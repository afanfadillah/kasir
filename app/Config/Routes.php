<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('welcome', 'Home::welcome');

$routes->get('kasir', 'Home::index',['filter'=>'role:manager,kasir']);
$routes->post('kasir', 'Home::addKeranjang');

$routes->get('menu', 'Menu::index',['filter'=>'role:manager']);
$routes->post('menu', 'Menu::tambah',['filter'=>'role:manager']);
$routes->put('menu/(:num)', 'Menu::ubah/$1',['filter'=>'role:manager']);
$routes->delete('menu/(:num)', 'Menu::hapus/$1',['filter'=>'role:manager']);
