<?php

use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Dashboard\DesignController;
use App\Http\Controllers\Dashboard\ShippingCompaniesController;
use App\Http\Controllers\Dashboard\WithdrawalsController;
use App\Http\Controllers\Site\AccountController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\Payment\SurePayController;
use App\Http\Controllers\Site\PhoneVerificationController;
use App\Http\Controllers\Site\WithdrawalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SlideController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\GovernorateController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductVariationController;
use App\Http\Controllers\Dashboard\CountryContoller;
use App\Http\Controllers\Dashboard\AjaxController;
use App\Http\Controllers\Dashboard\SizeController;
use App\Http\Controllers\Dashboard\ColorController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UserDesginController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\Site\RegisterController;
use App\Http\Controllers\Site\VerifyEmailController;
use App\Http\Controllers\Site\ProfileController as UserProfileController;


use App\Http\Controllers\Testcontroller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/test', [TestController::class, 'index']);
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['throttle:global','localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web']
], function () {
    Route::get('/Dashboard/login', [AuthController::class, 'form'])->name('dashboard.login_form');
    Route::post('/Dashboard/login', [AuthController::class, 'login'])->name('dashboard.login');
    Route::group(['prefix' => 'Dashboard', 'as' => 'dashboard.', 'middleware' => ['admin']], function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('sizes', SizeController::class);
        Route::resource('designs', DesignController::class);
        Route::resource('colors', ColorController::class);
        Route::resource('shipping_companies', ShippingCompaniesController::class);
        Route::resource('admins', AdminController::class);
        Route::resource('categories', CategoryController::class); // not fount in view
        Route::resource('slides', SlideController::class);
        Route::resource('pages', PageController::class);
        Route::resource('products', ProductController::class);
        Route::post('products/store_design_sizes', [ProductController::class, 'store_design_sizes'])->name('products.store_design_sizes');

        Route::resource('countries', CountryContoller::class);
        Route::resource('governorates', GovernorateController::class);
        Route::resource('cities', CityController::class);

        Route::resource('coupons', CouponController::class);
        Route::resource('orders', OrderController::class);

        Route::resource('users', UserController::class);

        Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::patch('settings', [SettingsController::class, 'update'])->name('settings.update');

        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');

        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('password', [ProfileController::class, 'password'])->name('password');
        Route::patch('password', [ProfileController::class, 'update_password'])->name('password.update');

        Route::get('users/{user}/desgins', [UserDesginController::class, 'user_desgins'])->name('users.desgins');
        Route::get('users/{user}/orders', [UserController::class, 'orders'])->name('users.orders');
        Route::get('users/{user}/login', [UserController::class, 'login'])->name('users.login');
        Route::get('products/{product}/variations/create', [ProductVariationController::class, 'create'])->name('products.variations.create');
        Route::post('products/{product}/variations', [ProductVariationController::class, 'store'])->name('products.variations.store');
        Route::post('/get_new_varition_main_row', [AjaxController::class, 'get_new_varition_main_row'])->name('get_new_varition_main_row');
        Route::post('/get_new_varition_color_row', [AjaxController::class, 'get_new_varition_color_row'])->name('get_new_varition_color_row');

        Route::group(['prefix' => 'withdrawals'], function () {
            Route::get('/', [WithdrawalsController::class, 'index'])->name('withdrawals.index');
            Route::get('/create', [WithdrawalsController::class, 'create'])->name('withdrawals.create');
            Route::post('/', [WithdrawalsController::class, 'store'])->name('withdrawals.store');
            Route::get('/deny/{withdrawal}', [WithdrawalsController::class, 'deny'])->name('withdrawals.deny');
            Route::get('/approve/{withdrawal}', [WithdrawalsController::class, 'approve'])->name('withdrawals.approve');
            Route::get('/{withdrawal}', [WithdrawalsController::class, 'show'])->name('withdrawals.show');
        });
    });

    Route::get('/', [SiteController::class, 'index'])->name('home');
    Route::group(['prefix' => 'forgot-password'], function () {
        Route::get('/', [PasswordResetLinkController::class, 'create'])
            ->middleware('guest')
            ->name('password.request');
        Route::post('send-code/', [PasswordResetLinkController::class, 'send'])
            ->middleware('guest')
            ->name('password.send');
        Route::post('check-code/', [PasswordResetLinkController::class, 'check'])
            ->middleware('guest')
            ->name('password.check');
        Route::post('/', [PasswordResetLinkController::class, 'store'])
            ->middleware('guest')
            ->name('password.newPassword');
    });
    Route::group(['prefix' => 'login'], function () {
        Route::get('/', [LoginController::class, 'form'])->name('login.form');
        Route::post('/', [LoginController::class, 'login'])->name('login.post');
    });
    Route::group(['prefix' => 'register'], function () {
        Route::get('/', [RegisterController::class, 'form'])->name('register.form');
        Route::post('/', [RegisterController::class, 'register'])->name('register.post');
    });
    Route::group(['prefix' => 'verify_phone'], function () {
        Route::get('/', [PhoneVerificationController::class, 'index'])->name('verify_phone.index');
        Route::post('/', [PhoneVerificationController::class, 'store'])->name('verify_phone.store');
    });

//    Route::get('/verify', [VerifyEmailController::class, 'form'])->name('verify.form');
//    Route::post('/verify', [VerifyEmailController::class, 'verify'])->name('verify.post');

    Route::get('pages/{page}', [SiteController::class, 'page'])->name('pages.show');
    Route::get('users/{username}', [SiteController::class, 'user'])->name('users.show');
    Route::get('contact', [SiteController::class, 'contact'])->name('contact');
    Route::get('search', [SiteController::class, 'search'])->name('search');
    Route::get('products/{product}', [SiteController::class, 'product'])->name('products.show');
    Route::get('/explore', [SiteController::class, 'explore'])->name('explore');
    Route::get('/products', [SiteController::class, 'products'])->name('products');
    Route::get('/designs', [SiteController::class, 'designs'])->name('designs');
    Route::post('/designs/{id}', [SiteController::class, 'updateDesign'])->name('designs.update');
    Route::get('/cart', [SiteController::class, 'cart'])->name('cart');
    Route::get('/current-designs/{product_id}', [SiteController::class, 'current_custom_designs'])->name('current-custom-designs');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
        Route::get('/wishlist', [UserProfileController::class, 'wishlist'])->name('wishlist');
        Route::get('/orders', [UserProfileController::class, 'orders'])->name('orders');
        Route::get('/track-order/{order_id}', [UserProfileController::class, 'track_order'])->name('track_order');
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/settings', [UserProfileController::class, 'settings'])->name('settings');
        Route::get('/followers', [UserProfileController::class, 'followers'])->name('followers');
        Route::get('/my-designs', [UserProfileController::class, 'my_designs'])->name('my_designs');
        Route::get('/diamond', [UserProfileController::class, 'diamond'])->name('diamond');
        Route::get('/statistics', [AccountController::class, 'statistics'])->name('statistics');
        Route::get('/incomes', [AccountController::class, 'incomes'])->name('incomes');
        Route::get('/custom-designs/{product_id}', [SiteController::class, 'custom_designs'])->name('custom-designs');
        Route::group(['prefix' => 'cart'], function () {
            Route::get('/', [CartController::class, 'index'])->name('cart.index');
            Route::get('/create', [CartController::class, 'create'])->name('cart.create');
            Route::post('/', [CartController::class, 'store'])->name('cart.store');
        });
        Route::group(['prefix' => 'withdrawals'], function () {
            Route::get('/', [WithdrawalController::class, 'index'])->name('withdrawals.index');
            Route::get('/create', [WithdrawalController::class, 'create'])->name('withdrawals.create');
            Route::post('/', [WithdrawalController::class, 'store'])->name('withdrawals.store');
            Route::get('/{withdrawal}', [WithdrawalController::class, 'show'])->name('withdrawals.show');
        });
        Route::group(['middleware' => ['verify_phone']], function () {
            Route::group(['prefix' => 'checkout'], function () {
                Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
                Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
                Route::get('/pay/{order_id}', [CheckoutController::class, 'pay'])->name('checkout.pay');
            });
        });
    });
});
Route::group(['prefix' => 'payment'], function () {
    Route::get('/callback', [SurePayController::class, 'callBack'])->name('payment.callBack');
});
