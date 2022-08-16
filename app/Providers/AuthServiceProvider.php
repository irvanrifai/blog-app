<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('isUser', function (User $user) {
            return $user->role === 1;
        });

        Gate::define('isAdmin', function (User $user) {
            return $user->role === 2;
        });

        Gate::define('do_read', function ($user, $url) {
            return session('access')->where('url', $url)
                ->where('type', 'Read')->isNotEmpty();
        });

        Gate::define('do_create', function ($user, $raw) {
            return session('permissions')->where('raw', $raw)
                ->isNotEmpty();
        });

        Gate::define('do_update', function ($user, $raw) {
            return session('permissions')->where('raw', $raw)
                ->isNotEmpty();
        });

        Gate::define('do_delete', function ($user, $raw) {
            return session('permissions')->where('raw', $raw)
                ->isNotEmpty();
        });
    }
}
