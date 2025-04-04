<?php

namespace App\Filament\Personal\Resources\PurchaseResource\Pages;

use App\Filament\Personal\Resources\PurchaseResource;
use App\Models\StockMovement;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;

    protected function afterCreate(): void
    {
        $purchase = $this->record;

        foreach ($purchase->purchaseDetails as $detail) {
            $product = $detail->product;

            // Obtener el stock actual del producto
            $currentStock = $product->stock;

            // Calcular el nuevo stock
            $newStock = $currentStock + $detail->quantity;

            // Registrar el movimiento de stock
            StockMovement::create([
                'product_id' => $detail->product_id,
                'movement_type' => 'purchase',
                'quantity' => $detail->quantity,
                'new_stock' => $newStock,
                'date' => now(),
                'note' => "Purchase ID: {$purchase->id}, Supplier: {$purchase->supplier->name}"
            ]);

            // Actualizar el stock del producto en la tabla 'products'
            $product->update(['stock' => $newStock]);
        }
    }
}
