<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('view/(:any)', 'HomeController::view/$1');
$routes->get('about', 'HomeController::about');
$routes->get('contact', 'HomeController::contact');
$routes->add('contact-add', 'HomeController::addContact');


$routes->get('login', 'Admin\AuthController::index');
$routes->add('login/auth', 'Admin\AuthController::auth');
$routes->get('logout', 'Admin\AuthController::logout');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Admin\DashboardController::index');
	$routes->get('category', 'Admin\CategoryController::index');
	$routes->add('category/store', 'Admin\CategoryController::store');
	$routes->add('category/update/(:any)', 'Admin\CategoryController::update/$1');
	$routes->get('category/delete/(:any)', 'Admin\CategoryController::delete/$1');

	$routes->get('news', 'Admin\NewsController::index');
	$routes->add('news/store', 'Admin\NewsController::store');
	$routes->add('news/update/(:any)', 'Admin\NewsController::update/$1');
	$routes->get('news/delete/(:any)', 'Admin\NewsController::delete/$1');
	$routes->get('news/view/(:any)', 'Admin\NewsController::view/$1');
	$routes->get('news/get/(:any)', 'Admin\NewsController::get/$1');

	$routes->get('user', 'Admin\UserController::index');
	$routes->add('user/store', 'Admin\UserController::store');
	$routes->get('user/delete/(:any)', 'Admin\UserController::delete/$1');
	$routes->add('user/update/(:any)', 'Admin\UserController::update/$1');

	$routes->get('contact', 'Admin\ContactController::index');
	$routes->get('contact/get/(:any)', 'Admin\ContactController::get/$1');
	$routes->get('contact/delete/(:any)', 'Admin\ContactController::delete/$1');

	$routes->get('setting', 'Admin\SettingController::index');
	$routes->add('setting/update/(:any)', 'Admin\SettingController::update/$1');
	$routes->add('setting/upload', 'Admin\SettingController::store_gallery');
	$routes->get('setting/delete-gallery/(:any)', 'Admin\SettingController::delete_gallery/$1');
});

// API
$routes->addRedirect('api', '/');
$routes->resource('api/news', ['filter' => 'JwtAuth']);
$routes->resource('api/category');

$routes->post('api/login', 'Api\Auth::login');
$routes->post('api/register', 'Api\Auth::register');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
