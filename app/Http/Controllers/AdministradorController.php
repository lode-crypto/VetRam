<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index()
    {
        $administradores = Administrador::all();
        return view('administradores.index', compact('administradores'));
    }

    public function create()
    {
        return view('administradores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        Administrador::create($request->all());

        return redirect()->route('administradores.index')
            ->with('success', 'Administrador creado correctamente');
    }

    public function edit($id)
    {
        $administrador = Administrador::findOrFail($id);
        return view('administradores.edit', compact('administrador'));
    }

    public function update(Request $request, $id)
    {
        $administrador = Administrador::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email'
        ]);

        $administrador->update($request->all());

        return redirect()->route('administradores.index')
            ->with('success', 'Administrador actualizado');
    }

    public function destroy($id)
    {
        Administrador::destroy($id);

        return redirect()->route('administradores.index')
            ->with('success', 'Administrador eliminado');
    }
}