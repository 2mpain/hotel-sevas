<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Customer;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CustomersAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Новые клиенты';

    protected static string $color = 'info';

    public ?string $filter = 'today';

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
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
        //     'datasets' => [
        //         [
        //             'label' => 'Заявки',
        //             'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
        //         ],
        //         [
        //             'label' => 'Одобренные',
        //             'data' => [4, 4, 3, 2, 12, 24, 12, 4, 3, 5, 4, 6, 2],
        //             'backgroundColor' => '#82C09A'
        //         ],
        //         [
        //             'label' => 'Отклонённые',
        //             'data' => [3, 6, 2, 1, 4, 3, 2, 5, 3, 1, 6, 5, 3],
        //             'backgroundColor' => '#E84855'
        //         ]
        //     ],
        //     'labels' => ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Нов', 'Дек'],
        // ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
