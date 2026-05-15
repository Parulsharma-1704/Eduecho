<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'approved' => \App\Http\Middleware\CheckApproved::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle authorization exceptions
        $exceptions->render(function ($_e, Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized',
                    'error' => 'You do not have permission to perform this action.',
                ], 403);
            }
        });

        // Handle authentication exceptions
        $exceptions->render(function ($_e, Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'error' => 'Authentication required. Please log in.',
                ], 401);
            }
        });

        // Handle validation exceptions
        $exceptions->render(function (ValidationException $e, Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unprocessable Entity',
                    'errors' => $e->errors(),
                ], 422);
            }
        });

        // Handle model not found exceptions
        $exceptions->render(function ($_e, Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Not Found',
                    'error' => 'The requested resource was not found.',
                ], 404);
            }
        });

        // Handle general exceptions
        $exceptions->render(function (Throwable $e, Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Server Error',
                    'error' => config('app.debug') ? $e->getMessage() : 'An internal server error occurred.',
                ], 500);
            }
        });
    })
    ->withProviders([
        App\Providers\AuthServiceProvider::class,
    ])->create();
