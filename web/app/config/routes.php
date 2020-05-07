<?php

/**
 * File: /app/routes.php
 * Description: URL custom routes are
 * defined here using the Router
 * component.
 */

/** @var Router $router */

use Phalcon\Mvc\Router;

$router = $di->get('router');
$router->setDefaultNamespace('MovieSpace\Controllers');

// System health check
$router->add('/health', [
    'controller'    => 'index',
    'action'        => 'health'
])->setName('health');

/** Authentication */
// Register
$router->add('/register', [
    'controller' => 'index',
    'action'     => 'register',
])->setName('register');

$router->add('/logout', [
    'controller' => 'index',
    'action'     => 'logout',
])->setName('logout');

/** Movie Routes */
$router->addGet('/movies', [
    'controller' => 'movie',
    'action'     => 'index',
])->setName('movies');

$router->addGet('/movie/{id:[0-9]+}', [
    'controller' => 'movie',
    'action'     => 'detail',
])->setName('detail_movie');

/** User Routes */
$router->addGet('/user/movies', [
    'controller'    => 'user',
    'action'        => 'movies'
])->setName('user_movies');

$router->addGet('/user/movies/fav/{id:[0-9]+}', [
    'controller'    => 'user',
    'action'        => 'movieFav'
])->setName('user_movieFav');

$router->addGet('/user/movies/unfav/{id:[0-9]+}', [
    'controller'    => 'user',
    'action'        => 'movieUnFav'
])->setName('user_movieUnFav');

// Movie Movie Routes
//$router->add('/movie/')

// Handle routes
$router->handle($_GET['_url'] ?? '/');

