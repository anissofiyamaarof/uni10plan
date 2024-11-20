<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Updating;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isManager', function ($user) {
            return $user->userLevel === 'manager';
        });

        Gate::define('isDeveloper', function ($user) {
            return $user->userLevel === 'developer';
        });

        Gate::define('isUser', function ($user) {
            return $user->userLevel === 'user';
        });

    }
}
