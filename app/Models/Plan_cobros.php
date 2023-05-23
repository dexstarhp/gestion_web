<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan_cobros extends Model
{
    use HasFactory;

    protected $table = 'plan_cobros';


    protected $fillable = ['ventas_id', 'ventas', 'fecha', 'monto_cobro'];
}
