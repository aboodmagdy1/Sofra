<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Restaurant\AuthController;
use App\Http\Controllers\Api\Restaurant\MealController;
use App\Http\Controllers\Api\Restaurant\OfferController;
use App\Http\Controllers\Api\Restaurant\RestaurantController;
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
});

Route::middleware('auth:sanctum')->group(function () {

    // Restaurant ( must be authenticated)
    Route::apiResource('meals', MealController::class);
    Route::apiResource('offers', OfferController::class);

    Route::controller(RestaurantController::class)->group(function () {
        Route::get('reviews', 'listReviews');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('current-orders', 'restCurrentOrders');
        Route::get('new-orders', 'restNewOrders');
        Route::get('previous-orders', 'restPrevOrders');
        Route::get('/orders-commission', 'commission');
    });
});
