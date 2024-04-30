<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Feedback;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class FeedbacksAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Отзывы';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Trend::model(Feedback::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Все',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => date('d M, Y', strtotime($value->date))),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
