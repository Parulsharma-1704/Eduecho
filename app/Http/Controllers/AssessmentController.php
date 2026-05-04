<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentResponse;
use App\Models\Student;
use App\Http\Requests\StoreAssessmentRequest;
use App\Http\Requests\UpdateAssessmentRequest;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of assessments.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Assessment::class);

        $assessments = Assessment::with('course', 'questions')
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->paginate(15);

        return view('assessments.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new assessment.
     */
    public function create()
    {
        $this->authorize('create', Assessment::class);
        return view('assessments.create');
    }

    /**
     * Store a newly created assessment.
     */
    public function store(StoreAssessmentRequest $request)
    {
        $assessment = Assessment::create($request->validated());
        return redirect()->route('assessments.show', $assessment)->with('success', 'Assessment created successfully.');
    }

    /**
     * Display the specified assessment.
     */
    public function show(Assessment $assessment)
    {
        $this->authorize('view', $assessment);
        $assessment->load('course', 'questions');
        return view('assessments.show', compact('assessment'));
    }

    /**
     * Show the form for editing the specified assessment.
     */
    public function edit(Assessment $assessment)
    {
        $this->authorize('update', $assessment);
        return view('assessments.edit', compact('assessment'));
    }

    /**
     * Update the specified assessment.
     */
    public function update(UpdateAssessmentRequest $request, Assessment $assessment)
    {
        $this->authorize('update', $assessment);
        $assessment->update($request->validated());
        return redirect()->route('assessments.show', $assessment)->with('success', 'Assessment updated successfully.');
    }

    /**
     * Remove the specified assessment.
     */
    public function destroy(Assessment $assessment)
    {
        $this->authorize('delete', $assessment);
        $assessment->delete();
        return redirect()->route('assessments.index')->with('success', 'Assessment deleted successfully.');
    }

    /**
     * Start taking an assessment (interactive UI)
     */
    public function take(Assessment $assessment, Student $student)
    {
        // Get or create assessment response
        $response = AssessmentResponse::firstOrCreate(
            ['assessment_id' => $assessment->id, 'student_id' => $student->id],
            ['response_data' => []]
        );

        // Get adapted questions for student
        $questions = $assessment->getAdaptedQuestionsForStudent($student);
        $accommodations = $assessment->getAccommodationsForStudent($student);
        $adjustedTimeLimit = $assessment->getAdjustedTimeLimit($student);

        return view('assessments.take', compact('assessment', 'student', 'response', 'questions', 'accommodations', 'adjustedTimeLimit'));
    }

    /**
     * Submit assessment responses
     */
    public function submit(Request $request, Assessment $assessment, Student $student)
    {
        $response = AssessmentResponse::where('assessment_id', $assessment->id)
            ->where('student_id', $student->id)
            ->firstOrFail();

        $validated = $request->validate([
            'responses' => 'required|array',
            'time_taken' => 'required|integer',
        ]);

        // Calculate score
        $totalPoints = 0;
        $earnedPoints = 0;
        $responseData = $validated['responses'];

        foreach ($assessment->questions as $question) {
            $totalPoints += $question->points;
            if (isset($responseData[$question->id]) && $question->isCorrect($responseData[$question->id])) {
                $earnedPoints += $question->points;
            }
        }

        $scorePercentage = $totalPoints > 0 ? round(($earnedPoints / $totalPoints) * 100) : 0;

        $response->update([
            'response_data' => $responseData,
            'score' => $scorePercentage,
            'time_taken' => $validated['time_taken'],
            'used_extra_time' => $validated['time_taken'] > ($assessment->time_limit * 60),
            'completed_at' => now(),
        ]);

        return redirect()->route('assessments.results', [$assessment, $student])
            ->with('success', 'Assessment submitted successfully!');
    }

    /**
     * View assessment results
     */
    public function results(Assessment $assessment, Student $student)
    {
        $response = AssessmentResponse::where('assessment_id', $assessment->id)
            ->where('student_id', $student->id)
            ->firstOrFail();

        $questions = $assessment->questions;
        $responseData = $response->response_data;

        // Calculate detailed breakdown
        $breakdown = [];
        foreach ($questions as $question) {
            $studentAnswer = $responseData[$question->id] ?? null;
            $breakdown[] = [
                'question' => $question,
                'student_answer' => $studentAnswer,
                'is_correct' => $studentAnswer ? $question->isCorrect($studentAnswer) : false,
                'points_earned' => ($studentAnswer && $question->isCorrect($studentAnswer)) ? $question->points : 0,
                'points_possible' => $question->points,
            ];
        }

        return view('assessments.results', compact('assessment', 'student', 'response', 'breakdown'));
    }

    /**
     * View student's assessment history
     */
    public function studentResults(Student $student)
    {
        $this->authorize('view', $student);

        $responses = $student->assessmentResponses()
            ->with('assessment')
            ->orderBy('completed_at', 'desc')
            ->paginate(10);

        $averageScore = $student->assessmentResponses()
            ->whereNotNull('completed_at')
            ->avg('score') ?? 0;

        $completedCount = $student->assessmentResponses()
            ->whereNotNull('completed_at')
            ->count();

        $totalCount = $student->assessmentResponses()->count();

        return view('assessments.student-results', compact(
            'student',
            'responses',
            'averageScore',
            'completedCount',
            'totalCount'
        ));
    }

    /**
     * Get assessment analytics
     */
    public function analytics(Assessment $assessment)
    {
        $this->authorize('view', $assessment);

        $totalResponses = $assessment->responses()->count();
        $completedResponses = $assessment->responses()->whereNotNull('completed_at')->count();
        $averageScore = $assessment->getAverageScore();
        $completionRate = $assessment->getCompletionRate();

        // Score distribution
        $scoreDistribution = $assessment->responses()
            ->whereNotNull('completed_at')
            ->selectRaw('CASE 
                WHEN score >= 80 THEN "80-100"
                WHEN score >= 60 THEN "60-79"
                WHEN score >= 40 THEN "40-59"
                ELSE "0-39"
            END as range, COUNT(*) as count')
            ->groupBy('range')
            ->get();

        // Time taken statistics
        $timeStats = $assessment->responses()
            ->whereNotNull('completed_at')
            ->selectRaw('AVG(time_taken) as avg_time, MIN(time_taken) as min_time, MAX(time_taken) as max_time')
            ->first();

        return view('assessments.analytics', compact(
            'assessment',
            'totalResponses',
            'completedResponses',
            'averageScore',
            'completionRate',
            'scoreDistribution',
            'timeStats'
        ));
    }
}
