<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('pedido')->get();
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $pedidos = Pedido::all();
        return view('pagos.create', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'metodo_pago' => 'required',
            'monto' => 'required|numeric'
        ]);

        Pago::create($request->all());

        return redirect()->route('pagos.index')
            ->with('success', 'Pago registrado correctamente');
    }

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        $pedidos = Pedido::all();

        return view('pagos.edit', compact('pago', 'pedidos'));
    }

    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        $request->validate([
            'metodo_pago' => 'required',
            'monto' => 'required|numeric'
        ]);

        $pago->update($request->all());

        return redirect()->route('pagos.index')
            ->with('success', 'Pago actualizado');
    }

    public function destroy($id)
    {
        Pago::destroy($id);

        return redirect()->route('pagos.index')
            ->with('success', 'Pago eliminado');
    }
}