<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    protected $fillable = ['nombre', 'precio', 'categoria_id', 'imagen', 'disponible'];

    // Relación inversa: Un platillo PERTENECE A una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
