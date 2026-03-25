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
    max-width: 600px;
    margin: 50px auto;
    padding: 30px;
    background: #1e293b;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}

/* TITULO */
.form-container h1 {
    text-align: center;
    color: #facc15;
    margin-bottom: 30px;
}

/* ALERTA */
.alert-success {
    background: #14532d;
    color: #bbf7d0;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 8px;
}

.alert-error {
    background: #7f1d1d;
    color: #fecaca;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 8px;
}

/* LABEL */
label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #cbd5e1;
}

/* SELECT */
select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 2px solid #475569;
    background: #0f172a;
    color: #fff;
    margin-bottom: 15px;
}

select:focus {
    outline: none;
    border-color: #facc15;
}

/* INPUT */
input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 2px solid #475569;
    background: #0f172a;
    color: #fff;
    margin-bottom: 15px;
}

input:focus {
    outline: none;
    border-color: #facc15;
}

/* BOTONES */
.actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn {
    flex: 1;
    padding: 12px;
    border-radius: 8px;
    border: none;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
}

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

    <h1>Editar Detalle de Pedido</h1>

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

    <form action="{{ route('detalle_pedidos.update', $detalle->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="pedido_id">Pedido</label>
        <select name="pedido_id" id="pedido_id" required>
            <option value="">Seleccionar pedido</option>
            @foreach($pedidos as $pedido)
                <option value="{{ $pedido->id }}" {{ old('pedido_id', $detalle->pedido_id) == $pedido->id ? 'selected' : '' }}>
                    Pedido #{{ $pedido->id }} - {{ $pedido->cliente?->nombre }}
                </option>
            @endforeach
        </select>

        <label for="producto_id">Producto</label>
        <select name="producto_id" id="producto_id" required>
            <option value="">Seleccionar producto</option>
            @foreach($productos as $producto)
                <option value="{{ $producto->id }}" {{ old('producto_id', $detalle->producto_id) == $producto->id ? 'selected' : '' }}>
                    {{ $producto->nombre }} - {{ number_format($producto->precio, 2) }} Bs
                </option>
            @endforeach
        </select>

        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $detalle->cantidad) }}" min="1" required>

        <div class="actions">
            <button type="submit" class="btn btn-save">
                Actualizar Detalle
            </button>

            <a href="{{ route('detalle_pedidos.index') }}" class="btn btn-cancel">
                Cancelar
            </a>
        </div>

    </form>

</div>

@endsection
