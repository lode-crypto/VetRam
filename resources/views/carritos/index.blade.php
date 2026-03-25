@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

/* CONTENEDOR */
.cart-container {
    max-width: 1000px;
    margin: 30px auto;
    padding: 20px;
}

/* TITULO */
.cart-container h1 {
    text-align: center;
    color: #c5a215;
    margin-bottom: 25px;
}

/* TABLA */
.cart-table {
    width: 100%;
    border-collapse: collapse;
    background: #1e293b;
    border-radius: 10px;
    overflow: hidden;
}

/* HEAD */
.cart-table thead {
    background: #334155;
}

.cart-table th {
    padding: 12px;
    text-align: left;
}

/* FILAS */
.cart-table td {
    padding: 12px;
    border-top: 1px solid #475569;
}

/* INPUT */
.cart-table input {
    width: 60px;
    padding: 5px;
    border-radius: 5px;
    border: none;
}

/* BOTONES */
.btn {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 12px;
}

.btn-update {
    background: #22c55e;
    color: #000;
}

.btn-delete {
    background: #ef4444;
    color: #fff;
}

.btn:hover {
    opacity: 0.9;
}

/* TOTAL */
.cart-total {
    text-align: right;
    margin-top: 20px;
    font-size: 1.3rem;
    color: #facc15;
}

/* ACCIONES */
.cart-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 25px;
}

.cart-actions a,
.cart-actions button {
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: bold;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

/* BOTONES ACCIONES */
.btn-blue { background: #3b82f6; color: #fff; }
.btn-orange { background: #f59e0b; color: #000; }
.btn-green { background: #22c55e; color: #000; }

/* CARRITO VACIO */
.empty-cart {
    text-align: center;
    padding: 40px;
    background: #1e293b;
    border-radius: 10px;
}

.empty-cart a {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 25px;
    background: #facc15;
    color: #000;
    text-decoration: none;
    border-radius: 6px;
}
</style>

<div class="cart-container">
    <h1>Mi Carrito de Compras</h1>

    @if(count($productos) > 0)

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>

                    <td>
                        <form action="/carrito/actualizar/{{ $producto->id }}" method="POST" style="display:flex; gap:5px;">
                            @csrf
                            <input type="number" name="cantidad" value="{{ $producto->cantidad }}" min="1" max="999">
                            <button class="btn btn-update" type="submit">OK</button>
                        </form>
                    </td>

                    <td>{{ number_format($producto->precioUnitario, 2) }} Bs</td>

                    <td>
                        <strong>
                            {{ number_format($producto->cantidad * $producto->precioUnitario, 2) }} Bs
                        </strong>
                    </td>

                    <td>
                        <form action="/carrito/eliminar/{{ $producto->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete" onclick="return confirm('¿Eliminar producto?')">
                                X
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="cart-total">
            Total: {{ number_format($total, 2) }} Bs
        </div>

        <div class="cart-actions">
            <a href="/productos" class="btn-blue">Seguir comprando</a>

            <form action="/carrito/vaciar" method="POST">
                @csrf
                <button class="btn-orange">Vaciar</button>
            </form>

            <a href="/checkout" class="btn-green">Pagar</a>
        </div>

    @else

        <div class="empty-cart">
            <p>Tu carrito está vacío 🛒</p>
            <a href="/productos">Ir a la tienda</a>
        </div>

    @endif
</div>

@endsection