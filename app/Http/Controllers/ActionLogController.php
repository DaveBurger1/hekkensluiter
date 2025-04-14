<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionLogController extends Controller
{
    public function index()
    {
        $logs = ActionLog::with(['user.profile', 'action'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('app.log.index', ['logs' => $logs]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return back()->withErrors(['user' => 'User must be logged in to log actions.']);
        }

        $validated = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'action_id' => 'required|exists:actions,id',
            'change' => 'nullable|string'
        ]);

        $log = ActionLog::create([
            'user_id' => $user->id,
            'prisoner_id' => $validated['prisoner_id'],
            'action_id' => $validated['action_id'],
            'change' => $validated['change'],
            'created_at' => now()
        ]);

        return back()->with('success', 'Actie succesvol gelogd');
    }

   public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}