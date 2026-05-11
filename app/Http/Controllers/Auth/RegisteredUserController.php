<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\DisabilityProfile;
use App\Models\SpecialEducator;
use App\Models\EducatorDisabilitySpecialization;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation rules for student registration only
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'disability_type' => ['nullable', 'in:autism,adhd,dyslexia,hearing,visual,mobility'],
            'severity' => ['nullable', 'required_with:disability_type', 'in:mild,moderate,severe'],
            'support_devices' => ['nullable', 'string'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];

        $request->validate($rules);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign student role
        $user->assignRole('student');

        // Create Student record
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

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
