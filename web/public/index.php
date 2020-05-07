<?php

use MovieSpace\Application;
use Phalcon\Config;
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH. '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Configure services and inject them into
     * the DI container
     */
    require APP_PATH . '/config/services.php';

    /**
     * Handle routes
     */
    include APP_PATH . '/config/routes.php';

    /**
     * Get config service for use in inline setup below
     */
    /** @var Config $config */
    $config = $di->get('config');

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Inclusion Vendor
     */
    include BASE_PATH . '/vendor/autoload.php';

    /**
     * Create the web application and
     * handle requests
     */
    $application = new Application($di);
    echo $application->handle($_GET['_url'] ?? '/')->getContent();

} catch (\Exception $e) {

    /**
     * Logs any exception thrown into
     * the /logs/application.log file.
     */
    $application->logger->error(json_encode([
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]));
}