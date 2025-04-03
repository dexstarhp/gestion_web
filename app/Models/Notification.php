<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
            'product_id',
            'message',
            'is_read'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
