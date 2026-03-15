<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para ver el carrito.');
        }

        $pedido = Pedido::where('cliente_id', $userId)->where('estado', 'carrito')->with('detalles.producto')->first();

        if (!$pedido) {
            $pedido = null;
        }

        return view('carritos.index', compact('pedido'));
    }

    public function agregar(Request $request)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para agregar al carrito.');
        }

        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::find($request->producto_id);

        if ($request->cantidad > $producto->stock) {
            return back()->with('error', 'Cantidad supera el stock disponible.');
        }

        // Buscar o crear pedido carrito
        $pedido = Pedido::where('cliente_id', $userId)->where('estado', 'carrito')->first();

        if (!$pedido) {
            $pedido = Pedido::create([
                'cliente_id' => $userId,
                'fecha' => now(),
                'estado' => 'carrito',
                'total' => 0,
            ]);
        }

        // Verificar si el producto ya está en el carrito
        $detalleExistente = DetallePedido::where('pedido_id', $pedido->id)->where('producto_id', $request->producto_id)->first();

        if ($detalleExistente) {
            $detalleExistente->cantidad += $request->cantidad;
            $detalleExistente->save();
        } else {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
                'precio' => $producto->precio,
            ]);
        }

        // Actualizar total
        $pedido->total = $pedido->detalles->sum(function($detalle) {
            return $detalle->cantidad * $detalle->precio;
        });
        $pedido->save();

        return redirect('/carrito')->with('success', 'Producto agregado al carrito.');
    }

    public function eliminarItem($id)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $detalle = DetallePedido::findOrFail($id);

        // Verificar que pertenece al usuario
        if ($detalle->pedido->cliente_id != $userId) {
            abort(403);
        }

        $detalle->delete();

        // Actualizar total
        $pedido = $detalle->pedido;
        $pedido->total = $pedido->detalles->sum(function($d) {
            return $d->cantidad * $d->precio;
        });
        $pedido->save();

        return redirect('/carrito')->with('success', 'Producto eliminado del carrito.');
    }

    public function edit($id)
    {
        $carrito = Carrito::findOrFail($id);
        $clientes = Cliente::all();

        return view('carritos.edit', compact('carrito', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $carrito = Carrito::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fechaCreacion' => 'required|date',
        ]);

        $carrito->update($request->all());

        return redirect()->route('carritos.index')
            ->with('success', 'Carrito actualizado');
    }

    public function destroy($id)
    {
        Carrito::destroy($id);

        return redirect()->route('carritos.index')
            ->with('success', 'Carrito eliminado');
    }
}