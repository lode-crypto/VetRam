<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carritos = Carrito::with('cliente')->get();
        return view('carritos.index', compact('carritos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('carritos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id'
        ]);

        Carrito::create($request->all());

        return redirect()->route('carritos.index')
            ->with('success', 'Carrito creado correctamente');
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