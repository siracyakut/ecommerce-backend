<?php

namespace App\Providers;

use App\Interfaces\Services\ChargeServiceInterface;
use App\Services\ChargeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ChargeServiceInterface::class, ChargeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
