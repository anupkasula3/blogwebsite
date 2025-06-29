<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;

Route::middleware('guest')->group(function () {
    // Registration Routes
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])
                ->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // User Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])
                ->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Admin Login Routes
    Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])
                ->name('admin.login');
    Route::post('admin/login', [AdminLoginController::class, 'login']);

    // Password Reset Routes
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
                ->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
                ->name('password.email');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
                ->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    // Logout Route
    Route::post('logout', [LoginController::class, 'logout'])
                ->name('logout');
});

Route::middleware('admin')->group(function () {
    // Admin Logout Route
    Route::post('admin/logout', [AdminLoginController::class, 'logout'])
                ->name('admin.logout');
});
