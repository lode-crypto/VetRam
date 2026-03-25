@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

.receipt-container {
    max-width: 900px;
    margin: 30px auto;
    padding: 20px;
}

.receipt {
    background: #1e293b;
    border-radius: 16px;
    padding: 25px;
    border: 1px solid #334155;
}

.success-header {
    text-align: center;
    border-bottom: 2px solid #38bdf8;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.success-header h1 {
    color: #38bdf8;
    margin: 0;
}

.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

.box {
    background: #0f172a;
    padding: 15px;
    border-radius: 10px;
}

.box h3 {
    margin-bottom: 10px;
    color: #facc15;
}

.table {
    width: 100%;
    border-collapse: collapse;
    background: #0f172a;
    border-radius: 10px;
    overflow: hidden;
}

.table thead {
    background: #334155;
}

.table th, .table td {
    padding: 10px;
    border-top: 1px solid #475569;
}

.total {
    text-align: right;
    margin-top: 15px;
    font-size: 1.2rem;
    color: #facc15;
}

.payment {
    background: #022c22;
    border-left: 4px solid #38bdf8;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.warning {
    background: #78350f;
    border-left: 4px solid #facc15;
    padding: 15px;
    border-radius: 8px;
}

.shipping {
    background: #0c4a6e;
    border-left: 4px solid #3b82f6;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.footer {
    text-align: center;
    margin-top: 20px;
    font-size: 12px;
    color: #94a3b8;
}

.actions {
    text-align: center;
    margin-top: 20px;
}

.btn {
    padding: 10px 20px;
    background: #facc15;
    color: #000;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
}

.btn:hover {
    background: #eab308;
}

@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="receipt-container">
    <div class="receipt">
        <div class="success-header">
            <h1>Pedido #{{ $pedido->id }}</h1>
            <p>Fecha: {{ $pedido->fecha }} | Estado: {{ ucfirst($pedido->estado) }}</p>
        </div>

        <div class="grid">
            <div class="box">
                <h3>Cliente</h3>
                <p>{{ $pedido->cliente->nombre }}</p>
                <p>{{ $pedido->cliente->email }}</p>
                <p>{{ $pedido->cliente->telefono }}</p>
            </div>
            <div class="box">
                <h3>Pago</h3>
                <p>Método: {{ $pedido->pago?->metodoPago ?? 'No definido' }}</p>
                <p>Estado: {{ $pedido->pago?->estadoPago ?? 'Pendiente' }}</p>
                <p>Monto: {{ number_format($pedido->total, 2) }} Bs</p>
            </div>
        </div>

        <h3 style="color:#facc15;">Detalle del pedido</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->precioUnitario, 2) }} Bs</td>
                    <td>{{ number_format($detalle->cantidad * $detalle->precioUnitario, 2) }} Bs</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total: {{ number_format($pedido->total, 2) }} Bs
        </div>

        <div class="shipping">
            <strong>Dirección de envío:</strong>
            <p>{{ $pedido->cliente->direccionEnvio }}</p>
        </div>

        <div class="footer">
            <p>Gracias por tu compra.</p>
            <p>Contacto: contacto@vetram.com</p>
        </div>
    </div>

    <div class="actions">
        <a href="/mis-pedidos" class="btn">Volver a Mis Pedidos</a>
    </div>
</div>

@endsection