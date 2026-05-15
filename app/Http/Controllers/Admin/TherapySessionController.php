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
            'duration'     => 'required|integer|min:15|max:300',
            'notes'        => 'nullable|string',
        ]);

        $validated['status'] = 'SCHEDULED';

        TherapySession::create($validated);

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
