<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class InvitationController extends Controller
{
    /**
     * Display invitation registration form
     */
    public function show(string $token): View|RedirectResponse
    {
        // Find invitation by token
        $invitation = Invitation::where('token', $token)->first();

        // Check if invitation exists and is valid
        if (!$invitation || !$invitation->isValid()) {
            return redirect()->route('register')
                ->with('error', 'Invalid or expired invitation link.');
        }

        return view('auth.register-invitation', ['invitation' => $invitation]);
    }

    /**
     * Handle invitation registration
     */
    public function store(Request $request, string $token): RedirectResponse
    {
        // Find and validate invitation
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation || !$invitation->isValid()) {
            return redirect()->route('register')
                ->with('error', 'Invalid or expired invitation link.');
        }

        // Validate request data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Check if email matches invitation
        if ($request->email !== $invitation->email) {
            throw ValidationException::withMessages([
                'email' => ['Email does not match the invitation.'],
            ]);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the invited role
        $user->assignRole($invitation->role);

        // Mark invitation as used
        $invitation->markAsUsed();

        // Trigger registered event
        event(new Registered($user));

        // Login user
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
