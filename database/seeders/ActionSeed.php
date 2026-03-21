<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actions')->insert([
            ['title' => 'Goal', 'description' => '', 'score' => 5.0],
            ['title' => 'Assist', 'description' => '', 'score' => 5.0],
            ['title' => 'Defense', 'description' => '', 'score' => 5.0],
            ['title' => 'Penalty', 'description' => '', 'score' => 5.0],
            ['title' => 'Corner', 'description' => '', 'score' => 5.0],
            ['title' => 'FreeKick', 'description' => '', 'score' => 5.0],
            ['title' => 'Offside', 'description' => '', 'score' => 5.0],
            ['title' => 'Foul', 'description' => '', 'score' => 5.0],
            ['title' => 'FoulTaken', 'description' => '', 'score' => 5.0],
            ['title' => 'YellowCard', 'description' => '', 'score' => 5.0],
            ['title' => 'RedCard', 'description' => '', 'score' => 5.0],
            ['title' => 'Substitution', 'description' => '', 'score' => 5.0],
            ['title' => 'Interception', 'description' => '', 'score' => 5.0],
            ['title' => 'GoalkeeperSave', 'description' => '', 'score' => 5.0],
        ]);
    }
}
