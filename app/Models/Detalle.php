<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $table = 'detalle';


    protected $fillable = ['item_id', 'cantidad', 'precio_unitario', 'factura_recibo_id', 'factura_recibos', 'destino', 'user_id'];
}
