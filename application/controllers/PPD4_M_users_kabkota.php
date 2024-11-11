<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PPD4_M_users_kabkota extends CI_Controller {
    var $view_dir   = "ppd4/PPD4_user/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/management/users.js";
    var $allowed    = array("PPD4");
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");
        $this->load->library('email');//panggil library email codeigniter
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
                $this->js_path    = "assets/js/ppd4/PPD4_user/users_kk.js?v=".now("Asia/Jakarta");
                
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                
                //List Group
                $this->m_ref->setTableName("tbl_user_group");
                $select = array("id","groupid","name");
                $cond = array(
                  //  "id" => 'G2'
                );
                $list_group= $this->m_ref->get_by_condition($select,$cond);
                
                //List kab/kota
                $sql="SELECT K.*, P.id_kode, P.nama_provinsi FROM kabupaten K 
                        LEFT JOIN provinsi P ON P.id_kode = K.prov_id
                        WHERE P.id =?";
                $bind = array($satkercode);
                $list_kab = $this->db->query($sql,$bind);
                if(!$list_kab){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                $data_page = array(
                    "list_group"    =>  $list_group,
                    "list_kab"    =>  $list_kab,
                );
                $str = $this->load->view($this->view_dir."index_kk",$data_page,TRUE);


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
     *  User kabupaten kota PPD4     - START
     * =========================================================================
     */
     /*
     * list data User kabupaten kota
     * author : FSM 
     * date : 1 des 2021
     */
    function get_datatable(){
        if($this->input->is_ajax_request()){
            try {
                $requestData= $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $usercr = $this->session->userdata(SESSION_LOGIN)->userid;
                
                $idx = 0;
                $columns = array( 
                // datatable column index  => database column name
                    $idx++   =>'A.`userid`', 
                    $idx++   =>'A.`name`',
                    // $idx++   =>'A.`email`',
                    $idx++   =>'B.`name`',
                    $idx++   =>'C.`nama_kabupaten`',
                    $idx++   =>'D.`nama_provinsi`',
                );
                
                $sql = "SELECT A.id, A.userid,A.`name`,A.email,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker, A.last_access,C.nama_kabupaten, D.nama_provinsi,A.cr_by
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        INNER JOIN `kabupaten` C ON A.satker = C.id
                        INNER JOIN `provinsi` D ON C.prov_id = D.id_kode
                        WHERE B.`id`='5' AND D.id='$satkercode' AND A.active_flag!='D'";
                                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " A.`userid` LIKE '%".$requestData['search']['value']."%' "
                                . " OR A.`name` LIKE '%".$requestData['search']['value']."%' "
                                // . " OR A.`email` LIKE '%".$requestData['search']['value']."%' "
                                . " OR B.`name` LIKE '%".$requestData['search']['value']."%' "
                                . " OR C.`nama_kabupaten` LIKE '%".$requestData['search']['value']."%' "
                                . " OR D.`nama_provinsi` LIKE '%".$requestData['search']['value']."%' "
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
                    $id      = "prov-".$row->id;
                    $title  = $row->name;
                    $encrypted_id= base64_encode(openssl_encrypt($id,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp1 = "class='btn btn-outline-info btn-sm getDetail' data-id='".$encrypted_id."'";
                    $tmp1 .= " data-ustpt='".$row->userid."'";
                    $tmp1 .= " data-nmtpt='".$row->name."'";
                    $tmp1 .= " data-emtpt='".$row->email."'";
                    
                    $tmp2 = "class='btn btn-outline-warning btn-sm btnRes' data-id='".$encrypted_id."'";
                    $tmp2 .= " data-title='".$row->name."'";
                    $tmp3 = "class='btn btn-outline-danger btn-sm btnDel' data-id='".$encrypted_id."'";
                    $tmp3 .= " data-title='".$row->name."'";
                    
                    $nestedData[] = $row->userid;
                    $nestedData[] = $row->name;
                  
                    // $nestedData[] = $row->email;
                    $nestedData[] = $row->nama_kabupaten;
                    //$nestedData[] = $row->groupname;
                    $str = "<span class='badge badge-pink'>Tidak Aktif</span>";
                    $str3="<a href='javascript:void(0)' ></a>";
                    $str1="<a href='javascript:void(0)' ></a>";
                    if($row->active_flag=='Y'){
                    $str = "<span class='badge badge-success'>Aktif</span>";
                    $str3 ="<a href='javascript:void(0)' ".$tmp2." title='Reset Password'><i class='fas mdi mdi-lock-reset'></i></a>";
                        if($row->cr_by ==$usercr){
                            $str1="<a href='javascript:void(0)' ".$tmp3." title='Hapus Data'><i class='text fas fa-trash-alt'></i></a>";
                        }
                    
                    }
                    $nestedData[] = $str;
                            
                    $nestedData[] = "<a href='javascript:void(0)' ".$tmp1." title='Edit Data'><i class='fas fa-pencil-alt'></i></a> "
                            . " ".$str3." ".$str1."";
                            
                    //$nestedData[] = "<a  href='javascript:void(0)' ".$tmp3." title='Hapus Data'>     <i class='text fas fa-trash-alt'></i></a>";                    
                     //$nestedData[] = $str1;
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
                $this->form_validation->set_rules('code','Code','required|xss_clean');
                $this->form_validation->set_rules('name','Name','required|xss_clean');
                
                $this->form_validation->set_rules('kab','Kabupaten','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $this->form_validation->set_rules('email','Email','required|xss_clean');
                
                $userid = $this->input->post("code");
                $name = $this->input->post("name");
                //$group = $this->input->post("group");
                $email = $this->input->post("email");
                $satker = $this->input->post("kab");
           
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "userid"  => $userid,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){throw new Exception("Id User Sudah Ada",0);}
                $tambah="INSERT INTO tbl_user (userid,        `name`,                          `email`,      `password`,                      `group`,                          `satker`, `active_flag`,`cr_by`,`cr_dt`)
                   VALUES                     ('".$userid."', '".$this->input->post("name")."','".$email."', '".md5("pancasila"."monda")."','5','".$satker."','N','".$this->session->userdata(SESSION_LOGIN)->userid."','$current_date_time')";
                $status_save = $this->db->query($tambah);
                
                if(!$status_save){
                    throw new Exception($this->db->error()["code"].":Failed save data",0);
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
                    "msg"    =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    
    /*
     * Detail user dan list daerah dinilai User TPT
     * author : FSM 
     * date : 19 des 2020
     */
    function detail_view(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID #1");
                $kate_grp = $tmp[0];
                $idusr = $tmp[1];
                
                $_arr = array("adm","tpt","tpi","prov");
                if(!in_array($kate_grp, $_arr))
                    throw new Exception("InvaliD Kategori User");
                if(!is_numeric($idusr))
                    throw new Exception("Invalid ID User");
                
                
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $idusr,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
                $groupid = $list_data->row()->group;
                
                $sql_g="SELECT TU.id, TU.name FROM tbl_user_group TU WHERE 1=1 ";
                $list_pr = $this->db->query($sql_g);
                $str_pr = "<option value=''> - Choose - </option>";
                foreach ($list_pr->result() as $v) {                    
                    if($v->id==$list_data->row()->group)
                        $str_pr.="<option value='". $v->id."' selected=''>";
                    else
                        $str_pr.="<option value='". $v->id."'>";
                        $str_pr.=$v->name. "</option>";
                }
                
                //LIST STATUS
                $_arr_stts = array("Y","N");
                $_arr_stts_lbl = array("Y"=>"Active","N"=>"Not Active");
                $str_stts = "<option value=''> - Choose - </option>";
                $statt='';
                foreach ($_arr_stts as $v) {
                    
                    if($v==$list_data->row()->active_flag)
                        $str_stts.="<option value='".$v."' selected=''>";
                    else
                        $str_stts.="<option value='". $v."'>";
                    $str_stts.=$_arr_stts_lbl[$v]. "</option>";
                    
                    $stat=$list_data->row()->active_flag;
                    if($stat=='Y')
                        $statt='Aktif';
                    else 
                        $statt='Tidak Aktif';
                            
                }
                
                $hasPlant = 'N';
                $_arr = array("G2","G5","G6");
                if(in_array($groupid, $_arr))
                        $hasPlant='Y';
                
                //daerah provinsi penilaian
                $select_daerah="SELECT 	P.`id`, P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser, W.id kodewil
                                FROM  `provinsi` P 
                                LEFT JOIN `tbl_user_wilayah` W ON W.idwilayah = P.id
                                WHERE W.iduser='".$idusr."'";
                $list_wilayah = $this->db->query($select_daerah);
                $content = "";
                $no=1;
                foreach ($list_wilayah->result() as $r_wil) {
                    $id      = $r_wil->id;
                    $id1     = "prov_".$r_wil->kodewil;
                    $encrypted_id= base64_encode(openssl_encrypt($id1,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='text-danger btn btn-sm btnDel' data-id='".$encrypted_id."'";
                    $tmp .= " data-title='".$r_wil->nama_provinsi."'";
                    
                    $content.="<tr class='odd gradeX'>";
                    $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' >".$no++."</a></td>";
                    $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->id_kode."</a></td>";
                    $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->nama_provinsi."</a></td>";
                    $content.="<td><a  href='javascript:void(0)' ".$tmp." title='Hapus Data'>     <i class='text fas fa-trash-alt'></i>      </a></td>";
                    $content.="</tr>";
                }
                
                //daerah  kabupaten penilaian
                $content_k = "";
                $no_k=1;
                $select_kab = "SELECT 	K.`id`, K.`id_kab`, K.`nama_kabupaten`,W.iduser, W.id kodewil
                                FROM  `kabupaten` K 
                                LEFT JOIN `tbl_user_kabkot` W ON W.idkabkot = K.id
                                WHERE W.iduser='".$idusr."'";
                //print_r($select_kab);exit();
                $list_kab = $this->db->query($select_kab);
                if($list_kab->num_rows()==0)
                    $content_k = "<tr><td colspan='4'>Data tidak ditemukan</td></tr>";
                
                foreach ($list_kab->result() as $r_kab) {
                    $id      = $r_kab->id;
                    $id1     = "kabko_".$r_kab->kodewil;
                    $encrypted_id= base64_encode(openssl_encrypt($id1,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='text-danger btn btn-sm btnDel' data-id='".$encrypted_id."'";
                    $tmp .= " data-title='".$r_kab->nama_kabupaten."'";
                    $content_k.="<tr class='odd gradeX'>";
                    $content_k.="<td style=''><a class='isinilai' data-id='".encrypt_text($id)."' >".$no_k++."</a></td>";
                    $content_k.="<td style=''><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_kab->id_kab."</a></td>";
                    $content_k.="<td style=''><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_kab->nama_kabupaten."</a></td>";
                    $content_k.="<td><a  href='javascript:void(0)' ".$tmp." title='Hapus Data'>     <i class='text fas fa-trash-alt'></i>      </a></td>";
                    $content_k.="</tr>";
                }
          
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success get data",
                    "data"          =>  $list_data->result(),
                    "tbl_wilayah"   =>  $content,
                    "tbl_kabupaten" =>  $content_k,
                    "str_pr"        =>  $str_pr,
                    "str_stts"      =>  $str_stts,
                    "str_status"    =>  $statt,
                    //"id"            => encrypt_text($id),
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
    
    
    /*
     * edit data User TPT
     * author : FSM 
     * date : 01 jan 2021
     */
    public function detail_act()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                
                $this->form_validation->set_rules('iduser','id','required|xss_clean');
                $this->form_validation->set_rules('userid','user id','required|xss_clean');
                $this->form_validation->set_rules('nama','Name','required|xss_clean');
                
                //$this->form_validation->set_rules('stts','Status Active','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $this->form_validation->set_rules('email','Group','required|xss_clean');
                
                $idcomb = decrypt_base64($this->input->post("iduser"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $userid = $tmp[1];
                
                //CHECK DATA
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $userid,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, reload the page!!",0);}
                
              
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //update
                    $this->m_ref->setTableName("tbl_user");
                    $data_uodate = array(
                        "name"      => $this->input->post("nama"),
                        "email"      => $this->input->post("email"),
                        //"active_flag"      => $this->input->post("stts"),
                        "up_dt"      => $current_date_time,
                        "up_by"      =>  $this->session->userdata(SESSION_LOGIN)->userid
                    );
                    $cond = array(
                        "id"    => $userid,
                    );
                    $status_save = $this->m_ref->update($cond,$data_uodate);
                    if(!$status_save){throw new Exception($this->db->error("code")." : Failed Update data",0);}
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "msg"       =>  "Data Sukses diperbaharui",
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
    
    
    function kab_datatable(){
        if($this->input->is_ajax_request()){
            try {
                $requestData= $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array( 
                // datatable column index  => database column name
                    $idx++   =>'K.id', 
                    $idx++   =>'K.`id_kab`',
                    $idx++   =>'K.`nama_kabupaten`',
                    $idx++   =>'P.`nama_provinsi`',
                );
                
                $sql = "SELECT K.id, K.`id_kab`, K.`nama_kabupaten`, P.nama_provinsi  
                        FROM `kabupaten` K
                        LEFT JOIN `provinsi` P ON P.id_kode= K.prov_id
                        WHERE 1=1";
                                
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " K.`id` LIKE '%".$requestData['search']['value']."%' "
                                . " OR K.`id_kab` LIKE '%".$requestData['search']['value']."%' "
                                . " OR K.`nama_kabupaten` LIKE '%".$requestData['search']['value']."%' "
                                . " OR P.`nama_provinsi` LIKE '%".$requestData['search']['value']."%' "
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
                    $id      = "tpt-".$row->id;
                    
                    $title  = $row->nama_kabupaten;
                    $encrypted_id= base64_encode(openssl_encrypt($id,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-ustpt='".$row->id_kab."'";
                    $tmp .= " data-nmtpt='".$row->nama_kabupaten."'";
                    $tmp .= " data-emtpt='".$row->nama_provinsi."'";
                    
                    $nestedData[] = $row->id_kab;
                    $nestedData[] = $row->nama_kabupaten;
                    $nestedData[] = $row->nama_provinsi;
                    $nestedData[] = "<input type='radio' class='radio' name='group' value='".$row->nama_kabupaten."' data-id='$row->id' data-pv='$row->nama_provinsi' /> ";
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
     * add Provinsi dinilai User TPT
     * author : FSM 
     * date : 31 des 2020
     */
    function add_wil()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('id','Id User','required|xss_clean');
                $this->form_validation->set_rules('prov','Name','required|xss_clean');
                
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $userid = $tmp[1];
               
                $wilayah = decrypt_text($this->input->post("prov"));
                
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

                $tambah="INSERT INTO tbl_user_wilayah (iduser,`idwilayah`,`cr_dt`,`up_dt`,`cr_by`,`up_by`)
                   VALUES ('".$userid."', '".$wilayah."','".$current_date_time."', '', '".$this->session->userdata(SESSION_LOGIN)->id."','')";
                
                $status_save = $this->db->query($tambah);
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
                    $content.="<td ><a class='isinilai' data-id='".encrypt_text($id)."' >".$no++."</a></td>";
                    $content.="<td ><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->id_kode."</a></td>";
                    $content.="<td ><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->nama_provinsi."</a></td>";
                    $content.="<td ><a class='isinilai' data-id='".encrypt_text($id)."' >Hapus</a></td>";
                    $content.="</tr>";
                }
                
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "New data has been saved",
                     "tbl_wilayah"  =>  $content,
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                    "msg"       =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
   
    /*
     * add daerah dinilai User TPT
     * author : FSM 
     * date : 31 des 2020
     */
    function add_kk()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('id','Id User','required|xss_clean');
                $this->form_validation->set_rules('kk','Kab/Kota','required|xss_clean');
                
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $userid = $tmp[1];
                
                $kabko=$this->input->post("kk");
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //cek data 
                $this->m_ref->setTableName("tbl_user_kabkot");
                $select = array();
                $cond = array(
                    "iduser"  => $userid,
                    "idkabkot"=> $kabko,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){throw new Exception("Data duplication",0);}

                $this->m_ref->setTableName("tbl_user_kabkot");
                $data_baru = array(
                    "iduser"     => $userid,
                    "idkabkot"   => $kabko,
                    "cr_dt"      => $current_date_time,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->id,
                    
                );
                $status_save = $this->m_ref->save($data_baru);
                if(!$status_save){
                    log_message("error", $this->db->error()["message"]);
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
                    $content.="<td ><a class='isinilai' data-id='".encrypt_text($id)."' >".$no++."</a></td>";
                    $content.="<td ><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->id_kode."</a></td>";
                    $content.="<td ><a class='isinilai' data-id='".encrypt_text($id)."' >".$r_wil->nama_provinsi."</a></td>";
                    $content.="<td ><a class='isinilai' data-id='".encrypt_text($id)."' >Hapus</a></td>";
                    $content.="</tr>";
                }
                
                //sukses
                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "New data has been saved",
                     "tbl_wilayah"  =>  $content,
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "csrf_hash" =>  $this->security->get_csrf_hash(),
                    "msg"       =>  $exc->getMessage(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
   
    
    /*
     * reset data User ppd
     * author : FSM 
     * date : 01 jan 2021
     */
    function reset_password(){
        if($this->input->is_ajax_request()){
            try{
            if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
            $this->form_validation->set_rules('id','Id','required');
            if($this->form_validation->run() == FALSE){
                throw new Exception(validation_errors("", ""),0);
            }
            $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $userid = $tmp[1];
                
            date_default_timezone_set("Asia/Jakarta");
            $current_date_time = date("Y-m-d H:i:s");
            
            $npas     = "pancasila";
            
            //cek data 
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $userid,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0){throw new Exception("Data Tidak ada",0);}
                $iduser   = $list_data->row()->userid;       
                $name     = $list_data->row()->name;       
                $email    = $list_data->row()->email;  
                
            //update
            $this->db->trans_begin();
            $this->m_ref->setTableName("tbl_user");
            $data_baru = array(
                "password"         => md5($npas."monda"),
                "up_dt"         => $current_date_time,
                "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
            );
            $cond = array(
                "id"  => $userid,
            );
            $status_save = $this->m_ref->update($cond,$data_baru);
            if(!$status_save){throw new Exception($this->db->error("code")." : Failed Update data",0);}
            
            $config = [
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1',
                    'protocol'  => 'smtp',
                    'smtp_host' => 'webmail.bappenas.go.id',
                    'smtp_user' => SMTP_USER,  // Email gmail
                    'smtp_pass'   => SMTP_PASS,  // Password gmail
                    'smtp_port '  => 465,
                    'crlf'    => "\r\n",
                    'newline' => "\r\n",
                    'wordwrap' => TRUE
                ];

                // Load library email dan konfigurasinya
                $this->load->library('email', $config);
                $this->email->initialize($config);
                // Email dan nama pengirim
                $this->email->from('no-reply@bappenas.go.id', 'PPD 2025');
                // Email penerima
                $this->email->to($email); // Ganti dengan email tujuan
                // Subject email
                $this->email->subject('[PPD 2022] Ganti Password');
                // Isi email
                $this->email->message("".$name." yang terhormat,<br><br>"
                . "Id Pengguna    : ".$iduser."<br>"
                . "Untuk Password : ".$npas."<br><br>"
                . "Salam<br><br><br>"
                . "Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan Daerah<br><br>"
                . "--------------------------------------------------------------<br>"
                . "Email ini dikirim secara otomatis oleh sistem. Anda tidak perlu membalas atau mengirim email ke alamat ini.<br>"
                . "© 2025 Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan Daerah | https://peppd.bappenas.go.id/  | dit.peppd@bappenas.go.id ");
                        
                // Tampilkan pesan sukses atau error
                if (!$this->email->send()) {
                    throw new Exception($this->db->error()["code"].":Gagal Kirim ke email",0);
                }
            
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
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $userid = $tmp[1];
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
//                $this->m_ref->setTableName("tbl_user");
//                $select = array();
//                $cond = array(
//                    "id"          => $userid,
//                );
//                $list_data = $this->m_ref->get_by_condition($select,$cond);
//                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
//                
//                $this->db->trans_begin();
//                $status = $this->m_ref->delete($cond);
//                if(!$status){
//                    if($this->db->error()["code"] == 1451)
//                        throw new Exception($this->db->error()["code"].":Data sedang digunakan",0);
//                    else
//                        throw new Exception($this->db->error()["code"].":Failed delete data",0);
//                }
            $this->db->trans_begin();
            $this->m_ref->setTableName("tbl_user");
            $data_baru = array(
                "active_flag"         => "D",
                "up_dt"         => $current_date_time,
                "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
            );
            $cond = array(
                "id"  => $userid,
            );
            $status_save = $this->m_ref->update($cond,$data_baru);
            if(!$status_save){throw new Exception($this->db->error("code")." : Failed Update data",0);}
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
    /*
     * Hapus daftar daerah penilaian provinsi
     * author : FSM 
     * date : 01 jan 2021
     */
    function delete_prov(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('_', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $wilid = $tmp[1];
                
                $this->m_ref->setTableName("tbl_user_wilayah");
                $select = array();
                $cond = array(
                    "id"  => $wilid,
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
    /*
     * Hapus daftar daerah penilaian kab/kota
     * author : FSM 
     * date : 01 jan 2021
     */
    function delete_kabko(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                }
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('_', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $wilid = $tmp[1];
                
                $this->m_ref->setTableName("tbl_user_kabkot");
                $select = array();
                $cond = array(
                    "id"  => $wilid,
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
//    public function detail_act()
//    {
//        if($this->input->is_ajax_request()){
//            try {
//                if(!$this->session->userdata(SESSION_LOGIN)){
//                    throw new Exception("Session berakhir, silahkan login ulang",2);
//                }
//                $this->form_validation->set_rules('id','id','required|xss_clean');
//                $this->form_validation->set_rules('code','Code','required|xss_clean');
//                $this->form_validation->set_rules('name','Name','required|xss_clean');
//                $this->form_validation->set_rules('group','Group','required|xss_clean');
//                $this->form_validation->set_rules('stts','Status Active','required|xss_clean');
//
//                if($this->form_validation->run() == FALSE){
//                    throw new Exception(validation_errors("", ""),0);
//                }
//                $groupid = $this->input->post("group");
//                $_arr = array("G1","G2","G3","G4","G5","G6");
//                if(!in_array($groupid, $_arr))
//                    throw new Exception("Invalid value Group");
//                
//                $stts = $this->input->post("stts");
//                $_arr_stts = array("Y","N");
//                if(!in_array($stts, $_arr_stts))
//                    throw new Exception("Invalid value Status");
//                
//                $plantcode = NULL;
//                
//                $_arr = array("G2","G5","G6");
//                if(in_array($groupid, $_arr)){
//                    $this->form_validation->set_rules('plant','plant','required|xss_clean');
//                    if($this->form_validation->run() == FALSE){
//                        throw new Exception(validation_errors("", ""),0);
//                    }
//                    $plantid = decrypt_text($this->input->post("plant"));
//                    if(!is_numeric($plantid))
//                        throw new Exception("Invalid Value Plant");
//                    //cek data 
//                    $this->m_ref->setTableName("m_plant");
//                    $select = array();
//                    $cond = array(
//                        "id"  => $plantid,
//                    );
//                    $list_data = $this->m_ref->get_by_condition($select,$cond);
//                    if($list_data->num_rows() == 0){throw new Exception("Data Plant Not Found",0);}
//                    $plantcode = $list_data->row()->code;
//                }
//                
//                $id = decrypt_text($this->input->post("id"));
//                if(!is_numeric($id))
//                    throw new Exception("Invalid ID!",0);
//                
//                //CHECK DATA
//                $this->m_ref->setTableName("tbl_user");
//                $select = array();
//                $cond = array(
//                    "id"  => $id,
//                );
//                $list_data = $this->m_ref->get_by_condition($select,$cond);
//                if($list_data->num_rows() == 0){throw new Exception("Data not found, reload the page!!",0);}
//                
//              
//                date_default_timezone_set("Asia/Jakarta");
//                $current_date_time = date("Y-m-d H:i:s");
//                
//                
//                $this->db->trans_begin();
//                $this->m_ref->setTableName("tbl_user");
//                $data_baru = array(
//                    "name"          => $this->input->post("name"),
//                    "unit_code"     => $plantcode,
//                    "groupid"       => $groupid,
//                    "active_flag"   => $stts,
//                    "up_by"         => $this->session->userdata(SESSION_LOGIN)->userid,
//                    "up_dt"         => $current_date_time,
//                );
//                $cond = array(
//                    "id"  => $id,
//                );
//                $status_save = $this->m_ref->update($cond,$data_baru);
//                if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
//                
//                $this->db->trans_commit();
//                
//                //sukses
//                $output = array(
//                    "status"    =>  1,
//                    "msg"       =>  "Data has been updated",
//                    "csrf_hash" =>  $this->security->get_csrf_hash(),
//                );
//                exit(json_encode($output));
//            } catch (Exception $exc) {
//                $this->db->trans_rollback();
//                $output = array(
//                    "status"    =>  $exc->getCode(),
//                    "msg"    =>  $exc->getMessage(),
//                );
//                exit(json_encode($output));
//            }
//        }
//        else{exit("Access Denied");}
//    }
//    
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
