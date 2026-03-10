<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function cliente()
{
    return $this->belongsTo(Cliente::class);
}
    public function detalles()
{
    return $this->hasMany(DetallePedido::class);
}
    public function pago()
{
    return $this->hasOne(Pago::class);
}
}
