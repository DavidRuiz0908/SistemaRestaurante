<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $fillable = ['pedido_id', 'platillo_id', 'cantidad', 'subtotal'];
    public function platillo()
    {
        return $this->belongsTo(Platillo::class);
    }
}
