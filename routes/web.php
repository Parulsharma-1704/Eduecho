<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IEPController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\TherapySessionController;
use App\Http\Controllers\ProgressReportController;
use App\Http\Controllers\UserInvitationController;
use App\Http\Controllers\AccessibilitySettingController;
use App\Http\Controllers\AdaptiveContentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Students
    Route::resource('students', StudentController::class);

    // Courses
    Route::resource('courses', CourseController::class);

    // IEPs (Individualized Education Programs)
    Route::resource('ieps', IEPController::class);

    // Assessments
    Route::resource('assessments', AssessmentController::class);
    Route::get('/assessments/{assessment}/students/{student}/take', [AssessmentController::class, 'take'])->name('assessments.take');
    Route::post('/assessments/{assessment}/students/{student}/submit', [AssessmentController::class, 'submit'])->name('assessments.submit');
    Route::get('/assessments/{assessment}/students/{student}/results', [AssessmentController::class, 'results'])->name('assessments.results');
    Route::get('/students/{student}/assessment-results', [AssessmentController::class, 'studentResults'])->name('assessments.student-results');
    Route::get('/assessments/{assessment}/analytics', [AssessmentController::class, 'analytics'])->name('assessments.analytics');

    // Therapy Sessions
    Route::resource('therapy-sessions', TherapySessionController::class);
    Route::get('/therapy/dashboard', [TherapySessionController::class, 'dashboard'])->name('therapy.dashboard');
    Route::get('/students/{student}/therapy-progress', [TherapySessionController::class, 'studentProgress'])->name('therapy.student-progress');
    Route::post('/therapy-sessions/{therapySession}/behavioral-note', [TherapySessionController::class, 'addBehavioralNote'])->name('therapy.add-note');
    Route::get('/students/{student}/behavioral-notes', [TherapySessionController::class, 'behavioralNotes'])->name('therapy.behavioral-notes');
    Route::get('/students/{student}/therapy-progress/export', [TherapySessionController::class, 'exportProgress'])->name('therapy.export-progress');

    // Progress Reports (read-only)
    Route::resource('progress-reports', ProgressReportController::class)->only(['index', 'show']);

    // User Invitations (admin only)
    Route::resource('invitations', UserInvitationController::class);

    // Accessibility Settings (students & educators)
    Route::get('students/{student}/accessibility', [AccessibilitySettingController::class, 'show'])->name('accessibility.show');
    Route::patch('students/{student}/accessibility', [AccessibilitySettingController::class, 'update'])->name('accessibility.update');
    Route::post('students/{student}/accessibility/reset', [AccessibilitySettingController::class, 'reset'])->name('accessibility.reset');
    Route::get('students/{student}/accessibility/preview', [AccessibilitySettingController::class, 'preview'])->name('accessibility.preview');

    // Adaptive Content (educators & admins)
    Route::resource('adaptive-content', AdaptiveContentController::class);
    Route::post('adaptive-content/{adaptiveContent}/variations', [AdaptiveContentController::class, 'createVariation'])->name('adaptive-content.variations.create');
    Route::patch('adaptive-content/{adaptiveContent}/variations/{variation}', [AdaptiveContentController::class, 'updateVariation'])->name('adaptive-content.variations.update');
    Route::delete('adaptive-content/{adaptiveContent}/variations/{variation}', [AdaptiveContentController::class, 'deleteVariation'])->name('adaptive-content.variations.destroy');
    Route::get('adaptive-content/{adaptiveContent}/student/{student}/recommended', [AdaptiveContentController::class, 'getRecommendedVariation'])->name('adaptive-content.recommended');

    // Compliance & Governance
    Route::prefix('compliance')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\ComplianceController::class, 'dashboard'])->name('compliance.dashboard');
        Route::get('/audits', [\App\Http\Controllers\ComplianceController::class, 'audits'])->name('compliance.audits');
        Route::get('/audits/create', [\App\Http\Controllers\ComplianceController::class, 'createAudit'])->name('compliance.audits.create');
        Route::post('/audits', [\App\Http\Controllers\ComplianceController::class, 'storeAudit'])->name('compliance.audits.store');
        Route::get('/audits/{accessibilityAudit}', [\App\Http\Controllers\ComplianceController::class, 'showAudit'])->name('compliance.audits.show');
        Route::get('/logs', [\App\Http\Controllers\ComplianceController::class, 'logs'])->name('compliance.logs');
        Route::get('/reports', [\App\Http\Controllers\ComplianceController::class, 'generateReport'])->name('compliance.reports');
        Route::get('/export', [\App\Http\Controllers\ComplianceController::class, 'export'])->name('compliance.export');
        Route::get('/governance', [\App\Http\Controllers\ComplianceController::class, 'governance'])->name('compliance.governance');
    });

    // Educator Requests
    Route::prefix('educator-requests')->group(function () {
        Route::get('/create', [App\Http\Controllers\EducatorRequestController::class, 'create'])->name('educator-request.create');
        Route::post('/', [App\Http\Controllers\EducatorRequestController::class, 'store'])->name('educator-request.store');
        Route::get('/', [App\Http\Controllers\EducatorRequestController::class, 'index'])->name('educator-request.index');
        Route::get('/{educatorRequest}', [App\Http\Controllers\EducatorRequestController::class, 'show'])->name('educator-request.show');
        Route::post('/{educatorRequest}/approve', [App\Http\Controllers\EducatorRequestController::class, 'approve'])->name('educator-request.approve');
        Route::post('/{educatorRequest}/reject', [App\Http\Controllers\EducatorRequestController::class, 'reject'])->name('educator-request.reject');
    });

    // Tutoring Hub & Matching
    Route::prefix('tutoring')->group(function () {
        Route::get('/matching', [\App\Http\Controllers\TutoringController::class, 'matching'])->name('tutoring.matching');
        Route::get('/find-tutors', [\App\Http\Controllers\TutoringController::class, 'findTutors'])->name('tutoring.find-tutors');
        Route::post('/connect/{educator}', [\App\Http\Controllers\TutoringController::class, 'requestConnection'])->name('tutoring.request-connect');
        Route::get('/hub', [\App\Http\Controllers\TutoringController::class, 'hub'])->name('tutoring.hub');
        Route::get('/api/messages/{contact}', [\App\Http\Controllers\TutoringController::class, 'getMessages'])->name('tutoring.messages.get');
        Route::post('/api/messages/{contact}', [\App\Http\Controllers\TutoringController::class, 'sendMessage'])->name('tutoring.messages.send');
    });
});

require __DIR__ . '/auth.php';
