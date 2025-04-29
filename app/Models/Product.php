<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_service',
        'image_url',
        'min_stock',
        'current_sale_price',
        'is_sellable',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function priceHistory(): HasMany
    {
        return $this->hasMany(PriceHistory::class);
    }

    public function purchaseDetails(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }

    // Dynamic stock calculation

    /**
     * @return int|mixed
     */
    public function getCurrentStockAttribute(): mixed
    {
        $inputs = $this->stockMovements()
            ->whereIn('movement_type', ['purchase', 'adjustment'])
            ->sum('quantity');

        $outputs = $this->stockMovements()
            ->where('movement_type', 'sale')
            ->sum('quantity');

        return $inputs - $outputs;
    }

    public function getAverageCostAttribute(): float
    {
        $cpp = $this->stockMovements()
            ->selectRaw('
                sum(CASE WHEN movement_type = "PURCHASE" THEN quantity
                    WHEN movement_type = "ADJUSTMENT" THEN quantity
                     WHEN movement_type = "SALE" THEN -quantity
                    ELSE 0 END) as total_quantity,

                sum(CASE WHEN movement_type = "PURCHASE" THEN quantity * unit_cost
                    WHEN movement_type = "ADJUSTMENT" THEN quantity * unit_cost
                         WHEN movement_type = "SALE" THEN -quantity * unit_cost
                         ELSE 0 END) as total_cost
                ')
            ->first();
        if ($cpp && $cpp->total_quantity > 0) {
            return $cpp->total_cost / $cpp->total_quantity;
        }

        return 0;
    }

    public function scopeOnlyPhysical(Builder $query): Builder
    {
        return $query->where('is_service', false);
    }

    public function isStockLow(): bool
    {
        return $this->current_stock < $this->min_stock;
    }
}
