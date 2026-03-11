@extends('layouts.app')

@section('contenido')

<h1>Productos RAM</h1>

@foreach($productos as $producto)

<div class="producto">

<h3>{{ $producto->nombre }}</h3>

<p>{{ $producto->precio }} Bs</p>

<a href="/producto/{{ $producto->id }}">Ver producto</a>

</div>

@endforeach

@endsection