<?php

use CodeIgniter\Router\RouteCollection;

/** 
 * @var RouteCollection $routes
 */

// polisi
$routes->get('/polisi/dashboard', 'Polisi\DashboardController::index');
$routes->get('/tindakan', 'Polisi\TindakanController::index');
// polisi

// admin
$routes->get('/admin/dashboard', 'Admin\DashboardController::index');
$routes->get('/data-latih', 'Admin\DataLatihController::index');
$routes->post('/data-latih', 'Admin\DataLatihController::store');

// kelola user
$routes->get('/kelola-user', 'Admin\UserController::index');
$routes->post('/kelola-user/(:num)', 'Admin\UserController::update/$1');
$routes->post('kelola-user/delete/(:num)', 'Admin\UserController::delete/$1');
// kelola pengaduan
$routes->get('/kelola-pengaduan', 'Admin\PengaduanController::index');
// kelola tindakan
$routes->get('/kelola-tindakan', 'Admin\TindakanController::index');

// admin

// masyaerakat
$routes->get('/', 'Masyarakat\PengaduanController::home');
$routes->get('/pengaduan', 'Masyarakat\PengaduanController::index');
$routes->post('/pengaduan', 'Masyarakat\PengaduanController::store');
// masyaerakat

// autentikasi
$routes->get('/logout', 'Auth\AuthController::logout');
$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login', 'Auth\AuthController::prosesLogin');
$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/register', 'Auth\AuthController::prosesRegister');
// autentikasi



$routes->get('knn', 'Bahan\KNNController::knn');