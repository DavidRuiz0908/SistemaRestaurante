<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre'];
    // Esta es la relación: Una categoría TIENE MUCHOS platillos
    public function platillos()
    {
        return $this->hasMany(Platillo::class);
    }
}