<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address; // ✅ EKLENDİ
use Illuminate\Queue\SerializesModels;

class RegistrationAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('ogulmuhammetfatih@gmail.com', 'Munich EXPO'),
            subject: 'New Registration Received – Munich EXPO',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
