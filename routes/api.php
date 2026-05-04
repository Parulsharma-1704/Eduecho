<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\IEPController;
use App\Http\Controllers\Api\AssessmentController;
use App\Http\Controllers\Api\TherapySessionController;
use App\Http\Controllers\Api\ProgressReportController;
use App\Http\Controllers\Api\AdaptiveContentAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Students API
    Route::apiResource('students', StudentController::class);

    // Courses API
    Route::apiResource('courses', CourseController::class);

    // IEPs API
    Route::apiResource('ieps', IEPController::class);

    // Assessments API
    Route::apiResource('assessments', AssessmentController::class);

    // Therapy Sessions API
    Route::apiResource('therapy-sessions', TherapySessionController::class);

    // Progress Reports API (Read-only)
    Route::apiResource('progress-reports', ProgressReportController::class)
        ->only(['index', 'show']);

    // Adaptive Content API
    Route::get('adaptive-content', [AdaptiveContentAPIController::class, 'index']);
    Route::get('adaptive-content/course-resource/{resourceId}', [AdaptiveContentAPIController::class, 'getForCourseResource']);
    Route::get('adaptive-content/{adaptiveContent}/variations', [AdaptiveContentAPIController::class, 'getVariations']);
    Route::get('adaptive-content/{adaptiveContent}/variation/{variation}', [AdaptiveContentAPIController::class, 'getVariation']);
    Route::get('adaptive-content/{adaptiveContent}/student/{student}/recommended', [AdaptiveContentAPIController::class, 'getRecommendedForStudent']);
    Route::post('adaptive-content/{adaptiveContent}/student/{student}/usage', [AdaptiveContentAPIController::class, 'recordUsage']);
    Route::get('students/{student}/content-preferences', [AdaptiveContentAPIController::class, 'getStudentPreferences']);
    Route::post('students/{student}/content-preferences/{variation}', [AdaptiveContentAPIController::class, 'updateStudentPreference']);
});
