<!DOCTYPE html>
<html>
<head>

    <title>VetRam</title>

    <style>

    body{
        font-family: Arial;
        margin:0;
        background:#f5f5f5;
    }

    nav{
        background:#111;
        padding:15px;
    }

    nav a{
        color:white;
        margin-right:20px;
        text-decoration:none;
        font-weight:bold;
    }

    .container{
        width:90%;
        margin:auto;
        padding:20px;
    }

    .producto{
        background:white;
        padding:15px;
        margin:10px;
        display:inline-block;
        width:200px;
        border-radius:5px;
        box-shadow:0px 0px 5px #ccc;
    }

    </style>

</head>

<body>

<nav>

<a href="/">Inicio</a>

<a href="/productos">Productos</a>

<a href="/carrito">Carrito</a>

<a href="/admin/productos">Admin</a>

</nav>

<div class="container">

@yield('contenido')

</div>

</body>

</html>