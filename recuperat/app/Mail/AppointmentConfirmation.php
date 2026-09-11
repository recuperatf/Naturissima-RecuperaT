<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env("MAIL_USERNAME","no-reply-recuperatf@recuperat.com"))->subject("Nueva cita a las ". $this->appointment->appoinment_date. " en ". ($this->appointment->clinic ? $this->appointment->clinic->name : 'No especificado'))
        ->view('email.confirmation_for_admin')->
        with('appointment', $this->appointment);
    }
}
