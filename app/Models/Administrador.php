<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    public function clientes()
{
    return $this->hasMany(Cliente::class);
}
}
