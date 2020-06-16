<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-12-04 08:10:25 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 08:10:29 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 08:12:01 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 13:10:15 --> Severity: Notice --> Undefined index: tbl_employee_id /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 318
ERROR - 2019-12-04 13:15:02 --> Severity: Notice --> Undefined index: tbl_employee_id /home/wahidfix/public_html/admin/application/controllers/webapi/User_api.php 318
ERROR - 2019-12-04 13:15:38 --> Query error: Column 'isDeleted' in where clause is ambiguous - Invalid query: SELECT sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,s.service_name,s.service_desc,s.service_logo,t.time_slot_name,sr.pending_amount,sr.assigned_emp_id FROM tbl_service_request sr LEFT JOIN tbl_time_slot t ON t.time_slot_id=sr.prefferd_time LEFT JOIN tbl_services s ON s.service_id=sr.service_id WHERE sr.assigned_emp_id = 33 AND isDeleted = 0 ORDER BY sr.sr_id DESC LIMIT 0,10
ERROR - 2019-12-04 13:16:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY sr.sr_id DESC LIMIT 0,10' at line 1 - Invalid query: SELECT sr.sr_id,sr.service_request_ref,sr.prefferd_date,sr.prefferd_time,sr.created_at,sr.status,s.service_name,s.service_desc,s.service_logo,t.time_slot_name,sr.pending_amount,sr.assigned_emp_id FROM tbl_service_request sr LEFT JOIN tbl_time_slot t ON t.time_slot_id=sr.prefferd_time LEFT JOIN tbl_services s ON s.service_id=sr.service_id WHERE sr.assigned_emp_id = 33 AND ORDER BY sr.sr_id DESC LIMIT 0,10
ERROR - 2019-12-04 15:01:00 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:32:51 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:33:05 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:33:27 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:33:44 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:38:15 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:38:35 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:38:38 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:38:41 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:38:49 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:38:51 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:39:13 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 15:39:25 --> 404 Page Not Found: Assets/js
ERROR - 2019-12-04 16:51:54 --> Severity: Notice --> Undefined index: assigned_emp_id /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 752
ERROR - 2019-12-04 16:55:23 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php:762) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-04 16:55:23 --> Severity: Parsing Error --> syntax error, unexpected ''tbl_employee_mobile'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 762
ERROR - 2019-12-04 16:56:32 --> Severity: Notice --> Undefined variable: query1 /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 757
ERROR - 2019-12-04 16:56:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-12-04 16:56:32 --> Severity: Error --> Call to a member function row_array() on null /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 757
