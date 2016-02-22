<?php

/*
 * This file is part of the laravel-httplug Project.
 *
 * (c) laravel-httplug <mathieu.santostefano@gmail.com>
 */

namespace Http\Httplug;

use Illuminate\Support\Facades\Facade;

class HttplugFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'http-httplug';
    }
}
