<?php

namespace App\Providers;

use App\Interfaces\Repositories\ChargeInterface;
use App\Repositories\ChargeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ChargeInterface::class, ChargeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
