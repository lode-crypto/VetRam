@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
}

/* CONTENEDOR */
.product-container {
    max-width: 900px;
    margin: 40px auto;
    background: #1e293b;
    padding: 25px;
    border-radius: 16px;
    border: 1px solid #334155;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

/* IMAGEN */
.product-img {
    width: 100%;
    max-height: 300px;
    object-fit: contain;
    background: #fff;
    border-radius: 10px;
    padding: 10px;
}

/* INFO */
.product-info h1 {
    color: #facc15;
    margin-bottom: 15px;
}

.product-info p {
    margin-bottom: 10px;
    color: #cbd5e1;
}

/* PRECIO */
.precio {
    font-size: 28px;
    color: #22c55e;
    font-weight: bold;
    margin: 15px 0;
}

/* STOCK */
.stock-ok {
    color: #22c55e;
}

.stock-no {
    color: #ef4444;
}

/* FORM */
.form-carrito {
    margin-top: 20px;
}

.form-carrito input {
    padding: 8px;
    width: 80px;
    border-radius: 6px;
    border: none;
    margin-right: 10px;
}

/* BOTÓN */
.btn-carrito {
    background: #facc15;
    color: #000;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

.btn-carrito:hover {
    background: #eab308;
}

/* ALERTA */
.alerta {
    background: #7f1d1d;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

/* VOLVER */
.back-link {
    display: inline-block;
    margin-top: 25px;
    background: #facc15;
    color: #000;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
}

.back-link:hover {
    background: #eab308;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .product-container {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="product-container">

    <!-- IMAGEN -->
    <div>
        @if($producto->imagen)
            <img src="{{ asset('storage/imagenesdeproductos/' . $producto->imagen) }}" class="product-img" alt="{{ $producto->nombre }}">
        @endif
    </div>

    <!-- INFO -->
    <div class="product-info">

        <h1>{{ $producto->nombre }}</h1>

        <p><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>

        <p><strong>Descripción:</strong></p>
        <p>{{ $producto->descripcion }}</p>

        <div class="precio">{{ $producto->precio }} Bs</div>

        <p><strong>Stock:</strong>
            @if($producto->stock > 0)
                <span class="stock-ok">✓ {{ $producto->stock }} disponibles</span>
            @else
                <span class="stock-no">✗ Agotado</span>
            @endif
        </p>

        @if($producto->stock > 0)
            <form action="/carrito/agregar" method="POST" class="form-carrito">
                @csrf
                <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                <label>Cantidad:</label>
                <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}">

                <button type="submit" class="btn-carrito">
                    Agregar al carrito
                </button>
            </form>
        @else
            <div class="alerta">
                 Este producto no está disponible en este momento
            </div>
        @endif

        <a href="/productos" class="back-link">
            ← Volver al catálogo
        </a>

    </div>

</div>

@endsection