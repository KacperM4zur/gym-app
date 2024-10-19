<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExercisesGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('exercises_group')->insert([
            [
                'name' => 'Klatka Piersiowa',
                'description' => 'Ćwiczenia na klatkę piersiową koncentrują się na rozwijaniu mięśni piersiowych...',
                'image_path' => 'klatka_piersiowa.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nogi',
                'description' => 'Ćwiczenia na nogi angażują mięśnie nóg, pośladków i dolnych partii ciała...',
                'image_path' => 'nogi.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plecy',
                'description' => 'Ćwiczenia na plecy koncentrują się na wzmacnianiu mięśni grzbietu...',
                'image_path' => 'plecy.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ramiona',
                'description' => 'Ćwiczenia na ramiona wzmacniają bicepsy, tricepsy i przedramiona...',
                'image_path' => 'ramiona.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brzuch',
                'description' => 'Ćwiczenia na brzuch pomagają w rozwoju mięśni brzucha i stabilizacji tułowia...',
                'image_path' => 'brzuch.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
