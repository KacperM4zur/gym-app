<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\ExercisesGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
{
    protected $model = Exercise::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'image_path' => $this->faker->imageUrl(),
            'status' => $this->faker->numberBetween(0, 1),
            'exercises_group_id' => ExercisesGroup::factory(), // Assuming you have an ExercisesGroup factory
        ];
    }
}
