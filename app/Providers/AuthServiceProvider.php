<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('is-admin', function (User $user) {
            $userRoleType = Auth::user()->userRole;
            if($userRoleType->name == 'admin'){
                return true;
            }
            return false;
        });

        Gate::define('is-editor', function (User $user) {
            $userRoleType = Auth::user()->userRole;
            if($userRoleType->name == 'editor'){
                return true;
            }
            return false;
        });
    }
}
