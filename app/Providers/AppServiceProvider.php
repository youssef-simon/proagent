<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


use App\Policies\SubjectPolicy;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;

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
         Schema::defaultStringLength(191);
		 
		 	    Gate::policy(Subject::class, SubjectPolicy::class);
		Gate::policy(Post::class, PostPolicy::class);
    }
}
