<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SchoolSignupApprovalEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $school;
    private $password_reset_link;
    /**
     * Create a new message instance.
     */
    public function __construct($school, $password_reset_link)
    {
        $this->school = $school;
        $this->password_reset_link = $password_reset_link;
    }
    

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'School Signup Approval Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.signup.application-approval-mail',
            with: [
                'school' => $this->school,
                'password_reset_link' => $this->password_reset_link,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
