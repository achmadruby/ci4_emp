<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->post('/authprocess', 'LoginController::processLogin');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/dashboard', 'DashboardController::index');

$routes->group('emp', function ($routes) {
    $routes->get('/', 'KaryawanController::index');
    $routes->get('create', 'KaryawanController::create');
    $routes->post('store', 'KaryawanController::store');
    $routes->get('edit/(:num)', 'KaryawanController::edit/$1');
    $routes->post('update/(:num)', 'KaryawanController::update/$1');
    $routes->get('delete/(:num)', 'KaryawanController::delete/$1');
    $routes->get('detail/(:num)', 'KaryawanController::detail/$1');
});

$routes->group('sertifikat', function ($routes) {
    $routes->get('/', 'SertifikatController::index');
    $routes->get('create', 'SertifikatController::create');
    $routes->post('store', 'SertifikatController::store');
    $routes->get('edit/(:num)', 'SertifikatController::edit/$1');
    $routes->post('update/(:num)', 'SertifikatController::update/$1');
    $routes->get('delete/(:num)', 'SertifikatController::delete/$1');
});

$routes->group('resign', function ($routes) {
    $routes->get('/', 'ResignController::index');
    $routes->get('create', 'ResignController::create');
    $routes->post('store', 'ResignController::store');
    $routes->get('edit/(:num)', 'ResignController::edit/$1');
    $routes->post('update/(:num)', 'ResignController::update/$1');
    $routes->get('delete/(:num)', 'ResignController::delete/$1');
});

$routes->group('user', function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});

$routes->group('dept', function ($routes) {
    $routes->get('/', 'DepartementController::index');
    $routes->get('create', 'DepartementController::create');
    $routes->post('store', 'DepartementController::store');
    $routes->get('edit/(:num)', 'DepartementController::edit/$1');
    $routes->post('update/(:num)', 'DepartementController::update/$1');
    $routes->get('delete/(:num)', 'DepartementController::delete/$1');
});

$routes->group('status', function ($routes) {
    $routes->get('/', 'StatusController::index');
    $routes->get('create', 'StatusController::create');
    $routes->post('store', 'StatusController::store');
    $routes->get('edit/(:num)', 'StatusController::edit/$1');
    $routes->post('update/(:num)', 'StatusController::update/$1');
    $routes->get('delete/(:num)', 'StatusController::delete/$1');
});

$routes->group('pendidikan', function ($routes) {
    $routes->get('/', 'PendidikanController::index');
    $routes->get('create', 'PendidikanController::create');
    $routes->post('store', 'PendidikanController::store');
    $routes->get('edit/(:num)', 'PendidikanController::edit/$1');
    $routes->post('update/(:num)', 'PendidikanController::update/$1');
    $routes->get('delete/(:num)', 'PendidikanController::delete/$1');
});
