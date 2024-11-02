<?php

use App\Http\Controllers\Api\Restaurant\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:sanctum')->controller(AuthController::class)->group(function () {
    Route::post('/login',  'login');
    Route::post('/register',  'register');
    Route::post('/forget-password', 'forgetPassword');
    Route::post('/reset-password', 'resetPassword');
});

Route::middleware('auth:sanctum')->controller(AuthController::class)->group(function () {
    // Auth 
    Route::post('/logout', 'logout');
    Route::patch('/profile', 'updateProfile');

    // Restaurant ( must be authenticated)
});
