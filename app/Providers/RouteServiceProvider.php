<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('global', function (Request $request) {
            $rate_limit = $request->isMethod('post') ? 5 : 10;
            if (auth()->user()) {
                $rate_limit = (isset(auth()->user()->rate_limit) ? auth()->user()->rate_limit : $rate_limit);
                return Limit::perMinute($rate_limit)->by(auth()->user()->id)->response(function () {

                    return response()->json([
                        'response' => 'Failed',
                        'message' => 'Too many request has been made',
                    ], 429);
                });
            } else {
                return Limit::perMinute($rate_limit)->by($request->ip())->response(function () {
                    return response()->json([
                        'response' => 'Failed',
                        'message' => 'Too many request has been made',
                    ], 429);
                });
            }
        });
    }
}
