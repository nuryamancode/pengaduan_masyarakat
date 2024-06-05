<?php

use CodeIgniter\Router\RouteCollection;

/** 
 * @var RouteCollection $routes
 */


$routes->get('/polisi', function () {
    echo 'halaman polisi';
});

// admin
$routes->get('/dashboard', 'Admin\DataLatihController::index');
$routes->post('/store-data-latih', 'Admin\DataLatihController::store');
// admin

// masyaerakat
$routes->get('/', 'Masyarakat\PengaduanController::home');
$routes->get('/pengaduan', 'Masyarakat\PengaduanController::index');
$routes->post('/store-pengaduan', 'Masyarakat\PengaduanController::store');
// masyaerakat

// autentikasi
$routes->get('/logout', 'Auth\AuthController::logout');
$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login', 'Auth\AuthController::prosesLogin');
$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/register', 'Auth\AuthController::prosesRegister');
// autentikasi
