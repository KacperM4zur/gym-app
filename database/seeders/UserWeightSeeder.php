<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserWeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_weights')->insert([
            [
                'customer_id' => 2,
                'weight' => 70,
                'date' => '2024-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'weight' => 68,
                'date' => '2024-02-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 14,
                'weight' => 85,
                'date' => '2024-01-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 14,
                'weight' => 83,
                'date' => '2024-02-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
