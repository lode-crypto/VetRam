@extends('layouts.app')

@section('contenido')

<h1>Detalle de pedidos</h1>

@if($detalles->count() > 0)

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; max-width:1000px; border-collapse: collapse; text-align:center;">

    <thead style="background:#f2f2f2;">
        <tr>
            <th>ID</th>
            <th>Pedido</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
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

                {{-- SUBTOTAL --}}
                <td>
                    {{ $detalle->cantidad * $detalle->precioUnitario }}
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

<br>

{{-- TOTAL GENERAL --}}
<h2>
    Total del carrito: {{ $total }}
</h2>

@else
    <p>No hay productos en el carrito.</p>
@endif

<br>

<a href="{{ route('detalle_pedidos.create') }}">
    ➕ Agregar detalle
</a>

@endsection