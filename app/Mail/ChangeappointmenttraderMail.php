<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeappointmenttraderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $seekquote;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($changeappointment)
    {
        $this->changeappointment = $changeappointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Appointment Status Changed')->markdown('emails.changeappointmenttraderMail')
            ->with('changeappointment', $this->changeappointment);
    }
}
