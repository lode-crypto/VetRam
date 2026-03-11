@extends('layouts.app')

@section('contenido')

<h1>Editar Categoría</h1>

<form action="/admin/categorias/{{ $categoria->id }}" method="POST">

@csrf
@method('PUT')

<label>Nombre</label>

<input type="text" name="nombre" value="{{ $categoria->nombre }}">

<button type="submit">Actualizar</button>

</form>

@endsection