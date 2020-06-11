<?php

/**
 * File: /app/services_cli.php
 * Description: Services for the console
 * application should be registered here.
 */

use Phalcon\Config;
use Phalcon\Cli\Dispatcher as Dispatcher;
use Phalcon\Mvc\Model\MetaData\Memory as MetadataAdapter;

/**
 * Shared Configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . '/config/config.php';
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
 * Models Metadata Caching
 */
$di->set('modelsMetadata', function () {
    return new MetadataAdapter();
});

/**
 * Create our request dispatcher service
 */
$di->set('dispatcher', function () use ($di) {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('BMS\Tasks');

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