<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_Salida_Cabeceras extends Model
{
    use HasFactory;
    protected $table = 'entrada_salida_cabeceras';


    protected $fillable = ['nombre', 'ci', 'telefono', 'user_id'];
}
