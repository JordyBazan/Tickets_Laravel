<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketAssignedNotification extends Mailable
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
            subject: '🛠️ Nueva Tarea Asignada: OT #' . $this->ticket->ticket_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket_assigned',
        );
    }
}