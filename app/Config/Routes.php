<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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
$routes->get('/', 'CGeneral::index');
$routes->get('/Login', 'CGeneral::Login');
$routes->get('/Register', 'CGeneral::Register');
$routes->match(['get','post'],'/BrowseProducts', 'CGeneral::BrowseProducts');
$routes->match(['get','post'],'/BrowseProducts?page=(:any)', 'CGeneral::BrowseProducts');
$routes->match(['get','post'],'/BrowseProducts/(:any)?page=(:any)', 'CGeneral::BrowseProducts/$1');
$routes->match(['get','post'],'/BrowseProducts/(:any)', 'CGeneral::BrowseProducts/$1');
$routes->match(['get','post'],'/ManageOrders?page=(:any)', 'CAdmin::ManageOrders');
$routes->match(['get','post'],'/ManageOrders/(:any)', 'CAdmin::ManageOrders');
$routes->match(['get','post'],'/Product/(:any)', 'CGeneral::ProductDrillDown/$1');


$routes->match(['get','post'],'/Member', 'CMember::index');
$routes->match(['get','post'],'/Logout', 'CMember::Logout');
$routes->match(['get','post'],'/Cart', 'CMember::Cart');
$routes->match(['get','post'],'/Wishlist', 'CMember::Wishlist');
$routes->match(['get','post'],'/Pay', 'CMember::Payment');
$routes->match(['get','post'],'/Checkout', 'CMember::Checkout');
$routes->match(['get','post'],'/Orders', 'CMember::Orders');
$routes->match(['get','post'],'/ManageOrders', 'CAdmin::ManageOrders');
$routes->match(['get','post'],'/Order/(:any)', 'CMember::OrderDrilldown/$1');
$routes->match(['get','post'],'/AddToCart/(:any)', 'CMember::AddToCart/$1');
$routes->match(['get','post'],'/RemoveFromCart/(:any)', 'CMember::RemoveFromCart/$1');
$routes->match(['get','post'],'/DeleteProduct/(:any)', 'CAdmin::DeleteProduct/$1');
$routes->match(['get','post'],'/AddProduct', 'CAdmin::AddProduct');
$routes->match(['get','post'],'/AddToWishlist/(:any)', 'CMember::AddToWishlist/$1');
$routes->match(['get','post'],'/RemoveFromWishlist/(:any)', 'CMember::RemoveFromWishlist/$1');

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
