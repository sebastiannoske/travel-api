<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\TravelContact;

class ContactUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $fromMail;
    public $fromMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TravelContact $user, Request $request)
    {
        $this->user = $user;
        $this->fromMail = $request->email;
        $this->fromMessage = $request->description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->fromMail)->subject('Eine Nachricht von der Mitfahrzentrale')->view('emails.contact-user');
    }
}
