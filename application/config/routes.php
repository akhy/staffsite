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

$route['admin']                        = 'admin/home/index';

$route['admin/profile']                = 'admin/profile/index';
$route['admin/profile/edit']           = 'admin/profile/edit';
$route['admin/profile/password']       = 'admin/profile/password';
$route['admin/profile/picture']        = 'admin/profile/picture';

$route['admin/articles']               = 'admin/articles/index';
$route['admin/articles/page/(:num)']   = 'admin/articles/page/$1';
$route['admin/articles/new']           = 'admin/articles/new';
$route['admin/articles/(:num)/edit']   = 'admin/articles/edit/$1';
$route['admin/articles/(:num)/delete'] = 'admin/articles/delete/$1';

$route['admin/files']                  = 'admin/files/index';
$route['admin/files/page/(:num)']      = 'admin/files/page/$1';
$route['admin/files/new']              = 'admin/files/new';
$route['admin/files/(:num)/edit']      = 'admin/files/edit/$1';
$route['admin/files/(:num)/delete']    = 'admin/files/delete/$1';
$route['admin/files/(:num)/upload']    = 'admin/files/upload/$1';

$route['admin/portfolios']             = 'admin/portfolios/index';


/**
 * FRONTEND
 */

$route['(:any)/feed']                  = 'staffs/feed/$1/1';
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