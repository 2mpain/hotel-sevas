<?php

namespace App\Providers;

use App\Infrastructure\Repository\Customers\CustomersRepository;
use App\Infrastructure\Repository\Customers\CustomersRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomersRepositoryInterface::class, CustomersRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ru','en']);
        });
    }
}
