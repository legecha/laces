<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\DataTransferObjects\UserPasswordUpdateResultDto;
use App\Events\Users\UserPasswordUpdated;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

final readonly class UpdateUserPassword
{
    /**
     * Update the authenticated user's password.
     */
    public function handle(User $user, string $password): UserPasswordUpdateResultDto
    {
        throw_if($password === '', InvalidArgumentException::class, 'Password is required.');

        return DB::transaction(function () use ($password, $user): UserPasswordUpdateResultDto {
            $user->update([
                'password' => $password,
            ]);

            event(new UserPasswordUpdated(userId: $user->id));

            return new UserPasswordUpdateResultDto(userId: $user->id);
        });
    }
}
