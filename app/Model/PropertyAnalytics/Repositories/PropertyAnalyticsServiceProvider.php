<?php
namespace App\Model\PropertyAnalytics\Repositories;

use Illuminate\Support\ServiceProvider;


class PropertyAnalyticsServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Model\PropertyAnalytics\Repositories\PropertyAnalyticsServiceProvider', 'App\Model\PropertyAnalytics\Repositories\PropertyAnalyticsRepository');
    }
}
