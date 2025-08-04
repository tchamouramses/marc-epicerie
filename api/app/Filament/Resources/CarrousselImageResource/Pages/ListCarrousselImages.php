<?php

namespace App\Filament\Resources\CarrousselImageResource\Pages;

use App\Filament\Resources\CarrousselImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarrousselImages extends ListRecords
{
    protected static string $resource = CarrousselImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
