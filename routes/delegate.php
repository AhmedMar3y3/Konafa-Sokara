<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Delegate\AuthController;
use App\Http\Controllers\Api\Delegate\ProfileController;



//////////////////////////////////////// Delegate Routes ////////////////////////////////////////
//public routes
Route::post('/register'                     ,[AuthController::class, 'register']);
Route::post('/verify-email'                 ,[AuthController::class, 'verifyEmail']);
Route::post('/resend-code'                  ,[AuthController::class, 'resendCode']);
Route::post('/login'                        ,[AuthController::class, 'login']);
Route::post('/reset-password'               ,[AuthController::class, 'resetPassword']);
Route::post('/reset-password-send-code'     ,[AuthController::class, 'sendCode']);
Route::post('/reset-password-check-code'    ,[AuthController::class, 'checkCode']);

Route::middleware(['auth.delegate'])->group(function () {

    // profile routes //
    Route::post('/logout',          [AuthController::class, 'logout']);
    Route::post('set-location',     [AuthController::class, 'setLocation']);
    Route::get('/get-profile',      [ProfileController::class, 'getProfile']);
    Route::post('/update-profile',  [ProfileController::class, 'updateProfile']);
    Route::get('/faqs',             [ProfileController::class, 'faqs']);
    Route::get('/my-orders',        [ProfileController::class, 'myOrders']);
    Route::get('/notifications',    [ProfileController::class, 'getNotifications']);
    Route::post('/update-token', [ProfileController::class, 'updateToken']);
});