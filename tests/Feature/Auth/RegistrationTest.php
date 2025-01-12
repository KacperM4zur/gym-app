<?php

test('ekran rejestracji może być wyświetlony', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('nowi użytkownicy mogą się zarejestrować', function () {
    $response = $this->post('/register', [
        'name' => 'Testowy Użytkownik',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
