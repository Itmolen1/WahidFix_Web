<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-21 08:52:40 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_email`, `tbl_user_platform`, `tbl_user_device_id`, `tbl_user_device_token`
FROM `tbl_user`
WHERE `tbl_user_id` = '1'
ERROR - 2019-11-21 08:52:54 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_email`, `tbl_user_platform`, `tbl_user_device_id`, `tbl_user_device_token`
FROM `tbl_user`
WHERE `tbl_user_id` = '1'
ERROR - 2019-11-21 08:53:31 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_email`, `tbl_user_platform`, `tbl_user_device_id`, `tbl_user_device_token`
FROM `tbl_user`
WHERE `tbl_user_id` = '1'
ERROR - 2019-11-21 09:00:03 --> Query error: Unknown column 'd.tbl_user_device_id' in 'field list' - Invalid query: SELECT `u`.`tbl_user_id`, `u`.`tbl_user_name`, `u`.`tbl_user_mobile`, `u`.`tbl_user_email`, `d`.`tbl_user_platform`, `d`.`tbl_user_device_id`, `d`.`tbl_user_device_token`
FROM `tbl_user` as `u`
LEFT JOIN `tbl_user` as `d` ON `d`.`tbl_user_id` = `u`.`tbl_user_id`
WHERE `u`.`tbl_user_id` = '1'
ERROR - 2019-11-21 09:15:37 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/Service_request_model.php:172) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-21 09:15:37 --> Severity: Error --> Call to undefined function string() /home/wahidfix/public_html/admin/application/models/Service_request_model.php 172
ERROR - 2019-11-21 10:54:08 --> Severity: error --> Exception: /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php exists, but doesn't declare class User_api_model /home/wahidfix/public_html/admin/system/core/Loader.php 340
ERROR - 2019-11-21 14:08:17 --> Query error: Unknown column 'sr.sr_id' in 'field list' - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `sr`.`created_at`, `sr`.`status`, `t`.`time_slot_name`
FROM `tbl_service_request`
WHERE `assigned_emp_id` = 33
ERROR - 2019-11-21 14:08:41 --> Query error: Unknown column 't.time_slot_name' in 'field list' - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `sr`.`created_at`, `sr`.`status`, `t`.`time_slot_name`
FROM `tbl_service_request` as `sr`
WHERE `assigned_emp_id` = 33
ERROR - 2019-11-21 14:08:43 --> Query error: Unknown column 't.time_slot_name' in 'field list' - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `sr`.`created_at`, `sr`.`status`, `t`.`time_slot_name`
FROM `tbl_service_request` as `sr`
WHERE `assigned_emp_id` = 33
ERROR - 2019-11-21 14:09:39 --> Query error: Unknown column 't.time_slot_name' in 'field list' - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `sr`.`created_at`, `sr`.`status`, `t`.`time_slot_name`
FROM `tbl_service_request` as `sr`
WHERE `assigned_emp_id` = 32
ERROR - 2019-11-21 14:11:30 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:486) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-21 14:11:30 --> Severity: Parsing Error --> syntax error, unexpected ';' /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 486
ERROR - 2019-11-21 14:11:51 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:486) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-21 14:11:51 --> Severity: Parsing Error --> syntax error, unexpected ';' /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 486
ERROR - 2019-11-21 14:11:54 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:486) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-21 14:11:54 --> Severity: Parsing Error --> syntax error, unexpected ';' /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 486
ERROR - 2019-11-21 14:11:59 --> Query error: Unknown column 't.time_slot_name' in 'field list' - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `sr`.`created_at`, `sr`.`status`, `t`.`time_slot_name`
FROM `tbl_service_request` as `sr`
WHERE `assigned_emp_id` = 33
ERROR - 2019-11-21 14:12:49 --> Query error: Unknown column 't.time_slot_name' in 'field list' - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `sr`.`created_at`, `sr`.`status`, `t`.`time_slot_name`
FROM `tbl_service_request` as `sr`
WHERE `assigned_emp_id` = 33
ERROR - 2019-11-21 14:12:51 --> Query error: Unknown column 't.time_slot_name' in 'field list' - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `sr`.`created_at`, `sr`.`status`, `t`.`time_slot_name`
FROM `tbl_service_request` as `sr`
WHERE `assigned_emp_id` = 33
ERROR - 2019-11-21 14:38:11 --> Query error: Column 'isDeleted' in where clause is ambiguous - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `t`.`time_slot_name`, `sr`.`created_at`, `sr`.`status`, `s`.`service_name`, `s`.`service_desc`, `s`.`service_logo`
FROM `tbl_service_request` as `sr`
JOIN `tbl_time_slot` as `t` ON `t`.`time_slot_id`=`sr`.`prefferd_time`
JOIN `tbl_services` as `s` ON `s`.`service_id`=`sr`.`sr_id`
WHERE `assigned_emp_id` = 33
AND `isDeleted` = 0
ERROR - 2019-11-21 14:38:49 --> Query error: Column 'isDeleted' in where clause is ambiguous - Invalid query: SELECT `sr`.`sr_id`, `sr`.`service_request_ref`, `sr`.`prefferd_date`, `sr`.`prefferd_time`, `t`.`time_slot_name`, `sr`.`created_at`, `sr`.`status`, `s`.`service_name`, `s`.`service_desc`, `s`.`service_logo`
FROM `tbl_service_request` as `sr`
JOIN `tbl_time_slot` as `t` ON `t`.`time_slot_id`=`sr`.`prefferd_time`
JOIN `tbl_services` as `s` ON `s`.`service_id`=`sr`.`sr_id`
WHERE `assigned_emp_id` = 33
AND `isDeleted` = 0
ERROR - 2019-11-21 15:02:12 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:12:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:12:33 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:12:47 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:15:46 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:19:02 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:19:05 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:19:09 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:20:04 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:20:16 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:20:28 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:31:18 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:42:50 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:47:11 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:47:49 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:49:32 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:50:37 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:50:56 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-21 15:54:21 --> 404 Page Not Found: webapi/User_api/orderList
