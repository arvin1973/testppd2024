<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-17 08:34:44 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 08:36:34 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 08:36:34 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 08:41:04 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 08:41:19 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 08:41:56 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 08:41:56 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 08:43:18 --> 404 Page Not Found: Attachments/penilaian
ERROR - 2024-09-17 10:17:10 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 10:21:05 --> 404 Page Not Found: Attachments/penilaian
ERROR - 2024-09-17 10:23:40 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 10:23:55 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 10:24:16 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 10:24:17 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 10:30:03 --> 404 Page Not Found: Attachments/kertaskerja
ERROR - 2024-09-17 10:36:05 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 10:36:13 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 10:36:13 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 10:36:13 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 10:36:13 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 10:36:13 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 10:50:02 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 10:50:21 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 10:50:22 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 10:59:45 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 10:59:55 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 11:02:41 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:02:41 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:07:57 --> Query error: Unknown column 'us.sakter' in 'field list' - Invalid query: SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(I.`id`) FROM r_mdl1_item I JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov='N' JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y') * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT us.sakter,us.group,kabkot.id AS id, kabkot.iduser AS iduser, us.userid AS userid, us.name AS name, kabkot.idkabkot AS idkabkot, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten 
                            FROM `tbl_user_kabkot` kabkot
                            JOIN tbl_user us ON kabkot.iduser = us.id
                            JOIN kabupaten kab ON kabkot.idkabkot = kab.id
                            JOIN provinsi prov ON kab.prov_id = prov.id_kode
                        ) t1
                        LEFT JOIN t_mdl1_skor_kabkota skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_kabkota sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt') AND t1.nama_kabupaten LIKE 'Kabupaten %' AND t1.group=7 AND t1.satker=3
                        GROUP BY t1.id
                        ORDER BY t1.userid, t1.nama_provinsi
ERROR - 2024-09-17 11:07:57 --> jabar PPD4_status_penilaian_kab_daerah : Unknown column 'us.sakter' in 'field list'
ERROR - 2024-09-17 11:08:10 --> Query error: Unknown column 'us.sakter' in 'field list' - Invalid query: SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(I.`id`) FROM r_mdl1_item I JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov='N' JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y') * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT us.sakter,us.group,kabkot.id AS id, kabkot.iduser AS iduser, us.userid AS userid, us.name AS name, kabkot.idkabkot AS idkabkot, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten 
                            FROM `tbl_user_kabkot` kabkot
                            JOIN tbl_user us ON kabkot.iduser = us.id
                            JOIN kabupaten kab ON kabkot.idkabkot = kab.id
                            JOIN provinsi prov ON kab.prov_id = prov.id_kode
                        ) t1
                        LEFT JOIN t_mdl1_skor_kabkota skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_kabkota sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt') AND t1.nama_kabupaten LIKE 'Kabupaten %' AND t1.group=7 AND t1.satker=3
                        GROUP BY t1.id
                        ORDER BY t1.userid, t1.nama_provinsi
ERROR - 2024-09-17 11:08:10 --> jabar PPD4_status_penilaian_kab_daerah : Unknown column 'us.sakter' in 'field list'
ERROR - 2024-09-17 11:08:24 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:08:24 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:08:28 --> Query error: Unknown column 'us.sakter' in 'field list' - Invalid query: SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(I.`id`) FROM r_mdl1_item I JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov='N' JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y') * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT us.sakter,us.group,kabkot.id AS id, kabkot.iduser AS iduser, us.userid AS userid, us.name AS name, kabkot.idkabkot AS idkabkot, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten 
                            FROM `tbl_user_kabkot` kabkot
                            JOIN tbl_user us ON kabkot.iduser = us.id
                            JOIN kabupaten kab ON kabkot.idkabkot = kab.id
                            JOIN provinsi prov ON kab.prov_id = prov.id_kode
                        ) t1
                        LEFT JOIN t_mdl1_skor_kabkota skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_kabkota sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt') AND t1.nama_kabupaten LIKE 'Kabupaten %' AND t1.group=7 AND t1.satker=3
                        GROUP BY t1.id
                        ORDER BY t1.userid, t1.nama_provinsi
ERROR - 2024-09-17 11:08:28 --> jabar PPD4_status_penilaian_kab_daerah : Unknown column 'us.sakter' in 'field list'
ERROR - 2024-09-17 11:09:51 --> Query error: Unknown column 'us.sakter' in 'field list' - Invalid query: SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(I.`id`) FROM r_mdl1_item I JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov='N' JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y') * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT us.sakter,us.group,kabkot.id AS id, kabkot.iduser AS iduser, us.userid AS userid, us.name AS name, kabkot.idkabkot AS idkabkot, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten 
                            FROM `tbl_user_kabkot` kabkot
                            JOIN tbl_user us ON kabkot.iduser = us.id
                            JOIN kabupaten kab ON kabkot.idkabkot = kab.id
                            JOIN provinsi prov ON kab.prov_id = prov.id_kode
                        ) t1
                        LEFT JOIN t_mdl1_skor_kabkota skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_kabkota sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt') AND t1.nama_kabupaten LIKE 'Kabupaten %' AND t1.group=7
                        GROUP BY t1.id
                        ORDER BY t1.userid, t1.nama_provinsi
ERROR - 2024-09-17 11:09:51 --> jabar PPD4_status_penilaian_kab_daerah : Unknown column 'us.sakter' in 'field list'
ERROR - 2024-09-17 11:13:02 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 11:13:10 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 11:13:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:13:11 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:14:05 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 11:14:05 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:14:05 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:24:01 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 11:24:21 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 11:24:21 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:24:21 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:25:09 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 11:25:22 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 11:25:22 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:25:22 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:31:21 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 11:31:34 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 11:31:34 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:31:34 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:44:09 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 11:44:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 11:44:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 13:30:46 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 13:31:26 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 13:31:26 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 13:36:17 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 13:36:17 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 13:42:21 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 13:42:21 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 13:42:21 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 13:42:57 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 13:42:57 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 13:42:57 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:05:15 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 14:05:24 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:05:25 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:05:25 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:05:25 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:05:59 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 14:06:14 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:06:14 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:06:14 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:06:14 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:06:14 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:06:22 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:06:22 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:06:25 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:06:25 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:16:55 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:16:55 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:16:55 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:16:55 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:17:06 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:17:07 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:17:07 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:17:07 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:17:08 --> 404 Page Not Found: PPD7_bahan_dukung_tpt/index
ERROR - 2024-09-17 14:17:10 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:17:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:17:10 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:17:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:33 --> 404 Page Not Found: PPD7_bahan_dukung_tpt/index
ERROR - 2024-09-17 14:21:35 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:35 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:35 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:35 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:39 --> 404 Page Not Found: PPD7_bahan_dukung_tpt/index
ERROR - 2024-09-17 14:21:41 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:42 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:42 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:42 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:47 --> 404 Page Not Found: PPD7_bahan_dukung_tpt/index
ERROR - 2024-09-17 14:21:49 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:49 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:49 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:49 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:52 --> 404 Page Not Found: PPD7_bahan_dukung_tpt/index
ERROR - 2024-09-17 14:21:54 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:54 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:54 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:54 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:56 --> 404 Page Not Found: PPD7_bahan_dukung_tpt/index
ERROR - 2024-09-17 14:21:58 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:58 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:58 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:21:58 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:21:59 --> 404 Page Not Found: PPD7_bahan_dukung_tpt/index
ERROR - 2024-09-17 14:22:02 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:22:02 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:22:02 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:22:02 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:22:32 --> 404 Page Not Found: PPD8_bahan_dukung_tpt/g_bahan
ERROR - 2024-09-17 14:22:53 --> 404 Page Not Found: PPD8_bahan_dukung_tpt/g_bahan
ERROR - 2024-09-17 14:23:57 --> 404 Page Not Found: PPD8_bahan_dukung_tpt/g_bahan
ERROR - 2024-09-17 14:23:58 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:23:58 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:23:58 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:23:58 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:23:59 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:23:59 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:23:59 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:23:59 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:24:00 --> 404 Page Not Found: PPD8_bahan_dukung_tpt/g_bahan
ERROR - 2024-09-17 14:24:45 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:24:46 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:24:46 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:24:46 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:24:47 --> 404 Page Not Found: PPD8_bahan_dukung_tpt/g_bahans
ERROR - 2024-09-17 14:24:51 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:24:52 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:24:52 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:24:52 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:24:58 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:24:58 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:24:58 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 14:24:58 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:28:06 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 14:33:17 --> 404 Page Not Found: Attachments/bahandukung
ERROR - 2024-09-17 14:34:52 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 14:35:28 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:35:28 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:35:28 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:35:28 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:35:28 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:36:19 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:36:19 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:36:30 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:36:30 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 14:54:48 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:54:48 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:54:48 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:54:48 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:54:48 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 14:54:53 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 14:56:34 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_kabkot`, CONSTRAINT `tbl_user_kabkot_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '785'
ERROR - 2024-09-17 14:56:50 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_kabkot`, CONSTRAINT `tbl_user_kabkot_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '802'
ERROR - 2024-09-17 15:07:10 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:07:11 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:07:22 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:07:22 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:08:49 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 15:09:01 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 15:09:01 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 15:09:01 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 15:09:01 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 15:09:01 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-09-17 15:09:12 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:09:12 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:13:08 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:13:08 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:13:08 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:13:08 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:14:17 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:14:18 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:14:18 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:14:18 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:15:27 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:15:28 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:15:28 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:15:28 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:16:14 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:16:15 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:16:15 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:16:15 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:16:43 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:16:44 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:16:44 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:16:45 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:16:48 --> 404 Page Not Found: G_wilayah/index
ERROR - 2024-09-17 15:16:57 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:16:57 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:16:57 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:16:57 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:17:25 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 15:23:25 --> 404 Page Not Found: Package/css
ERROR - 2024-09-17 15:24:33 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:24:33 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:26:02 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:26:03 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 15:26:03 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 15:26:03 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:03:59 --> 404 Page Not Found: Attachments/kabkota
ERROR - 2024-09-17 16:18:26 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:18:26 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:18:29 --> 404 Page Not Found: PPD7_unduh_nilai_kab/index
ERROR - 2024-09-17 16:18:31 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:18:31 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:24:58 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:24:59 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:03 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:04 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:05 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:05 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:10 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:10 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:10 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:17 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:17 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:17 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:17 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:28 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:28 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:28 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:28 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:33 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:33 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:33 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:33 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:37 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:37 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:25:37 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:25:37 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:27:06 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:27:06 --> 404 Page Not Found: Assets/libs
ERROR - 2024-09-17 16:27:06 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-17 16:27:06 --> 404 Page Not Found: Assets/libs
