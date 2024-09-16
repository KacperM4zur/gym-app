<?php

namespace Database\Seeders;

use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $days = [
            ['name' => 'Poniedziałek', 'number' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Wtorek', 'number' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Środa', 'number' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Czwartek', 'number' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Piątek', 'number' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sobota', 'number' => 6, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Niedziela', 'number' => 7, 'created_at' => $now, 'updated_at' => $now],
        ];

        Day::insert($days);
    }
}
