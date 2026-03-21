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

        for($i = 1; $i <= 100; $i ++){
            //CRIAÇÃO DE USUARIO
            DB::table("users")->insert([
                "uuid" => (string) Str::uuid(),
                "first_name" => $faker->firstName,
                "last_name" => $faker->lastName,
                "user_name" => $faker->name,
                "email" => $faker->email,
                "password" => bcrypt("futezada@123"),
                "phone" => $faker->phoneNumber,
                "born_date" => $faker->dateTimeBetween("-50 years", "-18 years")->format("Y-m-d"),
                "photo" => $faker->imageUrl(640,400,"people",true,"User"),
                "visibility" => $faker->boolean,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
