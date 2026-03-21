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

                //BOOLEANO DE PARTICIPAÇÃO COMO PLAYER E MANAGER
                $isPlayer = $faker->boolean();
                $isManager = $faker->boolean();
                
                //GERAR DADOS DE PLAYER DO USUARIO
                if($isPlayer){
                    //INCREMENTAR ID DO PLAYER
                    $player_id ++;
                    DB::table('players')->insert([
                        "user_id" => $i,
                        "best_side" => $faker->boolean() ? "right" : "left",
                        "type" => $faker->company,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                    DB::table('player_positions')->insert([
                        "player_id" => $player_id,
                        "position_id" => random_int(1, 5),
                        "main" => $faker->boolean,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                }
                
                //GERAR DADOS DE MANAGER DO USUARIO
                if($isManager){
                    DB::table('managers')->insert([
                        "user_id" => $i,
                        'team' => $faker->jobTitle,
                        'alias' => substr($faker->jobTitle, 0, 3),
                        'primary' => $faker->randomElement(["green_300","blue_500","red_300","yellow_300","orange_300","purple_300","dark_300","white"]),
                        'secondary' => $faker->randomElement(["green_300","blue_500","red_300","yellow_300","orange_300","purple_300","dark_300","white"]),
                        'emblem' => json_encode(
                            $faker->randomElement([
                                "emblema_1","emblema_2","emblema_3",
                                "emblema_4","emblema_5","emblema_6","emblema_7"
                            ])
                        ),
                        'uniform' => null,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                }
            }
        }
    }
}
