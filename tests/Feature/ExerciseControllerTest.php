<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Exercise;
use App\Models\ExercisesGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ExerciseControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Utworz uzytkownika i zaloguj
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function moze_wyswietlic_liste_cwiczen()
    {
        $exercisesGroup = ExercisesGroup::factory()->create();
        Exercise::factory()->create(['name' => 'Push Up', 'exercises_group_id' => $exercisesGroup->id]);
        Exercise::factory()->create(['name' => 'Pull Up', 'exercises_group_id' => $exercisesGroup->id]);

        $response = $this->get(route('exercises.index'));

        $response->assertStatus(200);
        $response->assertSee('Push Up');
        $response->assertSee('Pull Up');
    }

    /** @test */
    public function moze_utworzyc_cwiczenie()
    {
        Storage::fake('public');
        $exercisesGroup = ExercisesGroup::factory()->create();

        $response = $this->post(route('exercises.edit'), [
            'name' => 'Squat',
            'description' => 'A basic squat exercise.',
            'image_path' => UploadedFile::fake()->image('exercise.jpg'),
            'status' => 1,
            'exercises_group_id' => $exercisesGroup->id
        ]);

        $response->assertRedirect(route('exercises.index'));
        $this->assertDatabaseHas('exercises', ['name' => 'Squat']);
    }

    /** @test */
    public function moze_wyswietlic_cwiczenie()
    {
        $exercisesGroup = ExercisesGroup::factory()->create();
        $exercise = Exercise::factory()->create(['name' => 'Push Up', 'exercises_group_id' => $exercisesGroup->id]);

        $response = $this->get(route('exercises.edit', $exercise->id));

        $response->assertStatus(200);
        $response->assertSee('Push Up');
    }

    /** @test */
    public function moze_zaktualizowac_cwiczenie()
    {
        Storage::fake('public');
        $exercisesGroup = ExercisesGroup::factory()->create();
        $exercise = Exercise::factory()->create(['name' => 'Push Up', 'exercises_group_id' => $exercisesGroup->id]);

        $response = $this->post(route('exercises.edit', $exercise->id), [
            'name' => 'Pull Up',
            'description' => 'An updated description.',
            'image_path' => UploadedFile::fake()->image('new_exercise.jpg'),
            'status' => 1,
            'exercises_group_id' => $exercisesGroup->id
        ]);

        $response->assertRedirect(route('exercises.index'));
        $this->assertDatabaseHas('exercises', ['name' => 'Pull Up']);
    }

    /** @test */
    public function moze_usunac_cwiczenie()
    {
        Storage::fake('public');
        $exercisesGroup = ExercisesGroup::factory()->create();
        $exercise = Exercise::factory()->create(['name' => 'Push Up', 'exercises_group_id' => $exercisesGroup->id]);

        $response = $this->delete(route('exercises.delete', $exercise->id));

        $response->assertRedirect(route('exercises.index'));
        $this->assertDatabaseMissing('exercises', ['name' => 'Push Up']);
    }
}
