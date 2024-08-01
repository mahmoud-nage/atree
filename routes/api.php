<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum', 'verify_phone'])->group(function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'me']);
        Route::post('/update', [ProfileController::class, 'updateProfile']);
        Route::post('/change-password', [ProfileController::class, 'changePassword']);
        Route::post('/change-phone', [ProfileController::class, 'changePhone']);
        Route::post('/delete-account', [ProfileController::class, 'deleteAccount']);
    });
    Route::post('auth/logout', [LoginController::class, 'logout']);
    Route::get('/my-designs', [ProfileController::class, 'my_designs']);

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [ProfileController::class, 'orders']);
        Route::get('/track_order/{id}', [ProfileController::class, 'track_order']);
    });
    Route::group(['prefix' => 'wishlists'], function () {
        Route::get('/', [ProfileController::class, 'wishlist']);
        Route::post('/toggle/{id}', [ProfileController::class, 'storeAndDeleteWishlist']);
    });
    Route::group(['prefix' => 'followers'], function () {
        Route::get('/', [ProfileController::class, 'followers']);
        Route::post('/toggle/{id}', [ProfileController::class, 'storeAndDeleteFollowers']);
    });

//    Route::get('/diamond', [ProfileController::class, 'diamond']);
    Route::get('/settings', [MainController::class, 'settings']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/resend-code', [PhoneVerificationController::class, 'sendCode']);
    Route::post('/check-code', [PhoneVerificationController::class, 'checkCode']);
    Route::post('/reset-password', [ProfileController::class, 'resetPassword']);
});

Route::get('/home', [MainController::class, 'index']);
Route::get('search', [MainController::class, 'search'])->name('search');
Route::get('pages', [MainController::class, 'pages'])->name('pages.show');
Route::get('/products', [MainController::class, 'products'])->name('products');
Route::get('products/{product}', [MainController::class, 'product'])->name('products.show');
Route::get('/designs', [MainController::class, 'designs'])->name('designs');
Route::get('/explore', [MainController::class, 'explore'])->name('explore');
Route::post('contact-us', [ContactUsController::class, 'store'])->name('contacts');


Route::get('users/{user:username}', [MainController::class, 'user'])->name('users.show');
Route::get('/custom-designs', [MainController::class, 'custom_designs'])->name('custom-designs');
Route::get('/cart', [MainController::class, 'cart'])->name('cart');
