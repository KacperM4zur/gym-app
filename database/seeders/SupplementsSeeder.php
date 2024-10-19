<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usunięcie starych danych z tabeli przed seedowaniem
        DB::table('supplements')->truncate();

        // Dodanie nowych danych z poprawnym `supplements_group_id`
        DB::table('supplements')->insert([
            [
                'name' => 'Białko WPC 80',
                'description' => 'Wysokiej jakości białko WPC 80 wspomagające regenerację i wzrost mięśni.',
                'image_path' => 'bialko_wpc_80.jpg',
                'status' => 1,
                'supplements_group_id' => 9,  // ID grupy "Białko"
                'advantages' => 'Wysoka zawartość białka',
                'disadvantages' => 'Może powodować problemy trawienne',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Monohydrat kreatyny',
                'description' => 'Popularna kreatyna, zwiększająca siłę i masę mięśniową.',
                'image_path' => 'monohydrat_kreatyny.jpg',
                'status' => 1,
                'supplements_group_id' => 10,  // ID grupy "Kreatyna"
                'advantages' => 'Zwiększa siłę',
                'disadvantages' => 'Może powodować retencję wody',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Multiwitamina',
                'description' => 'Zestaw witamin wspierających ogólną odporność organizmu.',
                'image_path' => 'multiwitamina.jpg',
                'status' => 1,
                'supplements_group_id' => 11,  // ID grupy "Witaminy"
                'advantages' => 'Wspiera układ odpornościowy',
                'disadvantages' => 'Może być drogie w długotrwałym stosowaniu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BCAA',
                'description' => 'Aminokwasy rozgałęzione wspomagające regenerację mięśni.',
                'image_path' => 'bcaa.jpg',
                'status' => 1,
                'supplements_group_id' => 12,  // ID grupy "Aminokwasy"
                'advantages' => 'Wspiera regenerację',
                'disadvantages' => 'Może być kosztowne',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pre-workout Xtreme',
                'description' => 'Mocny pre-workout zapewniający energię na intensywny trening.',
                'image_path' => 'preworkout_xtreme.jpg',
                'status' => 1,
                'supplements_group_id' => 13,  // ID grupy "Pre-workout"
                'advantages' => 'Zwiększa energię',
                'disadvantages' => 'Zawiera dużą ilość kofeiny',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
