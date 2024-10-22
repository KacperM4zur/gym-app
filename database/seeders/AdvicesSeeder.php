<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdvicesSeeder extends Seeder
{
    public function run()
    {
        DB::table('advices')->insert([
            [
                'customer_id' => 2,
                'content' => 'Pamiętaj, aby pić dużo wody podczas treningów.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'customer_id' => 2,
                'content' => 'Zwiększ intensywność cardio, aby poprawić kondycję.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'customer_id' => 14,
                'content' => 'Dodaj więcej białka do swojej diety, aby wspierać budowę mięśni.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'customer_id' => 14,
                'content' => 'Zadbaj o odpowiednią regenerację, szczególnie po ciężkich treningach siłowych.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
