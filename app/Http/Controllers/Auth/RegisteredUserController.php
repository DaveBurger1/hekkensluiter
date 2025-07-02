<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (!auth()->check() || !auth()->user()->hasGroup('director')) {
            abort(403, 'Unauthorized action.');
        }
        
        $groups = Group::all();
        return view('auth.register', ['groups' => $groups]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'group_id' => ['required', 'exists:groups,id']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the selected group to the user
        $group = Group::find($request->group_id);
        $user->groups()->attach($group);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Display the registration view for directors.
     */
    public function createForDirector(Request $request): View
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user || !method_exists($user, 'hasGroup') || !$user->hasGroup('director')) {
            abort(403, 'Unauthorized action.');
        }
        
        $role = $request->query('role');
        if ($role && in_array($role, ['bewaker', 'coordinator'])) {
            $groups = Group::where('name', $role)->get();
        } else {
            $groups = Group::whereIn('name', ['bewaker', 'coordinator'])->get();
        }
        $formAction = route('director.register');
        return view('auth.register', ['groups' => $groups, 'formAction' => $formAction]);
    }

    /**
     * Handle an incoming registration request from directors.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeForDirector(Request $request): RedirectResponse
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user || !$user->hasGroup('director')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'group_id' => ['required', 'exists:groups,id']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the selected group to the user
        $group = Group::find($request->group_id);
        $user->groups()->attach($group);

        event(new Registered($user));

        return redirect(route('dashboard', absolute: false));
    }
}
