<?php

declare(strict_types=1);

use App\Models\User;

it('renders the confirm password screen', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('password.confirm'));

    $response->assertOk();
});
