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
.form-container {
    background: #1e293b;
    padding: 2rem;
    border-radius: 16px;
    width: 100%;
    max-width: 500px;
    border: 1px solid #334155;
    box-shadow: 0 15px 35px rgba(0,0,0,0.5);
}

/* TITULO */
.form-container h1 {
    text-align: center;
    color: #facc15;
    margin-bottom: 20px;
}

/* LABEL */
label {
    display: block;
    margin-top: 10px;
    margin-bottom: 5px;
    color: #cbd5e1;
}

/* INPUTS */
input, textarea, select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 2px solid #475569;
    background: #0f172a;
    color: #fff;
    margin-bottom: 10px;
}

/* FOCUS */
input:focus, textarea:focus, select:focus {
    outline: none;
    border-color: #facc15;
    box-shadow: 0 0 0 3px rgba(250,204,21,0.2);
}

/* TEXTAREA */
textarea {
    resize: none;
    height: 80px;
}

/* IMAGEN ACTUAL */
.current-img {
    display: block;
    margin: 10px auto;
    border: 2px solid #475569;
    border-radius: 8px;
    background: #fff;
    padding: 5px;
    max-width: 120px;
}

/* TEXTO IMAGEN */
.img-label {
    text-align: center;
    font-size: 13px;
    color: #cbd5e1;
}

/* BOTÓN */
button {
    width: 100%;
    padding: 12px;
    background: #facc15;
    color: #0f172a;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    margin-top: 10px;
    cursor: pointer;
}

button:hover {
    background: #eab308;
}

/* LINK */
.back-link {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #facc15;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}
</style>

<div class="form-page">
    <div class="form-container">

    <h1>Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required>

        <label>Descripción</label>
        <textarea name="descripcion" required>{{ $producto->descripcion }}</textarea>

        <label>Precio</label>
        <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>

        <label>Stock</label>
        <input type="number" name="stock" value="{{ $producto->stock }}" required>

        <label>Categoría</label>
        <select name="categoria_id" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>

        <label>Imagen (opcional)</label>
        <input type="file" name="imagen" accept="image/*">

        @if($producto->imagen)
            <p class="img-label">Imagen actual:</p>
            <img src="{{ asset('storage/imagenesdeproductos/' . $producto->imagen) }}" class="current-img" alt="Imagen actual">
        @endif

        <button type="submit">Actualizar Producto</button>
    </form>

    <a href="{{ route('productos.index') }}" class="back-link">
        ← Volver a la lista
    </a>
    </div>
</div>

@endsection