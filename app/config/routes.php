<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "auth/login";
$route['404_override'] = '';

// Auth Routes
$route['login'] = 'auth/login';
$route['signup'] = 'auth/signup';
$route['logout'] = 'auth/logout';
$route['forgot'] = 'auth/forgot';


/* End of file routes.php */
/* Location: ./app/config/routes.php */
