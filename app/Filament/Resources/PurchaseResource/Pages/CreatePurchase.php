<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use App\Enums\MovementType;
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
            if (!$product->isService) {
                $currentStock = $product->stock;
                $newStock = $currentStock + $detail->quantity;

                StockMovement::create([
                    'product_id' => $detail->product_id,
                    'movement_type' => MovementType::PURCHASE,
                    'unit_cost' => $detail->unit_price,
                    'quantity' => $detail->quantity,
                    'new_stock' => $newStock,
                    'date' => now(),
                    'note' => "Compra: {$purchase->desciption}, Proveedor: {$purchase->supplier->name}"
                ]);
            }
        }
    }
}
