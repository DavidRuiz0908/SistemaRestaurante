<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Platillo;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoItem;

class MenuController extends Controller
{
    public function index()
    {
        // Traemos todas las categorías junto con sus platillos
        $categorias = Categoria::with('platillos')->get();
        return view('menu.index', compact('categorias'));
    }
    public function agregarAlCarrito($id)
    {
        // 1. Buscamos el platillo en la base de datos
        $platillo = Platillo::findOrFail($id);
        
        // 2. Traemos el carrito actual de la memoria (o creamos uno vacío)
        $carrito = session()->get('carrito', []);

        // 3. Si ya está en el carrito, le sumamos 1 a la cantidad
        if(isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            // Si no está, lo agregamos por primera vez
            $carrito[$id] = [
                "nombre" => $platillo->nombre,
                "cantidad" => 1,
                "precio" => $platillo->precio
            ];
        }

        // 4. Guardamos el carrito actualizado en la memoria
        session()->put('carrito', $carrito);

        // 5. Regresamos a la página del menú con un mensaje de éxito
        return redirect()->back()->with('success', '¡Agregado: ' . $platillo->nombre . '!');
    }
    public function verCarrito()
    {
        // Traemos el carrito de la memoria. Si no hay nada, trae un arreglo vacío.
        $carrito = session()->get('carrito', []);
        return view('menu.carrito', compact('carrito'));
    }
    public function confirmarPedido()
    {
        $carrito = session()->get('carrito', []);

        // Si por algún error intentan confirmar un carrito vacío, los regresamos
        if(count($carrito) == 0) {
            return redirect('/menu');
        }

        // 1. Calculamos el gran total otra vez por seguridad
        $total = 0;
        foreach($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // 2. Creamos el "Ticket" padre en la tabla pedidos
        $pedido = Pedido::create([
            'mesa' => 'Mesa 1', // Por ahora lo dejamos fijo
            'estado' => 'pendiente',
            'total' => $total
        ]);

        // 3. Recorremos el carrito para guardar cada postre/bebida en pedido_items
        foreach($carrito as $id => $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'platillo_id' => $id, // El $id es la llave del arreglo
                'cantidad' => $item['cantidad'],
                'subtotal' => $item['precio'] * $item['cantidad']
            ]);
        }

        // 4. ¡Limpiamos la mesa! Borramos el carrito de la sesión
        session()->forget('carrito');

        // 5. Redirigimos al menú con un mensaje de triunfo
        return redirect('/menu')->with('success', '¡Pedido #' . $pedido->id . ' enviado a cocina exitosamente!');
    }
}
