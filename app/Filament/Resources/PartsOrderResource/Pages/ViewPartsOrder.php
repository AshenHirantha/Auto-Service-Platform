<?php

namespace App\Filament\Resources\PartsOrderResource\Pages;

use App\Filament\Resources\PartsOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPartsOrder extends ViewRecord
{
    protected static string $resource = PartsOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}