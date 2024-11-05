<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD1_status_penilaian_prov extends CI_Controller
{
    var $view_dir   = "ppd1/statuspenilaian/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd1/statuspenilaian/statuspenilaian.js";
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
                $this->js_path    = "assets/js/ppd1/statuspenilaian/statuspenilaian_prov.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_prov", $data_page, TRUE);

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
                session_write_close();

                //---------------isi disini--------------------

                $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(id) FROM r_mdl1_item) * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload'
                            ELSE 'Belum upload'
                        END AS lembar_pernyataan
                        FROM
                        (
                            SELECT wil.id AS id, wil.iduser AS iduser, us.userid AS userid, us.name AS name, wil.idwilayah AS idwilayah, pro.nama_provinsi AS nama_provinsi 
                            FROM `tbl_user_wilayah` wil
                            JOIN tbl_user us ON wil.iduser = us.id
                            JOIN provinsi pro ON wil.idwilayah = pro.id  
                        ) t1
                        LEFT JOIN t_mdl1_skor_prov skor ON t1.id = skor.mapid
                        LEFT JOIN t_mdl1_sttment_prov sttment ON t1.id = sttment.mapid
                        WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')
                        GROUP BY t1.id
                        ORDER BY t1.userid";
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
                    $str .= '<td><center>' . $list->name . '</center></td>';
                    $str .= '<td><center>' . $list->nama_provinsi . '</center></td>';
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

    function g_rekap_penilaian_tim()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                //---------------isi disini--------------------

                $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(id) FROM r_mdl1_item) * 100), 2) AS persentase_penilaian,
                        CASE
                            WHEN sttment.id != 'null' THEN 'Sudah upload lembar pernyataan'
                            ELSE 'Belum upload lembar pernyataan'
                        END AS lembar_pernyataan
                        FROM(
                            SELECT wil.id AS id, wil.iduser AS iduser, us.userid AS userid, us.name AS name, wil.idwilayah AS idwilayah, pro.nama_provinsi AS nama_provinsi 
                            FROM `tbl_user_wilayah` wil
                            JOIN tbl_user us ON wil.iduser = us.id
                            JOIN provinsi pro ON wil.idwilayah = pro.id  
                            ) t1
                            LEFT JOIN t_mdl1_skor_prov skor ON t1.id = skor.mapid
                            LEFT JOIN t_mdl1_sttment_prov sttment ON t1.id = sttment.mapid
                            WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')
                            GROUP BY t1.userid
                            HAVING persentase_penilaian > 0  
                        ORDER BY t1.userid  ASC";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $sql_all_penilai = "SELECT wil.id AS id, wil.iduser AS iduser, us.userid AS userid, us.name AS name, wil.idwilayah AS idwilayah, pro.nama_provinsi AS nama_provinsi, COUNT(wil.iduser) AS jumlah_daerah_yang_dinilai
                                    FROM `tbl_user_wilayah` wil
                                    JOIN tbl_user us ON wil.iduser = us.id
                                    JOIN provinsi pro ON wil.idwilayah = pro.id
                                    WHERE us.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')
                                    GROUP BY us.userid
                                    ORDER BY us.userid ASC";
                $list_data_all_penilai = $this->db->query($sql_all_penilai);

                //---------end isi disini----------------------

                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => count($list_data->result()),
                    "data"      => $list_data->result(),
                    "str_all_penilai"   => count($list_data_all_penilai->result()),
                    "data_all_penilai"  => $list_data_all_penilai->result(),
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
                    $idx++   => 'K.`id_kode`',
                    $idx++   => 'K.`id`',
                    $idx++   => 'K.`nama_provinsi`',
                );

                $sql = "SELECT K.id mapid,K.id_kode, K.nama_provinsi
                        FROM `provinsi` K 
                        WHERE K.id != '-1' ";

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
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
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

                if ($kate_wlyh == "prov") {
                    //get jml item
                    $sql = "SELECT I.`id`
                            FROM r_mdl1_item I 
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'PROV')
                            JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y'";
                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $jml_item = $list_data->num_rows();

                    $sql = "SELECT A.iduser,C.name, A.idwilayah,B.nama_provinsi, JML.jml,IFNULL(RS.jml,0) jml_rsm, ST.id stts, ST.attachments
                            FROM tbl_user_wilayah A
                            JOIN `provinsi` B ON B.`id`=A.`idwilayah`
                            JOIN `tbl_user` C ON C.id = A.iduser AND C.group=2 AND C.id!=674
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml,W.iduser
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov IN ('ALL', 'PROV')
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE 1=1
                                    GROUP BY W.`idwilayah`,W.iduser
                                ) JML ON JML.idprov=A.`idwilayah` AND JML.`iduser` = A.iduser
                                LEFT JOIN(
                                            SELECT W.`idwilayah` idprov,COUNT(1) jml,W.iduser
                                            FROM `tbl_user_wilayah` W
                                            JOIN `t_mdl1_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                            WHERE 1=1
                                            GROUP BY W.`idwilayah`,W.`iduser`
                                                        ) RS ON RS.idprov=A.`idwilayah` AND RS.`iduser`=A.iduser      
                            LEFT JOIN t_mdl1_sttment_prov ST ON ST.mapid=A.id                          
                            WHERE A.`idwilayah`=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }

                    $prov_id = base64_encode(openssl_encrypt($idmap, "AES-128-ECB", ENCRYPT_PASS));
                        
                    $btn = "<a href='#' data-pr='$prov_id' id='downAllProv' class='btn btn-primary waves-effect waves-light' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;margin-right: 5px; margin-bottom: 10px; float: right;'>Unduh Semua<i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                    $str = "";
                    if ($list_data->num_rows() == 0){
                        $str = "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
                        $btn = "";
                    }
                    $no = 1;
                    $link = base_url() . "attachments/kertaskerja/";
                    foreach ($list_data->result() as $v) {
                        $idcomb = "-" . $v->iduser;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                        //$tmp = " data-id='" . $encrypted_id . "'";
                        $tmp = " data-id='" . $encrypted_id . "'";
                        $idcomb1 = "-" . $v->idwilayah;
                        $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                        $tmp1 = " data-pr='" . $encrypted_id1 . "'";
                        $downl = $link . $v->attachments;
                        if (substr($v->attachments, -3) == 'rar') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".rar";
                        } elseif (substr($v->attachments, -3) == 'zip') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".zip";
                        } elseif (substr($v->attachments, -3) == 'pdf') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".pdf";
                        } elseif (substr($v->attachments, -4) == 'docx') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".docx";
                        } elseif (substr($v->attachments, -4) == 'xlsx') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".xlsx";
                        } elseif (substr($v->attachments, -4) == 'jpeg') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".jpeg";
                        } elseif (substr($v->attachments, -4) == 'pptx') {
                            $rename = $v->name . "_" . $v->nama_provinsi . ".pptx";
                        } else {
                            $rename = $v->name . "_" . $v->nama_provinsi;
                        }

                        $str .= "<tr class='' title='Dokumen'>";
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                        $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->name . "</td>";

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
                        $str .= "<td  class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a $tmp $tmp1 class='btn btn-sm btnDown'  title='Unduh Data'><i class='fas fa-download'></i></a></td>";
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
            throw new Exception("Session expired, please login", 2);
        }

        $idcomb = decrypt_base64($_GET['timid']);
        $tmp = explode('-', $idcomb);
        if (count($tmp) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp[0];
        $user = $tmp[1];

        $provcomb = decrypt_base64($_GET['provid']);
        $tmp2 = explode('-', $provcomb);
        if (count($tmp2) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp2[0];
        $idwil = $tmp2[1];
        
        $select_u = "SELECT W.* FROM `tbl_user` W WHERE W.id='$user' ";
        $list_u   = $this->db->query($select_u);
        foreach ($list_u->result() as $u) {
            $nama = $u->name;
        }
        //$user
        $select = "SELECT W.id,W.iduser,W.idwilayah, P.nama_provinsi, U.userid
                    FROM `tbl_user_wilayah` W
                    JOIN `provinsi` P ON W.idwilayah = P.id
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE W.iduser='$user' AND W.idwilayah='$idwil'";

        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nilai = $d->id;
            $user_d = $d->userid;
            $namaprov = $d->nama_provinsi;
        }

        $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
        FROM `r_mdl1_item` IT
        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'PROV')
        JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
        JOIN `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
        JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
        LEFT JOIN `t_mdl1_resume_prov` RES ON RES.`aspekid` = A.id AND RES.mapid ='$nilai'
        LEFT JOIN(
                SELECT I.`id` iditem,II.`skor`
                FROM `t_mdl1_skor_prov` SK
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
        $this->excel->getActiveSheet()->setCellValue('D5', "$namaprov");
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
        header("Content-Disposition:attachment;filename = Modul1_" . $user_d . "_" . $namaprov . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function downloadAllNilai()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }

        $idwil    = decrypt_base64($_GET['provid']);
        
        //$user
        $select = "SELECT W.id,W.iduser,W.idwilayah, P.nama_provinsi, U.userid, U.name
                    FROM `tbl_user_wilayah` W
                    JOIN `provinsi` P ON W.idwilayah = P.id
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE W.idwilayah='$idwil' AND U.id!=674"; // id 674 dit.peppd

        $list_data  = $this->db->query($select);

        $this->load->library("Excel");
        $this->excel->setActiveSheetIndex(0);
        foreach ($list_data->result() as $index => $d) {
            $nilai = $d->id;
            $name = $d->name;
            $user_d = $d->userid;
            $namaprov = $d->nama_provinsi;
        
            $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
            FROM `r_mdl1_item` IT
            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'PROV')
            JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
            JOIN `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
            JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
            LEFT JOIN `t_mdl1_resume_prov` RES ON RES.`aspekid` = A.id AND RES.mapid ='$nilai'
            LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_prov` SK
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
            $this->excel->getActiveSheet()->setCellValue('D5', "$namaprov");
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
        $this->excel->getActiveSheet()->setCellValue('C3', $namaprov);
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
        $this->excel->getActiveSheet()->setCellValue($averageColumn.$rowCoeff, "=stdev({$firstCoeff}:{$lastCoeff})/(".$averageColumn.$rowTotal.") * 100");             
        // $this->excel->getActiveSheet()->setCellValue($averageColumn.$rowCoeff, "=SUM({$firstCoeff}:{$lastCoeff})");
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
        header("Content-Disposition:attachment;filename = Rekap_Nilai_". $namaprov . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_penilaian_tpt_by_user()
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap User');

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
        $this->excel->getActiveSheet()->setCellValue("E1", "PERSENTASE PENILAIAN");
        $this->excel->getActiveSheet()->setCellValue("F1", "LEMBAR PERNYATAAN");

        //---------------isi disini--------------------

        $sql = "SELECT t1.*, ROUND((COUNT(skor.id) / (SELECT COUNT(id) FROM r_mdl1_item) * 100), 2) AS persentase_penilaian,
                CASE
                    WHEN sttment.id != 'null' THEN 'Sudah upload'
                    ELSE 'Belum upload'
                END AS lembar_pernyataan
                FROM
                (
                    SELECT wil.id AS id, wil.iduser AS iduser, us.userid AS userid, us.name AS name, wil.idwilayah AS idwilayah, pro.nama_provinsi AS nama_provinsi 
                    FROM `tbl_user_wilayah` wil
                    JOIN tbl_user us ON wil.iduser = us.id
                    JOIN provinsi pro ON wil.idwilayah = pro.id  
                ) t1
                LEFT JOIN t_mdl1_skor_prov skor ON t1.id = skor.mapid
                LEFT JOIN t_mdl1_sttment_prov sttment ON t1.id = sttment.mapid
                WHERE t1.userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')
                GROUP BY t1.id
                ORDER BY t1.userid";
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
        //font
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_peniaian_tpt_by_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_resume_tpt_by_user()
    {
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

        $sql = "SELECT user.userid AS iduser, user.name AS nama_user, resume_prov.mapid AS mapid, wil.idwilayah AS idwilayah, prov.id AS idprovinsi, prov.nama_provinsi AS nama_provinsi, 
                aspek.id AS idaspek, aspek.nama AS nama_aspek, resume_prov.ksmplan AS kesimpulan, resume_prov.saran AS saran
                FROM t_mdl1_resume_prov resume_prov
                JOIN tbl_user_wilayah wil ON resume_prov.mapid = wil.id
                JOIN tbl_user user ON wil.iduser = user.id
                JOIN r_mdl1_aspek aspek ON resume_prov.aspekid = aspek.id
                JOIN provinsi prov ON wil.idwilayah = prov.id
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
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_provinsi);
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
        header("Content-Disposition:attachment;filename = rekap_resume_tpt_by_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
