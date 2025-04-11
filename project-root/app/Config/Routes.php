<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Connection::index');
$routes->post('/login', 'Connection::attemptLogin');
$routes->get('/home', 'Home::index');
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index');
$routes->get('/user', 'User::index');
