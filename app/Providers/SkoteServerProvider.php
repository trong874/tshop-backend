<?php

namespace App\Providers;

use App\Classes\Theme\Init;
use Illuminate\Support\ServiceProvider;

class SkoteServerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Init::run();
    }
}
