<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    var $view_dir   = "admin/home";
    var $js_init    = "home";
    var $js_path    = "assets/js/userdefined/home/home.js";
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {

        try {
            if (!$this->session->userdata(SESSION_LOGIN))
                throw new Exception("Session Expired", 2);

            date_default_timezone_set("Asia/Jakarta");
            $id = $this->session->userdata(SESSION_LOGIN)->id;
            $satker = $this->session->userdata(SESSION_LOGIN)->satker;


            $sql = "SELECT * FROM tbl_user WHERE id=?";
            $bind = array($id);
            $list_data = $this->db->query($sql, $bind);
            if (!$list_data)
                throw new Exception("SQL Error!");
            $activeflag = $list_data->row()->active_flag;
            $up_dt = $list_data->row()->up_dt;

            $up_dt = new DateTime($up_dt);
            if($list_data->row()->userid =='SekretariatPPD'){
                $up_dt = new DateTime();
            }
            $current_date = new DateTime();
            $interval = $current_date->diff($up_dt);
            $last_pass = '';
            if ($interval->days > 90) { // 90 hari
                $last_pass = 0; 
            } else {
                $last_pass = 1; 
            }

            $sidebar_view = "admin/template/sidebar/sidebar";

            $main_content = $this->view_dir . "/home_page";
            $satker_name = '';
            $satker_kbko = '';
            $home_properties = array();
            if (in_array($this->session->userdata(SESSION_LOGIN)->groupid, array("PPD4"))) {

                $sql = "SELECT * FROM provinsi WHERE id=?";
                $bind = array($satker);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data)
                    throw new Exception("SQL Error!");
                $satker_name = $list_data->row()->nama_provinsi;

                $home_properties = array(
                    "satker_name"   => $list_data->row()->nama_provinsi,
                );
            } elseif (in_array($this->session->userdata(SESSION_LOGIN)->groupid, array("PPD5"))) {
                //$satker = $this->session->userdata(SESSION_LOGIN)->satker;
                $sql = "SELECT K.*, P.`nama_provinsi` FROM `kabupaten` K JOIN `provinsi` P ON P.`id_kode`=K.`prov_id` WHERE K.`id`=?";
                $bind = array($satker);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data)
                    throw new Exception("SQL Error!");
                $satker_name = $list_data->row()->nama_provinsi;
                $satker_kbko = $list_data->row()->nama_kabupaten;

                $home_properties = array(
                    "satker_name"   => $satker_name,
                    "satker_kbko"      => $satker_kbko,
                );
            } else if(in_array($this->session->userdata(SESSION_LOGIN)->groupid, array("PPD7"))){
                $sql = "SELECT * FROM provinsi WHERE id=?";
                $bind = array($satker);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data)
                    throw new Exception("SQL Error!");
                $satker_name = $list_data->row()->nama_provinsi;

                $home_properties = array(
                    "satker_name"   => $list_data->row()->nama_provinsi,
                );
            }
            //MAIN CONTENT
            $main_content = $this->view_dir . "/home_page_" . $this->session->userdata(SESSION_LOGIN)->groupid;

            //SIDEBAR
            $sidebar_view = "admin/template/sidebar/sidebar_" . $this->session->userdata(SESSION_LOGIN)->groupid;
            $this->js_path = "assets/js/admin/home/home_" . $this->session->userdata(SESSION_LOGIN)->groupid . ".js";
            $this->js_init = "main.init();";
            $data_page = array(
                "tag_title"     =>  APP_TITLE,
                "main_content"    =>  $main_content,
                "sidebar"         =>  $sidebar_view,
                "profile"         =>  $this->session->userdata(SESSION_LOGIN)->name,
                "home_properties" =>  $home_properties,
                "satker_name"     => $satker_name,
                "group"           =>  $this->session->userdata(SESSION_LOGIN)->groupname,
                "notif"           => '0',
                "csrf"            =>  array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                ),
                "js_path"       =>  base_url($this->js_path),
                "js_init"       =>  $this->js_init,
            );
            if ($activeflag == 'Y' && $last_pass==1) {
                $this->load->view("admin/template/template", $data_page);
            } else {
                $this->load->view("admin/template/template_active_flag", $data_page);
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 2) {
                var_dump($exc->getCode());
                redirect("Welcome?err=session_expired");
            } else {
                show_error($exc->getMessage(), 500, "Error");
            }
        }
    }

    /*
     * get data detail alamat
     */
    public function detail_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);



                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");


                $address = "Direktorat PEPPD <br/>
                            Jalan Taman Sunda Kelapa No.9 Jakarta 10310,<br>
                            Telp. 021 3193 6207 <br/>
                            Fax 021 3145 374";
                $cond = array($this->session->userdata(SESSION_LOGIN)->id_group);
                $sql = "SELECT alamat FROM tbl_profile_kl WHERE iddept=?";
                $list_data = $this->db->query($sql, $cond);
                if ($list_data->num_rows() > 0)
                    $address = $list_data->row()->alamat;

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "address"       =>  $address,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data user tpt
     */
    public function all_tpt_user_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_tpt = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 2 AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')";
                $list_tpt = $this->db->query($sql_list_tpt)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_tpt),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data user tpt
     */
    public function active_tpt_user_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_active_tpt = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 2 AND last_access IS NOT NULL AND tbl_user.active_flag = 'Y' AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt')";
                $list_active_tpt = $this->db->query($sql_list_active_tpt)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_active_tpt),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data user tpitpu
     */
    public function all_tpitpu_user_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_tpitpu = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 3 AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi')";
                $list_tpitpu = $this->db->query($sql_list_tpitpu)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_tpitpu),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data user tpitpu
     */
    public function active_tpitpu_user_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_active_tpitpu = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 3 AND last_access IS NOT NULL AND tbl_user.active_flag = 'Y' AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi')";
                $list_active_tpitpu = $this->db->query($sql_list_active_tpitpu)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_active_tpitpu),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data user province
     */
    public function all_province_user_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_province = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 4 AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi', 'testprovinsi')";
                $list_province = $this->db->query($sql_list_province)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_province),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data user province
     */
    public function active_province_user_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_active_province = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 4 AND last_access IS NOT NULL AND tbl_user.active_flag = 'Y' AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi', 'testprovinsi')";
                $list_active_province = $this->db->query($sql_list_active_province)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_active_province),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data user citydistrict
     */
    public function all_citydistrict_user_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_citydistrict = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 5 AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi', 'testprovinsi', 'Testkabkota-pusat', 'admin')";
                $list_citydistrict = $this->db->query($sql_list_citydistrict)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_citydistrict),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data user citydistrict
     */
    public function active_citydistrict_user_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_active_citydistrict = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 5 AND last_access IS NOT NULL AND tbl_user.active_flag = 'Y' AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi', 'testprovinsi', 'Testkabkota-pusat', 'admin')";
                $list_active_citydistrict = $this->db->query($sql_list_active_citydistrict)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_active_citydistrict),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data all province document
     */
    public function all_province_document_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_all_province_document = "SELECT * FROM `t_doc_prov` WHERE isactive = 'Y'";
                $list_all_province_document = $this->db->query($sql_list_all_province_document)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_all_province_document),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data all citydistrict document
     */
    public function all_citydistrict_document_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_all_citydistrict_document = "SELECT * FROM `t_doc_kab` WHERE isactive = 'Y'";
                $list_all_citydistrict_document = $this->db->query($sql_list_all_citydistrict_document)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  count($list_all_citydistrict_document),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data progress tpt
     */
    public function progress_tpt()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_list_tpt = "SELECT U.id AS 'user_id', U.name AS 'name_user', U.group AS 'group' , COUNT(DISTINCT(W.idwilayah)) AS 'sum_assessed_area_prov', COUNT(DISTINCT(K.idkabkot)) AS 'sum_assessed_area_district', COUNT(DISTINCT(W.idwilayah)) + COUNT(DISTINCT(K.idkabkot)) AS 'sum_assessed_area', COUNT(DISTINCT(SP.mapid)) AS 'sum_finish_assessed_area', COUNT(DISTINCT(SK.mapid)) AS 'sum_finish_assessed_district', COUNT(DISTINCT(SP.mapid)) + COUNT(DISTINCT(SK.mapid)) AS 'sum_finish_assessed' 
                FROM tbl_user U 
                LEFT JOIN tbl_user_wilayah W ON U.id = W.iduser 
                LEFT JOIN tbl_user_kabkot K ON U.id = K.iduser 
                LEFT JOIN t_mdl1_sttment_prov SP ON W.id = SP.mapid 
                LEFT JOIN t_mdl1_sttment_kabkota SK ON K.id = SK.mapid 
                WHERE U.group = '2' AND U.active_flag = 'Y' 
                GROUP BY U.id
                ORDER BY sum_finish_assessed DESC";
                $list_tpt = $this->db->query($sql_list_tpt)->result();

                $str = '';
                foreach ($list_tpt as $tpt_v) {
                    $str .= '<div class="inbox-item" style="padding-right: 20px;">';
                    $str .= '<div class="inbox-item-img"><img src="' . base_url() . '/assets/images/users/avatar-1.jpg" class="rounded-circle" alt=""></div>';
                    $str .= '<p class="inbox-item-author">' . $tpt_v->name_user . '</p>';
                    $str .= '<div class="progress progress-sm m-0">';
                    $str .= '<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="' . $tpt_v->sum_finish_assessed . '" aria-valuemin="0" aria-valuemax="' . $tpt_v->sum_assessed_area . '" style="width:' . ($tpt_v->sum_assessed_area != 0 ? ($tpt_v->sum_finish_assessed / $tpt_v->sum_assessed_area) * 100 : 0) . '%;">';
                    $str .= '<span class="sr-only">' . $tpt_v->sum_finish_assessed . '/' . $tpt_v->sum_assessed_area . ' Modul Selesai</span>';
                    $str .= '</div>';
                    $str .= '</div>';
                    $str .= '<p style="font-size: 10px; padding-top: 3px; margin-bottom: 0px; text-align: right;">' . $tpt_v->sum_finish_assessed . '/' . $tpt_v->sum_assessed_area . ' Modul Selesai</p>';
                    $str .= '<div class="btn-group d-flex text-white mb-2 mt-2">';
                    $str .= '<a class="btn btn-primary waves-effect waves-light btn-xs" role="button">Pesan</a>';
                    $str .= '<a class="btn btn-info waves-effect waves-light btn-xs" role="button">Detail</a>';
                    $str .= '</div>';
                    $str .= '</div>';
                }


                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  $str,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data modul 1
     */
    public function sum_modul_1_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_modul_1 = "SELECT U.id AS 'user_id', U.name AS 'name_user', U.group AS 'group' , COUNT(DISTINCT(W.idwilayah)) + COUNT(DISTINCT(K.idkabkot)) AS 'sum_assessed_area'
                FROM tbl_user U 
                LEFT JOIN tbl_user_wilayah W ON U.id = W.iduser 
                LEFT JOIN tbl_user_kabkot K ON U.id = K.iduser
                WHERE U.group = '2' AND U.active_flag = 'Y'
                GROUP BY U.id";
                $modul_1 = $this->db->query($sql_modul_1)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  $modul_1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * get data finish modul 1
     */
    public function sum_finish_modul_1_get()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);

                // date_default_timezone_set("Asia/Jakarta");
                // $current_date_time = date("Y-m-d H:i:s");

                $sql_finish_modul_1 = "SELECT U.id AS 'user_id', U.name AS 'name_user', U.group AS 'group' , COUNT(DISTINCT(SP.mapid)) + COUNT(DISTINCT(SK.mapid)) AS 'sum_finish_assessed' 
                FROM tbl_user U  
                LEFT JOIN tbl_user_wilayah W ON U.id = W.iduser 
                LEFT JOIN tbl_user_kabkot K ON U.id = K.iduser
                LEFT JOIN t_mdl1_sttment_prov SP ON W.id = SP.mapid 
                LEFT JOIN t_mdl1_sttment_kabkota SK ON K.id = SK.mapid 
                WHERE U.group = '2' AND U.active_flag = 'Y' 
                GROUP BY U.id";
                $finish_modul_1 = $this->db->query($sql_finish_modul_1)->result();

                //sukses
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  $finish_modul_1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }
}
