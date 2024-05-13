<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Masyarakat\PengaduanController::index');
$routes->post('/store-pengaduan', 'Masyarakat\PengaduanController::store');
