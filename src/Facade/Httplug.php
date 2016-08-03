<?php

namespace Http\Httplug\Facade;

use Illuminate\Support\Facades\Facade;

class Httplug extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'httplug';
    }
}
