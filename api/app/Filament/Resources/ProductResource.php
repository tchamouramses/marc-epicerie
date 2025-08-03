<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('price')->required()->integer(),
                TextInput::make('quantity')->required()->integer(),
                Select::make('rate')->required()->options([
                    '1',
                    '2',
                    '3',
                    '4',
                    '5'
                ]),
                TextInput::make('discount')->nullable()->numeric(),
                TextInput::make('min_quantity')->label('Alert quantity')->required()->integer(),
                Textarea::make('description')->nullable(),
                Select::make('sub_category_id')->label('Sub Category')
                    ->required()
                    ->options(SubCategory::all()->pluck('name', 'id'))
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('code')->searchable(),
                TextColumn::make('rate'),
                TextColumn::make('subCategory.name')->label('Sub Category'),
                TextColumn::make('price'),
                TextColumn::make('quantity'),
                TextColumn::make('min_quantity')->label('Alert quantity'),
            ])
            ->filters([
                SelectFilter::make('sub_category_id')
                    ->label('Sub category')
                    ->options(fn(): array => SubCategory::query()->pluck('name', 'id')->all())
                    ->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProducts::route('/'),
        ];
    }
}
