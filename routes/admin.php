<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MainDashboardController;
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
});

Route::middleware(['auth'])->controller(MainDashboardController::class)->group(function () {
    Route::get('/',  'index')->name('dashboard');
});
