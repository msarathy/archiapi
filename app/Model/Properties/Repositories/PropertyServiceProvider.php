<?php
namespace App\Model\Properties\Repositories;

use Illuminate\Support\ServiceProvider;


class PropertyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Model\Properties\Repositories\PropertyServiceProvider', 'App\Model\Properties\Repositories\PropertyRepository');
    }
}
