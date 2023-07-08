<?php

namespace App\Providers;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryInterface;
use App\Repositories\Products\CategoryRepository;
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
        $this->app->bind(CategoryInterface::class, function () {
            return new CategoryRepository(new Category());
        });
    }
}
