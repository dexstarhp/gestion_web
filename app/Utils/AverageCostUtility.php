<?php

namespace App\Utils;


use Illuminate\Support\Facades\DB;

class AverageCostUtility
{
    public static function calculateAverageCost($productId, $dateTo)
    {
        return DB::table('stock_movements')
            ->where('product_id', $productId)
            ->where('date', '<=', $dateTo)
            ->selectRaw('
                sum(CASE WHEN movement_type = "PURCHASE" THEN quantity
                     WHEN movement_type = "SALE" THEN -quantity
                    ELSE 0 END) as total_quantity,

                sum(CASE WHEN movement_type = "PURCHASE" THEN quantity * unit_cost
                         WHEN movement_type = "SALE" THEN -quantity * unit_cost
                         ELSE 0 END) as total_cost
                ')
            ->first();
    }

    public static function getTotalCost($productId, $dateTo)
    {
        $result = self::calculateAverageCost($productId, $dateTo);
        return $result ? $result->total_cost : 0;
    }

    public static function getTotalQuantity($productId, $dateTo)
    {
        $result = self::calculateAverageCost($productId, $dateTo);
        return $result ? $result->total_quantity : 0;
    }

    public static function getTotalUnitCost($productId, $dateTo)
    {
        $result = self::calculateAverageCost($productId, $dateTo);
        if ($result && $result->total_quantity > 0) {
            return $result->total_cost / $result->total_quantity;
        }

        return 0;
    }


}
