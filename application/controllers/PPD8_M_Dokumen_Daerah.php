<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
* Penilaian Modul 1 oleh TPT Pusat
* author : ilham
 * date : 10 des 2020
*/
class PPD8_M_Dokumen_Daerah extends CI_Controller
{
    var $view_dir   = "ppd8/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd8/dokumen_daerah.js";

    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        $this->load->library("Excel");
        $this->load->library('zip');
    }


    public function index()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session expired, please login", 2);
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //common properties
                $this->js_init    = "main";
                $this->js_tedit    = "main";
                $this->js_path    = "assets/js/ppd8/dokumen_daerah.js?v=" . now("Asia/Jakarta");


                $data_page = array();
                $str = $this->load->view($this->view_dir . "dokumen_daerah_ppd8", $data_page, TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init . ".init();",
                    //"js_tedit"    =>  $this->js_tedit.".tble();",
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

    function g_dokumen_all()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $group = $this->session->userdata(SESSION_LOGIN)->group;

                //---------------isi disini--------------------

                $sql = "SELECT D.provid, D.jenisid, D.judul, D.tautan, D.cr_by, D.cr_dt
                        FROM `t_doc_prov` D  
                        JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                        WHERE D.isactive = 'Y' AND G.groupid = '8'
                        ORDER BY provid, jenisid ASC";

                $bind = array($group);
                $list_data = $this->db->query($sql, $bind);

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $no = 1;
                $str = '';
                $link_d = base_url() . "attachments/provinsi/";
                foreach ($list_data->result() as $list) {
                    $val_link = $link_d . $list->tautan;

                    if (substr($list->tautan, -3) == 'rar') {
                        $rename = $list->judul . ".rar";
                    } elseif (substr($list->tautan, -3) == 'zip') {
                        $rename = $list->judul . ".zip";
                    } elseif (substr($list->tautan, -3) == 'pdf') {
                        $rename = $list->judul . ".pdf";
                    } elseif (substr($list->tautan, -3) == 'doc') {
                        $rename = $list->judul . ".doc";
                    } elseif (substr($list->tautan, -4) == 'docx') {
                        $rename = $list->judul . ".docx";
                    } elseif (substr($list->tautan, -4) == 'xlsx') {
                        $rename = $list->judul . ".xlsx";
                    } elseif (substr($list->tautan, -3) == 'xls') {
                        $rename = $list->judul . ".xls";
                    } elseif (substr($list->tautan, -3) == 'png') {
                        $rename = $list->judul . ".png";
                    } elseif (substr($list->tautan, -3) == 'PNG') {
                        $rename = $list->judul . ".png";
                    } elseif (substr($list->tautan, -3) == 'jpg') {
                        $rename = $list->judul . ".jpg";
                    } elseif (substr($list->tautan, -3) == 'JPG') {
                        $rename = $list->judul . ".jpg";
                    } elseif (substr($list->tautan, -4) == 'jpeg') {
                        $rename = $list->judul . ".jpeg";
                    } elseif (substr($list->tautan, -4) == 'jfif') {
                        $rename = $list->judul . ".jpg";
                    } elseif (substr($list->tautan, -4) == 'pptx') {
                        $rename = $list->judul . ".pptx";
                    } else {
                        $rename = $list->judul;
                    }

                    $str .= "<tr>";
                    $str .= "<td style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><center>" . $no . "</center></td>";
                    $str .= "<td style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><center>" . $list->judul . "</center></td>";
                    $str .= "<td style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><center>" . $list->cr_by . "</center></td>";
                    $str .= "<td style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><center>" . $list->cr_dt . "</center></td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a href='$val_link' download='$rename' target='_blank' class='btn text-primary '  title='Unduh Data'><i class='fas fa-download'></i><h7 class='mt-3 mb-0'></h7></a></td>";

                    $str .= "</tr>";
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
     * list data wilayah
     * author : FSM
     * date : 17 des 2020
     */
    function g_wilayah()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $userid = $session->id;

                //table wilayah

                $sql = "SELECT 'prov' kate,P.`id` mapid,P.`id_kode` kode, P.`nama_provinsi` nmprov
                        FROM t_doc_prov_groupuser PGU
                        JOIN `t_doc_prov` DP ON `PGU`.`docid`=DP.id
                        JOIN provinsi P ON DP.provid=P.id
                        WHERE PGU.groupid=8
                        GROUP BY nmprov ASC";
                // $bind = array($session->id);
                // $list_data = $this->db->query($sql, $bind);
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $str = "";
                if ($list_data->num_rows() == 0) {
                    $str .= "<div class='not-found-img' style='display: grid; justify-content: center;'>";
                    $str .= "<img src='" . base_url() . "/assets/icons/not_found_2.svg' alt='Data Not Found' width='200' height='200'>";
                    $str .= "<h5 style='font-family: \'Hind Madurai\', sans-serif; text-align: center;'>- <strong style='color: red;'>Data</strong> tidak ditemukan -</h5>";
                    $str .= "</div>";
                } else {
                    $no = 1;
                    foreach ($list_data->result() as $v) {
                        $idcomb = $v->kate . "-" . $v->mapid;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));


                        $tmp = "class='btn btn-sm btn-success waves-effect waves-light getDetail' data-id='" . $encrypted_id . "'";
                        $tmp .= " data-nmpkk='" . $v->nmprov . "'";

                        $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                        $str .= "<div style='display: flex; align-items: center;'>";
                        $str .= "<img src='" . base_url() . "/assets/icons/PNG_Provinsi/" . $v->kode . "_" . $v->nmprov . ".png' alt='" . $v->nmprov . "' title='" . $v->nmprov . "' width='100' height='100' style='padding: 15px;'>";
                        $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                        $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                        $str .= "<h4 style='margin-bottom: 3px;'>" . $v->nmprov . "</h4>";
                        $str .= "</div>";
                        $str .= "<div class='mt-0'>";
                        // $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.8rem;'><strong>20</strong> Dokumen / File Bahan Dukung</p>";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "<div class='btn-wilayah' style='float: right; margin-right: 3%;'>";
                        $str .= "<a href='javascript:void(0)' " . $tmp . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'>Detail <i class='fa fa-caret-right' style='padding-left: 5px;'></i></a>";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "</div>";
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
     * list data Bahan Dokumen
     * author :  FSM
     * date : 17 des 2020
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

                $idcomb = decrypt_base64($this->input->post("id"));
                $group = $this->session->userdata(SESSION_LOGIN)->group;
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];

                $_arr = array("prov", "kab", "kot");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                $link = '';
                if ($kate_wlyh == "prov") {
                    //LIST Dokumen
                    //                    $sql = "SELECT  1 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                    //                            FROM `t_doc` D  
                    //                            JOIN `t_doc_groupuser` G ON D.id = G.docid 
                    //                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                    //                            WHERE U.id=? AND D.isactive = 'Y'
                    //                            UNION
                    //                            SELECT 2 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                    //                            FROM `t_doc_prov` D  
                    //                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                    //                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                    //                            WHERE D.provid =?  AND D.isactive = 'Y' ";
                    // $sql = "SELECT 2 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                    //     FROM `t_doc_prov` D  
                    //     JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                    //     JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                    //     WHERE D.provid =?  AND D.isactive = 'Y' GROUP BY mapid ";
                    $sql = "SELECT 2 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                            FROM `t_doc_prov` D  
                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                            WHERE D.provid =?  AND D.isactive = 'Y' AND G.groupid =?";
                    $bind = array($idmap, $group);
                    $list_data = $this->db->query($sql, $bind);
                }
                //                if($kate_wlyh=="kab"){
                //                    //LIST Dokumen
                //                    $sql = "SELECT D.`id` mapid, D.judul, D.filename
                //                            FROM `t_doc_capai_kab` D
                //                            JOIN `provinsi` P ON P.`id`=D.kabid
                //                            WHERE D.kabid =? AND D.isactive = 'Y' ";
                //                    $bind = array($idmap);
                //                    $list_data = $this->db->query($sql,$bind);
                //                }

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";

                $no = 1;
                $lnk = 'https';
                $link_d = base_url() . "attachments/provinsi/";
                foreach ($list_data->result() as $v) {
                    $idcomb = $kate_wlyh . "-" . $idmap . "-" . $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    //                    if($v->no=='1'){ $link =base_url()."attachments/bahandukung/"; }
                    //                    else{ $link =base_url()."attachments/provinsi/"; }
                    $val_link = $link_d . $v->tautan;
                    $namefile = $v->judul;

                    if (substr($v->tautan, -3) == 'rar') {
                        $rename = $v->judul . ".rar";
                    } elseif (substr($v->tautan, -3) == 'zip') {
                        $rename = $v->judul . ".zip";
                    } elseif (substr($v->tautan, -3) == 'pdf') {
                        $rename = $v->judul . ".pdf";
                    } elseif (substr($v->tautan, -3) == 'doc') {
                        $rename = $v->judul . ".doc";
                    } elseif (substr($v->tautan, -4) == 'docx') {
                        $rename = $v->judul . ".docx";
                    } elseif (substr($v->tautan, -4) == 'xlsx') {
                        $rename = $v->judul . ".xlsx";
                    } elseif (substr($v->tautan, -3) == 'xls') {
                        $rename = $v->judul . ".xls";
                    } elseif (substr($v->tautan, -3) == 'png') {
                        $rename = $v->judul . ".png";
                    } elseif (substr($v->tautan, -3) == 'PNG') {
                        $rename = $v->judul . ".png";
                    } elseif (substr($v->tautan, -3) == 'jpg') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -3) == 'JPG') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $rename = $v->judul . ".jpeg";
                    } elseif (substr($v->tautan, -4) == 'jfif') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $rename = $v->judul . ".pptx";
                    } else {
                        $rename = $v->judul;
                    }

                    // $str.="<tr class='bg-secondary' title='Kegiatan'>";
                    $str .= "<tr class='' title='Kegiatan'>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $no++ . "</td>";
                    // $str.="<td  class='text'>".wordwrap($v->judul,50,"<br/>")."</td>";
                    $str .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $v->judul . "</td>";
                    $str .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $v->cr_by . "</td>";
                    $str .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $v->cr_dt . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a href='$val_link' download='$rename' target='_blank' class='btn text-primary '  title='Unduh Data'><i class='fas fa-download'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                    $str .= "</tr>";
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
     * Download zip
     * author :  FSM
     * date : 17 Feb 2021
     */
    function d_bahan()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }
        $idcomb = decrypt_base64($_GET['wl']);
        $group = $this->session->userdata(SESSION_LOGIN)->group;
        $tmp = explode('-', $idcomb);
        if (count($tmp) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh  = $tmp[0];
        $idwlyh     = $tmp[1];

        $_arr = array("prov", "kab", "KOTA");
        if (!in_array($kate_wlyh, $_arr))
            throw new Exception("InvaliD Kategori Wilayah");
        if (!is_numeric($idwlyh))
            throw new Exception("Invalid ID Map");


        $user = $this->session->userdata(SESSION_LOGIN)->id;
        $userid = $this->session->userdata(SESSION_LOGIN)->userid;
        $nama = $this->session->userdata(SESSION_LOGIN)->name;
        $usergroupid = $this->session->userdata(SESSION_LOGIN)->group;
        date_default_timezone_set("Asia/Jakarta");
        $current_date_time = date("Y_m_d_H_i_s");

        /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
        if ($kate_wlyh == "prov") {

            /*
                     * check data PROV - start
                     */
            $sql = "SELECT A.*
                            FROM `provinsi` A
                            WHERE A.`id`=?";
            $bind = array($idwlyh);
            $list_data = $this->db->query($sql, $bind);
            if (!$list_data) {
                $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                log_message("error", $msg);
                throw new Exception("Invalid SQL!");
            }
            if ($list_data->num_rows() == 0) {
                $msg = $session->userid . " " . $this->router->fetch_class() . " : Prov ID : " . $idwlyh . " not found";
                log_message("error", $msg);
                throw new Exception("Data Provinsi tidak ditemukan!");
            }
            foreach ($list_data->result() as $p) {
                $name = $p->label;
            }
            $filename = "dokumen_daerah_" . $name . ".zip";
            /*
                     * check data PROV - end
                     */

            //get LIST tautan doc
            //                    $sql = "SELECT  1 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
            //                            FROM `t_doc` D  
            //                            JOIN `t_doc_groupuser` G ON D.id = G.docid 
            //                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
            //                            WHERE U.id=? AND D.isactive = 'Y'
            //                            UNION
            //                            SELECT 2 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
            //                            FROM `t_doc_prov` D  
            //                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
            //                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
            //                            WHERE D.provid =?  AND D.isactive = 'Y' ";
            //   $sql = "
            //         SELECT 2 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
            //         FROM `t_doc_prov` D  
            //         JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
            //         JOIN `tbl_user_group` U ON G.`groupid` = U.id 
            //         WHERE D.provid =?  AND D.isactive = 'Y' GROUP BY mapid ";
            $sql = "
                            SELECT 2 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                            FROM `t_doc_prov` D  
                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                            WHERE D.provid =?  AND D.isactive = 'Y' AND G.groupid =? ";
            $bind = array($idwlyh, $usergroupid);
            $list_data = $this->db->query($sql, $bind);
            if (!$list_data) {
                $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                log_message("error", $msg);
                throw new Exception("Invalid SQL!");
            }
        }

        //                elseif($kate_wlyh=="kab" || $kate_wlyh=="KOTA"){
        //                    /*
        //                     * check data KAB / KOTA - start
        //                     */
        //                    $sql = "SELECT A.*
        //                            FROM `kabupaten` A
        //                            WHERE A.`id`=?";
        //                    $bind = array($idwlyh);
        //                    $list_data = $this->db->query($sql,$bind);
        //                    if(!$list_data){
        //                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
        //                        log_message("error", $msg);
        //                        throw new Exception("Invalid SQL!");
        //                    }
        //                    if($list_data->num_rows() ==0){
        //                        $msg = $session->userid." ".$this->router->fetch_class()." : Kab/Kota ID : ".$idwlyh." not found";
        //                        log_message("error", $msg);
        //                        throw new Exception("Data Kabupaten / Kota tidak ditemukan!");
        //                    }
        //                    foreach ($list_data->result() as $k) {
        //                        $name=$k->nama_kabupaten;
        //                    }
        //                    $filename = "bahan_".$name.".zip";
        //                    /*
        //                     * check data KAB / KOTA - end
        //                     */
        //                    
        //                    //get LIST tautan doc
        //                    $sql = "SELECT  1 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
        //                            FROM `t_doc` D  
        //                            JOIN `t_doc_groupuser` G ON D.id = G.docid 
        //                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
        //                            WHERE U.id=$usergroupid AND D.isactive = 'Y'
        //                            UNION
        //                            SELECT 2 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt
        //                                FROM `t_doc_kab` D  
        //                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
        //                                JOIN `tbl_user_group` U ON G.`groupid` = U.id 
        //                                WHERE D.kabid =? AND D.isactive = 'Y'";
        //                    $bind = array($idwlyh);
        //                    $list_data = $this->db->query($sql,$bind);
        //                    if(!$list_data){
        //                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
        //                        log_message("error", $msg);
        //                        throw new Exception("Invalid SQL!");
        //                    }
        //                }
        if ($list_data->num_rows() == 0) {
            echo 'Bahan Dukung tidak ada';
            exit();
        }
        // print_r($list_data->result()); die();
        foreach ($list_data->result() as $v) {
            $no = $v->no;
            $file       = $v->tautan;
            $filepath1 = FCPATH . 'attachments/provinsi/' . $file;

            if (substr($v->tautan, -3) == 'rar') {
                $rename = $v->judul . ".rar";
            } elseif (substr($v->tautan, -3) == 'zip') {
                $rename = $v->judul . ".zip";
            } elseif (substr($v->tautan, -3) == 'pdf') {
                $rename = $v->judul . ".pdf";
            } elseif (substr($v->tautan, -3) == 'xls') {
                $rename = $v->judul . ".xls";
            } elseif (substr($v->tautan, -4) == 'xlsx') {
                $rename = $v->judul . ".xlsx";
            } elseif (substr($v->tautan, -3) == 'doc') {
                $rename = $v->judul . ".doc";
            } elseif (substr($v->tautan, -4) == 'docx') {
                $rename = $v->judul . ".docx";
            } elseif (substr($v->tautan, -3) == 'png') {
                $rename = $v->judul . ".png";
            } elseif (substr($v->tautan, -3) == 'PNG') {
                $rename = $v->judul . ".png";
            } elseif (substr($v->tautan, -3) == 'jpg') {
                $rename = $v->judul . ".jpg";
            } elseif (substr($v->tautan, -3) == 'JPG') {
                $rename = $v->judul . ".jpg";
            } elseif (substr($v->tautan, -4) == 'jpeg') {
                $rename = $v->judul . ".jpeg";
            } elseif (substr($v->tautan, -4) == 'jfif') {
                $rename = $v->judul . ".jpg";
            } elseif (substr($v->tautan, -4) == 'pptx') {
                $rename = $v->judul . ".pptx";
            } else {
                $rename = $v->judul;
            }

            $this->zip->read_file($filepath1, $rename);
            // $filepath = $v->tautan;     
            // $filedata[] =$filepath;
        }

        $this->zip->download($filename);
    }

    function d_bahan_all()
    {

        if (!$this->session->userdata(SESSION_LOGIN)) {
            session_write_close();
            throw new Exception("Session expired, please login", 2);
        }
        $session = $this->session->userdata(SESSION_LOGIN);
        session_write_close();

        $group = $this->session->userdata(SESSION_LOGIN)->group;

        //---------------isi disini--------------------

        $sql = "SELECT D.provid, D.jenisid, D.judul, D.tautan, D.cr_by, D.cr_dt
                FROM `t_doc_prov` D  
                JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                WHERE D.isactive = 'Y' AND G.groupid = '8'
                ORDER BY provid, jenisid ASC";

        $bind = array($group);
        $list_data = $this->db->query($sql, $bind);

        $list_data = $this->db->query($sql);
        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        $no = 1;
        $str = '';
        $link_d = base_url() . "attachments/provinsi/";
        foreach ($list_data->result() as $list) {
            $filepath1 = FCPATH . 'attachments/provinsi/' . $list->tautan;

            if (substr($list->tautan, -3) == 'rar') {
                $rename = $list->judul . ".rar";
            } elseif (substr($list->tautan, -3) == 'zip') {
                $rename = $list->judul . ".zip";
            } elseif (substr($list->tautan, -3) == 'pdf') {
                $rename = $list->judul . ".pdf";
            } elseif (substr($list->tautan, -3) == 'doc') {
                $rename = $list->judul . ".doc";
            } elseif (substr($list->tautan, -4) == 'docx') {
                $rename = $list->judul . ".docx";
            } elseif (substr($list->tautan, -4) == 'xlsx') {
                $rename = $list->judul . ".xlsx";
            } elseif (substr($list->tautan, -3) == 'xls') {
                $rename = $list->judul . ".xls";
            } elseif (substr($list->tautan, -3) == 'png') {
                $rename = $list->judul . ".png";
            } elseif (substr($list->tautan, -3) == 'PNG') {
                $rename = $list->judul . ".png";
            } elseif (substr($list->tautan, -3) == 'jpg') {
                $rename = $list->judul . ".jpg";
            } elseif (substr($list->tautan, -3) == 'JPG') {
                $rename = $list->judul . ".jpg";
            } elseif (substr($list->tautan, -4) == 'jpeg') {
                $rename = $list->judul . ".jpeg";
            } elseif (substr($list->tautan, -4) == 'jfif') {
                $rename = $list->judul . ".jpg";
            } elseif (substr($list->tautan, -4) == 'pptx') {
                $rename = $list->judul . ".pptx";
            } else {
                $rename = $list->judul;
            }

            $this->zip->read_file($filepath1, $rename);
        }

        //---------end isi disini----------------------

        $filename = "dokumen_daerah_provinsi.zip";

        $this->zip->download($filename);
    }
}
