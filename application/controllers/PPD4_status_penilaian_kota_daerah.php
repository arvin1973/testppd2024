<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD4_status_penilaian_kota_daerah extends CI_Controller
{
    var $view_dir   = "ppd4/statuspenilaian_daerah/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd4/statuspenilaian_daerah/statuspenilaian_daerah.js";
    var $allowed    = array("PPD4");
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
    }

    /*
     * 
     */
    public function index()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //common properties
                $this->js_init    = "main";
                $this->js_path    = "assets/js/ppd4/statuspenilaian_daerah/statuspenilaian_kota_daerah.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_kota", $data_page, TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init . ".init();",
                    "csrf_hash"     => $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     => $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("access denied!");
        }
    }

    function g_nilai_berdasarkan_penilai()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                session_write_close();

                
                //---------------isi disini--------------------
                $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(I.`id`) FROM r_mdl1_item I JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT') JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y') * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT us.satker,us.group,kabkot.id AS id, kabkot.iduser AS iduser, us.userid AS userid, us.name AS name, kabkot.idkabkot AS idkabkot, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten 
                            FROM `tbl_user_kabkot` kabkot
                            JOIN tbl_user us ON kabkot.iduser = us.id
                            JOIN kabupaten kab ON kabkot.idkabkot = kab.id
                            JOIN provinsi prov ON kab.prov_id = prov.id_kode
                        ) t1
                        LEFT JOIN t_mdl1_skor_kabkota skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_kabkota sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt') AND t1.nama_kabupaten LIKE 'Kota %' AND t1.group=7 AND t1.satker=$satkercode
                        GROUP BY t1.id
                        ORDER BY t1.userid, t1.nama_provinsi";


                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $no = 1;
                $str = '';
                foreach ($list_data->result() as $list) {
                    $str .= '<tr>';
                    $str .= '<td><center>' . $no . '</center></td>';
                    $str .= '<td><center>' . $list->userid . '</center></td>';
                    // $str .= '<td><center>' . $list->name . '</center></td>';
                    $str .= '<td><center>' . substr($list->name, 0, 20) . '</center></td>';
                    $str .= '<td><center>' . $list->nama_provinsi . '</center></td>';
                    $str .= '<td><center>' . $list->nama_kabupaten . '</center></td>';
                    $str .= '<td><center>' . $list->persentase_penilaian . '</center></td>';
                    $str .= '<td><center>' . $list->lembar_pernyataan . '</center></td>';
                    $str .= '</td>';
                    $no++;
                }

                //---------end isi disini----------------------

                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"     => $str,
                );
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
            } catch (Exception $exc) {
                $json_data = array(
                    "status"    => 0,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "msg"       => $exc->getMessage(),
                );
                exit(json_encode($json_data));
            }
        } else die("Die!");
    }

    /*
     * =========================================================================
     *  Provinsi                                                   - START
     * =========================================================================
     */
    /*
     * list data Provinsi
     * author : FSM 
     * date : 17 des 2020
     */
    function get_datatable()
    {
        if ($this->input->is_ajax_request()) {
            try {
                $requestData = $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array(
                    // datatable column index  => database column name
                    $idx++   => 'C.`id_kab`',
                    $idx++   => 'C.`id`',
                    $idx++   => 'C.`nama_kabupaten`',
                );

                $sql = "SELECT A.*, B.userid, B.name,C.id 'mapid',C.`id_kab`,C.nama_kabupaten
                    FROM `tbl_user_kabkot` A 
                    LEFT JOIN `tbl_user` B ON A.iduser=B.id 
                    LEFT JOIN `kabupaten` C ON A.idkabkot = C.id
                    WHERE B.group=7 AND B.active_flag ='Y' AND C.urutan='1' AND B.satker=$satkercode
                    GROUP BY C.id ";

                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " AND ( "
                        . " C.`nama_kabupaten` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR C.`id_kab` LIKE '%" . $requestData['search']['value'] . "%' "
                        . ")";
                }
                $list_data = $this->db->query($sql);
                $totalFiltered = $list_data->num_rows();
                $sql .= " ORDER BY "
                    . $columns[$requestData['order'][0]['column']] . "   "
                    . $requestData['order'][0]['dir'] . "  "
                    . "LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                $list_data = $this->db->query($sql);
                $data = array();
                $i = 1;
                foreach ($list_data->result() as $row) {
                    $nestedData = array();
                    $id      = $row->mapid;
                    $idkab = "kot_" . $row->mapid;

                    $encrypted_id = base64_encode(openssl_encrypt($idkab, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-nmkk='" . $row->nama_kabupaten . "'";

                    $nestedData[] = $row->id_kab;
                    $nestedData[] = "<a href='javascript:void(0)' " . $tmp . ">" . $row->nama_kabupaten . "</a>";
                    $data[] = $nestedData;
                }
                $json_data = array(
                    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval($totalData),  // total number of records
                    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        } else
            die;
    }
    /*
     * list data Status penilaian
     * author :  FSM
     * date : 10 Feb 2021
     */
    function g_bahan()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $this->form_validation->set_rules('id', 'ID Data Indikator', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $link = base_url() . "attachments/kertaskerja/";
                $idcomb = decrypt_base64($this->input->post("id"));

                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];

                $_arr = array("prov", "kab", "kot");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");

                //get jml aspek
                $sql = "SELECT A.`id` FROM r_mdl1_aspek A WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $jml_aspek = $list_data->num_rows();

                $str = "";

                if ($kate_wlyh == "kot") {
                    //get jml item
                    $sql = "SELECT I.`id`
                            FROM r_mdl1_item I 
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT')
                            JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y'";
                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $jml_item = $list_data->num_rows();

                    $sql = "SELECT A.iduser,C.name, A.id idkab,B.nama_kabupaten, JML.jml,IFNULL(RS.jml,0) jml_rsm, ST.id stts, ST.attachments
                            FROM tbl_user_kabkot A
                            JOIN `kabupaten` B ON B.`id`=A.`idkabkot` 
                            JOIN `tbl_user` C ON C.id = A.iduser AND C.group=7
                               LEFT JOIN(
                                        SELECT W.`idkabkot` idkab,COUNT(1) jml,W.iduser
                                        FROM `tbl_user_kabkot` W
                                        JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                        JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                        JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT')
                                        JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                        WHERE 1=1
                                        GROUP BY W.`idkabkot`,W.iduser
                                    ) JML ON JML.idkab=A.`idkabkot` AND JML.`iduser` = A.iduser
                                LEFT JOIN(
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml,W.iduser
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE 1=1
                                    GROUP BY W.`idkabkot`,W.`iduser`
                                ) RS ON RS.idkab=A.`idkabkot` AND RS.`iduser`=A.iduser      
                              LEFT JOIN t_mdl1_sttment_kabkota ST ON ST.mapid=A.id                          
                            WHERE A.`idkabkot`=? AND B.`urutan`=1";

                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }

                    $str = "";
                    if ($list_data->num_rows() == 0)
                        $str = "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
                    $no = 1;
                    $link = base_url() . "attachments/kertaskerja/";
                    foreach ($list_data->result() as $v) {
                        $idcomb = "-" . $v->iduser;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                        $tmp = " data-id='" . $encrypted_id . "'";
                        $idcomb1 = "-" . $v->idkab;
                        $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                        $tmp1 = " data-pr='" . $encrypted_id1 . "'";
                        $downl = $link . $v->attachments;
                        if (substr($v->attachments, -3) == 'rar') {
                            $rename = $v->name . "_" . $v->nama_kabupaten . ".rar";
                        } elseif (substr($v->attachments, -3) == 'zip') {
                            $rename = $v->name . "_" . $v->nama_kabupaten . ".zip";
                        } elseif (substr($v->attachments, -3) == 'pdf') {
                            $rename = $v->name . "_" . $v->nama_kabupaten . ".pdf";
                        } elseif (substr($v->attachments, -4) == 'docx') {
                            $rename = $v->name . "_" . $v->nama_kabupaten . ".docx";
                        } elseif (substr($v->attachments, -4) == 'xlsx') {
                            $rename = $v->name . "_" . $v->nama_kabupaten . ".xlsx";
                        } elseif (substr($v->attachments, -4) == 'jpeg') {
                            $rename = $v->name . "_" . $v->nama_kabupaten . ".jpeg";
                        } elseif (substr($v->attachments, -4) == 'pptx') {
                            $rename = $v->name . "_" . $v->nama_kabupaten . ".pptx";
                        } else {
                            $rename = $v->name . "_" . $v->nama_kabupaten;
                        }

                        $str .= "<tr class='' title='Dokumen'>";
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->name . "</td>";
                        // $str.="<td  class=''><a href='$downl' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";

                        //status
                        $prcntg = $jml_item == 0 ? 0 : $v->jml / $jml_item * 100;
                        $str_tmp = number_format($prcntg, 2) . "&nbsp;%";
                        if ($prcntg == 1) {
                            $str_tmp = "<i class='fas fa-check-circle text-success'></i>";
                        }
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $str_tmp . "</td>";

                        //status
                        $str_tmp = "<i class='fas fas fa-battery-half fa-2x text-warning' title='Data penilaian belum lengkap'></i>";
                        if ($prcntg == 100) {
                            $str_tmp = "<i class='fas fas fa-exclamation-circle fa-2x text-warning' title='Data Resume Aspek belum lengkap'></i>";
                            if ($v->jml_rsm == $jml_aspek) {
                                $str_tmp = "<a href='javascript:void(0);' class='getSttmnt' data-id='' title='Lembar pernyataan belum lengkap'><i class='fas fa-exclamation-circle fa-2x text-pink'></i></a>";
                                if (!is_null($v->stts)) {
                                    //$str_tmp="<a href='javascript:void(0);' class='getSttmnt' data-id='' title='Lengkap'><i class='fas fa-check-circle fa-2x text-success'></i></a>";
                                    $str_tmp = "<a href='$downl' download='$rename' target='_blank' class='getSttmnt' data-id='' title='Unduh Kertas Kerja'><i class='fas fa-check-circle fa-2x text-success'></i></a>";
                                }
                            }
                        }
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $str_tmp . "</td>";
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a $tmp $tmp1 class='btn btn-sm btnDown'  title='Unduh Data'><i class='fas fa-download text-primary'></i></a></td>";
                        $str .= "</tr>";
                    }
                }

                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => $str,
                );
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
            } catch (Exception $exc) {
                $json_data = array(
                    "status"    => 0,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "msg"       => $exc->getMessage(),
                );
                exit(json_encode($json_data));
            }
        } else die("Die!");
    }

    /*
     * unduh nilai 
     * author : FSM
     * date : 17 des 2020
     */
    function Download_nilai()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            echo "Session expired, silakan login";
        }
        $user = $this->session->userdata(SESSION_LOGIN)->id;

        $idcomb = decrypt_base64($_GET['timid']);
        $tmp = explode('-', $idcomb);
        if (count($tmp) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp[0];
        $user = $tmp[1];

        $provcomb = decrypt_base64($_GET['provid']);
        $tmp2 = explode('_', $provcomb);
        if (count($tmp2) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp2[0];
        $idwil = $tmp2[1];

        //select tim penilai
        $select_u = "SELECT W.* FROM `tbl_user` W WHERE W.id='$user' ";
        $list_u  = $this->db->query($select_u);
        foreach ($list_u->result() as $u) {
            $nama = $u->name;
        }

        //$user
         $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid "
             . "FROM `tbl_user_kabkot` W "
             . "JOIN `kabupaten` P ON W.idkabkot = P.id "
             . "JOIN `tbl_user` U ON W.iduser = U.id "
             . "WHERE W.iduser='$user' AND W.idkabkot='$idwil'";
         $list_data  = $this->db->query($select);
         foreach ($list_data->result() as $d) {
             $nilai = $d->id;
             $user_d = $d->userid;
             $namakab = $d->nama_kabupaten;
         }
         $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
         FROM `r_mdl1_item` IT
         JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT')
         JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
         JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
         JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
         LEFT JOIN `t_mdl1_resume_kabkota` RES ON RES.`aspekid` = A.id AND RES.mapid ='$nilai'
         LEFT JOIN(
                 SELECT I.`id` iditem,II.`skor`
                 FROM `t_mdl1_skor_kabkota` SK
                 JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                 JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                 WHERE SK.`mapid`='$nilai'
         ) SKOR ON SKOR.iditem=IT.`id`
         ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC";
 
 
         $list_data  = $this->db->query($status_sql);
 
         $nmkriteriaCount = [];
         $nmindiCount = [];
         
         foreach ($list_data->result_array() as $item) {
             $nmkriteria = $item['nmkriteria'];
             if (isset($nmkriteriaCount[$nmkriteria])) {
                 $nmkriteriaCount[$nmkriteria]++;
             } else {
                 $nmkriteriaCount[$nmkriteria] = 1;
             }
             
             $nmindi = $item['nmindi'];
             if (isset($nmindiCount[$nmindi])) {
                 $nmindiCount[$nmindi]++;
             } else {
                 $nmindiCount[$nmindi] = 1;
             }
         }
         //list indikator skor
         $this->load->library("Excel");
 
         $sharedStyleTitles = new PHPExcel_Style();
 
         $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
         $this->excel->getSheet(0)->setTitle('Rekap Nilai');
 
         $this->excel->getActiveSheet()->getStyle('B115')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_TOP);
         $this->excel->getActiveSheet()->getStyle('B120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
 
         //garis
         $sharedStyleTitles->applyFromArray(
             array(
                 'borders' =>
                 array(
                     'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                     'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                     'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                     'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                 )
             )
         );
 
         $headerRow = 10;
 
         $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2024");
         $this->excel->getActiveSheet()->mergeCells('A1:K1');
         $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->setCellValue('A2', "Kriteria dan Indikator Penilaian Dokumen RKPD");
        
         $this->excel->getActiveSheet()->mergeCells('A2:K2');
 
         $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
         $this->excel->getActiveSheet()->mergeCells('A4:B4');
         $this->excel->getActiveSheet()->setCellValue('C4', ":");
         $this->excel->getActiveSheet()->setCellValue('A5', "Daerah Yang Dinilai ");
         $this->excel->getActiveSheet()->mergeCells('A5:B5');
         $this->excel->getActiveSheet()->setCellValue('C5', ":");
         $this->excel->getActiveSheet()->setCellValue('D4', "$nama");
         $this->excel->getActiveSheet()->setCellValue('D5', "$namakab");
         $this->excel->getActiveSheet()->mergeCells('A2:B2');
         $this->excel->getActiveSheet()->mergeCells('A3:B3');
 
         $this->excel->getActiveSheet()->setCellValue("A10", "NO");
         $this->excel->getActiveSheet()->mergeCells('A10:A11');
         $this->excel->getActiveSheet()->setCellValue("B10", "KRITERIA");
         $this->excel->getActiveSheet()->mergeCells('B10:B11');
 
         $this->excel->getActiveSheet()->setCellValue("C10", "INDIKATOR");
         $this->excel->getActiveSheet()->mergeCells('C10:D11');
         $this->excel->getActiveSheet()->setCellValue("E10", "ITEM");
         $this->excel->getActiveSheet()->mergeCells('E10:F11');
         $this->excel->getActiveSheet()->setCellValue("G10", "NILAI");
         $this->excel->getActiveSheet()->mergeCells('G10:G11');
         $this->excel->getActiveSheet()->setCellValue("H10", "KEUNGGULAN DAERAH");
         $this->excel->getActiveSheet()->mergeCells('H10:H11');
         $this->excel->getActiveSheet()->setCellValue("I10", "REKOMENDASI");
         $this->excel->getActiveSheet()->mergeCells('I10:I11');
         $this->excel->getActiveSheet()->setCellValue("J10", "SKOR");
         $this->excel->getActiveSheet()->mergeCells('J10:J11');
         $this->excel->getActiveSheet()->setCellValue("K10", "BOBOT");
         $this->excel->getActiveSheet()->mergeCells('K10:K11');
         $this->excel->getActiveSheet()->setCellValue("L10", "NILAI TERBOBOT");
         $this->excel->getActiveSheet()->mergeCells('L10:L11');
         $this->excel->getActiveSheet()->getStyle('A10:L11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
     
         
         $inisialRow = 12;
         $startRow = 12; // Starting row for merging
         $excel = $this->excel->getActiveSheet(); // Get the active sheet
         
         foreach ($nmkriteriaCount as $criteria => $count) {
             $endRow = $startRow + $count - 1;
             $excel->mergeCells("A{$startRow}:A{$endRow}"); 
             $excel->mergeCells("B{$startRow}:B{$endRow}"); 
             $excel->mergeCells("H{$startRow}:H{$endRow}"); 
             $excel->mergeCells("I{$startRow}:I{$endRow}"); 
             $startRow = $endRow + 1; 
         }
         
 
         $excelColumn = range('A', 'ZZ');
         $index_excelColumn = 0;
         $row = 12;
         $nol = '';
         $initial_nmindi = '';
         foreach ($list_data->result() as $value) {
            if ($value->nmindi != $initial_nmindi) {
                $no_itemPerIndikator = 1;
                $initial_nmindi = $value->nmindi;
            }
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no_itemPerIndikator);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skor);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran);
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, '');
             $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot / 100);
             $index_excelColumn = 0;
             $no_itemPerIndikator++;
             $row++;
         }
         
         $startRowIndikator = 12; // Starting rowIndkator for merging
         $excel = $this->excel->getActiveSheet(); // Get the active sheet
         foreach ($nmindiCount as $indikator => $count) {
             $endRowIndkator = $startRowIndikator + $count - 1;
             $excel->mergeCells("C{$startRowIndikator}:C{$endRowIndkator}"); 
             $excel->mergeCells("D{$startRowIndikator}:D{$endRowIndkator}"); 
             $excel->mergeCells("J{$startRowIndikator}:J{$endRowIndkator}"); 
             $excel->setCellValue("J{$startRowIndikator}", "=10*SUM(G{$startRowIndikator}:G{$endRowIndkator})/COUNT(E{$startRowIndikator}:E{$endRowIndkator})");
             $excel->mergeCells("K{$startRowIndikator}:K{$endRowIndkator}"); 
             $excel->mergeCells("L{$startRowIndikator}:L{$endRowIndkator}"); 
             $excel->setCellValue("L{$startRowIndikator}", "=J{$startRowIndikator}*K{$startRowIndikator}");
 
             $startRowIndikator = $endRowIndkator + 1; 
         }
         
         //lebar kolom
         $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
         $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
         $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
         $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("55");
         $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
         $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("80");
         $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("10");
         $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("57");
         $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("57");
         $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth("20");
         
         $endnilai = $startRowIndikator-1;
         $endbottomrow = $startRowIndikator;
         
         $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, "A{$headerRow}:L{$endbottomrow}");
 
         $this->excel->getActiveSheet()->getStyle("L{$inisialRow}:L{$endnilai}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
         $this->excel->getActiveSheet()->getStyle("J{$inisialRow}:J{$endnilai}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
         
         $this->excel->getActiveSheet()->setCellValue("A{$endbottomrow}", "TOTAL");
         $this->excel->getActiveSheet()->mergeCells("A{$endbottomrow}:K{$endbottomrow}");
         $this->excel->getActiveSheet()->setCellValue("L{$endbottomrow}", "=SUM(L{$inisialRow}:L{$endnilai})");
         $this->excel->getActiveSheet()->getStyle("L{$endbottomrow}:L{$endbottomrow}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
 
         $this->excel->getActiveSheet()->getStyle("G{$inisialRow}:G{$startRowIndikator}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle("J{$inisialRow}:L{$startRowIndikator}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle("D{$inisialRow}:I{$startRowIndikator}")->getAlignment()->setWrapText(true);
         $this->excel->getActiveSheet()->getStyle("A{$endbottomrow}:L{$endbottomrow}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         
         $this->excel->getActiveSheet()->getStyle("A{$inisialRow}:A{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("B{$inisialRow}:B{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("C{$inisialRow}:C{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("D{$inisialRow}:D{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("E{$inisialRow}:E{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("H{$inisialRow}:H{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("I{$inisialRow}:I{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("J{$inisialRow}:J{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("K{$inisialRow}:K{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         $this->excel->getActiveSheet()->getStyle("l{$inisialRow}:l{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
 
         //font
         $this->excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setName('CMIIW');
         $this->excel->getActiveSheet()->getStyle('A10:A11')->getFont()->setName('CMIIW');
         //$this->excel->getActiveSheet()->getStyle('A203')->getFont()->setName('CMIIW');
         //bolt
         $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle("A{$endbottomrow}:L{$endbottomrow}")->getFont()->setBold(true);
         //size    
         $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setSize(12);
         $this->excel->getActiveSheet()->getStyle("A{$endbottomrow}")->getFont()->setSize(18);
         $this->excel->getActiveSheet()->getStyle("L{$endbottomrow}")->getFont()->setSize(18);
 
 
 
         $this->excel->getActiveSheet()->setShowGridlines(False);
         //                $this->excel->getActiveSheet()->getStyle('D12:D181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
         //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
         $this->excel->getActiveSheet()->getProtection()->setSheet(true);
         $this->excel->getActiveSheet()->getProtection()->setSort(true);
         $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
         $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
         $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');
 
         header("Content-Type:application/vnd.ms-excel");
         header("Content-Disposition:attachment;filename = Modul1_" . $user_d . "_" . $namakab . ".xls");
         header("Cache-Control:max-age=0");
         $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
         $objWriter->save("php://output");
    }
    function Download_nilai1()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            echo "Session expired, silakan login";
        }
        $user = $this->session->userdata(SESSION_LOGIN)->id;

        $idcomb = decrypt_base64($_GET['timid']);
        $tmp = explode('-', $idcomb);
        if (count($tmp) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp[0];
        $user = $tmp[1];

        $provcomb = decrypt_base64($_GET['provid']);
        $tmp2 = explode('_', $provcomb);
        if (count($tmp2) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp2[0];
        $idwil = $tmp2[1];

        //select tim penilai
        $select_u = "SELECT W.* FROM `tbl_user` W WHERE W.id='$user' ";
        $list_u  = $this->db->query($select_u);
        foreach ($list_u->result() as $u) {
            $nama = $u->name;
        }

        //$user
        $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid "
            . "FROM `tbl_user_kabkot` W "
            . "JOIN `kabupaten` P ON W.idkabkot = P.id "
            . "JOIN `tbl_user` U ON W.iduser = U.id "
            . "WHERE W.iduser='$user' AND W.idkabkot='$idwil'";
        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nilai = $d->id;
            $user_d = $d->userid;
            $namakab = $d->nama_kabupaten;
        }
        //list indikator skor
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Nilai ');

        $this->excel->getActiveSheet()->getStyle('B115')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2021");
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A2', "Kriteria dan Indikator Penilaian Dokumen RKPD");
        $this->excel->getActiveSheet()->mergeCells('A2:K2');
        //                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:L166');
        $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
        $this->excel->getActiveSheet()->mergeCells('A4:B4');
        $this->excel->getActiveSheet()->setCellValue('C4', ":");
        $this->excel->getActiveSheet()->setCellValue('A5', "Daerah Yang Dinilai ");
        $this->excel->getActiveSheet()->mergeCells('A5:B5');
        $this->excel->getActiveSheet()->setCellValue('C5', ":");
        $this->excel->getActiveSheet()->setCellValue('D4', "$nama");
        $this->excel->getActiveSheet()->setCellValue('D5', "$namakab");
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A2:B2');
        $this->excel->getActiveSheet()->mergeCells('A3:B3');

        //                
        $this->excel->getActiveSheet()->setCellValue("A10", "NO");
        $this->excel->getActiveSheet()->mergeCells('A10:A11');
        $this->excel->getActiveSheet()->setCellValue("B10", "KRITERIA");
        $this->excel->getActiveSheet()->mergeCells('B10:B11');
        $this->excel->getActiveSheet()->setCellValue("C10", "INDIKATOR");
        $this->excel->getActiveSheet()->mergeCells('C10:D11');
        $this->excel->getActiveSheet()->setCellValue("E10", "ITEM");
        $this->excel->getActiveSheet()->mergeCells('E10:F11');
        $this->excel->getActiveSheet()->setCellValue("G10", "NILAI");
        $this->excel->getActiveSheet()->mergeCells('G10:G11');
        $this->excel->getActiveSheet()->setCellValue("H10", "CATATAN");
        $this->excel->getActiveSheet()->mergeCells('H10:H11');
        $this->excel->getActiveSheet()->setCellValue("I10", "MASUKAN DAN SARAN");
        $this->excel->getActiveSheet()->mergeCells('I10:I11');
        $this->excel->getActiveSheet()->setCellValue("J10", "SKOR");
        $this->excel->getActiveSheet()->mergeCells('J10:J11');
        $this->excel->getActiveSheet()->setCellValue("K10", "BOBOT");
        $this->excel->getActiveSheet()->mergeCells('K10:K11');
        $this->excel->getActiveSheet()->setCellValue("L10", "NILAI TERBOBOT");
        $this->excel->getActiveSheet()->mergeCells('L10:L11');
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue("A166", "TOTAL");

        $this->excel->getActiveSheet()->getStyle('A166:L166')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A10:L10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->mergeCells('A12:A74');
        $this->excel->getActiveSheet()->mergeCells('A75:A85');
        $this->excel->getActiveSheet()->mergeCells('A86:A103');
        $this->excel->getActiveSheet()->mergeCells('A104:A140');
        $this->excel->getActiveSheet()->mergeCells('A141:A165');

        $this->excel->getActiveSheet()->mergeCells('B12:B74');
        $this->excel->getActiveSheet()->mergeCells('B75:B85');
        $this->excel->getActiveSheet()->mergeCells('B86:B103');
        $this->excel->getActiveSheet()->mergeCells('B104:B140');
        $this->excel->getActiveSheet()->mergeCells('B141:B165');

        $this->excel->getActiveSheet()->mergeCells('C12:C20');
        $this->excel->getActiveSheet()->mergeCells('C21:C27');
        $this->excel->getActiveSheet()->mergeCells('C28:C38');
        $this->excel->getActiveSheet()->mergeCells('C39:C53');
        $this->excel->getActiveSheet()->mergeCells('C54:C57');
        $this->excel->getActiveSheet()->mergeCells('C58:C67');
        $this->excel->getActiveSheet()->mergeCells('C68:C74');
        $this->excel->getActiveSheet()->mergeCells('C75:C79');
        $this->excel->getActiveSheet()->mergeCells('C80:C85');
        $this->excel->getActiveSheet()->mergeCells('C86:C91');
        $this->excel->getActiveSheet()->mergeCells('C92:C94');
        $this->excel->getActiveSheet()->mergeCells('C95:C100');
        $this->excel->getActiveSheet()->mergeCells('C101:C103');
        $this->excel->getActiveSheet()->mergeCells('C104:C108');
        $this->excel->getActiveSheet()->mergeCells('C109:C112');
        $this->excel->getActiveSheet()->mergeCells('C113:C115');
        $this->excel->getActiveSheet()->mergeCells('C116:C120');
        $this->excel->getActiveSheet()->mergeCells('C121:C123');
        $this->excel->getActiveSheet()->mergeCells('C124:C126');
        $this->excel->getActiveSheet()->mergeCells('C127:C129');
        $this->excel->getActiveSheet()->mergeCells('C130:C135');
        $this->excel->getActiveSheet()->mergeCells('C136:C140');
        $this->excel->getActiveSheet()->mergeCells('C141:C149');
        $this->excel->getActiveSheet()->mergeCells('C150:C165');

        $this->excel->getActiveSheet()->mergeCells('D12:D20');
        $this->excel->getActiveSheet()->mergeCells('D21:D27');
        $this->excel->getActiveSheet()->mergeCells('D28:D38');
        $this->excel->getActiveSheet()->mergeCells('D39:D53');
        $this->excel->getActiveSheet()->mergeCells('D54:D57');
        $this->excel->getActiveSheet()->mergeCells('D58:D67');
        $this->excel->getActiveSheet()->mergeCells('D68:D74');
        $this->excel->getActiveSheet()->mergeCells('D75:D79');
        $this->excel->getActiveSheet()->mergeCells('D80:D85');
        $this->excel->getActiveSheet()->mergeCells('D86:D91');
        $this->excel->getActiveSheet()->mergeCells('D92:D94');
        $this->excel->getActiveSheet()->mergeCells('D95:D100');
        $this->excel->getActiveSheet()->mergeCells('D101:D103');
        $this->excel->getActiveSheet()->mergeCells('D104:D108');
        $this->excel->getActiveSheet()->mergeCells('D109:D112');
        $this->excel->getActiveSheet()->mergeCells('D113:D115');
        $this->excel->getActiveSheet()->mergeCells('D116:D120');
        $this->excel->getActiveSheet()->mergeCells('D121:D123');
        $this->excel->getActiveSheet()->mergeCells('D124:D126');
        $this->excel->getActiveSheet()->mergeCells('D127:D129');
        $this->excel->getActiveSheet()->mergeCells('D130:D135');
        $this->excel->getActiveSheet()->mergeCells('D136:D140');
        $this->excel->getActiveSheet()->mergeCells('D141:D149');
        $this->excel->getActiveSheet()->mergeCells('D150:D165');

        $this->excel->getActiveSheet()->mergeCells('H12:H74');
        $this->excel->getActiveSheet()->mergeCells('H75:H140');
        $this->excel->getActiveSheet()->mergeCells('H141:H165');

        $this->excel->getActiveSheet()->mergeCells('I12:I74');
        $this->excel->getActiveSheet()->mergeCells('I75:I140');
        $this->excel->getActiveSheet()->mergeCells('I141:I165');

        $this->excel->getActiveSheet()->mergeCells('A166:k166');

        $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
                            FROM `r_mdl1_item` IT
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT')
                            JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                            JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                            JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                            LEFT JOIN `t_mdl1_resume_kabkota` RES ON RES.`aspekid` = A.id AND RES.mapid ='$nilai'
                            LEFT JOIN(
                                    SELECT I.`id` iditem,II.`skor`
                                    FROM `t_mdl1_skor_kabkota` SK
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    WHERE SK.`mapid`='$nilai'
                            ) SKOR ON SKOR.iditem=IT.`id`
                ORDER BY IND.`nourut`,IT.subindiid, IT.`nourut`";


        $list_data  = $this->db->query($status_sql);
        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 12;
        $nol = '';
        foreach ($list_data->result() as $value) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skor);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, '');
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot / 100);
            //                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nmitem);
            //                    
            $index_excelColumn = 0;
            $row++;
        }

        $this->excel->getActiveSheet()->mergeCells('J12:J20');
        $this->excel->getActiveSheet()->setCellValue("J12", "=10*SUM(G12:G20)/COUNT(E12:E20))");
        $this->excel->getActiveSheet()->mergeCells('J21:J27');
        $this->excel->getActiveSheet()->setCellValue("J21", "=10*SUM(G21:G27)/COUNT(E21:E27))");
        $this->excel->getActiveSheet()->mergeCells('J28:J38');
        $this->excel->getActiveSheet()->setCellValue("J28", "=10*SUM(G28:G38)/COUNT(E28:E38))");
        $this->excel->getActiveSheet()->mergeCells('J39:J53');
        $this->excel->getActiveSheet()->setCellValue("J39", "=10*SUM(G39:G53)/COUNT(E39:E53))");
        $this->excel->getActiveSheet()->mergeCells('J54:J57');
        $this->excel->getActiveSheet()->setCellValue("J54", "=10*SUM(G54:G57)/COUNT(E54:E57))");
        $this->excel->getActiveSheet()->mergeCells('J58:J67');
        $this->excel->getActiveSheet()->setCellValue("J58", "=10*SUM(G58:G67)/COUNT(E58:E67))");
        $this->excel->getActiveSheet()->mergeCells('J68:J74');
        $this->excel->getActiveSheet()->setCellValue("J68", "=10*SUM(G68:G74)/COUNT(E68:E74))");
        $this->excel->getActiveSheet()->mergeCells('J75:J79');
        $this->excel->getActiveSheet()->setCellValue("J75", "=10*SUM(G75:G79)/COUNT(E75:E79))");
        $this->excel->getActiveSheet()->mergeCells('J80:J85');
        $this->excel->getActiveSheet()->setCellValue("J80", "=10*SUM(G80:G85)/COUNT(E80:E85))");
        $this->excel->getActiveSheet()->mergeCells('J86:J91');
        $this->excel->getActiveSheet()->setCellValue("J86", "=10*SUM(G86:G91)/COUNT(E86:E91))");
        $this->excel->getActiveSheet()->mergeCells('J92:J94');
        $this->excel->getActiveSheet()->setCellValue("J92", "=10*SUM(G92:G94)/COUNT(E92:E94))");
        $this->excel->getActiveSheet()->mergeCells('J95:J100');
        $this->excel->getActiveSheet()->setCellValue("J95", "=10*SUM(G95:G100)/COUNT(E95:E100))");
        $this->excel->getActiveSheet()->mergeCells('J101:J103');
        $this->excel->getActiveSheet()->setCellValue("J101", "=10*SUM(G101:G103)/COUNT(E101:E103))");
        $this->excel->getActiveSheet()->mergeCells('J104:J108');
        $this->excel->getActiveSheet()->setCellValue("J104", "=10*SUM(G104:G108)/COUNT(E104:E108))");
        $this->excel->getActiveSheet()->mergeCells('J109:J112');
        $this->excel->getActiveSheet()->setCellValue("J109", "=10*SUM(G109:G112)/COUNT(E109:E112))");
        $this->excel->getActiveSheet()->mergeCells('J113:J115');
        $this->excel->getActiveSheet()->setCellValue("J113", "=10*SUM(G113:G115)/COUNT(E113:E115))");
        $this->excel->getActiveSheet()->mergeCells('J116:J120');
        $this->excel->getActiveSheet()->setCellValue("J116", "=10*SUM(G116:G120)/COUNT(E116:E120))");
        $this->excel->getActiveSheet()->mergeCells('J121:J123');
        $this->excel->getActiveSheet()->setCellValue("J121", "=10*SUM(G121:G123)/COUNT(E121:E123))");
        $this->excel->getActiveSheet()->mergeCells('J124:J126');
        $this->excel->getActiveSheet()->setCellValue("J124", "=10*SUM(G124:G126)/COUNT(E124:E126))");
        $this->excel->getActiveSheet()->mergeCells('J127:J129');
        $this->excel->getActiveSheet()->setCellValue("J127", "=10*SUM(G127:G129)/COUNT(E127:E129))");
        $this->excel->getActiveSheet()->mergeCells('J130:J135');
        $this->excel->getActiveSheet()->setCellValue("J130", "=10*SUM(G130:G135)/COUNT(E130:E135))");
        $this->excel->getActiveSheet()->mergeCells('J136:J140');
        $this->excel->getActiveSheet()->setCellValue("J136", "=10*SUM(G136:G140)/COUNT(E136:E140))");
        $this->excel->getActiveSheet()->mergeCells('J141:J149');
        $this->excel->getActiveSheet()->setCellValue("J141", "=10*SUM(G141:G149)/COUNT(E141:E149))");
        $this->excel->getActiveSheet()->mergeCells('J150:J165');
        $this->excel->getActiveSheet()->setCellValue("J150", "=10*SUM(G150:G165)/COUNT(E150:E165))");
        $this->excel->getActiveSheet()->getStyle('J12:J150')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        $this->excel->getActiveSheet()->mergeCells('K12:K20');
        $this->excel->getActiveSheet()->mergeCells('K21:K27');
        $this->excel->getActiveSheet()->mergeCells('K28:K38');
        $this->excel->getActiveSheet()->mergeCells('K39:K53');
        $this->excel->getActiveSheet()->mergeCells('K54:K57');
        $this->excel->getActiveSheet()->mergeCells('K58:K67');
        $this->excel->getActiveSheet()->mergeCells('K68:K74');
        $this->excel->getActiveSheet()->mergeCells('K75:K79');
        $this->excel->getActiveSheet()->mergeCells('K80:K85');
        $this->excel->getActiveSheet()->mergeCells('K86:K91');
        $this->excel->getActiveSheet()->mergeCells('K92:K94');
        $this->excel->getActiveSheet()->mergeCells('K95:K100');
        $this->excel->getActiveSheet()->mergeCells('K101:K103');
        $this->excel->getActiveSheet()->mergeCells('K104:K108');
        $this->excel->getActiveSheet()->mergeCells('K109:K112');
        $this->excel->getActiveSheet()->mergeCells('K113:K115');
        $this->excel->getActiveSheet()->mergeCells('K116:K120');
        $this->excel->getActiveSheet()->mergeCells('K121:K123');
        $this->excel->getActiveSheet()->mergeCells('K124:K126');
        $this->excel->getActiveSheet()->mergeCells('K127:K129');
        $this->excel->getActiveSheet()->mergeCells('K130:K135');
        $this->excel->getActiveSheet()->mergeCells('K136:K140');
        $this->excel->getActiveSheet()->mergeCells('K141:K149');
        $this->excel->getActiveSheet()->mergeCells('K150:K165');

        $this->excel->getActiveSheet()->mergeCells('L12:L20');
        $this->excel->getActiveSheet()->setCellValue("L12", "=J12*K12");
        $this->excel->getActiveSheet()->mergeCells('L21:L27');
        $this->excel->getActiveSheet()->setCellValue("L21", "=J21*K21");
        $this->excel->getActiveSheet()->mergeCells('L28:L38');
        $this->excel->getActiveSheet()->setCellValue("L28", "=J28*K28");
        $this->excel->getActiveSheet()->mergeCells('L39:L53');
        $this->excel->getActiveSheet()->setCellValue("L39", "=J39*K39");
        $this->excel->getActiveSheet()->mergeCells('L54:L57');
        $this->excel->getActiveSheet()->setCellValue("L54", "=J54*K54");
        $this->excel->getActiveSheet()->mergeCells('L58:L67');
        $this->excel->getActiveSheet()->setCellValue("L58", "=J58*K58");
        $this->excel->getActiveSheet()->mergeCells('L68:L74');
        $this->excel->getActiveSheet()->setCellValue("L68", "=J68*K68");
        $this->excel->getActiveSheet()->mergeCells('L75:L79');
        $this->excel->getActiveSheet()->setCellValue("L75", "=J75*K75");
        $this->excel->getActiveSheet()->mergeCells('L80:L85');
        $this->excel->getActiveSheet()->setCellValue("L80", "=J80*K80");
        $this->excel->getActiveSheet()->mergeCells('L86:L91');
        $this->excel->getActiveSheet()->setCellValue("L86", "=J86*K86");
        $this->excel->getActiveSheet()->mergeCells('L92:L94');
        $this->excel->getActiveSheet()->setCellValue("L92", "=J92*K92");
        $this->excel->getActiveSheet()->mergeCells('L95:L100');
        $this->excel->getActiveSheet()->setCellValue("L95", "=J95*K95");
        $this->excel->getActiveSheet()->mergeCells('L101:L103');
        $this->excel->getActiveSheet()->setCellValue("L101", "=J101*K101");
        $this->excel->getActiveSheet()->mergeCells('L104:L108');
        $this->excel->getActiveSheet()->setCellValue("L104", "=J104*K104");
        $this->excel->getActiveSheet()->mergeCells('L109:L112');
        $this->excel->getActiveSheet()->setCellValue("L109", "=J109*K109");
        $this->excel->getActiveSheet()->mergeCells('L113:L115');
        $this->excel->getActiveSheet()->setCellValue("L113", "=J113*K113");
        $this->excel->getActiveSheet()->mergeCells('L116:L120');
        $this->excel->getActiveSheet()->setCellValue("L116", "=J116*K116");
        $this->excel->getActiveSheet()->mergeCells('L121:L123');
        $this->excel->getActiveSheet()->setCellValue("L121", "=J121*K121");
        $this->excel->getActiveSheet()->mergeCells('L124:L126');
        $this->excel->getActiveSheet()->setCellValue("L124", "=J124*K124");
        $this->excel->getActiveSheet()->mergeCells('L127:L129');
        $this->excel->getActiveSheet()->setCellValue("L127", "=J127*K127");
        $this->excel->getActiveSheet()->mergeCells('L130:L135');
        $this->excel->getActiveSheet()->setCellValue("L130", "=J130*K130");
        $this->excel->getActiveSheet()->mergeCells('L136:L140');
        $this->excel->getActiveSheet()->setCellValue("L136", "=J136*K136");
        $this->excel->getActiveSheet()->mergeCells('L141:L149');
        $this->excel->getActiveSheet()->setCellValue("L141", "=J141*K141");
        $this->excel->getActiveSheet()->mergeCells('L150:L165');
        $this->excel->getActiveSheet()->setCellValue("L150", "=J150*K150");
        $this->excel->getActiveSheet()->getStyle('L12:L172')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("39.18");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("62.64");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("19.82");
        $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("30");
        $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("30");
        $this->excel->getActiveSheet()->getColumnDimension("J")->setWidth("15");
        $this->excel->getActiveSheet()->getColumnDimension("k")->setWidth("15");
        $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth("20");

        $this->excel->getActiveSheet()->setCellValue("L166", "=SUM(L12:L165)");
        //                $this->excel->getActiveSheet()->getColumnDimension("F")->setWrapText(true);
        //$this->excel->getActiveSheet()->getStyle('D12:D181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->getStyle('D12:F181' . $this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

        //$this->excel->getActiveSheet()->getStyle('B12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('A12:A167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B12:B167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('C12:C167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('D12:D167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('E12:E167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('H12:H167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('I12:I167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('J12:J167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('K12:K167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('l12:l167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('G10:G165')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('J10:L165')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setShowGridlines(False);

        //                $this->excel->getActiveSheet()->getStyle('D12:D181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
        //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul1_" . $namakab . "_" . $user_d . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_penilaian_tpt_by_user()
    {
        $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
        
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Penilaian Kota');

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue("A1", "NO");
        $this->excel->getActiveSheet()->setCellValue("B1", "USERID");
        $this->excel->getActiveSheet()->setCellValue("C1", "NAMA");
        $this->excel->getActiveSheet()->setCellValue("D1", "NAMA PROVINSI");
        $this->excel->getActiveSheet()->setCellValue("E1", "NAMA KOTA");
        $this->excel->getActiveSheet()->setCellValue("F1", "PERSENTASE PENILAIAN");
        $this->excel->getActiveSheet()->setCellValue("G1", "LEMBAR PERNYATAAN");

        //---------------isi disini--------------------

        $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(I.`id`) FROM r_mdl1_item I JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT') JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y') * 100), 2) AS persentase_penilaian,
                CASE
                    WHEN sttment.id != 'null' THEN 'Sudah upload'
                    ELSE 'Belum upload'
                END AS lembar_pernyataan
                FROM
                (
                    SELECT us.group,us.satker,kabkot.id AS id, kabkot.iduser AS iduser, us.userid AS userid, us.name AS name, kabkot.idkabkot AS idkabkot, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten 
                    FROM `tbl_user_kabkot` kabkot
                    JOIN tbl_user us ON kabkot.iduser = us.id
                    JOIN kabupaten kab ON kabkot.idkabkot = kab.id
                    JOIN provinsi prov ON kab.prov_id = prov.id_kode
                ) t1
                LEFT JOIN t_mdl1_skor_kabkota skor ON t1.id = skor.mapid
                LEFT JOIN t_mdl1_sttment_kabkota sttment ON t1.id = sttment.mapid
                WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt') AND t1.nama_kabupaten LIKE 'Kota %' AND t1.group=7 AND t1.satker=$satkercode
                GROUP BY t1.id
                ORDER BY t1.userid, t1.nama_provinsi";
        $list_data = $this->db->query($sql);
        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        //---------end isi disini----------------------

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 2;
        $no = 1;
        foreach ($list_data->result() as $list) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->userid);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->name);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_provinsi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_kabupaten);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->persentase_penilaian);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->lembar_pernyataan);
            $index_excelColumn = 0;
            $no++;
            $row++;
        }

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("27");
        //font
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_peniaian_kota_tpt_by_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_resume_tpt_by_user()
    {
        $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
        
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Resume User');

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue("A1", "NO");
        $this->excel->getActiveSheet()->setCellValue("B1", "USERID");
        $this->excel->getActiveSheet()->setCellValue("C1", "NAMA");
        $this->excel->getActiveSheet()->setCellValue("D1", "NAMA PROVINSI");
        $this->excel->getActiveSheet()->setCellValue("E1", "ASPEK");
        $this->excel->getActiveSheet()->setCellValue("F1", "KESIMPULAN");
        $this->excel->getActiveSheet()->setCellValue("G1", "SARAN");

        //---------------isi disini--------------------

        $sql = "SELECT user.userid AS iduser, user.name AS nama_user, resume_kabkota.mapid AS mapid, wil.idkabkot AS idkabkot, kab.id AS idkabupaten, kab.nama_kabupaten AS nama_kabupaten, aspek.id AS idaspek, aspek.nama AS nama_aspek, resume_kabkota.ksmplan AS kesimpulan, resume_kabkota.saran AS saran
                FROM t_mdl1_resume_kabkota resume_kabkota
                JOIN tbl_user_kabkot wil ON resume_kabkota.mapid = wil.id
                JOIN tbl_user user ON wil.iduser = user.id
                JOIN r_mdl1_aspek aspek ON resume_kabkota.aspekid = aspek.id
                JOIN kabupaten kab ON wil.idkabkot = kab.id
                WHERE kab.nama_kabupaten LIKE 'Kota %' AND user.group=7 AND user.satker=$satkercode
                ORDER BY iduser, mapid ASC";
        $list_data = $this->db->query($sql);
        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        //---------end isi disini----------------------

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 2;
        $no = 1;
        foreach ($list_data->result() as $list) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->iduser);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_user);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_kabupaten);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_aspek);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->kesimpulan);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->saran);
            $index_excelColumn = 0;
            $no++;
            $row++;
        }

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("27");
        //font
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_resume_tpt_by_user_kota.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_penilaian_daerah_by_tpt()
    {
        $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
        
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Penilaian Kota');

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue("A1", "NO");
        $this->excel->getActiveSheet()->setCellValue("B1", "DAERAH");
        $this->excel->getActiveSheet()->setCellValue("C1", "JUMLAH PENILAI YANG BELUM MENILAI");
        $this->excel->getActiveSheet()->setCellValue("D1", "JUMLAH PENILAI");

        //---------------isi disini--------------------

        $sql = "SELECT A.idkabkot idkab, B.nama_kabupaten, COUNT(CASE WHEN JML.jml IS NULL THEN 1 END) AS jumlah_penilai_yang_belum_menilai, COUNT(A.idkabkot) AS jumlah_penilai
                FROM tbl_user_kabkot A
                            JOIN `kabupaten` B ON B.`id`=A.`idkabkot` 
                            JOIN `tbl_user` C ON C.id = A.iduser AND C.group=7
                            LEFT JOIN(
                                        SELECT W.`idkabkot` idkab,COUNT(1) jml,W.iduser
                                        FROM `tbl_user_kabkot` W
                                        JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                        JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                        JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT')
                                        JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                        WHERE 1=1
                                        GROUP BY W.`idkabkot`,W.iduser
                                    ) JML ON JML.idkab=A.`idkabkot` AND JML.`iduser` = A.iduser
                                LEFT JOIN(
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml,W.iduser
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE 1=1
                                    GROUP BY W.`idkabkot`,W.`iduser`
                                ) RS ON RS.idkab=A.`idkabkot` AND RS.`iduser`=A.iduser      
                            LEFT JOIN t_mdl1_sttment_kabkota ST ON ST.mapid=A.id 
                    WHERE C.name NOT IN('testtpt', 'testtpt2', 'Dit PEPPD') AND B.`urutan`=1 AND C.satker=$satkercode
                    GROUP BY B.nama_kabupaten
                    ORDER BY idkab ASC";
        $list_data = $this->db->query($sql);
        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        //---------end isi disini----------------------

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 2;
        $no = 1;
        $count_jumlah_daerah_yang_belum_dinilai = 0;
        $count_jumlah_daerah_yang_belum_dinilai_lebih_dari_3_tpt = 0;
        foreach ($list_data->result() as $list) {
            if ($list->jumlah_penilai_yang_belum_menilai == $list->jumlah_penilai) {
                $count_jumlah_daerah_yang_belum_dinilai = $count_jumlah_daerah_yang_belum_dinilai + 1;
            }

            if ($list->jumlah_penilai_yang_belum_menilai >= 3) {
                $count_jumlah_daerah_yang_belum_dinilai_lebih_dari_3_tpt = $count_jumlah_daerah_yang_belum_dinilai_lebih_dari_3_tpt + 1;
            }

            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_kabupaten);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->jumlah_penilai_yang_belum_menilai);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->jumlah_penilai);
            $index_excelColumn = 0;
            $no++;
            $row++;
        }

        $row_belum_dinilai = $row + 1;
        $row_belum_dinilai_oleh_tpt_kurang_dari_3 = $row + 2;
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn + 1] . $row_belum_dinilai, 'Kota Yang Belum dinilai sama sekali');
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn + 2] . $row_belum_dinilai, $count_jumlah_daerah_yang_belum_dinilai);
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn + 1] . $row_belum_dinilai_oleh_tpt_kurang_dari_3, 'Kota yang Belum dinilai lebih dari 3 Tim Penilai');
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn + 2] . $row_belum_dinilai_oleh_tpt_kurang_dari_3, $count_jumlah_daerah_yang_belum_dinilai_lebih_dari_3_tpt);

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("27");
        //font
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_peniaian_kota_tpt_by_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
