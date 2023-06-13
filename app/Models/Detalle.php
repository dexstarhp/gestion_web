<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $table = 'detalles';


    protected $fillable = [
        'item_id',
        'cantidad',
        'precio_unitario',
        'factura_recibo_id',
        'destino',
        'user_id'
    ];
}
