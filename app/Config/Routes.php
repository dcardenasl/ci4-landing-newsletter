<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->group('(:segment)', static function ($routes) {
    $routes->get('/', 'HomeController::index/$1');
    $routes->post('api/newsletter/subscribe', 'NewsletterController::subscribe');
});
