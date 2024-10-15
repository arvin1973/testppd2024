<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-08 09:05:04 --> 404 Page Not Found: Package/css
ERROR - 2024-10-08 09:21:59 --> Severity: Error --> [] operator not supported for strings C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1208
ERROR - 2024-10-08 10:29:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'Hatmadji Sudjarwo, ST, MPP, SintaParamita.skor Sinta Paramita, ST, M.T.I, BimoAr' at line 1 - Invalid query: SELECT K.id NOKRITERIA,K.`nama` KRITERIA,IND.nourut NOINDI,IND.`nama` INDIKATOR,IT.`nourut` NOITEM,IT.`nama` ITEM, IND.bobot BOBOT, YudhieHatmadjiSudjarwo.skor Yudhie Hatmadji Sudjarwo, ST, MPP, SintaParamita.skor Sinta Paramita, ST, M.T.I, BimoArvianto.skor Bimo Fachrizal Arvianto, S.Si, MIT, AnnisaKusumaWardhani.skor Annisa Kusuma Wardhani, ST, AdeFaisal.skor Ade Faisal, ST, MSc
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
                    WHERE SK.`mapid`='144'
                    ) YudhieHatmadjiSudjarwo ON YudhieHatmadjiSudjarwo.iditem=IT.`id`LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='180'
                    ) SintaParamita ON SintaParamita.iditem=IT.`id`LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='336'
                    ) BimoArvianto ON BimoArvianto.iditem=IT.`id`LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='350'
                    ) AnnisaKusumaWardhani ON AnnisaKusumaWardhani.iditem=IT.`id`LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='402'
                    ) AdeFaisal ON AdeFaisal.iditem=IT.`id`
                        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC
ERROR - 2024-10-08 10:29:19 --> Severity: Error --> Call to a member function result_array() on boolean C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1186
ERROR - 2024-10-08 10:29:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'Hatmadji Sudjarwo, ST, MPP, SintaParamita.skor Sinta Paramita, ST, M.T.I, BimoAr' at line 1 - Invalid query: SELECT K.id NOKRITERIA,K.`nama` KRITERIA,IND.nourut NOINDI,IND.`nama` INDIKATOR,IT.`nourut` NOITEM,IT.`nama` ITEM, IND.bobot BOBOT, YudhieHatmadjiSudjarwo.skor Yudhie Hatmadji Sudjarwo, ST, MPP, SintaParamita.skor Sinta Paramita, ST, M.T.I, BimoArvianto.skor Bimo Fachrizal Arvianto, S.Si, MIT, AnnisaKusumaWardhani.skor Annisa Kusuma Wardhani, ST, AdeFaisal.skor Ade Faisal, ST, MSc
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
                    WHERE SK.`mapid`='144'
                    ) YudhieHatmadjiSudjarwo ON YudhieHatmadjiSudjarwo.iditem=IT.`id`LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='180'
                    ) SintaParamita ON SintaParamita.iditem=IT.`id`LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='336'
                    ) BimoArvianto ON BimoArvianto.iditem=IT.`id`LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='350'
                    ) AnnisaKusumaWardhani ON AnnisaKusumaWardhani.iditem=IT.`id`LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='402'
                    ) AdeFaisal ON AdeFaisal.iditem=IT.`id`
                        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC
ERROR - 2024-10-08 10:29:59 --> Severity: Error --> Call to a member function result_array() on boolean C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1186
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:36 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:37 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:38 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:39 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "jabar1" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar2" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:40 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:41 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 10:53:42 --> Severity: Notice --> Undefined index: "tptjabar3" C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1283
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:42 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_unique() expects parameter 1 to be array, string given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1307
ERROR - 2024-10-08 11:28:43 --> Severity: Warning --> array_values() expects parameter 1 to be array, null given C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1308
ERROR - 2024-10-08 13:06:57 --> Severity: Notice --> Undefined offset: 26 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:06:57 --> Severity: error --> Exception: Invalid cell coordinate 4 C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell.php 558
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 26 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 27 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 28 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 29 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 30 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 31 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 32 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 33 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 34 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 35 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 36 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 37 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 38 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 39 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 40 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 41 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 42 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 43 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 44 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 45 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 46 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 47 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 48 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 49 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 50 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 51 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 52 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 53 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 54 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 55 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 56 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 57 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 58 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 59 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 60 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 61 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 62 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 63 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 64 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 65 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 66 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 67 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 68 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 69 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 70 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 71 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 72 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 73 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 74 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 75 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 76 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 77 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 78 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 79 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 80 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 81 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 82 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 83 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 84 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 85 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 86 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 87 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 88 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 89 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 90 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 91 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 92 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 93 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 94 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 95 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 96 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 97 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 98 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 99 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 100 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 101 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 102 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 103 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 104 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 105 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 106 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 107 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 108 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 109 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 110 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 111 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 112 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 113 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 114 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 115 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 116 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 117 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 118 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 119 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 120 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 121 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 122 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 123 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 124 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 125 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 126 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 127 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 128 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 129 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 130 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 131 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 132 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 133 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 134 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 135 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 136 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 137 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 138 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 139 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 140 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 141 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 142 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:07:39 --> Severity: Notice --> Undefined offset: 143 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1311
ERROR - 2024-10-08 13:09:35 --> Severity: Notice --> Undefined offset: 26 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1318
ERROR - 2024-10-08 14:04:45 --> 404 Page Not Found: Package/css
ERROR - 2024-10-08 14:04:59 --> 404 Page Not Found: Assets/js
ERROR - 2024-10-08 14:05:00 --> 404 Page Not Found: Assets/js
ERROR - 2024-10-08 16:19:45 --> 404 Page Not Found: Package/css
ERROR - 2024-10-08 16:19:56 --> 404 Page Not Found: Assets/js
ERROR - 2024-10-08 16:19:56 --> 404 Page Not Found: Assets/js
ERROR - 2024-10-08 16:26:57 --> 404 Page Not Found: Package/css
ERROR - 2024-10-08 16:43:54 --> Severity: Notice --> Undefined variable: nama C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1162
ERROR - 2024-10-08 16:51:33 --> Severity: Notice --> Undefined offset: 27 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1270
ERROR - 2024-10-08 16:51:33 --> Severity: Notice --> Undefined offset: 28 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1273
ERROR - 2024-10-08 16:51:33 --> Severity: Notice --> Undefined offset: 28 C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1276
ERROR - 2024-10-08 16:51:33 --> Severity: error --> Exception: Invalid cell coordinate 345 C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell.php 558
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1365
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1366
ERROR - 2024-10-08 17:00:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1367
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:03:02 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:03:03 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1368
ERROR - 2024-10-08 17:03:03 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1369
ERROR - 2024-10-08 17:03:03 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1370
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1366
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1367
ERROR - 2024-10-08 17:04:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1368
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1368
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1369
ERROR - 2024-10-08 17:05:10 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1370
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:12 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1368
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1369
ERROR - 2024-10-08 17:09:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1370
ERROR - 2024-10-08 17:09:28 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:28 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:28 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:28 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:28 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:28 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:31 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:31 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:31 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:31 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:31 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:31 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:09:33 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:10:21 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:10:21 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:10:21 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:10:21 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:10:21 --> Severity: Warning --> preg_match() expects parameter 2 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Cell\DefaultValueBinder.php 95
ERROR - 2024-10-08 17:10:21 --> Severity: Warning --> mb_substr() expects parameter 1 to be string, array given C:\xampp5\htdocs\ppd2024\application\libraries\third_party\PHPExcel\Shared\String.php 575
ERROR - 2024-10-08 17:20:56 --> Severity: Warning --> array_merge(): Argument #5 is not an array C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1242
ERROR - 2024-10-08 17:20:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1249
ERROR - 2024-10-08 17:20:56 --> Severity: Warning --> array_merge(): Argument #5 is not an array C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1242
ERROR - 2024-10-08 17:20:56 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1249
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> array_merge(): Argument #5 is not an array C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1242
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1249
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> array_merge(): Argument #5 is not an array C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1242
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1249
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> array_merge(): Argument #5 is not an array C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1242
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1249
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> array_merge(): Argument #5 is not an array C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1242
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1249
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1365
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1366
ERROR - 2024-10-08 17:20:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_status_penilaian_kota_daerah.php 1367
