<?php

use CodeIgniter\Router\RouteCollection;

/** 
 * @var RouteCollection $routes
 */
$routes->get('/adminn', 'Admin\DataLatihController::index');
$routes->get('/testnn', 'Admin\DataLatihController::knn');
$routes->get('/testbm', 'Bahan\BM25Controller::hasil');
$routes->get('/testknn', 'Bahan\KNNController::knn');
$routes->get('/test', 'Masyarakat\PengaduanController::search');
// $routes->get('/test/{text}', 'Masyarakat\PengaduanController::bm25');
$routes->post('/store-pengaduan', 'Masyarakat\PengaduanController::store');
$routes->post('/store-data-latih', 'Admin\DataLatihController::store');


$routes->get('/dashboard', function () {
    echo 'halaman admin';
});
$routes->get('/polisi', function () {
    echo 'halaman polisi';
});



$routes->get('/', 'Masyarakat\PengaduanController::home');
$routes->get('/pengaduan', 'Masyarakat\PengaduanController::index');

$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/login', 'Auth\AuthController::prosesLogin');
$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/register', 'Auth\AuthController::prosesRegister');
// $routes->group('/login', function ($routes) {
//     $routes->get('/', 'Auth\AuthController::login');
//     $routes->post('/', 'Auth\AuthController::prosesLogin');
// });
// $routes->group('/register', function ($routes) {
//     $routes->get('/', 'Auth\AuthController::register');
//     $routes->post('/', 'Auth\AuthController::prosesRegister');
// });

$routes->get('/logout', 'Auth\AuthController::logout');
