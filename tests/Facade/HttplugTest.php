<?php

namespace Http\Httplug\Facade;

use Http\Httplug\HttplugManager;
use Http\Httplug\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class HttplugTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'httplug';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Httplug::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return HttplugManager::class;
    }
}
