<?php

/*
 * This file is part of the laravel-httplug Project.
 *
 * (c) laravel-httplug <mathieu.santostefano@gmail.com>
 */

namespace Http\LaravelHttplug;

use Illuminate\Support\ServiceProvider;

class HttplugServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-httplug.php' => $this->app->configPath().'/'.'laravel-httplug.php',
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-httplug.php', 'laravel-httplug');
        $this->app->bind(Httplug::class, function () {
            return new Httplug();
        });

        $config = config('laravel-httplug');

        foreach ($config['classes'] as $service => $class) {
            if (!empty($class)) {
                $this->app->register(sprintf('httplug.%s.default', $service), function() use($class) {
                    return new $class();
                });
            }
        }

        foreach ($config['main_alias'] as $type => $id) {
            $this->app->alias(sprintf('httplug.%s', $type), $id);
        }

        $this->app->alias(Httplug::class, 'laravel-httplug');
    }
}
