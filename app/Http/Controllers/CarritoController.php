<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Inicializar carrito en sesión si no existe
     */
    private function inicializarCarrito()
    {
        if (!session()->has('carrito')) {
            session(['carrito' => []]);
        }
    }

    /**
     * Mostrar el carrito del usuario (desde sesión)
     */
    public function index()
    {
        $this->inicializarCarrito();
        $carrito = session('carrito', []);
        
        // Obtener los productos del carrito
        $productos = [];
        foreach ($carrito as $productoId => $item) {
            $producto = Producto::find($productoId);
            if ($producto) {
                $productos[] = (object)[
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'imagen' => $producto->imagen,
                    'cantidad' => $item['cantidad'],
                    'precioUnitario' => $item['precioUnitario'],
                ];
            }
        }

        $total = collect($productos)->sum(fn($p) => $p->cantidad * $p->precioUnitario);

        return view('carritos.index', compact('productos', 'total'));
    }

    /**
     * Agregar producto al carrito (en sesión)
     */
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($request->cantidad > $producto->stock) {
            return back()->with('error', 'Cantidad supera el stock disponible.');
        }

        $this->inicializarCarrito();
        $carrito = session('carrito', []);

        $productoId = $request->producto_id;

        if (isset($carrito[$productoId])) {
            // Aumentar cantidad si ya existe
            $cantidadNueva = $carrito[$productoId]['cantidad'] + $request->cantidad;
            
            if ($cantidadNueva > $producto->stock) {
                return back()->with('error', 'Cantidad total supera el stock disponible.');
            }

            $carrito[$productoId]['cantidad'] = $cantidadNueva;
        } else {
            // Agregar nuevo producto
            $carrito[$productoId] = [
                'cantidad' => $request->cantidad,
                'precioUnitario' => $producto->precio,
            ];
        }

        session(['carrito' => $carrito]);

        return redirect('/carrito')->with('success', 'Producto agregado al carrito.');
    }

    /**
     * Actualizar cantidad de producto en el carrito
     */
    public function actualizar(Request $request, $productoId)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $this->inicializarCarrito();
        $carrito = session('carrito', []);

        $producto = Producto::findOrFail($productoId);

        if ($request->cantidad > $producto->stock) {
            return back()->with('error', 'Cantidad supera el stock disponible.');
        }

        if ($request->cantidad == 0) {
            // Eliminar si cantidad es 0
            unset($carrito[$productoId]);
            session(['carrito' => $carrito]);
            return redirect('/carrito')->with('success', 'Producto eliminado del carrito.');
        }

        // Actualizar cantidad
        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] = $request->cantidad;
            session(['carrito' => $carrito]);
        }

        return redirect('/carrito')->with('success', 'Cantidad actualizada.');
    }

    /**
     * Eliminar producto del carrito
     */
    public function eliminarItem($productoId)
    {
        $this->inicializarCarrito();
        $carrito = session('carrito', []);

        if (!isset($carrito[$productoId])) {
            return back()->with('error', 'Producto no encontrado en el carrito.');
        }

        unset($carrito[$productoId]);
        session(['carrito' => $carrito]);

        return redirect('/carrito')->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Vaciar el carrito completo
     */
    public function vaciar()
    {
        session(['carrito' => []]);

        return redirect('/carrito')->with('success', 'Carrito vaciado.');
    }

    // MÉTODOS DEL PANEL ADMINISTRATIVO

    /**
     * Listar todos los carritos (Admin)
     */
    public function list_admin()
    {
        $carritos = Carrito::with('cliente', 'productos')->get();
        return view('carritos.admin-index', compact('carritos'));
    }

    /**
     * Editar carrito (Admin)
     */
    public function edit($id)
    {
        $carrito = Carrito::findOrFail($id);
        $clientes = Cliente::all();

        return view('carritos.edit', compact('carrito', 'clientes'));
    }

    /**
     * Actualizar carrito (Admin)
     */
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

    /**
     * Eliminar carrito (Admin)
     */
    public function destroy($id)
    {
        $carrito = Carrito::findOrFail($id);
        $carrito->delete();

        return redirect()->route('carritos.index')
            ->with('success', 'Carrito eliminado');
    }
}