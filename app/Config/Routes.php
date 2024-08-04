<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ReviewsController::list');
$routes->post('reviews/create/', 'ReviewsController::create');
$routes->post('reviews/read/', 'ReviewsController::read');
$routes->post('reviews/delete/', 'ReviewsController::delete');
