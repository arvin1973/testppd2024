<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-01-05 09:12:43 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 09:12:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:13:51 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 09:14:04 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:14:42 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:14:42 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:14:42 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:15:02 --> Query error: Table 'peppd_demo_ppd2022.t_mdl3_skor_p' doesn't exist - Invalid query: SELECT A.`id` mapid,P.id idprov,P.id_kode,P.`nama_provinsi` nmprov,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_wilayah A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl3_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl3_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`='28'
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl3_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`='28'
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl3_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`='28'
ERROR - 2022-01-05 09:15:02 --> tpi1 PPD3_modul3 : Table 'peppd_demo_ppd2022.t_mdl3_skor_p' doesn't exist
ERROR - 2022-01-05 09:15:21 --> Query error: Table 'peppd_demo_ppd2022.t_mdl3_skor_p' doesn't exist - Invalid query: SELECT A.`id` mapid,P.id idprov,P.id_kode,P.`nama_provinsi` nmprov,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_wilayah A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl3_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl3_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`='28'
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl3_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`='28'
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl3_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`='28'
ERROR - 2022-01-05 09:15:21 --> tpi1 PPD3_modul3 : Table 'peppd_demo_ppd2022.t_mdl3_skor_p' doesn't exist
ERROR - 2022-01-05 09:24:38 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:24:40 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:24:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:24:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:25:01 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 09:25:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:25:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:25:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:25:38 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:25:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:25:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:27:58 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 09:28:11 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:28:11 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:28:11 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:28:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:28:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:28:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:28:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:28:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:28:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:31:15 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:31:15 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:31:15 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:32:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:32:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:32:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:32:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:33:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:33:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:33:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:34:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:34:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:34:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:37:59 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:38:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:39:51 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:39:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:39:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:40:17 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:44:04 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:44:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:44:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:44:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:46:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:46:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:46:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:50:35 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:50:35 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:50:35 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:51:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:51:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:51:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:51:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:51:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:51:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:52:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:52:31 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:52:31 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:52:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:52:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:52:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:40 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:51 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 09:55:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:18:58 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 10:19:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:23:08 --> Query error: Table 'peppd_demo_ppd2022.t_mdl3_skor_p' doesn't exist - Invalid query: SELECT A.`id` mapid,P.id idprov,P.id_kode,P.`nama_provinsi` nmprov,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_wilayah A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl3_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl3_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`='28'
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl3_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`='28'
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl3_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`='28'
ERROR - 2022-01-05 10:23:08 --> tpi1 PPD3_modul3 : Table 'peppd_demo_ppd2022.t_mdl3_skor_p' doesn't exist
ERROR - 2022-01-05 10:23:29 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 10:23:44 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:27:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:27:44 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:27:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:48 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:54 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:28:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:30:18 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:30:21 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:30:21 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:30:21 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:30:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:30:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:08 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:12 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:12 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:12 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:52:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:53:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:53:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:53:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:53:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:53:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:53:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:54:11 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:54:12 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:54:12 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:54:33 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:54:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:54:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:58:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:58:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:58:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:58:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:58:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:58:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:59:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:59:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 10:59:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:00:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:00:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:00:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:00:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:00:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:00:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:01:49 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:01:49 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:01:49 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:04:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:04:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:04:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:04 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:05:26 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:09:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:09:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:09:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:11:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:11:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:11:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:18:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:18:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:18:39 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:17 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:17 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:17 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:28 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:28 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:28 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:57 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:59 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:59 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:19:59 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:31 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:31 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:33 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:33 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:33 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:21:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:21 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:21 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:21 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:29 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:29 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:29 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:22:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:23:00 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:23:02 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:23:49 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:23 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:28 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:28 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:24:28 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:25:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:25:59 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:26:00 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:26:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:26:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:26:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:27:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:27:27 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:28:19 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:28:19 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 11:39:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:43:28 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 13:43:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:45:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:45:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:45:14 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:45:44 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 13:45:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:48:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:49:11 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:49:25 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:50:05 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 13:50:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:50:18 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:51:10 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 13:51:17 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:53:44 --> Query error: Table 'peppd_demo_ppd2022.t_mdl3_skor_p' doesn't exist - Invalid query: SELECT A.`id` mapid,P.id idprov,P.id_kode,P.`nama_provinsi` nmprov,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_wilayah A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl3_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl3_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`='28'
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl3_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`='28'
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl3_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`='28'
ERROR - 2022-01-05 13:53:44 --> tpi1 PPD3_modul3 : Table 'peppd_demo_ppd2022.t_mdl3_skor_p' doesn't exist
ERROR - 2022-01-05 13:53:47 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 13:53:57 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:54:16 --> Severity: Notice --> Undefined property: stdClass::$id_kode /var/www/peppd/demo_ppd2022/application/views/ppd4/PPD4_user/index_kk.php 421
ERROR - 2022-01-05 13:59:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 14:04:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 14:07:12 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 14:07:41 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 14:07:41 --> 404 Page Not Found: Assets/js
ERROR - 2022-01-05 14:07:42 --> 404 Page Not Found: Assets/js
ERROR - 2022-01-05 14:07:55 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 14:08:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 14:11:44 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 14:11:58 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 14:12:05 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 14:31:52 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 14:32:06 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 14:32:54 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 14:47:32 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 16:36:01 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 16:36:10 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:36:52 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 16:48:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:48:01 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:49:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:49:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:51:09 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:51:09 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:54:48 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:54:48 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:57:18 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:57:18 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:57:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:57:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:58:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 16:58:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:00:06 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:00:06 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:04:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:04:43 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:06:35 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:06:35 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:07:18 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:07:18 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:08:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:08:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:09:46 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:09:46 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:10:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:10:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:12:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:12:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:14:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:14:13 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:14:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:14:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:16:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:16:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:17:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:17:16 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:17:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:17:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:18:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:18:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:18:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:18:52 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:21:41 --> 404 Page Not Found: Package/css
ERROR - 2022-01-05 17:21:51 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:28:30 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:29:21 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:29:28 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:29:29 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:29:29 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:29:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:30:18 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:30:32 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:30:45 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:30:49 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:30:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:30:50 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:31:38 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:31:38 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:31:38 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:31:46 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:32:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:32:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:33:21 --> 404 Page Not Found: Assets/libs
ERROR - 2022-01-05 17:34:49 --> 404 Page Not Found: Package/css
