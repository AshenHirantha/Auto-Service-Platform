<?php

namespace App\Filament\Resources\PartsOrderResource\Pages;

use App\Filament\Resources\PartsOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPartsOrders extends ListRecords
{
    protected static string $resource = PartsOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
