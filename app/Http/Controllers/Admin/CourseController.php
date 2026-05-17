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
            'support_type'        => 'nullable|string|max:255',
        ]);

        $validated['is_active'] = true;
        // Optionally set assigned educator to creator for now, or just leave null
        $validated['assigned_educator_id'] = $validated['created_by_id'];

        Course::create($validated);

        return redirect()->back()->with('success', 'Course created successfully.');
    }

    /**
     * Assign an educator to the course.
     */
    public function assignEducator(Request $request, Course $course)
    {
        $validated = $request->validate([
            'assigned_educator_id' => 'required|exists:users,id',
        ]);

        $course->assigned_educator_id = $validated['assigned_educator_id'];
        $course->save();

        return redirect()->back()->with('success', 'Educator assigned to course successfully.');
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

    /**
     * Self-enroll a student in a course.
     */
    public function enroll(Request $request, Course $course)
    {
        $student = auth()->user()->student;
        if (!$student) {
            return redirect()->back()->with('error', 'Only students can enroll in courses.');
        }

        // Check if already enrolled or requested
        $existing = \App\Models\CourseEnrollment::where('course_id', $course->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'You have already requested enrollment or are enrolled in this course.');
        }

        \App\Models\CourseEnrollment::create([
            'course_id' => $course->id,
            'student_id' => $student->id,
            'status' => 'Pending', // Status is Pending until approved
            'enrolled_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Your enrollment request is pending admin approval.');
    }

    /**
     * Approve a pending enrollment (Admin only).
     */
    public function approveEnrollment(Request $request, $enrollmentId)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'Only admins can approve enrollments.');
        }

        $enrollment = \App\Models\CourseEnrollment::findOrFail($enrollmentId);
        $enrollment->status = 'Active'; // Approved and active
        $enrollment->save();

        // Notify student of approval
        if ($enrollment->student && $enrollment->student->user_id) {
            \App\Models\Notification::create([
                'user_id' => $enrollment->student->user_id,
                'notification_type' => 'announcement',
                'title' => 'Course Enrollment Approved',
                'message' => 'Your request to enroll in "' . $enrollment->course->title . '" has been approved!',
                'is_read' => false,
            ]);
        }

        return redirect()->back()->with('success', 'Enrollment approved successfully.');
    }
}
