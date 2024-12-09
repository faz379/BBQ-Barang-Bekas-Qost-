<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BarangController::home');

$routes->get('/barang', 'BarangController::index');
$routes->get('barang/create', 'BarangController::create');
$routes->post('barang/store', 'BarangController::store');
$routes->get('barang/edit/(:num)', 'BarangController::edit/$1');
$routes->post('barang/update/(:num)', 'BarangController::update/$1');
$routes->get('barang/show/(:num)', 'BarangController::show/$1');
$routes->get('barang/showHome/(:num)', 'BarangController::showHome/$1');
$routes->get('barang/delete/(:num)', 'BarangController::delete/$1');

service('auth')->routes($routes);


$routes->get('db', 'TestController::index');