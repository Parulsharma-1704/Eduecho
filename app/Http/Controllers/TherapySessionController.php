<?php

namespace App\Http\Controllers;

use App\Models\TherapySession;
use App\Models\Student;
use App\Models\BehavioralNote;
use App\Http\Requests\StoreTherapySessionRequest;
use App\Http\Requests\UpdateTherapySessionRequest;
use Illuminate\Http\Request;

class TherapySessionController extends Controller
{
    /**
     * Display a listing of therapy sessions.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', TherapySession::class);

        $sessions = TherapySession::with('student', 'therapist')
            ->when($request->search, fn($q) => $q->whereHas('student', fn($q) => $q->whereHas('user', fn($q) => $q->where('name', 'like', "%{$request->search}%"))))
            ->paginate(15);

        return view('therapy-sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new therapy session.
     */
    public function create()
    {
        $this->authorize('create', TherapySession::class);
        return view('therapy-sessions.create');
    }

    /**
     * Store a newly created therapy session.
     */
    public function store(StoreTherapySessionRequest $request)
    {
        $session = TherapySession::create($request->validated());
        return redirect()->route('therapy-sessions.show', $session)->with('success', 'Therapy session created successfully.');
    }

    /**
     * Display the specified therapy session.
     */
    public function show(TherapySession $therapySession)
    {
        $this->authorize('view', $therapySession);
        $therapySession->load('student', 'therapist');
        return view('therapy-sessions.show', compact('therapySession'));
    }

    /**
     * Show the form for editing the specified therapy session.
     */
    public function edit(TherapySession $therapySession)
    {
        $this->authorize('update', $therapySession);
        return view('therapy-sessions.edit', compact('therapySession'));
    }

    /**
     * Update the specified therapy session.
     */
    public function update(UpdateTherapySessionRequest $request, TherapySession $therapySession)
    {
        $this->authorize('update', $therapySession);
        $therapySession->update($request->validated());
        return redirect()->route('therapy-sessions.show', $therapySession)->with('success', 'Therapy session updated successfully.');
    }

    /**
     * Remove the specified therapy session.
     */
    public function destroy(TherapySession $therapySession)
    {
        $this->authorize('delete', $therapySession);
        $therapySession->delete();
        return redirect()->route('therapy-sessions.index')->with('success', 'Therapy session deleted successfully.');
    }

    /**
     * Display therapy progress for a student
     */
    public function studentProgress(Student $student)
    {
        $this->authorize('view', $student);
        
        $sessions = $student->therapySessions()
            ->orderBy('session_date', 'desc')
            ->paginate(10);
        
        $totalSessions = $student->therapySessions()->count();
        $completedSessions = $student->therapySessions()
            ->where('session_date', '<=', now())
            ->count();
        
        $averageProgress = $student->therapySessions()
            ->avg('progress') ?? 0;
        
        $sessionsByType = $student->therapySessions()
            ->groupBy('session_type')
            ->selectRaw('session_type, COUNT(*) as count')
            ->get();
        
        $recentNotes = $student->behavioralNotes()
            ->orderBy('observation_date', 'desc')
            ->limit(5)
            ->get();
        
        return view('therapy-sessions.student-progress', compact(
            'student',
            'sessions',
            'totalSessions',
            'completedSessions',
            'averageProgress',
            'sessionsByType',
            'recentNotes'
        ));
    }

    /**
     * Display therapy dashboard with analytics
     */
    public function dashboard()
    {
        $this->authorize('viewAny', TherapySession::class);
        
        $totalSessions = TherapySession::count();
        $completedSessions = TherapySession::where('session_date', '<=', now())->count();
        $upcomingSessions = TherapySession::where('session_date', '>', now())
            ->orderBy('session_date')
            ->limit(5)
            ->get();
        
        $averageProgress = TherapySession::avg('progress') ?? 0;
        
        $therapySessions = TherapySession::with('student', 'therapist')
            ->orderBy('session_date', 'desc')
            ->limit(10)
            ->get();
        
        $sessionsByType = \DB::table('therapy_sessions')
            ->selectRaw('session_type, COUNT(*) as count')
            ->groupBy('session_type')
            ->get();
        
        return view('therapy-sessions.dashboard', compact(
            'totalSessions',
            'completedSessions',
            'upcomingSessions',
            'averageProgress',
            'therapySessions',
            'sessionsByType'
        ));
    }

    /**
     * Add behavioral note to a session
     */
    public function addBehavioralNote(Request $request, TherapySession $therapySession)
    {
        $this->authorize('update', $therapySession);
        
        $validated = $request->validate([
            'observation' => 'required|string',
            'emotion_state' => 'required|in:happy,calm,anxious,frustrated,angry,sad',
            'support_provided' => 'nullable|string',
        ]);
        
        $validated['student_id'] = $therapySession->student_id;
        $validated['created_by_id'] = auth()->id();
        $validated['observation_date'] = $therapySession->session_date;
        
        BehavioralNote::create($validated);
        
        return back()->with('success', 'Behavioral note added successfully.');
    }

    /**
     * Get behavioral notes for a student
     */
    public function behavioralNotes(Student $student)
    {
        $this->authorize('view', $student);
        
        $notes = $student->behavioralNotes()
            ->with('createdBy')
            ->orderBy('observation_date', 'desc')
            ->paginate(15);
        
        $emotionStats = $student->behavioralNotes()
            ->selectRaw('emotion_state, COUNT(*) as count')
            ->groupBy('emotion_state')
            ->get();
        
        return view('therapy-sessions.behavioral-notes', compact('student', 'notes', 'emotionStats'));
    }

    /**
     * Export therapy progress report
     */
    public function exportProgress(Student $student)
    {
        $this->authorize('view', $student);
        
        $sessions = $student->therapySessions()->with('therapist')->get();
        $notes = $student->behavioralNotes()->with('createdBy')->get();
        
        $html = view('therapy-sessions.export-progress', compact('student', 'sessions', 'notes'))->render();
        
        return response($html)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "attachment; filename=therapy-progress-{$student->id}.pdf");
    }
}
