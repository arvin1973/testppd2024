<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-11-12 18:10:16 --> 404 Page Not Found: Package/css
ERROR - 2022-11-12 18:14:43 --> 404 Page Not Found: Package/css
ERROR - 2022-11-12 18:25:47 --> Query error: Table 'ppd2023.t_dok_pkk' doesn't exist - Invalid query: SELECT * FROM (
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
ERROR - 2022-11-12 18:25:47 --> admin PPD1_M_Bahan_dukung : Table 'ppd2023.t_dok_pkk' doesn't exist
