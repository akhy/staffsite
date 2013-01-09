<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * RESERVED ROUTES
 */

$route['default_controller'] = "staffs";
$route['404_override'] = '';



/**
 * AUTH
 */

$route['login']  = 'auth/login';
$route['logout'] = 'auth/logout';
$route['forget'] = 'auth/forget';



/**
 * BACKEND
 */

$route['admin']                       = 'admin/home/index';

$route['admin/profile']               = 'admin/profile/index';
$route['admin/profile/edit']          = 'admin/profile/edit';
$route['admin/profile/password']      = 'admin/profile/password';

$route['admin/article']               = 'admin/article/index';
$route['admin/article/create']        = 'admin/article/create';
$route['admin/article/(:num)/edit']   = 'admin/article/edit/$1';
$route['admin/article/(:num)/delete'] = 'admin/article/delete/$1';

$route['admin/file']                  = 'admin/file/index';
$route['admin/file/create']           = 'admin/file/create';
$route['admin/file/(:num)/edit']      = 'admin/file/edit/$1';
$route['admin/file/(:num)/upload']    = 'admin/file/upload/$1';
$route['admin/file/(:num)/delete']    = 'admin/file/delete/$1';



/**
 * FRONTEND
 */

$route['(:any)/download']              = 'staffs/download/$1/1';
$route['(:any)/download/(:num)']       = 'staffs/download/$1/$2';
$route['(:any)/blog']                  = 'staffs/blog/$1/1';
$route['(:any)/blog/(:num)']           = 'staffs/blog/$1/$2';
$route['(:any)/article/(:num)-(:any)'] = 'staffs/article/$1/$2/$3';
$route['(:any)/profile']               = 'staffs/profile/$1';



/**
 * ELSE
 */

$route['(:any)']                       = 'staffs/index/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */