<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
* Penilaian Modul 1 oleh TPT Pusat
* author : ilham
 * date : 10 des 2020
*/
class PPD7_unduh_nilai_kab extends CI_Controller
{
    var $view_dir   = "ppd7/PPD7_unduh_nilai/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd7/PPD7_unduh_nilai/ppd7.js";

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
                $this->js_path    = "assets/js/ppd7/PPD7_unduh_nilai/unduh_nilai_kab.js?v=" . now("Asia/Jakarta");


                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_ppd7_kab", $data_page, TRUE);

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
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.`isactive`='Y' AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB')
                            JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid` AND MI.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $jml_item = $list_data->num_rows();

                //table wilayah
                //                $sql= "
                //                        SELECT 'kab' kate, K.`id` ,K.`id_kab` kode,K.`nama_kabupaten` nmpkab
                //                        FROM `tbl_user_kabkot` A
                //                        JOIN `kabupaten` K ON K.`id`=A.`idkabkot`
                //                        WHERE A.`iduser`=? AND K.urutan ='0'";
                //                $bind = array($session->id);
                //LIST KABUPATEN
                $sql = "SELECT 'kab' kate,A.`id` idkab,K.id mapid,K.id_kab kode ,K.`nama_kabupaten` nmpkab,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_kabkot`  A
                            JOIN `kabupaten` K ON K.`id`=A.`idkabkot` AND K.`urutan`=0
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_kabkot` W
                                    JOIN `t_mdl1_skor_kabkota` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB')
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                            ) JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN(
				SELECT W.`idkabkot` idkab,COUNT(1) jml
				FROM `tbl_user_kabkot` W
				JOIN `t_mdl1_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
				WHERE W.`iduser`=?
				GROUP BY W.`idkabkot`
                            ) RS ON RS.idkab=A.`idkabkot`
                            LEFT JOIN `t_mdl1_sttment_kabkota` ST ON ST.mapid=A.id
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
                        $tmp .= " data-nmpkk='" . $v->nmpkab . "'";

                        $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                        $str .= "<div style='display: flex; align-items: center;'>";
                        $str .= "<img src='" . base_url() . "assets/icons/PNG_KabupatenKota/" . $v->kode . "_" . $v->nmpkab . ".png' alt='" . $v->nmpkab . "' title='" . $v->nmpkab . "' width='100' height='100' style='padding: 15px;'>";
                        $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                        $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                        $str .= "<h4>" . $v->nmpkab . "</h4>";
                        $str .= "<div class='btn-wilayah' style='float: right;'>";
                        //                        //status
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
                        //                        $str .= "<a href='javascript:void(0)' ".$tmp." style='border-radius: 0px; padding-left: 10px;'>Unduh Nilai <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
                        $str .= "";
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
            echo "Session expired, silakan login";
        }
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        $nama = $this->session->userdata(SESSION_LOGIN)->name;

        $provcomb = decrypt_base64($_GET['token']);
        $tmp2 = explode('-', $provcomb);
        if (count($tmp2) != 2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp2[0];
        $idwil = $tmp2[1];

        //$user
        $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid "
            . "FROM `tbl_user_kabkot` W "
            . "JOIN `kabupaten` P ON W.idkabkot = P.id "
            . "JOIN `tbl_user` U ON W.iduser = U.id "
            . "WHERE W.iduser='$user' AND W.idkabkot='$idwil'";
        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nilai = $d->id;
            $user_d = $d->userid;
            $namakab = $d->nama_kabupaten;
        }
        
        $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
        FROM `r_mdl1_item` IT
        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB')
        JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
        JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
        JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
        LEFT JOIN `t_mdl1_resume_kabkota` RES ON RES.`aspekid` = A.id AND RES.mapid ='$nilai'
        LEFT JOIN(
                SELECT I.`id` iditem,II.`skor`
                FROM `t_mdl1_skor_kabkota` SK
                JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                WHERE SK.`mapid`='$nilai'
        ) SKOR ON SKOR.iditem=IT.`id`
        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC";


        $list_data  = $this->db->query($status_sql);

        $nmkriteriaCount = [];
        $nmindiCount = [];
        
        foreach ($list_data->result_array() as $item) {
            $nmkriteria = $item['nmkriteria'];
            if (isset($nmkriteriaCount[$nmkriteria])) {
                $nmkriteriaCount[$nmkriteria]++;
            } else {
                $nmkriteriaCount[$nmkriteria] = 1;
            }
            
            $nmindi = $item['nmindi'];
            if (isset($nmindiCount[$nmindi])) {
                $nmindiCount[$nmindi]++;
            } else {
                $nmindiCount[$nmindi] = 1;
            }
        }
        //list indikator skor
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

        $headerRow = 10;

        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2024");
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A2', "Kriteria dan Indikator Penilaian Dokumen RKPD");
       
        $this->excel->getActiveSheet()->mergeCells('A2:K2');

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
    
        
        $inisialRow = 12;
        $startRow = 12; // Starting row for merging
        $excel = $this->excel->getActiveSheet(); // Get the active sheet
        
        foreach ($nmkriteriaCount as $criteria => $count) {
            $endRow = $startRow + $count - 1;
            $excel->mergeCells("A{$startRow}:A{$endRow}"); 
            $excel->mergeCells("B{$startRow}:B{$endRow}"); 
            $excel->mergeCells("H{$startRow}:H{$endRow}"); 
            $excel->mergeCells("I{$startRow}:I{$endRow}"); 
            $startRow = $endRow + 1; 
        }
        

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
            $index_excelColumn = 0;
            $row++;
        }
        
        $startRowIndikator = 12; // Starting rowIndkator for merging
        $excel = $this->excel->getActiveSheet(); // Get the active sheet
        foreach ($nmindiCount as $indikator => $count) {
            $endRowIndkator = $startRowIndikator + $count - 1;
            $excel->mergeCells("C{$startRowIndikator}:C{$endRowIndkator}"); 
            $excel->mergeCells("D{$startRowIndikator}:D{$endRowIndkator}"); 
            $excel->mergeCells("J{$startRowIndikator}:J{$endRowIndkator}"); 
            $excel->setCellValue("J{$startRowIndikator}", "=10*SUM(G{$startRowIndikator}:G{$endRowIndkator})/COUNT(E{$startRowIndikator}:E{$endRowIndkator})");
            $excel->mergeCells("K{$startRowIndikator}:K{$endRowIndkator}"); 
            $excel->mergeCells("L{$startRowIndikator}:L{$endRowIndkator}"); 
            $excel->setCellValue("L{$startRowIndikator}", "=J{$startRowIndikator}*K{$startRowIndikator}");

            $startRowIndikator = $endRowIndkator + 1; 
        }
        
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
        
        $endnilai = $startRowIndikator-1;
        $endbottomrow = $startRowIndikator;
        
        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, "A{$headerRow}:L{$endbottomrow}");

        $this->excel->getActiveSheet()->getStyle("L{$inisialRow}:L{$endnilai}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $this->excel->getActiveSheet()->getStyle("J{$inisialRow}:J{$endnilai}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        
        $this->excel->getActiveSheet()->setCellValue("A{$endbottomrow}", "TOTAL");
        $this->excel->getActiveSheet()->mergeCells("A{$endbottomrow}:K{$endbottomrow}");
        $this->excel->getActiveSheet()->setCellValue("L{$endbottomrow}", "=SUM(L{$inisialRow}:L{$endnilai})");
        $this->excel->getActiveSheet()->getStyle("L{$endbottomrow}:L{$endbottomrow}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        $this->excel->getActiveSheet()->getStyle("G{$inisialRow}:G{$startRowIndikator}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle("J{$inisialRow}:L{$startRowIndikator}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle("D{$inisialRow}:I{$startRowIndikator}")->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getStyle("A{$endbottomrow}:L{$endbottomrow}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $this->excel->getActiveSheet()->getStyle("A{$inisialRow}:A{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("B{$inisialRow}:B{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("C{$inisialRow}:C{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("D{$inisialRow}:D{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("E{$inisialRow}:E{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("H{$inisialRow}:H{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("I{$inisialRow}:I{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("J{$inisialRow}:J{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("K{$inisialRow}:K{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle("l{$inisialRow}:l{$startRowIndikator}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        //font
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setName('CMIIW');
        $this->excel->getActiveSheet()->getStyle('A10:A11')->getFont()->setName('CMIIW');
        //$this->excel->getActiveSheet()->getStyle('A203')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("A{$endbottomrow}:L{$endbottomrow}")->getFont()->setBold(true);
        //size    
        $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle("A{$endbottomrow}")->getFont()->setSize(18);
        $this->excel->getActiveSheet()->getStyle("L{$endbottomrow}")->getFont()->setSize(18);



        $this->excel->getActiveSheet()->setShowGridlines(False);
        //                $this->excel->getActiveSheet()->getStyle('D12:D181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
        //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul1_" . $user_d . "_" . $namakab . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
    function Download_nilai1()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            echo 'Invalid Token, silakan logon sistem';
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
        $_arr = array("PROV", "kab", "KOT");
        if (!in_array($kate_wlyh, $_arr)) {
            echo 'Invalid ID';
            exit();
        }

        //$user
        $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid
                            FROM `tbl_user_kabkot` W
                            JOIN `kabupaten` P ON W.idkabkot = P.id
                            JOIN `tbl_user` U ON W.iduser = U.id
                            WHERE W.iduser='$user' AND W.idkabkot='$idwil'";

        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nilai = $d->id;
            $user_d = $d->userid;
            $namakab = $d->nama_kabupaten;
        }


        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap Nilai ');

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

        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:L193');

        $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
        $this->excel->getActiveSheet()->mergeCells('A4:B4');
        $this->excel->getActiveSheet()->setCellValue('C4', ":");
        $this->excel->getActiveSheet()->setCellValue('A5', "Daerah Yang Dinilai ");
        $this->excel->getActiveSheet()->mergeCells('A5:B5');
        $this->excel->getActiveSheet()->setCellValue('C5', ":");
        $this->excel->getActiveSheet()->setCellValue('D4', "$nama");
        $this->excel->getActiveSheet()->setCellValue('D5', "$namakab");
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A2:B2');
        $this->excel->getActiveSheet()->mergeCells('A3:B3');

        //                
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
        $this->excel->getActiveSheet()->setCellValue("A193", "TOTAL");

        $this->excel->getActiveSheet()->getStyle('A193:L193')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $this->excel->getActiveSheet()->mergeCells('A12:A95');
        $this->excel->getActiveSheet()->mergeCells('A96:A105');
        $this->excel->getActiveSheet()->mergeCells('A106:A121');
        $this->excel->getActiveSheet()->mergeCells('A122:A165');
        $this->excel->getActiveSheet()->mergeCells('A166:A192');

        $this->excel->getActiveSheet()->mergeCells('B12:B95');
        $this->excel->getActiveSheet()->mergeCells('B96:B105');
        $this->excel->getActiveSheet()->mergeCells('B106:B121');
        $this->excel->getActiveSheet()->mergeCells('B122:B165');
        $this->excel->getActiveSheet()->mergeCells('B166:B192');

        $this->excel->getActiveSheet()->mergeCells('C12:C20');
        $this->excel->getActiveSheet()->mergeCells('C21:C33');
        $this->excel->getActiveSheet()->mergeCells('C34:C50');
        $this->excel->getActiveSheet()->mergeCells('C51:C71');
        $this->excel->getActiveSheet()->mergeCells('C72:C78');
        $this->excel->getActiveSheet()->mergeCells('C79:C88');
        $this->excel->getActiveSheet()->mergeCells('C89:C95');
        $this->excel->getActiveSheet()->mergeCells('C96:C99');
        $this->excel->getActiveSheet()->mergeCells('C100:C105');
        $this->excel->getActiveSheet()->mergeCells('C106:C110');
        $this->excel->getActiveSheet()->mergeCells('C111:C113');
        $this->excel->getActiveSheet()->mergeCells('C114:C118');
        $this->excel->getActiveSheet()->mergeCells('C119:C121');
        $this->excel->getActiveSheet()->mergeCells('C122:C126');
        $this->excel->getActiveSheet()->mergeCells('C127:C134');
        $this->excel->getActiveSheet()->mergeCells('C135:C138');
        $this->excel->getActiveSheet()->mergeCells('C139:C142');
        $this->excel->getActiveSheet()->mergeCells('C143:C146');
        $this->excel->getActiveSheet()->mergeCells('C147:C150');
        $this->excel->getActiveSheet()->mergeCells('C151:C154');
        $this->excel->getActiveSheet()->mergeCells('C155:C160');
        $this->excel->getActiveSheet()->mergeCells('C161:C165');
        $this->excel->getActiveSheet()->mergeCells('C166:C177');
        $this->excel->getActiveSheet()->mergeCells('C178:C192');

        $this->excel->getActiveSheet()->mergeCells('D12:D20');
        $this->excel->getActiveSheet()->mergeCells('D21:D33');
        $this->excel->getActiveSheet()->mergeCells('D34:D50');
        $this->excel->getActiveSheet()->mergeCells('D51:D71');
        $this->excel->getActiveSheet()->mergeCells('D72:D78');
        $this->excel->getActiveSheet()->mergeCells('D79:D88');
        $this->excel->getActiveSheet()->mergeCells('D89:D95');
        $this->excel->getActiveSheet()->mergeCells('D96:D99');
        $this->excel->getActiveSheet()->mergeCells('D100:D105');
        $this->excel->getActiveSheet()->mergeCells('D106:D110');
        $this->excel->getActiveSheet()->mergeCells('D111:D113');
        $this->excel->getActiveSheet()->mergeCells('D114:D118');
        $this->excel->getActiveSheet()->mergeCells('D119:D121');
        $this->excel->getActiveSheet()->mergeCells('D122:D126');
        $this->excel->getActiveSheet()->mergeCells('D127:D134');
        $this->excel->getActiveSheet()->mergeCells('D135:D138');
        $this->excel->getActiveSheet()->mergeCells('D139:D142');
        $this->excel->getActiveSheet()->mergeCells('D143:D146');
        $this->excel->getActiveSheet()->mergeCells('D147:D150');
        $this->excel->getActiveSheet()->mergeCells('D151:D154');
        $this->excel->getActiveSheet()->mergeCells('D155:D160');
        $this->excel->getActiveSheet()->mergeCells('D161:D165');
        $this->excel->getActiveSheet()->mergeCells('D166:D177');
        $this->excel->getActiveSheet()->mergeCells('D178:D192');

        $this->excel->getActiveSheet()->mergeCells('H12:H95');
        $this->excel->getActiveSheet()->mergeCells('H96:H165');
        $this->excel->getActiveSheet()->mergeCells('H166:H192');

        $this->excel->getActiveSheet()->mergeCells('I12:I95');
        $this->excel->getActiveSheet()->mergeCells('I96:I165');
        $this->excel->getActiveSheet()->mergeCells('I166:I192');

        $this->excel->getActiveSheet()->mergeCells('A193:k193');

        $status_sql = "SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
                            FROM `r_mdl1_item` IT
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KAB')
                            JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                            JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                            JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                            LEFT JOIN `t_mdl1_resume_kabkota` RES ON RES.`aspekid` = A.id AND RES.mapid ='$nilai'
                            LEFT JOIN(
                                    SELECT I.`id` iditem,II.`skor`
                                    FROM `t_mdl1_skor_kabkota` SK
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    WHERE SK.`mapid`='$nilai'
                            ) SKOR ON SKOR.iditem=IT.`id`
                ORDER BY IND.`nourut`,IT.subindiid, IT.`nourut`";


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

            $index_excelColumn = 0;
            $row++;
        }

        $this->excel->getActiveSheet()->mergeCells('J12:J20');
        $this->excel->getActiveSheet()->setCellValue("J12", "=10*SUM(G12:G20)/COUNT(E12:E20))");
        $this->excel->getActiveSheet()->mergeCells('J21:J33');
        $this->excel->getActiveSheet()->setCellValue("J21", "=10*SUM(G21:G33)/COUNT(E21:E33))");
        $this->excel->getActiveSheet()->mergeCells('J34:J50');
        $this->excel->getActiveSheet()->setCellValue("J34", "=10*SUM(G34:G50)/COUNT(E34:E50))");
        $this->excel->getActiveSheet()->mergeCells('J51:J71');
        $this->excel->getActiveSheet()->setCellValue("J51", "=10*SUM(G51:G71)/COUNT(E51:E71))");
        $this->excel->getActiveSheet()->mergeCells('J72:J78');
        $this->excel->getActiveSheet()->setCellValue("J72", "=10*SUM(G72:G78)/COUNT(E72:E78))");
        $this->excel->getActiveSheet()->mergeCells('J79:J88');
        $this->excel->getActiveSheet()->setCellValue("J79", "=10*SUM(G79:G88)/COUNT(E79:E88))");
        $this->excel->getActiveSheet()->mergeCells('J89:J95');
        $this->excel->getActiveSheet()->setCellValue("J89", "=10*SUM(G89:G95)/COUNT(E89:E95))");
        $this->excel->getActiveSheet()->mergeCells('J96:J99');
        $this->excel->getActiveSheet()->setCellValue("J96", "=10*SUM(G96:G99)/COUNT(E96:E99))");
        $this->excel->getActiveSheet()->mergeCells('J100:J105');
        $this->excel->getActiveSheet()->setCellValue("J100", "=10*SUM(G100:G105)/COUNT(E100:E105))");
        $this->excel->getActiveSheet()->mergeCells('J106:J110');
        $this->excel->getActiveSheet()->setCellValue("J106", "=10*SUM(G106:G110)/COUNT(E106:E110))");
        $this->excel->getActiveSheet()->mergeCells('J111:J113');
        $this->excel->getActiveSheet()->setCellValue("J111", "=10*SUM(G111:G113)/COUNT(E111:E113))");
        $this->excel->getActiveSheet()->mergeCells('J114:J118');
        $this->excel->getActiveSheet()->setCellValue("J114", "=10*SUM(G114:G118)/COUNT(E114:E118))");
        $this->excel->getActiveSheet()->mergeCells('J119:J121');
        $this->excel->getActiveSheet()->setCellValue("J119", "=10*SUM(G119:G121)/COUNT(E119:E121))");
        $this->excel->getActiveSheet()->mergeCells('J122:J126');
        $this->excel->getActiveSheet()->setCellValue("J122", "=10*SUM(G122:G126)/COUNT(E122:E126))");
        $this->excel->getActiveSheet()->mergeCells('J127:J134');
        $this->excel->getActiveSheet()->setCellValue("J127", "=10*SUM(G127:G134)/COUNT(E127:E134))");
        $this->excel->getActiveSheet()->mergeCells('J135:J138');
        $this->excel->getActiveSheet()->setCellValue("J135", "=10*SUM(G135:G138)/COUNT(E135:E138))");
        $this->excel->getActiveSheet()->mergeCells('J139:J142');
        $this->excel->getActiveSheet()->setCellValue("J139", "=10*SUM(G139:G142)/COUNT(E139:E142))");
        $this->excel->getActiveSheet()->mergeCells('J143:J146');
        $this->excel->getActiveSheet()->setCellValue("J143", "=10*SUM(G143:G146)/COUNT(E143:E146))");
        $this->excel->getActiveSheet()->mergeCells('J147:J150');
        $this->excel->getActiveSheet()->setCellValue("J147", "=10*SUM(G147:G150)/COUNT(E147:E150))");
        $this->excel->getActiveSheet()->mergeCells('J151:J154');
        $this->excel->getActiveSheet()->setCellValue("J151", "=10*SUM(G151:G154)/COUNT(E151:E154))");
        $this->excel->getActiveSheet()->mergeCells('J155:J160');
        $this->excel->getActiveSheet()->setCellValue("J155", "=10*SUM(G155:G160)/COUNT(E155:E160))");
        $this->excel->getActiveSheet()->mergeCells('J161:J165');
        $this->excel->getActiveSheet()->setCellValue("J161", "=10*SUM(G161:G165)/COUNT(E161:E165))");
        $this->excel->getActiveSheet()->mergeCells('J166:J177');
        $this->excel->getActiveSheet()->setCellValue("J166", "=10*SUM(G166:G177)/COUNT(E166:E177))");
        $this->excel->getActiveSheet()->mergeCells('J178:J192');
        $this->excel->getActiveSheet()->setCellValue("J178", "=10*SUM(G178:G192)/COUNT(E178:E192))");
        $this->excel->getActiveSheet()->getStyle('J12:J192')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);


        $this->excel->getActiveSheet()->mergeCells('K12:K20');
        $this->excel->getActiveSheet()->mergeCells('K21:K33');
        $this->excel->getActiveSheet()->mergeCells('K34:K50');
        $this->excel->getActiveSheet()->mergeCells('K51:K71');
        $this->excel->getActiveSheet()->mergeCells('K72:K78');
        $this->excel->getActiveSheet()->mergeCells('K79:K88');
        $this->excel->getActiveSheet()->mergeCells('K89:K95');
        $this->excel->getActiveSheet()->mergeCells('K96:K99');
        $this->excel->getActiveSheet()->mergeCells('K100:k105');
        $this->excel->getActiveSheet()->mergeCells('K106:K110');
        $this->excel->getActiveSheet()->mergeCells('K111:K113');
        $this->excel->getActiveSheet()->mergeCells('K114:K118');
        $this->excel->getActiveSheet()->mergeCells('K119:K121');
        $this->excel->getActiveSheet()->mergeCells('K122:K126');
        $this->excel->getActiveSheet()->mergeCells('K127:K134');
        $this->excel->getActiveSheet()->mergeCells('K135:K138');
        $this->excel->getActiveSheet()->mergeCells('K139:K142');
        $this->excel->getActiveSheet()->mergeCells('K143:K146');
        $this->excel->getActiveSheet()->mergeCells('K147:K150');
        $this->excel->getActiveSheet()->mergeCells('K151:K154');
        $this->excel->getActiveSheet()->mergeCells('K155:K160');
        $this->excel->getActiveSheet()->mergeCells('K161:K165');
        $this->excel->getActiveSheet()->mergeCells('K166:K177');
        $this->excel->getActiveSheet()->mergeCells('K178:K192');


        $this->excel->getActiveSheet()->mergeCells('L12:L20');
        $this->excel->getActiveSheet()->setCellValue("L12", "=J12*K12");
        $this->excel->getActiveSheet()->mergeCells('L21:L33');
        $this->excel->getActiveSheet()->setCellValue("L21", "=J21*K21");
        $this->excel->getActiveSheet()->mergeCells('L34:L50');
        $this->excel->getActiveSheet()->setCellValue("L34", "=J34*K34");
        $this->excel->getActiveSheet()->mergeCells('L51:L71');
        $this->excel->getActiveSheet()->setCellValue("L51", "=J51*K51");
        $this->excel->getActiveSheet()->mergeCells('L72:L78');
        $this->excel->getActiveSheet()->setCellValue("L72", "=J72*K72");
        $this->excel->getActiveSheet()->mergeCells('L79:L88');
        $this->excel->getActiveSheet()->setCellValue("L79", "=J79*K79");
        $this->excel->getActiveSheet()->mergeCells('L89:L95');
        $this->excel->getActiveSheet()->setCellValue("L89", "=J89*K89");
        $this->excel->getActiveSheet()->mergeCells('L96:L99');
        $this->excel->getActiveSheet()->setCellValue("L96", "=J96*K96");
        $this->excel->getActiveSheet()->mergeCells('L100:L105');
        $this->excel->getActiveSheet()->setCellValue("L100", "=J100*K100");
        $this->excel->getActiveSheet()->mergeCells('L106:L110');
        $this->excel->getActiveSheet()->setCellValue("L106", "=J106*K106");
        $this->excel->getActiveSheet()->mergeCells('L111:L113');
        $this->excel->getActiveSheet()->setCellValue("L111", "=J111*K111");
        $this->excel->getActiveSheet()->mergeCells('L114:L118');
        $this->excel->getActiveSheet()->setCellValue("L114", "=J114*K114");
        $this->excel->getActiveSheet()->mergeCells('L119:L121');
        $this->excel->getActiveSheet()->setCellValue("L119", "=J119*K119");
        $this->excel->getActiveSheet()->mergeCells('L122:L126');
        $this->excel->getActiveSheet()->setCellValue("L122", "=J122*K122");
        $this->excel->getActiveSheet()->mergeCells('L127:L134');
        $this->excel->getActiveSheet()->setCellValue("L127", "=J127*K127");
        $this->excel->getActiveSheet()->mergeCells('L135:L138');
        $this->excel->getActiveSheet()->setCellValue("L135", "=J135*K135");
        $this->excel->getActiveSheet()->mergeCells('L139:L142');
        $this->excel->getActiveSheet()->setCellValue("L139", "=J139*K139");
        $this->excel->getActiveSheet()->mergeCells('L143:L146');
        $this->excel->getActiveSheet()->setCellValue("L143", "=J143*K143");
        $this->excel->getActiveSheet()->mergeCells('L147:L150');
        $this->excel->getActiveSheet()->setCellValue("L147", "=J147*K147");
        $this->excel->getActiveSheet()->mergeCells('L151:L154');
        $this->excel->getActiveSheet()->setCellValue("L151", "=J151*K151");
        $this->excel->getActiveSheet()->mergeCells('L155:L160');
        $this->excel->getActiveSheet()->setCellValue("L155", "=J155*K155");
        $this->excel->getActiveSheet()->mergeCells('L161:L165');
        $this->excel->getActiveSheet()->setCellValue("L161", "=J161*K161");
        $this->excel->getActiveSheet()->mergeCells('L166:L177');
        $this->excel->getActiveSheet()->setCellValue("L166", "=J166*K166");
        $this->excel->getActiveSheet()->mergeCells('L178:L192');
        $this->excel->getActiveSheet()->setCellValue("L178", "=J178*K178");
        $this->excel->getActiveSheet()->getStyle('L12:L193')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

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

        $this->excel->getActiveSheet()->setCellValue("L193", "=SUM(L12:L192)");

        $this->excel->getActiveSheet()->getStyle('D12:F192' . $this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
        //$this->excel->getActiveSheet()->getStyle('H12:H192'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 
        $this->excel->getActiveSheet()->getStyle('G12:G192')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('J12:L192')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A193:L193')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        //$this->excel->getActiveSheet()->getStyle('B12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('A12:A192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B12:B192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('C12:C192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('D12:D192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('E12:E192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('H12:H192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('I12:I192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('J12:J192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('K12:K192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('l12:l192')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

        //$this->excel->getActiveSheet()->getStyle('G10:G192')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
        $this->excel->getActiveSheet()->getStyle('J10:L192')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //font
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setName('CMIIW');
        $this->excel->getActiveSheet()->getStyle('A10:A11')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A193:L193')->getFont()->setBold(true);
        //size    
        $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A10:L11')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A193')->getFont()->setSize(18);
        $this->excel->getActiveSheet()->getStyle('L193')->getFont()->setSize(18);

        $this->excel->getActiveSheet()->setShowGridlines(False);

        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul1_" . $user_d . "_" . $namakab . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
