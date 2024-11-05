<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD1_M_Bahan_dukung extends CI_Controller
{
    var $view_dir   = "ppd1/PPD1_upload_dokumen/";
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
                $this->js_path    = "assets/js/ppd1/PPD1_upload_dokumen/bahan_dukung_prov.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_bahandukung_ppd1", $data_page, TRUE);

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
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 0);
                }

                                   $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml 
                                   FROM `t_doc` D  
                                   LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                                   LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
                                   WHERE D.isactive = 'Y'";
//                 $sql = "SELECT * FROM (
// SELECT '1' kate, D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml, 'Sekretariat PPD'  graoup 
//                     FROM `t_doc` D  
//                     LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
//                     LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
//                     WHERE D.isactive = 'Y') AS a
//                     UNION
//                     SELECT * FROM (
// SELECT '2' kate ,PK.id mapid, PK.judul, PK.tautan,PK.cr_dt, PK.cr_by, PK.up_dt, PK.up_by, '0' jml, 'Tim Provinsi'  graoup 
// FROM `t_dok_pkk` PK 
// WHERE PK.isactive = 'Y') AS b
// ORDER BY kate, mapid ASC";
                $list_data = $this->db->query($sql);
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
                    // if ($v->kate != $satu) {
                    //     $str .= "<tr class='bg-secondary' title='Bahan Dukung'>";
                    //     $str .= "<td colspan='8' class='text'><b><small></small><br/>" . $v->graoup . "</b></td>";
                    //     $str .= "</tr>";
                    //     $satu = $v->kate;
                    // }
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
                    
                    $str .= "<td class='p-l-25'><a href='javascript:void(0)' " . $tmpJml . ">" . $v->jml . " Group User</a></td>";
                    $str1 = "<td  class=''><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='text fas fa-pencil-alt'></i></a></td>";
                    $str2 = "<td  class=''><a href='javascript:void(0)' " . $tmp . " class='text-danger btn btn-sm ' title='Hapus Data'><i class='text fas fa-trash-alt text-danger'></i></a></td>";
                

                    $str .= "<td  class='text' title='Diedit oleh : $v->up_by' >" . $v->cr_by . "</td>";
                    $str .= "<td  class='text' title='Diedit : $v->up_dt'>" . $v->cr_dt . "</td>";
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
     * Detail tag group
     * author : FSM 
     * date : 19 des 2020
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

                //get list Gropu
                $sql = "SELECT B.*,C.groupid 
                        FROM `tbl_user_group` B
                        LEFT JOIN  `t_doc_groupuser` C ON B.id = C.groupid AND C.docid=?
                        WHERE 1=1";
                $bind = array($iddok);
                $list_group = $this->db->query($sql, $iddok);
                $content_k = '';
                $tahap = '';
                $str_stts = "<option value=''> - Pilih - </option>";
                foreach ($list_group->result() as $g) {
                    $idcomb = "hapus-" . $g->id;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmped = "class='btnCl' data-id='" . $encrypted_id . "'";

                    $idcomb1 = "tambah-" . $g->id;
                    $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                    $tmped1 = "class='btnCl' data-id='" . $encrypted_id . "'";

                    $content_k .= "<tr class='odd gradeX'>";
                    if ($g->groupid == '') {
                        $str_stts .= "<option value='$encrypted_id1'>$g->name</option>";
                    } else {
                        $content_k .= "<td class='text-lift' style='width:15px'><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='btnCl fas fas fa-times fa-2x text-danger' title=''></i></a></td>";
                        $content_k .= "<td style=''><a class='isinilai'>" . $g->name . "</a></td>";
                    }
                    $content_k .= "</tr>";

                    if ($g->groupid == '3') {
                        $tahap = $g->groupid;
                    }
                }

                $sql_t = "SELECT G.*,T.tahap 
                        FROM `tbl_group_tahap` G 
                        LEFT JOIN `t_doc_tahap` T ON G.id = T.tahap AND T.docid=?
                        WHERE 1=1 ";
                $bind_t = array($iddok);
                $list_group_t = $this->db->query($sql_t, $bind_t);
                $content_t = '';

                $str_stts_t = "<option value=''> - Pilih - </option>";
                foreach ($list_group_t->result() as $t) {
                    $idcomb = "hapus-" . $t->id;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmped = "class='btnCl' data-id='" . $encrypted_id . "'";
                    $idcomb1 = "tambah-" . $t->id;
                    $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                    $tmped1 = "class='btnCl' data-id='" . $encrypted_id . "'";
                    $content_t .= "<tr class='odd gradeX'>";
                    if ($t->tahap == '') {
                        $str_stts_t .= "<option value='$encrypted_id1'>$t->nama</option>";
                    } else {
                        $content_t .= "<td class='text-lift' style='width:15px'><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='btnCl fas fas fa-times fa-2x text-danger' title=''></i></a></td>";
                        $content_t .= "<td style='text-align:left'><a class='isinilai'>" . $t->nama . "</a></td>";
                    }
                    $content_t .= "<tr class='odd gradeX'>";
                }

                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success get data",
                    "tbl_group" =>  $content_k,
                    "str"       => $str_stts,
                    "tahap"            => $tahap,
                    "tbl_tahap" =>  $content_t,
                    "str_t"       => $str_stts_t,
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

    function detail_update()
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
                $this->form_validation->set_rules('group', 'ID group', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                $idcomb = decrypt_base64($this->input->post("id"));

                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID #1");
                $kate_id = $tmp[0];
                $iddok = $tmp[1];
                if (!is_numeric($iddok))
                    throw new Exception("Invalid ID User");

                $group = decrypt_base64($this->input->post("group"));
                $tmp1 = explode('-', $group);
                if (count($tmp1) != 2)
                    throw new Exception("Invalid ID #1");
                $kate_iselect = $tmp1[0];
                $idgrp        = $tmp1[1];
                if (!is_numeric($idgrp))
                    throw new Exception("Invalid ID User");

                $tahap = '';
                //$pesan="success get data";
                if ($kate_iselect == "hapus") {
                    $this->m_ref->setTableName("t_doc_groupuser");
                    $select = array();
                    $cond = array(
                        "docid"    => $iddok,
                        "groupid"  => $idgrp,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if ($list_data->num_rows() == 0) {
                        throw new Exception("Data not found, please reload this page!", 0);
                    }

                    $this->db->trans_begin();
                    $status = $this->m_ref->delete($cond);
                    if (!$status) {
                        if ($this->db->error()["code"] == 1451)
                            throw new Exception($this->db->error()["code"] . ":Data sedang digunakan", 0);
                        else
                            throw new Exception($this->db->error()["code"] . ":Failed delete data", 0);
                    }
                    $this->db->trans_commit();

                    //get list Gropu
                    $sql = "SELECT B.*,C.groupid 
                            FROM `tbl_user_group` B
                            LEFT JOIN  `t_doc_groupuser` C ON B.id = C.groupid AND C.docid=?
                            WHERE 1=1";
                    $bind = array($iddok);
                    $list_group = $this->db->query($sql, $iddok);
                    $content_k = '';
                    $str_stts = "<option value=''> - Pilih - </option>";
                    foreach ($list_group->result() as $g) {
                        $idcomb = "hapus-" . $g->id;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                        $tmped = "class='btnCl' data-id='" . $encrypted_id . "'";

                        $idcomb1 = "tambah-" . $g->id;
                        $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                        $tmped1 = "class='btnCl' data-id='" . $encrypted_id . "'";

                        $content_k .= "<tr class='odd gradeX'>";
                        if ($g->groupid == '') {
                            $str_stts .= "<option value='$encrypted_id1'>$g->name</option>";
                        } else {
                            $content_k .= "<td class='text-lift'><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='btnCl fas fas fa-times fa-2x text-danger' title=''></i></a></td>";
                            $content_k .= "<td style=''><a class='isinilai'>" . $g->name . "</a></td>";
                        }
                        $content_k .= "</tr>";
                        if ($g->groupid == '3') {
                            $tahap = $g->groupid;
                        }
                    }
                } else {
                    // add record
                    $this->m_ref->setTableName("t_doc_groupuser");
                    $data_baru = array(
                        "docid"    => $iddok,
                        "groupid"  => $idgrp,
                        "cr_dt"     => $current_date_time,
                        "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        log_message("error", $this->db->error()["message"]);
                        throw new Exception($this->db->error()["code"] . ":Failed save data1", 0);
                    }

                    //get list Gropu
                    $sql = "SELECT B.*,C.groupid 
                                FROM `tbl_user_group` B
                                LEFT JOIN  `t_doc_groupuser` C ON B.id = C.groupid AND C.docid=?
                                WHERE 1=1";
                    $bind = array($iddok);
                    $list_group = $this->db->query($sql, $iddok);
                    $content_k = '';
                    $str_stts = "<option value=''> - Pilih - </option>";
                    foreach ($list_group->result() as $g) {
                        $idcomb = "hapus-" . $g->id;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                        $tmped = "class='btnCl' data-id='" . $encrypted_id . "'";

                        $idcomb1 = "tambah-" . $g->id;
                        $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                        $tmped1 = "class='btnCl' data-id='" . $encrypted_id . "'";

                        $content_k .= "<tr class='odd gradeX'>";
                        if ($g->groupid == '') {
                            $str_stts .= "<option value='$encrypted_id1'>$g->name</option>";
                        } else {
                            $content_k .= "<td class='text-lift'><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='btnCl fas fas fa-times fa-2x text-danger' title=''></i></a></td>";
                            $content_k .= "<td style=''><a class='isinilai'>" . $g->name . "</a></td>";
                        }
                        $content_k .= "</tr>";
                        if ($g->groupid == '3') {
                            $tahap = $g->groupid;
                        }
                    }
                }

                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success update data",
                    "tbl_group" =>  $content_k,
                    "str"       => $str_stts,
                    "tahap"            => $tahap,
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
     * tambah dan hapus  data tahap dokumen 
     * author : FSM
     * date : 23 jan 2021
     */
    function detail_update_t()
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
                $this->form_validation->set_rules('group', 'ID group', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                $idcomb = decrypt_base64($this->input->post("id"));

                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID #1");
                $kate_id = $tmp[0];
                $iddok = $tmp[1];
                if (!is_numeric($iddok))
                    throw new Exception("Invalid ID User");

                $group = decrypt_base64($this->input->post("group"));
                $tmp1 = explode('-', $group);
                if (count($tmp1) != 2)
                    throw new Exception("Invalid ID #1");
                $kate_iselect = $tmp1[0];
                $idgrp        = $tmp1[1];
                if (!is_numeric($idgrp))
                    throw new Exception("Invalid ID Tahap");

                if ($kate_iselect == "hapus") {
                    $this->m_ref->setTableName("t_doc_tahap");
                    $select = array();
                    $cond = array(
                        "docid"    => $iddok,
                        "tahap"  => $idgrp,
                    );
                    $list_data = $this->m_ref->get_by_condition($select, $cond);
                    if ($list_data->num_rows() == 0) {
                        throw new Exception("Data not found, please reload this page!", 0);
                    }

                    $this->db->trans_begin();
                    $status = $this->m_ref->delete($cond);
                    if (!$status) {
                        if ($this->db->error()["code"] == 1451)
                            throw new Exception($this->db->error()["code"] . ":Data sedang digunakan", 0);
                        else
                            throw new Exception($this->db->error()["code"] . ":Failed delete data", 0);
                    }
                    $this->db->trans_commit();

                    //get list Gropu tahap
                    $sql = "SELECT G.*,T.tahap 
                            FROM `tbl_group_tahap` G 
                            LEFT JOIN `t_doc_tahap` T ON G.id = T.tahap AND T.docid=?
                            WHERE 1=1";
                    $bind = array($iddok);
                    $list_group = $this->db->query($sql, $iddok);
                    $content_k = '';
                    $str_stts = "<option value=''> - Pilih - </option>";
                    foreach ($list_group->result() as $g) {
                        $idcomb = "hapus-" . $g->id;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                        $tmped = "class='btnCl' data-id='" . $encrypted_id . "'";

                        $idcomb1 = "tambah-" . $g->id;
                        $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                        $tmped1 = "class='btnCl' data-id='" . $encrypted_id . "'";

                        $content_k .= "<tr class='odd gradeX'>";
                        if ($g->tahap == '') {
                            $str_stts .= "<option value='$encrypted_id1'>$g->nama</option>";
                        } else {
                            $content_k .= "<td class='text-lift'><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='btnCl fas fas fa-times fa-2x text-danger' title=''></i></a></td>";
                            $content_k .= "<td style=''><a class='isinilai'>" . $g->nama . "</a></td>";
                        }
                        $content_k .= "</tr>";
                    }
                } else {
                    // add record
                    $this->m_ref->setTableName("t_doc_tahap");
                    $data_baru = array(
                        "docid"    => $iddok,
                        "tahap"  => $idgrp,
                        "cr_dt"     => $current_date_time,
                        "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if (!$status_save) {
                        log_message("error", $this->db->error()["message"]);
                        throw new Exception($this->db->error()["code"] . ":Failed save data1", 0);
                    }

                    //get list Gropu
                    $sql = "SELECT G.*,T.tahap 
                            FROM `tbl_group_tahap` G 
                            LEFT JOIN `t_doc_tahap` T ON G.id = T.tahap AND T.docid=?
                            WHERE 1=1";
                    $bind = array($iddok);
                    $bind = array($iddok);
                    $list_group = $this->db->query($sql, $iddok);
                    $content_k = '';
                    $str_stts = "<option value=''> - Pilih - </option>";
                    foreach ($list_group->result() as $g) {
                        $idcomb = "hapus-" . $g->id;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                        $tmped = "class='btnCl' data-id='" . $encrypted_id . "'";

                        $idcomb1 = "tambah-" . $g->id;
                        $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                        $tmped1 = "class='btnCl' data-id='" . $encrypted_id . "'";

                        $content_k .= "<tr class='odd gradeX'>";
                        if ($g->tahap == '') {
                            $str_stts .= "<option value='$encrypted_id1'>$g->nama</option>";
                        } else {
                            $content_k .= "<td class='text-lift'><a href='javascript:void(0)' " . $tmped . " class='text-danger btn btn-sm ' title='Edit Data'><i class='btnCl fas fas fa-times fa-2x text-danger' title=''></i></a></td>";
                            $content_k .= "<td style=''><a class='isinilai'>" . $g->nama . "</a></td>";
                        }
                        $content_k .= "</tr>";
                    }
                }

                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success update data",
                    "tbl_group_t" =>  $content_k,
                    "str_t"       => $str_stts,
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
                $sql = "SELECT id, judul FROM t_doc WHERE id=" . $id;

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if ($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $nm = $list_data->row()->judul;
                $this->db->trans_begin();
                $sql = "UPDATE t_doc SET isactive ='N', up_by='" . $this->session->userdata(SESSION_LOGIN)->userid . "', up_dt='" . $current_date_time . "' WHERE id=" . $id;
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
    function save_dokkk()
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

                $inp_nm     = $this->input->post("nama");
                $group = $this->session->userdata(SESSION_LOGIN)->group;
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
                    //$inp_urldoc = base_url("attachments/bahandukung/").$upload_file['file_name'];
                    $inp_urldoc = $upload_file['file_name'];
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, judul nm FROM t_doc WHERE judul=? AND isactive = 'Y'";
                $bind = array($inp_nm);
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
                $this->m_ref->setTableName("t_doc");
                $data_baru = array(
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

                $sql1 = "SELECT id, judul FROM t_doc WHERE judul=? AND isactive = 'Y'";
                $bind1 = array($inp_nm);
                $list_data1 = $this->db->query($sql1, $bind1);
                if ($list_data1->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan", 3);

                $idd = $list_data1->row()->id;

                // add table group doc prov
                $this->m_ref->setTableName("t_doc_groupuser");
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
                $sql = "SELECT id, judul nm FROM t_doc WHERE id=? ";
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
                    $this->m_ref->setTableName("t_doc");
                    $data_baru = array(
                        "judul"      => $inp_nm,
                        "tautan"   => $inp_urldoc,
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
                } else {

                    //update
                    $this->m_ref->setTableName("t_doc");
                    $data_baru = array(
                        "judul"      => $inp_nm,
                        "up_dt"         => $current_date_time,
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


    function download_all()
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

                $this->load->library('zip');
                $this->zip->archive('my_backup.zip');
                $directory = 'download';
                $filename = "bahan_dukung" . date("Y-m-d H:i:s");

                $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml 
                    FROM `t_doc` D  
                    LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                    LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
                    WHERE D.isactive = 'Y'";
                //                    $bind = array($idmap);
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                //                if($list_data->num_rows()==0)
                //                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";
                $link = base_url() . "attachments/bahandukung/";
                $no = 1;
                foreach ($list_data->result() as $v) {
                }
                $this->zip->read_file($v->tautan);
                $this->zip->download('' . $filename . '.zip');

                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    // "str"       => $str,
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
}
