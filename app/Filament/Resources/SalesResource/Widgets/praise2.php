<?php

namespace App\Filament\Resources\SalesResource\Widgets;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\Widget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\sales;
use App\Models\expenses;
use App\Models\User;
use Filament\Widgets\LineChartWidget;

class praise2 extends LineChartWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 1;
    protected function getHeading(): string
    {
        return 'Sales';
    }
    protected function getData(): array
{
    $data = Trend::model(sales::class)
        ->between(
            start: now()->startOfWeek(),
            end: now()->endOfWeek(),
        )
        ->perHour()
        ->count();


    return [
        'datasets' => [
            [
                'label' => 'Sales',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
}
}

