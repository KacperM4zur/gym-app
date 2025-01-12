<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplementsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Dodanie nowych danych
        DB::table('supplements_group')->insert([
            [
                'name' => 'Białko',
                'description' => 'Suplement białkowy wspomaga regenerację i budowę mięśni.',
                'image_path' => 'bialko.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kreatyna',
                'description' => 'Kreatyna zwiększa siłę i wytrzymałość mięśni.',
                'image_path' => 'kreatyna.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Witaminy',
                'description' => 'Witaminy wspierają ogólną odporność organizmu.',
                'image_path' => 'witaminy.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aminokwasy',
                'description' => 'Aminokwasy wspomagają regenerację i wzrost mięśni.',
                'image_path' => 'aminokwasy.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pre-workout',
                'description' => 'Suplement przedtreningowy zwiększa energię i wytrzymałość.',
                'image_path' => 'preworkout.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
