<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Responses\LogoutResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Http\Responses\LoginResponse;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\PostController;
use App\Http\Responses\LoginResponse as ResponsesLoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse as ContractsLogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Redireccionar rutas de respuestas ubicamos la funcionde de la pensataña que deseamos imprimir 
        //                   /
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });


        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
     
            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }
}
