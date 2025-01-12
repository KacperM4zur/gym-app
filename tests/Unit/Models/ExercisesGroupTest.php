<?php

namespace Tests\Unit\Models;

use App\Models\ExercisesGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExercisesGroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function moze_utworzyc_grupe_cwiczen()
    {
        $group = ExercisesGroup::factory()->create();

        $this->assertInstanceOf(ExercisesGroup::class, $group);
        $this->assertNotEmpty($group->name);
        $this->assertNotEmpty($group->description);
        $this->assertNotEmpty($group->image_path);
        $this->assertContains($group->status, [0, 1]); // Dodane sprawdzenie status jako integer
    }

    /** @test */
    public function moze_zaktualizowac_grupe_cwiczen()
    {
        $group = ExercisesGroup::factory()->create();
        $group->name = 'Updated Name';
        $group->description = 'Updated Description';
        $group->image_path = 'updated/path/to/image.jpg';
        $group->status = 0; // Aktualizacja status jako integer
        $group->save();

        $updatedGroup = ExercisesGroup::find($group->id);

        $this->assertEquals('Updated Name', $updatedGroup->name);
        $this->assertEquals('Updated Description', $updatedGroup->description);
        $this->assertEquals('updated/path/to/image.jpg', $updatedGroup->image_path);
        $this->assertEquals(0, $updatedGroup->status); // Sprawdzenie status jako integer
    }

    /** @test */
    public function moze_usunac_grupe_cwiczen()
    {
        $group = ExercisesGroup::factory()->create();
        $groupId = $group->id;
        $group->delete();

        $deletedGroup = ExercisesGroup::find($groupId);

        $this->assertNull($deletedGroup);
    }
}
