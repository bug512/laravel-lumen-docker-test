<?php

namespace App\Jobs;

use App\Models\Participant;
use App\Mail\CreatedParticipantMail;
use Illuminate\Support\Facades\Mail;

class CreateParticipant extends Job
{
    /**
     * @var Participant
     */
    public $participant;

    /**
     * CreateParticipant constructor.
     * @param Participant $participant
     */
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->participant->email)->send(new CreatedParticipantMail($this->participant));
    }
}
