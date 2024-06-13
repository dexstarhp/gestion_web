<?php

namespace App\Http\Controllers;

use App\Models\Entrada_Salida_detalles;
use App\Models\Items;
use App\Http\Requests\StoreItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            // Crear la carpeta si no existe
            $uploadFolder = 'uploads';
            $folderPath = public_path($uploadFolder);

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }
            // Si hay una imagen cargada, guarda la imagen en el sistema de archivos
            if ($request->hasFile('imagen_url')) {
                $path = $request->file('imagen_url')->store('uploads', 'public');
            } else {
                $path = null;
            }

            $item = new Items([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'imagen_url' => $path
            ]);
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
    public function show(Items $item)
    {
        return view('items.show')
            ->with([
                'item' => $item
            ]);
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
            if ($request->hasFile('imagen_url')) {
                // Elimina la imagen anterior si existe
                if ($item->imagen_url) {
                    File::delete(public_path($item->imagen_url));
                }

                // Guarda la nueva imagen
                $path = $request->file('imagen_url')->store('uploads', 'public');
                $data = [
                    'nombre' => $request->input('nombre'),
                    'descripcion' => $request->input('descripcion'),
                    'imagen_url' => $path
                ];
            } else {
                $data = [
                    'nombre' => $request->input('nombre'),
                    'descripcion' => $request->input('descripcion')
                ];
            }

            $item->fill($request->all());
            $item->update($data);

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

    /**
     * Listado de kardex items
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function kardex() {
        $items = Items::all();

        return view("reporte.kardex.index")
            ->with([
                'items' => $items
            ]);
    }

    public function kardexPdf(){
        $items = Items::all();
        $pdf = Pdf::loadView('reporte.kardex.pdf', compact('items'))
            ->setPaper('letter','landscape');
        return $pdf->stream('kardex.pdf');
    }

    public function getQr(Items $item){
        $item_ = Items::find($item->id);
        $pdf = Pdf::loadView(
            'reporte.item.qr',
            compact('item_')
        );

        return $pdf->stream('qr.pdf');
    }

    public function kardexDetalle($itemId) {
        $entradaSalidaList = Entrada_Salida_detalles::where('item_id', $itemId)
                ->get();

        return view("reporte.kardex.detalleItem")
            ->with([
                'entradaSalidaList' => $entradaSalidaList
            ]);
    }
}
