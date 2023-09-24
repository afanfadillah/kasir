<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('welcome', 'Home::welcome');

$routes->get('kasir', 'Home::index');

$routes->get('menu', 'Menu::index');
$routes->post('menu', 'Menu::tambah');
$routes->put('menu/(:num)', 'Menu::ubah/$1');
$routes->delete('menu/(:num)', 'Menu::hapus/$1');
