<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $pedidos = Pedido::where('cliente_id', $userId)->where('estado', '!=', 'carrito')->with('detalles.producto')->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function checkout()
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $pedido = Pedido::where('cliente_id', $userId)->where('estado', 'carrito')->with('detalles.producto')->first();

        if (!$pedido || $pedido->detalles->isEmpty()) {
            return redirect('/carrito')->with('error', 'Tu carrito está vacío.');
        }

        return view('pedidos.checkout', compact('pedido'));
    }

    public function procesarPago(Request $request)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $pedido = Pedido::where('cliente_id', $userId)->where('estado', 'carrito')->first();

        if (!$pedido) {
            return redirect('/carrito');
        }

        $request->validate([
            'metodo_pago' => 'required',
        ]);

        // Cambiar estado del pedido
        $pedido->estado = 'pagado';
        $pedido->save();

        // Crear pago
        Pago::create([
            'pedido_id' => $pedido->id,
            'monto' => $pedido->total,
            'metodo' => $request->metodo_pago,
            'fecha' => now(),
        ]);

        // Reducir stock
        foreach ($pedido->detalles as $detalle) {
            $producto = $detalle->producto;
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        return redirect('/nota-pago/' . $pedido->id);
    }

    public function notaPago($id)
    {
        $userId = session('user_id');

        $pedido = Pedido::where('id', $id)->where('cliente_id', $userId)->with('detalles.producto', 'pago')->firstOrFail();

        return view('pedidos.nota', compact('pedido'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required',
            'total' => 'required|numeric'
        ]);

        Pedido::create([
            'cliente_id' => session('user_id'),
            'fecha' => $request->fecha,
            'estado' => $request->estado,
            'total' => $request->total,
        ]);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido creado correctamente');
    }

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $clientes = Cliente::all();

        return view('pedidos.edit', compact('pedido', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'estado' => 'required',
            'total' => 'required|numeric'
        ]);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido actualizado');
    }

    public function destroy($id)
    {
        Pedido::destroy($id);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido eliminado');
    }
}