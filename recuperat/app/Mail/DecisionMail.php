<?php

namespace App\Mail;

use App\DecisionHpp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Decision;

class DecisionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Decision $decision, $hppDecisions, string $subject)
    {
        $this->decision = $decision;
        $this->subject = $subject;
        $this->hppDecisions = $hppDecisions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('decision.decision_email')
            ->from(env("MAIL_USERNAME", "no-reply-recuperatf@recuperat.com"))
            ->with("decision", $this->decision)
            ->with("hppDecisions", $this->hppDecisions)
            ->subject($this->subject);
    }
}
