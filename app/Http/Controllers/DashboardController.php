<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\IEP;
use App\Models\Assessment;
use App\Models\TherapySession;
use App\Models\SpecialEducator;
use App\Models\User;
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
                'total_educators' => User::role('special_educator')->count(),
            ];

            // Get recent students and all students for admin dashboard
            $recentStudents = Student::latest('created_at')
                ->select('id', 'user_id')
                ->with('user:id,name,email')
                ->take(5)
                ->get();

            $allStudents = Student::select('id', 'user_id')
                ->with('user:id,name,email')
                ->take(20)
                ->get();

            // Get recent educators
            $recentEducators = User::role('special_educator')
                ->select('id', 'name', 'email', 'created_at')
                ->latest('created_at')
                ->take(5)
                ->get();

            // Get upcoming therapy sessions
            $upcomingSessions = TherapySession::where('session_date', '>=', now())
                ->select('id', 'therapist_id', 'session_date', 'status', 'notes')
                ->with('therapist:id,name')
                ->orderBy('session_date', 'asc')
                ->take(5)
                ->get();

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
                'recentStudents' => $recentStudents,
                'allStudents' => $allStudents,
                'recentEducators' => $recentEducators,
                'upcomingSessions' => $upcomingSessions,
            ]);
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
                'total_students' => DB::table('students')->where('assigned_educator_id', $user->id)->count(),
                'total_courses' => DB::table('courses')->where('created_by_id', $user->id)->count(),
                'total_ieps' => DB::table('i_e_p_s')->where('created_by_id', $user->id)->count(),
                'total_assessments' => 0,
            ];

            // Get students assigned to this educator
            $recentStudents = Student::where('assigned_educator_id', $user->id)
                ->select('id', 'user_id')
                ->with('user:id,name,email')
                ->take(5)
                ->get();

            $allStudents = Student::where('assigned_educator_id', $user->id)
                ->select('id', 'user_id')
                ->with('user:id,name,email')
                ->take(20)
                ->get();

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

            // Get upcoming therapy sessions for students
            $upcomingSessions = TherapySession::whereIn('student_id', function($q) use ($user) {
                $q->select('id')->from('students')->where('assigned_educator_id', $user->id);
            })
                ->where('session_date', '>=', now())
                ->select('id', 'therapist_id', 'session_date', 'status', 'notes')
                ->with('therapist:id,name')
                ->orderBy('session_date', 'asc')
                ->take(5)
                ->get();

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
                'educator' => $educator,
                'recentStudents' => $recentStudents,
                'allStudents' => $allStudents,
                'upcomingSessions' => $upcomingSessions,
                'studentsWithSpecializedDisabilities' => $studentsWithSpecializedDisabilities,
            ]);
        } elseif ($user->hasRole('therapist')) {
            $stats = [
                'total_students' => DB::table('therapy_sessions')->where('therapist_id', $user->id)->distinct('student_id')->count('student_id'),
                'total_courses' => 0,
                'total_ieps' => 0,
                'total_assessments' => 0,
            ];

            // Get upcoming sessions for this therapist
            $upcomingSessions = TherapySession::where('therapist_id', $user->id)
                ->where('session_date', '>=', now())
                ->select('id', 'student_id', 'session_date', 'status', 'notes')
                ->with('student:id,user_id', 'student.user:id,name')
                ->orderBy('session_date', 'asc')
                ->take(5)
                ->get();

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
                'upcomingSessions' => $upcomingSessions,
            ]);
        } elseif ($user->hasRole('support_staff')) {
            $stats = [
                'total_students' => DB::table('students')->count(),
                'total_courses' => DB::table('courses')->where('is_active', true)->count(),
                'total_ieps' => DB::table('i_e_p_s')->count(),
                'total_assessments' => DB::table('assessments')->count(),
            ];

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
            ]);
        } elseif ($user->hasRole('care_giver')) {
            $stats = [
                'total_students' => 1,
                'total_courses' => 0,
                'total_ieps' => 0,
                'total_assessments' => 0,
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
