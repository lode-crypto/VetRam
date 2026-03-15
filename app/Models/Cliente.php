<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use HasFactory, Notifiable;
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

    protected $fillable = [
        'nombre',
        'email',
        'contrasena',
        'direccionEnvio',
        'telefono',
        'administrador_id',
    ];

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
