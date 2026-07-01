<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Inquiry $inquiry)
    {
        //
    }

    public function envelope(): Envelope
    {
        $subjects = [
            'contact' => 'New Contact Form Submission',
            'newsletter' => 'New Newsletter Subscriber',
            'get_started' => 'New Get Started Request',
        ];

        return new Envelope(
            subject: $subjects[$this->inquiry->type] ?? 'New Inquiry Received',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inquiry-admin-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
