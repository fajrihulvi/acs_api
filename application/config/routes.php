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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
// API Route
$route['api/authentication/login'] = 'api/authentication/index_get';

$route['api/tarif/get_data'] = 'api/tarif/index_get';
$route['api/tarif/post_data'] = 'api/tarif/index_post';

$route['api/pemohon/get_data'] = 'api/pemohon/index_get';
$route['api/pemohon/post_data'] = 'api/pemohon/index_post';

$route['api/pelanggan/get_data'] = 'api/pelanggan/index_get';
$route['api/pelanggan/post_data'] = 'api/pelanggan/index_post';

$route['api/bangunan/get_data'] = 'api/bangunan/index_get';
$route['api/bangunan/post_data'] = 'api/bangunan/index_post';

$route['api/transaksi_pasang_baru/get_data'] = 'api/transaksi_pasang_baru/index_get';
$route['api/transaksi_pasang_baru/post_data'] = 'api/transaksi_pasang_baru/index_post';

$route['api/transaksi_perubahan_daya/get_data'] = 'api/transaksi_perubahan_daya/index_get';
$route['api/transaksi_perubahan_daya/post_data'] = 'api/transaksi_perubahan_daya/index_post';

$route['api/transaksi_perubahan_daya_diskon/get_data'] = 'api/transaksi_perubahan_daya_diskon/index_get';
$route['api/transaksi_perubahan_daya_diskon/post_data'] = 'api/transaksi_perubahan_daya_diskon/index_post';

$route['api/transaksi_perubahan_daya_prabayar/get_data'] = 'api/transaksi_perubahan_daya_prabayar/index_get';
$route['api/transaksi_perubahan_daya_prabayar/post_data'] = 'api/transaksi_perubahan_daya_prabayar/index_post';