<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Kertaskerja_Kab extends CI_Controller {
    var $view_dir   = "admin/kertaskerja/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/kertaskerja/kertaskerja.js";
    var $allowed    = array("PPD1");
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
                $session = $this->session->userdata(SESSION_LOGIN);
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //common properties
                $this->js_init    = "main";
                $this->js_path    = "assets/js/admin/kertaskerja/kertaskerja_kab.js?v=".now("Asia/Jakarta");
              
                $data_page = array(  
                );
                $str = $this->load->view($this->view_dir."index_kab",$data_page,TRUE);

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
     *  Provinsi                                                   - START
     * =========================================================================
     */
     /*
     * list data Provinsi
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
                    $idx++   =>'K.`id_kab`', 
                    $idx++   =>'K.`nama_kabupaten`',
                );
                
                $sql = "SELECT K.id mapid,K.id_kab, K.nama_kabupaten
                        FROM `kabupaten` K 
                        WHERE urutan='0' ";
                                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " K.`nama_kabupaten` LIKE '%".$requestData['search']['value']."%' "
                                . " OR K.`id_kab` LIKE '%".$requestData['search']['value']."%' "
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
                    $encrypted_id= base64_encode(openssl_encrypt($idkab,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-nmkk='".$row->nama_kabupaten."'";
                    
                    $nestedData[] = $row->id_kab;
                    $nestedData[] = "<a href='javascript:void(0)' ".$tmp.">".$row->nama_kabupaten."</a>";
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
     * list data Kertas kerja
     * author :  FSM
     * date : 02 Jan 2021
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
                $link =base_url()."attachments/kertaskerja/";
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
                
                if($kate_wlyh=="prov"){
                    $sql = "SELECT K.id,U.name , K.attachments 
                            FROM `t_mdl1_sttment_prov` K 
                            JOIN `tbl_user_wilayah` W ON K.mapid = W.id
                            JOIN `provinsi` P ON W.idwilayah = P.id
                            JOIN `tbl_user` U ON W.iduser = U.id
                            WHERE P.id=? AND U.group=2";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql,$bind);
                }
                elseif ($kate_wlyh=="kab") {
                    $sql = "SELECT K.id,U.name , K.attachments 
                            FROM `t_mdl1_sttment_kabkota` K 
                            JOIN `tbl_user_kabkot` W ON K.mapid = W.id
                            JOIN `kabupaten` KK ON W.idkabkot = KK.id
                            JOIN `provinsi` P ON KK.prov_id = P.id_kode
                            JOIN `tbl_user` U ON W.iduser = U.id
                            WHERE KK.id=? AND KK.urutan='0' AND U.group=2";
                    $bind = array($idmap);
                    $list_data = $this->db->query($sql,$bind);
                    
                }
                elseif ($kate_wlyh=="kota") {
                    $sql = "SELECT K.id,U.name , K.attachments 
                            FROM `t_mdl1_sttment_kabkota` K 
                            JOIN `tbl_user_kabkot` W ON K.mapid = W.id
                            JOIN `kabupaten` KK ON W.idkabkot = KK.id
                            JOIN `provinsi` P ON KK.prov_id = P.id_kode
                            JOIN `tbl_user` U ON W.iduser = U.id
                            WHERE KK.id=? AND KK.urutan='1' AND U.group=2";
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
                    $idcomb = $v->id;
                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='btnDel' data-id='".$encrypted_id."'";
                    $tmp .= " data-title='".$v->name."'";

                    $idcomb1 = "prov_".$v->id;
                    $encrypted_id1= base64_encode(openssl_encrypt($idcomb1,"AES-128-ECB",ENCRYPT_PASS));
                    $tmped = "class='btnEdi' data-id='".$encrypted_id1."'";
                    $tmped .= " data-nama='".$v->name."'";
                    $tmped .= " data-file='".$v->attachments."'";
                    $downl= $link.$v->attachments;                    
                        $str.="<tr class='bg-secondary' title='Dokumen'>";
                        $str.="<td class='text-right'>".$no++."</td>";
                        $str.="<td  class='text-uppercase'>".$v->name."</td>";
                        $str.="<td  class=''><a href='$downl' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
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
     * delete data dokumen Provinsi
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
                $sql= "SELECT id,provid, judul FROM t_doc_capai_prov WHERE id=".$id;
              
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan",3);
                
                $nm = $list_data->row()->judul;
                $this->db->trans_begin();
                $sql= "UPDATE t_doc_capai_prov SET isactive = 'N' AND up_dt='".$this->session->userdata(SESSION_LOGIN)->userid."' AND up_by='".$current_date_time."' WHERE id=".$id ;
              
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
     * insert data Prov
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
                
                $this->form_validation->set_rules('id','ID Provinsi','required|xss_clean');
                $this->form_validation->set_rules('nama','Nama File','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                
                $tmp = explode('_', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                
                $inp_nm     = $this->input->post("nama");

                //upload file dokumen
                $inp_urldoc="";
                if(file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/provinsi/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip";
                    $config['max_size']	= '300000'; //30 Mb
                    $config['encrypt_name']	= TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")){
                        throw new Exception($this->upload->display_errors("",""),0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $inp_urldoc = base_url("attachments/provinsi/").$upload_file['file_name'];
                }
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, judul nm FROM t_doc_capai_prov WHERE provid=? AND judul=? AND isactive = 'Y'";
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
                $this->m_ref->setTableName("t_doc_capai_prov");
                $data_baru = array(
                    "provid"    => $idmap,
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
    
     /*
     * update data Prov
     * author : FSM 
     * date : 30 des 2020
     */
    function update_dok()
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
                
                $this->form_validation->set_rules('id','ID Provinsi','required|xss_clean');
                $this->form_validation->set_rules('nama','Nama File','required|xss_clean');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('_', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                
                $inp_nm     = $this->input->post("nama");
                
                //cek duplikasi
                $sql = "SELECT id, judul nm FROM t_doc_capai_prov WHERE id=? ";
//                print_r($sql);exit();
                $bind = array($idmap);
                $list_data= $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()==0){
                    throw new Exception("Data Tidak Ada!");
                }

                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $fileupload = file_exists($_FILES['filedok']['tmp_name']);
                
                if($fileupload!=''){
                    //upload file dokumen
                    $inp_urldoc="";
                    if(file_exists($_FILES['filedok']['tmp_name']) && is_uploaded_file($_FILES['filedok']['tmp_name'])) {
                        //UPLOAD documents
                        $config['upload_path'] = './attachments/provinsi/';
                        $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip";
                        $config['max_size']	= '300000'; //30 Mb
                        $config['encrypt_name']	= TRUE;
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload("filedok")){
                            throw new Exception($this->upload->display_errors("",""),0);
                        }
                        //uploaded data
                        $upload_file = $this->upload->data();
                        $inp_urldoc = base_url("attachments/provinsi/").$upload_file['file_name'];
                    }
                    
                    //update
                    $this->m_ref->setTableName("t_doc_capai_prov");
                    $data_baru = array(
                        "judul"      => $inp_nm,
                        "filename"   => $inp_urldoc,
                        "up_dt"      => $current_date_time,
                        "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $idmap,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed Update data",0);}

                } 
                else {
                    
                    //update
                    $this->m_ref->setTableName("t_doc_capai_prov");
                    $data_baru = array(
                        "judul"      => $inp_nm,
                        "up_dt"         => $current_date_time,
                        "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $idmap,
                    );
                    $status_save = $this->m_ref->update($cond,$data_baru);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed Update data",0);}
                    
                }
                
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Data berhasil Di update"
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
