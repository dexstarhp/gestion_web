<?php

namespace App\Filament\Personal\Resources\ProductSalePriceResource\Pages;

use App\Filament\Personal\Resources\ProductSalePriceResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListProductSalePrices extends ListRecords
{
    protected static string $resource = ProductSalePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Registrar Producto')
                ->icon('heroicon-o-plus')
                ->label('Registrar Producto')
                ->url(route('filament.admin.resources.products.create'))
                ->color('primary'),
        ];
    }
}
