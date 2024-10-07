<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
* Unduh Penilaian Prov
* author : FSM
 * date : 10 des 2020
*/
class PPD3_t3_unduh_nilai_prov extends CI_Controller
{
    var $view_dir   = "ppd3/PPD3_unduh_nilai/t3/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD3_unduh_nilai/ppd2.js";
    //var $js_google    = "https://www.googletagmanager.com/gtag/js?id=UA-217181586-1";
    //    var $js_google    = "window.dataLayer = window.dataLayer || [];
    //          function gtag(){dataLayer.push(arguments);}
    //          gtag('js', new Date());
    //
    //          gtag('config', 'UA-217181586-1');";

    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        $this->load->library("Excel");
    }


    public function index()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session expired, please login", 2);
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //common properties
                $this->js_init    = "main";
                $this->js_path    = "assets/js/ppd3/PPD3_unduh_nilai/t3/unduh_nilai_prov_t3.js?v=" . now("Asia/Jakarta");


                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_ppd3_prov", $data_page, TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init . ".init();",
                    //"js_google"    =>   $this->js_google,
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
     * list data wilayah
     * author : FSM
     * date : 17 des 2020
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
                $userid = $session->id;
                //get jml aspek modul 2
                $sql = "SELECT A.`id` FROM r_mdl3_aspek A WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_aspek = $list_data->num_rows();
                //get jml item
                $sql = "SELECT I.`id`
                            FROM `r_mdl3_item` I 
                            WHERE I.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL2!");
                }
                $jml_item = $list_data->num_rows();

                //LIST PROVINSI
                $sql = "SELECT 'PROV' kate,A.`id` mapid,P.id idprov,P.id_kode kode,P.`nama_provinsi` nmprov,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_t3_prov A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov, COUNT(1) jml
                                    FROM `tbl_user_t3_prov` W
                                    JOIN `t_mdl3_skor_p` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl3_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN (
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_t3_prov` W
                                    JOIN `t_mdl3_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                                    )RS ON RS.idprov=A.`idwilayah`                                    
                            LEFT JOIN t_mdl3_sttment_prov ST ON ST.mapid=A.id                         
                            WHERE A.`iduser`=?";
                $bind = array($session->id, $session->id, $session->id);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $str = "";
                if ($list_data->num_rows() == 0) {
                    // $str = "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";
                    $str .= "<div class='not-found-img' style='display: grid; justify-content: center;'>";
                    $str .= "<img src='" . base_url() . "/assets/icons/not_found_2.svg' alt='Data Not Found' width='200' height='200'>";
                    $str .= "<h5 style='font-family: \'Hind Madurai\', sans-serif; text-align: center;'>- <strong style='color: red;'>Data</strong> tidak ditemukan -</h5>";
                    $str .= "</div>";
                } else {
                    $no = 1;
                    foreach ($list_data->result() as $v) {
                        $idcomb = $v->kate . "-" . $v->mapid;
                        $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));


                        $tmp = "class='btn btn-sm btn-primary waves-effect waves-light getDetail' data-id='" . $encrypted_id . "'";
                        $tmp .= " data-nmpkk='" . $v->nmprov . "'";
                        //status
                        $prcntg = $jml_item == 0 ? 0 : $v->jml / $jml_item * 100;

                        $str_tmp = number_format($prcntg, 2) . "&nbsp;%";
                        //status
                        $color_progress = "#ffd740";
                        $notif_warning = "";


                        $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                        $str .= "<div style='display: flex; align-items: center;'>";
                        $str .= "<img src='" . base_url() . "assets/icons/PNG_Provinsi/" . $v->kode . "_" . $v->nmprov . ".png' alt='" . $v->nmprov . "' title='" . $v->nmprov . "' width='100' height='100' style='padding: 15px;'>";
                        $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                        $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                        $str .= "<h4>" . $v->nmprov . "</h4>";
                        $str .= "<div class='btn-wilayah' style='float: right;'>";
                        if ($prcntg == 100) {
                            $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getDetail' data-id='" . $encrypted_id . "' data-nmwlyh='" . $v->nmprov . "' data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                            $str_icon = "<i class='fas fa-exclamation'></i>";
                            if ($v->jml_rsm == $jml_aspek) {
                                if (!is_null($v->stts)) {
                                    $str_tmp = "class='btn btn-sm btn-info waves-effect waves-light btn-status getSttmnt' data-id='" . $encrypted_id . "' data-toggle='tooltip' data-placement='top' title='klik untuk unduh' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                    $str_icon = "Unduh Nilai<i class='fas fa-download' style='padding-left: 5px;'></i>";
                                } else {
                                    $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status getSttmnt' data-id='" . $encrypted_id . "' data-toggle='tooltip' data-placement='top' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                                    $str_icon = "<i class='fas fa-check-circle'></i>";
                                }
                            }
                            $str .= "<a href='javascript:void(0);' " . $tmp . " " . $str_tmp . ">" . $str_icon . "</a>";
                        }

                        //                            $str .= "<a href='javascript:void(0)' ".$tmp." style='border-radius: 0px; padding-left: 10px;'>Unduh Nilai <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                        //$str .= "";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "</div>";
                        $str .= "</div>";
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
     * unduh nilai 
     * author : FSM
     * date : 17 des 2020
     */
    function Download_nilai()
    {

        if (!$this->session->userdata(SESSION_LOGIN)) {
            echo 'Invalid Token, silakan ulangi login ke aplikasi';
            exit();
        }

        $user = $this->session->userdata(SESSION_LOGIN)->id;
        $nama = $this->session->userdata(SESSION_LOGIN)->name;
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
        //$user
        $select = "SELECT W.id,W.iduser,W.idwilayah, P.nama_provinsi, U.userid
                    FROM `tbl_user_t3_prov` W
                    JOIN `provinsi` P ON W.idwilayah = P.id
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE W.iduser='$user' AND W.id='$idwil'";
        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nilai = $d->id;
            $user_d = $d->userid;
            $namaprov = $d->nama_provinsi;
        }
        //list indikator skor


        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
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


        $status_sql = "SELECT K.id nokrr,K.aspekid nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,IT.`nourut` nr,IT.`nama` nmitem,IJ.nama nmjdl,JDL.`judl`,SK.sumber,SK.skor skr,
RES.ksmplan, RES.saran,IND.bobot
                                FROM `r_mdl3_item` IT
                                JOIN `r_mdl3_sub_indi` SI ON SI.`id`=IT.`subindiid`
                                JOIN `r_mdl3_indi` IND ON IND.`id`=SI.`indiid`
                                LEFT JOIN `r_mdl3_item_judul` IJ ON IJ.`indiid` = IND.`id`
                                JOIN `r_mdl3_krtria` K ON K.`id`=IND.`krtriaid`
                                JOIN `r_mdl3_aspek` A ON A.id = K.aspekid
                                LEFT JOIN `t_mdl3_resume_prov` RES ON RES.`aspekid` = A.id AND RES.mapid ='$idwil'
                                    LEFT JOIN `t_mdl3_judul_prov` JDL ON JDL.judlid = IJ.id AND JDL.mapid ='$idwil'
                                LEFT JOIN `t_mdl3_skor_p` SK ON SK.`itemindi` = IT.id AND SK.mapid ='$idwil'
                                ORDER BY K.aspekid,IND.nourut,IT.`id` ASC";
        $list_data  = $this->db->query($status_sql);
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
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $judul);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->sumber);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, '');
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot / 100);
            $index_excelColumn = 0;
            $row++;
        }




        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2022");
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->setCellValue('A2', "Modul 3 Verifikasi");
        $this->excel->getActiveSheet()->mergeCells('A2:K2');
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
        $this->excel->getActiveSheet()->mergeCells('A4:B4');
        $this->excel->getActiveSheet()->setCellValue('C4', ":");
        $this->excel->getActiveSheet()->setCellValue('A5', "Daerah Yang Dinilai ");
        $this->excel->getActiveSheet()->mergeCells('A5:B5');
        $this->excel->getActiveSheet()->setCellValue('C5', ":");
        $this->excel->getActiveSheet()->setCellValue('D4', "$nama");
        $this->excel->getActiveSheet()->setCellValue('D5', "$namaprov");
        $this->excel->getActiveSheet()->mergeCells('A2:B2');
        $this->excel->getActiveSheet()->mergeCells('A3:B3');


        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:N120');
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
        $this->excel->getActiveSheet()->setCellValue("H10", "SUMBER INFORMASI");
        $this->excel->getActiveSheet()->mergeCells('H10:H11');
        $this->excel->getActiveSheet()->setCellValue("I10", "NILAI");
        $this->excel->getActiveSheet()->mergeCells('I10:I11');
        $this->excel->getActiveSheet()->setCellValue("J10", "KEUNGGULAN DAERAH");
        $this->excel->getActiveSheet()->mergeCells('J10:J11');
        $this->excel->getActiveSheet()->setCellValue("K10", "REKOMENDASI");
        $this->excel->getActiveSheet()->mergeCells('K10:K11');
        $this->excel->getActiveSheet()->setCellValue("L10", "SKOR");
        $this->excel->getActiveSheet()->mergeCells('L10:L11');
        $this->excel->getActiveSheet()->setCellValue("M10", "BOBOT");
        $this->excel->getActiveSheet()->mergeCells('M10:M11');
        $this->excel->getActiveSheet()->setCellValue("N10", "NILAI TERBOBOT");
        $this->excel->getActiveSheet()->mergeCells('N10:N11');
        $this->excel->getActiveSheet()->setCellValue("A120", "TOTAL");

        //list indikator skor

        //$this->excel->getActiveSheet()->getStyle('A10:M119')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

        $this->excel->getActiveSheet()->mergeCells('A12:A61');
        $this->excel->getActiveSheet()->mergeCells('A62:A98');
        $this->excel->getActiveSheet()->mergeCells('A99:A119');

        $this->excel->getActiveSheet()->mergeCells('B12:B61');
        $this->excel->getActiveSheet()->mergeCells('B62:B98');
        $this->excel->getActiveSheet()->mergeCells('B99:B119');
        //
        $this->excel->getActiveSheet()->mergeCells('C12:C16');
        $this->excel->getActiveSheet()->mergeCells('C17:C21');
        $this->excel->getActiveSheet()->mergeCells('C22:C26');
        $this->excel->getActiveSheet()->mergeCells('C27:C31');
        $this->excel->getActiveSheet()->mergeCells('C32:C36');
        $this->excel->getActiveSheet()->mergeCells('C37:C41');
        $this->excel->getActiveSheet()->mergeCells('C42:C46');
        $this->excel->getActiveSheet()->mergeCells('C47:C51');
        $this->excel->getActiveSheet()->mergeCells('C52:C56');
        $this->excel->getActiveSheet()->mergeCells('C57:C61');
        $this->excel->getActiveSheet()->mergeCells('C62:C65');
        $this->excel->getActiveSheet()->mergeCells('C66:C73');
        $this->excel->getActiveSheet()->mergeCells('C74:C76');
        $this->excel->getActiveSheet()->mergeCells('C77:C82');
        $this->excel->getActiveSheet()->mergeCells('C83:C87');
        $this->excel->getActiveSheet()->mergeCells('C88:C90');
        $this->excel->getActiveSheet()->mergeCells('C91:C94');
        $this->excel->getActiveSheet()->mergeCells('C95:C98');
        $this->excel->getActiveSheet()->mergeCells('C99:C105');
        $this->excel->getActiveSheet()->mergeCells('C106:C110');
        $this->excel->getActiveSheet()->mergeCells('C111:C114');
        $this->excel->getActiveSheet()->mergeCells('C115:C119');
        //                
        $this->excel->getActiveSheet()->mergeCells('D12:D16');
        $this->excel->getActiveSheet()->mergeCells('D17:D21');
        $this->excel->getActiveSheet()->mergeCells('D22:D26');
        $this->excel->getActiveSheet()->mergeCells('D27:D31');
        $this->excel->getActiveSheet()->mergeCells('D32:D36');
        $this->excel->getActiveSheet()->mergeCells('D37:D41');
        $this->excel->getActiveSheet()->mergeCells('D42:D46');
        $this->excel->getActiveSheet()->mergeCells('D47:D51');
        $this->excel->getActiveSheet()->mergeCells('D52:D56');
        $this->excel->getActiveSheet()->mergeCells('D57:D61');
        $this->excel->getActiveSheet()->mergeCells('D62:D65');
        $this->excel->getActiveSheet()->mergeCells('D66:D73');
        $this->excel->getActiveSheet()->mergeCells('D74:D76');
        $this->excel->getActiveSheet()->mergeCells('D77:D82');
        $this->excel->getActiveSheet()->mergeCells('D83:D87');
        $this->excel->getActiveSheet()->mergeCells('D88:D90');
        $this->excel->getActiveSheet()->mergeCells('D91:D94');
        $this->excel->getActiveSheet()->mergeCells('D95:D98');
        $this->excel->getActiveSheet()->mergeCells('D99:D105');
        $this->excel->getActiveSheet()->mergeCells('D106:D110');
        $this->excel->getActiveSheet()->mergeCells('D111:D114');
        $this->excel->getActiveSheet()->mergeCells('D115:D119');

        $this->excel->getActiveSheet()->mergeCells('G12:G16');
        $this->excel->getActiveSheet()->mergeCells('G17:G21');
        $this->excel->getActiveSheet()->mergeCells('G22:G26');
        $this->excel->getActiveSheet()->mergeCells('G27:G31');
        $this->excel->getActiveSheet()->mergeCells('G32:G36');
        $this->excel->getActiveSheet()->mergeCells('G37:G41');
        $this->excel->getActiveSheet()->mergeCells('G42:G46');
        $this->excel->getActiveSheet()->mergeCells('G47:G51');
        $this->excel->getActiveSheet()->mergeCells('G52:G56');
        $this->excel->getActiveSheet()->mergeCells('G57:G61');
        $this->excel->getActiveSheet()->mergeCells('G62:G65');
        $this->excel->getActiveSheet()->mergeCells('G66:G73');
        $this->excel->getActiveSheet()->mergeCells('G74:G76');
        $this->excel->getActiveSheet()->mergeCells('G77:G82');
        $this->excel->getActiveSheet()->mergeCells('G83:G87');
        $this->excel->getActiveSheet()->mergeCells('G88:G90');
        $this->excel->getActiveSheet()->mergeCells('G91:G94');
        $this->excel->getActiveSheet()->mergeCells('G95:G98');
        $this->excel->getActiveSheet()->mergeCells('G99:G105');
        $this->excel->getActiveSheet()->mergeCells('G106:G110');
        $this->excel->getActiveSheet()->mergeCells('G111:G114');
        $this->excel->getActiveSheet()->mergeCells('G115:G119');

        $this->excel->getActiveSheet()->mergeCells('J12:J61');
        $this->excel->getActiveSheet()->mergeCells('J62:J98');
        $this->excel->getActiveSheet()->mergeCells('J99:J119');

        $this->excel->getActiveSheet()->mergeCells('K12:K61');
        $this->excel->getActiveSheet()->mergeCells('K62:K98');
        $this->excel->getActiveSheet()->mergeCells('K99:K119');

        $this->excel->getActiveSheet()->mergeCells('A120:M120');



        $this->excel->getActiveSheet()->getStyle('A10:N10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A12:N119')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('A120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue("N120", "=SUM(N12:N119)");


        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("4");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("55");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("80");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("J")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("K")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("M")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("N")->setWidth("10");

        $this->excel->getActiveSheet()->getStyle('I12:I119')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $this->excel->getActiveSheet()->getStyle('L12:N119')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        //                $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //                $this->excel->getActiveSheet()->getStyle('A203:L203')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //                $this->excel->getActiveSheet()->getStyle('A10:N11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$this->excel->getActiveSheet()->getStyle('B115')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_TOP);
        //$this->excel->getActiveSheet()->getStyle('B120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);


        //$this->excel->getActiveSheet()->getStyle('A12:N202')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);




        //$this->excel->getActiveSheet()->getStyle('I12:I202')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$this->excel->getActiveSheet()->getStyle('L12:N202')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$this->excel->getActiveSheet()->getStyle('L12:N202')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        //$this->excel->getActiveSheet()->getStyle('L12:L202')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        //$this->excel->getActiveSheet()->getStyle('N203')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        //$this->excel->getActiveSheet()->getStyle('H12:F172'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 

        //$this->excel->getActiveSheet()->getStyle('B12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);


        //font
        $this->excel->getActiveSheet()->getStyle('A1:A11')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:N11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A203:N203')->getFont()->setBold(true);
        //size    
        $this->excel->getActiveSheet()->getStyle('A1:D2')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A10:N11')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A203')->getFont()->setSize(18);
        $this->excel->getActiveSheet()->getStyle('N203')->getFont()->setSize(18);

        //garis

        //hilangin rowkolom
        $this->excel->getActiveSheet()->setShowGridlines(False);
        //$this->excel->getActiveSheet()->getStyle('D12:K119' . $this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getStyle('D12:K119')->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Nilai');
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul3_" . $user_d . "_" . $namaprov . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
