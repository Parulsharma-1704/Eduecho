<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Handle therapist-specific profile updates
        if ($user->hasRole('therapist') && $user->therapist) {
            $user->therapist->update(array_filter([
                'specialization'   => $request->specialization,
                'certification'    => $request->certification,
                'experience_years' => $request->experience_years,
            ], fn($v) => !is_null($v)));
        }

        // Handle educator specializations and general details
        if ($user->hasRole('special_educator')) {
            $specialEducator = $user->specialEducator;
            if ($specialEducator) {
                $specialEducator->update([
                    'specialization'   => $request->specialization,
                    'qualification'    => $request->qualification,
                    'experience_years' => $request->experience_years,
                ]);

                $specialEducator->disabilitySpecializations()->delete();
                if ($request->has('specializations')) {
                    foreach ($request->specializations as $type) {
                        \App\Models\EducatorDisabilitySpecialization::create([
                            'educator_id'   => $specialEducator->id,
                            'disability_type' => $type,
                        ]);
                    }
                }
            }
        }

        return Redirect::route('dashboard')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
