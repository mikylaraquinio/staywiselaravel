<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        return view('auth.register');
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
            'number' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'in:owner,renter'], // Ensure role is valid
            'identification' => ['required_if:role,owner', 'string'], // Required only for owners
            'image' => ['required_if:role,owner', 'image', 'mimes:png,jpg,jpeg'], // Required only for owners
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'identification' => $request->role === 'owner' ? $request->identification : null,
            'image' => $request->role === 'owner' ? $request->file('image')->store('images') : null,
            'usertype' => 'user', // Default usertype
            'approved' => false, // Default not approved
        ]);

        event(new Registered($user));

        if ($user->role !== 'owner') {
            Auth::login($user);
        }

        return redirect()->route('login');
    }
}
