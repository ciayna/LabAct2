<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/main', 'MainController::index');
$routes->post('/addAudio', 'MainController::addAudio');
$routes->post('/addPlaylist', 'MainController::addPlaylist');
$routes->get('/delete/(:any)', 'MainController::delete/$1');
