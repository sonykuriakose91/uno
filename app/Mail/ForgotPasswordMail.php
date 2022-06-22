<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $reset_password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reset_password)
    {
        $this->reset_password = $reset_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password')->markdown('emails.forgotpasswordMail')
            ->with('reset_password', $this->reset_password);
    }
}
