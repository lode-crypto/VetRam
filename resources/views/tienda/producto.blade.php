<h1>{{ $producto->nombre }}</h1>

<img src="{{ asset('storage/imagenesdeproductos/' . $producto->imagen) }}" width="200">

<p>{{ $producto->descripcion }}</p>

<p>Precio: {{ $producto->precio }} Bs</p>

<p>Stock: {{ $producto->stock }}</p>

<form action="/carrito/agregar" method="POST">
    @csrf
    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
    <label for="cantidad">Cantidad:</label>
    <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}">
    <button type="submit">Agregar al carrito</button>
</form>