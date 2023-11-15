<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('/save', 'MainController::save');
$routes->post('/bookRoom', 'PendingController::saveBooking');
$routes->get('/showroom', 'MainController::getData');
$routes->get('/getRoom', 'MainController::getRoom');
$routes->get('/pending', 'PendingController::getPending');
$routes->post('/confirmed-booking/(:num)', 'BookingController::confirmBooking/$1');
$routes->get('/get-booking', 'BookingController::getBooking');