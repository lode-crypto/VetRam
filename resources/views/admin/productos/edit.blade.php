@extends('layouts.app')

@section('contenido')
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

        <label>Imagen (opcional, deja vacío para mantener actual)</label>
        <input type="file" name="imagen" accept="image/*">

        @if($producto->imagen)
            <p>Imagen actual:</p>
            <img src="{{ asset('storage/imagenesdeproductos/' . $producto->imagen) }}" width="100" alt="Imagen actual">
        @endif

        <button type="submit">Actualizar Producto</button>
    </form>

    <p><a href="{{ route('productos.index') }}">Volver a la lista</a></p>
@endsection