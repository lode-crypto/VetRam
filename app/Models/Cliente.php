<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function carrito()
{
    return $this->hasOne(Carrito::class);
}
    public function pedidos()
{
    return $this->hasMany(Pedido::class);
}
    public function administrador()
{
    return $this->belongsTo(Administrador::class);
}
}
