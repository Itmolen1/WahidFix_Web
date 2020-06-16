<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-19 09:15:39 --> 404 Page Not Found: webapi/User_api/api
ERROR - 2019-12-19 09:27:09 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:858) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 09:27:09 --> Severity: Parsing Error --> syntax error, unexpected '}' /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 858
ERROR - 2019-12-19 09:27:44 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:858) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 09:27:44 --> Severity: Parsing Error --> syntax error, unexpected '}' /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 858
ERROR - 2019-12-19 09:28:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:860) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 09:28:24 --> Severity: Parsing Error --> syntax error, unexpected '}' /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 860
ERROR - 2019-12-19 09:28:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:860) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 09:28:26 --> Severity: Parsing Error --> syntax error, unexpected '}' /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 860
ERROR - 2019-12-19 10:36:57 --> Severity: Notice --> Undefined variable: input /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 1222
ERROR - 2019-12-19 10:36:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'WHERE `isDeleted` = 0
AND `sr_id` IS NULL' at line 2 - Invalid query: SELECT `tbl_user_id`
WHERE `isDeleted` = 0
AND `sr_id` IS NULL
ERROR - 2019-12-19 10:36:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 10:37:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'WHERE `isDeleted` = 0
AND `sr_id` = 1' at line 2 - Invalid query: SELECT `tbl_user_id`
WHERE `isDeleted` = 0
AND `sr_id` = 1
ERROR - 2019-12-19 10:43:35 --> Query error: Unknown column 'tbl_user_platformn' in 'field list' - Invalid query: SELECT `tbl_user_device_id`, `tbl_user_platformn`, `tbl_user_device_token`
FROM `tbl_user_devices`
WHERE `isDeleted` = 0
ERROR - 2019-12-19 10:45:10 --> Query error: Unknown column 'tbl_user_platformn' in 'field list' - Invalid query: SELECT `tbl_user_device_id`, `tbl_user_platformn`, `tbl_user_device_token`
FROM `tbl_user_devices`
WHERE `isDeleted` = 0
AND `tbl_user_id` = '67'
ERROR - 2019-12-19 11:14:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:1488) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 11:14:32 --> Severity: Compile Error --> Cannot redeclare User_api_model::get_user_details() /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 1488
ERROR - 2019-12-19 11:19:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:2166) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 11:19:00 --> Severity: Compile Error --> Cannot redeclare User_api::Android() /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 2166
ERROR - 2019-12-19 11:19:27 --> Severity: Notice --> Undefined variable: value /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 865
ERROR - 2019-12-19 11:19:27 --> Severity: Notice --> Undefined variable: value /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 865
ERROR - 2019-12-19 11:19:27 --> Severity: Notice --> Undefined property: User_api::$service_request_model /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 908
ERROR - 2019-12-19 11:19:27 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 11:19:27 --> Severity: Error --> Call to a member function insert_user_notification() on null /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 908
ERROR - 2019-12-19 11:20:07 --> Severity: Notice --> Undefined variable: value /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 865
ERROR - 2019-12-19 11:20:07 --> Severity: Notice --> Undefined property: User_api::$service_request_model /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 908
ERROR - 2019-12-19 11:20:07 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 11:20:07 --> Severity: Error --> Call to a member function insert_user_notification() on null /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 908
ERROR - 2019-12-19 11:20:11 --> Severity: Notice --> Undefined variable: value /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 865
ERROR - 2019-12-19 11:20:11 --> Severity: Notice --> Undefined property: User_api::$service_request_model /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 908
ERROR - 2019-12-19 11:20:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 11:20:11 --> Severity: Error --> Call to a member function insert_user_notification() on null /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 908
ERROR - 2019-12-19 11:20:34 --> Severity: Notice --> Undefined property: User_api::$service_request_model /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 908
ERROR - 2019-12-19 11:20:34 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 11:20:34 --> Severity: Error --> Call to a member function insert_user_notification() on null /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 908
ERROR - 2019-12-19 11:22:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:2086) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 11:22:17 --> Severity: Compile Error --> Cannot redeclare User_api_model::insert_user_notification() /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 2086
ERROR - 2019-12-19 17:07:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:169) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 17:07:45 --> Severity: Parsing Error --> syntax error, unexpected ',', expecting ')' /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 169
ERROR - 2019-12-19 17:07:50 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:169) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 17:07:50 --> Severity: Parsing Error --> syntax error, unexpected ',', expecting ')' /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 169
ERROR - 2019-12-19 17:08:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:169) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 17:08:46 --> Severity: Parsing Error --> syntax error, unexpected ',', expecting ')' /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 169
ERROR - 2019-12-19 17:08:54 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:169) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-19 17:08:54 --> Severity: Parsing Error --> syntax error, unexpected ',', expecting ')' /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 169
ERROR - 2019-12-19 17:23:48 --> Query error: Unknown column 'tbl_user_platform' in 'where clause' - Invalid query: SELECT `tbl_users_devices_id`, `tbl_users_device_id`, `tbl_users_platform`, `tbl_users_device_token`
FROM `tbl_users_devices`
WHERE `isDeleted` = 0
AND `tbl_user_platform` = 'Android'
AND `roleId` = 2
ERROR - 2019-12-19 17:57:05 --> Severity: Notice --> Undefined index: tbl_employee_name /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 912
ERROR - 2019-12-19 17:57:05 --> Severity: Notice --> Undefined index: tbl_employee_name /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 920
ERROR - 2019-12-19 17:57:33 --> Severity: Notice --> Undefined index: tbl_employee_name /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 920
