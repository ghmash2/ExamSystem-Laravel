<?php

use App\ApiResponseClass;
use App\Http\Middleware\RequestToJson;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

        $middleware->api(RequestToJson::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e, $request) {
            return ApiResponseClass::sendResponse(
                [],
                'Validation failed',
                422,
                $e->errors(),
                false
            );
        });
        $exceptions->render(function (ModelNotFoundException $e, $request) {
            return ApiResponseClass::sendResponse(
                [],
                'Resource not found.',
                404,
                $e->getMessage(),
                false
            );
        });
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return ApiResponseClass::sendResponse(
                [],
                'The requested URL was not found on this server.',
                404,
                $e->getMessage(),
                false
            );
        });
        $exceptions->render(function (QueryException $e, $request) {
            return ApiResponseClass::sendResponse(
                [],
                'An error occurred while processing your request.',
                500, // Internal Server Error
                $e->getMessage(),
                false
            );
        });
        $exceptions->render(function (ErrorException $e, $request) {
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
