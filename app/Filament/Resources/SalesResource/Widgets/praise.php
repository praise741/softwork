<?php

namespace App\Filament\Resources\SalesResource\Widgets;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\sales;
use App\Models\expenses;
use App\Models\supplier;
use App\Models\User;
class praise extends BaseWidget
{
    protected static string $pollingInterval = '10s';
    protected function getCards(): array
    {
        return [

            Card::make('number of sales', sales::count())
            ->description('number of sales')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success')
            ->chart([sales::count()], User::count(), expenses::count()),
            Card::make('total sales', sales::sum('amount')),
            Card::make('total profit', sales::sum('amount')- expenses::sum('amount')),
            Card::make('Total expenses', expenses::sum('amount')),
            Card::make('number of users', User::count()),
            Card::make('number of suppliers',supplier::count()),
        ];
    }
}
