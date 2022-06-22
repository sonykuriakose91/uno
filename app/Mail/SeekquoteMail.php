<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeekquoteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $seekquote;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seekquote)
    {
        $this->seekquote = $seekquote;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Job Quote Request Received')->markdown('emails.seekquoteMail')
            ->with('seekquote', $this->seekquote);
    }
}
