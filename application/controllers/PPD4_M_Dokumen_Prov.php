<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD4_M_Dokumen_Prov extends CI_Controller
{
    var $view_dir   = "ppd4/PPD4_upload_dokumen/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd4/PPD4_upload_dokumen/dokumen.js";
    var $allowed    = array("PPD4");
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
                $this->js_path    = "assets/js/ppd4/PPD4_upload_dokumen/dokumen_prov.js?v=" . now("Asia/Jakarta");

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
    function g_upload_bahan()
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
                $userid = $this->session->userdata(SESSION_LOGIN)->userid;
                $satker = $this->session->userdata(SESSION_LOGIN)->satker;
                $group = $this->session->userdata(SESSION_LOGIN)->groupid;
                $sql = "SELECT P.* FROM `provinsi` P WHERE P.id=?";
                $bind = array($satker);
                $list_data = $this->db->query($sql, $bind);
                if ($list_data->num_rows() == 0)
                    throw new Exception("Data Provinsi tidak ditemukan!", 0);
                $nmprov     = $list_data->row()->nama_provinsi; //nama provinsi

                $link = base_url() . "attachments/provinsi/";

                $sql = "SELECT * FROM (
                         SELECT '1' kate ,J.id, J.nama nmdok,J.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_provinsi,DOK.tautan
                        FROM `tbl_jenis_doc` J
                        LEFT JOIN(
                                SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.provid, P.nama_provinsi
                                FROM `t_doc_prov` D 
                                JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `provinsi` P ON D.`provid` = P.id
                                WHERE D.provid =? AND U.groupid=? AND D.isactive = 'Y'
                        ) DOK ON  DOK.jenisid = J.id
                        WHERE J.tahap='I' AND J.id !='19' AND J.id != '20') AS a
                        UNION
			SELECT * FROM (
			SELECT  '2' kate ,D.jenisid id,J.nama nmdok,J.jndok,J.formatdata,D.judul, D.id mapid,P.nama_provinsi,D.tautan
                                FROM `t_doc_prov` D 
                                JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                                JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id
                                JOIN `provinsi` P ON D.`provid` = P.id
                                WHERE D.provid =? AND U.groupid=? AND D.isactive = 'Y' AND D.`jenisid`='19' ORDER BY D.id ASC) AS b 
                        ORDER BY id, mapid ASC
                        ";
                $bind = array($satker, $group, $satker, $group);
                $list_data = $this->db->query($sql, $bind);

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str_j = "";
                if ($list_data->num_rows() == 0)
                    $str_j = "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";

                $no = 1;
                foreach ($list_data->result() as $v) {
                    $val_link = base_url("attachments/provinsi/" . $v->tautan);

                    if ($v->nmdok == 'Dokumen_Inovasi') {
                        if ($v->mapid != null) {
                            $sql = "SELECT * FROM `t_doc_prov_inov` WHERE id_doc_prov = ?";
                            $bind = array($v->mapid);
                            $list_data_inov = $this->db->query($sql, $bind)->result();

                            $idcomb     = "PROV-" . $v->id . "-" . $v->nmdok;
                            $tmp = "data-id='$idcomb'   ";
                            $tmp .= " data-nmdok='" . $v->nmdok . "_" . $nmprov . "'";
                            $tmp .= " data-frmat='" . $v->formatdata . "'";
                            $tmp .= " data-idmap='" . $v->mapid . "'";
                            $tmp .= " data-link='" . $val_link . "'";
                            $tmp .= " data-kate='" . $v->kate . "'";
                            $tmp .= " data-jdl='" . $v->judul . "'";

                            if ($list_data_inov != null) {
                                $tmp .= " data-idinov='" . $list_data_inov[0]->id . "'";
                                $tmp .= " data-nminov='" . $list_data_inov[0]->nama_inovasi . "'";
                                $tmp .= " data-descinov='" . $list_data_inov[0]->deskripsi . "'";
                                $tmp .= " data-inpinov='" . $list_data_inov[0]->input . "'";
                                $tmp .= " data-proinov='" . $list_data_inov[0]->proses . "'";
                                $tmp .= " data-outinov='" . $list_data_inov[0]->output . "'";
                                $tmp .= " data-cominov='" . $list_data_inov[0]->outcome . "'";
                                $tmp .= " data-tag='" . $list_data_inov[0]->tag . "'";
                            }
                        } else {
                            $idcomb     = "PROV-" . $v->id . "-" . $v->nmdok;
                            $tmp = "data-id='$idcomb'   ";
                            $tmp .= " data-nmdok='" . $v->nmdok . "_" . $nmprov . "'";
                            $tmp .= " data-frmat='" . $v->formatdata . "'";
                            $tmp .= " data-idmap='" . $v->mapid . "'";
                            $tmp .= " data-link='" . $val_link . "'";
                            $tmp .= " data-kate='" . $v->kate . "'";
                            $tmp .= " data-jdl='" . $v->judul . "'";
                        }
                    } else {
                        $idcomb     = "PROV-" . $v->id . "-" . $v->nmdok;
                        $tmp = "data-id='$idcomb'   ";
                        $tmp .= " data-nmdok='" . $v->nmdok . "_" . $nmprov . "'";
                        $tmp .= " data-frmat='" . $v->formatdata . "'";
                        $tmp .= " data-idmap='" . $v->mapid . "'";
                        $tmp .= " data-link='" . $val_link . "'";
                        $tmp .= " data-kate='" . $v->kate . "'";
                        $tmp .= " data-jdl='" . $v->judul . "'";
                    }



                    //$namefile=$v->judul;
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
                    $str_j .= "<tr class='' title='Dokumen'>";
                    $str_j .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'>" . $no++ . "</td>";
                    if ($v->kate == '1') {
                        $str_j .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'>" . $v->jndok . "<sup> (<font style='color: #2c03fc'>Max 100 MB</font>, " . $v->formatdata . " ) <span class='text-danger'>*</span></sup></td>";
                        // $hapus="<td></td>";
                        $hapus = "";
                    } else {
                        $str_j .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'>" . $v->judul . "</td>";
                        // $hapus="<td class=' _btnDokDel' ".$tmp."><a class='text-danger btn btn-sm' href='javascript:void(0)'  title='Hapus Data'><i class='text fas fa-trash-alt'></i></a></td>";
                        $hapus = "<a class='btn btn-xs btn-outline-danger _btnDokDel' " . $tmp . " style='margin-left: 5px;' href='javascript:void(0)' title='Hapus Data'>Hapus Dokumen <i class='fas fa-trash-alt' style='margin-left: 5px;'></i></a>";
                    }

                    if ($v->tautan != '') {
                        $str_j .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'><a href='$val_link' download='$rename' target='_blank' class='btn btn-xs btn-outline-primary' title='Unduh Data'>Lihat Dokumen <i class='fas fa-download' style='margin-left: 5px;'></i></a></td>";
                        // $str_j.="<td  class=''><a href='$val_link' download='$rename' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><medium> Lihat Dokumen</medium></h7></a></td>";
                        // $str_j.="<td  class='p-l-25 _colSatu textpointer _btnEdtDok' ".$tmp."><a class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unggah Dokumen'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><medium> Edit Dokumen</medium></h7></a></td>";
                        if ($v->nmdok != 'Dokumen_Inovasi') {
                            $str_j .= "<td class='text-center textpointer' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'><a class='btn btn-xs btn-outline-warning _btnEdtDok' " . $tmp . " title='Edit Dokumen'>Edit Dokumen <i class='fas fa-edit' style='margin-left: 5px;'></i></a>" . $hapus . "</td>";
                        } else {
                            $str_j .= "<td class='text-center textpointer' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'><a class='btn btn-xs btn-outline-warning _btnEdtInovasiDok' " . $tmp . " title='Edit Dokumen'>Edit Dokumen <i class='fas fa-edit' style='margin-left: 5px;'></i></a>" . $hapus . "</td>";
                        }
                    } else {
                        $str_j .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'>Belum diunggah</td>";
                        // $str_j.="<td  class=''>Belum diunggah</td>";
                        // $str_j.="<td  class='p-l-25 _colSatu textpointer _btnUplDok' ".$tmp."><a class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unggah Dokumen'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><medium> Unggah Dokumen</medium></h7></a></td>";
                        if ($v->nmdok != 'Dokumen_Inovasi') {
                            $str_j .= "<td class='text-center textpointer _btnUplDok' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;' " . $tmp . "><a class='btn btn-xs btn-outline-info' title='Unggah Dokumen'>Unggah Dokumen <i class='fas fa-upload' style='margin-left: 5px;'></i></a></td>";
                        } else {
                            $str_j .= "<td class='text-center textpointer _btnUplInovasiDok' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;' " . $tmp . "><a class='btn btn-xs btn-outline-info' title='Unggah Dokumen'>Unggah Dokumen<i class='fas fa-upload' style='margin-left: 5px;'></i></a></td>";
                        }
                    }
                    // $str_j.=$hapus;
                    $str_j .= "</tr>";
                }


                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => $str_j,
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
     * insert data Prov
     * author : FSM 
     * date : 06 jan 2022
     */
    function save_dokumen_prov()
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

                $this->form_validation->set_rules('iddok', 'Id File', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');
                $this->form_validation->set_rules('datafrm', 'Format File', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb      = $this->input->post("iddok");
                $inp_nm      = $this->input->post("nama");
                $format_data = $this->input->post("datafrm");


                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idjenis   = $tmp[1];
                $file      = $tmp[2];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("Invalid ID Kategori Wilayah");
                if (!is_numeric($idjenis))
                    throw new Exception("Invalid ID Map");


                $group = $this->session->userdata(SESSION_LOGIN)->group;
                $satker = $this->session->userdata(SESSION_LOGIN)->satker;


                //upload file dokumen
                $tautan = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/provinsi/';
                    //                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|rar|";
                    $config['allowed_types'] = strtolower($format_data);
                    $config['max_size']    = '3000000'; //300 Mb
                    // $config['max_size']    = '300000000'; //300 Mb
                    $config['encrypt_name']    = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")) {
                        throw new Exception($this->upload->display_errors("", ""), 0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $tautan = $upload_file['file_name'];
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                            FROM `t_doc_prov` D  
                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                            WHERE D.provid =? AND D.judul=? AND U.groupid=? AND D.isactive = 'Y'";
                // WHERE D.provid =? AND D.judul=? AND D.isactive = 'Y'";
                //                $sql = "SELECT id, judul FROM t_doc_prov WHERE provid=? AND judul=? AND isactive = 'Y'";

                $bind = array($satker, $inp_nm, $group);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if ($list_data->num_rows() > 0) {
                    throw new Exception("Duplikasi Nama Dokumen!");
                }
                // add table doc prov
                $this->m_ref->setTableName("t_doc_prov");
                $data_baru = array(
                    "provid"     => $satker,
                    "jenisid"    => $idjenis,
                    "judul"      => $inp_nm,
                    "tautan"     => $tautan,
                    "isactive"   => 'Y',
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"      => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
                }

                $sql1 = "SELECT id, judul, jenisid FROM t_doc_prov WHERE provid=? AND judul=? AND cr_by=? AND isactive = 'Y'";
                $bind1 = array($satker, $inp_nm, $this->session->userdata(SESSION_LOGIN)->userid);
                $list_data1 = $this->db->query($sql1, $bind1);
                if ($list_data1->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $idd = $list_data1->row()->id;

                //spesifik tag user
                if (($list_data1->row()->jenisid == '17') || ($list_data1->row()->jenisid == '18')) {
                    // add table group doc prov
                    $this->m_ref->setTableName("t_doc_prov_groupuser");
                    $data_baru = array(
                        "docid"      => $idd,
                        "groupid"    => '8',
                        "cr_dt"      => $current_date_time,
                        "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        log_message("error", $this->db->error()["message"]);
                        throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                    }
                };

                // add table group doc prov
                $this->m_ref->setTableName("t_doc_prov_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => $group,
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }

                // add table group doc tpt
                $this->m_ref->setTableName("t_doc_prov_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '2',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }

                $output = array(
                    // "satker"    => $satker,
                    // "inp_nm"    => $inp_nm,
                    // "group"     => $group,
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
     * date : 06 jan 2022
     */
    function save_dokumen_prov_inovasi()
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

                $this->form_validation->set_rules('iddok', 'Id File', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');
                $this->form_validation->set_rules('judul', 'Judul Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('deskripsi', 'Deskripsi Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('input', 'Input Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('proses', 'Proses Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('output', 'Output Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('outcome', 'Outcome Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('tagInovasi[]', 'Tag Inovasi', 'required');
                $this->form_validation->set_rules('datafrm', 'Format File', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb      = $this->input->post("iddok");
                $inp_nm      = $this->input->post("nama");
                $judul       = $this->input->post('judul');
                $deskripsi   = $this->input->post('deskripsi');
                $input       = $this->input->post('input');
                $proses      = $this->input->post('proses');
                $output      = $this->input->post('output');
                $outcome     = $this->input->post('outcome');
                $tagInovasi  = $this->input->post('tagInovasi');
                $format_data = $this->input->post("datafrm");


                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idjenis   = $tmp[1];
                $file      = $tmp[2];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("Invalid ID Kategori Wilayah");
                if (!is_numeric($idjenis))
                    throw new Exception("Invalid ID Map");


                $group = $this->session->userdata(SESSION_LOGIN)->group;
                $satker = $this->session->userdata(SESSION_LOGIN)->satker;


                //upload file dokumen
                $tautan = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/provinsi/';
                    //                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|rar|";
                    $config['allowed_types'] = strtolower($format_data);
                    $config['max_size']    = '3000000'; //300 Mb
                    // $config['max_size']    = '300000000'; //300 Mb
                    $config['encrypt_name']    = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")) {
                        throw new Exception($this->upload->display_errors("", ""), 0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $tautan = $upload_file['file_name'];
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                            FROM `t_doc_prov` D  
                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                            WHERE D.provid =? AND D.judul=? AND U.groupid=? AND D.isactive = 'Y'";
                // WHERE D.provid =? AND D.judul=? AND D.isactive = 'Y'";
                //                $sql = "SELECT id, judul FROM t_doc_prov WHERE provid=? AND judul=? AND isactive = 'Y'";

                $bind = array($satker, $inp_nm, $group);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if ($list_data->num_rows() > 0) {
                    throw new Exception("Duplikasi Nama Dokumen!");
                }
                // add table doc prov
                $this->m_ref->setTableName("t_doc_prov");
                $data_baru = array(
                    "provid"     => $satker,
                    "jenisid"    => $idjenis,
                    "judul"      => $inp_nm,
                    "tautan"     => $tautan,
                    "isactive"   => 'Y',
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"      => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
                }

                //get doc after insert
                $sql = "SELECT D.* 
                            FROM `t_doc_prov` D 
                            WHERE D.provid =? AND D.jenisid=? AND D.judul=? AND D.isactive = 'Y'";
                $bind = array($satker, $idjenis, $inp_nm);
                $list_data = $this->db->query($sql, $bind)->result();
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                // add information from doc innovation
                $this->m_ref->setTableName("t_doc_prov_inov");

                $data_baru = array(
                    "id_doc_prov"   => $list_data[0]->id,
                    "nama_inovasi"  => $judul,
                    "deskripsi"     => $deskripsi,
                    "input"         => $input,
                    "proses"        => $proses,
                    "output"        => $output,
                    "outcome"       => $outcome,
                    "tag"           => implode(', ', $tagInovasi),
                    "cr_dt"         => $current_date_time,
                    "cr_by"         => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
                }

                $sql1 = "SELECT id, judul FROM t_doc_prov WHERE provid=? AND judul=? AND cr_by=? AND isactive = 'Y'";
                $bind1 = array($satker, $inp_nm, $this->session->userdata(SESSION_LOGIN)->userid);
                $list_data1 = $this->db->query($sql1, $bind1);
                if ($list_data1->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $idd = $list_data1->row()->id;

                // add table group doc prov
                $this->m_ref->setTableName("t_doc_prov_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => $group,
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }

                // add table group doc tpt
                $this->m_ref->setTableName("t_doc_prov_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '2',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
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
                $userid = $this->session->userdata(SESSION_LOGIN)->userid;
                $satker = $this->session->userdata(SESSION_LOGIN)->satker;
                $group = $this->session->userdata(SESSION_LOGIN)->groupid;

                $link = base_url() . "attachments/provinsi/";
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                            FROM `t_doc_prov` D  
                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                            WHERE D.provid =? AND U.groupid=? AND D.isactive = 'Y'";

                $bind = array($satker, $group);
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
                $lnk = 'https';
                foreach ($list_data->result() as $v) {
                    $idcomb = $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='btnDel' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->judul . "'";

                    $idcomb1 = "prov_" . $v->mapid;
                    $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                    $tmped = "class='btnEdi' data-id='" . $encrypted_id1 . "'";
                    $tmped .= " data-nama='" . $v->judul . "'";
                    $tmped .= " data-file='" . $v->tautan . "'";
                    //$downl = $link.$v->tautan;
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
                    $str .= "<tr class='bg-secondary' title='Dokumen'>";
                    $str .= "<td class='text-right'>" . $no++ . "</td>";
                    $str .= "<td  class='text' >" . wordwrap($v->judul, 10, "<br>\n") . "</td>";
                    $str .= "<td  class='text'></td>";
                    $str .= "<td  class='text'>" . $v->cr_by . "</td>";
                    $str .= "<td  class='text'>" . $v->cr_dt . "</td>";
                    $str .= "<td  class=''><a href='$link' download='$rename' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                    if ($userid == $v->cr_by) {
                        $str .= "<td  class=''><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='text fas fa-pencil-alt'></i></a></td>";
                        $str .= "<td  class=''><a href='javascript:void(0)' " . $tmp . " class='text-danger btn btn-sm ' title='Hapus Data'><i class='text fas fa-trash-alt '></i></a></td>";
                    } else {
                        $str .= "<td  class=''></td>";
                        $str .= "<td  class=''></td>";
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
                $id = $this->input->post("id");
                if (!is_numeric($id))
                    throw new Exception("Invalid ID");
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //check data
                $sql = "SELECT id,judul FROM t_doc_prov WHERE id=" . $id;

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if ($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $nm = $list_data->row()->judul;
                $this->db->trans_begin();
                $sql = "UPDATE t_doc_prov SET isactive = 'N', up_dt='" . $this->session->userdata(SESSION_LOGIN)->userid . "', up_by='" . $current_date_time . "' WHERE id=" . $id;
                //print_r($sql);exit();
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

                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $satker = $this->session->userdata(SESSION_LOGIN)->satker;
                $inp_nm     = $this->input->post("nama");
                $group = $this->session->userdata(SESSION_LOGIN)->group;

                //upload file dokumen
                $tautan = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    //     $config['upload_path'] = './attachments/provinsi/';
                    $config['upload_path'] = './attachments/provinsi/';
                    // $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|rar|";
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi";
                    $config['max_size']    = '3000000'; //300 Mb
                    // $config['max_size']    = '300000000'; //300 Mb
                    $config['encrypt_name']    = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")) {
                        throw new Exception($this->upload->display_errors("", ""), 0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    //$tautan = base_url("attachments/provinsi/").$upload_file['file_name'];
                    $tautan = $upload_file['file_name'];
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                            FROM `t_doc_prov` D  
                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                WHERE D.provid =? AND D.judul=? AND D.isactive = 'Y'";
                // WHERE D.provid =? AND D.judul=? AND U.groupid=? AND D.isactive = 'Y'";
                // $sql = "SELECT id, judul FROM t_doc_prov WHERE provid=? AND judul=? AND isactive = 'Y'";

                // $bind = array($satker, $inp_nm, $group);
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
                // add table doc prov
                $this->m_ref->setTableName("t_doc_prov");
                $data_baru = array(
                    "provid"     => $satker,
                    "judul"      => $inp_nm,
                    "jenisid"      => "19",
                    "tautan"     => $tautan,
                    "isactive"   => 'Y',
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"      => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
                }

                $sql1 = "SELECT id, judul FROM t_doc_prov WHERE provid=? AND judul=? AND cr_by=? AND isactive = 'Y'";
                $bind1 = array($satker, $inp_nm, $this->session->userdata(SESSION_LOGIN)->userid);
                $list_data1 = $this->db->query($sql1, $bind1);
                if ($list_data1->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $idd = $list_data1->row()->id;

                // add table group doc prov
                $this->m_ref->setTableName("t_doc_prov_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => $group,
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }

                // add table group doc tpt
                $this->m_ref->setTableName("t_doc_prov_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '2',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }

                $output = array(
                    // "satker"    => $satker,
                    // "inp_nm"    => $inp_nm,
                    // "group"     => $group,
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
     * date : 30 des 2020
     */
    /*
     * update data kota
     * author : FSM 
     * date : 30 des 2021
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

                $this->form_validation->set_rules('dokdata', 'ID Dok', 'required|xss_clean');
                $this->form_validation->set_rules('iddok', 'ID Dok', 'required|xss_clean');
                $this->form_validation->set_rules('datafrm', 'Nama File', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }


                //$idcomb = decrypt_base64($this->input->post("id"));
                $idcomb = $this->input->post("dokdata");
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                //$kate_wlyh = $tmp[0];
                $idmap = $this->input->post("iddok");
                $inp_nm     = $this->input->post("nama");
                $dt_format     = $this->input->post("datafrm");

                //cek data
                $sql = "SELECT id, judul nm FROM t_doc_prov WHERE id=? ";
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

                if ($fileupload != '' && $inp_nm == '') {
                    //upload file dokumen
                    $tautan = "";
                    if (file_exists($_FILES['filedok']['tmp_name']) && is_uploaded_file($_FILES['filedok']['tmp_name'])) {
                        //UPLOAD documents
                        $config['upload_path'] = './attachments/provinsi/';
                        // $config['allowed_types'] = $dt_format;
                        $config['allowed_types'] = strtolower($dt_format);
                        $config['max_size']    = '3000000'; //300 Mb
                        $config['encrypt_name']    = TRUE;
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload("filedok")) {
                            throw new Exception($this->upload->display_errors("", ""), 0);
                        }
                        //uploaded data
                        $upload_file = $this->upload->data();
                        //$inp_urldoc = base_url("attachments/provinsi/").$upload_file['file_name'];
                        $tautan = $upload_file['file_name'];
                    }

                    //update
                    $this->m_ref->setTableName("t_doc_prov");
                    $data_uodate = array(
                        "tautan"   => $tautan,
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
                } elseif ($fileupload == '' && $inp_nm != '') {

                    //update
                    $this->m_ref->setTableName("t_doc_prov");
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
                } else {
                    //upload file dokumen
                    $tautan = "";
                    if (file_exists($_FILES['filedok']['tmp_name']) && is_uploaded_file($_FILES['filedok']['tmp_name'])) {
                        //UPLOAD documents
                        $config['upload_path'] = './attachments/provinsi/';
                        // $config['allowed_types'] = $dt_format;
                        $config['allowed_types'] = strtolower($dt_format);
                        $config['max_size']    = '3000000'; //300 Mb
                        // $config['max_size']    = '300000000'; //300 Mb
                        $config['encrypt_name']    = TRUE;
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload("filedok")) {
                            throw new Exception($this->upload->display_errors("", ""), 0);
                        }
                        //uploaded data
                        $upload_file = $this->upload->data();
                        $tautan = $upload_file['file_name'];
                    }

                    //update
                    $this->m_ref->setTableName("t_doc_prov");
                    $data_uodate = array(
                        "judul"   => $inp_nm,
                        "tautan"   => $tautan,
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

    function update_inovasi_dok()
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

                $this->form_validation->set_rules('dokdata', 'ID Dok', 'required|xss_clean');
                $this->form_validation->set_rules('iddok', 'Id File', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');
                $this->form_validation->set_rules('judul', 'Judul Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('deskripsi', 'Deskripsi Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('input', 'Input Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('proses', 'Proses Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('output', 'Output Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('outcome', 'Outcome Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('tagInovasi[]', 'Tag Inovasi', 'required');
                $this->form_validation->set_rules('datafrm', 'Format File', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = $this->input->post("dokdata");
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 3)
                    throw new Exception("Invalid ID");
                $idmap = $this->input->post("iddok");
                $inp_nm      = $this->input->post("nama");
                $judul       = $this->input->post('judul');
                $deskripsi   = $this->input->post('deskripsi');
                $input       = $this->input->post('input');
                $proses      = $this->input->post('proses');
                $output      = $this->input->post('output');
                $outcome     = $this->input->post('outcome');
                $tagInovasi  = $this->input->post('tagInovasi');
                $dt_format = $this->input->post("datafrm");

                //cek data
                $sql = "SELECT id, judul nm FROM t_doc_prov WHERE id=? ";
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
                    $tautan = "";
                    if (file_exists($_FILES['filedok']['tmp_name']) && is_uploaded_file($_FILES['filedok']['tmp_name'])) {
                        //UPLOAD documents
                        $config['upload_path'] = './attachments/provinsi/';
                        $config['allowed_types'] = strtolower($dt_format);
                        $config['max_size']    = '3000000'; //300 Mb
                        // $config['max_size']    = '300000000'; //300 Mb
                        $config['encrypt_name']    = TRUE;
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload("filedok")) {
                            throw new Exception($this->upload->display_errors("", ""), 0);
                        }
                        //uploaded data
                        $upload_file = $this->upload->data();
                        $tautan = $upload_file['file_name'];
                    }

                    //update di tabel t_doc_prov
                    $this->m_ref->setTableName("t_doc_prov");
                    $data_uodate = array(
                        "tautan"   => $tautan,
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

                    //update di tabel t_doc_prov_inov
                    $this->m_ref->setTableName("t_doc_prov_inov");
                    $data_uodate_inov = array(
                        "nama_inovasi"  => $judul,
                        "deskripsi"     => $deskripsi,
                        "input"         => $input,
                        "proses"        => $proses,
                        "output"        => $output,
                        "outcome"       => $outcome,
                        "tag"           => implode(', ', $tagInovasi),
                        "up_dt"         => $current_date_time,
                        "up_by"         =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond_inov = array(
                        "id_doc_prov"    => $idmap,
                    );
                    $status_save_inov = $this->m_ref->update($cond_inov, $data_uodate_inov);
                    if (!$status_save_inov) {
                        throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                    }
                } elseif ($fileupload == '') {

                    //update di tabel t_doc_prov_inov
                    $this->m_ref->setTableName("t_doc_prov_inov");
                    $data_uodate_inov = array(
                        "nama_inovasi"  => $judul,
                        "deskripsi"     => $deskripsi,
                        "input"         => $input,
                        "proses"        => $proses,
                        "output"        => $output,
                        "outcome"       => $outcome,
                        "tag"           => implode(', ', $tagInovasi),
                        "up_dt"         => $current_date_time,
                        "up_by"         =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond_inov = array(
                        "id_doc_prov"    => $idmap,
                    );
                    $status_save_inov = $this->m_ref->update($cond_inov, $data_uodate_inov);
                    if (!$status_save_inov) {
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


    /*
     * Download bahan dukung daerah
     * author :  FSM
     * date : 23 Feb 2021
     */
    function d_bahan()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }
        $userid = $this->session->userdata(SESSION_LOGIN)->userid;
        $satker = $this->session->userdata(SESSION_LOGIN)->satker;
        $group  = $this->session->userdata(SESSION_LOGIN)->groupid;
        date_default_timezone_set("Asia/Jakarta");
        $current_date_time = date("Y_m_d_H_i_s");

        $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                            FROM `t_doc_prov` D  
                            JOIN `t_doc_prov_groupuser` G ON D.id = G.docid 
                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                            WHERE D.provid =? AND U.groupid=? AND D.isactive = 'Y'";

        $bind = array($satker, $group);
        $list_data = $this->db->query($sql, $bind);
        if ($list_data->num_rows() == 0) {
            echo 'Bahan Dukung tidak ada';
            exit();
        }

        foreach ($list_data->result() as $v) {
            //                        if(substr($v->tautan,0, 5)=='https'){ $file       =substr($v->tautan,58, 500); }
            //                        else { $file       =substr($v->tautan,57, 500); }

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

            $filepath1 = FCPATH . 'attachments/provinsi/' . $v->tautan;

            $this->zip->read_file($filepath1, $rename);

            $filepath = $v->tautan;
            $filedata[] = $filepath;
        }
        // Download
        $filename = "Dokumen_dukung_" . $userid . ".zip";
        $this->zip->download($filename);
    }
}
