<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('visit_admin', function(User $user){
            return $user->role === 'admin' && $user->suspended == 0 && $user->deactivated == 0;
        });

        Gate::define('visit_user', function (User $user) {
            return $user->role === 'user' && $user->suspended == 0 && $user->deactivated == 0;
        });

        Gate::define('visit_suspended', function (User $user) {
            return $user->suspended == 1;
        });

        Gate::define('visit_deactivated', function (User $user) {
            return $user->deactivated == 1;
        });
    }
}
