@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
}

/* CONTENEDOR */
.page {
    padding: 30px;
}

/* TOP */
.top-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.top-actions h1 {
    border: 2px solid #facc15;
    padding: 10px 30px;
}

/* BOTÓN CREAR */
.create-link {
    background: #facc15;
    color: #000;
    padding: 10px 20px;
    text-decoration: none;
    font-weight: bold;
}

.create-link:hover {
    background: #eab308;
}

/* GRID */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 25px;
}

/* CATEGORÍA HEADER */
.categoria-header {
    padding: 25px 20px;
    border-bottom: 3px solid #facc15;
    margin-bottom: 25px;
    margin-top: 40px;
    grid-column: 1 / -1;
    background: transparent;
}

.categoria-header h2 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
    color: #facc15;
    letter-spacing: 0.5px;
}

.categoria-header p {
    display: none;
}

/* CARD */
.ram-card {
    background: #dcdcdc;
    color: #000;
    border: 2px solid #000;
    padding: 12px;
    text-align: center;
    transition: 0.3s;
}

.ram-card:hover {
    transform: scale(1.04);
}

/* IMAGEN */
.ram-img-wrap {
    border: 1px solid #000;
    background: #fff;
    padding: 5px;
    margin-bottom: 10px;
}

.ram-img {
    width: 100%;
    height: 110px;
    object-fit: contain;
}

/* LABEL */
.ram-label {
    font-weight: bold;
    margin-bottom: 5px;
}

/* NOMBRE */
.ram-name {
    font-size: 14px;
    margin-bottom: 8px;
}

/* META */
.ram-meta {
    font-size: 12px;
    margin-bottom: 10px;
}

.ram-meta span {
    display: block;
}

/* ACCIONES */
.ram-actions {
    display: flex;
    justify-content: center;
    gap: 5px;
}

/* BOTONES */
.btn-link {
    font-size: 12px;
    padding: 4px 8px;
    border: 1px solid #000;
    background: #fff;
    cursor: pointer;
    text-decoration: none;
    color: #000;
}

.btn-edit {
    border-color: orange;
}

.btn-delete {
    border-color: red;
    color: red;
}
</style>

<div class="page">

    <div class="top-actions">
        <h1>Lista de Productos</h1>

        <a class="create-link" href="{{ route('productos.create') }}">
            Agregar Producto
        </a>
    </div>

    <div class="cards-grid">

        @forelse($productos as $categoria => $productosPorCategoria)

            <!-- ENCABEZADO DE CATEGORÍA -->
            <div class="categoria-header">
                <h2>{{ $categoria }}</h2>
            </div>

            <!-- PRODUCTOS DE LA CATEGORÍA -->
            @foreach($productosPorCategoria as $producto)

            <article class="ram-card">

                <div class="ram-img-wrap">
                    <img class="ram-img"
                         src="{{ asset('storage/imagenesdeproductos/'.$producto->imagen) }}"
                         alt="{{ $producto->nombre }}">
                </div>

                <div class="ram-label">RAM</div>

                <div class="ram-name">
                    {{ $producto->nombre }}
                </div>

                <div class="ram-meta">
                    <span>Precio: {{ $producto->precio }} Bs</span>
                    <span>Stock: {{ $producto->stock }}</span>
                </div>

                <div class="ram-actions">

                    <a class="btn-link btn-edit"
                       href="{{ route('productos.edit',$producto->id) }}">
                        Editar
                    </a>

                    <form action="{{ route('productos.destroy',$producto->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn-link btn-delete" type="submit">
                            Eliminar
                        </button>
                    </form>

                </div>

            </article>

            @endforeach

        @empty

            <div style="grid-column: 1 / -1; text-align: center; padding: 50px 20px; color: #666;">
                <h3>No hay productos registrados</h3>
                <p>Comienza agregando productos a tu tienda</p>
            </div>

        @endforelse

    </div>

</div>

@endsection