<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function item(): BelongsTo
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function entradaSalida(): BelongsTo
    {
        return $this->belongsTo(Entrada_Salida::class, 'entrada_salida_id');
    }
}
