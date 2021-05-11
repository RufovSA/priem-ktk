<?php
return [
    'url' => [
        'api_path' => 'api',
        'admin_path' => 'admin'
    ],
    'default_lang' => 'ru',
    'components' => [
        'request' => [
            'onlySSL' => false,
            'enableCookieValidation' => true,
            'cookieValidationKey' => '7843hfdjks8',
            'multiCookieDomain' => true
        ],
        'user' => [
            'identityClass' => 'Reagordi\\CMS\\Components\\User',
            'loginUrl' => 'auth',
            'reg' => false
        ]
    ],
    'cache' => [
        'type' => 'files',
        'value' => [
            'host' => 'localhost',
            'port' => 6379
        ]
    ]
];
