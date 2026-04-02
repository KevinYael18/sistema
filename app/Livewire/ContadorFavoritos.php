<?php

namespace App\Livewire;

use Livewire\Component;

class ContadorFavoritos extends Component
{
    public int $total = 0;

    public function mount(): void
    {
        if (auth()->check()) {
            // Si NO tienes relación favoritos, deja esto en 0
            $this->total = 0;
        }
    }

    public function render()
    {
        return view('livewire.contador-favoritos');
    }
}