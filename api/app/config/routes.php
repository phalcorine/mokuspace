<?php

/**
 * File: /app/routes.php
 * Description: URL custom routes are
 * defined here using the Router
 * component.
 */

use BMS\Routes\InventoryRoutes;
use Phalcon\Mvc\Router;

/** @var Router $router */
$router = $di->get('router');
$router->setDefaultNamespace('BMS\Controllers');

// Define Custom Routes here...
/**
 * Named routes are used for custom link
 * generation and other fun stuff. The
 * conventions used is action plus
 * controller separated by an underscore
 */

// System Health
$router->addGet('/health', [
    'controller'    => 'index',
    'action'        => 'health'
])->setName('health_index');

// Login
$router->addPost('/login', [
    'controller'    => 'index',
    'action'        => 'login'
])->setName('login_index');

// Register
$router->addPost('/register', [
    'controller'    => 'index',
    'action'        => 'register'
])->setName('register_index');

// Product Type Routes
$router->addGet('/', [
    'controller'    => 'movies',
    'action'        => 'allMovies'
])->setName('movies_all');

$router->addGet('/movie/{id:[0-9]+}', [
    'controller' => 'movies',
    'action'     => 'info',
])->setName('movies_info');

// User Routes
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

// ====== Router Groups =========
// Inventory Routes
$router->mount(new InventoryRoutes());

$router->handle($_GET['_url'] ?? '/');