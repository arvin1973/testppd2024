<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-26 09:07:53 --> 404 Page Not Found: Package/css
ERROR - 2024-09-26 09:09:50 --> 404 Page Not Found: Package/css
ERROR - 2024-09-26 09:10:45 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_kabkot`, CONSTRAINT `tbl_user_kabkot_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '800'
ERROR - 2024-09-26 09:11:50 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_kabkot`, CONSTRAINT `tbl_user_kabkot_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '786'
ERROR - 2024-09-26 09:12:05 --> Query error: Cannot delete or update a parent row: a foreign key constraint fails (`peppd_ppd2024`.`tbl_user_kabkot`, CONSTRAINT `tbl_user_kabkot_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `tbl_user` (`id`)) - Invalid query: DELETE FROM `tbl_user`
WHERE `id` = '788'
ERROR - 2024-09-26 09:38:06 --> Severity: Notice --> Undefined index: name C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 700
ERROR - 2024-09-26 09:38:06 --> Severity: Notice --> Undefined index: name C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 700
ERROR - 2024-09-26 09:38:06 --> Severity: Notice --> Undefined index: name C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 700
ERROR - 2024-09-26 10:42:38 --> 404 Page Not Found: Package/css
ERROR - 2024-09-26 10:43:02 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-26 10:43:03 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-26 10:48:23 --> 404 Page Not Found: Package/css
ERROR - 2024-09-26 10:48:55 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-26 10:48:55 --> 404 Page Not Found: Assets/js
ERROR - 2024-09-26 11:25:52 --> Query error: Not unique table/alias: 'jabar' - Invalid query: SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem, jabar.skor, jabar1.skor, tptjabar2.skor, jabar.skor, jabar1.skor, tptjabar2.skor,  IND.bobot
                        FROM `r_mdl1_item` IT
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                        JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                        JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                        JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                        LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='551'
                            ) jabar ON jabar.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='560'
                            ) jabar1 ON jabar1.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='566'
                            ) tptjabar2 ON tptjabar2.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='552'
                            ) jabar ON jabar.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='561'
                            ) jabar1 ON jabar1.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='567'
                            ) tptjabar2 ON tptjabar2.iditem=IT.`id`
                        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC
ERROR - 2024-09-26 11:25:52 --> Severity: Error --> Call to a member function result_array() on boolean C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 741
ERROR - 2024-09-26 11:26:49 --> Query error: Not unique table/alias: 'jabar' - Invalid query: SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem, jabar.skor, jabar1.skor, tptjabar2.skor, jabar.skor, jabar1.skor, tptjabar2.skor,  IND.bobot
                        FROM `r_mdl1_item` IT
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                        JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                        JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                        JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                        LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='551'
                            ) jabar ON jabar.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='560'
                            ) jabar1 ON jabar1.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='566'
                            ) tptjabar2 ON tptjabar2.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='552'
                            ) jabar ON jabar.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='561'
                            ) jabar1 ON jabar1.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='567'
                            ) tptjabar2 ON tptjabar2.iditem=IT.`id`
                        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC
ERROR - 2024-09-26 11:26:49 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php:736) C:\xampp5\htdocs\ppd2024\system\core\Common.php 570
ERROR - 2024-09-26 11:26:49 --> Severity: Error --> Call to a member function result_array() on boolean C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 743
ERROR - 2024-09-26 11:27:20 --> Query error: Not unique table/alias: 'jabar' - Invalid query: SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem, jabar.skor, jabar1.skor, tptjabar2.skor, jabar.skor, jabar1.skor, tptjabar2.skor,  IND.bobot
                        FROM `r_mdl1_item` IT
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                        JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                        JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                        JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                        LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='551'
                            ) jabar ON jabar.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='560'
                            ) jabar1 ON jabar1.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='566'
                            ) tptjabar2 ON tptjabar2.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='552'
                            ) jabar ON jabar.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='561'
                            ) jabar1 ON jabar1.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='567'
                            ) tptjabar2 ON tptjabar2.iditem=IT.`id`
                        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC
ERROR - 2024-09-26 11:27:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php:737) C:\xampp5\htdocs\ppd2024\system\core\Common.php 570
ERROR - 2024-09-26 11:27:20 --> Severity: Error --> Call to a member function result_array() on boolean C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 745
ERROR - 2024-09-26 11:40:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 804
ERROR - 2024-09-26 11:40:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 805
ERROR - 2024-09-26 11:40:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 806
ERROR - 2024-09-26 11:40:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 804
ERROR - 2024-09-26 11:40:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 805
ERROR - 2024-09-26 11:40:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 806
ERROR - 2024-09-26 11:41:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:443) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 800
ERROR - 2024-09-26 11:41:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:443) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 801
ERROR - 2024-09-26 11:41:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:443) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 802
ERROR - 2024-09-26 11:41:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:443) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 800
ERROR - 2024-09-26 11:41:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:443) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 801
ERROR - 2024-09-26 11:41:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:443) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 802
ERROR - 2024-09-26 11:47:02 --> Query error: Unknown column 'jabar.skorjabar' in 'field list' - Invalid query: SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem, jabar.skorjabar, jabar1.skorjabar1, tptjabar2.skortptjabar2,  IND.bobot
                        FROM `r_mdl1_item` IT
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                        JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                        JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                        JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                        LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='551'
                            ) jabar ON jabar.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='560'
                            ) jabar1 ON jabar1.iditem=IT.`id`LEFT JOIN(
                                SELECT I.`id` iditem,II.`skor`
                                FROM `t_mdl1_skor_kabkota` SK
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                WHERE SK.`mapid`='566'
                            ) tptjabar2 ON tptjabar2.iditem=IT.`id`
                        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC
ERROR - 2024-09-26 11:47:02 --> Severity: Error --> Call to a member function result_array() on boolean C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 744
ERROR - 2024-09-26 11:52:41 --> Severity: Parsing Error --> syntax error, unexpected ':' C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 706
ERROR - 2024-09-26 11:56:33 --> Severity: Error --> Call to a member function result() on string C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 809
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:07 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 823
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 824
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 825
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 823
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 824
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 825
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Notice --> Undefined property: stdClass::$skor C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 816
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 823
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 824
ERROR - 2024-09-26 11:57:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 825
ERROR - 2024-09-26 11:57:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 822
ERROR - 2024-09-26 11:57:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 823
ERROR - 2024-09-26 11:57:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 824
ERROR - 2024-09-26 11:57:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 822
ERROR - 2024-09-26 11:57:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 823
ERROR - 2024-09-26 11:57:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 824
ERROR - 2024-09-26 11:58:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 821
ERROR - 2024-09-26 11:58:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 822
ERROR - 2024-09-26 11:58:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 823
ERROR - 2024-09-26 11:58:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 821
ERROR - 2024-09-26 11:58:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 822
ERROR - 2024-09-26 11:58:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 823
ERROR - 2024-09-26 13:35:14 --> Severity: Parsing Error --> syntax error, unexpected ')' C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 729
ERROR - 2024-09-26 13:42:10 --> Severity: Parsing Error --> syntax error, unexpected ']' C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:42:12 --> Severity: Notice --> Array to string conversion C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 719
ERROR - 2024-09-26 13:43:23 --> Severity: Parsing Error --> syntax error, unexpected ')' C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 777
ERROR - 2024-09-26 13:45:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 785
ERROR - 2024-09-26 13:45:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 13:45:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 787
ERROR - 2024-09-26 13:45:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 785
ERROR - 2024-09-26 13:45:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 13:45:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 787
ERROR - 2024-09-26 13:46:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 785
ERROR - 2024-09-26 13:46:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 13:46:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 787
ERROR - 2024-09-26 13:46:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 785
ERROR - 2024-09-26 13:46:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 13:46:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 787
ERROR - 2024-09-26 13:57:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 13:57:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 787
ERROR - 2024-09-26 13:57:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 788
ERROR - 2024-09-26 13:57:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 13:57:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 787
ERROR - 2024-09-26 13:57:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 788
ERROR - 2024-09-26 14:10:11 --> Severity: Notice --> Undefined property: CI_DB_mysqli_result::$result C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 744
ERROR - 2024-09-26 14:10:11 --> Severity: Notice --> Undefined property: CI_DB_mysqli_result::$result C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 744
ERROR - 2024-09-26 14:10:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:369) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 795
ERROR - 2024-09-26 14:10:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:369) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 796
ERROR - 2024-09-26 14:10:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:369) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:10:11 --> Severity: Notice --> Undefined property: CI_DB_mysqli_result::$result C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 744
ERROR - 2024-09-26 14:10:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:369) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 795
ERROR - 2024-09-26 14:10:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:369) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 796
ERROR - 2024-09-26 14:10:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:369) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> array_keys() expects parameter 1 to be array, object given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 774
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 779
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> array_keys() expects parameter 1 to be array, object given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 774
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 779
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 795
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 796
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> array_keys() expects parameter 1 to be array, object given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 774
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 779
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 795
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 796
ERROR - 2024-09-26 14:10:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:11:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 795
ERROR - 2024-09-26 14:11:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 796
ERROR - 2024-09-26 14:11:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:11:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 795
ERROR - 2024-09-26 14:11:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 796
ERROR - 2024-09-26 14:11:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:31:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:31:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:31:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:31:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:31:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:31:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:32:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:32:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:32:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:32:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:32:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:32:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:36:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:36:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 800
ERROR - 2024-09-26 14:36:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 801
ERROR - 2024-09-26 14:36:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:36:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 800
ERROR - 2024-09-26 14:36:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 801
ERROR - 2024-09-26 14:38:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 795
ERROR - 2024-09-26 14:38:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 796
ERROR - 2024-09-26 14:38:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:38:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 795
ERROR - 2024-09-26 14:38:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 796
ERROR - 2024-09-26 14:38:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:43:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:43:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:43:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:43:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:43:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:43:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:44:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:44:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:44:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:44:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:44:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:44:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:44:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:44:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:44:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:44:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 797
ERROR - 2024-09-26 14:44:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 798
ERROR - 2024-09-26 14:44:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\OLE\PPS\Root.php:279) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 799
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:55 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 786
ERROR - 2024-09-26 14:58:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 820
ERROR - 2024-09-26 14:58:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 821
ERROR - 2024-09-26 14:58:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 822
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:31 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Notice --> Undefined index: nmkriteria C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 794
ERROR - 2024-09-26 15:01:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 820
ERROR - 2024-09-26 15:01:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 821
ERROR - 2024-09-26 15:01:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 822
