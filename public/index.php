<?php

use Phalcon\Mvc\Application;
use Phalcon\Config;

define('APP_PATH', realpath('..') . '/');

$config = new Config(require APP_PATH . 'app/config/config.php');

require APP_PATH . 'app/config/services.php';
require APP_PATH . 'app/config/loader.php';

$application = new Application($di);

try {
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}
