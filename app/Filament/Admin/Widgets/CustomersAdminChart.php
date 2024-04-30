<?php

namespace App\Filament\Admin\Widgets;

use App\Enums\Customers\CustomersStatusEnum;
use App\Models\Customer;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CustomersAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Клиенты';

    protected static string $color = 'info';

    public ?string $filter = 'today';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Customer::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Клиенты',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
                [
                    'label' => 'Оставили заявку',
                    'data' => $data->where(['status' => CustomersStatusEnum::STATUS_LEFT_A_REQUEST])->map(fn(TrendValue $value) => $value->aggregate),
                    ''
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
