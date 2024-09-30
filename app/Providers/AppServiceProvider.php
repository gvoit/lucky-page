<?php

namespace App\Providers;

use App\Services\Lucky\Contracts\LuckyPageTokenServiceInterface;
use App\Services\Lucky\Contracts\LuckyServiceInterface;
use App\Services\Lucky\LuckyPageTokenService;
use App\Services\Lucky\LuckyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LuckyServiceInterface::class, LuckyService::class);
        $this->app->bind(LuckyPageTokenServiceInterface::class, LuckyPageTokenService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
