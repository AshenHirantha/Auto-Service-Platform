<?php

namespace App\Filament\Resources\ServiceStationResource\Pages;

use App\Filament\Resources\ServiceStationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceStation extends EditRecord
{
    protected static string $resource = ServiceStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
