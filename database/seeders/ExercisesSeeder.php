<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExercisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('exercises')->insert([
            // Klatka Piersiowa (ID 9)
            [
                'name' => 'Wyciskanie sztangi na ławce poziomej',
                'description' => 'Podstawowe ćwiczenie na klatkę piersiową...',
                'image_path' => 'wyciskanie_sztangi.jpg',
                'status' => 1,
                'exercises_group_id' => 9,  // ID grupy "Klatka Piersiowa"
                'technique' => 'Leż na ławce, chwyć sztangę...',
                'advantages' => 'Wzmacnia klatkę piersiową',
                'disadvantages' => 'Obciążenie barków przy złej technice',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rozpiętki z hantlami',
                'description' => 'Izolacyjne ćwiczenie na klatkę piersiową...',
                'image_path' => 'rozpietki.jpg',
                'status' => 1,
                'exercises_group_id' => 9,
                'technique' => 'Leż na ławce, zginaj ramiona...',
                'advantages' => 'Izoluje mięśnie klatki',
                'disadvantages' => 'Mniejsze obciążenie niż przy sztandze',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wyciskanie hantli na ławce poziomej',
                'description' => 'Ćwiczenie z hantlami na klatkę piersiową...',
                'image_path' => 'wyciskanie_hantli.jpg',
                'status' => 1,
                'exercises_group_id' => 9,
                'technique' => 'Chwyć hantle i wyciśnij je w górę...',
                'advantages' => 'Poprawa symetrii mięśniowej',
                'disadvantages' => 'Trudniejsze w kontroli techniki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pompki na poręczach',
                'description' => 'Ćwiczenie rozwijające klatkę i tricepsy...',
                'image_path' => 'pompki_porecze.jpg',
                'status' => 1,
                'exercises_group_id' => 9,
                'technique' => 'Uchwyć poręcze, opuść ciało...',
                'advantages' => 'Angażuje wiele mięśni',
                'disadvantages' => 'Trudniejsze dla początkujących',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wyciskanie na ławce skośnej',
                'description' => 'Ćwiczenie na górną część klatki...',
                'image_path' => 'wyciskanie_skosna.jpg',
                'status' => 1,
                'exercises_group_id' => 9,
                'technique' => 'Ustaw ławkę pod kątem 30 stopni...',
                'advantages' => 'Wzmacnia górną część klatki',
                'disadvantages' => 'Mniejszy zakres ruchu',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Nogi (ID 11)
            [
                'name' => 'Przysiady ze sztangą',
                'description' => 'Podstawowe ćwiczenie na nogi...',
                'image_path' => 'przysiady.jpg',
                'status' => 1,
                'exercises_group_id' => 11,  // ID grupy "Nogi"
                'technique' => 'Stań prosto, umieść sztangę na barkach...',
                'advantages' => 'Wzmacnia nogi i pośladki',
                'disadvantages' => 'Obciążenie kolan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Martwy ciąg',
                'description' => 'Ćwiczenie rozwijające nogi i plecy...',
                'image_path' => 'martwy_ciąg.jpg',
                'status' => 1,
                'exercises_group_id' => 11,
                'technique' => 'Stań prosto, chwyć sztangę...',
                'advantages' => 'Angażuje wiele mięśni',
                'disadvantages' => 'Ryzyko kontuzji dolnego odcinka kręgosłupa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wykroki z hantlami',
                'description' => 'Ćwiczenie rozwijające nogi...',
                'image_path' => 'wykroki.jpg',
                'status' => 1,
                'exercises_group_id' => 11,
                'technique' => 'Zrób krok w przód, zginając kolana...',
                'advantages' => 'Poprawia stabilność',
                'disadvantages' => 'Obciążenie kolan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Podnoszenie na łydkach',
                'description' => 'Ćwiczenie na mięśnie łydek...',
                'image_path' => 'łydki.jpg',
                'status' => 1,
                'exercises_group_id' => 11,
                'technique' => 'Stań na krawędzi stopnia, unieś pięty...',
                'advantages' => 'Wzmacnia łydki',
                'disadvantages' => 'Trudniejsze do opanowania techniki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Przysiady bułgarskie',
                'description' => 'Ćwiczenie angażujące mięśnie nóg...',
                'image_path' => 'przysiady_bułgarskie.jpg',
                'status' => 1,
                'exercises_group_id' => 11,
                'technique' => 'Jedna noga na ławce, druga w wykroku...',
                'advantages' => 'Poprawa równowagi',
                'disadvantages' => 'Wymaga większej stabilności',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Plecy (ID 13)
            [
                'name' => 'Podciąganie na drążku',
                'description' => 'Ćwiczenie na rozwój mięśni grzbietu...',
                'image_path' => 'podciaganie.jpg',
                'status' => 1,
                'exercises_group_id' => 13,  // ID grupy "Plecy"
                'technique' => 'Złap drążek, podciągnij się do góry...',
                'advantages' => 'Poprawa siły górnej części ciała',
                'disadvantages' => 'Trudniejsze dla początkujących',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Dodaj więcej ćwiczeń na plecy, ramiona i brzuch
        ]);
    }
}
