<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * مسیر پیش‌فرض برای redirect بعد از login
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // مسیرهای API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // مسیرهای Web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}