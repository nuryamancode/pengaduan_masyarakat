<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Masyarakat\PengaduanController::index');
$routes->get('/test', 'Masyarakat\PengaduanController::test');
// $routes->get('/test/{text}', 'Masyarakat\PengaduanController::bm25');
$routes->post('/store-pengaduan', 'Masyarakat\PengaduanController::store');
