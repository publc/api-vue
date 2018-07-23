<?php

return [
    'app' => [
        'url' => 'url',
        'root' => dirname(dirname(__FILE__)),
        'name' => 'AppName',
    ],
    'hash' => [
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10
    ],
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'user' => 'user',
        'pass' => 'pass',
        'name' => 'dbName',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'options' => [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    'mail' => [
        'host' => 'host',
        'port' => 25,
        'secure' => ['ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]],
        'user' => 'user_email',
        'pass' => 'user_pass',
        'from' => 'from_email',
        'smtp_auth' => true,
        'charset' => 'utf-8'
    ],
    'remember' => [
        'name' => 'remember',
        'exp' => time() + (60 * 60 * 24 * 30)
    ],
    'session' => [
        'session_name' => 'user',
        'token_name' => 'token'
    ],
    'jwt' => [
        'secret' => 'secret',
        'payload' => [
            'iat' => time(),
            'iss' => 'url',
            'exp' => time() + (60 * 60)
        ]
    ],
    'protocol_response' => [
        '404' => '../views/protocols/404.php'
    ]
];
