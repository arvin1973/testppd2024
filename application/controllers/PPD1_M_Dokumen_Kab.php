<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD1_M_Dokumen_Kab extends CI_Controller
{
    var $view_dir   = "admin/PPD1_upload_dokumen/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/dokumen/dokumen.js";
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
                $this->js_path    = "assets/js/ppd1/PPD1_upload_dokumen/dokumen_kk.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_kk", $data_page, TRUE);

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
                    $idx++   => 'K.`id_kab`',
                    $idx++   => 'K.`nama_kabupaten`',
                    $idx++   => 'P.`nama_provinsi`',
                );

                $sql = "SELECT K.id mapid,K.id_kab, K.nama_kabupaten,P.nama_provinsi, IFNULL(JML.jml,0) jml_dok
                        FROM `kabupaten` K 
                        LEFT JOIN `provinsi` P ON K.prov_id = P.id_kode
                        LEFT JOIN(
                                    SELECT K.id, K.`nama_kabupaten`,COUNT(1) jml  
                                    FROM  `t_doc_kab` D
                                    JOIN `kabupaten` K  ON K.id=D.kabid
                                    WHERE D.`isactive`='Y'
                                    GROUP BY K.`id`
                                ) JML ON JML.id=K.id
                        WHERE urutan='0' ";

                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " AND ( "
                        . " K.`nama_kabupaten` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR K.`id_kab` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR P.`nama_provinsi` LIKE '%" . $requestData['search']['value'] . "%' "
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

                    $nestedData[] = $row->id_kab;
                    $nestedData[] = "<a href='javascript:void(0)' " . $tmp . ">" . $row->nama_kabupaten . "</a>";
                    $nestedData[] = $row->nama_provinsi;
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

                $_arr = array("prov", "kab", "kot");
                if (!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if (!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");

                if ($kate_wlyh == "kab") {
                    //LIST Dokumen
                    $sql = "SELECT D.`id` mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml 
                            FROM `t_doc_kab` D
                            JOIN `kabupaten` P ON P.`id`=D.kabid
                            LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_kab_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                            LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id
                            WHERE D.kabid =? AND D.isactive = 'Y' ";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql, $bind);
                }

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";

                $no = 1;
                $str_view = '';
                foreach ($list_data->result() as $v) {
                    $val_link = base_url("attachments/kabkota/" . $v->tautan);

                    $idcomb = $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));

                    $tmp = "class='btnDel' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->judul . "'";

                    $idcomb1 = "kab_" . $v->mapid;
                    $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));


                    // $tmped = "class='btnEdi' data-id='" . $encrypted_id1 . "'";
                    // $tmped .= " data-nama='" . $v->judul . "'";
                    // $tmped .= " data-file='" . $v->judul . "'";


                    if (substr($v->judul, 0, 15) == 'Dokumen_Inovasi') {
                        if ($v->mapid != null) {
                            $sql = "SELECT * FROM `t_doc_kab_inov` WHERE id_doc_kab = ?";
                            $bind = array($v->mapid);
                            $list_data_inov = $this->db->query($sql, $bind)->result();

                            if ($list_data_inov == null) {
                                $tmped = "class='btnEdi' data-id='" . $encrypted_id1 . "'";
                                $tmped .= " data-nama='" . $v->judul . "'";
                                $tmped .= " data-file='" . $v->tautan . "'";
                            } else {
                                $tmped = "class='btnEdtInovasiDok' data-id='" . $encrypted_id1 . "'";
                                $tmped .= " data-nama='" . $v->judul . "'";
                                $tmped .= " data-file='" . $v->tautan . "'";

                                $tmped .= " data-idinov='" . $list_data_inov[0]->id . "'";
                                $tmped .= " data-nminov='" . $list_data_inov[0]->nama_inovasi . "'";
                                $tmped .= " data-descinov='" . $list_data_inov[0]->deskripsi . "'";
                                $tmped .= " data-inpinov='" . $list_data_inov[0]->input . "'";
                                $tmped .= " data-proinov='" . $list_data_inov[0]->proses . "'";
                                $tmped .= " data-outinov='" . $list_data_inov[0]->output . "'";
                                $tmped .= " data-cominov='" . $list_data_inov[0]->outcome . "'";
                                $tmped .= " data-tag='" . $list_data_inov[0]->tag . "'";
                            }
                        } else {
                            $tmped = "class='btnEdi' data-id='" . $encrypted_id1 . "'";
                            $tmped .= " data-nama='" . $v->judul . "'";
                            $tmped .= " data-file='" . $v->tautan . "'";
                        }
                    } else {
                        $tmped = "class='btnEdi' data-id='" . $encrypted_id1 . "'";
                        $tmped .= " data-nama='" . $v->judul . "'";
                        $tmped .= " data-file='" . $v->tautan . "'";
                    }


                    $idcombJ = "-" . $v->mapid;
                    $encrypted_idJ = base64_encode(openssl_encrypt($idcombJ, "AES-128-ECB", ENCRYPT_PASS));
                    $tmpJml = "class='btnJml' data-id='" . $encrypted_idJ . "'";
                    $tmpJml .= " data-judul='" . $v->judul . "'";
                    $tmpJml .= " data-cr='" . $v->cr_by . "'";
                    $tmpJml .= " data-dt='" . $v->cr_dt . "'";

                    $idcomb_v = "kota-" . $v->mapid;
                    $encrypted_id_v = base64_encode(openssl_encrypt($idcomb_v, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp_v = "font-size: 14px;' class='btn btn-xs text-primary text-left getView' data-id='" . $encrypted_id_v . "'";

                    if (substr($v->tautan, -3) == 'rar') {
                        $rename = $v->judul . ".rar";
                        $str_view = "<td  class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a style='font-size: 14px;' class='btn btn-xs text-secondary text-left'>" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'zip') {
                        $rename = $v->judul . ".zip";
                        $str_view = "<td  class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a style='font-size: 14px;' class='btn btn-xs text-secondary text-left'>" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'pdf') {
                        $tmp_v .= " data-nmlink='" . $val_link . "'";
                        $rename = $v->judul . ".pdf";
                        $str_view = "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'doc') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".docx";
                        $str_view = "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'docx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".docx";
                        $str_view = "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'xlsx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".xlsx";
                        $str_view = "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'xls') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".xls";
                        $str_view = "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $tmp_v .= " data-nmlink='" . $val_link . "'";
                        $rename = $v->judul . ".jpeg";
                        $str_view = "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".pptx";
                        $str_view = "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'mp4') {
                        $tmp_v .= " data-nmlink='" . $val_link . "'";
                        $rename = $v->judul . ".mp4";
                        $str_view = "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' ><a  title='Klik untuk unduh dokumen' href='javascript:void(0)' " . $tmp_v . "    title='Klik untuk lihat dokumen' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } else {
                        $rename = $v->judul;
                        $str_view = "<td  class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a style='font-size: 14px;' class='btn btn-xs text-secondary text-left'>" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    }

                    $str .= "<tr class=''>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                    //$str.="<td  class='text-center'>".wordwrap($v->judul,50,"<br/>")."</td>";
                    $str .= $str_view;
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmpJml . ">" . $v->jml . " Group User</a></td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' title='Diedit oleh : $v->up_by' >" . $v->cr_by . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' title='Diedit : $v->up_dt'>" . $v->cr_dt . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='$val_link' download='$rename' target='_blank' class='text-primary btn btn-sm' title='Unduh Data'><i class='fas fa-download text-primary'></i></a></td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmped . " class='text-warning btn btn-sm' title='Edit Data'><i class='text fas fa-pencil-alt text-warning'></i></a></td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmp . " class='text-danger btn btn-sm' title='Hapus Data'><i class='text fas fa-trash-alt text-danger'></i></a></td>";
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
                // $sql="SELECT B.* FROM `tbl_user_group` B WHERE 1=1";
                $sql = "SELECT B.*,C.groupid 
                        FROM `tbl_user_group` B
                        LEFT JOIN  `t_doc_kab_groupuser` C ON B.id = C.groupid AND C.docid=?
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
                        //                        $content_k.="<td style=''><input type='checkbox' class='checkbox data-id='".$g->id."'' name='checkbox'  value='".$g->id."'/></td>";
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
                $sql_t = "SELECT G.*,T.tahap 
                        FROM `tbl_group_tahap` G 
                        LEFT JOIN `t_doc_tahap_kab` T ON G.id = T.tahap AND T.docid=?
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

    /*
     * add tag group
     * author : FSM
     * date : 11 jan 2021
     */
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
                    $this->m_ref->setTableName("t_doc_kab_groupuser");
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

                    //get list Group
                    $sql = "SELECT B.*,C.groupid 
                            FROM `tbl_user_group` B
                            LEFT JOIN  `t_doc_kab_groupuser` C ON B.id = C.groupid AND C.docid=?
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
                    $this->m_ref->setTableName("t_doc_kab_groupuser");
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

                    //get list Group
                    $sql = "SELECT B.*,C.groupid 
                                FROM `tbl_user_group` B
                                LEFT JOIN  `t_doc_kab_groupuser` C ON B.id = C.groupid AND C.docid=?
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
     * delete data dokumen Kab/kota
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
                $sql = "SELECT id,kabid, judul FROM t_doc_kab WHERE id=" . $id;

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
     * insert data Dokumen Kab/Kota
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

                $this->form_validation->set_rules('id', 'ID Kab/kota', 'required|xss_clean');
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

                $inp_nm     = $this->input->post("nama");

                //upload file dokumen
                $inp_urldoc = "";
                if (file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/kabkota/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
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
                $sql = "SELECT id, judul nm FROM t_doc_kab WHERE kabid=? AND judul=? AND isactive = 'Y'";
                $bind = array($idmap, $inp_nm);
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
                $this->m_ref->setTableName("t_doc_kab");
                $data_baru = array(
                    "kabid"    => $idmap,
                    "jenisid"      => '19',
                    "judul"      => $inp_nm,
                    "tautan"    => $inp_urldoc,
                    "isactive"  => 'Y',
                    "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"     => $current_date_time,
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
     * update data Kab
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

                $this->form_validation->set_rules('id', 'ID Kab', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }


                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid IDd");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];

                $inp_nm     = $this->input->post("nama");

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
                    $inp_urldoc = "";
                    if (file_exists($_FILES['filedok']['tmp_name']) && is_uploaded_file($_FILES['filedok']['tmp_name'])) {
                        //UPLOAD documents
                        $config['upload_path'] = './attachments/kabkota/';
                        $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
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
                    $this->m_ref->setTableName("t_doc_kab");
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
                    $this->m_ref->setTableName("t_doc_kab");
                    $data_baru = array(
                        "judul"      => $inp_nm,
                        "up_dt"      => $current_date_time,
                        "up_by"      =>  $this->session->userdata(SESSION_LOGIN)->userid
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
     * update data Kab
     * author : FSM 
     * date : 30 des 2020
     */
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

                $this->form_validation->set_rules('id', 'ID Kab', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Nama File', 'required|xss_clean');

                $this->form_validation->set_rules('judul', 'Judul Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('deskripsi', 'Deskripsi Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('input', 'Input Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('proses', 'Proses Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('output', 'Output Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('outcome', 'Outcome Inovasi', 'required|xss_clean');
                $this->form_validation->set_rules('tagInovasi[]', 'Tag Inovasi', 'required');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('_', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid IDd");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];

                $inp_nm     = $this->input->post("nama");

                $judul       = $this->input->post('judul');
                $deskripsi   = $this->input->post('deskripsi');
                $input       = $this->input->post('input');
                $proses      = $this->input->post('proses');
                $output      = $this->input->post('output');
                $outcome     = $this->input->post('outcome');
                $tagInovasi  = $this->input->post('tagInovasi');

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
                    $inp_urldoc = "";
                    if (file_exists($_FILES['filedok']['tmp_name']) && is_uploaded_file($_FILES['filedok']['tmp_name'])) {
                        //UPLOAD documents
                        $config['upload_path'] = './attachments/kabkota/';
                        $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
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
                    $this->m_ref->setTableName("t_doc_kab");
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

                    //update
                    $this->m_ref->setTableName("t_doc_kab");
                    $data_baru = array(
                        "judul"      => $inp_nm,
                        "up_dt"      => $current_date_time,
                        "up_by"      =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $idmap,
                    );
                    $status_save = $this->m_ref->update($cond, $data_baru);
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
                    throw new Exception("Invalid ID #2");
                $kate_iselect = $tmp1[0];
                $idgrp        = $tmp1[1];
                if (!is_numeric($idgrp))
                    throw new Exception("Invalid ID Tahap");

                if ($kate_iselect == "hapus") {
                    $this->m_ref->setTableName("t_doc_tahap_kab");
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
                            LEFT JOIN `t_doc_tahap_kab` T ON G.id = T.tahap AND T.docid=?
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
                    $this->m_ref->setTableName("t_doc_tahap_kab");
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
                            LEFT JOIN `t_doc_tahap_kab` T ON G.id = T.tahap AND T.docid=?
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
     * Download zip Tahap 3
     * author :  FSM
     * date : 17 Feb 2021
     */
    function d_bahan()
    {
        $this->zip->compression_level = 9;

        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }
        $idcomb = decrypt_base64($_GET['wl']);
        $tmp = explode('-', $idcomb);

        if (count($tmp) != 2) {
            echo 'Invalid ID';
            exit();
        }
        $kate_wlyh  = $tmp[0];
        $idwlyh     = $tmp[1];

        $_arr = array("prov", "kab", "KOTA");
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
        if ($kate_wlyh == "prov") {
            /*
                     * check data KAB / KOTA - start
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
                $msg = $session->userid . " " . $this->router->fetch_class() . " : Kab/Kota ID : " . $idwlyh . " not found";
                log_message("error", $msg);
                throw new Exception("Data Kabupaten / Kota tidak ditemukan!");
            }
            foreach ($list_data->result() as $k) {
                $name = $k->nama_provinsi;
            }
            $filename = "Dokumen_" . $name . ".zip";
            /*
                     * check data KAB / KOTA - end
                     */

            //get LIST tautan doc

            $sql = "SELECT D.`id` mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml 
                            FROM `t_doc_prov` D
                            JOIN `provinsi` P ON P.`id`=D.provid
                            LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_prov_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                            LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id
                            WHERE D.provid =?  AND D.isactive = 'Y' ";
            $bind = array($idwlyh);
            $list_data = $this->db->query($sql, $bind);
            if (!$list_data) {
                $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                log_message("error", $msg);
                throw new Exception("Invalid SQL!");
            }
        } elseif ($kate_wlyh == "kab" || $kate_wlyh == "KOTA") {
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
            $filename = "dokumen_Daerah_" . $name . ".zip";
            /*
                     * check data KAB / KOTA - end
                     */

            //get LIST tautan doc
            //                        $sql = "SELECT D.`id` mapid, D.judul, D.filename
            //                            FROM `t_doc_penilaian_kk` D
            //                            JOIN `provinsi` P ON P.`id`=D.provid
            //                            WHERE D.provid =? AND D.isactive = 'Y' ";
            $sql = "SELECT D.`id` mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml 
                            FROM `t_doc_kab` D
                            JOIN `kabupaten` P ON P.`id`=D.kabid
                            LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_kab_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                            LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id
                            WHERE D.kabid =? AND D.isactive = 'Y' ";
            $bind = array($idwlyh);
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
            $filepath1 = FCPATH . 'attachments/kabkota/' . $v->tautan;

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

            $file_contents = $this->zip->read_file($filepath1, $rename);
            $filepath = $v->tautan;
            $filedata[] = $filepath;
        }

        $this->zip->download($filename);
    }

    function get_spesifikdokumen()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            session_write_close();
            throw new Exception("Session expired, please login", 2);
        };
        $sql = "SELECT P.id, P.nama, P.jndok, S.jumlah FROM tbl_jenis_doc AS P JOIN ( SELECT jenisid,COUNT(*) AS jumlah FROM `t_doc_kab` WHERE isactive='Y' AND judul like '%kabupaten%' GROUP BY jenisid ) AS S ON P.id = S.jenisid";
        $dokumen = $this->db->query($sql)->result_array();
        echo json_encode($dokumen);
    }

    function unduhspesifik() {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            session_write_close();
            throw new Exception("Session expired, please login", 2);
        }
    
        $file = $this->input->post('id');
        $part = (int)$this->input->post('part'); // Get the part number
        $limit = 25; // Number of documents per part
        $offset = ($part - 1) * $limit; // Calculate offset
    
        $sql = "SELECT tbl_jenis_doc.nama, t_doc_kab.judul, t_doc_kab.tautan 
                FROM t_doc_kab 
                JOIN tbl_jenis_doc ON t_doc_kab.jenisid=tbl_jenis_doc.id 
                WHERE t_doc_kab.isactive = 'Y' 
                AND t_doc_kab.judul LIKE '%kabupaten%' 
                AND t_doc_kab.jenisid=$file 
                LIMIT $limit OFFSET $offset"; // Limit and offset for pagination
    
        $data = $this->db->query($sql)->result_array();
    
        if (empty($data)) {
            throw new Exception("No documents found for this part", 5);
        }
    
        $namafile = $data[0]['nama'] . '_kabupaten_part' . $part . '.zip'; // Change filename to include part number
        $zipFilePath = FCPATH . 'attachments/kabkota/' . $namafile;
        $zip = new ZipArchive();
        
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            throw new Exception("Cannot open ZIP file", 3);
        }
    
        foreach ($data as $item) {
            $filePath = FCPATH . 'attachments/kabkota/' . $item['tautan'];
            if (file_exists($filePath)) {
                $extensi = pathinfo($item['tautan'], PATHINFO_EXTENSION);
                $judul = $item['judul'] . '.' . $extensi;
                $zip->addFile($filePath, $judul);
            }
        }
    
        $zip->close();
    
        if (file_exists($zipFilePath)) {
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $namafile . '"');
            readfile($zipFilePath);
            unlink($zipFilePath); // Remove the zip file after download
        } else {
            throw new Exception("Failed to create ZIP file", 4);
        }
    }

    function d_bahaninovasi()
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap User');

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

        $this->excel->getActiveSheet()->setCellValue("A1", "NO");
        $this->excel->getActiveSheet()->setCellValue("B1", "NAMA PROVINSI");
        $this->excel->getActiveSheet()->setCellValue("C1", "NAMA INOVASI");
        $this->excel->getActiveSheet()->setCellValue("D1", "DESKRIPSI");
        $this->excel->getActiveSheet()->setCellValue("E1", "INPUT");
        $this->excel->getActiveSheet()->setCellValue("F1", "PROSES");
        $this->excel->getActiveSheet()->setCellValue("G1", "OUTPUT");
        $this->excel->getActiveSheet()->setCellValue("H1", "OUTCOME");
        $this->excel->getActiveSheet()->setCellValue("I1", "TAG");

        //---------------isi disini--------------------


        $sql = "SELECT inov.*, kab.nama_kabupaten
                FROM `t_doc_kab_inov` inov
                JOIN t_doc_kab k ON k.id = inov.id_doc_kab
                JOIN kabupaten kab ON kab.id = k.kabid";

        $list_data = $this->db->query($sql);
        if (!$list_data) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        //---------end isi disini----------------------

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 2;
        $no = 1;

        foreach ($list_data->result() as $value) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nama_kabupaten);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nama_inovasi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->deskripsi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->input);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->proses);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->output);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->outcome);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->tag);
            $index_excelColumn = 0;
            $no++;
            $row++;
        }
        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("27");
        //font
        $this->excel->getActiveSheet()->getStyle('A1:D1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_inovasi_kabupaten.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
