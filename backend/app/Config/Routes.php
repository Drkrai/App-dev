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
$routes->get('/showRoom', 'MainController::getDataStatus');
$routes->get('/show-employee', 'EmployeeController::getEmployee');
$routes->post('/save-employee', 'EmployeeController::save');
$routes->get('/payment/(:num)', 'BookingController::payment/$1');
$routes->post('/register', 'UserController::register');
$routes->post('/login', 'UserController::login');
$routes->post('/update-room/(:num)', 'MainController::updateRoom/$1');
$routes->get('/total-booking', 'MainController::getTotalBookings');
$routes->get('/avail-rooms', 'MainController::getAvailRoom');
$routes->post('/delete-pending/(:num)', 'PendingController::deletePending/$1');
$routes->post('/payment', 'PaymentController::savePayment');
$routes->get('/get-amenities', 'AmenityController::get');
$routes->post('/add-amenity', 'AmenityController::save');
$routes->get('/getUsernames', 'UserController::getUsernames');
$routes->get('/getUserBookings/(:num)', 'BookingController::getUserBookings/$1');
$routes->post('/cancel-booking', 'CancelController::saveCancel');
$routes->get('/get-cancel', 'CancelController::getcancel');
$routes->post('/booking-cancel/(:num)', 'CancelController::cancelBooking/$1');
$routes->post('/delete-rooms/(:num)', 'MainController::deleteRoom/$1');
$routes->get('/showpayment', 'PaymentController::getPay');