<?php

declare(strict_types=1);

use App\Livewire\Auth\Register;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'pass123WORD!@£')
        ->set('password_confirmation', 'pass123WORD!@£')
        ->call('register');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('registration password must be sufficiently strong', function (string $password) {
    $response = Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', $password)
        ->set('password_confirmation', $password)
        ->call('register');

    $response->assertHasErrors(['password']);
})->with([
    'password',
    'passWORD',
    'pass123',
    'pass123WORD',
    'p1W!',
    '!@£$%^&*()',
]);
