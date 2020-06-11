<?php

/**
 * File: /app/services.php
 * Description: Services for the web api
 * application should be registered here.
 */

use BMS\Helper\Json;
use BMS\Models\AppUser;
use BMS\Plugins\ResponsePlugin;
use BMS\Plugins\SecurityPlugin;
use Phalcon\Config;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Http\Request;
use Phalcon\Flash\Session as FlashService;
use Phalcon\Mvc\Dispatcher as Dispatcher;
use Phalcon\Mvc\Model\MetaData\Memory as MetadataAdapter;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * Shared Configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . '/config/config.php';
});

/**
 * Url Resolver
 */
$di->set('url', function () use ($di) {

    /** @var Config $config */
    $config = $di->get('config');
    /** @var string $baseUri */
    $baseUri = $config->path('application.baseUri');

    $url = new UrlResolver();
    $url->setBaseUri($baseUri);

    return $url;
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
        $params['dbname'] = BASE_PATH . "/db/{$config->path('database.dbname')}.sqlite3";
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
 * Setting up (or not?) the view component.
 * Since this is an API module, we will be
 * disabling the view
 */
$di->setShared('view', function () {
    $view = new Phalcon\Mvc\View();

    $view->disable();

    return $view;
});

/**
 * Models Metadata Caching
 */
$di->set('modelsMetadata', function () {
    return new MetadataAdapter();
});

/**
 * Session Setup
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
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
 * Create our request dispatcher service
 */
$di->set('dispatcher', function () use ($di) {
    $eventsManager = new EventsManager();

    /**
     * Attach event handlers
     */
    // Handles security / exception handling
    $eventsManager->attach('dispatch', new SecurityPlugin());
    // Handles normalization of successful JSON responses
    $eventsManager->attach('dispatch:afterExecuteRoute', new ResponsePlugin());

    $dispatcher = new Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    $dispatcher->setDefaultNamespace('BMS\Controllers');

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

$di->set('user', function () use ($di) {
    /** @var Request $httpRequest */
    $httpRequest = $di->get('request');
    /** @var Config $config */
    $config = $di->get('config');
    $userIdToken = null;

    $attributes = Json::getJsonRawBodyFromHttpRequest($httpRequest);

    try {
        $userIdToken = @SecurityPlugin::getUserIdFromToken($config, $attributes->token ?? null);
    } catch (Exception $exception) {
        // No exceptions get caught here. Ever. I don't know why
    }

    // Attempt to fetch the user from the db
    $user = AppUser::findFirst([
        'conditions'    => 'userToken = :token:',
        'bind'  => [
            'token'     => $userIdToken
        ]
    ]);

    return $user;
});

