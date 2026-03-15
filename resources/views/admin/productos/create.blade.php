@extends('layouts.app')

@section('contenido')
    <h1>Agregar Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Descripción</label>
        <textarea name="descripcion" required></textarea>

        <label>Precio</label>
        <input type="number" step="0.01" name="precio" required>

        <label>Stock</label>
        <input type="number" name="stock" required>

        <label>Categoría</label>
        <select name="categoria_id" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>

        <label>Imagen</label>
        <input type="file" name="imagen" accept="image/*" required>

        <button type="submit">Guardar Producto</button>
    </form>

    <p><a href="{{ route('productos.index') }}">Volver a la lista</a></p>
@endsection