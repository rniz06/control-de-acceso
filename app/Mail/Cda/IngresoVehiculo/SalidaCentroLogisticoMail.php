<?php

namespace App\Mail\Cda\IngresoVehiculo;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SalidaCentroLogisticoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $saludo;

    /**
     * Create a new message instance.
     */
    public function __construct(public $vehiculo)
    {
        $hora = now()->format('H');

        if ($hora >= 6 && $hora < 12) {
            $this->saludo = 'Buenos Días';
        } elseif ($hora >= 12 && $hora < 18) {
            $this->saludo = 'Buenas Tardes';
        } else {
            $this->saludo = 'Buenas Noches';
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Centrol Logístico: Ingreso y/o Salida',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.cda.ingreso-vehiculos.salida-centro-logistico',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
