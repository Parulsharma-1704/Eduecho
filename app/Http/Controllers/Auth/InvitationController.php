<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Student;
use App\Models\DisabilityProfile;
use App\Models\SpecialEducator;
use App\Models\EducatorDisabilitySpecialization;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        // Base validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'email' => ['required', 'email'],
        ];

        // Add student-specific validation rules
        if ($invitation->role === 'student') {
            $rules['disability_type'] = ['nullable', 'in:autism,adhd,dyslexia,hearing,visual,mobility'];
            $rules['severity'] = ['nullable', 'required_with:disability_type', 'in:mild,moderate,severe'];
            $rules['support_devices'] = ['nullable', 'string'];
            $rules['description'] = ['nullable', 'string', 'max:1000'];
        }

        // Add educator-specific validation rules
        if ($invitation->role === 'special_educator') {
            $rules['specializations'] = ['nullable', 'array'];
            $rules['specializations.*'] = ['in:autism,adhd,dyslexia,hearing,visual,mobility'];
            $rules['experience_years'] = ['nullable', 'integer', 'min:0', 'max:70'];
        }

        // Validate request data
        $request->validate($rules);

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

        // Create Student record and disability profile if role is student
        if ($invitation->role === 'student') {
            $student = Student::create([
                'user_id' => $user->id,
                'enrollment_date' => now(),
                'is_active' => true,
            ]);

            // Create disability profile if disability type is provided
            if ($request->disability_type) {
                $supportDevices = null;
                if ($request->support_devices) {
                    // Convert comma-separated string to JSON array
                    $supportDevices = json_encode(
                        array_map('trim', explode(',', $request->support_devices))
                    );
                }

                DisabilityProfile::create([
                    'student_id' => $student->id,
                    'disability_type' => $request->disability_type,
                    'severity' => $request->severity,
                    'support_devices' => $supportDevices,
                    'description' => $request->description,
                ]);
            }
        }

        // Create SpecialEducator record and specializations if role is special_educator
        if ($invitation->role === 'special_educator') {
            $educator = SpecialEducator::create([
                'user_id' => $user->id,
                'experience_years' => $request->experience_years ?? 0,
            ]);

            // Create specialization records
            if ($request->specializations && is_array($request->specializations)) {
                foreach ($request->specializations as $disabilityType) {
                    EducatorDisabilitySpecialization::create([
                        'educator_id' => $educator->id,
                        'disability_type' => $disabilityType,
                        'is_certified' => false,
                        'years_of_experience' => $request->experience_years ?? 0,
                    ]);
                }
            }
        }

        // Mark invitation as used
        DB::table('invitations')
            ->where('id', $invitation->id)
            ->update(['used_at' => now()]);

        // Trigger registered event
        event(new Registered($user));

        // Login user
        Auth::login($user);

        return redirect(route('dashboard', absolute: false))->with('success', 'Registration completed successfully!');
    }
}
