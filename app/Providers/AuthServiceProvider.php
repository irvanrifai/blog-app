<?php

namespace App\Providers;

use App\Models\Post;
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
            return $user->role == null;
        });

        Gate::define('isAdmin', function (User $user) {
            return $user->role == 1;
        });

        Gate::define('read_post', ([Post::class, 'index']));

        // Gate::define('create_post', ([Post::class, 'store']));

        Gate::define('create_post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('update_post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('delete_post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('create_user', ([User::class, 'store']));

        Gate::define('update_user', function (User $user) {
            return $user->id === auth()->user()->id;
        });

        Gate::define('delete_user', function (User $user) {
            return $user->id === auth()->user()->id;
        });
    }
}
