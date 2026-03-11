<h1>Agregar Producto</h1>

<form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">

@csrf

<label>Nombre</label>
<input type="text" name="nombre">

<label>Descripcion</label>
<textarea name="descripcion"></textarea>

<label>Precio</label>
<input type="number" name="precio">

<label>Stock</label>
<input type="number" name="stock">

<label>Categoria</label>

<select name="categoria_id">

@foreach($categorias as $categoria)

<option value="{{ $categoria->id }}">
{{ $categoria->nombre }}
</option>

@endforeach

</select>

<label>Imagen</label>
<input type="file" name="imagen">

<button type="submit">
Guardar Producto
</button>

</form>