<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function detalles()
{
    return $this->hasMany(DetallePedido::class);
}
    public function categoria()
{
    return $this->belongsTo(Categoria::class);
}
    public function carrito()
{
    return $this->belongsTo(Carrito::class);
}
}
