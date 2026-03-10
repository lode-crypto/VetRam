<!DOCTYPE html>
<html>
<head>
    <title>categorias</title>
</head>
<body>

<h1>Lista de Categorías</h1>

<a href="{{ route('categorias.create') }}">Crear Nueva Categoría</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Categoría</th>
        <th>Acciones</th>
    </tr>

    @foreach($categorias as $categoria)
    <tr>
        <td>{{ $categoria->id }}</td>
        <td>{{ $categoria->nombre }}</td>
        <td>{{ $categoria->precio }}</td>
        <td>{{ $categoria->stock }}</td>
        <td>{{ $categoria->categoria }}</td>
        <td>
            <a href="{{ route('categorias.edit', $categoria->id) }}">Editar</a>

            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
            </form>
        </td>
    @endforeach

</table>

</body>
</html>