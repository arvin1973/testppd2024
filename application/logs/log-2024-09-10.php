<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-10 11:22:17 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:22:17 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:22:20 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_daerah_tpt`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_daerah_tpt` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_daerah_tpt` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:22:20 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:22:22 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_daerah_tpt`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_daerah_tpt` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_daerah_tpt` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:22:22 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:23:11 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:23:12 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:23:17 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_daerah_tpt`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_daerah_tpt` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_daerah_tpt` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:23:17 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:23:20 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_daerah_tpt`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_daerah_tpt` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_daerah_tpt` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:23:20 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:26:13 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:26:13 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:26:19 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:26:19 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:26:22 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:26:22 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:26:25 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:26:25 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:31:01 --> 404 Page Not Found: Package/css
ERROR - 2024-09-10 11:31:34 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:31:34 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:31:38 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:31:38 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:31:40 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='783'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='783'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='783'
ERROR - 2024-09-10 11:31:40 --> tptdaerah PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:31:47 --> 404 Page Not Found: Package/css
ERROR - 2024-09-10 11:31:59 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:31:59 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:32:02 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='781'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='781'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='781'
ERROR - 2024-09-10 11:32:02 --> tptjabar PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:32:06 --> Query error: Unknown column 'W.idwilayah' in 'field list' - Invalid query: SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idwilayah` AND K.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`='781'
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idkab=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`='781'
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idkab=A.`idwilayah`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`='781'
ERROR - 2024-09-10 11:32:06 --> tptjabar PPD7_modul1 : Unknown column 'W.idwilayah' in 'field list'
ERROR - 2024-09-10 11:39:41 --> 404 Page Not Found: Package/css
ERROR - 2024-09-10 11:39:53 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:39:53 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:40:27 --> 404 Page Not Found: Https45fe4195b97c7bb183480fea9688pdf/index
ERROR - 2024-09-10 11:55:07 --> 404 Page Not Found: Package/css
ERROR - 2024-09-10 11:55:20 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 11:55:20 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:24:22 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:24:22 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:32:02 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:32:02 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:32:06 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:32:07 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:32:07 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:32:07 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:34:51 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:34:52 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:34:52 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:34:52 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:35:10 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:35:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:35:10 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:35:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:35:31 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:35:31 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:35:34 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:35:34 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:39:42 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:39:43 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:39:43 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:39:43 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:42:19 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:42:19 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:42:19 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:42:19 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:42:53 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:42:53 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 13:42:53 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 13:42:53 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:28:36 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 14:28:37 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:28:37 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 14:28:37 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:28:40 --> Severity: Notice --> Undefined variable: strPro C:\xampp5\htdocs\ppd2024\application\controllers\PPD7_modul1.php 235
ERROR - 2024-09-10 14:28:42 --> 404 Page Not Found: Package/css
ERROR - 2024-09-10 14:28:59 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 14:28:59 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:28:59 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 14:28:59 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:29:01 --> Severity: Notice --> Undefined variable: strPro C:\xampp5\htdocs\ppd2024\application\controllers\PPD7_modul1.php 235
ERROR - 2024-09-10 14:29:07 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:29:07 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:29:26 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 14:29:26 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:29:26 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 14:29:26 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 14:31:50 --> 404 Page Not Found: Package/css
ERROR - 2024-09-10 14:49:57 --> 404 Page Not Found: Package/css
ERROR - 2024-09-10 15:06:23 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_daerah_tpt`, CONSTRAINT `tbl_user_daerah_tpt_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '783'
ERROR - 2024-09-10 15:06:32 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_daerah_tpt`, CONSTRAINT `tbl_user_daerah_tpt_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '783'
ERROR - 2024-09-10 15:09:00 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_kabkot`, CONSTRAINT `tbl_user_kabkot_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '756'
ERROR - 2024-09-10 15:09:18 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_daerah_tpt`, CONSTRAINT `tbl_user_daerah_tpt_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '783'
ERROR - 2024-09-10 15:09:21 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_daerah_tpt`, CONSTRAINT `tbl_user_daerah_tpt_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '783'
ERROR - 2024-09-10 15:11:03 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_daerah_tpt`, CONSTRAINT `tbl_user_daerah_tpt_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '783'
ERROR - 2024-09-10 15:12:14 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 15:12:15 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 15:12:15 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-10 15:12:15 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-10 15:22:58 --> 404 Page Not Found: M_users_tpt_daerah/add_wil
ERROR - 2024-09-10 15:35:01 --> Severity: Notice --> Undefined variable: content C:\xampp5\htdocs\ppd2024\application\controllers\M_users_tpt_daerah.php 552
ERROR - 2024-09-10 15:35:03 --> 404 Page Not Found: Package/css
