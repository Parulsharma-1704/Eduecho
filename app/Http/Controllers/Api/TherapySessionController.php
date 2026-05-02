<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTherapySessionRequest;
use App\Http\Resources\TherapySessionResource;
use App\Models\TherapySession;
use Illuminate\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\JsonResponse;

class TherapySessionController extends Controller
{
    /**
     * Display a listing of therapy sessions.
     */
    public function index(): ResourceCollection
    {
        $this->authorize('viewAny', TherapySession::class);

        $sessions = TherapySession::with('student', 'therapist')
            ->paginate(15);

        return TherapySessionResource::collection($sessions);
    }

    /**
     * Store a newly created therapy session.
     */
    public function store(StoreTherapySessionRequest $request): JsonResponse
    {
        $session = TherapySession::create($request->validated());

        return response()->json(
            new TherapySessionResource($session->load('student', 'therapist')),
            201
        );
    }

    /**
     * Display the specified therapy session.
     */
    public function show(TherapySession $session): TherapySessionResource
    {
        $this->authorize('view', $session);

        return new TherapySessionResource($session->load('student', 'therapist'));
    }

    /**
     * Update the specified therapy session.
     */
    public function update(StoreTherapySessionRequest $request, TherapySession $session): TherapySessionResource
    {
        $this->authorize('update', $session);

        $session->update($request->validated());

        return new TherapySessionResource($session);
    }

    /**
     * Remove the specified therapy session.
     */
    public function destroy(TherapySession $session): JsonResponse
    {
        $this->authorize('delete', $session);

        $session->delete();

        return response()->json(['message' => 'Therapy session deleted successfully'], 200);
    }
}
