@extends('layouts.app')

@section('contenido')
    <h1>Pagos</h1>

    @isset($pagos)
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; max-width:800px; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Monto</th>
                    <th>Método</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagos as $pago)
                    <tr>
                        <td>{{ $pago->id }}</td>
                        <td>{{ $pago->pedido?->id }}</td>
                        <td>{{ $pago->monto }}</td>
                        <td>{{ $pago->metodoPago }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay pagos para mostrar.</p>
    @endisset

    <p><a href="{{ route('pagos.create') }}">Registrar pago</a></p>
@endsection
