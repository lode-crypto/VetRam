@extends('layouts.app')

@section('contenido')
    <h1>Mi Carrito</h1>

    @if($pedido && $pedido->detalles->count() > 0)
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; max-width:800px; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ $detalle->precio }} Bs</td>
                        <td>{{ $detalle->cantidad * $detalle->precio }} Bs</td>
                        <td>
                            <form action="/carrito/eliminar/{{ $detalle->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Total: {{ $pedido->total }} Bs</strong></p>
        <a href="/checkout">Proceder al pago</a>
    @else
        <p>Tu carrito está vacío.</p>
    @endif

    <p><a href="/productos">Continuar comprando</a></p>
@endsection
