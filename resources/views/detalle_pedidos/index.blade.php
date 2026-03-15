@extends('layouts.app')

@section('contenido')
    <h1>Detalle de pedidos</h1>

    @isset($detalles)
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; max-width:900px; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->id }}</td>
                        <td>{{ $detalle->pedido?->id }}</td>
                        <td>{{ $detalle->producto?->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ $detalle->precioUnitario }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay detalles de pedidos para mostrar.</p>
    @endisset

    <p><a href="{{ route('detalle_pedidos.create') }}">Agregar detalle</a></p>
@endsection
