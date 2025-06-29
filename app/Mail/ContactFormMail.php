<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;
    public $isConfirmation;

    /**
     * Create a new message instance.
     */
    public function __construct($contactData, $isConfirmation = false)
    {
        $this->contactData = $contactData;
        $this->isConfirmation = $isConfirmation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->isConfirmation
            ? 'Thank you for contacting us - ' . \App\Models\Setting::get('site_name', 'MyBlogSite')
            : 'New Contact Form Submission - ' . \App\Models\Setting::get('site_name', 'MyBlogSite');

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = $this->isConfirmation ? 'emails.contact.confirmation' : 'emails.contact.notification';

        return new Content(
            view: $view,
            with: [
                'contactData' => $this->contactData,
                'siteName' => \App\Models\Setting::get('site_name', 'MyBlogSite'),
                'siteUrl' => url('/'),
            ],
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
