<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-01-17 08:21:47 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 08:37:48 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 08:38:00 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 08:38:14 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 08:38:47 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:01:49 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:12:04 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:15:40 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:18:27 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:25:13 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:25:41 --> Severity: Notice --> Undefined property: stdClass::$kode /var/www/peppd/demo_ppd2022/application/controllers/PPD3_t3_dokumen_daerah.php 133
ERROR - 2022-01-17 09:25:41 --> Severity: Notice --> Undefined property: stdClass::$kode /var/www/peppd/demo_ppd2022/application/controllers/PPD3_t3_dokumen_daerah.php 133
ERROR - 2022-01-17 09:25:41 --> Severity: Notice --> Undefined property: stdClass::$kode /var/www/peppd/demo_ppd2022/application/controllers/PPD3_t3_dokumen_daerah.php 133
ERROR - 2022-01-17 09:25:41 --> 404 Page Not Found: Assets/icons
ERROR - 2022-01-17 09:25:41 --> 404 Page Not Found: Assets/icons
ERROR - 2022-01-17 09:25:41 --> 404 Page Not Found: Assets/icons
ERROR - 2022-01-17 09:25:43 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:25:59 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:26:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 09:26:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 09:27:24 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:27:53 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_demo_ppd2022`.`t_mdl1_resume_prov`, CONSTRAINT `t_mdl1_resume_prov_ibfk_1` FOREIGN KEY (`mapid`) REFERENCES `tbl_user_wilayah` (`id`) ON UPDATE CASCADE) - Invalid query: DELETE FROM `tbl_user_wilayah`
WHERE `id` = '2'
ERROR - 2022-01-17 09:27:58 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_demo_ppd2022`.`t_mdl1_resume_prov`, CONSTRAINT `t_mdl1_resume_prov_ibfk_1` FOREIGN KEY (`mapid`) REFERENCES `tbl_user_wilayah` (`id`) ON UPDATE CASCADE) - Invalid query: DELETE FROM `tbl_user_wilayah`
WHERE `id` = '2'
ERROR - 2022-01-17 09:31:20 --> Severity: Notice --> Undefined property: stdClass::$kode /var/www/peppd/demo_ppd2022/application/controllers/PPD3_t3_dokumen_daerah.php 202
ERROR - 2022-01-17 09:31:20 --> 404 Page Not Found: Assets/icons
ERROR - 2022-01-17 09:31:23 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:33:14 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:34:15 --> Query error: Unknown column 'P.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,P.id idprov,P.`idwilayah` kode,P.`nama_provinsi` nmprov,P.`label`
                            FROM tbl_user_wilayah A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            WHERE A.`iduser`='28'
ERROR - 2022-01-17 09:34:15 --> tpi1 PPD3_t3_dokumen_daerah : Unknown column 'P.idwilayah' in 'field list'
ERROR - 2022-01-17 09:34:17 --> Query error: Unknown column 'P.idkabkot' in 'field list' - Invalid query: SELECT A.`id` mapid,P.id idkab, P.`idkabkot` kode, P.`nama_kabupaten` nmkab
                            FROM tbl_user_kabkot A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                            WHERE A.`iduser`='28'
ERROR - 2022-01-17 09:34:17 --> tpi1 PPD3_t3_dokumen_daerah : Unknown column 'P.idkabkot' in 'field list'
ERROR - 2022-01-17 09:34:18 --> Query error: Unknown column 'P.idkabkot' in 'field list' - Invalid query: SELECT A.`id` mapid,P.id idkota, P.`idkabkot` kode, P.`nama_kabupaten` nmkot
                            FROM tbl_user_kabkot A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                            WHERE A.`iduser`='28'
ERROR - 2022-01-17 09:34:18 --> tpi1 PPD3_t3_dokumen_daerah : Unknown column 'P.idkabkot' in 'field list'
ERROR - 2022-01-17 09:37:33 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:48:14 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:49:47 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 09:49:47 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 09:51:38 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:51:46 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:53:28 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:54:03 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:55:32 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:58:04 --> Severity: Notice --> Undefined property: stdClass::$kode /var/www/peppd/demo_ppd2022/application/controllers/PPD3_t3_dokumen_daerah.php 133
ERROR - 2022-01-17 09:58:04 --> Severity: Notice --> Undefined property: stdClass::$kode /var/www/peppd/demo_ppd2022/application/controllers/PPD3_t3_dokumen_daerah.php 133
ERROR - 2022-01-17 09:58:04 --> Severity: Notice --> Undefined property: stdClass::$kode /var/www/peppd/demo_ppd2022/application/controllers/PPD3_t3_dokumen_daerah.php 133
ERROR - 2022-01-17 09:58:04 --> 404 Page Not Found: Assets/icons
ERROR - 2022-01-17 09:58:04 --> 404 Page Not Found: Assets/icons
ERROR - 2022-01-17 09:58:04 --> 404 Page Not Found: Assets/icons
ERROR - 2022-01-17 09:58:06 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 09:59:27 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:01:19 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:01:19 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:08:08 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:09:38 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:10:57 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:12:22 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:26:14 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:26:42 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:26:42 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:31:30 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:40:40 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:40:40 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:41:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:41:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:46:35 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:49:20 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:49:20 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:53:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:53:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:54:20 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:54:20 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:55:15 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 10:55:29 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 10:55:29 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 11:01:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 11:01:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 11:05:32 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:05:57 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:09:53 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:10:52 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:19:55 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:20:20 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:21:14 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:21:51 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:22:12 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:23:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 11:23:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 11:24:48 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:25:58 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:30:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 11:30:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 11:33:43 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 11:34:41 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 12:03:14 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 12:04:22 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:22:58 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:24:52 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:29:45 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:38:48 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:39:18 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:40:06 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:40:46 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:41:23 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:41:23 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:41:31 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:41:53 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:42:00 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:42:17 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:42:42 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:42:52 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:43:04 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:43:13 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:43:27 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:43:27 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:43:39 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-17 13:44:05 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:46:17 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 13:57:48 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:05:43 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:08:55 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:18:04 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:18:35 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:18:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 14:18:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 14:18:50 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:22:27 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:33:18 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:33:50 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:37:04 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:39:22 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:40:44 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:40:50 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:41:47 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:42:29 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:44:11 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:44:27 --> 404 Page Not Found: Assets/js
ERROR - 2022-01-17 14:45:11 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:46:15 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 14:51:55 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 15:03:42 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 15:06:01 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 15:13:16 --> 404 Page Not Found: Assets/js
ERROR - 2022-01-17 15:13:34 --> 404 Page Not Found: Assets/js
ERROR - 2022-01-17 15:13:39 --> 404 Page Not Found: Assets/js
ERROR - 2022-01-17 15:17:25 --> 404 Page Not Found: Assets/js
ERROR - 2022-01-17 15:22:14 --> Query error: Unknown column 'isprov' in 'field list' - Invalid query: SELECT A.`id` idsindi,A.`nama` nmsindi,isprov,nourut
                        FROM `r_mdl3_item` A
                        WHERE A.`indiid`='6'
                        ORDER BY A.nourut ASC
ERROR - 2022-01-17 15:22:14 --> admin M_modul_3 : Unknown column 'isprov' in 'field list'
ERROR - 2022-01-17 15:30:26 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 15:32:12 --> Query error: Unknown column 'isprov' in 'field list' - Invalid query: SELECT A.`id` idsindi,A.`nama` nmsindi,isprov,nourut
                        FROM `r_mdl3_item` A
                        WHERE A.`indiid`='6'
                        ORDER BY A.nourut ASC
ERROR - 2022-01-17 15:32:12 --> admin M_modul_3 : Unknown column 'isprov' in 'field list'
ERROR - 2022-01-17 15:32:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 15:32:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 15:33:45 --> Query error: Unknown column 'isprov' in 'field list' - Invalid query: SELECT A.`id` idsindi,A.`nama` nmsindi,isprov,nourut
                        FROM `r_mdl3_item` A
                        WHERE A.`indiid`='6'
                        ORDER BY A.nourut ASC
ERROR - 2022-01-17 15:33:45 --> admin M_modul_3 : Unknown column 'isprov' in 'field list'
ERROR - 2022-01-17 15:34:36 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 15:44:32 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 15:45:41 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 15:51:05 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 15:53:44 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:00:52 --> Query error: Unknown column 'isprov' in 'field list' - Invalid query: SELECT A.`id` idsindi,A.`nama` nmsindi,isprov,nourut
                        FROM `r_mdl3_item` A
                        WHERE A.`indiid`='1'
                        ORDER BY A.nourut ASC
ERROR - 2022-01-17 16:00:52 --> admin M_modul_3 : Unknown column 'isprov' in 'field list'
ERROR - 2022-01-17 16:04:28 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:04:54 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:05:26 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:06:20 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:06:33 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:07:03 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:07:16 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:07:48 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:09:02 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:09:15 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:09:26 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:09:46 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:14:27 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:14:46 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:15:15 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:15:33 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:15:46 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:15:59 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:16:05 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:18:58 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:19:04 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Notice --> Undefined variable: filepath1 /var/www/peppd/demo_ppd2022/application/controllers/PPD1_M_Dokumen_Prov.php 1156
ERROR - 2022-01-17 16:24:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/peppd/demo_ppd2022/system/core/Exceptions.php:271) /var/www/peppd/demo_ppd2022/system/helpers/download_helper.php 136
ERROR - 2022-01-17 16:24:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/peppd/demo_ppd2022/system/core/Exceptions.php:271) /var/www/peppd/demo_ppd2022/system/helpers/download_helper.php 137
ERROR - 2022-01-17 16:24:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/peppd/demo_ppd2022/system/core/Exceptions.php:271) /var/www/peppd/demo_ppd2022/system/helpers/download_helper.php 138
ERROR - 2022-01-17 16:24:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/peppd/demo_ppd2022/system/core/Exceptions.php:271) /var/www/peppd/demo_ppd2022/system/helpers/download_helper.php 139
ERROR - 2022-01-17 16:24:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/peppd/demo_ppd2022/system/core/Exceptions.php:271) /var/www/peppd/demo_ppd2022/system/helpers/download_helper.php 140
ERROR - 2022-01-17 16:24:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/peppd/demo_ppd2022/system/core/Exceptions.php:271) /var/www/peppd/demo_ppd2022/system/helpers/download_helper.php 141
ERROR - 2022-01-17 16:27:02 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:30:14 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:32:24 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:36:00 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:36:27 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:40:24 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 16:56:13 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 17:01:54 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 17:57:51 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 18:00:01 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 18:04:02 --> 404 Page Not Found: Composerjson/index
ERROR - 2022-01-17 18:04:25 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 18:04:34 --> 404 Page Not Found: Git/index
ERROR - 2022-01-17 18:07:49 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 21:13:21 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 21:43:48 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 21:54:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:54:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:54:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:54:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:55:02 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:55:02 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:55:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:55:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:56:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:56:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:58:08 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 21:58:08 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:01:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:01:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:02:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:02:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:05:46 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:05:46 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:09:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:09:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:10:00 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:10:00 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:12:02 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:12:02 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:12:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:12:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:19:10 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:19:10 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:19:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:19:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:20:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:20:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:24:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:24:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-17 22:38:01 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 22:58:17 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 23:00:49 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 23:02:00 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 23:02:24 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 23:02:58 --> 404 Page Not Found: Package/css
ERROR - 2022-01-17 23:22:43 --> 404 Page Not Found: Package/css
