<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD3_t2_dokumen_daerah extends CI_Controller
{
    var $view_dir   = "ppd3/PPD3_bahan_dukung/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD3_bahan_dukung/PPD3_bahan_dukung.js";
    var $allowed    = array("PPD3");
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
                $this->js_path    = "assets/js/ppd3/PPD3_bahan_dukung/dokumen_daerah_t2.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_th2", $data_page, TRUE);

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
     * list data wilayah provinsi dan atau Kabupaten/kota
     * author : fsm 
     * date : 23 des 2020
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
                $usergroupid = $session->group;
                $str = "";
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY PROVINSI - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if ($inp_katewlyh == "PROV") {

                    $sql = "SELECT A.`id` mapid,P.id idprov, P.`id_kode` kode, P.`nama_provinsi` nmprov,P.`label`, IFNULL(JML.jml,0) jml_dok
                            FROM tbl_user_t2_prov A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN (
					SELECT A.`id`,A.provid, COUNT(1) jml  
					    FROM `t_doc_prov` A
					    JOIN `t_doc_prov_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
					    JOIN `t_doc_tahap_prov` C ON C.`docid`=A.`id` AND C.`tahap`=2
					    WHERE A.`isactive`='Y'
					    GROUP BY A.`id`
                            ) JML ON JML.provid = P.`id`
                            WHERE A.`iduser`=?
                            GROUP BY P.`id_kode`";
                    $bind = array($usergroupid, $session->id);
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
                            //TAUTAN DOC
                            $idcomb_prov = $inp_katewlyh . '-' . $v->idprov;
                            $encrypted_provid = base64_encode(openssl_encrypt($idcomb_prov, "AES-128-ECB", ENCRYPT_PASS));
                            $tmp_prov = "class='btn btn-sm btn-primary waves-effect waves-light getDoc' data-id='" . $encrypted_provid . "'";
                            $tmp_prov .= " data-nmwlyh='" . $v->nmprov . "'";


                            $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                            $str .= "<div style='display: flex; align-items: center;'>";
                            $str .= "<img src='" . base_url() . "/assets/icons/PNG_Provinsi/" . $v->kode . "_" . $v->nmprov . ".png' alt='" . $v->nmprov . "' title='" . $v->nmprov . "' width='100' height='100' style='padding: 15px;'>";
                            $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                            $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                            $str .= "<h4 style='margin-bottom: 3px;'>" . $v->nmprov . "</h4>";
                            $str .= "</div>";
                            $str .= "<div class='mt-0'>";
                            $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.8rem;'><strong>" . $v->jml_dok . "</strong> Dokumen </p>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div class='btn-wilayah' style='float: right; margin-right: 3%;'>";
                            $str .= "<a href='javascript:void(0)' " . $tmp_prov . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'>Unduh Dokumen Daerah <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
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
                    //                    $sql = "SELECT A.`id` mapid,P.id idkab, P.`id_kab` kode, P.`nama_kabupaten` nmkab
                    //                            FROM tbl_user_t2_kabkot A
                    //                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                    //                           
                    //                            WHERE A.`iduser`=?";
                    $sql = "SELECT A.`id` mapid,P.id idkab, P.`id_kab` kode, P.`nama_kabupaten` nmkab, IFNULL(JML.jml,0) jml_dok
                            FROM tbl_user_t2_kabkot A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                           LEFT JOIN (
                                SELECT A.`id`,A.`kabid`, COUNT(1) jml  
                                FROM `t_doc_kab` A
                                JOIN `t_doc_kab_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                                JOIN `t_doc_tahap_kab` C ON C.`docid`=A.`id` AND C.`tahap`=2
                                WHERE A.`isactive`='Y' 
                                GROUP BY A.`id`
                           )JML ON JML.kabid = P.`id`
                            WHERE A.`iduser`=? 
                            GROUP BY P.`id_kab`";
                    $bind = array($usergroupid, $session->id);
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
                            //TAUTAN DOC
                            $idcomb_kab = $inp_katewlyh . '-' . $v->idkab;
                            $encrypted_kabid = base64_encode(openssl_encrypt($idcomb_kab, "AES-128-ECB", ENCRYPT_PASS));
                            $tmp_kab = "class='btn btn-sm btn-primary waves-effect waves-light getDoc' data-id='" . $encrypted_kabid . "'";
                            $tmp_kab .= " data-nmwlyh='" . $v->nmkab . "'";

                            $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                            $str .= "<div style='display: flex; align-items: center;'>";
                            $str .= "<img src='" . base_url() . "/assets/icons/PNG_KabupatenKota/" . $v->kode . "_" . $v->nmkab . ".png' alt='" . $v->nmkab . "' title='" . $v->nmkab . "' width='100' height='100' style='padding: 15px;'>";
                            $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                            $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                            $str .= "<h4 style='margin-bottom: 3px;'>" . $v->nmkab . "</h4>";
                            $str .= "</div>";
                            $str .= "<div class='mt-0'>";
                            $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.8rem;'><strong>" . $v->jml_dok . "</strong> Dokumen </p>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div class='btn-wilayah' style='float: right; margin-right: 3%;'>";
                            $str .= "<a href='javascript:void(0)' " . $tmp_kab . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'>Unduh Dokumen Daerah <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "</div>";
                        }
                    }
                }


                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY KOTA - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */ elseif ($inp_katewlyh == 'KOTA') {
                    //                    $sql = "SELECT A.`id` mapid,P.id idkab, P.`id_kab` kode, P.`nama_kabupaten` nmkab
                    //                            FROM tbl_user_t2_kabkot A
                    //                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                    //                            WHERE A.`iduser`=?";
                    $sql = "SELECT A.`id` mapid,P.id idkab, P.`id_kab` kode, P.`nama_kabupaten` nmkab, IFNULL(JML.jml,0) jml_dok
                            FROM tbl_user_t2_kabkot A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                           LEFT JOIN (
                                SELECT A.`id`,A.`kabid`, COUNT(1) jml  
                                FROM `t_doc_kab` A
                                JOIN `t_doc_kab_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                                JOIN `t_doc_tahap_kab` C ON C.`docid`=A.`id` AND C.`tahap`=2
                                WHERE A.`isactive`='Y' 
                                GROUP BY A.`id`
                           )JML ON JML.kabid = P.`id`
                            WHERE A.`iduser`=? 
                            GROUP BY P.`id_kab`";
                    $bind = array($usergroupid, $session->id);
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

                            //TAUTAN DOC
                            $idcomb_kab = $inp_katewlyh . '-' . $v->idkab;
                            $encrypted_kabid = base64_encode(openssl_encrypt($idcomb_kab, "AES-128-ECB", ENCRYPT_PASS));
                            $tmp_kab = "class='btn btn-sm btn-primary waves-effect waves-light getDoc' data-id='" . $encrypted_kabid . "'";
                            $tmp_kab .= " data-nmwlyh='" . $v->nmkab . "'";


                            $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                            $str .= "<div style='display: flex; align-items: center;'>";
                            $str .= "<img src='" . base_url() . "/assets/icons/PNG_KabupatenKota/" . $v->kode . "_" . $v->nmkab . ".png' alt='" . $v->nmkab . "' title='" . $v->nmkab . "' width='100' height='100' style='padding: 15px;'>";
                            $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                            $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                            $str .= "<h4 style='margin-bottom: 3px;'>" . $v->nmkab . "</h4>";
                            $str .= "</div>";
                            $str .= "<div class='mt-0'>";
                            $str .= "<p style='margin-bottom: 0px; color: #98a6ad !important; font-size: 0.8rem;'><strong>" . $v->jml_dok . "</strong> Dokumen </p>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div class='btn-wilayah' style='float: right; margin-right: 3%;'>";
                            $str .= "<a href='javascript:void(0)' " . $tmp_kab . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'>Unduh Dokumen Daerah <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                            $str .= "</div>";
                            $str .= "</div>";
                            $str .= "</div>";
                        }
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
     * list data dokumen bahan dukung masing-masing wilayah
     * author : fsm
     * date : 23 jan 2021
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
                    $link = base_url() . "attachments/provinsi/";
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
                    $sql = "
                            SELECT A.`id`,A.`judul`,A.`tautan`, 'daerah' kate
                            FROM `t_doc_prov` A
                            JOIN `t_doc_prov_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                            JOIN `t_doc_tahap_prov` C ON C.`docid`=A.`id` AND C.`tahap`=2
                            WHERE A.`isactive`='Y' AND A.provid=?";
                    $bind = array($usergroupid, $idwlyh);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                    $link = base_url() . "attachments/kabkota/";
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
                    $sql = "
                            SELECT A.`id`,A.`judul`,A.`tautan`, 'umum' kate
                            FROM `t_doc_kab` A
                            JOIN `t_doc_kab_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                            JOIN `t_doc_tahap_kab` C ON C.`docid`=A.`id` AND C.`tahap`=2
                            WHERE A.`isactive`='Y' AND A.kabid=?";
                    $bind = array($usergroupid, $idwlyh);
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
                    //                    if(substr($v->tautan,0, 5)=='https'){ $link=$v->tautan; }
                    //                    else { $tautan= substr($v->tautan, 4); $link = $lnk.$tautan; }
                    $val_link = $link . $v->tautan;

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
                    } elseif (substr($v->tautan, -4) == 'xlsx') {
                        $rename = $v->judul . ".xlsx";
                    } elseif (substr($v->tautan, -3) == 'xls') {
                        $rename = $v->judul . ".xls";
                    } elseif (substr($v->tautan, -3) == 'jpg') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -3) == 'JPG') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -3) == 'png') {
                        $rename = $v->judul . ".png";
                    } elseif (substr($v->tautan, -3) == 'PNG') {
                        $rename = $v->judul . ".png";
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $rename = $v->judul . ".jpeg";
                    } elseif (substr($v->tautan, -4) == 'jfif') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $rename = $v->judul . ".pptx";
                    } else {
                        $rename = $v->judul;
                    }

                    /* $str.="<tr>";
                    $str.="<td class='text-right'>".$no++."</td>";
                    $str.="<td class=''><a href='".$link."' download='$rename' target='_blank' title='Klik untuk unduh dokumen' >".wordwrap($v->judul,50,"<br/>")."</a></td>";
                    $str.="<td class='text-center'><a class='btn btn-xs text-primary' target='_blank' title='Klik untuk unduh dokumen' href='".$link."' download='$rename' ><i class='fas fa-2x fa-download'></i></a></td>";
                    $str.="</tr>"; */

                    $str .= "<tr>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'>" . $no++ . "</td>";
                    $str .= "<td class='' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a href='" . $val_link . "' download='$rename' target='_blank' title='Klik untuk unduh dokumen' >" . $v->judul . "</a></td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit; border: 1px solid black'><a class='btn btn-xs text-primary' target='_blank' title='Klik untuk unduh dokumen' href='" . $val_link . "' download='$rename' ><i class='fas fa-lg fa-download'></i></a></td>";
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
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 0);
                }
                $group = $this->session->userdata(SESSION_LOGIN)->group;
                $link = base_url() . "attachments/bahandukung/";
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt "
                    . "FROM `t_doc` D  "
                    . "JOIN `t_doc_groupuser` G ON D.id = G.docid "
                    . "JOIN `tbl_user_group` U ON G.`groupid` = U.id "
                    . "WHERE U.id=? AND D.isactive = 'Y'";
                $bind = array($group);
                $list_data = $this->db->query($sql, $group);

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";

                $no = 1;
                foreach ($list_data->result() as $v) {
                    $idcomb = $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='btnVie' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->judul . "'";

                    $str .= "<tr class='bg-secondary' title='Dokumen'>";
                    $str .= "<td class='text-right'>" . $no++ . "</td>";
                    $str .= "<td  class='text'><a href='javascript:void(0)' " . $tmp . " title='View'>" . $v->judul . "</a></td>";
                    $str .= "<td  class='text'>" . $v->cr_by . "</td>";
                    $str .= "<td  class='text'>" . $v->cr_dt . "</td>";
                    $str .= "<td  class=''><a href='$v->tautan' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                    // $str.="<td  class=''><a href='javascript:void(0)' ".$tmp." class='text-danger btn btn-sm ' title='Hapus Data'><i class='text fas fa-trash-alt '></i></a></td>";
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
        if ($kate_wlyh == "PROV") {

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
            $filename = "bahan_daerah_II_" . $name . ".zip";
            /*
                     * check data PROV - end
                     */

            //get LIST tautan doc
            $sql = "
                            SELECT A.`id`,A.`judul`,A.`tautan`, 'daerah' kate
                            FROM `t_doc_prov` A
                            JOIN `t_doc_prov_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                            JOIN `t_doc_tahap_prov` C ON C.`docid`=A.`id` AND C.`tahap`=2
                            WHERE A.`isactive`='Y' AND A.provid=?";
            $bind = array($usergroupid, $idwlyh);
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
            $sql = "SELECT A.*
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
            foreach ($list_data->result() as $k) {
                $name = $k->nama_kabupaten;
            }
            $filename = "bahan_daerah_II_" . $name . ".zip";
            /*
                     * check data KAB / KOTA - end
                     */

            //get LIST tautan doc
            $sql = "
                            SELECT A.`id`,A.`judul`,A.`tautan`, 'umum' kate
                            FROM `t_doc_kab` A
                            JOIN `t_doc_kab_groupuser` B ON B.`docid`=A.`id` AND B.`groupid`=?
                            JOIN `t_doc_tahap_kab` C ON C.`docid`=A.`id` AND C.`tahap`=2
                            WHERE A.`isactive`='Y' AND A.kabid=?";
            $bind = array($usergroupid, $idwlyh);
            $list_data = $this->db->query($sql, $bind);
            if (!$list_data) {
                $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                log_message("error", $msg);
                throw new Exception("Invalid SQL!");
            }
        }
        if ($list_data->num_rows() == 0) {
            echo 'Bahan Dukung tidak ada';
            exit();
        }

        foreach ($list_data->result() as $v) {
            if ($kate_wlyh == "PROV") {
                //                if(substr($v->tautan,0, 5)=='https'){ 
                //                    $file       =substr($v->tautan,58, 500);
                //                    $filepath1 = FCPATH.'attachments/provinsi/'.$file;
                //                }
                //                else { $file       =substr($v->tautan,57, 500); 
                //                        $filepath1 = FCPATH.'attachments/provinsi/'.$file;
                //                }
                $filepath1 = FCPATH . 'attachments/provinsi/' . $v->tautan;
            } elseif ($kate_wlyh == "KAB" || $kate_wlyh == "KOTA") {
                //                if(substr($v->tautan,0, 5)=='https'){ 
                //                    $file       =substr($v->tautan,57, 500); 
                //                    $filepath1 = FCPATH.'attachments/kabkota/'.$file;
                //                }
                //                else { 
                //                    $file       =substr($v->tautan,56, 500); 
                //                    $filepath1 = FCPATH.'attachments/kabkota/'.$file;
                //                }
                $filepath1 = FCPATH . 'attachments/kabkota/' . $v->tautan;
            }

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
            } elseif (substr($v->tautan, -4) == 'xlsx') {
                $rename = $v->judul . ".xlsx";
            } elseif (substr($v->tautan, -3) == 'xls') {
                $rename = $v->judul . ".xls";
            } elseif (substr($v->tautan, -3) == 'jpg') {
                $rename = $v->judul . ".jpg";
            } elseif (substr($v->tautan, -3) == 'JPG') {
                $rename = $v->judul . ".jpg";
            } elseif (substr($v->tautan, -3) == 'png') {
                $rename = $v->judul . ".png";
            } elseif (substr($v->tautan, -3) == 'PNG') {
                $rename = $v->judul . ".png";
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
            $filepath = $v->tautan;
            $filedata[] = $filepath;
        }

        $this->zip->download($filename);
    }
}
