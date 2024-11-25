<?php

use App\Http\Controllers\Api\Client\AuthController;
use App\Http\Controllers\GeneralController;
use Illuminate\Support\Facades\Route;


// General Routes 

Route::controller(GeneralController::class)->group(function () {
    Route::get('/cities', 'cities')->name('cities');
    Route::get('/districts', 'districts')->name('districts');
    Route::get('/categories', 'restaurant_categories')->name('restaurant_categories');
    Route::get('/restaurants', 'list_restaurants');
    Route::get('/restaurants/{id}', 'show_restaurant');
    Route::get('/settings', 'settings');
    Route::post('/contact', 'contact');
});
