<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\CartController;
use App\Http\Controllers\Api\User\HomeController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\FavouriteController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\ResetPasswordController;
use App\Http\Controllers\Api\User\AddressController;
use App\Http\Controllers\Api\User\PointsController;
use App\Services\PaymentGateway\PaymentService;


Route::post('/register-admin', 'App\Http\Controllers\Admin\AuthController@register');

//////////////////////////////////////// User Routes ////////////////////////////////////////
//public routes
Route::post('/register',     [AuthController::class, 'register']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/resend-code',  [AuthController::class, 'resendCode']);
Route::post('/login',        [AuthController::class, 'login']);

Route::get('payment/get-payment-status'     ,[PaymentService::class, 'callback'])->name('payment.getPaymentStatus');

// reset password //
Route::post('/reset-password-send-code'     ,[ResetPasswordController::class, 'sendCode']);
Route::post('/reset-password-check-code'    ,[ResetPasswordController::class, 'checkCode']);
Route::post('/reset-password'               ,[ResetPasswordController::class, 'resetPassword']);


//protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('set-location', [AuthController::class, 'setLocation']);
    Route::post('/logout',      [AuthController::class, 'logout']);

    // profile routes //
    Route::get('/get-profile',      [ProfileController::class, 'getProfile']);
    Route::post('/update-profile',  [ProfileController::class, 'updateProfile']);
    Route::post('/delete-account',  [ProfileController::class, 'deleteAccount']);
    Route::post('/change-password', [ProfileController::class, 'changePassword']);
    Route::get('/faqs',             [ProfileController::class, 'faqs']);
    
    // home routes //
    Route::get('/categories'     ,    [HomeController::class, 'categories']);
    Route::get('/categories/{categoryId}/subcategory/{subcategoryId?}', [HomeController::class, 'products']);
    Route::get('/offers',             [HomeController::class, 'offers']);
    Route::get('/most-sold-products', [HomeController::class, 'mostSoldProducts']);
    Route::get('/banners',            [HomeController::class, 'banners']);
    Route::get('/product/{id}',       [HomeController::class, 'showProduct']);
    Route::get('/prize-products',     [HomeController::class, 'prizeProducts']);
    
    // Points routes
    Route::get('/settings',           [PointsController::class, 'settingPoints']);
    Route::get('/points',             [PointsController::class, 'userPoints']);
    Route::post('/rate-app',          [PointsController::class, 'rateApp']);
    Route::post('/undo',              [PointsController::class, 'undoRating']);


    // favourite routes //
    Route::get('/favourites',             [FavouriteController::class, 'index']);
    Route::post('/toggle-favourite/{id}', [FavouriteController::class, 'toggleFavorite']);

    // cart routes //
    Route::post('/add-to-cart'              ,[CartController::class , 'addToCart']);
    Route::get('/cart-summary'              ,[CartController::class , 'cartSummary']);
    Route::post('/update-cart'              ,[CartController::class , 'updateCart']);
    Route::post('delete-cart'               ,[CartController::class , 'deleteCart']);

    // order routes //
    Route::post('store-order'               ,[OrderController::class, 'store']);
    Route::get('orders'                     ,[OrderController::class, 'orders']);
    Route::get('orders/{order}'             ,[OrderController::class, 'showOrder']);

    // Address Routes //
    Route::get('/addresses'                  ,[AddressController::class, 'index']);
    Route::post('/store-address'             ,[AddressController::class, 'store']);
    Route::delete('/delete-address/{id}'     ,[AddressController::class, 'destroy']);

});