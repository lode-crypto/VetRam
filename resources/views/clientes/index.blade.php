@extends('layouts.app')

@section('contenido')
    <h1>Clientes</h1>

    @isset($clientes)
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; max-width:800px; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefono }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay clientes para mostrar.</p>
    @endisset

    <p><a href="{{ route('clientes.create') }}">Crear nuevo cliente</a></p>
@endsection
