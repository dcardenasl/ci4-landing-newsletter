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
$routes->post('analytics/events', 'NewsletterController::analyticsEvents');

$routes->group('(:segment)', static function ($routes) {
    $routes->get('/', 'HomeController::index/$1');
    $routes->post('api/newsletter/subscribe', 'NewsletterController::subscribe');
    $routes->post('api/newsletter/analytics/events', 'NewsletterController::analyticsEvents/$1');
    $routes->get('confirm/(:segment)', 'NewsletterController::confirmPage/$1/$2');
    $routes->get('unsubscribe', 'NewsletterController::unsubscribePage/$1');
    $routes->post('unsubscribe', 'NewsletterController::unsubscribe/$1');
});
