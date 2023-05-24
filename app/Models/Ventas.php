<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $fillable = ['fecha', 'ventas','clientes_id', 'users_id'];

    // relationship
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliene::class);
    }
}
