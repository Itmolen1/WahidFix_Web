<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-06 09:14:02 --> Severity: Notice --> Trying to get property of non-object /home/wahidfix/public_html/admin/application/controllers/Login.php 71
ERROR - 2019-11-06 09:14:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/helpers/url_helper.php 564
ERROR - 2019-11-06 09:19:33 --> Severity: Notice --> Trying to get property of non-object /home/wahidfix/public_html/admin/application/controllers/Login.php 71
ERROR - 2019-11-06 09:19:33 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/helpers/url_helper.php 564
ERROR - 2019-11-06 10:05:31 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-06 10:05:45 --> 404 Page Not Found: Purchase_master_listing/index
ERROR - 2019-11-06 10:06:34 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-06 10:10:40 --> 404 Page Not Found: Purchase_master_listing/index
ERROR - 2019-11-06 10:10:42 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-06 10:20:36 --> 404 Page Not Found: Purchase_master_listing/index
ERROR - 2019-11-06 15:16:16 --> Severity: Notice --> Undefined index: tbl_user_id /home/wahidfix/public_html/admin/application/models/webapi/User_api_model.php 205
ERROR - 2019-11-06 15:16:49 --> Query error: Unknown column 'tbl_user_latitude' in 'field list' - Invalid query: UPDATE `tbl_employee` SET `tbl_user_latitude` = 21.2187086, `tbl_user_longitude` = 72.8742753
WHERE `tbl_employee_id` = 32
ERROR - 2019-11-06 15:16:52 --> Query error: Unknown column 'tbl_user_latitude' in 'field list' - Invalid query: UPDATE `tbl_employee` SET `tbl_user_latitude` = 21.2187086, `tbl_user_longitude` = 72.8742753
WHERE `tbl_employee_id` = 32
ERROR - 2019-11-06 15:20:40 --> 404 Page Not Found: Purchase_master_listing/index
ERROR - 2019-11-06 15:45:53 --> Query error: Column 'isDeleted' in where clause is ambiguous - Invalid query: SELECT `item`.`item_master_id`, `item`.`item_master_name`, `item`.`item_master_desc`, `item`.`item_master_unit`, `item`.`item_master_logo`
FROM `tbl_item_master` as `item`
JOIN `tbl_item_unit` as `unit` ON `unit`.`item_unit_id`=`item`.`item_master_unit`
WHERE `isDeleted` = 0
ORDER BY `item`.`item_master_unit` DESC
ERROR - 2019-11-06 15:45:57 --> Query error: Column 'isDeleted' in where clause is ambiguous - Invalid query: SELECT `item`.`item_master_id`, `item`.`item_master_name`, `item`.`item_master_desc`, `item`.`item_master_unit`, `item`.`item_master_logo`
FROM `tbl_item_master` as `item`
JOIN `tbl_item_unit` as `unit` ON `unit`.`item_unit_id`=`item`.`item_master_unit`
WHERE `isDeleted` = 0
ORDER BY `item`.`item_master_unit` DESC
