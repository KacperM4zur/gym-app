<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMaxLiftsSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_max_lifts')->insert([
            [
                'customer_id' => 2,
                'exercise_id' => 1,
                'weight' => 100.0,
                'date' => '2024-10-21',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'exercise_id' => 25,
                'weight' => 90.5,
                'date' => '2024-10-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 14,
                'exercise_id' => 24,
                'weight' => 40.0,
                'date' => '2024-10-23',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 14,
                'exercise_id' => 31,
                'weight' => 60.0,
                'date' => '2024-10-24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'exercise_id' => 12,
                'weight' => 150.0,
                'date' => '2024-10-25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 14,
                'exercise_id' => 30,
                'weight' => 70.0,
                'date' => '2024-10-26',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
