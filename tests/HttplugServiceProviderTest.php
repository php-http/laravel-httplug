<?php

namespace Http\Httplug;

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
}
