<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
* Unduh Penilaian Prov
* author : FSM
 * date : 10 des 2020
*/
class PPD2_unduh_nilai_prov extends CI_Controller
{
    var $view_dir   = "ppd2/PPD2_unduh_nilai/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD2_unduh_nilai/ppd2.js";

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
                $this->js_tedit    = "main";
                $this->js_path    = "assets/js/ppd2/PPD2_unduh_nilai/unduh_nilai_prov.js?v=" . now("Asia/Jakarta");


                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_ppd2_prov", $data_page, TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init . ".init();",
                    //"js_tedit"    =>  $this->js_tedit.".tble();",
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
                //get jml aspek
                $sql = "SELECT A.`id`
                        FROM r_mdl1_aspek A 
                        WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $jml_aspek = $list_data->num_rows();

                //get jml item
                $sql = "SELECT I.`id`
                            FROM r_mdl1_item I 
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'PROV')
                            JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $jml_item = $list_data->num_rows();


                //table wilayah
                //                $sql= "SELECT 'PROV' kate,P.`id` mapid,P.`id_kode` kode, P.`nama_provinsi` nmprov
                //                        FROM tbl_user_wilayah A
                //                        JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                //                        WHERE A.`iduser`=?";
                //                $bind = array($session->id);
                //LIST PROVINSI
                $sql = "SELECT 'PROV' kate,A.`id`,P.id mapid,P.id_kode kode,P.`nama_provinsi` nmprov,P.`label`,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM tbl_user_wilayah A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            LEFT JOIN(
                                    SELECT W.`idwilayah` idprov,COUNT(1) jml
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov IN ('ALL', 'PROV')
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idwilayah`
                            ) JML ON JML.idprov=A.`idwilayah`
                            LEFT JOIN(
				SELECT W.`idwilayah` idprov,COUNT(1) jml
				FROM `tbl_user_wilayah` W
				JOIN `t_mdl1_resume_prov` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`=?
				GROUP BY W.`idwilayah`
                            ) RS ON RS.idprov=A.`idwilayah`
                            LEFT JOIN t_mdl1_sttment_prov ST ON ST.mapid=A.id
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

                        $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                        $str .= "<div style='display: flex; align-items: center;'>";
                        $str .= "<img src='" . base_url() . "assets/icons/PNG_Provinsi/" . $v->kode . "_" . $v->nmprov . ".png' alt='" . $v->nmprov . "' title='" . $v->nmprov . "' width='100' height='100' style='padding: 15px;'>";
                        $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                        $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                        $str .= "<h4>" . $v->nmprov . "</h4>";
                        $str .= "<div class='btn-wilayah' style='float: right;'>";
                        //status
                        $prcntg = $jml_item == 0 ? 0 : $v->jml / $jml_item * 100;
                        if ($prcntg == 100) {
                            $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                            $str_icon = "Data resume aspek belum lengkap <i class='fas fa-exclamation'></i>";
                            if ($v->jml_rsm == $jml_aspek) {
                                if (!is_null($v->stts)) {
                                    $str_tmp = " " . $tmp . " class='btn btn-sm btn-info waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='klik untuk Unduh Nilai' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                                    $str_icon = "Unduh Nilai <i class='fas fa-check-circle'></i>";
                                } else {
                                    $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='Belum menyelesaikan lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                                    //$str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                                    $str_icon = " Belum menyelesaikan lembar pernyataan <i class='fas fa-exclamation'></i>";
                                }
                            }
                            $str .= "<a href='javascript:void(0);' " . $str_tmp . ">" . $str_icon . "</a>";
                        } else {
                            $str .= "<a href='javascript:void(0)'  style='border-radius: 0px; padding-left: 10px;'>Silakan melakukan penilaian Modul 1 <i class='fas ' style='padding-left: 5px;'></i></a>";
                        }

                        //$str .= "<a href='javascript:void(0)' ".$tmp." style='border-radius: 0px; padding-left: 10px;'>Unduh Nilai <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
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
            echo 'Invalid Token, silakan logon sistem';
            exit();
        }
        //echo 'proses';
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
                    FROM `tbl_user_wilayah` W
                    JOIN `provinsi` P ON W.idwilayah = P.id
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE W.iduser='$user' AND W.idwilayah='$idwil'";

        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nilai = $d->id;
            $user_d = $d->userid;
            $namaprov = $d->nama_provinsi;
        }

        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Nilai');

        $this->excel->getActiveSheet()->getStyle('B115')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);

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
        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2023");
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A2', "Kriteria dan Indikator Penilaian Dokumen RKPD");

        $this->excel->getActiveSheet()->mergeCells('A2:K2');

        //                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        
        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:L187');

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



        $this->excel->getActiveSheet()->setCellValue("A10", "NO");
        $this->excel->getActiveSheet()->mergeCells('A10:A11');
        $this->excel->getActiveSheet()->setCellValue("B10", "KRITERIA");
        $this->excel->getActiveSheet()->mergeCells('B10:B11');

        $this->excel->getActiveSheet()->setCellValue("C10", "INDIKATOR");
        $this->excel->getActiveSheet()->mergeCells('C10:D11');
        $this->excel->getActiveSheet()->setCellValue("E10", "ITEM");
        $this->excel->getActiveSheet()->mergeCells('E10:F11');
        $this->excel->getActiveSheet()->setCellValue("G10", "NILAI");
        $this->excel->getActiveSheet()->mergeCells('G10:G11');
        $this->excel->getActiveSheet()->setCellValue("H10", "KEUNGGULAN DAERAH");
        $this->excel->getActiveSheet()->mergeCells('H10:H11');
        $this->excel->getActiveSheet()->setCellValue("I10", "REKOMENDASI");
        $this->excel->getActiveSheet()->mergeCells('I10:I11');
        $this->excel->getActiveSheet()->setCellValue("J10", "SKOR");
        $this->excel->getActiveSheet()->mergeCells('J10:J11');
        $this->excel->getActiveSheet()->setCellValue("K10", "BOBOT");
        $this->excel->getActiveSheet()->mergeCells('K10:K11');
        $this->excel->getActiveSheet()->setCellValue("L10", "NILAI TERBOBOT");
        $this->excel->getActiveSheet()->mergeCells('L10:L11');
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue("A187", "TOTAL");


        $this->excel->getActiveSheet()->mergeCells('A12:A71');
        $this->excel->getActiveSheet()->mergeCells('A72:A110');
        $this->excel->getActiveSheet()->mergeCells('A111:A127');
        $this->excel->getActiveSheet()->mergeCells('A128:A159');
        $this->excel->getActiveSheet()->mergeCells('A160:A186');
        
        $this->excel->getActiveSheet()->mergeCells('B12:B71');
        $this->excel->getActiveSheet()->mergeCells('B72:B110');
        $this->excel->getActiveSheet()->mergeCells('B111:B127');
        $this->excel->getActiveSheet()->mergeCells('B128:B159');
        $this->excel->getActiveSheet()->mergeCells('B160:B186');

        $this->excel->getActiveSheet()->mergeCells('C12:C21');
        $this->excel->getActiveSheet()->mergeCells('C22:C26');
        $this->excel->getActiveSheet()->mergeCells('C27:C33');
        $this->excel->getActiveSheet()->mergeCells('C34:C45');
        $this->excel->getActiveSheet()->mergeCells('C46:C52');
        $this->excel->getActiveSheet()->mergeCells('C53:C60');
        $this->excel->getActiveSheet()->mergeCells('C61:C71');
        $this->excel->getActiveSheet()->mergeCells('C72:C81');
        $this->excel->getActiveSheet()->mergeCells('C82:C84');
        $this->excel->getActiveSheet()->mergeCells('C85:C88');
        $this->excel->getActiveSheet()->mergeCells('C89:C95');
        $this->excel->getActiveSheet()->mergeCells('C96:C100');
        $this->excel->getActiveSheet()->mergeCells('C101:C104');
        $this->excel->getActiveSheet()->mergeCells('C105:C110');
        $this->excel->getActiveSheet()->mergeCells('C111:C115');
        $this->excel->getActiveSheet()->mergeCells('C116:C118');
        $this->excel->getActiveSheet()->mergeCells('C119:C123');
        $this->excel->getActiveSheet()->mergeCells('C124:C127');
        $this->excel->getActiveSheet()->mergeCells('C128:C133');
        $this->excel->getActiveSheet()->mergeCells('C134:C145');
        $this->excel->getActiveSheet()->mergeCells('C146:C153');
        $this->excel->getActiveSheet()->mergeCells('C154:C159');
        $this->excel->getActiveSheet()->mergeCells('C160:C172');
        $this->excel->getActiveSheet()->mergeCells('C173:C186');

        $this->excel->getActiveSheet()->mergeCells('D12:D21');
        $this->excel->getActiveSheet()->mergeCells('D22:D26');
        $this->excel->getActiveSheet()->mergeCells('D27:D33');
        $this->excel->getActiveSheet()->mergeCells('D34:D45');
        $this->excel->getActiveSheet()->mergeCells('D46:D52');
        $this->excel->getActiveSheet()->mergeCells('D53:D60');
        $this->excel->getActiveSheet()->mergeCells('D61:D71');
        $this->excel->getActiveSheet()->mergeCells('D72:D81');
        $this->excel->getActiveSheet()->mergeCells('D82:D84');
        $this->excel->getActiveSheet()->mergeCells('D85:D88');
        $this->excel->getActiveSheet()->mergeCells('D89:D95');
        $this->excel->getActiveSheet()->mergeCells('D96:D100');
        $this->excel->getActiveSheet()->mergeCells('D101:D104');
        $this->excel->getActiveSheet()->mergeCells('D105:D110');
        $this->excel->getActiveSheet()->mergeCells('D111:D115');
        $this->excel->getActiveSheet()->mergeCells('D116:D118');
        $this->excel->getActiveSheet()->mergeCells('D119:D123');
        $this->excel->getActiveSheet()->mergeCells('D124:D127');
        $this->excel->getActiveSheet()->mergeCells('D128:D133');
        $this->excel->getActiveSheet()->mergeCells('D134:D145');
        $this->excel->getActiveSheet()->mergeCells('D146:D153');
        $this->excel->getActiveSheet()->mergeCells('D154:D159');
        $this->excel->getActiveSheet()->mergeCells('D160:D172');
        $this->excel->getActiveSheet()->mergeCells('D173:D186');

        $this->excel->getActiveSheet()->mergeCells('H12:H71');
        $this->excel->getActiveSheet()->mergeCells('H72:H159');
        $this->excel->getActiveSheet()->mergeCells('H160:H186');

        $this->excel->getActiveSheet()->mergeCells('I12:I71');
        $this->excel->getActiveSheet()->mergeCells('I72:I159');
        $this->excel->getActiveSheet()->mergeCells('I160:I186');


        $this->excel->getActiveSheet()->mergeCells('A187:K187');


        //                $this->excel->getActiveSheet()->mergeCells('H12:H20');
        //list indikator skor ORDER BY IND.`nourut`,IT.subindiid, IT.`nourut`
        $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
                                FROM `r_mdl1_item` IT
                                JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'PROV')
                                JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                                JOIN `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                                JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                                LEFT JOIN `t_mdl1_resume_prov` RES ON RES.`aspekid` = A.id AND RES.mapid ='$nilai'
                                LEFT JOIN(
                                        SELECT I.`id` iditem,II.`skor`
                                        FROM `t_mdl1_skor_prov` SK
                                        JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                        JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                        WHERE SK.`mapid`='$nilai'
                                ) SKOR ON SKOR.iditem=IT.`id`
                                ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC";


        $list_data  = $this->db->query($status_sql);
        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 12;
        $nol = '';
        foreach ($list_data->result() as $value) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nr);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skor);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, '');
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot / 100);
            //                $this->excel->getActiveSheet()->getColumnDimension("F")->setWrapText(true);
            $index_excelColumn = 0;
            $row++;
        }


        $this->excel->getActiveSheet()->mergeCells('J12:J21'); //$this->excel->getActiveSheet()->mergeCells('J12:J20');
        $this->excel->getActiveSheet()->setCellValue("J12", "=10*SUM(G12:G21)/COUNT(E12:E21))");
        $this->excel->getActiveSheet()->mergeCells('J22:J26'); //$this->excel->getActiveSheet()->mergeCells('J21:J27');
        $this->excel->getActiveSheet()->setCellValue("J22", "=10*SUM(G22:G26)/COUNT(E22:E26))");
        $this->excel->getActiveSheet()->mergeCells('J27:J33'); //$this->excel->getActiveSheet()->mergeCells('J28:J38');
        $this->excel->getActiveSheet()->setCellValue("J27", "=10*SUM(G27:G33)/COUNT(E27:E33))");
        $this->excel->getActiveSheet()->mergeCells('J34:J45'); //$this->excel->getActiveSheet()->mergeCells('J39:J53');
        $this->excel->getActiveSheet()->setCellValue("J34", "=10*SUM(G34:G45)/COUNT(E34:E45))");
        $this->excel->getActiveSheet()->mergeCells('J46:J52'); //$this->excel->getActiveSheet()->mergeCells('J54:J61');
        $this->excel->getActiveSheet()->setCellValue("J46", "=10*SUM(G46:G52)/COUNT(E46:E52))");
        $this->excel->getActiveSheet()->mergeCells('J53:J60');
        $this->excel->getActiveSheet()->setCellValue("J53", "=10*SUM(G53:G60)/COUNT(E53:E60))");
        $this->excel->getActiveSheet()->mergeCells('J61:J71');
        $this->excel->getActiveSheet()->setCellValue("J61", "=10*SUM(G61:G71)/COUNT(E61:E71))");
        $this->excel->getActiveSheet()->mergeCells('J72:J81');
        $this->excel->getActiveSheet()->setCellValue("J72", "=10*SUM(G72:G81)/COUNT(E72:E81))");
        $this->excel->getActiveSheet()->mergeCells('J82:J84');
        $this->excel->getActiveSheet()->setCellValue("J82", "=10*SUM(G82:G84)/COUNT(E82:E84))");
        $this->excel->getActiveSheet()->mergeCells('J85:J88');
        $this->excel->getActiveSheet()->setCellValue("J85", "=10*SUM(G85:G88)/COUNT(E85:E88))");
        $this->excel->getActiveSheet()->mergeCells('J89:J95');
        $this->excel->getActiveSheet()->setCellValue("J89", "=10*SUM(G89:G95)/COUNT(E89:E95))");
        $this->excel->getActiveSheet()->mergeCells('J96:J100');
        $this->excel->getActiveSheet()->setCellValue("J96", "=10*SUM(G96:G100)/COUNT(E96:E100))");
        $this->excel->getActiveSheet()->mergeCells('J101:J104');
        $this->excel->getActiveSheet()->setCellValue("J101", "=10*SUM(G101:G104)/COUNT(E101:E104))");
        $this->excel->getActiveSheet()->mergeCells('J105:J110');
        $this->excel->getActiveSheet()->setCellValue("J105", "=10*SUM(G105:G110)/COUNT(E105:E110))");
        $this->excel->getActiveSheet()->mergeCells('J111:J115');
        $this->excel->getActiveSheet()->setCellValue("J111", "=10*SUM(G111:G115)/COUNT(E111:E115))");
        $this->excel->getActiveSheet()->mergeCells('J116:J118');
        $this->excel->getActiveSheet()->setCellValue("J116", "=10*SUM(G116:G118)/COUNT(E116:E118))");
        $this->excel->getActiveSheet()->mergeCells('J119:J123');
        $this->excel->getActiveSheet()->setCellValue("J119", "=10*SUM(G119:G123)/COUNT(E119:E123))");
        $this->excel->getActiveSheet()->mergeCells('J124:J127');
        $this->excel->getActiveSheet()->setCellValue("J124", "=10*SUM(G124:G127)/COUNT(E124:E127))");
        $this->excel->getActiveSheet()->mergeCells('J128:J133');
        $this->excel->getActiveSheet()->setCellValue("J128", "=10*SUM(G128:G133)/COUNT(E128:E133))");
        $this->excel->getActiveSheet()->mergeCells('J134:J145');
        $this->excel->getActiveSheet()->setCellValue("J134", "=10*SUM(G134:G145)/COUNT(E134:E145))");
        $this->excel->getActiveSheet()->mergeCells('J146:J153');
        $this->excel->getActiveSheet()->setCellValue("J146", "=10*SUM(G146:G153)/COUNT(E146:E153))");
        $this->excel->getActiveSheet()->mergeCells('J154:J159');
        $this->excel->getActiveSheet()->setCellValue("J154", "=10*SUM(G154:G159)/COUNT(E154:E159))");
        $this->excel->getActiveSheet()->mergeCells('J160:J172');
        $this->excel->getActiveSheet()->setCellValue("J160", "=10*SUM(G160:G172)/COUNT(E160:E172))");
        $this->excel->getActiveSheet()->mergeCells('J173:J186');
        $this->excel->getActiveSheet()->setCellValue("J173", "=10*SUM(G173:G186)/COUNT(E173:E186))");
        //                $this->excel->getActiveSheet()->mergeCells('J157:J172');
        //                $this->excel->getActiveSheet()->setCellValue("J157", "=10*SUM(G157:G172)/COUNT(E157:E172))");
        $this->excel->getActiveSheet()->getStyle('J12:J186')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        $this->excel->getActiveSheet()->mergeCells('K12:K21');
        $this->excel->getActiveSheet()->mergeCells('K22:K26');
        $this->excel->getActiveSheet()->mergeCells('K27:K33');
        $this->excel->getActiveSheet()->mergeCells('K34:K45');
        $this->excel->getActiveSheet()->mergeCells('K46:K52');
        $this->excel->getActiveSheet()->mergeCells('K53:K60');
        $this->excel->getActiveSheet()->mergeCells('K61:K71');
        $this->excel->getActiveSheet()->mergeCells('K72:K81');
        $this->excel->getActiveSheet()->mergeCells('K82:K84');
        $this->excel->getActiveSheet()->mergeCells('K85:K88');
        $this->excel->getActiveSheet()->mergeCells('K89:K95');
        $this->excel->getActiveSheet()->mergeCells('K96:K100');
        $this->excel->getActiveSheet()->mergeCells('K101:K104');
        $this->excel->getActiveSheet()->mergeCells('K105:K110');
        $this->excel->getActiveSheet()->mergeCells('K111:K115');
        $this->excel->getActiveSheet()->mergeCells('K116:K118');
        $this->excel->getActiveSheet()->mergeCells('K119:K123');
        $this->excel->getActiveSheet()->mergeCells('K124:K127');
        $this->excel->getActiveSheet()->mergeCells('K128:K133');
        $this->excel->getActiveSheet()->mergeCells('K134:K145');
        $this->excel->getActiveSheet()->mergeCells('K146:K153');
        $this->excel->getActiveSheet()->mergeCells('K154:K159');
        $this->excel->getActiveSheet()->mergeCells('K160:K172');
        $this->excel->getActiveSheet()->mergeCells('K173:K186');


        $this->excel->getActiveSheet()->mergeCells('L12:L21');
        $this->excel->getActiveSheet()->setCellValue("L12", "=J12*K12");
        $this->excel->getActiveSheet()->mergeCells('L22:L26');
        $this->excel->getActiveSheet()->setCellValue("L22", "=J22*K22");
        $this->excel->getActiveSheet()->mergeCells('L27:L33');
        $this->excel->getActiveSheet()->setCellValue("L27", "=J27*K27");
        $this->excel->getActiveSheet()->mergeCells('L34:L45');
        $this->excel->getActiveSheet()->setCellValue("L34", "=J34*K34");
        $this->excel->getActiveSheet()->mergeCells('L46:L52');
        $this->excel->getActiveSheet()->setCellValue("L46", "=J46*K46");
        $this->excel->getActiveSheet()->mergeCells('L53:L60');
        $this->excel->getActiveSheet()->setCellValue("L53", "=J53*K53");
        $this->excel->getActiveSheet()->mergeCells('L61:L71');
        $this->excel->getActiveSheet()->setCellValue("L61", "=J61*K61");
        $this->excel->getActiveSheet()->mergeCells('L72:L81');
        $this->excel->getActiveSheet()->setCellValue("L72", "=J72*K72");
        $this->excel->getActiveSheet()->mergeCells('L82:L84');
        $this->excel->getActiveSheet()->setCellValue("L82", "=J82*K82");
        $this->excel->getActiveSheet()->mergeCells('L85:L88');
        $this->excel->getActiveSheet()->setCellValue("L85", "=J85*K85");
        $this->excel->getActiveSheet()->mergeCells('L89:L95');
        $this->excel->getActiveSheet()->setCellValue("L89", "=J89*K89");
        $this->excel->getActiveSheet()->mergeCells('L96:L100');
        $this->excel->getActiveSheet()->setCellValue("L96", "=J96*K96");
        $this->excel->getActiveSheet()->mergeCells('L101:L104');
        $this->excel->getActiveSheet()->setCellValue("L101", "=J101*K101");
        $this->excel->getActiveSheet()->mergeCells('L105:L110');
        $this->excel->getActiveSheet()->setCellValue("L105", "=J105*K105");
        $this->excel->getActiveSheet()->mergeCells('L111:L115');
        $this->excel->getActiveSheet()->setCellValue("L111", "=J111*K111");
        $this->excel->getActiveSheet()->mergeCells('L116:L118');
        $this->excel->getActiveSheet()->setCellValue("L116", "=J116*K116");
        $this->excel->getActiveSheet()->mergeCells('L119:L123');
        $this->excel->getActiveSheet()->setCellValue("L119", "=J119*K119");
        $this->excel->getActiveSheet()->mergeCells('L124:L127');
        $this->excel->getActiveSheet()->setCellValue("L124", "=J124*K124");
        $this->excel->getActiveSheet()->mergeCells('L128:L133');
        $this->excel->getActiveSheet()->setCellValue("L128", "=J128*K128");
        $this->excel->getActiveSheet()->mergeCells('L134:L145');
        $this->excel->getActiveSheet()->setCellValue("L134", "=J134*K134");
        $this->excel->getActiveSheet()->mergeCells('L146:L153');
        $this->excel->getActiveSheet()->setCellValue("L146", "=J146*K146");
        $this->excel->getActiveSheet()->mergeCells('L154:L159');
        $this->excel->getActiveSheet()->setCellValue("L154", "=J154*K154");
        $this->excel->getActiveSheet()->mergeCells('L160:L172');
        $this->excel->getActiveSheet()->setCellValue("L160", "=J160*K160");
        $this->excel->getActiveSheet()->mergeCells('L173:L186');
        $this->excel->getActiveSheet()->setCellValue("L173", "=J173*K173");

        $this->excel->getActiveSheet()->getStyle('L12:L186')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("55");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
        $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("80");
        $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("57");
        $this->excel->getActiveSheet()->getColumnDimension("L")->setWidth("20");

        $this->excel->getActiveSheet()->setCellValue("L187", "=SUM(L12:L186)");

        $this->excel->getActiveSheet()->getStyle('G12:G186')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('J12:L186')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A187:L187')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('D12:I186')->getAlignment()->setWrapText(true);
        //$this->excel->getActiveSheet()->getStyle('D12:F202'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 

        //$this->excel->getActiveSheet()->getStyle('B12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('A12:A186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B12:B186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('C12:C186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('D12:D186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('E12:E186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('H12:H186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('I12:I186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('J12:J186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('K12:K186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('l12:l186')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        //font
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setName('CMIIW');
        $this->excel->getActiveSheet()->getStyle('A10:A11')->getFont()->setName('CMIIW');
        //$this->excel->getActiveSheet()->getStyle('A203')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A187:L187')->getFont()->setBold(true);
        //size    
        $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A187')->getFont()->setSize(18);
        $this->excel->getActiveSheet()->getStyle('L187')->getFont()->setSize(18);



        $this->excel->getActiveSheet()->setShowGridlines(False);
        // $this->excel->getActiveSheet()->getStyle('D12:I202')->getAlignment()->setWrapText(true);
        //                $this->excel->getActiveSheet()->getStyle('D12:D181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
        //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul1_" . $user_d . "_" . $namaprov . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
