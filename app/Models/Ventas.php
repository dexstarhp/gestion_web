<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'total',
        'fecha_venta',
        'cliente_id',
        'user_id'
    ];


    // relationship
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliene::class);
    }
}
