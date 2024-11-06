<?php

use App\Http\Controllers\Api\Client\AuthController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;


// General Routes 

Route::controller(GeneralController::class)->group(function () {
    Route::get('/cities', 'cities');
    Route::get('/districts', 'districts');
    Route::get('/categories', 'restaurant_categories');
});
