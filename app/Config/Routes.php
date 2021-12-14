<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->get('/', 'Home::index');
$routes->match(['get','post'],'login', 'Home::login_details', ['filter'=>'noauth']);
$routes->get('dashboard', 'Home::dashboard', ['filter'=>'auth']);
// User Model
$routes->match(['get','post'], 'user/create_user', 'User::create_user_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'user/import_users', 'User::import_users_details', ['filter'=>'auth']);
$routes->get('logout', 'Home::logout');

// Register Sanstha
$routes->match(['get','post'],'sanstha/sanstha_details/(:any)','Sanstha::sanstha_details/$1', ['filter'=>'auth']);
$routes->match(['get','post'], 'sanstha/create_sanstha', 'Sanstha::create_sanstha', ['filter'=>'auth']);
$routes->match(['get','post'], 'sanstha/(:any)/update_details', 'Sanstha::update_sanstha_details', ['filter'=>'auth']);

$routes->get('sanstha/update_sanstha/(:any)', 'Sanstha::updateSanstha/$1', ['filter'=>'auth']);
$routes->match(['get','post'],'sanstha/sansthaUpdateRe', 'Sanstha::update_sanstha_record', ['filter'=>'auth']);
$routes->match(['get','post'],'sanstha/sansthaUpdateSave', 'Sanstha::update_sanstha_save_record',['filter'=>'auth']);

// Delete Sanstha
$routes->match(['get','post'], 'sanstha/sanstha_details', 'Sanstha::sansthaDelete', ['filter'=>'auth']);

// Report
$routes->match(['get','post'], 'report/rpt_sanstha', 'Report::rpt_sanstha', ['filter'=>'auth']);
//master
$routes->match(['get','post'], 'master/master_details', 'Master::master_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'master/master_details', 'Master::deleteProducts', ['filter'=>'auth']);

// // Sales Modules
// $routes->match(['get','post'], 'sales/pre-sales', 'Sales::pre_sales_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'sales/post-sales', 'Sales::post_sales_details', ['filter'=>'auth']);

// //kunjika
// $routes->match(['get','post'], 'sales/save_lead', 'Sales::save_lead', ['filter'=>'auth']);
// $routes->get('sales/update_lead_open/(:any)', 'Sales::update_lead_open/$1', ['filter'=>'auth']);
// $routes->get('sales/update_lead', 'Sales::update_lead', ['filter'=>'auth']);
// $routes->match(['get','post'], 'sales/save_lead_update', 'Sales::save_lead_update', ['filter'=>'auth']);
// $routes->match(['get','post'], 'sales/(:any)/lead_progress', 'Sales::lead_data_call', ['filter'=>'auth']);

// // Masters Modules
// $routes->match(['get','post'], 'master/clients', 'Master::client_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'master/register_clients', 'Master::register_client_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'master/(:any)/update_clients', 'Master::update_client_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'master/departments', 'Master::department_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'master/add_cp', 'Master::add_cp', ['filter'=>'auth']);
// $routes->match(['get','post'], 'master/delete_cp', 'Master::delete_cp', ['filter'=>'auth']);
// $routes->match(['get','post'], 'master/products', 'Master::product_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'master/terms', 'Master::terms_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'master/eligibility', 'Master::eligibility_details', ['filter'=>'auth']);

// // Bid Modules

// $routes->match(['get','post'],'bid/bid_details','Bid::bid_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'bid/create_bid', 'Bid::create_bid', ['filter'=>'auth']);
// $routes->match(['get','post'], 'bid/(:any)/update_details', 'Bid::update_bid_details', ['filter'=>'auth']);
// $routes->match(['get','post'], 'bid/(:any)/oem_details', 'Bid::bid_oem_association', ['filter'=>'auth']);
// $routes->match(['get','post'],'bid/(:any)/bid_progress', 'Bid::bid_data_call', ['filter'=>'auth']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
