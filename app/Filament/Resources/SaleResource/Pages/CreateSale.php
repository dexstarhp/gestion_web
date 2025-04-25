<?php

namespace App\Filament\Resources\SaleResource\Pages;

use App\Enums\MovementType;
use App\Filament\Personal\Resources\SaleResource;
use App\Models\StockMovement;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

    /**
     * @throws \Exception
     */
    protected function afterCreate(): void
    {
        $sale = $this->record;

        foreach ($sale->saleDetails as $detail) {
            $product = $detail->product;
            if (!$product->isServise) {
                $currentStock = $product->currentStock;
                $newStock = $currentStock - $detail->quantity;
                if ($newStock < 0) {
                    throw new \Exception("No hay suficiente stock para vender el producto: {$product->name}. Stock disponible: {$currentStock}, solicitado: {$detail->quantity}");
                }
                // Registrar de la salida
                StockMovement::create([
                    'product_id' => $detail->product_id,
                    'movement_type' => MovementType::SALE,
                    'quantity' => $detail->quantity, // negativo por salida
                    'unit_cost' => $product->average_cost,
                    'new_stock' => $newStock,
                    'date' => now(),
                    'note' => "Sale ID: {$sale->id}, Customer: {$sale->customer->name}",
                ]);
            }
        }
    }
}
