<?php

namespace App\Filament\Resources\ProductSalePriceResource\Pages;

use App\Filament\Personal\Resources\ProductSalePriceResource;
use Filament\Resources\Pages\ListRecords;

class ListProductSalePrices extends ListRecords
{
    protected static string $resource = ProductSalePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
