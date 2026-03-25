@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

/* LOGO */
.titulo {
    border: 2px solid #facc15;
    padding: 10px 40px;
    font-size: 28px;
    font-weight: bold;
}

/* BOTONES */
.btn {
    padding: 10px 20px;
    border: 2px solid #facc15;
    color: #facc15;
    text-decoration: none;
}

.btn-yellow {
    background: #facc15;
    color: #000;
    border: none;
}

.btn-yellow:hover {
    background: #eab308;
}

/* GRID */
.categorias-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

/* CARD */
.categoria-card {
    background: #dcdcdc;
    color: #000;
    border: 2px solid #000;
    padding: 20px;
    text-align: center;
    transition: 0.3s;
}

.categoria-card:hover {
    transform: scale(1.05);
}

/* TITULO CARD */
.categoria-card h3 {
    margin-bottom: 10px;
}

/* INFO */
.categoria-card p {
    font-size: 13px;
    margin: 5px 0;
}

/* BOTONES INTERNOS */
.card-buttons {
    margin-top: 10px;
}

.card-buttons a,
.card-buttons button {
    font-size: 12px;
    padding: 5px 10px;
    margin: 3px;
    border: 1px solid #000;
    background: #fff;
    cursor: pointer;
}

.card-buttons a {
    text-decoration: none;
    color: #000;
}

.card-buttons button {
    color: red;
}
</style>

<div class="header">
    <div class="titulo">VENTRAM</div>

    <a href="/admin/categorias/create" class="btn btn-yellow">
        CREAR CATEGORÍA
    </a>
</div>

<h2>LISTA DE CATEGORÍAS</h2>

<div class="categorias-container">

@foreach($categorias as $categoria)

    <div class="categoria-card">

        <h3>CAT</h3>

        <p><strong>{{ $categoria->nombre }}</strong></p>

        {{-- Puedes cambiar esto si luego tienes relación productos --}}
        <p>Estado: Activa</p>

        <div class="card-buttons">

            <a href="/admin/categorias/{{ $categoria->id }}/edit">
                EDITAR
            </a>

            <form action="/admin/categorias/{{ $categoria->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">ELIMINAR</button>
            </form>

        </div>

    </div>

@endforeach

</div>

@endsection