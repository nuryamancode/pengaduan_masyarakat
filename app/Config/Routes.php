<?php

use CodeIgniter\Router\RouteCollection;

/** 
 * @var RouteCollection $routes
 */

// polisi
$routes->get('/polisi', function () {
    echo 'halaman polisi';
});
// polisi

// admin
$routes->get('/dashboard', 'Admin\DashboardController::index');
$routes->get('/data-latih', 'Admin\DataLatihController::index');
$routes->post('/data-latih', 'Admin\DataLatihController::store');
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
