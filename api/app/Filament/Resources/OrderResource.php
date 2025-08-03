<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Enums\OrderStatusEnum;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $breadcrumb = 'Orders';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Customer')->searchable(),
                TextColumn::make('product.name')->label('Product')->searchable(),
                SelectColumn::make('status')->options([
                    OrderStatusEnum::Unpaid->value => 'Unpaid',
                    OrderStatusEnum::Paid->value => 'Paid',
                    OrderStatusEnum::Ongoing->value => 'Ongoing',
                    OrderStatusEnum::Delivered->value => 'Delivered',
                ])->selectablePlaceholder(false),
                TextColumn::make('planing_date')->dateTime(),
                TextColumn::make('created_at')->since(),
                TextColumn::make('comment')
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    OrderStatusEnum::Unpaid->value => 'Unpaid',
                    OrderStatusEnum::Paid->value => 'Paid',
                    OrderStatusEnum::Ongoing->value => 'Ongoing',
                    OrderStatusEnum::Delivered->value => 'Delivered',
                ])
            ])
            ->actions([
                //
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageOrders::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', OrderStatusEnum::Delivered->value)->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'undelivered order';
    }
}
