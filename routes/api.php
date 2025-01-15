<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\ResetPasswordController;

Route::post('/register-admin', 'App\Http\Controllers\Admin\AuthController@register');

//////////////////////////////////////// User Routes ////////////////////////////////////////
//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/resend-code', [AuthController::class, 'resendCode']);
Route::post('/login', [AuthController::class, 'login']);

// reset password //
Route::post('/reset-password-send-code'     ,[ResetPasswordController::class, 'sendCode']);
Route::post('/reset-password-check-code'    ,[ResetPasswordController::class, 'checkCode']);
Route::post('/reset-password'               ,[ResetPasswordController::class, 'resetPassword']);
// reset password //

//protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('set-location', [AuthController::class, 'setLocation']);
    Route::post('/logout', [AuthController::class, 'logout']);

// profile routes //
    Route::get('/get-profile', [ProfileController::class, 'getProfile']);
    Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
    // Route::get('/my-orders', [ProfileController::class, 'myOrders']);
    Route::post('/delete-account', [ProfileController::class, 'deleteAccount']);
    Route::post('/change-password', [ProfileController::class, 'changePassword']);
    Route::get('/faqs', [ProfileController::class, 'faqs']);
// profile routes //

});