<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-13 07:52:36 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-13 07:53:00 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-13 08:30:50 --> 404 Page Not Found: Edit_purchase_order/N.A.
ERROR - 2019-11-13 10:13:56 --> Severity: Notice --> Undefined variable: value /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 624
ERROR - 2019-11-13 10:31:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:383) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 10:31:02 --> Severity: Parsing Error --> syntax error, unexpected 'return' (T_RETURN) /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 383
ERROR - 2019-11-13 10:32:56 --> Query error: Unknown column 'tbl_user_dept' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_dept`, `tbl_user_experiance`, `tbl_user_current_company`, `tbl_user_previouse_company`, `tbl_user_expected_salary`, `tbl_user_employment_status`, `tbl_user_image`
FROM `tbl_user`
WHERE `tbl_user_id` = '10'
ERROR - 2019-11-13 10:45:55 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 10:45:55 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: UPDATE `tbl_user` SET `tbl_user_address` = '365,APT Complex,Shabia,Abu Dhabi,UAE'
WHERE `tbl_user_id` = Array
ERROR - 2019-11-13 10:45:55 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 11:05:19 --> 404 Page Not Found: Assets/sq_pdf
ERROR - 2019-11-13 14:20:26 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: INSERT INTO `tbl_user` (`tbl_user_name`, `tbl_user_mobile`, `tbl_user_email`, `tbl_user_password`, `tbl_user_device_id`, `tbl_user_device_type`, `tbl_user_device_token`, `tbl_user_createdat`, `tbl_user_updatedat`) VALUES ('one', '7896548230', 'one1ds@gmail.com', '123', 'd56fas5d454f6d465', 'Android', 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65', '2019-11-13 14:20:26', '2019-11-13 14:20:26')
ERROR - 2019-11-13 14:35:34 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: INSERT INTO `tbl_user` (`tbl_user_name`, `tbl_user_mobile`, `tbl_user_email`, `tbl_user_password`, `tbl_user_device_id`, `tbl_user_device_type`, `tbl_user_device_token`, `tbl_user_createdat`, `tbl_user_updatedat`) VALUES ('one', '7896548230', 'one1ds@gmail.com', '123', 'd56fas5d454f6d465', 'Android', 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65', '2019-11-13 14:35:34', '2019-11-13 14:35:34')
ERROR - 2019-11-13 14:36:22 --> Query error: Unknown column 'tbl_user_device_type' in 'field list' - Invalid query: INSERT INTO `tbl_user_devices` (`tbl_user_id`, `tbl_user_device_id`, `tbl_user_device_type`, `tbl_user_device_token`, `created_at`, `updated_at`, `isDeleted`) VALUES (25, 'd56fas5d454f6d465', 'Android', 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65', '2019-11-13 14:36:22', '2019-11-13 14:36:22', 0)
ERROR - 2019-11-13 14:50:36 --> Severity: Warning --> array_merge(): Argument #1 is not an array /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 252
ERROR - 2019-11-13 15:01:17 --> Severity: Warning --> array_merge(): Argument #1 is not an array /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 260
ERROR - 2019-11-13 15:42:26 --> Severity: Warning --> unlink(/home/wahidfix/public_html/admin/assets/user_profile/1573644619_profile.JPG): No such file or directory /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 598
ERROR - 2019-11-13 15:46:49 --> Query error: Unknown column 'tbl_user_device_id' in 'field list' - Invalid query: UPDATE `tbl_user` SET `tbl_user_device_id` = 'd56fas5d454f6d465', `tbl_user_device_type` = 'Android', `tbl_user_device_token` = 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65'
WHERE `tbl_user_email` = 'hello@gmail.com'
ERROR - 2019-11-13 16:08:45 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:08:45 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `tbl_user_device_id`
FROM `tbl_user_devices`
WHERE `tbl_user_id` = Array
ERROR - 2019-11-13 16:08:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:50:11 --> Severity: Notice --> Undefined variable: data /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 115
ERROR - 2019-11-13 16:50:11 --> Severity: Notice --> Undefined variable: data /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 116
ERROR - 2019-11-13 16:50:11 --> Severity: Notice --> Undefined variable: data /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 117
ERROR - 2019-11-13 16:50:11 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:50:11 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: UPDATE `tbl_user_devices` SET `tbl_user_device_id` = NULL, `tbl_user_platform` = NULL, `tbl_user_device_token` = NULL
WHERE `tbl_user_id` = Array
AND `tbl_user_device_id` = 'd56fas5d454f6d465'
ERROR - 2019-11-13 16:50:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:53:47 --> Severity: Notice --> Undefined index: tbl_user_platform /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 116
ERROR - 2019-11-13 16:53:47 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:53:47 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: UPDATE `tbl_user_devices` SET `tbl_user_device_id` = 'd56fas5d454f6d465', `tbl_user_platform` = NULL, `tbl_user_device_token` = 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65'
WHERE `tbl_user_id` = Array
AND `tbl_user_device_id` = 'd56fas5d454f6d465'
ERROR - 2019-11-13 16:53:47 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:53:49 --> Severity: Notice --> Undefined index: tbl_user_platform /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 116
ERROR - 2019-11-13 16:53:49 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:53:49 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: UPDATE `tbl_user_devices` SET `tbl_user_device_id` = 'd56fas5d454f6d465', `tbl_user_platform` = NULL, `tbl_user_device_token` = 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65'
WHERE `tbl_user_id` = Array
AND `tbl_user_device_id` = 'd56fas5d454f6d465'
ERROR - 2019-11-13 16:53:49 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:53:50 --> Severity: Notice --> Undefined index: tbl_user_platform /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 116
ERROR - 2019-11-13 16:53:50 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:53:50 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: UPDATE `tbl_user_devices` SET `tbl_user_device_id` = 'd56fas5d454f6d465', `tbl_user_platform` = NULL, `tbl_user_device_token` = 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65'
WHERE `tbl_user_id` = Array
AND `tbl_user_device_id` = 'd56fas5d454f6d465'
ERROR - 2019-11-13 16:53:50 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:53:52 --> Severity: Notice --> Undefined index: tbl_user_platform /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 116
ERROR - 2019-11-13 16:53:52 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:53:52 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: UPDATE `tbl_user_devices` SET `tbl_user_device_id` = 'd56fas5d454f6d465', `tbl_user_platform` = NULL, `tbl_user_device_token` = 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65'
WHERE `tbl_user_id` = Array
AND `tbl_user_device_id` = 'd56fas5d454f6d465'
ERROR - 2019-11-13 16:53:52 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:54:57 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:54:57 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: UPDATE `tbl_user_devices` SET `tbl_user_device_id` = 'd56fas5d454f6d465', `tbl_user_platform` = 'Android', `tbl_user_device_token` = 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65'
WHERE `tbl_user_id` = Array
AND `tbl_user_device_id` = 'd56fas5d454f6d465'
ERROR - 2019-11-13 16:54:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:55:55 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:55:55 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `tbl_user_device_id`, `tbl_user_platform`, `tbl_user_device_token`
FROM `tbl_user_devices`
WHERE `tbl_user_id` = '27'
AND `tbl_user_device_id` = Array
ERROR - 2019-11-13 16:55:55 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:55:57 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:55:57 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `tbl_user_device_id`, `tbl_user_platform`, `tbl_user_device_token`
FROM `tbl_user_devices`
WHERE `tbl_user_id` = '27'
AND `tbl_user_device_id` = Array
ERROR - 2019-11-13 16:55:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:55:59 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:55:59 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `tbl_user_device_id`, `tbl_user_platform`, `tbl_user_device_token`
FROM `tbl_user_devices`
WHERE `tbl_user_id` = '27'
AND `tbl_user_device_id` = Array
ERROR - 2019-11-13 16:55:59 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:59:20 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:59:20 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `tbl_user_device_id`, `tbl_user_platform`, `tbl_user_device_token`
FROM `tbl_user_devices`
WHERE `tbl_user_id` = '27'
AND `tbl_user_device_id` = Array
ERROR - 2019-11-13 16:59:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 16:59:56 --> Severity: Notice --> Array to string conversion /home/wahidfix/public_html/admin/system/database/DB_query_builder.php 2442
ERROR - 2019-11-13 16:59:56 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `tbl_user_device_id`, `tbl_user_platform`, `tbl_user_device_token`
FROM `tbl_user_devices`
WHERE `tbl_user_id` = '27'
AND `tbl_user_device_id` = Array
ERROR - 2019-11-13 16:59:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-13 17:18:29 --> 404 Page Not Found: webapi/User_api/UserLogout
