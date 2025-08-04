<?php

namespace App\Filament\Widgets;

use App\Models\Enums\OrderStatusEnum;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Order::latest()->take(5);
            })
            ->columns([
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer'),
                Tables\Columns\SelectColumn::make('status')->options([
                    OrderStatusEnum::Unpaid->value => 'Unpaid',
                    OrderStatusEnum::Paid->value => 'Paid',
                    OrderStatusEnum::Ongoing->value => 'Ongoing',
                    OrderStatusEnum::Delivered->value => 'Delivered',
                ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])->paginated(false);
    }
}
