<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\ActionLog;
use App\Models\Action;
use App\Models\Prisoner;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\CellOccupation; // Import CellOccupation model
class PrisonerController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\CheckRole::class . ':prisoner_make')->only(['create', 'store']);
    }

    public function cellStatus()
    {
        $cells = CellOccupation::with(['prisoner.profile'])
            ->whereNull('end_time')
            ->whereNull('end_time')
            ->orderBy('wing')
            ->orderBy('cell_number')
            ->get()
            ->groupBy(['wing', 'cell_number']);

        $allCells = [];
        $wingRanges = [
            'A' => ['start' => 100, 'end' => 110],
            'B' => ['start' => 200, 'end' => 205], 
            'C' => ['start' => 363, 'end' => 373]
        ];

        foreach ($wingRanges as $wing => $range) {
            for ($i = $range['start']; $i <= $range['end']; $i++) {
                $cellNumber = str_pad($i, 3, '0', STR_PAD_LEFT);
                $allCells[$wing][$cellNumber] = $cells[$wing][$cellNumber][0] ?? null;
            }
        }

        return view('app.prisoners.cell-status', ['cells' => $allCells]);
    }
    public function index()
    {
        $prisoners = Prisoner::all();
        return view('app.prisoners.index', ['prisoners' => $prisoners]);
    }

    public function create()
    {
        // Create empty objects for new prisoner form
        $profile = new Profile();
        $prisoner = new Prisoner();
        return view('app.prisoners.create', [
            'profile' => $profile,
            'prisoner' => $prisoner
        ]);
    }

    private function logAction(string $actionKey, Prisoner $prisoner, ?string $change = null): void
    {
        try {
            // First try to find existing action
            $action = Action::where('key', $actionKey)->first();

            // If action doesn't exist, create it
            if (!$action) {
                $action = Action::create([
                    'key' => $actionKey,
                    'name' => $actionKey,
                    'name_past' => $actionKey
                ]);
            }

            // Create the log
            ActionLog::create([
                'user_id' => request()->user()->id,
                'action_id' => $action->id,
                'prisoner_id' => $prisoner->id,
                'change' => $change,
                'created_at' => now()
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to log prisoner action: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        // Handle date conversion with try-catch
        try {
            $date = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $request->merge(['date_of_birth' => $date]);
        } catch (\Exception $e) {
            return back()->withErrors(['date_of_birth' => 'Ongeldige datum. Gebruik formaat DD/MM/YYYY']);
        }

        // Validate profile data including photo
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'tussenvoegsel' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'wing' => 'required|in:A,B,C',
            'cell_number' => 'required|string|max:4',
            'bsn' => 'required|string|size:9',
            'address' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string',
            'delict' => 'required|string|max:30',
            'photo' => 'nullable|image|max:2048' // max 2MB
        ]);

        if ($request->id) {
            // Update existing prisoner
            $prisoner = Prisoner::find($request->id);
            $prisoner->profile->update($validated);
        } else {
            try {
                DB::beginTransaction();

                // Handle photo upload if present
                if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                    $path = $request->file('photo')->store('photos', 'public');
                    $validated['photo'] = $path;
                }

                // Create new profile
                $profile = Profile::create($validated);
                
                // Create new prisoner linked to profile
                $prisoner = Prisoner::create([
                    'profile_id' => $profile->id
                ]);

                // Assign cell
                $prisoner->assignCell($request->wing, $request->cell_number);

                // Add new case if specified
                if ($request->new_case_id && $request->new_case_reason) {
                    $prisoner->cases()->attach($request->new_case_id, ['reason' => $request->new_case_reason]);
                }

                DB::commit();
            } catch (\InvalidArgumentException $e) {
                DB::rollBack();
                return back()->withErrors(['cell_number' => $e->getMessage()]);
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Er is een fout opgetreden bij het opslaan van de gevangene.']);
            }
        }

        $this->logAction('prisoner_make', $prisoner, 'Nieuwe gevangene aangemaakt');
        return to_route('prisoners.show', ['prisoner' => $prisoner]);
    }

    public function show(string $id)
    {
        $prisoner = Prisoner::with('profile')->findOrFail($id);
        $logs = ActionLog::with(['user.profile', 'action'])
            ->where('prisoner_id', $prisoner->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get users with groups director or coordinator
        $users = \App\Models\User::whereHas('groups', function ($query) {
            $query->whereIn('name', ['director', 'coordinator']);
        })->with('profile')->get();
            
        return view('app.prisoners.show', [
            'profile' => $prisoner->profile,
            'prisoner' => $prisoner,
            'logs' => $logs,
            'users' => $users
        ]);
    }

    public function edit(string $id)
    {
        $prisoner = Prisoner::find($id);
        $profile = $prisoner->profile ?? new \App\Models\Profile();
        return view('app.prisoners.edit', ['profile' => $profile, 'prisoner' => $prisoner]);
    }

    public function update(Request $request, string $id)
    {
        $prisoner = Prisoner::find($id);
        
        // Handle date conversion with try-catch
        try {
            $date = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $request->merge(['date_of_birth' => $date]);
        } catch (\Exception $e) {
            return back()->withErrors(['date_of_birth' => 'Ongeldige datum. Gebruik formaat DD/MM/YYYY']);
        }

        // Validate and update profile data
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'tussenvoegsel' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'wing' => 'required|in:A,B,C',
            'cell_number' => 'required|string|max:4',
            'bsn' => 'required|string|size:9',
            'address' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string',
            'delict' => 'required|string|max:30'
        ]);

        // Update profile data
        $prisoner->profile->update($validated);

        // Always update cell assignment with current values
        logger()->info('Cell assignment attempt', [
            'wing' => $request->wing,
            'cell_number' => $request->cell_number,
            'prisoner_id' => $prisoner->id
        ]);
        
        try {
            $cell = $prisoner->assignCell($request->wing, $request->cell_number);
            logger()->info('Cell assigned successfully', $cell->toArray());
        } catch (\InvalidArgumentException $e) {
            logger()->error('Cell assignment failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['cell_number' => $e->getMessage()]);
        }

        $this->logAction('prisoner_edit', $prisoner, 'Gevangene bewerkt');
        return to_route('prisoners.show', ['prisoner' => $prisoner]);
    }

    public function destroy(string $id)
    {
        $prisoner = Prisoner::find($id);
        $this->logAction('prisoner_delete', $prisoner, 'Gevangene verwijderd');
        $prisoner->delete();
        return to_route('prisoners.index');
    }

    public function moveCell(Request $request, string $id)
    {
        $prisoner = Prisoner::findOrFail($id);
        
        $validated = $request->validate([
            'wing' => 'required|in:A,B,C',
            'cell_number' => 'required|string|max:4'
        ]);

        try {
            $prisoner->assignCell($validated['wing'], $validated['cell_number']);
            $this->logAction('prisoner_move', $prisoner, 
                "Verplaatst naar cel {$validated['wing']}{$validated['cell_number']}");
            
            return back()->with('success', 'Gevangene succesvol verplaatst');
        } catch (\Exception $e) {
            return back()->withErrors(['cell_number' => $e->getMessage()]);
        }
    }
}