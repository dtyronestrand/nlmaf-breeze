<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Make sure this use statement is present
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request; // Keep this for the destroy method
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'), // Using helper here is fine too
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Regenerate the session ID using the global helper
        session()->regenerate(); // <--- Use the helper function

        // Redirect to the intended URL or the dashboard route
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // You can use the helper here too for consistency, though $request->session() should work
        session()->invalidate();
        session()->regenerateToken();

        // Or keep the original if it wasn't causing issues:
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect('/');
    }
}
