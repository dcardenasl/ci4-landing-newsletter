<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

// Email links carry no locale segment — these land on the default locale.
$routes->get('confirm/(:segment)', 'NewsletterController::confirmPage/es/$1');
$routes->get('unsubscribe', 'NewsletterController::unsubscribePage');
$routes->post('unsubscribe', 'NewsletterController::unsubscribe');

$routes->group('(:segment)', static function ($routes) {
    $routes->get('/', 'HomeController::index/$1');
    $routes->post('api/newsletter/subscribe', 'NewsletterController::subscribe');
    $routes->get('confirm/(:segment)', 'NewsletterController::confirmPage/$1/$2');
    $routes->get('unsubscribe', 'NewsletterController::unsubscribePage/$1');
    $routes->post('unsubscribe', 'NewsletterController::unsubscribe/$1');
});
