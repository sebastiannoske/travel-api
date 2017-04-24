<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class ConfirmTravel extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pw;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $pw)
    {
        $this->user = $user;
        $this->pw = $pw;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirm');
    }
}
