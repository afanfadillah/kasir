<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('welcome', 'Home::welcome');

$routes->get('kasir', 'Home::index',['filter'=>'role:manager,kasir']);
$routes->post('kasir', 'Home::addKeranjang');
$routes->post('kasir/keranjang', 'Home::hapusKeranjang');
$routes->post('kasir/pembayaran', 'Home::simpanTransaksi');
$routes->post('kasir/bayar', 'Home::bayarPesanan');
$routes->get('sukses', 'Home::suksesTransaksi');
$routes->get('gagal', 'Home::gagalTransaksi');

$routes->get('menu', 'Menu::index',['filter'=>'role:manager']);
$routes->post('menu', 'Menu::tambah',['filter'=>'role:manager']);
$routes->put('menu/(:num)', 'Menu::ubah/$1',['filter'=>'role:manager']);
$routes->delete('menu/(:num)', 'Menu::hapus/$1',['filter'=>'role:manager']);
