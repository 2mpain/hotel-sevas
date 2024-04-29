<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Customer;
use App\Models\Feedback;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Пользователи', User::query()->count())
                ->description('Все пользователи сайта')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([8, 2, 10, 3, 15, 4, 17]),
            Stat::make('Клиенты', Customer::query()->count())
                ->description('Клиенты отеля')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('primary')
                ->chart([8, 2, 10, 3, 15, 4, 17]),
            Stat::make('Отзывы', Feedback::query()->count())
                ->description('Отзывы сайта')
                ->descriptionIcon('heroicon-o-chat-bubble-oval-left-ellipsis')
                ->color('info')
                ->chart([8, 2, 10, 3, 15, 4, 17]),
        ];
    }
}
