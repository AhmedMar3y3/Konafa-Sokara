<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Delegate\AuthController;



//////////////////////////////////////// User Routes ////////////////////////////////////////
//public routes
Route::post('/register'                     ,[AuthController::class, 'register']);
Route::post('/verify-email'                 ,[AuthController::class, 'verifyEmail']);
Route::post('/resend-code'                  ,[AuthController::class, 'resendCode']);
Route::post('/login'                        ,[AuthController::class, 'login']);
Route::post('/reset-password'               ,[AuthController::class, 'resetPassword']);
Route::post('/reset-password-send-code'     ,[AuthController::class, 'sendCode']);
Route::post('/reset-password-check-code'    ,[AuthController::class, 'checkCode']);

Route::middleware(['auth.delegate'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

});