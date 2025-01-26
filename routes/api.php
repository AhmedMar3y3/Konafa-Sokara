<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\CartController;
use App\Http\Controllers\Api\User\HomeController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\FavouriteController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\ResetPasswordController;
use App\Services\PaymentGateway\PaymentService;

Route::post('/register-admin', 'App\Http\Controllers\Admin\AuthController@register');

//////////////////////////////////////// User Routes ////////////////////////////////////////
//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/resend-code', [AuthController::class, 'resendCode']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('payment/get-payment-status'                 ,[PaymentService::class, 'callback'])->name('payment.getPaymentStatus');

// reset password //
Route::post('/reset-password-send-code'     ,[ResetPasswordController::class, 'sendCode']);
Route::post('/reset-password-check-code'    ,[ResetPasswordController::class, 'checkCode']);
Route::post('/reset-password'               ,[ResetPasswordController::class, 'resetPassword']);

// home routes //
Route::get('/categories'     , [HomeController::class, 'categories']);
Route::get('/categories/{categoryId}/subcategory/{subcategoryId?}', [HomeController::class, 'products']);
Route::get('/newest-products', [HomeController::class, 'newestProducts']);
Route::get('/offers', [HomeController::class, 'offers']);
Route::get('/most-sold-products', [HomeController::class, 'mostSoldProducts']);
Route::get('/banners', [HomeController::class, 'banners']);

//protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('set-location', [AuthController::class, 'setLocation']);
    Route::post('/logout', [AuthController::class, 'logout']);

// profile routes //
    Route::get('/get-profile', [ProfileController::class, 'getProfile']);
    Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
    Route::get('/my-orders', [ProfileController::class, 'myOrders']);
    Route::post('/delete-account', [ProfileController::class, 'deleteAccount']);
    Route::post('/change-password', [ProfileController::class, 'changePassword']);
    Route::get('/faqs', [ProfileController::class, 'faqs']);

// home routes //
    Route::get('/product/{id}', [HomeController::class, 'showProduct']);

// favourite routes //
    Route::get('/favourites', [FavouriteController::class, 'index']);
    Route::post('/toggle-favourite/{id}', [FavouriteController::class, 'toggleFavorite']);

    // cart
    Route::post('/add-to-cart'              ,[CartController::class , 'addToCart']);
    Route::get('/cart-summary'              ,[CartController::class , 'cartSummary']);
    Route::post('/update-cart'              ,[CartController::class , 'updateCart']);
    Route::post('delete-cart'               ,[CartController::class , 'deleteCart']);
    // cart

    //order
    Route::post('store-order'               ,[OrderController::class, 'store']);

});