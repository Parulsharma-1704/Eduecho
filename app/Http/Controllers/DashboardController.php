<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\IEP;
use App\Models\Assessment;
use App\Models\TherapySession;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Get statistics based on user role
        $stats = [];
        if ($user->hasRole('admin')) {
            $stats = [
                'total_students' => Student::count(),
                'total_courses' => Course::count(),
                'total_ieps' => IEP::count(),
                'total_assessments' => Assessment::count(),
            ];
        } elseif ($user->hasRole('student')) {
            $student = $user->student;
            $stats = [
                'ieps_count' => $student?->ieps?->count() ?? 0,
                'courses_count' => $student?->courses?->count() ?? 0,
                'therapy_sessions' => $student?->therapySessions?->count() ?? 0,
            ];
        } elseif ($user->hasRole('special_educator')) {
            $stats = [
                'students_assigned' => Student::where('assigned_educator_id', $user->id)->count(),
                'courses_created' => Course::where('created_by_id', $user->id)->count(),
                'ieps_created' => IEP::where('created_by_id', $user->id)->count(),
            ];
        } elseif ($user->hasRole('therapist')) {
            $stats = [
                'sessions_completed' => TherapySession::where('therapist_id', $user->id)
                    ->where('status', 'COMPLETED')->count(),
                'sessions_pending' => TherapySession::where('therapist_id', $user->id)
                    ->where('status', 'SCHEDULED')->count(),
            ];
        }

        return view('dashboard', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }
}
