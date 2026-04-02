<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;

class BuscadorProductos extends Component
{
    public string $busqueda = '';

    public function render()
    {
        $productos = Producto::when($this->busqueda, function ($q) {
            $q->where('nombre', 'LIKE', '%' . $this->busqueda . '%');
        })->limit(10)->get();

        return view('livewire.buscador-productos', [
            'productos' => $productos
        ]);
    }
}