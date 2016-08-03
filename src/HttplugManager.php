<?php

namespace Http\Httplug;

use Illuminate\Support\Manager;
use Http\Message\StreamFactory;
use Http\Message\MessageFactory;
use Http\Message\ResponseFactory;
use Illuminate\Foundation\Application;
use GuzzleHttp\Client as GuzzleFiveClient;
use Http\Client\Curl\Client as CurlAdapter;
use Http\Adapter\Buzz\Client as BuzzAdapter;
use Http\Adapter\React\Client as ReactAdapter;
use Http\Client\Socket\Client as SocketAdapter;
use Http\Adapter\Guzzle6\Client as GuzzleSixAdapter;
use Http\Adapter\Guzzle5\Client as GuzzleFiveAdapter;

class HttplugManager extends Manager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create a new HttplugManager instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get default driver.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['httplug.default'];
    }

    /**
     * @param string $name
     *
     * @return array
     */
    protected function getConfig($name)
    {
        return $this->app['config']["httplug.adapters.{$name}"];
    }

    /**
     * @return \Http\Adapter\Guzzle6\Client
     */
    public function createGuzzle6Driver()
    {
        return GuzzleSixAdapter::createWithConfig($this->getConfig('guzzle6'));
    }

    /**
     * @return \Http\Adapter\Guzzle5\Client
     */
    public function createGuzzle5Driver()
    {
        return new GuzzleFiveAdapter(
            new GuzzleFiveClient($this->getConfig('guzzle5')),
            $this->app->make(MessageFactory::class)
        );
    }

    /**
     * @return \Http\Client\Curl\Client
     */
    public function createCurlDriver()
    {
        return new CurlAdapter(
            $this->app->make(MessageFactory::class),
            $this->app->make(StreamFactory::class),
            $this->getConfig('curl')
        );
    }

    /**
     * @return \Http\Client\Socket\Client
     */
    public function createSocketDriver()
    {
        return new SocketAdapter(
            $this->app->make(MessageFactory::class),
            $this->getConfig('socket')
        );
    }

    /**
     * @todo  add custom configuration
     *
     * @return \Http\Adapter\Buzz\Client
     */
    public function createBuzzDriver()
    {
        return new BuzzAdapter(
            null,
            $this->app->make(ResponseFactory::class)
        );
    }

    /**
     * @todo  add custom configuration
     *
     * @return \Http\Adapter\React\Client
     */
    public function createReactDriver()
    {
        return new ReactAdapter(
            $this->app->make(ResponseFactory::class)
        );
    }
}
