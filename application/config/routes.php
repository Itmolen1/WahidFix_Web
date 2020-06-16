<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "welcome";
$route['404_override'] = 'My404';

$route['Scedule_service/(:any)'] = 'Scedule_service';
$route['Scedule_service/add'] = 'Scedule_service/add';

$route['ac_service'] = "Detail_page/ac_service";
$route['plumbing'] = "Detail_page/plumbing";
$route['electric'] = "Detail_page/electric";
$route['glass_work'] = "Detail_page/glass_work";
$route['gypsum_ceiling'] = "Detail_page/gypsum_ceiling";
$route['painting'] = "Detail_page/painting";
$route['interior_painting'] = "Detail_page/interior_painting";
$route['exterior_painting'] = "Detail_page/exterior_painting";
$route['masonry'] = "Detail_page/masonry";

$route['Careers'] = "Contact/Careers";
$route['Careers_add'] = "Contact/Careers_add";

$route['Partner'] = "Contact/Partner";
$route['Partner_add'] = "Contact/Partner_add";

$route['service_taken'] = "Services/service_taken";
$route['add_guest'] = "welcome/add_guest";
$route['Forgot_password'] = "login/reset_password";
$route['update_password'] = "login/update_password";
$route['contact/add'] = "Contact/add";
$route['Forgot_password/token/(:any)'] = 'login/update_password';
$route['get_guest_user_vals'] = "welcome/get_guest_user_vals";
/* End of file routes.php */
/* Location: ./application/config/routes.php */