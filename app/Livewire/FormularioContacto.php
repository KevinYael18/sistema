<?php

namespace App\Livewire;

use Livewire\Component;

class FormularioContacto extends Component
{
    public string $nombre = '';
    public string $email = '';
    public string $mensaje = '';
    public bool $enviado = false;

    protected $rules = [
        'nombre' => 'required|min:3',
        'email' => 'required|email',
        'mensaje' => 'required|min:10',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function enviar()
    {
        $this->validate();

        $this->reset(['nombre', 'email', 'mensaje']);
        $this->enviado = true;
    }

    public function render()
    {
        return view('livewire.formulario-contacto');
    }
}