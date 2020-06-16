<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = "login";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['deleteUser/(:num)'] = "user/deleteUser/$1";
$route['profile'] = "user/profile";
$route['profile/(:any)'] = "user/profile/$1";
$route['profileUpdate'] = "user/profileUpdate";
$route['profileUpdate/(:any)'] = "user/profileUpdate/$1";

$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['changePassword/(:any)'] = "user/changePassword/$1";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:num)'] = "user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

/*new routes*/
//services
$route['servicesListing'] = 'Services/servicesListing';
$route['servicesListing/(:num)'] = "Services/servicesListing/$1";
$route['addNewService'] = "Services/addNewService";
$route['addNewServices'] = "Services/addNewServices";
$route['deleteservices/(:num)'] = "Services/deleteservices/$1";
$route['editService/(:num)'] = "Services/editService/$1";
$route['editService'] = "Services/editService";

//sub services
$route['sub_service_listing'] = 'sub_services/sub_service_listing';
$route['sub_service_listing/(:num)'] = "sub_services/sub_service_listing/$1";
$route['add_new_subservice'] = "sub_services/add_new_subservice";
$route['delete_sub_service/(:num)'] = "sub_services/delete_sub_service/$1";
$route['edit_sub_subservice/(:num)'] = "sub_services/edit_sub_subservice/$1";
$route['edit_sub_subservice'] = "sub_services/edit_sub_subservice";

//contact us
$route['contact_us_listing'] = 'contact_us/contact_us_listing';
$route['contact_us_listing/(:num)'] = "contact_us/contact_us_listing/$1";
$route['contact_us_reply/(:num)'] = 'contact_us/contact_us_reply/$1';
$route['contact_us_reply'] = 'contact_us/contact_us_reply';
$route['delete_contact_us/(:num)'] = "contact_us/delete_contact_us/$1";

//Careers
$route['careers_listing'] = 'Careers/careers_listing';
//$route['careers_listing/(:num)'] = "Careers/careers_listing/$1";
//$route['contact_us_reply/(:num)'] = 'Careers/contact_us_reply/$1';
//$route['contact_us_reply'] = 'Careers/contact_us_reply';
$route['delete_careers/(:num)'] = "Careers/delete_careers/$1";

//partner
$route['partner_listing'] = 'Partner/partner_listing';
//$route['careers_listing/(:num)'] = "Careers/careers_listing/$1";
//$route['contact_us_reply/(:num)'] = 'Careers/contact_us_reply/$1';
//$route['contact_us_reply'] = 'Careers/contact_us_reply';
$route['delete_partner/(:num)'] = "Partner/delete_partner/$1";


//slider
$route['sliderListing'] = 'Slider/sliderListing';
$route['addNewSlider'] = "Slider/addNewSlider";
$route['addNewSliders'] = "slider/addNewSliders";
$route['deleteslider/(:num)'] = "slider/deleteslider/$1";
$route['editSlider/(:num)'] = "slider/editSlider/$1";
$route['editSlider'] = "slider/editSlider";
$route['sliderListing/(:num)'] = "slider/sliderListing/$1";


//service request
$route['service_request_listing'] = 'service_request/service_request_listing';
$route['edit_service_request/(:num)'] = "service_request/edit_service_request/$1";
$route['edit_service_request'] = "service_request/edit_service_request";
$route['service_request_listing/(:num)'] = "service_request/service_request_listing/$1";
$route['delete_service_request/(:num)'] = "service_request/delete_service_request/$1";
$route['track_service_request/(:num)'] = "service_request/track_service_request/$1";
$route['get_latest_cordinates'] = "service_request/get_latest_cordinates";
$route['detailed_status_service_request/(:num)'] = "service_request/detailed_status_service_request/$1";
$route['get_suborder_details'] = "service_request/get_suborder_details";
$route['sr_admin_accept/(:num)'] = "service_request/sr_admin_accept/$1";
$route['sr_admin_reject/(:num)'] = "service_request/sr_admin_reject/$1";

//guest service request
$route['guest_service_request_listing'] = 'guest_service_request/guest_service_request_listing';
$route['edit_guest_service_request/(:num)'] = "guest_service_request/edit_guest_service_request/$1";
$route['edit_guest_service_request'] = "guest_service_request/edit_guest_service_request";
$route['guest_service_request_listing/(:num)'] = "guest_service_request/guest_service_request_listing/$1";
$route['delete_guest_service_request/(:num)'] = "guest_service_request/delete_guest_service_request/$1";
$route['get_guest_suborder_details'] = "guest_service_request/get_guest_suborder_details";

//employee
$route['employee_listing'] = 'employee/employee_listing';
$route['add_new_employee'] = 'employee/add_new_employee';
$route['edit_employee/(:num)'] = "employee/edit_employee/$1";
$route['edit_employee'] = "employee/edit_employee";
$route['delete_employee/(:num)'] = "employee/delete_employee";
$route['employee_listing/(:num)'] = "employee/employee_listing/$1";
$route['employee_email_exists'] = "employee/employee_email_exists";

//item unit
$route['item_unit_listing'] = 'item_unit/item_unit_listing';
$route['item_unit_listing/(:num)'] = "item_unit/item_unit_listing/$1";
$route['add_new_item_unit'] = "item_unit/add_new_item_unit";
$route['delete_item_unit/(:num)'] = "item_unit/delete_item_unit/$1";
$route['edit_item_unit/(:num)'] = "item_unit/edit_item_unit/$1";
$route['edit_item_unit'] = "item_unit/edit_item_unit";

//MODULE MASTER
$route['module_master_listing'] = 'module_master/module_master_listing';
$route['module_master_listing/(:num)'] = "module_master/module_master_listing/$1";
$route['add_new_module_master'] = "module_master/add_new_module_master";
$route['delete_module_master/(:num)'] = "module_master/delete_module_master/$1";
$route['edit_module_master/(:num)'] = "module_master/edit_module_master/$1";
$route['edit_module_master'] = "module_master/edit_module_master";

//ROLE MASTER
$route['role_master_listing'] = 'role_master/role_master_listing';
$route['role_master_listing/(:num)'] = "role_master/role_master_listing/$1";
$route['add_new_role_master'] = "role_master/add_new_role_master";
$route['delete_role_master/(:num)'] = "role_master/delete_role_master/$1";
$route['edit_role_master/(:num)'] = "role_master/edit_role_master/$1";
$route['edit_role_master'] = "role_master/edit_role_master";

$route['AssignRightsRole'] = 'role_master/AssignRightsRole';
$route['AssignRightsRole/(:num)'] = 'role_master/AssignRightsRole/$1';


//item category
$route['item_category_listing'] = 'item_category/item_category_listing';
$route['item_category_listing/(:num)'] = "item_category/item_category_listing/$1";
$route['add_new_item_category'] = "item_category/add_new_item_category";
$route['delete_item_category/(:num)'] = "item_category/delete_item_category/$1";
$route['edit_item_category/(:num)'] = "item_category/edit_item_category/$1";
$route['edit_item_category'] = "item_category/edit_item_category";

//time slot
$route['time_slot_listing'] = 'time_slot/time_slot_listing';
$route['time_slot_listing/(:num)'] = "time_slot/time_slot_listing/$1";
$route['add_new_time_slot'] = "time_slot/add_new_time_slot";
$route['delete_time_slot/(:num)'] = "time_slot/delete_time_slot/$1";
$route['edit_time_slot/(:num)'] = "time_slot/edit_time_slot/$1";
$route['edit_time_slot'] = "time_slot/edit_time_slot";

//item master
$route['item_master_listing'] = 'item_master/item_master_listing';
$route['item_master_listing/(:num)'] = "item_master/item_master_listing/$1";
$route['add_new_item_master'] = "item_master/add_new_item_master";
$route['delete_item_master/(:num)'] = "item_master/delete_item_master/$1";
$route['edit_item_master/(:num)'] = "item_master/edit_item_master/$1";
$route['edit_item_master'] = "item_master/edit_item_master";

//registered user
$route['r_user_listing'] = 'r_user/r_user_listing';
$route['r_user_listing/(:num)'] = "r_user/r_user_listing/$1";
$route['add_new_r_user'] = "r_user/add_new_r_user";
$route['delete_r_user/(:num)'] = "r_user/delete_r_user/$1";
$route['edit_r_user/(:num)'] = "r_user/edit_r_user/$1";
$route['edit_r_user'] = "r_user/edit_r_user";

//guest user
$route['guest_user_listing'] = 'guest_user/guest_user_listing';
$route['guest_user_listing/(:num)'] = "guest_user/guest_user_listing/$1";
$route['add_new_guest_user'] = "guest_user/add_new_guest_user";
$route['delete_guest_user/(:num)'] = "guest_user/delete_guest_user/$1";
$route['edit_guest_user/(:num)'] = "guest_user/edit_guest_user/$1";
$route['edit_guest_user'] = "guest_user/edit_guest_user";

//vendor 
$route['vendor_listing'] = 'vendor/vendor_listing';
$route['vendor_listing/(:num)'] = "vendor/vendor_listing/$1";
$route['add_new_vendor'] = "vendor/add_new_vendor";
$route['delete_vendor/(:num)'] = "vendor/delete_vendor/$1";
$route['edit_vendor/(:num)'] = "vendor/edit_vendor/$1";
$route['edit_vendor'] = "vendor/edit_vendor";
$route['vendor_email_exists'] = "vendor/vendor_email_exists";


//vehicle
$route['vehicle_listing'] = 'vehicle/vehicle_listing';
$route['add_new_vehicle'] = 'vehicle/add_new_vehicle';
$route['edit_vehicle/(:num)'] = "vehicle/edit_vehicle/$1";
$route['edit_vehicle'] = "vehicle/edit_vehicle";
$route['delete_vehicle/(:num)'] = "vehicle/delete_vehicle";
$route['vehicle_listing/(:num)'] = "vehicle/vehicle_listing/$1";
$route['vehicle_no_exists'] = "vehicle/vehicle_no_exists";

// purchase order
$route['purchase_order_listing'] = 'purchase_order/purchase_order_listing';
$route['add_new_purchase_order'] = 'purchase_order/add_new_purchase_order';
$route['add_po_boi_session'] = 'purchase_order/add_po_boi_session';
$route['delete_po_boi_session'] = 'purchase_order/delete_po_boi_session';
$route['delete_purchase_order/(:num)'] = 'purchase_order/delete_purchase_order/$1';
$route['edit_purchase_order/(:num)'] = "purchase_order/edit_purchase_order/$1";
$route['edit_purchase_order'] = "purchase_order/edit_purchase_order";
$route['edit_po_boi_session'] = "purchase_order/edit_po_boi_session";
$route['purchase_order_pdf'] = "purchase_order/purchase_order_pdf";
$route['purchase_order_email'] = "purchase_order/purchase_order_email";
$route['purchase_order_get_payment_record_details'] = "purchase_order/purchase_order_get_payment_record_details";
$route['purchase_order_add_payment_record'] = "purchase_order/purchase_order_add_payment_record";
$route['po_export_exl/(:num)'] = "purchase_order/po_export_exl/$1";

// purchase master
$route['purchase_master_listing'] = 'purchase_master/purchase_master_listing';
$route['add_new_purchase_master'] = 'purchase_master/add_new_purchase_master';
$route['add_pm_boi_session'] = 'purchase_master/add_pm_boi_session';
$route['delete_pm_boi_session'] = 'purchase_master/delete_pm_boi_session';
$route['delete_purchase_master/(:num)'] = 'purchase_master/delete_purchase_master/$1';
$route['edit_purchase_master/(:num)'] = "purchase_master/edit_purchase_master/$1";
$route['edit_purchase_master'] = "purchase_master/edit_purchase_master";
$route['edit_pm_boi_session'] = "purchase_master/edit_pm_boi_session";
$route['purchase_master_pdf'] = "purchase_master/purchase_master_pdf";
$route['purchase_master_email'] = "purchase_master/purchase_master_email";
$route['purchase_master_get_payment_record_details'] = "purchase_master/purchase_master_get_payment_record_details";
$route['purchase_master_add_payment_record'] = "purchase_master/purchase_master_add_payment_record";
$route['pm_export_exl/(:num)'] = "purchase_master/pm_export_exl/$1";


// sales quotation
$route['sales_quotation_listing'] = 'sales_quotation/sales_quotation_listing';
$route['add_new_purchase_master'] = 'sales_quotation/add_new_purchase_master';
$route['add_pm_boi_session'] = 'sales_quotation/add_pm_boi_session';

// sales master
$route['sales_master_listing'] = 'sales_master/sales_master_listing';

// rights and roles
// $route['AssignRights'] = 'User/AssignRights';
// $route['AssignRights/(:num)'] = 'User/AssignRights/$1';

$route['AssignRole'] = 'User/AssignRole';
$route['AssignRole/(:num)'] = 'User/AssignRole/$1';

//contact
$route['contact_listing'] = 'Contact/contact_listing';
$route['contact_listing/(:num)'] = "Contact/contact_listing/$1";
$route['add_new_contact'] = "Contact/add_new_contact";
$route['delete_contact/(:num)'] = "Contact/delete_contact/$1";
$route['edit_contact/(:num)'] = "Contact/edit_contact/$1";
$route['edit_contact'] = "Contact/edit_contact";


//Reports
$route['Reports_listing'] = 'Reports/Reports_listing';
// $route['contact_listing/(:num)'] = "Contact/contact_listing/$1";
// $route['add_new_contact'] = "Contact/add_new_contact";
// $route['delete_contact/(:num)'] = "Contact/delete_contact/$1";
// $route['edit_contact/(:num)'] = "Contact/edit_contact/$1";
// $route['edit_contact'] = "Contact/edit_contact";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
