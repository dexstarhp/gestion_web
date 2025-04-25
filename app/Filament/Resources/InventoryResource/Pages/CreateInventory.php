<?php

namespace App\Filament\Resources\InventoryResource\Pages;

use App\Filament\Personal\Resources\InventoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInventory extends CreateRecord
{
    protected static string $resource = InventoryResource::class;
}
