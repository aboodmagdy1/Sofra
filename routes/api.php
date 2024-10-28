<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->controller(GeneralController::class)->group(function () {
    Route::get('/cities', [GeneralController::class, 'cities']);
    Route::get('/districts', [GeneralController::class, 'districts']);
    Route::get('/categories', [GeneralController::class, 'restaurant_categories']);
});


Route::controller(AuthController::class)->group(function () {
    Route::post('/login',  'login');
    Route::post('/register',  'register');
});
