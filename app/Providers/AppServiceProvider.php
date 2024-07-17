<?php

namespace App\Providers;

use App\Interfaces\Services\ChargeServiceInterface;
use App\Interfaces\Services\TicketServiceInterface;
use App\Services\ChargeService;
use App\Services\TicketService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ChargeServiceInterface::class, ChargeService::class);
        $this->app->bind(TicketServiceInterface::class, TicketService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
