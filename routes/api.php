<?php

use App\Http\Controllers\Api\GeneralController;
use Illuminate\Support\Facades\Route;

// --------------------------------General API routes --------------------------------------

Route::controller(GeneralController::class)->group(function () {
    Route::get('/cities',  'cities');
    Route::get('/districts',  'districts');
    Route::get('/categories',  'restaurant_categories');
});
