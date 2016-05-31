<?php

/*
 * This file is part of the laravel-httplug Project.
 *
 * (c) laravel-httplug <mathieu.santostefano@gmail.com>
 */

namespace Http\LaravelHttplug;

use Http\Client\HttpClient;

class Httplug
{
    /** @var HttpClient */
    private $client;

    public function __construct()
    {
        $this->client = '';
    }
}
