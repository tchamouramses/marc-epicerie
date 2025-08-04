<?php

namespace App\Filament\Resources\CarrousselImageResource\Pages;

use App\Filament\Resources\CarrousselImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarrousselImage extends EditRecord
{
    protected static string $resource = CarrousselImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
