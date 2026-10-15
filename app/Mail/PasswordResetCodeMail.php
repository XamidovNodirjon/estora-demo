<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $code,
        public string $userName = 'Foydalanuvchi',
        public int $ttlMinutes = 5
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('notifications@estora.uz', 'Estora Real Estate'),
            subject: "Parolni tiklash kodi: {$this->code} - Estora",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.password_reset_code',
        );
    }
}
