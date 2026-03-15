<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AuthController;

/*
TIENDA
*/

Route::get('/', [ProductoController::class,'inicio']);

Route::get('/productos', [ProductoController::class,'tienda']);

Route::get('/producto/{id}', [ProductoController::class,'show']);

// Autenticación
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::get('/register', [AuthController::class,'showRegister'])->name('register');
Route::post('/register', [AuthController::class,'register']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// Carrito y pedidos
Route::get('/carrito',[CarritoController::class,'index']);
Route::post('/carrito/agregar',[CarritoController::class,'agregar']);
Route::delete('/carrito/eliminar/{id}',[CarritoController::class,'eliminarItem']);
Route::get('/checkout', [PedidoController::class,'checkout']);
Route::post('/checkout', [PedidoController::class,'procesarPago']);
Route::get('/nota-pago/{id}', [PedidoController::class,'notaPago']);
Route::get('/mis-pedidos',[PedidoController::class,'index']);

Route::prefix('admin')->group(function(){

Route::get('/',[AdministradorController::class,'dashboard']);

Route::resource('productos',ProductoController::class);

Route::resource('categorias',CategoriaController::class);

    Route::resource('clientes', ClienteController::class)->except(['show']);
    Route::resource('carritos', CarritoController::class)->except(['show']);
    Route::resource('pedidos', PedidoController::class)->except(['show']);
    Route::resource('detalle_pedidos', DetallePedidoController::class)->except(['show']);
    Route::resource('pagos', PagoController::class)->except(['show']);

});