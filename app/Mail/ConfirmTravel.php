<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Travel;

class ConfirmTravel extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $travel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Travel $travel)
    {
        $this->user = $user;
        $this->travel = $travel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirm-travel');
    }
}
