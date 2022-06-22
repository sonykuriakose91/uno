<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptjobquoteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $quote;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quote)
    {
        $this->quote = $quote;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You job quote request has been accepted.')->markdown('emails.acceptjobquoteMail')
            ->with('quote', $this->quote);
    }
}
