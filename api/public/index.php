<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application as MvcApplication;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Configure services and inject into the
     * DI container.
     */
    include APP_PATH . '/config/services.php';

    /**
     * Load our shared configuration object...
     */
    $config = $di->get('config');

    /**
     * Autoloader
     */
    require APP_PATH . '/config/loader.php';

    /**
     * Composer Autoloader
     */
    include BASE_PATH . '/vendor/autoload.php';

    /**
     * Handle routes
     */
    include APP_PATH . '/config/routes.php';

    /**
     * Create the web application and
     * handle requests
     */
    $application = new MvcApplication($di);
    echo $application->handle($_GET['_url'] ?? '/')->getContent();

} catch (\Exception $exception) {

    /**
     * Logs any exception thrown into
     * the /logs/application.log file.
     */
    $application->logger->error(
        json_encode([
            'message'   =>$exception->getMessage(),
            'trace'     => $exception->getTraceAsString()
        ])
    );
}