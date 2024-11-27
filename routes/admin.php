<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CommisionController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardClientController;
use App\Http\Controllers\Admin\DashboardRestaurantController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\MainDashboardController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PaymentMethodController;
use Illuminate\Support\Facades\Route;

// auth guest
Route::middleware(['guest'])->controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginSubmit')->name('loginSubmit');
    Route::get('/password/forgot', 'forgotPassword')->name('forgotPassword');
    Route::post('/password/forogt', 'submitForgotPassword')->name('submitForgotPassword');
    Route::get('/password/reset', 'resetPassword')->name('resetPassword');
    Route::post('/password/reset', 'submitResetPassword')->name('submitResetPassword');
});

// auth user
Route::middleware(['auth'])->controller(AuthController::class)->group(function () {
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/profile', 'profile')->name('profile');
    Route::put('/profile', 'updateProfile')->name('updateProfile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/',  [MainDashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings',  [MainDashboardController::class, 'appSettings'])->name('settings');
    Route::put('/settings',  [MainDashboardController::class, 'updateSettings'])->name('updateSettings');
    Route::resource('cities', CityController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('payment-methods', PaymentMethodController::class);
    Route::resource('commisions', CommisionController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('restaurants', DashboardRestaurantController::class);
    Route::resource('clients', DashboardClientController::class);
});
