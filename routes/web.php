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
use App\Http\Controllers\FacturaReciboController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProveedorController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
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
    Route::get('/compras', [FacturaReciboController::class, 'index'])->name('compra.index');
    Route::get('compra/crear', [FacturaReciboController::class, 'create'])->name('compra.create');
    Route::post('compra/crear', [FacturaReciboController::class, 'store'])->name('compra.store');
    Route::get('compra/editar/{proveedor}', [FacturaReciboController::class, 'edit'])->name('compra.edit');
    Route::put('compra/editar/{proveedor}', [FacturaReciboController::class, 'update'])->name('compra.update');


    // Items
    Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
    Route::get('items/crear', [ItemsController::class, 'create'])->name('items.create');
    Route::post('items/crear', [ItemsController::class, 'store'])->name('items.store');
    Route::get('items/editar/{item}', [ItemsController::class, 'edit'])->name('items.edit');
    Route::put('items/editar/{item}', [ItemsController::class, 'update'])->name('items.update');

    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');

    Route::get('/{page}', [PageController::class, 'index'])->name('page');
});
