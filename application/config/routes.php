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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Auth';
$route['master-data-jenis-barang'] = 'master/Master_data/data_jenis_barang/';
$route['master-frame'] = 'master/Master_data/data_frame/';
$route['master-lensa'] = 'master/Master_data/data_lensa/';
$route['master-cairan'] = 'master/Master_data/data_cairan/';
$route['master-level-user'] = 'master/Master_level/data_jenis_level/';
$route['master-data-gudang'] = 'master/Master_data/data_gudang/';
$route['master-softlense'] = 'master/Master_data/data_softlense/';
$route['restok-data-toko'] = 'master/Master_data/restok_toko/';
$route['pesan-lensa'] = 'pesan_lensa';
$route['master-user'] = 'user/Master_user/mstr_user/';
$route['laporan-toko'] = 'laporan';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
