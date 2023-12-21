<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments()
    {
        return [];
    }
    public function build()
    {
        return $this->subject('Verifikasi akun')
            ->view('mailTemplate');
    }
}
