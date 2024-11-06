<?php

use App\Http\Controllers\Api\Restaurant\AuthController;
use App\Http\Controllers\Api\Restaurant\MealController;
use App\Http\Controllers\Api\Restaurant\OfferController;
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
    Route::controller(MealController::class)->group(function () {
        Route::get('meals', 'index');
        Route::post('meals', 'store');
        Route::patch('meals/{id}', 'update');
        Route::delete('meals/{id}', 'delete');
    });

    Route::controller(OfferController::class)->group(function () {
        Route::post('offers', 'store');
        Route::patch('offers/{id}', 'update');
        Route::delete('offers/{id}', 'delete');
        Route::get('offers', 'index');
    });
});
