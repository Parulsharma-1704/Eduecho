<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInvitationController extends Controller
{
    /**
     * Display a listing of all invitations
     */
    public function index()
    {
        // Only admins can view invitations
        $this->authorize('viewAny', Invitation::class);

        $invitations = Invitation::with('invitedBy')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('invitations.index', ['invitations' => $invitations]);
    }

    /**
     * Show the form for creating a new invitation
     */
    public function create()
    {
        // Only admins can create invitations
        $this->authorize('create', Invitation::class);

        $roles = ['special_educator', 'therapist', 'care_giver', 'support_staff', 'admin'];

        return view('invitations.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created invitation
     */
    public function store(Request $request)
    {
        // Only admins can create invitations
        $this->authorize('create', Invitation::class);

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string', 'in:special_educator,therapist,care_giver,support_staff,admin'],
        ]);

        // Check if invitation already exists for this email
        $existingInvitation = Invitation::where('email', $request->email)
            ->where('used_at', null)
            ->where('expires_at', '>', now())
            ->first();

        if ($existingInvitation) {
            return redirect()->back()
                ->with('error', 'An active invitation already exists for this email.');
        }

        // Check if user already exists
        if (\App\Models\User::where('email', $request->email)->exists()) {
            return redirect()->back()
                ->with('error', 'A user account with this email already exists.');
        }

        // Create invitation
        $invitation = Invitation::create([
            'email' => $request->email,
            'role' => $request->role,
            'token' => Invitation::generateToken(),
            'invited_by' => Auth::id(),
            'expires_at' => now()->addDays(7), // 7 days expiry
        ]);

        // Generate invitation link
        $invitationLink = route('invitation.show', ['token' => $invitation->token]);

        return redirect()->route('invitations.index')
            ->with('success', "Invitation created successfully. Share this link: {$invitationLink}");
    }

    /**
     * Display the specified invitation
     */
    public function show(string $id)
    {
        $invitation = Invitation::findOrFail($id);
        $this->authorize('view', $invitation);

        return view('invitations.show', ['invitation' => $invitation]);
    }

    /**
     * Show the form for editing the specified invitation
     */
    public function edit(string $id)
    {
        $invitation = Invitation::findOrFail($id);
        $this->authorize('update', $invitation);

        $roles = ['special_educator', 'therapist', 'care_giver', 'support_staff', 'admin'];

        return view('invitations.edit', ['invitation' => $invitation, 'roles' => $roles]);
    }

    /**
     * Update the specified invitation
     */
    public function update(Request $request, string $id)
    {
        $invitation = Invitation::findOrFail($id);
        $this->authorize('update', $invitation);

        // Can't update used invitations
        if ($invitation->used_at !== null) {
            return redirect()->back()->with('error', 'Cannot update a used invitation.');
        }

        $request->validate([
            'role' => ['required', 'string', 'in:special_educator,therapist,care_giver,support_staff,admin'],
            'expires_at' => ['required', 'date', 'after:now'],
        ]);

        $invitation->update($request->only('role', 'expires_at'));

        return redirect()->route('invitations.show', $invitation)
            ->with('success', 'Invitation updated successfully.');
    }

    /**
     * Remove the specified invitation
     */
    public function destroy(string $id)
    {
        $invitation = Invitation::findOrFail($id);
        $this->authorize('delete', $invitation);

        $invitation->delete();

        return redirect()->route('invitations.index')
            ->with('success', 'Invitation deleted successfully.');
    }
}
