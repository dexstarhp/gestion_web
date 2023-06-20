<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Http\Requests\StoreClientesRequest;
use App\Http\Requests\UpdateClientesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::all();
        return view("clientes.index")
            ->with([
                'clientes' => $clientes
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientesRequest $request)
    {
        DB::beginTransaction();
        try{
            $cliente = new Clientes($request->all());
            $cliente->user_id = Auth::id();
            $cliente->save();
            DB::commit();
            return redirect()
                ->route('cliente.index')
                ->with('succes', 'Cliente Registrado');
        } catch(\Exception $ex){
            DB::rollBack();
            dd('e', $ex);
            return redirect()
                ->route('cliente.create')
                ->with('Error', 'Error al registrar '. $ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $clientes)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clientes $cliente)
    {
        return view('clientes.editar')
            ->with([
                'cliente' => $cliente
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientesRequest $request, Clientes $cliente)
    {
        DB::beginTransaction();
        try{
            $cliente->fill($request->all());
            $cliente->update();

            DB::commit();
            return redirect()
                ->route('cliente.index')
                ->with('succes', 'Cliente Editado');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('cliente.edit',$cliente)
                ->with('Error', 'Error al editar '. $ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
