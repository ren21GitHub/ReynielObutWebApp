<?php

namespace App\Providers;

use App\Models\Students;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        //
        // View::share('title', 'sadfas');
        // View::share('loginTitle', 'Student Admin');//pwede din gamitin to para sa title
        /* View::composer('students.index', function($view){
            $view->with('students', Students::all());
        }); */
    }
}
