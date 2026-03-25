@extends('layouts.app')

@section('contenido')
    <h1>Crear cliente</h1>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 12px; margin-bottom: 20px; border-radius: 6px; border: 1px solid #a7f3d0;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 12px; margin-bottom: 20px; border-radius: 6px; border: 1px solid #fecaca;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST" style="max-width: 500px;">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="nombre" style="display: block; font-weight: bold; margin-bottom: 5px;">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="telefono" style="display: block; font-weight: bold; margin-bottom: 5px;">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="direccionEnvio" style="display: block; font-weight: bold; margin-bottom: 5px;">Dirección</label>
            <input type="text" name="direccionEnvio" id="direccionEnvio" value="{{ old('direccionEnvio') }}" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="contrasena" style="display: block; font-weight: bold; margin-bottom: 5px;">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px;">
        </div>

        <button type="submit" style="background: #38bdf8; color: #fff; padding: 10px 18px; border: none; border-radius: 5px; cursor: pointer;">Guardar cliente</button>
        <a href="{{ route('clientes.index') }}" style="margin-left: 12px; color: #1d4ed8; text-decoration: none;">Cancelar</a>
    </form>
@endsection
