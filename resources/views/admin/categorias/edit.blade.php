@extends('layouts.app')

@section('contenido')

<style>
body {
    background: linear-gradient(135deg, #0f172a 0%, #012661 100%);
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

.form-page {
    min-height: calc(100vh - 60px);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
}

/* CONTENEDOR */
.container-form {
    background: #1e293b;
    padding: 2.5rem 2rem;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    width: 100%;
    max-width: 400px;
    border: 1px solid #334155;
}

/* TITULO */
.container-form h1 {
    text-align: center;
    color: #facc15;
    margin-bottom: 2rem;
}

/* LABEL */
label {
    display: block;
    margin-bottom: 0.5rem;
    color: #cbd5e1;
}

/* INPUT */
input {
    width: 100%;
    padding: 0.9rem;
    border: 2px solid #475569;
    border-radius: 8px;
    background: #0f172a;
    color: #fff;
    margin-bottom: 1.5rem;
}

input:focus {
    outline: none;
    border-color: #facc15;
    box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.2);
}

/* BOTÓN */
button {
    width: 100%;
    padding: 1rem;
    background: #facc15;
    color: #0f172a;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #eab308;
}
</style>

<div class="form-page">
    <div class="container-form">

    <h1>Editar Categoría</h1>

    <form action="/admin/categorias/{{ $categoria->id }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $categoria->nombre }}" required>

        <button type="submit">Actualizar</button>
    </form>
    </div>
</div>

@endsection