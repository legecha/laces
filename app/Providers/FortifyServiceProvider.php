<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

final class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(fn (): Factory|View => view('pages::auth.login'));
        Fortify::verifyEmailView(fn (): Factory|View => view('pages::auth.verify-email'));
        Fortify::twoFactorChallengeView(fn (): Factory|View => view('pages::auth.two-factor-challenge'));
        Fortify::confirmPasswordView(fn (): Factory|View => view('pages::auth.confirm-password'));
        Fortify::registerView(fn (): Factory|View => view('pages::auth.register'));
        Fortify::resetPasswordView(fn (): Factory|View => view('pages::auth.reset-password'));
        Fortify::requestPasswordResetLinkView(fn (): Factory|View => view('pages::auth.forgot-password'));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', fn (Request $request) => Limit::perMinute(5)->by($request->session()->get('login.id')));

        RateLimiter::for('login', function (Request $request) {
            $usernameInput = $request->input(Fortify::username());
            $username = is_string($usernameInput) ? $usernameInput : '';
            $throttleKey = Str::transliterate(Str::lower($username).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }
}
