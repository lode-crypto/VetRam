<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

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
    'nombre'=>'required',
    'descripcion'=>'required',
    'precio'=>'required',
    'stock'=>'required',
    'categoria_id'=>'required',
    'imagen'=>'image'
    ]);

    $imagenNombre = null;

    if($request->hasFile('imagen')){

    $imagen = $request->file('imagen');

    $imagenNombre = time().'.'.$imagen->getClientOriginalExtension();

    $imagen->move(public_path('productos'),$imagenNombre);

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
            'precio' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $producto->update($request->all());

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