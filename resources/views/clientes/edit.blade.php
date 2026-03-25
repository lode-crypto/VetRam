@extends('layouts.app')

@section('contenido')

<style>
body {
    background: #0b0f2a;
    font-family: 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

/* CONTENEDOR */
.form-container {
    max-width: 500px;
    margin: 40px auto;
    background: #1e293b;
    padding: 25px;
    border-radius: 16px;
    border: 1px solid #334155;
}

/* TITULO */
.form-container h1 {
    text-align: center;
    color: #facc15;
    margin-bottom: 20px;
}

/* ALERTAS */
.alert-success {
    background: #14532d;
    color: #bbf7d0;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.alert-error {
    background: #7f1d1d;
    color: #fecaca;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* LABEL */
label {
    display: block;
    margin-bottom: 5px;
    color: #cbd5e1;
}

/* INPUT */
input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 2px solid #475569;
    background: #0f172a;
    color: #fff;
    margin-bottom: 10px;
}

/* FOCUS */
input:focus {
    outline: none;
    border-color: #facc15;
}

/* BOTONES */
.actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.btn {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: none;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
}

/* BOTONES */
.btn-save {
    background: #22c55e;
    color: #000;
}

.btn-cancel {
    background: #3b82f6;
    color: #fff;
}
</style>

<div class="form-container">

    <h1>Editar cliente</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $cliente->email) }}">

        <label>Teléfono</label>
        <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">

        <label>Dirección</label>
        <input type="text" name="direccionEnvio" value="{{ old('direccionEnvio', $cliente->direccionEnvio) }}">

        <div class="actions">
            <button type="submit" class="btn btn-save">
                Actualizar
            </button>

            <a href="{{ route('clientes.index') }}" class="btn btn-cancel">
                Cancelar
            </a>
        </div>

    </form>

</div>

@endsection