<?php

namespace App\Filament\Widgets;

use App\Models\Enums\OrderStatusEnum;
use App\Models\Order;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderPostOverView extends BaseWidget
{
    public function getStats(): array
    {
        return [
            Stat::make(
                label: 'Total orders',
                value: Order::query()->count(),
            )
                ->description('Total orders registered')
                ->descriptionIcon('heroicon-m-wallet', IconPosition::Before),
            Stat::make(
                label: 'Total Delivered',
                value: Order::where('status', OrderStatusEnum::Delivered->value)->count(),
            )
                ->description('Total delivered orders registered')
                ->descriptionIcon('heroicon-m-currency-euro', IconPosition::Before),
            Stat::make(
                label: 'Total Unpaid',
                value: Order::where('status', OrderStatusEnum::Unpaid->value)->count(),
            )
                ->description('Total unpaid orders registered')
                ->descriptionIcon('heroicon-m-hand-thumb-down', IconPosition::Before),
        ];
    }
}
