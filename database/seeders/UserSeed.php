<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();
        $random = new \Random\Randomizer();
        $modalityes = ["Football", "Basketball", "Volleyball"];

        function getModalities(){
            $faker = Factory::create();
            $modalityes = ["Football", "Basketball", "Volleyball"];
            $count = $faker->numberBetween(0, 2);
            $arr = [];
            for ($i = 0; $i <= $count; $i++) { 
                $arr[] = $modalityes[$i];
            } 
        }

        for($i = 1; $i <= 100; $i ++){

            //GERAR IDS DO EVENTO
            $events = $faker->numberBetween(1, 10);
            $isPlayer = $faker->boolean;
            $isManager = $faker->boolean;
            $p = 0;
            $m = 0;
            

            //CRIAR USUARIO
            DB::table("users")->insert([
                "uuid" => (string) Str::uuid(),
                "first_name" => $faker->firstName,
                "last_name" => $faker->lastName,
                "user_name" => $faker->name,
                "email" => $faker->email,
                "password" => bcrypt("futezada@123"),
                "born_date" => $faker->dateTimeBetween("-50 years", "-18 years")->format("Y-m-d"),
                "phone" => $faker->phoneNumber,
                "photo" => $faker->imageUrl(640,400,"people",true,"User"),
                "privacy" => $faker->boolean,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ]);
            //CRIAR CONFIGURAÇÕES DE USUARIO
            DB::table('user_configs')->insert([
                "user_id" => $i,
                "main_modality" => $faker->randomElement($modalityes),
                "modalities" => getModalities()
            ]);
            //CRIAR VINCULO DE LEVEL DO USUARIO
            DB::table('user_levels')->insert([
                "user_id" => $i,
                "level_id" => 1,
                "points" => 0,
            ]);
            
            //GERAR DADOS DE PLAYER DO USUARIO
            if($isPlayer){
                //INCREMENTAR ID DO PLAYER
                $p ++;
                //CRIAR PLAYER
                DB::table('players')->insert([
                    "user_id" => $i,
                    "number" => $faker->numberBetween(1, 99),
                    "best_side" => $faker->boolean() ? "right" : "left",
                    "type" => $faker->company,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
                $player = DB::table('players')->where('id', $p)->first();
                if($isPlayer && !empty($player)){
                    DB::table('player_positions')->insert([
                        "player_id" => $p,
                        "position_id" => $faker->numberBetween(1, 5),
                        "main" => $faker->boolean,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                }
            }
            
            //GERAR DADOS DE MANAGER DO USUARIO
            if($isManager){
                //INCREMENTAR MANAGER
                $m++;
                //CRIAR MANAGER
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

            for ($e = 1; $e <= $events ; $e++) { 
                //GERAR PARTICIPANT (EVENTS)
                DB::table('participants')->insert([
                    'event_id' => $e,
                    'user_id' => $i,
                    'roles' => json_encode($faker->randomElement(["Organizator", "Colaborator", "Refereer", "Player", "Manager"]), $faker->numberBetween(1, 5)),
                    'status' => $faker->randomElement(['Avaliable','Doubt','Injured','Out']),
                    'permissions' => null,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);

                $manager = DB::table('managers')->where('id', $m)->first();
                if($isManager && !empty($manager)) {
                    //GERAR RATING (PLAYER)
                    DB::table('ratings')->insert([
                        'user_id' => $i,
                        'event_id' => $e,
                        'role' => $faker->randomElement([ "Player", "Manager", "Refereer",]),
                        'points' => $faker->randomFloat(2, 0, 99),
                        'avarage' => $faker->randomFloat(2, 0, 99),
                        'valuation' => $faker->randomFloat(2, 0, 99),
                        'price' => $faker->randomFloat(2, 0, 99),
                        'games' => $faker->randomFloat(2, 0, 99),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                    //GERAR ECONOMY (MANAGER)
                    DB::table('economies')->insert([
                        'manager_id' => $manager->id,
                        'event_id' => $e,
                        'patrimony' => $faker->randomFloat(2, 0, 99),
                        'price' => $faker->randomFloat(2, 0, 99),
                        'price' => $faker->randomFloat(2, 0, 99),
                        'valuation' => $faker->randomFloat(2, 0, 99),
                        'points' => $faker->randomFloat(2, 0, 99),
                        'total_points' => $faker->randomFloat(2, 0, 99),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                    //GERAR ECONOMY (MANAGER)
                    DB::table('escalations')->insert([
                        'manager_id' => $manager->id,
                        'event_id' => $e,
                        'formation' => $faker->randomElement(["4-3-3", "4-4-2", "4-5-1", "3-5-2", "4-1-2-1"]),
                        'starters' => json_encode([]),
                        'reserves' => json_encode([]),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                }
            }

            for ($a = 1; $a <= $faker->numberBetween(1, 10); $a++) { 
                //GERAR ACHIVMENTS DO USUARIO
                DB::table('user_achievements')->insert([
                    'user_id' => $i,
                    'achievement_id' => $a,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
    }
}
