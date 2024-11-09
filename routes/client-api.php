<?php

use App\Http\Controllers\Api\Client\AuthController;
use App\Http\Controllers\Api\Client\MainClientController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:sanctum')->controller(AuthController::class)->group(function () {
    Route::post('/login',  'login');
    Route::post('/register',  'register');
    Route::post('/forget-password', 'forgetPassword');
    Route::post('/reset-password', 'resetPassword');
});

Route::middleware('auth:sanctum')->controller(AuthController::class)->group(function () {
    Route::post('/logout', 'logout');
    Route::patch('/profile', 'updateProfile');
});


Route::middleware('auth:sanctum')->controller(MainClientController::class)->group(function () {
    Route::post('/add-review', 'addReview');
});

Route::middleware('auth:sanctum')->controller(OrderController::class)->group(function () {
    Route::post('/new-order', 'createOrder');
    Route::get('/orders-current', 'myCurrentOrders');
    Route::get('/orders-previous', 'myPreviousOrders');
    Route::get('/orders/{order}', 'showOrder');
});
