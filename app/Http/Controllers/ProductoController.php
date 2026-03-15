<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    public function inicio()
    {
        $productos = Producto::take(4)->get();
        return view('tienda.inicio', compact('productos'));
    }

    public function tienda()
    {
        $productos = \App\Models\Producto::all();
        return view('tienda.productos', compact('productos'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('tienda.producto', compact('producto'));
    }

    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {

    $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image'
    ]);

    $imagenNombre = null;

    if($request->hasFile('imagen')){

    $imagen = $request->file('imagen');

    $imagenNombre = time().'.'.$imagen->getClientOriginalExtension();

    $imagen->storeAs('imagenesdeproductos', $imagenNombre, 'public');

    }


    Producto::create([
    'nombre'=>$request->nombre,
    'descripcion'=>$request->descripcion,
    'precio'=>$request->precio,
    'stock'=>$request->stock,
    'categoria_id'=>$request->categoria_id,
    'imagen'=>$imagenNombre
    ]);

    return redirect()->route('productos.index');

    }
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();

        return view('admin.productos.edit', compact('producto','categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image'
        ]);

        $imagenNombre = $producto->imagen; // Mantener imagen actual si no se sube nueva

        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $imagenNombre = time().'.'.$imagen->getClientOriginalExtension();
            $imagen->storeAs('imagenesdeproductos', $imagenNombre, 'public');
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'imagen' => $imagenNombre
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado');
    }

    public function destroy($id)
    {
        Producto::destroy($id);

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado');
    }

}