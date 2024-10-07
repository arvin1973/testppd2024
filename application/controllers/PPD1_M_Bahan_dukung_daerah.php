<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD1_M_Bahan_dukung_daerah extends CI_Controller
{
    var $view_dir   = "ppd1/PPD1_upload_dokumen/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD1_upload_dokumen_daerah/dokumen_daerah.js";
    var $allowed    = array("PPD1");
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        $this->load->library('zip');
    }

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
                $this->js_path    = "assets/js/ppd1/PPD1_upload_dokumen/bahan_dukung_daerah.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                
                $str = $this->load->view($this->view_dir . "index_bahandukung_daerah_ppd1", $data_page, TRUE);

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
     * list data Provinsi
     * author : MMA 
     * date : 23 sep 2024
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
                    $idx++   => 'prov.`id_kode`',
                    $idx++   => 'prov.`id`',
                    $idx++   => 'prov.`nama_provinsi`',
                    $idx++   => 'jml_dok',
                );
                $sql = "SELECT prov.id AS mapid, prov.id_kode AS id_kode, prov.nama_provinsi AS nama_provinsi, IFNULL(JML.jml,0) jml_dok
                        FROM provinsi prov
                        LEFT JOIN(
                            SELECT p.id, p.nama_provinsi, COUNT(1) jml
                            FROM t_dok_pkk pkk
                            JOIN provinsi p ON p.id=pkk.provid
                            WHERE pkk.isactive='Y'
                            GROUP BY p.id
                        )JML ON JML.id=prov.id
                        WHERE prov.id != -1";

                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " AND ( "
                        . " prov.`nama_provinsi` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR prov.`id_kode` LIKE '%" . $requestData['search']['value'] . "%' "
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
                    if ($row->jml_dok > 0) {
                        $nestedData[] = "<span class='badge-warning'>" . $row->jml_dok . " Dokumen</span>";
                    } else {
                        $nestedData[] = "<span class='badge-danger'>" . $row->jml_dok . " Dokumen</span>";
                    }
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
     * =========================================================================
     *  Provinsi                                                   - START
     * =========================================================================
     */
    /*
     * list data Bahan Dokumen
     * author :  MMA
     * date : 19 sep 2024
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

                $sql = "SELECT '2' kate ,PK.provid provid, PK.id mapid, PK.judul, PK.tautan,PK.cr_dt, PK.cr_by, PK.up_dt, PK.up_by, '0' jml, 'Tim Provinsi'  graoup 
                        FROM `t_dok_pkk` PK 
                        WHERE PK.provid=? AND PK.isactive = 'Y'";
                $bind = array($idmap);
                $list_data = $this->db->query($sql, $bind);

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";

                $link = base_url() . "attachments/bahandukung/";
                $no = 1;
                $lnk = 'https';
                $satu = "";
                $str_view = '';
                foreach ($list_data->result() as $v) {
                    $val_link = $link . $v->tautan;
                    if ($v->kate != $satu) {
                        $str .= "<tr class='bg-secondary' title='Bahan Dukung'>";
                        $str .= "<td colspan='8' class='text'><b><small></small><br/>" . $v->graoup . "</b></td>";
                        $str .= "</tr>";
                        $satu = $v->kate;
                    }
                    $idcomb = $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='btnDel' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->judul . "'";

                    $idcombJ = "-" . $v->mapid;
                    $encrypted_idJ = base64_encode(openssl_encrypt($idcombJ, "AES-128-ECB", ENCRYPT_PASS));
                    $tmpJml = "class='btnJml' data-id='" . $encrypted_idJ . "'";
                    $tmpJml .= " data-judul='" . $v->judul . "'";
                    $tmpJml .= " data-cr='" . $v->cr_by . "'";
                    $tmpJml .= " data-dt='" . $v->cr_dt . "'";

                    $idcomb1 = "prov_" . $v->mapid;
                    $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                    $tmped = "class='btnEdi' data-id='" . $encrypted_id1 . "'";
                    $tmped .= " data-nama='" . $v->judul . "'";
                    $tmped .= " data-file='" . $v->tautan . "'";

                    $namefile = $v->judul;

                    $idcomb_v = "umum-" . $v->mapid;
                    $encrypted_id_v = base64_encode(openssl_encrypt($idcomb_v, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp_v = "font-size: 12px;' class='btn btn-xs text-primary text-left getView' data-id='" . $encrypted_id_v . "'";

                    if (substr($v->tautan, -3) == 'rar') {
                        $rename = $v->judul . ".rar";
                        $str_view = "<td  class='text'><a style='font-size: 12px;' class='btn btn-xs text-secondary text-left'>" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'zip') {
                        $rename = $v->judul . ".zip";
                        $str_view = "<td  class='text'><a style='font-size: 12px;' class='btn btn-xs text-secondary text-left'>" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'pdf') {
                        $tmp_v .= " data-nmlink='" . $val_link . "'";
                        $rename = $v->judul . ".pdf";
                        $str_view = "<td class='text' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'doc') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".docx";
                        $str_view = "<td class='text' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'docx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".docx";
                        $str_view = "<td class='text' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'xlsx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".xlsx";
                        $str_view = "<td class='text' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'xls') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".xls";
                        $str_view = "<td class='text' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $tmp_v .= " data-nmlink='" . $val_link . "'";
                        $rename = $v->judul . ".jpeg";
                        $str_view = "<td class='text' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".pptx";
                        $str_view = "<td class='text' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'mp4') {
                        $tmp_v .= " data-nmlink='" . $val_link . "'";
                        $rename = $v->judul . ".mp4";
                        $str_view = "<td class='text' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } else {
                        $rename = $v->judul;
                        $str_view = "<td  class='text'><a style='font-size: 12px;' class='btn btn-xs text-secondary text-left'>" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    }
                    // $str .= "<tr class='bg-secondary' >";
                    $str .= "<tr class='' >";
                    $str .= "<td class='text-right'>" . $no++ . "</td>";
                    //$str.="<td  class='text'>".wordwrap($v->judul,50,"<br/>")."</td>";
                    $str .= $str_view;
                    if ($v->kate == '2') {
                        // $str .= "<td class='p-l-25'><a href='javascript:void(0)' " . $tmpJml . ">" . $v->jml . " Group User</a></td>";
                        $str1 = "<td  class=''><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='text fas fa-pencil-alt'></i></a></td>";
                        $str2 = "<td  class=''><a href='javascript:void(0)' " . $tmp . " class='text-danger btn btn-sm ' title='Hapus Data'><i class='text fas fa-trash-alt text-danger'></i></a></td>";
                    } else {
                        $str .= "<td class='p-l-25'><a href='javascript:void(0)' ></a></td>";
                        $str1 = "<td  class=''></td>";
                        $str2 = "<td  class=''></td>";
                    }

                    $str .= "<td  class='text' title='Diedit oleh : $v->cr_by' >" . $v->cr_by . "</td>";
                    $str .= "<td  class='text' title='Diedit : $v->cr_dt'>" . $v->cr_dt . "</td>";
                    $str .= "<td  class=''><a href='$val_link' download='$namefile' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                    $str .= $str1;
                    $str .= $str2;

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
     * Download Bahan Dukung oleh Provinsi
     * author :  MMA
     * date : 25 Sep 2024
     */
    function d_bahan()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }
        $idcomb = decrypt_base64($_GET['wl']);
        $tmp = explode('_', $idcomb);

        if (count($tmp) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh  = $tmp[0];
        $idmap     = $tmp[1];

        $_arr = array("prov", "kab", "kot");
        if (!in_array($kate_wlyh, $_arr))
            throw new Exception("InvaliD Kategori Wilayah");
        if (!is_numeric($idmap))
            throw new Exception("Invalid ID Map");

        $sql = "SELECT A.*
            FROM `provinsi` A
            WHERE A.`id`=?";
        $bind = array($idmap);
        $list_data = $this->db->query($sql, $bind);
        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }
        foreach ($list_data->result() as $k) {
            $name = $k->nama_provinsi;
        }
        $filename = "Bahan Dukung oleh_" . $name . ".zip";

        $sql = "SELECT '2' kate ,PK.provid provid, PK.id mapid, PK.judul, PK.tautan,PK.cr_dt, PK.cr_by, PK.up_dt, PK.up_by, '0' jml, 'Tim Provinsi'  graoup 
                FROM `t_dok_pkk` PK 
                WHERE PK.provid=? AND PK.isactive = 'Y'";
        $bind = array($idmap);
        $list_data = $this->db->query($sql, $bind);

        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        if ($list_data->num_rows() == 0) {
            echo 'Bahan Dukung tidak ada';
            exit();
        }

        foreach ($list_data->result() as $v) {
            $filepath1 = FCPATH . 'attachments/bahandukung/' . $v->tautan;

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
            } elseif (substr($v->tautan, -3) == 'xls') {
                $rename = $v->judul . ".xls";
            } elseif (substr($v->tautan, -4) == 'jpeg') {
                $rename = $v->judul . ".jpeg";
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

    /*
     * insert data Bahan Dukung
     * author : MMA 
     * date : 25 Sep 2024
     */
    function save_dok()
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
                // $group = $this->session->userdata(SESSION_LOGIN)->group;
                // $satker = $this->session->userdata(SESSION_LOGIN)->satker;

                //upload file dokumen
                $inp_urldoc = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/bahandukung/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
                    $config['max_size']    = '900000'; //900 Mb
                    $config['encrypt_name']    = TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")) {
                        throw new Exception($this->upload->display_errors("", ""), 0);
                    }
                    //uploaded data
                    //                    $upload_file = $this->upload->data();
                    $upload_file = $this->upload->data();
                    $inp_urldoc = $upload_file['file_name'];
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, judul nm FROM t_dok_pkk WHERE judul=? AND provid=? AND isactive = 'Y'";
                $bind = array($inp_nm, $idmap);
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
                $this->m_ref->setTableName("t_dok_pkk");
                $data_baru = array(
                    "provid"      => $idmap,
                    "judul"      => $inp_nm,
                    "tautan"    => $inp_urldoc,
                    "isactive"  => 'Y',
                    "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"     => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if (!$status_save) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"] . ":Failed save dataa", 0);
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
     * update data Bahan Dukung
     * author : MMA 
     * date : 25 Sep 2024
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

                //cek duplikasi
                $sql = "SELECT id, judul nm FROM t_dok_pkk WHERE id=? AND isactive = 'Y'";
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
                        $config['upload_path'] = './attachments/bahandukung/';
                        $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
                        $config['max_size']    = '900000'; //900 Mb
                        $config['encrypt_name']    = TRUE;
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload("filedok")) {
                            throw new Exception($this->upload->display_errors("", ""), 0);
                        }
                        //uploaded data
                        $upload_file = $this->upload->data();
                        //$inp_urldoc = base_url("attachments/bahandukung/").$upload_file['file_name'];
                        $inp_urldoc = $upload_file['file_name'];
                    }

                    //update
                    $this->m_ref->setTableName("t_dok_pkk");
                    $data_baru = array(
                        "judul"     => $inp_nm,
                        "tautan"    => $inp_urldoc,
                        "up_dt"     => $current_date_time,
                        "up_by"     => $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $idmap,
                    );
                    $status_save = $this->m_ref->update($cond, $data_baru);
                    if (!$status_save) {
                        throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                    }
                } else {

                    //update
                    $this->m_ref->setTableName("t_dok_pkk");
                    $data_baru = array(
                        "judul"      => $inp_nm,
                        "up_dt"      => $current_date_time,
                        "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $idmap,
                    );
                    $status_save = $this->m_ref->update($cond, $data_baru);
                    if (!$status_save) {
                        throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                    }
                }

                $output = array(
                    "status"    =>  1,
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Data berhasil Di update"
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                    "msg"       =>  $exc->getMessage(),

                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }

    /*
     * delete data bahan dukung
     * author : MMA
     * date : 25 Sep 2024
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
                $sql = "SELECT id, judul FROM t_dok_pkk WHERE id=? AND isactive = 'Y'";
                $bind = array($id);
                $list_data = $this->db->query($sql, $bind);

                if (!$list_data) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if ($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $nm = $list_data->row()->judul;
                $this->db->trans_begin();
                $sql = "UPDATE t_dok_pkk SET isactive ='N', up_by='" . $this->session->userdata(SESSION_LOGIN)->userid . "', up_dt='" . $current_date_time . "' WHERE id=" . $id;
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
}
