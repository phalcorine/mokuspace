<?php

/**
 * File: /app/loader.php
 * Description: This file auto-loads classes
 * and/or namespaces.
 */

use Phalcon\Loader as Loader;

$loader = new Loader();

$loader->registerNamespaces([
    'BMS\Controllers'    => $config->application->controllersDir,
    'BMS\Models'         => $config->application->modelsDir,
    'BMS\Plugins'        => $config->application->pluginsDir,
    'BMS\Routes'         => $config->application->routesDir,
    'BMS\Tasks'          => $config->application->tasksDir,
    'BMS'                => $config->application->libraryDir
]);

$loader->register();