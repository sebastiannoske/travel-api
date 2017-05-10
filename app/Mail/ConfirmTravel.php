<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Travel;
use App\EmailTemplate;

class ConfirmTravel extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $travel;
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Travel $travel)
    {
        $this->user = $user;
        $this->travel = $travel;
        $this->template = EmailTemplate::find(1);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mitfahrbörse: Eintrag bestätigen')->view('emails.confirm-travel');
    }
}
