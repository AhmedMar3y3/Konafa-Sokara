<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;



Route::post('/register-admin', 'App\Http\Controllers\Admin\AuthController@register');

//////////////////////////////////////// User Routes ////////////////////////////////////////
//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/resend-code', [AuthController::class, 'resendCode']);
Route::post('set-location', [AuthController::class, 'setLocation']);
Route::post('/login', [AuthController::class, 'login']);