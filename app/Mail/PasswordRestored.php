<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordRestored extends Mailable
{
    use Queueable, SerializesModels;

    protected $newPassword;

    /**
     * Create a new message instance.
     *
     * @param $newPassword
     */
    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admins.password-restored')->with([
            'password' => $this->newPassword
        ]);
    }
}
