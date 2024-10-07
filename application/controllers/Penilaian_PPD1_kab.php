<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_PPD1_kab extends CI_Controller {
    var $view_dir   = "admin/penilaian/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/penilaian/penilaian.js";
    
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
                $this->js_path    = "assets/js/admin/penilaian/penilaian_PPD1_kab.js?v=".now("Asia/Jakarta");
                
                //List modul
                $this->m_ref->setTableName("tbl_module");
                $select = array("id","nm_module");
                $cond = array(
                  //  "id" => 'G2'
                );
                $list_modul= $this->m_ref->get_by_condition($select,$cond);
                

                //list Tim penilai
                $select_u="SELECT * FROM tbl_user WHERE `group` = '2' ";
                $list_user  = $this->db->query($select_u);

                
                $data_page = array( 
                    "list_modul"    =>  $list_modul,
                    "list_user"    =>  $list_user,
                  //  "list_prov"    =>  $list_prov,
                );
                $str = $this->load->view($this->view_dir."index_PPD1_kab",$data_page,TRUE);

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
    
    function s_daerah(){
        if($this->input->is_ajax_request()){
            try{
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                                $this->form_validation->set_rules('id','ID Data Indikator','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idusr = $tmp[1];
                
                $_arr = array("PROV","KAB","kot");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idusr))
                    throw new Exception("Invalid ID Map");
                //$userid = $session->id;
                
                //table wilayah
                $sql= "SELECT W.*, P.nama_kabupaten FROM `tbl_user_kabkot` W
                        JOIN `kabupaten` P ON W.idkabkot = P.id
                        WHERE W.iduser = ? AND P.urutan='0'";
                
                $bind = array($idusr);
                $list_data = $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                if($list_data->num_rows()==0)
                    $str_stts = "<option value=''> - Tidak Terdaftar - </option>";
                
                $no=1;
                $str_stts = "<option value=''> - Pilih - </option>";
                foreach ($list_data->result() as $v) {
                    $idcomb = "KAB-".$v->idkabkot;
                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "$encrypted_id";
                    $str_stts.="<option value='$tmp'>$v->nama_kabupaten</option>";
                    
                }
                $response = array(
                    "status"    => 1,   
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => $str_stts,
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
        if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
        $user = $this->session->userdata(SESSION_LOGIN)->id;
       // $nama = $this->session->userdata(SESSION_LOGIN)->name;
        
        $idcomb = decrypt_base64($_GET['timid']);
        $tmp = explode('-', $idcomb);
        if(count($tmp)!=2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp[0];
        $user = $tmp[1];
        
        $provcomb = decrypt_base64($_GET['provid']);
        $tmp2 = explode('-', $provcomb);
        if(count($tmp2)!=2)
            throw new Exception("Invalid ID");
        $kate_wlyh = $tmp2[0];
        $idwil = $tmp2[1];
        //select tim penilai
                $select_u="SELECT W.*
                            FROM `tbl_user` W
                            WHERE W.id='$user' ";
                $list_u  = $this->db->query($select_u);
                foreach ($list_u->result() as $u) {
                    $nama = $u->name;   
                }
        
        
        //$user
                $select="SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten
                            FROM `tbl_user_kabkot` W
                            JOIN `kabupaten` P ON W.idkabkot = P.id
                            WHERE W.iduser='$user' AND W.idkabkot='$idwil'";
                //print_r($select);exit();
                $list_data  = $this->db->query($select);
                foreach ($list_data->result() as $d) {
                    $nilai = $d->id;
                    $namakab = $d->nama_kabupaten;   
                }
        
                //list indikator skor
                
                $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        
        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
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
                $this->excel->getActiveSheet()->mergeCells('A1:K1');
                $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->setCellValue('A2', "Kriteria dan Indikator Penilaian Dokumen RKPD");
                $this->excel->getActiveSheet()->mergeCells('A2:K2');
//                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:L161');
//                
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
                
                $this->excel->getActiveSheet()->setCellValue("A161", "TOTAL");
                
                $this->excel->getActiveSheet()->getStyle('A161:L161')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                
                $this->excel->getActiveSheet()->getStyle('A10:L10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);                
                
                $this->excel->getActiveSheet()->mergeCells('A12:A73');
                $this->excel->getActiveSheet()->mergeCells('A74:A84');
                $this->excel->getActiveSheet()->mergeCells('A85:A102');
                $this->excel->getActiveSheet()->mergeCells('A103:A135');
                $this->excel->getActiveSheet()->mergeCells('A136:A160');

                $this->excel->getActiveSheet()->mergeCells('B12:B73');
                $this->excel->getActiveSheet()->mergeCells('B74:B84');
                $this->excel->getActiveSheet()->mergeCells('B85:B102');
                $this->excel->getActiveSheet()->mergeCells('B103:B135');
                $this->excel->getActiveSheet()->mergeCells('B136:B160');

                $this->excel->getActiveSheet()->mergeCells('C12:C20');
                $this->excel->getActiveSheet()->mergeCells('C21:C27');
                $this->excel->getActiveSheet()->mergeCells('C28:C38');
                $this->excel->getActiveSheet()->mergeCells('C39:C53');
                $this->excel->getActiveSheet()->mergeCells('C54:C57');
                $this->excel->getActiveSheet()->mergeCells('C58:C67');
                $this->excel->getActiveSheet()->mergeCells('C68:C73');
                $this->excel->getActiveSheet()->mergeCells('C74:C78');
                $this->excel->getActiveSheet()->mergeCells('C79:C84');
                $this->excel->getActiveSheet()->mergeCells('C85:C90');
                $this->excel->getActiveSheet()->mergeCells('C91:C93');
                $this->excel->getActiveSheet()->mergeCells('C94:C99');
                $this->excel->getActiveSheet()->mergeCells('C100:C102');
                $this->excel->getActiveSheet()->mergeCells('C103:C107');
                $this->excel->getActiveSheet()->mergeCells('C108:C110');
                $this->excel->getActiveSheet()->mergeCells('C111:C113');
                $this->excel->getActiveSheet()->mergeCells('C114:C116');
                $this->excel->getActiveSheet()->mergeCells('C117:C119');
                $this->excel->getActiveSheet()->mergeCells('C120:C122');
                $this->excel->getActiveSheet()->mergeCells('C123:C125');
                $this->excel->getActiveSheet()->mergeCells('C126:C130');
                $this->excel->getActiveSheet()->mergeCells('C131:C135');
                $this->excel->getActiveSheet()->mergeCells('C136:C144');
                $this->excel->getActiveSheet()->mergeCells('C145:C160');
                
                $this->excel->getActiveSheet()->mergeCells('D12:D20');
                $this->excel->getActiveSheet()->mergeCells('D21:D27');
                $this->excel->getActiveSheet()->mergeCells('D28:D38');
                $this->excel->getActiveSheet()->mergeCells('D39:D53');
                $this->excel->getActiveSheet()->mergeCells('D54:D57');
                $this->excel->getActiveSheet()->mergeCells('D58:D67');
                $this->excel->getActiveSheet()->mergeCells('D68:D73');
                $this->excel->getActiveSheet()->mergeCells('D74:D78');
                $this->excel->getActiveSheet()->mergeCells('D79:D84');
                $this->excel->getActiveSheet()->mergeCells('D85:D90');
                $this->excel->getActiveSheet()->mergeCells('D91:D93');
                $this->excel->getActiveSheet()->mergeCells('D94:D99');
                $this->excel->getActiveSheet()->mergeCells('D100:D102');
                $this->excel->getActiveSheet()->mergeCells('D103:D107');
                $this->excel->getActiveSheet()->mergeCells('D108:D110');
                $this->excel->getActiveSheet()->mergeCells('D111:D113');
                $this->excel->getActiveSheet()->mergeCells('D114:D116');
                $this->excel->getActiveSheet()->mergeCells('D117:D119');
                $this->excel->getActiveSheet()->mergeCells('D120:D122');
                $this->excel->getActiveSheet()->mergeCells('D123:D125');
                $this->excel->getActiveSheet()->mergeCells('D126:D130');
                $this->excel->getActiveSheet()->mergeCells('D131:D135');
                $this->excel->getActiveSheet()->mergeCells('D136:D144');
                $this->excel->getActiveSheet()->mergeCells('D145:D160');
                
                $this->excel->getActiveSheet()->mergeCells('H12:H73');
                $this->excel->getActiveSheet()->mergeCells('H74:H135');
                $this->excel->getActiveSheet()->mergeCells('H136:H160');
                $this->excel->getActiveSheet()->mergeCells('I12:I73');
                $this->excel->getActiveSheet()->mergeCells('I74:I135');
                $this->excel->getActiveSheet()->mergeCells('I136:I160');
                
                $this->excel->getActiveSheet()->mergeCells('A161:k161');

                  $status_sql="SELECT IT.`nourut` nr,IND.nourut,K.id nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,SI.`nama` nmsubindi,IT.`nama` nmitem,SKOR.skor,IND.bobot,RES.ksmplan, RES.saran
                            FROM `r_mdl1_item` IT
                            JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                            JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                            JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                            JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                            LEFT JOIN `t_mdl1_resume_kabkota` RES ON RES.`aspekid` = A.id AND RES.mapid =1
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
//                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->nmitem);
//                    
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
                $this->excel->getActiveSheet()->mergeCells('J54:J57');
                $this->excel->getActiveSheet()->setCellValue("J54", "=10*SUM(G54:G57)/COUNT(E54:E57))");
                $this->excel->getActiveSheet()->mergeCells('J58:J67');
                $this->excel->getActiveSheet()->setCellValue("J58", "=10*SUM(G58:G67)/COUNT(E58:E67))");
                $this->excel->getActiveSheet()->mergeCells('J68:J73');
                $this->excel->getActiveSheet()->setCellValue("J68", "=10*SUM(G68:G73)/COUNT(E68:E73))");
                $this->excel->getActiveSheet()->mergeCells('J74:J78');
                $this->excel->getActiveSheet()->setCellValue("J74", "=10*SUM(G74:G78)/COUNT(E74:E78))");
                $this->excel->getActiveSheet()->mergeCells('J79:J84');
                $this->excel->getActiveSheet()->setCellValue("J79", "=10*SUM(G79:G84)/COUNT(E79:E84))");
                $this->excel->getActiveSheet()->mergeCells('J85:J90');
                $this->excel->getActiveSheet()->setCellValue("J85", "=10*SUM(G85:G90)/COUNT(E85:E90))");
                $this->excel->getActiveSheet()->mergeCells('J91:J93');
                $this->excel->getActiveSheet()->setCellValue("J91", "=10*SUM(G91:G93)/COUNT(E91:E93))");
                $this->excel->getActiveSheet()->mergeCells('J94:J99');
                $this->excel->getActiveSheet()->setCellValue("J94", "=10*SUM(G94:G99)/COUNT(E94:E99))");
                $this->excel->getActiveSheet()->mergeCells('J100:J102');
                $this->excel->getActiveSheet()->setCellValue("J100", "=10*SUM(G100:G102)/COUNT(E100:E102))");
                $this->excel->getActiveSheet()->mergeCells('J103:J107');
                $this->excel->getActiveSheet()->setCellValue("J103", "=10*SUM(G103:G107)/COUNT(E103:E107))");
                $this->excel->getActiveSheet()->mergeCells('J108:J110');
                $this->excel->getActiveSheet()->setCellValue("J108", "=10*SUM(G108:G110)/COUNT(E108:E110))");
                $this->excel->getActiveSheet()->mergeCells('J111:J113');
                $this->excel->getActiveSheet()->setCellValue("J111", "=10*SUM(G111:G113)/COUNT(E111:E113))");
                $this->excel->getActiveSheet()->mergeCells('J114:J116');
                $this->excel->getActiveSheet()->setCellValue("J114", "=10*SUM(G114:G116)/COUNT(E114:E116))");
                $this->excel->getActiveSheet()->mergeCells('J117:J119');
                $this->excel->getActiveSheet()->setCellValue("J117", "=10*SUM(G117:G119)/COUNT(E117:E119))");
                $this->excel->getActiveSheet()->mergeCells('J120:J122');
                $this->excel->getActiveSheet()->setCellValue("J120", "=10*SUM(G120:G122)/COUNT(E120:E122))");
                $this->excel->getActiveSheet()->mergeCells('J123:J125');
                $this->excel->getActiveSheet()->setCellValue("J123", "=10*SUM(G123:G125)/COUNT(E123:E125))");
                $this->excel->getActiveSheet()->mergeCells('J126:J130');
                $this->excel->getActiveSheet()->setCellValue("J126", "=10*SUM(G126:G130)/COUNT(E126:E130))");
                $this->excel->getActiveSheet()->mergeCells('J131:J135');
                $this->excel->getActiveSheet()->setCellValue("J131", "=10*SUM(G131:G135)/COUNT(E131:E135))");
                $this->excel->getActiveSheet()->mergeCells('J136:J144');
                $this->excel->getActiveSheet()->setCellValue("J136", "=10*SUM(G136:G144)/COUNT(E136:E144))");
                $this->excel->getActiveSheet()->mergeCells('J145:J160');
                $this->excel->getActiveSheet()->setCellValue("J145", "=10*SUM(G145:G160)/COUNT(E145:E160))");
                
                $this->excel->getActiveSheet()->mergeCells('K12:K20');
                $this->excel->getActiveSheet()->mergeCells('K21:K27');
                $this->excel->getActiveSheet()->mergeCells('K28:K38');
                $this->excel->getActiveSheet()->mergeCells('K39:K53');
                $this->excel->getActiveSheet()->mergeCells('K54:K57');
                $this->excel->getActiveSheet()->mergeCells('K58:K67');
                $this->excel->getActiveSheet()->mergeCells('K68:K73');
                $this->excel->getActiveSheet()->mergeCells('K74:K78');
                $this->excel->getActiveSheet()->mergeCells('K79:K84');
                $this->excel->getActiveSheet()->mergeCells('K85:K90');
                $this->excel->getActiveSheet()->mergeCells('K91:K93');
                $this->excel->getActiveSheet()->mergeCells('K94:K99');
                $this->excel->getActiveSheet()->mergeCells('K100:K102');
                $this->excel->getActiveSheet()->mergeCells('K103:K107');
                $this->excel->getActiveSheet()->mergeCells('K108:K110');
                $this->excel->getActiveSheet()->mergeCells('K111:K113');
                $this->excel->getActiveSheet()->mergeCells('K114:K116');
                $this->excel->getActiveSheet()->mergeCells('K117:K119');
                $this->excel->getActiveSheet()->mergeCells('K120:K122');
                $this->excel->getActiveSheet()->mergeCells('K123:K125');
                $this->excel->getActiveSheet()->mergeCells('K126:K130');
                $this->excel->getActiveSheet()->mergeCells('K131:K135');
                $this->excel->getActiveSheet()->mergeCells('K136:K144');
                $this->excel->getActiveSheet()->mergeCells('K145:K160');
                
                $this->excel->getActiveSheet()->mergeCells('L12:L20');
                $this->excel->getActiveSheet()->setCellValue("L12", "=J12*K12");
                $this->excel->getActiveSheet()->mergeCells('L21:L27');
                $this->excel->getActiveSheet()->setCellValue("L21", "=J21*K21");
                $this->excel->getActiveSheet()->mergeCells('L28:L38');
                $this->excel->getActiveSheet()->setCellValue("L28", "=J28*K28");
                $this->excel->getActiveSheet()->mergeCells('L39:L53');
                $this->excel->getActiveSheet()->setCellValue("L39", "=J39*K39");
                $this->excel->getActiveSheet()->mergeCells('L54:L57');
                $this->excel->getActiveSheet()->setCellValue("L54", "=J54*K54");
                $this->excel->getActiveSheet()->mergeCells('L58:L67');
                $this->excel->getActiveSheet()->setCellValue("L58", "=J58*K58");
                $this->excel->getActiveSheet()->mergeCells('L68:L73');
                $this->excel->getActiveSheet()->setCellValue("L68", "=J68*K68");
                $this->excel->getActiveSheet()->mergeCells('L74:L78');
                $this->excel->getActiveSheet()->setCellValue("L74", "=J74*K74");
                $this->excel->getActiveSheet()->mergeCells('L79:L84');
                $this->excel->getActiveSheet()->setCellValue("L79", "=J79*K79");
                $this->excel->getActiveSheet()->mergeCells('L85:L90');
                $this->excel->getActiveSheet()->setCellValue("L85", "=J85*K85");
                $this->excel->getActiveSheet()->mergeCells('L91:L93');
                $this->excel->getActiveSheet()->setCellValue("L91", "=J91*K91");
                $this->excel->getActiveSheet()->mergeCells('L94:L99');
                $this->excel->getActiveSheet()->setCellValue("L94", "=J94*K94");
                $this->excel->getActiveSheet()->mergeCells('L100:L102');
                $this->excel->getActiveSheet()->setCellValue("L100", "=J100*K102");
                $this->excel->getActiveSheet()->mergeCells('L103:L107');
                $this->excel->getActiveSheet()->setCellValue("L103", "=J103*K103");
                $this->excel->getActiveSheet()->mergeCells('L108:L110');
                $this->excel->getActiveSheet()->setCellValue("L108", "=J108*K108");
                $this->excel->getActiveSheet()->mergeCells('L111:L113');
                $this->excel->getActiveSheet()->setCellValue("L111", "=J111*K111");
                $this->excel->getActiveSheet()->mergeCells('L114:L116');
                $this->excel->getActiveSheet()->setCellValue("L114", "=J114*K114");
                $this->excel->getActiveSheet()->mergeCells('L117:L119');
                $this->excel->getActiveSheet()->setCellValue("L117", "=J117*K117");
                $this->excel->getActiveSheet()->mergeCells('L120:L122');
                $this->excel->getActiveSheet()->setCellValue("L120", "=J120*K20");
                $this->excel->getActiveSheet()->mergeCells('L123:L125');
                $this->excel->getActiveSheet()->setCellValue("L123", "=J123*K123");
                $this->excel->getActiveSheet()->mergeCells('L126:L130');
                $this->excel->getActiveSheet()->setCellValue("L126", "=J126*K126");
                $this->excel->getActiveSheet()->mergeCells('L131:L135');
                $this->excel->getActiveSheet()->setCellValue("L131", "=J131*K131");
                $this->excel->getActiveSheet()->mergeCells('L136:L144');
                $this->excel->getActiveSheet()->setCellValue("L136", "=J136*K136");
                $this->excel->getActiveSheet()->mergeCells('L145:L160');
                $this->excel->getActiveSheet()->setCellValue("L145", "=J145*K145");
                

                
                //lebar kolom
                $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
                $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
                $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("3.3");
                $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("39.18");
                $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("4.64");
                $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth("62.64");
                $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth("19.82");
                $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth("19.82");
                $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth("19.82");
                
                $this->excel->getActiveSheet()->setCellValue("L161", "=SUM(L12:L160)");
//                $this->excel->getActiveSheet()->getColumnDimension("F")->setWrapText(true);
                $this->excel->getActiveSheet()->getStyle('F12:F181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true); 
                 
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
                
                
//                $this->excel->getActiveSheet()->getStyle('D12:D181'.$this->excel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
                //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
                $this->excel->getActiveSheet()->getProtection()->setSheet(true);
                $this->excel->getActiveSheet()->getProtection()->setSort(true);
                $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
                $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
                $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');
                
                header("Content-Type:application/vnd.ms-excel");
                header("Content-Disposition:attachment;filename = Modul1_penilaian_dokumen_kabupaten.xls");
                header("Cache-Control:max-age=0");
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save("php://output"); 
    }
    
    
}
