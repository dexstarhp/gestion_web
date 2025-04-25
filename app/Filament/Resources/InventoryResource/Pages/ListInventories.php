<?php

namespace App\Filament\Resources\InventoryResource\Pages;

use App\Filament\Personal\Resources\InventoryResource;
use Filament\Resources\Pages\ListRecords;

class ListInventories extends ListRecords
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
