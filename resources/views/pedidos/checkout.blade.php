@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

/* CONTENEDOR */
.checkout-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
}

/* TITULOS */
h1 {
    text-align: center;
    color: #facc15;
    margin-bottom: 30px;
}

h2 {
    color: #facc15;
    margin-bottom: 15px;
}

/* GRID */
.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

/* TABLA */
.checkout-table {
    width: 100%;
    border-collapse: collapse;
    background: #1e293b;
    border-radius: 10px;
    overflow: hidden;
}

.checkout-table thead {
    background: #334155;
}

.checkout-table th,
.checkout-table td {
    padding: 12px;
    border-top: 1px solid #475569;
}

.checkout-table td {
    color: #cbd5e1;
}

/* TOTAL */
.total-box {
    text-align: right;
    margin-top: 15px;
    font-size: 1.3rem;
    color: #facc15;
}

/* FORM */
.checkout-form {
    background: #1e293b;
    padding: 20px;
    border-radius: 10px;
}

/* INPUT */
select {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: none;
    margin-bottom: 10px;
}

/* BOTONES */
.actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.btn {
    flex: 1;
    padding: 12px;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
}

.btn-success {
    background: #22c55e;
    color: #000;
}

.btn-back {
    background: #3b82f6;
    color: #fff;
}

/* DATOS */
.user-data p {
    margin: 5px 0;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .checkout-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="checkout-container">

    <h1>Confirmación de Compra</h1>

    <div class="checkout-grid">

        <!-- RESUMEN -->
        <div>
            <h2>Resumen de tu Compra</h2>

            <table class="checkout-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>{{ number_format($producto->precioUnitario, 2) }} Bs</td>
                        <td>
                            <strong>
                                {{ number_format($producto->cantidad * $producto->precioUnitario, 2) }} Bs
                            </strong>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-box">
                Total: {{ number_format($total, 2) }} Bs
            </div>
        </div>

        <!-- FORM -->
        <div>
            <h2>Información de Pago</h2>

            <form action="/procesarPago" method="POST" class="checkout-form">
                @csrf

                <label>Método de Pago:</label>
                <select name="metodo_pago">
                    <option value="">-- Selecciona --</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="transferencia_movil">Transferencia</option>
                </select>

                @error('metodo_pago')
                    <span style="color:red;">{{ $message }}</span>
                @enderror

                <div class="user-data">
                    <p><strong>Nombre:</strong> {{ Auth::user()->nombre ?? session('user_name') }}</p>
                    <p><strong>Teléfono:</strong> (Guardado en tu perfil)</p>
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-success">
                        Confirmar Pago
                    </button>

                    <a href="/carrito" class="btn btn-back">
                        Volver
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>

@endsection