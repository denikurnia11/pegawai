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
$routes->setDefaultNamespace('');
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
$routes->get('/', 'App\Modules\Auth\Controllers\Login::index');
// Controller Auth
$routes->group('auth', function ($routes) {
    $routes->add('login', 'App\Modules\Auth\Controllers\Login::index');
    $routes->add('login/(:any)', 'App\Modules\Auth\Controllers\Login::$1');
    $routes->add('registrasi', 'App\Modules\Auth\Controllers\Registrasi::index');
    $routes->add('registrasi/(:any)', 'App\Modules\Auth\Controllers\Registrasi::$1');
});
// Controller User
$routes->group('user', function ($routes) {
    $routes->add('pegawai', 'App\Modules\User\Controllers\Pegawai::index');
    $routes->add('jabatan', 'App\Modules\User\Controllers\Jabatan::index');
    $routes->add('unit', 'App\Modules\User\Controllers\Unit::index');
});
// Controller Admin
$routes->group('admin', function ($routes) {
    $routes->add('pegawai', 'App\Modules\Admin\Controllers\Pegawai::index');
    $routes->add('pegawai/(:any)', 'App\Modules\Admin\Controllers\Pegawai::$1');
    $routes->add('jabatan', 'App\Modules\Admin\Controllers\Jabatan::index');
    $routes->add('jabatan/(:any)', 'App\Modules\Admin\Controllers\Jabatan::$1');
    $routes->add('unit', 'App\Modules\Admin\Controllers\Unit::index');
    $routes->add('unit/(:any)', 'App\Modules\Admin\Controllers\Unit::$1');
    $routes->add('user', 'App\Modules\Admin\Controllers\User::index');
    $routes->add('user/(:any)', 'App\Modules\Admin\Controllers\User::$1');
});


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
