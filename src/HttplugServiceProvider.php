<?php

namespace Http\Httplug;

use Http\Message\UriFactory;
use Http\Message\StreamFactory;
use Http\Message\MessageFactory;
use Http\Message\ResponseFactory;
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
        $this->publishes([$source => config_path('httplug.php')], 'config');
        $this->mergeConfigFrom($source, 'httplug');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerHttplugFactories();
        $this->registerHttplug();
    }

    /**
     * Register php-http interfaces to container.
     */
    protected function registerHttplugFactories()
    {
        $this->app->bind('httplug.message_factory.default', function ($app) {
            return MessageFactoryDiscovery::find();
        });
        $this->app->alias('httplug.message_factory.default', MessageFactory::class);
        $this->app->alias('httplug.message_factory.default', ResponseFactory::class);

        $this->app->bind('httplug.uri_factory.default', function ($app) {
            return UriFactoryDiscovery::find();
        });
        $this->app->alias('httplug.uri_factory.default', UriFactory::class);

        $this->app->bind('httplug.stream_factory.default', function ($app) {
            return StreamFactoryDiscovery::find();
        });
        $this->app->alias('httplug.stream_factory.default', StreamFactory::class);
    }

    /**
     * Register httplug to container.
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
            'httplug.message_factory.default',
            'httplug.uri_factory.default',
            'httplug.stream_factory.default',
            MessageFactory::class,
            ResponseFactory::class,
            StreamFactory::class,
            UriFactory::class,

        ];
    }
}
