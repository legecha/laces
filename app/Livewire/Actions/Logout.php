<?php

declare(strict_types=1);

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

final class Logout
{
    /**
     * Log the current user out of the application.
     *
     * Livewire intercepts redirect responses at runtime and replaces them
     * with a Livewire redirect instruction, so this method must not declare
     * a concrete return type.
     *
     * @phpstan-ignore missingType.return
     */
    public function __invoke()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
