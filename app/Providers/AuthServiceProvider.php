<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isGod', function($user) {
            return $user->born_rights == 'god';
        });

        Gate::define('isGodling', function($user) {
            return $user->born_rights == 'godling' || $user->born_rights == 'god';
        });

        Gate::define('isMortal', function($user) {
            return $user->born_rights == 'mortal' || $user->born_rights == 'godling' || $user->born_rights == 'god';
        });


        Gate::define('update-post', [PostPolicy::class, 'update']);

    }
}
