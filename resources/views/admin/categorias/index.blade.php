@extends('layouts.app')

@section('contenido')

<h1>Categorías</h1>

<a href="/admin/categorias/create">Nueva Categoría</a>

<table border="1">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Acciones</th>
</tr>

@foreach($categorias as $categoria)

<tr>

<td>{{ $categoria->id }}</td>

<td>{{ $categoria->nombre }}</td>

<td>

<a href="/admin/categorias/{{ $categoria->id }}/edit">Editar</a>

<form action="/admin/categorias/{{ $categoria->id }}" method="POST" style="display:inline">

@csrf
@method('DELETE')

<button type="submit">Eliminar</button>

</form>

</td>

</tr>

@endforeach

</table>

@endsection