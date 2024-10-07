<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD4_M_Penilaian_Prov_Daerah extends CI_Controller
{
    var $view_dir   = "ppd4/PPD4_hasil_penilaian/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/Penilaian/dokumen.js";
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
                $this->js_path    = "assets/js/ppd4/PPD4_hasil_penilaian/hasil_penilaian_prov.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_penilaian", $data_page, TRUE);

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


                $satker = $this->session->userdata(SESSION_LOGIN)->satker;

                // $sql = "SELECT D.`id` mapid, D.judul, D.filename, D.cr_dt,D.cr_by
                //             FROM `t_doc_penilaian_kk` D
                //             JOIN `provinsi` P ON P.`id`=D.provid
                //             WHERE D.provid =?  AND D.isactive = 'Y' ";

                $sql = "SELECT * FROM (
                            SELECT '1' kate, J.id, J.nama nmdok, J.jndok, J.formatdata, DOK.judul, DOK.mapid, DOK.nama_provinsi, DOK.filename, DOK.cr_dt, DOK.cr_by
                            FROM `tbl_jenis_doc_penilaian_kk` J
                            LEFT JOIN(
                                SELECT D.id mapid, D.jenisid, D.judul, D.filename, D.cr_by, D.cr_dt, D.provid, P.nama_provinsi
                                FROM `t_doc_penilaian_kk` D  
                                JOIN `provinsi` P ON D.provid = P.id
                                WHERE D.provid =? AND D.isactive = 'Y') DOK ON DOK.jenisid = J.id
                            WHERE J.tahap='I' AND J.id !='6') AS a
                            UNION
                            SELECT * FROM (
                                SELECT '2' kate, J.id, J.jndok,  D.judul nmdok, J.formatdata, D.judul, D.id mapid, P.nama_provinsi, D.filename, D.cr_dt, D.cr_by
                                FROM `t_doc_penilaian_kk` D 
                                JOIN `provinsi` P ON D.provid = P.id
                            JOIN `tbl_jenis_doc_penilaian_kk` J ON D.jenisid = J.`id`
                                WHERE D.provid =? AND D.isactive = 'Y' AND D.`jenisid`='6' ORDER BY D.id ASC) AS b
                        ORDER BY id, mapid ASC";

                $bind = array($satker, $satker);
                $list_data = $this->db->query($sql, $bind);

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                $lnk = 'https';
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";

                $no = 1;
                foreach ($list_data->result() as $v) {
                    $val_link = base_url("attachments/penilaian/" . $v->filename);

                    $idcomb = $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='btnDel' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->judul . "'";

                    $idcomb1 = "kot_" . $v->mapid;
                    $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                    $tmped = "class='btnEdi' data-id='" . $encrypted_id1 . "'";
                    $tmped .= " data-nama='" . $v->judul . "'";
                    $tmped .= " data-file='" . $v->filename . "'";

                    $idcomb1 = "kot_" . $v->mapid;
                    $encrypted_id2 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                    $tmpup = "class='btnUp btn btn-xs btn-outline-primary' data-id='" . $encrypted_id2 . "'";
                    $tmpup .= " data-iddok='" . $v->id . "'";
                    $tmpup .= " data-nama='" . $v->jndok . "'";

                    //                    if(substr($v->filename, -3) == 'rar'){
                    //                        $rename = $v->judul.".rar";
                    //                    }else{
                    //                        $rename = $v->judul;
                    //                    }
                    //                    if(substr($v->filename,0, 5)=='https'){
                    //                        $link=$v->filename;
                    //                    }
                    //                    else {
                    //                        $tautan= substr($v->filename, 4);
                    //                        $link = $lnk.$tautan;
                    //                    }


                    if (substr($v->filename, -3) == 'rar') {
                        $rename = $v->judul . ".rar";
                    } elseif (substr($v->filename, -3) == 'zip') {
                        $rename = $v->judul . ".zip";
                    } elseif (substr($v->filename, -3) == 'pdf') {
                        $rename = $v->judul . ".pdf";
                    } elseif (substr($v->filename, -3) == 'doc') {
                        $rename = $v->judul . ".doc";
                    } elseif (substr($v->filename, -4) == 'docx') {
                        $rename = $v->judul . ".docx";
                    } elseif (substr($v->filename, -4) == 'xlsx') {
                        $rename = $v->judul . ".xlsx";
                    } elseif (substr($v->filename, -3) == 'xls') {
                        $rename = $v->judul . ".xls";
                    } elseif (substr($v->filename, -3) == 'png') {
                        $rename = $v->judul . ".png";
                    } elseif (substr($v->filename, -3) == 'jpg') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->filename, -4) == 'jpeg') {
                        $rename = $v->judul . ".jpeg";
                    } elseif (substr($v->filename, -4) == 'pptx') {
                        $rename = $v->judul . ".pptx";
                    } else {
                        $rename = $v->judul;
                    }
                    $str .= "<tr class='' title='Dokumen'>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                    $str .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->jndok . "<sup> (<font style='color: #2c03fc'>Max 100 MB</font>, " . $v->formatdata . " ) <span class='text-danger'>*</span></sup></td>";
                    if ($v->filename != null) {
                        if ($v->kate != 1) {
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->cr_by . "</td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->cr_dt . "</td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='$val_link' download='$rename' target='_blank' class='text-primary btn btn-sm ' title='Unduh Data'><i class='fas fa-download'></i></a></td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmped . " class='text-warning btn btn-sm ' title='Edit Data'><i class='text-warning fas fa-pencil-alt'></i></a></td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmp . " class='text-danger btn btn-sm ' title='Hapus Data'><i class='text-danger fas fa-trash-alt '></i></a></td>";
                        } else {
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->cr_by . "</td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->cr_dt . "</td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='$val_link' download='$rename' target='_blank' class='text-primary btn btn-sm ' title='Unduh Data'><i class='fas fa-download'></i></a></td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmped . " class='text-warning btn btn-sm ' title='Edit Data'><i class='text-warning fas fa-pencil-alt'></i></a></td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'></td>";
                        }
                    } else {
                        $str .= "<td colspan='5' class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmpup . " title='Unggah Dokumen'>Unggah Dokumen <i class='fas fa-upload' style='margin-left: 5px;'></i></a></td>";
                    }
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
     * delete data dokumen Provinsi
     * author : FSM
     * date : 17 des 2020
     */
    function delete_dok()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                $this->form_validation->set_rules('id', 'ID Data', 'required|xss_clean');
                if ($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""), 0);
                $id = decrypt_base64($this->input->post("id"));
                if (!is_numeric($id))
                    throw new Exception("Invalid ID");
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //check data
                $sql = "SELECT id,provid, judul FROM t_doc_penilaian_kk WHERE id=" . $id;

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if ($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $nm = $list_data->row()->judul;
                $this->db->trans_begin();
                $sql = "UPDATE t_doc_penilaian_kk SET isactive = 'N' AND up_dt='" . $this->session->userdata(SESSION_LOGIN)->userid . "' AND up_by='" . $current_date_time . "' WHERE id=" . $id;

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    if ($this->db->error()["code"] == 1451)
                        throw new Exception($this->db->error()["code"] . ":Data tidak dapat dihapus karena terkait dengan data yang lain");
                    else
                        throw new Exception($this->db->error()["code"] . ":Failed delete data");
                }

                //sukses
                $this->db->trans_commit();
                $output = array(
                    "status"    =>  1,
                    "msg"       =>  "Data " . $nm . " berhasil dihapus",
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
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
     * insert data Prov
     * author : FSM 
     * date : 17 des 2020
     */
    function save_dok_prov_d()
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

                //$this->form_validation->set_rules('id','ID Provinsi','required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $satker = $this->session->userdata(SESSION_LOGIN)->satker;
                $inp_nm     = $this->input->post("nama");

                //upload file dokumen
                $inp_urldoc = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/penilaian/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|ZIP|RAR|rar";
                    // $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi";
                    $config['max_size']    = '300000000'; //30 Mb
                    $config['encrypt_name']    = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")) {
                        throw new Exception($this->upload->display_errors("", ""), 0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $inp_urldoc = $upload_file['file_name'];
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, judul nm FROM t_doc_penilaian_kk WHERE provid=? AND judul=? AND isactive = 'Y'";
                $bind = array($satker, $inp_nm);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if ($list_data->num_rows() > 0) {
                    throw new Exception("Duplikasi Nama Dokumen!");
                }
                // add record
                $this->m_ref->setTableName("t_doc_penilaian_kk");
                $data_baru = array(
                    "provid"     => $satker,
                    "jenisid"    => '6',
                    "judul"      => $inp_nm,
                    "filename"   => $inp_urldoc,
                    "isactive"   => 'Y',
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"      => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
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
     * insert data Prov
     * author : FSM 
     * date : 17 des 2020
     */
    function save_dok_prov_d_up()
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

                //$this->form_validation->set_rules('id','ID Provinsi','required|xss_clean');
                $this->form_validation->set_rules('iddok', 'ID Dokumen', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $satker = $this->session->userdata(SESSION_LOGIN)->satker;
                $inp_iddok     = $this->input->post("iddok");
                $inp_nm     = $this->input->post("nama");

                //upload file dokumen
                $inp_urldoc = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/penilaian/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip";
                    // $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi";
                    $config['max_size']    = '300000'; //30 Mb
                    $config['encrypt_name']    = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")) {
                        throw new Exception($this->upload->display_errors("", ""), 0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $inp_urldoc = $upload_file['file_name'];
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, judul nm FROM t_doc_penilaian_kk WHERE provid=? AND judul=? AND isactive = 'Y'";
                $bind = array($satker, $inp_nm);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if ($list_data->num_rows() > 0) {
                    throw new Exception("Duplikasi Nama Dokumen!");
                }
                // add record
                $this->m_ref->setTableName("t_doc_penilaian_kk");
                $data_baru = array(
                    "provid"     => $satker,
                    "jenisid"    => $inp_iddok,
                    "judul"      => $inp_nm,
                    "filename"   => $inp_urldoc,
                    "isactive"   => 'Y',
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"      => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
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
     * update data Prov
     * author : FSM 
     * date : 02 Jan 2020
     */
    function update_dok()
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
                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];

                $inp_nm     = $this->input->post("nama");

                //cek data
                $sql = "SELECT id, judul nm FROM t_doc_penilaian_kk WHERE id=? ";
                $bind = array($idmap);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if ($list_data->num_rows() == 0) {
                    throw new Exception("Data Tidak Ada!");
                }


                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                $fileupload = file_exists($_FILES['filedok']['tmp_name']);

                if ($fileupload != '') {
                    //upload file dokumen
                    $inp_urldoc = "";
                    if (file_exists($_FILES['filedok']['tmp_name']) && is_uploaded_file($_FILES['filedok']['tmp_name'])) {
                        //UPLOAD documents
                        $config['upload_path'] = './attachments/penilaian/';
                        $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip";
                        // $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi";
                        $config['max_size']    = '300000'; //30 Mb
                        $config['encrypt_name']    = TRUE;
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload("filedok")) {
                            throw new Exception($this->upload->display_errors("", ""), 0);
                        }
                        //uploaded data
                        $upload_file = $this->upload->data();
                        $inp_urldoc = $upload_file['file_name'];
                    }

                    //update
                    $this->m_ref->setTableName("t_doc_penilaian_kk");
                    $data_uodate = array(
                        "judul"      => $inp_nm,
                        "filename"   => $inp_urldoc,
                        "up_dt"      => $current_date_time,
                        "up_by"      =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $idmap,
                    );
                    $status_save = $this->m_ref->update($cond, $data_uodate);
                    if (!$status_save) {
                        throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                    }
                } else {

                    //update
                    $this->m_ref->setTableName("t_doc_penilaian_kk");
                    $data_uodate = array(
                        "judul"      => $inp_nm,
                        "up_dt"      => $current_date_time,
                        "up_by"      =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $idmap,
                    );
                    $status_save = $this->m_ref->update($cond, $data_uodate);
                    if (!$status_save) {
                        throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                    }
                }

                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Data berhasil Di update"
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
}
