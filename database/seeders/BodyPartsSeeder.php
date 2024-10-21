<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BodyPartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('body_parts')->insert([
            ['name' => 'Klatka piersiowa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Plecy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nogi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ramiona', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brzuch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Barki', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
