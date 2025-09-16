<?php

declare(strict_types=1);

pest()
    ->extend(Illuminate\Foundation\Testing\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class);

pest()
    ->in('Feature')
    ->group('feature');

pest()
    ->in('Unit')
    ->group('unit');
