<?php
namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Task::class => TaskPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
