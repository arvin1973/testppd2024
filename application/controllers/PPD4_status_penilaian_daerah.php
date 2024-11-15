<?php defined('BASEPATH') or exit('No direct script access allowed');

class PPD4_status_penilaian_daerah extends CI_Controller
{
    var $view_dir   = "ppd4/statuspenilaian_daerah/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/Penilaian/dokumen.js";
    var $allowed    = array("PPD4");
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
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
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;

                //common properties
                $this->js_init    = "main";
                $this->js_path    = "assets/js/ppd4/statuspenilaian_daerah/statuspenilaian_daerah.js?v=" . now("Asia/Jakarta");

                $data_page=array();
                $str = $this->load->view($this->view_dir . "index_daerah", $data_page, TRUE);

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

    function allrekap()
    {
        if (!$this->session->userdata(SESSION_LOGIN)) {
            throw new Exception("Session expired, please login", 2);
        }
        
        $idmap = $this->session->userdata(SESSION_LOGIN)->satker;
        
        $kabkota = $this->db->query("SELECT K.id FROM `kabupaten` K 
                    JOIN `provinsi` P ON K.prov_id=P.id_kode 
                    WHERE P.id='$idmap'")->result_array();

        $nama_prov = $this->db->query("SELECT nama_provinsi FROM provinsi WHERE id=$idmap")->row_array();
        $nama_prov = $nama_prov['nama_provinsi'];

        $kabkota_ids_string = implode(",", array_column($kabkota, 'id'));
        
        
        $select = "SELECT W.id,W.iduser,W.idkabkot, P.nama_kabupaten, U.userid,U.name 
        FROM `tbl_user_kabkot` W 
        JOIN `kabupaten` P ON W.idkabkot = P.id 
        JOIN `tbl_user` U ON W.iduser = U.id 
        WHERE W.idkabkot in ($kabkota_ids_string) AND U.id!=674 AND U.group=7";
        $list_data  = $this->db->query($select)->result_array();
        
        $grouped_data = [];

        foreach ($list_data as $entry) {
            $idkabkot = $entry['idkabkot'];
            
            if (!isset($grouped_data[$idkabkot])) {
                $grouped_data[$idkabkot] = [];
            }
            
            $grouped_data[$idkabkot][] = $entry; 
        }
        uksort($grouped_data, function($a, $b) {
            return $a - $b;
        });

        $key_kolom = '';
        $kolom_nama = '';
        $kolom = '';
        $query_skor = '';

        
        $this->load->library("Excel");
        $this->excel->setActiveSheetIndex(0);
        $sharedStyleTitles = new PHPExcel_Style();
        $this->excel->getActiveSheet()->setTitle("Hasil Penilaian");

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);

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

        $excelColumn = [];

        // Generate Excel column names from A to ZZ
        for ($i = 0; $i < 702; $i++) { // 702 corresponds to 'ZZ'
            if ($i < 26) {
                $excelColumn[] = chr($i + 65); // A-Z
            } else {
                $firstLetter = chr(floor(($i - 26) / 26) + 65); // A-Z for the first character
                $secondLetter = chr(($i - 26) % 26 + 65); // A-Z for the second character
                $excelColumn[] = $firstLetter . $secondLetter; // Combine letters for AA-ZZ
            }
        }

        $rowKab = 3;
        $rowJudul = 4;
        $row = 5;
        $rowawal = 5;
        
        $list_kab = array();
        $penilai = array();
        $nm_penilai = array();
        
        $cell_sum = array();
        $cell_range = array();
        $cell_coeff = array();

        $rekap = array();
        foreach ($grouped_data as $group){
            $nm_penilai = '';
            foreach ($group as $d){
                $namakab = $d['nama_kabupaten'];
                $key_kab = 'C'.$rowKab;
                $list_kab[$key_kab] = $namakab;

                $key_kolom .= $d['userid'];
                $dnama = $d['name'];
                $kolom .= $key_kolom.'.skor '. $key_kolom.', ';
                $nilai = $d['id'];
                $penilai[] = $key_kolom;
                $nm_penilai[] = $dnama;
                $query_skor .=  "LEFT JOIN(
                    SELECT I.`id` iditem,II.`skor`
                    FROM `t_mdl1_skor_kabkota` SK
                    JOIN `r_mdl1_item_indi` II ON II.`id`=SK.`itemindi`
                    JOIN `r_mdl1_item` I ON I.`id`=II.`itemid`
                    WHERE SK.`mapid`='$nilai'
                    ) $key_kolom ON $key_kolom.iditem=IT.`id`";
                    $key_kolom='';
                    $kolom_nama='';
            }
            $kolom = rtrim($kolom, ', ');
            $sql = "SELECT K.id NOKRITERIA,K.`nama` KRITERIA,IND.nourut NOINDI,IND.`nama` INDIKATOR,IT.`nourut` NOITEM,IT.`nama` ITEM, IND.bobot BOBOT, $kolom
                        FROM `r_mdl1_item` IT
                        JOIN `r_mdl1_sub_indi` SI ON SI.`id`=IT.`subindiid` AND SI.isprov IN ('ALL', 'KOTKAB', 'KOT')
                        JOIN `r_mdl1_indi` IND ON IND.`id`=SI.`indiid`
                        JOIN  `r_mdl1_krtria` K ON K.`id`=IND.`krtriaid`
                        JOIN `r_mdl1_aspek` A ON A.id = K.aspekid
                        $query_skor
                        ORDER BY IND.`nourut`,SI.nourut, IT.`nourut` ASC";
            $query_skor='';
            $kolom='';
            
            $query_results  = $this->db->query($sql)->result_array(); 

            $countKriteria = array();
            $countIndikator = array();

            foreach ($query_results as $data) {
                if (isset($countKriteria[$data['KRITERIA']])) {
                    $countKriteria[$data['KRITERIA']]++;
                } else {
                    $countKriteria[$data['KRITERIA']] = 1;
                }
                if (isset($countIndikator[$data['INDIKATOR']])) {
                    $countIndikator[$data['INDIKATOR']]++;
                } else {
                    $countIndikator[$data['INDIKATOR']] = 1;
                }
            }
            
            $this->excel->getActiveSheet()->setCellValue('A'.$rowKab, "Nama Kota");
            $this->excel->getActiveSheet()->setCellValue('B'.$rowKab, ":");
            $this->excel->getActiveSheet()->setCellValue('C'.$rowKab, $namakab);

            $list_kab[$key_kab] = $namakab; // Store each namakab in an array at the key

            $cell_skor = array();
            $cell_bobot = array();
            $nm_skor = array();
            $nm_nilai_terbobot = array();
            $nm_skor = '';
            $nm_nilai_terbobot = '';
            $judul= array('No Kriteria','Kriteria','No Indi','Indikator','No Item','Item','Bobot');
            foreach($nm_penilai as $nm){
                $nm_skor[] = 'Skor '.$nm;
                $nm_nilai_terbobot[] = 'Nilai Terbobot '.$nm;
            }
            $merge_judul = array_merge($judul,$nm_penilai,$nm_skor,$nm_nilai_terbobot,array('Rata-Rata'));

            if (!empty($query_results)) {
                // $columnNames = array_keys($query_results[0]);
                $columnNames = $merge_judul;
                $jmlh_penilai =count($nm_penilai);
                $iterasi = 1;
                foreach ($columnNames as $index => $columnName) {
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index] . $rowJudul, $columnName);
                    if($index>=7 && $iterasi <= $jmlh_penilai){
                        $cell_nilai[] = $index; 
                        $cell_skor[] = $index+$jmlh_penilai; 
                        $cell_bobot[] = $index+$jmlh_penilai*2; 
                        $iterasi++;
                    }
                } 
            }
            
            foreach ($countKriteria as $criteria => $count) {
                $endRow = $row + $count - 1;
                $this->excel->getActiveSheet()->mergeCells("A{$row}:A{$endRow}"); 
                $this->excel->getActiveSheet()->mergeCells("B{$row}:B{$endRow}"); 
                $row = $endRow + 1; 
            }

            $averageColumn = end($cell_bobot) + 1;

            $row = $rowawal;
            foreach ($countIndikator as $criteria => $count) {
                $endRow = $row + $count - 1;
                foreach($cell_skor as $c){
                    $knilai = $c-$jmlh_penilai;
                    $ncells = $excelColumn[$knilai].$row.':'.$excelColumn[$knilai].$endRow;
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$c].$row,"=10*sum($ncells)/count($ncells)");
                    $this->excel->getActiveSheet()->mergeCells($excelColumn[$c].$row.':'.$excelColumn[$c].$endRow);
                }

                foreach($cell_bobot as $b)
                {
                    $kskor = $b-$jmlh_penilai;
                    $skor = "G".$row.'*'.$excelColumn[$kskor].$row; 
                    $firstIndex = $cell_bobot[0];
                    $lastIndex = $cell_bobot[count($cell_bobot) - 1];
                    $averageRange = $excelColumn[$firstIndex] . $row . ':' . $excelColumn[$lastIndex] . $row;
                    $average = "AVERAGE(" . $averageRange . ")";

                    $rekap[$key_kab][] = $excelColumn[$averageColumn].$row;
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$b].$row,"=$skor");
                    $this->excel->getActiveSheet()->mergeCells($excelColumn[$b].$row.':'.$excelColumn[$b].$endRow);
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$averageColumn].$row,"=$average");
                    $this->excel->getActiveSheet()->mergeCells($excelColumn[$averageColumn].$row.':'.$excelColumn[$averageColumn].$endRow);
                } 

                $this->excel->getActiveSheet()->mergeCells("C{$row}:C{$endRow}"); 
                $this->excel->getActiveSheet()->mergeCells("D{$row}:D{$endRow}"); 
                $this->excel->getActiveSheet()->mergeCells("G{$row}:G{$endRow}"); 
                $row = $endRow + 1; 
            }

            $row = $rowawal;
            $index_excelColumn = 0;
            foreach ($query_results as $value) {
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['NOKRITERIA']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['KRITERIA']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['NOINDI']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['INDIKATOR']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['NOITEM']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value['ITEM']);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, ($value['BOBOT'] / 100));
                foreach($penilai as $pe)
                {
                    $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value[$pe]);
                }
                $lastIndex = $index_excelColumn;
                $index_excelColumn = 0;
                $row++;
            }
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$lastIndex].$row, "Total");
            $this->excel->getActiveSheet()->mergeCells($excelColumn[$lastIndex].$row.":".$excelColumn[$lastIndex+$jmlh_penilai-1].$row);
            
            $index_excelColumn = $lastIndex+$jmlh_penilai-1;
            $average = $jmlh_penilai+1;
            $cell_rata2 = array();

            for($i=0;$i<$average;$i++)
            {
                $index_excelColumn++;
                $cell_rata2[]=$index_excelColumn;
                $endofrow = $row-1;
                $total = $excelColumn[$index_excelColumn].$rowawal.":".$excelColumn[$index_excelColumn].$endofrow;
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn].$row, "=SUM($total)");
            }
            $cell_sum[] = $excelColumn[$index_excelColumn].$row;
            

            $row++;
            
            $index1 = $cell_rata2[0];
            $index2 = $cell_rata2[count($cell_rata2) - 2];
            
            $range = $lastIndex+$jmlh_penilai*2;
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$lastIndex].$row, "Range");
            $this->excel->getActiveSheet()->mergeCells($excelColumn[$lastIndex].$row.":".$excelColumn[$lastIndex+$jmlh_penilai*2-1].$row);
            
            $valrange = $excelColumn[$index1].($row-1).":".$excelColumn[$index2].($row-1);
            $cellRange = $excelColumn[$range].$row;
            $cell_range[]=$cellRange;
            $this->excel->getActiveSheet()->setCellValue($cellRange, "=MAX($valrange)-MIN($valrange)");
            
            $row++;
            
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$lastIndex].$row, "Coeffisien Variasi");
            $this->excel->getActiveSheet()->mergeCells($excelColumn[$lastIndex].$row.":".$excelColumn[$lastIndex+$jmlh_penilai*2-1].$row);
            
            $firstrange = $valrange = $excelColumn[$index1].($row-2).":".$excelColumn[$index2].($row-2);
            $secondrange = $excelColumn[($index2+1)].($row-2);
            $valcoeff = "=STDEV(".$firstrange.")/".$secondrange."*100";
            $cellCoeff = $excelColumn[$range].$row;
            $cell_coeff[] = $cellCoeff;
            $this->excel->getActiveSheet()->setCellValue($cellCoeff, "$valcoeff");            

            $penilai ='';
            $index_excelColumn ='';

            $rowKab = $row+3;
            $rowJudul = $row+4;
            $row = $row+5;
            $rowawal = $row;
        }           


        $this->excel->createSheet();
        $this->excel->setActiveSheetIndex(1);
        $this->excel->getActiveSheet()->setTitle("Rekap Nilai");

        $row = 3;


        $o=1;
        $indi = count($countIndikator);
        
        $columnIndex = 1;
        for($o;$o<=$indi;$o++){
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].($row-1),"$o");
        }
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].($row-1),"Total Nilai");
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].($row-1),"Range");
        $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].($row-1),"Koefisien Variasi");

        $i = 0;
        
        foreach($rekap as $key => $val){
            $this->excel->getActiveSheet()->setCellValue("A".$row,"='Hasil Penilaian'!$key");
            
            $value = array_unique($val);
            $value = array_values($value);
            
            $columnIndex = 1;
            foreach ($value as $k){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex++].$row,"='Hasil Penilaian'!$k");
            }
            
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$columnIndex].$row,"='Hasil Penilaian'!".$cell_sum[$i]."");
            $this->excel->getActiveSheet()->setCellValue($excelColumn[($columnIndex+1)].$row,"='Hasil Penilaian'!".$cell_range[$i]."");
            $this->excel->getActiveSheet()->setCellValue($excelColumn[($columnIndex+2)].$row,"='Hasil Penilaian'!".$cell_coeff[$i]."");
            
            $i++;
            $row++;
        }
        
        // die;
        $file_name = "Rekap Nilai Tahap I Kab/Kota di " . $nama_prov .".xls";
        
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = $file_name");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
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


                $satker = $this->session->userdata(SESSION_LOGIN)->satker;

                $sql = "SELECT * FROM (
                            SELECT '1' kate, J.id, J.nama nmdok, J.jndok, J.formatdata, DOK.judul, DOK.mapid, DOK.nama_provinsi, DOK.filename, DOK.cr_dt, DOK.cr_by
                            FROM `tbl_jenis_doc_penilaian_kk` J
                            LEFT JOIN(
                                SELECT D.id mapid, D.jenisid, D.judul, D.filename, D.cr_by, D.cr_dt, D.provid, P.nama_provinsi
                                FROM `t_doc_penilaian_kk` D  
                                JOIN `provinsi` P ON D.provid = P.id
                                WHERE D.provid =? AND D.isactive = 'Y') DOK ON DOK.jenisid = J.id
                            WHERE J.tahap='I' AND J.id !='6') AS a
                            UNION
                            SELECT * FROM (
                                SELECT '2' kate, J.id, J.jndok,  D.judul nmdok, J.formatdata, D.judul, D.id mapid, P.nama_provinsi, D.filename, D.cr_dt, D.cr_by
                                FROM `t_doc_penilaian_kk` D 
                                JOIN `provinsi` P ON D.provid = P.id
                            JOIN `tbl_jenis_doc_penilaian_kk` J ON D.jenisid = J.`id`
                                WHERE D.provid =? AND D.isactive = 'Y' AND D.`jenisid`='6' ORDER BY D.id ASC) AS b
                        ORDER BY id, mapid ASC";

                $bind = array($satker, $satker);
                $list_data = $this->db->query($sql, $bind);

                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $str = "";
                $lnk = 'https';
                if ($list_data->num_rows() == 0)
                    $str = "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";

                $no = 1;
                foreach ($list_data->result() as $v) {
                    $val_link = base_url("attachments/penilaian/" . $v->filename);

                    $idcomb = $v->mapid;
                    $encrypted_id = base64_encode(openssl_encrypt($idcomb, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp = "class='btnDel' data-id='" . $encrypted_id . "'";
                    $tmp .= " data-title='" . $v->judul . "'";

                    $idcomb1 = "kot_" . $v->mapid;
                    $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                    $tmped = "class='btnEdi' data-id='" . $encrypted_id1 . "'";
                    $tmped .= " data-nama='" . $v->judul . "'";
                    $tmped .= " data-file='" . $v->filename . "'";

                    $idcomb1 = "kot_" . $v->mapid;
                    $encrypted_id2 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                    $tmpup = "class='btnUp btn btn-xs btn-outline-primary' data-id='" . $encrypted_id2 . "'";
                    $tmpup .= " data-iddok='" . $v->id . "'";
                    $tmpup .= " data-nama='" . $v->jndok . "'";

                    if (substr($v->filename, -3) == 'rar') {
                        $rename = $v->judul . ".rar";
                    } elseif (substr($v->filename, -3) == 'zip') {
                        $rename = $v->judul . ".zip";
                    } elseif (substr($v->filename, -3) == 'pdf') {
                        $rename = $v->judul . ".pdf";
                    } elseif (substr($v->filename, -3) == 'doc') {
                        $rename = $v->judul . ".doc";
                    } elseif (substr($v->filename, -4) == 'docx') {
                        $rename = $v->judul . ".docx";
                    } elseif (substr($v->filename, -4) == 'xlsx') {
                        $rename = $v->judul . ".xlsx";
                    } elseif (substr($v->filename, -3) == 'xls') {
                        $rename = $v->judul . ".xls";
                    } elseif (substr($v->filename, -3) == 'png') {
                        $rename = $v->judul . ".png";
                    } elseif (substr($v->filename, -3) == 'jpg') {
                        $rename = $v->judul . ".jpg";
                    } elseif (substr($v->filename, -4) == 'jpeg') {
                        $rename = $v->judul . ".jpeg";
                    } elseif (substr($v->filename, -4) == 'pptx') {
                        $rename = $v->judul . ".pptx";
                    } else {
                        $rename = $v->judul;
                    }
                    $str .= "<tr class='' title='Dokumen'>";
                    $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $no++ . "</td>";
                    $str .= "<td class='text' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->jndok . "<sup> (<font style='color: #2c03fc'>Max 100 MB</font>, " . $v->formatdata . " ) <span class='text-danger'>*</span></sup></td>";
                    if ($v->filename != null) {
                        if ($v->kate != 1) {
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->cr_by . "</td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->cr_dt . "</td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='$val_link' download='$rename' target='_blank' class='text-primary btn btn-sm ' title='Unduh Data'><i class='fas fa-download'></i></a></td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmped . " class='text-warning btn btn-sm ' title='Edit Data'><i class='text-warning fas fa-pencil-alt'></i></a></td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmp . " class='text-danger btn btn-sm ' title='Hapus Data'><i class='text-danger fas fa-trash-alt '></i></a></td>";
                        } else {
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->cr_by . "</td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'>" . $v->cr_dt . "</td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='$val_link' download='$rename' target='_blank' class='text-primary btn btn-sm ' title='Unduh Data'><i class='fas fa-download'></i></a></td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmped . " class='text-warning btn btn-sm ' title='Edit Data'><i class='text-warning fas fa-pencil-alt'></i></a></td>";
                            $str .= "<td class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'></td>";
                        }
                    } else {
                        $str .= "<td colspan='5' class='text-center' style='padding: 3px; padding-left: 10px; padding-right: 10px; vertical-align: inherit; white-space: inherit;border: 1px solid black'><a href='javascript:void(0)' " . $tmpup . " title='Unggah Dokumen'>Unggah Dokumen <i class='fas fa-upload' style='margin-left: 5px;'></i></a></td>";
                    }
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
    
}
