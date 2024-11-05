<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD7_bahan_dukung_tpt extends CI_Controller
{
    var $view_dir   = "ppd7/PPD7_bahan_dukung/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd3/PPD3_bahan_dukung/PPD3_bahan_dukung.js";
    var $allowed    = array("PPD7");
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
                $this->js_path    = "assets/js/ppd7/PPD7_bahan_dukung/bahan_dukung_tpt.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_bahan_tpt", $data_page, TRUE);

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
     *  Tahab 2                                                   - START
     * =========================================================================
     */

    /*
     * list data Bahan Dokumen Tahap 2
     * author :  FSM
     * date : 23 jan 2021
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

                $satker = $this->session->userdata(SESSION_LOGIN)->satker;
                //                    $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml 
                //                    FROM `t_doc` D  
                //                    LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                //                    LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
                //                    WHERE D.isactive = 'Y'";
                $sql = "SELECT * FROM (
                SELECT '1' kate, D.id mapid, D.judul, D.tautan, D.cr_dt, D.cr_by, D.up_dt, D.up_by, G.jml, 'Sekretariat PPD'  graoup 
                                    FROM `t_doc` D  
                                    LEFT JOIN(SELECT COUNT(A.id) AS jml,A.docid,A.groupid FROM `t_doc_groupuser` A WHERE 1=1 GROUP BY A.docid) G ON D.id = G.docid 
                                    LEFT JOIN(SELECT B.* FROM `tbl_user_group` B WHERE 1=1) U ON G.`groupid` = U.id 
                                    WHERE D.isactive = 'Y') AS a
                                    UNION
                                    SELECT * FROM (
                SELECT '2' kate ,PK.id mapid, PK.judul, PK.tautan,PK.cr_dt, PK.cr_by, PK.up_dt, PK.up_by, '0' jml, 'Tim Provinsi'  graoup 
                FROM `t_dok_pkk` PK 
                WHERE PK.isactive = 'Y' AND PK.provid=$satker) AS b
                ORDER BY kate, mapid ASC";
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
                        $str_view = "<td class='text' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'doc') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".docx";
                        $str_view = "<td class='text' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'docx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".docx";
                        $str_view = "<td class='text' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'xlsx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".xlsx";
                        $str_view = "<td class='text' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'xls') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".xls";
                        $str_view = "<td class='text' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $tmp_v .= " data-nmlink='" . $val_link . "'";
                        $rename = $v->judul . ".jpeg";
                        $str_view = "<td class='text' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $tautan = "https://view.officeapps.live.com/op/embed.aspx?src=" . $val_link . "&embedded=true";
                        $tmp_v .= " data-nmlink='" . $tautan . "'";
                        $rename = $v->judul . ".pptx";
                        $str_view = "<td class='text' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } elseif (substr($v->tautan, -3) == 'mp4') {
                        $tmp_v .= " data-nmlink='" . $val_link . "'";
                        $rename = $v->judul . ".mp4";
                        $str_view = "<td class='text' >" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    } else {
                        $rename = $v->judul;
                        $str_view = "<td  class='text'><a style='font-size: 12px;' class='btn btn-xs text-secondary text-left'>" . wordwrap($v->judul, 50, "<br/>") . "</a></td>";
                    }
                    // $str .= "<tr class='bg-secondary' >";
                    $str .= "<tr class='' >";
                    $str .= "<td class='text-right'>" . $no++ . "</td>";
                    //$str.="<td  class='text'>".wordwrap($v->judul,50,"<br/>")."</td>";
                    $str .= $str_view;
                    
                    $str .= "<td  class='text' title='Diedit oleh : $v->up_by' >" . $v->cr_by . "</td>";
                    $str .= "<td  class='text' title='Diedit : $v->up_dt'>" . $v->cr_dt . "</td>";
                    $str .= "<td  class=''><a href='$val_link' download='$namefile' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                    

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
    /* author :  FSM
     * date : 17 Feb 2021
     */
    function d_bahan()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        $userid = $this->session->userdata(SESSION_LOGIN)->userid;
        $nama = $this->session->userdata(SESSION_LOGIN)->name;
        $group = $this->session->userdata(SESSION_LOGIN)->group;
        date_default_timezone_set("Asia/Jakarta");
        $current_date_time = date("Y_m_d_H_i_s");
        $link = base_url() . "attachments/bahandukung/";
        //                    $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt "
        //                            . "FROM `t_doc` D  "
        //                            . "JOIN `t_doc_groupuser` G ON D.id = G.docid "
        //                            . "JOIN `tbl_user_group` U ON G.`groupid` = U.id AND U.id=? "
        //                            . "JOIN `t_doc_tahap` T ON D.id= T.docid AND T.tahap=2 "
        //                            . "WHERE D.isactive = 'Y'";

        $sql = "SELECT  1 AS `no`,D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt 
                            FROM `t_doc` D  
                            JOIN `t_doc_groupuser` G ON D.id = G.docid 
                            JOIN `tbl_user_group` U ON G.`groupid` = U.id 
                            WHERE U.id=? AND D.isactive = 'Y'";

        $bind = array($group);
        $list_data = $this->db->query($sql, $group);
        if ($list_data->num_rows() == 0) {
            echo 'Bahan Dukung tidak ada';
            exit();
        }

        foreach ($list_data->result() as $v) {
            //                        if(substr($v->tautan,0, 5)=='https'){ $file       =substr($v->tautan,61, 500); }
            //                        else { $file       =substr($v->tautan,60, 500); }
            $file       = $v->tautan;

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

            $filepath1 = FCPATH . 'attachments/bahandukung/' . $file;

            $this->zip->read_file($filepath1, $rename);

            $filepath = $v->tautan;
            $filedata[] = $filepath;
        }
        // Download
        $filename = "bahan_dukung_tpt_.zip";
        $this->zip->download($filename);
    }
}
