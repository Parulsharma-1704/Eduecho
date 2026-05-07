<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\IEP;
use App\Models\Assessment;
use App\Models\TherapySession;
use App\Models\SpecialEducator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $stats = [];
            if ($student) {
                $stats = [
                    'ieps_count' => DB::table('i_e_p_s')->where('student_id', $student->id)->count(),
                    'courses_count' => DB::table('course_enrollments')->where('student_id', $student->id)->count(),
                    'therapy_sessions' => DB::table('therapy_sessions')->where('student_id', $student->id)->count(),
                ];
            } else {
                $stats = ['ieps_count' => 0, 'courses_count' => 0, 'therapy_sessions' => 0];
            }

            // Get actionable data for students
            $enrolledCourses = collect();
            $pendingAssessments = collect();
            $upcomingSessions = collect();
            $disabilityProfile = null;
            $disabilityResources = collect();

            if ($student) {
                $enrolledCourses = Course::whereHas('enrollments', function($q) use ($student) {
                    $q->where('student_id', $student->id);
                })->select('id', 'title', 'description', 'created_by_id', 'is_active')
                    ->with('creator:id,name')
                    ->take(3)
                    ->get();

                $enrolledCourseIds = $enrolledCourses->pluck('id')->toArray();
                $pendingAssessments = collect();
                if (!empty($enrolledCourseIds)) {
                    $pendingAssessments = Assessment::whereIn('course_id', $enrolledCourseIds)
                        ->whereNotIn('id', function($q) use ($student) {
                            $q->select('assessment_id')
                                ->from('assessment_responses')
                                ->where('student_id', $student->id);
                        })
                        ->select('id', 'course_id', 'title', 'type')
                        ->take(3)
                        ->get();
                }

                $upcomingSessions = TherapySession::where('student_id', $student->id)
                    ->where('status', 'SCHEDULED')
                    ->where('session_date', '>=', now())
                    ->select('id', 'therapist_id', 'session_date', 'status', 'duration')
                    ->with('therapist:id,name')
                    ->orderBy('session_date', 'asc')
                    ->take(3)
                    ->get();

                // Load disability profile and related resources
                $disabilityProfile = $student->disabilityProfile;
                if ($disabilityProfile && $student->assigned_educator_id) {
                    // Get adaptive content/resources related to student's disability
                    $disabilityResources = Course::where('is_active', true)
                        ->where('created_by_id', $student->assigned_educator_id)
                        ->select('id', 'title', 'description', 'is_active')
                        ->take(5)
                        ->get();
                }
            }

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
                'enrolledCourses' => $enrolledCourses,
                'pendingAssessments' => $pendingAssessments,
                'upcomingSessions' => $upcomingSessions,
                'disabilityProfile' => $disabilityProfile,
                'disabilityResources' => $disabilityResources,
            ]);
        } elseif ($user->hasRole('special_educator')) {
            $educator = SpecialEducator::where('user_id', $user->id)
                ->with('disabilitySpecializations:id,educator_id,disability_type')
                ->first();
            
            $stats = [
                'students_assigned' => DB::table('students')->where('assigned_educator_id', $user->id)->count(),
                'courses_created' => DB::table('courses')->where('created_by_id', $user->id)->count(),
                'ieps_created' => DB::table('i_e_p_s')->where('created_by_id', $user->id)->count(),
            ];

            // Get students with disabilities matching educator's specializations
            $studentsWithSpecializedDisabilities = collect();
            if ($educator && $educator->disabilitySpecializations->isNotEmpty()) {
                $specializedDisabilities = $educator->disabilitySpecializations
                    ->pluck('disability_type')
                    ->toArray();

                $studentsWithSpecializedDisabilities = Student::whereHas('disabilityProfile', function($q) use ($specializedDisabilities) {
                    $q->whereIn('disability_type', $specializedDisabilities);
                })
                    ->select('id', 'user_id', 'assigned_educator_id', 'enrollment_date')
                    ->with('disabilityProfile:id,student_id,disability_type,severity', 'user:id,name,email')
                    ->take(5)
                    ->get();
            }

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
                'educator' => $educator,
                'studentsWithSpecializedDisabilities' => $studentsWithSpecializedDisabilities,
            ]);
        } elseif ($user->hasRole('therapist')) {
            $stats = [
                'sessions_completed' => DB::table('therapy_sessions')
                    ->where('therapist_id', $user->id)
                    ->where('status', 'COMPLETED')
                    ->count(),
                'sessions_pending' => DB::table('therapy_sessions')
                    ->where('therapist_id', $user->id)
                    ->where('status', 'SCHEDULED')
                    ->count(),
            ];

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
            ]);
        } elseif ($user->hasRole('support_staff')) {
            $stats = [
                'students_supported' => DB::table('students')->count(),
                'active_courses' => DB::table('courses')->where('is_active', true)->count(),
                'records_managed' => DB::table('i_e_p_s')->count(),
                'pending_tasks' => DB::table('assessments')->count(),
            ];

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
            ]);
        } elseif ($user->hasRole('care_giver')) {
            $student = Student::first(); // Care givers view their assigned students
            $stats = [
                'students_monitored' => 1, // This could be expanded to show assigned students
                'active_courses' => $student ? DB::table('course_enrollments')->where('student_id', $student->id)->count() : 0,
                'progress_updates' => $student ? DB::table('i_e_p_s')->where('student_id', $student->id)->count() : 0,
            ];

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
            ]);
        }

        return view('dashboard', [
            'user' => $user,
            'stats' => $stats ?? [],
        ]);
    }
}
