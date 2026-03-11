@extends('layouts.app')

@section('contenido')

<h1>Bienvenido a VetRam</h1>

<h2>Productos destacados</h2>

@foreach($productos as $producto)

<div class="producto">

<h3>{{ $producto->nombre }}</h3>

<p>{{ $producto->precio }} Bs</p>

</div>

@endforeach

@endsection