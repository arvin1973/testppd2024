<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-31 09:12:24 --> 404 Page Not Found: Package/css
ERROR - 2024-10-31 09:16:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '-1' at line 10 - Invalid query: SELECT K.id mapid,K.id_kode, K.nama_provinsi, IFNULL(JML.jml,0) jml_tpt
                        FROM `provinsi` K 
                        LEFT JOIN(
				        SELECT P.id, P.`nama_provinsi`,COUNT(1) jml  
                                    FROM  `tbl_user` D
                                    JOIN `provinsi` P  ON P.id=D.satker
                                    WHERE D.`group`=7
                                    GROUP BY P.`id`
                        )JML ON JML.id=K.`id`
                        WHERE K.id !='-1' ORDER BY K.`id_kode`   asc  LIMIT 0 ,-1   
ERROR - 2024-10-31 09:16:36 --> Severity: Error --> Call to a member function result() on boolean C:\xampp5\htdocs\ppd2024\application\controllers\M_users_tpt_daerah.php 174
ERROR - 2024-10-31 10:10:27 --> 404 Page Not Found: Package/css
ERROR - 2024-10-31 10:10:38 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-10-31 10:13:49 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-10-31 10:13:56 --> 404 Page Not Found: Package/css
ERROR - 2024-10-31 11:05:24 --> 404 Page Not Found: Package/css
ERROR - 2024-10-31 11:14:41 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 11:14:41 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:33:40 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:33:40 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:35:45 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:35:45 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:40:38 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:40:38 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:42:01 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:42:01 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:42:32 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:42:32 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:43:02 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:43:02 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:46:51 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:46:51 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:47:14 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:47:14 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:47:17 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:47:17 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:48:31 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:48:31 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 136
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 137
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 138
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 139
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 140
ERROR - 2024-10-31 12:59:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 141
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> file_get_contents(C:\xampp5\htdocs\ppd2024\attachments/penilaian_tpitpu/): failed to open stream: No such file or directory C:\xampp5\htdocs\ppd2024\system\libraries\Zip.php 316
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 136
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 137
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 138
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 139
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 140
ERROR - 2024-10-31 13:00:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp5\htdocs\ppd2024\system\core\Exceptions.php:271) C:\xampp5\htdocs\ppd2024\system\helpers\download_helper.php 141
ERROR - 2024-10-31 13:05:46 --> Severity: error --> Exception: Data Upload Tidak Ada C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_t2_penilaian.php 438
ERROR - 2024-10-31 13:48:32 --> Severity: Warning --> fsockopen(): unable to connect to webmail.bappenas.go.id:25 (A connection attempt failed because the connected party did not properly respond after a period of time, or established connection failed because connected host has failed to respond.
) C:\xampp5\htdocs\ppd2024\system\libraries\Email.php 2069
ERROR - 2024-10-31 13:50:40 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 13:50:40 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 13:51:38 --> Severity: error --> Exception: Data Upload Tidak Ada C:\xampp5\htdocs\ppd2024\application\controllers\PPD1_t2_penilaian.php 438
ERROR - 2024-10-31 14:07:58 --> 404 Page Not Found: Package/css
ERROR - 2024-10-31 14:08:07 --> 404 Page Not Found: Assets/video_tutorial_3
ERROR - 2024-10-31 14:08:51 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 14:08:51 --> 404 Page Not Found: Assets/libs
ERROR - 2024-10-31 14:11:38 --> 404 Page Not Found: Attachments/bahandukung
