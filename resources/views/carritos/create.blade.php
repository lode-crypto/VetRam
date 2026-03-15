@extends('layouts.app')

@section('contenido')
    <h1>Crear carrito</h1>

    <form action="{{ route('carritos.store') }}" method="POST">
        @csrf

        <label>Fecha de creación</label>
        <input type="date" name="fechaCreacion" required>

        <button type="submit">Crear carrito</button>
    </form>

    <p><a href="{{ route('carritos.index') }}">Volver a la lista de carritos</a></p>
@endsection
