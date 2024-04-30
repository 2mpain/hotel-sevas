<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Customer;
use App\Models\Feedback;
use App\Models\User;
use App\Services\Customers\CustomersGettingService;
use App\Services\Feedbacks\FeedbackSettingsGettingService;
use App\Services\Users\UserSettingsGettingService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class StatsAdminOverview extends BaseWidget
{

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $usersCount = app(UserSettingsGettingService::class)->getUsersCount();
        $customersCount = app(CustomersGettingService::class)->getCustomersCount();
        $feedbacksCount = app(FeedbackSettingsGettingService::class)->getCount();

        return [
            Stat::make('Пользователи', $usersCount)
                ->description('За последний месяц')
                ->descriptionIcon('heroicon-o-users')
                ->color('success')
                ->chart($this->generateChartData($usersCount, User::class))
                ->extraAttributes(['class' => 'cursor-pointer']),
            Stat::make('Клиенты', $customersCount)
                ->description('За последние две недели')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('primary')
                ->chart($this->generateChartData(
                    $customersCount,
                    Customer::class,
                    now()->subWeeks(2)
                ))
                ->extraAttributes(['class' => 'cursor-pointer']),
            Stat::make('Отзывы', $feedbacksCount)
                ->description('За последнюю неделю')
                ->descriptionIcon('heroicon-o-chat-bubble-oval-left-ellipsis')
                ->color('info')
                ->chart($this->generateChartData(
                    $feedbacksCount,
                    Feedback::class,
                    now()->subWeek()
                ))
                ->extraAttributes(['class' => 'cursor-pointer']),
        ];
    }

    /**
     * @param mixed $count
     * @param mixed $model
     * @param mixed $startDate=null
     *
     * @return array
     */
    private function generateChartData($count, $model, $startDate = null): array
    {
        if (!$startDate) {
            $startDate = now()->subMonth();
        }

        $data = Trend::model($model)
            ->between(
                start: $startDate,
                end: now(),
            )
            ->perDay()
            ->count();

        return $data->map(fn (TrendValue $value) => $value->aggregate)->toArray();
    }
}
