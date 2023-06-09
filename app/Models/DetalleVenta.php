<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';

    protected $fillable = [
        'cantidad',
        'precio unitario',
        'importe',
        'ventas_id',
        'tipo ENUM',
        'item_id',
        'user_id'
    ];
}
