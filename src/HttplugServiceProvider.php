<?php

/*
 * This file is part of the laravel-httplug Project.
 *
 * (c) laravel-httplug <mathieu.santostefano@gmail.com>
 */

namespace Http\Httplug;

use Illuminate\Support\ServiceProvider;

class HttplugServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-httplug.php' => $this->app->configPath().'/'.'laravel-httplug.php',
        ], 'config');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-httplug.php', 'laravel-httplug');

        $this->app->bind('http-httplug', function () {
            return new Httplug();
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides()
    {
        return ['laravel-http-httplug'];
    }
}
