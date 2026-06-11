<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

use function Pest\Laravel\artisan;

describe('production tests', function (): void {
    beforeEach(function (): void {
        app()->detectEnvironment(fn (): string => 'production');
    });

    it('runs configureDefaults in the app service provider', function (): void {
        config(['app.env' => 'production']);

        expect(Date::now())->toBeInstanceOf(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(true);
        artisan('migrate:fresh')->assertExitCode(Command::FAILURE);

        $rule = Password::defaults();
        $expected = Password::min(12)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
            ->uncompromised();
        expect($rule->appliedRules())->toBe($expected->appliedRules());
    });
});
