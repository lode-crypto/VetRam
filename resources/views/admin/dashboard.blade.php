@extends('layouts.app')

@section('contenido')
<div style="max-width: 1000px; margin: 0 auto;">
    <h1 style="text-align: center; color: #333; margin-bottom: 40px;">Panel Administrador</h1>
    
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
            <h3 style="margin-top: 0; color: #333;">📦 Productos</h3>
            <p>Administra los productos de la tienda</p>
            <a href="/admin/productos" style="display: inline-block; background-color: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">Ir a Productos</a>
        </div>
        
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
            <h3 style="margin-top: 0; color: #333;">📂 Categorías</h3>
            <p>Administra las categorías de productos</p>
            <a href="/admin/categorias" style="display: inline-block; background-color: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">Ir a Categorías</a>
        </div>
    </div>
</div>
@endsection