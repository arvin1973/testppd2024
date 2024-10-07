<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kertas_kerja_1 extends CI_Controller {
    var $view_dir   = "admin/dokumen/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/dokumen/dokumen.js";
    
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
               
                
                //common properties
                $this->js_init    = "main";
                $this->js_path    = "assets/js/admin/dokumen/dokumen_".$this->session->userdata(SESSION_LOGIN)->groupid.".js";
                
                //List Dokumen
                $select_dok="SELECT D.*, P.nama_provinsi FROM `tbl_dokumen` D LEFT JOIN `provinsi` P ON P.id = D.idprov WHERE 1=1";
                $list_dok = $this->db->query($select_dok);
                $content = "";
                $no=1;
                foreach ($list_dok->result() as $r_dok) {
                    $content.="<tr >";
                    $content.="<td >".$no++."</td>";
                    $content.="<td ><a class='isinilai' >".$r_dok->nama_provinsi."</a></td>";
                    $content.="<td ><a class='btn btn-xs btn-success' href='". $r_dok->attch."' target='_blank' title='Download Attachment' ><i class='fa fa-download'></i></a></td>";
                    $content.="<td ><a class='btn btn-xs btn-succes'  title='Edit' ><i class='fa fa-edit'></i>Edit</a></td>";
                    $content.="</tr>";          
                }

                
                //List kab/kota
                $this->m_ref->setTableName("provinsi");
                $select = array("id","id_kode","nama_provinsi","ppd");
                $cond = array(
                );
                $list_prov = $this->m_ref->get_by_condition($select,$cond);
                
                $data_page = array(
                    "list_dok"    =>  $list_dok,
                    "list_prov"    =>  $list_prov,
                    "content_t" => $content,
                );
                $str = $this->load->view($this->view_dir."content",$data_page,TRUE);


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
    
    function get_datatable(){
        if($this->input->is_ajax_request()){
            try {
                $requestData= $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array( 
                // datatable column index  => database column name
                    $idx++   =>'A.`userid`', 
                    $idx++   =>'A.`name`',
                    $idx++   =>'A.`email`',
                    $idx++   =>'A.`groupname`',
                );
                
                $sql = "SELECT A.id, A.userid,A.`name`,A.email,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        WHERE 1=1";
                                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " A.`userid` LIKE '%".$requestData['search']['value']."%' "
                                . " OR A.`name` LIKE '%".$requestData['search']['value']."%' "
                                . " OR A.`email` LIKE '%".$requestData['search']['value']."%' "
                                . " OR A.`groupname` LIKE '%".$requestData['search']['value']."%' "
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
                    $title  = $row->name;
                    $nestedData[] = $row->userid;
                    $nestedData[] = $row->name;
                    $nestedData[] = $row->email;
                    $nestedData[] = $row->groupname;
                    $str = "<span class='badge badge-pink'>Tidak Aktif</span>";
                    if($row->active_flag=='Y')
                        $str = "<span class='badge badge-success'>Aktif</span>";
                    $nestedData[] = $str;
                    $nestedData[] = $nestedData[] = "<a class='btn btn-xs btn-outline-purple waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h7> View</h7></a>";
//                    if($row->status==''){
//                        $nestedData[] = "<a class='btn btn-xs btn-danger edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h7> Belum Diisi</h7></a>";}
//                    if($row->status=='1'){
//                        $nestedData[] = ""
//                    . "<a class='btn btn-xs btn-warning edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a>";}
//                    if($row->status=='2'){
//                         $nestedData[] = ""
//                    . "<a class='btn btn-xs btn-success edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h6 class='mt-3 mb-0'><small>Sudah Diisi</small></h6></a>";}
//                    
                    //$nestedData[] = $row->status;
                    ;
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
    
     function add_act()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('select_prov','Provinsi','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //upload file dokumen
                $inp_urldoc="";
                if(file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/';
                    $config['allowed_types'] = "doc|docx|pdf";
                    $config['max_size']	= '300000'; //30 Mb
                    $config['encrypt_name']	= TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")){
                        throw new Exception($this->upload->display_errors("",""),0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $inp_urldoc = base_url("attachments/").$upload_file['file_name'];
                }
                
                
                //cek data 
                $this->m_ref->setTableName("tbl_dokumen");
                $select = array();
                $cond = array(
                    "idprov"  => $this->input->post("select_prov"),
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){throw new Exception("Data duplication",0);}
                $data_baru = array(
                    "idprov"        => $this->input->post("select_prov"),
                    "attch"          => $inp_urldoc,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->userid,
                    "cr_dt"       => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if(!$status_save){
                    throw new Exception($this->db->error()["code"].":Failed save data",0);
                }
                //List Dokumen
                $select_dok="SELECT D.*, P.nama_provinsi FROM `tbl_dokumen` D LEFT JOIN `provinsi` P ON P.id = D.idprov WHERE 1=1";
                $list_dok = $this->db->query($select_dok);
                $content = "";
                $no=1;
                foreach ($list_dok->result() as $r_dok) {
                    $content.="<tr >";
                    $content.="<td >".$no++."</td>";
                    $content.="<td ><a class='isinilai' >".$r_dok->nama_provinsi."</a></td>";
                    $content.="<td ><a class='btn btn-xs btn-success' href='". $r_dok->attch."' target='_blank' title='Download Attachment' ><i class='fa fa-download'></i></a></td>";
                    $content.="<td ><a class='btn btn-xs btn-succes'  title='Edit' ><i class='fa fa-edit'></i>Edit</a></td>";
                    $content.="</tr>";          
                }
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "content_t" => $content,
                    "msg"       =>  "Data Sukses Diupload"
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
    //klik view table
    function detail_view(){
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
                
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
                $groupid = $list_data->row()->group;
                
                $sql_g="SELECT TU.id, TU.name FROM tbl_user_group TU WHERE 1=1 ";
                $list_pr = $this->db->query($sql_g);
                //LIST PRIVILEGE
                //$this->m_ref->setTableName("tbl_user_group");
//                $select = array("id","name");
//                $cond = array(
//                    
//                );
//                $list_pr = $this->m_ref->get_by_condition($select,$cond);
                
                $str_pr = "<option value=''> - Choose - </option>";
                foreach ($list_pr->result() as $v) {                    
                    if($v->id==$list_data->row()->group)
                        $str_pr.="<option value='". $v->id."' selected=''>";
                    else
                        $str_pr.="<option value='". $v->id."'>";
                        $str_pr.=$v->name. "</option>";
                }
                //LIST PLANT
//                $this->m_ref->setTableName("m_provinsi");
//                $select = array("id","nama_pro","kode","nm_kabko","nm_kec","keldes");
//                $cond = array(
//                );
//                $list_kk = $this->m_ref->get_by_condition($select,$cond);
//                
//                $str = "<option value=''> - Choose - </option>";
//                foreach ($list_kk->result() as $v) {
//                    
//                    if($v->kode==$list_data->row()->unit_code)
//                        $str.="<option value='". encrypt_text($v->id)."' selected=''>";
//                    else
//                        $str.="<option value='". encrypt_text($v->id)."'>";
//                    $str.=$v->kode."-".$v->nama_pro. "-".$v->nm_kabko. "-".$v->nm_kec. "</option>";
//                }
//                
                //LIST STATUS
                $_arr_stts = array("Y","N");
                $_arr_stts_lbl = array("Y"=>"Active","N"=>"Not Active");
                $str_stts = "<option value=''> - Choose - </option>";
                foreach ($_arr_stts as $v) {
                    
                    if($v==$list_data->row()->active_flag)
                        $str_stts.="<option value='".$v."' selected=''>";
                    else
                        $str_stts.="<option value='". $v."'>";
                    $str_stts.=$_arr_stts_lbl[$v]. "</option>";
                }
                
                $hasPlant = 'N';
                $_arr = array("G2","G5","G6");
                if(in_array($groupid, $_arr))
                        $hasPlant='Y';
                
                //daerah penilaian
                $select_daerah="SELECT 	P.`id`, P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser
	FROM  `provinsi` P 
	LEFT JOIN `tbl_user_wilayah` W ON W.idwilayah = P.id
	WHERE W.iduser='".$id."'";
                $list_wilayah = $this->db->query($select_daerah);
                $content = "";
                $no=1;
                foreach ($list_wilayah->result() as $r_wil) {
                    $id      = $r_wil->id;
                    $content.="<tr class='odd gradeX'>";
                    $content.="<td style='font-size: 11px'><a class='isinilai' data-id='".encrypt_text($id)."' >".$no++."</a></td>";
                    $content.="<td style='font-size: 11px'><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->id_kode."</a></td>";
                    $content.="<td style='font-size: 11px'><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->nama_provinsi."</a></td>";
                    $content.="<td style='font-size: 11px'><a class='isinilai' data-id='".encrypt_text($id)."' >Hapus</a></td>";
                    $content.="</tr>";
                }
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
                    "data"      =>  $list_data->result(),
                    "tbl_wilayah"       =>  $content,
//                    "str"      =>  $str,
                    "str_pr"      =>  $str_pr,
                    "str_stts"      =>  $str_stts,
//                    "hasPlant"      =>  $hasPlant,
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
    
    function add_wil()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('iduser','Code','required|xss_clean');
                $this->form_validation->set_rules('prov','Name','required|xss_clean');
                
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $userid = decrypt_text($this->input->post("iduser"));
                if(!is_numeric($userid))
                    throw new Exception("Invalid ID!");
                $wilayah = decrypt_text($this->input->post("prov"));
//                $_arr = array("1","2","3","4");
//                if(!in_array($groupid, $_arr))
//                    throw new Exception("Invalid value Group");
//                $userid = $this->input->post("code");
//                $name = $this->input->post("name");
//                $group = $this->input->post("group");
//                $email = $this->input->post("email");
//                $satker = NULL;
                

               
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_user_wilayah");
                $select = array();
                $cond = array(
                    "iduser"  => $userid,
                    "idwilayah"=> $wilayah,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){throw new Exception("Data duplication",0);}
                
//                $tambah="INSERT INTO tbl_user (userid,`name`,`email`,`password`,`group`,`satker`, `active_flag`,`cr_by`,`cr_dt`)
//                   VALUES ('".$userid."', '".$this->input->post("name")."','".$email."', '".md5("sundakelapa"."monda")."', '".$this->input->post("group")."','','Y','".$this->session->userdata(SESSION_LOGIN)->userid."','$current_date_time')";
//                print_r($tambah);exit();
                $tambah="INSERT INTO tbl_user_wilayah (iduser,`idwilayah`,`cr_dt`,`up_dt`,`cr_by`,`up_by`)
                   VALUES ('".$userid."', '".$wilayah."','".$current_date_time."', '', '".$this->session->userdata(SESSION_LOGIN)->userid."','')";
                //print_r($tambah);exit();
                $status_save = $this->db->query($tambah);
//                $data_baru = array(
//                    "userid"        => $userid,
//                    "name"          => $this->input->post("name"),
//                    "password"      => md5("sundakelapa"."PPD"),
//                    "groupid"       => $this->input->post("group"),
//                    "satker"        => '',                    
//                    "active_flag"   => "Y",
//                    "cr_by"         => $this->session->userdata(SESSION_LOGIN)->userid,
//                    "cr_dt"         => $current_date_time,
//                );
//                $status_save = $this->m_ref->save($data_baru);
                if(!$status_save){
                    throw new Exception($this->db->error()["code"].":Failed save data",0);
                }
                 //daerah penilaian
                $select_daerah="SELECT 	P.`id`, P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser
	FROM  `provinsi` P 
	LEFT JOIN `tbl_user_wilayah` W ON W.idwilayah = P.id
	WHERE W.iduser='".$userid."'";
                $list_wilayah = $this->db->query($select_daerah);
                $content = "";
                $no=1;
                foreach ($list_wilayah->result() as $r_wil) {
                    $id      = $r_wil->id;
                    $content.="<tr class='odd gradeX'>";
                    $content.="<td style='font-size: 11px'><a class='isinilai' data-id='".encrypt_text($id)."' >".$no++."</a></td>";
                    $content.="<td style='font-size: 11px'><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->id_kode."</a></td>";
                    $content.="<td style='font-size: 11px'><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->nama_provinsi."</a></td>";
                    $content.="<td style='font-size: 11px'><a class='isinilai' data-id='".encrypt_text($id)."' >Hapus</a></td>";
                    $content.="</tr>";
                }
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "New data has been saved"
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "tbl_wilayah"       =>  $content,
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
//    function get_datatable(){
//        if($this->input->is_ajax_request()){
//            try {
//                $requestData= $_REQUEST;
//        
//                $idx = 0;
//                $columns = array( 
//                // datatable column index  => database column name
//                        $idx++   =>'A.`userid`', 
//                        $idx++   =>'A.`name`', 
//                        $idx++   =>'A.`active_flag`', 
//                );
//                $sql = "SELECT A.id CODE,A.`userid`,A.`name`,A.`last_access`,B.`name` groupname,A.`active_flag`
//                        FROM `tbl_user` A
//                        INNER JOIN `tbl_user_group` B ON B.`id`=A.`groupid`
//                        WHERE 1=1' ";
//                $totalData = $this->db->query($sql)->num_rows();
//                $totalFiltered = $totalData;
//
//
//                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
//                        $sql.=" AND ( "
//                                . " A.`name` LIKE '%".$requestData['search']['value']."%' "
//                                . ")";    
//                }
//                $list_data = $this->db->query($sql);
//                $totalFiltered = $list_data->num_rows();
//
//                $sql.=" ORDER BY "
//                        .$columns[$requestData['order'][0]['column']]."   "
//                        .$requestData['order'][0]['dir']."  "
//                        . "LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
//                $list_data = $this->db->query($sql);
//                $data = array();
//
//                $i=1;
//                foreach ($list_data->result() as $row) {
//                    $nestedData=array(); 
//                    $id     = $row->code;
//                    $title  = $row->userid;
//
//                    $nestedData[] = $row->userid;
//                    $nestedData[] = $row->name;
//                    $nestedData[] = $row->groupname;                    
//                    $nestedData[] = "";
////                            . "<a class='btn btn-xs btn-info edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i></a>"
////                            . " <a data-title='".$title."' data-id='".encrypt_text($id)."' class=\"btn btn-danger btn-xs hapus\" title='Hapus data'><i class=\"fa fa-times\"></i></a>";
//                    $data[] = $nestedData;
//                }
//                $json_data = array(
//                    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//                    "recordsTotal"    => intval( $totalData ),  // total number of records
//                    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
//                    "data"            => $data   // total data array
//                    );
//                exit(json_encode($json_data));
//            } catch (Exception $exc) {
//                echo $exc->getTraceAsString();
//            }
//                }
//        else
//            die;
//    }
   
    /*
     * hapus data
     */
    function delete(){
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
                
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
                
                $this->db->trans_begin();
                $status = $this->m_ref->delete($cond);
                if(!$status){
                    if($this->db->error()["code"] == 1451)
                        throw new Exception($this->db->error()["code"].":Data sedang digunakan",0);
                    else
                        throw new Exception($this->db->error()["code"].":Failed delete data",0);
                }
                $this->db->trans_commit();
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "Data has been deleted"
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
    
    

    public function detail_act()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','id','required|xss_clean');
                $this->form_validation->set_rules('code','Code','required|xss_clean');
                $this->form_validation->set_rules('name','Name','required|xss_clean');
                $this->form_validation->set_rules('group','Group','required|xss_clean');
                $this->form_validation->set_rules('stts','Status Active','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $groupid = $this->input->post("group");
                $_arr = array("G1","G2","G3","G4","G5","G6");
                if(!in_array($groupid, $_arr))
                    throw new Exception("Invalid value Group");
                
                $stts = $this->input->post("stts");
                $_arr_stts = array("Y","N");
                if(!in_array($stts, $_arr_stts))
                    throw new Exception("Invalid value Status");
                
                $plantcode = NULL;
                
                $_arr = array("G2","G5","G6");
                if(in_array($groupid, $_arr)){
                    $this->form_validation->set_rules('plant','plant','required|xss_clean');
                    if($this->form_validation->run() == FALSE){
                        throw new Exception(validation_errors("", ""),0);
                    }
                    $plantid = decrypt_text($this->input->post("plant"));
                    if(!is_numeric($plantid))
                        throw new Exception("Invalid Value Plant");
                    //cek data 
                    $this->m_ref->setTableName("m_plant");
                    $select = array();
                    $cond = array(
                        "id"  => $plantid,
                    );
                    $list_data = $this->m_ref->get_by_condition($select,$cond);
                    if($list_data->num_rows() == 0){throw new Exception("Data Plant Not Found",0);}
                    $plantcode = $list_data->row()->code;
                }
                
                $id = decrypt_text($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID!",0);
                
                //CHECK DATA
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, reload the page!!",0);}
                
              
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                
                $this->db->trans_begin();
                $this->m_ref->setTableName("tbl_user");
                $data_baru = array(
                    "name"          => $this->input->post("name"),
                    "unit_code"     => $plantcode,
                    "groupid"       => $groupid,
                    "active_flag"   => $stts,
                    "up_by"         => $this->session->userdata(SESSION_LOGIN)->userid,
                    "up_dt"         => $current_date_time,
                );
                $cond = array(
                    "id"  => $id,
                );
                $status_save = $this->m_ref->update($cond,$data_baru);
                if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                
                $this->db->trans_commit();
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "msg"       =>  "Data has been updated",
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
    
    function change_password(){
        if($this->input->is_ajax_request()){
            try{
            if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
            $this->form_validation->set_rules('opass','Password Saat Ini','required');
            $this->form_validation->set_rules('npass','New Password','required');
            $this->form_validation->set_rules('cpass','Ulangi Password','required');
            if($this->form_validation->run() == FALSE){
                throw new Exception(validation_errors("", ""),0);
            }                
            date_default_timezone_set("Asia/Jakarta");
            $current_date_time = date("Y-m-d H:i:s");
            
            $pass     = $this->input->post("opass");
            $npas     = $this->input->post("npass");
            $userid   = $this->session->userdata(SESSION_LOGIN)->userid;
            
            $sql = "SELECT A.id, A.userid,A.`name`,A.`active_flag`,A.`groupid`,B.`name` groupname,A.unit_code
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`groupid`=B.`id`
                        WHERE A.`userid`=? AND A.`password`=?;";
            $bind=array($userid, md5($pass."monda"));
            $list_data = $this->db->query($sql,$bind);
            if(!$list_data)
                    throw new Exception("SQL Error!");
            if($list_data->num_rows() == 0)
                    throw new Exception("Wrong Combination!");
            //update
            $this->db->trans_begin();
            $this->m_ref->setTableName("tbl_user");
            $data_baru = array(
                "password"         => md5($npas."monda"),
                "up_dt"         => $current_date_time,
                "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
            );
            $cond = array(
                "id"  => $list_data->row()->id,
            );
            $status_save = $this->m_ref->update($cond,$data_baru);
            if(!$status_save){throw new Exception($this->db->error("code")." : Failed Update data",0);}
            
            $this->db->trans_commit();
                $output = array(
                    "status"    =>  1,
                    "msg"       =>  "Data has been updated",
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
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
