<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_Salida_detalles extends Model
{
    use HasFactory;

    protected $table = 'clientes';


    protected $fillable = ['items_id', 'cantidad', 'precio_unitario', 'tipo(entrada_salida)', 'entrada_salida_cabecera_id'];
}
