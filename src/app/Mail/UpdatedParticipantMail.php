<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdatedParticipantMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The participant instance.
     *
     * @var Participant
     */
    protected $participant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.participants.update')
            ->with([
                'name' => $this->participant->name,
                'email' => $this->participant->email,
                'eventTitle' => $this->participant->event->title,
                'eventDate' => $this->participant->event->date,
                'eventCity' => $this->participant->event->city,
            ]);
    }
}
