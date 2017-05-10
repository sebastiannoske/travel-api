<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\EmailTemplate;

class UserConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pw;
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $pw)
    {
        $this->user = $user;
        $this->pw = $pw;
        $this->template = EmailTemplate::find(2);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Zugangsdaten für die Mitfahrbörse')->view('emails.user-confirmed');
    }
}
