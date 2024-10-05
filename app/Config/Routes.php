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
$routes->setDefaultController('utama');
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
$routes->add('/', 'frontend\index::index');
$routes->add('/about', 'frontend\about::index');
$routes->add('/rooms', 'frontend\rooms::index');
$routes->add('/roomsingle', 'frontend\roomsingle::index');
$routes->add('/booking', 'frontend\booking::index');
$routes->add('/offer', 'frontend\offer::index');
$routes->add('/offersingle', 'frontend\offersingle::index');
$routes->add('/blog', 'frontend\blog::index');
$routes->add('/blogsingle', 'frontend\blogsingle::index');
$routes->add('/gallery', 'frontend\gallery::index');
$routes->add('/contact', 'frontend\contact::index');
$routes->add('/meetingrooms', 'frontend\meetingrooms::index');
$routes->add('/api/(:any)', 'api::$1');
$routes->add('/utama', 'utama::index');
$routes->add('/login', 'utama::login');
$routes->add('/logout', 'utama::logout');
$routes->add('/mposition', 'master\mposition::index');
$routes->add('/mpositionpages', 'master\mpositionpages::index');
$routes->add('/muser', 'master\muser::index');
$routes->add('/mpassword', 'master\mpassword::index');
$routes->add('/mstore', 'master\mstore::index');
$routes->add('/midentity', 'master\midentity::index');
$routes->add('/mbackground', 'master\mbackground::index');
$routes->add('/mslider', 'master\mslider::index');
$routes->add('/mabout', 'master\mabout::index');
$routes->add('/msosmed', 'master\msosmed::index');
$routes->add('/mfacilities', 'master\mfacilities::index');
$routes->add('/mroom', 'master\mroom::index');
$routes->add('/tbooking', 'transaction\tbooking::index');
$routes->add('/moffer', 'master\moffer::index');
$routes->add('/mblog', 'master\mblog::index');
$routes->add('/mgallery', 'master\mgallery::index');
$routes->add('/mcontact', 'master\mcontact::index');
$routes->add('/mmeetingrooms', 'master\mmeetingrooms::index');






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
