<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PositionSeed::class);
        $this->call(UserSeed::class);
        $this->call(EventSeed::class);
        $this->call(ParticipantSeed::class);
    }
}
