<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AdminHome::index', ['filter' => 'authGuard']);
$routes->get('products', 'ProductController::index' , ['filter' => 'authGuard']);
$routes->get('products/create', 'ProductController::create', ['filter' => 'authGuard']);
$routes->post('products/store', 'ProductController::store' , ['filter' => 'authGuard']);

$routes->get('products/delete/(:num)', 'ProductController::delete/$1', ['filter' => 'authGuard']);
$routes->get('products/edit/(:num)', 'ProductController::edit/$1', ['filter' => 'authGuard']);
$routes->post('products/update/(:num)', 'ProductController::update/$1', ['filter' => 'authGuard']);

// Signin, Signup
$routes->get('register', 'SignupController::index');
$routes->match(['get', 'post'], 'register/store', 'SignupController::store');
$routes->get('signin', 'SigninController::index');
$routes->post('login', 'SigninController::login');
$routes->get('signout', 'SigninController::logout');

// Category Routes
$routes->get('category', 'CategoryController::index' , ['filter' => 'authGuard']); // category list
$routes->get('category/create', 'CategoryController::create', ['filter' => 'authGuard']); // category entry form
$routes->post('category/store', 'CategoryController::store', ['filter' => 'authGuard']); // category save
$routes->get('category/edit/(:num)', 'CategoryController::edit/$1', ['filter' => 'authGuard']); // category edit form
$routes->post('category/update/(:num)', 'CategoryController::update/$1', ['filter' => 'authGuard']); // category update
$routes->get('category/delete/(:num)', 'CategoryController::delete/$1', ['filter' => 'authGuard']); // category delete

