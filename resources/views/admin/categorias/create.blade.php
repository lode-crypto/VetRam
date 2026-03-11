@extends('layouts.app')

@section('contenido')

<h1>Nueva Categoría</h1>

<form action="/admin/categorias" method="POST">

@csrf

<label>Nombre</label>

<input type="text" name="nombre">

<button type="submit">Guardar</button>

</form>

@endsection