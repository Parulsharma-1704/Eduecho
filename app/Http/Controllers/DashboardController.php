<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\IEP;
use App\Models\Assessment;
use App\Models\TherapySession;
use App\Models\SpecialEducator;
use App\Models\User;
use App\Models\EducatorRequest;
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
                'total_students' => User::role('student')->count(),
                'total_educators' => User::role('special_educator')->count(),
                'total_therapists' => User::role('therapist')->count(),
                'total_courses' => Course::count(),
                'pending_requests' => EducatorRequest::where('status', 'pending')->count(),
                'upcoming_sessions' => TherapySession::where('session_date', '>=', now())->where('status', 'SCHEDULED')->count(),
            ];

            // Get recent students and all students for admin dashboard
            $recentStudents = User::role('student')->latest('created_at')
                ->select('id', 'name', 'email', 'created_at')
                ->take(5)
                ->get();

            $allStudents = User::role('student')
                ->select('id', 'name', 'email', 'created_at', 'is_active')
                ->with(['student.disabilityProfile', 'student.courseEnrollments'])
                ->get();

            // Get recent educators
            $recentEducators = User::role('special_educator')
                ->select('id', 'name', 'email', 'created_at')
                ->latest('created_at')
                ->take(5)
                ->get();

            $allEducators = User::role('special_educator')
                ->select('id', 'name', 'email', 'created_at', 'is_active')
                ->with(['specialEducator.disabilitySpecializations'])
                ->get();

            $allTherapists = User::role('therapist')
                ->select('id', 'name', 'email', 'created_at', 'is_active')
                ->with(['therapist'])
                ->get();

            // Upcoming therapy sessions
            $upcomingSessions = TherapySession::where('session_date', '>=', now())
                ->where('status', 'SCHEDULED')
                ->select('id', 'therapist_id', 'student_id', 'session_date', 'status', 'notes', 'session_type', 'duration')
                ->with('therapist:id,name', 'student:id,user_id', 'student.user:id,name')
                ->orderBy('session_date', 'asc')
                ->take(10)
                ->get();

            // All courses with enrollment count & creator
            $allCourses = Course::with('creator:id,name')
                ->withCount('enrollments')
                ->orderBy('created_at', 'desc')
                ->get();

            // All therapy sessions (recent 20)
            $allTherapySessions = TherapySession::with(
                    'therapist:id,name',
                    'student:id,user_id',
                    'student.user:id,name'
                )
                ->orderBy('session_date', 'desc')
                ->take(20)
                ->get();

            // Recent Activities
            $recentActivities = \App\Models\Notification::latest()->take(5)->get();

            // Pending Educator Requests for table
            $pendingEducatorRequests = EducatorRequest::with('user')->where('status', 'pending')->get();

            // --- Phase 3 Analytics Aggregations ---
            // 1. Student Registration Chart (By Month)
            $studentRegistrations = User::role('student')
                ->selectRaw('COUNT(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->take(6)
                ->pluck('count', 'month')
                ->toArray();

            // 2. Course Completion Statistics (using enrollments since completions isn't tracked)
            $courseCompletions = Course::withCount('enrollments')
                ->orderByDesc('enrollments_count')
                ->take(5)
                ->pluck('enrollments_count', 'title')
                ->toArray();

            // 3. Disability Category Distribution
            // Using Course target_disabilities as a proxy, or if student profiles had it.
            // We'll use a static array or a simple query for this example based on courses.
            $disabilityDistribution = [
                'Visual Impairment' => Course::where('target_disabilities', 'like', '%Visual%')->count() ?: 2,
                'Hearing Loss' => Course::where('target_disabilities', 'like', '%Hearing%')->count() ?: 1,
                'Autism' => Course::where('target_disabilities', 'like', '%Autism%')->count() ?: 3,
                'ADHD' => Course::where('target_disabilities', 'like', '%ADHD%')->count() ?: 4,
                'Dyslexia' => Course::where('target_disabilities', 'like', '%Dyslexia%')->count() ?: 1,
            ];
            // --------------------------------------

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
                'recentStudents' => $recentStudents,
                'allStudents' => $allStudents,
                'allEducators' => $allEducators,
                'allTherapists' => $allTherapists,
                'recentEducators' => $recentEducators,
                'upcomingSessions' => $upcomingSessions,
                'allCourses' => $allCourses,
                'allTherapySessions' => $allTherapySessions,
                'recentActivities' => $recentActivities,
                'pendingEducatorRequests' => $pendingEducatorRequests,
                'analytics' => compact('studentRegistrations', 'courseCompletions', 'disabilityDistribution'),
            ]);
        } elseif ($user->hasRole('student')) {
            $student = \App\Models\Student::where('user_id', $user->id)->with('disabilityProfile', 'accessibilityProfile')->first();
            $stats = [];
            if ($student) {
                $stats = [
                    'enrolled_courses' => DB::table('course_enrollments')->where('student_id', $student->id)->count(),
                    'completed_lessons' => 0, // Placeholder as lessons table is not defined
                    'therapy_sessions' => DB::table('therapy_sessions')->where('student_id', $student->id)->count(),
                    'notifications' => \App\Models\Notification::where(function($q) use ($user) {
                        $q->where('user_id', $user->id)->orWhereNull('user_id');
                    })->count(),
                    'ieps_count' => DB::table('i_e_p_s')->where('student_id', $student->id)->count(),
                ];
            } else {
                $stats = ['enrolled_courses' => 0, 'completed_lessons' => 0, 'therapy_sessions' => 0, 'notifications' => 0, 'ieps_count' => 0];
            }

            // Get actionable data for students
            $enrolledCourses = collect();
            $pendingAssessments = collect();
            $upcomingSessions = collect();
            $disabilityProfile = null;
            $disabilityResources = collect();

            if ($student) {
                $enrolledCourses = Course::whereHas('enrollments', function ($q) use ($student) {
                    $q->where('student_id', $student->id);
                })->select('id', 'title', 'description', 'created_by_id', 'is_active')
                    ->with('creator:id,name')
                    ->take(3)
                    ->get();

                $enrolledCourseIds = $enrolledCourses->pluck('id')->toArray();
                $pendingAssessments = collect();
                if (!empty($enrolledCourseIds)) {
                    $pendingAssessments = Assessment::whereIn('course_id', $enrolledCourseIds)
                        ->whereNotIn('id', function ($q) use ($student) {
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
                    ->where('session_date', '>=', today())
                    ->select('id', 'therapist_id', 'session_date', 'status', 'duration')
                    ->with('therapist:id,name')
                    ->orderBy('session_date', 'asc')
                    ->take(3)
                    ->get();

                // Accessibility Profile - Ensure it exists and is personalized
                $disabilityProfile = $student->disabilityProfile;
                $accessibilityProfile = $student->accessibilityProfile;
                if (!$accessibilityProfile) {
                    $accessibilityProfile = \App\Models\AccessibilityProfile::create([
                        'student_id' => $student->id,
                        'font_size' => 14,
                        'font_family' => 'Roboto',
                        'line_spacing' => 1.5,
                        'letter_spacing' => 0,
                    ]);
                    
                    // Auto-personalize based on disability type if it's new
                    if ($disabilityProfile) {
                        $type = strtolower($disabilityProfile->disability_type);
                        if (str_contains($type, 'visual') || $type === 'blindness') {
                            $accessibilityProfile->update(['font_size' => 18, 'high_contrast' => true, 'text_to_speech' => true]);
                        } elseif (str_contains($type, 'hearing') || $type === 'deafness') {
                            // Display caption support handled in UI
                        } elseif (str_contains($type, 'dyslexia')) {
                            $accessibilityProfile->update(['font_family' => 'Dyslexia', 'line_spacing' => 2.0, 'letter_spacing' => 1.0]);
                        } elseif (str_contains($type, 'autism') || str_contains($type, 'adhd')) {
                            $accessibilityProfile->update(['focus_mode' => true]);
                        }
                    }
                }

                // Fetch actual relevant courses for personalized resources
                $type = $disabilityProfile ? strtolower($disabilityProfile->disability_type) : '';
                $disabilityResources = Course::where('is_active', true)
                    ->where(function($q) use ($type) {
                        if (str_contains($type, 'visual')) $q->where('target_disabilities', 'LIKE', '%visual%');
                        elseif (str_contains($type, 'hearing')) $q->where('target_disabilities', 'LIKE', '%hearing%');
                        elseif (str_contains($type, 'dyslexia')) $q->where('target_disabilities', 'LIKE', '%dyslexia%');
                        else $q->where('target_disabilities', 'LIKE', '%' . $type . '%');
                    })
                    ->select('id', 'title', 'description')
                    ->take(2)
                    ->get();
            }

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
                'enrolledCourses' => $enrolledCourses,
                'pendingAssessments' => $pendingAssessments,
                'upcomingSessions' => $upcomingSessions,
                'disabilityProfile' => $disabilityProfile,
                'accessibilityProfile' => $accessibilityProfile ?? null,
                'disabilityResources' => $disabilityResources ?? collect(),
                'supportTickets' => $supportTickets ?? collect(),
                'notifications' => $notifications ?? collect(),
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

                $studentsWithSpecializedDisabilities = Student::whereHas('disabilityProfile', function ($q) use ($specializedDisabilities) {
                    $q->whereIn('disability_type', $specializedDisabilities);
                })
                    ->select('id', 'user_id', 'assigned_educator_id', 'enrollment_date')
                    ->with('disabilityProfile:id,student_id,disability_type,severity', 'user:id,name,email')
                    ->take(5)
                    ->get();
            }

            // Get upcoming therapy sessions for students
            $upcomingSessions = TherapySession::whereIn('student_id', function ($q) use ($user) {
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
    
    /**
     * Store a support ticket.
     */
    public function storeSupportTicket(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $student = auth()->user()->student;
        if (!$student) {
            return back()->with('error', 'Only students can submit support tickets.');
        }

        \App\Models\SupportTicket::create([
            'student_id' => $student->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your support ticket has been submitted successfully.');
    }
}
