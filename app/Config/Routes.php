<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Homepage::index');
$routes->get('/about', 'Homepage::about');
$routes->get('/events', 'Events::index');
$routes->get('/events/(:segment)', 'Events::view/$1');
$routes->get('/contact', 'Homepage::contact');
$routes->get('/photos', 'Photo::index');
$routes->get('upload', 'Upload::index');
$routes->post('upload/upload', 'Upload::upload');
$routes->get('/article/create', 'Article::create');
$routes->post('/article/store', 'Article::store');
// Alias so `/login` works with the App controller
$routes->get('/login', 'Auth::login');
$routes->group('auth', ['namespace' => 'IonAuth\Controllers'], function ($routes) {
	$routes->add('login', 'Auth::login');
	$routes->get('logout', 'Auth::logout');
	$routes->add('forgot_password', 'Auth::forgot_password');
	// $routes->get('/', 'Auth::index');
	// $routes->add('create_user', 'Auth::create_user');
	// $routes->add('edit_user/(:num)', 'Auth::edit_user/$1');
	// $routes->add('create_group', 'Auth::create_group');
	// $routes->get('activate/(:num)', 'Auth::activate/$1');
	// $routes->get('activate/(:num)/(:hash)', 'Auth::activate/$1/$2');
	// $routes->add('deactivate/(:num)', 'Auth::deactivate/$1');
	// $routes->get('reset_password/(:hash)', 'Auth::reset_password/$1');
	// $routes->post('reset_password/(:hash)', 'Auth::reset_password/$1');
	// ...
});