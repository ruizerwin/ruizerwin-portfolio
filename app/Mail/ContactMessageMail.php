<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name:string,email:string,subject:string,message:string,ip?:string,recaptcha_score?:string}  $payload
     */
    public function __construct(public array $payload)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                (string) config('mail.from.address'),
                (string) config('mail.from.name')
            ),
            replyTo: [
                new Address($this->payload['email'], $this->payload['name']),
            ],
            subject: '[Portfolio Contact] ' . $this->payload['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.contact-message',
        );
    }
}
