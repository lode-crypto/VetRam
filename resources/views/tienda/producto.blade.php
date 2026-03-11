<h1>{{ $producto->nombre }}</h1>

<img src="/productos/{{ $producto->imagen }}" width="200">

<p>{{ $producto->descripcion }}</p>

<p>Precio: {{ $producto->precio }} Bs</p>

<p>Stock: {{ $producto->stock }}</p>

<a href="/carrito">
Agregar al carrito
</a>