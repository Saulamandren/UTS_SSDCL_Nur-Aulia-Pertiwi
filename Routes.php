<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/securedata', 'SecureData::index', ['filter' => 'auth']);
$routes->post('/securedata/process', 'SecureData::process', ['filter' => 'auth']);
$routes->get('/login', 'Auth::login');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/register', 'Auth::register');
$routes->post('/registerProcess', 'Auth::registerProcess');
$routes->get('/logout', 'Auth::logout');

$routes->get('/attack/simulate', 'AttackSim::simulate', ['filter' => 'auth']);
$routes->post('/attack/result', 'AttackSim::result', ['filter' => 'auth']);

// Hanya admin yang bisa akses halaman ini
$routes->get('/admin/dashboard', 'Admin::dashboard', ['filter' => 'role:admin']);

// Hanya user biasa yang bisa akses halaman ini
$routes->get('/user/dashboard', 'User::dashboard', ['filter' => 'role:user']);

// Halaman simulasi bisa diakses oleh admin dan user
$routes->get('/attack/simulate', 'AttackSim::simulate', ['filter' => 'role:admin,user']);
$routes->post('/attack/result', 'AttackSim::result', ['filter' => 'role:admin,user']);

