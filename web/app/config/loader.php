<?php

/**
 * File: /app/loader.php
 * Description: This file auto-loads classes
 * and/or namespaces.
 */

use Phalcon\Loader as Loader;

$loader = new Loader();

$loader->registerNamespaces([
    'MovieSpace\Controllers'    => $config->application->controllersDir,
    'MovieSpace\Forms'          => $config->application->formsDir,
    'MovieSpace\Models'         => $config->application->modelsDir,
    'MovieSpace\Plugins'        => $config->application->pluginsDir,
    'MovieSpace'                => $config->application->libraryDir
]);

$loader->register();