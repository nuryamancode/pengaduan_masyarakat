<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Masyarakat\PengaduanController::index');
$routes->get('/admin', 'Admin\DataLatihController::index');
$routes->get('/testnn', 'Admin\DataLatihController::knn');
$routes->get('/testbm', 'Bahan\BM25Controller::hasil');
$routes->get('/testknn', 'Bahan\KNNController::knn');
$routes->get('/test', 'Masyarakat\PengaduanController::search');
// $routes->get('/test/{text}', 'Masyarakat\PengaduanController::bm25');
$routes->post('/store-pengaduan', 'Masyarakat\PengaduanController::store');
$routes->post('/store-data-latih', 'Admin\DataLatihController::store');
