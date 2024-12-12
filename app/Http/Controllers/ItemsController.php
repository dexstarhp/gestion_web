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
        try {
            // Definir la carpeta de subida
            $uploadFolder = 'uploads';
            $folderPath = public_path($uploadFolder);

            // Crear la carpeta si no existe
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }

            // Si hay una imagen cargada, guardar en 'public/uploads'
            if ($request->hasFile('imagen_url')) {
                $file = $request->file('imagen_url');
                // Generar un nombre único para el archivo
                $fileName = time() . '_' . $file->getClientOriginalName();
                // Mover el archivo al directorio 'public/uploads'
                $file->move($folderPath, $fileName);
                // Guardar la ruta relativa en la base de datos
                $path = $uploadFolder . '/' . $fileName;
            } else {
                $path = null;
            }

            // Crear el item
            $item = new Items([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'imagen_url' => $path, // Guardar la ruta relativa
            ]);
            $item->save();

            DB::commit();
            return redirect()
                ->route('items.index')
                ->with('success', 'Item Registrado');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()
                ->route('items.index')
                ->with('error', 'Error al registrar: ' . $ex->getMessage());
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
        try {
            // Datos a actualizar
            $data = [
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
            ];

            // Manejar la imagen, si se sube una nueva
            if ($request->hasFile('imagen_url')) {
                // Elimina la imagen anterior si existe
                if ($item->imagen_url && File::exists(public_path($item->imagen_url))) {
                    File::delete(public_path($item->imagen_url));
                }

                // Define el directorio de subida
                $uploadFolder = 'uploads';
                $folderPath = public_path($uploadFolder);

                // Crea el directorio si no existe
                if (!File::exists($folderPath)) {
                    File::makeDirectory($folderPath, 0755, true);
                }

                // Guarda la nueva imagen
                $file = $request->file('imagen_url');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($folderPath, $fileName);

                // Agregar la nueva ruta al array de datos
                $data['imagen_url'] = $uploadFolder . '/' . $fileName;
            }

            // Actualizar los datos del item
            $item->update($data);

            DB::commit();
            return redirect()
                ->route('items.index')
                ->with('success', 'Item Editado');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()
                ->route('items.index')
                ->with('error', 'Error al editar: ' . $ex->getMessage());
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
            ->orderBy('id')
            ->get();
        $item = Items::find($itemId);

        return view("reporte.kardex.detalleItem")
            ->with([
                'entradaSalidaList' => $entradaSalidaList,
                'item' => $item,
            ]);
    }

    public function kardexDetallePdf($itemId){
        $entradaSalidaList = Entrada_Salida_detalles::where('item_id', $itemId)
            ->orderBy('id')
            ->get();
        $item = Items::find($itemId);

        $pdf = Pdf::loadView(
            'reporte.kardex.detallePdf',
            compact('item', 'entradaSalidaList')
        )->setPaper('letter','landscape');
        return $pdf->stream('kardex_detalle.pdf');
    }
}
