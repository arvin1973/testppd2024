<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_Kab extends CI_Controller {
    var $view_dir   = "ppd1/penilaian_daerah/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd1/penilaian_daerah/dokumen.js";
    var $allowed    = array("PPD1");
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");     
        $this->load->library('zip');
    }
    
    /*
     * 
     */
    public function index(){
        if($this->input->is_ajax_request()){
            try 
            {                
                if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //common properties
                $this->js_init    = "main";
                $this->js_path    = "assets/js/ppd1/penilaian_daerah/penilaian_kako.js?v=".now("Asia/Jakarta");
              
                $data_page = array(  
                );
                $str = $this->load->view($this->view_dir."index_daerah",$data_page,TRUE);

                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init.".init();",
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
     * =========================================================================
     *  Kabupaten Kota                                                   - START
     * =========================================================================
     */
     /*
     * list data Kabupaten Kota
     * author : FSM 
     * date : 17 des 2020
     */
    function get_datatable(){
        if($this->input->is_ajax_request()){
            try {
                $requestData= $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array( 
                // datatable column index  => database column name
                    $idx++   =>'K.`id_kode`', 
                    $idx++   =>'K.`id`',
                    $idx++   =>'K.`nama_provinsi`',
                );
                
                $sql = "SELECT K.id mapid,K.id_kode, K.nama_provinsi, P.judul
                        FROM `provinsi` K 
                        LEFT JOIN(SELECT D.id, D.provid, D.judul FROM `t_doc_penilaian_kk` D WHERE D.isactive='Y' GROUP BY D.provid)P ON P.provid=K.`id`
                        WHERE K.id!='-1'";  
                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " K.`id_kode` LIKE '%".$requestData['search']['value']."%' "
                                . " OR K.`id` LIKE '%".$requestData['search']['value']."%' "
                                . " OR K.`nama_provinsi` LIKE '%".$requestData['search']['value']."%' "
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
                    $id      = $row->mapid;
                    $idkab = "kab-".$row->mapid;
                    
                    $str_status = "";
                    if($row->judul=='')
                        $str_status = "<a href='javascript:void(0);' class='btn btn-warning '  title='Data penilaian belum dikirim  '><i class='fas fa-exclamation '></i></span>";
                    else 
                        $str_status = "<a href='javascript:void(0);' class='btn btn-succses' title='Data penilaian sudah dikirim'><i class=' fas fa-check-circle fa-2x text-info'></i></span>";
                    
                    $encrypted_id= base64_encode(openssl_encrypt($idkab,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-nmkk='".$row->nama_provinsi."'";
                    
                    $nestedData[] = $row->id_kode;
                    $nestedData[] = "<a href='javascript:void(0)' ".$tmp.">".$row->nama_provinsi."</a>";
                    $nestedData[] = $str_status;
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
    /*
     * list data Bahan Dokumen
     * author :  FSM
     * date : 17 des 2020
     */
    function g_bahan(){
        if($this->input->is_ajax_request()){
            try {
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
                $idmap = $tmp[1];
             
                $_arr = array("prov","kab","kot");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idmap))
                    throw new Exception("Invalid ID Map");
                
                if($kate_wlyh=="kab"){
                    //LIST Dokumen
                    $sql = "SELECT D.`id` mapid, D.judul, D.filename
                            FROM `t_doc_penilaian_kk` D
                            JOIN `provinsi` P ON P.`id`=D.provid
                            WHERE D.provid =? AND D.isactive = 'Y' ";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql,$bind);
                }
                
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                $str="";
                if($list_data->num_rows()==0)
                    $str = "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";
                
                $no=1;
                foreach ($list_data->result() as $v) {
                    $val_link= base_url("attachments/penilaian/".$v->filename);
                    $idcomb = $v->mapid;
                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='btnDel' data-id='".$encrypted_id."'";
                    $tmp .= " data-title='".$v->judul."'";
                    
                    if(substr($v->filename, -3) == 'rar'){
                        $rename = $v->judul.".rar";
                    }
                    elseif(substr($v->filename, -3) == 'zip'){
                        $rename = $v->judul.".zip";
                    }
                    elseif(substr($v->filename, -3) == 'pdf'){
                        $rename = $v->judul.".pdf";
                    }
                    elseif (substr($v->filename, -4) == 'docx') {
                        $rename = $v->judul.".docx";
                    }
                    elseif (substr($v->filename, -4) == 'xlsx') {
                        $rename = $v->judul.".xlsx";
                    }
                    elseif (substr($v->filename, -3) == 'xls') {
                        $rename = $v->judul.".xls";
                    }
                    elseif (substr($v->filename, -4) == 'jpeg') {
                        $rename = $v->judul.".jpeg";
                    }
                    elseif (substr($v->filename, -4) == 'pptx') {
                        $rename = $v->judul.".pptx";
                    }
                    else{
                        $rename = $v->judul;
                    }
                    
                        $str.="<tr class='bg-secondary' title='Dokumen'>";
                        $str.="<td class='text-right'>".$no++."</td>";
                        $str.="<td  class='text-uppercase bar'>".wordwrap($v->judul,80,"<br/>")."</td>";
                        $str.="<td  class=''><a href='$val_link' download='$rename' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                        $str.="";
                        $str.="</tr>";
                   
                   
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
     * Download zip Tahap 3
     * author :  FSM
     * date : 17 Feb 2021
     */
    function d_bahan(){
        if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
        $idcomb = decrypt_base64($_GET['wl']);
        $tmp = explode('-', $idcomb);
        
        if(count($tmp)!=2)
            throw new Exception("Invalid ID");
        $kate_wlyh  = $tmp[0];
        $idwlyh     = $tmp[1];
        
        $_arr = array("PROV","kab","KOTA");
        if(!in_array($kate_wlyh, $_arr))
                throw new Exception("InvaliD Kategori Wilayah");
        if(!is_numeric($idwlyh))
            throw new Exception("Invalid ID Map");
                
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        $userid = $this->session->userdata(SESSION_LOGIN)->userid;
        $nama = $this->session->userdata(SESSION_LOGIN)->name;
        $usergroupid= $this->session->userdata(SESSION_LOGIN)->group;
        date_default_timezone_set("Asia/Jakarta");
        $current_date_time = date("Y_m_d_H_i_s");
        
         /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
        if($kate_wlyh=="kab" || $kate_wlyh=="KOTA"){
                    /*
                     * check data KAB / KOTA - start
                     */
           $sql = "SELECT A.*
                            FROM `provinsi` A
                            WHERE A.`id`=?";
                    $bind = array($idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
                    if($list_data->num_rows() ==0){
                        $msg = $session->userid." ".$this->router->fetch_class()." : Kab/Kota ID : ".$idwlyh." not found";
                        log_message("error", $msg);
                        throw new Exception("Data Kabupaten / Kota tidak ditemukan!");
                    }
                    foreach ($list_data->result() as $k) {
                        $name=$k->nama_provinsi;
                    }
                    $filename = "Penilaian_Daerah_".$name.".zip";
                    /*
                     * check data KAB / KOTA - end
                     */
                    
                    //get LIST tautan doc
                        $sql = "SELECT D.`id` mapid, D.judul, D.filename
                            FROM `t_doc_penilaian_kk` D
                            JOIN `provinsi` P ON P.`id`=D.provid
                            WHERE D.provid =? AND D.isactive = 'Y' ";
                    $bind = array($idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                                        if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }
        }
        if($list_data->num_rows()==0){
                        echo 'Bahan Dukung tidak ada';exit();
            }
        
        foreach ($list_data->result() as $v) {
            
//            if($kate_wlyh=="kab" || $kate_wlyh=="KOTA"){
//                if(substr($v->filename,0, 5)=='https'){ 
//                    $file       =substr($v->filename,58, 500); 
//                    $filepath1 = FCPATH.'attachments/provinsi/'.$file;
//                }
//                else { 
//                    $file       =substr($v->filename,57, 500); 
//                    $filepath1 = FCPATH.'attachments/provinsi/'.$file;
//                }
//            }       
            $filepath1 = FCPATH.'attachments/penilaian/'.$v->filename;
            if(substr($v->filename, -3) == 'rar'){ $rename = $v->judul.".rar"; }
                    elseif(substr($v->filename, -3) == 'zip'){ $rename = $v->judul.".zip"; }
                    elseif(substr($v->filename, -3) == 'pdf'){ $rename = $v->judul.".pdf"; }
                    elseif (substr($v->filename, -3) == 'xls') { $rename = $v->judul.".xls"; }
                    elseif (substr($v->filename, -4) == 'docx') { $rename = $v->judul.".docx"; }
                    elseif (substr($v->filename, -4) == 'xlsx') { $rename = $v->judul.".xlsx"; }
                    elseif (substr($v->filename, -4) == 'jpeg') { $rename = $v->judul.".jpeg"; }
                    elseif (substr($v->filename, -4) == 'pptx') { $rename = $v->judul.".pptx"; }
                    else{ $rename = $v->judul; }
                    
                    $this->zip->read_file($filepath1,$rename);
                    $filepath = $v->filename;     
                    $filedata[] =$filepath;
                }
                 
                   $this->zip->download($filename);
        
    }
    
        /*
     * delete data dokumen Kab/kota
     * author : FSM
     * date : 17 des 2020
     */
    function delete_dok(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID Data','required|xss_clean');
                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //check data
                $sql= "SELECT id,kabid, judul FROM t_doc_penilaian_kk WHERE id=".$id;
              
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan",3);
                
                $nm = $list_data->row()->judul;
                $this->db->trans_begin();
                $sql= "UPDATE t_doc_penilaian_kk SET isactive = 'N' AND up_dt='".$this->session->userdata(SESSION_LOGIN)->userid."' AND up_by='".$current_date_time."' WHERE id=".$id;
              
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    if($this->db->error()["code"] == 1451)
                        throw new Exception($this->db->error()["code"].":Data tidak dapat dihapus karena terkait dengan data yang lain");
                    else
                        throw new Exception($this->db->error()["code"].":Failed delete data");
                }
                
                //sukses
                $this->db->trans_commit();
                $output = array(
                    "status"    =>  1,
                    "msg"       =>  "Data ".$nm." berhasil dihapus",
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
   
     /*
     * insert data Dokumen Kab/Kota
     * author : FSM 
     * date : 17 des 2020
     */
    function save_dokkk()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",0);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID Kab/kota','required|xss_clean');
                $this->form_validation->set_rules('nama','Nama File','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                
                $inp_nm     = $this->input->post("nama");

                //upload file dokumen
                $inp_urldoc="";
                if(file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/kabkota/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv";
                    $config['max_size']	= '300000'; //30 Mb
                    $config['encrypt_name']	= TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")){
                        throw new Exception($this->upload->display_errors("",""),0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $inp_urldoc = base_url("attachments/kabkota/").$upload_file['file_name'];
                }
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, judul nm FROM t_doc_penilaian_kk WHERE kabid=? AND judul=? AND isactive = 'Y'";
                $bind = array($idmap,$inp_nm);
                $list_data= $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()>0){
                    throw new Exception("Duplikasi Nama Dokumen!");
                }
                // add record
                $this->m_ref->setTableName("t_doc_penilaian_kk");
                $data_baru = array(
                    "kabid"    => $idmap,
                    "judul"      => $inp_nm,
                    "filename"    => $inp_urldoc,
                    "isactive"  => 'Y',
                    "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"     => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if(!$status_save){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"].":Failed save data",0);
                }
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Data berhasil disimpan"
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
    
    
      
    
    
    
}