<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
* Penilaian Modul 2 oleh TPI Pusat
* author : 
 * date : 10 des 2020
*/
class PPD3_modul2 extends CI_Controller
{
    var $view_dir   = "ppd3/modul_2/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/module_1/ppd2.js";
    var $allowed    = array("PPD3");

    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        $this->load->library("Excel");
    }


    public function index()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $username = $session->name;
                $iduaer   = $session->id;
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //common properties
                $this->js_init    = "main";
                $this->js_tedit    = "main";
                $this->js_path    = "assets/js/ppd3/PPD3_modul_2/ppd3_modul2.js?v=" . now("Asia/Jakarta");


                $data_page = array(
                    "username" => $username,
                    // "jmlprov"=>$jml_prov
                );
                $str = $this->load->view($this->view_dir . "index_ppd2", $data_page, TRUE);

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
    /*
     * progres provinsi dan atau Kabupaten/kota
     * author :  
     * date : 28 des 2021
     */
    function g_progres()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $iduaer   = $session->id;
                //jumlah wilayah penilaian provinsi
                $sql = "SELECT W.* FROM `tbl_user_t2_prov` W WHERE W.`iduser`='" . $iduaer . "'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_prov = $list_data->num_rows();
                //jumlah item provinsi
                $sql = "SELECT COUNT(1) jml
                        FROM `r_mdl2_item` IT
                        JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid` 
                        JOIN `r_mdl2_indi` I ON I.`id`=SI.`indiid`
                        JOIN `r_mdl2_krtria` K ON K.`id`=I.`krtriaid`";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_item = $list_data->num_rows();
                $sum_item = $list_data->row()->jml;
                $total_item = $jml_prov * $sum_item;

                //jumlah lembar kertas kerja
                $sql = "SELECT COUNT(1) jml FROM `t_mdl2_sttment_prov` S
                    JOIN `tbl_user_t2_prov` W ON W.`id`=S.mapid
                    JOIN `tbl_user` U ON U.id = W.`iduser`
                    WHERE U.id='" . $iduaer . "'";

                $list_data_l = $this->db->query($sql);
                if (!$list_data_l) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_lembar = $list_data_l->row()->jml;
                //Jumlah penyelesaian modul
                $sql = "SELECT COUNT(1) jml_ttl
                    FROM `tbl_user` U
                    JOIN `tbl_user_t2_prov` W ON W.`iduser`=U.id
                    JOIN `t_mdl2_skor_p` P ON P.mapid=W.`id`
                    JOIN `r_mdl2_item` IT ON IT.id=P.itemindi
                                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid` 
                                            JOIN `r_mdl2_indi` I ON I.`id`=SI.`indiid`
                                            JOIN `r_mdl2_krtria` K ON K.`id`=I.`krtriaid`
                                            WHERE U.id=" . $iduaer . "";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_penyelesain = $list_data->row()->jml_ttl;
                if ($jml_penyelesain == '0') {
                    $total_penyelesaian = '0';
                } else {
                    $total_penyelesaian = $jml_penyelesain / $total_item * 100;
                }

                $warna_p = '';
                if ($total_penyelesaian <= '33') {
                    $warna_p = '#ef5350'; //merah
                } elseif (($total_penyelesaian > '33') && ($total_penyelesaian < '100')) {
                    $warna_p = '#ffd740'; //kuning
                } elseif ($total_penyelesaian == '100') {
                    if ($jml_lembar <= '2') {
                        $warna_p = '#ffd740'; //kuning
                    } else {
                        $warna_p = '#29b6f6'; //Biru
                    }
                }

                $strPro = "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : " . $jml_lembar . "/" . $jml_prov . " Selesai</p>
                    <div class='progress progress-sm' style='margin-bottom: 0px;' >
                    <div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' 
                        aria-valuenow='" . $total_penyelesaian . "' aria-valuemin='0' aria-valuemax='100' 
                        style='width: " . $total_penyelesaian . "%; background-color: " . $warna_p . "!important;'>
                              <span class='sr-only'>" . $total_penyelesaian . "% Complete</span>
                            </div></div>";

                //jumlah wilayah penilaian kabupaten
                $sql = "SELECT U.* FROM `tbl_user_t2_kabkot` U LEFT JOIN `kabupaten` K ON K.id=U.idkabkot WHERE U.`iduser`='" . $iduaer . "' AND K.urutan=0";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_kab = $list_data->num_rows();
                //jumlah item Kabupaten/kota
                $sql = "SELECT COUNT(1) jml FROM `r_mdl2_item` IT JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`  JOIN `r_mdl2_indi` I ON I.`id`=SI.`indiid` JOIN `r_mdl2_krtria` K ON K.`id`=I.`krtriaid`";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_item_kab = $list_data->num_rows();
                $sum_item_kabko = $list_data->row()->jml;
                $total_item_kab = $jml_kab * $sum_item_kabko;

                //jumlah lembar kertas kerja kabupaten
                $sql = "SELECT COUNT(1) jml FROM `t_mdl2_sttment_kabkota` S
                    JOIN `tbl_user_t2_kabkot` W ON W.`id`=S.mapid
                    JOIN `tbl_user` U ON U.id = W.`iduser`
                    JOIN `kabupaten` K ON K.id=W.`idkabkot`
                    WHERE U.id='" . $iduaer . "' AND K.urutan=0";
                $list_data_l = $this->db->query($sql);
                if (!$list_data_l) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_lembar_kab = $list_data_l->row()->jml;
                //Jumlah penyelesaian modul Kabupaten
                $sql = "SELECT COUNT(1) jml_ttl
                        FROM `tbl_user` U
                        JOIN `tbl_user_t2_kabkot` W ON W.`iduser`=U.id
                        JOIN `kabupaten` KK ON KK.id=W.`idkabkot`
                        JOIN `t_mdl2_skor_k` P ON P.mapid=W.`id`
                        JOIN `r_mdl2_item` IT ON IT.id=P.itemindi
                        JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid` 
                        JOIN `r_mdl2_indi` I ON I.`id`=SI.`indiid`
                        JOIN `r_mdl2_krtria` K ON K.`id`=I.`krtriaid`
                        WHERE U.id=" . $iduaer . " AND KK.urutan=0";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_penyelesain_kab = $list_data->row()->jml_ttl;
                if ($jml_penyelesain_kab == '0') {
                    $total_penyelesaian_kab = '0';
                } else {
                    $total_penyelesaian_kab = $jml_penyelesain_kab / $total_item_kab * 100;
                }
                //$total_penyelesaian_kab=$jml_penyelesain_kab/$total_item_kab*100;
                $warna_kab = '';
                if ($total_penyelesaian_kab <= '33') {
                    $warna_kab = '#ef5350'; //merah
                } elseif ($total_penyelesaian_kab > '33' || $total_penyelesaian <= '66') {
                    $warna_kab = '#ffd740'; //kuning
                } elseif ($total_penyelesaian_kab > '66') {
                    if ($jml_lembar_kab <= '2') {
                        $warna_kab = '#ffd740'; //kuning
                    } else {
                        $warna_kab = '#29b6f6'; //Biru
                    }
                }
                $strKab = "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : " . $jml_lembar_kab . "/" . $jml_kab . " Selesai</p>
                    <div class='progress progress-sm' style='margin-bottom: 0px;' >
                    <div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' 
                        aria-valuenow='66.6' aria-valuemin='66.6' aria-valuemax='100' 
                        style='width: " . $total_penyelesaian_kab . "%; background-color: " . $warna_kab . "!important;'>
                              <span class='sr-only'>10.6% Complete</span>
                            </div></div>";

                //jumlah wilayah penilaian kota
                $sql = "SELECT U.* FROM `tbl_user_t2_kabkot` U LEFT JOIN `kabupaten` K ON K.id=U.idkabkot WHERE U.`iduser`='" . $iduaer . "' AND K.urutan=1";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_kot = $list_data->num_rows();
                $total_item_kot = $jml_kot * $sum_item_kabko;
                //jumlah lembar kertas kerja kabupaten
                $sql = "SELECT COUNT(1) jml FROM `t_mdl2_sttment_kabkota` S
                    JOIN `tbl_user_t2_kabkot` W ON W.`id`=S.mapid
                    JOIN `tbl_user` U ON U.id = W.`iduser`
                    JOIN `kabupaten` K ON K.id=W.`idkabkot`
                    WHERE U.id='" . $iduaer . "' AND K.urutan=1";
                $list_data_l = $this->db->query($sql);
                if (!$list_data_l) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_lembar_kot = $list_data_l->row()->jml;
                //Jumlah penyelesaian modul Kabupaten
                $sql = "SELECT COUNT(1) jml_ttl
                        FROM `tbl_user` U
                        JOIN `tbl_user_t2_kabkot` W ON W.`iduser`=U.id
                        JOIN `kabupaten` KK ON KK.id=W.`idkabkot`
                        JOIN `t_mdl2_skor_k` P ON P.mapid=W.`id`
                        JOIN `r_mdl2_item` IT ON IT.id=P.itemindi
                        JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid` 
                        JOIN `r_mdl2_indi` I ON I.`id`=SI.`indiid`
                        JOIN `r_mdl2_krtria` K ON K.`id`=I.`krtriaid`
                        WHERE U.id=" . $iduaer . " AND KK.urutan=1";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_penyelesain_kot = $list_data->row()->jml_ttl;
                if ($jml_penyelesain_kot == '0') {
                    $total_penyelesaian_kot = '0';
                } else {
                    $total_penyelesaian_kot = $jml_penyelesain_kot / $total_item_kot * 100;
                }
                //$total_penyelesaian_kot=$jml_penyelesain_kot/$total_item_kot*100;

                $warna_kot = '';
                if ($total_penyelesaian_kot <= '33') {
                    $warna_kot = '#ef5350'; //merah
                } elseif ($total_penyelesaian_kot > '33' || $total_penyelesaian_kot <= '66') {
                    $warna_kot = '#ffd740'; //kuning
                } elseif ($total_penyelesaian_kot > '66') {
                    if ($jml_lembar_kot <= '2') {
                        $warna_kot = '#ffd740'; //kuning
                    } else {
                        $warna_kot = '#29b6f6'; //Biru
                    }
                }
                $strKot = "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : " . $jml_lembar_kot . "/" . $jml_kot . " Selesai</p>
                    <div class='progress progress-sm' style='margin-bottom: 0px;' >
                    <div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' 
                        aria-valuenow='66.6' aria-valuemin='66.6' aria-valuemax='100' 
                        style='width: " . $total_penyelesaian_kot . "%; background-color: " . $warna_kot . "!important;'>
                              <span class='sr-only'>10.6% Complete</span>
                            </div></div>";
                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "strPro"       => $strPro,
                    "strKab"       => $strKab,
                    "strKot"       => $strKot,

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
     * list data wilayah provinsi dan atau Kabupaten/kota
     * author :  
     * date : 10 des 2020
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
                $this->form_validation->set_rules('kate', 'Kategori Wilayah', 'required|in_list[PROV,KAB,KOTA]');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $inp_katewlyh = $this->input->post("kate");

                //get jml aspek modul 2
                $sql = "SELECT A.`id` FROM r_mdl2_aspek A WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_aspek = $list_data->num_rows();


                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                $str = "";
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY PROVINSI - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($inp_katewlyh == "PROV") {
                    //get jml item
                    // $sql = "SELECT I.`id`
                    //         FROM `r_mdl2_item` I 
                    //         WHERE I.`isactive`='Y'";

                    $sql = "SELECT I.`id`
                            FROM `r_mdl2_item` I";

                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
                    }
                    $jml_item = $list_data->num_rows();

                    //LIST PROVINSI
                    $sql = "SELECT A.`id` mapid,P.id idprov,P.`nama_provinsi` nmprov,P.id_kode id_kode,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_t2_prov A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_t2_prov` W
                                    JOIN `t_mdl2_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_t2_prov` W
                                    JOIN `t_mdl2_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl2_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                    $bind = array($session->id, $session->id, $session->id);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
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
                            $idcomb = $inp_katewlyh . "-" . $v->mapid;
                            $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));

                            $tmp = "class='btn btn-sm btn-success waves-effect waves-light btn-mulai-penilaian getDetail' data-id='" . $encrypted_id . "'";
                            $tmp .= " data-nmwlyh='" . $v->nmprov . "'";

                            $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                            $str .= "<div style='display: flex;'>";
                            $str .= "<img src='" . base_url() . "assets/icons/PNG_Provinsi/" . $v->id_kode . "_" . $v->nmprov . ".png' width='100' height='100' alt='" . $v->nmprov . "' title='" . $v->nmprov . "' style='padding: 15px;'>";
                            $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-bottom: 0.8rem; padding-left: 0px;'>";
                            $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";

                            $str .= "<h4 class='title-regional-name'>" . $v->nmprov . "</h4>";

                            $str .= "<div class='btn-wilayah' style='float: right;'>";

                            //TAUTAN DOC
                            $idcomb_prov = $inp_katewlyh . '-' . $v->idprov;
                            $encrypted_provid = base64_encode(openssl_encrypt($idcomb_prov, "AES-128-ECB", ENCRYPT_PASS));
                            $tmp_prov1 = "class='btn btn-sm btn-warning waves-effect waves-light btn-unduh-bahan-dukung getNilai' data-id='" . $encrypted_provid . "'";
                            $tmp_prov1 .= " data-nmwlyh='" . $v->nmprov . "'";

                            $tmp_prov = "class='btn btn-sm btn-primary waves-effect waves-light btn-unduh-bahan-dukung getDoc' data-id='" . $encrypted_provid . "'";
                            $tmp_prov .= " data-nmwlyh='" . $v->nmprov . "'";

                            $str .= "<a href='javascript:void(0)' " . $tmp_prov1 . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Unggah Penilaian<i class='fas fa-upload' style='padding-left: 5px;'></i></a>";
                            //$str .= "<a href='javascript:void(0)' ".$tmp_prov." style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Unduh Bahan Dukung <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                            $str .= "<a href='javascript:void(0)' " . $tmp . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Mulai Penilaian <i class='fa fa-caret-right' style='padding-left: 5px;'></i></a>";

                            //status
                            $prcntg = ($jml_item == 0 ? 0 : $v->jml / $jml_item * 100);

                            $str_tmp = number_format($prcntg, 2) . "&nbsp;%";
                            /* if($prcntg==1){
                                $str .= "<button type='button' class='btn btn-sm btn-info waves-effect waves-light' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'><i class='ion ion-md-checkmark-circle-outline'></i></button>";
                            } */

                            //status
                            $color_progress = "#ffd740";
                            $notif_warning = "";
                            if ($prcntg == 100) {
                                $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getDetail' data-id='" . $encrypted_id . "' data-nmwlyh='" . $v->nmprov . "' data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                                $str_icon = "<i class='fas fa-exclamation'></i>";
                                $notif_warning = "<p style='margin-bottom: 0px; color: red !important; font-size: 0.8rem; float: right;'>" . $str_icon . " anda belum menyelesaikan data resume aspek</p>";
                                $color_progress = "#ffd740";
                                if ($v->jml_rsm == $jml_aspek) {
                                    if (!is_null($v->stts)) {
                                        $str_tmp = "class='btn btn-sm btn-info waves-effect waves-light btn-status getSttmnt' data-id='" . $encrypted_id . "' data-toggle='tooltip' data-placement='top' title='klik untuk lihat detail lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#29b6f6";
                                        $notif_warning = "";
                                    } else {
                                        $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getSttmnt' data-id='" . $encrypted_id . "' data-toggle='tooltip' data-placement='top' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#33b86c";
                                        $notif_warning = "<p style='margin-bottom: 0px; color: red !important; font-size: 0.8rem; float: right;'>" . $str_icon . " anda belum menyelesaikan lembar pernyataan</p>";
                                    }
                                }
                                $str .= "<a href='javascript:void(0);' " . $str_tmp . ">" . $str_icon . "</a>";
                            }

                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div class='mt-0'>";
                            $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : " . number_format($prcntg, 2) . " %</p>";
                            $str .= "<div class='progress progress-sm' style='margin-bottom: 0px;'>";
                            $str .= "<div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . number_format($prcntg, 2) . "' aria-valuemin='0' aria-valuemax='100' style='width: " . number_format($prcntg, 2) . "%; background-color: " . $color_progress . "!important;'>";
                            $str .= "<span class='sr-only'>" . number_format($prcntg, 2) . " % Complete</span>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= $notif_warning;
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "</div>";
                        }
                    }
                }
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY PROVINSI - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY KABUPATEN - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */ elseif ($inp_katewlyh == 'KAB') {
                    //get jml item
                    // $sql = "SELECT I.`id`
                    //         FROM `r_mdl2_item` I 
                    //         WHERE I.`isactive`='Y'";

                    $sql = "SELECT I.`id`
                            FROM `r_mdl2_item` I";

                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL Kab 1!");
                    }
                    $jml_item = $list_data->num_rows();
                    //LIST KABUPATEN
                    $sql = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                    $bind = array($session->id, $session->id, $session->id);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL Kab 2!");
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
                            $idcomb = $inp_katewlyh . "-" . $v->mapid;
                            $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));

                            $tmp = "class='btn btn-sm btn-success waves-effect waves-light btn-mulai-penilaian getDetail' data-id='" . $encrypted_id . "'";
                            $tmp .= " data-nmwlyh='" . $v->nmkab . "'";


                            $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                            $str .= "<div style='display: flex;'>";
                            $str .= "<img src='" . base_url() . "assets/icons/PNG_KabupatenKota/" . $v->id_kode . "_" . $v->nmkab . ".png' width='100' height='100' alt='" . $v->nmkab . "' title='" . $v->nmkab . "' style='padding: 15px;'>";
                            $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-bottom: 0.8rem; padding-left: 0px;'>";
                            $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";

                            $str .= "<h4 class='title-regional-name'>" . $v->nmkab . "</h4>";

                            $str .= "<div class='btn-wilayah' style='float: right;'>";

                            //TAUTAN DOC
                            $idcomb_kab = $inp_katewlyh . '-' . $v->idkab;
                            $encrypted_provid = base64_encode(openssl_encrypt($idcomb_kab, "AES-128-ECB", ENCRYPT_PASS));
                            $tmp_kab = "class='btn btn-sm btn-primary waves-effect waves-light btn-unduh-bahan-dukung getDoc' data-id='" . $encrypted_provid . "'";
                            $tmp_kab .= " data-nmwlyh='" . $v->nmkab . "'";

                            $tmp_kab1 = "class='btn btn-sm btn-warning waves-effect waves-light btn-unduh-bahan-dukung getNilai' data-id='" . $encrypted_provid . "'";
                            $tmp_kab1 .= " data-nmwlyh='" . $v->nmkab . "'";

                            $str .= "<a href='javascript:void(0)' " . $tmp_kab1 . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Unggah Penilaian<i class='fas fa-upload' style='padding-left: 5px;'></i></a>";
                            //$str .= "<a href='javascript:void(0)' ".$tmp_kab." style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Unduh Bahan Dukung <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                            $str .= "<a href='javascript:void(0)' " . $tmp . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Mulai Penilaian <i class='fa fa-caret-right' style='padding-left: 5px;'></i></a>";

                            //status
                            $prcntg = $jml_item == 0 ? 0 : $v->jml / $jml_item * 100;

                            $str_tmp = number_format($prcntg, 2) . "&nbsp;%";
                            /* if($prcntg==1){
                                $str .= "<button type='button' class='btn btn-sm btn-info waves-effect waves-light' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'><i class='ion ion-md-checkmark-circle-outline'></i></button>";
                            } */

                            //status
                            $color_progress = "#ffd740";
                            $notif_warning = "";
                            if ($prcntg == 100) {
                                $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getDetail' data-id='" . $encrypted_id . "' data-nmwlyh='" . $v->nmkab . "' data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                                $str_icon = "<i class='fas fa-exclamation'></i>";
                                $notif_warning = "<p style='margin-bottom: 0px; color: red !important; font-size: 0.8rem; float: right;'>" . $str_icon . " anda belum menyelesaikan data resume aspek</p>";
                                $color_progress = "#ffd740";
                                if ($v->jml_rsm == $jml_aspek) {
                                    if (!is_null($v->stts)) {
                                        $str_tmp = "class='btn btn-sm btn-info waves-effect waves-light btn-status getSttmnt' data-id='" . $encrypted_id . "' data-toggle='tooltip' data-placement='top' title='klik untuk lihat detail lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#29b6f6";
                                        $notif_warning = "";
                                    } else {
                                        $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getSttmnt' data-id='" . $encrypted_id . "' data-toggle='tooltip' data-placement='top' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#33b86c";
                                        $notif_warning = "<p style='margin-bottom: 0px; color: red !important; font-size: 0.8rem; float: right;'>" . $str_icon . " anda belum menyelesaikan lembar pernyataan</p>";
                                    }
                                }
                                $str .= "<a href='javascript:void(0);' " . $str_tmp . ">" . $str_icon . "</a>";
                            }

                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div class='mt-0'>";
                            $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : " . number_format($prcntg, 2) . " %</p>";
                            $str .= "<div class='progress progress-sm' style='margin-bottom: 0px;'>";
                            $str .= "<div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . number_format($prcntg, 2) . "' aria-valuemin='0' aria-valuemax='100' style='width: " . number_format($prcntg, 2) . "%; background-color: " . $color_progress . "!important;'>";
                            $str .= "<span class='sr-only'>" . number_format($prcntg, 2) . " % Complete</span>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= $notif_warning;
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "</div>";
                        }
                    }
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY KABUPATEN - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY KOTA - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */ elseif ($inp_katewlyh == 'KOTA') {
                    //get jml item
                    // $sql = "SELECT I.`id`
                    //         FROM r_mdl2_item I 
                    //         JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov='N'
                    //         JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y'";
                    // $list_data = $this->db->query($sql);
                    // if(!$list_data){
                    //     $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    //     log_message("error", $msg);
                    //     throw new Exception("Invalid SQL!");
                    // }
                    // $jml_item = $list_data->num_rows();

                    //get jml item
                    // $sql = "SELECT I.`id`
                    //         FROM `r_mdl2_item` I 
                    //         WHERE I.`isactive`='Y'";

                    $sql = "SELECT I.`id`
                            FROM `r_mdl2_item` I";

                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL Kota 1!");
                    }
                    $jml_item = $list_data->num_rows();

                    //LIST KOTA
                    $sql = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";

                    $bind = array($session->id, $session->id, $session->id);
                    $list_data = $this->db->query($sql, $bind);
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
                            $idcomb = $inp_katewlyh . "-" . $v->mapid;
                            $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));

                            $tmp = "class='btn btn-sm btn-success waves-effect waves-light btn-mulai-penilaian getDetail' data-id='" . $encrypted_id . "'";
                            $tmp .= " data-nmwlyh='" . $v->nmkab . "'";

                            $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                            $str .= "<div style='display: flex;'>";
                            $str .= "<img src='" . base_url() . "assets/icons/PNG_KabupatenKota/" . $v->id_kode . "_" . $v->nmkab . ".png' width='100' height='100' alt='" . $v->nmkab . "' title='" . $v->nmkab . "' style='padding: 15px;'>";
                            $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-bottom: 0.8rem; padding-left: 0px;'>";
                            $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";

                            $str .= "<h4 class='title-regional-name'>" . $v->nmkab . "</h4>";

                            $str .= "<div class='btn-wilayah' style='float: right;'>";

                            //TAUTAN DOC
                            $idcomb_kab = $inp_katewlyh . '-' . $v->idkab;
                            $encrypted_provid = base64_encode(openssl_encrypt($idcomb_kab, "AES-128-ECB", ENCRYPT_PASS));
                            $tmp_kab = "class='btn btn-sm btn-primary waves-effect waves-light btn-unduh-bahan-dukung getDoc' data-id='" . $encrypted_provid . "'";
                            $tmp_kab .= " data-nmwlyh='" . $v->nmkab . "'";
                            $tmp_kab1 = "class='btn btn-sm btn-warning waves-effect waves-light btn-unduh-bahan-dukung getNilai' data-id='" . $encrypted_provid . "'";
                            $tmp_kab1 .= " data-nmwlyh='" . $v->nmkab . "'";

                            $str .= "<a href='javascript:void(0)' " . $tmp_kab1 . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Unggah Penilaian<i class='fas fa-upload' style='padding-left: 5px;'></i></a>";
                            //$str .= "<a href='javascript:void(0)' ".$tmp_kab." style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Unduh Bahan Dukung <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                            $str .= "<a href='javascript:void(0)' " . $tmp . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Mulai Penilaian <i class='fa fa-caret-right' style='padding-left: 5px;'></i></a>";

                            //status
                            $prcntg = $jml_item == 0 ? 0 : $v->jml / $jml_item * 100;

                            $str_tmp = number_format($prcntg, 2) . "&nbsp;%";

                            /* if($prcntg==1){
                                $str .= "<button type='button' class='btn btn-sm btn-info waves-effect waves-light' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'><i class='ion ion-md-checkmark-circle-outline'></i></button>";
                            } */

                            //status
                            $color_progress = "#ffd740";
                            $notif_warning = "";
                            if ($prcntg == 100) {
                                $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getDetail' data-id='" . $encrypted_id . "' data-nmwlyh='" . $v->nmkab . "' data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                                $str_icon = "<i class='fas fa-exclamation'></i>";
                                $notif_warning = "<p style='margin-bottom: 0px; color: red !important; font-size: 0.8rem; float: right;'>" . $str_icon . " anda belum menyelesaikan data resume aspek</p>";
                                $color_progress = "#ffd740";
                                if ($v->jml_rsm == $jml_aspek) {
                                    if (!is_null($v->stts)) {
                                        $str_tmp = "class='btn btn-sm btn-info waves-effect waves-light btn-status getSttmnt' data-id='" . $encrypted_id . "' data-toggle='tooltip' data-placement='top' title='klik untuk lihat detail lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#29b6f6";
                                        $notif_warning = "";
                                    } else {
                                        $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getSttmnt' data-id='" . $encrypted_id . "' data-toggle='tooltip' data-placement='top' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#33b86c";
                                        $notif_warning = "<p style='margin-bottom: 0px; color: red !important; font-size: 0.8rem; float: right;'>" . $str_icon . " anda belum menyelesaikan lembar pernyataan</p>";
                                    }
                                }
                                $str .= "<a href='javascript:void(0);' " . $str_tmp . ">" . $str_icon . "</a>";
                            }

                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div class='mt-0'>";
                            $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : " . number_format($prcntg, 2) . " %</p>";
                            $str .= "<div class='progress progress-sm' style='margin-bottom: 0px;'>";
                            $str .= "<div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . number_format($prcntg, 2) . "' aria-valuemin='0' aria-valuemax='100' style='width: " . number_format($prcntg, 2) . "%; background-color: " . $color_progress . "!important;'>";
                            $str .= "<span class='sr-only'>" . number_format($prcntg, 2) . " % Complete</span>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= $notif_warning;
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "</div>";
                        }
                    }
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY KOTA - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */

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
     * list data indikator
     * author :  
     * date : 10 des 2020
     */
    function g_indi()
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
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];

                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");


                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($kate_wlyh == "PROV") {
                    $sql = "SELECT A.id idindi,B.id idkriteria,ASP.id idaspek,ASP.nama nmaspek,B.`nama` nmkriteria,A.`nama` nmindi,ASP.bobot bobotaspek,A.`bobot` bobotindi,B.`bobot` bobotkriteria,A.`note` noteindi
                            ,A.nourut,COUNT(1) jml,IFNULL(LAPOR.jml,0) jmllapor,RSM.`stts` stts_rsm
                            FROM `r_mdl2_indi` A
                            JOIN `r_mdl2_krtria` B ON B.`id`=A.`krtriaid`
                            JOIN `r_mdl2_aspek` ASP ON ASP.id=B.aspekid
                            JOIN `r_mdl2_sub_indi` SI ON SI.`indiid`=A.`id`
                            JOIN `r_mdl2_item` I ON I.`subindiid`=SI.`id`
                            LEFT JOIN (
					SELECT MII.id idindi,COUNT(1) jml
					FROM `tbl_user_t2_prov` W
					JOIN `t_mdl2_skor_p` SP ON SP.`mapid`=W.`id`
					JOIN `r_mdl2_item` MI ON MI.`id`=SP.`itemindi`
					JOIN `r_mdl2_sub_indi` SI ON SI.`id`=MI.`subindiid`
					JOIN `r_mdl2_indi` MII ON MII.`id`=SI.`indiid`
					WHERE W.`id`=?
					GROUP BY MII.`id`
					)LAPOR ON LAPOR.idindi=A.`id`
                            LEFT JOIN `t_mdl2_resume_prov` RSM ON RSM.`aspekid`=ASP.`id` AND RSM.`mapid`=?
                            GROUP BY A.`id`
                            ORDER BY B.`id`,A.nourut";
                    $bind = array($idmap, $idmap);
                    $list_data = $this->db->query($sql, $bind);

                    /*
                    * +++++++++++++++++++++++++++++++++++++++++
                    * CHECK KELENGKAPAN RESUME PROVINSI - START
                    * +++++++++++++++++++++++++++++++++++++++++
                    */
                    $sql = "SELECT COUNT(A.id) jml, SUM(CASE WHEN B.`id` IS NULL THEN 0 ELSE 1 END) jml_rsm
                           FROM `r_mdl2_aspek` A
                           LEFT JOIN `t_mdl2_resume_prov` B ON A.`id`=B.`aspekid` AND B.`mapid`=?
                           WHERE A.`isactive`='Y'";
                    $bind = array($idmap);
                    $list_check = $this->db->query($sql, $bind);
                    if (!$list_check) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if ($list_check->num_rows() == 0)
                        throw new Exception("Data Kriteria tidak ditemukan!");

                    $sttsDispSttment = 'N';
                    if ($list_check->row()->jml > 0 && $list_check->row()->jml == $list_check->row()->jml_rsm)
                        $sttsDispSttment = 'Y';

                    /*
                    * +++++++++++++++++++++++++++++++++++++++
                    * CHECK KELENGKAPAN RESUME PROVINSI- END
                    * +++++++++++++++++++++++++++++++++++++++
                    */

                    if ($sttsDispSttment == 'Y') {
                        $sql = "SELECT id FROM t_mdl2_sttment_prov WHERE mapid=?";
                        $bind = array($idmap);
                        $list_check = $this->db->query($sql, $bind);
                        if (!$list_check) {
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception("Invalid SQL!");
                        }
                        if ($list_check->num_rows() > 0)
                            $sttsDispSttment = 'N';
                    }
                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    //LIST INDIKATOR
                    $sql = "SELECT A.id idindi,B.id idkriteria,ASP.id idaspek,ASP.nama nmaspek,B.`nama` nmkriteria,A.`nama` nmindi,ASP.bobot bobotaspek,A.`bobot` bobotindi,B.`bobot` bobotkriteria,A.`note` noteindi
                            ,A.nourut,COUNT(1) jml,IFNULL(LAPOR.jml,0) jmllapor,RSM.`stts` stts_rsm
                            FROM `r_mdl2_indi` A
                            JOIN `r_mdl2_krtria` B ON B.`id`=A.`krtriaid`
                            JOIN `r_mdl2_aspek` ASP ON ASP.id=B.aspekid
                            JOIN `r_mdl2_sub_indi` SI ON SI.`indiid`=A.`id`
                            JOIN `r_mdl2_item` I ON I.`subindiid`=SI.`id`
                            LEFT JOIN (
					SELECT MII.id idindi,COUNT(1) jml
					FROM `tbl_user_t2_kabkot` W
					JOIN `t_mdl2_skor_k` SP ON SP.`mapid`=W.`id`
					JOIN `r_mdl2_item` MI ON MI.`id`=SP.`itemindi`
					JOIN `r_mdl2_sub_indi` SI ON SI.`id`=MI.`subindiid`
					JOIN `r_mdl2_indi` MII ON MII.`id`=SI.`indiid`
					WHERE W.`id`=?
					GROUP BY MII.`id`
					)LAPOR ON LAPOR.idindi=A.`id`
                            LEFT JOIN `t_mdl2_resume_kabkota` RSM ON RSM.`aspekid`=ASP.`id` AND RSM.`mapid`=?
                            GROUP BY A.`id`
                            ORDER BY B.`id`,A.nourut";
                    $bind = array($idmap, $idmap);
                    $list_data = $this->db->query($sql, $bind);

                    /*
                    * +++++++++++++++++++++++++++++++++++++++++++
                    * CHECK KELENGKAPAN RESUME KABUPATEN - START
                    * +++++++++++++++++++++++++++++++++++++++++++
                    */
                    $sql = "SELECT COUNT(A.id) jml, SUM(CASE WHEN B.`id` IS NULL THEN 0 ELSE 1 END) jml_rsm
                           FROM `r_mdl2_aspek` A
                           LEFT JOIN `t_mdl2_resume_kabkota` B ON A.`id`=B.`aspekid` AND B.`mapid`=?
                           WHERE A.`isactive`='Y'";
                    $bind = array($idmap);
                    $list_check = $this->db->query($sql, $bind);
                    if (!$list_check) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if ($list_check->num_rows() == 0)
                        throw new Exception("Data Kriteria tidak ditemukan!");

                    $sttsDispSttment = 'N';
                    if ($list_check->row()->jml > 0 && $list_check->row()->jml == $list_check->row()->jml_rsm)
                        $sttsDispSttment = 'Y';

                    /*
                    * +++++++++++++++++++++++++++++++++++++++++
                    * CHECK KELENGKAPAN RESUME KABUPATEN - END
                    * +++++++++++++++++++++++++++++++++++++++++
                    */

                    if ($sttsDispSttment == 'Y') {
                        $sql = "SELECT id FROM t_mdl2_sttment_kabkota WHERE mapid=?";
                        $bind = array($idmap);
                        $list_check = $this->db->query($sql, $bind);
                        if (!$list_check) {
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception("Invalid SQL!");
                        }
                        if ($list_check->num_rows() > 0)
                            $sttsDispSttment = 'N';
                    }
                }


                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";

                $no = 1;
                $idkriteria = $idaspek = "";
                $no = 1;
                foreach ($list_data->result() as $v) {

                    $idcomb = $kate_wlyh . "-" . $idmap . "-" . $v->idaspek;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    if ($v->idaspek != $idaspek) {
                        $str .= "<tr class='alert-info' title='Status Kelengkapan Resume Aspek'>";
                        $str .= "<td colspan='2' class='text-uppercase'><b><small>Aspek</small><br/>" . $v->nmaspek . "</b></td>";
                        $str .= "<td colspan='' class='text-uppercase text-vertical-center text-right'><b>" . number_format($v->bobotaspek, 2) . "&nbsp;%</b></td>";

                        //status resume
                        $tmp = " data-id='" . $encrypted_id . "'";
                        $tmp .= " data-nmaspek='" . $v->nmaspek . "'";

                        $str_aspek = "";
                        if ($v->stts_rsm == 'Y')
                            $str_aspek .= "<a href='javascript:void(0);' class='_mdlRsm' " . $tmp . " ><i class='fas fa-check-circle fa-2x text-info'></i></span>";
                        else if ($v->stts_rsm == 'N')
                            $str_aspek .= "<a href='javascript:void(0);' class='btn btn-warning _mdlRsm' " . $tmp . " title='Klik untuk mengisi Resume dan masukan Aspek'><i class='fas fa-exclamation fa-2x'></i></span>";

                        $str .= "<td class='text-center text-vertical-center'>" . $str_aspek . "</td>";
                        //$str.="<td class='text-center text-vertical-center'></td>";
                        $str .= "</tr>";
                        $idaspek = $v->idaspek;
                    }
                    if ($v->idkriteria != $idkriteria) {
                        $str .= "<tr class='alert-warning'>";
                        $str .= "<td colspan='2' class='text-uppercase pl-4'><b><small>Kriteria</small><br/>" . $v->nmkriteria . "</b></td>";
                        $str .= "<td colspan='' class='text-uppercase text-vertical-center text-right'><b>" . number_format($v->bobotkriteria, 2) . "&nbsp;%</b></td>";


                        $str .= "<td class='text-center'></td>";
                        $str .= "</tr>";
                        $idkriteria = $v->idkriteria;
                    }

                    $idcomb = $kate_wlyh . "-" . $idmap . "-" . $v->idindi;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-nmaspek='" . $v->nmaspek . "'";
                    $tmp .= " data-nmkriteria='" . $v->nmkriteria . "'";
                    $tmp .= " data-nmindi='" . $v->nmindi . "'";
                    $str .= "<tr>";
                    $str .= "<td class='text-center'>" . $v->nourut . "</td>";
                    // $str.="<td class='p-l-25'><a href='javascript:void(0)' ".$tmp.">".wordwrap($v->nmindi,50,"<br/>")."</a></td>";
                    $str .= "<td class='p-l-25' style='white-space: inherit;'><a href='javascript:void(0)' " . $tmp . ">" . $v->nmindi . "</a></td>";

                    $str .= "<td class='text-right'>" . number_format($v->bobotindi, 2) . "&nbsp;%</td>";

                    //status
                    $prcntg = $v->jml == 0 ? 0 : $v->jmllapor / $v->jml * 100;

                    $str_tmp = "<span class='badge badge-warning'>" . number_format($prcntg, 2) . "&nbsp;%</span>";
                    //$str_tmp = "<span class='badge badge-warning'></span>";
                    if ($prcntg == 100) {
                        $str_tmp = "<i class='fas fa-check-circle fa-2x text-success' title='Lengkap'></i>";
                    }

                    $str .= "<td class='text-center'>" . $str_tmp . "</td>";

                    $str .= "</tr>";
                }


                $response = array(
                    "status"            => 1,
                    "csrf_hash"         => $this->security->get_csrf_hash(),
                    "str"               => $str,
                    "sttsDispSttment"   => $sttsDispSttment,
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
     * list data item
     * author :  
     * date : 10 des 2020
     */
    function g_grafik_aspek()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $this->form_validation->set_rules('kate', 'Kategori Wilayah', 'required|in_list[PROV,KAB,KOTA]');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $inp_katewlyh = $this->input->post("kate");

                //GET ASPEK MODUL 2
                $sql_aspek = "SELECT ASP.id idaspek,ASP.nama nmaspek FROM `r_mdl2_aspek` ASP ORDER BY `idaspek` ASC";
                $list_data_aspek = $this->db->query($sql_aspek);

                //GET INDIKATOR BY ASPEK MODUL 2
                $sql_indi_by_aspek = "SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT
                                    FROM r_mdl2_aspek ASP
                                    JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id
                                    JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id
                                    JOIN `r_mdl2_sub_indi` SI ON SI.indiid = MI.id
                                    JOIN `r_mdl2_item` I ON I.subindiid=SI.id
                                    GROUP BY MI.nama
                                    ORDER BY `id_aspek` ASC, NO_URUT ASC";
                $list_data_indi_by_aspek = $this->db->query($sql_indi_by_aspek);

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($inp_katewlyh == "PROV") {

                    //LIST PROVINSI
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idprov,P.`nama_provinsi` nmprov,P.id_kode id_kode,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_t2_prov A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_t2_prov` W
                                    JOIN `t_mdl2_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_t2_prov` W
                                    JOIN `t_mdl2_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl2_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);

                    //array untuk mengumpulkan nilai indikator, nama aspek, no aspek
                    $array_data_indikator_by_aspek = array();
                    //variable numor aspek
                    $no_aspek = 1;
                    //looping data aspek
                    foreach ($list_data_aspek->result() as $va) {
                        // array untuk menampung nama daerah dan data nilai indikator
                        $array_data_nilai_indikator = array();
                        // looping nama daerah
                        foreach ($list_data_nama_daerah->result() as $vd) {
                            // sql untuk mencari indikator berdasarkan id aspek
                            $sql_indikator = "SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT
                                    FROM r_mdl2_aspek ASP
                                    JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id
                                    JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id
                                    WHERE ASP.id = " . $va->idaspek . "
                                    ORDER BY `id_aspek` ASC, NO_URUT ASC";
                            $list_data_indikator = $this->db->query($sql_indikator);
                            // array untuk menampung nilai indikator
                            $array_nilai_indikator = array();
                            foreach ($list_data_indikator->result() as $vi) {
                                //NILAI INDIKATOR MODUL 2
                                // sql untuk mengambil nilai indikator berdasarkan id indikator dan mapid
                                $sql_nilai_indi = "SELECT MI.nourut AS nourut, MI.id AS id_indikator, MI.nama AS nama, SUM(SKR.skor) AS total
                                            FROM `tbl_user_t2_prov` W
                                            JOIN `t_mdl2_skor_p` SKR ON SKR.`mapid`=W.`id`
                                            JOIN `r_mdl2_item` I ON I.`id`=SKR.`itemindi` 
                                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid`
                                            JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=" . $vi->ID_INDIKATOR . "
                                            JOIN provinsi PROV ON PROV.id = W.idwilayah
                                            WHERE W.`id` =" . $vd->mapid . "
                                            ORDER BY `I`.`nourut` ASC";
                                $list_data_nilai_indi = $this->db->query($sql_nilai_indi);

                                // sql untuk mengambil item berdasarkan id indikator
                                $sql_item = "SELECT MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.bobot AS BOBOT, I.nama AS ITEM
                                            FROM r_mdl2_indi MI
                                            JOIN r_mdl2_sub_indi SI ON SI.indiid = MI.id
                                            JOIN r_mdl2_item I ON I.subindiid = SI.id
                                            WHERE MI.id = '" . $vi->ID_INDIKATOR . "'";
                                $list_data_item = $this->db->query($sql_item);
                                //perhitungan nilai berdasarkan skor indikator
                                // $nilai = ($list_data_nilai_indi->result()[0]->total != null ? ($list_data_nilai_indi->result()[0]->total / $list_data_item->num_rows()) * $list_data_item->result()[0]->BOBOT : 0);
                                $nilai = ($list_data_nilai_indi->result()[0]->total != null ? ($list_data_nilai_indi->result()[0]->total / $list_data_item->num_rows()) : 0);
                                // masukan hasil nilai ke array_nilai_indikator
                                array_push($array_nilai_indikator, (float)number_format($nilai, 1));
                            }
                            // tampung ke dalam array_data_indikator
                            $array_data_indikator = array(
                                "name"  => $vd->nmprov,
                                "data"  => $array_nilai_indikator,
                            );
                            // masukan array_data_indikator ke array_data_nilai_indikator
                            array_push($array_data_nilai_indikator, $array_data_indikator);
                        }
                        // tampung ke dalam array_data_aspek
                        $array_data_aspek = array(
                            "no_aspek"              => $no_aspek,
                            "nama_aspek"            => $va->nmaspek,
                            "nilai_per_indikator"   => $array_data_nilai_indikator,
                        );
                        // masukan array_data_aspek ke dalam array_data_indikator_by_aspek
                        array_push($array_data_indikator_by_aspek, $array_data_aspek);

                        $no_aspek += 1;
                    }
                } elseif ($inp_katewlyh == "KAB") {

                    //LIST KABUPATEN
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);

                    //array untuk mengumpulkan nilai indikator, nama aspek, no aspek
                    $array_data_indikator_by_aspek = array();
                    //variable numor aspek
                    $no_aspek = 1;
                    //looping data aspek
                    foreach ($list_data_aspek->result() as $va) {
                        // array untuk menampung nama daerah dan data nilai indikator
                        $array_data_nilai_indikator = array();
                        // looping nama daerah
                        foreach ($list_data_nama_daerah->result() as $vd) {
                            // sql untuk mencari indikator berdasarkan id aspek
                            $sql_indikator = "SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT
                                    FROM r_mdl2_aspek ASP
                                    JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id
                                    JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id
                                    WHERE ASP.id = " . $va->idaspek . "
                                    ORDER BY `id_aspek` ASC, NO_URUT ASC";
                            $list_data_indikator = $this->db->query($sql_indikator);
                            // array untuk menampung nilai indikator
                            $array_nilai_indikator = array();
                            foreach ($list_data_indikator->result() as $vi) {
                                //NILAI INDIKATOR MODUL 2
                                // sql untuk mengambil nilai indikator berdasarkan id indikator dan mapid
                                $sql_nilai_indi = "SELECT MI.nourut AS nourut, MI.id AS id_indikator, MI.nama AS nama, SUM(SKR.skor) AS total 
                                            FROM `tbl_user_t2_kabkot` W
                                            JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                            JOIN `r_mdl2_item` I ON I.`id`=SKR.`itemindi` 
                                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid`
                                            JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=" . $vi->ID_INDIKATOR . "
                                            JOIN kabupaten KAB ON KAB.id = W.idkabkot
                                            WHERE W.`id`=" . $vd->mapid  . "
                                            ORDER BY `I`.`nourut` ASC";
                                $list_data_nilai_indi = $this->db->query($sql_nilai_indi);

                                // sql untuk mengambil item berdasarkan id indikator
                                $sql_item = "SELECT MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.bobot AS BOBOT, I.nama AS ITEM
                                            FROM r_mdl2_indi MI
                                            JOIN r_mdl2_sub_indi SI ON SI.indiid = MI.id
                                            JOIN r_mdl2_item I ON I.subindiid = SI.id
                                            WHERE MI.id = '" . $vi->ID_INDIKATOR . "'";
                                $list_data_item = $this->db->query($sql_item);
                                //perhitungan nilai berdasarkan skor indikator
                                // $nilai = ($list_data_nilai_indi->result()[0]->total != null ? ($list_data_nilai_indi->result()[0]->total / $list_data_item->num_rows()) * $list_data_item->result()[0]->BOBOT : 0);
                                $nilai = ($list_data_nilai_indi->result()[0]->total != null ? ($list_data_nilai_indi->result()[0]->total / $list_data_item->num_rows()) : 0);
                                // masukan hasil nilai ke array_nilai_indikator
                                array_push($array_nilai_indikator, (float)number_format($nilai, 1));
                            }
                            // tampung ke dalam array_data_indikator
                            $array_data_indikator = array(
                                "name"  => $vd->nmkab,
                                "data"  => $array_nilai_indikator,
                            );
                            // masukan array_data_indikator ke array_data_nilai_indikator
                            array_push($array_data_nilai_indikator, $array_data_indikator);
                        }
                        // tampung ke dalam array_data_aspek
                        $array_data_aspek = array(
                            "no_aspek"              => $no_aspek,
                            "nama_aspek"            => $va->nmaspek,
                            "nilai_per_indikator"   => $array_data_nilai_indikator,
                        );
                        // masukan array_data_aspek ke dalam array_data_indikator_by_aspek
                        array_push($array_data_indikator_by_aspek, $array_data_aspek);

                        $no_aspek += 1;
                    }
                } elseif ($inp_katewlyh == "KOTA") {

                    //LIST KOTA
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";

                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);

                    //array untuk mengumpulkan nilai indikator, nama aspek, no aspek
                    $array_data_indikator_by_aspek = array();
                    //variable numor aspek
                    $no_aspek = 1;
                    //looping data aspek
                    foreach ($list_data_aspek->result() as $va) {
                        // array untuk menampung nama daerah dan data nilai indikator
                        $array_data_nilai_indikator = array();
                        // looping nama daerah
                        foreach ($list_data_nama_daerah->result() as $vd) {
                            // sql untuk mencari indikator berdasarkan id aspek
                            $sql_indikator = "SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT
                                    FROM r_mdl2_aspek ASP
                                    JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id
                                    JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id
                                    WHERE ASP.id = " . $va->idaspek . "
                                    ORDER BY `id_aspek` ASC, NO_URUT ASC";
                            $list_data_indikator = $this->db->query($sql_indikator);
                            // array untuk menampung nilai indikator
                            $array_nilai_indikator = array();
                            foreach ($list_data_indikator->result() as $vi) {
                                //NILAI INDIKATOR MODUL 2
                                // sql untuk mengambil nilai indikator berdasarkan id indikator dan mapid
                                $sql_nilai_indi = "SELECT MI.nourut AS nourut, MI.id AS id_indikator, MI.nama AS nama, SUM(SKR.skor) AS total 
                                            FROM `tbl_user_t2_kabkot` W
                                            JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                            JOIN `r_mdl2_item` I ON I.`id`=SKR.`itemindi` 
                                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid`
                                            JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=" . $vi->ID_INDIKATOR . "
                                            JOIN kabupaten KAB ON KAB.id = W.idkabkot
                                            WHERE W.`id`=" . $vd->mapid  . "
                                            ORDER BY `I`.`nourut` ASC";
                                $list_data_nilai_indi = $this->db->query($sql_nilai_indi);

                                // sql untuk mengambil item berdasarkan id indikator
                                $sql_item = "SELECT MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.bobot AS BOBOT, I.nama AS ITEM
                                            FROM r_mdl2_indi MI
                                            JOIN r_mdl2_sub_indi SI ON SI.indiid = MI.id
                                            JOIN r_mdl2_item I ON I.subindiid = SI.id
                                            WHERE MI.id = '" . $vi->ID_INDIKATOR . "'";
                                $list_data_item = $this->db->query($sql_item);
                                //perhitungan nilai berdasarkan skor indikator
                                // $nilai = ($list_data_nilai_indi->result()[0]->total != null ? ($list_data_nilai_indi->result()[0]->total / $list_data_item->num_rows()) * $list_data_item->result()[0]->BOBOT : 0);
                                $nilai = ($list_data_nilai_indi->result()[0]->total != null ? ($list_data_nilai_indi->result()[0]->total / $list_data_item->num_rows()) : 0);
                                // masukan hasil nilai ke array_nilai_indikator
                                array_push($array_nilai_indikator, (float)number_format($nilai, 1));
                            }
                            // tampung ke dalam array_data_indikator
                            $array_data_indikator = array(
                                "name"  => $vd->nmkab,
                                "data"  => $array_nilai_indikator,
                            );
                            // masukan array_data_indikator ke array_data_nilai_indikator
                            array_push($array_data_nilai_indikator, $array_data_indikator);
                        }
                        // tampung ke dalam array_data_aspek
                        $array_data_aspek = array(
                            "no_aspek"              => $no_aspek,
                            "nama_aspek"            => $va->nmaspek,
                            "nilai_per_indikator"   => $array_data_nilai_indikator,
                        );
                        // masukan array_data_aspek ke dalam array_data_indikator_by_aspek
                        array_push($array_data_indikator_by_aspek, $array_data_aspek);

                        $no_aspek += 1;
                    }
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */

                //KATEGORI GRAFIK
                $no = 1;
                $str = "";
                $str .= "<ul class='nav nav-tabs tabs-bordered tabs-grafik' role='tablist'>";
                foreach ($list_data_aspek->result() as $va) {
                    $str .= "<li class='nav-item'>";
                    $str .= "<a class='nav-link " . ($no == 1 ? ' active' : '') . "' id='aspek-" . str_replace(" ", "-", $va->nmaspek) . "-tab' data-toggle='tab' href='#aspek-" . str_replace(" ", "-", $va->nmaspek) . "' role='tab' aria-controls='aspek-" . str_replace(" ", "-", $va->nmaspek) . "' aria-selected='true'>";
                    $str .= "<span class='d-block d-sm-none'><i class='mdi mdi-account-outline font-18'></i></span>";
                    $str .= "<span class='d-none d-sm-block'>" . $va->nmaspek . "</span>";
                    $str .= "</a>";
                    $str .= "</li>";

                    $no += 1;
                }
                $str .= "</ul>";

                $no_konten = 1;
                $no_indikator = 1;
                $str .= "<div class='tab-content'>";
                foreach ($list_data_aspek->result() as $va) {
                    $str .= "<div class='tab-pane " . ($no_konten == 1 ? ' show active' : '') . "' id='aspek-" . str_replace(" ", "-", $va->nmaspek) . "' role='tabpanel' aria-labelledby='" . str_replace(" ", "-", $va->nmaspek) . "-tab'>";
                    $str .= "<figure class='highcharts-figure'>";
                    $str .= "<div class='card-body'>";
                    $str .= "<div id='container-" . str_replace(" ", "-", $va->nmaspek) . "'></div>";
                    // $str .= "<p class='highcharts-description'>";
                    $str .= "<table class='table table-condensed table-bordered table-striped'>";
                    $str .= "<thead>";
                    $str .= "<tr class='bg-primary text-white'>";
                    $str .= "<th width='5%;'><center>No</center></th>";
                    $str .= "<th width='70%;'><center>Indikator</center></th>";
                    $str .= "<th width='25%;'><center>Kode Indikator</center></th>";
                    $str .= "</tr>";
                    $str .= "</thead>";
                    $str .= "</tbody>";

                    $no_tabel_indikator = 1;
                    foreach ($list_data_indi_by_aspek->result() as $viba) {
                        if ($va->nmaspek == $viba->ASPEK) {
                            $str .= "<tr>";
                            $str .= "<th style='white-space: normal; font-weight: normal; background-color: #fff4ca;'><center>" . $no_tabel_indikator . "</center></th>";
                            $str .= "<th style='white-space: normal; font-weight: normal; background-color: #fff4ca;'>" . $viba->INDIKATOR . "</th>";
                            $str .= "<th style='white-space: normal; font-weight: normal; background-color: #fff4ca;'><center>Indikator " . $no_indikator . "</center></th>";
                            $str .= "</tr>";

                            $no_indikator += 1;
                            $no_tabel_indikator += 1;
                        }
                    }

                    $str .= "</tbody>";
                    $str .= "</table>";
                    // $str .= "</p>";
                    $str .= "</div>";
                    $str .= "</figure>";
                    $str .= "</div>";

                    $no_konten += 1;
                }
                $str .= "</div>";

                $response = array(
                    "status"            => 1,
                    "csrf_hash"         => $this->security->get_csrf_hash(),
                    "str"               => $str,
                    "list_data_aspek"   => $list_data_aspek->result(),
                    "list_data_indi_by_aspek"   => $list_data_indi_by_aspek->result(),
                    "array_data_indikator_by_aspek" => $array_data_indikator_by_aspek,
                    "session_id"        => $session->id,
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
     * list data item
     * author :  
     * date : 10 des 2020
     */
    function g_persandingan_aspek_kualitatif()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $this->form_validation->set_rules('kate', 'Kategori Wilayah', 'required|in_list[PROV,KAB,KOTA]');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $inp_katewlyh = $this->input->post("kate");

                //GET ASPEK MODUL 2
                $sql_aspek = "SELECT ASP.id idaspek,ASP.nama nmaspek FROM `r_mdl2_aspek` ASP ORDER BY `idaspek` ASC";
                $list_data_aspek = $this->db->query($sql_aspek);

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($inp_katewlyh == "PROV") {
                    //LIST PROVINSI
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idprov,P.`nama_provinsi` nmprov,P.id_kode id_kode,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_t2_prov A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_t2_prov` W
                                    JOIN `t_mdl2_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_t2_prov` W
                                    JOIN `t_mdl2_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl2_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                } elseif ($inp_katewlyh == "KAB") {
                    //LIST KABUPATEN
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                } elseif ($inp_katewlyh == "KOTA") {
                    //LIST KOTA
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";

                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */

                //JUDUL TABEL

                $str_nama_daerah = "";
                $str_nama_daerah .= "<tr class='bg-primary text-white'>";
                $str_nama_daerah .= "<th class='' colspan='1' rowspan='2' width='5%'>";
                $str_nama_daerah .= "<center>No</center>";
                $str_nama_daerah .= "</th>";
                $str_nama_daerah .= "<th class='' colspan='1' rowspan='2' width='5%'>";
                $str_nama_daerah .= "<center>Aspek</center>";
                $str_nama_daerah .= "</th>";
                foreach ($list_data_nama_daerah->result() as $vd) {
                    $str_nama_daerah .= "<th class='' colspan='2' rowspan='1' width='" . number_format((float)(90 / $list_data_nama_daerah->num_rows()), 2, '.', '') . "%' style='white-space: normal;'>";
                    if ($inp_katewlyh == "PROV") {
                        $str_nama_daerah .= "<center>" . $vd->nmprov . "</center>";
                    } elseif ($inp_katewlyh == "KAB") {
                        $str_nama_daerah .= "<center>" . $vd->nmkab . "</center>";
                    } elseif ($inp_katewlyh == "KOTA") {
                        $str_nama_daerah .= "<center>" . $vd->nmkab . "</center>";
                    }
                    $str_nama_daerah .= "</th>";
                }
                $str_nama_daerah .= "</tr>";
                $str_nama_daerah .= "<tr class='bg-primary text-white'>";
                foreach ($list_data_nama_daerah->result() as $vd) {
                    $str_nama_daerah .= "<th class='' width='" . number_format((float)((90 / $list_data_nama_daerah->num_rows()) / 2), 2, '.', '') . "%'>";
                    $str_nama_daerah .= "<center>Keunggulan</center>";
                    $str_nama_daerah .= "</th>";
                    $str_nama_daerah .= "<th class='' width='" . number_format((float)((90 / $list_data_nama_daerah->num_rows()) / 2), 2, '.', '') . "%'>";
                    $str_nama_daerah .= "<center>Rekomendasi</center>";
                    $str_nama_daerah .= "</th>";
                }
                $str_nama_daerah .= "</tr>";


                //KATEGORI TABEL
                $str = "";
                foreach ($list_data_aspek->result() as $va) {
                    $str .= "<tr>";
                    $str .= "<td class=''>";
                    $str .= "<center><b>" . $va->idaspek . "</b></center>";
                    $str .= "</td>";
                    $str .= "<td class=''><b>" . str_replace("Aspek", "", $va->nmaspek) . "</b></td>";
                    foreach ($list_data_nama_daerah->result() as $vd) {
                        if ($inp_katewlyh == "PROV") {
                            $sql_isi_aspek_kualitatif = "SELECT ASP.id idaspek,ASP.nama nmaspek,RSM.ksmplan kesimpulan, RSM.saran saran FROM `r_mdl2_aspek` ASP JOIN t_mdl2_resume_prov RSM ON RSM.`aspekid`=ASP.`id` AND RSM.`mapid`= " . $vd->mapid . " WHERE ASP.id = " . $va->idaspek . " ORDER BY ASP.id ASC ";
                        } elseif (($inp_katewlyh == "KAB") || ($inp_katewlyh == "KOTA")) {
                            $sql_isi_aspek_kualitatif = "SELECT ASP.id idaspek,ASP.nama nmaspek,RSM.ksmplan kesimpulan, RSM.saran saran FROM `r_mdl2_aspek` ASP JOIN t_mdl2_resume_kabkota RSM ON RSM.`aspekid`=ASP.`id` AND RSM.`mapid`= " . $vd->mapid . " WHERE ASP.id = " . $va->idaspek . " ORDER BY ASP.id ASC ";
                        }

                        $list_isi_aspek_kualitatif = $this->db->query($sql_isi_aspek_kualitatif);

                        if ($list_isi_aspek_kualitatif->num_rows() == 0) {
                            $str .= "<td style='white-space: normal; background-color: #fff4ca;'><center><i>-</i></center></td>";
                            $str .= "<td style='white-space: normal; background-color: #fff4ca;'><center><i>-</i></center></td>";
                        } else {
                            foreach ($list_isi_aspek_kualitatif->result() as $via) {
                                $str .= "<td style='white-space: normal; background-color: #fff4ca;'>" . $via->kesimpulan . "</td>";
                                $str .= "<td style='white-space: normal; background-color: #fff4ca;'>" . $via->saran . "</td>";
                            }
                        }
                    }
                    $str .= "</tr>";
                }

                $response = array(
                    "status"            => 1,
                    "csrf_hash"         => $this->security->get_csrf_hash(),
                    "str"               => $str,
                    "str_nama_daerah"   => $str_nama_daerah,
                    "data_aspek"        => $list_data_aspek->result(),
                    "data_nama_daerah"  => $list_data_nama_daerah->result(),
                    "session_id"        => $session->id,
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
     * list data item
     * author :  
     * date : 10 des 2020
     */

    function g_item()
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

                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                $idindi = $tmp[2];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if (!is_numeric($idindi))
                    throw new Exception("Invalid ID Indi");

                //get indikator catatan
                $ctt_indi = "";
                $bbt_indi = 0;
                $sql = "SELECT nama,note,bobot FROM `r_mdl2_indi` WHERE id=?";
                $bind = array($idindi);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                if ($list_data->num_rows() == 0)
                    throw new Exception("Data indikator tidak ditemukan");
                $ctt_indi = $list_data->row()->note;
                $bbt_indi = $list_data->row()->bobot;
                //get juul item dinilai
                $nmjudul = "";
                $judulitem = "";

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($kate_wlyh == "PROV") {
                    //List Judul item
                    $sql_j = "SELECT IJ.id,IJ.indiid, IJ.nama nmjudul, JP.judl 
                            FROM `r_mdl2_item_judul` IJ
                            LEFT JOIN `t_mdl2_judul_prov` JP ON JP.judlid = IJ.id AND JP.mapid=?
                            WHERE IJ.indiid=" . $idindi . " ";
                    $bind = array($idmap);
                    $list_data_j = $this->db->query($sql_j, $bind);


                    //LIST INDIKATOR
                    $sql = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`,SP.`skor`
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            LEFT JOIN `t_mdl2_skor_p` SP ON SP.itemindi = IT.id AND SP.mapid=?
                            WHERE SI.`indiid`=" . $idindi . "
                            ORDER BY SI.`nourut`,IT.`nourut` ASC";

                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    //list Judul



                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    //List Judul item
                    $sql_j = "SELECT IJ.id,IJ.indiid, IJ.nama nmjudul, JP.judl 
                            FROM `r_mdl2_item_judul` IJ
                            LEFT JOIN `t_mdl2_judul_kabkota` JP ON JP.judlid = IJ.id AND JP.mapid=?
                            WHERE IJ.indiid=" . $idindi . " ";
                    $bind = array($idmap);
                    $list_data_j = $this->db->query($sql_j, $bind);

                    //LIST INDIKATOR
                    $sql = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`,SP.`skor`
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            LEFT JOIN `t_mdl2_skor_k` SP ON SP.itemindi = IT.id AND SP.mapid=?
                            WHERE SI.`indiid`=" . $idindi . "
                            ORDER BY SI.`nourut`,IT.`nourut` ASC";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * Tampilkan Judul item Dinilai
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if (!$list_data_j) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL1!");
                }
                if ($list_data_j->num_rows() !== 0) {
                    $nmjudul     = $list_data_j->row()->nmjudul; // Nama judul
                    $judulitem   = $list_data_j->row()->judl; // judul item
                }
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";

                $no = 1;
                $idsubindi = "";
                $ttl_skor = 0;
                $nom = '';
                foreach ($list_data->result() as $v) {
                    if ($v->idsubindi != $idsubindi) {
                        if ($v->istampil == 'Y') {
                            $str .= "<tr class='bg-secondary' title='Sub Indikator'>";
                            $str .= "<td colspan='7' class='text-uppercase' style='white-space: inherit;'><b>" . $v->nmsubindi . "</b></td>";
                            $str .= "</tr>";
                        }
                        $idsubindi = $v->idsubindi;
                    }

                    $idcomb = $kate_wlyh . "-" . $idmap . "-" . $v->iditem . "-" . $v->iditem . "-" . $v->nourut;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='  ' data-id='" . $encrypted_id . "' data-item='$v->nourut' data-nomor='$v->nourut' data-nmitem='$v->nmitem'  ";
                    $tmp .= " title='Isi indikator penilaian'";
                    //  $str_tmp = "<div class='form-group t_dataNil' style='margin-bottom: 0px;' ><input type='number' pattern='[0-9]+([,\.][0-9]+)?' class='form-control '  id='$v->nourut' data-nn='$v->nourut' name='nitem' data-nilai='nilai' value='$v->skor'></div>";
                    $str_tmp = "<div class='input-group bootstrap-touchspin bootstrap-touchspin-injected form-group t_dataNil' style='margin-bottom: 0px;'>";
                    // $str_tmp .= "<span class='input-group-btn input-group-prepend'><button class='btn btn-primary bootstrap-touchspin-down' type='button'>-</button></span>";
                    $str_tmp .= "<span class='input-group-addon bootstrap-touchspin-prefix input-group-prepend'><span class='input-group-text'><span class=' fas fa-fax'></span></span></span>";
                    $str_tmp .= "<input data-toggle='touchspin' type='number' class='form-control' min='5' max='10' step='.01' id='$v->nourut' data-nn='$v->nourut' name='nitem' data-nilai='nilai' value='$v->skor'>";
                    // $str_tmp .= "<span class='input-group-btn input-group-append'><button class='btn btn-primary bootstrap-touchspin-up' type='button'>+</button></span>";
                    $str_tmp .= "</div>";

                    $str .= "<tr>";
                    $str .= "<td class='text-center'>" . $v->nourut . "</td>";

                    // $str.="<td class='p-l-25'>".wordwrap($v->nmitem,80,"<br/>")."</td>";
                    $str .= "<td class='' style='white-space: inherit;'>" . $v->nmitem . "</td>";
                    $str .= "<td class='_colSatu textpointer _btnIsiIndiItem' style='white-space: inherit; width: 155px;' " . $tmp . ">" . $str_tmp . "</td>";
                    //                        $str.="<td  class='p-l-25 _colSatu textpointer ' style='width:10px'> </td>";


                    $str .= "</tr>";
                    $nom[] = $v->nourut;
                    $ttl_skor += is_null($v->skor) ? 0 : $v->skor;
                }

                $str_foot = "<tr class='bg-secondary'>";
                $str_foot .= "<td colspan='2' class='text-center'><h5>TOTAL SKOR</h5></td>";
                $str_foot .= "<td class='text-right' style='white-space: inherit;' ><h4 class='ttl_skor'>" . number_format($ttl_skor, 2) . "</h4></td>";
                $str_foot .= "</tr>";

                // $nilai = $ttl_skor / $list_data->num_rows() * $bbt_indi;
                $nilai = $ttl_skor / $list_data->num_rows();

                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => $str,
                    "str_foot"  => $str_foot,
                    "ctt_indi"  => $ctt_indi,
                    "nilai"     => number_format($nilai, 1),
                    "datajudul" => $nmjudul,
                    "judulitem" => $judulitem,
                    // "idindi"    => $idindi,
                    // "idmap"     => $idmap,
                    // "session_id" => $session->id,
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
     * list data item
     * author :  
     * date : 10 des 2020
     */
    function g_item_persandingan_per_daerah()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $this->form_validation->set_rules('kate', 'Kategori Wilayah', 'required|in_list[PROV,KAB,KOTA]');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $inp_katewlyh = $this->input->post("kate");

                //GET ASPEK MODUL 2
                $sql_aspek = "SELECT ASP.id idaspek,ASP.nama nmaspek FROM `r_mdl2_aspek` ASP ORDER BY `idaspek` ASC";
                $list_data_aspek = $this->db->query($sql_aspek);


                $str_aspek = "";
                $str_aspek .= "<ul class='nav nav-tabs tabs-bordered' role='tablist'>";
                foreach ($list_data_aspek->result() as $va) {
                    $str_aspek .= "<li class='nav-item'>";
                    $str_aspek .= "<a class='nav-link " . ($va->idaspek == 1 ? 'active' : '') . "' id='" . str_replace(' ', '-', $va->nmaspek) . "-b1-tab' data-toggle='tab' href='#" . str_replace(' ', '-', $va->nmaspek) . "-b1' role='tab' aria-controls='" . str_replace(' ', '-', $va->nmaspek) . "-b1' aria-selected='" . ($va->idaspek == 1 ? 'true' : 'false') . "'>";
                    $str_aspek .= "<span class='d-block d-sm-none'><i class='mdi mdi-account-outline font-18'></i></span>";
                    $str_aspek .= "<span class='d-none d-sm-block'>" . $va->nmaspek . "</span>";
                    $str_aspek .= "</a>";
                    $str_aspek .= "</li>";
                }
                $str_aspek .= "</ul>";

                $no_indikator = 1;
                $no_indikator_card = 1;
                $str_aspek .= "<div class='tab-content'>";
                foreach ($list_data_aspek->result() as $va) {

                    $sql_indikator_by_aspek = "SELECT ASP.id AS ID_ASPEK, ASP.nama ASPEK, KRT.nama AS KRITERIA, MI.id AS ID_INDIKATOR, MI.nama AS INDIKATOR, MI.nourut AS NO_URUT 
                                        FROM r_mdl2_aspek ASP 
                                        JOIN r_mdl2_krtria KRT ON KRT.aspekid = ASP.id 
                                        JOIN `r_mdl2_indi` MI ON MI.krtriaid = KRT.id 
                                        WHERE ASP.id = " . $va->idaspek . "
                                        ORDER BY `id_aspek` ASC, NO_URUT ASC";
                    $list_data_indikator_by_aspek = $this->db->query($sql_indikator_by_aspek);



                    $str_aspek .= "<div class='tab-pane " . ($va->idaspek == 1 ? 'active' : '') . "' id='" . str_replace(' ', '-', $va->nmaspek) . "-b1' role='tabpanel' aria-labelledby='" . str_replace(' ', '-', $va->nmaspek) . "-b1-tab'>";



                    $str_aspek .= "<div class='row'>";

                    $str_aspek .= "<div class='col-md-2'>";
                    $str_aspek .= "<div class='nav flex-column nav-pills' id='v-pills-tab' role='tablist' aria-orientation='vertical'>";

                    $no_indikator_by_aspek = 1;
                    foreach ($list_data_indikator_by_aspek->result() as $via) {
                        $str_aspek .= "<a class='nav-link mb-2 " . ($no_indikator_by_aspek == 1 ? 'active' : '') . "' id='v-pills-indikator-" . $via->ID_INDIKATOR . "-tab' data-toggle='pill' href='#v-pills-indikator-" . $via->ID_INDIKATOR . "' role='tab' aria-controls='v-pills-" . $via->ID_INDIKATOR . "' aria-selected='" . ($no_indikator_by_aspek == 1 ? 'true' : 'false') . "'>Indikator " . $no_indikator . "</a>";

                        $no_indikator_by_aspek += 1;
                        $no_indikator += 1;
                    }

                    $str_aspek .= "</div>";
                    $str_aspek .= "</div>";

                    $str_aspek .= "<div class='col-md-10'>";
                    $str_aspek .= "<div class='tab-content pt-md-0'>";

                    $no_indikator_by_aspek = 1;
                    foreach ($list_data_indikator_by_aspek->result() as $via) {
                        $str_aspek .= "<div class='tab-pane " . ($no_indikator_by_aspek == 1 ? 'fade active show' : '') . "' id='v-pills-indikator-" . $via->ID_INDIKATOR . "' role='tabpanel' aria-labelledby='v-pills-indikator-" . $via->ID_INDIKATOR . "-tab'>";



                        $str_aspek .= "<div class='card' style='border: 1px solid rgba(49, 126, 235, 1);'>";
                        $str_aspek .= "<div class='avatar-lg bg-info rounded-circle mr-2' style='position: absolute; height: 5.5rem; width: 5.5rem; top: 20px; right: 15px; background-color: rgba(49, 126, 235, 0.2) !important; border: 2px solid rgba(41,182,246, 0.5)'>";
                        $str_aspek .= "<i class='ion-md-information avatar-title font-26 text-white' style='font-size: 72px !important;'></i>";
                        $str_aspek .= "</div>";
                        $str_aspek .= "<div class='card-header border-info bg-transparent pb-0'>";
                        $str_aspek .= "<h3 class='card-title text-info'>Informasi</h3>";
                        $str_aspek .= "</div>";
                        $str_aspek .= "<div class='card-body'>";
                        $str_aspek .= "<div class='text-left'>";
                        $str_aspek .= "<p class='mb-0'><b>Kriteria</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " . $via->KRITERIA . "</p>";
                        $str_aspek .= "<p class='mb-0'><b>Indikator " . $no_indikator_card . "</b> &nbsp;: " . $via->INDIKATOR . "</p>";
                        $str_aspek .= "</div>";
                        $str_aspek .= "</div>";
                        $str_aspek .= "</div>";


                        $str_aspek .= "<table class='table table-bordered table-responsive'>";
                        $str_aspek .= "<thead>";

                        $str_aspek .= "<tr class='bg-primary text-white'>";

                        $str_aspek .= "<th class='text-uppercase text-vertical-center' title='No Urut' width='5%' style='white-space: normal;'>";
                        $str_aspek .= "<center>No</center>";
                        $str_aspek .= "</th>";
                        $str_aspek .= "<th class='text-uppercase text-vertical-center' width='42.5%' style='white-space: normal;'>";
                        $str_aspek .= "<center>Nama Item</center>";
                        $str_aspek .= "</th>";

                        if ($inp_katewlyh == "PROV") {
                            //LIST INDIKATOR
                            $sql = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                                    FROM `r_mdl2_item` IT
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                    WHERE SI.`indiid`=" . $via->ID_INDIKATOR . "
                                    ORDER BY SI.`nourut`,IT.`nourut` ASC";

                            // $bind = array($idmap);
                            $list_data = $this->db->query($sql);

                            //LIST PROVINSI
                            $sql_nama_daerah = "SELECT A.`id` mapid,P.id idprov,P.`nama_provinsi` nmprov,P.id_kode id_kode,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                                                FROM tbl_user_t2_prov A
                                                JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                                                LEFT JOIN(
                                                        SELECT W.`idwilayah` idprov, COUNT(1) jml
                                                        FROM `tbl_user_t2_prov` W
                                                        JOIN `t_mdl2_skor_p` SKR ON SKR.`mapid`=W.`id`
                                                        JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                                        WHERE W.`iduser`=?
                                                        GROUP BY W.`idwilayah`
                                                        )JML ON JML.idprov=A.`idwilayah`
                                                LEFT JOIN (
                                                        SELECT W.`idwilayah` idprov,COUNT(1) jml
                                                        FROM `tbl_user_t2_prov` W
                                                        JOIN `t_mdl2_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                                        WHERE W.`iduser`=?
                                                        GROUP BY W.`idwilayah`
                                                        )RS ON RS.idprov=A.`idwilayah`                                    
                                                LEFT JOIN t_mdl2_sttment_prov ST ON ST.mapid=A.id                         
                                                WHERE A.`iduser`=?";
                            $bind_nama_daerah = array($session->id, $session->id, $session->id);
                            $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                        } elseif ($inp_katewlyh == "KAB") {
                            //LIST INDIKATOR
                            $sql = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                                    FROM `r_mdl2_item` IT
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                    WHERE SI.`indiid`=" . $via->ID_INDIKATOR . "
                                    ORDER BY SI.`nourut`,IT.`nourut` ASC";

                            // $bind = array($idmap);
                            $list_data = $this->db->query($sql);

                            //LIST KABUPATEN
                            $sql_nama_daerah = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                                                FROM `tbl_user_t2_kabkot` A
                                                JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                                                LEFT JOIN(
                                                        SELECT W.`idkabkot` idkab, COUNT(1) jml
                                                        FROM `tbl_user_t2_kabkot` W
                                                        JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                                        JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                                        WHERE W.`iduser`=?
                                                        GROUP BY W.`idkabkot`
                                                        )JML ON JML.idkab=A.`idkabkot`
                                                LEFT JOIN (
                                                        SELECT W.`idkabkot` idkab,COUNT(1) jml
                                                        FROM `tbl_user_t2_kabkot` W
                                                        JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                                        WHERE W.`iduser`=?
                                                        GROUP BY W.`idkabkot`
                                                        )RS ON RS.idkab=A.`idkabkot`                                    
                                                LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                                                WHERE A.`iduser`=?";
                            $bind_nama_daerah = array($session->id, $session->id, $session->id);
                            $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                        } elseif ($inp_katewlyh == "KOTA") {
                            //LIST INDIKATOR
                            $sql = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                                    FROM `r_mdl2_item` IT
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                    WHERE SI.`indiid`=" . $via->ID_INDIKATOR . "
                                    ORDER BY SI.`nourut`,IT.`nourut` ASC";

                            // $bind = array($idmap);
                            $list_data = $this->db->query($sql);

                            //LIST KOTA
                            $sql_nama_daerah = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                                                FROM `tbl_user_t2_kabkot` A
                                                JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                                                LEFT JOIN(
                                                        SELECT W.`idkabkot` idkab, COUNT(1) jml
                                                        FROM `tbl_user_t2_kabkot` W
                                                        JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                                        JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                                        WHERE W.`iduser`=?
                                                        GROUP BY W.`idkabkot`
                                                        )JML ON JML.idkab=A.`idkabkot`
                                                LEFT JOIN (
                                                        SELECT W.`idkabkot` idkab,COUNT(1) jml
                                                        FROM `tbl_user_t2_kabkot` W
                                                        JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                                        WHERE W.`iduser`=?
                                                        GROUP BY W.`idkabkot`
                                                        )RS ON RS.idkab=A.`idkabkot`                                    
                                                LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                                                WHERE A.`iduser`=?";
                            $bind_nama_daerah = array($session->id, $session->id, $session->id);
                            $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                        }

                        foreach ($list_data_nama_daerah->result() as $vd) {
                            if ($inp_katewlyh == "PROV") {
                                $str_aspek .= "<th class='text-uppercase text-vertical-center' width='10%' style='white-space: normal;'>";
                                $str_aspek .= "<center>" . $vd->nmprov . "</center>";
                                $str_aspek .= "</th>";
                            } elseif (($inp_katewlyh == "KAB") || ($inp_katewlyh == "KOTA")) {
                                $str_aspek .= "<th class='text-uppercase text-vertical-center' width='10%' style='white-space: normal;'>";
                                $str_aspek .= "<center>" . $vd->nmkab . "</center>";
                                $str_aspek .= "</th>";
                            }
                        }

                        $str_aspek .= "</tr>";

                        $str_aspek .= "</thead>";
                        $str_aspek .= "<tbody>";

                        $idsubindi = '';
                        foreach ($list_data->result() as $v) {

                            if ($v->idsubindi != $idsubindi) {
                                if ($v->istampil == 'Y') {
                                    $str_aspek .= "<tr class='bg-secondary' title='Sub Indikator'>";
                                    $str_aspek .= "<td colspan='7' class='text-uppercase'><b><small>Sub Indikator</small><br/>" . $v->nmsubindi . "</b></td>";
                                    $str_aspek .= "</tr>";
                                }
                                $idsubindi = $v->idsubindi;
                            }

                            $str_aspek .= "<tr>";
                            $str_aspek .= "<td class='text-center'>" . $v->nourut . "</td>";
                            $str_aspek .= "<td style='white-space: inherit;' class='p-l-25'>" . $v->nmitem . "</td>";


                            // LIST NILAI DAERAH
                            foreach ($list_data_nama_daerah->result() as $vd) {

                                if ($inp_katewlyh == "PROV") {

                                    $sql_nilai_daerah = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`,SP.`skor`
                                                FROM `r_mdl2_item` IT
                                                JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                                LEFT JOIN `t_mdl2_skor_p` SP ON SP.itemindi = IT.id AND SP.mapid=" . $vd->mapid . "
                                                WHERE SI.`indiid`=" . $via->ID_INDIKATOR . " AND IT.id = " . $v->iditem . "
                                                ORDER BY SI.`nourut`,IT.`nourut` ASC";
                                } elseif (($inp_katewlyh == "KAB") || ($inp_katewlyh == "KOTA")) {

                                    $sql_nilai_daerah = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`,SP.`skor`
                                                    FROM `r_mdl2_item` IT
                                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                                    LEFT JOIN `t_mdl2_skor_k` SP ON SP.itemindi = IT.id AND SP.mapid=" . $vd->mapid . "
                                                    WHERE SI.`indiid`=" . $via->ID_INDIKATOR . " AND IT.id = " . $v->iditem . "
                                                    ORDER BY SI.`nourut`,IT.`nourut` ASC";
                                }


                                $list_data_nilai_daerah = $this->db->query($sql_nilai_daerah);

                                if ($list_data_nilai_daerah->num_rows() == 0) {
                                    $str_aspek .= "<td style='white-space: inherit;' class='p-l-25'><center>-</center></td>";
                                } else {
                                    foreach ($list_data_nilai_daerah->result() as $vnd) {
                                        $str_aspek .= "<td style='white-space: inherit; background-color: #fff4ca;' class='p-l-25'><center>" . $vnd->skor . "</center></td>";
                                    }
                                }
                            }


                            $str_aspek .= "</tr>";
                        }

                        $str_aspek .= "</tr>";
                        $str_aspek .= "</tbody>";
                        $str_aspek .= "</table>";






                        $str_aspek .= "</div>";

                        $no_indikator_by_aspek += 1;
                        $no_indikator_card += 1;
                    }

                    $str_aspek .= "</div>";
                    $str_aspek .= "</div>";

                    $str_aspek .= "</div>";



                    $str_aspek .= "</div>";
                }
                $str_aspek .= "</div>";


                $response = array(
                    "status"            => 1,
                    "csrf_hash"         => $this->security->get_csrf_hash(),
                    "str_aspek"         => $str_aspek,
                    // "str"               => $str,
                    // "str_nama_daerah"   => $str_nama_daerah,
                    // "data_aspek"        => $list_data_aspek->result(),
                    // "data_nama_daerah"  => $list_data_nama_daerah->result(),
                    // "session_id"        => $session->id,
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
     * list data item
     * author :  
     * date : 10 des 2020
     */
    function g_item_persandingan()
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

                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                $idindi = $tmp[2];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if (!is_numeric($idindi))
                    throw new Exception("Invalid ID Indi");

                //get indikator catatan
                $ctt_indi = "";
                $sql = "SELECT nama,note
                        FROM `r_mdl2_indi`
                        WHERE id=?";
                $bind = array($idindi);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                if ($list_data->num_rows() == 0)
                    throw new Exception("Data indikator tidak ditemukan");
                $ctt_indi = $list_data->row()->note;

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($kate_wlyh == "PROV") {
                    //LIST INDIKATOR
                    $sql = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            WHERE SI.`indiid`=" . $idindi . "
                            ORDER BY SI.`nourut`,IT.`nourut` ASC";

                    // $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);

                    //LIST NAMA DAERAH YANG DINILAI

                    //LIST PROVINSI
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idprov,P.`nama_provinsi` nmprov,P.id_kode id_kode,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_t2_prov A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_t2_prov` W
                                    JOIN `t_mdl2_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_t2_prov` W
                                    JOIN `t_mdl2_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl2_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                } elseif ($kate_wlyh == "KAB") {
                    //LIST INDIKATOR
                    $sql = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            WHERE SI.`indiid`=" . $idindi . "
                            ORDER BY SI.`nourut`,IT.`nourut` ASC";
                    // $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);

                    //LIST NAMA DAERAH YANG DINILAI

                    //LIST KABUPATEN
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                } elseif ($kate_wlyh == "KOTA") {
                    //LIST INDIKATOR
                    $sql = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            WHERE SI.`indiid`=" . $idindi . "
                            ORDER BY SI.`nourut`,IT.`nourut` ASC";
                    // $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);

                    //LIST KOTA
                    $sql_nama_daerah = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab id_kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";

                    $bind_nama_daerah = array($session->id, $session->id, $session->id);
                    $list_data_nama_daerah = $this->db->query($sql_nama_daerah, $bind_nama_daerah);
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */

                $str_nama_daerah = "";
                $str_nama_daerah .= "<tr class='bg-primary text-white'>";
                $str_nama_daerah .= "<th class='text-uppercase text-vertical-center' title='No Urut' width='5%' style='white-space: normal;'>";
                $str_nama_daerah .= "<center>NO</center>";
                $str_nama_daerah .= "</th>";
                $str_nama_daerah .= "<th class='text-uppercase text-vertical-center' width='42.5%' style='white-space: normal;'>";
                $str_nama_daerah .= "<center>NAMA ITEM</center>";
                $str_nama_daerah .= "</th>";
                foreach ($list_data_nama_daerah->result() as $vd) {
                    $str_nama_daerah .= "<th class='text-uppercase text-vertical-center' width='10%' style='white-space: normal;'>";
                    if ($kate_wlyh == "PROV") {
                        $str_nama_daerah .= "<center>" . $vd->nmprov . "</center>";
                    } elseif ($kate_wlyh == "KAB") {
                        $str_nama_daerah .= "<center>" . $vd->nmkab . "</center>";
                    } elseif ($kate_wlyh == "KOTA") {
                        $str_nama_daerah .= "<center>" . $vd->nmkab . "</center>";
                    }
                    $str_nama_daerah .= "</th>";
                }
                $str_nama_daerah .= "</tr>";


                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";

                $no = 1;
                $idsubindi = "";

                foreach ($list_data->result() as $v) {

                    if ($v->idsubindi != $idsubindi) {
                        if ($v->istampil == 'Y') {
                            $str .= "<tr class='bg-secondary' title='Sub Indikator'>";
                            $str .= "<td colspan='7' class='text-uppercase'><b>" . $v->nmsubindi . "</b></td>";
                            $str .= "</tr>";
                        }
                        $idsubindi = $v->idsubindi;
                    }

                    $str .= "<tr>";
                    $str .= "<td class='text-center'>" . $v->nourut . "</td>";
                    $str .= "<td style='white-space: inherit;' class='p-l-25'>" . $v->nmitem . "</td>";


                    // LIST NILAI DAERAH
                    foreach ($list_data_nama_daerah->result() as $vd) {

                        if ($kate_wlyh == "PROV") {

                            $sql_nilai_daerah = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`,SP.`skor`
                                        FROM `r_mdl2_item` IT
                                        JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                        LEFT JOIN `t_mdl2_skor_p` SP ON SP.itemindi = IT.id AND SP.mapid=" . $vd->mapid . "
                                        WHERE SI.`indiid`=" . $idindi . " AND IT.id = " . $v->iditem . "
                                        ORDER BY SI.`nourut`,IT.`nourut` ASC";
                        } elseif (($kate_wlyh == "KAB") || ($kate_wlyh == "KOTA")) {

                            $sql_nilai_daerah = "SELECT IT.`nourut`, IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`,SP.`skor`
                                            FROM `r_mdl2_item` IT
                                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                            LEFT JOIN `t_mdl2_skor_k` SP ON SP.itemindi = IT.id AND SP.mapid=" . $vd->mapid . "
                                            WHERE SI.`indiid`=" . $idindi . " AND IT.id = " . $v->iditem . "
                                            ORDER BY SI.`nourut`,IT.`nourut` ASC";
                        }

                        $list_data_nilai_daerah = $this->db->query($sql_nilai_daerah);

                        if ($list_data_nilai_daerah->num_rows() == 0) {
                            if ($idmap == $vd->mapid) {
                                $str .= "<td style='white-space: inherit; background-color: #fff4ca;' class='p-l-25'><center>-</center></td>";
                            } else {
                                $str .= "<td style='white-space: inherit;' class='p-l-25'><center>-</center></td>";
                            }
                        } else {
                            foreach ($list_data_nilai_daerah->result() as $vnd) {
                                if ($idmap == $vd->mapid) {
                                    $str .= "<td style='white-space: inherit; background-color: #fff4ca;' class='p-l-25'><center>" . $vnd->skor . "</center></td>";
                                } else {
                                    $str .= "<td style='white-space: inherit;' class='p-l-25'><center>" . $vnd->skor . "</center></td>";
                                }
                            }
                        }
                    }


                    $str .= "</tr>";
                }

                $response = array(
                    "status"            => 1,
                    "csrf_hash"         => $this->security->get_csrf_hash(),
                    "str"               => $str,
                    "str_nama_daerah"   => $str_nama_daerah,
                    "idindi"            => $idindi,
                    "idmap"             => $idmap,
                    "session ID"             => $session->id,
                    "data"              => $list_data->result(),
                    "data daerah"              => $list_data_nama_daerah->result(),
                    "kate_wlyh"         => $kate_wlyh,
                    // "data_nama_daerah"  => $list_data_daerah->result(),
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

    function save_jdlnilai()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $this->form_validation->set_rules('id', 'ID Comb', 'required|xss_clean');
                $this->form_validation->set_rules('judul', 'Judul Item', 'required|xss_clean');
                //$this->form_validation->set_rules('wlyh','Wilayah Penilaian','required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID Wilayah Penilaian");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $idindi     = $tmp[2];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("Invalid ID Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");

                $judul  = $this->input->post("judul");
                if ($kate_wlyh == "PROV") {
                    /*
                     * check map wilayah - START
                     */
                    $sql = "SELECT * FROM tbl_user_t2_prov WHERE id=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL #1!");
                    }
                    if ($list_data->num_rows() == 0)
                        throw new Exception("Data Map tidak ditemukan!", 0);

                    $sql_j = "SELECT IJ.id,IJ.indiid, IJ.nama nmjudul, JP.judl 
                            FROM `r_mdl2_item_judul` IJ
                            LEFT JOIN `t_mdl2_judul_prov` JP ON JP.judlid = IJ.id AND JP.mapid=?
                            WHERE IJ.indiid=" . $idindi . " ";
                    $bind = array($idmap);
                    $list_data_j = $this->db->query($sql_j, $bind);
                    if ($list_data_j->num_rows() == 0)
                        throw new Exception("Data Kategori Penilaian Item tidak ditemukan!", 0);
                    $iditmjdl    = $list_data_j->row()->id; // ID item judul

                    //1.pastikan judul item per wilayah 
                    $sql = "DELETE A
                            FROM `t_mdl2_judul_prov` A
                            WHERE A.`mapid`=? AND A.`judlid`=?";
                    $bind = array($idmap, $iditmjdl);
                    $stts = $this->db->query($sql, $bind);
                    if (!$stts) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                    }
                    //2.simpan data
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("t_mdl2_judul_prov");
                    $data_baru = array(
                        "mapid"     => $idmap,
                        "judlid"    => $iditmjdl,
                        "stts"    => "Y",
                        "judl"      => $judul,
                        "cr_by"     => $session->id,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        $this->db->trans_rollback();
                        throw new Exception("SQL Error " . $this->db->error("code") . " : Gagal menyimpan skor!", 0);
                    }
                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    /*
                     * check map wilayah - START
                     */
                    $sql = "SELECT * FROM tbl_user_t2_kabkot WHERE id=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL #1!");
                    }
                    if ($list_data->num_rows() == 0)
                        throw new Exception("Data Map tidak ditemukan!", 0);

                    $sql_j = "SELECT IJ.id,IJ.indiid, IJ.nama nmjudul, JP.judl 
                            FROM `r_mdl2_item_judul` IJ
                            LEFT JOIN `t_mdl2_judul_kabkota` JP ON JP.judlid = IJ.id AND JP.mapid=?
                            WHERE IJ.indiid=" . $idindi . " ";
                    $bind = array($idmap);
                    $list_data_j = $this->db->query($sql_j, $bind);
                    if ($list_data_j->num_rows() == 0)
                        throw new Exception("Data Kategori Penilaian Item tidak ditemukan!", 0);
                    $iditmjdl    = $list_data_j->row()->id; // ID item judul

                    //1.pastikan judul item per wilayah 
                    $sql = "DELETE A
                            FROM `t_mdl2_judul_kabkota` A
                            WHERE A.`mapid`=? AND A.`judlid`=?";
                    $bind = array($idmap, $iditmjdl);
                    $stts = $this->db->query($sql, $bind);
                    if (!$stts) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                    }
                    //2.simpan data
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("t_mdl2_judul_kabkota");
                    $data_baru = array(
                        "mapid"     => $idmap,
                        "judlid"    => $iditmjdl,
                        "stts"    => "Y",
                        "judl"      => $judul,
                        "cr_by"     => $session->id,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        $this->db->trans_rollback();
                        throw new Exception("SQL Error " . $this->db->error("code") . " : Gagal menyimpan skor!", 0);
                    }
                }



                /*
                 * -------------------------------------------
                 * pengisian judul wilayah KAB/KOTA - END
                 * -------------------------------------------
                 */

                $this->db->trans_commit();



                /*
                 * +++++++++++++++++++++++++++++++++++++++++
                 * FORM RESUME dan SARAN properties - end
                 * +++++++++++++++++++++++++++++++++++++++++
                 */
                //sukses
                $output = array(
                    "status"                => 1,
                    "csrf_hash"             => $this->security->get_csrf_hash(),
                    "msg"                   => "Sukses menyimpan data",
                );

                exit(json_encode($output));
            } catch (Exception $exc) {
                log_message("error", $exc->getLine());
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
     * simpan skor kategori item penilaian
     * author : 
     * date : 13 des 2020
     */
    function save_score()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $this->form_validation->set_rules('id', 'ID Comb', 'required|xss_clean');
                $this->form_validation->set_rules('nilai', 'Nilai skor', 'required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");


                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 5)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $iditemindi = $tmp[2];
                $idindi     = $tmp[3];
                $nourut     = $tmp[4];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("Invalid ID Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if (!is_numeric($iditemindi))
                    throw new Exception("Invalid ID Item Indi");
                if (!is_numeric($idindi))
                    throw new Exception("Invalid ID Indi");

                if (!is_numeric($nourut))
                    throw new Exception("Invalid Nomor Urut");

                $skor  = $this->input->post("nilai");
                $nomor  = $this->input->post("nomor");
                $nmitem = $this->input->post("nmitem");


                //default properties
                $val_ksmpln = $val_saran = "";

                /* 
                 * =============================================
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * =============================================
                 */
                /*
                 * -------------------------------------------
                 * pengisian skor wilayah PROVINSI - START
                 * -------------------------------------------
                 */
                if ($kate_wlyh == "PROV") {
                    /*
                     * check map wilayah - START
                     */
                    $sql = "SELECT * FROM tbl_user_t2_prov WHERE id=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL #1!");
                    }
                    if ($list_data->num_rows() == 0)
                        throw new Exception("Data Map tidak ditemukan!", 0);
                    /*
                     * check map wilayah - END
                     */

                    /*
                     * if mdl skor - START
                     */

                    /*
                     * check kategori penilaian item - START
                     */
                    $sql = "SELECT A.id,A.nourut,A.nama nmitem, MII.`id` indkid, MII.`bobot`, ASP.`id` aspekid, ASP.nama nmaspek
                            FROM `r_mdl2_item` A
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=A.`subindiid`
                            JOIN `r_mdl2_indi` MII ON MII.`id`=SI.`indiid`
                            JOIN `r_mdl2_krtria` K ON K.`id`=MII.`krtriaid`
                            JOIN r_mdl2_aspek ASP ON ASP.id=K.aspekid
                            WHERE A.id =?";
                    $bind = array($iditemindi);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL #2!");
                    }
                    if ($list_data->num_rows() == 0)
                        throw new Exception("Data Kategori Penilaian Item tidak ditemukan!", 0);

                    $iditem     = $list_data->row()->id; //ID item
                    $urutno     = $list_data->row()->nourut; // Nomor urut
                    $nmitem     = $list_data->row()->nmitem; // Nama Kriteria
                    $idindk     = $list_data->row()->indkid; // ID Indikator
                    $bbtind     = $list_data->row()->bobot; // Bobot
                    $idaspek    = $list_data->row()->aspekid; // ID Aspek
                    $nmaspek    = $list_data->row()->nmaspek; // Nama Aspek
                    /*
                     * check kategori penilaian item - END
                     */
                    //List Judul item
                    //                    $sql_j="SELECT IJ.id,IJ.indiid, IJ.nama nmjudul, JP.judl 
                    //                            FROM `r_mdl2_item_judul` IJ
                    //                            LEFT JOIN `t_mdl2_judul_prov` JP ON JP.judlid = IJ.id AND JP.mapid=?
                    //                            WHERE IJ.indiid=".$idindk." ";
                    //                    $bind = array($idmap);
                    //                    $list_data_j = $this->db->query($sql_j,$bind);
                    //                    if(!$list_data_j){
                    //                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    //                        log_message("error", $msg);
                    //                        throw new Exception("Invalid SQL1!");
                    //                    }
                    //                    if($list_data_j->num_rows() !==0){
                    //                        $nmjudul     = $list_data_j->row()->nmjudul; // Nama judul
                    //                        $judulitem   = $list_data_j->row()->judl; // judul item
                    //                        if($judulitem==''){
                    //                            $output = array(
                    //                                "status"                => 3,
                    //                                "csrf_hash"             => $this->security->get_csrf_hash(),
                    //                                "msg"                   => "Data Harus Disi",
                    //                            );
                    //                            exit(json_encode($output));
                    //                        }
                    //                    }
                    /*
                     * +++++++++++++++++++++++++
                     * catat penilaian - START
                     * +++++++++++++++++++++++++
                     */

                    //1.pastikan skor item per wilayah 
                    $sql = "DELETE A
                            FROM `t_mdl2_skor_p` A
                            WHERE A.`mapid`=? AND A.`itemindi`=?";
                    $bind = array($idmap, $iditem);
                    $stts = $this->db->query($sql, $bind);
                    if (!$stts) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                    }
                    //2.simpan data
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("t_mdl2_skor_p");
                    $data_baru = array(
                        "mapid"     => $idmap,
                        "itemindi"    => $iditem,
                        "skor"      => $skor,
                        "cr_by"     => $session->id,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        $this->db->trans_rollback();
                        throw new Exception("SQL Error " . $this->db->error("code") . " : Gagal menyimpan skor!", 0);
                    }


                    /*
                     * +++++++++++++++++++++++++
                     * catat penilaian - END
                     * +++++++++++++++++++++++++
                     */

                    /*
                     * ++++++++++++++++++++++++++++
                     * get last TOTAL SKOR - START
                     * ++++++++++++++++++++++++++++
                     */
                    //LIST INDIKATOR
                    $sql = "SELECT MII.id idindi, SUM(SP.skor) skor
					FROM `tbl_user_t2_prov` W
					JOIN `t_mdl2_skor_p` SP ON SP.`mapid`=W.`id`
					JOIN `r_mdl2_item` MI ON MI.`id`=SP.`itemindi`
					JOIN `r_mdl2_sub_indi` SI ON SI.`id`=MI.`subindiid`
					JOIN `r_mdl2_indi` MII ON MII.`id`=SI.`indiid`
					WHERE W.`id`=? AND MII.id=?
					ORDER BY MII.`id`";
                    $bind = array($idmap, $idindk);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL#3!");
                    }
                    $ttl_skor = 0;
                    if ($list_data->num_rows() > 0)
                        $ttl_skor = $list_data->row()->skor;

                    /*
                     * ++++++++++++++++++++++++++++
                     * get last TOTAL SKOR - END
                     * ++++++++++++++++++++++++++++
                     */

                    /*
                     * ++++++++++++++++++++++++++++
                     * get Nilai - START
                     * ++++++++++++++++++++++++++++
                     */
                    $sql = "SELECT IT.id
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            WHERE SI.`indiid`=" . $idindk . " ";
                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    // $nilai = $ttl_skor / $list_data->num_rows() * $bbtind;
                    $nilai = $ttl_skor / $list_data->num_rows();
                    /*
                     * ++++++++++++++++++++++++++++
                     * get Nilai - END
                     * ++++++++++++++++++++++++++++
                     */
                    /*
                     * ++++++++++++++++++++++++++++++++++++++
                     * Check semua item sudah dinilai - START
                     * ++++++++++++++++++++++++++++++++++++++
                     */
                    $sql = "SELECT A.jml,LPR.jml jml_lpr
                            FROM(
                                SELECT K.`aspekid`,COUNT(1) jml
                                FROM `r_mdl2_item` IT
                                JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid` 
                                JOIN `r_mdl2_indi` I ON I.`id`=SI.`indiid`
                                JOIN `r_mdl2_krtria` K ON K.`id`=I.`krtriaid`
                                WHERE K.`aspekid`=" . $idaspek . "
                                GROUP BY K.`aspekid`
                            ) A
                            LEFT JOIN(
                                        SELECT K.`aspekid`,COUNT(1) jml
                                        FROM `tbl_user_t2_prov` W 
                                        JOIN `t_mdl2_skor_p` P ON P.mapid=W.`id`
                                        JOIN `r_mdl2_item` IT ON IT.id=P.itemindi
                                        JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid` 
                                        JOIN `r_mdl2_indi` I ON I.`id`=SI.`indiid`
                                        JOIN `r_mdl2_krtria` K ON K.`id`=I.`krtriaid`
                                        WHERE W.id=" . $idmap . " AND K.`aspekid`=" . $idaspek . "
                                        GROUP BY K.`aspekid` 
                            )LPR ON LPR.aspekid=A.aspekid";
                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $isdisplay_simpul = 'N';
                    if ($list_data->num_rows() > 0) {
                        if ($list_data->row()->jml == $list_data->row()->jml_lpr) {
                            $isdisplay_simpul = 'Y';
                            //tandai bahwa provinsi sudah harus isi form resume
                            //check data simpul
                            $sql = "SELECT A.`id`,A.`ksmplan`,A.`saran`
                                    FROM `t_mdl2_resume_prov` A
                                    WHERE A.`aspekid`=? AND A.`mapid`=?";
                            $bind = array($idaspek, $idmap);
                            $list_data = $this->db->query($sql, $bind);
                            if (!$list_data) {
                                $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                                log_message("error", $msg);
                                throw new Exception("Invalid SQL!");
                            }
                            if ($list_data->num_rows() == 0) {
                                $this->m_ref->setTableName("t_mdl2_resume_prov");
                                $data_baru = array(
                                    "mapid"     => $idmap,
                                    "aspekid"   => $idaspek,
                                    "stts"      => 'N',
                                    "cr_by"     => $session->id,
                                );
                                $status_save = $this->m_ref->save($data_baru);
                                if (!$status_save) {
                                    $this->db->trans_rollback();
                                    throw new Exception("SQL Error " . $this->db->error()["code"] . " : Gagal menyimpan skor!", 0);
                                }
                            }
                            //get kesimpulan dan saran
                            $sql = "SELECT A.`id`,A.`ksmplan`,A.`saran`
                                    FROM `t_mdl2_resume_prov` A
                                    WHERE A.`aspekid`=? AND A.`mapid`=?";
                            $bind = array($idaspek, $idmap);
                            $list_data = $this->db->query($sql, $bind);
                            if (!$list_data) {
                                $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                                log_message("error", $msg);
                                throw new Exception("Invalid SQL!");
                            }

                            $val_ksmpln  = "";
                            $val_saran   = "";
                            if ($list_data->num_rows() > 0) {
                                $val_ksmpln = $list_data->row()->ksmplan;
                                $val_saran = $list_data->row()->saran;
                            }
                        }
                    } else {
                        $this->db->trans_rollback();
                        throw new Exception("Data Master Item tidak ditemukan");
                    }
                }

                /*
                 * -------------------------------------------
                 * pengisian skor wilayah PROVINSI - END
                 * -------------------------------------------
                 */
                /*
                 * -------------------------------------------
                 * pengisian skor wilayah KAB/KOTA - START
                 * -------------------------------------------
                 */ elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {

                    /*
                     * check map wilayah - START
                     */
                    $sql = "SELECT * FROM tbl_user_t2_kabkot WHERE id=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL #1!");
                    }
                    if ($list_data->num_rows() == 0)
                        throw new Exception("Data Map tidak ditemukan!", 0);
                    /*
                     * check map wilayah - END
                     */
                    /*
                     * if mdl skor - START
                     */

                    /*
                     * check kategori penilaian item - START
                     */
                    $sql = "SELECT A.id,A.nourut,A.nama nmitem, MII.`id` indkid, MII.`bobot`, ASP.`id` aspekid, ASP.nama nmaspek
                            FROM `r_mdl2_item` A
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=A.`subindiid`
                            JOIN `r_mdl2_indi` MII ON MII.`id`=SI.`indiid`
                            JOIN `r_mdl2_krtria` K ON K.`id`=MII.`krtriaid`
                            JOIN r_mdl2_aspek ASP ON ASP.id=K.aspekid
                            WHERE A.id =?";
                    $bind = array($iditemindi);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL #2!");
                    }
                    if ($list_data->num_rows() == 0)
                        throw new Exception("Data Kategori Penilaian Item tidak ditemukan!", 0);

                    $iditem     = $list_data->row()->id; //ID item
                    $urutno     = $list_data->row()->nourut; // Nomor urut
                    $nmitem     = $list_data->row()->nmitem; // Nama Kriteria
                    $idindk     = $list_data->row()->indkid; // Nama indikator
                    $bbtind     = $list_data->row()->bobot; // Bobot
                    $idaspek    = $list_data->row()->aspekid; // ID Aspek
                    $nmaspek    = $list_data->row()->nmaspek; // Nama Aspek
                    /*
                     * check kategori penilaian item - END
                     */
                    //List Judul item
                    //                    $sql_j="SELECT IJ.id,IJ.indiid, IJ.nama nmjudul, JP.judl 
                    //                            FROM `r_mdl2_item_judul` IJ
                    //                            LEFT JOIN `t_mdl2_judul_kabkota` JP ON JP.judlid = IJ.id AND JP.mapid=?
                    //                            WHERE IJ.indiid=".$idindk." ";
                    //                    $bind = array($idmap);
                    //                    $list_data_j = $this->db->query($sql_j,$bind);
                    //                    if(!$list_data_j){
                    //                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    //                        log_message("error", $msg);
                    //                        throw new Exception("Invalid SQL1!");
                    //                    }
                    //                    if($list_data_j->num_rows() !==0){
                    //                        $nmjudul     = $list_data_j->row()->nmjudul; // Nama judul
                    //                        $judulitem   = $list_data_j->row()->judl; // judul item
                    //                        if($judulitem==''){
                    //                            $output = array(
                    //                                "status"                => 3,
                    //                                "csrf_hash"             => $this->security->get_csrf_hash(),
                    //                                "msg"                   => "Data Harus Disi",
                    //                            );
                    //                            exit(json_encode($output));
                    //                        }
                    //                    }
                    /*
                     * +++++++++++++++++++++++++
                     * catat penilaian - START
                     * +++++++++++++++++++++++++
                     */

                    //1.pastikan skor item per wilayah 
                    $sql = "DELETE A
                            FROM `t_mdl2_skor_k` A
                            WHERE A.`mapid`=? AND A.`itemindi`=?";
                    $bind = array($idmap, $iditem);
                    $stts = $this->db->query($sql, $bind);
                    if (!$stts) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                    }
                    //2.simpan data
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("t_mdl2_skor_k");
                    $data_baru = array(
                        "mapid"     => $idmap,
                        "itemindi"    => $iditem,
                        "skor"      => $skor,
                        "cr_by"     => $session->id,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        $this->db->trans_rollback();
                        throw new Exception("SQL Error " . $this->db->error("code") . " : Gagal menyimpan skor!", 0);
                    }


                    /*
                     * +++++++++++++++++++++++++
                     * catat penilaian - END
                     * +++++++++++++++++++++++++
                     */

                    /*
                     * ++++++++++++++++++++++++++++
                     * get last TOTAL SKOR - START
                     * ++++++++++++++++++++++++++++
                     */
                    //LIST INDIKATOR
                    $sql = "SELECT MII.id idindi, SUM(SP.skor) skor
					FROM `tbl_user_t2_kabkot` W
					JOIN `t_mdl2_skor_k` SP ON SP.`mapid`=W.`id`
					JOIN `r_mdl2_item` MI ON MI.`id`=SP.`itemindi`
					JOIN `r_mdl2_sub_indi` SI ON SI.`id`=MI.`subindiid`
					JOIN `r_mdl2_indi` MII ON MII.`id`=SI.`indiid`
					WHERE W.`id`=? AND MII.id=?
					ORDER BY MII.`id`";
                    $bind = array($idmap, $idindk);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL#3!");
                    }
                    $ttl_skor = 0;
                    if ($list_data->num_rows() > 0)
                        $ttl_skor = $list_data->row()->skor;

                    /*
                     * ++++++++++++++++++++++++++++
                     * get last TOTAL SKOR - END
                     * ++++++++++++++++++++++++++++
                     */

                    /*
                     * ++++++++++++++++++++++++++++
                     * get Nilai - START
                     * ++++++++++++++++++++++++++++
                     */
                    $sql = "SELECT IT.id
                            FROM `r_mdl2_item` IT
                            JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            WHERE SI.`indiid`=" . $idindk . " ";
                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    // $nilai = $ttl_skor / $list_data->num_rows() * $bbtind;
                    $nilai = $ttl_skor / $list_data->num_rows();
                    /*
                     * ++++++++++++++++++++++++++++
                     * get Nilai - END
                     * ++++++++++++++++++++++++++++
                     */
                    /*
                     * ++++++++++++++++++++++++++++++++++++++
                     * Check semua item sudah dinilai - START
                     * ++++++++++++++++++++++++++++++++++++++
                     */
                    $sql = "SELECT A.jml,LPR.jml jml_lpr
                            FROM(
                                    SELECT K.`aspekid`,COUNT(1) jml
                                    FROM `r_mdl2_item` IT
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid` 
                                    JOIN `r_mdl2_indi` I ON I.`id`=SI.`indiid`
                                    JOIN `r_mdl2_krtria` K ON K.`id`=I.`krtriaid`
                                    WHERE K.`aspekid`=" . $idaspek . "
                                    GROUP BY K.`aspekid`
                            ) A
                            LEFT JOIN(
                                    SELECT K.`aspekid`,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` I ON I.`id`=SKR.`itemindi`
                                    JOIN `r_mdl2_sub_indi` SI ON SI.`id`=I.`subindiid` 
                                    JOIN `r_mdl2_indi` MI ON MI.`id`=SI.`indiid`
                                    JOIN `r_mdl2_krtria` K ON K.`id`=MI.`krtriaid`
                                    WHERE W.`id`=" . $idmap . " AND K.`aspekid`=" . $idaspek . "
                                    GROUP BY K.`aspekid`
                            )LPR ON LPR.aspekid=A.aspekid";

                    $list_data = $this->db->query($sql);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $isdisplay_simpul = 'N';
                    if ($list_data->num_rows() > 0) {
                        if ($list_data->row()->jml == $list_data->row()->jml_lpr) {
                            $isdisplay_simpul = 'Y';
                            //tandai bahwa provinsi sudah harus isi form resume
                            //check data simpul
                            $sql = "SELECT A.`id`,A.`ksmplan`,A.`saran`
                                    FROM `t_mdl2_resume_kabkota` A
                                    WHERE A.`aspekid`=? AND A.`mapid`=?";
                            $bind = array($idaspek, $idmap);
                            $list_data = $this->db->query($sql, $bind);
                            if (!$list_data) {
                                $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                                log_message("error", $msg);
                                throw new Exception("Invalid SQL!");
                            }
                            if ($list_data->num_rows() == 0) {
                                $this->m_ref->setTableName("t_mdl2_resume_kabkota");
                                $data_baru = array(
                                    "mapid"     => $idmap,
                                    "aspekid"   => $idaspek,
                                    "stts"      => 'N',
                                    "cr_by"     => $session->id,
                                );
                                $status_save = $this->m_ref->save($data_baru);
                                if (!$status_save) {
                                    $this->db->trans_rollback();
                                    throw new Exception("SQL Error " . $this->db->error()["code"] . " : Gagal menyimpan skor!", 0);
                                }
                            }
                            //get kesimpulan dan saran
                            $sql = "SELECT A.`id`,A.`ksmplan`,A.`saran`
                                    FROM `t_mdl2_resume_kabkota` A
                                    WHERE A.`aspekid`=? AND A.`mapid`=?";
                            $bind = array($idaspek, $idmap);
                            $list_data = $this->db->query($sql, $bind);
                            if (!$list_data) {
                                $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                                log_message("error", $msg);
                                throw new Exception("Invalid SQL!");
                            }

                            $val_ksmpln  = "";
                            $val_saran   = "";
                            if ($list_data->num_rows() > 0) {
                                $val_ksmpln = $list_data->row()->ksmplan;
                                $val_saran = $list_data->row()->saran;
                            }
                        }
                    } else {
                        $this->db->trans_rollback();
                        throw new Exception("Data Master Item tidak ditemukan");
                    }
                }
                /*
                 * -------------------------------------------
                 * pengisian skor wilayah KAB/KOTA - END
                 * -------------------------------------------
                 */
                /* 
                 * =============================================
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * =============================================
                 */

                $this->db->trans_commit();


                /*
                 * +++++++++++++++++++++++++++++++++++++++++
                 * FORM RESUME dan SARAN properties - start
                 * +++++++++++++++++++++++++++++++++++++++++
                 */
                $idcomb = $kate_wlyh . "-" . $idmap . "-" . $idaspek;
                $enc_idrsme = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                /*
                 * +++++++++++++++++++++++++++++++++++++++++
                 * FORM RESUME dan SARAN properties - end
                 * +++++++++++++++++++++++++++++++++++++++++
                 */
                //sukses
                $output = array(
                    "status"                => 1,
                    "csrf_hash"             => $this->security->get_csrf_hash(),
                    "msg"                   => "Sukses menyimpan data",
                    "ttl_skor"              => number_format($ttl_skor, 2),
                    "nilai"                 => number_format($nilai, 1),
                    "is_display_simpul"     => $isdisplay_simpul,
                    "val_ksmpln"            => $val_ksmpln,
                    "val_saran"             => $val_saran,
                    "nmaspek"               => $nmaspek,
                    "idrsme"                => $enc_idrsme,
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                log_message("error", $exc->getLine());
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
     * list data dokumen bahan dukung masing-masing wilayah
     * author :  
     * date : 9 jan 2021
     */
    function g_doc()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $usergroupid = $session->group;

                $this->form_validation->set_rules('id', 'ID Data Indikator', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = decrypt_base64($this->input->post("id"));
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


                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($kate_wlyh == "PROV") {

                    /*
                     * check data PROV - start
                     */
                    $sql = "SELECT A.`id`
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
                    /*
                     * check data PROV - end
                     */

                    //get LIST tautan doc
                    $sql = "SELECT A.`id`,A.`judul`,A.`tautan`, 'umum' kate
                            FROM `t_doc` A
                            JOIN `t_doc_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                            WHERE A.`isactive`='Y'
                            UNION
                            SELECT A.`id`,A.`judul`,A.`tautan`, 'daerah' kate
                            FROM `t_doc_prov` A
                            JOIN `t_doc_prov_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                            WHERE A.`isactive`='Y' AND A.provid=?";
                    $bind = array($usergroupid, $usergroupid, $idwlyh);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    /*
                     * check data KAB / KOTA - start
                     */
                    $sql = "SELECT A.`id`
                            FROM `kabupaten` A
                            WHERE A.`id`=?";
                    $bind = array($idwlyh);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if ($list_data->num_rows() == 0) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : Kab/Kota ID : " . $idwlyh . " not found";
                        log_message("error", $msg);
                        throw new Exception("Data Kabupaten / Kota tidak ditemukan!");
                    }
                    /*
                     * check data KAB / KOTA - end
                     */

                    //get LIST tautan doc
                    $sql = "SELECT A.`id`,A.`judul`,A.`tautan`, 'umum' kate
                            FROM `t_doc` A
                            JOIN `t_doc_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                            WHERE A.`isactive`='Y'
                            UNION
                            SELECT A.`id`,A.`judul`,A.`tautan`, 'daerah' kate
                            FROM `t_doc_kab` A
                            JOIN `t_doc_kab_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                            WHERE A.`isactive`='Y' AND A.kabid=?";
                    $bind = array($usergroupid, $usergroupid, $idwlyh);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                }


                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */


                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";

                $no = 1;
                $lnk = 'https';
                foreach ($list_data->result() as $v) {
                    if (substr($v->tautan, 0, 5) == 'https') {
                        $link = $v->tautan;
                    } else {
                        $tautan = substr($v->tautan, 4);
                        $link = $lnk . $tautan;
                    }

                    if (substr($v->tautan, -3) == 'rar') {
                        $rename = $v->judul . ".rar";
                    } elseif (substr($v->tautan, -3) == 'zip') {
                        $rename = $v->judul . ".zip";
                    } elseif (substr($v->tautan, -3) == 'pdf') {
                        $rename = $v->judul . ".pdf";
                    } elseif (substr($v->tautan, -4) == 'docx') {
                        $rename = $v->judul . ".docx";
                    } elseif (substr($v->tautan, -4) == 'xlsx') {
                        $rename = $v->judul . ".xlsx";
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $rename = $v->judul . ".jpeg";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $rename = $v->judul . ".pptx";
                    } else {
                        $rename = $v->judul;
                    }
                    // $str.="<tr>";
                    // $str.="<td class='text-right'>".$no++."</td>";
                    // $str.="<td class=''><a href='".$link."' download='$rename' target='_blank' title='Klik untuk unduh dokumen' >".wordwrap($v->judul,50,"<br/>")."</a></td>";
                    // $str.="<td class='text-center'><a class='btn btn-xs text-primary' target='_blank' title='Klik untuk unduh dokumen' href='".$link."' download='$rename' ><i class='fas fa-2x fa-download'></i></a></td>";
                    // $str.="</tr>";

                    $str .= "<tr>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $no++ . "</td>";
                    // $str.="<td class=''><a href='".$link."' download='$rename' target='_blank' title='Klik untuk unduh dokumen' >".wordwrap($v->judul,50,"<br/>")."</a></td>";
                    $str .= "<td class='' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a href='" . $link . "' download='$rename' target='_blank' title='Klik untuk unduh dokumen' >" . $v->judul . "</a></td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a class='btn btn-xs text-primary' target='_blank' title='Klik untuk unduh dokumen' href='" . $link . "' download='$rename' ><i class='fas fa-lg fa-download'></i></a></td>";
                    $str .= "</tr>";
                }



                $response = array(
                    "status"            => 1,
                    "csrf_hash"         => $this->security->get_csrf_hash(),
                    "str"               => $str,
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


    //save resume Aspek
    function resume_save()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Your session is ended, please relogin", 2);
                }
                $this->form_validation->set_rules('id', 'ID data', 'required|xss_clean');
                $this->form_validation->set_rules('simpul', 'Keunggulan Daerah Pada', 'required|xss_clean');
                $this->form_validation->set_rules('saran', ' Rekomendasi Terhadap', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $idaspek    = $tmp[2];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if (!is_numeric($idaspek))
                    throw new Exception("Invalid ID Aspek");

                $inp_simpul = $this->input->post("simpul");
                $inp_saran  = $this->input->post("saran");

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                $this->db->trans_begin();

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($kate_wlyh == "PROV") {
                    //cek data 
                    $this->m_ref->setTableName("t_mdl2_resume_prov");
                    $select = array();
                    $cond = array(
                        "mapid"  => $idmap,
                        "aspekid" => $idaspek,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL");
                    }
                    if ($list_data->num_rows() > 0) {
                        $this->m_ref->setTableName("t_mdl2_resume_prov");
                        $data_baru = array(
                            "ksmplan"   => $inp_simpul,
                            "saran"     => $inp_saran,
                            "stts"      => 'Y',
                            "up_dt"     => $current_date_time,
                            "up_by"     => $session->userid,
                        );
                        $cond = array(
                            "mapid"  => $idmap,
                            "aspekid" => $idaspek,
                        );
                        $status_save = $this->m_ref->update($cond, $data_baru);
                        if (!$status_save) {
                            $this->db->trans_rollback();
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception($this->db->error()["code"] . " : Failed save data", 0);
                        }
                    } else {
                        $this->m_ref->setTableName("t_mdl2_resume_prov");
                        $data_baru = array(
                            "mapid"     => $idmap,
                            "aspekid"  => $idaspek,
                            "ksmplan"   => $inp_simpul,
                            "saran"     => $inp_saran,
                            "stts"      => 'Y',
                            "cr_by"     => $session->userid,
                        );
                        $status_save = $this->m_ref->save($data_baru);
                        if (!$status_save) {
                            $this->db->trans_rollback();
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception($this->db->error("code") . " : Failed save data", 0);
                        }
                    }
                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    //cek data 
                    $this->m_ref->setTableName("t_mdl2_resume_kabkota");
                    $select = array();
                    $cond = array(
                        "mapid"  => $idmap,
                        "aspekid" => $idaspek,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL");
                    }
                    if ($list_data->num_rows() > 0) {
                        $this->m_ref->setTableName("t_mdl2_resume_kabkota");
                        $data_baru = array(
                            "ksmplan"   => $inp_simpul,
                            "saran"     => $inp_saran,
                            "stts"      => 'Y',
                            "up_dt"     => $current_date_time,
                            "up_by"     => $session->userid,
                        );
                        $cond = array(
                            "mapid"  => $idmap,
                            "aspekid" => $idaspek,
                        );
                        $status_save = $this->m_ref->update($cond, $data_baru);
                        if (!$status_save) {
                            $this->db->trans_rollback();
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception($this->db->error()["code"] . " : Failed save data", 0);
                        }
                    } else {
                        $this->m_ref->setTableName("t_mdl2_resume_kabkota");
                        $data_baru = array(
                            "mapid"     => $idmap,
                            "aspekid"   => $idaspek,
                            "ksmplan"   => $inp_simpul,
                            "saran"     => $inp_saran,
                            "stts"      => 'Y',
                            "cr_by"     => $session->userid,
                        );
                        $status_save = $this->m_ref->save($data_baru);
                        if (!$status_save) {
                            $this->db->trans_rollback();
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception($this->db->error("code") . " : Failed save data", 0);
                        }
                    }
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                $this->db->trans_commit();


                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Resume Aspek berhasil disimpan"
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }


    /*
     * get detail data resume aspek
     * author :  
     * date : 23 des 2020
     */
    function g_det_resume()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $this->form_validation->set_rules('id', 'ID Data', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = decrypt_base64($this->input->post("id"));

                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $idaspek    = $tmp[2];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if (!is_numeric($idaspek))
                    throw new Exception("Invalid ID Aspek");

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY Nama Aspek
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                $this->m_ref->setTableName("r_mdl2_aspek");
                $select_a = array("id", "nama");
                $cond_a = array(
                    "id"     => $idaspek,
                );
                $list_data_a = $this->m_ref->get_by_condition($select_a, $cond_a);
                if (!$list_data_a) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if ($list_data_a->num_rows() == 0) {
                    throw new Exception("Data not found, please reload this page!", 0);
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($kate_wlyh == 'PROV') {
                    $this->m_ref->setTableName("t_mdl2_resume_prov");
                    $select = array("ksmplan", "saran");
                    $cond = array(
                        "mapid"     => $idmap,
                        "aspekid"   => $idaspek,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if ($list_data->num_rows() == 0) {
                        throw new Exception("Data not found, please reload this page!", 0);
                    }
                } elseif ($kate_wlyh == 'KAB' || $kate_wlyh == 'KOTA') {
                    $this->m_ref->setTableName("t_mdl2_resume_kabkota");
                    $select = array("ksmplan", "saran");
                    $cond = array(
                        "mapid"     => $idmap,
                        "aspekid"   => $idaspek,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if ($list_data->num_rows() == 0) {
                        throw new Exception("Data not found, please reload this page!", 0);
                    }
                }


                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                $nmaspek    = $list_data_a->row()->nama;
                $val_simpul = $list_data->row()->ksmplan;
                $val_saran  = $list_data->row()->saran;
                //sukses
                $output = array(
                    "status"            =>  1,
                    "csrf_hash"         =>  $this->security->get_csrf_hash(),
                    "msg"               =>  "success get data",
                    "simpul"               =>  $val_simpul,
                    "saran"               =>  $val_saran,
                    "nmaspek"               =>  $nmaspek,
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
     * get detail data lembar pernyataan
     * author :  
     * date : 1 jan 2021
     */
    function g_det_sttmnt()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $this->form_validation->set_rules('id', 'ID Data', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($kate_wlyh == "PROV") {
                    $this->m_ref->setTableName("t_mdl2_sttment_prov");
                    $select = array("attachments");
                    $cond = array(
                        "mapid"     => $idmap,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    //                    $val_link = NULL;
                    //                    if($list_data->num_rows() > 0){
                    //                        $val_link= base_url("attachments/kertaskerja/".$list_data->row()->attachments);
                    //                    }

                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    $this->m_ref->setTableName("t_mdl2_sttment_kabkota");
                    $select = array("attachments");
                    $cond = array(
                        "mapid"     => $idmap,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    //                    $val_link = NULL;
                    //                    if($list_data->num_rows() > 0){
                    //                        $val_link= base_url("attachments/kertaskerja/".$list_data->row()->attachments);
                    //                    }

                }
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                //sukses
                $output = array(
                    "status"            =>  1,
                    "csrf_hash"         =>  $this->security->get_csrf_hash(),
                    "msg"               =>  "success get data",
                    // "link"               =>  $val_link,
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
     * save Lembar Pernyataan
     * author :  
     * date : 1 Jan 2021
     */
    function sttmnt_save()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Your session is ended, please relogin", 2);
                }
                $this->form_validation->set_rules('id', 'ID data', 'required|xss_clean');


                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");

                //UPLOAD documents
                //                $config['upload_path']      = './attachments/kertaskerja/';
                //                $config['allowed_types']    = "pdf|xls|xlsx";
                //                $config['max_size']         = '10000'; //10 Mb
                //                $config['encrypt_name']     = TRUE;
                //                $this->load->library('upload');
                //                $this->upload->initialize($config);
                //                if (!$this->upload->do_upload("dokumen")){
                //                    throw new Exception($this->upload->display_errors("",""),0);
                //                }
                //                //uploaded data
                //                $upload_file = $this->upload->data();
                //                $filename= $upload_file['file_name'];
                $filename = "Dengan ini saya menyatakan bahwa penilaian ini dilakukan secara profesional, jujur, bertanggung-jawab, dan tidak atas dasar tekanan dari pihak manapun.";
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                $this->db->trans_begin();

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($kate_wlyh == "PROV") {
                    //cek data 
                    $this->m_ref->setTableName("t_mdl2_sttment_prov");
                    $select = array();
                    $cond = array(
                        "mapid"  => $idmap,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL");
                    }
                    if ($list_data->num_rows() > 0) {
                        $this->m_ref->setTableName("t_mdl2_sttment_prov");
                        $data_baru = array(
                            "attachments"   => $filename,
                            "up_dt"     => $current_date_time,
                            "up_by"     => $session->userid,
                        );
                        $cond = array(
                            "mapid"  => $idmap,
                        );
                        $status_save = $this->m_ref->update($cond, $data_baru);
                        if (!$status_save) {
                            $this->db->trans_rollback();
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception($this->db->error()["code"] . " : Failed save data", 0);
                        }
                    } else {
                        $this->m_ref->setTableName("t_mdl2_sttment_prov");
                        $data_baru = array(
                            "mapid"     => $idmap,
                            "attachments"   => $filename,
                            "cr_by"     => $session->userid,
                        );
                        $status_save = $this->m_ref->save($data_baru);
                        if (!$status_save) {
                            $this->db->trans_rollback();
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception($this->db->error()["code"] . " : Failed save data", 0);
                        }
                    }
                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    //cek data 
                    // $this->m_ref->setTableName("t_md21_sttment_kabkota");
                    $this->m_ref->setTableName("t_mdl2_sttment_kabkota");
                    $select = array();
                    $cond = array(
                        "mapid"  => $idmap,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL");
                    }
                    if ($list_data->num_rows() > 0) {
                        $this->m_ref->setTableName("t_mdl2_sttment_kabkota");
                        $data_baru = array(
                            "attachments"   => $filename,
                            "up_dt"     => $current_date_time,
                            "up_by"     => $session->userid,
                        );
                        $cond = array(
                            "mapid"  => $idmap,
                        );
                        $status_save = $this->m_ref->update($cond, $data_baru);
                        if (!$status_save) {
                            $this->db->trans_rollback();
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception($this->db->error()["code"] . " : Failed save data", 0);
                        }
                    } else {
                        $this->m_ref->setTableName("t_mdl2_sttment_kabkota");
                        $data_baru = array(
                            "mapid"     => $idmap,
                            "attachments"   => $filename,
                            "cr_by"     => $session->userid,
                        );
                        $status_save = $this->m_ref->save($data_baru);
                        if (!$status_save) {
                            $this->db->trans_rollback();
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception($this->db->error()["code"] . " : Failed save data", 0);
                        }
                    }
                }

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                $this->db->trans_commit();


                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Pernyataan berhasil disimpan"
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }



    function g_nilai_upload()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $usergroupid = $session->group;

                $this->form_validation->set_rules('id', 'ID Wilayah', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];

                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");


                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                $link = base_url("attachments/penilaian_tpitpu/");
                if ($kate_wlyh == "PROV") {
                    //cek id wilayah
                    $sql_w = "SELECT * FROM tbl_user_t2_prov WHERE iduser=? AND idwilayah=?";
                    $bind_w = array($userid, $idmap);
                    $list_data_w = $this->db->query($sql_w, $bind_w);
                    if (!$list_data_w) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL1!");
                    }

                    $str_nilai = "N";
                    $str = "";
                    $sql = " SELECT A.`id`,A.`judul`,A.`tautan`
                            FROM `t_doc_tahap_penilaian_prov` A
                            JOIN `tbl_user_t2_prov` B ON B.`id`=A.`mapid` 
                            WHERE A.`isactive`='Y' AND A.tahap ='2' AND B.idwilayah=? AND B.`iduser`=?";
                    $bind = array($idmap, $userid);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
                    }
                    if ($list_data->num_rows() > 0) {
                        $tautan     = $list_data->row()->tautan;
                        $judul     = $list_data->row()->judul;
                        $v_link = $link . $tautan;
                        $str_nilai = "Y";
                        $str = "<a href='" . $v_link . "' download='$judul' target='_blank' type=\"button\" class=\"btn btn-info waves-effect waves-light mr-1\" ><i class=\"fas fa-arrow-circle-right\"></i>&nbsp;Lihat isi penilaian </a>";
                    }
                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    //cek id wilayah
                    $sql_w = "SELECT * FROM tbl_user_t2_kabkot WHERE iduser=? AND idkabkot=?";
                    $bind_w = array($userid, $idmap);
                    $list_data_w = $this->db->query($sql_w, $bind_w);
                    if (!$list_data_w) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL1!");
                    }

                    $str_nilai = "N";
                    $str = "";
                    $sql = " SELECT A.`id`,A.`judul`,A.`tautan`
                            FROM `t_doc_tahap_penilaian_kabkota` A
                            JOIN `tbl_user_t2_kabkot` B ON B.`id`=A.`kbko` 
                            WHERE A.`isactive`='Y' AND A.tahap ='2' AND B.idkabkot=? AND B.`iduser`=?";
                    $bind = array($idmap, $userid);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
                    }
                    if ($list_data->num_rows() > 0) {
                        $tautan     = $list_data->row()->tautan;
                        $judul     = $list_data->row()->judul;
                        $v_link = $link . $tautan;
                        $str_nilai = "Y";
                        $str = "<a href='" . $v_link . "' download='$judul' target='_blank' type=\"button\" class=\"btn btn-info waves-effect waves-light mr-1\" ><i class=\"fas fa-arrow-circle-right\"></i>&nbsp;Lihat isi penilaian </a>";
                    }
                }

                $response = array(
                    "status"            => 1,
                    "csrf_hash"         => $this->security->get_csrf_hash(),
                    "str"               => $str,
                    "str_nilai"         => $str_nilai,
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
     * insert data penilaian Prov
     * author : FSM 
     * date : 17 des 2020
     */
    function save_dok_nilai()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Your session is ended, please relogin", 2);
                }
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 0);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $this->form_validation->set_rules('id', 'ID Provinsi', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = decrypt_base64($this->input->post("id"));

                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");

                $inp_nm     = $this->input->post("nama");
                $userid = $this->session->userdata(SESSION_LOGIN)->id;

                //upload file dokumen
                $inp_urldoc = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/penilaian_tpitpu/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
                    $config['max_size']    = '900000'; //900 Mb
                    $config['encrypt_name']    = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")) {
                        throw new Exception($this->upload->display_errors("", ""), 0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    //                    $inp_urldoc = base_url("attachments/penilaian_tpitpu/").$upload_file['file_name'];
                    $inp_urldoc = $upload_file['file_name'];
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                /*
                * check data Prov - start
                */
                if ($kate_wlyh == "PROV") {

                    //cek id wilayah
                    $sql_w = "SELECT * FROM tbl_user_t2_prov WHERE iduser=? AND idwilayah=?";
                    $bind_w = array($userid, $idmap);
                    $list_data_w = $this->db->query($sql_w, $bind_w);
                    if (!$list_data_w) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL1!");
                    }
                    foreach ($list_data_w->result() as $w) {
                        $idwil = $w->id;
                    }

                    //cek duplikasi
                    $sql = " SELECT A.`id`,A.`mapid`,A.`judul`,A.`tautan`
                            FROM `t_doc_tahap_penilaian_prov` A
                            JOIN `tbl_user_t2_prov` B ON B.`id`=A.`mapid` 
                            WHERE A.`isactive`='Y' AND A.tahap ='1' AND B.idwilayah=? AND judul=? AND B.`iduser`=? ";
                    $bind = array($idmap, $inp_nm, $userid);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
                    }
                    if ($list_data->num_rows() > 0) {
                        $dokid     = $list_data->row()->id; //Id Dokumen
                        $wilid     = $list_data->row()->mapid; //Id Dokumen
                        //1.pastikan  per wilayah 
                        $sql = "DELETE A
                            FROM `t_doc_tahap_penilaian_prov` A
                            WHERE A.`mapid`=? AND A.tahap='2' ";

                        $bind = array($wilid,);
                        $stts = $this->db->query($sql, $bind);
                        if (!$stts) {
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                        }
                    }
                    // add record
                    $this->m_ref->setTableName("t_doc_tahap_penilaian_prov");
                    $data_baru = array(
                        "mapid"     => $idwil,
                        "judul"     => $inp_nm,
                        "tautan"    => $inp_urldoc,
                        "isactive"  => 'Y',
                        "tahap"     => '2',
                        "cr_dt"     => $current_date_time,
                        "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        log_message("error", $this->db->error()["message"]);
                        throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
                    }
                }
                /*
                * check data KAB / KOTA - start
                */ elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {

                    //cek id wilayah kab kota
                    $sql_w = "SELECT * FROM tbl_user_t2_kabkot WHERE iduser=? AND idkabkot=?";
                    $bind_w = array($userid, $idmap);
                    $list_data_w = $this->db->query($sql_w, $bind_w);
                    if (!$list_data_w) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL1!");
                    }
                    foreach ($list_data_w->result() as $w) {
                        $idwil = $w->id;
                    }

                    //cek duplikasi
                    $sql = " SELECT A.`id`,A.kbko,A.`judul`,A.`tautan`
                                FROM `t_doc_tahap_penilaian_kabkota` A
                                JOIN `tbl_user_t2_kabkot` B ON B.`id`=A.`kbko` 
                                WHERE A.`isactive`='Y' AND A.tahap ='2' AND B.`idkabkot`=? AND judul=? AND B.`iduser`=?  ";
                    $bind = array($idmap, $inp_nm, $userid);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
                    }
                    if ($list_data->num_rows() > 0) {
                        $dokid     = $list_data->row()->id; //Id Dokumen
                        $wilid     = $list_data->row()->kbko; //Id Dokumen
                        //1.pastikan  per wilayah 
                        $sql = "DELETE A
                            FROM `t_doc_tahap_penilaian_kabkota` A
                            WHERE A.`kbko`=? AND A.tahap='2' ";

                        $bind = array($wilid,);
                        $stts = $this->db->query($sql, $bind);
                        if (!$stts) {
                            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                        }
                    }
                    // add record
                    $this->m_ref->setTableName("t_doc_tahap_penilaian_kabkota");
                    $data_baru = array(
                        "kbko"      => $idwil,
                        "judul"     => $inp_nm,
                        "tautan"    => $inp_urldoc,
                        "isactive"  => 'Y',
                        "tahap"     => '2',
                        "cr_dt"     => $current_date_time,
                        "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        log_message("error", $this->db->error()["message"]);
                        throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
                    }
                }

                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Data berhasil disimpan"
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),

                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }






    /*
     * 
     */
    function tambah_skore()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $this->form_validation->set_rules('idtambah', 'ID Comb', 'required|xss_clean');
                $this->form_validation->set_rules('itmnama', 'item Nama', 'required|xss_clean');
                $this->form_validation->set_rules('skor', 'Nilai skor', 'required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                $idcomb = decrypt_base64($this->input->post("idtambah"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                $idindi = $tmp[2];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if (!is_numeric($idindi))
                    throw new Exception("Invalid ID Indi");
                $itmnamai = $this->input->post("itmnama");
                $nilai = $this->input->post("skor");

                //get indikator catatan
                $sql = "SELECT nama,note
                        FROM `r_mdl2_indi`
                        WHERE id=?";
                $bind = array($idindi);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                if ($list_data->num_rows() == 0)
                    throw new Exception("Data indikator tidak ditemukan");
                $ctt_indi = $list_data->row()->note;

                $str = "";
                $ttl_skor = "";
                if ($kate_wlyh == "PROV") {
                    /*
                     * check map wilayah - START
                     */
                    $sql = "SELECT * FROM tbl_user_t2_prov WHERE id=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if ($list_data->num_rows() == 0)
                        throw new Exception("Data Map tidak ditemukan!", 0);
                    /*
                     * check map wilayah - END
                     */
                    /*
                     * check kategori penilaian item - START
                     */
                    //                    $sql = "SELECT A.id,A.nourut,A.nama nmitem, A.indiid
                    //                            FROM `r_mdl2_item_indi` A
                    //                            WHERE A.id = ?";
                    //                    $bind = array($idindi);
                    //                    $list_data = $this->db->query($sql,$bind);
                    //                    if(!$list_data){
                    //                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    //                        log_message("error", $msg);
                    //                        throw new Exception("Invalid SQL!");
                    //                    }
                    //                    if($list_data->num_rows() ==0)
                    //                        throw new Exception("Data Kategori Penilaian Item tidak ditemukan!",0);
                    //                    
                    //                    $iditem     = $list_data->row()->id; //ID item
                    //                    $urutno     = $list_data->row()->nourut; // Nomor urut
                    //                    $idindii     = $list_data->row()->indiid; // ID indikator
                    //                    $nmitem     = $list_data->row()->nmitem; // Nama Kriteria
                    /*
                     * check kategori penilaian item - END
                     */

                    /*
                     * check nomor urut - START
                     */
                    $sql = "SELECT * FROM ( SELECT A.id,A.nourut,A.nama nmitem,A.indiid, B.skor
                                            FROM `r_mdl2_item_indi` A
                                            LEFT JOIN `t_mdl2_skor_prov` B ON B.iditem = A.id AND B.mapid=?
                                            WHERE A.indiid = " . $idindi . "  ) AS a 
                            UNION     
                            SELECT * FROM ( SELECT B.id,B.nourut,B.nama nmitem,B.indiid, B.skor
                                            FROM `r_mdl2_indi` A
                                            LEFT JOIN `t_mdl2_skor_prov_tambah` B ON B.indiid = A.id AND B.mapid=?
                                            WHERE A.id = " . $idindi . " ) AS b
                            ORDER BY nourut ASC";
                    $bind = array($idmap, $idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    foreach ($list_data->result() as $v) {
                        $nourut[] = $v->nourut;
                    }
                    $maxno = max($nourut) + 1;
                    /*
                * check nomor urut - END
                */
                    /*
                     * +++++++++++++++++++++++++
                     * catat penilaian - START
                     * +++++++++++++++++++++++++
                     */

                    //1.pastikan skor item per wilayah 
                    //                    $sql = "DELETE A
                    //                            FROM `t_mdl2_skor_prov` A
                    //                            WHERE A.`mapid`=? AND A.`iditem`=?";
                    //                    $bind = array($idmap,$iditem);
                    //                    $stts = $this->db->query($sql,$bind);
                    //                    if(!$stts){
                    //                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    //                        log_message("error", $msg);
                    //                        throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                    //                    }
                    //2.simpan data
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("t_mdl2_skor_prov_tambah");
                    $data_baru = array(
                        "mapid"     => $idmap,
                        "iditem"    => $maxno,
                        "nourut"    => $maxno,
                        "indiid"    => $idindi,
                        "nama"      => $itmnamai,
                        "skor"      => $nilai,
                        "cr_by"     => $session->id,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        $this->db->trans_rollback();
                        throw new Exception("SQL Error " . $this->db->error("code") . " : Gagal menyimpan skor!", 0);
                    }

                    /*
                     * +++++++++++++++++++++++++
                     * catat penilaian - END
                     * +++++++++++++++++++++++++
                     */

                    //LIST INDIKATOR
                    //                    $sql = "SELECT * FROM ( SELECT A.id,A.nourut,A.nama nmitem,A.indiid, B.skor
                    //                                            FROM `r_mdl2_item_indi` A
                    //                                            LEFT JOIN `t_mdl2_skor_prov` B ON B.iditem = A.id AND B.mapid=?
                    //                                            WHERE A.indiid = ".$idindi."  ) AS a 
                    //                            UNION all    
                    //                            SELECT * FROM ( SELECT B.id,B.nourut,B.nama nmitem,B.indiid, B.skor
                    //                                            FROM `r_mdl2_indi` A
                    //                                            LEFT JOIN `t_mdl2_skor_prov_tambah` B ON B.indiid = A.id AND B.mapid=?
                    //                                            WHERE A.id = ".$idindi." ) AS b
                    //                            ORDER BY nourut ASC";  
                    //                    $bind = array($idmap,$idmap);
                    //                    $list_data = $this->db->query($sql,$bind);
                    //                    $bind = array($idmap,$idmap);
                    //                    $list_data = $this->db->query($sql,$bind);
                    //                    if(!$list_data){
                    //                      $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    //                      log_message("error", $msg);
                    //                      throw new Exception("Invalid SQL!");
                    //                    }
                    //                    $nom='';
                    //                    if($list_data->num_rows()==0)
                    //                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
                    //                    foreach ($list_data->result() as $v) {
                    //                        if($v->id !=NULL){
                    //                        $idcomb = $kate_wlyh."-".$idmap."-".$v->id;
                    //                        $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    //                        $tmp = "class='  ' data-id='".$encrypted_id."' data-item='$v->nourut' ";
                    //                        $tmp .= " title='Isi indikator penilaian'";
                    //
                    //                        $str.="<tr>";
                    //                        $str.="<td class='text-right'>".$v->nourut."</td>";
                    //                        $str.="<td class='p-l-25'>".wordwrap($v->nmitem,80,"<br/>")."</td>";
                    //
                    //                        $str_tmp = "<div class='form-group t_dataNil' >
                    //                                            <input type='number' pattern='[0-9]+([,\.][0-9]+)?' class='form-control '  id='$v->nourut' data-nn='$v->nourut' name='nitem' data-nilai='nilai' value='$v->skor'>
                    //                                        </div>";
                    //
                    //                        $str.="<td class='p-l-25 _colSatu textpointer _btnIsiIndiItem' style='width:100px' ".$tmp.">".$str_tmp."</td>";
                    //
                    //
                    //                        $str.="</tr>";
                    //                        $nom[]=$v->nourut;
                    //                        $ttl_skor+= is_null($v->skor)?0:$v->skor;
                    //                        }
                    //                    }
                    //                    $noberikut = max($nom)+1;
                    //
                    //                    $str_foot = "<tr >";
                    //                    $str_foot .= "<td  class='text-right'>$noberikut.</td>";
                    //                    $str_foot .= "<td class='text-left'></td>";
                    //
                    //                    $str_foot .= "<td class='text-right'>"
                    //                            . "<a href='javascript:void(0)'  class='text-info btn btn-sm _btnEdit' ><i class='fas fa-pencil-alt'></i></a></td>";
                    //                    $str_foot .= "</tr>";
                    //
                    //                    $str_foot .= "<tr class='bg-secondary'>";
                    //                    $str_foot .= "<td colspan='2' class='text-center'><h5>TOTAL SKOR</h5></td>";
                    //                    $str_foot .= "<td class='text-right'><h4 class='ttl_skor'>$ttl_skor</h4></td>";
                    //                    $str_foot .= "</tr>";
                    //
                    //                    $nilai = $ttl_skor/$list_data->num_rows()*10;

                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                }

                $this->db->trans_commit();
                //sukses
                $output = array(
                    "status"                => 1,
                    "csrf_hash"             => $this->security->get_csrf_hash(),
                    "msg"                   => "Sukses menyimpan data",
                    //                    "str"           => $str,
                    //                    "str_foot"      => $str_foot,
                    //"nilai"         => '',
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                log_message("error", $exc->getLine());
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
}
