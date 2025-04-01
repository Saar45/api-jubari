<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('login', 'Login::login');
$routes->post('register', 'Registration::register');
$routes->options('(:any)', 'CorsController::preflight');
