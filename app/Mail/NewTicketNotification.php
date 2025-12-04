<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewTicketNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔔 Nueva Solicitud de Mantención Recibida',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_ticket',
        );
    }
}