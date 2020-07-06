<?php

namespace App\Jobs;

use App\Models\Participant;
use App\Mail\UpdatedParticipantMail;
use Illuminate\Support\Facades\Mail;

class UpdateParticipant extends Job
{
    /**
     * @var Participant
     */
    public $participant;

    /**
     * UpdateParticipant constructor.
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
        Mail::to($this->participant->email)->send(new UpdatedParticipantMail($this->participant));
    }
}
