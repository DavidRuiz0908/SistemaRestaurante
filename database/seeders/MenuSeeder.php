<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Platillo;

class MenuSeeder extends Seeder
{
    
    public function run(): void
    {
        $bebida = Categoria::create(['nombre' => 'Bebidas']);
        $postre = Categoria::create(['nombre' => 'Postres']);

        Platillo::create([
            'nombre' => 'Carlota de Limón',
            'precio' => 45.00,
            'categoria_id' => $postre->id,
            'disponible' => true
        ]);

        Platillo::create([
            'nombre' => 'Agua de Horchata',
            'precio' => 25.00,
            'categoria_id' => $bebida->id,
            'disponible' => true
        ]);
    }
}
