<?php

/**
 * File: /app/services.php
 * Description: Services for the web
 * application should be registered here.
 */

use MovieSpace\ApiClient;
use MovieSpace\Plugins\SecurityPlugin;
use Phalcon\Config;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Flash\Session as FlashService;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Model\MetaData\Memory as MetadataAdapter;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($di) {
    /** @var Config $config */
    $config = $this->get('config');

    $url = new UrlResolver();
    $url->setBaseUri($config->path('application.baseUri'));

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($di) {
    /** @var Config $config */
    $config = $di->get('config');

    $view = new View();
    $view->setDI($di);
    $view->setViewsDir($config->path('application.viewsDir'));

    $view->registerEngines([
        '.volt'  => function ($view) use ($config, $di) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions([
                'compileAlways'     => true,
                'compiledPath'      => $config->path('application.cacheDir') . 'volt/',
                'compiledSeparator' => '_'
            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the
 * parameters defined in the configuration file
 */
$di->setShared('db', function () use ($di) {
    /** @var Config $config */
    $config = $this->get('config');

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->path('database.adapter');
    $params = [
        'host'     => $config->path('database.host'),
        'port'     => $config->path('database.port'),
        'username' => $config->path('database.username'),
        'password' => $config->path('database.password'),
        'dbname'   => $config->path('database.dbname'),
        'charset'   => $config->path('database.charset')
    ];

    // IF adapter is Sqlite, we would want to connect to an sqlite file db instead
    if($config->path('database.adapter') == 'Sqlite') {
        $params['dbname'] = BASE_PATH . "db/{$config->path('database.dbname')}";
    }

    // If adapter is Postgresql, then we should remove the charset from the DSN
    if($config->path('database.adapter') == 'Postgresql') {
        $params['dbname'] = BASE_PATH . "db/{$config->path('database.dbname')}";
    }

    /** @var $connection */
    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flashSession', function () {
    return new FlashService([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->set('dispatcher', function () {
    $eventsManager = new EventsManager();

    $eventsManager->attach('dispatch', new SecurityPlugin());

    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

/**
 * Custom Logger component
 */
$di->setShared('logger',  function () {
    $logger = new Phalcon\Logger\Adapter\File(
        BASE_PATH . '/logs/application.log'
    );
    $logger->setLogLevel(Phalcon\Logger::ERROR);

    return $logger;
});

/**
 * Our API Client :)
 */
$di->setShared('api', function () use ($di) {
    /** @var Config $config */
    $config = $di->get('config');
    $apiClient = new ApiClient(
        $config->path('api.url'), $di->get('session')
    );

    return $apiClient;
});