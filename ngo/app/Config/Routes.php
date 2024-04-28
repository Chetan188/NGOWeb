<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->get('/auth', 'Auth::index');
$routes->get('/sign-in', 'Auth::admin');
$routes->get('/ngo-sign-in', 'Auth::ngo_sign_in');
$routes->get('/donor-sign-in', 'Auth::donor_sign_in');
$routes->get('/sign-up/(:any)', 'Auth::sign_up/$1');
$routes->post('/submitSignIn', 'Auth::submitSignIn');
$routes->post('/submitSignUp', 'Auth::submitSignUp');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/profile', 'Dashboard::profile');
$routes->post('/submit-profile', 'Dashboard::submit_profile');
$routes->get('/logout', 'Auth::logout');
$routes->get('/delete-account', 'Dashboard::delete_account');
$routes->get('/transactions', 'Dashboard::transactions');

$routes->resource('users');
$routes->resource('ngos');
$routes->get('/get-state-wise-city', 'Ngos::get_state_wise_city');
$routes->post('/remove-ngo-photo', 'Ngos::remove_photo');
$routes->get('/pending-ngos', 'Ngos::pending_ngos');
$routes->get('/approve-ngo/(:any)', 'Ngos::approve_ngo/$1');
$routes->get('/reject-ngo/(:any)', 'Ngos::reject_ngo/$1');
$routes->get('/ngo-view/(:any)', 'Ngos::ngo_view/$1');
$routes->get('/ngo-payments', 'Ngos::ngo_payments');
$routes->get('/all-ngos', 'Ngos::all_ngos');
// $routes->get('/pg-list', 'Pgs::pg_list');
// $routes->post('/apply-pg', 'Pgs::apply_pg');
// $routes->get('/pg-bookings', 'Pgs::pg_bookings');
// $routes->post('/make-payment', 'Pgs::make_payment');
// $routes->post('/pg-feedback', 'Pgs::pg_feedback');
// $routes->get('/my-pg-bookings', 'Pgs::my_pg_bookings');
// $routes->post('/watch-pg-docs', 'Pgs::watch_pg_docs');
// $routes->get('/approve-pg-request/(:any)', 'Pgs::approve_pg_request/$1');
// $routes->get('/reject-pg-request/(:any)', 'Pgs::reject_pg_request/$1');
// $routes->get('/pg-feedbacks', 'Pgs::pg_feedbacks');

$routes->resource('messes');
$routes->get('/messes/photos/(:any)', 'Messes::photos/$1');
$routes->get('/pending-messes', 'Messes::pending_pgs');
$routes->get('/approve-mess/(:any)', 'Messes::approve_pg/$1');
$routes->get('/reject-mess/(:any)', 'Messes::reject_pg/$1');
$routes->get('/mess-list', 'Messes::mess_list');
$routes->get('/mess-view/(:any)', 'Messes::mess_view/$1');
$routes->post('/apply-mess', 'Messes::apply_mess');
$routes->get('/mess-bookings', 'Messes::mess_bookings');
$routes->post('/make-payment-mess', 'Messes::make_payment');
$routes->post('/mess-feedback', 'Messes::mess_feedback');
$routes->get('/my-mess-bookings', 'Messes::my_mess_bookings');
$routes->post('/watch-mess-docs', 'Messes::watch_mess_docs');
$routes->get('/approve-mess-request/(:any)', 'Messes::approve_mess_request/$1');
$routes->get('/reject-mess-request/(:any)', 'Messes::reject_mess_request/$1');
$routes->get('/mess-feedbacks', 'Messes::mess_feedbacks');