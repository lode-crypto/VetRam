<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Mostrar mis pedidos
     */
    public function index()
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $pedidos = Pedido::where('cliente_id', $userId)
                        ->where('estado', '!=', 'carrito')
                        ->with('detalles.producto', 'pago')
                        ->orderBy('fecha', 'desc')
                        ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Mostrar página de checkout
     */
    public function checkout()
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect('/carrito')->with('error', 'Tu carrito está vacío.');
        }

        // Obtener información de los productos
        $productos = [];
        foreach ($carrito as $productoId => $item) {
            $producto = \App\Models\Producto::find($productoId);
            if ($producto) {
                $productos[] = (object)[
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'cantidad' => $item['cantidad'],
                    'precioUnitario' => $item['precioUnitario'],
                ];
            }
        }

        $total = array_reduce($productos, fn($sum, $p) => $sum + ($p->cantidad * $p->precioUnitario), 0);

        return view('pedidos.checkout', compact('productos', 'total'));
    }

    /**
     * Procesar el pago y convertir carrito en pedido
     */
    public function procesarPago(Request $request)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $request->validate([
            'metodo_pago' => 'required|in:tarjeta,efectivo,transferencia,transferencia_movil',
        ], [
            'metodo_pago.required' => 'Debes seleccionar un método de pago.',
            'metodo_pago.in' => 'Método de pago no válido.',
        ]);

        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect('/carrito')->with('error', 'Tu carrito está vacío.');
        }

        try {
            $total = 0;
            $detallesPedido = [];

            // Calcular total y preparar detalles
            foreach ($carrito as $productoId => $item) {
                $producto = \App\Models\Producto::findOrFail($productoId);
                
                $subtotal = $item['cantidad'] * $item['precioUnitario'];
                $total += $subtotal;

                // Validar stock
                if ($item['cantidad'] > $producto->stock) {
                    return redirect('/carrito')->with('error', 'Stock insuficiente para: ' . $producto->nombre);
                }

                $detallesPedido[] = [
                    'producto_id' => $productoId,
                    'cantidad' => $item['cantidad'],
                    'precioUnitario' => $item['precioUnitario'],
                ];
            }

            // Crear pedido
            $pedido = Pedido::create([
                'cliente_id' => $userId,
                'fecha' => now()->toDateString(),
                'estado' => 'pagado',
                'total' => $total,
            ]);

            // Crear detalles y reducir stock
            foreach ($detallesPedido as $detalle) {
                $pedido->detalles()->create($detalle);

                // Reducir stock
                $producto = \App\Models\Producto::find($detalle['producto_id']);
                $producto->stock -= $detalle['cantidad'];
                $producto->save();
            }

            // Crear registro de pago
            Pago::create([
                'pedido_id' => $pedido->id,
                'monto' => $total,
                'metodoPago' => $request->metodo_pago,
                'estadoPago' => 'completado',
            ]);

            // Vaciar carrito de sesión
            session(['carrito' => []]);

            return redirect('/nota-pago/' . $pedido->id)->with('success', '¡Pago procesado correctamente!');
        } catch (\Exception $e) {
            return redirect('/checkout')->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    /**
     * Ver nota de pago/comprobante
     */
    public function notaPago($id)
    {
        $userId = session('user_id');

        $pedido = Pedido::where('id', $id)
                       ->where('cliente_id', $userId)
                       ->with('detalles.producto', 'pago')
                       ->firstOrFail();

        return view('pedidos.nota', compact('pedido'));
    }

    /**
     * Ver detalle de un pedido
     */
    public function show($id)
    {
        $userId = session('user_id');

        $pedido = Pedido::where('id', $id)
                       ->where('cliente_id', $userId)
                       ->with('detalles.producto', 'pago')
                       ->firstOrFail();

        return view('pedidos.show', compact('pedido'));
    }

    // MÉTODOS DEL PANEL ADMINISTRATIVO

    /**
     * Crear pedido (Admin)
     */
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

    /**
     * Editar pedido (Admin)
     */
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $clientes = Cliente::all();

        return view('pedidos.edit', compact('pedido', 'clientes'));
    }

    /**
     * Actualizar pedido (Admin)
     */
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

    /**
     * Eliminar pedido (Admin)
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        // Eliminar relaciones
        $pedido->detalles()->delete();
        $pedido->pago()->delete();
        $pedido->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido eliminado');
    }
}