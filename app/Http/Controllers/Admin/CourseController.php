<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Store a newly created course from admin dashboard.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string',
            'created_by_id'       => 'required|exists:users,id',
            'max_students'        => 'nullable|integer|min:1',
            'accessibility_level' => 'nullable|string|max:100',
            'target_disabilities' => 'nullable|string|max:255',
        ]);

        $validated['is_active'] = true;

        Course::create($validated);

        return redirect()->back()->with('success', 'Course created successfully.');
    }

    /**
     * Toggle the active status of a course.
     */
    public function toggleActive(Course $course)
    {
        $course->is_active = !$course->is_active;
        $course->save();

        return redirect()->back()->with('success', 'Course status updated.');
    }

    /**
     * Remove the specified course.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted successfully.');
    }
}
