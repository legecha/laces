<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

final readonly class UserPasswordUpdateResultDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $userId,
    ) {}
}
