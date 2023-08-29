<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EntradaSalidaController;
use App\Http\Controllers\FacturaReciboController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\UserController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // rutas del sistema
    // proveedores
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('proveedores/crear', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('proveedores/crear', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('proveedores/editar/{proveedor}', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::put('proveedores/editar/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');

    // Registro de compra
    Route::prefix('compras')->group(function(){
        Route::get('', [FacturaReciboController::class, 'index'])
            ->name('compra.index');
        Route::get('crear', [FacturaReciboController::class, 'create'])
            ->name('compra.create');
        Route::post('crear', [FacturaReciboController::class, 'store'])
            ->name('compra.store');
        Route::get('editar/{factura_recibo}', [FacturaReciboController::class, 'edit'])
            ->name('compra.edit');
        Route::put('editar/{factura_recibo}', [FacturaReciboController::class, 'update'])
            ->name('compra.update');
        // obtencion de items
        Route::get('add/item', [FacturaReciboController::class, 'addItem'])
            ->name('compra.add_item');
    });

    // Items
    Route::prefix('items')->group(function (){
        Route::get('', [ItemsController::class, 'index'])
            ->name('items.index');
        Route::get('crear', [ItemsController::class, 'create'])
            ->name('items.create');
        Route::post('crear', [ItemsController::class, 'store'])
            ->name('items.store');
        Route::get('editar/{item}', [ItemsController::class, 'edit'])
            ->name('items.edit');
        Route::put('editar/{item}', [ItemsController::class, 'update'])->name('items.update');
    });
    //entradas
    Route::prefix('entradas')->group(function (){
        Route::get('', [EntradaSalidaController::class, 'index'])
            ->name('entrada.index');
        Route::get('crear', [EntradaSalidaController::class, 'create'])
            ->name('entrada.create');
        Route::post('crear', [EntradaSalidaController::class, 'store'])
            ->name('entrada.store');
        Route::get('editar/{entrada_salida}', [EntradaSalidaController::class, 'edit'])
            ->name('entrada.edit');
        Route::get('mostrar/{entrada_salida}', [EntradaSalidaController::class, 'show'])
            ->name('entrada.show');
        Route::put('editar/{entrada_salida}', [EntradaSalidaController::class, 'update'])
            ->name('entrada.update');
        // obtencion de items
        Route::get('add/item', [EntradaSalidaController::class, 'addItem'])
            ->name('entrada.add_item');
    });
    //salidas
    Route::prefix('salidas')->group(function (){
        Route::get('', [SalidaController::class, 'index'])
            ->name('salida.index');
        Route::get('crear', [SalidaController::class, 'create'])
            ->name('salida.create');
        Route::post('crear', [SalidaController::class, 'store'])
            ->name('salida.store');
        Route::get('editar/{entrada_salida}', [SalidaController::class, 'edit'])
            ->name('salida.edit');
        Route::put('editar/{entrada_salida}', [SalidaController::class, 'update'])->name('salida.update');
        // obtencion de items
        Route::get('add/item', [SalidaController::class, 'addItem'])
            ->name('salida.add_item');
    });

    // Clientes
    Route::prefix('clientes')->group(function(){
        Route::get('', [ClientesController::class, 'index'])
            ->name('cliente.index');
        Route::get('crear', [ClientesController::class, 'create'])
            ->name('cliente.create');
        Route::post('crear', [ClientesController::class, 'store'])
            ->name('cliente.store');
        Route::get('editar/{cliente}', [ClientesController::class, 'edit'])
            ->name('cliente.edit');
        Route::put('editar/{cliente}', [ClientesController::class, 'update'])
            ->name('cliente.update');
    });
    // venta
    Route::prefix('venta')->group(function(){
        Route::get('', [VentasController::class, 'index'])
            ->name('venta.index');
        Route::get('crear', [VentasController::class, 'create'])
            ->name('venta.create');
        Route::post('crear', [VentasController::class, 'store'])
            ->name('venta.store');
        Route::get('editar/{venta}', [VentasController::class, 'edit'])
            ->name('venta.edit');
        Route::put('editar/{venta}', [VentasController::class, 'update'])
            ->name('venta.update');
        // obtencion de items
        Route::get('add/item', [VentasController::class, 'addItem'])
            ->name('venta.add_item');
    });

    //reportes
    Route::prefix('reportes')->group(function(){
        Route::get('kardex', [ItemsController::class, 'kardex'])
            ->name('kardex.index');
        Route::get('kardex/pdf', [ItemsController::class, 'kardexPdf'])
            ->name('kardex.pdf');
    });

    // Usuarios
    Route::prefix('users')->group(function (){
        Route::get('', [UserController::class, 'index'])
            ->name('user-management');
        Route::get('/register', [RegisterController::class, 'create'])
            ->name('register');
        Route::post('/register', [RegisterController::class, 'store'])
            ->name('register.perform');
    });

    Route::get('/{page}', [PageController::class, 'index'])->name('page');
});
