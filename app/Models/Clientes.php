<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clientes extends Model
{
    use HasFactory;

    // Referenciar a las tablas de la base de datos
    protected $table = 'clientes';

    // campos de la tabla
    protected $fillable = ['nombre', 'ci', 'telefono', 'user_id'];

    // relationship
    public function ventas(): HasMany
    {
        return $this->hasMany(Ventas::class, 'id');
    }
}
