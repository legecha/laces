<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\DataTransferObjects\UserProfileUpdateResultDto;
use App\Events\Users\UserProfileUpdated;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

final readonly class UpdateUserProfile
{
    /**
     * Update the authenticated user's profile details.
     *
     * @param  array{name: string, email: string}  $attributes
     */
    public function handle(User $user, array $attributes): UserProfileUpdateResultDto
    {
        throw_if($attributes['name'] === '' || $attributes['email'] === '', InvalidArgumentException::class, 'Name and email are required.');

        return DB::transaction(function () use ($attributes, $user): UserProfileUpdateResultDto {
            $emailChanged = $user->email !== $attributes['email'];

            $user->update([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'email_verified_at' => $emailChanged ? null : $user->email_verified_at,
            ]);

            event(new UserProfileUpdated(
                userId: $user->id,
                emailChanged: $emailChanged,
            ));

            return new UserProfileUpdateResultDto(
                userId: $user->id,
                emailChanged: $emailChanged,
            );
        });
    }
}
