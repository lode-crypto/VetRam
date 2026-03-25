@extends('layouts.app')

@section('contenido')

<style>
body {
    background: linear-gradient(135deg, #0f172a 0%, #012661 100%);
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

/* CONTENEDOR */
.admin-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 20px;
}

/* TITULO */
.admin-title {
    text-align: center;
    color: #facc15;
    margin-bottom: 40px;
    font-size: 2rem;
}

/* GRID */
.admin-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

/* CARD */
.admin-card {
    background: #1e293b;
    padding: 30px;
    border-radius: 16px;
    border: 1px solid #334155;
    text-align: center;
    transition: 0.3s;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}

.admin-card:hover {
    transform: translateY(-5px);
}

/* TITULO CARD */
.admin-card h3 {
    margin-top: 0;
    color: #facc15;
}

/* TEXTO */
.admin-card p {
    color: #cbd5e1;
    margin: 15px 0;
}

/* BOTÓN */
.admin-card a {
    display: inline-block;
    background: #facc15;
    color: #0f172a;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: 0.3s;
}

.admin-card a:hover {
    background: #eab308;
}
</style>

<div class="admin-container">

    <h1 class="admin-title">Panel Administrador</h1>

    <div class="admin-grid">

        <div class="admin-card">
            <h3> Productos</h3>
            <p>Administra los productos de la tienda</p>
            <a href="/admin/productos">Ir a Productos</a>
        </div>

        <div class="admin-card">
            <h3> Categorías</h3>
            <p>Administra las categorías de productos</p>
            <a href="/admin/categorias">Ir a Categorías</a>
        </div>

        <div class="admin-card">
            <h3> Detalles de Pedidos</h3>
            <p>Administra los detalles de pedidos</p>
            <a href="/admin/detalle_pedidos">Ir a Detalles</a>
        </div>

        <div class="admin-card">
            <h3> Clientes</h3>
            <p>Administra los clientes registrados</p>
            <a href="/admin/clientes">Ir a Clientes</a>
        </div>

    </div>

</div>

@endsection