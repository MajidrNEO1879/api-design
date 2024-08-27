<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->mapRoutes(); // Call to the mapRoutes method

        // Optional: If you want to define routes directly here, you can do it
        // $this->routes(function(){
        //     Route::middleware('api')
        //         ->prefix('api/v1')
        //         ->group(base_path('routes/api_v1.php'));
        // });
    }

    /**
     * Define the routes for the application.
     */
    protected function mapRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api/v1')
            ->group(base_path('routes/api_v1.php'));
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
