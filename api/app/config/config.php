<?php

/**
 * File: /app/config.php
 * Description: Shared Configuration file
 * for both the console and web applications
 */

use Phalcon\Config;

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new Config([
    'database'    => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'zephir_bms_db',
        'charset'  => 'utf8',
        'port'     => '3306'
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'routesDir'      => APP_PATH . '/routes/',
        'libraryDir'     => APP_PATH . '/library/',
        'tasksDir'       => APP_PATH . '/tasks/',
        'cacheDir'       => BASE_PATH . '/cache/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the web space.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ],
    'security'    => [
        'key'                => 'gMp0ScgdeH/mPL^.0!=yUvlQ\'YX8j$S5UQB,%|Rg{C,/}6SZn$)*>%(Lm+#<Fve'
    ],
    'api'   => [
        'url'           => 'https://wootlab-moviedb.herokuapp.com/api/',
        'moviesRoute'   => 'movie/list/all'
    ],
    'printNewLine' => true
]);