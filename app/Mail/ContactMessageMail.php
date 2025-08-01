<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Նոր հաղորդագրություն կայքից')
            ->replyTo($this->data['email'])
            ->view('emails.contact-message')
            ->with('data', $this->data);
    }
}
