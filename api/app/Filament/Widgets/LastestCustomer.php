<?php

namespace App\Filament\Widgets;

use App\Models\Enums\UserTypeEnum;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LastestCustomer extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return User::where('type', UserTypeEnum::Customer->value)->latest()->take(5);
            })
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])->paginated(false);
    }
}
