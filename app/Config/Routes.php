<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Homepage::index');
$routes->get('about', 'Homepage::about');
$routes->get('events', 'Events::index');
$routes->get('events/(:segment)', 'Events::view/$1');
$routes->get('contact', 'Contact::index');
$routes->get('gallery', 'Photo::index');
$routes->get('photos/(:num)', 'Photo::article/$1');
$routes->get('photo/(:num)', 'Photo::show/$1');
$routes->get('articles', 'Article::index');
$routes->get('article/(:num)', 'Article::show/$1');
$routes->get('sections', 'Section::index');
$routes->get('section/(:num)', 'Section::show/$1');
$routes->group('', ['filter' => 'admin'], function ($routes) {
	$routes->get('photo/upload', 'Photo::upload');
	$routes->post('photo/store', 'Photo::store');
	$routes->get('article/create', 'Article::create');
	$routes->post('article/store', 'Article::store');
	$routes->get('article/edit/(:num)', 'Article::edit/$1');
	$routes->post('article/update/(:num)', 'Article::update/$1');
	$routes->get('section/create', 'Section::create');
	$routes->post('section/store', 'Section::store');
	$routes->get('section/edit/(:num)', 'Section::edit/$1');
	$routes->post('section/update/(:num)', 'Section::update/$1');
	$routes->get('contact/create', 'Contact::create');
	$routes->post('contact/store', 'Contact::store');
	$routes->get('contact/edit/(:num)', 'Contact::edit/$1');
	$routes->post('contact/update/(:num)', 'Contact::update/$1');
});
$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->add('login', 'Auth::login');
	$routes->get('logout', 'Auth::logout');
	// $routes->add('forgot_password', 'Auth::forgot_password');
	$routes->get('/', 'Auth::index');
	$routes->add('create_user', 'Auth::create_user');
	$routes->add('edit_user/(:num)', 'Auth::edit_user/$1');
	// $routes->add('create_group', 'Auth::create_group');
	// $routes->get('activate/(:num)', 'Auth::activate/$1');
	// $routes->get('activate/(:num)/(:hash)', 'Auth::activate/$1/$2');
	// $routes->add('deactivate/(:num)', 'Auth::deactivate/$1');
	// $routes->get('reset_password/(:hash)', 'Auth::reset_password/$1');
	// $routes->post('reset_password/(:hash)', 'Auth::reset_password/$1');
	// ...
});