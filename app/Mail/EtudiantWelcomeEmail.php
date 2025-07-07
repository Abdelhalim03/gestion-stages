<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EtudiantWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $etudiant;

    public function __construct($etudiant)
    {
        $this->etudiant = $etudiant;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue dans votre espace étudiant',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.etudiant-welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
