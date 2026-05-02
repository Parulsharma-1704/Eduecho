<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\IEPController;
use App\Http\Controllers\Api\AssessmentController;
use App\Http\Controllers\Api\TherapySessionController;
use App\Http\Controllers\Api\ProgressReportController;
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
});
