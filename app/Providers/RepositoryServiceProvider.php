<?php

namespace App\Providers;

use App\Interfaces\Repositories\ChargeRepositoryInterface;
use App\Interfaces\Repositories\TicketRepositoryInterface;
use App\Repositories\ChargeRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ChargeRepositoryInterface::class, ChargeRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
