<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PPD3_t2_penilaian extends CI_Controller {
    var $view_dir   = "ppd3/PPD3_penilaian/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD3_bahan_dukung/PPD3_bahan_dukung.js";
    var $allowed    = array("PPD3");
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
                $this->js_path    = "assets/js/ppd3/PPD3_penilaian/PPD_3_penilaian_t2.js?v=".now("Asia/Jakarta");
              
                $data_page = array(  
                );
                $str = $this->load->view($this->view_dir."index_th2",$data_page,TRUE);

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
     * list data wilayah provinsi dan atau Kabupaten/kota
     * author : fsm 
     * date : 23 des 2020
     */
    function g_wilayah(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $this->form_validation->set_rules('kate','Kategori Wilayah','required|in_list[PROV,KAB,KOTA]');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $inp_katewlyh = $this->input->post("kate");
                
                $str = "";
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY PROVINSI - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($inp_katewlyh=="PROV"){
                    
                    //LIST PROVINSI
                    $sql = "SELECT A.`id` mapid,P.id idprov,P.`nama_provinsi` nmprov,P.`label`
                            FROM tbl_user_wilayah A
                            JOIN `provinsi` P ON P.`id`=A.`idwilayah`
                            WHERE A.`iduser`=?";
                    $bind = array($session->id);
                    $list_data = $this->db->query($sql,$bind);               
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }

                    $str="";
                    if($list_data->num_rows()==0)
                        $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";

                    $no=1;
                    foreach ($list_data->result() as $v) {
                        $idcomb = $inp_katewlyh."-".$v->mapid;
                        $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));


                        $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                        $tmp .= " data-nmwlyh='".$v->nmprov."'";
                        $str.="<tr>";
                        $str.="<td class='text-right'>".$no++."</td>";
                         
                        //TAUTAN DOC
                        $idcomb_prov = $inp_katewlyh.'-'.$v->idprov;
                        $encrypted_provid = base64_encode(openssl_encrypt($idcomb_prov,"AES-128-ECB",ENCRYPT_PASS));
                        $tmp_prov = "class='btn btn-link getDoc' data-id='".$encrypted_provid."'";
                        $tmp_prov .= " data-nmwlyh='".$v->nmprov."'";
                        $str.="<td class='p-l-25'><a href='javascript:void(0)' ".$tmp_prov.">".wordwrap($v->nmprov,100,"<br/>")."</a></td>";


                        $str.="</tr>";
                    }
                }
                 /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY PROVINSI - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                 /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY KABUPATEN - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                elseif($inp_katewlyh=='KAB'){
                    $sql = "SELECT A.`id` mapid,P.id idkab,P.`nama_kabupaten` nmkab
                            FROM tbl_user_kabkot A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=0
                            WHERE A.`iduser`=?";
                    $bind = array($session->id);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }

                    $str="";
                    if($list_data->num_rows()==0)
                        $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";

                    $no=1;
                    foreach ($list_data->result() as $v) {
                        $idcomb = $inp_katewlyh."-".$v->mapid;
                        $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));


                        $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                        $tmp .= " data-nmwlyh='".$v->nmkab."'";
                        $str.="<tr>";
                        $str.="<td class='text-right'>".$no++."</td>";
                        
                        //TAUTAN DOC
                        $idcomb_kab = $inp_katewlyh.'-'.$v->idkab;
                        $encrypted_kabid = base64_encode(openssl_encrypt($idcomb_kab,"AES-128-ECB",ENCRYPT_PASS));
                        $tmp_kab = "class='btn btn-link getDoc' data-id='".$encrypted_kabid."'";
                        $tmp_kab.= " data-nmwlyh='".$v->nmkab."'";
                         $str.="<td class='p-l-25'><a href='javascript:void(0)' ".$tmp_kab.">".wordwrap($v->nmkab,100,"<br/>")."</a></td>";
                       
                
                        $str.="</tr>";
                    }
                }
                
               
                 /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * QUERY KOTA - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                elseif($inp_katewlyh=='KOTA'){
                    //LIST KOTA
                   //LIST KOTA
                   $sql = "SELECT A.`id` mapid,P.id idkota,P.`nama_kabupaten` nmkot
                            FROM tbl_user_kabkot A
                            JOIN `kabupaten` P ON P.`id`=A.`idkabkot` AND P.`urutan`=1
                            WHERE A.`iduser`=?";
                    $bind = array($session->id);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL!");
                    }

                    $str="";
                    if($list_data->num_rows()==0)
                        $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";

                    $no=1;
                    foreach ($list_data->result() as $v) {
                        $idcomb = $inp_katewlyh."-".$v->mapid;
                        $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));


                        $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                        $tmp .= " data-nmwlyh='".$v->idkota."'";
                        $str.="<tr>";
                        $str.="<td class='text-right'>".$no++."</td>";
                        //TAUTAN DOC
                        $idcomb_kota = $inp_katewlyh.'-'.$v->idkota;
                        $encrypted_kotaid = base64_encode(openssl_encrypt($idcomb_kota,"AES-128-ECB",ENCRYPT_PASS));
                        $tmp_kota= "class='btn btn-link getDoc' data-id='".$encrypted_kotaid."'";
                        $tmp_kota.= " data-nmwlyh='".$v->nmkot."'";
                         $str.="<td class='p-l-25'><a href='javascript:void(0)' ".$tmp_kota.">".wordwrap($v->nmkot,100,"<br/>")."</a></td>";

                        $str.="</tr>";
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
                }
        else die("Die!");
    }
      
    /*
     * list data Bahan Dokumen penilaian
     * author :  FSM
     * date : 17 des 2020
     */
    function g_bahan(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",0);
                }
                $inp_katewlyh = $this->input->post("id");
                $group= $this->session->userdata(SESSION_LOGIN)->group;
                $userid= $this->session->userdata(SESSION_LOGIN)->id;
                
                
//                    $sql = "SELECT D.id mapid, D.judul, D.tautan, D.cr_by, D.cr_dt "
//                            . "FROM `t_doc` D  "
//                            . "JOIN `t_doc_groupuser` G ON D.id = G.docid "
//                            . "JOIN `tbl_user_group` U ON G.`groupid` = U.id "
//                            . "WHERE U.id=? AND D.isactive = 'Y'";
                    $sql = " SELECT A.`id`,A.`judul`,A.`filename`
                            FROM `t_doc_tahap_penilaian_prov` A
                            JOIN `tbl_user_wilayah` B ON B.`id`=A.`mapid` 
                            WHERE A.`isactive`='Y' AND A.tahap ='1' AND B.`iduser`=? ";
                    $bind = array($userid);
                    $list_data = $this->db->query($sql,$group);
                    
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                $str="";
                if($list_data->num_rows()==0)
                    $str = "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
                
                $no=1;
                foreach ($list_data->result() as $v) {
//                    $idcomb = $v->mapid;
//                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
//                    $tmp = "class='btnVie' data-id='".$encrypted_id."'";
//                    $tmp .= " data-title='".$v->judul."'";
                    
                        $str.="<tr class='bg-secondary' title='Dokumen'>";
                        $str.="<td class='text-right'>".$no++."</td>";
                       // $str.="<td  class='text'><a href='javascript:void(0)' ".$tmp." title='View'>".$v->judul."</a></td>";
                        $str.="<td  class='text'>".$v->judul."</td>";
//                        $str.="<td  class='text'>".$v->filename."</td>";
                        $str.="<td  class=''><a href='$v->filename' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                       // $str.="<td  class=''><a href='javascript:void(0)' ".$tmp." class='text-danger btn btn-sm ' title='Hapus Data'><i class='text fas fa-trash-alt '></i></a></td>";
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
     * list data dokumen bahan dukung masing-masing wilayah
     * author : fsm
     * date : 23 jan 2021
     */
    function g_doc(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $usergroupid = $session->group;
                
                $this->form_validation->set_rules('id','ID Data Indikator','required');
                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh  = $tmp[0];
                $idwlyh     = $tmp[1];
                
                $_arr = array("PROV","KAB","KOTA");
                if(!in_array($kate_wlyh, $_arr))
                    throw new Exception("InvaliD Kategori Wilayah");
                if(!is_numeric($idwlyh))
                    throw new Exception("Invalid ID Map");
                
                $userid= $this->session->userdata(SESSION_LOGIN)->id;
                $str="";
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - START
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                if($kate_wlyh=="PROV"){
                    
                    /*
                     * check data PROV - start
                     */
                    $sql = "SELECT A.`id`
                            FROM `provinsi` A
                            WHERE A.`id`=?";
                    $bind = array($idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL1!");
                    }
                    if($list_data->num_rows() ==0){
                        $msg = $session->userid." ".$this->router->fetch_class()." : Prov ID : ".$idwlyh." not found";
                        log_message("error", $msg);
                        throw new Exception("Data Provinsi tidak ditemukan!");
                    }
                    /*
                     * check data PROV - end
                     */
                    
                    //get LIST tautan doc
                     $sql = " SELECT A.`id` mapid,A.`judul`,A.`tautan`
                            FROM `t_doc_tahap_penilaian_prov` A
                            JOIN `tbl_user_wilayah` B ON B.`id`=A.`mapid` 
                            WHERE A.`isactive`='Y' AND A.tahap ='1' AND B.`iduser`=? AND B.`idwilayah`=? ";
                     
                    $bind = array($userid,$idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
                    }
                
                    
                    
                }
                
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    /*
                     * check data KAB / KOTA - start
                     */
                    $sql = "SELECT A.`id`
                            FROM `kabupaten` A
                            WHERE A.`id`=?";
                    $bind = array($idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL1!");
                    }
                    if($list_data->num_rows() ==0){
                        $msg = $session->userid." ".$this->router->fetch_class()." : Kab/Kota ID : ".$idwlyh." not found";
                        log_message("error", $msg);
                        throw new Exception("Data Kabupaten / Kota tidak ditemukan!");
                    }
                    /*
                     * check data KAB / KOTA - end
                     */
                    
                    //get LIST tautan doc
                    $sql = " SELECT A.`id` mapid,A.`judul`,A.`tautan`
                            FROM `t_doc_tahap_penilaian_kabkota` A
                            JOIN `tbl_user_kabkot` B ON B.`id`=A.`kbko` 
                            WHERE A.`isactive`='Y' AND A.tahap ='1' AND B.`iduser`=? AND B.`idkabkot`=? ";
                    
                    $bind = array($userid,$idwlyh);
                    $list_data = $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
                    }
                }
                
                
                /* 
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 * PEMBAGIAN QUERY PER KATEGORI WILAYAH - END
                 * +++++++++++++++++++++++++++++++++++++++++++++
                 */
                
                
                
                if($list_data->num_rows()==0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
                
                $no=1;
                $lnk='https';
                foreach ($list_data->result() as $v) {
                    $idcomb = $kate_wlyh."-".$v->mapid;
                    $encrypted_id= base64_encode(openssl_encrypt($idcomb,"AES-128-ECB",ENCRYPT_PASS));
                    $tmp = "class='btnDel' data-id='".$encrypted_id."'";
                    $tmp .= " data-title='".$v->judul."'";
                    
                    $idcomb1 = $kate_wlyh."-".$v->mapid;
                    $encrypted_id1= base64_encode(openssl_encrypt($idcomb1,"AES-128-ECB",ENCRYPT_PASS));
                    $tmped = "class='btnEdi' data-id='".$encrypted_id1."'";
                    $tmped .= " data-nama='".$v->judul."'";
                    $tmped .= " data-file='".$v->tautan."'";
                    
                    if(substr($v->tautan,0, 5)=='https'){ $link=$v->tautan; }
                    else { $tautan= substr($v->tautan, 4); $link = $lnk.$tautan; }
                    
                    if(substr($v->tautan, -3) == 'rar'){ $rename = $v->judul.".rar"; }
                    elseif(substr($v->tautan, -3) == 'zip'){ $rename = $v->judul.".zip"; }
                    elseif(substr($v->tautan, -3) == 'pdf'){ $rename = $v->judul.".pdf"; }
                    elseif (substr($v->tautan, -4) == 'docx') { $rename = $v->judul.".docx"; }
                    elseif (substr($v->tautan, -4) == 'xlsx') { $rename = $v->judul.".xlsx"; }
                    elseif (substr($v->tautan, -4) == 'jpeg') { $rename = $v->judul.".jpeg"; }
                    elseif (substr($v->tautan, -4) == 'pptx') { $rename = $v->judul.".pptx"; }
                    else{ $rename = $v->judul; }
                    
                    $str.="<tr>";
                    $str.="<td class='text-right'>".$no++."</td>";
                    $str.="<td class=''><a href='".$link."' download='$rename' target='_blank' title='Klik untuk unduh dokumen' >".wordwrap($v->judul,50,"<br/>")."</a></td>";
                    $str.="<td  class=''><a href='$link' download='$rename' target='_blank' class='btn btn-xs btn-outline-info waves-purple waves-light '  title='Unduh Data'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                    $str.="<td  class=''><a href='javascript:void(0)' ".$tmped." class='text-danger btn btn-sm ' title='Edit Data'><i class='text fas fa-pencil-alt'></i></a></td>";
                    $str.="<td  class=''><a href='javascript:void(0)' ".$tmp." class='text-danger btn btn-sm ' title='Hapus Data'><i class='text fas fa-trash-alt text-danger'></i></a></td>";
                       $str.="</tr>";
                }
                
                
                
                $response = array(
                    "status"            => 1,   
                    "csrf_hash"         => $this->security->get_csrf_hash(),
                    "str"               => $str,
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
     * delete data dokumen penilaian Provinsi
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
//                $id = decrypt_base64($this->input->post("id"));
//                if(!is_numeric($id))
//                    throw new Exception("Invalid ID");
                
                $idcomb = decrypt_base64($this->input->post("id"));
                
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                if($kate_wlyh=="PROV"){
                    //check data
                    $sql= "SELECT * FROM t_doc_tahap_penilaian_prov WHERE id=".$idmap;

                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        log_message("error", $this->db->error()["message"]);
                        throw new Exception("Invalid SQL");
                    }
                    if($list_data->num_rows() == 0)
                        throw new Exception("Data tidak ditemukan",3);

                    $nm = $list_data->row()->judul;
                    $this->db->trans_begin();
                    $sql= "UPDATE t_doc_tahap_penilaian_prov SET isactive = 'N', up_dt='".$this->session->userdata(SESSION_LOGIN)->userid."', up_by='".$current_date_time."' WHERE id=".$idmap ;

                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        if($this->db->error()["code"] == 1451)
                            throw new Exception($this->db->error()["code"].":Data tidak dapat dihapus karena terkait dengan data yang lain");
                        else
                            throw new Exception($this->db->error()["code"].":Failed delete data");
                    }
                }
                
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    
                    //check data
                    $sql= "SELECT * FROM t_doc_tahap_penilaian_kabkota WHERE id=".$idmap;

                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        log_message("error", $this->db->error()["message"]);
                        throw new Exception("Invalid SQL");
                    }
                    if($list_data->num_rows() == 0)
                        throw new Exception("Data tidak ditemukan",3);

                    $nm = $list_data->row()->judul;
                    $this->db->trans_begin();
                    $sql= "UPDATE t_doc_tahap_penilaian_kabkota SET isactive = 'N', up_dt='".$this->session->userdata(SESSION_LOGIN)->userid."', up_by='".$current_date_time."' WHERE id=".$idmap ;

                    $list_data = $this->db->query($sql);
                    if(!$list_data){
                        if($this->db->error()["code"] == 1451)
                            throw new Exception($this->db->error()["code"].":Data tidak dapat dihapus karena terkait dengan data yang lain");
                        else
                            throw new Exception($this->db->error()["code"].":Failed delete data");
                    }
                    
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
     * insert data penilaian Prov
     * author : FSM 
     * date : 17 des 2020
     */
    function save_p()
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
                
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                
                $inp_nm     = $this->input->post("nama");
                $userid= $this->session->userdata(SESSION_LOGIN)->id;
                
                //upload file dokumen
                $inp_urldoc="";
                if(file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/penilaian_tpitpu/';
                    $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
                    $config['max_size']	= '900000'; //900 Mb
                    $config['encrypt_name']	= TRUE;
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("attch")){
                        throw new Exception($this->upload->display_errors("",""),0);
                    }
                    //uploaded data
                    $upload_file = $this->upload->data();
                    $inp_urldoc = base_url("attachments/penilaian_tpitpu/").$upload_file['file_name'];
                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                /*
                * check data Prov - start
                */
                if($kate_wlyh=="PROV"){
                 
                //cek id wilayah
                $sql_w="SELECT * FROM tbl_user_wilayah WHERE iduser=? AND idwilayah=?";
                $bind_w = array($userid,$idmap);
                $list_data_w= $this->db->query($sql_w,$bind_w);
                if(!$list_data_w){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL1!");
                }
                foreach ($list_data_w->result() as $w) {
                    $idwil=$w->id;
                }
                
                //cek duplikasi
                $sql = " SELECT A.`id`,A.`judul`,A.`tautan`
                            FROM `t_doc_tahap_penilaian_prov` A
                            JOIN `tbl_user_wilayah` B ON B.`id`=A.`mapid` 
                            WHERE A.`isactive`='Y' AND A.tahap ='1' AND B.idwilayah=? AND judul=? AND B.`iduser`=?";
             //   print_r($sql);exit();
                $bind = array($idmap,$inp_nm,$userid);
                $list_data= $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL2!");
                }
                if($list_data->num_rows()>0){
                    throw new Exception("Duplikasi Nama Dokumen!");
                }
                // add record
                $this->m_ref->setTableName("t_doc_tahap_penilaian_prov");
                $data_baru = array(
                    "mapid"     => $idwil,
                    "judul"     => $inp_nm,
                    "tautan"    => $inp_urldoc,
                    "isactive"  => 'Y',
                    "tahap"     => '1',
                    "cr_dt"     => $current_date_time,
                    "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                );
                $status_save = $this->m_ref->save($data_baru);
                if(!$status_save){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception($this->db->error()["code"].":Failed save data",0);
                }
                
                }
                /*
                * check data KAB / KOTA - start
                */
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                
                    //cek id wilayah kab kota
                    $sql_w="SELECT * FROM tbl_user_kabkot WHERE iduser=? AND idkabkot=?";
                    $bind_w = array($userid,$idmap);
                    $list_data_w= $this->db->query($sql_w,$bind_w);
                    if(!$list_data_w){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL1!");
                    }
                    foreach ($list_data_w->result() as $w) {
                        $idwil=$w->id;
                    }

                    //cek duplikasi
                    $sql = " SELECT A.`id` mapid,A.`judul`,A.`tautan`
                                FROM `t_doc_tahap_penilaian_kabkota` A
                                JOIN `tbl_user_kabkot` B ON B.`id`=A.`kbko` 
                                WHERE A.`isactive`='Y' AND A.tahap ='1' AND B.`idkabkot`=? AND judul=? AND B.`iduser`=?  ";
                    $bind = array($idmap,$inp_nm,$userid);
                    $list_data= $this->db->query($sql,$bind);
                    if(!$list_data){
                        $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                        log_message("error", $msg);
                        throw new Exception("Invalid SQL2!");
                    }
                    if($list_data->num_rows()>0){
                        throw new Exception("Duplikasi Nama Dokumen!");
                    }
                    // add record
                    $this->m_ref->setTableName("t_doc_tahap_penilaian_kabkota");
                    $data_baru = array(
                        "kbko"      => $idwil,
                        "judul"     => $inp_nm,
                        "tautan"    => $inp_urldoc,
                        "isactive"  => 'Y',
                        "tahap"     => '1',
                        "cr_dt"     => $current_date_time,
                        "cr_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    );
                    $status_save = $this->m_ref->save($data_baru);
                    if(!$status_save){
                        log_message("error", $this->db->error()["message"]);
                        throw new Exception($this->db->error()["code"].":Failed save data",0);
                    }
                
                    
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
                $tmp = explode('-', $idcomb);
                if(count($tmp)!=2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $idmap = $tmp[1];
                
                $inp_nm     = $this->input->post("nama");
                
                if($kate_wlyh=="PROV"){
                    //cek duplikasi
                    $sql = "SELECT id, judul nm FROM t_doc_tahap_penilaian_prov WHERE id=? ";
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
                            $config['upload_path'] = './attachments/penilaian_tpitpu/';
                            $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
                            $config['max_size']	= '300000'; //30 Mb
                            $config['encrypt_name']	= TRUE;
                            $this->load->library('upload');
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload("filedok")){
                                throw new Exception($this->upload->display_errors("",""),0);
                            }
                            //uploaded data
                            $upload_file = $this->upload->data();
                            $inp_urldoc = base_url("attachments/penilaian_tpitpu/").$upload_file['file_name'];
                        }

                        //update
                        $this->m_ref->setTableName("t_doc_tahap_penilaian_prov");
                        $data_baru = array(
                            "judul"      => $inp_nm,
                            "tautan"   => $inp_urldoc,
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
                        $this->m_ref->setTableName("t_doc_tahap_penilaian_prov");
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
                }
                 /*
                * check data KAB / KOTA - start
                */
                elseif($kate_wlyh=="KAB" || $kate_wlyh=="KOTA"){
                    //cek duplikasi
                    $sql = "SELECT id, judul nm FROM t_doc_tahap_penilaian_kabkota WHERE id=? ";
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
                            $config['upload_path'] = './attachments/penilaian_tpitpu/';
                            $config['allowed_types'] = "doc|docx|pdf|xlsx|xls|csv|mp4|jpg|jpeg|zip|pptx|ppt|rar|avi|";
                            $config['max_size']	= '300000'; //30 Mb
                            $config['encrypt_name']	= TRUE;
                            $this->load->library('upload');
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload("filedok")){
                                throw new Exception($this->upload->display_errors("",""),0);
                            }
                            //uploaded data
                            $upload_file = $this->upload->data();
                            $inp_urldoc = base_url("attachments/penilaian_tpitpu/").$upload_file['file_name'];
                        }

                        //update
                        $this->m_ref->setTableName("t_doc_tahap_penilaian_kabkota");
                        $data_baru = array(
                            "judul"      => $inp_nm,
                            "tautan"    => $inp_urldoc,
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
                        $this->m_ref->setTableName("t_doc_tahap_penilaian_kabkota");
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
