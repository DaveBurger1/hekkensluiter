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
<<<<<<< HEAD

        $validated = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'user_id' => 'required|exists:users,id',
=======
        if (!$user) {
            return back()->withErrors(['user' => 'User must be logged in to log actions.']);
        }

        $validated = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
            'action_id' => 'required|exists:actions,id',
            'change' => 'nullable|string'
        ]);

<<<<<<< HEAD
        // Use user_id from form or fallback to authenticated user
        $userId = $validated['user_id'] ?? ($user ? $user->id : null);
        if (!$userId) {
            return back()->withErrors(['user' => 'User must be logged in or selected to log actions.']);
        }

        $log = ActionLog::create([
            'user_id' => $userId,
=======
        $log = ActionLog::create([
            'user_id' => $user->id,
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
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