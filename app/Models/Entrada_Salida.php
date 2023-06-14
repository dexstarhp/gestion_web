<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_Salida extends Model
{
    use HasFactory;

    protected $table = 'entrada_salidas';


    protected $fillable = [
        'nro',
        'fecha',
        'total',
        'tipo',
        'usuarios_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
