<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// Users Route Starts here
$route['default_controller'] = 'UserController';
$route['registration-form/:any/:any'] = 'UserController/registrationForm';
$route['registration/confirmation'] = 'UserController/confirmation';
$route['registration/edit'] = 'UserController/registrationEdit';
$route['submitInfo'] = 'UserController/submitInfo';
$route['registration/success'] = 'UserController/success';
$route['registration/multiple-data-entry'] = 'UserController/error';

// Restriction Access
$route['restricted-access'] = 'admin_controller/restrictionAccess';

// Admins Route Starts here
$route['admin'] = 'AdminController';
$route['register'] = 'AdminController/register';
$route['register'] = 'AdminController/register_new_admin';
$route['success'] = 'AdminController/register_success';
$route['admin'] = 'AdminController/login_admin';
$route['dashboard'] = 'AdminController/dashboard';
$route['logout'] = 'AdminController/logout';

$route['manageUser'] = 'AdminController/manageUser';
$route['deleteUser'] = 'AdminController/deleteUser';
$route['activateUser'] = 'AdminController/activateUser';
$route['deactivateUser'] = 'AdminController/deactivateUser';

$route['message'] = 'AdminController/message';
$route['seminar'] = 'AdminController/seminar';
$route['upload-image'] = 'AdminController/save';
$route['create-seminar'] = 'AdminController/createSeminar';
$route['create-seminar'] = 'AdminController/insertSeminar';
$route['activateSeminar'] = 'AdminController/activateSeminar';
$route['deactivateSeminar'] = 'AdminController/deactivateSeminar';
$route['deleteSeminar'] = 'AdminController/deleteSeminar';
$route['update-seminar'] = 'AdminController/updateSeminar';
$route['updateSeminar'] = 'AdminController/update_Seminar';
$route[':any/:any/:any'] = 'AdminController/seminarProfile';
$route[':any/:any'] = 'AdminController/seminarProfile';

$route['profile'] = 'AdminController/profile';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
