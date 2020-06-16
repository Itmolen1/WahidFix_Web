<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-28 09:18:35 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:19:33 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:19:49 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:20:05 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:20:27 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:21:25 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:25:24 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:30:26 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:36:39 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:36:41 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:37:22 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:37:24 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:50:05 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:54:25 --> Severity: Warning --> Missing argument 4 for Sub_services_model::sub_servicesListing(), called in /home/wahidfix/public_html/admin/application/controllers/Sub_services.php on line 55 and defined /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 27
ERROR - 2019-11-28 09:54:25 --> Severity: Notice --> Undefined variable: segment /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 44
ERROR - 2019-11-28 09:54:26 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:54:32 --> Severity: Warning --> Missing argument 4 for Sub_services_model::sub_servicesListing(), called in /home/wahidfix/public_html/admin/application/controllers/Sub_services.php on line 55 and defined /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 27
ERROR - 2019-11-28 09:54:32 --> Severity: Notice --> Undefined variable: segment /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 44
ERROR - 2019-11-28 09:54:33 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:54:35 --> Severity: Warning --> Missing argument 4 for Sub_services_model::sub_servicesListing(), called in /home/wahidfix/public_html/admin/application/controllers/Sub_services.php on line 55 and defined /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 27
ERROR - 2019-11-28 09:54:35 --> Severity: Notice --> Undefined variable: segment /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 44
ERROR - 2019-11-28 09:54:36 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:54:54 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:55:02 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:55:09 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:55:14 --> Severity: Warning --> Missing argument 4 for Sub_services_model::sub_servicesListing(), called in /home/wahidfix/public_html/admin/application/controllers/Sub_services.php on line 55 and defined /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 27
ERROR - 2019-11-28 09:55:14 --> Severity: Notice --> Undefined variable: segment /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 44
ERROR - 2019-11-28 09:55:15 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 09:55:29 --> Severity: Warning --> Missing argument 4 for Sub_services_model::sub_servicesListing(), called in /home/wahidfix/public_html/admin/application/controllers/Sub_services.php on line 55 and defined /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 27
ERROR - 2019-11-28 09:55:29 --> Severity: Notice --> Undefined variable: segment /home/wahidfix/public_html/admin/application/models/Sub_services_model.php 44
ERROR - 2019-11-28 09:55:30 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:01:12 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:03:19 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:03:47 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:03:57 --> Query error: Unknown column 'BaseTbl.email' in 'where clause' - Invalid query: SELECT `BaseTbl`.`sub_service_id`, `BaseTbl`.`service_id`, `BaseTbl`.`sub_service_name`, `BaseTbl`.`created_at`, `BaseTbl`.`updated_at`
FROM `tbl_sub_services` as `BaseTbl`
WHERE (`BaseTbl`.`email` LIKE '%Emergency%'
                            OR  `BaseTbl`.`name` LIKE '%Emergency%'
                            OR  `BaseTbl`.`mobile` LIKE '%Emergency%')
AND `BaseTbl`.`isDeleted` = 0
ERROR - 2019-11-28 10:08:45 --> Query error: Unknown column 'BaseTbl.email' in 'where clause' - Invalid query: SELECT `BaseTbl`.`sub_service_id`, `BaseTbl`.`service_id`, `BaseTbl`.`sub_service_name`, `BaseTbl`.`created_at`, `BaseTbl`.`updated_at`
FROM `tbl_sub_services` as `BaseTbl`
WHERE (`BaseTbl`.`email` LIKE '%Emergency%'
                            OR  `BaseTbl`.`name` LIKE '%Emergency%'
                            OR  `BaseTbl`.`mobile` LIKE '%Emergency%')
AND `BaseTbl`.`isDeleted` = 0
ERROR - 2019-11-28 10:10:42 --> Query error: Unknown column 's.s.service_name' in 'where clause' - Invalid query: SELECT `BaseTbl`.`sub_service_id`, `BaseTbl`.`service_id`, `BaseTbl`.`sub_service_name`, `BaseTbl`.`created_at`, `BaseTbl`.`updated_at`, `s`.`service_name`
FROM `tbl_sub_services` as `BaseTbl`
LEFT JOIN `tbl_services` as `s` ON `s`.`service_id` = `BaseTbl`.`service_id`
WHERE (`BaseTbl`.`sub_service_name` LIKE '%Emergency%'
                            OR  `s`.`s`.`service_name` LIKE '%Emergency%')
AND `BaseTbl`.`isDeleted` = 0
ERROR - 2019-11-28 10:17:25 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:18:56 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:18:59 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:19:03 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:19:07 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 10:19:14 --> 404 Page Not Found: Assets/js
ERROR - 2019-11-28 15:58:52 --> 404 Page Not Found: AssignRights/23
ERROR - 2019-11-28 16:03:30 --> Severity: Notice --> Undefined variable: data /home/wahidfix/public_html/admin/application/controllers/User.php 29
ERROR - 2019-11-28 16:03:30 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-28 16:04:07 --> Severity: Notice --> Undefined variable: data /home/wahidfix/public_html/admin/application/controllers/User.php 29
ERROR - 2019-11-28 16:04:07 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/wahidfix/public_html/admin/system/core/Exceptions.php:271) /home/wahidfix/public_html/admin/system/core/Common.php 570
ERROR - 2019-11-28 16:13:30 --> Severity: Notice --> Undefined variable: action /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 32
ERROR - 2019-11-28 16:13:30 --> Severity: Notice --> Undefined variable: list /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 65
ERROR - 2019-11-28 16:14:12 --> Severity: Notice --> Undefined variable: action /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 32
ERROR - 2019-11-28 16:14:12 --> Severity: Notice --> Undefined variable: list /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 65
ERROR - 2019-11-28 16:15:01 --> Severity: Notice --> Undefined variable: action /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 32
ERROR - 2019-11-28 16:15:01 --> Severity: Notice --> Undefined variable: list /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 65
ERROR - 2019-11-28 16:17:49 --> Severity: Notice --> Undefined variable: action /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 32
ERROR - 2019-11-28 16:17:49 --> Severity: Notice --> Undefined variable: list /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 65
ERROR - 2019-11-28 16:19:58 --> Severity: Notice --> Undefined variable: action /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 32
ERROR - 2019-11-28 16:19:58 --> Severity: Notice --> Undefined variable: list /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 65
ERROR - 2019-11-28 16:20:22 --> Severity: Notice --> Undefined variable: action /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 30
ERROR - 2019-11-28 16:21:48 --> Severity: Notice --> Undefined variable: action /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 30
ERROR - 2019-11-28 16:22:42 --> Severity: Notice --> Undefined variable: action /home/wahidfix/public_html/admin/application/views/add_new_assign_rights_view.php 30
