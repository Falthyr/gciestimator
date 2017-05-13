<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;

$di = new FactoryDefault();

$di->set(
    "view",
    function () use ($config) {
        $view = new View();
        $view->setViewsDir(APP_PATH . $config->application->viewsDir);
        $view->registerEngines(
            [
                ".volt" => function ($view, $di) use ($config) {
                    $volt = new Volt($view, $di);
                    $volt->setOptions(
                        [
                            "compiledPath" => APP_PATH . $config->application->voltCacheDir,
                        ]
                    );

                    return $volt;
                }
            ]
        );

        return $view;
    }
);

$di->set(
    "url",
    function () use ($config) {
        $url = new UrlProvider();
        $url->setBaseUri($config->application->baseUri);

        return $url;
    }
);

$di->set(
    "db",
    function () use ($config) {
        return new DbAdapter((array) $config->database);
    }
);

$di->set(
    "session",
    function () {
        $session = new Session();
        $session->start();

        return $session;
    }
);

$di->set(
    "flash",
    function () {
        return new FlashSession(array(
            'error' => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ));
    }
);

$di->set(
    "elements",
    function () {
        return new Elements();
    }
);

$di->set(
    "dispatcher",
    function () {
        $eventsManager = new EventsManager();

        $eventsManager->attach(
            "dispatch:beforeExecuteRoute",
            new SecurityPlugin()
        );

        $eventsManager->attach(
            "dispatch:beforeException",
            new NotFoundPlugin()
        );

        $dispatcher = new Dispatcher();
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }
);
