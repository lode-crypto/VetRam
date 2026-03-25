@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
}

/* TITULO PRINCIPAL */
h1 {
    text-align: center;
    margin: 30px 0;
    font-size: 2.5rem;
    color: #facc15;
}

/* SUBTITULO */
.titulo-seccion {
    margin: 20px;
    border-left: 5px solid #facc15;
    padding-left: 10px;
}

/* GRID */
.productos-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
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
    transform: scale(1.04);
}

/* IMAGEN */
.producto img {
    width: 100%;
    height: 120px;
    object-fit: contain;
    background: #fff;
    border: 1px solid #000;
    margin-bottom: 10px;
}

/* NOMBRE */
.producto h3 {
    font-size: 15px;
    margin-bottom: 5px;
}

/* DESCRIPCIÓN */
.producto p {
    font-size: 13px;
}

/* PRECIO */
.precio {
    font-weight: bold;
    margin: 5px 0;
}

/* BOTÓN */
.producto a {
    display: inline-block;
    margin-top: 8px;
    padding: 6px 12px;
    background: #facc15;
    color: #000;
    text-decoration: none;
    font-size: 12px;
    border: 1px solid #000;
}

.producto a:hover {
    background: #eab308;
}

/* BOTÓN VER TODO */
.ver-todos {
    text-align: center;
    margin: 30px 0;
}

.ver-todos a {
    background: #facc15;
    color: #000;
    padding: 12px 30px;
    text-decoration: none;
    font-weight: bold;
}

.ver-todos a:hover {
    background: #eab308;
}
.features {
    text-align: center;
    font-size: 1.2rem;
    color: #cbd5e1;
    margin-bottom: 30px;
}

</style>

<h1>Bienvenido a VetRam</h1>

<div class="features">
Potencia tu PC al máximo 🚀<br><br>
Rendimiento extremo, velocidad superior y estabilidad total para gamers,
edición y multitarea sin límites.
</div>

<h2 class="titulo-seccion">Productos destacados</h2>

<div class="productos-container">

@foreach($productos as $producto)

<div class="producto">
    @if($producto->imagen)
        <img src="{{ asset('storage/imagenesdeproductos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
    @endif

    <h3>{{ $producto->nombre }}</h3>

    @if($producto->descripcion)
        <p>{{ substr($producto->descripcion, 0, 100) }}{{ strlen($producto->descripcion) > 100 ? '...' : '' }}</p>
    @endif

    <p class="precio">{{ $producto->precio }} Bs</p>

    @if($producto->stock > 0)
        <p style="color: green; font-size: 12px;">✓ En stock ({{ $producto->stock }})</p>
    @else
        <p style="color: red; font-size: 12px;">✗ Agotado</p>
    @endif

    <a href="/producto/{{ $producto->id }}">Ver producto</a>
</div>

@endforeach

</div>

<div class="ver-todos">
    <a href="/productos">Ver todos los productos</a>
</div>

@endsection