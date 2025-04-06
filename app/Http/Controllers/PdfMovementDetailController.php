<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Utils\AverageCostUtility;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfMovementDetailController extends Controller
{
    public function exportPdfMovementDetail(Product $product)
    {
        $stockMovements = StockMovement::where('product_id', $product->id)
            ->orderBy('date')
            ->get();

        $averageData = $stockMovements->map(function ($record) {
            $avg = AverageCostUtility::calculateAverageCost($record->product_id, $record->date);
            return [
                'record' => $record,
                'average_quantity' => $avg->total_quantity ?? 0,
                'average_unit_cost' => ($avg->total_quantity ?? 0) > 0 ? ($avg->total_cost / $avg->total_quantity) : 0,
                'average_total_cost' => $avg->total_cost ?? 0,
            ];
        });

        $pdf = Pdf::loadView('inventory.pdf..movement.detail.stock-movements-pdf', [
            'product' => $product,
            'stockMovements' => $averageData,
        ])->setPaper('letter', 'landscape');;

        return $pdf->stream('movimientos_producto_' . $product->id . '.pdf');
    }
}
