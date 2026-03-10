<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
</head>
<body>

<h1>Lista de Productos</h1>

<a href="{{ route('productos.create') }}">Crear Nuevo Producto</a>

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

    @foreach($productos as $producto)
    <tr>
        <td>{{ $producto->id }}</td>
        <td>{{ $producto->nombre }}</td>
        <td>{{ $producto->precio }}</td>
        <td>{{ $producto->stock }}</td>
        <td>{{ $producto->categoria->nombre }}</td>
        <td>
            <a href="{{ route('productos.edit', $producto->id) }}">Editar</a>

            <form action="{{ route('productos.destroy', $producto->id) }}" 
                  method="POST" 
                  style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>