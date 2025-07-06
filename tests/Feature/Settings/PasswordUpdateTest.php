<?php

declare(strict_types=1);

use App\Livewire\Settings\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

test('password can be updated', function () {
    $user = User::factory()->create([
        'password' => Hash::make('pass123WORD!@£'),
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Password::class)
        ->set('current_password', 'pass123WORD!@£')
        ->set('password', 'new-pass123WORD!@£')
        ->set('password_confirmation', 'new-pass123WORD!@£')
        ->call('updatePassword');

    $response->assertHasNoErrors();

    expect(Hash::check('new-pass123WORD!@£', $user->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('pass123WORD!@£'),
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Password::class)
        ->set('current_password', 'wrong-password')
        ->set('password', 'new-pass123WORD!@£')
        ->set('password_confirmation', 'new-pass123WORD!@£')
        ->call('updatePassword');

    $response->assertHasErrors(['current_password']);
});
