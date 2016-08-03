<?php

namespace Http\Httplug;

use Http\Message\MessageFactory;
use Http\Message\ResponseFactory;
use Http\Message\UriFactory;
use Http\Message\StreamFactory;
use Http\Client\Curl\Client as CurlAdapter;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

class HttplugServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    /**
     * @test
     */
    public function canInjectManager()
    {
        $this->assertIsInjectable(HttplugManager::class);
    }

    /**
     * @test
     */
    public function canInjectMessageFactory()
    {
        $this->assertIsInjectable(MessageFactory::class);
    }

    /**
     * @test
     */
    public function canInjectResponseFactory()
    {
        $this->assertIsInjectable(ResponseFactory::class);
    }

    /**
     * @test
     */
    public function canInjectUriFactory()
    {
        $this->assertIsInjectable(UriFactory::class);
    }

    /**
     * @test
     */
    public function canInjectStreamFactory()
    {
        $this->assertIsInjectable(StreamFactory::class);
    }
}
