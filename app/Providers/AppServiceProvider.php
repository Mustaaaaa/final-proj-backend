<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
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
        View::composer('partials.header', function($view)
        {
            $user_id = Auth::id();
            $companies = Company::where('user_id', $user_id)->get();

            $view->with(compact('user_id', 'companies'));
        });
    }
}
