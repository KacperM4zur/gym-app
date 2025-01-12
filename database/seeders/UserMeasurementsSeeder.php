<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserMeasurementsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_measurements')->insert([
            [
                'customer_id' => 2,
                'body_part_id' => 8,
                'measurement' => 100,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'body_part_id' => 9,
                'measurement' => 105,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 14,
                'body_part_id' => 10,
                'measurement' => 90,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 14,
                'body_part_id' => 11,
                'measurement' => 45,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'body_part_id' => 12,
                'measurement' => 85,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 14,
                'body_part_id' => 13,
                'measurement' => 55,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
