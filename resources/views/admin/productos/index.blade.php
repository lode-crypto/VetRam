@extends('layouts.app')

@section('contenido')

<div class="page">

    <div class="top-actions">
        <h1>Lista de Productos</h1>

        <a class="create-link" href="{{ route('productos.create') }}">
            Agregar Producto
        </a>
    </div>

    <div class="cards-grid">

        @foreach($productos as $producto)

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
                <span>Precio: {{ $producto->precio }} $</span>
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

    </div>

</div>

@endsection