<?php

namespace App\Providers;

use App\Repositories\_Auth\AuthRepository;
use App\Repositories\_Auth\AuthRepositoryInterface;
use App\Repositories\_Response\ApiResponseInterface;
use App\Repositories\_Response\ApiResponseRepository;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            ApiResponseInterface::class,
            ApiResponseRepository::class,
        );

        $this->app->singleton(
            AuthRepositoryInterface::class,
            AuthRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
