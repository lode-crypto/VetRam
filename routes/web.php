<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\AdministradorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clientes', ClienteController::class);
Route::resource('productos', ProductoController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('carritos', CarritoController::class);
Route::resource('pagos', PagoController::class);
Route::resource('detalle_pedidos', DetallePedidoController::class);
Route::resource('administradores', AdministradorController::class);