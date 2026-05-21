<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ParticipantSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $player_id = 0;

        for($i = 1; $i <= 100; $i ++){
            
            //GERAR BOOLEANO DE PARTICIPANT ALEATORIO
            $isParticipant = $faker->boolean();
            
            //GERAR DADOS DE PARTICIPANT
            if($isParticipant){
                //GERAR ID DO EVENTO
                $event_id = random_int(1, 10);
                
                //GERAR PARTICIPANT
                DB::table('participants')->insert([
                    'event_id' => $event_id,
                    'user_id' => $i,
                    'roles' => json_encode($faker->randomElement(["Organizator", "Colaborator", "Refereer", "Player", "Manager"]), random_int(1, 4)),
                    'status' => $faker->randomElement(['Avaliable','Doubt','Injured','Out']),
                    'permissions' => null,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
    }
}
