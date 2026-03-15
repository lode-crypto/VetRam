@extends('layouts.app')

@section('contenido')
    <h1>Checkout</h1>

    <h2>Resumen del pedido</h2>
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; max-width:800px; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->precio }} Bs</td>
                    <td>{{ $detalle->cantidad * $detalle->precio }} Bs</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total: {{ $pedido->total }} Bs</strong></p>

    <h2>Información de pago</h2>
    <form action="/checkout" method="POST">
        @csrf
        <label for="metodo_pago">Método de pago:</label>
        <select name="metodo_pago" id="metodo_pago">
            <option value="tarjeta">Tarjeta de crédito</option>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia bancaria</option>
        </select><br><br>

        <button type="submit">Confirmar pago</button>
    </form>

    <p><a href="/carrito">Volver al carrito</a></p>
@endsection