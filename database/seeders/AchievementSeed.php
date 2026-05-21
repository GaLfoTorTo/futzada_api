<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class AchievementSeed extends Seeder
{
    public function run()
    {
        $achievements = [

            /*
            |--------------------------------------------------------------------------
            | FOOTBALL
            |--------------------------------------------------------------------------
            */

            [
                'title' => 'Football - Primeiro Gol',
                'description' => 'Marque seu primeiro gol',
                'points' => 50,
                'image' => 'achivment_1.png',
                'type' => 'single',
                'rarity' => 'Common',
            ],
            [
                'title' => 'Football - Artilheiro 10',
                'description' => 'Marque 10 gols',
                'points' => 100,
                'image' => 'achivment_2.png',
                'type' => 'progressive',
                'rarity' => 'Common',
            ],
            [
                'title' => 'Football - Artilheiro 50',
                'description' => 'Marque 50 gols',
                'points' => 300,
                'image' => 'achivment_3.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Football - Hat-Trick',
                'description' => 'Marque 3 gols em uma partida',
                'points' => 200,
                'image' => 'achivment_4.png',
                'type' => 'single',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Football - Invicto 5',
                'description' => 'Ganhe 5 partidas seguidas',
                'points' => 250,
                'image' => 'achivment_5.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Football - Invicto 10',
                'description' => 'Ganhe 10 partidas seguidas',
                'points' => 500,
                'image' => 'achivment_6.png',
                'type' => 'progressive',
                'rarity' => 'Epic',
            ],
            [
                'title' => 'Football - Maestro',
                'description' => 'Faça 20 assistências',
                'points' => 300,
                'image' => 'achivment_7.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Football - Muralha',
                'description' => 'Consiga 10 jogos sem sofrer gol',
                'points' => 400,
                'image' => 'achivment_8.png',
                'type' => 'progressive',
                'rarity' => 'Epic',
            ],
            [
                'title' => 'Football - Veterano',
                'description' => 'Jogue 50 partidas',
                'points' => 350,
                'image' => 'achivment_9.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Football - Lenda dos Campos',
                'description' => 'Marque 200 gols',
                'points' => 1000,
                'image' => 'achivment_10.png',
                'type' => 'progressive',
                'rarity' => 'Legendary',
            ],

            /*
            |--------------------------------------------------------------------------
            | BASKETBALL
            |--------------------------------------------------------------------------
            */

            [
                'title' => 'Basketball - Primeira Cesta',
                'description' => 'Marque sua primeira cesta',
                'points' => 50,
                'image' => 'achivment_11.png',
                'type' => 'single',
                'rarity' => 'Common',
            ],
            [
                'title' => 'Basketball - Pontuador 100',
                'description' => 'Faça 100 pontos',
                'points' => 150,
                'image' => 'achivment_12.png',
                'type' => 'progressive',
                'rarity' => 'Common',
            ],
            [
                'title' => 'Basketball - Pontuador 500',
                'description' => 'Faça 500 pontos',
                'points' => 400,
                'image' => 'achivment_13.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Basketball - Triplo Duplo',
                'description' => 'Consiga um triplo-duplo em uma partida',
                'points' => 500,
                'image' => 'achivment_14.png',
                'type' => 'single',
                'rarity' => 'Epic',
            ],
            [
                'title' => 'Basketball - Atirador',
                'description' => 'Converta 50 bolas de 3 pontos',
                'points' => 300,
                'image' => 'achivment_15.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Basketball - Dominante',
                'description' => 'Faça 30 pontos em uma partida',
                'points' => 200,
                'image' => 'achivment_16.png',
                'type' => 'single',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Basketball - Assistente',
                'description' => 'Faça 100 assistências',
                'points' => 300,
                'image' => 'achivment_17.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Basketball - Defesa de Ferro',
                'description' => 'Consiga 50 roubos de bola',
                'points' => 350,
                'image' => 'achivment_18.png',
                'type' => 'progressive',
                'rarity' => 'Epic',
            ],
            [
                'title' => 'Basketball - Veterano',
                'description' => 'Jogue 50 partidas',
                'points' => 300,
                'image' => 'achivment_19.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Basketball - Lenda da Quadra',
                'description' => 'Faça 2000 pontos',
                'points' => 1200,
                'image' => 'achivment_20.png',
                'type' => 'progressive',
                'rarity' => 'Legendary',
            ],

            /*
            |--------------------------------------------------------------------------
            | VOLLEYBALL
            |--------------------------------------------------------------------------
            */

            [
                'title' => 'Volleyball - Primeiro Ponto',
                'description' => 'Marque seu primeiro ponto',
                'points' => 50,
                'image' => 'achivment_21.png',
                'type' => 'single',
                'rarity' => 'Common',
            ],
            [
                'title' => 'Volleyball - Pontuador 50',
                'description' => 'Marque 50 pontos',
                'points' => 150,
                'image' => 'achivment_22.png',
                'type' => 'progressive',
                'rarity' => 'Common',
            ],
            [
                'title' => 'Volleyball - Pontuador 200',
                'description' => 'Marque 200 pontos',
                'points' => 400,
                'image' => 'achivment_23.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Volleyball - Ace!',
                'description' => 'Faça 10 aces de saque',
                'points' => 200,
                'image' => 'achivment_24.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Volleyball - Bloqueador',
                'description' => 'Realize 30 bloqueios',
                'points' => 300,
                'image' => 'achivment_25.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Volleyball - Defesa Impecável',
                'description' => 'Faça 50 defesas',
                'points' => 300,
                'image' => 'achivment_26.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Volleyball - Invicto 5',
                'description' => 'Ganhe 5 partidas seguidas',
                'points' => 250,
                'image' => 'achivment_27.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Volleyball - Invicto 10',
                'description' => 'Ganhe 10 partidas seguidas',
                'points' => 500,
                'image' => 'achivment_28.png',
                'type' => 'progressive',
                'rarity' => 'Epic',
            ],
            [
                'title' => 'Volleyball - Veterano',
                'description' => 'Jogue 50 partidas',
                'points' => 300,
                'image' => 'achivment_29.png',
                'type' => 'progressive',
                'rarity' => 'Rare',
            ],
            [
                'title' => 'Volleyball - Lenda da Rede',
                'description' => 'Marque 1000 pontos',
                'points' => 1000,
                'image' => 'achivment_30.png',
                'type' => 'progressive',
                'rarity' => 'Legendary',
            ],
        ];

        foreach ($achievements as &$achievement) {
            $achievement['status'] = true;
            $achievement['created_at'] = now();
            $achievement['updated_at'] = now();
        }

        DB::table('achievements')->insert($achievements);
    }
}