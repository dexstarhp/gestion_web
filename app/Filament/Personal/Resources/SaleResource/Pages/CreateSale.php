<?php

namespace App\Filament\Personal\Resources\SaleResource\Pages;

use App\Filament\Personal\Resources\SaleResource;
use App\Models\StockMovement;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

    protected function afterCreate(): void
    {
        $sale = $this->record;

        // Iteramos sobre los detalles de la venta
        foreach ($sale->saleDetails as $detail) {
            $product = $detail->product;

            // Obtener el stock actual del producto
            $currentStock = $product->currentStock;  // Usando el atributo dinámico para obtener el stock actual

            // Calcular el nuevo stock
            $newStock = $currentStock - $detail->quantity;

            // Registrar el movimiento de stock
            StockMovement::create([
                'product_id' => $detail->product_id,
                'movement_type' => 'sale',  // Tipo de movimiento de venta
                'quantity' => $detail->quantity,
                'new_stock' => $newStock,
                'date' => now(),
                'note' => "Sale ID: {$sale->id}, Customer: {$sale->customer->name}"
            ]);

        }
    }

}
