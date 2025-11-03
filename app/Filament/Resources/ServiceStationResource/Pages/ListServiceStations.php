<?php

namespace App\Filament\Resources\ServiceStationResource\Pages;

use App\Filament\Resources\ServiceStationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceStations extends ListRecords
{
    protected static string $resource = ServiceStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
