<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FacturaRecibo extends Model
{
    use HasFactory;

    protected $table = 'factura_recibos';

    protected $fillable = [
        'nro',
        'fecha',
        'total',
        'proveedor_id',
        'user_id'
    ];


    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(Detalle::class, 'factura_recibo_id');
    }
}
