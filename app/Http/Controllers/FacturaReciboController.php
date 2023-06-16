<?php

namespace App\Http\Controllers;

use App\Models\FacturaRecibo;
use App\Http\Requests\StoreFacturaReciboRequest;
use App\Http\Requests\UpdateFacturaReciboRequest;
use App\Models\Detalle;
use App\Models\Items;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacturaReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factura_recibos = FacturaRecibo::all();

        return view("factura_recibo.index")
            ->with([
                'factura_recibos' => $factura_recibos
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('factura_recibo.crear')
            ->with([
                'proveedores' => $proveedores
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaReciboRequest $request)
    {
        DB::beginTransaction();
        try{
            $factura_recibo = new FacturaRecibo($request->all());
            $factura_recibo->user_id = Auth::id();
            $factura_recibo->save();

            for ($i=0; $i < count($request->precio_unitario) ; $i++) {
                $detalle = new Detalle();
                $detalle->item_id = $request->item_id[$i];
                $detalle->cantidad = $request->cantidad[$i];
                $detalle->precio_unitario = $request->precio_unitario[$i];
                $detalle->destino_id = 1;
                $detalle->factura_recibo_id = $factura_recibo->id;
                $detalle->user_id = Auth::id();
                $detalle->save();
            }

            DB::commit();
            return redirect()
                ->route('compra.index')
                ->with('succes', 'Compra Registrada');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('compra.create')
                ->with('Error', 'Error al registrar '. $ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FacturaRecibo $facturaRecibo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacturaRecibo $facturaRecibo)
    {
        $proveedores = Proveedor::all();
        $items = Items::all();
        return view('factura_recibo.editar')
            ->with([
                'factura_recibo' => $facturaRecibo,
                'proveedores' => $proveedores,
                'items' => $items
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaReciboRequest $request, FacturaRecibo $facturaRecibo)
    {
        DB::beginTransaction();
        try{
            $facturaRecibo->fill($request->all());
            $facturaRecibo->user_id = Auth::id();
            $facturaRecibo->update();
            $facturaRecibo->detalles()->delete();
            for ($i=0; $i < count($request->precio_unitario) ; $i++) {
                $detalle = new Detalle();
                $detalle->item_id = $request->item_id[$i];
                $detalle->cantidad = $request->cantidad[$i];
                $detalle->precio_unitario = $request->precio_unitario[$i];
                $detalle->destino_id = 1;
                $detalle->factura_recibo_id = $facturaRecibo->id;
                $detalle->user_id = Auth::id();
                $detalle->save();
            }

            DB::commit();
            return redirect()
                ->route('compra.index')
                ->with('primary', 'Compra Registrada');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('compra.edit', $facturaRecibo)
                ->with('Error', 'Error al registrar '. $ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacturaRecibo $facturaRecibo)
    {
        //
    }

    function addItem() {
        $items = Items::all();

        $html = view('factura_recibo.partials.row_item')
                    ->with([
                        'items' => $items,
                    ])
                    ->render();

        return response()->json([
                'content' => $html
            ]);
    }
}
