<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// PAGES
$routes->get('/', 'Pages::index', ['filter' => 'noauth']);
$routes->get('/dashboard', 'Pages::dashboard', ['filter' => 'auth']);
$routes->get('/items/(:any)', 'Pages::items/$1', ['filter' => 'auth']);
$routes->get('/add-item/(:any)', 'Pages::addItem/$1', ['filter' => 'auth']);
$routes->get('/edit-item/(:any)/(:any)', 'Pages::editItem/$1/$2', ['filter' => 'auth']);
$routes->get('/property-card/(:any)', 'Pages::propertyCard/$1', ['filter' => 'auth']);
$routes->get('/add-property-card-entry/(:any)', 'Pages::addPropertyCardEntry/$1', ['filter' => 'auth']);
$routes->get('/supplies', 'Pages::supplies', ['filter' => 'auth']);
$routes->get('/departments', 'Pages::departments', ['filter' => 'auth']);
$routes->get('/department/(:any)', 'Pages::department/$1', ['filter' => 'auth']);
$routes->get('/add-department', 'Pages::addDepartment', ['filter' => 'auth']);
$routes->get('/edit-department/(:any)', 'Pages::editDepartment/$1', ['filter' => 'auth']);
$routes->get('/employees', 'Pages::employees', ['filter' => 'auth']);
$routes->get('/add-employee', 'Pages::addEmployee', ['filter' => 'auth']);
$routes->get('/edit-employee/(:any)', 'Pages::editEmployee/$1', ['filter' => 'auth']);
$routes->get('/locations', 'Pages::locations', ['filter' => 'auth']);
$routes->get('/add-location', 'Pages::addLocation', ['filter' => 'auth']);
$routes->get('/edit-location/(:any)', 'Pages::editLocation/$1', ['filter' => 'auth']);
$routes->get('/units', 'Pages::units', ['filter' => 'auth']);
$routes->get('/add-unit', 'Pages::addUnit', ['filter' => 'auth']);
$routes->get('/edit-unit/(:any)', 'Pages::editUnit/$1', ['filter' => 'auth']);
$routes->get('/requests', 'Pages::requests', ['filter' => 'auth']);
$routes->get('/requested-item/(:any)/(:any)', 'Pages::requestedItem/$1/$2', ['filter' => 'auth']);
$routes->get('/request-supplies/(:any)', 'Pages::requestSupplies/$1', ['filter' => 'auth']);
$routes->get('/request-supply', 'Pages::requestSupply', ['filter' => 'auth']);
$routes->get('/edit-request-supply/(:any)/(:any)', 'Pages::editRequestSupply/$1/$2', ['filter' => 'auth']);
$routes->get('/profile', 'Pages::profile', ['filter' => 'auth']);
$routes->get('/add-request-entry/(:any)/(:any)', 'Pages::addRequestEntry/$1/$2', ['filter' => 'auth']);

// DATA
$routes->post('/data/add-item', 'Data::addItem', ['filter' => 'auth']);
$routes->post('/data/edit-item', 'Data::editItem', ['filter' => 'auth']);
$routes->post('/data/delete-item', 'Data::deleteItem', ['filter' => 'auth']);
$routes->post('/data/add-department', 'Data::addDepartment', ['filter' => 'auth']);
$routes->post('/data/edit-department', 'Data::editDepartment', ['filter' => 'auth']);
$routes->post('/data/delete-department', 'Data::deleteDepartment', ['filter' => 'auth']);
$routes->post('/data/add-employee', 'Data::addEmployee', ['filter' => 'auth']);
$routes->post('/data/edit-employee', 'Data::editEmployee', ['filter' => 'auth']);
$routes->post('/data/edit-employee-password', 'Data::editEmployeePassword', ['filter' => 'auth']);
$routes->post('/data/delete-employee', 'Data::deleteEmployee', ['filter' => 'auth']);
$routes->post('/data/add-location', 'Data::addLocation', ['filter' => 'auth']);
$routes->post('/data/edit-location', 'Data::editLocation', ['filter' => 'auth']);
$routes->post('/data/delete-location', 'Data::deleteLocation', ['filter' => 'auth']);
$routes->post('/data/add-unit', 'Data::addUnit', ['filter' => 'auth']);
$routes->post('/data/edit-unit', 'Data::editUnit', ['filter' => 'auth']);
$routes->post('/data/delete-unit', 'Data::deleteUnit', ['filter' => 'auth']);
$routes->post('/data/add-property-card-entry', 'Data::addPropertyCardEntry', ['filter' => 'auth']);
$routes->post('/data/edit-property-card-entry', 'Data::editPropertyCardEntry', ['filter' => 'auth']);
$routes->post('/data/delete-property-card-entry', 'Data::deletePropertyCardEntry', ['filter' => 'auth']);
$routes->post('/data/edit-profile', 'Data::editProfile', ['filter' => 'auth']);
$routes->post('/data/change-password', 'Data::changePassword', ['filter' => 'auth']);
$routes->post('/data/request-supply', 'Data::requestSupply', ['filter' => 'auth']);
$routes->post('/data/edit-request-supply', 'Data::editRequestSupply', ['filter' => 'auth']);
$routes->post('/data/delete-request-supply', 'Data::deleteRequestSupply', ['filter' => 'auth']);
$routes->post('/data/add-request-entry', 'Data::addRequestEntry', ['filter' => 'auth']);

// AUTHENTICATION
$routes->post('/auth/login', 'Auth::login', ['filter' => 'noauth']);
$routes->get('/auth/logout', 'Auth::logout', ['filter' => 'auth']);
