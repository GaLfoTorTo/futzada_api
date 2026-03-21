<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameEvenTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('game_event_types')->insert([
            ['title' => 'StartGame', 'action_id' => null],
            ['title' => 'EndGame', 'action_id' => null],
            ['title' => 'HalfTimeEnd', 'action_id' => null],
            ['title' => 'ExtraTime', 'action_id' => null],
            ['title' => 'ExtraTimeStart', 'action_id' => null],
            ['title' => 'ExtraTimeEnd', 'action_id' => null],
            ['title' => 'Penalties', 'action_id' => null],
            ['title' => 'Goal', 'action_id' => 1],
            ['title' => 'Assist', 'action_id' => 2],
            ['title' => 'Defense', 'action_id' => 3],
            ['title' => 'Penalty', 'action_id' => 4],
            ['title' => 'Corner', 'action_id' => 5],
            ['title' => 'FreeKick', 'action_id' => 6],
            ['title' => 'GoalKick', 'action_id' => null],
            ['title' => 'Offside', 'action_id' => 7],
            ['title' => 'Foul', 'action_id' => 8],
            ['title' => 'FoulTaken', 'action_id' => 9],
            ['title' => 'YellowCard', 'action_id' => 10],
            ['title' => 'RedCard', 'action_id' => 11],
            ['title' => 'Substitution', 'action_id' => 12],
            ['title' => 'Interception', 'action_id' => 13],
            ['title' => 'GoalkeeperSave', 'action_id' => 14],
            ['title' => 'Injury', 'action_id' => null],
            ['title' => 'VARCheck', 'action_id' => null],
        ]);
    }
}
