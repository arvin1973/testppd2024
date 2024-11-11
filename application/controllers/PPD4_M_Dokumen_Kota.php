<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD4_M_Dokumen_Kota extends CI_Controller
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
                $this->js_path    = "assets/js/ppd4/PPD4_upload_dokumen/dokumen_kota.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_kota", $data_page, TRUE);

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
     *  Kabupaten Kota                                                   - START
     * =========================================================================
     */
    /*
     * list data Kabupaten Kota
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
                    //   
                    $idx++   => 'K.`nama_kabupaten`',
                    $idx++   => 'K.`id`',
                );
                $satker = $this->session->userdata(SESSION_LOGIN)->satker;

                //                $sql = "SELECT K.id mapid, K.nama_kabupaten
                //                        FROM `kabupaten` K 
                //                        JOIN `provinsi` II ON II.id_kode=K.prov_id
                //                        WHERE II.id='$satker' AND K.urutan='0' ";
                $sql = "SELECT K.id mapid, K.nama_kabupaten, IFNULL(JML.jml,0) jml_dok
                        FROM `kabupaten` K 
                        JOIN `provinsi` II ON II.id_kode=K.prov_id
                        LEFT JOIN(
                                    SELECT K.id, K.`nama_kabupaten`,COUNT(1) jml  
                                    FROM  `t_doc_kab` D
                                    JOIN `kabupaten` K  ON K.id=D.kabid
                                    JOIN t_doc_kab_groupuser DGU ON DGU.docid=D.id
                                    WHERE D.`isactive`='Y' AND DGU.groupid='4'
                                    GROUP BY K.`id`
                                ) JML ON JML.id=K.id
                        WHERE II.id='$satker' AND K.urutan='1' ";

                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " AND ( "
                        . " K.`nama_kabupaten` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR K.`id` LIKE '%" . $requestData['search']['value'] . "%' "
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
                    $idkab = "kab-" . $row->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idkab, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-nmkk='" . $row->nama_kabupaten . "'";

                    $tmp_mulai = "class='btn btn-sm btn-success waves-effect waves-light getDetail'";
                    $tmp_mulai .= "data-id='" . $encrypted_id . "' data-nmkk='" . $row->nama_kabupaten . "'";

                    $nestedData[] = $i++;
                    $nestedData[] = "<a href='javascript:void(0)' " . $tmp . ">" . $row->nama_kabupaten . "</a>";
                    $nestedData[] = "<a href='javascript:void(0)' >" . $row->jml_dok . " Dokumen</a>";
                    $nestedData[] = "<a href='javascript:void(0)' " . $tmp_mulai . " style='border-radius: 0px; padding-left: 10px; padding-right: 10px; margin-right: 5px;'>Detail <i class='fa fa-caret-right' style='padding-left: 5px;'></i></a>";
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
                $this->form_validation->set_rules('id', 'ID Data Indikator', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $userid = $this->session->userdata(SESSION_LOGIN)->userid;
                $idcomb = decrypt_base64($this->input->post("id"));
                $group = $this->session->userdata(SESSION_LOGIN)->groupid;

                $link = base_url() . "attachments/kabkota/";
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

                if ($kate_wlyh == "kab") {
                    $sql = "SELECT K.* FROM `kabupaten` K WHERE K.id=? ";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                    if (!$list_data) {
                        $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    $kabid     = $list_data->row()->id; //Id kab
                    $kabname     = $list_data->row()->nama_kabupaten; //nama kab

                    $sql = "SELECT * FROM (
                                            SELECT '1' kate ,J.id, J.nama nmdok,J.jndok,J.formatdata, DOK.judul,DOK.mapid,DOK.nama_kabupaten,DOK.tautan,DOK.cr_by
                                            FROM `tbl_jenis_doc` J
                                            LEFT JOIN(
                                                    SELECT  D.jenisid,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt,D.kabid, K.nama_kabupaten
                                                    FROM `t_doc_kab` D  
                                                    JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                                    JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                                    JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                                    JOIN `kabupaten` K ON  D.`kabid` =K.`id`
                                                    WHERE D.kabid =? AND U.groupid=? AND D.isactive = 'Y') DOK ON  DOK.jenisid = J.id
                                            WHERE J.tahap='I' AND J.id !='19' AND J.id != '20') AS a
                          UNION     
                          SELECT * FROM ( 
                                            SELECT  '2' kate ,D.jenisid id,J.nama nmdok,J.jndok,J.formatdata,D.judul, D.id mapid,K.nama_kabupaten,D.tautan,D.cr_by
                                            FROM `t_doc_kab` D  
                                            JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                            JOIN  `tbl_jenis_doc` J ON D.jenisid = J.`id`
                                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                            JOIN `kabupaten` K ON  D.`kabid` =K.`id`
                                            WHERE D.kabid =? AND U.groupid=? AND D.isactive = 'Y' AND D.`jenisid`='19' ORDER BY D.id ASC                                
                                            ) AS b 
                        ORDER BY id, mapid ASC";
                }
                $bind = array($idmap, $group, $idmap, $group);
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
                    $val_link = base_url("attachments/kabkota/" . $v->tautan);

                    if ($v->nmdok == 'Dokumen_Inovasi') {
                        if ($v->mapid != null) {
                            $sql = "SELECT * FROM `t_doc_kab_inov` WHERE id_doc_kab = ?";
                            $bind = array($v->mapid);
                            $list_data_inov = $this->db->query($sql, $bind)->result();

                            $idcomb     = "KAB-" . $v->id . "-" . $v->nmdok . "-" . $kabid;
                            $tmp = "data-id='$idcomb'   ";
                            $tmp .= " data-nmdok='" . $v->nmdok . "_" . $kabname . "'";
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
                            $idcomb     = "KAB-" . $v->id . "-" . $v->nmdok . "-" . $kabid;
                            $tmp = "data-id='$idcomb'   ";
                            $tmp .= " data-nmdok='" . $v->nmdok . "_" . $kabname . "'";
                            $tmp .= " data-frmat='" . $v->formatdata . "'";
                            $tmp .= " data-idmap='" . $v->mapid . "'";
                            $tmp .= " data-link='" . $val_link . "'";
                            $tmp .= " data-kate='" . $v->kate . "'";
                            $tmp .= " data-jdl='" . $v->judul . "'";
                        }
                    } else {
                        $idcomb     = "KAB-" . $v->id . "-" . $v->nmdok . "-" . $kabid;
                        $tmp = "class='  ' data-id='$idcomb'   ";
                        $tmp .= " data-nmdok='" . $v->nmdok . "_" . $kabname . "'";
                        $tmp .= " data-frmat='" . $v->formatdata . "'";
                        $tmp .= " data-idmap='" . $v->mapid . "'";
                        $tmp .= " data-kate='" . $v->kate . "'";
                        $tmp .= " data-jdl='" . $v->judul . "'";
                    }

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
                        $hapus = "";
                    } else {
                        $str_j .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'>" . $v->judul . "</td>";
                        $hapus = "<a class='btn btn-xs btn-outline-danger _btnDokDel' " . $tmp . " style='margin-left: 5px;' href='javascript:void(0)' title='Hapus Data'>Hapus Dokumen <i class='fas fa-trash-alt' style='margin-left: 5px;'></i></a>";
                        //$hapus="";
                    }
                    if ($v->tautan != '') {
                        $str_j .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'><a href='$val_link' download='$rename' target='_blank' class='btn btn-xs btn-outline-primary' title='Unduh Data'>Lihat Dokumen <i class='fas fa-download' style='margin-left: 5px;'></i></a></td>";

                        if ($v->nmdok != 'Dokumen_Inovasi') {
                            $str_j .= "<td class='text-center textpointer' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'><a class='btn btn-xs btn-outline-warning _btnEdtDok' " . $tmp . " title='Edit Dokumen'>Edit Dokumen <i class='fas fa-edit' style='margin-left: 5px;'></i></a>" . $hapus . "</td>";
                        } else {
                            $str_j .= "<td class='text-center textpointer' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'><a class='btn btn-xs btn-outline-warning _btnEdtInovasiDok' " . $tmp . " title='Edit Dokumen'>Edit Dokumen <i class='fas fa-edit' style='margin-left: 5px;'></i></a>" . $hapus . "</td>";
                        }
                    } else {
                        $str_j .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;'>Belum diunggah</td>";
                        if ($v->nmdok != 'Dokumen_Inovasi') {
                            $str_j .= "<td class='text-center textpointer _btnUplDok' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;' " . $tmp . "><a class='btn btn-xs btn-outline-info' title='Unggah Dokumen'>Unggah Dokumen <i class='fas fa-upload' style='margin-left: 5px;'></i></a></td>";
                        } else {
                            $str_j .= "<td class='text-center textpointer _btnUplInovasiDok' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;' " . $tmp . "><a class='btn btn-xs btn-outline-info' title='Unggah Dokumen'>Unggah Dokumen<i class='fas fa-upload' style='margin-left: 5px;'></i></a></td>";
                        }
                    }
                    $str_j .= "</tr>";
                }

                $response = array(
                    "group"     => $group,
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
     * date : 20 jan 2022
     */
    function save_dokumen_kab()
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

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $this->form_validation->set_rules('datafrm', 'Format File', 'required|xss_clean');


                $idcomb      = $this->input->post("iddok");
                $inp_nm      = $this->input->post("nama");
                $format_data = $this->input->post("datafrm");

                //print_r($idcomb);exit();

                $tmp = explode('-', $idcomb);
                if (count($tmp) != 4)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idjenis   = $tmp[1];
                $file      = $tmp[2];
                $satker    = $tmp[3];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("Invalid ID Kategori Wilayah");
                if (!is_numeric($idjenis))
                    throw new Exception("Invalid ID Dokumen");
                if (!is_numeric($satker))
                    throw new Exception("Invalid ID Kabupaten");

                $group = 5;
                //$satker= $this->session->userdata(SESSION_LOGIN)->satker;


                //upload file dokumen
                $tautan = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/kabkota/';
                    $config['allowed_types'] = strtolower($format_data);
                    $config['max_size']    = '3000000'; //300 Mb
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

                /*
                    * =========================================================================
                    * cek duplikasi di table dokumen kabupaten kota
                    * =========================================================================
                    */
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt
                                FROM `t_doc_kab` D  
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                WHERE D.kabid =? AND D.judul=? AND U.groupid=? AND D.isactive = 'Y'";
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
                $this->m_ref->setTableName("t_doc_kab");
                $data_baru = array(
                    "kabid"       => $satker,
                    "jenisid"     => $idjenis,
                    "judul"      => $inp_nm,
                    "tautan"     => $tautan,
                    "isactive"   => 'Y',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data1", 0);
                }

                $sql1 = "SELECT id, judul, jenisid FROM t_doc_kab WHERE kabid=? AND judul=? AND cr_by=? AND isactive = 'Y'";
                $bind1 = array($satker, $inp_nm, $this->session->userdata(SESSION_LOGIN)->userid);
                $list_data1 = $this->db->query($sql1, $bind1);
                if ($list_data1->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $idd = $list_data1->row()->id;

                //spesifik tag user
                if (($list_data1->row()->jenisid == '17') || ($list_data1->row()->jenisid == '18')) {
                    // add table group doc prov
                    $this->m_ref->setTableName("t_doc_kab_groupuser");
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

                // add table group doc Kabupaten/kota
                $this->m_ref->setTableName("t_doc_kab_groupuser");
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
                // add table group doc prov
                $this->m_ref->setTableName("t_doc_kab_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '4',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }
                // add table group doc tpt pusat
                $this->m_ref->setTableName("t_doc_kab_groupuser");
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
                // add table group doc tpt daerah
                $this->m_ref->setTableName("t_doc_kab_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '7',
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
                    "msg"       =>  "Data " . $inp_nm . " berhasil disimpan"
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
     * insert data Kab
     * author : FSM 
     * date : 20 jan 2022
     */
    function save_dokumen_kab_inovasi()
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

                //print_r($idcomb);exit();

                $tmp = explode('-', $idcomb);
                if (count($tmp) != 4)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idjenis   = $tmp[1];
                $file      = $tmp[2];
                $satker    = $tmp[3];
                $_arr = array("PROV", "KAB", "KOTA");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("Invalid ID Kategori Wilayah");
                if (!is_numeric($idjenis))
                    throw new Exception("Invalid ID Dokumen");
                if (!is_numeric($satker))
                    throw new Exception("Invalid ID Kabupaten");

                $group = 5;
                //$satker= $this->session->userdata(SESSION_LOGIN)->satker;


                //upload file dokumen
                $tautan = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/kabkota/';
                    $config['allowed_types'] = strtolower($format_data);
                    $config['max_size']    = '3000000'; //300 Mb
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

                /*
                    * =========================================================================
                    * cek duplikasi di table dokumen kabupaten kota
                    * =========================================================================
                    */
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt
                                FROM `t_doc_kab` D  
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                WHERE D.kabid =? AND D.judul=? AND U.groupid=? AND D.isactive = 'Y'";
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
                $this->m_ref->setTableName("t_doc_kab");
                $data_baru = array(
                    "kabid"       => $satker,
                    "jenisid"     => $idjenis,
                    "judul"      => $inp_nm,
                    "tautan"     => $tautan,
                    "isactive"   => 'Y',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data1", 0);
                }



                //get doc after insert
                $sql = "SELECT D.* 
                            FROM `t_doc_kab` D 
                            WHERE D.kabid =? AND D.jenisid=? AND D.judul=? AND D.isactive = 'Y'";
                $bind = array($satker, $idjenis, $inp_nm);
                $list_data = $this->db->query($sql, $bind)->result();
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                // add information from doc innovation
                $this->m_ref->setTableName("t_doc_kab_inov");

                $data_baru = array(
                    "id_doc_kab"   => $list_data[0]->id,
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







                $sql1 = "SELECT id, judul FROM t_doc_kab WHERE kabid=? AND judul=? AND cr_by=? AND isactive = 'Y'";
                $bind1 = array($satker, $inp_nm, $this->session->userdata(SESSION_LOGIN)->userid);
                $list_data1 = $this->db->query($sql1, $bind1);
                if ($list_data1->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $idd = $list_data1->row()->id;

                // add table group doc Kabupaten/kota
                $this->m_ref->setTableName("t_doc_kab_groupuser");
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
                // add table group doc prov
                $this->m_ref->setTableName("t_doc_kab_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '4',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }
                // add table group doc tpt
                $this->m_ref->setTableName("t_doc_kab_groupuser");
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
                // add table group doc tpt daerah
                $this->m_ref->setTableName("t_doc_kab_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '7',
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
                    "msg"       =>  "Data " . $inp_nm . " berhasil disimpan"
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



    function save_dok()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Your session is ended, please relogin", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                //                $this->form_validation->set_rules('id','ID Data Indikator','required');
                //                if($this->form_validation->run() == FALSE){
                //                    throw new Exception(validation_errors("", ""),0);
                //                }
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 0);
                }
                $this->form_validation->set_rules('idkabU', 'Id Kombinasi', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = decrypt_base64($this->input->post("idkabU"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idmap      = $tmp[1];

                $_arr = array("prov", "kab", "kot");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");


                //$idmap = $this->session->userdata(SESSION_LOGIN)->satker;
                //                if(!is_numeric($idmap))
                //                    throw new Exception("Invalid ID Map");
                $inp_nm     = $this->input->post("nama");
                //$group= $this->session->userdata(SESSION_LOGIN)->group;
                $group = 5;

                //upload file dokumen
                $tautan = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/kabkota/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|png|jpg|jpeg|zip|pptx|ppt|rar|avi";
                    $config['max_size']    = '3000000'; //30 Mb
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
                /*
     * =========================================================================
     * cek duplikasi di table dokumen kabupaten kota
     * =========================================================================
     */
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt
                                FROM `t_doc_kab` D  
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                WHERE D.kabid =? AND D.judul=? AND U.groupid=? AND D.isactive = 'Y'";
                //$sql = "SELECT id, judul FROM t_doc_kab WHERE kabid=? AND judul=? AND isactive = 'Y'";
                $bind = array($idmap, $inp_nm, $group);
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
                $this->m_ref->setTableName("t_doc_kab");
                $data_baru = array(
                    "kabid"      => $idmap,
                    "jenisid"    => '19',
                    "judul"      => $inp_nm,
                    "tautan"     => $tautan,
                    "isactive"   => 'Y',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data1", 0);
                }

                $sql1 = "SELECT id, judul FROM t_doc_kab WHERE kabid=? AND judul=? AND cr_by=? AND isactive = 'Y'";
                $bind1 = array($idmap, $inp_nm, $this->session->userdata(SESSION_LOGIN)->userid);
                $list_data1 = $this->db->query($sql1, $bind1);
                if ($list_data1->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $idd = $list_data1->row()->id;

                // add table group doc kabkota
                $this->m_ref->setTableName("t_doc_kab_groupuser");
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

                // add table group doc prov
                $this->m_ref->setTableName("t_doc_kab_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '4',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }
                // add table group doc tpt daerah
                $this->m_ref->setTableName("t_doc_kab_groupuser");
                $data_baru = array(
                    "docid"      => $idd,
                    "groupid"    => '7',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data2", 0);
                }
                // add table group doc tpt
                $this->m_ref->setTableName("t_doc_kab_groupuser");
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
                $this->db->trans_commit();
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Data " . $inp_nm . " berhasil disimpan"
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



    //     /*
    //     * insert data Prov
    //     * author : FSM 
    //     * date : 17 des 2020
    //     */
    function save_dok1()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Your session is ended, please relogin", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $this->form_validation->set_rules('id', 'ID Data Indikator', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 0);
                }

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

                $_arr = array("prov", "kab", "kot");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                $inp_nm     = $this->input->post("nama");
                $group = $this->session->userdata(SESSION_LOGIN)->group;

                //upload file dokumen
                $tautan = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/kabkota/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
                    $config['max_size']    = '3000000'; //30 Mb
                    $config['encrypt_name']    = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")) {
                        throw new Exception($this->upload->display_errors("", ""), 0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $tautan = base_url("attachments/kabkota/") . $upload_file['file_name'];
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt
                                FROM `t_doc_kab` D  
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                WHERE D.kabid =? AND D.judul=? AND U.groupid=? AND D.isactive = 'Y'";
                //$sql = "SELECT id, judul FROM t_doc_kab WHERE kabid=? AND judul=? AND isactive = 'Y'";
                $bind = array($idmap, $inp_nm, $group);
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
                $this->m_ref->setTableName("t_doc_kab");
                $data_baru = array(
                    "kabid"     => $idmap,
                    "judul"      => $inp_nm,
                    "tautan"     => $tautan,
                    "isactive"   => 'Y',
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save data1", 0);
                }

                $sql1 = "SELECT id, judul FROM t_doc_kab WHERE kabid=? AND judul=? AND cr_by=? AND isactive = 'Y'";
                $bind1 = array($idmap, $inp_nm, $this->session->userdata(SESSION_LOGIN)->userid);
                $list_data1 = $this->db->query($sql1, $bind1);
                if ($list_data1->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $idd = $list_data1->row()->id;

                // add table group doc prov
                $this->m_ref->setTableName("t_doc_kab_groupuser");
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
                $this->m_ref->setTableName("t_doc_kab_groupuser");
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
     * update data Prov
     * author : FSM 
     * date : 30 des 2020
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
                //                $this->form_validation->set_rules('nama','Nama File','required|xss_clean');
                //                $this->form_validation->set_rules('id','ID Provinsi','required|xss_clean');
                $this->form_validation->set_rules('dokdata', 'ID Dok', 'required|xss_clean');
                $this->form_validation->set_rules('iddok', 'ID Dok', 'required|xss_clean');
                $this->form_validation->set_rules('datafrm', 'Nama File', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }


                //$idcomb = decrypt_base64($this->input->post("dokdata"));
                $idcomb = $this->input->post("dokdata");
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 4)
                    throw new Exception("Invalid ID");
                $idmap = $this->input->post("iddok");
                $inp_nm     = $this->input->post("nama");
                $dt_format     = $this->input->post("datafrm");

                //cek data
                $sql = "SELECT id, judul nm FROM t_doc_kab WHERE id=? ";
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
                        $config['upload_path'] = './attachments/kabkota/';
                        $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
                        $config['max_size']    = '3000000'; //300 Mb
                        $config['encrypt_name']    = TRUE;
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload("filedok")) {
                            throw new Exception($this->upload->display_errors("", ""), 0);
                        }
                        //uploaded data
                        $upload_file = $this->upload->data();
                        //$tautan = base_url("attachments/kabkota/").$upload_file['file_name'];                   
                        $tautan = $upload_file['file_name'];
                    }

                    //update
                    $this->m_ref->setTableName("t_doc_kab");
                    $data_uodate = array(
                        "judul"      => $inp_nm,
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
                } else {

                    //update
                    $this->m_ref->setTableName("t_doc_kab");
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
                    "msg"       =>  $inp_nm . " berhasil Di update",
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
                if (count($tmp) != 4)
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
                $sql = "SELECT id, judul nm FROM t_doc_kab WHERE id=? ";
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
                        $config['upload_path'] = './attachments/kabkota/';
                        // $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
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
                        //$tautan = base_url("attachments/kabkota/").$upload_file['file_name'];                   
                        $tautan = $upload_file['file_name'];
                    }

                    //update di tabel t_doc_kab
                    $this->m_ref->setTableName("t_doc_kab");
                    $data_uodate = array(
                        "tautan"    => $tautan,
                        "up_dt"     => $current_date_time,
                        "up_by"     =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $idmap,
                    );
                    $status_save = $this->m_ref->update($cond, $data_uodate);
                    if (!$status_save) {
                        throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                    }

                    //update di tabel t_doc_kab_inov
                    $this->m_ref->setTableName("t_doc_kab_inov");
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
                        "id_doc_kab"    => $idmap,
                    );
                    $status_save_inov = $this->m_ref->update($cond_inov, $data_uodate_inov);
                    if (!$status_save_inov) {
                        throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                    }
                } else {

                    //update di tabel t_doc_kab_inov
                    $this->m_ref->setTableName("t_doc_kab_inov");
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
                        "id_doc_kab"    => $idmap,
                    );
                    $status_save_inov = $this->m_ref->update($cond_inov, $data_uodate_inov);
                    if (!$status_save_inov) {
                        throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                    }
                }

                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  $inp_nm . " berhasil Di update",
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
                //$id = decrypt_base64($this->input->post("id"));
                $id = $this->input->post("id");
                if (!is_numeric($id))
                    throw new Exception("Invalid ID");
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //check data
                $sql = "SELECT id, judul FROM t_doc_kab WHERE id=" . $id;

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if ($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $nm = $list_data->row()->judul;
                $this->db->trans_begin();
                $sql = "UPDATE t_doc_kab SET isactive = 'N', up_dt='" . $this->session->userdata(SESSION_LOGIN)->userid . "', up_by='" . $current_date_time . "' WHERE id=" . $id;

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
        $idcomb = decrypt_base64($_GET['wl']);

        $tmp = explode('-', $idcomb);
        if (count($tmp) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh  = $tmp[0];
        $idwlyh     = $tmp[1];

        $_arr = array("prov", "kab", "kota");
        if (!in_array($kate_wlyh, $_arr))
            throw new Exception("InvaliD Kategori Wilayah");
        if (!is_numeric($idwlyh))
            throw new Exception("Invalid ID Map");
        $sql = "SELECT * FROM `kabupaten` K WHERE K.`id`=?";
        $bind = array($idwlyh);
        $list_data = $this->db->query($sql, $bind);
        if (!$list_data) {
            echo 'Invalid SQL 1!';
            exit();
        }
        $nm_kab = $list_data->row()->nama_kabupaten;

        $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt
                                FROM `t_doc_kab` D  
                                JOIN `t_doc_kab_groupuser` G ON D.id = G.docid 
                                JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                                WHERE D.kabid =? AND U.groupid=? AND D.isactive = 'Y'";

        $bind = array($idwlyh, $group);
        $list_data = $this->db->query($sql, $bind);
        if ($list_data->num_rows() == 0) {
            echo 'Bahan Dukung tidak ada';
            exit();
        }

        foreach ($list_data->result() as $v) {

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

            $filepath1 = FCPATH . 'attachments/kabkota/' . $v->tautan;
            $this->zip->read_file($filepath1, $rename);

            $filepath = $v->tautan;
            $filedata[] = $filepath;
        }
        // Download
        $filename = "Dokumen_dukung_" . $nm_kab . "_" . $userid . ".zip";
        $this->zip->download($filename);
    }
}
