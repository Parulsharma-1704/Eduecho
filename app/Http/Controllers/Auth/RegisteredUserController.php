<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\DisabilityProfile;
use App\Models\EducatorRequest;
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
     * Display student registration form.
     */
    public function createStudent(): View
    {
        return view('auth.register-student');
    }

    /**
     * Handle student registration.
     */
    public function storeStudent(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'disability_type' => ['nullable', 'in:autism,adhd,dyslexia,hearing,visual,mobility'],
            'severity' => ['nullable', 'required_with:disability_type', 'in:mild,moderate,severe'],
            'support_devices' => ['nullable', 'string'],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign student role
        $user->assignRole('student');

        // Create student profile
        $student = Student::create([
            'user_id' => $user->id,
            'enrollment_date' => now(),
            'is_active' => true,
        ]);

        // Create disability profile if provided
        if ($request->disability_type) {
            $supportDevices = null;
            if ($request->support_devices) {
                $supportDevices = json_encode(
                    array_map('trim', explode(',', $request->support_devices))
                );
            }

            DisabilityProfile::create([
                'student_id' => $student->id,
                'disability_type' => $request->disability_type,
                'severity' => $request->severity,
                'support_devices' => $supportDevices,
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false))
            ->with('success', 'Welcome to EduEcho! Your student account is ready.');
    }

    /**
     * Display educator registration form.
     */
    public function createEducator(): View
    {
        return view('auth.register-educator');
    }

    /**
     * Handle educator registration.
     */
    public function storeEducator(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'qualification' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'experience_description' => ['nullable', 'string', 'max:1000'],
            'specializations' => ['required', 'array', 'min:1'],
            'specializations.*' => ['in:autism,adhd,dyslexia,hearing,visual,mobility'],
            'educator_disability_type' => ['nullable', 'in:autism,adhd,dyslexia,hearing,visual,mobility'],
            'educator_support_devices' => ['nullable', 'string'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'certifications' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'motivation' => ['nullable', 'string', 'max:1000'],
            'terms_agreed' => ['required', 'accepted'],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Store resume if provided
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('educator_documents/resumes', 'local');
        }

        // Store certification if provided
        $certificationPath = null;
        if ($request->hasFile('certifications')) {
            $certificationPath = $request->file('certifications')->store('educator_documents/certifications', 'local');
        }

        // Create educator request (pending approval)
        EducatorRequest::create([
            'user_id' => $user->id,
            'qualification' => $request->qualification,
            'experience' => $request->experience_description,
            'specializations' => $request->specializations,
            'motivation' => $request->motivation,
            'status' => 'pending',
            'review_notes' => json_encode([
                'resume' => $resumePath,
                'certifications' => $certificationPath,
                'experience_years' => $request->experience_years,
                'educator_disability' => $request->educator_disability_type,
                'educator_support' => $request->educator_support_devices,
            ]),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false))
            ->with('success', 'Application submitted! Your profile is under admin review. You\'ll receive an email once approved.');
    }

    /**
     * Display therapist registration form.
     */
    public function createTherapist(): View
    {
        return view('auth.register-therapist');
    }

    /**
     * Handle therapist registration.
     */
    public function storeTherapist(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'license_type' => ['required', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'experience_description' => ['nullable', 'string', 'max:1000'],
            'specializations' => ['required', 'array', 'min:1'],
            'specializations.*' => ['in:autism,adhd,dyslexia,hearing,visual,mobility,anxiety,depression'],
            'license_certificate' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'certifications' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'motivation' => ['nullable', 'string', 'max:1000'],
            'terms_agreed' => ['required', 'accepted'],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Store license certificate
        $licensePath = $request->file('license_certificate')->store('therapist_documents/licenses', 'local');

        // Store certifications if provided
        $certificationPath = null;
        if ($request->hasFile('certifications')) {
            $certificationPath = $request->file('certifications')->store('therapist_documents/certifications', 'local');
        }

        // Create therapist request (pending approval)
        EducatorRequest::create([
            'user_id' => $user->id,
            'qualification' => $request->license_type,
            'experience' => $request->experience_description,
            'specializations' => $request->specializations,
            'motivation' => $request->motivation,
            'status' => 'pending',
            'review_notes' => json_encode([
                'role' => 'therapist',
                'license_number' => $request->license_number,
                'license_certificate' => $licensePath,
                'certifications' => $certificationPath,
                'experience_years' => $request->experience_years,
            ]),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false))
            ->with('success', 'Application submitted! Your credentials are under admin review. You\'ll receive an email once approved.');
    }
}
