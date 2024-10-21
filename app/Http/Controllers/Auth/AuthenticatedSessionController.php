<?php

namespace App\Http\Controllers\Auth;

use App\Models\Owner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

        $user = $request->user();

        // Check if the user is an owner and is not approved
        if ($user->role === 'owner' && !$user->approved) {
            Auth::logout(); // Log out the user
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is not approved yet. Please wait for approval.',
            ]);
        }

        $request->session()->regenerate();

        if ($user->role == 'admin') {
            return redirect('admin/dashboard');
        }

        return redirect()->intended(route('dashboard'));
        }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
