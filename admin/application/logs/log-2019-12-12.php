<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-12 07:50:37 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 07:51:18 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 07:54:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 07:57:52 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 07:58:54 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 07:59:13 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:00:12 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:01:49 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:02:26 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:11:30 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:11:37 --> 404 Page Not Found: Sr_admin_accept/7
ERROR - 2019-12-12 08:11:42 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:12:49 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:12:56 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:13:18 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:13:38 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:13:41 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:16:29 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 08:55:14 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 873
ERROR - 2019-12-12 08:55:14 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 873
ERROR - 2019-12-12 08:55:14 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 873
ERROR - 2019-12-12 08:55:14 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 873
ERROR - 2019-12-12 09:38:07 --> Severity: Notice --> Undefined index: status /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 362
ERROR - 2019-12-12 09:38:07 --> Severity: Notice --> Undefined index: page_size /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 362
ERROR - 2019-12-12 09:38:07 --> Severity: Notice --> Undefined index: page_num /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 362
ERROR - 2019-12-12 09:38:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY sr.sr_id DESC LIMIT 0,' at line 1 - Invalid query: SELECT sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.pending_amount,sr.assigned_emp_id,sr.status FROM tbl_service_request sr LEFT JOIN tbl_time_slot t ON t.time_slot_id=sr.prefferd_time  WHERE sr.isDeleted = 0 AND sr.status =  ORDER BY sr.sr_id DESC LIMIT 0,
ERROR - 2019-12-12 09:38:07 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-12 10:33:48 --> Severity: Notice --> Undefined index: status /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 388
ERROR - 2019-12-12 10:33:48 --> Severity: Notice --> Undefined index: page_size /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 388
ERROR - 2019-12-12 10:33:48 --> Severity: Notice --> Undefined index: page_num /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 388
ERROR - 2019-12-12 10:33:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY sr.sr_id DESC LIMIT 0,' at line 1 - Invalid query: SELECT sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,t.time_slot_name,sr.pending_amount,sr.assigned_emp_id,sr.status FROM tbl_service_request sr LEFT JOIN tbl_time_slot t ON t.time_slot_id=sr.prefferd_time  WHERE sr.isDeleted = 0 AND sr.status =  ORDER BY sr.sr_id DESC LIMIT 0,
ERROR - 2019-12-12 10:33:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-12 10:35:15 --> Severity: Notice --> Undefined variable: offset /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 1468
ERROR - 2019-12-12 10:35:15 --> Severity: Notice --> Undefined variable: limit /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 1469
ERROR - 2019-12-12 10:43:13 --> Severity: Notice --> Undefined variable: tow /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 1483
ERROR - 2019-12-12 10:43:13 --> Severity: Warning --> array_merge(): Argument #1 is not an array /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 1483
ERROR - 2019-12-12 13:54:09 --> Query error: Table 'wahidfix_main.tbl_module_master' doesn't exist - Invalid query: SELECT `BaseTbl`.`module_master_id`, `BaseTbl`.`module_master_name`, `BaseTbl`.`module_master_created_at`, `BaseTbl`.`module_master_updated_at`
FROM `tbl_module_master` as `BaseTbl`
WHERE `BaseTbl`.`isDeleted` = 0
ERROR - 2019-12-12 13:56:33 --> Query error: Unknown column 'BaseTbl.isDeleted' in 'where clause' - Invalid query: SELECT `BaseTbl`.`module_id`, `BaseTbl`.`module_name`, `BaseTbl`.`module_lable`
FROM `tbl_modules` as `BaseTbl`
WHERE `BaseTbl`.`isDeleted` = 0
ERROR - 2019-12-12 13:57:20 --> Severity: Notice --> Undefined property: stdClass::$module_master_name /home/wahidfix/public_html/admin/application/views/module_master_list_view.php 49
ERROR - 2019-12-12 13:57:20 --> Severity: Notice --> Undefined property: stdClass::$module_master_id /home/wahidfix/public_html/admin/application/views/module_master_list_view.php 53
ERROR - 2019-12-12 13:57:20 --> Severity: Notice --> Undefined property: stdClass::$module_master_id /home/wahidfix/public_html/admin/application/views/module_master_list_view.php 54
ERROR - 2019-12-12 13:57:20 --> Severity: Notice --> Undefined property: stdClass::$module_master_name /home/wahidfix/public_html/admin/application/views/module_master_list_view.php 49
ERROR - 2019-12-12 13:57:20 --> Severity: Notice --> Undefined property: stdClass::$module_master_id /home/wahidfix/public_html/admin/application/views/module_master_list_view.php 53
ERROR - 2019-12-12 13:57:20 --> Severity: Notice --> Undefined property: stdClass::$module_master_id /home/wahidfix/public_html/admin/application/views/module_master_list_view.php 54
ERROR - 2019-12-12 13:58:47 --> Severity: Notice --> Undefined property: stdClass::$module_master_name /home/wahidfix/public_html/admin/application/views/module_master_list_view.php 48
ERROR - 2019-12-12 13:58:47 --> Severity: Notice --> Undefined property: stdClass::$module_master_name /home/wahidfix/public_html/admin/application/views/module_master_list_view.php 48
ERROR - 2019-12-12 14:00:48 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:06:10 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:06:26 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:08:20 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:09:30 --> Query error: Unknown column 'module_master_name' in 'field list' - Invalid query: INSERT INTO `tbl_modules` (`module_master_name`, `module_master_created_at`, `module_master_updated_at`) VALUES ('', '2019-12-12 14:09:30', '2019-12-12 14:09:30')
ERROR - 2019-12-12 14:18:16 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:18:28 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:18:51 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:19:00 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:19:21 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:19:38 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:19:48 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:21:01 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:21:26 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:21:39 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:21:57 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:22:36 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:23:12 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:24:02 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:24:29 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:24:45 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:24:59 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:25:15 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:25:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:25:49 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:50 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:26:51 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 95
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 96
ERROR - 2019-12-12 14:36:33 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 97
ERROR - 2019-12-12 14:38:31 --> Severity: Parsing Error --> syntax error, unexpected '{' /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 94
ERROR - 2019-12-12 14:39:02 --> Severity: Parsing Error --> syntax error, unexpected '}' /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 103
ERROR - 2019-12-12 14:40:15 --> Severity: Parsing Error --> syntax error, unexpected '}' /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 103
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 104
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 105
ERROR - 2019-12-12 14:41:10 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 106
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 98
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:42:18 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 2 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 3 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 4 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 5 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 6 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 7 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 8 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 9 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 10 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 11 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 12 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 13 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 14 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 15 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 16 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 17 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 18 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 19 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 20 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 21 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 107
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 116
ERROR - 2019-12-12 14:43:35 --> Severity: Notice --> Undefined offset: 22 /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 125
ERROR - 2019-12-12 14:45:23 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 14:47:23 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-12 16:49:54 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/User_model.php:72) /home/wahidfix/public_html/admin/system/helpers/url_helper.php 564
ERROR - 2019-12-12 16:50:23 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/User_model.php:72) /home/wahidfix/public_html/admin/system/helpers/url_helper.php 564
ERROR - 2019-12-12 16:50:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/User_model.php:72) /home/wahidfix/public_html/admin/system/helpers/url_helper.php 564
ERROR - 2019-12-12 17:16:40 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 873
ERROR - 2019-12-12 17:16:40 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 873
ERROR - 2019-12-12 17:16:40 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 873
ERROR - 2019-12-12 17:16:40 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 873
ERROR - 2019-12-12 17:19:32 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 874
ERROR - 2019-12-12 17:19:32 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 874
ERROR - 2019-12-12 17:19:32 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 874
ERROR - 2019-12-12 17:19:32 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 874
ERROR - 2019-12-12 17:21:50 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 875
ERROR - 2019-12-12 17:21:50 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 875
ERROR - 2019-12-12 17:21:50 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 875
ERROR - 2019-12-12 17:21:50 --> Severity: Notice --> Undefined offset: 0 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 875
