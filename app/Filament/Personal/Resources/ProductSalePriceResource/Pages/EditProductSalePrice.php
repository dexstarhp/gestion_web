<?php

namespace App\Filament\Personal\Resources\ProductSalePriceResource\Pages;

use App\Filament\Personal\Resources\ProductSalePriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductSalePrice extends EditRecord
{
    protected static string $resource = ProductSalePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
