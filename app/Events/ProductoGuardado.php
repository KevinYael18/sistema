<?php

namespace App\Events;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductoGuardado
{
    use Dispatchable, SerializesModels;

   public $producto;
public $accion;
public $user;

public function __construct($producto, $accion, $user)
{
    $this->producto = $producto;
    $this->accion = $accion;
    $this->user = $user;
}
}