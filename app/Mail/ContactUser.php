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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TravelContact $user, $fromMail)
    {
        $this->user = $user;
        $this->fromMail = $fromMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact-user');
    }
}
