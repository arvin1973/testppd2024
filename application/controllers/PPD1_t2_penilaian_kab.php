<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD1_t2_penilaian_kab extends CI_Controller
{
    var $view_dir   = "ppd1/penilaian_tpitpu/";
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
                $this->js_path    = "assets/js/ppd1/penilaian_tpitpu/penilaian_kab_t2.js?v=" . now("Asia/Jakarta");

                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_kab_t2", $data_page, TRUE);

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

                $sql = "SELECT 	'2' kate,K.`id` 'mapwil', K.`id_kab`, K.`nama_kabupaten`,W.iduser, W.id kodewil, 'Tahap II' tahap
                                FROM  `kabupaten` K 
                                LEFT JOIN `tbl_user_t2_kabkot` W ON W.idkabkot = K.id
                                WHERE W.iduser!='' AND K.urutan='0' GROUP BY K.id
                ORDER BY K.id_kab";

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";
                $no = 1;
                $lnk = 'https';
                foreach ($list_data->result() as $v) {
                    $idwil = "PROV-" . $v->mapwil;

                    $encrypted_id = base64_encode(openssl_encrypt($idwil, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->nama_kabupaten . "'";
                    $str .= "<tr class='' title='Dokumen'>";
                    $str .= "<td width='7%' class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                    $str .= "<td width='93%' class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmp . ">" . $v->nama_kabupaten . "</a></td>";
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
     * Detail Dokumen Penilaian Tahap II
     * author : FSM 
     * date : 24 feb 2021
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

                //jml aspek
                $sql = "SELECT A.`id` FROM r_mdl2_aspek A WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_aspek = $list_data->num_rows();

                //get jml item
                $sql = "SELECT DISTINCT SI.indiid FROM r_mdl2_sub_indi SI WHERE 1=1 ORDER BY SI.indiid";

                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL2!");
                }
                $jml_item = $list_data->num_rows();

                // $sql = "SELECT 'KAB' kate,A.`id` mapid,P.`nama_kabupaten` nmkab,A.*, B.userid, B.name,C.judul, C.tautan
                //                 ,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                //         FROM `tbl_user_t2_kabkot` A
                //         JOIN `kabupaten` P ON P.`id`=A.`idkabkot`
                //         LEFT JOIN(
                //             SELECT W.idkabkot ìdkab,SKR.`mapid`, COUNT(1) jml
                //             FROM `tbl_user_t2_kabkot` W
                //             left JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                //             left JOIN `r_mdl2_item` II ON II.`id`= SKR.`itemindi`
                //             WHERE 1=1 
                //             GROUP BY SKR.`mapid`
                //         ) JML ON JML.mapid=A.`id`
                //         LEFT JOIN(
                //             SELECT W.idkabkot ìdkab, RK.`mapid`, COUNT(1) jml
                //             FROM `tbl_user_t2_kabkot` W
                //             left JOIN `t_mdl2_resume_kabkota` RK ON RK.`mapid`=W.`id` AND RK.`stts`='Y'
                //             WHERE 1=1
                //             GROUP BY RK.`mapid`
                //         )RS ON RS.mapid=A.`id`
                //         LEFT JOIN `tbl_user` B ON A.iduser=B.id AND B.group=3 AND B.active_flag ='Y'
                //         LEFT JOIN `t_doc_tahap_penilaian_kabkota` C ON A.id = C.kbko AND C.isactive='Y'
                //         LEFT JOIN `t_mdl2_sttment_kabkota` ST ON ST.`mapid`=A.`id`
                //         WHERE A.idkabkot=? AND B.group=3 AND B.active_flag ='Y' 
                //         GROUP BY B.userid ";

                $sql = "SELECT 'KAB' kate,A.`id` mapid,P.`nama_kabupaten` nmkab,A.*, B.userid, B.name,C.judul, C.tautan
                                ,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                        FROM `tbl_user_t2_kabkot` A
                        JOIN `kabupaten` P ON P.`id`=A.`idkabkot`
                        LEFT JOIN(
                            SELECT W.idkabkot ìdkab,SKR.`mapid`, COUNT(1) jml
                            FROM `tbl_user_t2_kabkot` W
                            left JOIN `t_mdl2_skor_indi_k` SKR ON SKR.mapid=W.id
                            left JOIN `r_mdl2_item` II ON II.`id`= SKR.indi
                            WHERE 1=1 
                            GROUP BY SKR.`mapid`
                        ) JML ON JML.mapid=A.`id`
                        LEFT JOIN(
                            SELECT W.idkabkot ìdkab, RK.`mapid`, COUNT(1) jml
                            FROM `tbl_user_t2_kabkot` W
                            left JOIN `t_mdl2_resume_kabkota` RK ON RK.`mapid`=W.`id` AND RK.`stts`='Y'
                            WHERE 1=1
                            GROUP BY RK.`mapid`
                        )RS ON RS.mapid=A.`id`
                        LEFT JOIN `tbl_user` B ON A.iduser=B.id AND B.group=3 AND B.active_flag ='Y'
                        LEFT JOIN `t_doc_tahap_penilaian_kabkota` C ON A.id = C.kbko AND C.isactive='Y'
                        LEFT JOIN `t_mdl2_sttment_kabkota` ST ON ST.`mapid`=A.`id`
                        WHERE A.idkabkot=? AND B.group=3 AND B.active_flag ='Y' 
                        GROUP BY B.userid ";

                $bind = array($iddok);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='8'>Data tidak ditemukan</td></tr>";
                $no = 1;
                $sts = '';
                $unduh = '';
                foreach ($list_data->result() as $v) {
                    $status_link = base_url() . "attachments/penilaian_tpitpu/" . $v->tautan;
                    $idcomb = $v->kate . "-" . $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='btn btn-sm btn-primary waves-effect waves-light getDetail' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-nmpkk='" . $v->nmkab . "'";

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
                    } elseif (substr($v->tautan, -4) == 'jpeg') {
                        $rename = $v->judul . ".jpeg";
                    } elseif (substr($v->tautan, -4) == 'pptx') {
                        $rename = $v->judul . ".pptx";
                    } else {
                        $rename = $v->judul;
                    }

                    $status = $v->tautan;
                    if ($status == '') {
                        $sts   = "<a href='javascript:void(0);' class='getSttmnt' data-id='' title='belum lengkap'><i class='fas fa-exclamation-circle fa-2x text-pink'></i></a>";
                    } else {
                        $sts  = "<a href='$status_link' download='$rename' t]arget='_blank' class='getSttmnt' data-id='' title='Lengkap'><i class='fas fa-check-circle fa-2x text-success'></i></a>";
                    }

                    $str .= "<tr class='' >";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                    // $str .= "<td class='text'>" . $v->name . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black' title='" . $v->name . "'>" . wordwrap($v->name, 30, "<br/>") . "</td>";
                    // $str .= "<td class='text'>" . wordwrap($v->judul, 18, "<br/>") .  "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . wordwrap($v->judul, 18, "<br/>") . "</td>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><center>" . $sts . "</center></td>";

                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>";
                    $prcntg = $jml_item == 0 ? 0 : $v->jml / $jml_item * 100;
                    if ($prcntg == 100) {
                        $str_tmp = " " . $tmp . "class='btn btn-sm btn-warning waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                        $str_icon = "Data resume aspek<br> belum lengkap (" . number_format($prcntg, 2) . "%)<i class='fas fa-exclamation'></i>";
                        if ($v->jml_rsm == $jml_aspek) {
                            if (!is_null($v->stts)) {
                                $str_tmp = " " . $tmp . " class='btn btn-outline-purple waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='klik untuk Unduh Nilai' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                $str_icon = "Unduh Nilai <i class='fas fa-check-circle'></i>";
                            } else {
                                $str_tmp = " " . $tmp . "class='btn btn-outline-danger waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                                $str_icon = "Belum mengisi<br> lembar pernyataan (" . number_format($prcntg, 2) . "%)<i class='fas fa-check-circle'></i>";
                            }
                        }
                        $str .= "<a href='javascript:void(0);' " . $str_tmp . ">" . $str_icon . "</a>";
                    } else {
                        $str .= "<a href='javascript:void(0)'  class='btn btn-outline-primary waves-effect waves-light btn-status getDetail' data-id='" . $encrypted_id . "' data-nmpkk='" . $v->nmkab . "' style='border-radius: 0px; padding-left: 10px;' >Belum menyelesaikan<br> penilaian (" . number_format($prcntg, 2) . "%) <i class='fas fa-exclamation' style='padding-left: 5px;'></i></a>";
                    }

                    $str .= "</td></tr>";
                }

                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "str"       => $str,
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


        date_default_timezone_set("Asia/Jakarta");
        $current_date_time = date("Y_m_d_H_i_s");

        $sql_p = "SELECT * FROM kabupaten where id=?";
        $bind_p = array($idwlyh);
        $list_p = $this->db->query($sql_p, $bind_p);
        foreach ($list_p->result() as $p) {
            $nmprov = $p->nama_kabupaten;
        }

        //$link =base_url()."attachments/bahandukung/";
        // $sql = "SELECT A.*, B.userid, B.name,C.judul, C.tautan
        //             FROM `tbl_user_wilayah` A 
        //             LEFT JOIN `tbl_user` B ON A.iduser=B.id AND B.group=3 
        //             LEFT JOIN `t_doc_tahap_penilaian_prov` C ON A.id = C.mapid AND C.isactive='Y'
        //             WHERE A.idwilayah=? ";
        $sql = " SELECT A.*, B.userid, B.name,C.judul, C.tautan
                    FROM `tbl_user_t2_kabkot` A 
                    LEFT JOIN `tbl_user` B ON A.iduser=B.id AND B.group=3 AND B.active_flag ='Y'
                    LEFT JOIN `t_doc_tahap_penilaian_kabkota` C ON A.id = C.kbko AND C.isactive='Y'
                    WHERE A.idkabkot=? AND B.group=3 AND B.active_flag ='Y' AND C.tahap='2'";

        $bind = array($idwlyh);
        $list_data = $this->db->query($sql, $bind);
        if ($list_data->num_rows() == 0) {
            echo 'Tidak ada data upload penilaian';
            exit();
        }

        foreach ($list_data->result() as $v) {
            // if (substr($v->tautan, 0, 5) == 'https') {
            //     $file       = substr($v->tautan, 61, 500);
            // } else {
            //     $file       = substr($v->tautan, 60, 500);
            // }

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
            } elseif (substr($v->tautan, -3) == 'xls') {
                $rename = $v->judul . ".xls";
            } elseif (substr($v->tautan, -4) == 'xlsx') {
                $rename = $v->judul . ".xlsx";
            } elseif (substr($v->tautan, -4) == 'jpeg') {
                $rename = $v->judul . ".jpeg";
            } elseif (substr($v->tautan, -4) == 'pptx') {
                $rename = $v->judul . ".pptx";
            } else {
                $rename = $v->judul;
            }

            $filepath1 = FCPATH . 'attachments/penilaian_tpitpu/' . $v->tautan;

            $this->zip->read_file($filepath1, $rename);

            $filepath = $v->tautan;
            $filedata[] = $filepath;
        }
        // Download
        $filename = "penilaian_tahap_II_" . $nmprov . ".zip";
        $this->zip->download($filename);
    }

    function Download_nilai()
    {

        if (!$this->session->userdata(SESSION_LOGIN)) {
            echo 'Invalid Token, silakan ulangi login ke aplikasi';
            exit();
        }
        $idcomb = decrypt_base64($_GET['token']);
        $tmp = explode('-', $idcomb);
        if (count($tmp) != 2) {
            echo 'Invalid ID';
            exit();
        }
        $kate_wlyh = $tmp[0];
        $idwil = $tmp[1];
        $_arr = array("PROV", "KAB", "KOT");
        if (!in_array($kate_wlyh, $_arr)) {
            echo 'InvaliD Kategori Wilayah';
            exit(); //   throw new Exception("InvaliD Kategori Wilayah");
        }

        $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid, U.name
                    FROM `tbl_user_t2_kabkot` W
                    JOIN `kabupaten` P ON W.idkabkot = P.id
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE  W.id='$idwil'";

        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nama  = $d->name;
            $user_d = $d->userid;
            $namakab = $d->nama_kabupaten;
        }
        //list indikator skor
        // $status_sql = "SELECT A.id idaspek, A.nama nmaspek,A.bobot bbaspek,K.id nokr,K.`nama` nmkriteria,   IT.`nourut` nr,IND.nourut,IND.nourut noindi,IND.`nama` nmindi,IND.`bobot` bbindi,
        //     SI.id idsub,SI.`nama` nmsubindi,SI.`nama` nmsubindi,IT.`nama` nmitem,
        //     IND.bobot,RES.ksmplan, RES.saran,SK.`id` isskor, SK.skor skr,IJ.nama nmjdl,JDL.`judl`
        //                 FROM `r_mdl2_item` IT
        //                 JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid`
        //                         JOIN `r_mdl2_indi` IND ON IND.`id`=SI.`indiid`
        //                         LEFT JOIN `r_mdl2_item_judul` IJ ON IJ.`indiid` = IND.`id`
        //                         JOIN `r_mdl2_krtria` K ON K.`id`=IND.`krtriaid`
        //                         JOIN `r_mdl2_aspek` A ON A.id = K.aspekid
        //                         LEFT JOIN `t_mdl2_resume_kabkota` RES ON RES.`aspekid` = A.id AND RES.mapid ='$idwil'
        //                             LEFT JOIN `t_mdl2_judul_kabkota` JDL ON JDL.judlid = IJ.id AND JDL.mapid ='$idwil'
        //                         LEFT JOIN `t_mdl2_skor_k` SK ON SK.`itemindi` = IT.id AND SK.mapid ='$idwil'
        //                         ORDER BY K.id, IND.nourut, IT.`nourut` ASC ";
        $status_sql = "SELECT K.id nokr,K.`nama` nmkriteria,
                                IND.nourut noindi,IND.`nama` nmindi,
                                A.id idaspek, A.nama nmaspek,A.bobot bbaspek, 
                                IT.`nourut` nr,IND.nourut,IND.`bobot` bbindi, SI.id idsub,SI.`nama` nmsubindi,SI.`nama` nmsubindi,IT.`nama` nmitem, IND.bobot,RES.ksmplan, RES.saran,SK.`id` isskor, SK.skor skr
                                ,IJ.nama nmjdl,JDL.`judl`
                                FROM `r_mdl2_item` IT
                                JOIN `r_mdl2_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.`isprov` = 'N'
                                JOIN `r_mdl2_indi` IND ON IND.`id`=SI.`indiid`
                                LEFT JOIN `r_mdl2_item_judul` IJ ON IJ.`indiid` = IND.`id`
                                JOIN `r_mdl2_krtria` K ON K.`id`=IND.`krtriaid`
                                JOIN `r_mdl2_aspek` A ON A.id = K.aspekid
                                LEFT JOIN `t_mdl2_resume_kabkota` RES ON RES.`aspekid` = A.id AND RES.mapid ='$idwil'
                                LEFT JOIN `t_mdl2_judul_kabkota` JDL ON JDL.judlid = IJ.id AND JDL.mapid ='$idwil'
                                LEFT JOIN `t_mdl2_skor_indi_k` SK ON SK.`indi` = IND.id AND SK.mapid ='$idwil'
                                ORDER BY K.`id`, IND.nourut, IT.`nourut`, IT.`id` ASC ";

        $list_data  = $this->db->query($status_sql);

        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Nilai');




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
        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2024");
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A2', "Modul 2 Wawancara Dan Verifikasi");

        $this->excel->getActiveSheet()->mergeCells('A2:K2');

        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:L277');

        $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
        $this->excel->getActiveSheet()->mergeCells('A4:B4');
        $this->excel->getActiveSheet()->setCellValue('C4', ":");
        $this->excel->getActiveSheet()->setCellValue('A5', "Daerah Yang Dinilai ");
        $this->excel->getActiveSheet()->mergeCells('A5:B5');
        $this->excel->getActiveSheet()->setCellValue('C5', ":");
        $this->excel->getActiveSheet()->setCellValue('D4', "$nama");
        $this->excel->getActiveSheet()->setCellValue('D5', "$namakab");
        $this->excel->getActiveSheet()->mergeCells('A2:B2');
        $this->excel->getActiveSheet()->mergeCells('A3:B3');


        $this->excel->getActiveSheet()->setCellValue("A10", "NO");
        $this->excel->getActiveSheet()->mergeCells('A10:A11');
        $this->excel->getActiveSheet()->setCellValue("B10", "KRITERIA");
        $this->excel->getActiveSheet()->mergeCells('B10:B11');

        $this->excel->getActiveSheet()->setCellValue("C10", "INDIKATOR");
        $this->excel->getActiveSheet()->mergeCells('C10:D11');
        $this->excel->getActiveSheet()->setCellValue("E10", "ITEM");
        $this->excel->getActiveSheet()->mergeCells('E10:F11');
        $this->excel->getActiveSheet()->setCellValue("G10", "ITEM DI NILAI");
        $this->excel->getActiveSheet()->mergeCells('G10:G11');
        $this->excel->getActiveSheet()->setCellValue("H10", "KEUNGGULAN DAERAH");
        $this->excel->getActiveSheet()->mergeCells('H10:H11');
        $this->excel->getActiveSheet()->setCellValue("I10", "REKOMENDASI");
        $this->excel->getActiveSheet()->mergeCells('I10:I11');
        $this->excel->getActiveSheet()->setCellValue("J10", "NILAI");
        $this->excel->getActiveSheet()->mergeCells('J10:J11');
        $this->excel->getActiveSheet()->setCellValue("K10", "BOBOT");
        $this->excel->getActiveSheet()->mergeCells('K10:K11');
        $this->excel->getActiveSheet()->setCellValue("L10", "NILAI TERBOBOT");
        $this->excel->getActiveSheet()->mergeCells('L10:L11');
        $this->excel->getActiveSheet()->setCellValue("A277", "TOTAL");

        //list indikator skor

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 12;
        $nol = '';
        foreach ($list_data->result() as $value) {
            if ($value->nmjdl != '') {
                $judul = $value->nmjdl . ' : ' . $value->judl;
            } else {
                $judul = '';
            }
            if ($value->nmindi == "Ketimpangan Antar Kelompok Pendapatan (Gini Rasio) dan  Ketimpangan regional") {
                $value->nmindi = "Ketimpangan Antar Kelompok Pendapatan (Gini Rasio)";
            }
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nr);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $judul);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skr);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran);
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, '');
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot / 100);
            // $this->excel->getActiveSheet()->getColumnDimension("F")->setWrapText(true);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr); //A
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria); //B
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi); //C
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi); //D
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nr); //E
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem); //F
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $judul); //G
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skr);//H
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan); //H
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran); //I
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skr); //J
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot / 100); //K
            $index_excelColumn = 0;
            $row++;
        }

        $this->excel->getActiveSheet()->mergeCells('A12:A151');
        $this->excel->getActiveSheet()->mergeCells('A152:A157');
        $this->excel->getActiveSheet()->mergeCells('A158:A162');
        $this->excel->getActiveSheet()->mergeCells('A163:A169');
        $this->excel->getActiveSheet()->mergeCells('A170:A176');
        $this->excel->getActiveSheet()->mergeCells('A177:A187');
        $this->excel->getActiveSheet()->mergeCells('A188:A205');
        $this->excel->getActiveSheet()->mergeCells('A206:A220');
        $this->excel->getActiveSheet()->mergeCells('A221:A231');
        $this->excel->getActiveSheet()->mergeCells('A232:A240');
        $this->excel->getActiveSheet()->mergeCells('A241:A276');

        $this->excel->getActiveSheet()->mergeCells('B12:B151');
        $this->excel->getActiveSheet()->mergeCells('B152:B157');
        $this->excel->getActiveSheet()->mergeCells('B158:B162');
        $this->excel->getActiveSheet()->mergeCells('B163:B169');
        $this->excel->getActiveSheet()->mergeCells('B170:B176');
        $this->excel->getActiveSheet()->mergeCells('B177:B187');
        $this->excel->getActiveSheet()->mergeCells('B188:B205');
        $this->excel->getActiveSheet()->mergeCells('B206:B220');
        $this->excel->getActiveSheet()->mergeCells('B221:B231');
        $this->excel->getActiveSheet()->mergeCells('B232:B240');
        $this->excel->getActiveSheet()->mergeCells('B241:B276');

        $this->excel->getActiveSheet()->mergeCells('C12:C26');
        $this->excel->getActiveSheet()->mergeCells('C27:C40');
        $this->excel->getActiveSheet()->mergeCells('C41:C54');
        $this->excel->getActiveSheet()->mergeCells('C55:C67');
        $this->excel->getActiveSheet()->mergeCells('C68:C81');
        $this->excel->getActiveSheet()->mergeCells('C82:C95');
        $this->excel->getActiveSheet()->mergeCells('C96:C109');
        $this->excel->getActiveSheet()->mergeCells('C110:C123');
        $this->excel->getActiveSheet()->mergeCells('C124:C137');
        $this->excel->getActiveSheet()->mergeCells('C138:C151');
        $this->excel->getActiveSheet()->mergeCells('C152:C157');
        $this->excel->getActiveSheet()->mergeCells('C158:C162');
        $this->excel->getActiveSheet()->mergeCells('C163:C169');
        $this->excel->getActiveSheet()->mergeCells('C170:C176');
        $this->excel->getActiveSheet()->mergeCells('C177:C187');
        $this->excel->getActiveSheet()->mergeCells('C188:C205');
        $this->excel->getActiveSheet()->mergeCells('C206:C220');
        $this->excel->getActiveSheet()->mergeCells('C221:C231');
        $this->excel->getActiveSheet()->mergeCells('C232:C240');
        $this->excel->getActiveSheet()->mergeCells('C241:C250');
        $this->excel->getActiveSheet()->mergeCells('C251:C260');
        $this->excel->getActiveSheet()->mergeCells('C261:C269');
        $this->excel->getActiveSheet()->mergeCells('C270:C276');

        $this->excel->getActiveSheet()->mergeCells('D12:D26');
        $this->excel->getActiveSheet()->mergeCells('D27:D40');
        $this->excel->getActiveSheet()->mergeCells('D41:D54');
        $this->excel->getActiveSheet()->mergeCells('D55:D67');
        $this->excel->getActiveSheet()->mergeCells('D68:D81');
        $this->excel->getActiveSheet()->mergeCells('D82:D95');
        $this->excel->getActiveSheet()->mergeCells('D96:D109');
        $this->excel->getActiveSheet()->mergeCells('D110:D123');
        $this->excel->getActiveSheet()->mergeCells('D124:D137');
        $this->excel->getActiveSheet()->mergeCells('D138:D151');
        $this->excel->getActiveSheet()->mergeCells('D152:D157');
        $this->excel->getActiveSheet()->mergeCells('D158:D162');
        $this->excel->getActiveSheet()->mergeCells('D163:D169');
        $this->excel->getActiveSheet()->mergeCells('D170:D176');
        $this->excel->getActiveSheet()->mergeCells('D177:D187');
        $this->excel->getActiveSheet()->mergeCells('D188:D205');
        $this->excel->getActiveSheet()->mergeCells('D206:D220');
        $this->excel->getActiveSheet()->mergeCells('D221:D231');
        $this->excel->getActiveSheet()->mergeCells('D232:D240');
        $this->excel->getActiveSheet()->mergeCells('D241:D250');
        $this->excel->getActiveSheet()->mergeCells('D251:D260');
        $this->excel->getActiveSheet()->mergeCells('D261:D269');
        $this->excel->getActiveSheet()->mergeCells('D270:D276');

        $this->excel->getActiveSheet()->mergeCells('G12:G26');
        $this->excel->getActiveSheet()->mergeCells('G27:G40');
        $this->excel->getActiveSheet()->mergeCells('G41:G54');
        $this->excel->getActiveSheet()->mergeCells('G55:G67');
        $this->excel->getActiveSheet()->mergeCells('G68:G81');
        $this->excel->getActiveSheet()->mergeCells('G82:G95');
        $this->excel->getActiveSheet()->mergeCells('G96:G109');
        $this->excel->getActiveSheet()->mergeCells('G110:G123');
        $this->excel->getActiveSheet()->mergeCells('G124:G137');
        $this->excel->getActiveSheet()->mergeCells('G138:G151');
        $this->excel->getActiveSheet()->mergeCells('G152:G157');
        $this->excel->getActiveSheet()->mergeCells('G158:G162');
        $this->excel->getActiveSheet()->mergeCells('G163:G169');
        $this->excel->getActiveSheet()->mergeCells('G170:G176');
        $this->excel->getActiveSheet()->mergeCells('G177:G187');
        $this->excel->getActiveSheet()->mergeCells('G188:G205');
        $this->excel->getActiveSheet()->mergeCells('G206:G220');
        $this->excel->getActiveSheet()->mergeCells('G221:G231');
        $this->excel->getActiveSheet()->mergeCells('G232:G240');
        $this->excel->getActiveSheet()->mergeCells('G241:G250');
        $this->excel->getActiveSheet()->mergeCells('G251:G260');
        $this->excel->getActiveSheet()->mergeCells('G261:G269');
        $this->excel->getActiveSheet()->mergeCells('G270:G276');

        $this->excel->getActiveSheet()->mergeCells('I12:I151');
        $this->excel->getActiveSheet()->mergeCells('I152:I176');
        $this->excel->getActiveSheet()->mergeCells('I177:I240');
        $this->excel->getActiveSheet()->mergeCells('I241:I276');

        $this->excel->getActiveSheet()->mergeCells('H12:H151');
        $this->excel->getActiveSheet()->mergeCells('H152:H176');
        $this->excel->getActiveSheet()->mergeCells('H177:H240');
        $this->excel->getActiveSheet()->mergeCells('H241:H276');

        $this->excel->getActiveSheet()->mergeCells('J12:J26');
        $this->excel->getActiveSheet()->mergeCells('J27:J40');
        $this->excel->getActiveSheet()->mergeCells('J41:J54');
        $this->excel->getActiveSheet()->mergeCells('J55:J67');
        $this->excel->getActiveSheet()->mergeCells('J68:J81');
        $this->excel->getActiveSheet()->mergeCells('J82:J95');
        $this->excel->getActiveSheet()->mergeCells('J96:J109');
        $this->excel->getActiveSheet()->mergeCells('J110:J123');
        $this->excel->getActiveSheet()->mergeCells('J124:J137');
        $this->excel->getActiveSheet()->mergeCells('J138:J151');
        $this->excel->getActiveSheet()->mergeCells('J152:J157');
        $this->excel->getActiveSheet()->mergeCells('J158:J162');
        $this->excel->getActiveSheet()->mergeCells('J163:J169');
        $this->excel->getActiveSheet()->mergeCells('J170:J176');
        $this->excel->getActiveSheet()->mergeCells('J177:J187');
        $this->excel->getActiveSheet()->mergeCells('J188:J205');
        $this->excel->getActiveSheet()->mergeCells('J206:J220');
        $this->excel->getActiveSheet()->mergeCells('J221:J231');
        $this->excel->getActiveSheet()->mergeCells('J232:J240');
        $this->excel->getActiveSheet()->mergeCells('J241:J250');
        $this->excel->getActiveSheet()->mergeCells('J251:J260');
        $this->excel->getActiveSheet()->mergeCells('J261:J269');
        $this->excel->getActiveSheet()->mergeCells('J270:J276');


        $this->excel->getActiveSheet()->mergeCells('K12:K26');
        $this->excel->getActiveSheet()->mergeCells('K27:K40');
        $this->excel->getActiveSheet()->mergeCells('K41:K54');
        $this->excel->getActiveSheet()->mergeCells('K55:K67');
        $this->excel->getActiveSheet()->mergeCells('K68:K81');
        $this->excel->getActiveSheet()->mergeCells('K82:K95');
        $this->excel->getActiveSheet()->mergeCells('K96:K109');
        $this->excel->getActiveSheet()->mergeCells('K110:K123');
        $this->excel->getActiveSheet()->mergeCells('K124:K137');
        $this->excel->getActiveSheet()->mergeCells('K138:K151');
        $this->excel->getActiveSheet()->mergeCells('K152:K157');
        $this->excel->getActiveSheet()->mergeCells('K158:K162');
        $this->excel->getActiveSheet()->mergeCells('K163:K169');
        $this->excel->getActiveSheet()->mergeCells('K170:K176');
        $this->excel->getActiveSheet()->mergeCells('K177:K187');
        $this->excel->getActiveSheet()->mergeCells('K188:K205');
        $this->excel->getActiveSheet()->mergeCells('K206:K220');
        $this->excel->getActiveSheet()->mergeCells('K221:K231');
        $this->excel->getActiveSheet()->mergeCells('K232:K240');
        $this->excel->getActiveSheet()->mergeCells('K241:K250');
        $this->excel->getActiveSheet()->mergeCells('K251:K260');
        $this->excel->getActiveSheet()->mergeCells('K261:K269');
        $this->excel->getActiveSheet()->mergeCells('K270:K276');

        $this->excel->getActiveSheet()->mergeCells('L12:L26');
        $this->excel->getActiveSheet()->setCellValue("L12", "=J12*K12");
        $this->excel->getActiveSheet()->mergeCells('L27:L40');
        $this->excel->getActiveSheet()->setCellValue("L27", "=J27*K27");
        $this->excel->getActiveSheet()->mergeCells('L41:L54');
        $this->excel->getActiveSheet()->setCellValue("L41", "=J41*K41");
        $this->excel->getActiveSheet()->mergeCells('L55:L67');
        $this->excel->getActiveSheet()->setCellValue("L55", "=J55*K55");
        $this->excel->getActiveSheet()->mergeCells('L68:L81');
        $this->excel->getActiveSheet()->setCellValue("L68", "=J68*K68");
        $this->excel->getActiveSheet()->mergeCells('L82:L95');
        $this->excel->getActiveSheet()->setCellValue("L82", "=J82*K82");
        $this->excel->getActiveSheet()->mergeCells('L96:L109');
        $this->excel->getActiveSheet()->setCellValue("L96", "=J96*K96");
        $this->excel->getActiveSheet()->mergeCells('L110:L123');
        $this->excel->getActiveSheet()->setCellValue("L110", "=J110*K110");
        $this->excel->getActiveSheet()->mergeCells('L124:L137');
        $this->excel->getActiveSheet()->setCellValue("L124", "=J124*K124");
        $this->excel->getActiveSheet()->mergeCells('L138:L151');
        $this->excel->getActiveSheet()->setCellValue("L138", "=J138*K138");
        $this->excel->getActiveSheet()->mergeCells('L152:L157');
        $this->excel->getActiveSheet()->setCellValue("L152", "=J152*K152");
        $this->excel->getActiveSheet()->mergeCells('L158:L162');
        $this->excel->getActiveSheet()->setCellValue("L158", "=J158*K158");
        $this->excel->getActiveSheet()->mergeCells('L163:L169');
        $this->excel->getActiveSheet()->setCellValue("L163", "=J163*K163");
        $this->excel->getActiveSheet()->mergeCells('L170:L176');
        $this->excel->getActiveSheet()->setCellValue("L170", "=J170*K170");
        $this->excel->getActiveSheet()->mergeCells('L177:L187');
        $this->excel->getActiveSheet()->setCellValue("L177", "=J177*K177");
        $this->excel->getActiveSheet()->mergeCells('L188:L205');
        $this->excel->getActiveSheet()->setCellValue("L188", "=J188*K188");
        $this->excel->getActiveSheet()->mergeCells('L206:L220');
        $this->excel->getActiveSheet()->setCellValue("L206", "=J206*K206");
        $this->excel->getActiveSheet()->mergeCells('L221:L231');
        $this->excel->getActiveSheet()->setCellValue("L221", "=J221*K221");
        $this->excel->getActiveSheet()->mergeCells('L232:L240');
        $this->excel->getActiveSheet()->setCellValue("L232", "=J232*K232");
        $this->excel->getActiveSheet()->mergeCells('L241:L250');
        $this->excel->getActiveSheet()->setCellValue("L241", "=J241*K241");
        $this->excel->getActiveSheet()->mergeCells('L251:L260');
        $this->excel->getActiveSheet()->setCellValue("L251", "=J251*K251");
        $this->excel->getActiveSheet()->mergeCells('L261:L269');
        $this->excel->getActiveSheet()->setCellValue("L261", "=J261*K261");
        $this->excel->getActiveSheet()->mergeCells('L270:L276');
        $this->excel->getActiveSheet()->setCellValue("L270", "=J270*K270");

        $this->excel->getActiveSheet()->mergeCells('A277:K277');

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("55");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("80");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("J")->setWidth("20");
        $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth("20");
        $this->excel->getActiveSheet()->getColumnDimension("M")->setWidth("20");

        $this->excel->getActiveSheet()->setCellValue("L277", "=SUM(L12:L276)");

        $this->excel->getActiveSheet()->getStyle('B115')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $this->excel->getActiveSheet()->getStyle('A12:A277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B12:B277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('C12:C277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('D12:D277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('E12:E277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('G12:G277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('H12:H277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('I12:I277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('J12:J277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('K12:M277')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $this->excel->getActiveSheet()->getStyle('A277:L277')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A10:M11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // $this->excel->getActiveSheet()->getStyle('D12:F270'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getStyle('J12:L276')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('J12:J276')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $this->excel->getActiveSheet()->getStyle('K12:K276')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $this->excel->getActiveSheet()->getStyle('L12:L276')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $this->excel->getActiveSheet()->getStyle('M12:M277')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        //$this->excel->getActiveSheet()->getStyle('H12:F172'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 

        //$this->excel->getActiveSheet()->getStyle('B12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);


        //font
        $this->excel->getActiveSheet()->getStyle('A1:A11')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:M11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A277:M277')->getFont()->setBold(true);
        //size    
        $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A10:M11')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A277')->getFont()->setSize(18);
        $this->excel->getActiveSheet()->getStyle('M277')->getFont()->setSize(18);

        $this->excel->getActiveSheet()->getStyle('B12:I276')->getAlignment()->setWrapText(true);
        //$this->excel->getActiveSheet()->getStyle('D12:D270')->getAlignment()->setWrapText(true);
        // $this->excel->getActiveSheet()->getStyle('I12:J270')->getAlignment()->setWrapText(true);
        $this->excel->createSheet();
        $this->excel->getSheet(1)->setTitle('Rekapitulasi');


        $this->excel->getSheet(1)->setSharedStyle($sharedStyleTitles, 'A10:Y12');

        $this->excel->getSheet(1)->setCellValue('A1', "Penghargaan Pembangunan Daerah  2024");
        $this->excel->getSheet(1)->mergeCells('A1:Y1');
        $this->excel->getSheet(1)->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getSheet(1)->setCellValue('A2', "Modul 2 Wawancara Dan Verifikasi");
        $this->excel->getSheet(1)->mergeCells('A2:Y2');

        $this->excel->getSheet(1)->setCellValue('A4', "Nama");
        $this->excel->getSheet(1)->mergeCells('A4:B4');
        $this->excel->getSheet(1)->setCellValue('C4', ":");
        $this->excel->getSheet(1)->setCellValue('A5', "Daerah Yang Dinilai ");
        $this->excel->getSheet(1)->mergeCells('A5:B5');
        $this->excel->getSheet(1)->setCellValue('C5', ":");
        $this->excel->getSheet(1)->setCellValue('D4', "$nama");
        $this->excel->getSheet(1)->setCellValue('D5', "$namakab");
        $this->excel->getSheet(1)->mergeCells('A2:B2');
        $this->excel->getSheet(1)->mergeCells('A3:B3');

        $this->excel->getSheet(1)->setCellValue("A10", "No");
        $this->excel->getSheet(1)->mergeCells('A10:A11');
        $this->excel->getSheet(1)->setCellValue("B10", "Nama Daerah");
        $this->excel->getSheet(1)->mergeCells('B10:B11');
        $this->excel->getSheet(1)->setCellValue("C10", "Skor Indikator");
        $this->excel->getSheet(1)->mergeCells('C10:Y10');
        $startColumn = 'C';
        $endColumn = 'Y';
        $startRow = 11;
        $endRow = 11;

        for ($col = ord($startColumn); $col <= ord($endColumn); $col++) {
            $cell = chr($col) . $startRow;
            $this->excel->getSheet(1)->setCellValue($cell, $col - ord($startColumn) + 1);
        }
        $this->excel->getSheet(1)->setCellValue('A12', "1");
        $this->excel->getSheet(1)->setCellValue('B12', "$namakab");

        $this->excel->getSheet(1)->setCellValue('C12', "='Rekap Nilai'!J12");
        $this->excel->getSheet(1)->setCellValue('D12', "='Rekap Nilai'!J27");
        $this->excel->getSheet(1)->setCellValue('E12', "='Rekap Nilai'!J41");
        $this->excel->getSheet(1)->setCellValue('F12', "='Rekap Nilai'!J55");
        $this->excel->getSheet(1)->setCellValue('G12', "='Rekap Nilai'!J68");
        $this->excel->getSheet(1)->setCellValue('H12', "='Rekap Nilai'!J82");
        $this->excel->getSheet(1)->setCellValue('I12', "='Rekap Nilai'!J96");
        $this->excel->getSheet(1)->setCellValue('J12', "='Rekap Nilai'!J110");
        $this->excel->getSheet(1)->setCellValue('K12', "='Rekap Nilai'!J124");
        $this->excel->getSheet(1)->setCellValue('L12', "='Rekap Nilai'!J138");
        $this->excel->getSheet(1)->setCellValue('M12', "='Rekap Nilai'!J152");
        $this->excel->getSheet(1)->setCellValue('N12', "='Rekap Nilai'!J158");
        $this->excel->getSheet(1)->setCellValue('O12', "='Rekap Nilai'!J163");
        $this->excel->getSheet(1)->setCellValue('P12', "='Rekap Nilai'!J170");
        $this->excel->getSheet(1)->setCellValue('Q12', "='Rekap Nilai'!J177");
        $this->excel->getSheet(1)->setCellValue('R12', "='Rekap Nilai'!J188");
        $this->excel->getSheet(1)->setCellValue('S12', "='Rekap Nilai'!J206");
        $this->excel->getSheet(1)->setCellValue('T12', "='Rekap Nilai'!J221");
        $this->excel->getSheet(1)->setCellValue('U12', "='Rekap Nilai'!J232");
        $this->excel->getSheet(1)->setCellValue('V12', "='Rekap Nilai'!J241");
        $this->excel->getSheet(1)->setCellValue('W12', "='Rekap Nilai'!J251");
        $this->excel->getSheet(1)->setCellValue('X12', "='Rekap Nilai'!J261");
        $this->excel->getSheet(1)->setCellValue('Y12', "='Rekap Nilai'!J270");


        $this->excel->getSheet(1)->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getSheet(1)->getColumnDimension("B")->setWidth("25");
        $startColumn = 'C';
        $endColumn = 'Y';
        for ($col = ord($startColumn); $col <= ord($endColumn); $col++) {
            $column = chr($col);
            $this->excel->getSheet(1)->getColumnDimension($column)->setWidth(6);
        }

        $this->excel->getSheet(1)->getStyle('A10:Y10')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getSheet(1)->getStyle('A10:Y12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getSheet(1)->getStyle('C12:Y12')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        $this->excel->getActiveSheet()->getStyle('A10:Y11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:Y11')->getFont()->setSize(11);



        $this->excel->getActiveSheet()->setShowGridlines(False);
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');
        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(80);


        $this->excel->setActiveSheetIndex(0);
        $this->excel->getSheet(0)->setShowGridlines(False);
        $this->excel->getSheet(0)->getProtection()->setSheet(true);
        $this->excel->getSheet(0)->getProtection()->setSort(true);
        $this->excel->getSheet(0)->getProtection()->setInsertRows(true);
        $this->excel->getSheet(0)->getProtection()->setFormatCells(true);
        $this->excel->getSheet(0)->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul2_" . $user_d . "_" . $namakab . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_resume_tpitpu_by_user()
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Resume User');

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
        $this->excel->getActiveSheet()->setCellValue("B1", "USERID");
        $this->excel->getActiveSheet()->setCellValue("C1", "NAMA");
        $this->excel->getActiveSheet()->setCellValue("D1", "NAMA KABUPATEN");
        $this->excel->getActiveSheet()->setCellValue("E1", "ASPEK");
        $this->excel->getActiveSheet()->setCellValue("F1", "KESIMPULAN");
        $this->excel->getActiveSheet()->setCellValue("G1", "SARAN");

        //---------------isi disini--------------------

        $sql = "SELECT user.userid AS iduser, user.name AS nama_user, resume_kabkota.mapid AS mapid, wil.idkabkot AS idkabkot, kab.id AS idkabupaten, kab.nama_kabupaten AS nama_kabupaten, aspek.id AS idaspek, aspek.nama AS nama_aspek, resume_kabkota.ksmplan AS kesimpulan, resume_kabkota.saran AS saran
                FROM t_mdl2_resume_kabkota resume_kabkota
                JOIN tbl_user_t2_kabkot wil ON resume_kabkota.mapid = wil.id
                JOIN tbl_user user ON wil.iduser = user.id
                JOIN r_mdl2_aspek aspek ON resume_kabkota.aspekid = aspek.id
                JOIN kabupaten kab ON wil.idkabkot = kab.id
                WHERE kab.nama_kabupaten LIKE 'Kabupaten %'
                ORDER BY iduser, mapid ASC";
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
        foreach ($list_data->result() as $list) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->iduser);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_user);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_kabupaten);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->nama_aspek);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->kesimpulan);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $list->saran);
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
        //font
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_resume_tpitpu_kabupaten.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
