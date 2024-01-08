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

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [AccountController::class, 'me']);
        Route::put('/update', [AccountController::class, 'updateProfile']);
    });
    Route::get('/logout', [AccountController::class, 'logout']);

    Route::get('/wishlist', [MainController::class, 'wishlist']);
    Route::get('/orders', [MainController::class, 'orders']);
    Route::get('/settings', [MainController::class, 'settings']);
    Route::get('/followers', [MainController::class, 'followers']);
    Route::get('/diamond', [MainController::class, 'diamond']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AccountController::class, 'login']);
    Route::post('/register', [AccountController::class, 'register']);
    Route::post('/sendCode', [AccountController::class, 'sendCode']);
    Route::post('/checkCode', [AccountController::class, 'checkCode']);
});

Route::get('/home', [MainController::class, 'index']);
Route::get('pages/{page}', [MainController::class, 'page'])->name('pages.show');
Route::get('users/{user:username}', [MainController::class, 'user'])->name('users.show');
Route::get('contact', [MainController::class, 'contact'])->name('contact');
Route::get('search', [MainController::class, 'search'])->name('search');
Route::get('products/{product}', [MainController::class, 'product'])->name('products.show');
Route::get('/custom-designs', [MainController::class, 'custom_designs'])->name('custom-designs');
Route::get('/explore', [MainController::class, 'explore'])->name('explore');
Route::get('/products', [MainController::class, 'products'])->name('products');
Route::get('/designs', [MainController::class, 'designs'])->name('designs');
Route::get('/cart', [MainController::class, 'cart'])->name('cart');
