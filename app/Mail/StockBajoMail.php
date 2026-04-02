<?php

namespace App\Mail;

use App\Models\Producto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockBajoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $producto;

    public function __construct(Producto $producto)
    {
        $this->producto = $producto;
    }

 public function build()
{
    return $this->subject('Alerta: Stock Bajo - ' . $this->producto->nombre)
                ->view('emails.stock-bajo')
                ->with([
                    'producto' => $this->producto
                ]);
}
}