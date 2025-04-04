<?php

namespace App\Filament\Personal\Resources\SaleResource\Pages;

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

        // Iteramos sobre los detalles de la venta
        foreach ($sale->saleDetails as $detail) {
            $product = $detail->product;
            if (!$product->isServise) {
                $currentStock = $product->currentStock;
                $newStock = $currentStock - $detail->quantity;
                if ($newStock < 0) {
                    throw new \Exception("No hay suficiente stock para vender el producto: {$product->name}. Stock disponible: {$currentStock}, solicitado: {$detail->quantity}");
                }
                // Calculo de cpp
                $cpp = StockMovement::where('product_id', $product->id)
                    ->where('movement_type', MovementType::PURCHASE)
                    ->selectRaw('SUM(quantity * unit_cost) as total_cost, SUM(quantity) as total_qty')
                    ->first();

                if (!$cpp || $cpp->total_qty == 0) {
                    throw new \Exception("No se puede calcular el costo promedio porque no hay movimientos de compra para el producto: {$product->name}");
                }

                $averageCost = $cpp->total_cost / $cpp->total_qty;

                // Registrar de la salida
                StockMovement::create([
                    'product_id' => $detail->product_id,
                    'movement_type' => MovementType::SALE,
                    'quantity' => -$detail->quantity, // negativo por salida
                    'unit_cost' => $averageCost,
                    'new_stock' => $newStock,
                    'date' => now(),
                    'note' => "Sale ID: {$sale->id}, Customer: {$sale->customer->name}",
                ]);
            }
        }
    }

}
