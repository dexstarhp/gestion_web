<?php

namespace App\Models;

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
        // Aquí filtramos los movimientos para calcular solo las compras y ajustes
        return $this->stockMovements()
                ->whereIn('movement_type', ['purchase', 'adjustment']) // Solo compras y ajustes
                ->sum('quantity') - $this->stockMovements()
                ->where('movement_type', 'sale') // Restar las ventas
                ->sum('quantity');
    }
}
