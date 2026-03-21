<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventNewsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('event_news')->insert([
            ['title' => 'EventRegister'],
            ['title' => 'EventUpdate'],
            ['title' => 'EventLocation'],
            ['title' => 'EventConfig'],
            ['title' => 'EventGameDay'],
            ['title' => 'EventGame'],
            ['title' => 'EventNewRule'],
            ['title' => 'EventAlterRule'],
            ['title' => 'EventRemoveRule'],
            ['title' => 'ParticipantAdd'],
            ['title' => 'ParticipantRemove'],
            ['title' => 'ParticipantLeft'],
            ['title' => 'ParticipantChange'],
        ]);
    }
}
