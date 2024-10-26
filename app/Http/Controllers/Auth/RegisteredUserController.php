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
            'identification' => ['nullable', 'string'], // Nullable for renters
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'], // Nullable for renters
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/rooms/';
            $file->move($path, $filename);
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'identification' => $request->role === 'owner' ? $request->identification : null, // Store NULL for renters
            'image' => $request->role === 'owner' ? $path . $filename : null, // Store NULL for renters
            'usertype' => 'user', // Default usertype
            'approved' => false, // Default not approved
        ]);

        event(new Registered($user));

        // Auto-login renters after registration
        if ($user->role !== 'owner') {
            Auth::login($user);
            return redirect()->route('dashboard'); // Redirect renters to a specific dashboard
        }

        return redirect()->route('login');
    }
}
