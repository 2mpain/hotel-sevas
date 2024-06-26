<?php

namespace App\Filament\Admin\Widgets;

use App\Enums\Customers\CustomersStatusEnum;
use App\Models\Customer;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CustomersAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Клиенты за последние 2 недели';

    protected static string $color = 'info';

    public ?string $filter = 'today';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Customer::class)
            ->between(
                start: now()->startOfWeek()->subWeek(2),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Клиенты',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => date('d M, Y', strtotime($value->date))),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
