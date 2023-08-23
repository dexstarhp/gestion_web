<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\User;
use App\Models\Ventas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalIngresos = Ventas::whereRaw('fecha_venta = CURDATE()')
            ->sum('total');
        $totalVentas = Ventas::sum('total');
        $totalUsuarios = User::count();

        $totalClientes = Clientes::count();

        $gestionActual = Carbon::now()->format("Y");

        $ventasEnero = Ventas::whereMonth('fecha_venta', '1')->count();
        $ventasFebrero = Ventas::whereMonth('fecha_venta', '2')->count();
        $ventasMarzo = Ventas::whereMonth('fecha_venta', '3')->count();
        $ventasAbril = Ventas::whereMonth('fecha_venta', '4')->count();
        $ventasMayo = Ventas::whereMonth('fecha_venta', '5')->count();
        $ventasJunio = Ventas::whereMonth('fecha_venta', '6')->count();
        $ventasJulio = Ventas::whereMonth('fecha_venta', '7')->count();
        $ventasAgosto = Ventas::whereMonth('fecha_venta', '8')->count();
        $ventasSeptiembre = Ventas::whereMonth('fecha_venta', '9')->count();
        $ventasOctubre = Ventas::whereMonth('fecha_venta', '10')->count();
        $ventasNoviembre = Ventas::whereMonth('fecha_venta', '11')->count();
        $ventasDiciembre = Ventas::whereMonth('fecha_venta', '12')->count();

        return view('pages.dashboard')
            ->with([
                'totalIngresos' => $totalIngresos,
                'totalUsuarios' => $totalUsuarios,
                'totalClientes' => $totalClientes,
                'totalVentas' => $totalVentas,
                'gestionActual' => $gestionActual,
                'ventasEnero' => $ventasEnero,
                'ventasFebrero' => $ventasFebrero,
                'ventasMarzo' => $ventasMarzo,
                'ventasAbril' => $ventasAbril,
                'ventasMayo' => $ventasMayo,
                'ventasJunio' => $ventasJunio,
                'ventasJulio' => $ventasJulio,
                'ventasAgosto' => $ventasAgosto,
                'ventasSeptiembre' => $ventasSeptiembre,
                'ventasOctubre' => $ventasOctubre,
                'ventasNoviembre' => $ventasNoviembre,
                'ventasDiciembre' => $ventasDiciembre
            ]);
    }
}
