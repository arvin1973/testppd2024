<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
* Unduh Penilaian Prov
* author : FSM
 * date : 10 des 2020
*/
class PPD3_t2_unduh_nilai_kota extends CI_Controller
{
    var $view_dir   = "ppd3/PPD3_unduh_nilai/t2/";
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
                $this->js_path    = "assets/js/ppd3/PPD3_unduh_nilai/t2/unduh_nilai_kota_t2.js?v=" . now("Asia/Jakarta");


                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_ppd3_kota", $data_page, TRUE);

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
                //get jml aspek modul 2
                $sql = "SELECT A.`id` FROM r_mdl2_aspek A WHERE A.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL 1!");
                }
                $jml_aspek = $list_data->num_rows();

                //get jml item
                $sql = "SELECT I.`id`
                            FROM `r_mdl2_item` I 
                            WHERE I.`isactive`='Y'";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL Kab 1!");
                }
                $jml_item = $list_data->num_rows();

                //table wilayah
                //                $sql= "SELECT 'KAB' kate,A.`id` mapid,P.`id_kab` kode, P.`nama_kabupaten` nmkab
                //                        FROM tbl_user_t2_kabkot A
                //                        JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.urutan=1
                //                        WHERE A.`iduser`=?";
                //                $bind = array($session->id);
                //LIST KABUPATEN
                $sql = "SELECT 'KAB' kate,A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab,P.id_kab kode,JML.jml, ST.id stts,IFNULL(RS.jml,0) jml_rsm
                            FROM `tbl_user_t2_kabkot` A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                            LEFT JOIN(
                                    SELECT W.`idkabkot` idkab, COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_skor_k` SKR ON SKR.`mapid`=W.`id`
                                    JOIN `r_mdl2_item` II ON II.id = SKR.itemindi
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )JML ON JML.idkab=A.`idkabkot`
                            LEFT JOIN (
                                    SELECT W.`idkabkot` idkab,COUNT(1) jml
                                    FROM `tbl_user_t2_kabkot` W
                                    JOIN `t_mdl2_resume_kabkota` RS ON RS.`mapid`=W.`id` AND RS.stts='Y'
                                    WHERE W.`iduser`=?
                                    GROUP BY W.`idkabkot`
                                    )RS ON RS.idkab=A.`idkabkot`                                    
                            LEFT JOIN t_mdl2_sttment_kabkota ST ON ST.mapid=A.id                         
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
                        $tmp .= " data-nmpkk='" . $v->nmkab . "'";

                        $str .= "<div class='card' style='border: 2px solid rgba(38, 166, 154, 0.5); border-radius: 15px;'>";
                        $str .= "<div style='display: flex; align-items: center;'>";
                        $str .= "<img src='" . base_url() . "assets/icons/PNG_KabupatenKota/" . $v->kode . "_" . $v->nmkab . ".png' alt='" . $v->nmkab . "' title='" . $v->nmkab . "' width='100' height='100' style='padding: 15px;'>";
                        $str .= "<div class='card-body' style='padding-top: 0.8rem; padding-left: 0px;'>";
                        $str .= "<div class='content-wilayah' style='display: flex; justify-content: space-between; align-items: center;'>";
                        $str .= "<h4>" . $v->nmkab . "</h4>";
                        $str .= "<div class='btn-wilayah' style='float: right;'>";
                        //status
                        //$prcntg = $jml_item==0?0:$v->jml/$jml_item*100;

                        // if($prcntg==100){
                        //     $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='data resume aspek belum lengkap' style='border-radius: 0px; padding-left: 10px; padding-right: 10px;'";
                        //     $str_icon = "Data resume aspek belum lengkap <i class='fas fa-exclamation'></i>";
                        //     if($v->jml_rsm==$jml_aspek){
                        //         if(!is_null($v->stts)){
                        //             $str_tmp = " ".$tmp." class='btn btn-sm btn-info waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='klik untuk Unduh Nilai' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #29b6f6;'";
                        //                 $str_icon = "Unduh Nilai <i class='fas fa-check-circle'></i>";
                        //         } else {
                        //             $str_tmp = "class='btn btn-sm btn-warning waves-effect waves-light btn-status '  data-toggle='tooltip' data-placement='top' title='klik untuk isi lembar pernyataan' style='border-radius: 0px; padding-left: 10px; padding-right: 10px; background-color: #33b86c;'";
                        //             $str_icon = "Isi lembar pernyataan <i class='fas fa-check-circle'></i>";
                        //         }
                        //     }
                        //     $str .= "<a href='javascript:void(0);' ".$str_tmp.">".$str_icon."</a>";
                        // }else{
                        //     $str .= "<a href='javascript:void(0)'  style='border-radius: 0px; padding-left: 10px;'>Silakan melakukan penilaian Modul 2 <i class='fas fa-exclamation' style='padding-left: 5px;'></i></a>";
                        // }
                        $str .= "<a href='javascript:void(0)' " . $tmp . " style='border-radius: 0px; padding-left: 10px;'>Unduh Nilai <i class='fas fa-download' style='padding-left: 5px;'></i></a>";
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
            if($value->nmindi=="Ketimpangan Antar Kelompok Pendapatan (Gini Rasio) dan  Ketimpangan regional"){
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
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nokr);//A
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmkriteria);//B
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->noindi);//C
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmindi);//D
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nr);//E
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->nmitem);//F
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $judul);//G
            // $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skr);//H
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, " " . $value->ksmplan);//H
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->saran);//I
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->skr);//J
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->bobot/100);//K
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


        $this->excel->getActiveSheet()->setShowGridlines(False);
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul2_" . $user_d . "_" . $namakab . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
