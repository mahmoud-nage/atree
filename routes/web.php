<?php
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
use App\Http\Controllers\Site\ProfileController as UserProfileController ;


use App\Http\Controllers\Testcontroller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/test' , [TestController::class , 'index'] );
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'web' ]
], function(){


    Route::get('/Dashboard/login' , [AuthController::class , 'form'])->name('dashboard.login_form');
    Route::post('/Dashboard/login' , [AuthController::class , 'login'])->name('dashboard.login');

    Route::group(['prefix' => 'Dashboard' , 'as' => 'dashboard.' , 'middleware' => ['admin'] ], function() {
        Route::get('/',  [DashboardController::class , 'index'] )->name('index');
        Route::resource('sizes', SizeController::class);
        Route::resource('colors', ColorController::class);
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

        Route::get('settings' , [SettingsController::class , 'edit'])->name('settings.edit');
        Route::patch('settings' , [SettingsController::class , 'update'])->name('settings.update');

        Route::get('messages' , [MessageController::class , 'index'])->name('messages.index');
        Route::get('messages/{message}' , [MessageController::class , 'show'])->name('messages.show');

        Route::get('profile' , [ProfileController::class , 'profile'] )->name('profile');
        Route::patch('profile' , [ProfileController::class , 'update'] )->name('profile.update');

        Route::get('password' , [ProfileController::class , 'password'] )->name('password');
        Route::patch('password' , [ProfileController::class ,'update_password'] )->name('password.update');

        Route::get('users/{user}/desgins' , [UserDesginController::class , 'user_desgins'] )->name('users.desgins');
        Route::get('users/{user}/orders' , [UserController::class , 'orders'] )->name('users.orders');
        Route::get('users/{user}/login' , [UserController::class , 'login'] )->name('users.login');
        Route::get('products/{product}/variations/create'  , [ProductVariationController::class , 'create'] )->name('products.variations.create');
        Route::post('products/{product}/variations'  , [ProductVariationController::class , 'store'] )->name('products.variations.store');
        Route::post('/get_new_varition_main_row' , [AjaxController::class , 'get_new_varition_main_row'] )->name('get_new_varition_main_row');
        Route::post('/get_new_varition_color_row' , [AjaxController::class , 'get_new_varition_color_row'] )->name('get_new_varition_color_row');
    });

    Route::get('/' , [SiteController::class, 'index'] )->name('home');
    Route::get('/login' , [LoginController::class, 'form'] )->name('login.form');
    Route::post('/login' , [LoginController::class, 'login'] )->name('login.post');
    Route::get('/register' , [RegisterController::class, 'form'] )->name('register.form');
    Route::post('/register' , [RegisterController::class, 'register'] )->name('register.post');
    Route::get('/verify' , [VerifyEmailController::class, 'form'] )->name('verify.form');
    Route::post('/verify' , [VerifyEmailController::class, 'verify'] )->name('verify.post');
    Route::get('pages/{page}' , [SiteController::class , 'page'] )->name('pages.show');
    Route::get('users/{user_id}' , [SiteController::class , 'user'] )->name('users.show');
    Route::get('contact' , [SiteController::class , 'contact'])->name('contact');
    Route::get('search' , [SiteController::class , 'search'])->name('search');
    Route::get('products/{product}' , [SiteController::class , 'product'])->name('products.show');
    Route::get('/custom-designs' , [SiteController::class , 'custom_designs'])->name('custom-designs');
    Route::get('/explore' , [SiteController::class , 'explore'])->name('explore');
    Route::get('/products' , [SiteController::class , 'products'])->name('products');
    Route::get('/designs' , [SiteController::class , 'designs'])->name('designs');
    Route::get('/cart' , [SiteController::class , 'cart'])->name('cart');


    Route::group(['middleware' => 'auth'], function() {
        Route::get('/checkout' , [SiteController::class , 'checkout'])->name('checkout');
        Route::get('/profile' , [UserProfileController::class , 'index'] )->name('profile.index');
        Route::get('/wishlist' , [UserProfileController::class , 'wishlist'] )->name('wishlist');
        Route::get('/orders' , [UserProfileController::class , 'orders'] )->name('orders');
        Route::get('/track-order/{order_id}' , [UserProfileController::class , 'track_order'] )->name('track_order');
        Route::get('/logout' , [LoginController::class , 'logout'] )->name('logout');
        Route::get('/settings' , [UserProfileController::class , 'settings'] )->name('settings');
        Route::get('/followers' , [UserProfileController::class , 'followers'] )->name('followers');
        Route::get('/my-designs' , [UserProfileController::class , 'my_designs'] )->name('my_designs');
        Route::get('/diamond' , [UserProfileController::class , 'diamond'] )->name('diamond');
    });

});
