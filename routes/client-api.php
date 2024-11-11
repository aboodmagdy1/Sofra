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

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::patch('/profile', [AuthController::class, 'updateProfile']);


    Route::post('/add-review', [MainClientController::class, 'addReview']);


    Route::controller(OrderController::class)->group(function () {
        Route::post('/new-order', 'createOrder');
        Route::get('/orders-current', 'clientCurrentOrders');
        Route::get('/orders-previous', 'clientPreviousOrders');
        Route::get('/orders/{order}', 'showOrder');
        Route::patch('/receive-order/{id}', 'receiveOrder');
        Route::patch('/cancel-order/{id}', 'cancelOrder');
    });
});
