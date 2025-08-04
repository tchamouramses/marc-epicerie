<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Enums\OrderStatusEnum;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        OrderStatusEnum::Unpaid->value => 'Unpaid',
                        OrderStatusEnum::Paid->value => 'Paid',
                        OrderStatusEnum::Ongoing->value => 'Ongoing',
                        OrderStatusEnum::Delivered->value => 'Delivered',
                    ]),
                Forms\Components\DateTimePicker::make('planing_date')
                    ->required(),
                Forms\Components\Textarea::make('comment')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')->options([
                    OrderStatusEnum::Unpaid->value => 'Unpaid',
                    OrderStatusEnum::Paid->value => 'Paid',
                    OrderStatusEnum::Ongoing->value => 'Ongoing',
                    OrderStatusEnum::Delivered->value => 'Delivered',
                ])->selectablePlaceholder(false),
                Tables\Columns\TextColumn::make('planing_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereNot('status', OrderStatusEnum::Delivered->value)->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'undelivered order';
    }
}
