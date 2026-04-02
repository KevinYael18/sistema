<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->words(3, true),
            'descripcion' => $this->faker->paragraph(2),
            'precio' => $this->faker->randomFloat(2, 10, 5000),
            'stock' => $this->faker->numberBetween(0, 200),
            'categoria_id' => Categoria::factory(),
        ];
    }
}