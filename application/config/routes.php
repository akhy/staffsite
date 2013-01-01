<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "staffs";
$route['404_override'] = '';

// Auth
$route['login']  = 'auth/login';
$route['logout'] = 'auth/logout';
$route['forget'] = 'auth/forget';

// Backend
$route['admin']         = 'admin/index';
$route['admin/profile'] = 'admin/profile';
$route['admin/article'] = 'admin/article';
$route['admin/file']    = 'admin/file';

// Frontend
$route['(:any)/download']              = 'staffs/download/$1/1';
$route['(:any)/download/(:num)']       = 'staffs/download/$1/$2';
$route['(:any)/blog']                  = 'staffs/blog/$1/1';
$route['(:any)/blog/(:num)']           = 'staffs/blog/$1/$2';
$route['(:any)/article/(:num)-(:any)'] = 'staffs/article/$1/$2/$3';
$route['(:any)/profile']               = 'staffs/profile/$1';

// Else
$route['(:any)']                       = 'staffs/index/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */