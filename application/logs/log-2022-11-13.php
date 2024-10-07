<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-11-13 14:48:37 --> 404 Page Not Found: Package/css
ERROR - 2022-11-13 14:49:37 --> Query error: Table 'ppd2023.t_dok_pkk' doesn't exist - Invalid query: SELECT * FROM (
SELECT '1' kate, D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml, 'Sekretariat PPD'  graoup 
                    FROM `t_doc` D  
                    LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                    LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
                    WHERE D.isactive = 'Y') AS a
                    UNION
                    SELECT * FROM (
SELECT '2' kate ,PK.id mapid, PK.judul, PK.tautan,PK.cr_dt, PK.cr_by, PK.up_dt, PK.up_by, '0' jml, 'Tim Provinsi'  graoup 
FROM `t_dok_pkk` PK 
WHERE PK.isactive = 'Y') AS b
ORDER BY kate, mapid ASC
ERROR - 2022-11-13 14:49:37 --> admin PPD1_M_Bahan_dukung : Table 'ppd2023.t_dok_pkk' doesn't exist
ERROR - 2022-11-13 14:55:20 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-11-13 14:55:20 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-11-13 14:55:20 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-11-13 14:55:20 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-11-13 14:55:20 --> 404 Page Not Found: Attachments/provinsi
ERROR - 2022-11-13 14:59:07 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-13 14:59:07 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-13 15:54:20 --> Query error: Table 'ppd2023.t_dok_pkk' doesn't exist - Invalid query: SELECT * FROM (
SELECT '1' kate, D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml, 'Sekretariat PPD'  graoup 
                    FROM `t_doc` D  
                    LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                    LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
                    WHERE D.isactive = 'Y') AS a
                    UNION
                    SELECT * FROM (
SELECT '2' kate ,PK.id mapid, PK.judul, PK.tautan,PK.cr_dt, PK.cr_by, PK.up_dt, PK.up_by, '0' jml, 'Tim Provinsi'  graoup 
FROM `t_dok_pkk` PK 
WHERE PK.isactive = 'Y') AS b
ORDER BY kate, mapid ASC
ERROR - 2022-11-13 15:54:20 --> admin PPD1_M_Bahan_dukung : Table 'ppd2023.t_dok_pkk' doesn't exist
ERROR - 2022-11-13 15:55:05 --> Query error: Table 'ppd2023.tbl_user_t2_prov' doesn't exist - Invalid query: SELECT 	'2' kate, P.`id`, P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser, W.id kodewil, 'Tahap II' tahap
                                FROM  `provinsi` P 
                                LEFT JOIN `tbl_user_t2_prov` W ON W.idwilayah = P.id
                                WHERE W.iduser='59'
                                   UNION
                                SELECT 	'3' kate, P.`id`, P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser, W.id kodewil, 'Tahap III' tahap
                                FROM  `provinsi` P 
                                LEFT JOIN `tbl_user_t3_prov` W ON W.idwilayah = P.id
                                WHERE W.iduser='59'   
                         
ERROR - 2022-11-13 15:55:05 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\M_users_tpitpu.php 345
ERROR - 2022-11-13 15:57:36 --> 404 Page Not Found: Package/css
ERROR - 2022-11-13 15:59:59 --> Query error: Table 'ppd2023.t_dok_pkk' doesn't exist - Invalid query: SELECT * FROM (
SELECT '1' kate, D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml, 'Sekretariat PPD'  graoup 
                    FROM `t_doc` D  
                    LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                    LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
                    WHERE D.isactive = 'Y') AS a
                    UNION
                    SELECT * FROM (
SELECT '2' kate ,PK.id mapid, PK.judul, PK.tautan,PK.cr_dt, PK.cr_by, PK.up_dt, PK.up_by, '0' jml, 'Tim Provinsi'  graoup 
FROM `t_dok_pkk` PK 
WHERE PK.isactive = 'Y') AS b
ORDER BY kate, mapid ASC
ERROR - 2022-11-13 15:59:59 --> admin PPD1_M_Bahan_dukung : Table 'ppd2023.t_dok_pkk' doesn't exist
ERROR - 2022-11-13 16:00:21 --> Query error: Table 'ppd2023.t_dok_pkk' doesn't exist - Invalid query: SELECT * FROM (
SELECT '1' kate, D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml, 'Sekretariat PPD'  graoup 
                    FROM `t_doc` D  
                    LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                    LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
                    WHERE D.isactive = 'Y') AS a
                    UNION
                    SELECT * FROM (
SELECT '2' kate ,PK.id mapid, PK.judul, PK.tautan,PK.cr_dt, PK.cr_by, PK.up_dt, PK.up_by, '0' jml, 'Tim Provinsi'  graoup 
FROM `t_dok_pkk` PK 
WHERE PK.isactive = 'Y') AS b
ORDER BY kate, mapid ASC
ERROR - 2022-11-13 16:00:21 --> admin PPD1_M_Bahan_dukung : Table 'ppd2023.t_dok_pkk' doesn't exist
ERROR - 2022-11-13 16:00:49 --> Query error: Table 'ppd2023.tbl_user_t2_prov' doesn't exist - Invalid query: SELECT 	'2' kate, P.`id` 'mapwil', P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser, W.id kodewil, 'Tahap II' tahap
                            FROM  `provinsi` P 
                            LEFT JOIN `tbl_user_t2_prov` W ON W.idwilayah = P.id
                            WHERE W.iduser!=''
                            GROUP BY P.id
                            ORDER BY P.id_kode
ERROR - 2022-11-13 16:00:49 --> admin PPD1_t2_penilaian : Table 'ppd2023.tbl_user_t2_prov' doesn't exist
