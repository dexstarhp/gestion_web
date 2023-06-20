<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Http\Requests\StoreVentasRequest;
use App\Http\Requests\UpdateVentasRequest;
use App\Models\Clientes;
use App\Models\DetalleVenta;
use App\Models\Items;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Ventas::all();

        return view("venta.index")
            ->with([
                'ventas' => $ventas
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Clientes::all();
        return view('venta.crear')
            ->with([
                'clientes' => $clientes
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVentasRequest $request)
    {
        DB::beginTransaction();
        try{
            $venta = new Ventas($request->all());
            $venta->user_id = Auth::id();
            $venta->save();
            for ($i=0; $i < count($request->precio_unitario) ; $i++) {
                $detalle = new DetalleVenta();
                $detalle->item_id = $request->item_id[$i];
                $detalle->cantidad = $request->cantidad[$i];
                $detalle->precio_unitario = $request->precio_unitario[$i];
                $detalle->importe = $request->sub_total[$i];
                $detalle->tipo = 'producto';
                $detalle->venta_id = $venta->id;
                $detalle->user_id = Auth::id();
                $detalle->save();
            }
            DB::commit();
            return redirect()
                ->route('venta.index')
                ->with('succes', 'Venta Registrada');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('venta.create')
                ->with('Error', 'Error al registrar '. $ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ventas $ventas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventas $venta)
    {
        $clientes = Clientes::all();
        $items = Items::all();
        return view('venta.editar')
            ->with([
                'venta' => $venta,
                'clientes' => $clientes,
                'items' => $items
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVentasRequest $request, Ventas $venta)
    {
        DB::beginTransaction();
        try{
            $venta->fill($request->all());
            $venta->user_id = Auth::id();
            $venta->update();
            $venta->detalles()->delete();
            for ($i=0; $i < count($request->precio_unitario) ; $i++) {
                $detalle = new DetalleVenta();
                $detalle->item_id = $request->item_id[$i];
                $detalle->cantidad = $request->cantidad[$i];
                $detalle->precio_unitario = $request->precio_unitario[$i];
                $detalle->importe = $request->sub_total[$i];
                $detalle->tipo = 'producto';
                $detalle->venta_id = $venta->id;
                $detalle->user_id = Auth::id();
                $detalle->save();
            }
            DB::commit();
            return redirect()
                ->route('venta.index')
                ->with('succes', 'Venta editada');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('venta.edit', $venta)
                ->with('Error', 'Error al registrar '. $ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventas $ventas)
    {
        //
    }

    function addItem() {
        $items = Items::all();

        $html = view('venta.partials.row_item')
                    ->with([
                        'items' => $items,
                    ])
                    ->render();

        return response()->json([
                'content' => $html
            ]);
    }
}
