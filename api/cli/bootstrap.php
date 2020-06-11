<?php

/**
 * File /cli/bootstrap.php
 * Description: Contains bootstrap code
 * necessary to start up our console
 * application.
 */

use BMS\ConsoleApplication;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Di\FactoryDefault\Cli as CliDi;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$di = new CliDi();

include APP_PATH . '/config/services_cli.php';

$config = $di->get('config');

require APP_PATH . '/config/loader.php';

/**
 * Composer Autoloader
 */
include BASE_PATH . '/vendor/autoload.php';

// Create a console application
$console = new ConsoleApplication();

$console->setDI($di);

/**
 * Process the console arguments
 */
$arguments = [];

foreach ($argv as $k => $arg) {
    if ($k === 1) {
        $arguments['task'] = $arg;
    } elseif ($k === 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

try {

    /**
     * Handle
     */
    $console->handle($arguments);

    /**
     * If configs is set to true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    if (isset($config["printNewLine"]) && $config["printNewLine"]) {
        echo PHP_EOL;
    }

} catch (Exception $e) {
    // Log errors
    $console->logger->error('Error: ' . $e->getMessage());
    $console->logger->error('Trace: ' . $e->getTraceAsString());

    // Show errors on console output
    echo $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(255);
}
