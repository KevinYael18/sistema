<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::factory(50)->create([
            'categoria_id' => function () {
                return Categoria::inRandomOrder()->first()->id;
            },
        ]);
    }
}