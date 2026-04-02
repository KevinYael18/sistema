<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ReporteListo extends Mailable
{
    public function __construct(public string $rutaArchivo) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu reporte CSV esta listo'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reporte-listo',
            with: [
                'url' => asset('storage/' . $this->rutaArchivo),
            ]
        );
    }
}