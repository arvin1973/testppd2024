<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PPD2_unduh_nilai extends CI_Controller {
    var $view_dir   = "ppd2/PPD2_unduh_nilai/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD2_unduh_nilai/unduh_nilai.js";
    
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");
        $this->load->library("Excel");
    }
    
    /*
     * 
     */
    public function index(){
        if($this->input->is_ajax_request()){
            try 
            {                
                if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                //common properties
                $this->js_init    = "main";
                $this->js_tedit    = "main";
                $this->js_path    = "assets/js/admin/PPD2_unduh_nilai/unduh_nilai_".$this->session->userdata(SESSION_LOGIN)->groupid.".js";
                

                $data_page = array( );
                $str = $this->load->view($this->view_dir."content_PPD2",$data_page,TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init.".init();",
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

        }
        else{
            exit("access denied!");
        }
    }
    
   
    function Download_nilai(){
        if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
        //$id = $_GET['wl'];
        $idwilayah = $_GET['wl'];
        //print_r($idwilayah);exit();
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        //$idind = decrypt_text($_GET['in']);

           
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        $this->excel->getSheet(0)->setTitle('Rekap Nilai ');

        $this->excel->getActiveSheet()->getStyle('B115')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_TOP);
        $this->excel->getActiveSheet()->getStyle('B120')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
        
        
                //garis
                $sharedStyleTitles->applyFromArray(
                        array('borders' => 
                            array(
                                'bottom'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                'top'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                'left'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                                'right'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                            )
                        ));
//                 $styleTopalign->applyFromArray(
//                        array('alignment' => 
//                            array(
//                                'vertical'=> array('style' => PHPExcel_Style_Alignment::VERTICAL_TOP),
//                            )
//                        ));
//                $this->excel->getActiveSheet()->setSharedStyle($styleTopalign, 'C7:F19');
//                $this->excel->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2021");
                $this->excel->getActiveSheet()->mergeCells('A1:V1');
                $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->setCellValue('A2', "Kriteria dan Indikator Penilaian Dokumen RKPD");
                $this->excel->getActiveSheet()->mergeCells('A2:V2');
//                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:V11');
//                
                $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
                $this->excel->getActiveSheet()->mergeCells('A4:B4');
                $this->excel->getActiveSheet()->setCellValue('C4', ":");
                $this->excel->getActiveSheet()->setCellValue('A5', "Daerah 1 Yang Dinilai ");
                $this->excel->getActiveSheet()->mergeCells('A5:B5');
                $this->excel->getActiveSheet()->setCellValue('C5', ":");
                $this->excel->getActiveSheet()->setCellValue('A6', "Daerah 2 Yang Dinilai");
                $this->excel->getActiveSheet()->mergeCells('A6:B6');
                $this->excel->getActiveSheet()->setCellValue('C6', ":");
                $this->excel->getActiveSheet()->setCellValue('A7', "Daerah 3 Yang Dinilai");
                $this->excel->getActiveSheet()->mergeCells('A7:B7');
                $this->excel->getActiveSheet()->setCellValue('C7', ":");
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
                $this->excel->getActiveSheet()->mergeCells('G10:I10');
                $this->excel->getActiveSheet()->setCellValue("G11", "");
                $this->excel->getActiveSheet()->setCellValue("H11", "");
                $this->excel->getActiveSheet()->setCellValue("I11", "");
                $this->excel->getActiveSheet()->setCellValue("J10", "CATATAN");
                $this->excel->getActiveSheet()->mergeCells('J10:L10');
                $this->excel->getActiveSheet()->setCellValue("J11", "");
                $this->excel->getActiveSheet()->setCellValue("K11", "");
                $this->excel->getActiveSheet()->setCellValue("L11", "");
                $this->excel->getActiveSheet()->setCellValue("M10", "MASUKAN DAN SARAN");
                $this->excel->getActiveSheet()->mergeCells('M10:O10');
                $this->excel->getActiveSheet()->setCellValue("M11", "");
                $this->excel->getActiveSheet()->setCellValue("N11", "");
                $this->excel->getActiveSheet()->setCellValue("O11", "");
                $this->excel->getActiveSheet()->setCellValue("P10", "SKOR");
                $this->excel->getActiveSheet()->mergeCells('P10:R10');
                $this->excel->getActiveSheet()->setCellValue("P11", "");
                $this->excel->getActiveSheet()->setCellValue("Q11", "");
                $this->excel->getActiveSheet()->setCellValue("R11", "");
                $this->excel->getActiveSheet()->setCellValue("S10", "BOBOT");
                $this->excel->getActiveSheet()->mergeCells('S10:S11');
                $this->excel->getActiveSheet()->setCellValue("T10", "NILAI TERBOBOT");
                $this->excel->getActiveSheet()->mergeCells('T10:V10');
                $this->excel->getActiveSheet()->setCellValue("T11", "");
                $this->excel->getActiveSheet()->setCellValue("U11", "");
                $this->excel->getActiveSheet()->setCellValue("V11", "");
                $this->excel->getActiveSheet()->getStyle('A10:V11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                
                //$user
                //list provinsi
                $select_prov="SELECT A.`id` mapid,P.`nama_provinsi` nmprov,P.`label`,JML.jml
                        FROM tbl_user_wilayah A
                        JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                        LEFT JOIN(
                                SELECT W.`idwilayah` idprov,COUNT(1) jml
                                FROM `tbl_user_wilayah` W
                                JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
                                JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                WHERE W.`iduser`='".$user."'
                                GROUP BY W.`idwilayah`
                        ) JML ON JML.idprov=A.`idwilayah`
                        WHERE A.`iduser`='".$user."'";
//                print_r($select_prov);exit();
                $list_prov  = $this->db->query($select_prov);
                $excelColumnP = range('A', 'ZZ');
                $index_excelColumnP = 3;
                $rowP =5;
                foreach ($list_prov->result() as $p) {
                    $this->excel->getActiveSheet()->setCellValue($excelColumnP[$index_excelColumnP++].$rowP, $p->nmprov);
                    $index_excelColumnP=3;
                    $rowP++;
                }
                
                $status_sql="SELECT K.`nama` nmkriteria,I.nourut,I.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem
                            ,ISI.skor skor
                            FROM `r_mdl1_item` IT
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid`
                            JOIN `r_mdl1_indi` I ON I.`id`=SI.`indiid`
                            JOIN `r_mdl1_krtria` K ON K.`id`=I.`krtriaid`
                            LEFT JOIN(
                                    SELECT I.`id` iditem,II.`skor`,II.`id` indiitemid
                                    FROM `tbl_user_wilayah` W
                                    JOIN `t_mdl1_skor_prov` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl1_item_indi` II ON II.`id`=SKR.`itemindi`
                                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                                    JOIN `r_mdl1_sub_indi` SI ON SI.`id`=I.`subindiid`
                                    JOIN `r_mdl1_indi` MI ON MI.`id`=SI.`indiid`
                                    WHERE W.`id`='".$user."'
                                    
                            ) ISI ON ISI.iditem=IT.`id`
                            WHERE 1=1
                            ORDER BY SI.`nourut`,IT.`nourut`,I.id ASC";
                
                $list_data  = $this->db->query($status_sql);
                $excelColumn = range('A', 'ZZ');
                $index_excelColumn = 4;
                $row =12;
                foreach ($list_data->result() as $value) {
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nourut);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nmitem);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->skor);
                    $index_excelColumn=4;
                    $row++;
                }
                //lebar kolom
                $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
                $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
                $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("2.55");
                $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("39.18");
                $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
                $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("62.64");
                $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("19.82");
                $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("19.82");
                $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("19.82");
                $this->excel->getActiveSheet()->getColumnDimension("J")->setWidth("116.36");
                $this->excel->getActiveSheet()->getColumnDimension("K")->setWidth("86.45");
                
//                $this->excel->getActiveSheet()->getColumnDimension("F")->setWrapText(true);
                $this->excel->getActiveSheet()->getStyle('F12:F181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 

             //   $this->excel->getActiveSheet()->getStyle('F'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 

                
//                $this->excel->getActiveSheet()->setCellValue("P12", "=IF(COUNT(G12:G20)=COUNT(E12:E20),(SUM(G12:G20)/COUNT(G12:G20))*10,'Isian Belum Lengkap')");
                
//                $this->excel->getActiveSheet()->mergeCells('B7:B8');
//                $this->excel->getActiveSheet()->setCellValue("C7", "Item Penilaian");
//                
//                $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("35");
//                 
//                $this->excel->getActiveSheet()->setCellValue("D7", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D7:E7');
//  //              $this->excel->getActiveSheet()->getStyle('D7:E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//                $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("18");
//                $this->excel->getActiveSheet()->setCellValue("D8", "0");
//                $this->excel->getActiveSheet()->setCellValue("E8", "1");
//                $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("18");
//                $this->excel->getActiveSheet()->setCellValue("F7", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F7:F8');
//                $this->excel->getActiveSheet()->setCellValue("B18", "Jumlah Skor");
//                
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F5:F6');
//                $this->excel->getActiveSheet()->setCellValue("F5", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F6", "=(SUM(F9:F17)/COUNT(B9:B17))*10");
//                $this->excel->getActiveSheet()->setCellValue("F18", "=SUM(F9:F17)");
                
//                $this->excel->getActiveSheet()->getStyle('B7:F4')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('B18')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C9:E17')->getAlignment()->setWrapText(true);
//                $this->excel->getActiveSheet()->getStyle('B7:B17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//                $this->excel->getActiveSheet()->getStyle('C7:F8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//                $this->excel->getActiveSheet()->getStyle('F5:F18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//                $this->excel->getActiveSheet()->getStyle('F6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//                $this->excel->getActiveSheet()->mergeCells('B18:E18');
//
//                
//                $this->excel->getActiveSheet()->setCellValue('A21', '2');
//                $this->excel->getActiveSheet()->setCellValue('B21', 'Tingkat Pengangguran Terbuka (TPT)dan Jumlah Pengangguran');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F21:F22');
//                $this->excel->getActiveSheet()->setCellValue("F21", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("B22", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C22", "6,00%");
//                
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B23:F32');
//                $this->excel->getActiveSheet()->setCellValue("B23", "No");
//                $this->excel->getActiveSheet()->mergeCells('B23:B24');
//                $this->excel->getActiveSheet()->setCellValue("C23", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C23:C24');
//                $this->excel->getActiveSheet()->setCellValue("D23", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D23:E24');
//                $this->excel->getActiveSheet()->setCellValue("D24", "0");
//                $this->excel->getActiveSheet()->setCellValue("E24", "1");
//                $this->excel->getActiveSheet()->setCellValue("F23", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F23:F24');
//                $this->excel->getActiveSheet()->setCellValue("B32", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B32:E32');
//                $this->excel->getActiveSheet()->setCellValue("F32", "=SUM(F25:F31)");
//                $this->excel->getActiveSheet()->setCellValue("F22", "=(SUM(F25:F31)/COUNT(B25:B31))*10");
//                $this->excel->getActiveSheet()->getStyle('B23:B31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
//                $this->excel->getActiveSheet()->getStyle('B32')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C25:E31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//                $this->excel->getActiveSheet()->getStyle('F22')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//                $this->excel->getActiveSheet()->getStyle('C25:E31')->getAlignment()->setWrapText(true);
//                $this->excel->getActiveSheet()->getStyle('F21:F32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
//                $this->excel->getActiveSheet()->setCellValue('A34', '3');
//                $this->excel->getActiveSheet()->setCellValue('B34', 'Kemiskinan');
//                $this->excel->getActiveSheet()->setCellValue("B35", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C35", "8,00%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F34:F35');
//                $this->excel->getActiveSheet()->setCellValue("F34", "Nilai");
//                //$this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B22:F30');
//                $this->excel->getActiveSheet()->setCellValue("B36", "No");
//                $this->excel->getActiveSheet()->mergeCells('B36:B37');
//                $this->excel->getActiveSheet()->setCellValue("C36", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C36:C37');
//                $this->excel->getActiveSheet()->setCellValue("D36", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D36:E36');
//                $this->excel->getActiveSheet()->setCellValue("D37", "0");
//                $this->excel->getActiveSheet()->setCellValue("E37", "1");
//                $this->excel->getActiveSheet()->setCellValue("F36", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F36:F37');
//                $this->excel->getActiveSheet()->setCellValue("B49", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B49:E49');
//                $this->excel->getActiveSheet()->setCellValue("F49", "=SUM(F37:F47)");
                
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B36:F49');
//                $this->excel->getActiveSheet()->setCellValue("F35", "=(SUM(F38:F48)/COUNT(F38:F48))*10");
//                $this->excel->getActiveSheet()->getStyle('F35')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A51", "4");
//                $this->excel->getActiveSheet()->setCellValue('B51', 'Indeks Pembangunan Manusia (IPM)');
//                $this->excel->getActiveSheet()->setCellValue("B52", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C52", "8,00%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F51:F52');
//                $this->excel->getActiveSheet()->setCellValue("F51", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F52", "=(SUM(F55:F68)/COUNT(F55:F68))*10");
//                $this->excel->getActiveSheet()->setCellValue("B53", "No");
//                $this->excel->getActiveSheet()->mergeCells('B53:B54');
//                $this->excel->getActiveSheet()->setCellValue("C53", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C53:C54');
//                $this->excel->getActiveSheet()->setCellValue("D53", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D53:E53');
//                $this->excel->getActiveSheet()->setCellValue("D54", "0");
//                $this->excel->getActiveSheet()->setCellValue("E54", "1");
//                $this->excel->getActiveSheet()->setCellValue("F53", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F53:F54');
//                $this->excel->getActiveSheet()->setCellValue("B70", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B70:E70');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B53:F70');
//                $this->excel->getActiveSheet()->getStyle('F51')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A71", "5");
//                $this->excel->getActiveSheet()->setCellValue('B71', 'Ketimpangan');
//                $this->excel->getActiveSheet()->setCellValue("B72", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C72", "8,00%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F71:F72');
//                $this->excel->getActiveSheet()->setCellValue("F71", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F72", "=(SUM(F75:F81)/COUNT(F75:F81))*10");
//                $this->excel->getActiveSheet()->setCellValue("B73", "No");
//                $this->excel->getActiveSheet()->mergeCells('B73:B74');
//                $this->excel->getActiveSheet()->setCellValue("C73", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C73:C74');
//                $this->excel->getActiveSheet()->setCellValue("D73", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D73:E73');
//                $this->excel->getActiveSheet()->setCellValue("D74", "0");
//                $this->excel->getActiveSheet()->setCellValue("E74", "1");
//                $this->excel->getActiveSheet()->setCellValue("F73", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F73:F74');
//                $this->excel->getActiveSheet()->setCellValue("B82", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B82:E82');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B73:F82');
//                $this->excel->getActiveSheet()->getStyle('F72')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A84", "6");
//                $this->excel->getActiveSheet()->setCellValue('B84', 'Pelayanan Publik dan Pengelolaan Keuangan ');
//                $this->excel->getActiveSheet()->setCellValue("B85", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C85", "8,00%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F84:F85');
//                $this->excel->getActiveSheet()->setCellValue("F84", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F85", "=(SUM(F88:F97)/COUNT(F88:F97))*10");
//                $this->excel->getActiveSheet()->setCellValue("B86", "No");
//                $this->excel->getActiveSheet()->mergeCells('B86:B87');
//                $this->excel->getActiveSheet()->setCellValue("C86", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C86:C87');
//                $this->excel->getActiveSheet()->setCellValue("D86", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D86:E86');
//                $this->excel->getActiveSheet()->setCellValue("D87", "0");
//                $this->excel->getActiveSheet()->setCellValue("E87", "1");
//                $this->excel->getActiveSheet()->setCellValue("F86", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F86:F87');
//                $this->excel->getActiveSheet()->setCellValue("B98", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B98:E98');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B86:F98');
//                $this->excel->getActiveSheet()->getStyle('F85')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

//                $this->excel->getActiveSheet()->setCellValue("A100", "7");
//                $this->excel->getActiveSheet()->setCellValue('B100', 'Transparansi dan Akuntabilitas');
//                $this->excel->getActiveSheet()->setCellValue("B101", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C101", "8,00%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F100:F101');
//                $this->excel->getActiveSheet()->setCellValue("F100", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F101", "=(SUM(F104:F110)/COUNT(F104:F110))*10");
//                $this->excel->getActiveSheet()->setCellValue("B102", "No");
//                $this->excel->getActiveSheet()->mergeCells('B102:B103');
//                $this->excel->getActiveSheet()->setCellValue("C102", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C102:C103');
//                $this->excel->getActiveSheet()->setCellValue("D102", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D102:E102');
//                $this->excel->getActiveSheet()->setCellValue("D103", "0");
//                $this->excel->getActiveSheet()->setCellValue("E103", "1");
//                $this->excel->getActiveSheet()->setCellValue("F102", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F102:F103');
//                $this->excel->getActiveSheet()->setCellValue("B111", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B111:E111');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B102:F111');
//                $this->excel->getActiveSheet()->getStyle('F101')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue('B113', 'Resume Aspek Pencapaian Pembangunan ');
//                $this->excel->getActiveSheet()->setCellValue("B114", "Catatan");
//                $this->excel->getActiveSheet()->mergeCells('B115:F118');
//                $this->excel->getActiveSheet()->setCellValue('B119', 'Masukan dan Saran terhadap Aspek Pencapaian Pembangunan');
//                $this->excel->getActiveSheet()->mergeCells('B120:F123');
                //
//                $this->excel->getActiveSheet()->setCellValue("A125", "Kriteria Keterkaitan (5%)");
//                $this->excel->getActiveSheet()->setCellValue("A126", "8");
//                $this->excel->getActiveSheet()->setCellValue('B126', 'Tersedianya Penjelasan Strategi dan Arah Kebijakan RKPD 2020 yang Terkait dengan Visi dan Misi, Strategi dan Arah Kebijakan RPJMD');
//                $this->excel->getActiveSheet()->setCellValue("B127", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C127", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F126:F127');
//                $this->excel->getActiveSheet()->setCellValue("F126", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F127", "=(SUM(F130:F134)/COUNT(F130:F134))*10");
//                $this->excel->getActiveSheet()->setCellValue("B128", "No");
//                $this->excel->getActiveSheet()->mergeCells('B128:B129');
//                $this->excel->getActiveSheet()->setCellValue("C128", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C128:C129');
//                $this->excel->getActiveSheet()->setCellValue("D128", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D128:E128');
//                $this->excel->getActiveSheet()->setCellValue("D129", "0");
//                $this->excel->getActiveSheet()->setCellValue("E129", "1");
//                $this->excel->getActiveSheet()->setCellValue("F128", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F128:F129');
//                $this->excel->getActiveSheet()->setCellValue("B135", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B135:E135');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B128:F135');
//                $this->excel->getActiveSheet()->getStyle('F127')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//                $this->excel->getActiveSheet()->mergeCells('B126:E126');
//                $this->excel->getActiveSheet()->getStyle('B126')->getAlignment()->setWrapText(true);
                
//                                $this->excel->getActiveSheet()->setCellValue("A137", "9");
//                $this->excel->getActiveSheet()->setCellValue('B137', 'Tersedianya Penjelasan Keterkaitan antara Sasaran dan Prioritas Pembangunan Daerah dalam RKPD 2020 dengan Sasaran Prioritas Nasional (PN) RKP 2020');
//                $this->excel->getActiveSheet()->setCellValue("B138", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C138", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F137:F138');
//                $this->excel->getActiveSheet()->setCellValue("F137", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F138", "=(SUM(F141:F146)/COUNT(F141:F146))*10");
//                $this->excel->getActiveSheet()->setCellValue("B139", "No");
//                $this->excel->getActiveSheet()->mergeCells('B139:B140');
//                $this->excel->getActiveSheet()->setCellValue("C139", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C139:C140');
//                $this->excel->getActiveSheet()->setCellValue("D139", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D139:E139');
//                $this->excel->getActiveSheet()->setCellValue("D140", "0");
//                $this->excel->getActiveSheet()->setCellValue("E140", "1");
//                $this->excel->getActiveSheet()->setCellValue("F139", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F139:F140');
//                $this->excel->getActiveSheet()->setCellValue("B147", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B147:E147');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B139:F147');
//                $this->excel->getActiveSheet()->getStyle('F138')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//                $this->excel->getActiveSheet()->getStyle('B137')->getAlignment()->setWrapText(true);
//                $this->excel->getActiveSheet()->mergeCells('B137:E137');
                
//                $this->excel->getActiveSheet()->setCellValue("A149", "Kriteria Konsistensi (11,25%)");
//                                $this->excel->getActiveSheet()->setCellValue("A150", "10");
//                $this->excel->getActiveSheet()->setCellValue('B150', 'Terwujudnya Konsistensi antara Hasil Evaluasi Pelaksanaan RKPD 2018 dengan Permasalahan dan Isu Strategis pada RKPD 2020');
//                $this->excel->getActiveSheet()->setCellValue("B151", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C151", "3,75%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F150:F151');
//                $this->excel->getActiveSheet()->setCellValue("F150", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F151", "=(SUM(F154:F159)/COUNT(F154:F159))*10");
//                $this->excel->getActiveSheet()->setCellValue("B152", "No");
//                $this->excel->getActiveSheet()->mergeCells('B152:B153');
//                $this->excel->getActiveSheet()->setCellValue("C152", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C152:C153');
//                $this->excel->getActiveSheet()->setCellValue("D152", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D152:E152');
//                $this->excel->getActiveSheet()->setCellValue("D153", "0");
//                $this->excel->getActiveSheet()->setCellValue("E153", "1");
//                $this->excel->getActiveSheet()->setCellValue("F152", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F152:F153');
//                $this->excel->getActiveSheet()->setCellValue("B160", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B160:E160');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B152:F160');
//                $this->excel->getActiveSheet()->getStyle('F151')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A162", "11");
//                $this->excel->getActiveSheet()->setCellValue('B162', 'Terwujudnya Konsistensi antara Prioritas Pembangunan Daerah dengan Permasalahan/Isu Strategis pada RKPD 2020');
//                $this->excel->getActiveSheet()->setCellValue("B163", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C163", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F162:F163');
//                $this->excel->getActiveSheet()->setCellValue("F162", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F163", "=(SUM(F166:F168)/COUNT(F166:F168))*10");
//                $this->excel->getActiveSheet()->setCellValue("B164", "No");
//                $this->excel->getActiveSheet()->mergeCells('B164:B165');
//                $this->excel->getActiveSheet()->setCellValue("C164", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C164:C165');
//                $this->excel->getActiveSheet()->setCellValue("D164", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D164:E164');
//                $this->excel->getActiveSheet()->setCellValue("D165", "0");
//                $this->excel->getActiveSheet()->setCellValue("E165", "1");
//                $this->excel->getActiveSheet()->setCellValue("F164", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F164:F165');
//                $this->excel->getActiveSheet()->setCellValue("B169", "Jumlah Skor");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B164:F169');
//                $this->excel->getActiveSheet()->getStyle('F163')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//                
//                $this->excel->getActiveSheet()->setCellValue("A171", "12");
//                $this->excel->getActiveSheet()->setCellValue('B171', 'Terwujudnya Konsistensi antara Prioritas Pembangunan Daerah dalam RKPD 2020 dengan Program Prioritas');
//                $this->excel->getActiveSheet()->setCellValue("B172", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C172", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F171:F172');
//                $this->excel->getActiveSheet()->setCellValue("F171", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F172", "=(SUM(F175:F180)/COUNT(F175:F180))*10");
//                $this->excel->getActiveSheet()->setCellValue("B173", "No");
//                $this->excel->getActiveSheet()->mergeCells('B173:B174');
//                $this->excel->getActiveSheet()->setCellValue("C173", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C173:C174');
//                $this->excel->getActiveSheet()->setCellValue("D173", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D173:E173');
//                $this->excel->getActiveSheet()->setCellValue("D174", "0");
//                $this->excel->getActiveSheet()->setCellValue("E174", "1");
//                $this->excel->getActiveSheet()->setCellValue("F173", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F173:F174');
//                $this->excel->getActiveSheet()->setCellValue("B181", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B181:E181');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B173:F181');
//                $this->excel->getActiveSheet()->getStyle('F172')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//                
//                $this->excel->getActiveSheet()->setCellValue("A183", "13");
//                $this->excel->getActiveSheet()->setCellValue('B183', 'Terwujudnya Konsistensi antara Prioritas Pembangunan dalam RKPD 2020 dengan Pagu Anggaran');
//                $this->excel->getActiveSheet()->setCellValue("B184", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C184", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F183:F184');
//                $this->excel->getActiveSheet()->setCellValue("F183", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F184", "=(SUM(F187:F189)/COUNT(F187:F189))*10");
//                $this->excel->getActiveSheet()->setCellValue("B185", "No");
//                $this->excel->getActiveSheet()->mergeCells('B185:B186');
//                $this->excel->getActiveSheet()->setCellValue("C185", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C185:C186');
//                $this->excel->getActiveSheet()->setCellValue("D185", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D185:E185');
//                $this->excel->getActiveSheet()->setCellValue("D186", "0");
//                $this->excel->getActiveSheet()->setCellValue("E186", "1");
//                $this->excel->getActiveSheet()->setCellValue("F185", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F185:F186');
//                $this->excel->getActiveSheet()->setCellValue("B190", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B190:E190');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B185:F190');
//                $this->excel->getActiveSheet()->getStyle('F184')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//                
//                $this->excel->getActiveSheet()->setCellValue("A192", "Kriteria Kelengkapan dan Kedalaman (23,75%)");
//                $this->excel->getActiveSheet()->setCellValue("A193", "14");
//                $this->excel->getActiveSheet()->setCellValue('B193', 'Tersedianya Kerangka Ekonomi dan Kerangka Pendanaan dang Dilengkapi dengan Proyeksi dan Arah Kebijakan');
//                $this->excel->getActiveSheet()->setCellValue("B194", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C194", "3,75%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F193:F94');
//                $this->excel->getActiveSheet()->setCellValue("F193", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F194", "=(SUM(F197:F202)/COUNT(F197:F202))*10");
//                $this->excel->getActiveSheet()->setCellValue("B195", "No");
//                $this->excel->getActiveSheet()->mergeCells('B195:B196');
//                $this->excel->getActiveSheet()->setCellValue("C195", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C195:C196');
//                $this->excel->getActiveSheet()->setCellValue("D195", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D195:E195');
//                $this->excel->getActiveSheet()->setCellValue("D196", "0");
//                $this->excel->getActiveSheet()->setCellValue("E196", "1");
//                $this->excel->getActiveSheet()->setCellValue("F195", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F195:F196');
//                $this->excel->getActiveSheet()->setCellValue("B203", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B203:E203');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B195:F203');
//                $this->excel->getActiveSheet()->getStyle('F194')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A205", "15");
//                $this->excel->getActiveSheet()->setCellValue('B205', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Pembangunan Manusia dan Pengentasan Kemiskinan RKP 2020');
//                $this->excel->getActiveSheet()->setCellValue("B206", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C206", "3,75%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F205:F206');
//                $this->excel->getActiveSheet()->setCellValue("F205", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F206", "=(SUM(F209:F211)/COUNT(F209:F211))*10");
//                $this->excel->getActiveSheet()->setCellValue("B207", "No");
//                $this->excel->getActiveSheet()->mergeCells('B207:B208');
//                $this->excel->getActiveSheet()->setCellValue("C207", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C207:C208');
//                $this->excel->getActiveSheet()->setCellValue("D207", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D207:E207');
//                $this->excel->getActiveSheet()->setCellValue("D208", "0");
//                $this->excel->getActiveSheet()->setCellValue("E208", "1");
//                $this->excel->getActiveSheet()->setCellValue("F207", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F207:F208');
//                $this->excel->getActiveSheet()->setCellValue("B212", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B212:E212');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B207:F212');
//                $this->excel->getActiveSheet()->getStyle('F206')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A214", "16");
//                $this->excel->getActiveSheet()->setCellValue('B214', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Infrastruktur dan Pemerataan Wilayah RKP 2020');
//                $this->excel->getActiveSheet()->setCellValue("B215", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C215", "3,75%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F214:F215');
//                $this->excel->getActiveSheet()->setCellValue("F214", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F215", "=(SUM(F218:F220)/COUNT(F218:F220))*10");
//                $this->excel->getActiveSheet()->setCellValue("B216", "No");
//                $this->excel->getActiveSheet()->mergeCells('B216:B217');
//                $this->excel->getActiveSheet()->setCellValue("C216", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C216:C217');
//                $this->excel->getActiveSheet()->setCellValue("D216", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D216:E216');
//                $this->excel->getActiveSheet()->setCellValue("D217", "0");
//                $this->excel->getActiveSheet()->setCellValue("E217", "1");
//                $this->excel->getActiveSheet()->setCellValue("F216", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F216:F217');
//                $this->excel->getActiveSheet()->setCellValue("B221", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B221:E221');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B216:F221');
//                $this->excel->getActiveSheet()->getStyle('F215')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A223", "17");
//                $this->excel->getActiveSheet()->setCellValue('B223', 'Tersedianya Dukungan Program Prioritas daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Nilai Tambah Sektor Riil, Industrialisasi dan Kesempatan Kerja RKP 2020');
//                $this->excel->getActiveSheet()->setCellValue("B224", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C224", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F223:F224');
//                $this->excel->getActiveSheet()->setCellValue("F223", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F224", "=(SUM(F227:F229)/COUNT(F227:F229))*10");
//                $this->excel->getActiveSheet()->setCellValue("B225", "No");
//                $this->excel->getActiveSheet()->mergeCells('B225:B226');
//                $this->excel->getActiveSheet()->setCellValue("C225", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C225:C226');
//                $this->excel->getActiveSheet()->setCellValue("D225", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D225:E225');
//                $this->excel->getActiveSheet()->setCellValue("D226", "0");
//                $this->excel->getActiveSheet()->setCellValue("E226", "1");
//                $this->excel->getActiveSheet()->setCellValue("F225", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F225:F226');
//                $this->excel->getActiveSheet()->setCellValue("B230", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B230:E230');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B225:F230');
//                $this->excel->getActiveSheet()->getStyle('F224')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A232", "18");
//                $this->excel->getActiveSheet()->setCellValue('B232', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas PN Ketahanan Pangan, Air, Energi dan Lingkungan Hidup RKP 2020');
//                $this->excel->getActiveSheet()->setCellValue("B233", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C233", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F232:F233');
//                $this->excel->getActiveSheet()->setCellValue("F232", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F233", "=(SUM(F236:F238)/COUNT(F236:F238))*10");
//                $this->excel->getActiveSheet()->setCellValue("B234", "No");
//                $this->excel->getActiveSheet()->mergeCells('B234:B235');
//                $this->excel->getActiveSheet()->setCellValue("C234", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C234:C235');
//                $this->excel->getActiveSheet()->setCellValue("D234", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D234:E234');
//                $this->excel->getActiveSheet()->setCellValue("D235", "0");
//                $this->excel->getActiveSheet()->setCellValue("E235", "1");
//                $this->excel->getActiveSheet()->setCellValue("F234", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F234:F235');
//                $this->excel->getActiveSheet()->setCellValue("B239", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B239:E239');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B234:F239');
//                $this->excel->getActiveSheet()->getStyle('F233')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A241", "19");
//                $this->excel->getActiveSheet()->setCellValue('B241', 'Tersedianya Dukungan Program Daerah RKPD 2020 terhadap Arah Kebijakan Pengarusutamaan Pembangunan Berkelanjutan, Tata Kelola Pemerintahan yang Baik, Gender, Modal Sosial Budaya dan Transformasi Digital');
//                $this->excel->getActiveSheet()->setCellValue("B242", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C242", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F241:F242');
//                $this->excel->getActiveSheet()->setCellValue("F241", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F242", "=(SUM(F245:F259)/COUNT(F245:F259))*10");
//                $this->excel->getActiveSheet()->setCellValue("B243", "No");
//                $this->excel->getActiveSheet()->mergeCells('B243:B244');
//                $this->excel->getActiveSheet()->setCellValue("C243", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C243:C244');
//                $this->excel->getActiveSheet()->setCellValue("D243", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D243:E243');
//                $this->excel->getActiveSheet()->setCellValue("D244", "0");
//                $this->excel->getActiveSheet()->setCellValue("E244", "1");
//                $this->excel->getActiveSheet()->setCellValue("F243", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F243:F244');
//                $this->excel->getActiveSheet()->setCellValue("B260", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B260:E260');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B243:F260');
//                $this->excel->getActiveSheet()->getStyle('F242')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A262", "20");
//                $this->excel->getActiveSheet()->setCellValue('B262', 'Tersedianya dukungan program daerah RKPD 2020 terhadap arah kebijakan Pembangunan Lintas Bidang Kerentanan Bencana dan Perubahan Iklim');
//                $this->excel->getActiveSheet()->setCellValue("B263", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C263", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F262:F263');
//                $this->excel->getActiveSheet()->setCellValue("F262", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F263", "=(SUM(F266:F271)/COUNT(F266:F271))*10");
//                $this->excel->getActiveSheet()->setCellValue("B264", "No");
//                $this->excel->getActiveSheet()->mergeCells('B264:B265');
//                $this->excel->getActiveSheet()->setCellValue("C264", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C264:C265');
//                $this->excel->getActiveSheet()->setCellValue("D264", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D264:E264');
//                $this->excel->getActiveSheet()->setCellValue("D265", "0");
//                $this->excel->getActiveSheet()->setCellValue("E265", "1");
//                $this->excel->getActiveSheet()->setCellValue("F264", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F264:F265');
//                $this->excel->getActiveSheet()->setCellValue("B272", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B272:E272');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B264:F272');
//                $this->excel->getActiveSheet()->getStyle('F263')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

//                $this->excel->getActiveSheet()->setCellValue("A274", "21");
//                $this->excel->getActiveSheet()->setCellValue('B274', 'Tersedianya kebijakan pembangunan daerah RKPD 2020 yang menerapkan konsep Tematik, Holistik, Integratif, dan Spasial (THIS)');
//                $this->excel->getActiveSheet()->setCellValue("B275", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C275", "2,50%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F274:F275');
//                $this->excel->getActiveSheet()->setCellValue("F274", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F275", "=(SUM(F278:F282)/COUNT(F278:F282))*10");
//                $this->excel->getActiveSheet()->setCellValue("B276", "No");
//                $this->excel->getActiveSheet()->mergeCells('B276:B277');
//                $this->excel->getActiveSheet()->setCellValue("C276", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C276:C277');
//                $this->excel->getActiveSheet()->setCellValue("D276", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D276:E276');
//                $this->excel->getActiveSheet()->setCellValue("D277", "0");
//                $this->excel->getActiveSheet()->setCellValue("E277", "1");
//                $this->excel->getActiveSheet()->setCellValue("F276", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F276:F277');
//                $this->excel->getActiveSheet()->setCellValue("B283", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B283:E283');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B276:F283');  
//                $this->excel->getActiveSheet()->getStyle('F275')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A285", "22");
//                $this->excel->getActiveSheet()->setCellValue('B285', 'Tersedianya indikator kinerja sasaran pembangunan daerah dan program prioritas');
//                $this->excel->getActiveSheet()->setCellValue("B286", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C286", "3,75%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F285:F286');
//                $this->excel->getActiveSheet()->setCellValue("F285", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F286", "=(SUM(F289:F293)/COUNT(F289:F293))*10");
//                $this->excel->getActiveSheet()->setCellValue("B287", "No");
//                $this->excel->getActiveSheet()->mergeCells('B287:B288');
//                $this->excel->getActiveSheet()->setCellValue("C287", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C287:C288');
//                $this->excel->getActiveSheet()->setCellValue("D287", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D287:E287');
//                $this->excel->getActiveSheet()->setCellValue("D288", "0");
//                $this->excel->getActiveSheet()->setCellValue("E288", "1");
//                $this->excel->getActiveSheet()->setCellValue("F287", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F287:F288');
//                $this->excel->getActiveSheet()->setCellValue("B294", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B294:E294');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B287:F294'); 
//                $this->excel->getActiveSheet()->getStyle('F286')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue('B296', 'Resume Aspek Kualitas Dokumen RKPD');
//                $this->excel->getActiveSheet()->setCellValue("B297", "Catatan");
//                $this->excel->getActiveSheet()->mergeCells('B298:F301');
//                $this->excel->getActiveSheet()->setCellValue('B302', 'Masukan dan Saran terhadap Aspek Kualitas Dokumen RKPD');
//                $this->excel->getActiveSheet()->mergeCells('B303:F306');
                
//                $this->excel->getActiveSheet()->setCellValue("A308", "Kriteria Inovasi (20%)");
//                $this->excel->getActiveSheet()->setCellValue("A309", "23");
//                $this->excel->getActiveSheet()->setCellValue('B309', 'Indikator kelengkapan dokumen Inovasi daerah');
//                $this->excel->getActiveSheet()->setCellValue("B310", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C310", "5,00%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F309:F310');
//                $this->excel->getActiveSheet()->setCellValue("F309", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F310", "=(SUM(F313:F321)/COUNT(F313:F321))*10");
//                $this->excel->getActiveSheet()->setCellValue("B311", "No");
//                $this->excel->getActiveSheet()->mergeCells('B311:B312');
//                $this->excel->getActiveSheet()->setCellValue("C311", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C311:C312');
//                $this->excel->getActiveSheet()->setCellValue("D311", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D311:E311');
//                $this->excel->getActiveSheet()->setCellValue("D312", "0");
//                $this->excel->getActiveSheet()->setCellValue("E312", "1");
//                $this->excel->getActiveSheet()->setCellValue("F311", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F311:F312');
//                $this->excel->getActiveSheet()->setCellValue("B322", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B322:E322');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B311:F322');                
//                $this->excel->getActiveSheet()->getStyle('F310')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue("A324", "24");
//                $this->excel->getActiveSheet()->setCellValue('B324', 'Indikator kedalaman inovasi daerah');
//                $this->excel->getActiveSheet()->setCellValue("B325", "Bobot");
//                $this->excel->getActiveSheet()->setCellValue("C325", "15,00%");
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F324:F325');
//                $this->excel->getActiveSheet()->setCellValue("F324", "Nilai");
//                $this->excel->getActiveSheet()->setCellValue("F325", "=(SUM(F328:F343)/COUNT(F328:F343))*10");
//                $this->excel->getActiveSheet()->setCellValue("B326", "No");
//                $this->excel->getActiveSheet()->mergeCells('B326:B327');
//                $this->excel->getActiveSheet()->setCellValue("C326", "Item Penilaian");
//                $this->excel->getActiveSheet()->mergeCells('C326:C327');
//                $this->excel->getActiveSheet()->setCellValue("D326", "Kategori Skor per Item");
//                $this->excel->getActiveSheet()->mergeCells('D326:E326');
//                $this->excel->getActiveSheet()->setCellValue("D327", "0");
//                $this->excel->getActiveSheet()->setCellValue("E327", "1");
//                $this->excel->getActiveSheet()->setCellValue("F326", "Skor");
//                $this->excel->getActiveSheet()->mergeCells('F326:F327');
//                $this->excel->getActiveSheet()->setCellValue("B344", "Jumlah Skor");
//                $this->excel->getActiveSheet()->mergeCells('B344:E344');
//                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B326:F344');                
//                $this->excel->getActiveSheet()->getStyle('F325')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
//                $this->excel->getActiveSheet()->setCellValue('B346', 'Resume Aspek Inovasi');
//                $this->excel->getActiveSheet()->setCellValue("B347", "Catatan");
//                $this->excel->getActiveSheet()->mergeCells('B348:F350');
//                $this->excel->getActiveSheet()->setCellValue('B351', 'Masukan dan Saran terhadap Aspek Inovasi');
//                $this->excel->getActiveSheet()->mergeCells('B352:F355');
                
                //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
//                $this->excel->getActiveSheet()->getProtection()->setSheet(true);
//                $this->excel->getActiveSheet()->getProtection()->setSort(true);
//                $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
//                $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
//                $this->excel->getActiveSheet()->getProtection()->setPassword('sk9');
                
                header("Content-Type:application/vnd.ms-excel");
                header("Content-Disposition:attachment;filename = Module1_penilaian_dokumen_.xls");
                header("Cache-Control:max-age=0");
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save("php://output");   
    }
      
    
}
