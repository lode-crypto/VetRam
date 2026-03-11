<h1>Productos</h1>

<a href="{{ route('productos.create') }}">
Agregar Producto
</a>

<table>

<tr>
<th>Nombre</th>
<th>Precio</th>
<th>Stock</th>
<th>Acciones</th>
</tr>

@foreach($productos as $producto)

<tr>

<td>{{ $producto->nombre }}</td>

<td>{{ $producto->precio }}</td>

<td>{{ $producto->stock }}</td>

<td>

<a href="{{ route('productos.edit',$producto->id) }}">
Editar
</a>

<form action="{{ route('productos.destroy',$producto->id) }}" method="POST">

@csrf
@method('DELETE')

<button>
Eliminar
</button>

</form>

</td>

</tr>

@endforeach

</table>