<?php

namespace App\Filament\Admin\Widgets;

use App\Enums\Customers\CustomersStatusEnum;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AdminUsersChart extends ChartWidget
{
    protected static ?string $heading = 'Новые пользователи за последние 2 недели';
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Trend::model(User::class)
            ->between(
                start: now()->startOfWeek()->subWeek(2),
                end: now(),
            )
            ->perDay()
            ->count();
        

        return [
            'datasets' => [
                [
                    'label' => 'Пользователи',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'backgroundColor' => 'rgb(96, 165, 250)'
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => date('d M, Y', strtotime($value->date))),
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
