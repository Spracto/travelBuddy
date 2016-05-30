<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['add_trip'] = 'users/add_trip';
$route['add'] = 'users/add';
$route['info/(:any)'] = 'users/trip_info/$1';
$route['join/(:any)'] = 'users/join_trip/$1';
$route['profile'] = 'users/profile';
$route['index'] = 'users/index';
$route['cancel_trip/(:any)'] = 'users/cancel_trip/$1';
//end of routes.php
