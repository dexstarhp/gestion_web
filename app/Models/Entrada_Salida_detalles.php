<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_Salida_detalles extends Model
{
    use HasFactory;

    protected $table = 'entrada_salida_detalles';


    protected $fillable = [
        'item_id',
        'cantidad',
        'precio_unitario',
        'entrada_salida_id'
    ];
}
