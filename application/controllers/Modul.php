<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends CI_Controller {
    var $view_dir   = "admin/modul/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/modul/modul.js";
    
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");       
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
               // print_r($current_date_time);exit();
                //common properties
                $this->js_init    = "main";
                $this->js_tedit    = "main";
                $this->js_path    = "assets/js/admin/modul/modul_".$this->session->userdata(SESSION_LOGIN)->groupid.".js";
                

                $data_page = array( );
                $str = $this->load->view($this->view_dir."content",$data_page,TRUE);

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
                    $idx++   =>'TM.`id`', 
                    $idx++   =>'TM.`nm_module`',
                );
                
                $sql = "SELECT TM.id,TM.`nm_module`
                        FROM `tbl_module` TM
                        WHERE 1=1 ";
                                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " TM.`id` LIKE '%".$requestData['search']['value']."%' "
                                . " OR TM.`nm_module` LIKE '%".$requestData['search']['value']."%' "
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
                    $title  = $row->nm_module;
                    $nestedData[] = $row->id;
                    $nestedData[] = $row->nm_module;
                   // $nestedData[] = "<a class='btn btn-xs btn-succses edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h7> Lihat</h7></a>";
                    $nestedData[] = "<a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."'  title='Lihat Kriteria'><i class='fa fa-pencil'></i><h7>Lihat</h7></a></td>";
//                    if($row->status==''){
//                        $nestedData[] = "<a class='btn btn-xs btn-danger edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h7> Belum Diisi</h7></a>";}
//                    if($row->status=='1'){
//                        $nestedData[] = ""
//                    . "<a class='btn btn-xs btn-warning edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a>";}
//                    if($row->status=='2'){
//                         $nestedData[] = ""
//                    . "<a class='btn btn-xs btn-success edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h6 class='mt-3 mb-0'><small>Sudah Diisi</small></h6></a>";}
                    
                    //$nestedData[] = $row->status;
                    $nestedData[] = "";
//                            . " ";
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
                $id = decrypt_text($this->input->post("id"));
               
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!");
                //select table kriteria
                $this->m_ref->setTableName("tbl_kriteria");
                $select_i = array();
                $cond_i = array(
                    "idmodule" => $id,
                );
                $list_data_i2 = $this->m_ref->get_by_condition($select_i,$cond_i);
                $content = "";        
                $nomor=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' >".$nomor++."</a></td>";
                        $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_ti2->nama_kriteria."</a></td>";
                        $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_ti2->bobot." %</a></td>";
                        //$content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' title='Isi Nilai'><h5 class='text-danger font-16 m-0'>Lihat</h5></a></td>";
                        $content.="<td ><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai' data-id='".encrypt_text($id)."'  title='Lihat Indikator'><i class='fa fa-pencil'></i><h7>Lihat</h7></a></td>";                        
                        $content.="</tr>";
                }
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
                    "profile"       =>  $this->session->userdata(SESSION_LOGIN)->name,
                    "tbl_kriteria"       =>  $content,
                    "id"      => encrypt_text($id),
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
    
    function detail_kategori_skor(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $id = decrypt_text($this->input->post("id"));
               $idkriteria = $this->input->post("id");
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!");
                
                $query="";
                
                $this->m_ref->setTableName("tbl_indikator");
                $select_i = array();
                $cond_i = array(
                    "idkreteria" => $id,
                );
                $list_data_i2 = $this->m_ref->get_by_condition($select_i,$cond_i);
                $content = "";             
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->no_indikator."</a></td>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->nama_indikator."</a></td>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->bobot."</a></td>";
                        $content.="<td><a class='btn btn-xs btn-outline-pink waves-effect waves-light editNI' data-kriteria='".$idkriteria."' data-id='".encrypt_text($id)."' data-nomor='".$r_ti2->no_indikator."' data-nama='".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."' data-note='".$r_ti2->note."' title='Edit'>          <i class='fa fa-pencil'></i><h7>Edit</h7></a></td>";
                        $content.="<td><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai' data-id='".encrypt_text($id)."'  title='Lihat Indikator'><i class='fa fa-pencil'></i><h7>Lihat</h7></a></td>";
                        $content.="</tr>";
                }
                //$content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' data-nomor='".$r_ti2->no_indikator.". ".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."' title='Isi Nilai'><h5 class='text-danger font-16 m-0'>Belum Lengkap</h5></a></td>";
                        
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
                    "table_indikator"       =>  $content,
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
    
    function detail_skor(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $id  = decrypt_text($this->input->post("id"));
               $indk = decrypt_text($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!");
                
                $query="";
                
                $this->m_ref->setTableName("tbl_kategori_skor");
                $select_i = array();
                $cond_i = array(
                    "indikatorid" => $id,
                );
                $list_data_i2 = $this->m_ref->get_by_condition($select_i,$cond_i);
                $content = "";             
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_ti2->noskor."</a></td>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_ti2->item_penilaian."</a></td>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_ti2->kspi_nol."</a></td>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_ti2->kspi_satu."</a></td>";
                        if($r_ti2->tag=='0'){
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >Item semua daerah</a></td>";
                        }else{
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >Provinsi</a></td>";
                        }
                        
                        $content.="<td><a class='btn btn-xs btn-outline-purple waves-effect waves-light editks' data-id='".encrypt_text($id)."' title='Edit'><h5 class='text-succsess font-12 m-0'>Edit</h5></a></td>";
//                        $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' title='Edit'><h5 class='text-danger font-16 m-0'>Lihat</h5></a></td>";
                        $content.="</tr>";
                }
                $select_max="SELECT MAX(noskor) AS NOMAX 
FROM `tbl_kategori_skor` 
WHERE indikatorid= '$indk' ";
                $nmax=0;
                $list_dok = $this->db->query($select_max);
                foreach ($list_dok->result() as $r_dok) {
                    $max = $r_dok->NOMAX;
                }
                $nmax=$max+1;
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
                    "table_item"       =>  $content,
                    "max_s"       =>  $nmax,
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
    
    function edit_indikator()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('kriteria','kriteria','required|xss_clean');
                $this->form_validation->set_rules('idindk','idindk','required|xss_clean');
                $this->form_validation->set_rules('nomor','nomor','required|xss_clean');
                $this->form_validation->set_rules('nama_indk','nama_indk','required|xss_clean');
                $this->form_validation->set_rules('bobot','bobot','required|xss_clean');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $this->form_validation->set_rules('ctt','catatan','required|xss_clean');

                $kriteria = decrypt_text($this->input->post("kriteria"));
                if(!is_numeric($kriteria))
                    throw new Exception("Invalid ID Kriteria!");
                $idindkat = decrypt_text($this->input->post("idindk"));
                if(!is_numeric($idindkat))
                    throw new Exception("Invalid ID Indikator!");
                $nomorind = $this->input->post("nomor");
                if(!is_numeric($nomorind))
                    throw new Exception("Invalid Nomor Indikator!");
                $namaindi = $this->input->post("nama_indk");
                $bobotind = $this->input->post("bobot");
                $catatani = $this->input->post("ctt");
                $useridin = $this->session->userdata(SESSION_LOGIN)->id;
                //print_r($useridin);exit();
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_indikator");
                $select = array();
                $cond = array(
                    "id"          => $idindkat,
                    "idkreteria"  => $kriteria,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0){throw new Exception("Data tidak ditemukan",0);}
                $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_indikator");
                    $data_update = array(
                        "nama_indikator" => $namaindi,
                        "bobot"          => $bobotind,
                        "note"           => $catatani,
                        "ud_by"          => $useridin,
                        "ud_date"        => $current_date_time,
                    );
                    $cond = array(
                       "id"          => $idindkat,
                        "idkreteria"  => $kriteria,
                    );
                    $status_save = $this->m_ref->update($cond,$data_update);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Gagal Simpan Data",0);}
                    $this->db->trans_commit();
                    
               $select_dok="SELECT T.* FROM `tbl_indikator` T WHERE T.idkreteria='$kriteria'   ";
               
                $list_d = $this->db->query($select_dok);
                $content = "";             
                $no=1;
                foreach ($list_d->result() as $r_ti2) {
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->no_indikator."</a></td>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->nama_indikator."</a></td>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->bobot."</a></td>";
                        $content.="<td><a class='btn btn-xs btn-outline-pink waves-effect waves-light editNI' data-kriteria='".encrypt_text($kriteria)."' data-id='".encrypt_text($id)."' data-nomor='".$r_ti2->no_indikator."' data-nama='".$r_ti2->nama_indikator."' data-bobot='".$r_ti2->bobot."' data-note='".$r_ti2->note."' title='Edit'>          <i class='fa fa-pencil'></i><h7>Edit</h7></a></td>";
                        $content.="<td><a class='btn btn-xs btn-outline-info waves-effect waves-light isinilai' data-id='".encrypt_text($id)."'  title='Lihat Indikator'><i class='fa fa-pencil'></i><h7>Lihat</h7></a></td>";
                        $content.="</tr>";
                }
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "table_item"       =>  $content,
                    "msg"       =>  "Indikator sukses di update",
                   // 
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
    
    function edit_kategori_skor()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('id','id','required|xss_clean');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }

                $id = decrypt_text($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID Kategori skor per item!");
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_kategori_skor");
                $select = array();
                $cond = array(
                    "id"          => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0){throw new Exception("Data tidak ditemukan",0);}
                
                //LIST STATUS
                $_arr_stts = array("0","1");
                $_arr_stts_lbl = array("0"=>"Item semua daerah","1"=>"Provinsi");
                $str_stts = "<option value=''> - Choose - </option>";
                foreach ($_arr_stts as $v) {
                    
                    if($v==$list_data->row()->tag)
                        $str_stts.="<option value='".$v."' selected=''>";
                    else
                        $str_stts.="<option value='". $v."'>";
                    $str_stts.=$_arr_stts_lbl[$v]. "</option>";
                }
              
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "data"      =>  $list_data->result(),
                    "str_stts"      =>  $str_stts,
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
    
    function sv_edit_kategori_skor(){
        if($this->input->is_ajax_request()){
            try{
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('ip_id','id','required|xss_clean');
                $this->form_validation->set_rules('ind_id','No indikator','required|xss_clean');
                $this->form_validation->set_rules('ip_id','id','required|xss_clean');
                $this->form_validation->set_rules('nama_ip','nama_ip','required|xss_clean');
                $this->form_validation->set_rules('ks_nol','ks_nol','required|xss_clean');
                $this->form_validation->set_rules('ks_satu','ks_satu','required|xss_clean');
                $this->form_validation->set_rules('stts','ks_satu','required|xss_clean');
                
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $ip_id = decrypt_text($this->input->post("ip_id"));
                if(!is_numeric($ip_id))
                    throw new Exception("Invalid ID Kategori skor per item!");
                
                $nomorip = $this->input->post("nomorip");
                $nama_ip = $this->input->post("nama_ip");
                $ks_nol  = $this->input->post("ks_nol");
                $ks_satu = $this->input->post("ks_satu");
                $stts = $this->input->post("stts");
                $ind_id = $this->input->post("ind_id");
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_kategori_skor");
                $select = array();
                $cond = array(
                    "id"          => $ip_id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0){throw new Exception("Data tidak ditemukan",0);}
                
                $this->db->trans_begin();
                    $this->m_ref->setTableName("tbl_kategori_skor");
                    $data_update = array(
                        "noskor" => $nomorip,
                        "item_penilaian"          => $nama_ip,
                        "kspi_nol"           => $ks_nol,
                        "kspi_satu"          => $ks_satu,
                        "tag"        => $stts,
                        "cr_by"        => $this->session->userdata(SESSION_LOGIN)->userid,
                    );
                    $cond = array(
                       "id"          => $ip_id,
                    );
                    $status_save = $this->m_ref->update($cond,$data_update);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Gagal Simpan Data",0);}
                    $this->db->trans_commit();
                    
                     $this->m_ref->setTableName("tbl_kategori_skor");
                $select_i = array();
                $cond_i = array(
                    "indikatorid" => $ind_id,
                );
                $list_data_i2 = $this->m_ref->get_by_condition($select_i,$cond_i);
                $content = "";             
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_ti2->noskor."</a></td>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_ti2->item_penilaian."</a></td>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_ti2->kspi_nol."</a></td>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_ti2->kspi_satu."</a></td>";
                        if($r_ti2->tag=='0'){
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >Item semua daerah</a></td>";
                        }else{
                            $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' >Provinsi</a></td>";
                        }
                        
                        $content.="<td><a class='btn btn-xs btn-outline-purple waves-effect waves-light editks' data-id='".encrypt_text($id)."' title='Edit'><h5 class='text-succsess font-12 m-0'>Edit</h5></a></td>";
//                        $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' title='Edit'><h5 class='text-danger font-16 m-0'>Lihat</h5></a></td>";
                        $content.="</tr>";
                }
//                $select_max="SELECT MAX(noskor) AS NOMAX 
//FROM `tbl_kategori_skor` 
//WHERE indikatorid= '$indk' ";
//                $nmax=0;
//                $list_dok = $this->db->query($select_max);
//                foreach ($list_dok->result() as $r_dok) {
//                    $max = $r_dok->NOMAX;
//                }
//                $nmax=$max+1;
                
                    //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Indikator sukses di update",
                    "table_kat" => $content,
                );
                exit(json_encode($output));
                
            } catch (Exception $ex) {
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
}
