@extends('layouts.app')

@section('contenido')
    <h1>Iniciar sesión</h1>

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button type="submit">Iniciar sesión</button>
    </form>

    <p>
        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
    </p>
@endsection
