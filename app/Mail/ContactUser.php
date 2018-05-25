<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\TravelContact;

class ContactUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $fromMail;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TravelContact $user, $fromMail, $message)
    {
        $this->user = $user;
        $this->fromMail = $fromMail;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromMail)->view('emails.contact-user');
    }
}
