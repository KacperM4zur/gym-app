<?php

use App\Models\SupplementsGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

test('moze utworzyc grupe suplementow', function () {
    $data = [
        'name' => 'Proteiny',
        'description' => 'Suplementy bialkowe',
        'image_path' => 'path/to/image.jpg',
        'status' => 1,
    ];

    $group = SupplementsGroup::create($data);

    expect($group)->toBeInstanceOf(SupplementsGroup::class);
    expect($group->name)->toBe('Proteiny');
    assertDatabaseHas('supplements_group', $data);
});

test('moze odczytac grupe suplementow', function () {
    $group = SupplementsGroup::create([
        'name' => 'Witaminy',
        'description' => 'Suplementy witaminowe',
        'image_path' => 'path/to/image.jpg',
        'status' => 1,
    ]);

    $foundGroup = SupplementsGroup::find($group->id);

    expect($foundGroup)->not->toBeNull();
    expect($foundGroup->name)->toBe('Witaminy');
});

test('moze zaktualizowac grupe suplementow', function () {
    $group = SupplementsGroup::create([
        'name' => 'Mineraly',
        'description' => 'Suplementy mineralne',
        'image_path' => 'path/to/image.jpg',
        'status' => 1,
    ]);

    $updatedData = [
        'name' => 'Zmieniona nazwa',
    ];

    $group->update($updatedData);

    expect($group->name)->toBe('Zmieniona nazwa');
    assertDatabaseHas('supplements_group', array_merge($group->only('id', 'description', 'image_path', 'status'), $updatedData));
});

test('moze usunac grupe suplementow', function () {
    $group = SupplementsGroup::create([
        'name' => 'Antyoksydanty',
        'description' => 'Suplementy antyoksydacyjne',
        'image_path' => 'path/to/image.jpg',
        'status' => 1,
    ]);

    $groupId = $group->id;

    $group->delete();

    assertDatabaseMissing('supplements_group', ['id' => $groupId]);
});
