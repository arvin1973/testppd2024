<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-11-19 13:01:38 --> 404 Page Not Found: Package/css
ERROR - 2021-11-19 13:03:14 --> Query error: Table 'ppd2022.r_mdl2_item' doesn't exist - Invalid query: SELECT A.`id` iditem,A.`nama` nm,A.`isactive`,A.nourut
                        FROM `r_mdl2_item` A
                        WHERE A.`subindiid`='40'
                        ORDER BY A.nourut ASC
ERROR - 2021-11-19 13:03:14 --> admin M_modul_2 : Table 'ppd2022.r_mdl2_item' doesn't exist
ERROR - 2021-11-19 13:10:39 --> Query error: Table 'ppd2022.r_mdl2_item' doesn't exist - Invalid query: SELECT A.`id` iditem,A.`nama` nm,A.`isactive`,A.nourut
                        FROM `r_mdl2_item` A
                        WHERE A.`subindiid`='40'
                        ORDER BY A.nourut ASC
ERROR - 2021-11-19 13:10:39 --> admin M_modul_2 : Table 'ppd2022.r_mdl2_item' doesn't exist
ERROR - 2021-11-19 13:11:04 --> Query error: Table 'ppd2022.r_mdl2_item' doesn't exist - Invalid query: SELECT A.`id` iditem,A.`nama` nm,A.`isactive`,A.nourut
                        FROM `r_mdl2_item` A
                        WHERE A.`subindiid`='40'
                        ORDER BY A.nourut ASC
ERROR - 2021-11-19 13:11:04 --> admin M_modul_2 : Table 'ppd2022.r_mdl2_item' doesn't exist
ERROR - 2021-11-19 13:27:24 --> Query error: Table 'ppd2022.r_mdl2_item' doesn't exist - Invalid query: SELECT IT.`nourut`,IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                            ,NOL.idinditem idnol,NOL.nminditem nmnol,SATU.idinditem idsatu,SATU.nminditem nmsatu
                            ,ISI.skor isiskor,ISI.indiitemid
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl2_item_indi` MII
                                    JOIN `r_mdl2_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=1
                                    WHERE MII.`skor`=0
                            ) NOL ON NOL.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl2_item_indi` MII
                                    JOIN `r_mdl2_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=1
                                    WHERE MII.`skor`=1
                            ) SATU ON SATU.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,II.`skor`,II.`id` indiitemid
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl2_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl2_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=1
                                    WHERE W.`id`=22
                                    
                            ) ISI ON ISI.iditem=IT.`id`
                            WHERE SI.`indiid`=1  ORDER BY SI.`nourut`,IT.`nourut` ASC
ERROR - 2021-11-19 13:27:24 --> tpi1 PPD3_modul2 : Table 'ppd2022.r_mdl2_item' doesn't exist
ERROR - 2021-11-19 14:13:59 --> Query error: Table 'ppd2022.r_mdl2_item' doesn't exist - Invalid query: SELECT IT.`nourut`,IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                            ,NOL.idinditem idnol,NOL.nminditem nmnol,SATU.idinditem idsatu,SATU.nminditem nmsatu
                            ,ISI.skor isiskor,ISI.indiitemid
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl2_item_indi` MII
                                    JOIN `r_mdl2_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=1
                                    WHERE MII.`skor`=0
                            ) NOL ON NOL.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl2_item_indi` MII
                                    JOIN `r_mdl2_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=1
                                    WHERE MII.`skor`=1
                            ) SATU ON SATU.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,II.`skor`,II.`id` indiitemid
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl2_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl2_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=1
                                    WHERE W.`id`=22
                                    
                            ) ISI ON ISI.iditem=IT.`id`
                            WHERE SI.`indiid`=1  ORDER BY SI.`nourut`,IT.`nourut` ASC
ERROR - 2021-11-19 14:13:59 --> tpi1 PPD3_modul2 : Table 'ppd2022.r_mdl2_item' doesn't exist
ERROR - 2021-11-19 14:22:39 --> Query error: Table 'ppd2022.r_mdl2_sub_indi' doesn't exist - Invalid query: SELECT A.id idindi,B.id idkriteria,ASP.id idaspek,ASP.nama nmaspek,B.`nama` nmkriteria,A.`nama` nmindi,ASP.bobot bobotaspek,A.`bobot` bobotindi,B.`bobot` bobotkriteria,A.`note` noteindi
                            ,A.nourut,COUNT(1) jml
                            FROM `r_mdl2_indi` A
                            JOIN `r_mdl2_krtria` B ON B.`id`=A.`krtriaid`
                            JOIN `r_mdl2_aspek` ASP ON ASP.id=B.aspekid
                            JOIN `r_mdl2_sub_indi` SI ON SI.`indiid`=A.`id`
                            LEFT JOIN `t_mdl2_resume_prov` RSM ON RSM.`aspekid`=ASP.`id` AND RSM.`mapid`='22'
                            GROUP BY A.`id`
                            ORDER BY B.`id`,A.nourut
ERROR - 2021-11-19 14:22:39 --> tpi1 PPD3_modul2 : 
ERROR - 2021-11-19 14:27:29 --> Query error: Table 'ppd2022.r_mdl2_sub_indi' doesn't exist - Invalid query: SELECT A.`id` idsindi,A.`nama` nmsindi,istampil,isprov,nourut
                        FROM `r_mdl2_sub_indi` A
                        WHERE A.`indiid`='1'
                        ORDER BY A.nourut ASC
ERROR - 2021-11-19 14:27:29 --> admin M_modul_2 : Table 'ppd2022.r_mdl2_sub_indi' doesn't exist
ERROR - 2021-11-19 14:37:20 --> Query error: Table 'ppd2022.r_mdl2_sub_indi' doesn't exist - Invalid query: SELECT A.id idindi,B.id idkriteria,ASP.id idaspek,ASP.nama nmaspek,B.`nama` nmkriteria,A.`nama` nmindi,ASP.bobot bobotaspek,A.`bobot` bobotindi,B.`bobot` bobotkriteria,A.`note` noteindi
                            ,A.nourut,COUNT(1) jml
                            FROM `r_mdl2_indi` A
                            JOIN `r_mdl2_krtria` B ON B.`id`=A.`krtriaid`
                            JOIN `r_mdl2_aspek` ASP ON ASP.id=B.aspekid
                            JOIN `r_mdl2_sub_indi` SI ON SI.`indiid`=A.`id`
                            LEFT JOIN `t_mdl2_resume_prov` RSM ON RSM.`aspekid`=ASP.`id` AND RSM.`mapid`='22'
                            GROUP BY A.`id`
                            ORDER BY B.`id`,A.nourut
ERROR - 2021-11-19 14:37:20 --> tpi1 PPD3_modul2 : 
ERROR - 2021-11-19 14:41:43 --> Query error: Table 'ppd2022.r_mdl2_item' doesn't exist - Invalid query: SELECT IT.`nourut`,IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                            ,NOL.idinditem idnol,NOL.nminditem nmnol,SATU.idinditem idsatu,SATU.nminditem nmsatu
                            ,ISI.skor isiskor,ISI.indiitemid
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_item_indi` SI ON SI.`id`=IT.`subindiid`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl2_item_indi` MII
                                    JOIN `r_mdl2_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl2_item_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=1
                                    WHERE MII.`skor`=0
                            ) NOL ON NOL.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl2_item_indi` MII
                                    JOIN `r_mdl2_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl2_item_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=1
                                    WHERE MII.`skor`=1
                            ) SATU ON SATU.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,II.`skor`,II.`id` indiitemid
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl2_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl2_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl2_item_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=1
                                    WHERE W.`id`=22
                                    
                            ) ISI ON ISI.iditem=IT.`id`
                            WHERE SI.`indiid`=1  ORDER BY SI.`nourut`,IT.`nourut` ASC
ERROR - 2021-11-19 14:41:43 --> tpi1 PPD3_modul2 : Table 'ppd2022.r_mdl2_item' doesn't exist
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 14:43:11 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 14:43:12 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 14:43:12 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ppd2022\system\core\Exceptions.php:271) C:\xampp\htdocs\ppd2022\system\core\Common.php 570
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsubindi C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1107
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1118
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1122
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1127
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1130
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1135
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1140
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1143
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1149
ERROR - 2021-11-19 15:08:22 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1154
ERROR - 2021-11-19 15:08:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ppd2022\system\core\Exceptions.php:271) C:\xampp\htdocs\ppd2022\system\core\Common.php 570
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1169
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1169
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1169
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1169
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1169
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmitem C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1169
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:10:49 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:10:49 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ppd2022\system\core\Exceptions.php:271) C:\xampp\htdocs\ppd2022\system\core\Common.php 570
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nourut C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1168
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nourut C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1168
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nourut C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1168
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:13:15 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nourut C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1168
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nourut C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1168
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nourut C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1168
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1173
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nmnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1178
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idnol C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1181
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1186
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$nmsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1191
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$idsatu C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$indiitemid C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1194
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1200
ERROR - 2021-11-19 15:13:16 --> Severity: Notice --> Undefined property: stdClass::$isiskor C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1205
ERROR - 2021-11-19 15:13:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\ppd2022\system\core\Exceptions.php:271) C:\xampp\htdocs\ppd2022\system\core\Common.php 570
ERROR - 2021-11-19 15:15:58 --> Severity: Notice --> Undefined variable: nilai C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1221
ERROR - 2021-11-19 15:39:55 --> 404 Page Not Found: Package/css
ERROR - 2021-11-19 15:40:09 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 15:40:09 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 15:58:56 --> Severity: Warning --> max(): When only one parameter is given, it must be an array C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1218
ERROR - 2021-11-19 16:00:05 --> Severity: Warning --> max(): When only one parameter is given, it must be an array C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1219
ERROR - 2021-11-19 16:01:17 --> Severity: Warning --> max(): When only one parameter is given, it must be an array C:\xampp\htdocs\ppd2022\application\controllers\PPD3_modul2.php 1219
ERROR - 2021-11-19 16:37:51 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:37:51 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:42:43 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:42:43 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:48:08 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:48:08 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:48:43 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:48:44 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:48:46 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:48:46 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:50:05 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:50:05 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:50:07 --> 404 Page Not Found: Assets/libs
ERROR - 2021-11-19 16:50:07 --> 404 Page Not Found: Assets/libs
