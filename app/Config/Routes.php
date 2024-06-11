<?php

use CodeIgniter\Router\RouteCollection;

/** 
 * @var RouteCollection $routes
 */

// polisi
$routes->get('/polisi/dashboard', 'Polisi\DashboardController::index');
$routes->get('/tindakan', 'Polisi\TindakanController::index');
$routes->post('/tindakan/update/(:num)', 'Polisi\TindakanController::update/$1');
$routes->get('/download-file/(:any)', 'Masyarakat\PengaduanController::downloadFile/$1');
// polisi

// admin
$routes->get('/admin/dashboard', 'Admin\DashboardController::index');
$routes->get('/data-latih', 'Admin\DataLatihController::index');
$routes->post('/data-latih', 'Admin\DataLatihController::store');
$routes->post('/data-latih/delete/(:num)', 'Admin\DataLatihController::delete/$1');
$routes->post('/data-latih/update/(:num)', 'Admin\DataLatihController::update/$1');

// kelola user
$routes->get('/kelola-user', 'Admin\UserController::index');
$routes->post('/kelola-user/(:num)', 'Admin\UserController::update/$1');
// kelola pengaduan
$routes->get('/kelola-pengaduan', 'Admin\PengaduanController::index');
$routes->post('kelola-pengaduan/delete/(:num)', 'Admin\PengaduanController::delete/$1');
$routes->post('kelola-pengaduan/accept/(:num)', 'Admin\PengaduanController::accept/$1');
$routes->post('kelola-pengaduan/reject/(:num)', 'Admin\PengaduanController::reject/$1');
// kelola tindakan
$routes->get('/kelola-tindakan', 'Admin\TindakanController::index');

// admin

// masyaerakat
// $routes->get('/', 'Masyarakat\PengaduanController::home');
// $routes->get('/pengaduan', 'Masyarakat\PengaduanController::index');
// $routes->post('/pengaduan', 'Masyarakat\PengaduanController::store');

$routes->get('/', 'Masyarakat\PengaduanCDua::home');
$routes->get('/pengaduan', 'Masyarakat\PengaduanCDua::index');
$routes->post('/pengaduan', 'Masyarakat\PengaduanCDua::store');
// masyaerakat

// autentikasi
$routes->get('/logout', 'Auth\AuthController::logout');
$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login', 'Auth\AuthController::prosesLogin');
$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/register', 'Auth\AuthController::prosesRegister');
// autentikasi



$routes->get('knn', 'Bahan\KNNController::index');