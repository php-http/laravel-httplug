<?php

namespace Http\Httplug;

use Illuminate\Support\ServiceProvider;
use Http\Discovery\UriFactoryDiscovery;
use Http\Discovery\StreamFactoryDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

class HttplugServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
 
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $source = __DIR__.'/../config/laravel-httplug.php';
        $this->publishes([$source => config_path('httplug.php')]);
        $this->mergeConfigFrom($source, 'httplug');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHttplugFactories();
        $this->registerHttplug();
    }

    /**
     * Register php-http interfaces to container
     *
     * @return void
     */
    protected function registerHttplugFactories()
    {
        $this->app->bind('httplug.message_factory.default', function ($app) {
            return MessageFactoryDiscovery::find();
        });
        $this->app->alias('httplug.message_factory.default', 'Http\Message\MessageFactory');
        $this->app->alias('httplug.message_factory.default', 'Http\Message\ResponseFactory');

        $this->app->bind('httplug.uri_factory.default', function ($app) {
            return UriFactoryDiscovery::find();
        });
        $this->app->alias('httplug.uri_factory.default', 'Http\Message\UriFactory');

        $this->app->bind('httplug.stream_factory.default', function ($app) {
            return StreamFactoryDiscovery::find();
        });
        $this->app->alias('httplug.stream_factory.default', 'Http\Message\StreamFactory');
    }

    /**
     * Register httplug to container
     *
     * @return void
     */
    protected function registerHttplug()
    {
        $this->app->singleton('httplug', function ($app) {
            return new HttplugManager($app);
        });
        $this->app->alias('httplug', HttplugManager::class);

        $this->app->singleton('httplug.default', function ($app) {
            return $app['httplug']->driver();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'httplug',
            'httplug.default',

        ];
    }
}
