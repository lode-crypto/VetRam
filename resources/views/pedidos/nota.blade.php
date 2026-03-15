@extends('layouts.app')

@section('contenido')
    <h1>Nota de Pago</h1>

    <p><strong>ID del Pedido:</strong> {{ $pedido->id }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
    <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
    <p><strong>Estado:</strong> {{ $pedido->estado }}</p>

    <h2>Detalles del Pedido</h2>
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

    <h2>Información de Pago</h2>
    <p><strong>Método:</strong> {{ $pedido->pago->metodo }}</p>
    <p><strong>Monto:</strong> {{ $pedido->pago->monto }} Bs</p>
    <p><strong>Fecha de Pago:</strong> {{ $pedido->pago->fecha }}</p>

    <p>¡Gracias por tu compra!</p>
    <p><a href="/productos">Continuar comprando</a></p>
@endsection