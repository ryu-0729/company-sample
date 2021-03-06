<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Post;

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
        'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class, //Postポリシーの登録
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 権限の設定

        // 管理者のみ許可
        Gate::define('admin-only', function ($user) {
            return $user->role == '管理者';
        });

        // 開発者と管理者に許可
        Gate::define('system-higher', function ($user) {
            return $user->role == '管理者' || $user->role == '開発者';
        });

        // 全ユーザーに許可
        Gate::define('user-higher', function ($user) {
            return $user->role == '管理者' || $user->role == '開発者' || $user->role === '社員';
        });
    }
}
