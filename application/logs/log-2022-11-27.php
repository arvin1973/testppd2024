<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-11-27 13:58:55 --> 404 Page Not Found: Package/css
ERROR - 2022-11-27 14:09:48 --> 404 Page Not Found: Package/css
ERROR - 2022-11-27 14:37:33 --> Query error: Table 'ppd2023.r_mdl2_item_indi' doesn't exist - Invalid query: SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT
                                    FROM r_mdl2_aspek ASP
                                    JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id
                                    JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id
                                    JOIN `r_mdl2_sub_indi` SI ON SI.indiid = MI.id
                                    JOIN `r_mdl2_item` I ON I.subindiid=SI.id
                                    JOIN r_mdl2_item_indi II ON II.itemid=I.id
                                    LEFT JOIN t_mdl2_skor_prov SKR ON SKR.itemindi=II.id 
                                    LEFT JOIN tbl_user_wilayah W ON W.id = SKR.mapid
                                    GROUP BY MI.nama
                                    ORDER BY `id_aspek` ASC, NO_URUT ASC
ERROR - 2022-11-27 14:37:33 --> Query error: Table 'ppd2023.r_mdl2_item_indi' doesn't exist - Invalid query: SELECT MI.nourut AS nourut, MI.id AS id_indikator, MI.nama AS nama, SUM(II.`skor`) AS total
                                            FROM `tbl_user_t2_prov` W
                                            JOIN `t_mdl2_skor_p` SKR ON SKR.`mapid`=W.`id`
                                            JOIN `r_mdl2_item_indi` II ON II.`id`=SKR.`itemindi`
                                            JOIN `r_mdl2_item` I ON I.`id`=II.`itemid`
                                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid`
                                            JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=1
                                            JOIN provinsi PROV ON PROV.id = W.idwilayah
                                            WHERE W.`id` =6
                                            ORDER BY `I`.`nourut` ASC
ERROR - 2022-11-27 14:37:33 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1235
ERROR - 2022-11-27 14:37:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:37:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:37:44 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:37:44 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:37:48 --> Query error: Table 'ppd2023.r_mdl2_item_indi' doesn't exist - Invalid query: SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT
                                    FROM r_mdl2_aspek ASP
                                    JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id
                                    JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id
                                    JOIN `r_mdl2_sub_indi` SI ON SI.indiid = MI.id
                                    JOIN `r_mdl2_item` I ON I.subindiid=SI.id
                                    JOIN r_mdl2_item_indi II ON II.itemid=I.id
                                    LEFT JOIN t_mdl2_skor_prov SKR ON SKR.itemindi=II.id 
                                    LEFT JOIN tbl_user_wilayah W ON W.id = SKR.mapid
                                    GROUP BY MI.nama
                                    ORDER BY `id_aspek` ASC, NO_URUT ASC
ERROR - 2022-11-27 14:37:48 --> Query error: Table 'ppd2023.r_mdl2_item_indi' doesn't exist - Invalid query: SELECT MI.nourut AS nourut, MI.id AS id_indikator, MI.nama AS nama, SUM(II.`skor`) AS total
                                            FROM `tbl_user_t2_prov` W
                                            JOIN `t_mdl2_skor_p` SKR ON SKR.`mapid`=W.`id`
                                            JOIN `r_mdl2_item_indi` II ON II.`id`=SKR.`itemindi`
                                            JOIN `r_mdl2_item` I ON I.`id`=II.`itemid`
                                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid`
                                            JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=1
                                            JOIN provinsi PROV ON PROV.id = W.idwilayah
                                            WHERE W.`id` =6
                                            ORDER BY `I`.`nourut` ASC
ERROR - 2022-11-27 14:37:48 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1235
ERROR - 2022-11-27 14:51:42 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:51:42 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:51:45 --> Query error: Table 'ppd2023.r_mdl2_item_indi' doesn't exist - Invalid query: SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT
                                    FROM r_mdl2_aspek ASP
                                    JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id
                                    JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id
                                    JOIN `r_mdl2_sub_indi` SI ON SI.indiid = MI.id
                                    JOIN `r_mdl2_item` I ON I.subindiid=SI.id
                                    JOIN r_mdl2_item_indi II ON II.itemid=I.id
                                    LEFT JOIN t_mdl2_skor_prov SKR ON SKR.itemindi=II.id 
                                    LEFT JOIN tbl_user_wilayah W ON W.id = SKR.mapid
                                    GROUP BY MI.nama
                                    ORDER BY `id_aspek` ASC, NO_URUT ASC
ERROR - 2022-11-27 14:51:45 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1484
ERROR - 2022-11-27 14:52:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:52:55 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:52:57 --> Query error: Table 'ppd2023.t_mdl2_skor_prov' doesn't exist - Invalid query: SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT
                                    FROM r_mdl2_aspek ASP
                                    JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id
                                    JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id
                                    JOIN `r_mdl2_sub_indi` SI ON SI.indiid = MI.id
                                    JOIN `r_mdl2_item` I ON I.subindiid=SI.id
                                    LEFT JOIN t_mdl2_skor_prov SKR ON SKR.itemindi=I.id 
                                    LEFT JOIN tbl_user_wilayah W ON W.id = SKR.mapid
                                    GROUP BY MI.nama
                                    ORDER BY `id_aspek` ASC, NO_URUT ASC
ERROR - 2022-11-27 14:52:57 --> Severity: Error --> Call to a member function result() on boolean C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1483
ERROR - 2022-11-27 14:55:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 14:55:22 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:21:58 --> Severity: Parsing Error --> syntax error, unexpected ')' C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:23:02 --> Severity: Parsing Error --> syntax error, unexpected ')' C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:23:06 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:23:06 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:23:08 --> Severity: Parsing Error --> syntax error, unexpected ')' C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:23:11 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:23:11 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:23:16 --> Severity: Parsing Error --> syntax error, unexpected ')' C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:23:18 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:23:19 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:24:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:24:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Notice --> Trying to get property of non-object C:\xampp 5.6\htdocs\ppd2023\application\controllers\PPD3_modul2.php 1231
ERROR - 2022-11-27 15:24:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp 5.6\htdocs\ppd2023\system\core\Exceptions.php:271) C:\xampp 5.6\htdocs\ppd2023\system\core\Common.php 570
ERROR - 2022-11-27 15:24:44 --> 404 Page Not Found: Package/css
ERROR - 2022-11-27 15:24:53 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:24:54 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:24:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:24:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:26:09 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:26:09 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:37:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:37:34 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:44:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 15:44:24 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 17:32:08 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 17:32:08 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 17:33:07 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 17:33:07 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 17:35:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 17:35:56 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 17:37:54 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 17:37:54 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 18:05:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 18:05:37 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 18:05:47 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 18:05:47 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 18:10:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 18:10:36 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 18:11:44 --> 404 Page Not Found: Package/css
ERROR - 2022-11-27 18:11:58 --> 404 Page Not Found: Assets/libs
ERROR - 2022-11-27 18:11:58 --> 404 Page Not Found: Assets/libs
