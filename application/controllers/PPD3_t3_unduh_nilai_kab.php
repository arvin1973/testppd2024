<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
* Unduh Penilaian Prov
* author : FSM
 * date : 10 des 2020
*/
class PPD3_t3_unduh_nilai_kab extends CI_Controller
{
    var $view_dir   = "ppd3/PPD3_unduh_nilai/t3/";
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
                $this->js_path    = "assets/js/ppd3/PPD3_unduh_nilai/t3/unduh_nilai_kab_t3.js?v=" . now("Asia/Jakarta");


                $data_page = array();
                $str = $this->load->view($this->view_dir . "index_ppd3_kab", $data_page, TRUE);

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

                //table wilayah
                $sql = "SELECT 'KAB' kate,A.`id` mapid,P.`id_kab` kode, P.`nama_kabupaten` nmkab
                        FROM tbl_user_t3_kabkot A
                        JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.urutan=0
                        WHERE A.`iduser`=?";
                $bind = array($session->id);
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $str = "";
                if ($list_data->num_rows() == 0) {
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
        $_arr = array("PROV", "KAB", "KOT");
        if (!in_array($kate_wlyh, $_arr)) {
            echo 'InvaliD Kategori Wilayah';
            exit(); //   throw new Exception("InvaliD Kategori Wilayah");
        }
        //$user
        $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid
                    FROM `tbl_user_t3_kabkot` W
                    JOIN `kabupaten` P ON W.idkabkot = P.id AND P.urutan=0
                    JOIN `tbl_user` U ON W.iduser = U.id
                    WHERE W.iduser='$user' AND W.id='$idwil'";
        $list_data  = $this->db->query($select);
        foreach ($list_data->result() as $d) {
            $nilai = $d->id;
            $user_d = $d->userid;
            $namakabkot = $d->nama_kabupaten;
        }
        $status_sql = "SELECT K.id nokrr,K.aspekid nokr,K.`nama` nmkriteria,IND.nourut noindi,IND.`nama` nmindi,IT.`nourut` nr,IT.`nama` nmitem,IJ.nama nmjdl,JDL.`judl`,SK.sumber,SK.skor skr,
        RES.ksmplan, RES.saran,IND.bobot
                        FROM `r_mdl3_item` IT
                                JOIN `r_mdl3_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov='N'
                                JOIN `r_mdl3_indi` IND ON IND.`id`=SI.`indiid`
                                LEFT JOIN `r_mdl3_item_judul` IJ ON IJ.`indiid` = IND.`id`
                                JOIN `r_mdl3_krtria` K ON K.`id`=IND.`krtriaid`
                                JOIN `r_mdl3_aspek` A ON A.id = K.aspekid
                                LEFT JOIN `t_mdl3_resume_kabkota` RES ON RES.`aspekid` = A.id AND RES.mapid ='$idwil'
                                LEFT JOIN `t_mdl3_judul_kabkota` JDL ON JDL.judlid = IJ.id AND JDL.mapid ='$idwil'
                                LEFT JOIN `t_mdl3_skor_k` SK ON SK.`itemindi` = IT.id AND SK.mapid ='$idwil'
                                ORDER BY K.aspekid,IND.nourut,IT.`id` ASC";

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
        $this->excel->getActiveSheet()->setCellValue('A1', "Penghargaan Pembangunan Daerah  2022");
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->setCellValue('A2', "Modul 3 Inovasi");

        $this->excel->getActiveSheet()->mergeCells('A2:K2');


        $this->excel->getActiveSheet()->setCellValue('A4', "Nama");
        $this->excel->getActiveSheet()->mergeCells('A4:B4');
        $this->excel->getActiveSheet()->setCellValue('C4', ":");
        $this->excel->getActiveSheet()->setCellValue('A5', "Daerah Yang Dinilai ");
        $this->excel->getActiveSheet()->mergeCells('A5:B5');
        $this->excel->getActiveSheet()->setCellValue('C5', ":");
        $this->excel->getActiveSheet()->setCellValue('D4', "$nama");
        $this->excel->getActiveSheet()->setCellValue('D5', "$namakabkot");
        $this->excel->getActiveSheet()->mergeCells('A2:B2');
        $this->excel->getActiveSheet()->mergeCells('A3:B3');

        $this->excel->getActiveSheet()->setCellValue('F3', "Petunjuk Penilaian:");
        $this->excel->getActiveSheet()->setCellValue('F4', "1. Penilaian dikelompokkan dalam 7 kriteria dan 22 indikator.");
        $this->excel->getActiveSheet()->setCellValue('F5', "2. Masing-masing indikator terdiri dari beberapa item penilaian. Setiap item penilaian memiliki nilai minimum “5” dan maksimum “10”.");
        $this->excel->getActiveSheet()->setCellValue('F6', "3. Item penilaian pada masing-masing indikator dapat dipergunakan oleh TPI dan TPU sebagai alat bantu untuk menentukan nilai indikator.");
        $this->excel->getActiveSheet()->setCellValue('F7', "4. Nilai untuk masing-masing indikator merupakan rata-rata skor dari seluruh item penilaian					        ");
        $this->excel->getActiveSheet()->setCellValue('F8', "5. Total nilai suatu daerah merupakan akumulasi dari seluruh indikator dengan memperhatikan bobot masing-masing indikator					        ");
        $this->excel->getActiveSheet()->setCellValue('F9', "6. Nilai akhir penilaian presentasi dan wawancara adalah nilai tengah dari TPI dan TPU (yang memberikan penilaian).					        ");

        $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'A10:N119');
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
        $this->excel->getActiveSheet()->setCellValue("J10", "KEUNGGULAN");
        $this->excel->getActiveSheet()->mergeCells('J10:J11');
        $this->excel->getActiveSheet()->setCellValue("K10", "REKOMENDASI");
        $this->excel->getActiveSheet()->mergeCells('K10:K11');
        $this->excel->getActiveSheet()->setCellValue("L10", "SKOR");
        $this->excel->getActiveSheet()->mergeCells('L10:L11');
        $this->excel->getActiveSheet()->setCellValue("M10", "BOBOT");
        $this->excel->getActiveSheet()->mergeCells('M10:M11');
        $this->excel->getActiveSheet()->setCellValue("N10", "NILAI TERBOBOT");
        $this->excel->getActiveSheet()->mergeCells('N10:N11');
        $this->excel->getActiveSheet()->setCellValue("A119", "TOTAL");

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
        $this->excel->getActiveSheet()->mergeCells('A12:A66');
        $this->excel->getActiveSheet()->mergeCells('A67:A97');
        $this->excel->getActiveSheet()->mergeCells('A98:A118');

        $this->excel->getActiveSheet()->mergeCells('B12:B66');
        $this->excel->getActiveSheet()->mergeCells('B67:B97');
        $this->excel->getActiveSheet()->mergeCells('B98:B118');

        $this->excel->getActiveSheet()->mergeCells('C12:C17');
        $this->excel->getActiveSheet()->mergeCells('C18:C22');
        $this->excel->getActiveSheet()->mergeCells('C23:C27');
        $this->excel->getActiveSheet()->mergeCells('C28:C32');
        $this->excel->getActiveSheet()->mergeCells('C33:C37');
        $this->excel->getActiveSheet()->mergeCells('C38:C42');
        $this->excel->getActiveSheet()->mergeCells('C43:C47');
        $this->excel->getActiveSheet()->mergeCells('C48:C52');
        $this->excel->getActiveSheet()->mergeCells('C53:C57');
        $this->excel->getActiveSheet()->mergeCells('C58:C62');
        $this->excel->getActiveSheet()->mergeCells('C63:C66');
        $this->excel->getActiveSheet()->mergeCells('C67:C74');
        $this->excel->getActiveSheet()->mergeCells('C75:C77');
        $this->excel->getActiveSheet()->mergeCells('C78:C83');
        $this->excel->getActiveSheet()->mergeCells('C84:C86'); //
        $this->excel->getActiveSheet()->mergeCells('C87:C89');
        $this->excel->getActiveSheet()->mergeCells('C90:C93');
        $this->excel->getActiveSheet()->mergeCells('C94:C97');
        $this->excel->getActiveSheet()->mergeCells('C98:C104');
        $this->excel->getActiveSheet()->mergeCells('C105:C109');
        $this->excel->getActiveSheet()->mergeCells('C110:C113');
        $this->excel->getActiveSheet()->mergeCells('C114:C118');

        $this->excel->getActiveSheet()->mergeCells('D12:D17');
        $this->excel->getActiveSheet()->mergeCells('D18:D22');
        $this->excel->getActiveSheet()->mergeCells('D23:D27');
        $this->excel->getActiveSheet()->mergeCells('D28:D32');
        $this->excel->getActiveSheet()->mergeCells('D33:D37');
        $this->excel->getActiveSheet()->mergeCells('D38:D42');
        $this->excel->getActiveSheet()->mergeCells('D43:D47');
        $this->excel->getActiveSheet()->mergeCells('D48:D52');
        $this->excel->getActiveSheet()->mergeCells('D53:D57');
        $this->excel->getActiveSheet()->mergeCells('D58:D62');
        $this->excel->getActiveSheet()->mergeCells('D63:D66');
        $this->excel->getActiveSheet()->mergeCells('D67:D74');
        $this->excel->getActiveSheet()->mergeCells('D75:D77');
        $this->excel->getActiveSheet()->mergeCells('D78:D83');
        $this->excel->getActiveSheet()->mergeCells('D84:D86'); //
        $this->excel->getActiveSheet()->mergeCells('D87:D89');
        $this->excel->getActiveSheet()->mergeCells('D90:D93');
        $this->excel->getActiveSheet()->mergeCells('D94:D97');
        $this->excel->getActiveSheet()->mergeCells('D98:D104');
        $this->excel->getActiveSheet()->mergeCells('D105:D109');
        $this->excel->getActiveSheet()->mergeCells('D110:D113');
        $this->excel->getActiveSheet()->mergeCells('D114:D118');

        $this->excel->getActiveSheet()->mergeCells('G12:G17');
        $this->excel->getActiveSheet()->mergeCells('G18:G22');
        $this->excel->getActiveSheet()->mergeCells('G23:G27');
        $this->excel->getActiveSheet()->mergeCells('G28:G32');
        $this->excel->getActiveSheet()->mergeCells('G33:G37');
        $this->excel->getActiveSheet()->mergeCells('G38:G42');
        $this->excel->getActiveSheet()->mergeCells('G43:G47');
        $this->excel->getActiveSheet()->mergeCells('G48:G52');
        $this->excel->getActiveSheet()->mergeCells('G53:G57');
        $this->excel->getActiveSheet()->mergeCells('G58:G62');
        $this->excel->getActiveSheet()->mergeCells('G63:G66');
        $this->excel->getActiveSheet()->mergeCells('G67:G74');
        $this->excel->getActiveSheet()->mergeCells('G75:G77');
        $this->excel->getActiveSheet()->mergeCells('G78:G83');
        $this->excel->getActiveSheet()->mergeCells('G84:G86'); //
        $this->excel->getActiveSheet()->mergeCells('G87:G89');
        $this->excel->getActiveSheet()->mergeCells('G90:G93');
        $this->excel->getActiveSheet()->mergeCells('G94:G97');
        $this->excel->getActiveSheet()->mergeCells('G98:G104');
        $this->excel->getActiveSheet()->mergeCells('G105:G109');
        $this->excel->getActiveSheet()->mergeCells('G110:G113');
        $this->excel->getActiveSheet()->mergeCells('G114:G118');

        $this->excel->getActiveSheet()->mergeCells('J12:J66');
        $this->excel->getActiveSheet()->mergeCells('J67:J97');
        $this->excel->getActiveSheet()->mergeCells('J98:J118');

        $this->excel->getActiveSheet()->mergeCells('K12:K66');
        $this->excel->getActiveSheet()->mergeCells('K67:K97');
        $this->excel->getActiveSheet()->mergeCells('K98:K118');

        $this->excel->getActiveSheet()->mergeCells('A119:M119');

        $this->excel->getActiveSheet()->getStyle('A10:N10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A12:N118')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $this->excel->getActiveSheet()->getStyle('A119')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue("N119", "=SUM(N12:N118)");

        $this->excel->getActiveSheet()->mergeCells('L12:L17');
        $this->excel->getActiveSheet()->setCellValue("L12", "=SUM(I12:I17)/COUNTIF(I12:I17,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L18:L22');
        $this->excel->getActiveSheet()->setCellValue("L18", "=SUM(I18:I22)/COUNTIF(I18:I22,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L23:L27');
        $this->excel->getActiveSheet()->setCellValue("L23", "=SUM(I23:I27)/COUNTIF(I23:I27,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L28:L32');
        $this->excel->getActiveSheet()->setCellValue("L28", "=SUM(I28:I32)/COUNTIF(I28:I32,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L33:L37');
        $this->excel->getActiveSheet()->setCellValue("L33", "=SUM(I33:I37)/COUNTIF(I33:I37,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L38:L42');
        $this->excel->getActiveSheet()->setCellValue("L38", "=SUM(I38:I42)/COUNTIF(I38:I42,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L43:L47');
        $this->excel->getActiveSheet()->setCellValue("L43", "=SUM(I43:I47)/COUNTIF(I43:I47,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L48:L52');
        $this->excel->getActiveSheet()->setCellValue("L48", "=SUM(I48:I52)/COUNTIF(I48:I52,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L53:L57');
        $this->excel->getActiveSheet()->setCellValue("L53", "=SUM(I53:I57)/COUNTIF(I53:I57,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L58:L62');
        $this->excel->getActiveSheet()->setCellValue("L58", "=SUM(I58:I62)/COUNTIF(I58:I62,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L63:L66');
        $this->excel->getActiveSheet()->setCellValue("L63", "=SUM(I63:I66)/COUNTIF(I63:I66,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L67:L74');
        $this->excel->getActiveSheet()->setCellValue("L67", "=SUM(I67:I74)/COUNTIF(I67:I74,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L75:L77');
        $this->excel->getActiveSheet()->setCellValue("L75", "=SUM(I75:I77)/COUNTIF(I75:I77,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L78:L83');
        $this->excel->getActiveSheet()->setCellValue("L78", "=SUM(I78:I83)/COUNTIF(I78:I83,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L84:L86');
        $this->excel->getActiveSheet()->setCellValue("L84", "=SUM(I84:I86)/COUNTIF(I84:I86,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L87:L89');
        $this->excel->getActiveSheet()->setCellValue("L87", "=SUM(I87:I89)/COUNTIF(I87:I89,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L90:L93');
        $this->excel->getActiveSheet()->setCellValue("L90", "=SUM(I90:I93)/COUNTIF(I90:I93,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L94:L97');
        $this->excel->getActiveSheet()->setCellValue("L94", "=SUM(I94:I97)/COUNTIF(I94:I97,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L98:L104');
        $this->excel->getActiveSheet()->setCellValue("L98", "=SUM(I98:I104)/COUNTIF(I98:I104,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L105:L109');
        $this->excel->getActiveSheet()->setCellValue("L105", "=SUM(I105:I109)/COUNTIF(I105:I109,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L110:L113');
        $this->excel->getActiveSheet()->setCellValue("L110", "=SUM(I110:I113)/COUNTIF(I110:I113,\">0\"))");
        $this->excel->getActiveSheet()->mergeCells('L114:L118');
        $this->excel->getActiveSheet()->setCellValue("L114", "=SUM(I114:I118)/COUNTIF(I114:I118,\">0\"))");

        $this->excel->getActiveSheet()->mergeCells('M12:M17');
        $this->excel->getActiveSheet()->mergeCells('M18:M22');
        $this->excel->getActiveSheet()->mergeCells('M23:M27');
        $this->excel->getActiveSheet()->mergeCells('M28:M32');
        $this->excel->getActiveSheet()->mergeCells('M33:M37');
        $this->excel->getActiveSheet()->mergeCells('M38:M42');
        $this->excel->getActiveSheet()->mergeCells('M43:M47');
        $this->excel->getActiveSheet()->mergeCells('M48:M52');
        $this->excel->getActiveSheet()->mergeCells('M53:M57');
        $this->excel->getActiveSheet()->mergeCells('M58:M62');
        $this->excel->getActiveSheet()->mergeCells('M63:M66');
        $this->excel->getActiveSheet()->mergeCells('M67:M74');
        $this->excel->getActiveSheet()->mergeCells('M75:M77');
        $this->excel->getActiveSheet()->mergeCells('M78:M83');
        $this->excel->getActiveSheet()->mergeCells('M84:M86'); //
        $this->excel->getActiveSheet()->mergeCells('M87:M89');
        $this->excel->getActiveSheet()->mergeCells('M90:M93');
        $this->excel->getActiveSheet()->mergeCells('M94:M97');
        $this->excel->getActiveSheet()->mergeCells('M98:M104');
        $this->excel->getActiveSheet()->mergeCells('M105:M109');
        $this->excel->getActiveSheet()->mergeCells('M110:M113');
        $this->excel->getActiveSheet()->mergeCells('M114:M118');

        $this->excel->getActiveSheet()->mergeCells('N12:N17');
        $this->excel->getActiveSheet()->setCellValue("N12", "=L12*M12");
        $this->excel->getActiveSheet()->mergeCells('N18:N22');
        $this->excel->getActiveSheet()->setCellValue("N18", "=L18*M18");
        $this->excel->getActiveSheet()->mergeCells('N23:N27');
        $this->excel->getActiveSheet()->setCellValue("N23", "=L23*M23");
        $this->excel->getActiveSheet()->mergeCells('N28:N32');
        $this->excel->getActiveSheet()->setCellValue("N28", "=L28*M28");
        $this->excel->getActiveSheet()->mergeCells('N33:N37');
        $this->excel->getActiveSheet()->setCellValue("N33", "=L33*M33");
        $this->excel->getActiveSheet()->mergeCells('N38:N42');
        $this->excel->getActiveSheet()->setCellValue("N38", "=L38*M38");
        $this->excel->getActiveSheet()->mergeCells('N43:N47');
        $this->excel->getActiveSheet()->setCellValue("N43", "=L43*M43");
        $this->excel->getActiveSheet()->mergeCells('N48:N52');
        $this->excel->getActiveSheet()->setCellValue("N48", "=L48*M48");
        $this->excel->getActiveSheet()->mergeCells('N53:N57');
        $this->excel->getActiveSheet()->setCellValue("N53", "=L53*M53");
        $this->excel->getActiveSheet()->mergeCells('N58:N62');
        $this->excel->getActiveSheet()->setCellValue("N58", "=L58*M58");
        $this->excel->getActiveSheet()->mergeCells('N63:N66');
        $this->excel->getActiveSheet()->setCellValue("N63", "=L63*M63");
        $this->excel->getActiveSheet()->mergeCells('N67:N74');
        $this->excel->getActiveSheet()->setCellValue("N67", "=L67*M67");
        $this->excel->getActiveSheet()->mergeCells('N75:N77');
        $this->excel->getActiveSheet()->setCellValue("N75", "=L75*M75");
        $this->excel->getActiveSheet()->mergeCells('N78:N83');
        $this->excel->getActiveSheet()->setCellValue("N78", "=L78*M78");
        $this->excel->getActiveSheet()->mergeCells('N84:N86'); //
        $this->excel->getActiveSheet()->setCellValue("N84", "=L84*M84");
        $this->excel->getActiveSheet()->mergeCells('N87:N89');
        $this->excel->getActiveSheet()->setCellValue("N87", "=L87*M87");
        $this->excel->getActiveSheet()->mergeCells('N90:N93');
        $this->excel->getActiveSheet()->setCellValue("N90", "=L90*M90");
        $this->excel->getActiveSheet()->mergeCells('N94:N97');
        $this->excel->getActiveSheet()->setCellValue("N94", "=L94*M94");
        $this->excel->getActiveSheet()->mergeCells('N98:N104');
        $this->excel->getActiveSheet()->setCellValue("N98", "=L98*M98");
        $this->excel->getActiveSheet()->mergeCells('N105:N109');
        $this->excel->getActiveSheet()->setCellValue("N105", "=L105*M105");
        $this->excel->getActiveSheet()->mergeCells('N110:N113');
        $this->excel->getActiveSheet()->setCellValue("N110", "=L110*M110");
        $this->excel->getActiveSheet()->mergeCells('N114:N118');
        $this->excel->getActiveSheet()->setCellValue("N114", "=L114*M114");

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


        //font
        $this->excel->getActiveSheet()->getStyle('A1:A11')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A3:F9')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A10:M11')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A119:M119')->getFont()->setBold(true);
        //size    
        $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A10:M11')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A119:M119')->getFont()->setSize(18);
        //$this->excel->getActiveSheet()->getStyle('M203')->getFont()->setSize(18);


        $this->excel->getActiveSheet()->getStyle('D12:K119')->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->setShowGridlines(False);
        $this->excel->getActiveSheet()->getProtection()->setSheet(true);
        $this->excel->getActiveSheet()->getProtection()->setSort(true);
        $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
        $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
        $this->excel->getActiveSheet()->getProtection()->setPassword('garuda');

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = Modul3_" . $user_d . "_" . $namakabkot . ".xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }
}
