<?php

use Illuminate\Database\Seeder;
use App\Models\Participant;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Participant::class, 10)->create();
    }
}
