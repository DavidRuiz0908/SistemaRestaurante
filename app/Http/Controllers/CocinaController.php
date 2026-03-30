<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use Illuminate\Http\Request;

class CocinaController extends Controller
{
    public function index()
    {
        // Traemos los pedidos 'pendientes' junto con sus ítems y los datos del platillo
        // Usamos latest() para que el más nuevo salga al principio
        $pedidos = Pedido::with('items.platillo')
                         ->where('estado', 'pendiente')
                         ->latest()
                         ->get();

        return view('cocina.index', compact('pedidos'));
    }

    public function completar($id)
    {
        // Buscamos el ticket exacto
        $pedido = Pedido::findOrFail($id);
        
        // Le cambiamos el estado
        $pedido->estado = 'listo';
        
        // Guardamos el cambio en la base de datos
        $pedido->save();

        // Recargamos el tablero de la cocina
        return redirect('/cocina')->with('success', '¡Pedido #' . $id . ' despachado!');
    }
}
