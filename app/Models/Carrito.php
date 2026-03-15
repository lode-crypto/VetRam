<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    public function cliente()
{
    return $this->belongsTo(Cliente::class);
}
    public function productos()
{
    return $this->hasMany(Producto::class);
}

    protected $fillable = [
        'fechaCreacion',
        'cliente_id',
    ];
}
