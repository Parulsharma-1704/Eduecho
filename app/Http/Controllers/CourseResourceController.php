<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseResourceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'resource_type' => 'required|string|in:video,audio,pdf,reading,interactive',
            'file' => 'required|file|max:20480', // 20MB max
            'disability_category' => 'required|string|in:Visual Impairment,Hearing Impairment,Dyslexia,Autism / ADHD',
            'accessibility_support_type' => 'required|string|in:Audio-Based,Caption-Supported,Dyslexia-Friendly,Screen-Reader Friendly,Interactive Learning',
            'has_captions' => 'boolean',
            'has_transcript' => 'boolean',
            'has_audio_description' => 'boolean',
            'text_size_options' => 'boolean',
            'high_contrast_version' => 'boolean',
        ]);

        $course = Course::findOrFail($validated['course_id']);
        
        $user = auth()->user();

        // Validate alignment with educator specializations (if not admin)
        if (!$user->hasRole('admin')) {
            $specialEducator = \App\Models\SpecialEducator::where('user_id', $user->id)
                ->with('disabilitySpecializations')
                ->first();
            
            if (!$specialEducator) {
                return back()->withErrors(['disability_category' => 'You do not have a special educator profile to upload materials.'])->withInput();
            }

            $specializations = $specialEducator->disabilitySpecializations->pluck('disability_type')->map(fn($item) => strtolower($item))->toArray();
            
            $category = strtolower($validated['disability_category']);
            $courseTarget = strtolower($course->target_disabilities ?? '');
            $isAligned = false;

            if (str_contains($category, 'visual') && in_array('visual', $specializations)) {
                $isAligned = true;
            } elseif (str_contains($category, 'hearing') && in_array('hearing', $specializations)) {
                $isAligned = true;
            } elseif (str_contains($category, 'dyslexia') && in_array('dyslexia', $specializations)) {
                $isAligned = true;
            } elseif ((str_contains($category, 'autism') || str_contains($category, 'adhd')) && (in_array('autism', $specializations) || in_array('adhd', $specializations))) {
                $isAligned = true;
            }

            if (!$isAligned) {
                return back()->withErrors(['disability_category' => 'You can only upload materials matching your certified disability specialization area.'])->withInput();
            }

            // Also verify the course target disability matches the educator's specialization
            $courseAligned = false;
            foreach ($specializations as $spec) {
                if (str_contains($courseTarget, $spec)) {
                    $courseAligned = true;
                    break;
                }
            }
            if (!$courseAligned) {
                return back()->withErrors(['course_id' => 'This course is not aligned with your disability specialization area.'])->withInput();
            }
        }

        // Handle file upload
        $path = $request->file('file')->store('course-resources/' . $course->id, 'public');

        CourseResource::create([
            'course_id' => $validated['course_id'],
            'title' => $validated['title'],
            'resource_type' => $validated['resource_type'],
            'file_path' => $path,
            'disability_category' => $validated['disability_category'],
            'accessibility_support_type' => $validated['accessibility_support_type'],
            'has_captions' => $request->has('has_captions'),
            'has_transcript' => $request->has('has_transcript'),
            'has_audio_description' => $request->has('has_audio_description'),
            'text_size_options' => $request->has('text_size_options'),
            'high_contrast_version' => $request->has('high_contrast_version'),
            'description' => $request->description ?? '',
        ]);

        return redirect(route('dashboard') . '?panel=learning-materials')->with('success', 'Learning material uploaded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseResource $resource)
    {
        $user = auth()->user();
        if (auth()->id() !== $resource->course->created_by_id && auth()->id() !== $resource->course->assigned_educator_id && !$user->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        // Delete the file
        if ($resource->file_path) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return redirect(route('dashboard') . '?panel=learning-materials')->with('success', 'Learning material deleted successfully.');
    }

    /**
     * Securely download or view the resource.
     */
    public function download(CourseResource $resource)
    {
        $user = auth()->user();

        // 1. Educators and Admins have full access
        if ($user->hasRole('admin') || $user->hasRole('special_educator')) {
            if (Storage::disk('public')->exists($resource->file_path)) {
                return Storage::disk('public')->download($resource->file_path);
            }
            abort(404, 'Resource file not found in storage.');
        }

        // 2. Students must meet enrollment and disability profile matching
        if ($user->hasRole('student')) {
            $student = $user->student;
            if (!$student) {
                abort(403, 'Unauthorized access.');
            }

            // Enrollment check (must be active/approved)
            $isEnrolled = \App\Models\CourseEnrollment::where('course_id', $resource->course_id)
                ->where('student_id', $student->id)
                ->where('status', 'Active')
                ->exists();

            if (!$isEnrolled) {
                abort(403, 'Unauthorized access: You are not enrolled in this course or your request is pending approval.');
            }

            // Disability profile check
            $studentDisabilityType = $student->disabilityProfile ? strtolower($student->disabilityProfile->disability_type) : '';
            $materialCategory = strtolower($resource->disability_category);
            $isAligned = false;

            if (str_contains($studentDisabilityType, 'visual') && str_contains($materialCategory, 'visual')) {
                $isAligned = true;
            } elseif (str_contains($studentDisabilityType, 'hearing') && str_contains($materialCategory, 'hearing')) {
                $isAligned = true;
            } elseif (str_contains($studentDisabilityType, 'dyslexia') && str_contains($materialCategory, 'dyslexia')) {
                $isAligned = true;
            } elseif ((str_contains($studentDisabilityType, 'autism') || str_contains($studentDisabilityType, 'adhd')) && (str_contains($materialCategory, 'autism') || str_contains($materialCategory, 'adhd'))) {
                $isAligned = true;
            }

            if (!$isAligned) {
                abort(403, 'Unauthorized access: This material is not aligned with your disability profile.');
            }

            if (Storage::disk('public')->exists($resource->file_path)) {
                return Storage::disk('public')->download($resource->file_path);
            }
            abort(404, 'Resource file not found in storage.');
        }

        abort(403, 'Unauthorized access.');
    }
}
