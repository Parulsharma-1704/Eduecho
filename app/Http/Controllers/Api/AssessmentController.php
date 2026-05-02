<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAssessmentRequest;
use App\Http\Requests\UpdateAssessmentRequest;
use App\Http\Resources\AssessmentResource;
use App\Models\Assessment;
use Illuminate\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class AssessmentController extends Controller
{
    /**
     * Display a listing of assessments.
     */
    public function index(): ResourceCollection
    {
        $this->authorize('viewAny', Assessment::class);

        $assessments = Assessment::with('course', 'questions')
            ->paginate(15);

        return AssessmentResource::collection($assessments);
    }

    /**
     * Store a newly created assessment.
     */
    public function store(StoreAssessmentRequest $request): JsonResponse
    {
        $assessment = Assessment::create($request->validated());

        return response()->json(
            new AssessmentResource($assessment->load('course')),
            201
        );
    }

    /**
     * Display the specified assessment.
     */
    public function show(Assessment $assessment): AssessmentResource
    {
        $this->authorize('view', $assessment);

        return new AssessmentResource($assessment->load('course', 'questions', 'responses'));
    }

    /**
     * Update the specified assessment.
     */
    public function update(UpdateAssessmentRequest $request, Assessment $assessment): AssessmentResource
    {
        $this->authorize('update', $assessment);

        $assessment->update($request->validated());

        return new AssessmentResource($assessment);
    }

    /**
     * Remove the specified assessment.
     */
    public function destroy(Assessment $assessment): JsonResponse
    {
        $this->authorize('delete', $assessment);

        $assessment->delete();

        return response()->json(['message' => 'Assessment deleted successfully'], 200);
    }
}
