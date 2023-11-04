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
    public const HOME = '/dashboard';
    protected $namespace = 'App\Http\Controllers';

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

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/sitemap.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/front/front.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin/permission.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin/user.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin/role.php'));
                
            Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/subscription.php'));

            Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/category.php'));

            Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/post.php'));

            Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/report.php'));

            Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/meta.php'));

            Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/theme.php'));

            Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/notification.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}
