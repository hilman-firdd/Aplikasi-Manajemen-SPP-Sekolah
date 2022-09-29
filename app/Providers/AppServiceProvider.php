<?php

namespace App\Providers;

use App\Models\Pengaturan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('sitename', 'Aplikasi SPP | SMKK Bhakti Kencana');
        View()->composer('*', function($view) {
            $view->with('pengaturan', Pengaturan::first());
        });
    }
}
