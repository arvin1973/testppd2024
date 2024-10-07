<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Unduh Penilaian Prov
* author : FSM
 * date : 10 des 2020
*/
class PPD3_unduh_nilai_prov extends CI_Controller {
    var $view_dir   = "ppd3/PPD3_unduh_nilai/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD2_unduh_nilai/ppd2.js";
    
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");
        $this->load->library("Excel");
    }
    
    
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
                $this->js_path    = "assets/js/ppd3/PPD3_unduh_nilai/unduh_nilai_prov.js?v=".now("Asia/Jakarta");
                

                $data_page = array( );
                $str = $this->load->view($this->view_dir."index_ppd3_prov",$data_page,TRUE);

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
    
    /*
     * list data wilayah
     * author : FSM
     * date : 17 des 2020
     */
    function g_wilayah(){
        if($this->input->is_ajax_request()){
            try{
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $userid = $session->id;
                
                //table wilayah
                $sql= "SELECT 'PROV' kate,P.`id` mapid,P.`id_kode` kode, P.`nama_provinsi` nmprov
                        FROM tbl_user_wilayah A
                        JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                        WHERE A.`iduser`=?";
                $bind = array($session->id);
                $list_data = $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $str="";
                if($list_data->num_rows()==0) {
                    // $str = "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";
                    $str .= "<div class='not-found-img' style='display: grid; justify-content: center;'>";
                    $str .= "<img src='".base_url()."/assets/icons/not_found_2.svg' alt='Data Not Found' width='200' height='200'>";
                    $str .= "<h5 style='font-family: \'Hind Madurai\', sans-serif; text-align: center;'>- <strong style='color: red;'>Data</strong> tidak ditemukan -</h5>";
                    $str .= "</div>";
                }else{
                    $no=1;
                    foreach ($list_data->result() as $v) {
                        $idcomb = $v->kate."-".$v->mapid;
                        $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                        
                        
                        $tmp = "class='btn btn-sm btn-primary waves-effect waves-light getDetail' data-id='".$encrypted_id."'";
                        $tmp .= " data-nmpkk='".$v->nmprov."'";

                        $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                        $str .= "<div style='display: flex; align-items: center;'>";
                        $str .= "<img src='".base_url()."assets/icons/PNG_Provinsi/".$v->kode."_".$v->nmprov.".png' alt='".$v->nmprov."' title='".$v->nmprov."' width='100' height='100' style='padding: 15px;'>";
                        $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                        $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                        $str .= "<h4>".$v->nmprov."</h4>";
                        $str .= "<div class='btn-wilayah' style='float: right;'>";
                        $str .= "<a href='javascript:void(0)' ".$tmp." style='border-radius: 0px; padding-left: 10px;'>Unduh Nilai <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
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
        }
        else die("Die!");
    }
    
        /*
     * unduh nilai 
     * author : FSM
     * date : 17 des 2020
     */
     function Download_nilai(){
        if(!$this->session->userdata(SESSION_LOGIN)){echo 'Invalid Token, silakan logon sistem';exit();}
        echo 'Proses';
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        $nama = $this->session->userdata(SESSION_LOGIN)->name;
        $idcomb = decrypt_base64($_GET['wl']);
        $tmp = explode('-', $idcomb);
        if(count($tmp)!=2){
            echo 'Invalid ID';exit();
            //throw new Exception("Invalid ID");
        }
        $kate_wlyh = $tmp[0];
        $idwil = $tmp[1];
        $_arr = array("PROV","KAB","KOT");
        if(!in_array($kate_wlyh, $_arr)){
            echo 'InvaliD Kategori Wilayah';exit();
            //   throw new Exception("InvaliD Kategori Wilayah");
        }
        //$user
        $select="SELECT W.id,W.iduser,W.idwilayah, P.nama_provinsi, U.userid
                    FROM `tbl_user_wilayah` W
                    JOIN `provinsi` P ON W.idwilayah = P.id
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE W.iduser='$user' AND W.idwilayah='$idwil'";
        //print_r($select);exit();
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
                $this->excel->getActiveSheet()->mergeCells('A1:K1');
                $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->setCellValue('A2', "Kriteria dan Indikator Penilaian Dokumen RKPD");
                $this->excel->getActiveSheet()->mergeCells('A2:K2');
//                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:L173');
//                
                $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
                $this->excel->getActiveSheet()->mergeCells('A4:B4');
                $this->excel->getActiveSheet()->setCellValue('C4', ":");
                $this->excel->getActiveSheet()->setCellValue('A5', "Daerah Yang Dinilai ");
                $this->excel->getActiveSheet()->mergeCells('A5:B5');
                $this->excel->getActiveSheet()->setCellValue('C5', ":");
                $this->excel->getActiveSheet()->setCellValue('D4', "$nama");
                $this->excel->getActiveSheet()->setCellValue('D5', "$namaprov");
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
                $this->excel->getActiveSheet()->setCellValue("H10", "CATATAN");
                $this->excel->getActiveSheet()->mergeCells('H10:H11');
                $this->excel->getActiveSheet()->setCellValue("I10", "MASUKAN DAN SARAN");
                $this->excel->getActiveSheet()->mergeCells('I10:I11');
                $this->excel->getActiveSheet()->setCellValue("J10", "SKOR");
                $this->excel->getActiveSheet()->mergeCells('J10:J11');
                $this->excel->getActiveSheet()->setCellValue("K10", "BOBOT");
                $this->excel->getActiveSheet()->mergeCells('K10:K11');
                $this->excel->getActiveSheet()->setCellValue("L10", "NILAI TERBOBOT");
                $this->excel->getActiveSheet()->mergeCells('L10:L11');
                $this->excel->getActiveSheet()->getStyle('A10:L11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                
                
                $this->excel->getActiveSheet()->setCellValue("A173", "TOTAL");
                
                
                $this->excel->getActiveSheet()->mergeCells('A12:A80');
                $this->excel->getActiveSheet()->mergeCells('A81:A91');
                $this->excel->getActiveSheet()->mergeCells('A92:A109');
                $this->excel->getActiveSheet()->mergeCells('A110:A147');
                $this->excel->getActiveSheet()->mergeCells('A148:A172');

               $this->excel->getActiveSheet()->mergeCells('B12:B80');
                $this->excel->getActiveSheet()->mergeCells('B81:B91');
                $this->excel->getActiveSheet()->mergeCells('B92:B109');
                $this->excel->getActiveSheet()->mergeCells('B110:B147');
                $this->excel->getActiveSheet()->mergeCells('B148:B172');

                $this->excel->getActiveSheet()->mergeCells('C12:C20');
                $this->excel->getActiveSheet()->mergeCells('C21:C27');
                $this->excel->getActiveSheet()->mergeCells('C28:C38');
                $this->excel->getActiveSheet()->mergeCells('C39:C53');
                $this->excel->getActiveSheet()->mergeCells('C54:C61');
                $this->excel->getActiveSheet()->mergeCells('C62:C71');
                $this->excel->getActiveSheet()->mergeCells('C72:C80');
                $this->excel->getActiveSheet()->mergeCells('C81:C85');
                $this->excel->getActiveSheet()->mergeCells('C86:C91');
                $this->excel->getActiveSheet()->mergeCells('C92:C97');
                $this->excel->getActiveSheet()->mergeCells('C98:C100');
                $this->excel->getActiveSheet()->mergeCells('C101:C106');
                $this->excel->getActiveSheet()->mergeCells('C107:C109');
                $this->excel->getActiveSheet()->mergeCells('C110:C115');
                $this->excel->getActiveSheet()->mergeCells('C116:C119');
                $this->excel->getActiveSheet()->mergeCells('C120:C122');
                $this->excel->getActiveSheet()->mergeCells('C123:C127');
                $this->excel->getActiveSheet()->mergeCells('C128:C130');
                $this->excel->getActiveSheet()->mergeCells('C131:C133');
                $this->excel->getActiveSheet()->mergeCells('C134:C136');
                $this->excel->getActiveSheet()->mergeCells('C137:C142');
                $this->excel->getActiveSheet()->mergeCells('C143:C147');
                $this->excel->getActiveSheet()->mergeCells('C148:C156');
                $this->excel->getActiveSheet()->mergeCells('C157:C172');
                
                $this->excel->getActiveSheet()->mergeCells('D12:D20');
                $this->excel->getActiveSheet()->mergeCells('D21:D27');
                $this->excel->getActiveSheet()->mergeCells('D28:D38');
                $this->excel->getActiveSheet()->mergeCells('D39:D53');
                $this->excel->getActiveSheet()->mergeCells('D54:D61');
                $this->excel->getActiveSheet()->mergeCells('D62:D71');
                $this->excel->getActiveSheet()->mergeCells('D72:D80');
                $this->excel->getActiveSheet()->mergeCells('D81:D85');
                $this->excel->getActiveSheet()->mergeCells('D86:D91');
                $this->excel->getActiveSheet()->mergeCells('D92:D97');
                $this->excel->getActiveSheet()->mergeCells('D98:D100');
                $this->excel->getActiveSheet()->mergeCells('D101:D106');
                $this->excel->getActiveSheet()->mergeCells('D107:D109');
                $this->excel->getActiveSheet()->mergeCells('D110:D115');
                $this->excel->getActiveSheet()->mergeCells('D116:D119');
                $this->excel->getActiveSheet()->mergeCells('D120:D122');
                $this->excel->getActiveSheet()->mergeCells('D123:D127');
                $this->excel->getActiveSheet()->mergeCells('D128:D130');
                $this->excel->getActiveSheet()->mergeCells('D131:D133');
                $this->excel->getActiveSheet()->mergeCells('D134:D136');
                $this->excel->getActiveSheet()->mergeCells('D137:D142');
                $this->excel->getActiveSheet()->mergeCells('D143:D147');
                $this->excel->getActiveSheet()->mergeCells('D148:D156');
                $this->excel->getActiveSheet()->mergeCells('D157:D172');
                
                $this->excel->getActiveSheet()->mergeCells('H12:H80');
                $this->excel->getActiveSheet()->mergeCells('H81:H147');
                $this->excel->getActiveSheet()->mergeCells('H148:H172');

                $this->excel->getActiveSheet()->mergeCells('I12:I80');
                $this->excel->getActiveSheet()->mergeCells('I81:I147');
                $this->excel->getActiveSheet()->mergeCells('I148:I172');
                                
                $this->excel->getActiveSheet()->mergeCells('A173:k173');

                
//                $this->excel->getActiveSheet()->mergeCells('H12:H20');
                //list indikator skor
                $status_sql="SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
                                FROM `r_mdl1_item` IT
                                JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid`
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
                                ORDER BY IND.`nourut`,IT.subindiid, IT.`nourut`";


                $list_data  = $this->db->query($status_sql);
                $excelColumn = range('A', 'ZZ');
                $index_excelColumn = 0;
                $row =12;
                $nol='';
                foreach ($list_data->result() as $value) {
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nokr);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nmkriteria);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->noindi);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nmindi);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nr);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nmitem);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->skor);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, " ".$value->ksmplan);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->saran);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, '');
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->bobot/100);
                    //                $this->excel->getActiveSheet()->getColumnDimension("F")->setWrapText(true);
                    $index_excelColumn=0;
                    $row++;
                }
                
                $this->excel->getActiveSheet()->mergeCells('J12:J20');
                $this->excel->getActiveSheet()->setCellValue("J12", "=10*SUM(G12:G20)/COUNT(E12:E20))");
                $this->excel->getActiveSheet()->mergeCells('J21:J27');
                $this->excel->getActiveSheet()->setCellValue("J21", "=10*SUM(G21:G27)/COUNT(E21:E27))");
                $this->excel->getActiveSheet()->mergeCells('J28:J38');
                $this->excel->getActiveSheet()->setCellValue("J28", "=10*SUM(G28:G38)/COUNT(E28:E38))");
                $this->excel->getActiveSheet()->mergeCells('J39:J53');
                $this->excel->getActiveSheet()->setCellValue("J39", "=10*SUM(G39:G53)/COUNT(E39:E53))");
                $this->excel->getActiveSheet()->mergeCells('J54:J61');
                $this->excel->getActiveSheet()->setCellValue("J54", "=10*SUM(G54:G61)/COUNT(E54:E61))");
                $this->excel->getActiveSheet()->mergeCells('J62:J71');
                $this->excel->getActiveSheet()->setCellValue("J62", "=10*SUM(G62:G71)/COUNT(E62:E71))");
                $this->excel->getActiveSheet()->mergeCells('J72:J80');
                $this->excel->getActiveSheet()->setCellValue("J72", "=10*SUM(G72:G80)/COUNT(E72:E80))");
                $this->excel->getActiveSheet()->mergeCells('J81:J85');
                $this->excel->getActiveSheet()->setCellValue("J81", "=10*SUM(G81:G85)/COUNT(E81:E85))");
                $this->excel->getActiveSheet()->mergeCells('J86:J91');
                $this->excel->getActiveSheet()->setCellValue("J86", "=10*SUM(G86:G91)/COUNT(E86:E91))");
                $this->excel->getActiveSheet()->mergeCells('J92:J97');
                $this->excel->getActiveSheet()->setCellValue("J92", "=10*SUM(G92:G97)/COUNT(E92:E97))");
                $this->excel->getActiveSheet()->mergeCells('J98:J100');
                $this->excel->getActiveSheet()->setCellValue("J98", "=10*SUM(G98:G100)/COUNT(E98:E100))");
                $this->excel->getActiveSheet()->mergeCells('J101:J106');
                $this->excel->getActiveSheet()->setCellValue("J101", "=10*SUM(G101:G106)/COUNT(E101:E106))");
                $this->excel->getActiveSheet()->mergeCells('J107:J109');
                $this->excel->getActiveSheet()->setCellValue("J107", "=10*SUM(G107:G109)/COUNT(E107:E109))");
                $this->excel->getActiveSheet()->mergeCells('J110:J115');
                $this->excel->getActiveSheet()->setCellValue("J110", "=10*SUM(G110:G115)/COUNT(E110:E115))");
                $this->excel->getActiveSheet()->mergeCells('J116:J119');
                $this->excel->getActiveSheet()->setCellValue("J116", "=10*SUM(G116:G119)/COUNT(E116:E119))");
                $this->excel->getActiveSheet()->mergeCells('J120:J122');
                $this->excel->getActiveSheet()->setCellValue("J120", "=10*SUM(G120:G122)/COUNT(E120:E122))");
                $this->excel->getActiveSheet()->mergeCells('J123:J127');
                $this->excel->getActiveSheet()->setCellValue("J123", "=10*SUM(G123:G127)/COUNT(E123:E127))");
                $this->excel->getActiveSheet()->mergeCells('J128:J130');
                $this->excel->getActiveSheet()->setCellValue("J128", "=10*SUM(G128:G130)/COUNT(E128:E130))");
                $this->excel->getActiveSheet()->mergeCells('J131:J133');
                $this->excel->getActiveSheet()->setCellValue("J131", "=10*SUM(G131:G133)/COUNT(E131:E133))");
                $this->excel->getActiveSheet()->mergeCells('J134:J136');
                $this->excel->getActiveSheet()->setCellValue("J134", "=10*SUM(G134:G136)/COUNT(E134:E136))");
                $this->excel->getActiveSheet()->mergeCells('J137:J142');
                $this->excel->getActiveSheet()->setCellValue("J137", "=10*SUM(G137:G142)/COUNT(E137:E142))");
                $this->excel->getActiveSheet()->mergeCells('J143:J147');
                $this->excel->getActiveSheet()->setCellValue("J143", "=10*SUM(G143:G147)/COUNT(E143:E147))");
                $this->excel->getActiveSheet()->mergeCells('J148:J156');
                $this->excel->getActiveSheet()->setCellValue("J148", "=10*SUM(G148:G156)/COUNT(E148:E156))");
                $this->excel->getActiveSheet()->mergeCells('J157:J172');
                $this->excel->getActiveSheet()->setCellValue("J157", "=10*SUM(G157:G172)/COUNT(E157:E172))");
                 $this->excel->getActiveSheet()->getStyle('J12:J172')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                 
                $this->excel->getActiveSheet()->mergeCells('K12:K20');
                $this->excel->getActiveSheet()->mergeCells('K21:K27');
                $this->excel->getActiveSheet()->mergeCells('K28:K38');
                $this->excel->getActiveSheet()->mergeCells('K39:K53');
                $this->excel->getActiveSheet()->mergeCells('K54:K61');
                $this->excel->getActiveSheet()->mergeCells('K62:K71');
                $this->excel->getActiveSheet()->mergeCells('K72:K80');
                $this->excel->getActiveSheet()->mergeCells('K81:K85');
                $this->excel->getActiveSheet()->mergeCells('K86:K91');
                $this->excel->getActiveSheet()->mergeCells('K92:K97');
                $this->excel->getActiveSheet()->mergeCells('K98:K100');
                $this->excel->getActiveSheet()->mergeCells('K101:K106');
                $this->excel->getActiveSheet()->mergeCells('K107:K109');
                $this->excel->getActiveSheet()->mergeCells('K110:K115');
                $this->excel->getActiveSheet()->mergeCells('K116:K119');
                $this->excel->getActiveSheet()->mergeCells('K120:K122');
                $this->excel->getActiveSheet()->mergeCells('K123:K127');
                $this->excel->getActiveSheet()->mergeCells('K128:K130');
                $this->excel->getActiveSheet()->mergeCells('K131:K133');
                $this->excel->getActiveSheet()->mergeCells('K134:K136');
                $this->excel->getActiveSheet()->mergeCells('K137:K142');
                $this->excel->getActiveSheet()->mergeCells('K143:K147');
                $this->excel->getActiveSheet()->mergeCells('K148:K156');
                $this->excel->getActiveSheet()->mergeCells('K157:K172');
                
                $this->excel->getActiveSheet()->mergeCells('L12:L20');
                $this->excel->getActiveSheet()->setCellValue("L12", "=J12*K12");
                $this->excel->getActiveSheet()->mergeCells('L21:L27');
                $this->excel->getActiveSheet()->setCellValue("L21", "=J21*K21");
                $this->excel->getActiveSheet()->mergeCells('L28:L38');
                $this->excel->getActiveSheet()->setCellValue("L28", "=J28*K28");
                $this->excel->getActiveSheet()->mergeCells('L39:L53');
                $this->excel->getActiveSheet()->setCellValue("L39", "=J39*K39");
                $this->excel->getActiveSheet()->mergeCells('L54:L61');
                $this->excel->getActiveSheet()->setCellValue("L54", "=J54*K54");
                $this->excel->getActiveSheet()->mergeCells('L62:L71');
                $this->excel->getActiveSheet()->setCellValue("L62", "=J62*K62");
                $this->excel->getActiveSheet()->mergeCells('L72:L80');
                $this->excel->getActiveSheet()->setCellValue("L72", "=J72*K72");
                $this->excel->getActiveSheet()->mergeCells('L81:L85');
                $this->excel->getActiveSheet()->setCellValue("L81", "=J81*K81");
                $this->excel->getActiveSheet()->mergeCells('L86:L91');
                $this->excel->getActiveSheet()->setCellValue("L86", "=J86*K86");
                $this->excel->getActiveSheet()->mergeCells('L92:L97');
                $this->excel->getActiveSheet()->setCellValue("L92", "=J92*K92");
                $this->excel->getActiveSheet()->mergeCells('L98:L100');
                $this->excel->getActiveSheet()->setCellValue("L98", "=J98*K98");
                $this->excel->getActiveSheet()->mergeCells('L101:L106');
                $this->excel->getActiveSheet()->setCellValue("L101", "=J101*K101");
                $this->excel->getActiveSheet()->mergeCells('L107:L109');
                $this->excel->getActiveSheet()->setCellValue("L107", "=J107*K107");
                $this->excel->getActiveSheet()->mergeCells('L110:L115');
                $this->excel->getActiveSheet()->setCellValue("L110", "=J110*K110");
                $this->excel->getActiveSheet()->mergeCells('L116:L119');
                $this->excel->getActiveSheet()->setCellValue("L116", "=J116*K116");
                $this->excel->getActiveSheet()->mergeCells('L120:L122');
                $this->excel->getActiveSheet()->setCellValue("L120", "=J120*K120");
                $this->excel->getActiveSheet()->mergeCells('L123:L127');
                $this->excel->getActiveSheet()->setCellValue("L123", "=J123*K123");
                $this->excel->getActiveSheet()->mergeCells('L128:L130');
                $this->excel->getActiveSheet()->setCellValue("L128", "=J128*K128");
                $this->excel->getActiveSheet()->mergeCells('L131:L133');
                $this->excel->getActiveSheet()->setCellValue("L131", "=J131*K131");
                $this->excel->getActiveSheet()->mergeCells('L134:L136');
                $this->excel->getActiveSheet()->setCellValue("L134", "=J134*K134");
                $this->excel->getActiveSheet()->mergeCells('L137:L142');
                $this->excel->getActiveSheet()->setCellValue("L137", "=J137*K137");
                $this->excel->getActiveSheet()->mergeCells('L143:L147');
                $this->excel->getActiveSheet()->setCellValue("L143", "=J143*K143");
                $this->excel->getActiveSheet()->mergeCells('L148:L156');
                $this->excel->getActiveSheet()->setCellValue("L148", "=J148*K148");
                $this->excel->getActiveSheet()->mergeCells('L157:L172');
                $this->excel->getActiveSheet()->setCellValue("L157", "=J157*K157");                
                $this->excel->getActiveSheet()->getStyle('L12:L172')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                //lebar kolom
                $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
                $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
                $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
                $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("39.18");
                $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
                $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("62.64");
                $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("10");
                $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("30");
                $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("30");
                
                $this->excel->getActiveSheet()->setCellValue("L173", "=SUM(L12:L172)");
                
                $this->excel->getActiveSheet()->getStyle('G12:G172')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('J12:L172')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A173:L173')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('D12:F172'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 
                //$this->excel->getActiveSheet()->getStyle('H12:F172'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 
                 
                //$this->excel->getActiveSheet()->getStyle('B12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('A12:A167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('B12:B167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('C12:C167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('D12:D167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('E12:E167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('H12:H167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('I12:I167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('J12:J167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('K12:K167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('l12:l167')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                
                $this->excel->getActiveSheet()->setShowGridlines(False);
//                $this->excel->getActiveSheet()->getStyle('D12:D181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
                //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
                $this->excel->getActiveSheet()->getProtection()->setSheet(true);
                $this->excel->getActiveSheet()->getProtection()->setSort(true);
                $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
                $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
                $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');
                
                header("Content-Type:application/vnd.ms-excel");
                header("Content-Disposition:attachment;filename = Modul1_".$user_d."_".$namaprov.".xls");
                header("Cache-Control:max-age=0");
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save("php://output");   
    }
    
}
