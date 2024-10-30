<?php

use App\Http\Controllers\Api\Client\AuthController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;


// General Routes 

Route::controller(GeneralController::class)->group(function () {
    Route::get('/cities', [GeneralController::class, 'cities']);
    Route::get('/districts', [GeneralController::class, 'districts']);
    Route::get('/categories', [GeneralController::class, 'restaurant_categories']);
});
