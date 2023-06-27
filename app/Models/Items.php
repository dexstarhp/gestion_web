<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items';


    protected $fillable = ['nombre', 'fecha_de_expiracion', 'descripcion', 'fecha_de_elaboracion'];

    // mutators

    protected function cpp1(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                return '1';
            }
        );
    }

    public function getCantidadTotalAttribute(){
        $total_entradas = Entrada_Salida_detalles::join('entrada_salidas', 'entrada_salidas.id', '=', 'entrada_salida_detalles.entrada_salida_id')
            ->where('entrada_salidas.tipo', '=', 'entrada')
            ->where('item_id', $this->id)
            ->get()
            ->sum('cantidad');
        $total_salidas = Entrada_Salida_detalles::join('entrada_salidas', 'entrada_salidas.id', '=', 'entrada_salida_detalles.entrada_salida_id')
            ->where('entrada_salidas.tipo', '=', 'salida')
            ->where('item_id', $this->id)
            ->get()
            ->sum('cantidad');
        $cantidad_total = $total_entradas - $total_salidas;
        return $cantidad_total;
    }

    public function getImporteTotalAttribute(){
        $total_importe = Entrada_Salida_detalles::join('entrada_salidas', 'entrada_salidas.id', '=', 'entrada_salida_detalles.entrada_salida_id')
            ->where('entrada_salidas.tipo', '=', 'entrada')
            ->where('item_id', $this->id)
            ->select(DB::raw('cantidad*precio_unitario as subtotal'))
            ->get()
            ->sum('subtotal');

        return $total_importe;
    }

    public function getCppAttribute()
    {
        $cpp = $this->importe_total /$this->cantidad_total;
        return $cpp;
    }
}
