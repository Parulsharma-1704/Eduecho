<?php

namespace App\Http\Controllers;

use App\Models\AccessibilityProfile;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessibilitySettingController extends Controller
{
    /**
     * Show accessibility settings page for a student
     */
    public function show(Student $student)
    {
        $this->authorize('view', $student);

        $profile = $student->accessibilityProfile ?? AccessibilityProfile::create([
            'student_id' => $student->id,
        ]);

        return view('accessibility.settings', compact('student', 'profile'));
    }

    /**
     * Update accessibility settings
     */
    public function update(Request $request, Student $student)
    {
        $this->authorize('update', $student);

        $validated = $request->validate([
            'font_size' => ['required', 'integer', 'in:12,14,16,18,20,24'],
            'font_family' => ['required', 'string', 'in:Roboto,Serif,Monospace,Dyslexia'],
            'line_spacing' => ['required', 'numeric', 'between:1,3'],
            'letter_spacing' => ['required', 'numeric', 'between:-10,10'],
            'high_contrast' => ['boolean'],
            'invert_colors' => ['boolean'],
            'text_to_speech' => ['boolean'],
            'screen_reader_mode' => ['boolean'],
            'voice_control' => ['boolean'],
            'keyboard_only' => ['boolean'],
            'reading_guide' => ['boolean'],
            'focus_mode' => ['boolean'],
            'color_scheme' => ['required', 'string', 'in:light,dark'],
        ]);

        $profile = $student->accessibilityProfile ?? new AccessibilityProfile(['student_id' => $student->id]);
        $profile->update($validated);

        return redirect()->route('accessibility.show', $student)
            ->with('success', 'Accessibility settings updated successfully.');
    }

    /**
     * Reset accessibility settings to defaults
     */
    public function reset(Student $student)
    {
        $this->authorize('update', $student);

        if ($student->accessibilityProfile) {
            $student->accessibilityProfile->update([
                'font_size' => 16,
                'font_family' => 'Roboto',
                'line_spacing' => 1.5,
                'letter_spacing' => 0,
                'high_contrast' => false,
                'invert_colors' => false,
                'text_to_speech' => false,
                'screen_reader_mode' => false,
                'voice_control' => false,
                'keyboard_only' => false,
                'reading_guide' => false,
                'focus_mode' => false,
                'color_scheme' => 'light',
            ]);
        }

        return redirect()->route('accessibility.show', $student)
            ->with('success', 'Accessibility settings reset to defaults.');
    }

    /**
     * Preview accessibility settings
     */
    public function preview(Student $student)
    {
        $this->authorize('view', $student);

        $profile = $student->accessibilityProfile;

        if (!$profile) {
            return response()->json(['error' => 'No accessibility profile found'], 404);
        }

        return response()->json([
            'font_size' => $profile->font_size,
            'font_family' => $profile->font_family,
            'line_spacing' => $profile->line_spacing,
            'letter_spacing' => $profile->letter_spacing,
            'high_contrast' => $profile->high_contrast,
            'invert_colors' => $profile->invert_colors,
            'color_scheme' => $profile->color_scheme,
        ]);
    }
}
