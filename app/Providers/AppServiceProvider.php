<?php

namespace App\Providers;

use App\Services\V1\AuthServices\AuthService;
use App\Services\V1\Contracts\AuthServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //$this->app->bind(AuthServiceInterface::class, AuthService::class);
    }
}
