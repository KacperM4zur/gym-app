<?php

use App\Models\User;

test('ekran logowania może być wyświetlony', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('użytkownicy mogą się zalogować używając ekranu logowania', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('użytkownicy nie mogą się zalogować z nieprawidłowym hasłem', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('użytkownicy mogą się wylogować', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

