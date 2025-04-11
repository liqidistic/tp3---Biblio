<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Connection::index');
$routes->post('/login', 'Connection::attemptLogin');
$routes->get('/home', 'Home::index', ['filter' => \App\Filters\AuthenticatedFilter::class]);
$routes->get('/', 'Home::index', ['filter' => \App\Filters\AuthenticatedFilter::class]);
$routes->get('/admin', 'Admin::index');
