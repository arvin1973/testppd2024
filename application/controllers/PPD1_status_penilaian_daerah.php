<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD1_status_penilaian_daerah extends CI_Controller
{
    var $view_dir   = "ppd1/statuspenilaian_daerah/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd1/statuspenilaian_daerah/statuspenilaian_daerah.js";
    var $allowed    = array("PPD1");
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
                $this->js_path    = "assets/js/ppd1/statuspenilaian_daerah/statuspenilaian_daerah.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_daerah", $data_page, TRUE);

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

    function get_datatable_prov()
    {
        if ($this->input->is_ajax_request()) {
            try {
                $requestData = $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array(
                    $idx++   => 'K.`id_kode`',
                    $idx++   => 'K.`id`',
                    $idx++   => 'K.`nama_provinsi`',
                );

                $sql = "SELECT K.id mapid,K.id_kode, K.nama_provinsi
                        FROM `provinsi` K 
                        WHERE K.id !='-1'";

                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " AND ( "
                        . " K.`nama_provinsi` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR K.`id_kode` LIKE '%" . $requestData['search']['value'] . "%' "
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
                    $idkab = "prov_" . $row->mapid;

                    $encrypted_id = base64_encode(openssl_encrypt($idkab, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getkabkot' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-nmkk='" . $row->nama_provinsi . "'";
                    $id_kode = $row->id_kode;
                    if ($row->id_kode == '-1')
                        $id_kode = '';

                    $nestedData[] = $id_kode;
                    $nestedData[] = "<a href='javascript:void(0)' " . $tmp . ">" . $row->nama_provinsi . "</a>";
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

    function g_nilai_berdasarkan_penilai()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $idcomb = decrypt_base64($this->input->get("id"));


                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];

                //---------------isi disini--------------------
                $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(I.`id`) FROM r_mdl1_item I JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB') JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y') * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT us.group,kabkot.id AS id, kabkot.iduser AS iduser, us.userid AS userid, us.name AS name, kabkot.idkabkot AS idkabkot, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten 
                            FROM `tbl_user_kabkot` kabkot
                            JOIN tbl_user us ON kabkot.iduser = us.id
                            JOIN kabupaten kab ON kabkot.idkabkot = kab.id
                            JOIN provinsi prov ON kab.prov_id = prov.id_kode
                            WHERE prov.id=$idmap
                        ) t1
                        LEFT JOIN t_mdl1_skor_kabkota skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_kabkota sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt') AND t1.group=7
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

    function get_datatable()
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

                $idcomb = decrypt_base64($this->input->post("id"));

                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];


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
                    JOIN `provinsi` P ON P.id_kode= C.prov_id
                    WHERE B.group=7 AND B.active_flag ='Y' AND P.id=?
                    GROUP BY C.id ";

                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";
                               
                $i = 1;
                foreach ($list_data->result() as $row) {
                    $id      = $row->mapid;
                    $idkab = "kab_" . $row->mapid;

                    $encrypted_id = base64_encode(openssl_encrypt($idkab, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-nmkk='" . $row->nama_kabupaten . "'";

                    $str.="<tr title='Dokumen'>";
                    $str .= "<td>".$row->id_kab."</td>";
                    $str .= "<td><a href='javascript:void(0)' " . $tmp . ">" . $row->nama_kabupaten . "</a></td>";
                    $str.="</tr'>";
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
                echo $exc->getTraceAsString();
            }
        } else
            die;
    }
    function get_datatable1()
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
                    WHERE B.group=7 AND B.active_flag ='Y' AND C.urutan='0'
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
                    $idkab = "kab_" . $row->mapid;

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
                $sql = "SELECT A.`id`
                        FROM r_mdl1_aspek A 
                        WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $jml_aspek = $list_data->num_rows();

                $str = "";

                if ($kate_wlyh == "kab") {
                    //get jml item
                    $sql = "SELECT I.`id`
                            FROM r_mdl1_item I 
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB')
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
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB','KOTA')
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
								WHERE A.`idkabkot`=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    
                    $kab_id = base64_encode(openssl_encrypt($idmap, "AES-128-ECB", ENCRYPT_PASS));
                    
                    $btn = "<a href='#' data-pr='$kab_id' id='downAll' class='btn btn-primary waves-effect waves-light' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;'>Unduh Semua<i class='fas fa-download' style='padding-left: 5px;'></i></a>";
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
                    "btn"       => $btn,
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
        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB')
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
            $index_excelColumn = 0;
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
    function downloadAllNilai()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }

        $idwil    = decrypt_base64($_GET['kabid']);
        
        //$user
        $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid,U.name "
        . "FROM `tbl_user_kabkot` W "
        . "JOIN `kabupaten` P ON W.idkabkot = P.id "
        . "JOIN `tbl_user` U ON W.iduser = U.id "
        . "WHERE W.idkabkot='$idwil' AND U.id!=674";

        $list_data  = $this->db->query($select);
        
        $this->load->library("Excel");
        $this->excel->setActiveSheetIndex(0);
        foreach ($list_data->result() as $index => $d) {
            $nilai = $d->id;
            $name = $d->name;
            $user_d = $d->userid;
            $namakab = $d->nama_kabupaten;

            $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
                        FROM `r_mdl1_item` IT
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB')
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
                    
            $query_results  = $this->db->query($status_sql);

            $nmkriteriaCount = [];
            $nmindiCount = [];
            $result = [];
            
            foreach ($query_results->result_array() as $item) {
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

                $noindi = $item['noindi'];
                $exists = false;
                foreach ($result as $entry) {
                    if ($entry['nmindi'] === $nmindi) {
                        $exists = true;
                        break;
                    }
                }

                if (!$exists) {
                    $result[] = [
                        'nmkriteria' => $nmkriteria,
                        'nmindi' => $nmindi,
                        'noindi' => $noindi,
                    ];
                }
            }
        
            if ($index > 0) {
                $this->excel->createSheet(); 
            }

            $namasheet = 'Rekap Penilai '. ($index+1);
            $allSheet[]= $namasheet;
            $sharedStyleTitles = new PHPExcel_Style();

            
            $this->excel->setActiveSheetIndex($index);
            $this->excel->getActiveSheet()->setTitle("$namasheet");

            $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);

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
            $this->excel->getActiveSheet()->setCellValue('D4', "$name");
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
            foreach ($query_results->result() as $value) {
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
                $index_excelColumn = 0;
                $row++;
            }
            
            $startRowIndikator = 12; // Starting rowIndkator for merging
            $excel = $this->excel->getActiveSheet(); // Get the active sheet
            $nnilai=[];
            foreach ($nmindiCount as $indikator => $count) {
                $endRowIndkator = $startRowIndikator + $count - 1;
                $excel->mergeCells("C{$startRowIndikator}:C{$endRowIndkator}"); 
                $excel->mergeCells("D{$startRowIndikator}:D{$endRowIndkator}"); 
                $excel->mergeCells("J{$startRowIndikator}:J{$endRowIndkator}"); 
                $excel->setCellValue("J{$startRowIndikator}", "=10*SUM(G{$startRowIndikator}:G{$endRowIndkator})/COUNT(E{$startRowIndikator}:E{$endRowIndkator})");
                $excel->mergeCells("K{$startRowIndikator}:K{$endRowIndkator}"); 
                $excel->mergeCells("L{$startRowIndikator}:L{$endRowIndkator}"); 
                $excel->setCellValue("L{$startRowIndikator}", "=J{$startRowIndikator}*K{$startRowIndikator}");
                $nnilai[] = "L{$startRowIndikator}";
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
            
            $this->excel->getActiveSheet()->mergeCells("A{$endbottomrow}:K{$endbottomrow}");
            $this->excel->getActiveSheet()->setCellValue("A{$endbottomrow}", "TOTAL");
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
            $this->excel->getActiveSheet()->getProtection()->setSheet(true);
            $this->excel->getActiveSheet()->getProtection()->setSort(true);
            $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
            $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
            $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');
        }
        
        $this->excel->createSheet();
        $this->excel->setActiveSheetIndex($index+1);
        $this->excel->getActiveSheet()->setTitle("Rekap Nilai");

        $this->excel->getActiveSheet()->setCellValue('A1', "PENILAIAN TAHAP I PENGHARGAAN PEMBANGUNAN DAERAH TAHUN 2024");
        
        
        $this->excel->getActiveSheet()->setCellValue('A3', "Provinsi/Kabupaten/Kota");
        $this->excel->getActiveSheet()->setCellValue('B3', ":");
        $this->excel->getActiveSheet()->setCellValue('C3', $namakab);
        $totalsheet=5;
        
        $totalsheet = count($allSheet);
        
        
        $startColumn = 3; // Column C
        $mergePenilai = $startColumn + $totalsheet - 1; 
        $columnAverage = $mergePenilai+1;

        // Convert column numbers to letters
        function columnLetter($column) {
            return chr($column + 64); // 1-based to ASCII
        }
        
        $mergePenilaiLetter = columnLetter($mergePenilai);
        $columnAverageLetter = columnLetter($columnAverage);

        $this->excel->getActiveSheet()->mergeCells("A1:{$columnAverageLetter}1");
        
        $this->excel->getActiveSheet()->setCellValue("A5", "Kriteria");
        $this->excel->getActiveSheet()->mergeCells('A5:A6');
        $this->excel->getActiveSheet()->setCellValue("B5", "Indikator");
        $this->excel->getActiveSheet()->mergeCells('B5:B6');
        $this->excel->getActiveSheet()->setCellValue("C5", "Nama Penilai");
        $this->excel->getActiveSheet()->mergeCells("C5:{$mergePenilaiLetter}5");
        $this->excel->getActiveSheet()->setCellValue("{$columnAverageLetter}5", "Rata-rata Nilai Murni");
        $this->excel->getActiveSheet()->mergeCells("{$columnAverageLetter}5:{$columnAverageLetter}6");
        
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension($columnAverageLetter)->setWidth("22");

        $startRow = 7; // Initialize your starting row
        $lastCriteria = ''; // Keep track of the last criteria

        foreach ($result as $r) {
            if ($r['nmkriteria'] !== $lastCriteria) {
                $this->excel->getActiveSheet()->setCellValue("A{$startRow}", $r['nmkriteria']);
                $lastCriteria = $r['nmkriteria'];
                $mergeStartRow = $startRow;
            }

            $this->excel->getActiveSheet()->setCellValue("B{$startRow}", $r['noindi']);
            $startRow++;
            
            $row= ($startRow-1);
            
            if ($r !== end($result) && $result[array_search($r, $result) + 1]['nmkriteria'] !== $r['nmkriteria']) {
                $this->excel->getActiveSheet()->mergeCells("A{$mergeStartRow}:A{$row}");
            }
        }

        if ($mergeStartRow < $startRow) {
            $this->excel->getActiveSheet()->mergeCells("A{$mergeStartRow}:A{$row}");
        }


        $nnilai_reindexed = array_values($nnilai);
        $nnilai_reindexed = array_combine(range(7, count($nnilai_reindexed) + 6), $nnilai_reindexed); // nilai dari colom 7

        $index_excelColumn = 2; //C
        $row = 6;
        foreach($allSheet as $s){
            $this->excel->getActiveSheet()->getColumnDimension($excelColumn[$index_excelColumn])->setWidth("25");
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, "='$s'!D4"); //nama tim penilai
        }

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 2; // Start from column C
        $keys = array_keys($nnilai_reindexed);
        $firstRow = reset($keys); // Equivalent to array_key_first()
        $lastRow = end($keys); // Equivalent to array_key_last()
        $lastAverage = [];

        foreach ($nnilai_reindexed as $row => $cellRef) {
            $index_excelColumn = 2; // Reset to column C for each row
            $firstAverageColumn = ''; // Initialize for first average position
        
            foreach ($allSheet as $s) {
                // Set the cell value for each sheet
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, "='$s'!$cellRef");
            }
        
            $lastFilledColumn = $index_excelColumn - 1;
            $averageColumn = $excelColumn[$index_excelColumn]; 

            $averageFormula = "=AVERAGE(C$row:".$excelColumn[$lastFilledColumn]."$row)";
            $this->excel->getActiveSheet()->setCellValue($averageColumn.$row, $averageFormula);
        
            $lastAverage[$row] = $averageColumn.$row;
            $index_excelColumn++;
        }
        $allTotal= array();
        for ($i = 2; $i <= $lastFilledColumn; $i++) { //0=A, 1=B, 2=C, 4=D.....
            $sumColumn = $excelColumn[$i]; // Get the column letter
            $sumFormula = "=SUM(".$sumColumn."$firstRow:".$sumColumn."$lastRow)"; // Sum from $firstRow to $lastRow
            $allTotal[] = $sumColumn.($lastRow+1);
            $this->excel->getActiveSheet()->setCellValue($sumColumn.($lastRow + 1), $sumFormula); // Place sum at the bottom
            $lastColumn=$i;
        }
        $firstRange = $allTotal[0];
        $lastRange = $allTotal[count($allTotal)-1];

        $firstElement = reset($lastAverage); // Gets the first element
        $lastElement = end($lastAverage); 
        $firstCoeff = $excelColumn[2].($lastRow+1); // Column C
        $lastCoeff = $excelColumn[$lastColumn].($lastRow+1); // Column akhir
        $rowTotal= $lastRow+1;
        $rowRange= $lastRow+2;
        $rowCoeff= $lastRow+3;
        $this->excel->getActiveSheet()->setCellValue("A{$rowTotal}", "Total");
        $this->excel->getActiveSheet()->setCellValue("A{$rowRange}", "Range");
        $this->excel->getActiveSheet()->setCellValue("A{$rowCoeff}", "Coeffisien Variasi");
        $this->excel->getActiveSheet()->mergeCells("A{$rowTotal}:B{$rowTotal}");
        $this->excel->getActiveSheet()->mergeCells("A{$rowRange}:{$mergePenilaiLetter}{$rowRange}");
        $this->excel->getActiveSheet()->mergeCells("A{$rowCoeff}:{$mergePenilaiLetter}{$rowCoeff}");
        
        $this->excel->getActiveSheet()->setCellValue($averageColumn.$rowTotal, "=sum({$firstElement}:{$lastElement})");
        $this->excel->getActiveSheet()->setCellValue($averageColumn.$rowRange, "=max({$firstRange}:{$lastRange})-min({$firstRange}:{$lastRange})");
        $this->excel->getActiveSheet()->setCellValue($averageColumn.$rowCoeff, "=stdev.s({$firstCoeff}:{$lastCoeff})/(".$averageColumn.$rowTotal.") * 100");             
        // $this->excel->getActiveSheet()->setCellValue($averageColumn.$rowCoeff, "=STDEV.S({$firstCoeff}:{$lastCoeff})/(".$averageColumn.$rowRange.") * 100");  
        
        
        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, "A5:{$averageColumn}{$rowCoeff}");
        $this->excel->getActiveSheet()->getStyle("C5:{$averageColumn}{$rowCoeff}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle("A5:{$averageColumn}{$rowCoeff}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(60);

        
        $this->excel->getActiveSheet()->setShowGridlines(False);
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');
                
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Rekap_Nilai_". $namakab . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function allrekap()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }

        // $idwil    = decrypt_base64($_GET['kabid']);
        $idwil    = ($_GET['provid']);
        $idcomb = decrypt_base64($idwil);
        $tmp = explode('_', $idcomb);
        if (count($tmp) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp[0];
        $idmap = $tmp[1];
        
        $kabkota = $this->db->query("SELECT K.id FROM `kabupaten` K 
                    JOIN `provinsi` P ON K.prov_id=P.id_kode 
                    WHERE P.id='$idmap'")->result_array();

        $kabkota_ids_string = implode(",", array_column($kabkota, 'id'));
        
        
        $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid,U.name 
        FROM `tbl_user_kabkot` W 
        JOIN `kabupaten` P ON W.idkabkot = P.id 
        JOIN `tbl_user` U ON W.iduser = U.id 
        WHERE W.idkabkot in ($kabkota_ids_string) AND U.id!=674 AND U.group=7";
        $list_data  = $this->db->query($select)->result_array();
        
        $grouped_data = [];

        foreach ($list_data as $entry) {
            $idkabkot = $entry['idkabkot'];
            
            if (!isset($grouped_data[$idkabkot])) {
                $grouped_data[$idkabkot] = [];
            }
            
            $grouped_data[$idkabkot][] = $entry; 
        }

        $key_kolom = '';
        $kolom_nama = '';
        $kolom = '';
        $query_skor = '';

        
        $this->load->library("Excel");
        $this->excel->setActiveSheetIndex(0);
        $sharedStyleTitles = new PHPExcel_Style();
        $this->excel->getActiveSheet()->setTitle("Hasil Penilaian");

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);

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

        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2024");

        $excelColumn = [];

        // Generate Excel column names from A to ZZ
        for ($i = 0; $i < 702; $i++) { // 702 corresponds to 'ZZ'
            if ($i < 26) {
                $excelColumn[] = chr($i + 65); // A-Z
            } else {
                $firstLetter = chr(floor(($i - 26) / 26) + 65); // A-Z for the first character
                $secondLetter = chr(($i - 26) % 26 + 65); // A-Z for the second character
                $excelColumn[] = $firstLetter . $secondLetter; // Combine letters for AA-ZZ
            }
        }

        $rowKab = 3;
        $rowJudul = 4;
        $row = 5;
        $rowawal = 5;
        
        $list_kab = array();
        $penilai = array();
        $nm_penilai = array();
        
        $cell_sum = array();
        $cell_range = array();
        $cell_coeff = array();

        $rekap = array();
        foreach ($grouped_data as $group){
            $nm_penilai = '';
            foreach ($group as $d){
                $namakab = $d['nama_kabupaten'];
                $key_kab = 'C'.$rowKab;
                $list_kab[$key_kab] = $namakab;

                $key_kolom .= $d['userid'];
                $dnama = $d['name'];
                $kolom .= $key_kolom.'.skor '. $key_kolom.', ';
                $nilai = $d['id'];
                $penilai[] = $key_kolom;
                $nm_penilai[] = $dnama;
                $query_skor .=  "LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='$nilai'
                    ) $key_kolom ON $key_kolom.iditem=IT.`id`";
                    $key_kolom='';
                    $kolom_nama='';
            }
            $kolom = rtrim($kolom, ', ');
            $sql = "SELECT K.id NOKRITERIA,K.`nama` KRITERIA,IND.nourut NOINDI,IND.`nama` INDIKATOR,IT.`nourut` NOITEM,IT.`nama` ITEM, IND.bobot BOBOT, $kolom
                        FROM `r_mdl1_item` IT
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT')
                        JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                        JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                        JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                        $query_skor
                        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC";
            $query_skor='';
            $kolom='';
            
            $query_results  = $this->db->query($sql)->result_array(); 

            $countKriteria = array();
            $countIndikator = array();

            foreach ($query_results as $data) {
                if (isset($countKriteria[$data['KRITERIA']])) {
                    $countKriteria[$data['KRITERIA']]++;
                } else {
                    $countKriteria[$data['KRITERIA']] = 1;
                }
                if (isset($countIndikator[$data['INDIKATOR']])) {
                    $countIndikator[$data['INDIKATOR']]++;
                } else {
                    $countIndikator[$data['INDIKATOR']] = 1;
                }
            }
            
            $this->excel->getActiveSheet()->setCellValue('A'.$rowKab, "Nama Kota");
            $this->excel->getActiveSheet()->setCellValue('B'.$rowKab, ":");
            $this->excel->getActiveSheet()->setCellValue('C'.$rowKab, $namakab);

            $list_kab[$key_kab] = $namakab; // Store each namakab in an array at the key

            $cell_skor = array();
            $cell_bobot = array();
            $nm_skor = array();
            $nm_nilai_terbobot = array();
            $nm_skor = '';
            $nm_nilai_terbobot = '';
            $judul= array('No Kriteria','Kriteria','No Indi','Indikator','No Item','Item','Bobot');
            foreach($nm_penilai as $nm){
                $nm_skor[] = 'Skor '.$nm;
                $nm_nilai_terbobot[] = 'Nilai Terbobot '.$nm;
            }
            $merge_judul = array_merge($judul,$nm_penilai,$nm_skor,$nm_nilai_terbobot,array('Rata-Rata'));

            if (!empty($query_results)) {
                // $columnNames = array_keys($query_results[0]);
                $columnNames = $merge_judul;
                $jmlh_penilai =count($nm_penilai);
                $iterasi = 1;
                foreach ($columnNames as $index => $columnName) {
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index] . $rowJudul, $columnName);
                    if($index>=7 && $iterasi <= $jmlh_penilai){
                        $cell_nilai[] = $index; 
                        $cell_skor[] = $index+$jmlh_penilai; 
                        $cell_bobot[] = $index+$jmlh_penilai*2; 
                        $iterasi++;
                    }
                } 
            }
            
            foreach ($countKriteria as $criteria => $count) {
                $endRow = $row + $count - 1;
                $this->excel->getActiveSheet()->mergeCells("A{$row}:A{$endRow}"); 
                $this->excel->getActiveSheet()->mergeCells("B{$row}:B{$endRow}"); 
                $row = $endRow + 1; 
            }

            $averageColumn = end($cell_bobot) + 1;

            $row = $rowawal;
            foreach ($countIndikator as $criteria => $count) {
                $endRow = $row + $count - 1;
                foreach($cell_skor as $c){
                    $knilai = $c-$jmlh_penilai;
                    $ncells = $excelColumn[$knilai].$row.':'.$excelColumn[$knilai].$endRow;
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$c].$row,"=10*sum($ncells)/count($ncells)");
                    $this->excel->getActiveSheet()->mergeCells($excelColumn[$c].$row.':'.$excelColumn[$c].$endRow);
                }

                foreach($cell_bobot as $b)
                {
                    $kskor = $b-$jmlh_penilai;
                    $skor = "G".$row.'*'.$excelColumn[$kskor].$row; 
                    $firstIndex = $cell_bobot[0];
                    $lastIndex = $cell_bobot[count($cell_bobot) - 1];
                    $averageRange = $excelColumn[$firstIndex] . $row . ':' . $excelColumn[$lastIndex] . $row;
                    $average = "AVERAGE(" . $averageRange . ")";

                    $rekap[$key_kab][] = $excelColumn[$averageColumn].$row;
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$b].$row,"=$skor");
                    $this->excel->getActiveSheet()->mergeCells($excelColumn[$b].$row.':'.$excelColumn[$b].$endRow);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$averageColumn].$row,"=$average");
                    $this->excel->getActiveSheet()->mergeCells($excelColumn[$averageColumn].$row.':'.$excelColumn[$averageColumn].$endRow);
                } 

                $this->excel->getActiveSheet()->mergeCells("C{$row}:C{$endRow}"); 
                $this->excel->getActiveSheet()->mergeCells("D{$row}:D{$endRow}"); 
                $this->excel->getActiveSheet()->mergeCells("G{$row}:G{$endRow}"); 
                $row = $endRow + 1; 
            }

            $row = $rowawal;
            $index_excelColumn = 0;
            foreach ($query_results as $value) {
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['NOKRITERIA']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['KRITERIA']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['NOINDI']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['INDIKATOR']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['NOITEM']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['ITEM']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, ($value['BOBOT'] / 100));
                foreach($penilai as $pe)
                {
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value[$pe]);
                }
                $lastIndex = $index_excelColumn;
                $index_excelColumn = 0;
                $row++;
            }
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$lastIndex].$row, "Total");
            $this->excel->getActiveSheet()->mergeCells($excelColumn[$lastIndex].$row.":".$excelColumn[$lastIndex+$jmlh_penilai-1].$row);
            
            $index_excelColumn = $lastIndex+$jmlh_penilai-1;
            $average = $jmlh_penilai+1;
            $cell_rata2 = array();

            for($i=0;$i<$average;$i++)
            {
                $index_excelColumn++;
                $cell_rata2[]=$index_excelColumn;
                $endofrow = $row-1;
                $total = $excelColumn[$index_excelColumn].$rowawal.":".$excelColumn[$index_excelColumn].$endofrow;
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn].$row, "=SUM($total)");
            }
            $cell_sum[] = $excelColumn[$index_excelColumn].$row;
            

            $row++;
            
            $index1 = $cell_rata2[0];
            $index2 = $cell_rata2[count($cell_rata2) - 2];
            
            $range = $lastIndex+$jmlh_penilai*2;
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$lastIndex].$row, "Range");
            $this->excel->getActiveSheet()->mergeCells($excelColumn[$lastIndex].$row.":".$excelColumn[$lastIndex+$jmlh_penilai*2-1].$row);
            
            $valrange = $excelColumn[$index1].($row-1).":".$excelColumn[$index2].($row-1);
            $cellRange = $excelColumn[$range].$row;
            $cell_range[]=$cellRange;
            $this->excel->getActiveSheet()->setCellValue($cellRange, "=MAX($valrange)-MIN($valrange)");
            
            $row++;
            
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$lastIndex].$row, "Coeffisien Variasi");
            $this->excel->getActiveSheet()->mergeCells($excelColumn[$lastIndex].$row.":".$excelColumn[$lastIndex+$jmlh_penilai*2-1].$row);
            
            $firstrange = $valrange = $excelColumn[$index1].($row-2).":".$excelColumn[$index2].($row-2);
            $secondrange = $excelColumn[($index2+1)].($row-2);
            $valcoeff = "=STDEV(".$firstrange.")/".$secondrange."*100";
            $cellCoeff = $excelColumn[$range].$row;
            $cell_coeff[] = $cellCoeff;
            $this->excel->getActiveSheet()->setCellValue($cellCoeff, "$valcoeff");            

            $penilai ='';
            $index_excelColumn ='';

            $rowKab = $row+3;
            $rowJudul = $row+4;
            $row = $row+5;
            $rowawal = $row;
        }           


        $this->excel->createSheet();
        $this->excel->setActiveSheetIndex(1);
        $this->excel->getActiveSheet()->setTitle("Rekap Nilai");

        $row = 3;


        $o=1;
        $indi = count($countIndikator);
        
        $columnIndex = 1;
        for($o;$o<=$indi;$o++){
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].($row-1),"$o");
        }
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].($row-1),"Total Nilai");
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].($row-1),"Range");
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].($row-1),"Koefisien Variasi");

        $i = 0;
        
        foreach($rekap as $key => $val){
            $this->excel->getActiveSheet()->setCellValue("A".$row,"='Hasil Penilaian'!$key");
            
            $value = array_unique($val);
            $value = array_values($value);
            
            $columnIndex = 1;
            foreach ($value as $k){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].$row,"='Hasil Penilaian'!$k");
            }
            
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex].$row,"='Hasil Penilaian'!".$cell_sum[$i]."");
            $this->excel->getActiveSheet()->setCellValue($excelColumn[($columnIndex+1)].$row,"='Hasil Penilaian'!".$cell_range[$i]."");
            $this->excel->getActiveSheet()->setCellValue($excelColumn[($columnIndex+2)].$row,"='Hasil Penilaian'!".$cell_coeff[$i]."");
            
            $i++;
            $row++;
        }
        
        // die;
        
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Rekap_Nilai_Kota.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_penilaian_tpt_by_user($id)
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $idcomb = decrypt_base64($id);
                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
            $idmap = $tmp[1];

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Penilaian Daerah');

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
        $this->excel->getActiveSheet()->setCellValue("E1", "NAMA KABUPATEN");
        $this->excel->getActiveSheet()->setCellValue("F1", "PERSENTASE PENILAIAN");
        $this->excel->getActiveSheet()->setCellValue("G1", "LEMBAR PERNYATAAN");

        //---------------isi disini--------------------

        $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(I.`id`) FROM r_mdl1_item I JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB') JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y') * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT us.group,kabkot.id AS id, kabkot.iduser AS iduser, us.userid AS userid, us.name AS name, kabkot.idkabkot AS idkabkot, prov.nama_provinsi AS nama_provinsi, kab.nama_kabupaten AS nama_kabupaten 
                            FROM `tbl_user_kabkot` kabkot
                            JOIN tbl_user us ON kabkot.iduser = us.id
                            JOIN kabupaten kab ON kabkot.idkabkot = kab.id
                            JOIN provinsi prov ON kab.prov_id = prov.id_kode
                            WHERE prov.id=$idmap
                        ) t1
                        LEFT JOIN t_mdl1_skor_kabkota skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_kabkota sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt') AND t1.group=7
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
        header("Content-Disposition:attachment;filename = rekap_peniaian_tpt_daerah_by_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_penilaian_daerah_by_tpt($id)
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        $idcomb = decrypt_base64($id);
                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
            $idmap = $tmp[1];
        

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Penilaian Daerah');

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
                JOIN `provinsi` prov ON prov.id_kode=B.prov_id
                LEFT JOIN(
                        SELECT W.`idkabkot` idkab,COUNT(1) jml,W.iduser
                        FROM `tbl_user_kabkot` W
                        JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                        JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                        JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB','KOTA')
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
                    WHERE C.name NOT IN('testtpt', 'testtpt2', 'Dit PEPPD') and prov.id=$idmap
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
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn + 1] . $row_belum_dinilai, 'Kabupaten Yang Belum dinilai sama sekali');
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn + 2] . $row_belum_dinilai, $count_jumlah_daerah_yang_belum_dinilai);
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn + 1] . $row_belum_dinilai_oleh_tpt_kurang_dari_3, 'Kabupaten yang Belum dinilai lebih dari 3 Tim Penilai');
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
        header("Content-Disposition:attachment;filename = rekap_peniaian_kabupaten_tpt_by_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_resume_tpt_by_user($id)
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        $idcomb = decrypt_base64($id);
                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
            $idmap = $tmp[1];

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
                JOIN provinsi prov ON prov.id_kode=kab.prov_id
                WHERE prov.id=$idmap  AND user.group=7
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
        header("Content-Disposition:attachment;filename = rekap_resume_tpt_by_user_daerah.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
