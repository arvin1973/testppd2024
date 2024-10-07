<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD1_t3_penilaian extends CI_Controller
{
    var $view_dir   = "ppd1/penilaian_tpitpu/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD1_upload_dokumen/dokumen.js";
    var $allowed    = array("PPD1");
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        $this->load->library('zip');
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
                $this->js_path    = "assets/js/ppd1/penilaian_tpitpu/penilaian_prov_t3.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_prov_t3", $data_page, TRUE);

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

    /*
     * =========================================================================
     *  Provinsi                                                   - START
     * =========================================================================
     */
    /*
     * list data Bahan Dokumen
     * author :  FSM
     * date : 17 des 2020
     */
    function g_bahan1()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 0);
                }

                $sql = "SELECT 	'3' kate, P.`id` 'mapwil', P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser, W.id kodewil, 'Tahap III' tahap
                            FROM  `provinsi` P 
                            LEFT JOIN `tbl_user_t3_prov` W ON W.idwilayah = P.id
                            WHERE W.iduser!=''";

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";
                $no = 1;
                $lnk = 'https';
                foreach ($list_data->result() as $v) {
                    $idwil = "PROV-" . $v->mapwil;

                    $encrypted_id = base64_encode(openssl_encrypt($idwil, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->nama_provinsi . "'";

                    $str .= "<tr class='' >";
                    $str .= "<td class='text-right'>" . $no++ . "</td>";
                    $str .= "<td  class='text'><a href='javascript:void(0)' " . $tmp . ">" . wordwrap($v->nama_provinsi, 50, "<br/>") . "</a></td>";
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
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 0);
                }

                $sql = "SELECT 	'2' kate, P.`id` 'mapwil', P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser, W.id kodewil, 'Tahap II' tahap
                            FROM  `provinsi` P 
                            LEFT JOIN `tbl_user_t3_prov` W ON W.idwilayah = P.id
                            WHERE W.iduser!=''
                            GROUP BY P.id
                            ORDER BY P.id_kode";

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";
                $no = 1;
                $lnk = 'https';
                foreach ($list_data->result() as $v) {
                    $idwil = "PROV-" . $v->mapwil;

                    $encrypted_id = base64_encode(openssl_encrypt($idwil, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->nama_provinsi . "'";

                    $str .= "<tr class='' title='Dokumen'>";
                    $str .= "<td width='7%' class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                    $str .= "<td width='93%' class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmp . ">" . $v->nama_provinsi . "</a></td>";
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
     * Detail Dokumen Penilaian Tahap II
     * author : FSM 
     * date : 24 feb 2021
     */

    function detail_view()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $this->form_validation->set_rules('id', 'ID Data', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID #1");
                $kate_id = $tmp[0];
                $iddok = $tmp[1];
                if (!is_numeric($iddok))
                    throw new Exception("Invalid ID User");

                //get jml aspek modul 3
                $sql = "SELECT A.`id` FROM r_mdl3_aspek A WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_aspek = $list_data->num_rows();

                //get jml item
                $sql = "SELECT I.`id` FROM `r_mdl3_item` I 
                LEFT JOIN `r_mdl3_sub_indi` SI ON SI.`indiid`=I.`id` WHERE 1=1 ORDER BY I.id ";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL2!");
                }
                $jml_item = $list_data->num_rows();



                $sql = "SELECT 'PROV' kate,A.`id` mapid,P.`nama_provinsi` nmprov,A.*, B.userid, B.name,C.judul, C.tautan
                                ,IFNULL(JML.jml,0) jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                        FROM `tbl_user_t3_prov` A
                        JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                        LEFT JOIN(
                            SELECT W.idwilayah idprov,SKR.`mapid`, COUNT(1) jml
                            FROM `tbl_user_t3_prov` W
                            left JOIN `t_mdl3_skor_p` SKR ON SKR.`mapid`=W.`id`
                            left JOIN `r_mdl3_item` II ON II.`id`= SKR.`itemindi`
                            left JOIN `r_mdl3_sub_indi` SI ON SI.`indiid`=II.`id`
                            WHERE 1=1 
                            GROUP BY SKR.`mapid`
                        ) JML ON JML.mapid=A.`id`
                        LEFT JOIN(
                            SELECT W.idwilayah idprov, RK.`mapid`, COUNT(1) jml
                            FROM `tbl_user_t3_prov` W
                            left JOIN `t_mdl3_resume_prov` RK ON RK.`mapid`=W.`id` AND RK.`stts`='Y'
                            WHERE 1=1
                            GROUP BY RK.`mapid`
                        )RS ON RS.mapid=A.`id`
                        LEFT JOIN `tbl_user` B ON A.iduser=B.id AND B.group=3 AND B.active_flag ='Y'
                        LEFT JOIN `t_doc_tahap_penilaian_t3_prov` C ON A.id = C.mapid AND C.isactive='Y'
                        LEFT JOIN `t_mdl3_sttment_prov` ST ON ST.`mapid`=A.`id`
                        WHERE A.idwilayah=? AND B.group=3 AND B.active_flag ='Y' 
                        GROUP BY B.userid ";

                $bind = array($iddok);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";
                $no = 1;
                $sts = '';
                $unduh = '';
                foreach ($list_data->result() as $v) {
                    $status_link = base_url() . "attachments/penilaian_tpitpu/" . $v->tautan;

                    $idcomb = $v->kate . "-" . $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='btn btn-sm btn-primary waves-effect waves-light getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-nmpkk='" . $v->nmprov . "'";

                    if (substr($v->tautan, -3) == 'rar') {
                        $rename = $v->judul . ".rar";
                    } elseif (substr($v->tautan, -3) == 'zip') {
                        $rename = $v->judul . ".zip";
                    } elseif (substr($v->tautan, -3) == 'pdf') {
                        $rename = $v->judul . ".pdf";
                    } elseif (substr($v->tautan, -4) == 'docx') {
                        $rename = $v->judul . ".docx";
                    } elseif (substr($v->tautan, -3) == 'doc') {
                        $rename = $v->judul . ".doc";
                    } elseif (substr($v->tautan, -3) == 'xls') {
                        $rename = $v->judul . ".xls";
                    } elseif (substr($v->tautan, -4) == 'xlsx') {
                        $rename = $v->judul . ".xlsx";
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $rename = $v->judul . ".jpeg";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $rename = $v->judul . ".pptx";
                    } else {
                        $rename = $v->judul;
                    }

                    $status = $v->tautan;
                    if ($status == '') {
                        $sts   = "<a href='javascript:void(0);' class='getSttmnt' data-id='' title='belum lengkap'><i class='fas fa-exclamation-circle fa-2x text-pink'></i></a>";
                    } else {
                        $sts  = "<a href='$status_link' download='$rename' t]arget='_blank' class='getSttmnt' data-id='' title='Lengkap'><i class='fas fa-check-circle fa-2x text-success'></i></a>";
                    }


                    $str .= "<tr class='' >";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                    // $str .= "<td class='text'>" . $v->name . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' title='" . $v->name . "'>" . wordwrap($v->name, 30, "<br/>") . "</td>";
                    // $str .= "<td class='text'>" . wordwrap($v->judul, 18, "<br/>") .  "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . wordwrap($v->judul, 18, "<br/>") . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><center>" . $sts . "</center></td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>";
                    $prcntg = $jml_item == 0 ? 0 : $v->jml / $jml_item * 100;
                    if ($prcntg == 100) {
                        $str_tmp = " " . $tmp . "class='btn btn-sm btn-warning waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                        $str_icon = "Data resume aspek<br> belum lengkap (" . number_format($prcntg, 2) . "%)<i class='fas fa-exclamation'></i>";
                        if ($v->jml_rsm == $jml_aspek) {
                            if (!is_null($v->stts)) {
                                $str_tmp = " " . $tmp . " class='btn btn-outline-purple waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='klik untuk Unduh Nilai' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                $str_icon = "Unduh Nilai <i class='fas fa-check-circle'></i>";
                            } else {
                                $str_tmp = " " . $tmp . "class='btn btn-outline-danger waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                                $str_icon = "Belum mengisi<br> lembar pernyataan (" . number_format($prcntg, 2) . "%)<i class='fas fa-check-circle'></i>";
                            }
                        }
                        $str .= "<a href='javascript:void(0);' " . $str_tmp . ">" . $str_icon . "</a>";
                    } else {
                        $str .= "<a href='javascript:void(0)'  class='btn btn-outline-primary waves-effect waves-light btn-status getDetail' data-id='" . $encrypted_id . "' data-nmpkk='" . $v->nmprov . "' style='border-radius: 0px; padding-left: 10px;' >Belum menyelesaikan<br> penilaian (" . number_format($prcntg, 2) . "%) <i class='fas fa-exclamation' style='padding-left: 5px;'></i></a>";
                    }

                    $str .= "</td></tr>";
                }
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "str"       => $str,
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage(),
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }
    /*
     * Download zip Tahap 2
     * author :  FSM
     * date : 17 Feb 2021
     */
    function d_bahan()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }
        $idcomb = decrypt_base64($_GET['wl']);
        $tmp = explode('-', $idcomb);

        if (count($tmp) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh  = $tmp[0];
        $idwlyh     = $tmp[1];
        $_arr = array("PROV", "KAB", "KOTA");
        if (!in_array($kate_wlyh, $_arr))
            throw new Exception("InvaliD Kategori Wilayah");
        if (!is_numeric($idwlyh))
            throw new Exception("Invalid ID Map");


        date_default_timezone_set("Asia/Jakarta");
        $current_date_time = date("Y_m_d_H_i_s");

        $sql_p = "SELECT * FROM provinsi where id=?";
        $bind_p = array($idwlyh);
        $list_p = $this->db->query($sql_p, $bind_p);
        foreach ($list_p->result() as $p) {
            $nmprov = $p->nama_provinsi;
        }

        $link = base_url() . "attachments/penilaian_tpitpu/";
        $sql = "SELECT A.*, B.userid, B.name,C.judul, C.tautan
                    FROM `tbl_user_t3_prov` A 
                    LEFT JOIN `tbl_user` B ON A.iduser=B.id AND B.group=3 
                    LEFT JOIN `t_doc_tahap_penilaian_t3_prov` C ON A.id = C.mapid AND C.isactive='Y'
                    WHERE A.idwilayah=? ";

        $bind = array($idwlyh);
        $list_data = $this->db->query($sql, $bind);
        if ($list_data->num_rows() == 0) {
            echo 'Data tidak ada';
            exit();
        }

        foreach ($list_data->result() as $v) {
            // if (substr($v->tautan, 0, 5) == 'https') {
            //     $file       = substr($v->tautan, 61, 500);
            // } else {
            //     $file       = substr($v->tautan, 60, 500);
            // }

            if (substr($v->tautan, -3) == 'rar') {
                $rename = $v->judul . ".rar";
            } elseif (substr($v->tautan, -3) == 'zip') {
                $rename = $v->judul . ".zip";
            } elseif (substr($v->tautan, -3) == 'pdf') {
                $rename = $v->judul . ".pdf";
            } elseif (substr($v->tautan, -3) == 'xls') {
                $rename = $v->judul . ".xls";
            } elseif (substr($v->tautan, -4) == 'docx') {
                $rename = $v->judul . ".docx";
            } elseif (substr($v->tautan, -3) == 'doc') {
                $rename = $v->judul . ".doc";
            } elseif (substr($v->tautan, -4) == 'xlsx') {
                $rename = $v->judul . ".xlsx";
            } elseif (substr($v->tautan, -4) == 'jpeg') {
                $rename = $v->judul . ".jpeg";
            } elseif (substr($v->tautan, -4) == 'pptx') {
                $rename = $v->judul . ".pptx";
            } else {
                $rename = $v->judul;
            }

            $filepath1 = FCPATH . 'attachments/penilaian_tpitpu/' . $v->tautan;

            $this->zip->read_file($filepath1, $rename);

            $filepath = $v->tautan;
            $filedata[] = $filepath;
        }
        // Download
        $filename = "penilaian_tahap_II_" . $nmprov . ".zip";
        $this->zip->download($filename);
    }

    function Download_nilai()
    {

        if (!$this->session->userdata(SESSION_LOGIN)) {
            echo 'Invalid Token, silakan ulangi login ke aplikasi';
            exit();
        }

        //$user = $this->session->userdata(SESSION_LOGIN)->id;
        //$nama = $this->session->userdata(SESSION_LOGIN)->name;
        $idcomb = decrypt_base64($_GET['token']);
        $tmp = explode('-', $idcomb);
        if (count($tmp) != 2) {
            echo 'Invalid ID';
            exit();
        }
        $kate_wlyh = $tmp[0];
        $idwil = $tmp[1];
        $_arr = array("PROV", "KAB", "KOT");
        if (!in_array($kate_wlyh, $_arr)) {
            echo 'InvaliD Kategori Wilayah';
            exit(); //   throw new Exception("InvaliD Kategori Wilayah");
        }
        //$user
        $select = "SELECT W.id,W.iduser,W.idwilayah, P.nama_provinsi, U.userid, U.name
                    FROM `tbl_user_t3_prov` W
                    JOIN `provinsi` P ON W.idwilayah = P.id
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE  W.id='$idwil'";
        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nama  = $d->name;
            $user_d = $d->userid;
            $namaprov = $d->nama_provinsi;
        }
        //list indikator skor
        $status_sql = "SELECT K.id nokrr,K.aspekid nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,IT.`nourut` nr,IT.`nama` nmitem,IJ.nama nmjdl,JDL.`judl`,SK.sumber,SK.skor skr,
RES.ksmplan, RES.saran,IND.bobot
                                FROM `r_mdl3_item` IT
                                JOIN `r_mdl3_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                JOIN `r_mdl3_indi` IND ON IND.`id`=SI.`indiid`
                                LEFT JOIN `r_mdl3_item_judul` IJ ON IJ.`indiid` = IND.`id`
                                JOIN `r_mdl3_krtria` K ON K.`id`=IND.`krtriaid`
                                JOIN `r_mdl3_aspek` A ON A.id = K.aspekid
                                LEFT JOIN `t_mdl3_resume_prov` RES ON RES.`aspekid` = A.id AND RES.mapid ='$idwil'
                                    LEFT JOIN `t_mdl3_judul_prov` JDL ON JDL.judlid = IJ.id AND JDL.mapid ='$idwil'
                                LEFT JOIN `t_mdl3_skor_p` SK ON SK.`itemindi` = IT.id AND SK.mapid ='$idwil'
                                ORDER BY K.aspekid,IND.nourut,IT.`id` ASC";
        $list_data  = $this->db->query($status_sql);
        // print_r($list_data->result()[109]->nmitem);
        // die();

        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Nilai');



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
        // $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2022");
        // $this->excel->getActiveSheet()->mergeCells('A1:K1');
        // $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // $this->excel->getActiveSheet()->setCellValue('A2', "Modul 2 Presentasi Dan Wawacara");

        // $this->excel->getActiveSheet()->mergeCells('A2:K2');

        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:M122');

        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2023");
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->setCellValue('A2', "Modul 3 Verifikasi");
        $this->excel->getActiveSheet()->mergeCells('A2:K2');
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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

        $this->excel->getActiveSheet()->setCellValue('F3', "Petunjuk Penilaian:");
        $this->excel->getActiveSheet()->setCellValue('F4', "1. Penilaian dikelompokkan dalam 7 kriteria dan 22 indikator.");
        $this->excel->getActiveSheet()->setCellValue('F5', "2. Masing-masing indikator terdiri dari beberapa item penilaian. Setiap item penilaian memiliki nilai minimum “5” dan maksimum “10”.");
        $this->excel->getActiveSheet()->setCellValue('F6', "3. Item penilaian pada masing-masing indikator dapat dipergunakan oleh TPI dan TPU sebagai alat bantu untuk menentukan nilai indikator.");
        $this->excel->getActiveSheet()->setCellValue('F7', "4. Nilai untuk masing-masing indikator merupakan rata-rata skor dari seluruh item penilaian					        ");
        $this->excel->getActiveSheet()->setCellValue('F8', "5. Total nilai suatu daerah merupakan akumulasi dari seluruh indikator dengan memperhatikan bobot masing-masing indikator					        ");
        $this->excel->getActiveSheet()->setCellValue('F9', "6. Nilai akhir penilaian presentasi dan wawancara adalah nilai tengah dari TPI dan TPU (yang memberikan penilaian).					        ");



        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:N122');
        $this->excel->getActiveSheet()->setCellValue("A10", "NO");
        $this->excel->getActiveSheet()->mergeCells('A10:A11');
        $this->excel->getActiveSheet()->setCellValue("B10", "ASPEK");
        $this->excel->getActiveSheet()->mergeCells('B10:B11');

        $this->excel->getActiveSheet()->setCellValue("C10", "INDIKATOR");
        $this->excel->getActiveSheet()->mergeCells('C10:D11');
        $this->excel->getActiveSheet()->setCellValue("E10", "ITEM");
        $this->excel->getActiveSheet()->mergeCells('E10:F11');
        $this->excel->getActiveSheet()->setCellValue("G10", "ITEM DI NILAI");
        $this->excel->getActiveSheet()->mergeCells('G10:G11');
        $this->excel->getActiveSheet()->setCellValue("H10", "SUMBER INFORMASI");
        $this->excel->getActiveSheet()->mergeCells('H10:H11');
        $this->excel->getActiveSheet()->setCellValue("I10", "NILAI");
        $this->excel->getActiveSheet()->mergeCells('I10:I11');
        $this->excel->getActiveSheet()->setCellValue("J10", "KEUNGGULAN");
        $this->excel->getActiveSheet()->mergeCells('J10:J11');
        $this->excel->getActiveSheet()->setCellValue("K10", "REKOMENDASI");
        $this->excel->getActiveSheet()->mergeCells('K10:K11');
        $this->excel->getActiveSheet()->setCellValue("L10", "SKOR");
        $this->excel->getActiveSheet()->mergeCells('L10:L11');
        $this->excel->getActiveSheet()->setCellValue("M10", "BOBOT");
        $this->excel->getActiveSheet()->mergeCells('M10:M11');
        $this->excel->getActiveSheet()->setCellValue("N10", "NILAI TERBOBOT");
        $this->excel->getActiveSheet()->mergeCells('N10:N11');
        $this->excel->getActiveSheet()->setCellValue("A122", "TOTAL");

        //list indikator skor

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 12;
        $nol = '';
        foreach ($list_data->result() as $value) {
            if ($value->nmjdl != '') {
                $judul = $value->nmjdl . ' : ' . $value->judl;
            } else {
                $judul = '';
            }
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $judul);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->sumber);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, '');
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot / 100);
            $index_excelColumn = 0;
            $row++;
        }
        $this->excel->getActiveSheet()->mergeCells('A12:A62');
        $this->excel->getActiveSheet()->mergeCells('A63:A100');
        $this->excel->getActiveSheet()->mergeCells('A101:A121');

        $this->excel->getActiveSheet()->mergeCells('B12:B62');
        $this->excel->getActiveSheet()->mergeCells('B63:B100');
        $this->excel->getActiveSheet()->mergeCells('B101:B121');

        $this->excel->getActiveSheet()->mergeCells('C12:C17');
        $this->excel->getActiveSheet()->mergeCells('C18:C22');
        $this->excel->getActiveSheet()->mergeCells('C23:C27');
        $this->excel->getActiveSheet()->mergeCells('C28:C32');
        $this->excel->getActiveSheet()->mergeCells('C33:C37');
        $this->excel->getActiveSheet()->mergeCells('C38:C42');
        $this->excel->getActiveSheet()->mergeCells('C43:C47');
        $this->excel->getActiveSheet()->mergeCells('C48:C52');
        $this->excel->getActiveSheet()->mergeCells('C53:C57');
        $this->excel->getActiveSheet()->mergeCells('C58:C62');
        $this->excel->getActiveSheet()->mergeCells('C63:C66');
        $this->excel->getActiveSheet()->mergeCells('C67:C75');
        $this->excel->getActiveSheet()->mergeCells('C76:C78');
        $this->excel->getActiveSheet()->mergeCells('C79:C84');
        $this->excel->getActiveSheet()->mergeCells('C85:C89'); //
        $this->excel->getActiveSheet()->mergeCells('C90:C92');
        $this->excel->getActiveSheet()->mergeCells('C93:C96');
        $this->excel->getActiveSheet()->mergeCells('C97:C100');
        $this->excel->getActiveSheet()->mergeCells('C101:C107');
        $this->excel->getActiveSheet()->mergeCells('C108:C112');
        $this->excel->getActiveSheet()->mergeCells('C113:C116');
        $this->excel->getActiveSheet()->mergeCells('C117:C121');

        $this->excel->getActiveSheet()->mergeCells('D12:D17');
        $this->excel->getActiveSheet()->mergeCells('D18:D22');
        $this->excel->getActiveSheet()->mergeCells('D23:D27');
        $this->excel->getActiveSheet()->mergeCells('D28:D32');
        $this->excel->getActiveSheet()->mergeCells('D33:D37');
        $this->excel->getActiveSheet()->mergeCells('D38:D42');
        $this->excel->getActiveSheet()->mergeCells('D43:D47');
        $this->excel->getActiveSheet()->mergeCells('D48:D52');
        $this->excel->getActiveSheet()->mergeCells('D53:D57');
        $this->excel->getActiveSheet()->mergeCells('D58:D62');
        $this->excel->getActiveSheet()->mergeCells('D63:D66');
        $this->excel->getActiveSheet()->mergeCells('D67:D75');
        $this->excel->getActiveSheet()->mergeCells('D76:D78');
        $this->excel->getActiveSheet()->mergeCells('D79:D84');
        $this->excel->getActiveSheet()->mergeCells('D85:D89'); //
        $this->excel->getActiveSheet()->mergeCells('D90:D92');
        $this->excel->getActiveSheet()->mergeCells('D93:D96');
        $this->excel->getActiveSheet()->mergeCells('D97:D100');
        $this->excel->getActiveSheet()->mergeCells('D101:D107');
        $this->excel->getActiveSheet()->mergeCells('D108:D112');
        $this->excel->getActiveSheet()->mergeCells('D113:D116');
        $this->excel->getActiveSheet()->mergeCells('D117:D121');

        $this->excel->getActiveSheet()->mergeCells('G12:G17');
        $this->excel->getActiveSheet()->mergeCells('G18:G22');
        $this->excel->getActiveSheet()->mergeCells('G23:G27');
        $this->excel->getActiveSheet()->mergeCells('G28:G32');
        $this->excel->getActiveSheet()->mergeCells('G33:G37');
        $this->excel->getActiveSheet()->mergeCells('G38:G42');
        $this->excel->getActiveSheet()->mergeCells('G43:G47');
        $this->excel->getActiveSheet()->mergeCells('G48:G52');
        $this->excel->getActiveSheet()->mergeCells('G53:G57');
        $this->excel->getActiveSheet()->mergeCells('G58:G62');
        $this->excel->getActiveSheet()->mergeCells('G63:G66');
        $this->excel->getActiveSheet()->mergeCells('G67:G75');
        $this->excel->getActiveSheet()->mergeCells('G76:G78');
        $this->excel->getActiveSheet()->mergeCells('G79:G84');
        $this->excel->getActiveSheet()->mergeCells('G85:G89'); //
        $this->excel->getActiveSheet()->mergeCells('G90:G92');
        $this->excel->getActiveSheet()->mergeCells('G93:G96');
        $this->excel->getActiveSheet()->mergeCells('G97:G100');
        $this->excel->getActiveSheet()->mergeCells('G101:G107');
        $this->excel->getActiveSheet()->mergeCells('G108:G112');
        $this->excel->getActiveSheet()->mergeCells('G113:G116');
        $this->excel->getActiveSheet()->mergeCells('G117:G121');

        $this->excel->getActiveSheet()->mergeCells('J12:J62');
        $this->excel->getActiveSheet()->mergeCells('J63:J100');
        $this->excel->getActiveSheet()->mergeCells('J101:J121');

        $this->excel->getActiveSheet()->mergeCells('K12:K62');
        $this->excel->getActiveSheet()->mergeCells('K63:K100');
        $this->excel->getActiveSheet()->mergeCells('K101:K121');

        $this->excel->getActiveSheet()->mergeCells('A122:M122');



        $this->excel->getActiveSheet()->getStyle('A10:N10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A12:N119')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('A121')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue("N122", "=SUM(N12:N121)");

        $this->excel->getActiveSheet()->mergeCells('L12:L17');
        $this->excel->getActiveSheet()->setCellValue("L12", "=SUM(I12:I17)/COUNTIF(I12:I17,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L18:L22');
        $this->excel->getActiveSheet()->setCellValue("L18", "=SUM(I18:I22)/COUNTIF(I18:I22,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L23:L27');
        $this->excel->getActiveSheet()->setCellValue("L23", "=SUM(I23:I27)/COUNTIF(I23:I27,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L28:L32');
        $this->excel->getActiveSheet()->setCellValue("L28", "=SUM(I28:I32)/COUNTIF(I28:I32,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L33:L37');
        $this->excel->getActiveSheet()->setCellValue("L33", "=SUM(I33:I37)/COUNTIF(I33:I37,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L38:L42');
        $this->excel->getActiveSheet()->setCellValue("L38", "=SUM(I38:I42)/COUNTIF(I38:I42,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L43:L47');
        $this->excel->getActiveSheet()->setCellValue("L43", "=SUM(I43:I47)/COUNTIF(I43:I47,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L48:L52');
        $this->excel->getActiveSheet()->setCellValue("L48", "=SUM(I48:I52)/COUNTIF(I48:I52,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L53:L57');
        $this->excel->getActiveSheet()->setCellValue("L53", "=SUM(I53:I57)/COUNTIF(I53:I57,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L58:L62');
        $this->excel->getActiveSheet()->setCellValue("L58", "=SUM(I58:I62)/COUNTIF(I58:I62,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L63:L66');
        $this->excel->getActiveSheet()->setCellValue("L63", "=SUM(I63:I66)/COUNTIF(I63:I66,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L67:L75');
        $this->excel->getActiveSheet()->setCellValue("L67", "=SUM(I67:I75)/COUNTIF(I67:I75,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L76:L78');
        $this->excel->getActiveSheet()->setCellValue("L76", "=SUM(I76:I78)/COUNTIF(I76:I78,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L79:L84');
        $this->excel->getActiveSheet()->setCellValue("L79", "=SUM(I79:I84)/COUNTIF(I79:I84,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L85:L89'); //
        $this->excel->getActiveSheet()->setCellValue("L85", "=SUM(I85:I89)/COUNTIF(I85:I89,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L90:L92');
        $this->excel->getActiveSheet()->setCellValue("L90", "=SUM(I90:I92)/COUNTIF(I90:I92,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L93:L96');
        $this->excel->getActiveSheet()->setCellValue("L93", "=SUM(I93:I96)/COUNTIF(I93:I96,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L97:L100');
        $this->excel->getActiveSheet()->setCellValue("L97", "=SUM(I97:I100)/COUNTIF(I97:I100,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L101:L107');
        $this->excel->getActiveSheet()->setCellValue("L101", "=SUM(I101:I107)/COUNTIF(I101:I107,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L108:L112');
        $this->excel->getActiveSheet()->setCellValue("L108", "=SUM(I108:I112)/COUNTIF(I108:I112,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L113:L116');
        $this->excel->getActiveSheet()->setCellValue("L113", "=SUM(I113:I116)/COUNTIF(I113:I116,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L117:L121');
        $this->excel->getActiveSheet()->setCellValue("L117", "=SUM(I117:I121)/COUNTIF(I117:I121,\">0\"))");

        $this->excel->getActiveSheet()->mergeCells('M12:M17');
        $this->excel->getActiveSheet()->mergeCells('M18:M22');
        $this->excel->getActiveSheet()->mergeCells('M23:M27');
        $this->excel->getActiveSheet()->mergeCells('M28:M32');
        $this->excel->getActiveSheet()->mergeCells('M33:M37');
        $this->excel->getActiveSheet()->mergeCells('M38:M42');
        $this->excel->getActiveSheet()->mergeCells('M43:M47');
        $this->excel->getActiveSheet()->mergeCells('M48:M52');
        $this->excel->getActiveSheet()->mergeCells('M53:M57');
        $this->excel->getActiveSheet()->mergeCells('M58:M62');
        $this->excel->getActiveSheet()->mergeCells('M63:M66');
        $this->excel->getActiveSheet()->mergeCells('M67:M75');
        $this->excel->getActiveSheet()->mergeCells('M76:M78');
        $this->excel->getActiveSheet()->mergeCells('M79:M84');
        $this->excel->getActiveSheet()->mergeCells('M85:M89'); //
        $this->excel->getActiveSheet()->mergeCells('M90:M92');
        $this->excel->getActiveSheet()->mergeCells('M93:M96');
        $this->excel->getActiveSheet()->mergeCells('M97:M100');
        $this->excel->getActiveSheet()->mergeCells('M101:M107');
        $this->excel->getActiveSheet()->mergeCells('M108:M112');
        $this->excel->getActiveSheet()->mergeCells('M113:M116');
        $this->excel->getActiveSheet()->mergeCells('M117:M121');

        $this->excel->getActiveSheet()->mergeCells('N12:N17');
        $this->excel->getActiveSheet()->setCellValue("N12", "=L12*M12");
        $this->excel->getActiveSheet()->mergeCells('N18:N22');
        $this->excel->getActiveSheet()->setCellValue("N18", "=L18*M18");
        $this->excel->getActiveSheet()->mergeCells('N23:N27');
        $this->excel->getActiveSheet()->setCellValue("N23", "=L23*M23");
        $this->excel->getActiveSheet()->mergeCells('N28:N32');
        $this->excel->getActiveSheet()->setCellValue("N28", "=L28*M28");
        $this->excel->getActiveSheet()->mergeCells('N33:N37');
        $this->excel->getActiveSheet()->setCellValue("N33", "=L33*M33");
        $this->excel->getActiveSheet()->mergeCells('N38:N42');
        $this->excel->getActiveSheet()->setCellValue("N38", "=L38*M38");
        $this->excel->getActiveSheet()->mergeCells('N43:N47');
        $this->excel->getActiveSheet()->setCellValue("N43", "=L43*M43");
        $this->excel->getActiveSheet()->mergeCells('N48:N52');
        $this->excel->getActiveSheet()->setCellValue("N48", "=L48*M48");
        $this->excel->getActiveSheet()->mergeCells('N53:N57');
        $this->excel->getActiveSheet()->setCellValue("N53", "=L53*M53");
        $this->excel->getActiveSheet()->mergeCells('N58:N62');
        $this->excel->getActiveSheet()->setCellValue("N58", "=L58*M58");
        $this->excel->getActiveSheet()->mergeCells('N63:N66');
        $this->excel->getActiveSheet()->setCellValue("N63", "=L63*M63");
        $this->excel->getActiveSheet()->mergeCells('N67:N75');
        $this->excel->getActiveSheet()->setCellValue("N67", "=L67*M67");
        $this->excel->getActiveSheet()->mergeCells('N76:N78');
        $this->excel->getActiveSheet()->setCellValue("N76", "=L76*M76");
        $this->excel->getActiveSheet()->mergeCells('N79:N84');
        $this->excel->getActiveSheet()->setCellValue("N79", "=L79*M79");
        $this->excel->getActiveSheet()->mergeCells('N85:N89'); //
        $this->excel->getActiveSheet()->setCellValue("N85", "=L85*M85");
        $this->excel->getActiveSheet()->mergeCells('N90:N92');
        $this->excel->getActiveSheet()->setCellValue("N90", "=L90*M90");
        $this->excel->getActiveSheet()->mergeCells('N93:N96');
        $this->excel->getActiveSheet()->setCellValue("N93", "=L93*M93");
        $this->excel->getActiveSheet()->mergeCells('N97:N100');
        $this->excel->getActiveSheet()->setCellValue("N97", "=L97*M97");
        $this->excel->getActiveSheet()->mergeCells('N101:N107');
        $this->excel->getActiveSheet()->setCellValue("N101", "=L101*M101");
        $this->excel->getActiveSheet()->mergeCells('N108:N112');
        $this->excel->getActiveSheet()->setCellValue("N108", "=L108*M108");
        $this->excel->getActiveSheet()->mergeCells('N113:N116');
        $this->excel->getActiveSheet()->setCellValue("N113", "=L113*M113");
        $this->excel->getActiveSheet()->mergeCells('N117:N121');
        $this->excel->getActiveSheet()->setCellValue("N117", "=L117*M117");

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("4");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("55");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("80");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("J")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("K")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("M")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("N")->setWidth("10");

        $this->excel->getActiveSheet()->getStyle('I12:I122')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $this->excel->getActiveSheet()->getStyle('L12:N122')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);


        //font
        $this->excel->getActiveSheet()->getStyle('A1:A11')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A3:F9')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:N11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A122:N122')->getFont()->setBold(true);
        //size    
        $this->excel->getActiveSheet()->getStyle('A1:D2')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A10:N11')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A122')->getFont()->setSize(18);
        $this->excel->getActiveSheet()->getStyle('N122')->getFont()->setSize(18);

        $this->excel->getActiveSheet()->setShowGridlines(False);
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul3_" . $user_d . "_" . $namaprov . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
