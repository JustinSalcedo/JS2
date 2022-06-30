<?php

namespace App\Providers;

use App\Http\Controllers\Resume\ResumeController;
use App\Models\Blog;
use App\Policies\BlogPolicy;
use App\Policies\EditorPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Blog::class => BlogPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-resume', [EditorPolicy::class, 'edit']);
    }
}
