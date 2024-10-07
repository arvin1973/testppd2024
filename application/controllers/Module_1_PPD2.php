<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module_1_PPD2 extends CI_Controller {
    var $view_dir   = "admin/module_1/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/module_1/module_1.js";
    
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
                $this->js_path    = "assets/js/admin/module_1/module_1_".$this->session->userdata(SESSION_LOGIN)->groupid.".js";
                

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
    
    function get_datatable(){
        if($this->input->is_ajax_request()){
            try {
                $requestData= $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array( 
                // datatable column index  => database column name
                    $idx++   =>'MP.`id_kode`', 
                    $idx++   =>'MP.`nama_provinsi`',
                    $idx++   =>'KK.`status`',
                );
                
                $sql = "SELECT MP.id,MP.`id_kode`,MP.`nama_provinsi`, KK.`status` 
                        FROM `provinsi` MP
                        LEFT JOIN (SELECT * FROM `tbl_status_penilaian` WHERE `userid` = '$userid' ) KK ON KK.`provid` = MP.id
                        LEFT JOIN `tbl_user_wilayah` W ON W.idwilayah = MP.id
                        WHERE W.iduser='".$userid."' ";
                                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " MP.`id_kode` LIKE '%".$requestData['search']['value']."%' "
                                . " OR MP.`nama_provinsi` LIKE '%".$requestData['search']['value']."%' "
                                . " OR KK.`status` LIKE '%".$requestData['search']['value']."%' "
                                . ")";    
                }
                $list_data = $this->db->query($sql);
                $totalFiltered = $list_data->num_rows();
                $sql.=" ORDER BY "
                        .$columns[$requestData['order'][0]['column']]."   "
                        .$requestData['order'][0]['dir']."  "
                        . "LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
                $list_data = $this->db->query($sql);
                $data = array();
                $i=1;
                foreach ($list_data->result() as $row) {
                    $nestedData=array();
                    $id      = $row->id;
                    $title  = $row->nama_provinsi;
                    $nestedData[] = $i++;
                    $nestedData[] = $row->nama_provinsi;
                    $nestedData[] = "<a class='btn btn-xs btn-info waves-effect waves-light doku' data-id='".encrypt_text($id)."' title='Dokumen '><i class='fa fa-cloud'></i><h7> Bahan Dukung</h7></a>";
                    if($row->status==''){
                        $nestedData[] = "<a class='btn btn-xs btn-outline-secondary waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Belum '><i class='fa fa-pencil'></i><h7> Belum Diisi</h7></a>";
                        $nestedData[] = "";}
                    elseif($row->status=='1'){
                        $nestedData[] = ""
                        . "<a class='btn btn-xs btn-outline-warning waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lenkapi Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a>";
                        $nestedData[] = "";}
                    elseif($row->status=='2'){
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Lembar Pernyataan belum diisi</h7></a>";                   
                         $nestedData[] = "";
//                                 . "<a class='btn btn-xs btn-outline-info waves-purple waves-light download' data-id='".encrypt_text($id)."' title='Download Excel'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a>";
                    }
                    elseif($row->status=='3'){
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a>";
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-purple waves-light download' data-id='".encrypt_text($id)."' title='Download Excel'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a>";     
                    }
                    $data[] = $nestedData;
                }
                $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval( $totalData ),  // total number of records
                    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                    );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
                }
        else
            die;
    }
    
    function detail_dok(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                //provinsi
                $iddaerah = decrypt_text($this->input->post("id"));
               
                if(!is_numeric($iddaerah))
                    throw new Exception("Invalid ID!");
                                
                $this->m_ref->setTableName("provinsi");
                $select = array();
                $cond = array(
                    "id"  => $iddaerah,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
               
                
                $select_dok="SELECT P.*,D.`attch` FROM `provinsi` P LEFT JOIN `tbl_dokumen` D ON D.idprov = P.id WHERE P.id='$iddaerah'";
                //print_r($select_dok);exit();
                $list_dok = $this->db->query($select_dok);
                $content = "";
                foreach ($list_dok->result() as $r_dok) {
                    $content.="<td>3</td>";
                    $content.="<td>Data Pencapaian</td>";
                    $content.="<td><a href='$r_dok->attch' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Data Pencapaian'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                }
                
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
                    "tbl_dok"       =>  $content,
                    "id"      => encrypt_text($iddaerah),
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
        }
        else{exit("Access Denied");}
    }
    
    function detail_get(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                //provinsi
                $iddaerah = decrypt_text($this->input->post("id"));
               
                if(!is_numeric($iddaerah))
                    throw new Exception("Invalid ID!");
                                
                $this->m_ref->setTableName("provinsi");
                $select = array();
                $cond = array(
                    "id"  => $iddaerah,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
               // $penilai=
                foreach ($list_data->result() as $v) {
                    $nama_provinsi = $v->nama_provinsi;                    
                }
                $query="";

                $status_sql="SELECT TI.*, SP.`status` 
                        FROM `tbl_indikator` TI
                        LEFT JOIN (SELECT * FROM `tbl_sp_tbl_indikator` WHERE `user` ='".$this->session->userdata(SESSION_LOGIN)->id."' AND `provinsi`='".$iddaerah."'  GROUP BY `indikator`) SP ON SP.`indikator` = TI.id
                        WHERE 1=1";
                    $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";
                $no=1;
                $content2 = "";
                $content3 = "";
                $content4 = "";   
                $content5 = "";      
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                    if($r_ti2->idkreteria == 1){
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2'){
                            $content.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content.="</tr>";
                    }
                    if($r_ti2->idkreteria == 2){
                        $id      = $r_ti2->id;
                        $content2.="<tr class='odd gradeX'>";
                        $content2.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content2.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content2.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content2.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content2.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content2.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content2.="</tr>";
                    }    
                    if($r_ti2->idkreteria == 3){
                        $id      = $r_ti2->id;
                        $content3.="<tr class='odd gradeX'>";
                        $content3.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content3.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content3.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content3.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content3.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content3.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                    if($r_ti2->idkreteria == 4){
                        $id      = $r_ti2->id;
                        $content4.="<tr class='odd gradeX'>";
                        $content4.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content4.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content4.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content4.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content4.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content4.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                    if($r_ti2->idkreteria == 5){
                        $id      = $r_ti2->id;
                        $content5.="<tr class='odd gradeX'>";
                        $content5.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content5.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content5.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content5.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content5.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content5.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                }
                 //cek jumlah total indikator yang sudah dinilai
                $select_jml="SELECT COUNT(TI.id) AS total,SP.ttl , TI.idkreteria
                                FROM `tbl_indikator` TI 
                                LEFT JOIN (
                                SELECT COUNT(TI.id) AS ttl, TK.id,TS.indikator
                                FROM `tbl_sp_tbl_indikator` TS
                                LEFT JOIN tbl_indikator TI ON TI.id = TS.indikator
                                LEFT JOIN tbl_kriteria TK ON TK.id = TI.idkreteria
                                WHERE TS.`user` ='".$this->session->userdata(SESSION_LOGIN)->id."' AND TS.`provinsi`='".$iddaerah."' AND TS.status = '2'
                                GROUP BY TK.id
                                )SP ON SP.`indikator` = TI.id
                                WHERE 1=1
                                GROUP BY TI.idkreteria";
                $list_jml_n = $this->db->query($select_jml);
                $pencapaian='';$keterkaitan='';$konsistensi='';$kelengkapan='';$inovasi='';
                foreach($list_jml_n->result() as $row_jml){
                    $kriteria = $row_jml->idkreteria;
                    if($kriteria=='1'){
                        if($row_jml->ttl==''){
                            $pencapaian= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $pencapaian= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='2'){
                        if($row_jml->ttl==''){
                            $keterkaitan= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $keterkaitan= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                        
                    }
                    elseif($kriteria=='3'){
                        if($row_jml->ttl==''){
                            $konsistensi= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $konsistensi= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='4'){
                        if($row_jml->ttl==''){
                            $kelengkapan= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $kelengkapan= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='5'){
                        if($row_jml->ttl==''){
                            $inovasi= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $inovasi= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                }
                //cek status penilaian nilai 2
                $lembaran_pernyataan='';
                $select_status="SELECT SP.* FROM tbl_status_penilaian SP WHERE SP.userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND SP.provid = '".$iddaerah."' AND SP.status='2'";
                $list_status = $this->db->query($select_status);
                if($list_status->num_rows() > 0){
                    $lembaran_pernyataan='1';
                }
                
                //sukses
                $output = array(
                    "status"            =>  1,
                    "csrf_hash"         =>  $this->security->get_csrf_hash(),
                    "msg"               =>  "success get data",
                    "profile"           =>  $this->session->userdata(SESSION_LOGIN)->name,
                    "nama_provinsi"     =>  $nama_provinsi,
                    "data"              =>  $list_data->result(),
                    "tbl_pencapaian"       =>  $content,
                    "tbl_keterkaitan"       =>  $content2,
                    "tbl_konsistensi"       =>  $content3,
                    "tbl_kk"            =>  $content4,
                    "tbl_inovasi"       =>  $content5,
                    "id"                => encrypt_text($id),
                    "profile2"          =>  "Nama Penilai :".$this->session->userdata(SESSION_LOGIN)->name,
                    "pencapaian"        =>  $pencapaian,
                    "keterkaitan"       =>  $keterkaitan,
                    "konsistensi"       =>  $konsistensi,
                    "kelengkapan"       =>  $kelengkapan,
                    "inovasi"           =>  $inovasi,
                    "pernyataan"           => $lembaran_pernyataan,
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
        }
        else{exit("Access Denied");}
    }
  
//
    function detail_kategori_skor_d(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                    $user=$this->session->userdata(SESSION_LOGIN)->id;
                $indikator = decrypt_text($this->input->post("id"));      
                if(!is_numeric($indikator))
                    throw new Exception("Invalid ID!");
                $iddaerah = decrypt_text($this->input->post("iddaerah"));

                
                 //catatan indikator
                $select_note="SELECT TI.* FROM tbl_indikator TI WHERE TI.id='".$indikator."' ";
                $list_note = $this->db->query($select_note);
                foreach ($list_note->result() as $r_n) {
                    $catatan= $r_n->note;
                }
                $catatan_res = "";
                $masukan_res = "";
                if($indikator=='7' || $indikator=='22' || $indikator=='24'){
                    $select_resume="SELECT TI.* FROM tbl_resume_aspek_prov TI "
                            . "WHERE TI.indikator='".$indikator."' AND TI.user='".$user."' AND TI.provinsi='".$iddaerah."' ";
                    $list_resume = $this->db->query($select_resume);
                    foreach ($list_resume->result() as $r_re) {
                        $catatan_res = $r_re->catatan;
                        $masukan_res = $r_re->masukan;
                    }
                }
                $ctt='';
                if($catatan==''){ $ctt=''; } else {$ctt='Catatan :';}
                
                //cek kriteria
                $query="SELECT TK.* FROM `tbl_kriteria` TK
                        LEFT JOIN `tbl_indikator` TI ON TK.id= TI.idkreteria
                        LEFT JOIN `tbl_kategori_skor` TS ON TI.id =TS.indikatorid
                        WHERE TS.indikatorid='".$indikator."' GROUP BY TK.id";
                $list_data = $this->db->query($query);
                foreach ($list_data->result() as $r_data) {
                   $kriteria = $r_data->nama_kriteria;
                   $bobot    = $r_data->bobot;
                }
                
                $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.indikatorid='".$indikator."'";
               
                $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";             
                $no=1;
                $sub=3;
               
                foreach ($list_data_i2->result() as $r_ti2) {
                                      
                        $sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".wordwrap($r_ti2->item_penilaian,30,"<br>\n")."</a></td>";
                        if($r_ti2->sk==''){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }
                        elseif($r_ti2->sk=='0'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }
                        elseif($r_ti2->sk=='1'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }                        
                        $content.="</tr>";                    
                     }
                        $sum1=0;$count=0;$Nilai1=0;$Nilai=0;
                        
                //jumlah skor dan jumlah terjawab
                 $jawaban=0;
                 $item=0;
                 $Nilai=0;
                $select_jumlah = "SELECT  COUNT(TN.id) AS J_Terjawab,  SUM(TN.skor) AS J_Jawaban FROM `tbl_nilai_skor` TN 
                                 LEFT JOIN `tbl_kategori_skor` TK ON TN.kat_skor = TK.id 
                                 WHERE TN.`user` ='".$user."' AND TN.`provinsi`='".$iddaerah."' AND TK.`indikatorid`='".$indikator."'";

                $list_jumlah  = $this->db->query($select_jumlah);
                $terjawab = '0';
                foreach ($list_jumlah->result() as $r_sum) {
                    if($r_sum->J_Terjawab==''){
                        $terjawab ='0';
                    }else{
                        $terjawab = $r_sum->J_Terjawab;
                    }
                    
                    $jawaban  = $r_sum->J_Jawaban;
                }
                //Jumlah item penilaian
                $select_Jitem="SELECT COUNT(TK.id) AS J_Item FROM `tbl_kategori_skor` TK WHERE TK.indikatorid = '".$indikator."' ";
                $list_Jitem  = $this->db->query($select_Jitem);
                foreach ($list_Jitem->result() as $r_Jitem) {
                    $item = $r_Jitem->J_Item;
                }
                $Nilai1=($jawaban/$item)*10;
                $Nilai=number_format($Nilai1,2);
                
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success get data",
                    "table_ktg_skor"=>  $content,
                    "total"         => $Nilai,
                    "kriteria"      => "Kriteria ".$kriteria." (".$bobot."%)",
                    "jml_terjawab"  => $terjawab." dari ".$item." item penilaian",
                    "jml_jawaban"   => $jawaban,
                    "no_indikator"  => $indikator,
                    "desk"      => $ctt,
                    "catatan"      => $catatan,
                    "catatan_res"  => $catatan_res,
                    "masukan_res"  => $masukan_res,
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
        }
        else{exit("Access Denied");}
    }
    
    function pilih_skor_i(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                $this->form_validation->set_rules('indkno','ID No','required');
                $this->form_validation->set_rules('nilai','Nilai','required');
                $this->form_validation->set_rules('idin','Id Indikator','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                    
                $user=$this->session->userdata(SESSION_LOGIN)->id;
                $id = decrypt_text($this->input->post("id"));
                $indikator = decrypt_text($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!");
                $iddaerah = decrypt_text($this->input->post("iddaerah"));
                $nilai = $this->input->post("nilai");
                $noind = $this->input->post("indkno");
                $idin = $this->input->post("idin");
                
                //CHECK DATA
                $this->m_ref->setTableName("tbl_nilai_skor");
                $select = array();
                $cond = array(
                    "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                    "provinsi"  => $iddaerah,
                    "kat_skor"        => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_nilai_skor");
                    $data_baru = array(
                        "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                        "provinsi"      => $iddaerah,
                        "kat_skor"        => $id,
                        "skor"      => $nilai,
                        "cr_dt"      => $current_date_time,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                    $this->db->trans_commit();
                   // $pesan='Sukses Insert Data';
                }
                else {
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_nilai_skor");
                    $data_baru = array(
                        "skor"      => $nilai,
                        "ud_dt"      => $current_date_time,
                    );
                    $cond = array(
                        "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                        "provinsi"  => $iddaerah,
                        "kat_skor"  => $id,
                        
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                    $this->db->trans_commit();
                   // $pesan='Sukses Update Data';
                    

                 }
                 //jumlah skor Nilai jumlah skor dan jumlah terjawab
                 $jawaban=0;
                 $item=0;
                 $Nilai=0;
                $select_jumlah = "SELECT  COUNT(TN.id) AS J_Terjawab,  SUM(TN.skor) AS J_Jawaban FROM `tbl_nilai_skor` TN 
                                 LEFT JOIN `tbl_kategori_skor` TK ON TN.kat_skor = TK.id 
                                 WHERE TN.`user` ='".$user."' AND TN.`provinsi`='".$iddaerah."' AND TK.`indikatorid`='".$idin."'";
                //print_r($select_jumlah);exit();
                $list_jumlah  = $this->db->query($select_jumlah);
                foreach ($list_jumlah->result() as $r_sum) {
                    $terjawab = $r_sum->J_Terjawab;
                    $jawaban  = $r_sum->J_Jawaban;
                }
                //Jumlah item penilaian
                $select_Jitem="SELECT COUNT(TK.id) AS J_Item FROM `tbl_kategori_skor` TK WHERE TK.indikatorid = '".$idin."' ";
                $list_Jitem  = $this->db->query($select_Jitem);
                foreach ($list_Jitem->result() as $r_Jitem) {
                    $item = $r_Jitem->J_Item;
                }
                $Nilai1=($jawaban/$item)*10;
                $Nilai=number_format($Nilai1,2);
                                
                $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.indikatorid='".$idin."'";
                $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";             
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                                      
                        $sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".wordwrap($r_ti2->item_penilaian,30,"<br>\n")."</a></td>";
                        if($r_ti2->sk==''){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }
                        elseif($r_ti2->sk=='0'){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }
                        elseif($r_ti2->sk=='1'){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }                        
                        $content.="</tr>";                    
                     }
//                foreach ($list_data_i2->result() as $r_ti2) {
//                        $id      = $r_ti2->id;
//                        $content.="<tr class='odd gradeX'>";
//                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
//                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->item_penilaian."</a></td>";
////                        $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                        //$content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                        if($r_ti2->sk==''){
//                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                                                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
//                        }
//                        elseif($r_ti2->sk=='0'){
//                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
//                        }
//                        elseif($r_ti2->sk=='1'){
//                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
//                        }                          
//                        $content.="</tr>";
//                }
                
                //status Penilaian Indikator
                    if($r_ti2->sk==''){
                        //cek status penilaian Indikator
                        $select_s_p="SELECT * FROM `tbl_sp_tbl_indikator` "
                            . "WHERE user='".$this->session->userdata(SESSION_LOGIN)->id."' "
                            . "AND provinsi='$iddaerah' AND indikator='$idin'";
                        $list_sp  = $this->db->query($select_s_p);
                        if($list_sp->num_rows() == 0){             
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_sp_tbl_indikator");
                            $data_baru = array(
                               "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                               "provinsi"      => $iddaerah,
                               "indikator"      => $idin,
                               "status"      => '1',
                           );
                           $status_save = $this->m_ref->save($data_baru);
                           if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                           $this->db->trans_commit();
                        } 
                        else {
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_sp_tbl_indikator");
                            $data_baru = array(
                               "status"      => '1',
                            );
                            $cond = array(
                               "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                               "provinsi"      => $iddaerah,
                               "indikator"      => $idin,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                        }
                    }
                    else{
                        $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_sp_tbl_indikator");
                             $data_baru = array(
                                "status"      => '2',
                             );
                             $cond = array(
                                "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                                "provinsi"      => $iddaerah,
                                "indikator"      => $idin,
                             );
                             $status_save = $this->m_ref->update($cond,$data_baru);
                             if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                             $this->db->trans_commit();
                    }
                    //status module kota
                    $select_jml="SELECT COUNT(TKS.id) AS J_kategori
                                    FROM `tbl_kategori_skor` TKS
                                    LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                    LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                    LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                    WHERE TM.id='1'";
                    $list_jml_m  = $this->db->query($select_jml);
                    foreach ($list_jml_m->result() as $r_tjml_m){
                        $jml_kategori = $r_tjml_m->J_kategori;
                    }
                    //select jumlah jawaban
                    $select_jwb="SELECT COUNT(TN.id) AS J_nilai
                                FROM `tbl_nilai_skor` TN
                                LEFT JOIN `tbl_kategori_skor` TKS ON TN.kat_skor = TKS.id 
                                LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                WHERE TM.id='1' AND TN.user='".$user."' AND TN.provinsi='".$iddaerah."'";
                    $list_jml_j  = $this->db->query($select_jwb);
                    foreach ($list_jml_j->result() as $r_jml_j){
                        $jml_nilai = $r_jml_j->J_nilai;
                    }
                    //jika kreteria modul sama dengan jumlah jawaban maka cek resume
                    if($jml_kategori == $jml_nilai){
                        //jumlahkan resume aspek, jika sama dengan tiga module selesai dinilai download laporan akan muncul
                        $select_resume="SELECT COUNT(TR.id) AS J_resume
                                        FROM `tbl_resume_aspek_prov` TR
                                        WHERE TR.user ='".$user."' AND TR.provinsi='".$iddaerah."'";
                        $list_resume  = $this->db->query($select_resume);
                        foreach ($list_resume->result() as $r_resume){
                           $jml_resume =  $r_resume->J_resume;
                        }
                        if($jml_resume=='3'){
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian");
                            $data_baru = array(
                                "status"      => '2',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "provid"  => $iddaerah,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                        }
                        
                    }
                    else{
                        $select_s_p="SELECT * FROM `tbl_status_penilaian` "
                                . "WHERE userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND provid='$iddaerah'";
                        $list_sp  = $this->db->query($select_s_p);
                         if($list_sp->num_rows() == 0){
                             $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_status_penilaian");
                             $data_baru = array(
                                    "userid"      => $this->session->userdata(SESSION_LOGIN)->id,
                                    "provid"      => $iddaerah,
                                    "status"      => '1',
                            );
                             $status_save = $this->m_ref->save($data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();                    
                         } 
                         else {
                             //status penilaian pr
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian");
                            $data_baru = array(
                                "status"      => '1',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "provid"  => $iddaerah,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                         }
                    }
                
                //sukses
                $output = array(
                    "status"         => 1,
                    "csrf_hash"      => $this->security->get_csrf_hash(),
                    "msg"            => "success get data",
                    "table_ktg_skor" => $content,
                    "nilai"          => $Nilai,
                );
                exit(json_encode($output));
            } catch (Exception $exc)  {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage(),
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    //save resume Aspek provinsi
    function add_catatan_prov()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('provresume','provresume','required|xss_clean');
                $this->form_validation->set_rules('provindikaresum','provindikaresum','required|xss_clean');
                $this->form_validation->set_rules('provcatatan','provcatatan','required|xss_clean');
                $this->form_validation->set_rules('provsaran','provsaran','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $userid=$this->session->userdata(SESSION_LOGIN)->id;
                $prov = decrypt_text($this->input->post("provresume"));      
                if(!is_numeric($prov))
                    throw new Exception("Invalid ID Prov!");
                $provindikaresum = $this->input->post("provindikaresum");
                
                $catatan = $this->input->post("provcatatan");
                $saran = $this->input->post("provsaran");
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_resume_aspek_prov");
                $select = array();
                $cond = array(
                    "user"  => $userid,
                    "provinsi" => $prov,
                    "indikator" => $provindikaresum,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_resume_aspek_prov");
                    $data_baru = array(
                        "catatan"  => $catatan,
                        "masukan"  => $saran,
                        "ud_dt"    => $current_date_time,
                    );
                    $cond = array(
                       "user"       => $userid,
                        "provinsi"  => $prov,
                        "indikator" => $provindikaresum,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();   
                }
                else{
                    $this->db->trans_begin();
                     $this->m_ref->setTableName("tbl_resume_aspek_prov");
                    $data_baru = array(
                        "user"      => $userid,
                        "provinsi" => $prov,
                        "indikator" => $provindikaresum,
                        "catatan"   => $catatan,
                        "masukan"   => $saran,
                        "cr_dt"     => $current_date_time,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                }
                
                //status module kab
                    $select_jml="SELECT COUNT(TKS.id) AS J_kategori
                                    FROM `tbl_kategori_skor` TKS
                                    LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                    LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                    LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                    WHERE TM.id='1'";
                    $list_jml_m  = $this->db->query($select_jml);
                    foreach ($list_jml_m->result() as $r_tjml_m){
                        $jml_kategori = $r_tjml_m->J_kategori;
                    }
                    //select jumlah jawaban
                    $select_jwb="SELECT COUNT(TN.id) AS J_nilai
                                FROM `tbl_nilai_skor` TN
                                LEFT JOIN `tbl_kategori_skor` TKS ON TN.kat_skor = TKS.id 
                                LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                WHERE TM.id='1' AND TN.user='".$userid."' AND TN.provinsi='".$prov."'";
                    $list_jml_j  = $this->db->query($select_jwb);
                    foreach ($list_jml_j->result() as $r_jml_j){
                        $jml_nilai = $r_jml_j->J_nilai;
                    }
                    //jika kreteria modul sama dengan jumlah jawaban maka cek resume
                    if($jml_kategori == $jml_nilai){
                        //jumlahkan resume aspek, jika sama dengan tiga module selesai dinilai download laporan akan muncul
                        $select_resume="SELECT COUNT(TR.id) AS J_resume
                                        FROM `tbl_resume_aspek_prov` TR
                                        WHERE TR.user ='".$userid."' AND TR.provinsi='".$prov."'";
                        $list_resume  = $this->db->query($select_resume);
                        foreach ($list_resume->result() as $r_resume){
                           $jml_resume =  $r_resume->J_resume;
                        }
                        if($jml_resume=='3'){
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian");
                            $data_baru = array(
                                "status"      => '2',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "provid"  => $prov,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                        }
                        
                    }else{
                        $select_s_p="SELECT * FROM `tbl_status_penilaian` "
                                . "WHERE userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND provid='$prov'";
                        $list_sp  = $this->db->query($select_s_p);
                         if($list_sp->num_rows() == 0){
                             $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_status_penilaian");
                             $data_baru = array(
                                    "userid"      => $this->session->userdata(SESSION_LOGIN)->id,
                                    "provid"    => $prov,
                                    "status"      => '1',
                            );
                             $status_save = $this->m_ref->save($data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();                    
                         } 
                         else {
                             //status penilaian pr
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian");
                            $data_baru = array(
                                "status"      => '1',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "provid"  => $prov,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                         }
                    }
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Resume Aspek Sukses disimpan"
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    } 
    
         //save lembaran Provinsi
    function add_lembaranpernyataan_prov()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('prov','prov','required|xss_clean');
                $this->form_validation->set_rules('nama','nama','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $userid=$this->session->userdata(SESSION_LOGIN)->id;
                $prov = decrypt_text($this->input->post("prov"));      
                if(!is_numeric($prov))
                    throw new Exception("Invalid ID Provinsi!");
                $nama = $this->input->post("nama");
               
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_lembar_pernyataan_prov");
                $select = array();
                $cond = array(
                    "user"      => $userid,
                    "prov"      => $prov,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_lembar_pernyataan_prov");
                    $data_baru = array(
                        "nama"  => $nama,
                        "ud_dt"    => $current_date_time,
                    );
                    $cond = array(
                       "user"      => $userid,
                        "prov"      => $prov,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();   
                }
                else{
                    $this->db->trans_begin();
                     $this->m_ref->setTableName("tbl_lembar_pernyataan_prov");
                    $data_baru = array(
                        "user"     => $userid,
                        "prov"      => $prov,
                        "nama"     => $nama,
                        "cr_dt"    => $current_date_time,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                }
                    
                
                //update status penilaian kota
                $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_status_penilaian");
                    $data_baru = array(
                        "status"  => '3'
                    );
                    $cond = array(
                       "userid"      => $userid,
                        "provid"      => $prov,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  " Sukses disimpan",
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    function Download_excel(){
        if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
        //$id = $_GET['wl'];
        $idpro = decrypt_text($_GET['wl']);
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        //$idind = decrypt_text($_GET['in']);

            //cari Provinsi
        $d_pro="SELECT I.* FROM `provinsi` I WHERE id='$idpro'";
                $list_pro = $this->db->query($d_pro);
                foreach ($list_pro->result() as $pro){
                    $nm_wilayah   = $pro->nama_provinsi;
                    
                }
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        $this->excel->getSheet(0)->setTitle('Rekap Nilai '.$nm_wilayah.'');
        
//                //cari data 
        $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$idpro."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE 1=1";
        $list_data  = $this->db->query($status_sql);
                $excelColumn = range('A', 'ZZ');
                $index_excelColumn = 1;
                $row = $rowstart = 9;
                $row2 = $rowstart2 = 16;
                $row3 = $rowstart3 = 22;$row4 = $rowstart4 = 28;
        $row5 = $rowstart5 = 32;$row6 = $rowstart6 = 38;$row7 = $rowstart7 = 44;$row8 = $rowstart8 = 63;$row9 = $rowstart9 = 69;
        $row10 = 76;$row11 = 82;$row12 = 88;$row13 = 94;$row14 = 101; $row15 = 107; $row16 = 113; $row17 = 119; $row18 = 125; $row19 = 131;$row20 = 137;
        $row21 = 143;$row22 = 149;$row23 = 168; $row24 = 174;
                
        foreach ($list_data->result() as $value) {
            $indikatorid                = $value->indikatorid;
            if($indikatorid == '1'){ 
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->sk);
            }
            if($indikatorid == '2'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->sk);
            }
            if($indikatorid == '3'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->sk);
            }
            if($indikatorid == '4'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->sk);
            }
            if($indikatorid == '5'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->sk);
            }
            if($indikatorid == '6'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->sk);
            }
            if($indikatorid == '7'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->sk);
            }
            if($indikatorid == '8'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->sk);
            }
            if($indikatorid == '9'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->sk);
            }
            if($indikatorid == '10'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->sk);
            }
            if($indikatorid == '11'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->sk);
            }
            if($indikatorid == '12'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->sk);
            }
            if($indikatorid == '13'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->sk);
            }
            if($indikatorid == '14'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->sk);
            }                    
            if($indikatorid == '15'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->sk);
            }
            if($indikatorid == '16'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->sk);
            }
            if($indikatorid == '17'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->sk);
            }
            if($indikatorid == '18'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->sk);
            }
            if($indikatorid == '19'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->sk);
            }
            if($indikatorid == '20'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->sk);
            }
            if($indikatorid == '21'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->sk);
            }
            if($indikatorid == '22'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->sk);
            }
            if($indikatorid == '23'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->sk);
            }
            if($indikatorid == '24'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->sk);
            }
            $index_excelColumn=1;$row++;$row2++;$row3++;$row4++;$row5++;$row6++;$row7++;$row8++;$row9++;$row10++;$row11++;
            $row12++;$row13++;$row14++;$row15++;$row16++;$row17++;$row18++;$row19++;$row20++;$row21++;$row22++;$row23++;$row24++;
        }
        
        $select_r="SELECT * FROM tbl_resume_aspek_prov WHERE user = '".$user."' AND provinsi = '".$idpro."' ";
//        print_r($select_r);exit();
        $list_resume  = $this->db->query($select_r);
        foreach ($list_resume->result() as $resume){
            $indka = $resume->indikator;
            if($indka == '7'){
                $this->excel->getActiveSheet()->setCellValue('B115', $resume->catatan);
                $this->excel->getActiveSheet()->setCellValue('B120', $resume->masukan);
            }
            
        }
        ;
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

                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B7:F18');
//                $this->excel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->setCellValue('A2', "Nama Penilai");
                $this->excel->getActiveSheet()->setCellValue('C2', $this->session->userdata(SESSION_LOGIN)->name);
                $this->excel->getActiveSheet()->setCellValue('A3', "Provinsi Dinilai :");
                $this->excel->getActiveSheet()->setCellValue('C3', $nm_wilayah);
                $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->mergeCells('A2:B2');
                $this->excel->getActiveSheet()->mergeCells('A3:B3');
                
                $this->excel->getActiveSheet()->setCellValue("A4", "Kriteria Pencapaian(40%)");
                $this->excel->getActiveSheet()->setCellValue('A5', '1');
                $this->excel->getActiveSheet()->setCellValue('B5', 'Pertumbuhan Ekonomi dan Pertumbuhan PDRB per Kapita');
                $this->excel->getActiveSheet()->setCellValue("B6", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C6", "5,00%");
                
                $this->excel->getActiveSheet()->setCellValue("B7", "No");
                $this->excel->getActiveSheet()->mergeCells('B7:B8');
                $this->excel->getActiveSheet()->setCellValue("C7", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C7:C8');
                $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("35");
                 
                $this->excel->getActiveSheet()->setCellValue("D7", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D7:E7');
  //              $this->excel->getActiveSheet()->getStyle('D7:E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("18");
                $this->excel->getActiveSheet()->setCellValue("D8", "0");
                $this->excel->getActiveSheet()->setCellValue("E8", "1");
                $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("18");
                $this->excel->getActiveSheet()->setCellValue("F7", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F7:F8');
                $this->excel->getActiveSheet()->setCellValue("B18", "Jumlah Skor");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F5:F6');
                $this->excel->getActiveSheet()->setCellValue("F5", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F6", "=(SUM(F9:F17)/COUNT(B9:B17))*10");
                $this->excel->getActiveSheet()->setCellValue("F18", "=SUM(F9:F17)");
                
                $this->excel->getActiveSheet()->getStyle('B7:F4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B18')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C9:E17')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->getStyle('B7:B17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C7:F8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F5:F18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->mergeCells('B18:E18');

                
                $this->excel->getActiveSheet()->setCellValue('A21', '2');
                $this->excel->getActiveSheet()->setCellValue('B21', 'Tingkat Pengangguran Terbuka (TPT)dan Jumlah Pengangguran');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F21:F22');
                $this->excel->getActiveSheet()->setCellValue("F21", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("B22", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C22", "6,00%");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B23:F32');
                $this->excel->getActiveSheet()->setCellValue("B23", "No");
                $this->excel->getActiveSheet()->mergeCells('B23:B24');
                $this->excel->getActiveSheet()->setCellValue("C23", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C23:C24');
                $this->excel->getActiveSheet()->setCellValue("D23", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D23:E24');
                $this->excel->getActiveSheet()->setCellValue("D24", "0");
                $this->excel->getActiveSheet()->setCellValue("E24", "1");
                $this->excel->getActiveSheet()->setCellValue("F23", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F23:F24');
                $this->excel->getActiveSheet()->setCellValue("B32", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B32:E32');
                $this->excel->getActiveSheet()->setCellValue("F32", "=SUM(F25:F31)");
                $this->excel->getActiveSheet()->setCellValue("F22", "=(SUM(F25:F31)/COUNT(B25:B31))*10");
                $this->excel->getActiveSheet()->getStyle('B23:B31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('B32')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C25:E31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F22')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->getStyle('C25:E31')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->getStyle('F21:F32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $this->excel->getActiveSheet()->setCellValue('A34', '3');
                $this->excel->getActiveSheet()->setCellValue('B34', 'Kemiskinan');
                $this->excel->getActiveSheet()->setCellValue("B35", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C35", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F34:F35');
                $this->excel->getActiveSheet()->setCellValue("F34", "Nilai");
                //$this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B22:F30');
                $this->excel->getActiveSheet()->setCellValue("B36", "No");
                $this->excel->getActiveSheet()->mergeCells('B36:B37');
                $this->excel->getActiveSheet()->setCellValue("C36", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C36:C37');
                $this->excel->getActiveSheet()->setCellValue("D36", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D36:E36');
                $this->excel->getActiveSheet()->setCellValue("D37", "0");
                $this->excel->getActiveSheet()->setCellValue("E37", "1");
                $this->excel->getActiveSheet()->setCellValue("F36", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F36:F37');
                $this->excel->getActiveSheet()->setCellValue("B49", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B49:E49');
                $this->excel->getActiveSheet()->setCellValue("F49", "=SUM(F37:F47)");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B36:F49');
                $this->excel->getActiveSheet()->setCellValue("F35", "=(SUM(F38:F48)/COUNT(F38:F48))*10");
                $this->excel->getActiveSheet()->getStyle('F35')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A51", "4");
                $this->excel->getActiveSheet()->setCellValue('B51', 'Indeks Pembangunan Manusia (IPM)');
                $this->excel->getActiveSheet()->setCellValue("B52", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C52", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F51:F52');
                $this->excel->getActiveSheet()->setCellValue("F51", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F52", "=(SUM(F55:F68)/COUNT(F55:F68))*10");
                $this->excel->getActiveSheet()->setCellValue("B53", "No");
                $this->excel->getActiveSheet()->mergeCells('B53:B54');
                $this->excel->getActiveSheet()->setCellValue("C53", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C53:C54');
                $this->excel->getActiveSheet()->setCellValue("D53", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D53:E53');
                $this->excel->getActiveSheet()->setCellValue("D54", "0");
                $this->excel->getActiveSheet()->setCellValue("E54", "1");
                $this->excel->getActiveSheet()->setCellValue("F53", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F53:F54');
                $this->excel->getActiveSheet()->setCellValue("B70", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B70:E70');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B53:F70');
                $this->excel->getActiveSheet()->getStyle('F51')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A71", "5");
                $this->excel->getActiveSheet()->setCellValue('B71', 'Ketimpangan');
                $this->excel->getActiveSheet()->setCellValue("B72", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C72", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F71:F72');
                $this->excel->getActiveSheet()->setCellValue("F71", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F72", "=(SUM(F75:F81)/COUNT(F75:F81))*10");
                $this->excel->getActiveSheet()->setCellValue("B73", "No");
                $this->excel->getActiveSheet()->mergeCells('B73:B74');
                $this->excel->getActiveSheet()->setCellValue("C73", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C73:C74');
                $this->excel->getActiveSheet()->setCellValue("D73", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D73:E73');
                $this->excel->getActiveSheet()->setCellValue("D74", "0");
                $this->excel->getActiveSheet()->setCellValue("E74", "1");
                $this->excel->getActiveSheet()->setCellValue("F73", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F73:F74');
                $this->excel->getActiveSheet()->setCellValue("B82", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B82:E82');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B73:F82');
                $this->excel->getActiveSheet()->getStyle('F72')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A84", "6");
                $this->excel->getActiveSheet()->setCellValue('B84', 'Pelayanan Publik dan Pengelolaan Keuangan ');
                $this->excel->getActiveSheet()->setCellValue("B85", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C85", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F84:F85');
                $this->excel->getActiveSheet()->setCellValue("F84", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F85", "=(SUM(F88:F97)/COUNT(F88:F97))*10");
                $this->excel->getActiveSheet()->setCellValue("B86", "No");
                $this->excel->getActiveSheet()->mergeCells('B86:B87');
                $this->excel->getActiveSheet()->setCellValue("C86", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C86:C87');
                $this->excel->getActiveSheet()->setCellValue("D86", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D86:E86');
                $this->excel->getActiveSheet()->setCellValue("D87", "0");
                $this->excel->getActiveSheet()->setCellValue("E87", "1");
                $this->excel->getActiveSheet()->setCellValue("F86", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F86:F87');
                $this->excel->getActiveSheet()->setCellValue("B98", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B98:E98');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B86:F98');
                $this->excel->getActiveSheet()->getStyle('F85')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

                $this->excel->getActiveSheet()->setCellValue("A100", "7");
                $this->excel->getActiveSheet()->setCellValue('B100', 'Transparansi dan Akuntabilitas');
                $this->excel->getActiveSheet()->setCellValue("B101", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C101", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F100:F101');
                $this->excel->getActiveSheet()->setCellValue("F100", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F101", "=(SUM(F104:F110)/COUNT(F104:F110))*10");
                $this->excel->getActiveSheet()->setCellValue("B102", "No");
                $this->excel->getActiveSheet()->mergeCells('B102:B103');
                $this->excel->getActiveSheet()->setCellValue("C102", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C102:C103');
                $this->excel->getActiveSheet()->setCellValue("D102", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D102:E102');
                $this->excel->getActiveSheet()->setCellValue("D103", "0");
                $this->excel->getActiveSheet()->setCellValue("E103", "1");
                $this->excel->getActiveSheet()->setCellValue("F102", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F102:F103');
                $this->excel->getActiveSheet()->setCellValue("B111", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B111:E111');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B102:F111');
                $this->excel->getActiveSheet()->getStyle('F101')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B113', 'Resume Aspek Pencapaian Pembangunan ');
                $this->excel->getActiveSheet()->setCellValue("B114", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B115:F118');
                $this->excel->getActiveSheet()->setCellValue('B119', 'Masukan dan Saran terhadap Aspek Pencapaian Pembangunan');
                $this->excel->getActiveSheet()->mergeCells('B120:F123');
                //
                $this->excel->getActiveSheet()->setCellValue("A125", "Kriteria Keterkaitan (5%)");
                $this->excel->getActiveSheet()->setCellValue("A126", "8");
                $this->excel->getActiveSheet()->setCellValue('B126', 'Tersedianya Penjelasan Strategi dan Arah Kebijakan RKPD 2020 yang Terkait dengan Visi dan Misi, Strategi dan Arah Kebijakan RPJMD');
                $this->excel->getActiveSheet()->setCellValue("B127", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C127", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F126:F127');
                $this->excel->getActiveSheet()->setCellValue("F126", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F127", "=(SUM(F130:F134)/COUNT(F130:F134))*10");
                $this->excel->getActiveSheet()->setCellValue("B128", "No");
                $this->excel->getActiveSheet()->mergeCells('B128:B129');
                $this->excel->getActiveSheet()->setCellValue("C128", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C128:C129');
                $this->excel->getActiveSheet()->setCellValue("D128", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D128:E128');
                $this->excel->getActiveSheet()->setCellValue("D129", "0");
                $this->excel->getActiveSheet()->setCellValue("E129", "1");
                $this->excel->getActiveSheet()->setCellValue("F128", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F128:F129');
                $this->excel->getActiveSheet()->setCellValue("B135", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B135:E135');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B128:F135');
                $this->excel->getActiveSheet()->getStyle('F127')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->mergeCells('B126:E126');
                $this->excel->getActiveSheet()->getStyle('B126')->getAlignment()->setWrapText(true);
                
                                $this->excel->getActiveSheet()->setCellValue("A137", "9");
                $this->excel->getActiveSheet()->setCellValue('B137', 'Tersedianya Penjelasan Keterkaitan antara Sasaran dan Prioritas Pembangunan Daerah dalam RKPD 2020 dengan Sasaran Prioritas Nasional (PN) RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B138", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C138", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F137:F138');
                $this->excel->getActiveSheet()->setCellValue("F137", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F138", "=(SUM(F141:F146)/COUNT(F141:F146))*10");
                $this->excel->getActiveSheet()->setCellValue("B139", "No");
                $this->excel->getActiveSheet()->mergeCells('B139:B140');
                $this->excel->getActiveSheet()->setCellValue("C139", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C139:C140');
                $this->excel->getActiveSheet()->setCellValue("D139", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D139:E139');
                $this->excel->getActiveSheet()->setCellValue("D140", "0");
                $this->excel->getActiveSheet()->setCellValue("E140", "1");
                $this->excel->getActiveSheet()->setCellValue("F139", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F139:F140');
                $this->excel->getActiveSheet()->setCellValue("B147", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B147:E147');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B139:F147');
                $this->excel->getActiveSheet()->getStyle('F138')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->getStyle('B137')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->mergeCells('B137:E137');
                
                $this->excel->getActiveSheet()->setCellValue("A149", "Kriteria Konsistensi (11,25%)");
                                $this->excel->getActiveSheet()->setCellValue("A150", "10");
                $this->excel->getActiveSheet()->setCellValue('B150', 'Terwujudnya Konsistensi antara Hasil Evaluasi Pelaksanaan RKPD 2018 dengan Permasalahan dan Isu Strategis pada RKPD 2020');
                $this->excel->getActiveSheet()->setCellValue("B151", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C151", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F150:F151');
                $this->excel->getActiveSheet()->setCellValue("F150", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F151", "=(SUM(F154:F159)/COUNT(F154:F159))*10");
                $this->excel->getActiveSheet()->setCellValue("B152", "No");
                $this->excel->getActiveSheet()->mergeCells('B152:B153');
                $this->excel->getActiveSheet()->setCellValue("C152", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C152:C153');
                $this->excel->getActiveSheet()->setCellValue("D152", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D152:E152');
                $this->excel->getActiveSheet()->setCellValue("D153", "0");
                $this->excel->getActiveSheet()->setCellValue("E153", "1");
                $this->excel->getActiveSheet()->setCellValue("F152", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F152:F153');
                $this->excel->getActiveSheet()->setCellValue("B160", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B160:E160');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B152:F160');
                $this->excel->getActiveSheet()->getStyle('F151')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A162", "11");
                $this->excel->getActiveSheet()->setCellValue('B162', 'Terwujudnya Konsistensi antara Prioritas Pembangunan Daerah dengan Permasalahan/Isu Strategis pada RKPD 2020');
                $this->excel->getActiveSheet()->setCellValue("B163", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C163", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F162:F163');
                $this->excel->getActiveSheet()->setCellValue("F162", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F163", "=(SUM(F166:F168)/COUNT(F166:F168))*10");
                $this->excel->getActiveSheet()->setCellValue("B164", "No");
                $this->excel->getActiveSheet()->mergeCells('B164:B165');
                $this->excel->getActiveSheet()->setCellValue("C164", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C164:C165');
                $this->excel->getActiveSheet()->setCellValue("D164", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D164:E164');
                $this->excel->getActiveSheet()->setCellValue("D165", "0");
                $this->excel->getActiveSheet()->setCellValue("E165", "1");
                $this->excel->getActiveSheet()->setCellValue("F164", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F164:F165');
                $this->excel->getActiveSheet()->setCellValue("B169", "Jumlah Skor");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B164:F169');
                $this->excel->getActiveSheet()->getStyle('F163')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A171", "12");
                $this->excel->getActiveSheet()->setCellValue('B171', 'Terwujudnya Konsistensi antara Prioritas Pembangunan Daerah dalam RKPD 2020 dengan Program Prioritas');
                $this->excel->getActiveSheet()->setCellValue("B172", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C172", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F171:F172');
                $this->excel->getActiveSheet()->setCellValue("F171", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F172", "=(SUM(F175:F180)/COUNT(F175:F180))*10");
                $this->excel->getActiveSheet()->setCellValue("B173", "No");
                $this->excel->getActiveSheet()->mergeCells('B173:B174');
                $this->excel->getActiveSheet()->setCellValue("C173", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C173:C174');
                $this->excel->getActiveSheet()->setCellValue("D173", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D173:E173');
                $this->excel->getActiveSheet()->setCellValue("D174", "0");
                $this->excel->getActiveSheet()->setCellValue("E174", "1");
                $this->excel->getActiveSheet()->setCellValue("F173", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F173:F174');
                $this->excel->getActiveSheet()->setCellValue("B181", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B181:E181');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B173:F181');
                $this->excel->getActiveSheet()->getStyle('F172')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A183", "13");
                $this->excel->getActiveSheet()->setCellValue('B183', 'Terwujudnya Konsistensi antara Prioritas Pembangunan dalam RKPD 2020 dengan Pagu Anggaran');
                $this->excel->getActiveSheet()->setCellValue("B184", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C184", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F183:F184');
                $this->excel->getActiveSheet()->setCellValue("F183", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F184", "=(SUM(F187:F189)/COUNT(F187:F189))*10");
                $this->excel->getActiveSheet()->setCellValue("B185", "No");
                $this->excel->getActiveSheet()->mergeCells('B185:B186');
                $this->excel->getActiveSheet()->setCellValue("C185", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C185:C186');
                $this->excel->getActiveSheet()->setCellValue("D185", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D185:E185');
                $this->excel->getActiveSheet()->setCellValue("D186", "0");
                $this->excel->getActiveSheet()->setCellValue("E186", "1");
                $this->excel->getActiveSheet()->setCellValue("F185", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F185:F186');
                $this->excel->getActiveSheet()->setCellValue("B190", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B190:E190');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B185:F190');
                $this->excel->getActiveSheet()->getStyle('F184')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A192", "Kriteria Kelengkapan dan Kedalaman (23,75%)");
                $this->excel->getActiveSheet()->setCellValue("A193", "14");
                $this->excel->getActiveSheet()->setCellValue('B193', 'Tersedianya Kerangka Ekonomi dan Kerangka Pendanaan dang Dilengkapi dengan Proyeksi dan Arah Kebijakan');
                $this->excel->getActiveSheet()->setCellValue("B194", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C194", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F193:F94');
                $this->excel->getActiveSheet()->setCellValue("F193", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F194", "=(SUM(F197:F202)/COUNT(F197:F202))*10");
                $this->excel->getActiveSheet()->setCellValue("B195", "No");
                $this->excel->getActiveSheet()->mergeCells('B195:B196');
                $this->excel->getActiveSheet()->setCellValue("C195", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C195:C196');
                $this->excel->getActiveSheet()->setCellValue("D195", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D195:E195');
                $this->excel->getActiveSheet()->setCellValue("D196", "0");
                $this->excel->getActiveSheet()->setCellValue("E196", "1");
                $this->excel->getActiveSheet()->setCellValue("F195", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F195:F196');
                $this->excel->getActiveSheet()->setCellValue("B203", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B203:E203');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B195:F203');
                $this->excel->getActiveSheet()->getStyle('F194')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A205", "15");
                $this->excel->getActiveSheet()->setCellValue('B205', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Pembangunan Manusia dan Pengentasan Kemiskinan RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B206", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C206", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F205:F206');
                $this->excel->getActiveSheet()->setCellValue("F205", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F206", "=(SUM(F209:F211)/COUNT(F209:F211))*10");
                $this->excel->getActiveSheet()->setCellValue("B207", "No");
                $this->excel->getActiveSheet()->mergeCells('B207:B208');
                $this->excel->getActiveSheet()->setCellValue("C207", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C207:C208');
                $this->excel->getActiveSheet()->setCellValue("D207", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D207:E207');
                $this->excel->getActiveSheet()->setCellValue("D208", "0");
                $this->excel->getActiveSheet()->setCellValue("E208", "1");
                $this->excel->getActiveSheet()->setCellValue("F207", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F207:F208');
                $this->excel->getActiveSheet()->setCellValue("B212", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B212:E212');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B207:F212');
                $this->excel->getActiveSheet()->getStyle('F206')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A214", "16");
                $this->excel->getActiveSheet()->setCellValue('B214', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Infrastruktur dan Pemerataan Wilayah RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B215", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C215", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F214:F215');
                $this->excel->getActiveSheet()->setCellValue("F214", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F215", "=(SUM(F218:F220)/COUNT(F218:F220))*10");
                $this->excel->getActiveSheet()->setCellValue("B216", "No");
                $this->excel->getActiveSheet()->mergeCells('B216:B217');
                $this->excel->getActiveSheet()->setCellValue("C216", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C216:C217');
                $this->excel->getActiveSheet()->setCellValue("D216", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D216:E216');
                $this->excel->getActiveSheet()->setCellValue("D217", "0");
                $this->excel->getActiveSheet()->setCellValue("E217", "1");
                $this->excel->getActiveSheet()->setCellValue("F216", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F216:F217');
                $this->excel->getActiveSheet()->setCellValue("B221", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B221:E221');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B216:F221');
                $this->excel->getActiveSheet()->getStyle('F215')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A223", "17");
                $this->excel->getActiveSheet()->setCellValue('B223', 'Tersedianya Dukungan Program Prioritas daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Nilai Tambah Sektor Riil, Industrialisasi dan Kesempatan Kerja RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B224", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C224", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F223:F224');
                $this->excel->getActiveSheet()->setCellValue("F223", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F224", "=(SUM(F227:F229)/COUNT(F227:F229))*10");
                $this->excel->getActiveSheet()->setCellValue("B225", "No");
                $this->excel->getActiveSheet()->mergeCells('B225:B226');
                $this->excel->getActiveSheet()->setCellValue("C225", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C225:C226');
                $this->excel->getActiveSheet()->setCellValue("D225", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D225:E225');
                $this->excel->getActiveSheet()->setCellValue("D226", "0");
                $this->excel->getActiveSheet()->setCellValue("E226", "1");
                $this->excel->getActiveSheet()->setCellValue("F225", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F225:F226');
                $this->excel->getActiveSheet()->setCellValue("B230", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B230:E230');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B225:F230');
                $this->excel->getActiveSheet()->getStyle('F224')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A232", "18");
                $this->excel->getActiveSheet()->setCellValue('B232', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas PN Ketahanan Pangan, Air, Energi dan Lingkungan Hidup RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B233", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C233", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F232:F233');
                $this->excel->getActiveSheet()->setCellValue("F232", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F233", "=(SUM(F236:F238)/COUNT(F236:F238))*10");
                $this->excel->getActiveSheet()->setCellValue("B234", "No");
                $this->excel->getActiveSheet()->mergeCells('B234:B235');
                $this->excel->getActiveSheet()->setCellValue("C234", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C234:C235');
                $this->excel->getActiveSheet()->setCellValue("D234", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D234:E234');
                $this->excel->getActiveSheet()->setCellValue("D235", "0");
                $this->excel->getActiveSheet()->setCellValue("E235", "1");
                $this->excel->getActiveSheet()->setCellValue("F234", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F234:F235');
                $this->excel->getActiveSheet()->setCellValue("B239", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B239:E239');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B234:F239');
                $this->excel->getActiveSheet()->getStyle('F233')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A241", "19");
                $this->excel->getActiveSheet()->setCellValue('B241', 'Tersedianya Dukungan Program Daerah RKPD 2020 terhadap Arah Kebijakan Pengarusutamaan Pembangunan Berkelanjutan, Tata Kelola Pemerintahan yang Baik, Gender, Modal Sosial Budaya dan Transformasi Digital');
                $this->excel->getActiveSheet()->setCellValue("B242", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C242", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F241:F242');
                $this->excel->getActiveSheet()->setCellValue("F241", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F242", "=(SUM(F245:F259)/COUNT(F245:F259))*10");
                $this->excel->getActiveSheet()->setCellValue("B243", "No");
                $this->excel->getActiveSheet()->mergeCells('B243:B244');
                $this->excel->getActiveSheet()->setCellValue("C243", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C243:C244');
                $this->excel->getActiveSheet()->setCellValue("D243", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D243:E243');
                $this->excel->getActiveSheet()->setCellValue("D244", "0");
                $this->excel->getActiveSheet()->setCellValue("E244", "1");
                $this->excel->getActiveSheet()->setCellValue("F243", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F243:F244');
                $this->excel->getActiveSheet()->setCellValue("B260", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B260:E260');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B243:F260');
                $this->excel->getActiveSheet()->getStyle('F242')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A262", "20");
                $this->excel->getActiveSheet()->setCellValue('B262', 'Tersedianya dukungan program daerah RKPD 2020 terhadap arah kebijakan Pembangunan Lintas Bidang Kerentanan Bencana dan Perubahan Iklim');
                $this->excel->getActiveSheet()->setCellValue("B263", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C263", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F262:F263');
                $this->excel->getActiveSheet()->setCellValue("F262", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F263", "=(SUM(F266:F271)/COUNT(F266:F271))*10");
                $this->excel->getActiveSheet()->setCellValue("B264", "No");
                $this->excel->getActiveSheet()->mergeCells('B264:B265');
                $this->excel->getActiveSheet()->setCellValue("C264", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C264:C265');
                $this->excel->getActiveSheet()->setCellValue("D264", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D264:E264');
                $this->excel->getActiveSheet()->setCellValue("D265", "0");
                $this->excel->getActiveSheet()->setCellValue("E265", "1");
                $this->excel->getActiveSheet()->setCellValue("F264", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F264:F265');
                $this->excel->getActiveSheet()->setCellValue("B272", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B272:E272');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B264:F272');
                $this->excel->getActiveSheet()->getStyle('F263')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

                $this->excel->getActiveSheet()->setCellValue("A274", "21");
                $this->excel->getActiveSheet()->setCellValue('B274', 'Tersedianya kebijakan pembangunan daerah RKPD 2020 yang menerapkan konsep Tematik, Holistik, Integratif, dan Spasial (THIS)');
                $this->excel->getActiveSheet()->setCellValue("B275", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C275", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F274:F275');
                $this->excel->getActiveSheet()->setCellValue("F274", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F275", "=(SUM(F278:F282)/COUNT(F278:F282))*10");
                $this->excel->getActiveSheet()->setCellValue("B276", "No");
                $this->excel->getActiveSheet()->mergeCells('B276:B277');
                $this->excel->getActiveSheet()->setCellValue("C276", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C276:C277');
                $this->excel->getActiveSheet()->setCellValue("D276", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D276:E276');
                $this->excel->getActiveSheet()->setCellValue("D277", "0");
                $this->excel->getActiveSheet()->setCellValue("E277", "1");
                $this->excel->getActiveSheet()->setCellValue("F276", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F276:F277');
                $this->excel->getActiveSheet()->setCellValue("B283", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B283:E283');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B276:F283');  
                $this->excel->getActiveSheet()->getStyle('F275')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A285", "22");
                $this->excel->getActiveSheet()->setCellValue('B285', 'Tersedianya indikator kinerja sasaran pembangunan daerah dan program prioritas');
                $this->excel->getActiveSheet()->setCellValue("B286", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C286", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F285:F286');
                $this->excel->getActiveSheet()->setCellValue("F285", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F286", "=(SUM(F289:F293)/COUNT(F289:F293))*10");
                $this->excel->getActiveSheet()->setCellValue("B287", "No");
                $this->excel->getActiveSheet()->mergeCells('B287:B288');
                $this->excel->getActiveSheet()->setCellValue("C287", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C287:C288');
                $this->excel->getActiveSheet()->setCellValue("D287", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D287:E287');
                $this->excel->getActiveSheet()->setCellValue("D288", "0");
                $this->excel->getActiveSheet()->setCellValue("E288", "1");
                $this->excel->getActiveSheet()->setCellValue("F287", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F287:F288');
                $this->excel->getActiveSheet()->setCellValue("B294", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B294:E294');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B287:F294'); 
                $this->excel->getActiveSheet()->getStyle('F286')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B296', 'Resume Aspek Kualitas Dokumen RKPD');
                $this->excel->getActiveSheet()->setCellValue("B297", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B298:F301');
                $this->excel->getActiveSheet()->setCellValue('B302', 'Masukan dan Saran terhadap Aspek Kualitas Dokumen RKPD');
                $this->excel->getActiveSheet()->mergeCells('B303:F306');
                
                $this->excel->getActiveSheet()->setCellValue("A308", "Kriteria Inovasi (20%)");
                $this->excel->getActiveSheet()->setCellValue("A309", "23");
                $this->excel->getActiveSheet()->setCellValue('B309', 'Indikator kelengkapan dokumen Inovasi daerah');
                $this->excel->getActiveSheet()->setCellValue("B310", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C310", "5,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F309:F310');
                $this->excel->getActiveSheet()->setCellValue("F309", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F310", "=(SUM(F313:F321)/COUNT(F313:F321))*10");
                $this->excel->getActiveSheet()->setCellValue("B311", "No");
                $this->excel->getActiveSheet()->mergeCells('B311:B312');
                $this->excel->getActiveSheet()->setCellValue("C311", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C311:C312');
                $this->excel->getActiveSheet()->setCellValue("D311", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D311:E311');
                $this->excel->getActiveSheet()->setCellValue("D312", "0");
                $this->excel->getActiveSheet()->setCellValue("E312", "1");
                $this->excel->getActiveSheet()->setCellValue("F311", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F311:F312');
                $this->excel->getActiveSheet()->setCellValue("B322", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B322:E322');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B311:F322');                
                $this->excel->getActiveSheet()->getStyle('F310')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A324", "24");
                $this->excel->getActiveSheet()->setCellValue('B324', 'Indikator kedalaman inovasi daerah');
                $this->excel->getActiveSheet()->setCellValue("B325", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C325", "15,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F324:F325');
                $this->excel->getActiveSheet()->setCellValue("F324", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F325", "=(SUM(F328:F343)/COUNT(F328:F343))*10");
                $this->excel->getActiveSheet()->setCellValue("B326", "No");
                $this->excel->getActiveSheet()->mergeCells('B326:B327');
                $this->excel->getActiveSheet()->setCellValue("C326", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C326:C327');
                $this->excel->getActiveSheet()->setCellValue("D326", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D326:E326');
                $this->excel->getActiveSheet()->setCellValue("D327", "0");
                $this->excel->getActiveSheet()->setCellValue("E327", "1");
                $this->excel->getActiveSheet()->setCellValue("F326", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F326:F327');
                $this->excel->getActiveSheet()->setCellValue("B344", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B344:E344');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B326:F344');                
                $this->excel->getActiveSheet()->getStyle('F325')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B346', 'Resume Aspek Inovasi');
                $this->excel->getActiveSheet()->setCellValue("B347", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B348:F350');
                $this->excel->getActiveSheet()->setCellValue('B351', 'Masukan dan Saran terhadap Aspek Inovasi');
                $this->excel->getActiveSheet()->mergeCells('B352:F355');
                
                //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
                $this->excel->getActiveSheet()->getProtection()->setSheet(true);
                $this->excel->getActiveSheet()->getProtection()->setSort(true);
                $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
                $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
                $this->excel->getActiveSheet()->getProtection()->setPassword('sk9');
                
                header("Content-Type:application/vnd.ms-excel");
                header("Content-Disposition:attachment;filename = Module1_penilaian_dokumen_.xls");
                header("Cache-Control:max-age=0");
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save("php://output");   
    }




    
//untuk pilihan kabupaten
    //list Kabupaten
    function get_data_kk(){
        if($this->input->is_ajax_request()){
            try {
                $requestData= $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array( 
                // datatable column index  => database column name
                    $idx++   =>'MP.`id_kab`', 
                    $idx++   =>'MP.`nama_kabupaten`',
                    $idx++   =>'KK.`status`',
                );
                
                $sql = "SELECT MP.id,MP.`id_kab`,MP.`nama_kabupaten`,MP.urutan, KK.`status` 
                        FROM `kabupaten` MP
                        LEFT JOIN (SELECT * FROM `tbl_status_penilaian_kk` WHERE `userid` = '$userid' ) KK ON KK.`idkabkot` = MP.id
                        LEFT JOIN `tbl_user_kabkot` W ON W.idkabkot = MP.id
                        WHERE W.iduser='".$userid."' AND MP.urutan ='0' ";
                                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " MP.`id_kab` LIKE '%".$requestData['search']['value']."%' "
                                . " OR MP.`nama_kabupaten` LIKE '%".$requestData['search']['value']."%' "
                                . " OR KK.`status` LIKE '%".$requestData['search']['value']."%' "
                                . ")";    
                }
                $list_data = $this->db->query($sql);
                $totalFiltered = $list_data->num_rows();
                $sql.=" ORDER BY "
                        .$columns[$requestData['order'][0]['column']]."   "
                        .$requestData['order'][0]['dir']."  "
                        . "LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
                $list_data = $this->db->query($sql);
                $data = array();
                $i=1;
                foreach ($list_data->result() as $row) {
                    $nestedData=array();
                    $id      = $row->id;
                    $title  = $row->nama_kabupaten;
                    $nestedData[] = $i++;
                    $nestedData[] = $row->nama_kabupaten;
                    $nestedData[] = "<a class='btn btn-xs btn-info waves-effect waves-light doku' data-id='".encrypt_text($id)."' title='Dokumen '><i class='fa fa-cloud'></i><h7> Bahan Dukung</h7></a>";
                    if($row->status==''){
                        $nestedData[] = "<a class='btn btn-xs btn-outline-secondary waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Belum '><i class='fa fa-pencil'></i><h7> Belum Diisi</h7></a>";
                        $nestedData[] = "";}
                    elseif($row->status=='1'){
                        $nestedData[] = ""
                        . "<a class='btn btn-xs btn-outline-warning waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lenkapi Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a>";
                        $nestedData[] = "";
                    }
                    elseif($row->status=='2'){
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Lembar pernyataan belum diisi</h7></a>";
                    
                         $nestedData[] = "";
//                                 . "<a class='btn btn-xs btn-outline-info waves-purple waves-light download' data-id='".encrypt_text($id)."' title='Download Excel'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a>";                         
                    }
                    elseif($row->status=='3'){
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a>";
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-purple waves-light download' data-id='".encrypt_text($id)."' title='Download Excel'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a>";     
                    }
                    
                    $data[] = $nestedData;
                }
                $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval( $totalData ),  // total number of records
                    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                    );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
                }
        else
            die;
    }

    function detail_get_kab(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                //kabupaten
                $iddaerah = decrypt_text($this->input->post("id"));
               
                if(!is_numeric($iddaerah))
                    throw new Exception("Invalid ID!");
                                
                $this->m_ref->setTableName("kabupaten");
                $select = array();
                $cond = array(
                    "id"  => $iddaerah,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
               // $penilai=
                foreach ($list_data->result() as $v) {
                    $nama_kabupaten = $v->nama_kabupaten;                    
                }
                $query="";

                $status_sql="SELECT TI.*, SP.`status` 
                        FROM `tbl_indikator` TI
                        LEFT JOIN (SELECT * FROM `tbl_sp_tbl_indikator_kab` WHERE `user` ='".$this->session->userdata(SESSION_LOGIN)->id."' AND `kabupaten`='".$iddaerah."'  GROUP BY `indikator`) SP ON SP.`indikator` = TI.id
                        WHERE 1=1";
                    $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";
                $no=1;
                $content2 = "";
                $content3 = "";
                $content4 = "";   
                $content5 = "";      
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                    if($r_ti2->idkreteria == 1){
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2'){
                            $content.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content.="</tr>";
                    }
                    if($r_ti2->idkreteria == 2){
                        $id      = $r_ti2->id;
                        $content2.="<tr class='odd gradeX'>";
                        $content2.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content2.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content2.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content2.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content2.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content2.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content2.="</tr>";
                    }    
                    if($r_ti2->idkreteria == 3){
                        $id      = $r_ti2->id;
                        $content3.="<tr class='odd gradeX'>";
                        $content3.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content3.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content3.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content3.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content3.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content3.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                    if($r_ti2->idkreteria == 4){
                        $id      = $r_ti2->id;
                        $content4.="<tr class='odd gradeX'>";
                        $content4.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content4.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content4.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content4.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content4.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content4.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                    if($r_ti2->idkreteria == 5){
                        $id      = $r_ti2->id;
                        $content5.="<tr class='odd gradeX'>";
                        $content5.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content5.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content5.="<td style='font-size: 11px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content5.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content5.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content5.="<td style='font-size: 11px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                }
                //cek jumlah total indikator yang sudah dinilai
                $select_jml="SELECT COUNT(TI.id) AS total,SP.ttl , TI.idkreteria
                                FROM `tbl_indikator` TI 
                                LEFT JOIN (
                                SELECT COUNT(TI.id) AS ttl, TK.id,TS.indikator
                                FROM `tbl_sp_tbl_indikator_kab` TS
                                LEFT JOIN tbl_indikator TI ON TI.id = TS.indikator
                                LEFT JOIN tbl_kriteria TK ON TK.id = TI.idkreteria
                                WHERE TS.`user` ='".$this->session->userdata(SESSION_LOGIN)->id."' AND TS.`kabupaten`='".$iddaerah."' AND TS.status = '2'
                                GROUP BY TK.id
                                )SP ON SP.`indikator` = TI.id
                                WHERE 1=1
                                GROUP BY TI.idkreteria";
                $list_jml_n = $this->db->query($select_jml);
                $pencapaian='';$keterkaitan='';$konsistensi='';$kelengkapan='';$inovasi='';
                foreach($list_jml_n->result() as $row_jml){
                    $kriteria = $row_jml->idkreteria;
                    if($kriteria=='1'){
                        if($row_jml->ttl==''){
                            $pencapaian= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $pencapaian= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='2'){
                        if($row_jml->ttl==''){
                            $keterkaitan= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $keterkaitan= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                        
                    }
                    elseif($kriteria=='3'){
                        if($row_jml->ttl==''){
                            $konsistensi= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $konsistensi= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='4'){
                        if($row_jml->ttl==''){
                            $kelengkapan= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $kelengkapan= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='5'){
                        if($row_jml->ttl==''){
                            $inovasi= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $inovasi= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                }
                //cek status penilaian nilai 2
                $lembaran_pernyataan='';
                $select_status="SELECT SP.* FROM tbl_status_penilaian_kk SP WHERE SP.userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND SP.idkabkot = '".$iddaerah."' AND SP.status='2'";
                $list_status = $this->db->query($select_status);
                if($list_status->num_rows() > 0){
                    $lembaran_pernyataan='1';
                }
                //sukses
                $output = array(
                    "status"            =>  1,
                    "csrf_hash"         =>  $this->security->get_csrf_hash(),
                    "msg"               =>  "success get data",
                    "profile"           =>  $this->session->userdata(SESSION_LOGIN)->name,
                    "nama_kabupaten"    =>  $nama_kabupaten,
                    "data"              =>  $list_data->result(),
                    "tbl_pencapaian"    =>  $content,
                    "tbl_keterkaitan"   =>  $content2,
                    "tbl_konsistensi"   =>  $content3,
                    "tbl_kk"            =>  $content4,
                    "tbl_inovasi"       =>  $content5,
                    "id"                => encrypt_text($id),
                    "profile2"          =>  "Nama Penilai :".$this->session->userdata(SESSION_LOGIN)->name,
                    "pencapaian"        =>  $pencapaian,
                    "keterkaitan"       =>  $keterkaitan,
                    "konsistensi"       =>  $konsistensi,
                    "kelengkapan"       =>  $kelengkapan,
                    "inovasi"           =>  $inovasi,
                    "pernyataan"        =>  $lembaran_pernyataan,
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
        }
        else{exit("Access Denied");}
    }
    
    function detail_kategori_skor_kab(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                    $user=$this->session->userdata(SESSION_LOGIN)->id;
                $indikator = decrypt_text($this->input->post("id"));      
                if(!is_numeric($indikator))
                    throw new Exception("Invalid ID!");
                $iddaerah = decrypt_text($this->input->post("iddaerah"));
                //catatan indikator
                $select_note="SELECT TI.* FROM tbl_indikator TI WHERE TI.id='".$indikator."' ";
                $list_note = $this->db->query($select_note);
                foreach ($list_note->result() as $r_n) {
                    $catatan= $r_n->note;
                }
                $catatan_res = "";
                $masukan_res = "";
                if($indikator=='7' || $indikator=='22' || $indikator=='24'){
                    $select_resume="SELECT TI.* FROM tbl_resume_aspek_kab TI "
                            . "WHERE TI.indikator='".$indikator."' AND TI.user='".$user."' AND TI.kabupaten='".$iddaerah."' ";
                    $list_resume = $this->db->query($select_resume);
                    foreach ($list_resume->result() as $r_re) {
                        $catatan_res = $r_re->catatan;
                        $masukan_res = $r_re->masukan;
                    }
                }
                $ctt='';
                if($catatan==''){ $ctt=''; } else {$ctt='Catatan :';}
                //cek kriteria
                $query="SELECT TK.* FROM `tbl_kriteria` TK
                        LEFT JOIN `tbl_indikator` TI ON TK.id= TI.idkreteria
                        LEFT JOIN `tbl_kategori_skor` TS ON TI.id =TS.indikatorid
                        WHERE TS.indikatorid='".$indikator."' AND TS.tag='0' GROUP BY TK.id";
                $list_data = $this->db->query($query);
                foreach ($list_data->result() as $r_data) {
                   $kriteria = $r_data->nama_kriteria;
                   $bobot    = $r_data->bobot;
                }
                
                $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor_kk` WHERE `user` ='".$user."' AND `kbko`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.indikatorid='".$indikator."' AND KS.tag='0'";
               
                $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";             
                $no=1;
                $sub=3;
               
                foreach ($list_data_i2->result() as $r_ti2) {
                                      
                        $sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".wordwrap($r_ti2->item_penilaian,30,"<br>\n")."</a></td>";
                        if($r_ti2->sk==''){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }
                        elseif($r_ti2->sk=='0'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }
                        elseif($r_ti2->sk=='1'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }                        
                        $content.="</tr>";                    
                     }
                        $sum1=0;$count=0;$Nilai1=0;$Nilai=0;
                        
                //jumlah skor dan jumlah terjawab
                 $jawaban=0;
                 $item=0;
                 $Nilai=0;
                $select_jumlah = "SELECT  COUNT(TN.id) AS J_Terjawab,  SUM(TN.skor) AS J_Jawaban 
                                FROM `tbl_nilai_skor_kk` TN 
                                 LEFT JOIN `tbl_kategori_skor` TK ON TN.kat_skor = TK.id 
                                 WHERE TN.`user` ='".$user."' AND TN.`kbko`='".$iddaerah."' AND TK.`indikatorid`='".$indikator."' AND TK.tag='0'";

                $list_jumlah  = $this->db->query($select_jumlah);
                foreach ($list_jumlah->result() as $r_sum) {
                    $terjawab = $r_sum->J_Terjawab;
                    $jawaban  = $r_sum->J_Jawaban;
                }
                //Jumlah item penilaian
                $select_Jitem="SELECT COUNT(TK.id) AS J_Item FROM `tbl_kategori_skor` TK WHERE TK.indikatorid = '".$indikator."' AND TK.tag='0'";
                $list_Jitem  = $this->db->query($select_Jitem);
                foreach ($list_Jitem->result() as $r_Jitem) {
                    $item = $r_Jitem->J_Item;
                }
                $Nilai1=($jawaban/$item)*10;
                $Nilai=number_format($Nilai1,2);
                
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success get data",
                    "table_ktg_skor"=>  $content,
                    "total"         => $Nilai,
                    "kriteria"      => "Kriteria ".$kriteria." (".$bobot."%)",
                    "jml_terjawab"  => $terjawab." dari ".$item." item penilaian",
                    "jml_jawaban"   => $jawaban,
                    "no_indikator"  => $indikator,
                    "desk"          => $ctt,
                    "catatan"      => $catatan,
                    "catatan_res"  => $catatan_res,
                    "masukan_res"  => $masukan_res,

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
        }
        else{exit("Access Denied");}
    }

    function pilih_skor_kabupaten(){
            if($this->input->is_ajax_request()){
                try {
                    if(!$this->session->userdata(SESSION_LOGIN)){
                        throw new Exception("Session berakhir, silahkan login ulang",2);
                    }
                    $this->form_validation->set_rules('id','ID Data Indikator','required');
                    $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                    $this->form_validation->set_rules('indkno','ID No','required');
                    $this->form_validation->set_rules('nilai','Nilai','required');
                    $this->form_validation->set_rules('idin','Id Indikator','required');
                    if($this->form_validation->run() == FALSE){
                        throw new Exception(validation_errors("", ""),0);
                    }
                    date_default_timezone_set("Asia/Jakarta");
                    $current_date_time = date("Y-m-d H:i:s");
                
                    $user=$this->session->userdata(SESSION_LOGIN)->id;
                    $id = decrypt_text($this->input->post("id"));
                    $indikator = decrypt_text($this->input->post("id"));
                    if(!is_numeric($id))
                        throw new Exception("Invalid ID!");
                    $iddaerah = decrypt_text($this->input->post("iddaerah"));
                    $nilai = $this->input->post("nilai");
                    $noind = $this->input->post("indkno");
                    $idin = $this->input->post("idin");
                    
                    //CHECK DATA
                    $this->m_ref->setTableName("tbl_nilai_skor_kk");
                    $select = array();
                    $cond = array(
                        "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                        "kbko"  => $iddaerah,
                        "kat_skor"        => $id,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if($list_data->num_rows() == 0){
                        $this->db->trans_begin();
                        $this->m_ref->setTableName("tbl_nilai_skor_kk");
                        $data_baru = array(
                            "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                            "kbko"      => $iddaerah,
                            "kat_skor"        => $id,
                            "skor"      => $nilai,
                            "cr_dt"    => $current_date_time,
                          );
                        $status_save = $this->m_ref->save($data_baru);
                        if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                        $this->db->trans_commit();
                       // $pesan='Sukses Insert Data';
                    }
                    else {
                        $this->db->trans_begin();
                        $this->m_ref->setTableName("tbl_nilai_skor_kk");
                        $data_baru = array(
                            "skor"      => $nilai,
                            "ud_dt"     => $current_date_time,
                        );
                        $cond = array(
                            "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                            "kbko"  => $iddaerah,
                            "kat_skor"  => $id,

                        );
                        $status_save = $this->m_ref->update($cond,$data_baru);
                        if(!$status_save){throw new Exception($this->db->error("code")." : Gagal Update Data",0);}

                        $this->db->trans_commit();
                       // $pesan='Sukses Update Data';


                     }
                    
                     //Jumlahkan total Nilai
                     $jawaban=0;
                    $item=0;
                    $Nilai=0;
                    $select_jumlah = "SELECT COUNT(TN.id) AS J_Terjawab, SUM(TN.skor) AS J_Jawaban 
                                        FROM `tbl_nilai_skor_kk` TN  
                                     LEFT JOIN `tbl_kategori_skor` TK ON TN.kat_skor = TK.id 
                                     WHERE TN.`user` ='".$user."' AND TN.`kbko`='".$iddaerah."' AND TK.`indikatorid`='".$idin."' AND TK.tag='0'";
                    //print_r($select_jumlah);exit();
                    $list_jumlah  = $this->db->query($select_jumlah);
                    foreach ($list_jumlah->result() as $r_sum) {
                        $terjawab = $r_sum->J_Terjawab;
                        $jawaban  = $r_sum->J_Jawaban;
                    }
                    //Jumlah item penilaian
                    $select_Jitem="SELECT COUNT(TK.id) AS J_Item FROM `tbl_kategori_skor` TK WHERE TK.indikatorid = '".$idin."' AND TK.tag='0'";
                    $list_Jitem  = $this->db->query($select_Jitem);
                    foreach ($list_Jitem->result() as $r_Jitem) {
                        $item = $r_Jitem->J_Item;
                    }
                    $Nilai1=($jawaban/$item)*10;
                    $Nilai=number_format($Nilai1,2); 
                    

                    $status_sql="SELECT KS.*, NS.`skor` as sk 
                            FROM `tbl_kategori_skor` KS
                            LEFT JOIN (SELECT * FROM `tbl_nilai_skor_kk` WHERE `user` ='".$user."' AND `kbko`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                            WHERE KS.indikatorid='".$idin."' AND KS.tag='0'";
                    //print_r($status_sql);exit();
                        $list_data_i2  = $this->db->query($status_sql);

                    $content = "";             
                    $no=1;
//                    foreach ($list_data_i2->result() as $r_ti2) {
//                            $id      = $r_ti2->id;
//                            $content.="<tr class='odd gradeX'>";
//                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
//                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->item_penilaian."</a></td>";
//                            if($r_ti2->sk==''){
//                                $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                                $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                                $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
//                            }
//                            elseif($r_ti2->sk=='0'){
//                                $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                                $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                                $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
//                            }
//                            elseif($r_ti2->sk=='1'){
//                                $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                                $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                                $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
//                            }                          
//                            $content.="</tr>";
//                    }
                    foreach ($list_data_i2->result() as $r_ti2) {
                                      
                        $sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".wordwrap($r_ti2->item_penilaian,30,"<br>\n")."</a></td>";
                        if($r_ti2->sk==''){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }
                        elseif($r_ti2->sk=='0'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }
                        elseif($r_ti2->sk=='1'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }                        
                        $content.="</tr>";                    
                     }
                    //status Penilaian Indikator
                    if($r_ti2->sk==''){
                                             //cek status penilaian Indikator
                        $select_s_p="SELECT * FROM `tbl_sp_tbl_indikator_kab` "
                            . "WHERE user='".$this->session->userdata(SESSION_LOGIN)->id."' "
                            . "AND kabupaten='$iddaerah' AND indikator='$idin'";
                        $list_sp  = $this->db->query($select_s_p);
                        if($list_sp->num_rows() == 0){             
                                     $this->db->trans_begin();
                                     $this->m_ref->setTableName("tbl_sp_tbl_indikator_kab");
                                     $data_baru = array(
                                        "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                                        "kabupaten"      => $iddaerah,
                                        "indikator"      => $idin,
                                        "status"      => '1',
                                    );
                                    $status_save = $this->m_ref->save($data_baru);
                                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                                    $this->db->trans_commit();
                                } 
                         else {
                             $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_sp_tbl_indikator_kab");
                             $data_baru = array(
                                "status"      => '1',
                             );
                             $cond = array(
                                "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                                "kabupaten"      => $iddaerah,
                                "indikator"      => $idin,
                             );
                             $status_save = $this->m_ref->update($cond,$data_baru);
                             if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                             $this->db->trans_commit();
                         }
                    }
                    else{
                        $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_sp_tbl_indikator_kab");
                             $data_baru = array(
                                "status"      => '2',
                             );
                             $cond = array(
                                "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                                "kabupaten"      => $iddaerah,
                                "indikator"      => $idin,
                             );
                             $status_save = $this->m_ref->update($cond,$data_baru);
                             if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                             $this->db->trans_commit();
                    }
                    //status module kab
                    $select_jml="SELECT COUNT(TKS.id) AS J_kategori
                                    FROM `tbl_kategori_skor` TKS
                                    LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                    LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                    LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                    WHERE TM.id='1' AND TKS.tag='0'";
                    $list_jml_m  = $this->db->query($select_jml);
                    foreach ($list_jml_m->result() as $r_tjml_m){
                        $jml_kategori = $r_tjml_m->J_kategori;
                    }
                    //select jumlah jawaban
                    $select_jwb="SELECT COUNT(TN.id) AS J_nilai
                                FROM `tbl_nilai_skor_kk` TN
                                LEFT JOIN `tbl_kategori_skor` TKS ON TN.kat_skor = TKS.id 
                                LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                WHERE TM.id='1' AND TN.user='".$user."' AND TN.kbko='".$iddaerah."' AND TKS.tag='0'";
                    
                    $list_jml_j  = $this->db->query($select_jwb);
                    foreach ($list_jml_j->result() as $r_jml_j){
                        $jml_nilai = $r_jml_j->J_nilai;
                    }
                    //jika kreteria modul sama dengan jumlah jawaban maka cek resume
                    if($jml_kategori == $jml_nilai){
                        //jumlahkan resume aspek, jika sama dengan tiga module selesai dinilai download laporan akan muncul
                        $select_resume="SELECT COUNT(TR.id) AS J_resume
                                        FROM `tbl_resume_aspek_kab` TR
                                        WHERE TR.user ='".$user."' AND TR.kabupaten='".$iddaerah."'";
                        //print_r($select_resume);exit();
                        $list_resume  = $this->db->query($select_resume);
                        foreach ($list_resume->result() as $r_resume){
                           $jml_resume =  $r_resume->J_resume;
                        }
                        if($jml_resume=='3'){
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian_kk");
                            $data_baru = array(
                                "status"      => '2',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "idkabkot"  => $iddaerah,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                        }
                        
                    }
                    else{
                        $select_s_p="SELECT * FROM `tbl_status_penilaian_kk` "
                                . "WHERE userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND idkabkot='$iddaerah'";
                        $list_sp  = $this->db->query($select_s_p);
                         if($list_sp->num_rows() == 0){
                             $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_status_penilaian_kk");
                             $data_baru = array(
                                    "userid"      => $this->session->userdata(SESSION_LOGIN)->id,
                                    "idkabkot"      => $iddaerah,
                                    "status"      => '1',
                            );
                             $status_save = $this->m_ref->save($data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();                    
                         } 
                         else {
                             //status penilaian pr
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian_kk");
                            $data_baru = array(
                                "status"      => '1',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "idkabkot"  => $iddaerah,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                         }
                    }
                    
                    //sukses
                    $output = array(
                        "status"         => 1,
                        "csrf_hash"      => $this->security->get_csrf_hash(),
                        "msg"            => "success get data",
                        "table_ktg_skor" => $content,
                        "nilai"          => $Nilai,
                    );
                    exit(json_encode($output));
                } catch (Exception $exc)  {
                    $this->db->trans_rollback();
                    $output = array(
                        "status"    =>  $exc->getCode(),
                        "msg"       =>  $exc->getMessage(),
                        "csrf_hash" =>  $this->security->get_csrf_hash(),
                    );
                    exit(json_encode($output));
                }
            }
            else{exit("Access Denied");}
        }    
        
    //tambah saran dan catatan
    function add_catatan_kab()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('Kabresume','Kabresume','required|xss_clean');
                $this->form_validation->set_rules('kabindikaresum','kabindikaresum','required|xss_clean');
                $this->form_validation->set_rules('kabcatatan','kabcatatan','required|xss_clean');
                $this->form_validation->set_rules('kabsaran','kabsaran','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $userid=$this->session->userdata(SESSION_LOGIN)->id;
                $kab = decrypt_text($this->input->post("Kabresume"));      
                if(!is_numeric($kab))
                    throw new Exception("Invalid ID Kabupaten!");
                $kabindikaresum = $this->input->post("kabindikaresum");
                //print_r($indikaresum);exit();
                $catatan = $this->input->post("kabcatatan");
                $saran = $this->input->post("kabsaran");
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_resume_aspek_kab");
                $select = array();
                $cond = array(
                    "user"  => $userid,
                    "kabupaten" => $kab,
                    "indikator" => $kabindikaresum,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_resume_aspek_kab");
                    $data_baru = array(
                        "catatan"  => $catatan,
                        "masukan"  => $saran,
                        "ud_dt"    => $current_date_time,
                    );
                    $cond = array(
                       "user"       => $userid,
                        "kabupaten" => $kab,
                        "indikator" => $kabindikaresum,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();   
                }
                else{
                    $this->db->trans_begin();
                     $this->m_ref->setTableName("tbl_resume_aspek_kab");
                    $data_baru = array(
                        "user"      => $userid,
                        "kabupaten" => $kab,
                        "indikator" => $kabindikaresum,
                        "catatan"   => $catatan,
                        "masukan"   => $saran,
                        "cr_dt"     => $current_date_time,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                }
                
                //status module kab
                    $select_jml="SELECT COUNT(TKS.id) AS J_kategori
                                    FROM `tbl_kategori_skor` TKS
                                    LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                    LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                    LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                    WHERE TM.id='1'";
                    $list_jml_m  = $this->db->query($select_jml);
                    foreach ($list_jml_m->result() as $r_tjml_m){
                        $jml_kategori = $r_tjml_m->J_kategori;
                    }
                    //select jumlah jawaban
                    $select_jwb="SELECT COUNT(TN.id) AS J_nilai
                                FROM `tbl_nilai_skor_kk` TN
                                LEFT JOIN `tbl_kategori_skor` TKS ON TN.kat_skor = TKS.id 
                                LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                WHERE TM.id='1' AND TN.user='".$userid."' AND TN.kbko='".$kab."'";
                    $list_jml_j  = $this->db->query($select_jwb);
                    foreach ($list_jml_j->result() as $r_jml_j){
                        $jml_nilai = $r_jml_j->J_nilai;
                    }
                    //jika kreteria modul sama dengan jumlah jawaban maka cek resume
                    if($jml_kategori == $jml_nilai){
                        //jumlahkan resume aspek, jika sama dengan tiga module selesai dinilai download laporan akan muncul
                        $select_resume="SELECT COUNT(TR.id) AS J_resume
                                        FROM `tbl_resume_aspek_kab` TR
                                        WHERE TR.user ='".$userid."' AND TR.kabupaten='".$kab."'";
                        $list_resume  = $this->db->query($select_resume);
                        foreach ($list_resume->result() as $r_resume){
                           $jml_resume =  $r_resume->J_resume;
                        }
                        if($jml_resume=='3'){
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian_kk");
                            $data_baru = array(
                                "status"      => '2',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "idkabkot"  => $kab,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                        }
                        
                    }else{
                        $select_s_p="SELECT * FROM `tbl_status_penilaian_kk` "
                                . "WHERE userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND idkabkot='$kab'";
                        $list_sp  = $this->db->query($select_s_p);
                         if($list_sp->num_rows() == 0){
                             $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_status_penilaian_kk");
                             $data_baru = array(
                                    "userid"      => $this->session->userdata(SESSION_LOGIN)->id,
                                    "idkabkot"      => $kab,
                                    "status"      => '1',
                            );
                             $status_save = $this->m_ref->save($data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();                    
                         } 
                         else {
                             //status penilaian pr
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian_kk");
                            $data_baru = array(
                                "status"      => '1',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "idkabkot"  => $kab,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                         }
                    }
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Resume Aspek Sukses disimpan"
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }        
    
     //save lembaran pernyataan kab
    function add_lembaranpernyataan_kab()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('kab','kab','required|xss_clean');
                $this->form_validation->set_rules('nama','indikaresum','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $userid=$this->session->userdata(SESSION_LOGIN)->id;
                $kab = decrypt_text($this->input->post("kab"));      
                if(!is_numeric($kab))
                    throw new Exception("Invalid ID Kota!");
                $nama = $this->input->post("nama");
               
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_lembar_pernyataan_kabupaten");
                $select = array();
                $cond = array(
                    "user"      => $userid,
                    "kab"      => $kab,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_lembar_pernyataan_kabupaten");
                    $data_baru = array(
                        "nama"  => $nama,
                        "ud_dt"    => $current_date_time,
                    );
                    $cond = array(
                       "user"      => $userid,
                        "kab"      => $kab,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();   
                }
                else{
                    $this->db->trans_begin();
                     $this->m_ref->setTableName("tbl_lembar_pernyataan_kabupaten");
                    $data_baru = array(
                        "user"     => $userid,
                        "kab"      => $kab,
                        "nama"     => $nama,
                        "cr_dt"    => $current_date_time,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                }
                    
                
                //update status penilaian kota
                $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_status_penilaian_kk");
                    $data_baru = array(
                        "status"  => '3'
                    );
                    $cond = array(
                       "userid"      => $userid,
                        "idkabkot"      => $kab,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  " Sukses disimpan",
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    function Download_excel_kab(){
        if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
        //$id = $_GET['wl'];
        $idpro = decrypt_text($_GET['wl']);
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        //$idind = decrypt_text($_GET['in']);

            //cari Provinsi
        $d_pro="SELECT I.* FROM `kabupaten` I WHERE id='$idpro'";
        $list_pro = $this->db->query($d_pro);
        foreach ($list_pro->result() as $pro){
            $nm_wilayah   = $pro->nama_kabupaten;
            }
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
//        $this->excel->getSheet(0)->setTitle('Rekap Nilai '.$nm_wilayah.'');
        $this->excel->getSheet(0)->setTitle('Rekap Nilai ');
//                //cari data 
        $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor_kk` WHERE `user` ='".$user."' AND `kbko`='".$idpro."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.tag='0' ";
        
        $list_data  = $this->db->query($status_sql);
                $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 1;
                $row = $rowstart = 9;
                $row2 = $rowstart2 = 16;
                $row3 = $rowstart3 = 22;$row4 = $rowstart4 = 28;
        $row5 = $rowstart5 = 33;$row6 = $rowstart6 = 42;$row7 = $rowstart7 = 48;$row8 = $rowstart8 = 67;$row9 = $rowstart9 = 73;
        $row10 = 80;$row11 = 86;$row12 = 92;$row13 = 98;$row14 = 105; $row15 = 112; $row16 = 118; $row17 = 124; $row18 = 130; $row19 = 136;$row20 = 142;
        $row21 = 148;$row22 = 154;$row23 = 173; $row24 = 179;
                
        foreach ($list_data->result() as $value) {
            $indikatorid                = $value->indikatorid;
            if($indikatorid == '1'){ 
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->sk);
            }
            if($indikatorid == '2'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->sk);
            }
            if($indikatorid == '3'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->sk);
            }
            if($indikatorid == '4'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->sk);
            }
            if($indikatorid == '5'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->sk);
            }
            if($indikatorid == '6'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->sk);
            }
            if($indikatorid == '7'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->sk);
            }
            if($indikatorid == '8'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->sk);
            }
            if($indikatorid == '9'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->sk);
            }
            if($indikatorid == '10'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->sk);
            }
            if($indikatorid == '11'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->sk);
            }
            if($indikatorid == '12'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->sk);
            }
            if($indikatorid == '13'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->sk);
            }
            if($indikatorid == '14'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->sk);
            }                    
            if($indikatorid == '15'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->sk);
            }
            if($indikatorid == '16'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->sk);
            }
            if($indikatorid == '17'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->sk);
            }
            if($indikatorid == '18'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->sk);
            }
            if($indikatorid == '19'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->sk);
            }
            if($indikatorid == '20'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->sk);
            }
            if($indikatorid == '21'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->sk);
            }
            if($indikatorid == '22'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->sk);
            }
            if($indikatorid == '23'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->sk);
            }
            if($indikatorid == '24'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->sk);
            }
            $index_excelColumn=1;$row++;$row2++;$row3++;$row4++;$row5++;$row6++;$row7++;$row8++;$row9++;$row10++;$row11++;
            $row12++;$row13++;$row14++;$row15++;$row16++;$row17++;$row18++;$row19++;$row20++;$row21++;$row22++;$row23++;$row24++;
        }
        
        $select_r="SELECT * FROM tbl_resume_aspek_kota WHERE user = '".$user."' AND kota = '".$idpro."' ";
//        print_r($select_r);exit();
        $list_resume  = $this->db->query($select_r);
        foreach ($list_resume->result() as $resume){
            $indka = $resume->indikator;
            if($indka == '7'){
                $this->excel->getActiveSheet()->setCellValue('B115', $resume->catatan);
                $this->excel->getActiveSheet()->setCellValue('B120', $resume->masukan);
            }
            if($indka == '22'){
                $this->excel->getActiveSheet()->setCellValue('B298', $resume->catatan);
                $this->excel->getActiveSheet()->setCellValue('B303', $resume->masukan);
            }
            if($indka == '24'){
                $this->excel->getActiveSheet()->setCellValue('B348', $resume->catatan);
                $this->excel->getActiveSheet()->setCellValue('B352', $resume->masukan);
            }
        }
        ;
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

                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B7:F18');
//                $this->excel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->setCellValue('A2', "Nama Penilai");
                $this->excel->getActiveSheet()->setCellValue('C2', $this->session->userdata(SESSION_LOGIN)->name);
                $this->excel->getActiveSheet()->setCellValue('A3', "Provinsi Dinilai :");
                $this->excel->getActiveSheet()->setCellValue('C3', $nm_wilayah);
                $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->mergeCells('A2:B2');
                $this->excel->getActiveSheet()->mergeCells('A3:B3');
                
                $this->excel->getActiveSheet()->setCellValue("A4", "Kriteria Pencapaian(40%)");
                $this->excel->getActiveSheet()->setCellValue('A5', '1');
                $this->excel->getActiveSheet()->setCellValue('B5', 'Pertumbuhan Ekonomi dan Pertumbuhan PDRB per Kapita');
                $this->excel->getActiveSheet()->setCellValue("B6", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C6", "5,00%");
                
                $this->excel->getActiveSheet()->setCellValue("B7", "No");
                $this->excel->getActiveSheet()->mergeCells('B7:B8');
                $this->excel->getActiveSheet()->setCellValue("C7", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C7:C8');
                $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("35");
                 
                $this->excel->getActiveSheet()->setCellValue("D7", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D7:E7');
  //              $this->excel->getActiveSheet()->getStyle('D7:E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("18");
                $this->excel->getActiveSheet()->setCellValue("D8", "0");
                $this->excel->getActiveSheet()->setCellValue("E8", "1");
                $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("18");
                $this->excel->getActiveSheet()->setCellValue("F7", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F7:F8');
                $this->excel->getActiveSheet()->setCellValue("B18", "Jumlah Skor");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F5:F6');
                $this->excel->getActiveSheet()->setCellValue("F5", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F6", "=(SUM(F9:F17)/COUNT(B9:B17))*10");
                $this->excel->getActiveSheet()->setCellValue("F18", "=SUM(F9:F17)");
                
                $this->excel->getActiveSheet()->getStyle('B7:F4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B18')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C9:E17')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->getStyle('B7:B17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C7:F8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F5:F18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->mergeCells('B18:E18');

                
                $this->excel->getActiveSheet()->setCellValue('A21', '2');
                $this->excel->getActiveSheet()->setCellValue('B21', 'Tingkat Pengangguran Terbuka (TPT)dan Jumlah Pengangguran');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F21:F22');
                $this->excel->getActiveSheet()->setCellValue("F21", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("B22", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C22", "6,00%");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B23:F32');
                $this->excel->getActiveSheet()->setCellValue("B23", "No");
                $this->excel->getActiveSheet()->mergeCells('B23:B24');
                $this->excel->getActiveSheet()->setCellValue("C23", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C23:C24');
                $this->excel->getActiveSheet()->setCellValue("D23", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D23:E24');
                $this->excel->getActiveSheet()->setCellValue("D24", "0");
                $this->excel->getActiveSheet()->setCellValue("E24", "1");
                $this->excel->getActiveSheet()->setCellValue("F23", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F23:F24');
                $this->excel->getActiveSheet()->setCellValue("B32", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B32:E32');
                $this->excel->getActiveSheet()->setCellValue("F32", "=SUM(F25:F31)");
                $this->excel->getActiveSheet()->setCellValue("F22", "=(SUM(F25:F31)/COUNT(B25:B31))*10");
                $this->excel->getActiveSheet()->getStyle('B23:B31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('B32')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C25:E31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F22')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->getStyle('C25:E31')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->getStyle('F21:F32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $this->excel->getActiveSheet()->setCellValue('A34', '3');
                $this->excel->getActiveSheet()->setCellValue('B34', 'Kemiskinan');
                $this->excel->getActiveSheet()->setCellValue("B35", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C35", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F34:F35');
                $this->excel->getActiveSheet()->setCellValue("F34", "Nilai");
                //$this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B22:F30');
                $this->excel->getActiveSheet()->setCellValue("B36", "No");
                $this->excel->getActiveSheet()->mergeCells('B36:B37');
                $this->excel->getActiveSheet()->setCellValue("C36", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C36:C37');
                $this->excel->getActiveSheet()->setCellValue("D36", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D36:E36');
                $this->excel->getActiveSheet()->setCellValue("D37", "0");
                $this->excel->getActiveSheet()->setCellValue("E37", "1");
                $this->excel->getActiveSheet()->setCellValue("F36", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F36:F37');
                $this->excel->getActiveSheet()->setCellValue("B49", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B49:E49');
                $this->excel->getActiveSheet()->setCellValue("F49", "=SUM(F37:F47)");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B36:F49');
                $this->excel->getActiveSheet()->setCellValue("F35", "=(SUM(F38:F48)/COUNT(F38:F48))*10");
                $this->excel->getActiveSheet()->getStyle('F35')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A51", "4");
                $this->excel->getActiveSheet()->setCellValue('B51', 'Indeks Pembangunan Manusia (IPM)');
                $this->excel->getActiveSheet()->setCellValue("B52", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C52", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F51:F52');
                $this->excel->getActiveSheet()->setCellValue("F51", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F52", "=(SUM(F55:F68)/COUNT(F55:F68))*10");
                $this->excel->getActiveSheet()->setCellValue("B53", "No");
                $this->excel->getActiveSheet()->mergeCells('B53:B54');
                $this->excel->getActiveSheet()->setCellValue("C53", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C53:C54');
                $this->excel->getActiveSheet()->setCellValue("D53", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D53:E53');
                $this->excel->getActiveSheet()->setCellValue("D54", "0");
                $this->excel->getActiveSheet()->setCellValue("E54", "1");
                $this->excel->getActiveSheet()->setCellValue("F53", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F53:F54');
                $this->excel->getActiveSheet()->setCellValue("B70", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B70:E70');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B53:F70');
                $this->excel->getActiveSheet()->getStyle('F51')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A71", "5");
                $this->excel->getActiveSheet()->setCellValue('B71', 'Ketimpangan');
                $this->excel->getActiveSheet()->setCellValue("B72", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C72", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F71:F72');
                $this->excel->getActiveSheet()->setCellValue("F71", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F72", "=(SUM(F75:F81)/COUNT(F75:F81))*10");
                $this->excel->getActiveSheet()->setCellValue("B73", "No");
                $this->excel->getActiveSheet()->mergeCells('B73:B74');
                $this->excel->getActiveSheet()->setCellValue("C73", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C73:C74');
                $this->excel->getActiveSheet()->setCellValue("D73", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D73:E73');
                $this->excel->getActiveSheet()->setCellValue("D74", "0");
                $this->excel->getActiveSheet()->setCellValue("E74", "1");
                $this->excel->getActiveSheet()->setCellValue("F73", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F73:F74');
                $this->excel->getActiveSheet()->setCellValue("B82", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B82:E82');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B73:F82');
                $this->excel->getActiveSheet()->getStyle('F72')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A84", "6");
                $this->excel->getActiveSheet()->setCellValue('B84', 'Pelayanan Publik dan Pengelolaan Keuangan ');
                $this->excel->getActiveSheet()->setCellValue("B85", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C85", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F84:F85');
                $this->excel->getActiveSheet()->setCellValue("F84", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F85", "=(SUM(F88:F97)/COUNT(F88:F97))*10");
                $this->excel->getActiveSheet()->setCellValue("B86", "No");
                $this->excel->getActiveSheet()->mergeCells('B86:B87');
                $this->excel->getActiveSheet()->setCellValue("C86", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C86:C87');
                $this->excel->getActiveSheet()->setCellValue("D86", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D86:E86');
                $this->excel->getActiveSheet()->setCellValue("D87", "0");
                $this->excel->getActiveSheet()->setCellValue("E87", "1");
                $this->excel->getActiveSheet()->setCellValue("F86", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F86:F87');
                $this->excel->getActiveSheet()->setCellValue("B98", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B98:E98');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B86:F98');
                $this->excel->getActiveSheet()->getStyle('F85')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

                $this->excel->getActiveSheet()->setCellValue("A100", "7");
                $this->excel->getActiveSheet()->setCellValue('B100', 'Transparansi dan Akuntabilitas');
                $this->excel->getActiveSheet()->setCellValue("B101", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C101", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F100:F101');
                $this->excel->getActiveSheet()->setCellValue("F100", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F101", "=(SUM(F104:F110)/COUNT(F104:F110))*10");
                $this->excel->getActiveSheet()->setCellValue("B102", "No");
                $this->excel->getActiveSheet()->mergeCells('B102:B103');
                $this->excel->getActiveSheet()->setCellValue("C102", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C102:C103');
                $this->excel->getActiveSheet()->setCellValue("D102", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D102:E102');
                $this->excel->getActiveSheet()->setCellValue("D103", "0");
                $this->excel->getActiveSheet()->setCellValue("E103", "1");
                $this->excel->getActiveSheet()->setCellValue("F102", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F102:F103');
                $this->excel->getActiveSheet()->setCellValue("B111", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B111:E111');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B102:F111');
                $this->excel->getActiveSheet()->getStyle('F101')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B113', 'Resume Aspek Pencapaian Pembangunan ');
                $this->excel->getActiveSheet()->setCellValue("B114", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B115:F118');
                $this->excel->getActiveSheet()->setCellValue('B119', 'Masukan dan Saran terhadap Aspek Pencapaian Pembangunan');
                $this->excel->getActiveSheet()->mergeCells('B120:F123');
                //
                $this->excel->getActiveSheet()->setCellValue("A125", "Kriteria Keterkaitan (5%)");
                $this->excel->getActiveSheet()->setCellValue("A126", "8");
                $this->excel->getActiveSheet()->setCellValue('B126', 'Tersedianya Penjelasan Strategi dan Arah Kebijakan RKPD 2020 yang Terkait dengan Visi dan Misi, Strategi dan Arah Kebijakan RPJMD');
                $this->excel->getActiveSheet()->setCellValue("B127", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C127", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F126:F127');
                $this->excel->getActiveSheet()->setCellValue("F126", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F127", "=(SUM(F130:F134)/COUNT(F130:F134))*10");
                $this->excel->getActiveSheet()->setCellValue("B128", "No");
                $this->excel->getActiveSheet()->mergeCells('B128:B129');
                $this->excel->getActiveSheet()->setCellValue("C128", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C128:C129');
                $this->excel->getActiveSheet()->setCellValue("D128", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D128:E128');
                $this->excel->getActiveSheet()->setCellValue("D129", "0");
                $this->excel->getActiveSheet()->setCellValue("E129", "1");
                $this->excel->getActiveSheet()->setCellValue("F128", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F128:F129');
                $this->excel->getActiveSheet()->setCellValue("B135", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B135:E135');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B128:F135');
                $this->excel->getActiveSheet()->getStyle('F127')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->mergeCells('B126:E126');
                $this->excel->getActiveSheet()->getStyle('B126')->getAlignment()->setWrapText(true);
                
                                $this->excel->getActiveSheet()->setCellValue("A137", "9");
                $this->excel->getActiveSheet()->setCellValue('B137', 'Tersedianya Penjelasan Keterkaitan antara Sasaran dan Prioritas Pembangunan Daerah dalam RKPD 2020 dengan Sasaran Prioritas Nasional (PN) RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B138", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C138", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F137:F138');
                $this->excel->getActiveSheet()->setCellValue("F137", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F138", "=(SUM(F141:F146)/COUNT(F141:F146))*10");
                $this->excel->getActiveSheet()->setCellValue("B139", "No");
                $this->excel->getActiveSheet()->mergeCells('B139:B140');
                $this->excel->getActiveSheet()->setCellValue("C139", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C139:C140');
                $this->excel->getActiveSheet()->setCellValue("D139", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D139:E139');
                $this->excel->getActiveSheet()->setCellValue("D140", "0");
                $this->excel->getActiveSheet()->setCellValue("E140", "1");
                $this->excel->getActiveSheet()->setCellValue("F139", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F139:F140');
                $this->excel->getActiveSheet()->setCellValue("B147", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B147:E147');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B139:F147');
                $this->excel->getActiveSheet()->getStyle('F138')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->getStyle('B137')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->mergeCells('B137:E137');
                
                $this->excel->getActiveSheet()->setCellValue("A149", "Kriteria Konsistensi (11,25%)");
                                $this->excel->getActiveSheet()->setCellValue("A150", "10");
                $this->excel->getActiveSheet()->setCellValue('B150', 'Terwujudnya Konsistensi antara Hasil Evaluasi Pelaksanaan RKPD 2018 dengan Permasalahan dan Isu Strategis pada RKPD 2020');
                $this->excel->getActiveSheet()->setCellValue("B151", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C151", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F150:F151');
                $this->excel->getActiveSheet()->setCellValue("F150", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F151", "=(SUM(F154:F159)/COUNT(F154:F159))*10");
                $this->excel->getActiveSheet()->setCellValue("B152", "No");
                $this->excel->getActiveSheet()->mergeCells('B152:B153');
                $this->excel->getActiveSheet()->setCellValue("C152", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C152:C153');
                $this->excel->getActiveSheet()->setCellValue("D152", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D152:E152');
                $this->excel->getActiveSheet()->setCellValue("D153", "0");
                $this->excel->getActiveSheet()->setCellValue("E153", "1");
                $this->excel->getActiveSheet()->setCellValue("F152", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F152:F153');
                $this->excel->getActiveSheet()->setCellValue("B160", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B160:E160');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B152:F160');
                $this->excel->getActiveSheet()->getStyle('F151')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A162", "11");
                $this->excel->getActiveSheet()->setCellValue('B162', 'Terwujudnya Konsistensi antara Prioritas Pembangunan Daerah dengan Permasalahan/Isu Strategis pada RKPD 2020');
                $this->excel->getActiveSheet()->setCellValue("B163", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C163", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F162:F163');
                $this->excel->getActiveSheet()->setCellValue("F162", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F163", "=(SUM(F166:F168)/COUNT(F166:F168))*10");
                $this->excel->getActiveSheet()->setCellValue("B164", "No");
                $this->excel->getActiveSheet()->mergeCells('B164:B165');
                $this->excel->getActiveSheet()->setCellValue("C164", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C164:C165');
                $this->excel->getActiveSheet()->setCellValue("D164", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D164:E164');
                $this->excel->getActiveSheet()->setCellValue("D165", "0");
                $this->excel->getActiveSheet()->setCellValue("E165", "1");
                $this->excel->getActiveSheet()->setCellValue("F164", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F164:F165');
                $this->excel->getActiveSheet()->setCellValue("B169", "Jumlah Skor");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B164:F169');
                $this->excel->getActiveSheet()->getStyle('F163')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A171", "12");
                $this->excel->getActiveSheet()->setCellValue('B171', 'Terwujudnya Konsistensi antara Prioritas Pembangunan Daerah dalam RKPD 2020 dengan Program Prioritas');
                $this->excel->getActiveSheet()->setCellValue("B172", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C172", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F171:F172');
                $this->excel->getActiveSheet()->setCellValue("F171", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F172", "=(SUM(F175:F180)/COUNT(F175:F180))*10");
                $this->excel->getActiveSheet()->setCellValue("B173", "No");
                $this->excel->getActiveSheet()->mergeCells('B173:B174');
                $this->excel->getActiveSheet()->setCellValue("C173", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C173:C174');
                $this->excel->getActiveSheet()->setCellValue("D173", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D173:E173');
                $this->excel->getActiveSheet()->setCellValue("D174", "0");
                $this->excel->getActiveSheet()->setCellValue("E174", "1");
                $this->excel->getActiveSheet()->setCellValue("F173", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F173:F174');
                $this->excel->getActiveSheet()->setCellValue("B181", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B181:E181');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B173:F181');
                $this->excel->getActiveSheet()->getStyle('F172')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A183", "13");
                $this->excel->getActiveSheet()->setCellValue('B183', 'Terwujudnya Konsistensi antara Prioritas Pembangunan dalam RKPD 2020 dengan Pagu Anggaran');
                $this->excel->getActiveSheet()->setCellValue("B184", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C184", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F183:F184');
                $this->excel->getActiveSheet()->setCellValue("F183", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F184", "=(SUM(F187:F189)/COUNT(F187:F189))*10");
                $this->excel->getActiveSheet()->setCellValue("B185", "No");
                $this->excel->getActiveSheet()->mergeCells('B185:B186');
                $this->excel->getActiveSheet()->setCellValue("C185", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C185:C186');
                $this->excel->getActiveSheet()->setCellValue("D185", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D185:E185');
                $this->excel->getActiveSheet()->setCellValue("D186", "0");
                $this->excel->getActiveSheet()->setCellValue("E186", "1");
                $this->excel->getActiveSheet()->setCellValue("F185", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F185:F186');
                $this->excel->getActiveSheet()->setCellValue("B190", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B190:E190');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B185:F190');
                $this->excel->getActiveSheet()->getStyle('F184')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A192", "Kriteria Kelengkapan dan Kedalaman (23,75%)");
                $this->excel->getActiveSheet()->setCellValue("A193", "14");
                $this->excel->getActiveSheet()->setCellValue('B193', 'Tersedianya Kerangka Ekonomi dan Kerangka Pendanaan dang Dilengkapi dengan Proyeksi dan Arah Kebijakan');
                $this->excel->getActiveSheet()->setCellValue("B194", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C194", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F193:F94');
                $this->excel->getActiveSheet()->setCellValue("F193", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F194", "=(SUM(F197:F202)/COUNT(F197:F202))*10");
                $this->excel->getActiveSheet()->setCellValue("B195", "No");
                $this->excel->getActiveSheet()->mergeCells('B195:B196');
                $this->excel->getActiveSheet()->setCellValue("C195", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C195:C196');
                $this->excel->getActiveSheet()->setCellValue("D195", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D195:E195');
                $this->excel->getActiveSheet()->setCellValue("D196", "0");
                $this->excel->getActiveSheet()->setCellValue("E196", "1");
                $this->excel->getActiveSheet()->setCellValue("F195", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F195:F196');
                $this->excel->getActiveSheet()->setCellValue("B203", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B203:E203');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B195:F203');
                $this->excel->getActiveSheet()->getStyle('F194')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A205", "15");
                $this->excel->getActiveSheet()->setCellValue('B205', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Pembangunan Manusia dan Pengentasan Kemiskinan RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B206", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C206", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F205:F206');
                $this->excel->getActiveSheet()->setCellValue("F205", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F206", "=(SUM(F209:F211)/COUNT(F209:F211))*10");
                $this->excel->getActiveSheet()->setCellValue("B207", "No");
                $this->excel->getActiveSheet()->mergeCells('B207:B208');
                $this->excel->getActiveSheet()->setCellValue("C207", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C207:C208');
                $this->excel->getActiveSheet()->setCellValue("D207", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D207:E207');
                $this->excel->getActiveSheet()->setCellValue("D208", "0");
                $this->excel->getActiveSheet()->setCellValue("E208", "1");
                $this->excel->getActiveSheet()->setCellValue("F207", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F207:F208');
                $this->excel->getActiveSheet()->setCellValue("B212", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B212:E212');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B207:F212');
                $this->excel->getActiveSheet()->getStyle('F206')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A214", "16");
                $this->excel->getActiveSheet()->setCellValue('B214', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Infrastruktur dan Pemerataan Wilayah RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B215", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C215", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F214:F215');
                $this->excel->getActiveSheet()->setCellValue("F214", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F215", "=(SUM(F218:F220)/COUNT(F218:F220))*10");
                $this->excel->getActiveSheet()->setCellValue("B216", "No");
                $this->excel->getActiveSheet()->mergeCells('B216:B217');
                $this->excel->getActiveSheet()->setCellValue("C216", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C216:C217');
                $this->excel->getActiveSheet()->setCellValue("D216", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D216:E216');
                $this->excel->getActiveSheet()->setCellValue("D217", "0");
                $this->excel->getActiveSheet()->setCellValue("E217", "1");
                $this->excel->getActiveSheet()->setCellValue("F216", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F216:F217');
                $this->excel->getActiveSheet()->setCellValue("B221", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B221:E221');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B216:F221');
                $this->excel->getActiveSheet()->getStyle('F215')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A223", "17");
                $this->excel->getActiveSheet()->setCellValue('B223', 'Tersedianya Dukungan Program Prioritas daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Nilai Tambah Sektor Riil, Industrialisasi dan Kesempatan Kerja RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B224", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C224", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F223:F224');
                $this->excel->getActiveSheet()->setCellValue("F223", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F224", "=(SUM(F227:F229)/COUNT(F227:F229))*10");
                $this->excel->getActiveSheet()->setCellValue("B225", "No");
                $this->excel->getActiveSheet()->mergeCells('B225:B226');
                $this->excel->getActiveSheet()->setCellValue("C225", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C225:C226');
                $this->excel->getActiveSheet()->setCellValue("D225", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D225:E225');
                $this->excel->getActiveSheet()->setCellValue("D226", "0");
                $this->excel->getActiveSheet()->setCellValue("E226", "1");
                $this->excel->getActiveSheet()->setCellValue("F225", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F225:F226');
                $this->excel->getActiveSheet()->setCellValue("B230", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B230:E230');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B225:F230');
                $this->excel->getActiveSheet()->getStyle('F224')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A232", "18");
                $this->excel->getActiveSheet()->setCellValue('B232', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas PN Ketahanan Pangan, Air, Energi dan Lingkungan Hidup RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B233", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C233", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F232:F233');
                $this->excel->getActiveSheet()->setCellValue("F232", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F233", "=(SUM(F236:F238)/COUNT(F236:F238))*10");
                $this->excel->getActiveSheet()->setCellValue("B234", "No");
                $this->excel->getActiveSheet()->mergeCells('B234:B235');
                $this->excel->getActiveSheet()->setCellValue("C234", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C234:C235');
                $this->excel->getActiveSheet()->setCellValue("D234", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D234:E234');
                $this->excel->getActiveSheet()->setCellValue("D235", "0");
                $this->excel->getActiveSheet()->setCellValue("E235", "1");
                $this->excel->getActiveSheet()->setCellValue("F234", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F234:F235');
                $this->excel->getActiveSheet()->setCellValue("B239", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B239:E239');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B234:F239');
                $this->excel->getActiveSheet()->getStyle('F233')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A241", "19");
                $this->excel->getActiveSheet()->setCellValue('B241', 'Tersedianya Dukungan Program Daerah RKPD 2020 terhadap Arah Kebijakan Pengarusutamaan Pembangunan Berkelanjutan, Tata Kelola Pemerintahan yang Baik, Gender, Modal Sosial Budaya dan Transformasi Digital');
                $this->excel->getActiveSheet()->setCellValue("B242", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C242", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F241:F242');
                $this->excel->getActiveSheet()->setCellValue("F241", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F242", "=(SUM(F245:F259)/COUNT(F245:F259))*10");
                $this->excel->getActiveSheet()->setCellValue("B243", "No");
                $this->excel->getActiveSheet()->mergeCells('B243:B244');
                $this->excel->getActiveSheet()->setCellValue("C243", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C243:C244');
                $this->excel->getActiveSheet()->setCellValue("D243", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D243:E243');
                $this->excel->getActiveSheet()->setCellValue("D244", "0");
                $this->excel->getActiveSheet()->setCellValue("E244", "1");
                $this->excel->getActiveSheet()->setCellValue("F243", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F243:F244');
                $this->excel->getActiveSheet()->setCellValue("B260", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B260:E260');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B243:F260');
                $this->excel->getActiveSheet()->getStyle('F242')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A262", "20");
                $this->excel->getActiveSheet()->setCellValue('B262', 'Tersedianya dukungan program daerah RKPD 2020 terhadap arah kebijakan Pembangunan Lintas Bidang Kerentanan Bencana dan Perubahan Iklim');
                $this->excel->getActiveSheet()->setCellValue("B263", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C263", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F262:F263');
                $this->excel->getActiveSheet()->setCellValue("F262", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F263", "=(SUM(F266:F271)/COUNT(F266:F271))*10");
                $this->excel->getActiveSheet()->setCellValue("B264", "No");
                $this->excel->getActiveSheet()->mergeCells('B264:B265');
                $this->excel->getActiveSheet()->setCellValue("C264", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C264:C265');
                $this->excel->getActiveSheet()->setCellValue("D264", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D264:E264');
                $this->excel->getActiveSheet()->setCellValue("D265", "0");
                $this->excel->getActiveSheet()->setCellValue("E265", "1");
                $this->excel->getActiveSheet()->setCellValue("F264", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F264:F265');
                $this->excel->getActiveSheet()->setCellValue("B272", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B272:E272');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B264:F272');
                $this->excel->getActiveSheet()->getStyle('F263')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

                $this->excel->getActiveSheet()->setCellValue("A274", "21");
                $this->excel->getActiveSheet()->setCellValue('B274', 'Tersedianya kebijakan pembangunan daerah RKPD 2020 yang menerapkan konsep Tematik, Holistik, Integratif, dan Spasial (THIS)');
                $this->excel->getActiveSheet()->setCellValue("B275", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C275", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F274:F275');
                $this->excel->getActiveSheet()->setCellValue("F274", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F275", "=(SUM(F278:F282)/COUNT(F278:F282))*10");
                $this->excel->getActiveSheet()->setCellValue("B276", "No");
                $this->excel->getActiveSheet()->mergeCells('B276:B277');
                $this->excel->getActiveSheet()->setCellValue("C276", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C276:C277');
                $this->excel->getActiveSheet()->setCellValue("D276", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D276:E276');
                $this->excel->getActiveSheet()->setCellValue("D277", "0");
                $this->excel->getActiveSheet()->setCellValue("E277", "1");
                $this->excel->getActiveSheet()->setCellValue("F276", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F276:F277');
                $this->excel->getActiveSheet()->setCellValue("B283", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B283:E283');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B276:F283');  
                $this->excel->getActiveSheet()->getStyle('F275')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A285", "22");
                $this->excel->getActiveSheet()->setCellValue('B285', 'Tersedianya indikator kinerja sasaran pembangunan daerah dan program prioritas');
                $this->excel->getActiveSheet()->setCellValue("B286", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C286", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F285:F286');
                $this->excel->getActiveSheet()->setCellValue("F285", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F286", "=(SUM(F289:F293)/COUNT(F289:F293))*10");
                $this->excel->getActiveSheet()->setCellValue("B287", "No");
                $this->excel->getActiveSheet()->mergeCells('B287:B288');
                $this->excel->getActiveSheet()->setCellValue("C287", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C287:C288');
                $this->excel->getActiveSheet()->setCellValue("D287", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D287:E287');
                $this->excel->getActiveSheet()->setCellValue("D288", "0");
                $this->excel->getActiveSheet()->setCellValue("E288", "1");
                $this->excel->getActiveSheet()->setCellValue("F287", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F287:F288');
                $this->excel->getActiveSheet()->setCellValue("B294", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B294:E294');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B287:F294'); 
                $this->excel->getActiveSheet()->getStyle('F286')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B296', 'Resume Aspek Kualitas Dokumen RKPD');
                $this->excel->getActiveSheet()->setCellValue("B297", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B298:F301');
                $this->excel->getActiveSheet()->setCellValue('B302', 'Masukan dan Saran terhadap Aspek Kualitas Dokumen RKPD');
                $this->excel->getActiveSheet()->mergeCells('B303:F306');
                
                $this->excel->getActiveSheet()->setCellValue("A308", "Kriteria Inovasi (20%)");
                $this->excel->getActiveSheet()->setCellValue("A309", "23");
                $this->excel->getActiveSheet()->setCellValue('B309', 'Indikator kelengkapan dokumen Inovasi daerah');
                $this->excel->getActiveSheet()->setCellValue("B310", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C310", "5,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F309:F310');
                $this->excel->getActiveSheet()->setCellValue("F309", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F310", "=(SUM(F313:F321)/COUNT(F313:F321))*10");
                $this->excel->getActiveSheet()->setCellValue("B311", "No");
                $this->excel->getActiveSheet()->mergeCells('B311:B312');
                $this->excel->getActiveSheet()->setCellValue("C311", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C311:C312');
                $this->excel->getActiveSheet()->setCellValue("D311", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D311:E311');
                $this->excel->getActiveSheet()->setCellValue("D312", "0");
                $this->excel->getActiveSheet()->setCellValue("E312", "1");
                $this->excel->getActiveSheet()->setCellValue("F311", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F311:F312');
                $this->excel->getActiveSheet()->setCellValue("B322", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B322:E322');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B311:F322');                
                $this->excel->getActiveSheet()->getStyle('F310')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A324", "24");
                $this->excel->getActiveSheet()->setCellValue('B324', 'Indikator kedalaman inovasi daerah');
                $this->excel->getActiveSheet()->setCellValue("B325", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C325", "15,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F324:F325');
                $this->excel->getActiveSheet()->setCellValue("F324", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F325", "=(SUM(F328:F343)/COUNT(F328:F343))*10");
                $this->excel->getActiveSheet()->setCellValue("B326", "No");
                $this->excel->getActiveSheet()->mergeCells('B326:B327');
                $this->excel->getActiveSheet()->setCellValue("C326", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C326:C327');
                $this->excel->getActiveSheet()->setCellValue("D326", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D326:E326');
                $this->excel->getActiveSheet()->setCellValue("D327", "0");
                $this->excel->getActiveSheet()->setCellValue("E327", "1");
                $this->excel->getActiveSheet()->setCellValue("F326", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F326:F327');
                $this->excel->getActiveSheet()->setCellValue("B344", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B344:E344');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B326:F344');                
                $this->excel->getActiveSheet()->getStyle('F325')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B346', 'Resume Aspek Inovasi');
                $this->excel->getActiveSheet()->setCellValue("B347", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B348:F350');
                $this->excel->getActiveSheet()->setCellValue('B351', 'Masukan dan Saran terhadap Aspek Inovasi');
                $this->excel->getActiveSheet()->mergeCells('B352:F355');
                
                //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
                $this->excel->getActiveSheet()->getProtection()->setSheet(true);
                $this->excel->getActiveSheet()->getProtection()->setSort(true);
                $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
                $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
                $this->excel->getActiveSheet()->getProtection()->setPassword('sk9');
                
                header("Content-Type:application/vnd.ms-excel");
                header("Content-Disposition:attachment;filename = Module1_penilaian_dokumen_.xls");
                header("Cache-Control:max-age=0");
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save("php://output");   
    }
        
//untuk pilihan 
    //list Kota
    function get_data_kota(){
        if($this->input->is_ajax_request()){
            try {
                $requestData= $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array( 
                // datatable column index  => database column name
                    $idx++   =>'MP.`id_kab`', 
                    $idx++   =>'MP.`nama_kabupaten`',
                    $idx++   =>'KK.`status`',
                );
                
                $sql = "SELECT MP.id,MP.`id_kab`,MP.`nama_kabupaten`,MP.urutan, KK.`status` 
                        FROM `kabupaten` MP
                        LEFT JOIN (SELECT * FROM `tbl_status_penilaian_kk` WHERE `userid` = '$userid' ) KK ON KK.`idkabkot` = MP.id
                        LEFT JOIN `tbl_user_kabkot` W ON W.idkabkot = MP.id
                        WHERE W.iduser='".$userid."' AND MP.urutan ='1' ";
                                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " MP.`id_kab` LIKE '%".$requestData['search']['value']."%' "
                                . " OR MP.`nama_kabupaten` LIKE '%".$requestData['search']['value']."%' "
                                . " OR KK.`status` LIKE '%".$requestData['search']['value']."%' "
                                . ")";    
                }
                $list_data = $this->db->query($sql);
                $totalFiltered = $list_data->num_rows();
                $sql.=" ORDER BY "
                        .$columns[$requestData['order'][0]['column']]."   "
                        .$requestData['order'][0]['dir']."  "
                        . "LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
                $list_data = $this->db->query($sql);
                $data = array();
                $i=1;
                foreach ($list_data->result() as $row) {
                    $nestedData=array();
                    $id      = $row->id;
                    $title  = $row->nama_kabupaten;
                    $nestedData[] = $i++;
                    $nestedData[] = $row->nama_kabupaten;
                    $nestedData[] = "<a class='btn btn-xs btn-info waves-effect waves-light doku' data-id='".encrypt_text($id)."' title='Dokumen '><i class='fa fa-cloud'></i><h7> Bahan Dukung</h7></a>";
                    if($row->status==''){
                        $nestedData[] = "<a class='btn btn-xs btn-outline-secondary waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Belum '><i class='fa fa-pencil'></i><h7> Belum Diisi</h7></a>";
                        $nestedData[] = "";}
                    elseif($row->status=='1'){
                        $nestedData[] = ""
                        . "<a class='btn btn-xs btn-outline-warning waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lenkapi Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a>";
                        $nestedData[] = "";}
                    elseif($row->status=='2'){
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Lembar pernyataan belum diisi</h7></a>";
                         $nestedData[] = "";
//                                 . "<a class='btn btn-xs btn-outline-info waves-purple waves-light download' data-id='".encrypt_text($id)."' title='Download Excel'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a>";     
                    }
                    elseif($row->status=='3'){
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a>";
                         $nestedData[] = ""
                                 . "<a class='btn btn-xs btn-outline-info waves-purple waves-light download' data-id='".encrypt_text($id)."' title='Download Excel'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a>";     
                    }
                    
                    $data[] = $nestedData;
                }
                $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval( $totalData ),  // total number of records
                    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                    );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
                }
        else
            die;
    }
    
    function detail_get_kota(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                //kabupaten
                $iddaerah = decrypt_text($this->input->post("id"));
               
                if(!is_numeric($iddaerah))
                    throw new Exception("Invalid ID!");
                                
                $this->m_ref->setTableName("kabupaten");
                $select = array();
                $cond = array(
                    "id"  => $iddaerah,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
               // $penilai=
                foreach ($list_data->result() as $v) {
                    $nama_kabupaten = $v->nama_kabupaten;                    
                }
                $query="";

                $status_sql="SELECT TI.*, SP.`status` 
                        FROM `tbl_indikator` TI
                        LEFT JOIN (SELECT * FROM `tbl_sp_tbl_indikator_kota` WHERE `user` ='".$this->session->userdata(SESSION_LOGIN)->id."' AND `kota`='".$iddaerah."'  GROUP BY `indikator`) SP ON SP.`indikator` = TI.id
                        WHERE 1=1";
                $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";
                $no=1;
                $content2 = "";
                $content3 = "";
                $content4 = "";   
                $content5 = "";      
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                    if($r_ti2->idkreteria == 1){
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2'){
                            $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content.="</tr>";
                    }
                    if($r_ti2->idkreteria == 2){
                        $id      = $r_ti2->id;
                        $content2.="<tr class='odd gradeX'>";
                        $content2.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content2.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content2.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content2.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content2.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content2.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content2.="</tr>";
                    }    
                    if($r_ti2->idkreteria == 3){
                        $id      = $r_ti2->id;
                        $content3.="<tr class='odd gradeX'>";
                        $content3.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content3.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content3.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content3.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content3.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content3.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                    if($r_ti2->idkreteria == 4){
                        $id      = $r_ti2->id;
                        $content4.="<tr class='odd gradeX'>";
                        $content4.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content4.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content4.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content4.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content4.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content4.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                    if($r_ti2->idkreteria == 5){
                        $id      = $r_ti2->id;
                        $content5.="<tr class='odd gradeX'>";
                        $content5.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->no_indikator."</a></td>";
                        $content5.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".wordwrap($r_ti2->nama_indikator,115,"<br>\n")."</a></td>";
                        $content5.="<td style='font-size: 14px'><a class='isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->bobot."%</a></td>";
                        if($r_ti2->status==''){
                            $content5.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Diisi</h7></a></td>";
                        }elseif ($r_ti2->status=='1') {
                            $content5.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        } elseif ($r_ti2->status=='2') {
                            $content5.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai2' data-id='".encrypt_text($id)."' data-daerah='".$iddaerah."' data-nomor='".$r_ti2->no_indikator.". ".wordwrap($r_ti2->nama_indikator,100,"<br>\n")."' data-bobot='".$r_ti2->bobot."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        }
                        $content3.="</tr>";
                    }
                }
                
                //cek jumlah total indikator yang sudah dinilai
                $select_jml="SELECT COUNT(TI.id) AS total,SP.ttl , TI.idkreteria
                                FROM `tbl_indikator` TI 
                                LEFT JOIN (
                                SELECT COUNT(TI.id) AS ttl, TK.id,TS.indikator
                                FROM `tbl_sp_tbl_indikator_kota` TS
                                LEFT JOIN tbl_indikator TI ON TI.id = TS.indikator
                                LEFT JOIN tbl_kriteria TK ON TK.id = TI.idkreteria
                                WHERE TS.`user` ='".$this->session->userdata(SESSION_LOGIN)->id."' AND TS.`kota`='".$iddaerah."' AND TS.status = '2'
                                GROUP BY TK.id
                                )SP ON SP.`indikator` = TI.id
                                WHERE 1=1
                                GROUP BY TI.idkreteria";
                $list_jml_n = $this->db->query($select_jml);
                $pencapaian='';$keterkaitan='';$konsistensi='';$kelengkapan='';$inovasi='';
//                foreach($list_jml_n->result() as $row_jml){
//                    $kriteria = $row_jml->idkreteria;
//                    if($kriteria=='1'){
//                        $pencapaian= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
//                    }
//                    elseif($kriteria=='2'){
//                        $keterkaitan= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
//                    }
//                    elseif($kriteria=='3'){
//                        $konsistensi= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
//                    }
//                    elseif($kriteria=='4'){
//                        $kelengkapan= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
//                    }
//                    elseif($kriteria=='5'){
//                        $inovasi= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
//                    }
//                }
                foreach($list_jml_n->result() as $row_jml){
                    $kriteria = $row_jml->idkreteria;
                    if($kriteria=='1'){
                        if($row_jml->ttl==''){
                            $pencapaian= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $pencapaian= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='2'){
                        if($row_jml->ttl==''){
                            $keterkaitan= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $keterkaitan= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                        
                    }
                    elseif($kriteria=='3'){
                        if($row_jml->ttl==''){
                            $konsistensi= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $konsistensi= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='4'){
                        if($row_jml->ttl==''){
                            $kelengkapan= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $kelengkapan= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                    elseif($kriteria=='5'){
                        if($row_jml->ttl==''){
                            $inovasi= '0 dari '.$row_jml->total.' indikator';
                        }else{
                            $inovasi= $row_jml->ttl.' dari '.$row_jml->total.' indikator';
                        }
                    }
                }
                //cek status penilaian nilai 2
                $lembaran_pernyataan='';
                $select_status="SELECT SP.* FROM tbl_status_penilaian_kk SP WHERE SP.userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND SP.idkabkot = '".$iddaerah."' AND SP.status='2'";
                $list_status = $this->db->query($select_status);
                if($list_status->num_rows() > 0){
                    //jika 2 cek lembaran pernyataan
//                    $select_lp ="SELECT TL.* FROM `tbl_lembar_pernyataan_kota` TL WHERE TL.user = '".$this->session->userdata(SESSION_LOGIN)->id."' AND TL.kota='".$iddaerah."'";
//                //jika 0 tampil lembaran pernyataan
//                    $list_lp = $this->db->query($select_lp);
//                    if($list_lp->num_rows() == 0){
//                        $lembaran_pernyataan='1';
//                    }
                    $lembaran_pernyataan='1';
                }
                
                
                
                //sukses
                $output = array(
                    "status"            =>  1,
                    "csrf_hash"         =>  $this->security->get_csrf_hash(),
                    "msg"               =>  "success get data",
                    "profile"           =>  $this->session->userdata(SESSION_LOGIN)->name,
                    "nama_kabupaten"    =>  $nama_kabupaten,
                    "data"              =>  $list_data->result(),
                    "tbl_pencapaian"    =>  $content,
                    "tbl_keterkaitan"   =>  $content2,
                    "tbl_konsistensi"   =>  $content3,
                    "tbl_kk"            =>  $content4,
                    "tbl_inovasi"       =>  $content5,
                    "id"                => encrypt_text($id),
                    "profile2"          =>  "Nama Penilai :".$this->session->userdata(SESSION_LOGIN)->name,
                    "pencapaian"        =>  $pencapaian,
                    "keterkaitan"       =>  $keterkaitan,
                    "konsistensi"       =>  $konsistensi,
                    "kelengkapan"       =>  $kelengkapan,
                    "inovasi"           =>  $inovasi,
                    "pernyataan"        =>  $lembaran_pernyataan,
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
        }
        else{exit("Access Denied");}
    }

    //skor
    function detail_kategori_skor_kota(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                    $user=$this->session->userdata(SESSION_LOGIN)->id;
                $indikator = decrypt_text($this->input->post("id"));      
                if(!is_numeric($indikator))
                    throw new Exception("Invalid ID!");
                $iddaerah = decrypt_text($this->input->post("iddaerah"));
                //catatan indikator
                $select_note="SELECT TI.* FROM tbl_indikator TI WHERE TI.id='".$indikator."' ";
                $list_note = $this->db->query($select_note);
                foreach ($list_note->result() as $r_n) {
                    $catatan= $r_n->note;
                }
                $catatan_res = "";
                $masukan_res = "";
                if($indikator=='7' || $indikator=='22' || $indikator=='24'){
                    $select_resume="SELECT TI.* FROM tbl_resume_aspek_kota TI "
                            . "WHERE TI.indikator='".$indikator."' AND TI.user='".$user."' AND TI.kota='".$iddaerah."' ";
                    $list_resume = $this->db->query($select_resume);
                    foreach ($list_resume->result() as $r_re) {
                        $catatan_res = $r_re->catatan;
                        $masukan_res = $r_re->masukan;
                    }
                }
                $ctt='';
                if($catatan==''){ $ctt=''; } else {$ctt='Catatan :';}
                //cek kriteria
                $query="SELECT TK.* FROM `tbl_kriteria` TK
                        LEFT JOIN `tbl_indikator` TI ON TK.id= TI.idkreteria
                        LEFT JOIN `tbl_kategori_skor` TS ON TI.id =TS.indikatorid
                        WHERE TS.indikatorid='".$indikator."' AND TS.tag='0' GROUP BY TK.id";
                $list_data = $this->db->query($query);
                foreach ($list_data->result() as $r_data) {
                   $kriteria = $r_data->nama_kriteria;
                   $bobot    = $r_data->bobot;
                }
                
                $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor_kota` WHERE `user` ='".$user."' AND `kota`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.indikatorid='".$indikator."' AND KS.tag='0'";
               
                $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";             
                $no=1;
                $sub=3;
               
                foreach ($list_data_i2->result() as $r_ti2) {
                                      
                        $sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".wordwrap($r_ti2->item_penilaian,30,"<br>\n")."</a></td>";
                        if($r_ti2->sk==''){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }
                        elseif($r_ti2->sk=='0'){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }
                        elseif($r_ti2->sk=='1'){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }                        
                        $content.="</tr>";                    
                     }
                        $sum1=0;$count=0;$Nilai1=0;$Nilai=0;
                        
                //jumlah skor dan jumlah terjawab
                 $jawaban=0;
                 $item=0;
                 $Nilai=0;
                $select_jumlah = "SELECT COUNT(TN.id) AS J_Terjawab, SUM(TN.skor) AS J_Jawaban 
                                    FROM `tbl_nilai_skor_kota` TN 
                                    LEFT JOIN `tbl_kategori_skor` TK ON TN.kat_skor = TK.id
                                 WHERE TN.`user` ='".$user."' AND TN.`kota`='".$iddaerah."' AND TK.`indikatorid`='".$indikator."' AND TK.tag='0'";

                $list_jumlah  = $this->db->query($select_jumlah);
                foreach ($list_jumlah->result() as $r_sum) {
                    $terjawab = $r_sum->J_Terjawab;
                    $jawaban  = $r_sum->J_Jawaban;
                }
                //Jumlah item penilaian
                $select_Jitem="SELECT COUNT(TK.id) AS J_Item FROM `tbl_kategori_skor` TK WHERE TK.indikatorid = '".$indikator."' AND TK.tag='0'";
                $list_Jitem  = $this->db->query($select_Jitem);
                foreach ($list_Jitem->result() as $r_Jitem) {
                    $item = $r_Jitem->J_Item;
                }
                $Nilai1=($jawaban/$item)*10;
                $Nilai=number_format($Nilai1,2);
                
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success get data",
                    "table_ktg_skor"=>  $content,
                    "total"         => $Nilai,
                    "kriteria"      => "Kriteria ".$kriteria." (".$bobot."%)",
                    "jml_terjawab"  => $terjawab." dari ".$item." item penilaian",
                    "jml_jawaban"   => $jawaban,
                    "no_indikator"  => $indikator,
                    "desk"          => $ctt,
                    "catatan"      => $catatan,
                    "catatan_res"  => $catatan_res,
                    "masukan_res"  => $masukan_res,

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
        }
        else{exit("Access Denied");}
    }

    function pilih_skor_kota(){
            if($this->input->is_ajax_request()){
                try {
                    if(!$this->session->userdata(SESSION_LOGIN)){
                        throw new Exception("Session berakhir, silahkan login ulang",2);
                    }
                    $this->form_validation->set_rules('id','ID Data Indikator','required');
                    $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                    $this->form_validation->set_rules('indkno','ID No','required');
                    $this->form_validation->set_rules('nilai','Nilai','required');
                    $this->form_validation->set_rules('idin','Id Indikator','required');
                    if($this->form_validation->run() == FALSE){
                        throw new Exception(validation_errors("", ""),0);
                    }
                    date_default_timezone_set("Asia/Jakarta");
                    $current_date_time = date("Y-m-d H:i:s");
                
                    $user=$this->session->userdata(SESSION_LOGIN)->id;
                    $id = decrypt_text($this->input->post("id"));
                    $indikator = decrypt_text($this->input->post("id"));
                    if(!is_numeric($id))
                        throw new Exception("Invalid ID!");
                    $iddaerah = decrypt_text($this->input->post("iddaerah"));
                    $nilai = $this->input->post("nilai");
                    $noind = $this->input->post("indkno");
                    $idin = $this->input->post("idin");
                    
                    //CHECK DATA
                    $this->m_ref->setTableName("tbl_nilai_skor_kota");
                    $select = array();
                    $cond = array(
                        "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                        "kota"  => $iddaerah,
                        "kat_skor"        => $id,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if($list_data->num_rows() == 0){
                        $this->db->trans_begin();
                        $this->m_ref->setTableName("tbl_nilai_skor_kota");
                        $data_baru = array(
                            "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                            "kota"      => $iddaerah,
                            "kat_skor"        => $id,
                            "skor"      => $nilai,
                            "cr_dt"    => $current_date_time,
                          );
                        $status_save = $this->m_ref->save($data_baru);
                        if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                        $this->db->trans_commit();
                       // $pesan='Sukses Insert Data';
                    }
                    else {
                        $this->db->trans_begin();
                        $this->m_ref->setTableName("tbl_nilai_skor_kota");
                        $data_baru = array(
                            "skor"      => $nilai,
                            "ud_dt"     => $current_date_time,
                        );
                        $cond = array(
                            "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                            "kota"  => $iddaerah,
                            "kat_skor"  => $id,

                        );
                        $status_save = $this->m_ref->update($cond,$data_baru);
                        if(!$status_save){throw new Exception($this->db->error("code")." : Gagal Update Data",0);}

                        $this->db->trans_commit();
                       // $pesan='Sukses Update Data';


                     }
                    
                     //Jumlahkan total Nilai
                     $jawaban=0;
                    $item=0;
                    $Nilai=0;
                    $select_jumlah = "SELECT COUNT(TN.id) AS J_Terjawab, SUM(TN.skor) AS J_Jawaban 
                                        FROM `tbl_nilai_skor_kota` TN  
                                     LEFT JOIN `tbl_kategori_skor` TK ON TN.kat_skor = TK.id 
                                     WHERE TN.`user` ='".$user."' AND TN.`kota`='".$iddaerah."' AND TK.`indikatorid`='".$idin."' AND TK.tag='0'";
                    //print_r($select_jumlah);exit();
                    $list_jumlah  = $this->db->query($select_jumlah);
                    foreach ($list_jumlah->result() as $r_sum) {
                        $terjawab = $r_sum->J_Terjawab;
                        $jawaban  = $r_sum->J_Jawaban;
                    }
                    //Jumlah item penilaian
                    $select_Jitem="SELECT COUNT(TK.id) AS J_Item FROM `tbl_kategori_skor` TK WHERE TK.indikatorid = '".$idin."' AND TK.tag='0'";
                    $list_Jitem  = $this->db->query($select_Jitem);
                    foreach ($list_Jitem->result() as $r_Jitem) {
                        $item = $r_Jitem->J_Item;
                    }
                    $Nilai1=($jawaban/$item)*10;
                    $Nilai=number_format($Nilai1,2); 
                    
                    $status_sql="SELECT KS.*, NS.`skor` as sk 
                            FROM `tbl_kategori_skor` KS
                            LEFT JOIN (SELECT * FROM `tbl_nilai_skor_kota` WHERE `user` ='".$user."' AND `kota`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                            WHERE KS.indikatorid='".$idin."' AND KS.tag='0'";
                    //print_r($status_sql);exit();
                    $list_data_i2  = $this->db->query($status_sql);
                    $content = "";             
                    $no=1;
//                    foreach ($list_data_i2->result() as $r_ti2) {
//                            $id      = $r_ti2->id;
//                            $content.="<tr class='odd gradeX'>";
//                            $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
//                            $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->item_penilaian."</a></td>";
//                            if($r_ti2->sk==''){
//                                $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                                $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                                $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
//                            }
//                            elseif($r_ti2->sk=='0'){
//                                $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                                $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                                $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
//                            }
//                            elseif($r_ti2->sk=='1'){
//                                $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
//                                $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
//                                $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
//                            }                          
//                            $content.="</tr>";
//                    }
                                    foreach ($list_data_i2->result() as $r_ti2) {
                                      
                        $sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".wordwrap($r_ti2->item_penilaian,30,"<br>\n")."</a></td>";
                        if($r_ti2->sk==''){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }
                        elseif($r_ti2->sk=='0'){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }
                        elseif($r_ti2->sk=='1'){
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_nol,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".wordwrap($r_ti2->kspi_satu,30,"<br>\n")."</h7></a></td>";
                            $content.="<td style='font-size: 12px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }                        
                        $content.="</tr>";                    
                     }
                    //status Penilaian Indikator
                    if($r_ti2->sk==''){
                                             //cek status penilaian Indikator
                        $select_s_p="SELECT * FROM `tbl_sp_tbl_indikator_kota` "
                            . "WHERE user='".$this->session->userdata(SESSION_LOGIN)->id."' "
                            . "AND kota='$iddaerah' AND indikator='$idin'";
                        $list_sp  = $this->db->query($select_s_p);
                        if($list_sp->num_rows() == 0){             
                                     $this->db->trans_begin();
                                     $this->m_ref->setTableName("tbl_sp_tbl_indikator_kota");
                                     $data_baru = array(
                                        "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                                        "kota"      => $iddaerah,
                                        "indikator"      => $idin,
                                        "status"      => '1',
                                    );
                                    $status_save = $this->m_ref->save($data_baru);
                                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                                    $this->db->trans_commit();
                                } 
                         else {
                             $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_sp_tbl_indikator_kota");
                             $data_baru = array(
                                "status"      => '1',
                             );
                             $cond = array(
                                "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                                "kota"      => $iddaerah,
                                "indikator"      => $idin,
                             );
                             $status_save = $this->m_ref->update($cond,$data_baru);
                             if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                             $this->db->trans_commit();
                         }
                    }
                    else{
                        $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_sp_tbl_indikator_kota");
                             $data_baru = array(
                                "status"      => '2',
                             );
                             $cond = array(
                                "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                                "kota"      => $iddaerah,
                                "indikator"      => $idin,
                             );
                             $status_save = $this->m_ref->update($cond,$data_baru);
                             if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                             $this->db->trans_commit();
                    }
                    
                    
                    //status module kota
                    $select_jml="SELECT COUNT(TKS.id) AS J_kategori
                                    FROM `tbl_kategori_skor` TKS
                                    LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                    LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                    LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                    WHERE TM.id='1' AND TKS.tag='0'";
                    //print_r($select_jml);                    echo '</Br';
                    $list_jml_m  = $this->db->query($select_jml);
                    foreach ($list_jml_m->result() as $r_tjml_m){
                        $jml_kategori = $r_tjml_m->J_kategori;
                    }
                    $status_penilaian_m='';
                    //select jumlah jawaban
                    $select_jwb="SELECT COUNT(TN.id) AS J_nilai
                                FROM `tbl_nilai_skor_kota` TN
                                LEFT JOIN `tbl_kategori_skor` TKS ON TN.kat_skor = TKS.id 
                                LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                WHERE TM.id='1' AND TN.user='".$user."' AND TN.kota='".$iddaerah."' AND TKS.tag='0'";
                    //print_r($select_jwb);exit();
                    $list_jml_j  = $this->db->query($select_jwb);
                    foreach ($list_jml_j->result() as $r_jml_j){
                        $jml_nilai = $r_jml_j->J_nilai;
                    }
                    //jika kreteria modul sama dengan jumlah jawaban maka cek resume
                    if($jml_kategori == $jml_nilai){
                        //jumlahkan resume aspek, jika sama dengan tiga module selesai dinilai download laporan akan muncul
                        $select_resume="SELECT COUNT(TR.id) AS J_resume
                                        FROM `tbl_resume_aspek_kota` TR
                                        WHERE TR.user ='".$user."' AND TR.kota='".$iddaerah."'";
                        $list_resume  = $this->db->query($select_resume);
                        foreach ($list_resume->result() as $r_resume){
                           $jml_resume =  $r_resume->J_resume;
                        }
                        if($jml_resume=='3'){
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian_kk");
                            $data_baru = array(
                                "status"      => '2',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "idkabkot"  => $iddaerah,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                        }
                        
                    }
                    else{
                        $select_s_p="SELECT * FROM `tbl_status_penilaian_kk` "
                                . "WHERE userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND idkabkot='$iddaerah'";
                        $list_sp  = $this->db->query($select_s_p);
                         if($list_sp->num_rows() == 0){
                             $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_status_penilaian_kk");
                             $data_baru = array(
                                    "userid"      => $this->session->userdata(SESSION_LOGIN)->id,
                                    "idkabkot"      => $iddaerah,
                                    "status"      => '1',
                            );
                             $status_save = $this->m_ref->save($data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();                    
                         } 
                         else {
                             //status penilaian pr
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian_kk");
                            $data_baru = array(
                                "status"      => '1',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "idkabkot"  => $iddaerah,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                         }
                    }
                    
                    //cek status penilaian nilai 2
                $lembaran_pernyataan='';
                $select_status="SELECT SP.* FROM tbl_status_penilaian_kk SP WHERE SP.userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND SP.idkabkot = '".$iddaerah."' AND SP.status='2'";
                $list_status = $this->db->query($select_status);
                if($list_status->num_rows() > 0){
                    //jika 2 cek lembaran pernyataan
//                    $select_lp ="SELECT TL.* FROM `tbl_lembar_pernyataan_kota` TL WHERE TL.user = '".$this->session->userdata(SESSION_LOGIN)->id."' AND TL.kota='".$iddaerah."'";
//                //jika 0 tampil lembaran pernyataan
//                    $list_lp = $this->db->query($select_lp);
//                    if($list_lp->num_rows() == 0){
//                        $lembaran_pernyataan='1';
//                    }
                    $lembaran_pernyataan='1';
                }
                    
                    //sukses
                    $output = array(
                        "status"         => 1,
                        "csrf_hash"      => $this->security->get_csrf_hash(),
                        "msg"            => "success get data",
                        "table_ktg_skor" => $content,
                        "nilai"          => $Nilai,
                        "pernyataan"     =>  $lembaran_pernyataan,
                    );
                    exit(json_encode($output));
                } catch (Exception $exc)  {
                    $this->db->trans_rollback();
                    $output = array(
                        "status"    =>  $exc->getCode(),
                        "msg"       =>  $exc->getMessage(),
                        "csrf_hash" =>  $this->security->get_csrf_hash(),
                    );
                    exit(json_encode($output));
                }
            }
            else{exit("Access Denied");}
        }
        
    //tambah saran dan catatan
    function add_catatan_kota()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('Kotaresume','Kotaresume','required|xss_clean');
                $this->form_validation->set_rules('indikaresum','indikaresum','required|xss_clean');
                $this->form_validation->set_rules('catatan','catatan','required|xss_clean');
                $this->form_validation->set_rules('saran','group','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $userid=$this->session->userdata(SESSION_LOGIN)->id;
                $kota = decrypt_text($this->input->post("Kotaresume"));      
                if(!is_numeric($kota))
                    throw new Exception("Invalid ID Kota!");
                $indikaresum = $this->input->post("indikaresum");
                //print_r($indikaresum);exit();
                $catatan = $this->input->post("catatan");
                $saran = $this->input->post("saran");
               
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_resume_aspek_kota");
                $select = array();
                $cond = array(
                    "user"  => $userid,
                    "kota" => $kota,
                    "indikator" => $indikaresum,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_resume_aspek_kota");
                    $data_baru = array(
                        "catatan"  => $catatan,
                        "masukan"  => $saran,
                        "ud_dt"    => $current_date_time,
                    );
                    $cond = array(
                       "user"       => $userid,
                        "kota"      => $kota,
                        "indikator" => $indikaresum,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();   
                }
                else{
                    $this->db->trans_begin();
                     $this->m_ref->setTableName("tbl_resume_aspek_kota");
                    $data_baru = array(
                        "user"      => $userid,
                        "kota"      => $kota,
                        "indikator" => $indikaresum,
                        "catatan"   => $catatan,
                        "masukan"   => $saran,
                        "cr_dt"     => $current_date_time,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                }
                
                
                //status module kota
                    $select_jml="SELECT COUNT(TKS.id) AS J_kategori
                                    FROM `tbl_kategori_skor` TKS
                                    LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                    LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                    LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                    WHERE TM.id='1' AND TKS.tag='0'";
                    //print_r($select_jml);                    echo '</Br';
                    $list_jml_m  = $this->db->query($select_jml);
                    foreach ($list_jml_m->result() as $r_tjml_m){
                        $jml_kategori = $r_tjml_m->J_kategori;
                    }
                    $status_penilaian_m='';
                    //select jumlah jawaban
                    $select_jwb="SELECT COUNT(TN.id) AS J_nilai
                                FROM `tbl_nilai_skor_kota` TN
                                LEFT JOIN `tbl_kategori_skor` TKS ON TN.kat_skor = TKS.id 
                                LEFT JOIN `tbl_indikator` TI ON TKS.indikatorid = TI.id
                                LEFT JOIN `tbl_kriteria` TK ON TI.idkreteria = TK.id
                                LEFT JOIN  `tbl_module` TM ON TK.idmodule = TM.id
                                WHERE TM.id='1' AND TN.user='".$userid."' AND TN.kota='".$kota."' AND TKS.tag='0'";
                    //print_r($select_jwb);exit();
                    $list_jml_j  = $this->db->query($select_jwb);
                    foreach ($list_jml_j->result() as $r_jml_j){
                        $jml_nilai = $r_jml_j->J_nilai;
                    }
                    //jika kreteria modul sama dengan jumlah jawaban maka cek resume
                    if($jml_kategori == $jml_nilai){
                        //jumlahkan resume aspek, jika sama dengan tiga module selesai dinilai download laporan akan muncul
                        $select_resume="SELECT COUNT(TR.id) AS J_resume
                                        FROM `tbl_resume_aspek_kota` TR
                                        WHERE TR.user ='".$userid."' AND TR.kota='".$kota."'";
                        $list_resume  = $this->db->query($select_resume);
                        foreach ($list_resume->result() as $r_resume){
                           $jml_resume =  $r_resume->J_resume;
                        }
                        if($jml_resume=='3'){
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian_kk");
                            $data_baru = array(
                                "status"      => '2',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "idkabkot"  => $kota,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                        }
                        
                    }
                    else{
                        $select_s_p="SELECT * FROM `tbl_status_penilaian_kk` "
                                . "WHERE userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND idkabkot='$kota'";
                        $list_sp  = $this->db->query($select_s_p);
                         if($list_sp->num_rows() == 0){
                             $this->db->trans_begin();
                             $this->m_ref->setTableName("tbl_status_penilaian_kk");
                             $data_baru = array(
                                    "userid"      => $this->session->userdata(SESSION_LOGIN)->id,
                                    "idkabkot"      => $kota,
                                    "status"      => '1',
                            );
                             $status_save = $this->m_ref->save($data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();                    
                         } 
                         else {
                             //status penilaian pr
                            $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_status_penilaian_kk");
                            $data_baru = array(
                                "status"      => '1',
                            );
                            $cond = array(
                                "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                                "idkabkot"  => $iddaerah,
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                         }
                    }
                    
                    //cek status penilaian nilai 2
                $lembaran_pernyataan='';
                $select_status="SELECT SP.* FROM tbl_status_penilaian_kk SP WHERE SP.userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND SP.idkabkot = '".$kota."' AND SP.status='2'";
                $list_status = $this->db->query($select_status);
                if($list_status->num_rows() > 0){
                    //jika 2 cek lembaran pernyataan
//                    $select_lp ="SELECT TL.* FROM `tbl_lembar_pernyataan_kota` TL WHERE TL.user = '".$this->session->userdata(SESSION_LOGIN)->id."' AND TL.kota='".$kota."'";
//                //jika 0 tampil lembaran pernyataan
//                    $list_lp = $this->db->query($select_lp);
//                    if($list_lp->num_rows() == 0){
//                        $lembaran_pernyataan='1';
//                    }
                    $lembaran_pernyataan='1';
                }
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "Resume Aspek Sukses disimpan",
                    "pernyataan"    =>  $lembaran_pernyataan,
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }    

    //tambah saran dan catatan
    function add_lembaranpernyataan_kota()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('kota','Kota','required|xss_clean');
                $this->form_validation->set_rules('nama','indikaresum','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $userid=$this->session->userdata(SESSION_LOGIN)->id;
                $kota = decrypt_text($this->input->post("kota"));      
                if(!is_numeric($kota))
                    throw new Exception("Invalid ID Kota!");
                $nama = $this->input->post("nama");
               
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_lembar_pernyataan_kota");
                $select = array();
                $cond = array(
                    "user"      => $userid,
                    "kota"      => $kota,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_lembar_pernyataan_kota");
                    $data_baru = array(
                        "nama"  => $nama,
                        "ud_dt"    => $current_date_time,
                    );
                    $cond = array(
                       "user"      => $userid,
                        "kota"      => $kota,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();   
                }
                else{
                    $this->db->trans_begin();
                     $this->m_ref->setTableName("tbl_lembar_pernyataan_kota");
                    $data_baru = array(
                        "user"      => $userid,
                        "kota"      => $kota,
                        "nama"  => $nama,
                        "cr_dt"     => $current_date_time,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                }
                    
                
                //update status penilaian kota
                $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_status_penilaian_kk");
                    $data_baru = array(
                        "status"  => '3'
                    );
                    $cond = array(
                       "userid"      => $userid,
                        "idkabkot"      => $kota,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();

                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  " Sukses disimpan",
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    
    function Download_excel_kota(){
        if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
        //$id = $_GET['wl'];
        $idpro = decrypt_text($_GET['wl']);
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        //$idind = decrypt_text($_GET['in']);

            //cari Provinsi
        $d_pro="SELECT I.* FROM `kabupaten` I WHERE id='$idpro'";
                $list_pro = $this->db->query($d_pro);
                foreach ($list_pro->result() as $pro){
                    $nm_wilayah   = $pro->nama_kabupaten;
                    
                }
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();
        $this->excel->getSheet(0)->setTitle('Rekap Nilai '.$nm_wilayah.'');
        
//                //cari data 
        $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor_kota` WHERE `user` ='".$user."' AND `kota`='".$idpro."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.tag='0' ";
        $list_data  = $this->db->query($status_sql);
                $excelColumn = range('A', 'ZZ');
                $index_excelColumn = 1;
                $row = $rowstart = 9;
                $row2 = $rowstart2 = 16;
                $row3 = $rowstart3 = 22;$row4 = $rowstart4 = 28;
        $row5 = $rowstart5 = 33;$row6 = $rowstart6 = 42;$row7 = $rowstart7 = 48;$row8 = $rowstart8 = 67;$row9 = $rowstart9 = 73;
        $row10 = 80;$row11 = 86;$row12 = 92;$row13 = 98;$row14 = 105; $row15 = 112; $row16 = 118; $row17 = 124; $row18 = 130; $row19 = 136;$row20 = 142;
        $row21 = 148;$row22 = 154;$row23 = 173; $row24 = 179;
                
        foreach ($list_data->result() as $value) {
            $indikatorid                = $value->indikatorid;
            if($indikatorid == '1'){ 
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row, $value->sk);
            }
            if($indikatorid == '2'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row2, $value->sk);
            }
            if($indikatorid == '3'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row3, $value->sk);
            }
            if($indikatorid == '4'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row4, $value->sk);
            }
            if($indikatorid == '5'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row5, $value->sk);
            }
            if($indikatorid == '6'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row6, $value->sk);
            }
            if($indikatorid == '7'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row7, $value->sk);
            }
            if($indikatorid == '8'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row8, $value->sk);
            }
            if($indikatorid == '9'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row9, $value->sk);
            }
            if($indikatorid == '10'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row10, $value->sk);
            }
            if($indikatorid == '11'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row11, $value->sk);
            }
            if($indikatorid == '12'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row12, $value->sk);
            }
            if($indikatorid == '13'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row13, $value->sk);
            }
            if($indikatorid == '14'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row14, $value->sk);
            }                    
            if($indikatorid == '15'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row15, $value->sk);
            }
            if($indikatorid == '16'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row16, $value->sk);
            }
            if($indikatorid == '17'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row17, $value->sk);
            }
            if($indikatorid == '18'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row18, $value->sk);
            }
            if($indikatorid == '19'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row19, $value->sk);
            }
            if($indikatorid == '20'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row20, $value->sk);
            }
            if($indikatorid == '21'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row21, $value->sk);
            }
            if($indikatorid == '22'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row22, $value->sk);
            }
            if($indikatorid == '23'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row23, $value->sk);
            }
            if($indikatorid == '24'){
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->noskor);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->item_penilaian);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->kspi_nol);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->kspi_satu);
                $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++].$row24, $value->sk);
            }
            $index_excelColumn=1;$row++;$row2++;$row3++;$row4++;$row5++;$row6++;$row7++;$row8++;$row9++;$row10++;$row11++;
            $row12++;$row13++;$row14++;$row15++;$row16++;$row17++;$row18++;$row19++;$row20++;$row21++;$row22++;$row23++;$row24++;
        }
        
        $select_r="SELECT * FROM tbl_resume_aspek_kota WHERE user = '".$user."' AND kota = '".$idpro."' ";
//        print_r($select_r);exit();
        $list_resume  = $this->db->query($select_r);
        foreach ($list_resume->result() as $resume){
            $indka = $resume->indikator;
            if($indka == '7'){
                $this->excel->getActiveSheet()->setCellValue('B115', $resume->catatan);
                $this->excel->getActiveSheet()->setCellValue('B120', $resume->masukan);
            }
            if($indka == '22'){
                $this->excel->getActiveSheet()->setCellValue('B298', $resume->catatan);
                $this->excel->getActiveSheet()->setCellValue('B303', $resume->masukan);
            }
            if($indka == '24'){
                $this->excel->getActiveSheet()->setCellValue('B348', $resume->catatan);
                $this->excel->getActiveSheet()->setCellValue('B352', $resume->masukan);
            }
        }
        ;
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

                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B7:F18');
//                $this->excel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->setCellValue('A2', "Nama Penilai");
                $this->excel->getActiveSheet()->setCellValue('C2', $this->session->userdata(SESSION_LOGIN)->name);
                $this->excel->getActiveSheet()->setCellValue('A3', "Daerah Dinilai :");
                $this->excel->getActiveSheet()->setCellValue('C3', $nm_wilayah);
                $this->excel->getActiveSheet()->getStyle('A2:C3')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->mergeCells('A2:B2');
                $this->excel->getActiveSheet()->mergeCells('A3:B3');
                
                $this->excel->getActiveSheet()->setCellValue("A4", "Kriteria Pencapaian(40%)");
                $this->excel->getActiveSheet()->setCellValue('A5', '1');
                $this->excel->getActiveSheet()->setCellValue('B5', 'Pertumbuhan Ekonomi dan Pertumbuhan PDRB per Kapita');
                $this->excel->getActiveSheet()->setCellValue("B6", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C6", "5,00%");
                
                $this->excel->getActiveSheet()->setCellValue("B7", "No");
                $this->excel->getActiveSheet()->mergeCells('B7:B8');
                $this->excel->getActiveSheet()->setCellValue("C7", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C7:C8');
                $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("35");
                 
                $this->excel->getActiveSheet()->setCellValue("D7", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D7:E7');
  //              $this->excel->getActiveSheet()->getStyle('D7:E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("18");
                $this->excel->getActiveSheet()->setCellValue("D8", "0");
                $this->excel->getActiveSheet()->setCellValue("E8", "1");
                $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("18");
                $this->excel->getActiveSheet()->setCellValue("F7", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F7:F8');
                $this->excel->getActiveSheet()->setCellValue("B18", "Jumlah Skor");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F5:F6');
                $this->excel->getActiveSheet()->setCellValue("F5", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F6", "=(SUM(F9:F17)/COUNT(B9:B17))*10");
                $this->excel->getActiveSheet()->setCellValue("F18", "=SUM(F9:F17)");
                
                $this->excel->getActiveSheet()->getStyle('B7:F4')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B18')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C9:E17')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->getStyle('B7:B17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C7:F8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F5:F18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F6')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->mergeCells('B18:E18');

                
                $this->excel->getActiveSheet()->setCellValue('A21', '2');
                $this->excel->getActiveSheet()->setCellValue('B21', 'Tingkat Pengangguran Terbuka (TPT)dan Jumlah Pengangguran');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F21:F22');
                $this->excel->getActiveSheet()->setCellValue("F21", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("B22", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C22", "6,00%");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B23:F32');
                $this->excel->getActiveSheet()->setCellValue("B23", "No");
                $this->excel->getActiveSheet()->mergeCells('B23:B24');
                $this->excel->getActiveSheet()->setCellValue("C23", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C23:C24');
                $this->excel->getActiveSheet()->setCellValue("D23", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D23:E24');
                $this->excel->getActiveSheet()->setCellValue("D24", "0");
                $this->excel->getActiveSheet()->setCellValue("E24", "1");
                $this->excel->getActiveSheet()->setCellValue("F23", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F23:F24');
                $this->excel->getActiveSheet()->setCellValue("B32", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B32:E32');
                $this->excel->getActiveSheet()->setCellValue("F32", "=SUM(F25:F31)");
                $this->excel->getActiveSheet()->setCellValue("F22", "=(SUM(F25:F31)/COUNT(B25:B31))*10");
                $this->excel->getActiveSheet()->getStyle('B23:B31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_TOP);
                $this->excel->getActiveSheet()->getStyle('B32')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C25:E31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F22')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->getStyle('C25:E31')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->getStyle('F21:F32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $this->excel->getActiveSheet()->setCellValue('A34', '3');
                $this->excel->getActiveSheet()->setCellValue('B34', 'Kemiskinan');
                $this->excel->getActiveSheet()->setCellValue("B35", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C35", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F34:F35');
                $this->excel->getActiveSheet()->setCellValue("F34", "Nilai");
                //$this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B22:F30');
                $this->excel->getActiveSheet()->setCellValue("B36", "No");
                $this->excel->getActiveSheet()->mergeCells('B36:B37');
                $this->excel->getActiveSheet()->setCellValue("C36", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C36:C37');
                $this->excel->getActiveSheet()->setCellValue("D36", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D36:E36');
                $this->excel->getActiveSheet()->setCellValue("D37", "0");
                $this->excel->getActiveSheet()->setCellValue("E37", "1");
                $this->excel->getActiveSheet()->setCellValue("F36", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F36:F37');
                $this->excel->getActiveSheet()->setCellValue("B49", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B49:E49');
                $this->excel->getActiveSheet()->setCellValue("F49", "=SUM(F37:F47)");
                
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B36:F49');
                $this->excel->getActiveSheet()->setCellValue("F35", "=(SUM(F38:F48)/COUNT(F38:F48))*10");
                $this->excel->getActiveSheet()->getStyle('F35')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A51", "4");
                $this->excel->getActiveSheet()->setCellValue('B51', 'Indeks Pembangunan Manusia (IPM)');
                $this->excel->getActiveSheet()->setCellValue("B52", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C52", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F51:F52');
                $this->excel->getActiveSheet()->setCellValue("F51", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F52", "=(SUM(F55:F68)/COUNT(F55:F68))*10");
                $this->excel->getActiveSheet()->setCellValue("B53", "No");
                $this->excel->getActiveSheet()->mergeCells('B53:B54');
                $this->excel->getActiveSheet()->setCellValue("C53", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C53:C54');
                $this->excel->getActiveSheet()->setCellValue("D53", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D53:E53');
                $this->excel->getActiveSheet()->setCellValue("D54", "0");
                $this->excel->getActiveSheet()->setCellValue("E54", "1");
                $this->excel->getActiveSheet()->setCellValue("F53", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F53:F54');
                $this->excel->getActiveSheet()->setCellValue("B70", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B70:E70');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B53:F70');
                $this->excel->getActiveSheet()->getStyle('F51')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A71", "5");
                $this->excel->getActiveSheet()->setCellValue('B71', 'Ketimpangan');
                $this->excel->getActiveSheet()->setCellValue("B72", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C72", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F71:F72');
                $this->excel->getActiveSheet()->setCellValue("F71", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F72", "=(SUM(F75:F81)/COUNT(F75:F81))*10");
                $this->excel->getActiveSheet()->setCellValue("B73", "No");
                $this->excel->getActiveSheet()->mergeCells('B73:B74');
                $this->excel->getActiveSheet()->setCellValue("C73", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C73:C74');
                $this->excel->getActiveSheet()->setCellValue("D73", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D73:E73');
                $this->excel->getActiveSheet()->setCellValue("D74", "0");
                $this->excel->getActiveSheet()->setCellValue("E74", "1");
                $this->excel->getActiveSheet()->setCellValue("F73", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F73:F74');
                $this->excel->getActiveSheet()->setCellValue("B82", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B82:E82');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B73:F82');
                $this->excel->getActiveSheet()->getStyle('F72')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A84", "6");
                $this->excel->getActiveSheet()->setCellValue('B84', 'Pelayanan Publik dan Pengelolaan Keuangan ');
                $this->excel->getActiveSheet()->setCellValue("B85", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C85", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F84:F85');
                $this->excel->getActiveSheet()->setCellValue("F84", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F85", "=(SUM(F88:F97)/COUNT(F88:F97))*10");
                $this->excel->getActiveSheet()->setCellValue("B86", "No");
                $this->excel->getActiveSheet()->mergeCells('B86:B87');
                $this->excel->getActiveSheet()->setCellValue("C86", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C86:C87');
                $this->excel->getActiveSheet()->setCellValue("D86", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D86:E86');
                $this->excel->getActiveSheet()->setCellValue("D87", "0");
                $this->excel->getActiveSheet()->setCellValue("E87", "1");
                $this->excel->getActiveSheet()->setCellValue("F86", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F86:F87');
                $this->excel->getActiveSheet()->setCellValue("B98", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B98:E98');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B86:F98');
                $this->excel->getActiveSheet()->getStyle('F85')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

                $this->excel->getActiveSheet()->setCellValue("A100", "7");
                $this->excel->getActiveSheet()->setCellValue('B100', 'Transparansi dan Akuntabilitas');
                $this->excel->getActiveSheet()->setCellValue("B101", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C101", "8,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F100:F101');
                $this->excel->getActiveSheet()->setCellValue("F100", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F101", "=(SUM(F104:F110)/COUNT(F104:F110))*10");
                $this->excel->getActiveSheet()->setCellValue("B102", "No");
                $this->excel->getActiveSheet()->mergeCells('B102:B103');
                $this->excel->getActiveSheet()->setCellValue("C102", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C102:C103');
                $this->excel->getActiveSheet()->setCellValue("D102", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D102:E102');
                $this->excel->getActiveSheet()->setCellValue("D103", "0");
                $this->excel->getActiveSheet()->setCellValue("E103", "1");
                $this->excel->getActiveSheet()->setCellValue("F102", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F102:F103');
                $this->excel->getActiveSheet()->setCellValue("B111", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B111:E111');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B102:F111');
                $this->excel->getActiveSheet()->getStyle('F101')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B113', 'Resume Aspek Pencapaian Pembangunan ');
                $this->excel->getActiveSheet()->setCellValue("B114", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B115:F118');
                $this->excel->getActiveSheet()->setCellValue('B119', 'Masukan dan Saran terhadap Aspek Pencapaian Pembangunan');
                $this->excel->getActiveSheet()->mergeCells('B120:F123');
                //
                $this->excel->getActiveSheet()->setCellValue("A125", "Kriteria Keterkaitan (5%)");
                $this->excel->getActiveSheet()->setCellValue("A126", "8");
                $this->excel->getActiveSheet()->setCellValue('B126', 'Tersedianya Penjelasan Strategi dan Arah Kebijakan RKPD 2020 yang Terkait dengan Visi dan Misi, Strategi dan Arah Kebijakan RPJMD');
                $this->excel->getActiveSheet()->setCellValue("B127", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C127", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F126:F127');
                $this->excel->getActiveSheet()->setCellValue("F126", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F127", "=(SUM(F130:F134)/COUNT(F130:F134))*10");
                $this->excel->getActiveSheet()->setCellValue("B128", "No");
                $this->excel->getActiveSheet()->mergeCells('B128:B129');
                $this->excel->getActiveSheet()->setCellValue("C128", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C128:C129');
                $this->excel->getActiveSheet()->setCellValue("D128", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D128:E128');
                $this->excel->getActiveSheet()->setCellValue("D129", "0");
                $this->excel->getActiveSheet()->setCellValue("E129", "1");
                $this->excel->getActiveSheet()->setCellValue("F128", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F128:F129');
                $this->excel->getActiveSheet()->setCellValue("B135", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B135:E135');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B128:F135');
                $this->excel->getActiveSheet()->getStyle('F127')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->mergeCells('B126:E126');
                $this->excel->getActiveSheet()->getStyle('B126')->getAlignment()->setWrapText(true);
                
                                $this->excel->getActiveSheet()->setCellValue("A137", "9");
                $this->excel->getActiveSheet()->setCellValue('B137', 'Tersedianya Penjelasan Keterkaitan antara Sasaran dan Prioritas Pembangunan Daerah dalam RKPD 2020 dengan Sasaran Prioritas Nasional (PN) RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B138", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C138", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F137:F138');
                $this->excel->getActiveSheet()->setCellValue("F137", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F138", "=(SUM(F141:F146)/COUNT(F141:F146))*10");
                $this->excel->getActiveSheet()->setCellValue("B139", "No");
                $this->excel->getActiveSheet()->mergeCells('B139:B140');
                $this->excel->getActiveSheet()->setCellValue("C139", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C139:C140');
                $this->excel->getActiveSheet()->setCellValue("D139", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D139:E139');
                $this->excel->getActiveSheet()->setCellValue("D140", "0");
                $this->excel->getActiveSheet()->setCellValue("E140", "1");
                $this->excel->getActiveSheet()->setCellValue("F139", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F139:F140');
                $this->excel->getActiveSheet()->setCellValue("B147", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B147:E147');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B139:F147');
                $this->excel->getActiveSheet()->getStyle('F138')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                $this->excel->getActiveSheet()->getStyle('B137')->getAlignment()->setWrapText(true);
                $this->excel->getActiveSheet()->mergeCells('B137:E137');
                
                $this->excel->getActiveSheet()->setCellValue("A149", "Kriteria Konsistensi (11,25%)");
                                $this->excel->getActiveSheet()->setCellValue("A150", "10");
                $this->excel->getActiveSheet()->setCellValue('B150', 'Terwujudnya Konsistensi antara Hasil Evaluasi Pelaksanaan RKPD 2018 dengan Permasalahan dan Isu Strategis pada RKPD 2020');
                $this->excel->getActiveSheet()->setCellValue("B151", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C151", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F150:F151');
                $this->excel->getActiveSheet()->setCellValue("F150", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F151", "=(SUM(F154:F159)/COUNT(F154:F159))*10");
                $this->excel->getActiveSheet()->setCellValue("B152", "No");
                $this->excel->getActiveSheet()->mergeCells('B152:B153');
                $this->excel->getActiveSheet()->setCellValue("C152", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C152:C153');
                $this->excel->getActiveSheet()->setCellValue("D152", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D152:E152');
                $this->excel->getActiveSheet()->setCellValue("D153", "0");
                $this->excel->getActiveSheet()->setCellValue("E153", "1");
                $this->excel->getActiveSheet()->setCellValue("F152", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F152:F153');
                $this->excel->getActiveSheet()->setCellValue("B160", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B160:E160');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B152:F160');
                $this->excel->getActiveSheet()->getStyle('F151')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A162", "11");
                $this->excel->getActiveSheet()->setCellValue('B162', 'Terwujudnya Konsistensi antara Prioritas Pembangunan Daerah dengan Permasalahan/Isu Strategis pada RKPD 2020');
                $this->excel->getActiveSheet()->setCellValue("B163", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C163", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F162:F163');
                $this->excel->getActiveSheet()->setCellValue("F162", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F163", "=(SUM(F166:F168)/COUNT(F166:F168))*10");
                $this->excel->getActiveSheet()->setCellValue("B164", "No");
                $this->excel->getActiveSheet()->mergeCells('B164:B165');
                $this->excel->getActiveSheet()->setCellValue("C164", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C164:C165');
                $this->excel->getActiveSheet()->setCellValue("D164", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D164:E164');
                $this->excel->getActiveSheet()->setCellValue("D165", "0");
                $this->excel->getActiveSheet()->setCellValue("E165", "1");
                $this->excel->getActiveSheet()->setCellValue("F164", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F164:F165');
                $this->excel->getActiveSheet()->setCellValue("B169", "Jumlah Skor");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B164:F169');
                $this->excel->getActiveSheet()->getStyle('F163')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A171", "12");
                $this->excel->getActiveSheet()->setCellValue('B171', 'Terwujudnya Konsistensi antara Prioritas Pembangunan Daerah dalam RKPD 2020 dengan Program Prioritas');
                $this->excel->getActiveSheet()->setCellValue("B172", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C172", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F171:F172');
                $this->excel->getActiveSheet()->setCellValue("F171", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F172", "=(SUM(F175:F180)/COUNT(F175:F180))*10");
                $this->excel->getActiveSheet()->setCellValue("B173", "No");
                $this->excel->getActiveSheet()->mergeCells('B173:B174');
                $this->excel->getActiveSheet()->setCellValue("C173", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C173:C174');
                $this->excel->getActiveSheet()->setCellValue("D173", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D173:E173');
                $this->excel->getActiveSheet()->setCellValue("D174", "0");
                $this->excel->getActiveSheet()->setCellValue("E174", "1");
                $this->excel->getActiveSheet()->setCellValue("F173", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F173:F174');
                $this->excel->getActiveSheet()->setCellValue("B181", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B181:E181');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B173:F181');
                $this->excel->getActiveSheet()->getStyle('F172')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A183", "13");
                $this->excel->getActiveSheet()->setCellValue('B183', 'Terwujudnya Konsistensi antara Prioritas Pembangunan dalam RKPD 2020 dengan Pagu Anggaran');
                $this->excel->getActiveSheet()->setCellValue("B184", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C184", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F183:F184');
                $this->excel->getActiveSheet()->setCellValue("F183", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F184", "=(SUM(F187:F189)/COUNT(F187:F189))*10");
                $this->excel->getActiveSheet()->setCellValue("B185", "No");
                $this->excel->getActiveSheet()->mergeCells('B185:B186');
                $this->excel->getActiveSheet()->setCellValue("C185", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C185:C186');
                $this->excel->getActiveSheet()->setCellValue("D185", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D185:E185');
                $this->excel->getActiveSheet()->setCellValue("D186", "0");
                $this->excel->getActiveSheet()->setCellValue("E186", "1");
                $this->excel->getActiveSheet()->setCellValue("F185", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F185:F186');
                $this->excel->getActiveSheet()->setCellValue("B190", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B190:E190');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B185:F190');
                $this->excel->getActiveSheet()->getStyle('F184')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A192", "Kriteria Kelengkapan dan Kedalaman (23,75%)");
                $this->excel->getActiveSheet()->setCellValue("A193", "14");
                $this->excel->getActiveSheet()->setCellValue('B193', 'Tersedianya Kerangka Ekonomi dan Kerangka Pendanaan dang Dilengkapi dengan Proyeksi dan Arah Kebijakan');
                $this->excel->getActiveSheet()->setCellValue("B194", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C194", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F193:F94');
                $this->excel->getActiveSheet()->setCellValue("F193", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F194", "=(SUM(F197:F202)/COUNT(F197:F202))*10");
                $this->excel->getActiveSheet()->setCellValue("B195", "No");
                $this->excel->getActiveSheet()->mergeCells('B195:B196');
                $this->excel->getActiveSheet()->setCellValue("C195", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C195:C196');
                $this->excel->getActiveSheet()->setCellValue("D195", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D195:E195');
                $this->excel->getActiveSheet()->setCellValue("D196", "0");
                $this->excel->getActiveSheet()->setCellValue("E196", "1");
                $this->excel->getActiveSheet()->setCellValue("F195", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F195:F196');
                $this->excel->getActiveSheet()->setCellValue("B203", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B203:E203');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B195:F203');
                $this->excel->getActiveSheet()->getStyle('F194')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A205", "15");
                $this->excel->getActiveSheet()->setCellValue('B205', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Pembangunan Manusia dan Pengentasan Kemiskinan RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B206", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C206", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F205:F206');
                $this->excel->getActiveSheet()->setCellValue("F205", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F206", "=(SUM(F209:F211)/COUNT(F209:F211))*10");
                $this->excel->getActiveSheet()->setCellValue("B207", "No");
                $this->excel->getActiveSheet()->mergeCells('B207:B208');
                $this->excel->getActiveSheet()->setCellValue("C207", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C207:C208');
                $this->excel->getActiveSheet()->setCellValue("D207", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D207:E207');
                $this->excel->getActiveSheet()->setCellValue("D208", "0");
                $this->excel->getActiveSheet()->setCellValue("E208", "1");
                $this->excel->getActiveSheet()->setCellValue("F207", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F207:F208');
                $this->excel->getActiveSheet()->setCellValue("B212", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B212:E212');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B207:F212');
                $this->excel->getActiveSheet()->getStyle('F206')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A214", "16");
                $this->excel->getActiveSheet()->setCellValue('B214', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Infrastruktur dan Pemerataan Wilayah RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B215", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C215", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F214:F215');
                $this->excel->getActiveSheet()->setCellValue("F214", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F215", "=(SUM(F218:F220)/COUNT(F218:F220))*10");
                $this->excel->getActiveSheet()->setCellValue("B216", "No");
                $this->excel->getActiveSheet()->mergeCells('B216:B217');
                $this->excel->getActiveSheet()->setCellValue("C216", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C216:C217');
                $this->excel->getActiveSheet()->setCellValue("D216", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D216:E216');
                $this->excel->getActiveSheet()->setCellValue("D217", "0");
                $this->excel->getActiveSheet()->setCellValue("E217", "1");
                $this->excel->getActiveSheet()->setCellValue("F216", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F216:F217');
                $this->excel->getActiveSheet()->setCellValue("B221", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B221:E221');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B216:F221');
                $this->excel->getActiveSheet()->getStyle('F215')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A223", "17");
                $this->excel->getActiveSheet()->setCellValue('B223', 'Tersedianya Dukungan Program Prioritas daerah RKPD 2020 terhadap Kegiatan Prioritas pada PN Nilai Tambah Sektor Riil, Industrialisasi dan Kesempatan Kerja RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B224", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C224", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F223:F224');
                $this->excel->getActiveSheet()->setCellValue("F223", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F224", "=(SUM(F227:F229)/COUNT(F227:F229))*10");
                $this->excel->getActiveSheet()->setCellValue("B225", "No");
                $this->excel->getActiveSheet()->mergeCells('B225:B226');
                $this->excel->getActiveSheet()->setCellValue("C225", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C225:C226');
                $this->excel->getActiveSheet()->setCellValue("D225", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D225:E225');
                $this->excel->getActiveSheet()->setCellValue("D226", "0");
                $this->excel->getActiveSheet()->setCellValue("E226", "1");
                $this->excel->getActiveSheet()->setCellValue("F225", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F225:F226');
                $this->excel->getActiveSheet()->setCellValue("B230", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B230:E230');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B225:F230');
                $this->excel->getActiveSheet()->getStyle('F224')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A232", "18");
                $this->excel->getActiveSheet()->setCellValue('B232', 'Tersedianya Dukungan Program Prioritas Daerah RKPD 2020 terhadap Kegiatan Prioritas PN Ketahanan Pangan, Air, Energi dan Lingkungan Hidup RKP 2020');
                $this->excel->getActiveSheet()->setCellValue("B233", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C233", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F232:F233');
                $this->excel->getActiveSheet()->setCellValue("F232", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F233", "=(SUM(F236:F238)/COUNT(F236:F238))*10");
                $this->excel->getActiveSheet()->setCellValue("B234", "No");
                $this->excel->getActiveSheet()->mergeCells('B234:B235');
                $this->excel->getActiveSheet()->setCellValue("C234", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C234:C235');
                $this->excel->getActiveSheet()->setCellValue("D234", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D234:E234');
                $this->excel->getActiveSheet()->setCellValue("D235", "0");
                $this->excel->getActiveSheet()->setCellValue("E235", "1");
                $this->excel->getActiveSheet()->setCellValue("F234", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F234:F235');
                $this->excel->getActiveSheet()->setCellValue("B239", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B239:E239');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B234:F239');
                $this->excel->getActiveSheet()->getStyle('F233')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A241", "19");
                $this->excel->getActiveSheet()->setCellValue('B241', 'Tersedianya Dukungan Program Daerah RKPD 2020 terhadap Arah Kebijakan Pengarusutamaan Pembangunan Berkelanjutan, Tata Kelola Pemerintahan yang Baik, Gender, Modal Sosial Budaya dan Transformasi Digital');
                $this->excel->getActiveSheet()->setCellValue("B242", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C242", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F241:F242');
                $this->excel->getActiveSheet()->setCellValue("F241", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F242", "=(SUM(F245:F259)/COUNT(F245:F259))*10");
                $this->excel->getActiveSheet()->setCellValue("B243", "No");
                $this->excel->getActiveSheet()->mergeCells('B243:B244');
                $this->excel->getActiveSheet()->setCellValue("C243", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C243:C244');
                $this->excel->getActiveSheet()->setCellValue("D243", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D243:E243');
                $this->excel->getActiveSheet()->setCellValue("D244", "0");
                $this->excel->getActiveSheet()->setCellValue("E244", "1");
                $this->excel->getActiveSheet()->setCellValue("F243", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F243:F244');
                $this->excel->getActiveSheet()->setCellValue("B260", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B260:E260');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B243:F260');
                $this->excel->getActiveSheet()->getStyle('F242')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A262", "20");
                $this->excel->getActiveSheet()->setCellValue('B262', 'Tersedianya dukungan program daerah RKPD 2020 terhadap arah kebijakan Pembangunan Lintas Bidang Kerentanan Bencana dan Perubahan Iklim');
                $this->excel->getActiveSheet()->setCellValue("B263", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C263", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F262:F263');
                $this->excel->getActiveSheet()->setCellValue("F262", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F263", "=(SUM(F266:F271)/COUNT(F266:F271))*10");
                $this->excel->getActiveSheet()->setCellValue("B264", "No");
                $this->excel->getActiveSheet()->mergeCells('B264:B265');
                $this->excel->getActiveSheet()->setCellValue("C264", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C264:C265');
                $this->excel->getActiveSheet()->setCellValue("D264", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D264:E264');
                $this->excel->getActiveSheet()->setCellValue("D265", "0");
                $this->excel->getActiveSheet()->setCellValue("E265", "1");
                $this->excel->getActiveSheet()->setCellValue("F264", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F264:F265');
                $this->excel->getActiveSheet()->setCellValue("B272", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B272:E272');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B264:F272');
                $this->excel->getActiveSheet()->getStyle('F263')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

                $this->excel->getActiveSheet()->setCellValue("A274", "21");
                $this->excel->getActiveSheet()->setCellValue('B274', 'Tersedianya kebijakan pembangunan daerah RKPD 2020 yang menerapkan konsep Tematik, Holistik, Integratif, dan Spasial (THIS)');
                $this->excel->getActiveSheet()->setCellValue("B275", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C275", "2,50%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F274:F275');
                $this->excel->getActiveSheet()->setCellValue("F274", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F275", "=(SUM(F278:F282)/COUNT(F278:F282))*10");
                $this->excel->getActiveSheet()->setCellValue("B276", "No");
                $this->excel->getActiveSheet()->mergeCells('B276:B277');
                $this->excel->getActiveSheet()->setCellValue("C276", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C276:C277');
                $this->excel->getActiveSheet()->setCellValue("D276", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D276:E276');
                $this->excel->getActiveSheet()->setCellValue("D277", "0");
                $this->excel->getActiveSheet()->setCellValue("E277", "1");
                $this->excel->getActiveSheet()->setCellValue("F276", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F276:F277');
                $this->excel->getActiveSheet()->setCellValue("B283", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B283:E283');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B276:F283');  
                $this->excel->getActiveSheet()->getStyle('F275')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A285", "22");
                $this->excel->getActiveSheet()->setCellValue('B285', 'Tersedianya indikator kinerja sasaran pembangunan daerah dan program prioritas');
                $this->excel->getActiveSheet()->setCellValue("B286", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C286", "3,75%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F285:F286');
                $this->excel->getActiveSheet()->setCellValue("F285", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F286", "=(SUM(F289:F293)/COUNT(F289:F293))*10");
                $this->excel->getActiveSheet()->setCellValue("B287", "No");
                $this->excel->getActiveSheet()->mergeCells('B287:B288');
                $this->excel->getActiveSheet()->setCellValue("C287", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C287:C288');
                $this->excel->getActiveSheet()->setCellValue("D287", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D287:E287');
                $this->excel->getActiveSheet()->setCellValue("D288", "0");
                $this->excel->getActiveSheet()->setCellValue("E288", "1");
                $this->excel->getActiveSheet()->setCellValue("F287", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F287:F288');
                $this->excel->getActiveSheet()->setCellValue("B294", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B294:E294');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B287:F294'); 
                $this->excel->getActiveSheet()->getStyle('F286')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B296', 'Resume Aspek Kualitas Dokumen RKPD');
                $this->excel->getActiveSheet()->setCellValue("B297", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B298:F301');
                $this->excel->getActiveSheet()->setCellValue('B302', 'Masukan dan Saran terhadap Aspek Kualitas Dokumen RKPD');
                $this->excel->getActiveSheet()->mergeCells('B303:F306');
                
                $this->excel->getActiveSheet()->setCellValue("A308", "Kriteria Inovasi (20%)");
                $this->excel->getActiveSheet()->setCellValue("A309", "23");
                $this->excel->getActiveSheet()->setCellValue('B309', 'Indikator kelengkapan dokumen Inovasi daerah');
                $this->excel->getActiveSheet()->setCellValue("B310", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C310", "5,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F309:F310');
                $this->excel->getActiveSheet()->setCellValue("F309", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F310", "=(SUM(F313:F321)/COUNT(F313:F321))*10");
                $this->excel->getActiveSheet()->setCellValue("B311", "No");
                $this->excel->getActiveSheet()->mergeCells('B311:B312');
                $this->excel->getActiveSheet()->setCellValue("C311", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C311:C312');
                $this->excel->getActiveSheet()->setCellValue("D311", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D311:E311');
                $this->excel->getActiveSheet()->setCellValue("D312", "0");
                $this->excel->getActiveSheet()->setCellValue("E312", "1");
                $this->excel->getActiveSheet()->setCellValue("F311", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F311:F312');
                $this->excel->getActiveSheet()->setCellValue("B322", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B322:E322');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B311:F322');                
                $this->excel->getActiveSheet()->getStyle('F310')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue("A324", "24");
                $this->excel->getActiveSheet()->setCellValue('B324', 'Indikator kedalaman inovasi daerah');
                $this->excel->getActiveSheet()->setCellValue("B325", "Bobot");
                $this->excel->getActiveSheet()->setCellValue("C325", "15,00%");
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'F324:F325');
                $this->excel->getActiveSheet()->setCellValue("F324", "Nilai");
                $this->excel->getActiveSheet()->setCellValue("F325", "=(SUM(F328:F343)/COUNT(F328:F343))*10");
                $this->excel->getActiveSheet()->setCellValue("B326", "No");
                $this->excel->getActiveSheet()->mergeCells('B326:B327');
                $this->excel->getActiveSheet()->setCellValue("C326", "Item Penilaian");
                $this->excel->getActiveSheet()->mergeCells('C326:C327');
                $this->excel->getActiveSheet()->setCellValue("D326", "Kategori Skor per Item");
                $this->excel->getActiveSheet()->mergeCells('D326:E326');
                $this->excel->getActiveSheet()->setCellValue("D327", "0");
                $this->excel->getActiveSheet()->setCellValue("E327", "1");
                $this->excel->getActiveSheet()->setCellValue("F326", "Skor");
                $this->excel->getActiveSheet()->mergeCells('F326:F327');
                $this->excel->getActiveSheet()->setCellValue("B344", "Jumlah Skor");
                $this->excel->getActiveSheet()->mergeCells('B344:E344');
                $this->excel->getActiveSheet()->setSharedStyle($sharedStyleTitles, 'B326:F344');                
                $this->excel->getActiveSheet()->getStyle('F325')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
                
                $this->excel->getActiveSheet()->setCellValue('B346', 'Resume Aspek Inovasi');
                $this->excel->getActiveSheet()->setCellValue("B347", "Catatan");
                $this->excel->getActiveSheet()->mergeCells('B348:F350');
                $this->excel->getActiveSheet()->setCellValue('B351', 'Masukan dan Saran terhadap Aspek Inovasi');
                $this->excel->getActiveSheet()->mergeCells('B352:F355');
                
                //$this->excel->getActiveSheet()->mergeCells('D4:Q4');
                $this->excel->getActiveSheet()->getProtection()->setSheet(true);
                $this->excel->getActiveSheet()->getProtection()->setSort(true);
                $this->excel->getActiveSheet()->getProtection()->setInsertRows(true);
                $this->excel->getActiveSheet()->getProtection()->setFormatCells(true);
                $this->excel->getActiveSheet()->getProtection()->setPassword('sk9');
                
                header("Content-Type:application/vnd.ms-excel");
                header("Content-Disposition:attachment;filename = Module1_penilaian_dokumen_.xls");
                header("Cache-Control:max-age=0");
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save("php://output");   
    }


    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function detail_kategori_skor(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                    $user=$this->session->userdata(SESSION_LOGIN)->id;
                $id = decrypt_text($this->input->post("id"));      
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!");
                $iddaerah = decrypt_text($this->input->post("iddaerah"));
                $query="";
                $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.indikatorid='".$id."'";
               // print_r($status_sql);exit();
                    $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";             
                $no=1;
                $sub=3;
               
                foreach ($list_data_i2->result() as $r_ti2) {
                                      
                        $sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->item_penilaian."</a></td>";
                        //$content.="<td style='font-size: 11px'><a class='klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0'>".$r_ti2->kspi_nol."</a></td>";
//                        $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                                              //             . "<a class='btn btn-xs btn-outline-warning waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lenkapi Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a>";
//                        $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                        if($r_ti2->sk==''){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }
                        elseif($r_ti2->sk=='0'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }
                        elseif($r_ti2->sk=='1'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }                        
                        $content.="</tr>";                    
                     }
                        $sum1=0;$count=0;$Nilai1=0;$Nilai=0;
                       //jumlah skor
                     //jumlahkan hasil penilaian
//                     $select_sum="SELECT id, SUM(skor) AS JML FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."' AND `kat_skor`='".$id."'";
//                     $list_sum  = $this->db->query($select_sum);
//                     foreach ($list_sum->result() as $r_sum) {
//                         $sum1=$r_sum->JML;
//                     }
//                     $sum=$sum1;
//                      print_r($select_sum);exit();
//                     //count jumlah item indikator
//                     $select_count="SELECT indikatorid, COUNT(id) AS JM FROM `tbl_kategori_skor` WHERE indikatorid='".$id."'";
//                     $list_count  = $this->db->query($select_count);
//                     foreach ($list_count->result() as $r_count) {
//                         $count1=$r_count->JM;
//                     }
//                     $count=$count1;
//                     //sum/count*10    
//                     $Nilai1=($sum/$count)*10;
//                     $Nilai=number_format($Nilai1,2);
                $queryTotal="SELECT NS.*, TNS.JML, CNS.JM, ((TNS.JML/CNS.JM)*10) AS hasil   FROM `tbl_nilai_skor` NS
                             LEFT JOIN (SELECT id, SUM(skor) AS JML FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."' AND `kat_skor`='".$id."') TNS ON TNS.`id` = NS.id
                             LEFT JOIN (SELECT indikatorid, COUNT(id) AS JM FROM `tbl_kategori_skor` WHERE indikatorid='".$id."') CNS ON CNS.`indikatorid` = NS.id
                             WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."' GROUP BY `user`";
//               
                $list_total  = $this->db->query($queryTotal);
                foreach ($list_total->result() as $t_nilai) {
                    $Nilai1=$t_nilai->hasil;
                }
                $Nilai=number_format($Nilai1,2);
               
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success get data",
                    "table_ktg_skor"=>  $content,
                    "total"         => $Nilai,
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
        }
        else{exit("Access Denied");}
    }
    
    function pilih_skor(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                $this->form_validation->set_rules('indkno','ID No','required');
                $this->form_validation->set_rules('nilai','Nilai','required');
                $this->form_validation->set_rules('idin','Id Indikator','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $user=$this->session->userdata(SESSION_LOGIN)->id;
                $id = decrypt_text($this->input->post("id"));      
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!");
                $iddaerah = decrypt_text($this->input->post("iddaerah"));
                $nilai = $this->input->post("nilai");
                $noind = $this->input->post("indkno");
                $idin = $this->input->post("idin");
                
                 //cek status penilaian Indikator
        $select_s_p="SELECT * FROM `tbl_sp_tbl_indikator` "
                . "WHERE user='".$this->session->userdata(SESSION_LOGIN)->id."' "
                . "AND provinsi='$iddaerah' AND indikator='$idin'";
                    $list_sp  = $this->db->query($select_s_p);
                     if($list_sp->num_rows() == 0){
                         $this->db->trans_begin();
                         $this->m_ref->setTableName("tbl_sp_tbl_indikator");
                        $data_baru = array(
                            "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                            "provinsi"      => $iddaerah,
                            "indikator"      => $idin,
                            "status"      => '1',
                        );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                    $this->db->trans_commit();
                    
                     } else {
                         //status penilaian pr
                        $this->db->trans_begin();
                        $this->m_ref->setTableName("tbl_sp_tbl_indikator");
                        $data_baru = array(
                            "status"      => '2',
                        );
                        $cond = array(
                        "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                            "provinsi"      => $iddaerah,
                            "indikator"      => $idin,
                        );
                        $status_save = $this->m_ref->update($cond,$data_baru);
                        if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                        $this->db->trans_commit();
                        
                     }
                
                //select max
                $select_max="SELECT MAX(noskor) AS nomax FROM `tbl_kategori_skor` WHERE indikatorid='$noind'";
                $list_max  = $this->db->query($select_max);
                foreach ($list_max->result() as $r_max) {
                    $nomax=$r_max->nomax;
                }
                
                if($noind == $nomax){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_status_penilaian");
                    $data_baru = array(
                        "status"      => '2',
                    );
                    $cond = array(
                        "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                        "provid"  => $iddaerah,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                    $this->db->trans_commit();
                
                    
                }else{
                    //cek status penilaian provinsi
                    $select_s_p="SELECT * FROM `tbl_status_penilaian` WHERE userid='".$this->session->userdata(SESSION_LOGIN)->id."' AND provid='$iddaerah'";
                    $list_sp  = $this->db->query($select_s_p);
                     if($list_sp->num_rows() == 0){
                         $this->db->trans_begin();
                         $this->m_ref->setTableName("tbl_status_penilaian");
                        $data_baru = array(
                            "userid"      => $this->session->userdata(SESSION_LOGIN)->id,
                            "provid"      => $iddaerah,
                            "status"      => '1',
                        );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                    $this->db->trans_commit();
                    
                     } else {
                         //status penilaian pr
                        $this->db->trans_begin();
                        $this->m_ref->setTableName("tbl_status_penilaian");
                        $data_baru = array(
                            "status"      => '1',
                        );
                        $cond = array(
                            "userid"  => $this->session->userdata(SESSION_LOGIN)->id,
                            "provid"  => $iddaerah,
                        );
                        $status_save = $this->m_ref->update($cond,$data_baru);
                        if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                        $this->db->trans_commit();
                        
                     }
                    
                    
                }
                //CHECK DATA
                $this->m_ref->setTableName("tbl_nilai_skor");
                $select = array();
                $cond = array(
                    "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                    "provinsi"  => $iddaerah,
                    "kat_skor"        => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_nilai_skor");
                    $data_baru = array(
                        "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                        "provinsi"      => $iddaerah,
                        "kat_skor"        => $id,
                        "skor"      => $nilai,
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                    $this->db->trans_commit();
                   // $pesan='Sukses Insert Data';
                }
                else {
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_nilai_skor");
                    $data_baru = array(
                        "skor"      => $nilai,
                    );
                    $cond = array(
                        "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                        "provinsi"  => $iddaerah,
                        "kat_skor"  => $id,
                        
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                    $this->db->trans_commit();
                   // $pesan='Sukses Update Data';
                    

                 }
                 //jumlah skor
                $queryTotal="SELECT NS.*, TNS.JML, CNS.JM, ((TNS.JML/CNS.JM)*10) AS hasil   FROM `tbl_nilai_skor` NS
                             LEFT JOIN (SELECT id, SUM(skor) AS JML FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."') TNS ON TNS.`id` = NS.id
                             LEFT JOIN (SELECT id, COUNT(skor) AS JM FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."') CNS ON CNS.`id` = NS.id
                             WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."' GROUP BY `user`";
                $list_total  = $this->db->query($queryTotal);
                foreach ($list_total->result() as $t_nilai) {
                    $Nilai1=$t_nilai->hasil;
                }
                $Nilai=number_format($Nilai1,2);
                $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.indikatorid='".$idin."'";
                //print_r($status_sql);exit();
                    $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";             
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->item_penilaian."</a></td>";
//                        $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                        //$content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                        if($r_ti2->sk==''){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                                                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }
                        elseif($r_ti2->sk=='0'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }
                        elseif($r_ti2->sk=='1'){
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                            $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning waves-effect waves-light klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";
                        }                          
                        $content.="</tr>";
                }
                //$content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."' title='Isi Nilai'><h5 class='text-danger font-16 m-0'>Belum Lengkap</h5></a></td>";
                        
                //sukses
                $output = array(
                    "status"         => 1,
                    "csrf_hash"      => $this->security->get_csrf_hash(),
                    "msg"            => "success get data",
                    "table_ktg_skor" => $content,
                    "nilai"          => $Nilai,
                );
                exit(json_encode($output));
            } catch (Exception $exc)  {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage(),
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    function hasil_penilaian(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                    $user=$this->session->userdata(SESSION_LOGIN)->id;
                $id = decrypt_text($this->input->post("id"));      
                //print_r($id);exit();
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!");
                $iddaerah = decrypt_text($this->input->post("iddaerah"));
                
                                        $nilai ="
                                                <div class=\"radio \">
                                                            <input type=\"radio\" id=\"noskor\" value='0' name=\"noskor\" >
                                                            <label for=\"inlineRadio1\"></label>
                                                </div>
                                            
                                                <div class=\"radio \">
                                                    <input type=\"radio\" id=\"noskor\" value='1' name=\"noskor\">
                                                    <label for=\"inlineRadio2\"></label>
                                                </div>    
                                            ";
                $query="";
                $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.id='".$id."'";
               // print_r($status_sql);exit();
                    $list_data_i2  = $this->db->query($status_sql);
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                    $noskor=$r_ti2->noskor;
                    $item  =$r_ti2->item_penilaian;
                    $sk  =$r_ti2->sk;
                    $nol  =$r_ti2->kspi_nol;
                    $satu =$r_ti2->kspi_satu;
                    if($r_ti2->sk==''){
                        $nilai  ="<div class=\"radio\">
                                                    <input type=\"radio\" name=\"radio1\" id=\"radio1\" value=\"0\" >
                                                    <label for=\"radio1\">
                                                        0. ".$nol."
                                                    </label>
                                                </div>
                                                <div class=\"radio\">
                                                    <input type=\"radio\" name=\"radio1\" id=\"radio2\" value=\"1\">
                                                    <label for=\"radio2\">
                                                        1. ".$satu."
                                                    </label>
                                                </div>";
                    }
                    if($r_ti2->sk=='0'){
                        $nilai  ="<div class=\"radio\">
                                                    <input type=\"radio\" name=\"radio1\" id=\"radio1\" value=\"0\" checked='checked'>
                                                    <label for=\"radio1\">
                                                        0. ".$nol."
                                                    </label>
                                                </div>
                                                <div class=\"radio\">
                                                    <input type=\"radio\" name=\"radio1\" id=\"radio2\" value=\"1\">
                                                    <label for=\"radio2\">
                                                        1. ".$satu."
                                                    </label>
                                                </div>";                        
                    }
                    if($r_ti2->sk=='1'){
                        $nilai  ="<div class=\"radio\">
                                                    <input type=\"radio\" name=\"radio1\" id=\"radio1\" value=\"0\" >
                                                    <label for=\"radio1\">
                                                        0. ".$nol."
                                                    </label>
                                                </div>
                                                <div class=\"radio\">
                                                    <input type=\"radio\" name=\"radio1\" id=\"radio2\" value=\"1\" checked='checked'>
                                                    <label for=\"radio2\">
                                                        1. ".$satu."
                                                    </label>
                                                </div>";                        
                    }
                                             

                }
                        
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
                    "soal"    =>  $noskor.''.$item,
                    "sk"    =>  $sk,
                    "skor"    =>  $nilai,
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
        }
        else{exit("Access Denied");}
    }  
    
    public function nilai_skor()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                //$this->form_validation->set_rules('id','id','required|xss_clean');
                $this->form_validation->set_rules('daerah','Id Wilayah','required|xss_clean');
                $this->form_validation->set_rules('nomor','tbl Kategori skor','required|xss_clean');
                $this->form_validation->set_rules('radio1','Skor','required|xss_clean');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $id = decrypt_text($this->input->post("daerah"));
                //print_r($id);exit();
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!",0);
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                $nomor = $this->input->post("nomor");
                //CHECK DATA
                $this->m_ref->setTableName("tbl_nilai_skor");
                $select = array();
                $cond = array(
                    "user"  => $id,
                    "provinsi"  => $this->session->userdata(SESSION_LOGIN)->id,
                    "kat_skor"        => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){
                                         $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_nilai_skor");
                    $data_baru = array(
                        "user"      => $this->session->userdata(SESSION_LOGIN)->id,
                        "provinsi"      => $id,
                        "kat_skor"        => $nomor,
                        "skor"      => $this->input->post("radio1")?'0':'1',
                      );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                    $this->db->trans_commit();
                    $pesan='Sukses Insert Data';
                }
                else {
                    $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_nilai_skor");
                    $data_baru = array(
                        "skor"      => $tgl,
                    );
                    $cond = array(
                        "user"  => $this->session->userdata(SESSION_LOGIN)->id,
                        "provinsi"  => $id,
                        "kat_skor"  => $nomor,
                        "skor"      => $this->input->post("radio1")?'0':'1',
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}

                    $this->db->trans_commit();
                    $pesan='Sukses Update Data';
                    

                 }
              
                
                
                
                
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "msg"       =>  $pesan,
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }

//
    function detail_kategori_skor4(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                $this->form_validation->set_rules('iddaerah','ID Daerah','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                    $user=$this->session->userdata(SESSION_LOGIN)->id;
                $id = decrypt_text($this->input->post("id"));      
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!");
                $iddaerah = decrypt_text($this->input->post("iddaerah"));
                //cek sub indikator
                $query="SELECT * FROM `tbl_sub_kategori` WHERE `idindikator` = '".$id."'";
                print_r($query);exit();
                
                $status_sql="SELECT KS.*, NS.`skor` as sk 
                        FROM `tbl_kategori_skor` KS
                        LEFT JOIN (SELECT * FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."'  GROUP BY `kat_skor`) NS ON NS.`kat_skor` = KS.id
                        WHERE KS.indikatorid='".$id."'";
               // print_r($status_sql);exit();
                    $list_data_i2  = $this->db->query($status_sql);
                    
                $content = "";             
                $no=1;
                $sub=3;
               
                foreach ($list_data_i2->result() as $r_ti2) {
                                        
                    if($r_ti2->sub_kategori_skor=='0'){
                        $sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->item_penilaian."</a></td>";
                        //$content.="<td style='font-size: 11px'><a class='klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0'>".$r_ti2->kspi_nol."</a></td>";
                        $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                        $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                        if($r_ti2->sk!=''){
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";                        
                        }
                        else{
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }                        
                        $content.="</tr>";                    
                    }else{
$sk=$r_ti2->sub_kategori_skor;
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->noskor."</a></td>";
                        $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'>".$r_ti2->item_penilaian."</a></td>";
                        //$content.="<td style='font-size: 11px'><a class='klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0'>".$r_ti2->kspi_nol."</a></td>";
                        $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='0' title='Klik Untuk Skor 0'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_nol."</h7></a></td>";
                        $content.="<td style='font-size: 9px'><a class='btn btn-xs btn-warning klikskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."' data-nilai='1' title='Klik Untuk Skor 1'><i class='fa fa-pencil'></i><h7>".$r_ti2->kspi_satu."</h7></a></td>";
                        if($r_ti2->sk!=''){
                            $content.="<td style='font-size: 11px'><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-dark waves-effect waves-light'>".$r_ti2->sk."</button></a></td>";                        
                        }
                        else{
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' data-idin='".$r_ti2->indikatorid."' data-nomor='".$r_ti2->noskor."' data-soal='".$r_ti2->item_penilaian."'><button type='button' class='btn btn-outline-warning waves-effect waves-light'></button></a></td>";
                        }                        
                        $content.="</tr>";
                    }
                        
                     //jumlah skor
                $queryTotal="SELECT NS.*, TNS.JML, CNS.JM, ((TNS.JML/CNS.JM)*10) AS hasil   FROM `tbl_nilai_skor` NS
                             LEFT JOIN (SELECT id, SUM(skor) AS JML FROM `tbl_nilai_skor` WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."' AND `kat_skor`='".$id."') TNS ON TNS.`id` = NS.id
                             LEFT JOIN (SELECT indikatorid, COUNT(id) AS JM FROM `tbl_kategori_skor` WHERE indikatorid='".$id."') CNS ON CNS.`indikatorid` = NS.id
                             WHERE `user` ='".$user."' AND `provinsi`='".$iddaerah."' GROUP BY `user`";
//                print_r($queryTotal);exit();
                $list_total  = $this->db->query($queryTotal);
                foreach ($list_total->result() as $t_nilai) {
                    $Nilai1=$t_nilai->hasil;
                }
                $Nilai=number_format($Nilai1,2);
                }
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success get data",
                    "table_ktg_skor"=>  $content,
                    "total"         => $Nilai,
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
        }
        else{exit("Access Denied");}
    }
    
}
