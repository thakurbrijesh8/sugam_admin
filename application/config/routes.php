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
$route['default_controller'] = 'main';
$route['404_override'] = 'main/page_not_found';
$route['translate_uri_dashes'] = FALSE;

$route['download_copy'] = 'utility/download_copy';
$route['land_tax_na_download_excel'] = 'landtax_na/download_excel_for_landtax_na';
$route['land_tax_na_land_details_download_excel'] = 'landtax_na/download_excel_for_landtax_na_land_details';
$route['land_tax_na_generate_notice'] = 'landtax_na/generate_notice_in_pdf';
$route['land_tax_na_download_notice'] = 'landtax_na/download_notice_in_pdf';
$route['land_tax_na_download_notice/(:any)'] = 'landtax_na/download_notice_in_pdf/$1';
$route['land_tax_na_download_tr_five'] = 'landtax_na/download_tr_five_in_pdf';
$route['payment-success'] = 'payment_status/payment_success';
$route['payment-fail'] = 'payment_status/payment_failed';
$route['form_one_fourteen_office_copy'] = 'form_one_fourteen/office_copy_in_pdf';
$route['land_tax_agriculture_download_excel'] = 'landtax_agriculture/download_excel_for_landtax_agriculture';
$route['land_tax_agriculture_generate_notice'] = 'landtax_agriculture/generate_notice_for_lt_agriculture_in_pdf';
$route['land_tax_agriculture_download_notice'] = 'landtax_agriculture/download_notice_for_lt_in_pdf';
$route['land_tax_agriculture_download_notice/(:any)'] = 'landtax_agriculture/download_notice_for_lt_in_pdf/$1';
$route['land_tax_agri_download_tr_five'] = 'landtax_agriculture/download_agriculture_tr_five_in_pdf';