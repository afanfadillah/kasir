<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('kasir', 'Home::index');

$routes->get('menu', 'Menu::index');
