<!DOCTYPE html>
<html>
<head>

    <title>VetRam - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .admin-layout {
            display: flex;
            min-height: calc(100vh - 60px); /* Ajustar según nav */
        }
        .admin-sidebar {
            width: 250px;
            background: #1e293b;
            color: #e2e8f0;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .admin-sidebar h3 {
            margin-bottom: 20px;
            color: #facc15;
        }
        .admin-sidebar ul {
            list-style: none;
            padding: 0;
        }
        .admin-sidebar li {
            margin-bottom: 10px;
        }
        .admin-sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 8px;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .admin-sidebar a:hover {
            background: #334155;
        }
        .admin-main {
            flex: 1;
            padding: 20px;
        }
    </style>

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

<div class="admin-layout">
    <aside class="admin-sidebar">
        <h3>Panel Administrador</h3>
        <ul>
            <li><a href="/admin/">Dashboard</a></li>
            <li><a href="{{ route('productos.index') }}">Productos</a></li>
            <li><a href="{{ route('productos.create') }}">Agregar Producto</a></li>
            <li><a href="{{ route('categorias.index') }}">Categorías</a></li>
            <li><a href="{{ route('categorias.create') }}">Crear Categoría</a></li>
            <li><a href="{{ route('detalle_pedidos.index') }}">Detalles de Pedidos</a></li>
            <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
            <li><a href="{{ route('clientes.create') }}">Crear Cliente</a></li>
        </ul>
    </aside>
    <main class="admin-main">
        @yield('contenido')
    </main>
</div>

</body>

</html>