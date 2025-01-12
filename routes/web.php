<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;

//public routes
Route::get('/', [AuthController::class, 'loadLoginPage'])->name('loginPage');
Route::post('/login-admin', [AuthController::class, 'loginUser'])->name('loginUser');

//protected routes
Route::middleware(['auth.admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout'); 
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

    // category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/category/{id}/subcategories', [CategoryController::class, 'showSubCategories'])->name('admin.categories.show');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::post('categories/{parentId}/subcategories', [CategoryController::class, 'storeSubCategory'])->name('admin.categories.storeSubCategory');

});
