<?php

namespace App\Providers;

use App\Infrastructure\Mutators\Customers\CustomerSettingsMutator;
use App\Infrastructure\Mutators\Customers\CustomerSettingsMutatorInterface;
use App\Infrastructure\Mutators\Feedbacks\FeedbackSettingsMutator;
use App\Infrastructure\Mutators\Feedbacks\FeedbackSettingsMutatorInterface;
use App\Infrastructure\Repository\Customers\CustomersRepository;
use App\Infrastructure\Repository\Customers\CustomersRepositoryInterface;
use App\Infrastructure\Repository\Feedbacks\FeedbacksRepository;
use App\Infrastructure\Repository\Feedbacks\FeedbacksRepositoryInterface;
use App\Infrastructure\Repository\Users\UsersRepository;
use App\Infrastructure\Repository\Users\UsersRepositoryInterface;
use App\Models\Customer;
use App\Models\Feedback;
use App\Observers\CustomerObserver;
use App\Observers\FeedbackObserver;
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
        $this->app->bind(CustomerSettingsMutatorInterface::class, CustomerSettingsMutator::class);
        $this->app->bind(FeedbacksRepositoryInterface::class, FeedbacksRepository::class);
        $this->app->bind(FeedbackSettingsMutatorInterface::class, FeedbackSettingsMutator::class);
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
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

        Feedback::observe(FeedbackObserver::class);
        Customer::observe(CustomerObserver::class);
    }
}
