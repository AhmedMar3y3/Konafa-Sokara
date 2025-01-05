<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;

//public routes
Route::get('/', [AuthController::class, 'loadLoginPage'])->name('loginPage');
Route::post('/login-admin', [AuthController::class, 'loginUser'])->name('loginUser');

//protected routes
Route::middleware(['auth.admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout'); 
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

});
