<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        // select * from Proveedores
        // conxion a base de datos
        // consulta  a la base de datos
        // mapeo e los datos
        // mostrar datos
        return view("proveedor.index")
            ->with([
                'proveedores' => $proveedores
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedor.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request)
    {
        DB::beginTransaction();
        try{
            $proveedor = new Proveedor($request->all());
            $proveedor->save();
            DB::commit();
            return redirect()
                ->route('proveedores.index')
                ->with('succes', 'Proveedor Registrado');
        } catch(\Exception ){
            DB::rollBack();
            return redirect()
                ->route('proveedores.index')
                ->with('Error', 'Error al registrar '. $ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
