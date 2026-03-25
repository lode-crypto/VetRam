@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
}

/* TÍTULO */
h1 {
    text-align: center;
    margin-bottom: 30px;
    border: 2px solid #facc15;
    display: inline-block;
    padding: 10px 40px;
    margin-left: 50%;
    transform: translateX(-50%);
}

/* GRID PRODUCTOS */
.productos-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    padding: 20px;
}

/* CARD */
.producto {
    background: #dcdcdc;
    color: #000;
    border: 2px solid #000;
    padding: 10px;
    text-align: center;
    transition: 0.3s;
}

.producto:hover {
    transform: scale(1.03);
}

/* IMAGEN */
.producto img {
    width: 100%;
    height: 120px;
    object-fit: contain;
    border: 1px solid #000;
    background: #fff;
    margin-bottom: 10px;
}

/* NOMBRE */
.producto h3 {
    font-size: 16px;
    margin: 5px 0;
}

/* DESCRIPCIÓN */
.producto p {
    font-size: 13px;
}

/* PRECIO */
.precio {
    font-weight: bold;
    margin-top: 5px;
}

/* BOTÓN */
.producto a {
    display: inline-block;
    margin-top: 8px;
    padding: 5px 10px;
    border: 1px solid #000;
    text-decoration: none;
    color: #000;
    background: #facc15;
    font-size: 12px;
}

.producto a:hover {
    background: #eab308;
}
</style>

<h1>Catálogo de Productos VetRam</h1>

@if($productos->count() > 0)

    @foreach($productos as $categoria => $productosPorCategoria)
    
    <div style="margin-bottom: 50px;">
        <!-- ENCABEZADO DE CATEGORÍA -->
        <div style="padding: 25px 20px; margin-bottom: 25px; border-bottom: 3px solid #facc15;">
            <h2 style="margin: 0; font-size: 28px; font-weight: 700; color: #fff; letter-spacing: 0.5px;">{{ $categoria }}</h2>
        </div>
        
        <!-- GRID DE PRODUCTOS DE LA CATEGORÍA -->
        <div class="productos-container">
            @foreach($productosPorCategoria as $producto)
            
            <div class="producto">
                @if($producto->imagen)
                    <img src="{{ asset('storage/imagenesdeproductos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                @else
                    <img src="https://via.placeholder.com/150?text=Sin+imagen" alt="{{ $producto->nombre }}">
                @endif

                <h3>{{ $producto->nombre }}</h3>

                @if($producto->descripcion)
                    <p>{{ substr($producto->descripcion, 0, 80) }}{{ strlen($producto->descripcion) > 80 ? '...' : '' }}</p>
                @endif

                <p class="precio">{{ number_format($producto->precio, 2) }} Bs</p>

                @if($producto->stock > 0)
                    <p style="color: green; font-size: 12px;">✓ {{ $producto->stock }} en stock</p>
                @else
                    <p style="color: red; font-size: 12px;">✗ Agotado</p>
                @endif

                <a href="/producto/{{ $producto->id }}">Ver detalles</a>
            </div>

            @endforeach
        </div>
    </div>

    @endforeach

@else
    <div style="text-align: center; padding: 50px 0; color: #666;">
        <h3>No hay productos disponibles</h3>
        <p>Por favor intenta más tarde</p>
    </div>
@endif

@endsection