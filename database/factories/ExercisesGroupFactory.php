<?php

namespace Database\Factories;

use App\Models\ExercisesGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExercisesGroupFactory extends Factory
{
    protected $model = ExercisesGroup::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'image_path' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([0, 1]), // Dodanie pola status jako integer
        ];
    }
}
