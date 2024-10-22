<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use UserMeasurementsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DaysSeeder::class,
            ExercisesGroupSeeder::class,
            ExercisesSeeder::class,
            SupplementsGroupSeeder::class,
            BodyPartsSeeder::class,
            UserWeightSeeder::class,
            UserMeasurementsSeeder::class,
            AdvicesSeeder::class
        ]);
    }
}
