<?php

use App\ApiResponseClass;
use App\Http\Middleware\PreventExamNavigation;
use App\Http\Middleware\RequestToJson;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'prevent.navigation' => PreventExamNavigation::class,
        ]);

        $middleware->api([PreventExamNavigation::class,]);
        $middleware->api(RequestToJson::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e, $request) {
            return ApiResponseClass::sendResponse(
                [],
                'Validation failed',
                422,
                $e->errors(), // all validation errors
                false
            );
        });
        $exceptions->render(function (QueryException $e, $request) {
            // You can log the full exception for debugging
            Log::error('Query Error: ' . $e->getMessage());

            // Return a generic error message to the client
            return ApiResponseClass::sendResponse(
                [],
                'An error occurred while processing your request.',
                500, // Internal Server Error
                $e->getMessage(),
                false
            );
        });
    })

    ->create();
