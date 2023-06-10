<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Http\Requests\StoreItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Items::all();

        return view("items.index")
            ->with([
                'items' => $items
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemsRequest $request)
    {
        DB::beginTransaction();
        try{
            $item = new Items($request->all());
            $item->save();
            DB::commit();
            return redirect()
                ->route('items.index')
                ->with('succes', 'Item Registrado');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('items.index')
                ->with('Error', 'Error al registrar '. $ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Items $item)
    {
        return view('items.editar')
            ->with([
                'item' => $item
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemsRequest $request, Items $item)
    {
        DB::beginTransaction();
        try{
            $item->fill($request->all());
            $item->update();

            DB::commit();
            return redirect()
                ->route('items.index')
                ->with('succes', 'Item Editado');
        } catch(\Exception $ex){
            DB::rollBack();
            return redirect()
                ->route('items.index')
                ->with('Error', 'Error al editar '. $ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Items $items)
    {
        //
    }
}
