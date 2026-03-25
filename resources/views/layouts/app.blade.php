<!DOCTYPE html>
<html>
<head>

    <title>VetRam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

<nav class="main-nav">
    <div class="nav-inner container">
        <a class="brand" href="/">VetRam</a>
        <div class="nav-links">
            <a href="/">Inicio</a>
            <a href="/productos">Productos</a>
            <a href="/carrito">Carrito</a>
            @if(session('user_id') && session('user_role') === 'user')
                <a href="/mis-pedidos">Mis Pedidos</a>
            @elseif(session('user_id') && session('user_role') === 'admin')
                <a href="/admin/">Panel Admin</a>
            @endif
        </div>
        <div class="nav-user">
            @if(session('user_id'))
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            @else
                <a href="{{ route('login') }}">Ingresar</a>
                <a href="{{ route('register') }}">Registrarse</a>
            @endif
        </div>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="container">
    @yield('contenido')
</div>

</body>

</html>