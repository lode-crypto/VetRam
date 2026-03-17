<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function index()
    {
        $detalles = DetallePedido::with(['pedido','producto'])->get();

        $total = 0;

        foreach ($detalles as $detalle) {
            $total += $detalle->cantidad * $detalle->precioUnitario;
        }

        return view('detalle_pedidos.index', compact('detalles','total'));
    }

    public function create()
    {
        $pedidos = Pedido::all();
        $productos = Producto::all();

        return view('detalle_pedidos.create', compact('pedidos','productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer'
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        DetallePedido::create([
            'pedido_id' => $request->pedido_id,
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'precioUnitario' => $producto->precio
        ]);

        return redirect()->route('detalle_pedidos.index')
            ->with('success', 'Detalle del pedido creado');
    }

    public function edit($id)
    {
        $detalle = DetallePedido::findOrFail($id);
        $pedidos = Pedido::all();
        $productos = Producto::all();

        return view('detalle_pedidos.edit', compact('detalle','pedidos','productos'));
    }

    public function update(Request $request, $id)
    {
        $detalle = DetallePedido::findOrFail($id);

        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer'
        ]);

        // Obtener producto actualizado
        $producto = Producto::findOrFail($request->producto_id);

        $detalle->update([
            'pedido_id' => $request->pedido_id,
            'producto_id' => $producto->id,
            'cantidad' => $request->cantidad,
            'precioUnitario' => $producto->precio
        ]);

        return redirect()->route('detalle_pedidos.index')
            ->with('success', 'Detalle actualizado');
    }

    public function destroy($id)
    {
        DetallePedido::destroy($id);

        return redirect()->route('detalle_pedidos.index')
            ->with('success', 'Detalle eliminado');
    }
}