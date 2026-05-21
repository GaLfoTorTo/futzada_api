<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class LevelSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $tiers = [
            'Iniciante',
            'Peladeiro',
            'Várzea',
            'Amador',
            'Semi-Pro',
            'Pro',
            'Craque',
            'Estrela',
            'Lenda',
            'Rei'
        ];

        $roman = ['I','II','III','IV','V'];

        $levels = [];
        $xpTotal = 0;

        for ($i = 1; $i <= 100; $i++) {

            // RESGATAR ROMANO
            $tierIndex = floor(($i - 1) / 10);
            $tierName = $tiers[$tierIndex];

            //POSIÇÃO DO TIER
            $indexInTier = ($i - 1) % 10;

            //ROMANO OCUPA 2 POSIÇÕES
            $romanIndex = floor($indexInTier / 2);

            $title = $tierName . ' ' . $roman[$romanIndex];

            //CURVA DE XP
            if ($i <= 30) {
                $xpRequired = (int)(80 * pow($i, 1.5));
            } elseif ($i <= 70) {
                $xpRequired = (int)(100 * pow($i, 1.7));
            } else {
                $xpRequired = (int)(120 * pow($i, 2.0));
            }

            $xpTotal += $xpRequired;

            $levels[] = [
                'number' => $i,
                'tier' => $tierName,
                'title' => $title,
                'points_min' => $xpRequired,
                'points_max' => $xpTotal,
                'image' => $faker->imageUrl(640,400, "sports", true),
                'color' => $faker->randomElement(["green","blue_500","red","yellow","orange","purple","dark","white"]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('levels')->insert($levels);
    }
}
