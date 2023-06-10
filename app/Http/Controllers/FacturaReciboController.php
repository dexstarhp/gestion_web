<?php

namespace App\Http\Controllers;

use App\Models\FacturaRecibo;
use App\Http\Requests\StoreFacturaReciboRequest;
use App\Http\Requests\UpdateFacturaReciboRequest;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaReciboRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaReciboRequest $request, FacturaRecibo $facturaRecibo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacturaRecibo $facturaRecibo)
    {
        //
    }
}
