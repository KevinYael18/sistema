<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Producto;

class ProductoCreado extends Notification
{
    use Queueable;

    public $producto;

    public function __construct(Producto $producto)
    {
        $this->producto = $producto;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'mensaje' => 'Se registró el producto: ' . $this->producto->nombre,
            'producto_id' => $this->producto->id,
            'precio' => $this->producto->precio,
            'url' => url('/productos')
        ];
    }

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
 
}