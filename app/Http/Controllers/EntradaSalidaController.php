<?php

namespace App\Http\Controllers;

use App\Models\Entrada_Salida;
use App\Http\Requests\StoreEntrada_SalidaRequest;
use App\Http\Requests\UpdateEntrada_SalidaRequest;

class EntradaSalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = Entrada_Salida::all();

        return view("entrada.index")
            ->with([
                'entradas' => $entradas
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
    public function store(StoreEntrada_SalidaRequest $request)
    {
        //
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
    public function edit(Entrada_Salida $entrada_Salida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntrada_SalidaRequest $request, Entrada_Salida $entrada_Salida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada_Salida $entrada_Salida)
    {
        //
    }
}
