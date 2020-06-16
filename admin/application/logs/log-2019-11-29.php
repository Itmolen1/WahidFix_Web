<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-29 09:08:09 --> Severity: error --> Exception: /home/wahidfix/public_html/admin/application/models/Contact_model.php exists, but doesn't declare class Contact_model /home/wahidfix/public_html/admin/system/core/Loader.php 340
ERROR - 2019-11-29 09:14:54 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:16:25 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:16:27 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:20:27 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:20:29 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:20:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:23:16 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:23:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/Contact.php:58) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 09:23:24 --> Severity: Error --> Call to undefined method Contact_model::add_new_contact() /home/wahidfix/public_html/admin/application/controllers/Contact.php 58
ERROR - 2019-11-29 09:24:49 --> Severity: Notice --> Undefined property: stdClass::$contact_created_at /home/wahidfix/public_html/admin/application/views/Contact_list.php 56
ERROR - 2019-11-29 09:24:49 --> Severity: Notice --> Undefined property: stdClass::$contact_updated_at /home/wahidfix/public_html/admin/application/views/Contact_list.php 57
ERROR - 2019-11-29 09:27:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/Contact.php:96) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 09:27:45 --> Severity: Error --> Call to undefined method Contact_model::delete_contact() /home/wahidfix/public_html/admin/application/controllers/Contact.php 96
ERROR - 2019-11-29 09:28:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/Contact.php:96) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 09:28:17 --> Severity: Error --> Call to undefined method Contact_model::delete_contact() /home/wahidfix/public_html/admin/application/controllers/Contact.php 96
ERROR - 2019-11-29 09:28:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/Contact.php:96) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 09:28:21 --> Severity: Error --> Call to undefined method Contact_model::delete_contact() /home/wahidfix/public_html/admin/application/controllers/Contact.php 96
ERROR - 2019-11-29 09:28:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/Contact.php:96) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 09:28:26 --> Severity: Error --> Call to undefined method Contact_model::delete_contact() /home/wahidfix/public_html/admin/application/controllers/Contact.php 96
ERROR - 2019-11-29 09:28:52 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/Contact.php:84) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 09:28:52 --> Severity: Error --> Call to undefined method Contact_model::get_contact_info() /home/wahidfix/public_html/admin/application/controllers/Contact.php 84
ERROR - 2019-11-29 09:30:07 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:31:17 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:31:27 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 09:39:46 --> 404 Page Not Found: Sales_quotation/add_new_purchase_master
ERROR - 2019-11-29 09:40:03 --> 404 Page Not Found: Sales_quotation/add_new_purchase_master
ERROR - 2019-11-29 09:40:14 --> 404 Page Not Found: Sales_quotation/add_new_purchase_master
ERROR - 2019-11-29 09:40:59 --> 404 Page Not Found: Sales_quotation/add_new_purchase_master
ERROR - 2019-11-29 09:41:06 --> 404 Page Not Found: Sales_quotation/add_new_purchase_master
ERROR - 2019-11-29 10:12:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:285) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 10:12:46 --> Severity: Compile Error --> Cannot redeclare User_api_model::get_details_for_sm() /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 285
ERROR - 2019-11-29 10:29:59 --> Query error: Unknown column 'ic.item_master_logo' in 'field list' - Invalid query: SELECT `s`.`sales_quotation_boi_id`, `s`.`item_master_id`, `i`.`item_master_name`, `s`.`item_unit_id` as `item_master_unit`, `u`.`item_unit_name`, `s`.`sales_quotation_boi_qty`, `s`.`sales_quotation_boi_rate`, `s`.`sales_quotation_id`, `ic`.`item_category_id`, `ic`.`item_category_name`, `ic`.`item_master_logo`
FROM `tbl_sales_quotation_boi` as `s`
JOIN `tbl_item_master` as `i` ON `i`.`item_master_id`=`s`.`item_master_id`
JOIN `tbl_item_unit` as `u` ON `u`.`item_unit_id`=`s`.`item_unit_id`
JOIN `tbl_item_category` as `ic` ON `ic`.`item_category_id`=`i`.`item_master_category`
WHERE `s`.`sales_quotation_id` = 12
ERROR - 2019-11-29 11:27:28 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:255) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 11:27:28 --> Severity: Parsing Error --> syntax error, unexpected ',', expecting ')' /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 255
ERROR - 2019-11-29 12:44:23 --> Severity: Warning --> array_merge(): Argument #2 is not an array /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 573
ERROR - 2019-11-29 12:44:35 --> Severity: Warning --> array_merge(): Argument #2 is not an array /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 573
ERROR - 2019-11-29 12:45:31 --> Severity: Warning --> array_merge(): Argument #2 is not an array /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 573
ERROR - 2019-11-29 13:16:07 --> 404 Page Not Found: webapi/User_api/CreateSalesQuotationUser_api
ERROR - 2019-11-29 13:30:11 --> 404 Page Not Found: webapi/User_api/CreateSalesQuotationUser_api
ERROR - 2019-11-29 14:28:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:1133) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 14:28:16 --> Severity: Parsing Error --> syntax error, unexpected end of file /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 1133
ERROR - 2019-11-29 14:35:24 --> Severity: Notice --> Undefined variable: srid /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 342
ERROR - 2019-11-29 14:40:00 --> Severity: Notice --> Undefined variable: srid /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 342
ERROR - 2019-11-29 15:54:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 15:55:04 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-29 17:38:18 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-29 17:38:18 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_email`, `tbl_user_device_id`, `tbl_user_device_type`, `tbl_user_device_token`
FROM `tbl_user`
WHERE `tbl_user_email` = Array
ERROR - 2019-11-29 17:38:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 17:38:50 --> Severity: Notice --> Undefined index: tbl_user_email /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 1372
ERROR - 2019-11-29 17:38:50 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_email`, `tbl_user_device_id`, `tbl_user_device_type`, `tbl_user_device_token`
FROM `tbl_user`
WHERE `tbl_user_email` IS NULL
ERROR - 2019-11-29 17:38:50 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 17:38:55 --> Severity: Notice --> Undefined index: tbl_user_email /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 1372
ERROR - 2019-11-29 17:38:55 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_email`, `tbl_user_device_id`, `tbl_user_device_type`, `tbl_user_device_token`
FROM `tbl_user`
WHERE `tbl_user_email` IS NULL
ERROR - 2019-11-29 17:38:55 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 17:39:34 --> Severity: Notice --> Undefined index: tbl_user_email /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 1372
ERROR - 2019-11-29 17:39:37 --> Severity: Notice --> Undefined index: tbl_user_email /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 1372
ERROR - 2019-11-29 17:40:09 --> Severity: Notice --> Undefined index: tbl_user_email /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 1372
ERROR - 2019-11-29 17:52:03 --> Severity: Notice --> Undefined index: tbl_user_id /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 1397
ERROR - 2019-11-29 17:52:03 --> Query error: Unknown column 'tbl_user_device_type' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_device_type`, `tbl_user_address`, `tbl_user_dept`, `tbl_user_experiance`, `tbl_user_current_company`, `tbl_user_previouse_company`, `tbl_user_expected_salary`, `tbl_user_city`, `tbl_user_image`
FROM `tbl_user`
WHERE `tbl_user_id` IS NULL
ERROR - 2019-11-29 17:52:03 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-29 17:57:21 --> 404 Page Not Found: Forgot_password/token
ERROR - 2019-11-29 17:57:49 --> 404 Page Not Found: Forgot_password/token
ERROR - 2019-11-29 17:58:08 --> 404 Page Not Found: Forgot_password/token
ERROR - 2019-11-29 17:58:51 --> 404 Page Not Found: Forgot_password/token
