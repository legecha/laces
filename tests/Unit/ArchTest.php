<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Guarded;

arch()->preset()->php();
arch()->preset()->strict();
arch()->preset()->laravel();
arch()->preset()->security()->ignoring([
    'assert',
]);

arch('cased')
    ->expect('App')
    ->toBeCasedCorrectly();

arch('controllers')
    ->expect('App\Http\Controllers')
    ->not->toBeUsed();

arch('fillable')
    ->expect('App\Models')
    ->not->toUse(Fillable::class)
    ->not->toHaveProperty('fillable');

arch('guarded')
    ->expect('App\Models')
    ->not->toUse(Guarded::class)
    ->not->toHaveProperty('guarded');
