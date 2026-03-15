@extends('layouts.app')

@section('contenido')
    <h1>Crear cuenta</h1>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Nombre</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <label>Confirmar contraseña</label>
        <input type="password" name="password_confirmation" required>

        <label>Teléfono</label>
        <input type="text" name="telefono" value="{{ old('telefono') }}" required>

        <label>Dirección</label>
        <input type="text" name="direccion" value="{{ old('direccion') }}" required>

        <button type="submit">Registrar</button>
    </form>

    <p>
        ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
    </p>
@endsection
