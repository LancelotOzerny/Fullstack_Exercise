<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ReviewsController::list');
$routes->get('reviews/create/', 'ReviewsController::create');
$routes->get('reviews/read/', 'ReviewsController::read');
$routes->get('reviews/delete/', 'ReviewsController::delete');
