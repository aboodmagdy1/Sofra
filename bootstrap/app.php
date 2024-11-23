<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('api/client')->group(base_path('routes/client-api.php'));
            Route::prefix('api/restaurant')->group(base_path('routes/restaurant-api.php'));
            Route::prefix('/admin/dashboard')->as('admin.')->middleware('web')->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('admin/dashboard/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
