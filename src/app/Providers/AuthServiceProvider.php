<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('supper-admin', function (User $user) {
            return $user->isSupperAdmin();
        });

        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('access-field', function (User $user) {
            return $user->isAccessFiled();
        });

        Gate::define('update-collection', function ($user, $collection) {
            return $user->user_id === $collection->created_by;
        });

        Gate::define('edit-collection', function ($user, $collection) {
            return $user->user_id === $collection->created_by;
        });
    }
}
