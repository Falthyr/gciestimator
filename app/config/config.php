<?php

$config = [
    'application' => [
        'baseUri' => '/gciestimator/',
        'controllersDir' => 'app/controllers/',
        'modelsDir' => 'app/models/',
        'libraryDir' => 'app/library/',
        'viewsDir' => 'app/views/',
        'pluginsDir' => 'app/plugins/',
        'voltCacheDir' => 'cache/volt/'
    ],
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'gciestimator'
    ]
];

return $config;
