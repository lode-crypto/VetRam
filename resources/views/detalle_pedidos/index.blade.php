@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

/* CONTENEDOR */
.detalles-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
}

/* TITULO */
.detalles-container h1 {
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
.detalles-table {
    width: 100%;
    border-collapse: collapse;
    background: #1e293b;
    border-radius: 10px;
    overflow: hidden;
}

.detalles-table thead {
    background: #334155;
}

.detalles-table th,
.detalles-table td {
    padding: 12px;
    border-bottom: 1px solid #475569;
}

.detalles-table td {
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

/* TOTAL */
.total {
    text-align: center;
    margin-top: 20px;
    font-size: 1.5em;
    color: #facc15;
}
</style>

<div class="detalles-container">

    <h1>Detalles de Pedidos</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($detalles->count() > 0)

        <table class="detalles-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Pedido ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->id }}</td>
                    <td>{{ $detalle->pedido?->cliente?->nombre ?? 'Cliente no encontrado' }}</td>
                    <td>{{ $detalle->pedido_id ?? 'N/A' }}</td>
                    <td>{{ $detalle->producto?->nombre ?? 'Producto eliminado' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->precioUnitario, 2) }} Bs</td>
                    <td>{{ number_format($detalle->cantidad * $detalle->precioUnitario, 2) }} Bs</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('detalle_pedidos.edit', $detalle->id) }}" class="btn btn-edit">
                                Editar
                            </a>

                            <form action="{{ route('detalle_pedidos.destroy', $detalle->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-delete" onclick="return confirm('¿Eliminar detalle?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <div class="total">
            Total general: {{ number_format($total, 2) }} Bs
        </div>

    @else
        <p class="empty">No hay detalles de pedidos registrados. <a href="{{ route('detalle_pedidos.create') }}" class="create-btn">Crear uno</a></p>
    @endif

</div>

@endsection