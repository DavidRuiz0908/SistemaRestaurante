<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['mesa', 'estado', 'total'];
    // Un pedido TIENE MUCHOS ítems (platillos individuales)
    public function items()
    {
        return $this->hasMany(PedidoItem::class);
    }
}