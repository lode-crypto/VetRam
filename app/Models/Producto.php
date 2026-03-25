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

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'categoria_id',
    ];
}
