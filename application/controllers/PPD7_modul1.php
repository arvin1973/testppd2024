<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Penilaian Modul 1 oleh TPT Pusat
* author : 
 * date : 10 des 2020
*/
class PPD7_modul1 extends CI_Controller {
    var $view_dir   = "ppd7/module_1/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/module_1/ppd2.js";
    
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");
        $this->load->library("Excel");
    }
    
    
    public function index(){
        if($this->input->is_ajax_request()){
            try 
            {                
                if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);                session_write_close();
                $idprov = $this->session->userdata(SESSION_LOGIN)->satker;
                $provinsi = $this->db->query("SELECT * FROM provinsi WHERE id='$idprov'")->row_array();
                
                $username = $session->name;
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //common properties
                $this->js_init    = "main";
                $this->js_tedit    = "main";
                $this->js_path    = "assets/js/ppd7/PPD7_modul_1/ppd7.js?v=".now("Asia/Jakarta");
                

                $data_page = array(
                    "username"=>$username,
                    "prov" =>$provinsi 
                    );
                $str = $this->load->view($this->view_dir."index_ppd7",$data_page,TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init.".init();",
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

        }
        else{
            exit("access denied!");
        }
    }

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
                
                //jumlah wilayah penilaian kabupaten
                $sql = "SELECT U.* 
                        FROM `tbl_user_kabkot` U 
                        LEFT JOIN `kabupaten` K ON K.id=U.idkabkot 
                        WHERE U.`iduser`='" . $iduaer . "' AND K.urutan=0";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_kab = $list_data->num_rows();
                //jumlah item Kabupaten/kota
                $sql = "SELECT COUNT(1) jml 
                        FROM `r_mdl1_item` IT 
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'  
                        JOIN `r_mdl1_indi` I ON I.`id`=SI.`indiid` 
                        JOIN `r_mdl1_krtria` K ON K.`id`=I.`krtriaid`";
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
                $sql = "SELECT COUNT(1) jml FROM `t_mdl1_sttment_kabkota` S
                    JOIN `tbl_user_kabkot` W ON W.`id`=S.mapid
                    JOIN `tbl_user` U ON U.id = W.`iduser`
                    JOIN `kabupaten` K ON K.id=W.`idkabkot` AND K.urutan=0
                    WHERE U.id='" . $iduaer . "' ";
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
                                    JOIN `tbl_user_kabkot` W ON W.`iduser`=U.id
                                    JOIN `kabupaten` KK ON KK.id=W.`idkabkot` AND KK.urutan=0
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE U.`id`=" . $iduaer . "  ";
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

                $warna_kab = '';
                if ($total_penyelesaian_kab <= '33') {
                    $warna_kab = '#ef5350'; //merah
                } elseif ($total_penyelesaian_kab > '33' || $total_penyelesaian_kab <= '66') {
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
                $sql = "SELECT U.* 
                        FROM `tbl_user_kabkot` U 
                        LEFT JOIN `kabupaten` K ON K.id=U.idkabkot 
                        WHERE U.`iduser`='" . $iduaer . "' AND K.urutan=1";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_kot = $list_data->num_rows();
                $total_item_kot = $jml_kot * $sum_item_kabko;
                //jumlah lembar kertas kerja kota
                $sql = "SELECT COUNT(1) jml FROM `t_mdl1_sttment_kabkota` S
                    JOIN `tbl_user_kabkot` W ON W.`id`=S.mapid
                    JOIN `tbl_user` U ON U.id = W.`iduser`
                    JOIN `kabupaten` K ON K.id=W.`idkabkot` AND K.urutan=1
                    WHERE U.id='" . $iduaer . "' ";
                $list_data_l = $this->db->query($sql);
                if (!$list_data_l) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_lembar_kot = $list_data_l->row()->jml;
                //Jumlah penyelesaian modul kota
                $sql = "SELECT COUNT(1) jml_ttl
                    FROM `tbl_user` U
                                    JOIN `tbl_user_kabkot` W ON W.`iduser`=U.id
                                    JOIN `kabupaten` KK ON KK.id=W.`idkabkot` AND KK.urutan=1
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE U.`id`=" . $iduaer . " ";
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
    function g_wilayah(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $this->form_validation->set_rules('kate','Kategori Wilayah','required|in_list[PROV,KAB,KOTA]');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $inp_katewlyh = $this->input->post("kate");
                
                
                
                
                //get jml aspek
                $sql = "SELECT A.`id`
                        FROM r_mdl1_aspek A 
                        WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
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
                 * QUERY KABUPATEN - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($inp_katewlyh=='KAB'){
                    //get jml item
                    $sql = "SELECT I.`id`
                            FROM r_mdl1_item I 
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov='N'
                            JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y'";
                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $jml_item = $list_data->num_rows();
                    //LIST KABUPATEN
                    $sql = "SELECT A.`id` mapid,K.id idkab,K.id_kab id_kode ,K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idkabkot` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                            ) JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN(
				SELECT W.`idkabkot` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`=?
				GROUP BY W.`idkabkot`
                            ) RS ON RS.idkab=A.`idkabkot`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`=?";
                    $bind = array($session->id,$session->id,$session->id);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }

                    $str="";
                    if($list_data->num_rows()==0) {
                        $str .= "<div class='not-found-img' style='display: grid; justify-content: center;'>";
                        $str .= "<img src='".base_url()."/assets/icons/not_found_2.svg' alt='Data Not Found' width='200' height='200'>";
                        $str .= "<h5 style='font-family: \'Hind Madurai\', sans-serif; text-align: center;'>- <strong style='color: red;'>Data</strong> tidak ditemukan -</h5>";
                        $str .= "</div>";
                    }else{
                        $no=1;
                        foreach ($list_data->result() as $v) {
                            $idcomb = $inp_katewlyh."-".$v->mapid;
                            $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));


                            $tmp = "class='btn btn-sm btn-success waves-effect waves-light btn-mulai-penilaian getDetail' data-id='".$encrypted_id."'";
                            $tmp .= " data-nmwlyh='".$v->nmkab."'";
                            
                            $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                            $str .= "<div style='display: flex;'>";
                            $str .= "<img src='".base_url()."assets/icons/PNG_KabupatenKota/".$v->id_kode."_".$v->nmkab.".png' width='100' height='100' alt='".$v->nmkab."' title='".$v->nmkab."' style='padding: 15px;'>";
                            $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-bottom: 0.8rem; padding-left: 0px;'>";
                            $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                            $str .= "<h4 class='title-regional-name'>".$v->nmkab."</h4>";

                            $str .= "<div class='btn-wilayah'>";
                            
                            //TAUTAN DOC
                            $idcomb_kab = $inp_katewlyh.'-'.$v->idkab;
                            $encrypted_kabid = base64_encode(openssl_encrypt($idcomb_kab,"AES-128-ECB",ENCRYPT_PASS));
                            $tmp_kab = "class='btn btn-sm btn-primary waves-effect waves-light btn-unduh-bahan-dukung getDoc' data-id='".$encrypted_kabid."'";
                            $tmp_kab.= " data-nmwlyh='".$v->nmkab."'";
                            
                            $str .= "<a href='javascript:void(0)' ".$tmp_kab." style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Unduh Bahan Dukung <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                            $str .= "<a href='javascript:void(0)' ".$tmp." style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Mulai Penilaian <i class='fa fa-caret-right' style='padding-left: 5px;'></i></a>";

                            //status
                            $prcntg = $jml_item==0?0:$v->jml/$jml_item*100;

                            $str_tmp = number_format($prcntg,2)."&nbsp;%";
                            /* if($prcntg==1){
                                $str .= "<button type='button' class='btn btn-sm btn-info waves-effect waves-light' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'><i class='ion ion-md-checkmark-circle-outline'></i></button>";
                            } */
                        
                            //status
                            $color_progress = "#ffd740";
                            $notif_warning = "";
                            if($prcntg==100){
                                $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getDetail' data-id='".$encrypted_id."' data-nmwlyh='".$v->nmkab."' data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                                $str_icon = "<i class='fas fa-exclamation'></i>";
                                $notif_warning = "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem; float: right;'>".$str_icon." anda belum menyelesaikan data resume aspek</p>";
                                $color_progress = "#ffd740";
                                if($v->jml_rsm==$jml_aspek){
                                    if(!is_null($v->stts)){
                                        $str_tmp = "class='btn btn-sm btn-info waves-effect waves-light btn-status getSttmnt' data-id='".$encrypted_id."' title='klik untuk lihat detail lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#29b6f6";
                                        $notif_warning = "";
                                    }else{
                                        $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getSttmnt' data-id='".$encrypted_id."' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#33b86c";
                                        $notif_warning = "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem; float: right;'>".$str_icon." anda belum menyelesaikan lembar pernyataan</p>";
                                    }
                                }
                                $str .= "<a href='javascript:void(0);' ".$str_tmp.">".$str_icon."</a>";                                
                            }

                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div class='mt-0'>";
                            $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : ".number_format($prcntg,2)." %</p>";
                            $str .= "<div class='progress progress-sm' style='margin-bottom: 0px;'>";
                            $str .= "<div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='".number_format($prcntg,2)."' aria-valuemin='0' aria-valuemax='100' style='width: ".number_format($prcntg,2)."%; background-color: ".$color_progress."!important;'>";
                            $str .= "<span class='sr-only'>".number_format($prcntg,2)." % Complete</span>";
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
                 */
                elseif($inp_katewlyh=='KOTA'){
                    //get jml item
                    $sql = "SELECT I.`id`
                            FROM r_mdl1_item I 
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov='N'
                            JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y'";
                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $jml_item = $list_data->num_rows();
                    
                    //LIST KOTA
                    $sql = "SELECT A.`id` mapid,K.id idkota, K.id_kab id_kode, K.`nama_kabupaten` nmkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idkabkot` AND K.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                            ) JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN(
				SELECT W.`idkabkot` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`=?
				GROUP BY W.`idkabkot`
                            ) RS ON RS.idkab=A.`idkabkot`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
                            WHERE A.`iduser`=?";
                    $bind = array($session->id,$session->id,$session->id);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }

                    $str="";
                    if($list_data->num_rows()==0) {
                        $str .= "<div class='not-found-img' style='display: grid; justify-content: center;'>";
                        $str .= "<img src='".base_url()."/assets/icons/not_found_2.svg' alt='Data Not Found' width='200' height='200'>";
                        $str .= "<h5 style='font-family: \'Hind Madurai\', sans-serif; text-align: center;'>- <strong style='color: red;'>Data</strong> tidak ditemukan -</h5>";
                        $str .= "</div>";
                    }else{
                        $no=1;
                        foreach ($list_data->result() as $v) {
                            $idcomb = $inp_katewlyh."-".$v->mapid;
                            $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));


                            $tmp = "class='btn btn-sm btn-success waves-effect waves-light btn-mulai-penilaian getDetail' data-id='".$encrypted_id."'";
                            $tmp .= " data-nmwlyh='".$v->nmkab."'";

                            $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                            $str .= "<div style='display: flex;'>";
                            $str .= "<img src='".base_url()."assets/icons/PNG_KabupatenKota/".$v->id_kode."_".$v->nmkab.".png' width='100' height='100' alt='".$v->nmkab."' title='".$v->nmkab."' style='padding: 15px;'>";
                            $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-bottom: 0.8rem; padding-left: 0px;'>";
                            $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                            $str .= "<h4 class='title-regional-name'>".$v->nmkab."</h4>";
                                    

                            //TAUTAN DOC
                            $idcomb_kota = $inp_katewlyh.'-'.$v->idkota;
                            $encrypted_kotaid = base64_encode(openssl_encrypt($idcomb_kota,"AES-128-ECB",ENCRYPT_PASS));
                            $tmp_kota= "class='btn btn-sm btn-primary waves-effect waves-light btn-unduh-bahan-dukung getDoc' data-id='".$encrypted_kotaid."'";
                            $tmp_kota.= " data-nmwlyh='".$v->nmkab."'";
                            
                            $str .= "<div class='btn-wilayah' style='float: right;'>";
                            $str .= "<a href='javascript:void(0);' ".$tmp_kota." style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Unduh Bahan Dukung <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                            $str .= "<a href='javascript:void(0);' ".$tmp." style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Mulai Penilaian <i class='fa fa-caret-right' style='padding-left: 5px;'></i></a>";
                                    
                            //status
                            $prcntg = $jml_item==0?0:$v->jml/$jml_item*100;

                            $str_tmp = number_format($prcntg,2)."&nbsp;%";
                            /* if($prcntg==1){
                                $str .= "<button type='button' class='btn btn-sm btn-info waves-effect waves-light' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'><i class='ion ion-md-checkmark-circle-outline'></i></button>";
                            } */
                        
                            //status
                            $color_progress = "#ffd740";
                            $notif_warning = "";
                            if($prcntg==100){
                                $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getDetail' data-id='".$encrypted_id."' data-nmwlyh='".$v->nmkab."' data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                                $str_icon = "<i class='fas fa-exclamation'></i>";
                                $notif_warning = "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem; float: right;'>".$str_icon." anda belum menyelesaikan data resume aspek</p>";
                                $color_progress = "#ffd740";
                                if($v->jml_rsm==$jml_aspek){
                                    if(!is_null($v->stts)){
                                        $str_tmp = "class='btn btn-sm btn-info waves-effect waves-light btn-status getSttmnt' data-id='".$encrypted_id."' title='klik untuk lihat detail lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#29b6f6";
                                        $notif_warning = "";
                                    }else{
                                        $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getSttmnt' data-id='".$encrypted_id."' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                                        $str_icon = "<i class='fas fa-check-circle'></i>";
                                        $color_progress = "#33b86c";
                                        $notif_warning = "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem; float: right;'>".$str_icon." anda belum menyelesaikan lembar pernyataan</p>";
                                    }
                                }
                                $str .= "<a href='javascript:void(0);' ".$str_tmp.">".$str_icon."</a>";                                
                            }

                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div class='mt-0'>";
                            $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : ".number_format($prcntg,2)." %</p>";
                            $str .= "<div class='progress progress-sm' style='margin-bottom: 0px;'>";
                            $str .= "<div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='".number_format($prcntg,2)."' aria-valuemin='0' aria-valuemax='100' style='width: ".number_format($prcntg,2)."%; background-color: ".$color_progress."!important;'>";
                            $str .= "<span class='sr-only'>".number_format($prcntg,2)." % Complete</span>";
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
                }
        else die("Die!");
    }
    
    /*
     * list data dokumen bahan dukung masing-masing wilayah
     * author :  
     * date : 9 jan 2021
     */
    function g_doc(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $usergroupid = $session->group;
                
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idwlyh     = $tmp[1];
                
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idwlyh))
                    throw new Exception("Invalid ID Map");
                
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($kate_wlyh=="PROV"){
                    
                    /*
                     * check data PROV - start
                     */
                    $sql = "SELECT A.`id`
                            FROM `provinsi` A
                            WHERE A.`id`=?";
                    $bind = array($idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() ==0){
                        $msg = $session->userid." ".$this->router->fetch_class()." : Prov ID : ".$idwlyh." not found";
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
                    $bind = array($usergroupid,$usergroupid,$idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                }
                
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    /*
                     * check data KAB / KOTA - start
                     */
                    $sql = "SELECT A.`id`
                            FROM `kabupaten` A
                            WHERE A.`id`=?";
                    $bind = array($idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() ==0){
                        $msg = $session->userid." ".$this->router->fetch_class()." : Kab/Kota ID : ".$idwlyh." not found";
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
                    $bind = array($usergroupid,$usergroupid,$idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                }
                
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                
                
                $str="";
                if($list_data->num_rows()==0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
                
                $no=1;
                $lnk='https';
                foreach ($list_data->result() as $v) {
                    if(substr($v->tautan,0, 5)=='https'){
                        $link=$v->tautan;
                    }
                    else {
                        $tautan= substr($v->tautan, 4);
                        $link = $lnk.$tautan;
                    }
                    
                    if(substr($v->tautan, -3) == 'rar'){
                        $rename = $v->judul.".rar";
                    }
                    elseif(substr($v->tautan, -3) == 'zip'){
                        $rename = $v->judul.".zip";
                    }
                    elseif(substr($v->tautan, -3) == 'pdf'){
                        $rename = $v->judul.".pdf";
                    }
                    elseif (substr($v->tautan, -4) == 'docx') {
                        $rename = $v->judul.".docx";
                    }
                    elseif (substr($v->tautan, -4) == 'xlsx') {
                        $rename = $v->judul.".xlsx";
                    }
                    elseif (substr($v->tautan, -4) == 'jpeg') {
                        $rename = $v->judul.".jpeg";
                    }
                    elseif (substr($v->tautan, -4) == 'pptx') {
                        $rename = $v->judul.".pptx";
                    }
                    else{
                        $rename = $v->judul;
                    }
                    $str.="<tr>";
                    $str.="<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>".$no++."</td>";
                    // $str.="<td class=''><a href='".$link."' download='$rename' target='_blank' title='Klik untuk unduh dokumen' >".wordwrap($v->judul,50,"<br/>")."</a></td>";
                    $str.="<td class='' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a href='".$link."' download='$rename' target='_blank' title='Klik untuk unduh dokumen' >".$v->judul."</a></td>";
                    $str.="<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a class='btn btn-xs text-primary' target='_blank' title='Klik untuk unduh dokumen' href='".$link."' download='$rename' ><i class='fas fa-lg fa-download'></i></a></td>";
                    $str.="</tr>";
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
                }
        else die("Die!");
    }
    
    /*
     * list data indikator
     * author :  
     * date : 10 des 2020
     */
    function g_indi(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($kate_wlyh=="PROV"){
                    //LIST INDIKATOR
                    $sql = "SELECT A.id idindi,B.id idkriteria,ASP.id idaspek,ASP.nama nmaspek,B.`nama` nmkriteria,A.`nama` nmindi,ASP.bobot bobotaspek,A.`bobot` bobotindi,B.`bobot` bobotkriteria,A.`note` noteindi
                            ,A.nourut,COUNT(1) jml,IFNULL(LAPOR.jml,0) jmllapor,RSM.`stts` stts_rsm
                            FROM `r_mdl1_indi` A
                            JOIN `r_mdl1_krtria` B ON B.`id`=A.`krtriaid`
                            JOIN `r_mdl1_aspek` ASP ON ASP.id=B.aspekid
                            JOIN `r_mdl1_sub_indi` SI ON SI.`indiid`=A.`id`
                            JOIN `r_mdl1_item` I ON I.`subindiid`=SI.`id`
                            LEFT JOIN(
                                    SELECT MI.`id` idindi,COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`id`=?
                                    GROUP BY MI.`id`
                            ) LAPOR ON LAPOR.idindi=A.`id`
                            LEFT JOIN `t_mdl1_resume_prov` RSM ON RSM.`aspekid`=ASP.`id` AND RSM.`mapid`=?
                            GROUP BY A.`id`
                            ORDER BY B.`id`,A.nourut";
                    $bind = array($idmap,$idmap);
                    $list_data = $this->db->query($sql,$bind);                 
                    
                    
                   /*
                    * +++++++++++++++++++++++++++++++++++++++++
                    * CHECK KELENGKAPAN RESUME PROVINSI - START
                    * +++++++++++++++++++++++++++++++++++++++++
                    */
                   $sql = "SELECT COUNT(A.id) jml, SUM(CASE WHEN B.`id` IS NULL THEN 0 ELSE 1 END) jml_rsm
                           FROM `r_mdl1_aspek` A
                           LEFT JOIN `t_mdl1_resume_prov` B ON A.`id`=B.`aspekid` AND B.`mapid`=?
                           WHERE A.`isactive`='Y'";
                   $bind = array($idmap);
                   $list_check = $this->db->query($sql,$bind);
                   if(!$list_check){
                       $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                       log_message("error", $msg);
                       throw new Exception("Invalid SQL!");
                   }
                   if($list_check->num_rows()==0)
                       throw new Exception("Data Kriteria tidak ditemukan!");

                   $sttsDispSttment = 'N';
                   if($list_check->row()->jml>0 && $list_check->row()->jml==$list_check->row()->jml_rsm)
                       $sttsDispSttment = 'Y';

                   /*
                    * +++++++++++++++++++++++++++++++++++++++
                    * CHECK KELENGKAPAN RESUME PROVINSI- END
                    * +++++++++++++++++++++++++++++++++++++++
                    */
                    
                    if($sttsDispSttment=='Y'){
                        $sql = "SELECT id FROM t_mdl1_sttment_prov WHERE mapid=?";
                        $bind = array($idmap);
                        $list_check = $this->db->query($sql,$bind);
                        if(!$list_check){
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception("Invalid SQL!");
                        }
                        if($list_check->num_rows()>0)
                            $sttsDispSttment='N';
                    }
                }
                
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    //LIST INDIKATOR
                    $sql = "SELECT A.id idindi,B.id idkriteria,B.`nama` nmkriteria,ASP.id idaspek,ASP.nama nmaspek,A.`nama` nmindi,ASP.bobot bobotaspek,A.`bobot` bobotindi,B.`bobot` bobotkriteria,A.`note` noteindi
                            ,A.nourut,COUNT(1) jml,IFNULL(LAPOR.jml,0) jmllapor,RSM.`stts` stts_rsm
                            FROM `r_mdl1_indi` A
                            JOIN `r_mdl1_krtria` B ON B.`id`=A.`krtriaid`
                            JOIN `r_mdl1_aspek` ASP ON ASP.id=B.aspekid
                            JOIN `r_mdl1_sub_indi` SI ON SI.`indiid`=A.`id` AND SI.isprov='N'
                            JOIN `r_mdl1_item` I ON I.`subindiid`=SI.`id`
                            LEFT JOIN(
                                    SELECT MI.`id` idindi,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`id`=?
                                    GROUP BY MI.`id`
                            ) LAPOR ON LAPOR.idindi=A.`id`
                            LEFT JOIN `t_mdl1_resume_kabkota` RSM ON RSM.`aspekid`=ASP.`id` AND RSM.`mapid`=?
                            GROUP BY A.`id`
                            ORDER BY B.`id`,A.nourut";
                    $bind = array($idmap,$idmap);
                    $list_data = $this->db->query($sql,$bind);
                    
                    
                   /*
                    * +++++++++++++++++++++++++++++++++++++++++++
                    * CHECK KELENGKAPAN RESUME KABUPATEN - START
                    * +++++++++++++++++++++++++++++++++++++++++++
                    */
                   $sql = "SELECT COUNT(A.id) jml, SUM(CASE WHEN B.`id` IS NULL THEN 0 ELSE 1 END) jml_rsm
                           FROM `r_mdl1_aspek` A
                           LEFT JOIN `t_mdl1_resume_kabkota` B ON A.`id`=B.`aspekid` AND B.`mapid`=?
                           WHERE A.`isactive`='Y'";
                   $bind = array($idmap);
                   $list_check = $this->db->query($sql,$bind);
                   if(!$list_check){
                       $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                       log_message("error", $msg);
                       throw new Exception("Invalid SQL!");
                   }
                   if($list_check->num_rows()==0)
                       throw new Exception("Data Kriteria tidak ditemukan!");

                   $sttsDispSttment = 'N';
                   if($list_check->row()->jml>0 && $list_check->row()->jml==$list_check->row()->jml_rsm)
                       $sttsDispSttment = 'Y';

                   /*
                    * +++++++++++++++++++++++++++++++++++++++++
                    * CHECK KELENGKAPAN RESUME KABUPATEN - END
                    * +++++++++++++++++++++++++++++++++++++++++
                    */
                    
                    if($sttsDispSttment=='Y'){
                        $sql = "SELECT id FROM t_mdl1_sttment_kabkota WHERE mapid=?";
                        $bind = array($idmap);
                        $list_check = $this->db->query($sql,$bind);
                        if(!$list_check){
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error", $msg);
                            throw new Exception("Invalid SQL!");
                        }
                        if($list_check->num_rows()>0)
                            $sttsDispSttment='N';
                    }
                }
                
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                $str="";
                if($list_data->num_rows()==0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
                
                $no=1;
                $idkriteria= $idaspek="";
                $no=1;
                foreach ($list_data->result() as $v) {
                    
                    $idcomb = $kate_wlyh."-".$idmap."-".$v->idaspek;
                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    if($v->idaspek!= $idaspek){
                        $str.="<tr class='alert-info' title='Status Kelengkapan Resume Aspek'>";
                        $str.="<td colspan='2' class='text-uppercase'><b><small>Aspek</small><br/>".$v->nmaspek."</b></td>";
                        $str.="<td colspan='' class='text-uppercase text-vertical-center text-right'><b>".number_format($v->bobotaspek,2)."&nbsp;%</b></td>";
                        
                        //status resume
                        $tmp = " data-id='".$encrypted_id."'";
                        $tmp .= " data-nmaspek='".$v->nmaspek."'";
                        
                        $str_aspek = "";
                        if($v->stts_rsm=='Y')
                            $str_aspek.="<a href='javascript:void(0);' class='_mdlRsm' ".$tmp." ><i class='fas fa-check-circle fa-2x text-info'></i></span>";
                        else if($v->stts_rsm=='N')
                            $str_aspek.="<a href='javascript:void(0);' class='btn btn-warning _mdlRsm' ".$tmp." title='Klik untuk mengisi Resume dan masukan Aspek'><i class='fas fa-exclamation fa-2x'></i></span>";
                        
                        $str.="<td class='text-center text-vertical-center'>".$str_aspek."</td>";
                        $str.="</tr>";
                        $idaspek = $v->idaspek;
                    }
                    if($v->idkriteria != $idkriteria){
                        $str.="<tr class='alert-warning'>";
                        $str.="<td colspan='2' class='text-uppercase pl-4'><b><small>Kriteria</small><br/>".$v->nmkriteria."</b></td>";
                        $str.="<td colspan='' class='text-uppercase text-vertical-center text-right'><b>".number_format($v->bobotkriteria,2)."&nbsp;%</b></td>";
                        
                        
                        $str.="<td class='text-center'></td>";
                        $str.="</tr>";
                        $idkriteria = $v->idkriteria;
                    }
                    
                    $idcomb = $kate_wlyh."-".$idmap."-".$v->idindi;
                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-nmaspek='".$v->nmaspek."'";
                    $tmp .= " data-nmkriteria='".$v->nmkriteria."'";
                    $tmp .= " data-nmindi='".$v->nmindi."'";
                    $str.="<tr>";
                    $str.="<td class='text-right'>".$v->nourut."</td>";
                    // $str.="<td class='p-l-25'><a href='javascript:void(0)' ".$tmp.">".wordwrap($v->nmindi,50,"<br/>")."</a>";
                    $str.="<td class='p-l-25' style='white-space: inherit;'><a href='javascript:void(0)' ".$tmp.">".$v->nmindi."</a>";

                    //status
                    $prcntg = $v->jml==0?0:$v->jmllapor/$v->jml*100;
                    $str .= "<div class='mt-2'>";
                    $str .= "<div class='progress progress-sm' style='margin-bottom: 0px;'>";
                    if ($prcntg == 100) {
                        $str .= "<div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='".number_format($prcntg,2)."' aria-valuemin='0' aria-valuemax='100' style='width: ".number_format($prcntg,2)."%; background-color: #33b86c !important;'>";
                        $str .= "<span class='sr-only'>".number_format($prcntg,2)."% Complete</span>";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : ".number_format($prcntg,2)." %</p>";
                    }else{
                        $str .= "<div class='progress-bar bg-pink progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='".number_format($prcntg,2)."' aria-valuemin='0' aria-valuemax='100' style='width: ".number_format($prcntg,2)."%; background-color: #ffd740!important;'>";
                        $str .= "<span class='sr-only'>".number_format($prcntg,2)."% Complete</span>";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.7rem;'><b>Progress</b> : ".number_format($prcntg,2)." %</p>";
                    }
                    $str .= "</td>";
                    
                    $str.="<td class='text-right'>".number_format($v->bobotindi,2)."&nbsp;%</td>";
                    
                    
                    $str_tmp = "<span class='badge badge-warning'>".number_format($prcntg,2)."&nbsp;%</span>";
                    if($prcntg==100){
                        $str_tmp = "<i class='fas fa-check-circle fa-2x text-success' title='Lengkap'></i>";
                    }
                    
                    $str.="<td class='text-center'>".$str_tmp."</td>";
                    
                    $str.="</tr>";
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
                }
        else die("Die!");
    }
    
    
    /*
     * list data item
     * author :  
     * date : 10 des 2020
     */
    function g_item(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=3)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                $idindi = $tmp[2];
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if(!is_numeric($idindi))
                    throw new Exception("Invalid ID Indi");
                
                //get indikator catatan
                $ctt_indi = "";
                $sql = "SELECT nama,note
                        FROM `r_mdl1_indi`
                        WHERE id=?";
                $bind = array($idindi);                    
                $list_data = $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                if($list_data->num_rows()==0)
                    throw new Exception("Data indikator tidak ditemukan");
                $ctt_indi = $list_data->row()->note;
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($kate_wlyh=="PROV"){
                    //LIST INDIKATOR
                    $sql = "SELECT IT.`nourut`,IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                            ,NOL.idinditem idnol,NOL.nminditem nmnol,SATU.idinditem idsatu,SATU.nminditem nmsatu
                            ,ISI.skor isiskor,ISI.indiitemid
                            FROM `r_mdl1_item` IT
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl1_item_indi` MII
                                    JOIN `r_mdl1_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=".$idindi."
                                    WHERE MII.`skor`=0
                            ) NOL ON NOL.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl1_item_indi` MII
                                    JOIN `r_mdl1_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=".$idindi."
                                    WHERE MII.`skor`=1
                            ) SATU ON SATU.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,II.`skor`,II.`id` indiitemid
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=".$idindi."
                                    WHERE W.`id`=".$idmap."
                                    
                            ) ISI ON ISI.iditem=IT.`id`
                            WHERE SI.`indiid`=".$idindi." "
                            . " ORDER BY SI.`nourut`,IT.`nourut` ASC";
                    $bind = array($idmap);                    
                    $list_data = $this->db->query($sql,$bind);
                }
                
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    //LIST INDIKATOR
                    $sql = "SELECT IT.`nourut`,IT.`id`iditem,IT.`nama` nmitem,SI.`id` idsubindi ,SI.`nama` nmsubindi,SI.`istampil`
                            ,NOL.idinditem idnol,NOL.nminditem nmnol,SATU.idinditem idsatu,SATU.nminditem nmsatu
                            ,ISI.skor isiskor,ISI.indiitemid
                            FROM `r_mdl1_item` IT
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl1_item_indi` MII
                                    JOIN `r_mdl1_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=".$idindi."
                                    WHERE MII.`skor`=0
                            ) NOL ON NOL.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,MII.`id` idinditem,MII.`nama` nminditem
                                    FROM `r_mdl1_item_indi` MII
                                    JOIN `r_mdl1_item` I ON I.`id`=MII.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`indiid`=".$idindi." AND SI.isprov='N'
                                    WHERE MII.`skor`=1
                            ) SATU ON SATU.iditem=IT.`id`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,II.`skor`,II.`id` indiitemid
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=".$idindi."
                                    WHERE W.`id`=".$idmap."
                                    
                            ) ISI ON ISI.iditem=IT.`id`
                            WHERE SI.`indiid`=".$idindi." "
                            . " ORDER BY SI.`nourut`,IT.`nourut` ASC";
                    $bind = array($idmap);                    
                    $list_data = $this->db->query($sql,$bind);
                }
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                $str="";
                if($list_data->num_rows()==0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
                
                $no=1;
                $idsubindi= "";
                $ttl_skor=0;
                foreach ($list_data->result() as $v) {
                    
                    if($v->idsubindi != $idsubindi){
                        if($v->istampil=='Y'){
                            $str.="<tr class='bg-secondary' title='Sub Indikator'>";
                            $str.="<td colspan='7' class='text-uppercase'><b><small>Sub Indikator</small><br/>".$v->nmsubindi."</b></td>";
                            $str.="</tr>";
                        }
                        $idsubindi = $v->idsubindi;
                    }
                    
                    $str.="<tr>";
                    $str.="<td class='text-center'>".$v->nourut."</td>";
                    // $str.="<td class='p-l-25'>".wordwrap($v->nmitem,40,"<br/>")."</td>";
                    $str.="<td style='white-space: inherit;' class='p-l-25'>".$v->nmitem."</td>";
                    
                    
                    //Indikator 0
                    $idcomb = $kate_wlyh."-".$idmap."-".$v->idnol;
                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    
                    $tmp = "class='  ' data-id='".$encrypted_id."' data-nilai='0' ";
                    $tmp .= " title='Klik untuk pilih indikator penilaian 0'";
                    // $str_tmp = wordwrap($v->nmnol,40,"<br/>");
                    $str_tmp = $v->nmnol;
                    
                    $bg_class="";
                    if($v->idnol==$v->indiitemid)
                        $bg_class=" table-warning ";
                    $str.="<td style='white-space: inherit;' class='p-l-25 _colNol textpointer _btnPilihIndiItem ".$bg_class."' ".$tmp.">".$str_tmp."</td>";
                    
                    //Indikator 1
                    $idcomb = $kate_wlyh."-".$idmap."-".$v->idsatu;
                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    
                    $tmp = "class='  ' data-id='".$encrypted_id."'' data-nilai='1'";
                    $tmp .= " title='Klik untuk pilih indikator penilaian 1' ";
                    // $str_tmp = wordwrap($v->nmsatu,40,"<br/>");
                    $str_tmp = $v->nmsatu;
                    
                    $bg_class="";
                    if($v->idsatu==$v->indiitemid)
                        $bg_class=" table-warning ";
                    $str.="<td style='white-space: inherit;' class='p-l-25 _colSatu textpointer _btnPilihIndiItem ".$bg_class."' ".$tmp.">".$str_tmp."</td>";
                    
                    
                    //skor
                    $str_tmp="<h5 class='_colSkor'>".$v->isiskor."</h5>";
                    $str.="<td class='text-center '>".$str_tmp."</td>";
                    
                    $str.="</tr>";
                    
                    $ttl_skor+= is_null($v->isiskor)?0:$v->isiskor;
                }
                
                $str_foot = "<tr class='bg-secondary'>";
                $str_foot .= "<td colspan='4' class='text-center'><h5>TOTAL SKOR</h5></td>";
                $str_foot .= "<td class='text-center'><h4 class='ttl_skor'>".$ttl_skor."</h4></td>";
                $str_foot .= "</tr>";
                
                $nilai = $ttl_skor/$list_data->num_rows()*10;
                
                $response = array(
                    "status"    => 1,   
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => $str,
                    "str_foot"  => $str_foot,
                    "ctt_indi"  => $ctt_indi,
                    "nilai"     => number_format($nilai,1),
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
                }
        else die("Die!");
    }
    
    /*
     * simpan skor kategori item penilaian
     * author : 
     * date : 13 des 2020
     */
    function save_score(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $session=$this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID Comb','required|xss_clean');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                    
                
                
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=3)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                $iditemindi = $tmp[2];
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("Invalid ID Kategori Wilayah");
                if(!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if(!is_numeric($iditemindi))
                    throw new Exception("Invalid ID Indi");
                
                
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
                if($kate_wlyh=="PROV"){
                    
                    /*
                     * check map wilayah - START
                     */
                    $sql = "SELECT * FROM tbl_user_wilayah WHERE id=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() ==0)
                        throw new Exception("Data Map tidak ditemukan!",0);
                    /*
                     * check map wilayah - END
                     */
                    /*
                     * check kategori penilaian item - START
                     */
                    $sql = "SELECT MII.id,MII.skor,MII.itemid,MSI.indiid,I.`krtriaid`,K.`nama` nmkriteria,ASP.id aspekid,ASP.nama nmaspek "
                            . " FROM r_mdl1_item_indi MII "
                            . " JOIN `r_mdl1_item` MI ON MI.`id`=MII.`itemid`
                                JOIN `r_mdl1_sub_indi` MSI ON MSI.`id`=MI.`subindiid` 
                                JOIN `r_mdl1_indi` I ON I.`id`=MSI.`indiid` 
                                JOIN `r_mdl1_krtria` K ON K.`id`=I.`krtriaid`
                                JOIN r_mdl1_aspek ASP ON ASP.id=K.aspekid "
                            . " WHERE MII.id=?";
                    $bind = array($iditemindi);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() ==0)
                        throw new Exception("Data Kategori Penilaian Item tidak ditemukan!",0);
                    
                    $iditem     = $list_data->row()->itemid; //ID item
                    $idindi     = $list_data->row()->indiid; // ID indikator
                    $idkriteria = $list_data->row()->krtriaid; // ID Kriteria
                    $nmkriteria = $list_data->row()->nmkriteria; // Nama Kriteria
                    $idaspek    = $list_data->row()->aspekid; // ID Aspek
                    $nmaspek    = $list_data->row()->nmaspek; // Nama Aspek
                    /*
                     * check kategori penilaian item - END
                     */
                    
                    /*
                     * +++++++++++++++++++++++++
                     * catat penilaian - START
                     * +++++++++++++++++++++++++
                     */
                    
                    //1.pastikan skor item per wilayah 
                    $sql = "DELETE A
                            FROM `t_mdl1_skor_prov` A
                            JOIN `r_mdl1_item_indi` B ON B.`id`=A.`itemindi`
                            WHERE A.`mapid`=? AND B.`itemid`=?";
                    $bind = array($idmap,$iditem);
                    $stts = $this->db->query($sql,$bind);
                    if(!$stts){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                    }
                    //2.simpan data
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("t_mdl1_skor_prov");
                    $data_baru = array(
                        "mapid"     => $idmap,
                        "itemindi"  => $iditemindi,
                        "cr_by"     => $session->id,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){$this->db->trans_rollback();throw new Exception("SQL Error ".$this->db->error("code")." : Gagal menyimpan skor!",0);}
                    
                    
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
                    $sql = "SELECT MI.`id` idindi,SUM(II.`skor`) skor
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=".$idindi."
                                    WHERE W.`id`=".$idmap." "
                            . " GROUP BY MI.`id`";
                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $ttl_skor = 0;
                    if($list_data->num_rows() > 0)
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
                            FROM `r_mdl1_item` IT
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            WHERE SI.`indiid`=".$idindi." ";
                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $nilai = $ttl_skor/$list_data->num_rows()*10;
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
                                    FROM `r_mdl1_item` IT
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                    JOIN `r_mdl1_indi` I ON I.`id`=SI.`indiid`
                                    JOIN `r_mdl1_krtria` K ON K.`id`=I.`krtriaid`
                                    WHERE K.`aspekid`=".$idaspek."
                                    GROUP BY K.`aspekid`
                            ) A
                            LEFT JOIN(
                                    SELECT K.`aspekid`,COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    JOIN `r_mdl1_krtria` K ON K.`id`=MI.`krtriaid`
                                    WHERE W.`id`=".$idmap." AND K.`aspekid`=".$idaspek."
                                    GROUP BY K.`aspekid`
                            )LPR ON LPR.aspekid=A.aspekid";
                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    
                    $isdisplay_simpul = 'N';
                    if($list_data->num_rows()>0){
                        if($list_data->row()->jml == $list_data->row()->jml_lpr){
                            
                            $isdisplay_simpul = 'Y';
                            
                            //tandai bahwa provinsi sudah harus isi form resume
                            
                            //check data simpul
                            $sql = "SELECT A.`id`,A.`ksmplan`,A.`saran`
                                    FROM `t_mdl1_resume_prov` A
                                    WHERE A.`aspekid`=? AND A.`mapid`=?";
                            $bind = array($idaspek,$idmap);
                            $list_data = $this->db->query($sql,$bind);
                            if(!$list_data){
                                $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                                log_message("error", $msg);
                                throw new Exception("Invalid SQL!");
                            }
                            if($list_data->num_rows()==0){
                                $this->m_ref->setTableName("t_mdl1_resume_prov");
                                $data_baru = array(
                                    "mapid"     => $idmap,
                                    "aspekid"  => $idaspek,
                                    "stts"      => 'N',
                                    "cr_by"     => $session->id,
                                  );
                                $status_save = $this->m_ref->save($data_baru);
                                if(!$status_save){$this->db->trans_rollback();throw new Exception("SQL Error ".$this->db->error()["code"]." : Gagal menyimpan skor!",0);}
                            }
                            
                            //get kesimpulan dan saran
                            $sql = "SELECT A.`id`,A.`ksmplan`,A.`saran`
                                    FROM `t_mdl1_resume_prov` A
                                    WHERE A.`aspekid`=? AND A.`mapid`=?";
                            $bind = array($idaspek,$idmap);
                            $list_data = $this->db->query($sql,$bind);
                            if(!$list_data){
                                $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                                log_message("error", $msg);
                                throw new Exception("Invalid SQL!");
                            }
                            
                            $val_ksmpln  = "";
                            $val_saran   = "";
                            if($list_data->num_rows()>0){
                                $val_ksmpln = $list_data->row()->ksmplan;
                                $val_saran = $list_data->row()->saran;
                            }
                            
                        }
                    }
                    else{
                        $this->db->trans_rollback();
                        throw new Exception("Data Master Item tidak ditemukan");
                    }
                    /*
                     * ++++++++++++++++++++++++++++++++++++++
                     * Check semua item sudah dinilai - END
                     * ++++++++++++++++++++++++++++++++++++++
                     */
                    
                    
                    
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
                 */
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    
                    /*
                     * check map wilayah - START
                     */
                    $sql = "SELECT * FROM tbl_user_kabkot WHERE id=?";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() ==0)
                        throw new Exception("Data Map tidak ditemukan!",0);
                    /*
                     * check map wilayah - END
                     */
                    /*
                     * check kategori penilaian item - START
                     */
                    $sql = "SELECT MII.id,MII.skor,MII.itemid,MSI.indiid,I.`krtriaid`,K.`nama` nmkriteria,ASP.id aspekid,ASP.nama nmaspek "
                            . " FROM r_mdl1_item_indi MII "
                            . " JOIN `r_mdl1_item` MI ON MI.`id`=MII.`itemid`
                                JOIN `r_mdl1_sub_indi` MSI ON MSI.`id`=MI.`subindiid` AND MSI.isprov='N'
                                JOIN `r_mdl1_indi` I ON I.`id`=MSI.`indiid` 
                                JOIN `r_mdl1_krtria` K ON K.`id`=I.`krtriaid`
                                JOIN r_mdl1_aspek ASP ON ASP.id=K.aspekid "
                            . " WHERE MII.id=?";
                    $bind = array($iditemindi);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() ==0)
                        throw new Exception("Data Kategori Penilaian Item tidak ditemukan!",0);
                    
                    $iditem     = $list_data->row()->itemid; //ID item
                    $idindi     = $list_data->row()->indiid; // ID indikator
                    $idkriteria = $list_data->row()->krtriaid; // ID Kriteria
                    $nmkriteria = $list_data->row()->nmkriteria; // Nama Kriteria
                    $idaspek    = $list_data->row()->aspekid; // ID Aspek
                    $nmaspek    = $list_data->row()->nmaspek; // Nama Aspek
                    /*
                     * check kategori penilaian item - END
                     */
                    
                    /*
                     * +++++++++++++++++++++++++
                     * catat penilaian - START
                     * +++++++++++++++++++++++++
                     */
                    
                    //1.pastikan skor item per wilayah 
                    $sql = "DELETE A
                            FROM `t_mdl1_skor_kabkota` A
                            JOIN `r_mdl1_item_indi` B ON B.`id`=A.`itemindi`
                            WHERE A.`mapid`=? AND B.`itemid`=?";
                    $bind = array($idmap,$iditem);
                    $stts = $this->db->query($sql,$bind);
                    if(!$stts){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("SQL Error : Gagal Mencatat Penilaian!");
                    }
                    //2.simpan data
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("t_mdl1_skor_kabkota");
                    $data_baru = array(
                        "mapid"     => $idmap,
                        "itemindi"  => $iditemindi,
                        "cr_by"     => $session->id,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){$this->db->trans_rollback();throw new Exception("SQL Error ".$this->db->error("code")." : Gagal menyimpan skor!",0);}
                    
                    
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
                    $sql = "SELECT MI.`id` idindi,SUM(II.`skor`) skor
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.id=".$idindi."
                                    WHERE W.`id`=".$idmap." "
                            . " GROUP BY MI.`id`";
                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $ttl_skor = 0;
                    if($list_data->num_rows() > 0)
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
                            FROM `r_mdl1_item` IT
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                            WHERE SI.`indiid`=".$idindi." ";
                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $nilai = $ttl_skor/$list_data->num_rows()*10;
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
                                    FROM `r_mdl1_item` IT
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` I ON I.`id`=SI.`indiid`
                                    JOIN `r_mdl1_krtria` K ON K.`id`=I.`krtriaid`
                                    WHERE K.`aspekid`=".$idaspek."
                                    GROUP BY K.`aspekid`
                            ) A
                            LEFT JOIN(
                                    SELECT K.`aspekid`,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov='N'
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    JOIN `r_mdl1_krtria` K ON K.`id`=MI.`krtriaid`
                                    WHERE W.`id`=".$idmap." AND K.`aspekid`=".$idaspek."
                                    GROUP BY K.`aspekid`
                            )LPR ON LPR.aspekid=A.aspekid";
                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    
                    $isdisplay_simpul = 'N';
                    if($list_data->num_rows()>0){
                        if($list_data->row()->jml == $list_data->row()->jml_lpr){
                            
                            $isdisplay_simpul = 'Y';
                            
                            //tandai bahwa provinsi sudah harus isi form resume
                            
                            //check data simpul
                            $sql = "SELECT A.`id`,A.`ksmplan`,A.`saran`
                                    FROM `t_mdl1_resume_kabkota` A
                                    WHERE A.`aspekid`=? AND A.`mapid`=?";
                            $bind = array($idaspek,$idmap);
                            $list_data = $this->db->query($sql,$bind);
                            if(!$list_data){
                                $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                                log_message("error", $msg);
                                throw new Exception("Invalid SQL!");
                            }
                            if($list_data->num_rows()==0){
                                $this->m_ref->setTableName("t_mdl1_resume_kabkota");
                                $data_baru = array(
                                    "mapid"     => $idmap,
                                    "aspekid"   => $idaspek,
                                    "stts"      => 'N',
                                    "cr_by"     => $session->id,
                                  );
                                $status_save = $this->m_ref->save($data_baru);
                                if(!$status_save){$this->db->trans_rollback();throw new Exception("SQL Error ".$this->db->error()["code"]." : Gagal menyimpan skor!",0);}
                            }
                            
                            //get kesimpulan dan saran
                            $sql = "SELECT A.`id`,A.`ksmplan`,A.`saran`
                                    FROM `t_mdl1_resume_kabkota` A
                                    WHERE A.`aspekid`=? AND A.`mapid`=?";
                            $bind = array($idaspek,$idmap);
                            $list_data = $this->db->query($sql,$bind);
                            if(!$list_data){
                                $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                                log_message("error", $msg);
                                throw new Exception("Invalid SQL!");
                            }
                            
                            $val_ksmpln  = "";
                            $val_saran   = "";
                            if($list_data->num_rows()>0){
                                $val_ksmpln = $list_data->row()->ksmplan;
                                $val_saran = $list_data->row()->saran;
                            }
                            
                        }
                    }
                    else{
                        $this->db->trans_rollback();
                        throw new Exception("Data Master Item tidak ditemukan");
                    }
                    /*
                     * ++++++++++++++++++++++++++++++++++++++
                     * Check semua item sudah dinilai - END
                     * ++++++++++++++++++++++++++++++++++++++
                     */
                    
                    
                    
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
                $idcomb = $kate_wlyh."-".$idmap."-".$idaspek;
                $enc_idrsme= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
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
                    "ttl_skor"              => $ttl_skor,
                    "nilai"                 => number_format($nilai,1),
                    "is_display_simpul"     => $isdisplay_simpul,
                    "val_ksmpln"            => $val_ksmpln,
                    "val_saran"             => $val_saran,
                    "nmaspek"               => $nmaspek,
                    "idrsme"                => $enc_idrsme,
                );
                exit(json_encode($output));
            } catch (Exception $exc)  {
                log_message("error", $exc->getLine());
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage(),
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    
    
    //save resume Aspek
    function resume_save()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('id','ID data','required|xss_clean');
                $this->form_validation->set_rules('simpul','Catatan','required|xss_clean');
                $this->form_validation->set_rules('saran','Masukan & Saran','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $session=$this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=3)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $idaspek    = $tmp[2];
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if(!is_numeric($idaspek))
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
                if($kate_wlyh=="PROV"){
                    //cek data 
                    $this->m_ref->setTableName("t_mdl1_resume_prov");
                    $select = array();
                    $cond = array(
                        "mapid"  => $idmap,
                        "aspekid" => $idaspek,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error",$msg);
                        throw new Exception("Invalid SQL");
                    }
                    if($list_data->num_rows() > 0){
                        $this->m_ref->setTableName("t_mdl1_resume_prov");
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
                        $status_save = $this->m_ref->update($cond,$data_baru);
                        if(!$status_save){
                            $this->db->trans_rollback();
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error",$msg);
                            throw new Exception($this->db->error()["code"]." : Failed save data",0);
                        }
                    }
                    else{
                        $this->m_ref->setTableName("t_mdl1_resume_prov");
                        $data_baru = array(
                            "mapid"     => $idmap,
                            "aspekid"  => $idaspek,
                            "ksmplan"   => $inp_simpul,
                            "saran"     => $inp_saran,
                            "stts"      => 'Y',
                            "cr_by"     => $session->userid,
                          );
                        $status_save = $this->m_ref->save($data_baru);
                        if(!$status_save){
                            $this->db->trans_rollback();
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error",$msg);
                            throw new Exception($this->db->error("code")." : Failed save data",0);
                        }
                        

                    }
                }
                
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    //cek data 
                    $this->m_ref->setTableName("t_mdl1_resume_kabkota");
                    $select = array();
                    $cond = array(
                        "mapid"  => $idmap,
                        "aspekid" => $idaspek,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error",$msg);
                        throw new Exception("Invalid SQL");
                    }
                    if($list_data->num_rows() > 0){
                        $this->m_ref->setTableName("t_mdl1_resume_kabkota");
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
                        $status_save = $this->m_ref->update($cond,$data_baru);
                        if(!$status_save){
                            $this->db->trans_rollback();
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error",$msg);
                            throw new Exception($this->db->error()["code"]." : Failed save data",0);
                        }
                    }
                    else{
                        $this->m_ref->setTableName("t_mdl1_resume_kabkota");
                        $data_baru = array(
                            "mapid"     => $idmap,
                            "aspekid"   => $idaspek,
                            "ksmplan"   => $inp_simpul,
                            "saran"     => $inp_saran,
                            "stts"      => 'Y',
                            "cr_by"     => $session->userid,
                          );
                        $status_save = $this->m_ref->save($data_baru);
                        if(!$status_save){
                            $this->db->trans_rollback();
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error",$msg);
                            throw new Exception($this->db->error("code")." : Failed save data",0);
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
        }
        else{exit("Access Denied");}
    } 
  

    /*
     * get detail data resume aspek
     * author :  
     * date : 23 des 2020
     */
    function g_det_resume(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=3)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $idaspek    = $tmp[2];
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                if(!is_numeric($idaspek))
                    throw new Exception("Invalid ID Aspek");
               
                 /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY Nama Aspek
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                $this->m_ref->setTableName("r_mdl1_aspek");
                $select_a = array("id","nama");
                $cond_a = array(
                        "id"     => $idaspek,
                );
                $list_data_a = $this->m_ref->get_by_condition($select_a,$cond_a);
                if(!$list_data_a){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                }
                if($list_data_a->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($kate_wlyh=='PROV'){
                    $this->m_ref->setTableName("t_mdl1_resume_prov");
                    $select = array("ksmplan","saran");
                    $cond = array(
                        "mapid"     => $idmap,
                        "aspekid"   => $idaspek,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
                }
                elseif($kate_wlyh=='KAB' || $kate_wlyh=='KOTA'){
                    $this->m_ref->setTableName("t_mdl1_resume_kabkota");
                    $select = array("ksmplan","saran");
                    $cond = array(
                        "mapid"     => $idmap,
                        "aspekid"   => $idaspek,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
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
        }
        else{exit("Access Denied");}
    }
    
    /*
     * get detail data lembar pernyataan
     * author :  
     * date : 1 jan 2021
     */
    function g_det_sttmnt(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($kate_wlyh=="PROV"){
                    $this->m_ref->setTableName("t_mdl1_sttment_prov");
                    $select = array("attachments");
                    $cond = array(
                        "mapid"     => $idmap,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $val_link = NULL;
                    if($list_data->num_rows() > 0){
                        $val_link= base_url("attachments/kertaskerja/".$list_data->row()->attachments);
                    }

                }
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    $this->m_ref->setTableName("t_mdl1_sttment_kabkota");
                    $select = array("attachments");
                    $cond = array(
                        "mapid"     => $idmap,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $val_link = NULL;
                    if($list_data->num_rows() > 0){
                        $val_link= base_url("attachments/kertaskerja/".$list_data->row()->attachments);
                    }

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
                    "link"               =>  $val_link,
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
        }
        else{exit("Access Denied");}
    }
    
       
    /*
     * save Lembar Pernyataan
     * author :  
     * date : 1 Jan 2021
     */
    function sttmnt_save()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('id','ID data','required|xss_clean');
                

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $session=$this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                
                //UPLOAD documents
                $config['upload_path']      = './attachments/kertaskerja/';
                $config['allowed_types']    = "pdf|xls|xlsx";
                $config['max_size']         = '10000'; //10 Mb
                $config['encrypt_name']     = TRUE;
                $this->load->library('upload');
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("dokumen")){
                    throw new Exception($this->upload->display_errors("",""),0);
                }
                //uploaded data
                $upload_file = $this->upload->data();
                $filename= $upload_file['file_name'];
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $this->db->trans_begin();

                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($kate_wlyh=="PROV"){
                    //cek data 
                    $this->m_ref->setTableName("t_mdl1_sttment_prov");
                    $select = array();
                    $cond = array(
                        "mapid"  => $idmap,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error",$msg);
                        throw new Exception("Invalid SQL");
                    }
                    if($list_data->num_rows() > 0){
                        $this->m_ref->setTableName("t_mdl1_sttment_prov");
                        $data_baru = array(
                            "attachments"   => $filename,
                            "up_dt"     => $current_date_time,
                            "up_by"     => $session->userid,
                        );
                        $cond = array(
                            "mapid"  => $idmap,
                        );
                        $status_save = $this->m_ref->update($cond,$data_baru);
                        if(!$status_save){
                            $this->db->trans_rollback();
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error",$msg);
                            throw new Exception($this->db->error()["code"]." : Failed save data",0);
                        }
                    }
                    else{
                        $this->m_ref->setTableName("t_mdl1_sttment_prov");
                        $data_baru = array(
                            "mapid"     => $idmap,
                            "attachments"   => $filename,
                            "cr_by"     => $session->userid,
                          );
                        $status_save = $this->m_ref->save($data_baru);
                        if(!$status_save){
                            $this->db->trans_rollback();
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error",$msg);
                            throw new Exception($this->db->error()["code"]." : Failed save data",0);
                        }
                    }
                }
                
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    //cek data 
                    $this->m_ref->setTableName("t_mdl1_sttment_kabkota");
                    $select = array();
                    $cond = array(
                        "mapid"  => $idmap,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error",$msg);
                        throw new Exception("Invalid SQL");
                    }
                    if($list_data->num_rows() > 0){
                        $this->m_ref->setTableName("t_mdl1_sttment_kabkota");
                        $data_baru = array(
                            "attachments"   => $filename,
                            "up_dt"     => $current_date_time,
                            "up_by"     => $session->userid,
                        );
                        $cond = array(
                            "mapid"  => $idmap,
                        );
                        $status_save = $this->m_ref->update($cond,$data_baru);
                        if(!$status_save){
                            $this->db->trans_rollback();
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error",$msg);
                            throw new Exception($this->db->error()["code"]." : Failed save data",0);
                        }
                    }
                    else{
                        $this->m_ref->setTableName("t_mdl1_sttment_kabkota");
                        $data_baru = array(
                            "mapid"     => $idmap,
                            "attachments"   => $filename,
                            "cr_by"     => $session->userid,
                          );
                        $status_save = $this->m_ref->save($data_baru);
                        if(!$status_save){
                            $this->db->trans_rollback();
                            $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                            log_message("error",$msg);
                            throw new Exception($this->db->error()["code"]." : Failed save data",0);
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
        }
        else{exit("Access Denied");}
    } 
  
}
