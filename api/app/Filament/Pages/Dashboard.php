<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LastestCustomer;
use App\Filament\Widgets\LatestOrders;
use App\Filament\Widgets\OrderChart;
use App\Filament\Widgets\OrderPostOverView;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return [
            OrderPostOverView::class,
            LatestOrders::class,
            LastestCustomer::class,
            // OrderChart::class,
        ];
    }
}
