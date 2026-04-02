<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    
    Categoria::factory(10)->create();
    Categoria::create(['nombre' => 'Electrónica']);
    Categoria::create(['nombre' => 'Ropa']);
    Categoria::create(['nombre' => 'Alimentos']);
}
}
