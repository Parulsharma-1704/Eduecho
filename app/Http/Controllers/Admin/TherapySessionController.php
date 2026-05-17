<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TherapySession;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class TherapySessionController extends Controller
{
    /**
     * Store a newly created therapy session from admin dashboard.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'   => 'required|exists:students,id',
            'therapist_id' => 'required|exists:users,id',
            'session_type' => 'required|string|in:speech,occupational,physical,behavioral,counseling,special_education',
            'session_date' => 'required|date',
            'session_time' => 'required|date_format:H:i',
            'duration'     => 'required|integer|min:15|max:300',
            'notes'        => 'nullable|string',
        ]);

        $validated['status'] = 'SCHEDULED';
        
        // Combine date and time
        $validated['session_date'] = \Carbon\Carbon::parse($validated['session_date'] . ' ' . $validated['session_time']);
        
        // Remove session_time as it's not in the database schema
        unset($validated['session_time']);

        $session = TherapySession::create($validated);

        // Fetch related models for notification context
        $student = Student::with('user')->find($validated['student_id']);
        $therapist = User::find($validated['therapist_id']);

        // Notification for Therapist
        \App\Models\Notification::create([
            'user_id' => $therapist->id,
            'notification_type' => 'session_scheduled',
            'title' => 'New Therapy Session',
            'message' => 'A new ' . ucfirst($validated['session_type']) . ' therapy session has been scheduled with ' . ($student->user->name ?? 'a student') . ' on ' . $validated['session_date']->format('M d, Y \a\t h:i A') . '.',
            'is_read' => false,
        ]);

        // Notification for Student
        if ($student && $student->user_id) {
            \App\Models\Notification::create([
                'user_id' => $student->user_id,
                'notification_type' => 'session_scheduled',
                'title' => 'New Therapy Session',
                'message' => 'A new ' . ucfirst($validated['session_type']) . ' therapy session has been scheduled with ' . $therapist->name . ' on ' . $validated['session_date']->format('M d, Y \a\t h:i A') . '.',
                'is_read' => false,
            ]);
        }

        return redirect()->back()->with('success', 'Therapy session scheduled successfully.');
    }

    /**
     * Update the status of a therapy session.
     */
    public function updateStatus(Request $request, TherapySession $therapySession)
    {
        $validated = $request->validate([
            'status' => 'required|in:SCHEDULED,COMPLETED,CANCELLED',
        ]);

        $therapySession->update($validated);

        return redirect()->back()->with('success', 'Session status updated.');
    }

    /**
     * Remove the specified therapy session.
     */
    public function destroy(TherapySession $therapySession)
    {
        $therapySession->delete();
        return redirect()->back()->with('success', 'Therapy session deleted successfully.');
    }
}
