<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-01-09 22:20:27 --> 404 Page Not Found: Package/css
ERROR - 2022-01-09 22:53:01 --> 404 Page Not Found: Package/css
ERROR - 2022-01-09 22:53:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:53:37 --> 404 Page Not Found: Package/css
ERROR - 2022-01-09 22:53:48 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:57:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:57:47 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:58:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:58:35 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:58:38 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                        SELECT '1' kate ,J.id, J.nama nmdok,j.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, P.nama_kabupaten
				FROM `t_doc_kab` D 
				JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
				JOIN `tbl_user_group` U ON G.`groupid` = U.id
				JOIN `kabupaten` P ON D.`kabid` = P.id
				WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_kabupaten,D.tautan
                                FROM `t_doc_kab` D 
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `kabupaten` P ON D.`kabid` = P.id
                                WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC
                                ) AS b 
                        ORDER BY id, mapid ASC 
ERROR - 2022-01-09 22:58:38 --> AcehSelatan PPD5_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 22:58:40 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:58:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:59:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 22:59:07 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                        SELECT '1' kate ,J.id, J.nama nmdok,j.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, P.nama_kabupaten
				FROM `t_doc_kab` D 
				JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
				JOIN `tbl_user_group` U ON G.`groupid` = U.id
				JOIN `kabupaten` P ON D.`kabid` = P.id
				WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_kabupaten,D.tautan
                                FROM `t_doc_kab` D 
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `kabupaten` P ON D.`kabid` = P.id
                                WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC
                                ) AS b 
                        ORDER BY id, mapid ASC 
ERROR - 2022-01-09 22:59:07 --> AcehSelatan PPD5_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 22:59:13 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                        SELECT '1' kate ,J.id, J.nama nmdok,j.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, P.nama_kabupaten
				FROM `t_doc_kab` D 
				JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
				JOIN `tbl_user_group` U ON G.`groupid` = U.id
				JOIN `kabupaten` P ON D.`kabid` = P.id
				WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_kabupaten,D.tautan
                                FROM `t_doc_kab` D 
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `kabupaten` P ON D.`kabid` = P.id
                                WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC
                                ) AS b 
                        ORDER BY id, mapid ASC 
ERROR - 2022-01-09 22:59:13 --> AcehSelatan PPD5_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 23:02:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:02:28 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                        SELECT '1' kate ,J.id, J.nama nmdok,J.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, P.nama_kabupaten
				FROM `t_doc_kab` D 
				JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
				JOIN `tbl_user_group` U ON G.`groupid` = U.id
				JOIN `kabupaten` P ON D.`kabid` = P.id
				WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_kabupaten,D.tautan
                                FROM `t_doc_kab` D 
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `kabupaten` P ON D.`kabid` = P.id
                                WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC
                                ) AS b 
                        ORDER BY id, mapid ASC 
ERROR - 2022-01-09 23:02:28 --> AcehSelatan PPD5_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 23:02:31 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                        SELECT '1' kate ,J.id, J.nama nmdok,J.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, P.nama_kabupaten
				FROM `t_doc_kab` D 
				JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
				JOIN `tbl_user_group` U ON G.`groupid` = U.id
				JOIN `kabupaten` P ON D.`kabid` = P.id
				WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_kabupaten,D.tautan
                                FROM `t_doc_kab` D 
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `kabupaten` P ON D.`kabid` = P.id
                                WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC
                                ) AS b 
                        ORDER BY id, mapid ASC 
ERROR - 2022-01-09 23:02:31 --> AcehSelatan PPD5_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 23:02:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:02:36 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                        SELECT '1' kate ,J.id, J.nama nmdok,J.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, P.nama_kabupaten
				FROM `t_doc_kab` D 
				JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
				JOIN `tbl_user_group` U ON G.`groupid` = U.id
				JOIN `kabupaten` P ON D.`kabid` = P.id
				WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_kabupaten,D.tautan
                                FROM `t_doc_kab` D 
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `kabupaten` P ON D.`kabid` = P.id
                                WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC
                                ) AS b 
                        ORDER BY id, mapid ASC 
ERROR - 2022-01-09 23:02:36 --> AcehSelatan PPD5_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 23:04:06 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:04:08 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                        SELECT '1' kate ,J.id, J.nama nmdok,J.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, P.nama_kabupaten
				FROM `t_doc_kab` D 
				JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
				JOIN `tbl_user_group` U ON G.`groupid` = U.id
				JOIN `kabupaten` P ON D.`kabid` = P.id
				WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_kabupaten,D.tautan
                                FROM `t_doc_kab` D 
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `kabupaten` P ON D.`kabid` = P.id
                                WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC
                                ) AS b 
                        ORDER BY id, mapid ASC 
ERROR - 2022-01-09 23:04:08 --> AcehSelatan PPD5_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 23:04:13 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                        SELECT '1' kate ,J.id, J.nama nmdok,J.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, P.nama_kabupaten
				FROM `t_doc_kab` D 
				JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
				JOIN `tbl_user_group` U ON G.`groupid` = U.id
				JOIN `kabupaten` P ON D.`kabid` = P.id
				WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_kabupaten,D.tautan
                                FROM `t_doc_kab` D 
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `kabupaten` P ON D.`kabid` = P.id
                                WHERE D.kabid ='2' AND U.groupid='PPD5' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC
                                ) AS b 
                        ORDER BY id, mapid ASC 
ERROR - 2022-01-09 23:04:13 --> AcehSelatan PPD5_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 23:06:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:06:35 --> 404 Page Not Found: Attachments/kabkota
ERROR - 2022-01-09 23:08:22 --> 404 Page Not Found: Attachments/kabkota
ERROR - 2022-01-09 23:09:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:09:47 --> 404 Page Not Found: Package/css
ERROR - 2022-01-09 23:09:59 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:02 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:10:09 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                         SELECT '1' kate ,J.id, J.nama nmdok,j.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_provinsi,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.provid, P.nama_provinsi
                                FROM `t_doc_prov` D 
                                JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `provinsi` P ON D.`provid` = P.id
                                WHERE D.provid ='14' AND U.groupid='PPD4' AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='11') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,P.nama_provinsi,D.tautan
                                FROM `t_doc_prov` D 
                                JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `provinsi` P ON D.`provid` = P.id
                                WHERE D.provid ='14' AND U.groupid='PPD4' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC) AS b 
                        ORDER BY id, mapid ASC
                        
ERROR - 2022-01-09 23:10:09 --> aceh PPD4_M_Dokumen_Prov : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 23:10:16 --> Query error: Unknown column 'j.jndok' in 'field list' - Invalid query: SELECT * FROM (
                                            SELECT '1' kate ,J.id, J.nama nmdok,j.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan
                                            FROM `tbl_jenis_doc` J
                                            LEFT JOIN(
                                                    SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, K.nama_kabupaten
                                                    FROM `t_doc_kab` D  
                                                    JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                                    JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                                    JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                                    JOIN `kabupaten` K ON  D.`kabid` =K.`id`
                                                    WHERE D.kabid ='7' AND U.groupid='PPD4' AND D.isactive = 'Y') DOK ON  DOK.jenisid = J.id
                                            WHERE J.tahap='I' AND J.id !='11') AS a
                          UNION     
                          SELECT * FROM ( 
                                            SELECT  '2' kate ,D.jenisid id,J.nama nmdok,j.jndok,J.formatdata,D.judul, D.id mapid,K.nama_kabupaten,D.tautan
                                            FROM `t_doc_kab` D  
                                            JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                            JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                            JOIN `kabupaten` K ON  D.`kabid` =K.`id`
                                            WHERE D.kabid ='7' AND U.groupid='PPD4' AND D.isactive = 'Y' AND D.`jenisid`='11' ORDER BY D.id ASC                                
                                            ) AS b 
                        ORDER BY id, mapid ASC
ERROR - 2022-01-09 23:10:16 --> aceh PPD4_M_Dokumen_Kab : Unknown column 'j.jndok' in 'field list'
ERROR - 2022-01-09 23:14:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:14:21 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:15:41 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 332
ERROR - 2022-01-09 23:18:30 --> Query error: Table 'peppd_demo_ppd2022.t_doc_penilaian_kk' doesn't exist - Invalid query: SELECT D.`id` mapid, D.judul, D.filename, D.cr_dt,D.cr_by
                            FROM `t_doc_penilaian_kk` D
                            JOIN `provinsi` P ON P.`id`=D.provid
                            WHERE D.provid ='14'  AND D.isactive = 'Y' 
ERROR - 2022-01-09 23:18:30 --> aceh PPD4_M_Penilaian_Prov_Daerah : Table 'peppd_demo_ppd2022.t_doc_penilaian_kk' doesn't exist
ERROR - 2022-01-09 23:21:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:21:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:21:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:21:48 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:21:48 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:21:48 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:23:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:34:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:34:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:34:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:34:31 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:34:31 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-09 23:34:31 --> 404 Page Not Found: Assets/libs
