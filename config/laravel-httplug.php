<?php

return [

    'main_alias' => [
        'client' => 'httplug.client.default',
        'message_factory' => 'httplug.message_factory.default',
        'uri_factory' => 'httplug.uri_factory.default',
        'stream_factory' => 'httplug.stream_factory.default',
    ],

    'classes' => [
        # uses discovery if not specified
        'client' => '',
        'message_factory' => '',
        'uri_factory' => '',
        'stream_factory' => '',
    ],

    'clients' => [
        'acme' => [
            'factory' => 'httplug.factory.guzzle6',
            'plugins' => ['httplug.plugin.authentication.my_wsse', 'httplug.plugin.cache', 'httplug.plugin.retry'],
            'config' => [
                'verify' => false,
                'timeout' => 2,
                # more options to the guzzle 6 constructor
            ],
        ],
    ],
];
