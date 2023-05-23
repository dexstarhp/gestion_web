<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaRecibo extends Model
{
    use HasFactory;

    protected $table = 'FacturaRecibo';


    protected $fillable = ['nro', 'fecha', 'total'];
}
