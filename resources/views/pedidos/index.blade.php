@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

.pedidos-container {
    max-width: 1100px;
    margin: 30px auto;
    padding: 20px;
}

.pedidos-title {
    text-align: center;
    color: #facc15;
    margin-bottom: 20px;
}

.pedidos-table {
    width: 100%;
    border-collapse: collapse;
    background: #1e293b;
    border-radius: 10px;
    overflow: hidden;
}

.pedidos-table th,
.pedidos-table td {
    padding: 12px;
    border-bottom: 1px solid #475569;
    text-align: center;
}

.pedidos-table thead {
    background: #334155;
}

.pedidos-table th {
    color: #facc15;
}

.pedidos-table td {
    color: #cbd5e1;
}

.status-pill {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 0.85em;
    font-weight: bold;
}

.status-pagado { background: #16a34a; color: #dcfce7; }
.status-procesando { background: #fbbf24; color: #78350f; }
.status-cancelado { background: #ef4444; color: #fee2e2; }

.link-accion {
    display: inline-block;
    padding: 6px 12px;
    background: #3b82f6;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    transition: background 0.2s;
}

.link-accion:hover { background: #2563eb; }

.empty {
    text-align: center;
    color: #94a3b8;
    margin-top: 30px;
}
</style>

<div class="pedidos-container">
    <h1 class="pedidos-title">Mis Pedidos</h1>

    @if(session('success'))
        <div style="background: #14532d; color: #bbf7d0; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #7f1d1d; color: #fecaca; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    @if($pedidos->isEmpty())
        <p class="empty">No tienes pedidos todavía. Agrega productos al carrito y realiza el checkout.</p>
    @else
        <table class="pedidos-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Método de Pago</th>
                    <th>Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td>#{{ $pedido->id }}</td>
                    <td>{{ $pedido->fecha }}</td>
                    <td>
                        @php
                            $state = strtolower($pedido->estado);
                        @endphp
                        <span class="status-pill status-{{ $state }}">{{ ucfirst($pedido->estado) }}</span>
                    </td>
                    <td>{{ number_format($pedido->total, 2) }} Bs</td>
                    <td>{{ $pedido->pago?->metodoPago ?? 'No definido' }}</td>
                    <td>{{ $pedido->pago?->estadoPago ?? 'Pendiente' }}</td>
                    <td>
                        @if($pedido->pago)
                        <a href="{{ route('nota-pago', ['id' => $pedido->id]) }}" class="link-accion" style="margin-left:8px;">Nota de pago</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection