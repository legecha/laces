<?php

declare(strict_types=1);

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Users\UpdateUserPassword;
use App\Actions\Users\UpdateUserProfile;
use App\Events\Users\UserPasswordReset;
use App\Events\Users\UserPasswordUpdated;
use App\Events\Users\UserProfileUpdated;
use App\Events\Users\UserRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

it('creates a new user and dispatches a registered event', function (): void {
    Event::fake([UserRegistered::class]);

    $action = resolve(CreateNewUser::class);

    $user = $action->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'SecurePassword123!',
        'password_confirmation' => 'SecurePassword123!',
    ]);

    expect($user->exists)->toBeTrue();

    Event::assertDispatched(UserRegistered::class, fn (UserRegistered $event): bool => $event->userId === $user->id);
});

it('fails to create a user when validation fails', function (): void {
    $action = resolve(CreateNewUser::class);

    expect(fn (): User => $action->create([
        'name' => '',
        'email' => 'not-an-email',
        'password' => 'short',
        'password_confirmation' => 'mismatch',
    ]))->toThrow(ValidationException::class);

    expect(User::query()->get()->count())->toBe(0);
});

it('resets a user password and dispatches a reset event', function (): void {
    Event::fake([UserPasswordReset::class]);

    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $action = resolve(ResetUserPassword::class);

    $action->reset($user, [
        'password' => 'NewSecurePassword123!',
        'password_confirmation' => 'NewSecurePassword123!',
    ]);

    expect(Hash::check('NewSecurePassword123!', $user->refresh()->password))->toBeTrue();

    Event::assertDispatched(UserPasswordReset::class, fn (UserPasswordReset $event): bool => $event->userId === $user->id);
});

it('fails to reset a user password when validation fails', function (): void {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $action = resolve(ResetUserPassword::class);

    expect(fn (): mixed => $action->reset($user, [
        'password' => 'NewSecurePassword123!',
        'password_confirmation' => 'mismatch',
    ]))->toThrow(ValidationException::class);

    expect(Hash::check('password', $user->refresh()->password))->toBeTrue();
});

it('updates a user profile and dispatches a profile updated event', function (): void {
    Event::fake([UserProfileUpdated::class]);

    $user = User::factory()->create();

    $action = resolve(UpdateUserProfile::class);

    $result = $action->handle($user, [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
    ]);

    expect($result->userId)->toBe($user->id);
    expect($result->emailChanged)->toBeTrue();

    Event::assertDispatched(UserProfileUpdated::class, fn (UserProfileUpdated $event): bool => $event->userId === $user->id && $event->emailChanged);
});

it('fails to update a profile when required fields are missing', function (): void {
    $user = User::factory()->create();

    $action = resolve(UpdateUserProfile::class);

    expect(fn (): mixed => $action->handle($user, [
        'name' => '',
        'email' => '',
    ]))->toThrow('Name and email are required.');
});

it('updates a user password and dispatches a password updated event', function (): void {
    Event::fake([UserPasswordUpdated::class]);

    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $action = resolve(UpdateUserPassword::class);

    $result = $action->handle($user, 'AnotherSecurePassword123!');

    expect($result->userId)->toBe($user->id);
    expect(Hash::check('AnotherSecurePassword123!', $user->refresh()->password))->toBeTrue();

    Event::assertDispatched(UserPasswordUpdated::class, fn (UserPasswordUpdated $event): bool => $event->userId === $user->id);
});

it('fails to update a password when password is missing', function (): void {
    $user = User::factory()->create();

    $action = resolve(UpdateUserPassword::class);

    expect(fn (): mixed => $action->handle($user, ''))->toThrow('Password is required.');
});
