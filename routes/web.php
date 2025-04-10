<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfMovementDetailController;
use App\Http\Controllers\ProductController;
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


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login',
    [LoginController::class, 'login'])->middleware('guest')->name('login.perform');


// nuevas rutas
Route::group(['middleware' => ['auth']], function () {
    Route::get('/personal/inventory/stock/detail/export-pdf/{product}',
        [PdfMovementDetailController::class, 'exportPdfMovementDetail'])
        ->name('personal.inventory.stock.detail.pdf');
});

// acceso a cualquier persona

Route::get('/products/{product}/technical-file',
    [ProductController::class, 'file'])->name('product.file');
