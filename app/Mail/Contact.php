<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $user;
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type,$user,$contact)
    {
        $this->type = $type;
        $this->user = $user;
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact');
    }
}
