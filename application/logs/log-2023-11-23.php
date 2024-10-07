<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-11-23 09:06:32 --> Severity: Warning --> mysqli::real_connect(): (HY000/1045): Access denied for user 'peppd'@'localhost' (using password: YES) C:\xampp 5.6\htdocs\ppd2023\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2023-11-23 09:06:32 --> Unable to connect to the database
ERROR - 2023-11-23 09:06:33 --> Severity: Warning --> mysqli::real_connect(): (HY000/1045): Access denied for user 'peppd'@'localhost' (using password: YES) C:\xampp 5.6\htdocs\ppd2023\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2023-11-23 09:06:33 --> Severity: Error --> session_start(): Failed to initialize storage module: user (path: ci_sessions) C:\xampp 5.6\htdocs\ppd2023\system\libraries\Session\Session.php 143
ERROR - 2023-11-23 09:12:26 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 09:12:47 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:12:47 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:12:47 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:12:56 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 09:17:11 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 09:17:27 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 09:20:50 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:20:50 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:20:50 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:23:07 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:23:07 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:23:07 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:34:18 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:34:18 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:34:18 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:34:21 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 09:35:15 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 09:35:17 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 09:36:02 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 09:59:43 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:59:43 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 09:59:43 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 10:00:27 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 10:00:49 --> 404 Page Not Found: Assets/icons
ERROR - 2023-11-23 10:00:49 --> 404 Page Not Found: Assets/icons
ERROR - 2023-11-23 10:00:58 --> 404 Page Not Found: Assets/icons
ERROR - 2023-11-23 10:00:58 --> 404 Page Not Found: Assets/icons
ERROR - 2023-11-23 10:24:07 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 10:26:16 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 10:26:16 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 10:26:16 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 10:28:39 --> Severity: Notice --> Undefined offset: 7 C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 120
ERROR - 2023-11-23 10:28:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 6 - Invalid query: SELECT A.id, A.userid,A.`name`,A.email,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker, A.last_access,C.nama_kabupaten, D.nama_provinsi
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        INNER JOIN `kabupaten` C ON A.satker = C.id
                        INNER JOIN `provinsi` D ON C.prov_id = D.id_kode
                        WHERE B.`id`='5' AND A.active_flag!='D'  ORDER BY    asc  LIMIT 0 ,5   
ERROR - 2023-11-23 10:28:39 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 126
ERROR - 2023-11-23 10:28:41 --> Severity: Notice --> Undefined offset: 7 C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 120
ERROR - 2023-11-23 10:28:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 6 - Invalid query: SELECT A.id, A.userid,A.`name`,A.email,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker, A.last_access,C.nama_kabupaten, D.nama_provinsi
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        INNER JOIN `kabupaten` C ON A.satker = C.id
                        INNER JOIN `provinsi` D ON C.prov_id = D.id_kode
                        WHERE B.`id`='5' AND A.active_flag!='D'  AND (  A.`userid` LIKE '%j%'  OR A.`name` LIKE '%j%'  OR A.`email` LIKE '%j%'  OR B.`name` LIKE '%j%'  OR C.`nama_kabupaten` LIKE '%j%'  OR D.`nama_provinsi` LIKE '%j%' ) ORDER BY    asc  LIMIT 0 ,5   
ERROR - 2023-11-23 10:28:41 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 126
ERROR - 2023-11-23 10:28:42 --> Severity: Notice --> Undefined offset: 7 C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 120
ERROR - 2023-11-23 10:28:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 6 - Invalid query: SELECT A.id, A.userid,A.`name`,A.email,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker, A.last_access,C.nama_kabupaten, D.nama_provinsi
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        INNER JOIN `kabupaten` C ON A.satker = C.id
                        INNER JOIN `provinsi` D ON C.prov_id = D.id_kode
                        WHERE B.`id`='5' AND A.active_flag!='D'  AND (  A.`userid` LIKE '%jakar%'  OR A.`name` LIKE '%jakar%'  OR A.`email` LIKE '%jakar%'  OR B.`name` LIKE '%jakar%'  OR C.`nama_kabupaten` LIKE '%jakar%'  OR D.`nama_provinsi` LIKE '%jakar%' ) ORDER BY    asc  LIMIT 0 ,5   
ERROR - 2023-11-23 10:28:42 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 126
ERROR - 2023-11-23 10:28:42 --> Severity: Notice --> Undefined offset: 7 C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 120
ERROR - 2023-11-23 10:28:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 6 - Invalid query: SELECT A.id, A.userid,A.`name`,A.email,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker, A.last_access,C.nama_kabupaten, D.nama_provinsi
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        INNER JOIN `kabupaten` C ON A.satker = C.id
                        INNER JOIN `provinsi` D ON C.prov_id = D.id_kode
                        WHERE B.`id`='5' AND A.active_flag!='D'  AND (  A.`userid` LIKE '%jakart%'  OR A.`name` LIKE '%jakart%'  OR A.`email` LIKE '%jakart%'  OR B.`name` LIKE '%jakart%'  OR C.`nama_kabupaten` LIKE '%jakart%'  OR D.`nama_provinsi` LIKE '%jakart%' ) ORDER BY    asc  LIMIT 0 ,5   
ERROR - 2023-11-23 10:28:42 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 126
ERROR - 2023-11-23 10:28:43 --> Severity: Notice --> Undefined offset: 7 C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 120
ERROR - 2023-11-23 10:28:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 6 - Invalid query: SELECT A.id, A.userid,A.`name`,A.email,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker, A.last_access,C.nama_kabupaten, D.nama_provinsi
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        INNER JOIN `kabupaten` C ON A.satker = C.id
                        INNER JOIN `provinsi` D ON C.prov_id = D.id_kode
                        WHERE B.`id`='5' AND A.active_flag!='D'  AND (  A.`userid` LIKE '%jakarta%'  OR A.`name` LIKE '%jakarta%'  OR A.`email` LIKE '%jakarta%'  OR B.`name` LIKE '%jakarta%'  OR C.`nama_kabupaten` LIKE '%jakarta%'  OR D.`nama_provinsi` LIKE '%jakarta%' ) ORDER BY    asc  LIMIT 0 ,5   
ERROR - 2023-11-23 10:28:43 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 126
ERROR - 2023-11-23 10:28:54 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 10:28:54 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 10:28:54 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 14:22:46 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 84
ERROR - 2023-11-23 14:22:46 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_kabkota.php 85
ERROR - 2023-11-23 14:22:49 --> 404 Page Not Found: Package/css
ERROR - 2023-11-23 14:23:13 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 14:23:13 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 14:23:13 --> Severity: Warning --> Division by zero C:\xampp 5.6\htdocs\ppd2023\application\controllers\Home.php 550
ERROR - 2023-11-23 14:24:18 --> 404 Page Not Found: Package/css
