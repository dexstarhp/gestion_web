<?php

namespace App\Http\Controllers;

use App\Models\Entrada_Salida;
use App\Http\Requests\StoreEntrada_SalidaRequest;
use App\Http\Requests\UpdateEntrada_SalidaRequest;
use App\Models\Entrada_Salida_detalles;
use App\Models\Items;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salidas = Entrada_Salida::where('tipo', 'salida')
            ->get();

        return view("salida.index")
            ->with([
                'salidas' => $salidas
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salida.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntrada_SalidaRequest $request)
    {
        DB::beginTransaction();
        try{
            $entrada_salida = new Entrada_Salida($request->all());
            $nro = Entrada_Salida::where('tipo', 'salida')
                ->get()
                ->max('nro');
            $nro = (is_null($nro) ? 1: ($nro+1));
            $entrada_salida->nro = $nro;
            $entrada_salida->user_id = Auth::id();
            $entrada_salida->tipo = 'salida';
            $entrada_salida->save();

            for ($i=0; $i < count($request->precio_unitario) ; $i++) {
                $detalle = new Entrada_Salida_detalles();
                $detalle->item_id = $request->item_id[$i];
                $detalle->cantidad = $request->cantidad[$i];
                $detalle->precio_unitario = $request->precio_unitario[$i];
                $detalle->entrada_salida_id = $entrada_salida->id;
                $detalle->save();
            }

            DB::commit();
            return redirect()
                ->route('salida.index')
                ->with('succes', 'Entrada Registrada');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('salida.create')
                ->with('errors', 'Error al registrar '. $ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada_Salida $entrada_Salida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada_Salida $entrada_salida)
    {
        $items = Items::all();
        return view('salida.editar')
            ->with([
                'entrada_salida' => $entrada_salida,
                'items' => $items
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntrada_SalidaRequest $request, Entrada_Salida $entrada_salida)
    {
        DB::beginTransaction();
        try{
            $entrada_salida->fill($request->all());
            $entrada_salida->user_id = Auth::id();
            $entrada_salida->update();
            $entrada_salida->detalles()->delete();
            for ($i=0; $i < count($request->precio_unitario) ; $i++) {
                $detalle = new Entrada_Salida_detalles();
                $detalle->item_id = $request->item_id[$i];
                $detalle->cantidad = $request->cantidad[$i];
                $detalle->precio_unitario = $request->precio_unitario[$i];
                $detalle->entrada_salida_id = $entrada_salida->id;
                $detalle->save();
            }

            DB::commit();
            return redirect()
                ->route('salida.index')
                ->with('succes', 'Salida Editada');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('salida.edit')
                ->with('errors', 'Error al registrar '. $ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada_Salida $entrada_Salida)
    {
        //
    }
}
