<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-02 11:34:43 --> 404 Page Not Found: webapi/UserRegistration/index
ERROR - 2019-11-02 11:35:21 --> 404 Page Not Found: webapi/User_api/UserRegistration
ERROR - 2019-11-02 11:35:46 --> 404 Page Not Found: webapi/User_api/UserRegistration
ERROR - 2019-11-02 11:36:53 --> 404 Page Not Found: webapi/User_api/UserRegistration
ERROR - 2019-11-02 11:37:23 --> 404 Page Not Found: webapi/User_api/UserRegistration
ERROR - 2019-11-02 11:37:35 --> 404 Page Not Found: webapi/User_api/UserRegistration
ERROR - 2019-11-02 11:37:42 --> 404 Page Not Found: webapi/User_api/UserRegistration
ERROR - 2019-11-02 11:38:10 --> 404 Page Not Found: webapi/User_api/UserRegistration
ERROR - 2019-11-02 11:41:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php:5) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-02 11:41:48 --> Severity: Error --> Class 'MY_Controller' not found /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 5
ERROR - 2019-11-02 12:06:26 --> Severity: Notice --> Undefined index: tbl_user_address /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 58
ERROR - 2019-11-02 12:06:26 --> Severity: Notice --> Undefined index: tbl_user_dept /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 59
ERROR - 2019-11-02 12:06:26 --> Severity: Notice --> Undefined index: tbl_user_experiance /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 60
ERROR - 2019-11-02 12:06:26 --> Severity: Notice --> Undefined index: tbl_user_current_company /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 61
ERROR - 2019-11-02 12:06:26 --> Severity: Notice --> Undefined index: tbl_user_previouse_company /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 62
ERROR - 2019-11-02 12:06:26 --> Severity: Notice --> Undefined index: tbl_user_expected_salary /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 63
ERROR - 2019-11-02 12:06:26 --> Severity: Notice --> Undefined index: tbl_user_city /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 65
ERROR - 2019-11-02 12:06:26 --> Query error: Unknown column 'tbl_user_address' in 'field list' - Invalid query: INSERT INTO `tbl_user` (`tbl_user_name`, `tbl_user_mobile`, `tbl_user_password`, `tbl_user_device_type`, `tbl_user_device_id`, `tbl_user_address`, `tbl_user_dept`, `tbl_user_experiance`, `tbl_user_current_company`, `tbl_user_previouse_company`, `tbl_user_expected_salary`, `tbl_user_device_token`, `tbl_user_city`, `tbl_user_created_time`, `tbl_user_updated_time`, `tbl_user_comm_token`, `tbl_user_image`) VALUES ('one', '7896541230', '123', 'Android', 'd56fas5d454f6d465', NULL, NULL, NULL, NULL, NULL, NULL, 'ae5d4fa5s4d654f64sd654fs6d4f6s4fasd54f65', NULL, '2019-11-02 12:06:26', '2019-11-02 12:06:26', 'ce590238a1ce739ebc93bae63424ebe4', '')
ERROR - 2019-11-02 12:06:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-02 12:10:46 --> Query error: Unknown column 'tbl_user_address' in 'field list' - Invalid query: SELECT `tbl_user_id`, `tbl_user_name`, `tbl_user_mobile`, `tbl_user_device_type`, `tbl_user_address`, `tbl_user_dept`, `tbl_user_experiance`, `tbl_user_current_company`, `tbl_user_previouse_company`, `tbl_user_expected_salary`, `tbl_user_city`, `tbl_user_image`
FROM `tbl_user`
WHERE `tbl_user_id` = 8
ERROR - 2019-11-02 13:30:07 --> Severity: Notice --> Undefined variable: input /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 134
ERROR - 2019-11-02 14:55:52 --> Query error: Table 'wahidfix_main.sub_service_name' doesn't exist - Invalid query: SELECT `sub_service_name`
FROM `sub_service_name`
WHERE `isDeleted` = 0
AND `service_id` = '1'
ERROR - 2019-11-02 15:03:23 --> Query error: Table 'wahidfix_main.sub_service_name' doesn't exist - Invalid query: SELECT `sub_service_name`
FROM `sub_service_name`
WHERE `isDeleted` = 0
AND `service_id` = '1'
ERROR - 2019-11-02 15:14:23 --> Query error: Table 'wahidfix_main.sub_service_name' doesn't exist - Invalid query: SELECT `sub_service_name`
FROM `sub_service_name`
WHERE `isDeleted` = 0
AND `service_id` = '1'
ERROR - 2019-11-02 15:40:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:485) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-02 15:40:00 --> Severity: Parsing Error --> syntax error, unexpected ';' /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 485
ERROR - 2019-11-02 16:02:04 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:485) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-02 16:02:04 --> Severity: Parsing Error --> syntax error, unexpected 'json_encode' (T_STRING) /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 485
ERROR - 2019-11-02 16:30:47 --> 404 Page Not Found: webapi/User_api/ScheduleService
