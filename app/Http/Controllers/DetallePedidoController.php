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
        return view('detalle_pedidos.index', compact('detalles'));
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
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric'
        ]);

        DetallePedido::create($request->all());

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

        $detalle->update($request->all());

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