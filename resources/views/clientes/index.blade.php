@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

/* CONTENEDOR */
.clientes-container {
    max-width: 900px;
    margin: 30px auto;
    padding: 20px;
}

/* TITULO */
.clientes-container h1 {
    text-align: center;
    color: #facc15;
    margin-bottom: 20px;
}

/* ALERTA */
.alert-success {
    background: #14532d;
    color: #bbf7d0;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 8px;
}

/* TABLA */
.clientes-table {
    width: 100%;
    border-collapse: collapse;
    background: #1e293b;
    border-radius: 10px;
    overflow: hidden;
}

.clientes-table thead {
    background: #334155;
}

.clientes-table th,
.clientes-table td {
    padding: 12px;
    border-top: 1px solid #475569;
}

.clientes-table td {
    color: #cbd5e1;
}

/* ACCIONES */
.actions {
    display: flex;
    gap: 8px;
}

/* BOTONES */
.btn {
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 12px;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-edit {
    background: #3b82f6;
    color: #fff;
}

.btn-delete {
    background: #ef4444;
    color: #fff;
}

/* BOTON CREAR */
.create-btn {
    display: inline-block;
    margin-top: 20px;
    background: #facc15;
    color: #000;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
}

.create-btn:hover {
    background: #eab308;
}

/* VACIO */
.empty {
    text-align: center;
    margin-top: 20px;
}
</style>

<div class="clientes-container">

    <h1>Clientes</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @isset($clientes)

        <table class="clientes-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccionEnvio }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-edit">
                                Editar
                            </a>

                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-delete" onclick="return confirm('¿Eliminar cliente?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p class="empty">No hay clientes para mostrar.</p>
    @endisset

    <div style="text-align:center;">
    </div>

</div>

@endsection