<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookappointmentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $seekquote;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bookappointment)
    {
        $this->bookappointment = $bookappointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Appointment Request Received')->markdown('emails.bookappointmentMail')
            ->with('bookappointment', $this->bookappointment);
    }
}
