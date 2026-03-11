<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AdministradorController;

/*
TIENDA
*/

Route::get('/', [ProductoController::class,'inicio']);

Route::get('/productos', [ProductoController::class,'tienda']);

Route::get('/producto/{id}', [ProductoController::class,'show']);

/*
CARRITO
*/

Route::get('/carrito',[CarritoController::class,'index']);

/*
PEDIDOS
*/

Route::get('/mis-pedidos',[PedidoController::class,'index']);

/*
ADMIN
*/

Route::prefix('admin')->group(function(){

Route::get('/',[AdministradorController::class,'dashboard']);

Route::resource('productos',ProductoController::class);

Route::resource('categorias',CategoriaController::class);

});