<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_modul_3 extends CI_Controller {
    //var $view_dir   = "ppd1/managementdata/mmodul3/";
    var $view_dir   = "ppd1/mmodul3/";
    var $js_init    = "main";
    var $js_path    = "assets/js/ppd1/managementdata/mmodul3/modu3.js";
    var $allowed    = array("PPD1");
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");       
    }
    
    /*
     * -
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
                $this->js_path    = "assets/js/ppd1/modul2/modul3.js?v=".now("Asia/Jakarta");
                
                $sql = "SELECT id, nama nm FROM `r_mdl3_aspek` WHERE isactive='Y'";
                $list_aspek= $this->db->query($sql);
                if(!$list_aspek){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                $sql = "SELECT id, nama nm FROM r_mdl3_krtria WHERE isactive='Y'";
                $list_krtria= $this->db->query($sql);
                if(!$list_krtria){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                $data_page = array(
                    "list_kriteria"=>   $list_krtria,
                    "list_aspek"   =>   $list_aspek
                );
                $str = $this->load->view($this->view_dir."index_ppd3",$data_page,TRUE);

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
     *  INDIKATOR                                                       - START
     * =========================================================================
     */
    
    /*
     * list data indikator
     * author :  
     * date : 7 des 2021
     */
    function g_indi(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                
                //LIST INDIKATOR
                $sql = "SELECT A.id idindi,B.id idkriteria,C.id idaspek,A.`nama` nmindi,A.`bobot` bobotindi,B.`nama` nmkriteria,B.`bobot` bobotkriteria,C.`nama` nmaspek,C.bobot bobotaspek,A.`note` noteindi
                        ,A.nourut
                        FROM `r_mdl3_indi` A
                        JOIN `r_mdl3_krtria` B ON B.`id`=A.`krtriaid`
                        JOIN `r_mdl3_aspek` C ON C.`id` = B.aspekid
                        ORDER BY B.`id`,A.nourut";
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                
                $str="";
                if($list_data->num_rows()==0)
                    $str = "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
                
                $no=1;
                $idkriteria= "";
                $idaspek ="";
                $no=1;
                foreach ($list_data->result() as $v) {
                    $encrypted_id= base64_encode(openssl_encrypt($v->idindi,"AES-128-ECB",ENCRYPT_PASS));
                    if($v->idaspek != $idaspek){
                        $str.="<tr class='alert-info' title='Kelengkapan Resume Aspek'>";
                        $str.="<td colspan='2' class='text-uppercase'><b><small>Aspek</small><br/>".$v->nmaspek."</b></td>";
                        $str.="<td colspan='' class='text-uppercase text-vertical-center text-right'><b>".number_format($v->bobotaspek,2)."&nbsp;%</b></td>";
                        $str.="<td></td>";
                        $str.="</tr>";
                        $idaspek = $v->idaspek;
                    }
                    if($v->idkriteria != $idkriteria){
                        $str.="<tr class='bg-secondary' title='Kegiatan'>";
                        $str.="<td colspan='2' class='text-uppercase'><b><small>Kriteria</small><br/>".$v->nmkriteria."</b></td>";
                        $str.="<td colspan='' class='text-uppercase text-vertical-center text-right'><b>".number_format($v->bobotkriteria,2)."&nbsp;%</b></td>";
                        $str.="<td></td>";
                        $str.="</tr>";
                        $idkriteria = $v->idkriteria;
                    }                    
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-nmkriteria='".$v->nmkriteria."'";
                    $tmp .= " data-nmindi='".$v->nmindi."'";
                    $str.="<tr>";
                    $str.="<td class='text-right'>".$v->nourut."</td>";
                    $str.="<td class='p-l-25'><a href='javascript:void(0)' ".$tmp.">".wordwrap($v->nmindi,50,"<br/>")."</a></td>";
                    
                    $str.="<td class='text-right'>".number_format($v->bobotindi,2)."&nbsp;%</td>";
                    
                    $tmp = " data-id='".$encrypted_id."' data-title='".$v->nmindi."' ";
                    $str_tmp = "<td>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-info btn btn-sm btnEdit' ><i class='fas fa-pencil-alt'></i></a>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-danger btn btn-sm btnDel' title=''><i class='text fas fa-trash-alt '></i></a>"
                            . "</td>";
                    $str.=$str_tmp;
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
     * insert data indikator
     * author :  
     * date : 7 des 2020
     */
    function save_indi()
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
                
                $this->form_validation->set_rules('kriter','Kriteria','required|xss_clean|numeric');
                $this->form_validation->set_rules('nama','Nama Indikator','required|xss_clean');
                $this->form_validation->set_rules('bobot','bobot','required|xss_clean|numeric');
                $this->form_validation->set_rules('nourut','No Urut','required|xss_clean|numeric');
                $this->form_validation->set_rules('note','Catatan','xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                
                $inp_kriter = $this->input->post("kriter");
                $inp_nm     = $this->input->post("nama");
                $inp_bobot  = $this->input->post("bobot");
                $inp_nourut = $this->input->post("nourut");
                $inp_note   = $this->input->post("note");

                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, nama nm FROM r_mdl3_indi WHERE krtriaid=? AND nama=?";
                $bind = array($inp_kriter,$inp_nm);
                $list_data= $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()>0){
                    throw new Exception("Duplikasi Nama Indikator!");
                }
                // add record
                $this->m_ref->setTableName("r_mdl3_indi");
                $data_baru = array(
                    "krtriaid"  => $inp_kriter,
                    "nama"      => $inp_nm,
                    "bobot"     => $inp_bobot,
                    "nourut"    => $inp_nourut,
                    "note"      => $inp_note,
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
     * delete data indikator
     * author :  
     * date : 7 des 2020
     */
    function delete_indi(){
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
                //check data
                $sql= "SELECT id,nama nm FROM r_mdl3_indi WHERE id=".$id;
              
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan",3);
                
                $nm = $list_data->row()->nm;
                $this->db->trans_begin();
                $sql= "DELETE FROM r_mdl3_indi WHERE id=".$id;
              
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
     * get detail data indikator
     * author :  
     * date : 7 nov 2021
     */
    function get_detail_indi()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_indi");
                $sel = array("id","krtriaid","nama nm","isactive","bobot","note","nourut");
                $cond = array(
                    "id"            => $id,
                );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()==0)
                    throw new Exception("Data Indikator tidak ditemukan",0);
                
                
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  $list_data->result(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage().$exc->getLine(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    /*
     * update data indikator
     * author :  
     * date : 7 des 2020
     */
    function update_indi()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID','required');
                $this->form_validation->set_rules('nama','Nama ','required|xss_clean');
                $this->form_validation->set_rules('note','Catatan','xss_clean');
                $this->form_validation->set_rules('stts','Status','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('bobot','bobot','required|xss_clean|numeric');
                $this->form_validation->set_rules('nourut','No Urut','required|xss_clean|numeric');

                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                $inp_nm     = $this->input->post("nama");
                $inp_note   = $this->input->post("note");
                $inp_stts   = $this->input->post("stts");
                $inp_bobot  = $this->input->post("bobot");
                $inp_nourut = $this->input->post("nourut");
                

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_indi");
                $sel    = array("id");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if($list_data->num_rows()==0)
                    throw new Exception($this->lang->line("data_not_found"),0);
                
                $this->db->trans_begin();
                $this->m_ref->setTableName("r_mdl3_indi");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $data_ = array(
                    "nama"      => $inp_nm,
                    "bobot"     => $inp_bobot,
                    "nourut"    => $inp_nourut,
                    "note"      => $inp_note,
                    "isactive"  => $inp_stts,
                    "up_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    "up_dt"     => $current_date_time,
                );
                $status_save = $this->m_ref->update($cond,$data_);
                if(!$status_save){
                    if($this->db->error()["code"]==1062)
                        throw new Exception("Duplikasi Data : ".$inp_nm);
                    else
                        throw new Exception($this->db->error()["code"]." : ".$this->lang->line('failed_update_data').$this->db->error()["message"],0);
                }
                
                
                //sukses
                $this->db->trans_commit();
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Data berhasil diperbarui",
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"    =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    /*
     * =========================================================================
     *  INDIKATOR                                                       - END
     * =========================================================================
     */
    /*
     * =========================================================================
     *  SUB INDIKATOR                                                   - START
     * =========================================================================
     */
   /*
     * list data sub indikator
     * author :  
     * date : 18 nov 2020
     */
    function g_sindi(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                
                if(!in_array($session->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                
                $this->form_validation->set_rules('id','ID Indi','required');

                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID Indikator");

                    /*
                    * =========================================================================
                    *  list Judul atau List Dinilai                                       - Star
                    * =========================================================================
                    */

                $sql = "SELECT A.`id` idjudul,A.`nama` nmjudul,istampil,isprov
                        FROM `r_mdl3_item_judul` A
                        WHERE A.`indiid`=?
                        ORDER BY A.id ASC";
                $bind = array($id);
                $list_data = $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL1!");
                }
                $str_j="";
                if($list_data->num_rows()==0)
                    $str_j = "<tr><td colspan='6'>Data tidak ada</td></tr>";
                $no=1;
                foreach ($list_data->result() as $v) {
                    $encrypted_id= base64_encode(openssl_encrypt($v->idjudul,"AES-128-ECB",ENCRYPT_PASS));
                                      
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-nm='".$v->nmjudul."'";
                    $str_j.="<tr>";
                    $str_j.="<td class='text-right'>".$no++."</td>";
                    $str_j.="<td class='p-l-25'>".wordwrap($v->nmjudul,100,"<br/>")."</td>";
                    
                    $str_tmp = "<span class='text-success' title='Ya'><i class='fas fa-check-circle'></i></span>";
                    if($v->istampil!='Y')
                        $str_tmp = "<span class='text-danger' title='Tidak'><i class='fas fa-times-circle'></i></span>";
                    $str_j.="<td class='text-center'>".$str_tmp."</td>";
                    
                    $str_tmp = "<span class='text-success' title='Ya'><i class='fas fa-check-circle'></i></span>";
                    if($v->isprov!='Y')
                        $str_tmp = "<span class='text-danger' title='Tidak'><i class='fas fa-times-circle'></i></span>";
                    $str_j.="<td class='text-center'>".$str_tmp."</td>";
                
                    
                    $tmp = " data-id='".$encrypted_id."' data-title='".$v->nmjudul."' ";
                    $str_tmp = "<td>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-info btn btn-sm btnEdit' ><i class='fas fa-pencil-alt'></i></a>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-danger btn btn-sm btnDel' title=''><i class='text fas fa-trash-alt '></i></a>"
                            . "</td>";
                    $str_j.=$str_tmp;
                    $str_j.="</tr>";
                }
                
                /*
                    * =========================================================================
                    *  list Judul atau List Dinilai                                       - End
                    * =========================================================================
                    */
                /*
                    * =========================================================================
                    *  LIST SUB INDIKATOR                                                - Star
                    * =========================================================================
                    */
                    
                $sql = "SELECT A.`id` idsindi,A.`nama` nmsindi,istampil,isprov,nourut
                        FROM `r_mdl3_sub_indi` A
                        WHERE A.`indiid`=?
                        ORDER BY A.nourut ASC";
                $bind = array($id);
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
                $idkriteria= "";
                $no=1;
                foreach ($list_data->result() as $v) {
                    $encrypted_id= base64_encode(openssl_encrypt($v->idsindi,"AES-128-ECB",ENCRYPT_PASS));
                                      
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-nm='".$v->nmsindi."'";
                    $str.="<tr>";
                    $str.="<td class='text-right'>".$v->nourut."</td>";
                    $str.="<td class='p-l-25'><a href='javascript:void(0)' ".$tmp.">".wordwrap($v->nmsindi,100,"<br/>")."</a></td>";

                    
                    $str_tmp = "<span class='text-success' title='Ya'><i class='fas fa-check-circle'></i></span>";
                    if($v->istampil!='Y')
                        $str_tmp = "<span class='text-danger' title='Tidak'><i class='fas fa-times-circle'></i></span>";
                    $str.="<td class='text-center'>".$str_tmp."</td>";
                    
                    $str_tmp = "<span class='text-success' title='Ya'><i class='fas fa-check-circle'></i></span>";
                    if($v->isprov!='Y')
                        $str_tmp = "<span class='text-danger' title='Tidak'><i class='fas fa-times-circle'></i></span>";
                    $str.="<td class='text-center'>".$str_tmp."</td>";
                
                    
                    $tmp = " data-id='".$encrypted_id."' data-title='".$v->nmsindi."' ";
                    $str_tmp = "<td>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-info btn btn-sm btnEdit' ><i class='fas fa-pencil-alt'></i></a>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-danger btn btn-sm btnDel' title=''><i class='text fas fa-trash-alt '></i></a>"
                            . "</td>";
                    $str.=$str_tmp;
                    $str.="</tr>";
                }
                $response = array(
                    "status"    => 1,   
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"       => $str,
                    "str_j"       => $str_j,
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
     * insert data subindikator
     * author :  
     * date : 18 nov 2020
     */
    function save_sindi()
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
                
                $this->form_validation->set_rules('id','ID Indikator','required|xss_clean');
                $this->form_validation->set_rules('nama','Nama Indikator','required|xss_clean');
                $this->form_validation->set_rules('tampil','Status Tampil','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('tag_prov','Status Tampil Provinsi','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('note','Catatan','xss_clean');
                $this->form_validation->set_rules('nourut','No Urut','required|xss_clean|numeric');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID Indikator");
                
                $inp_nm     = $this->input->post("nama");
                $inp_tampil = $this->input->post("tampil");
                $inp_tagprov = $this->input->post("tag_prov");
                $inp_note   = $this->input->post("note");
                $inp_nourut = $this->input->post("nourut");

                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, nama nm FROM r_mdl3_sub_indi WHERE indiid=? AND nama=?";
                $bind = array($id,$inp_nm);
                $list_data= $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()>0){
                    throw new Exception("Duplikasi Sub Indikator!");
                }
                // add record
                $this->m_ref->setTableName("r_mdl3_sub_indi");
                $data_baru = array(
                    "indiid"    => $id,
                    "nama"      => $inp_nm,
                    "nourut"    => $inp_nourut,
                    "istampil"  => $inp_tampil,
                    "isprov"    => $inp_tagprov,
                    "note"      => $inp_note,
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
     * delete data sub indikator
     * author :  
     * date : 7 des 2020
     */
    function delete_sindi(){
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
                //check data
                $sql= "SELECT id,nama nm FROM r_mdl3_sub_indi WHERE id=".$id;
              //r_mdl3_sub_indi
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan",3);
                
                $nm = $list_data->row()->nm;
                $this->db->trans_begin();
                $sql= "DELETE FROM r_mdl3_sub_indi WHERE id=".$id;
              
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
     * get detail data sub indikator
     * author :  
     * date : 7 des 2020
     */
    function get_detail_sindi()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_sub_indi");
                $sel = array("id","istampil","isprov","nama nm","isactive","note","nourut");
                $cond = array(
                    "id"            => $id,
                );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()==0)
                    throw new Exception("Data Sub Indikator tidak ditemukan",0);
                
                
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  $list_data->result(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage().$exc->getLine(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    /*
     * update data sub indikator
     * author :  
     * date : 7 des 2020
     */
    function update_sindi()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID','required');
                $this->form_validation->set_rules('nama','Nama ','required|xss_clean');
                $this->form_validation->set_rules('stts','Status aktif','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('tampil','Status Tampil','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('tag_prov','Status Tampil Provinsi','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('note','Catatan','xss_clean');
                $this->form_validation->set_rules('nourut','No Urut','required|xss_clean|numeric');

                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                $inp_nm     = $this->input->post("nama");
                $inp_stts   = $this->input->post("stts");
                $inp_tampil = $this->input->post("tampil");
                $inp_tagprov= $this->input->post("tag_prov");
                $inp_note   = $this->input->post("note");
                $inp_nourut = $this->input->post("nourut");
                

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                
                //check data
                $this->m_ref->setTableName("r_mdl3_sub_indi");
                $sel    = array("id");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if($list_data->num_rows()==0)
                    throw new Exception("Data tidak ditemukan!",0);
                
                $this->db->trans_begin();
                $this->m_ref->setTableName("r_mdl3_sub_indi");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $data_ = array(
                    "nama"      => $inp_nm,
                    "istampil"  => $inp_tampil,
                    "isprov"    => $inp_tagprov,
                    "nourut"    => $inp_nourut,
                    "note"      => $inp_note,
                    "isactive"  => $inp_stts,
                    "up_by" => $this->session->userdata(SESSION_LOGIN)->userid,
                    "up_dt" => $current_date_time,
                );
                $status_save = $this->m_ref->update($cond,$data_);
                if(!$status_save){
                    if($this->db->error()["code"]==1062)
                        throw new Exception("Duplikasi Data : ".$inp_nm);
                    else
                        throw new Exception($this->db->error()["code"]." : ".$this->lang->line('failed_update_data').$this->db->error()["message"],0);
                }
                
                
                //sukses
                $this->db->trans_commit();
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Data berhasil diperbarui",
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"    =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    /*
     * =========================================================================
     *  SUB INDIKATOR                                                   - END
     * =========================================================================
     */
       
     /*
     * =========================================================================
     * author :  
     * date : 20 Mar 2022
     *  List Dinilai                                                   - Start  
     * =========================================================================
     */
    function save_dinil()
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
                
                $this->form_validation->set_rules('id','ID Indikator','required|xss_clean');
                $this->form_validation->set_rules('nama','Nama Indikator','required|xss_clean');
                $this->form_validation->set_rules('tampil','Status Tampil','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('tag_prov','Status Tampil Provinsi','required|xss_clean|in_list[Y,N]');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID Indikator");
                
                $inp_nm     = $this->input->post("nama");
                $inp_tampil = $this->input->post("tampil");
                $inp_tagprov = $this->input->post("tag_prov");

                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id,indiid, nama nm FROM `r_mdl3_item_judul` WHERE indiid=?";
                $bind = array($id);
                $list_data= $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()>0){
                    throw new Exception("Duplikasi Judul Item Dinilai!");
                }
                // add record
                $this->m_ref->setTableName("r_mdl3_item_judul");
                $data_baru = array(
                    "indiid"    => $id,
                    "nama"      => $inp_nm,
                    "istampil"  => $inp_tampil,
                    "isprov"    => $inp_tagprov,
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
    function delete_dinil(){
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
                //check data
                $sql= "SELECT id,nama nm FROM r_mdl3_item_judul WHERE id=".$id;
              
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan",3);
                
                $nm = $list_data->row()->nm;
                $this->db->trans_begin();
                $sql= "DELETE FROM r_mdl3_item_judul WHERE id=".$id;
              
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
    function get_detail_dinil()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_item_judul");
                $sel = array("id","istampil","isprov","nama nm","isactive");
                $cond = array(
                    "id"            => $id,
                );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()==0)
                    throw new Exception("Data item judul tidak ditemukan",0);
                
                
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  $list_data->result(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage().$exc->getLine(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    /*
     * update data dinilai item
     * author :  
     * date : 20 mar 2022
     */
    function update_dinil()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID','required');
                $this->form_validation->set_rules('nama','Nama ','required|xss_clean');
                $this->form_validation->set_rules('stts','Status aktif','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('tampil','Status Tampil','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('tag_prov','Status Tampil Provinsi','required|xss_clean|in_list[Y,N]');

                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                $inp_nm     = $this->input->post("nama");
                $inp_stts   = $this->input->post("stts");
                $inp_tampil = $this->input->post("tampil");
                $inp_tagprov= $this->input->post("tag_prov");
                

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_item_judul");
                $sel    = array("id");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if($list_data->num_rows()==0)
                    throw new Exception("Data tidak ditemukan!",0);
                
                $this->db->trans_begin();
                $this->m_ref->setTableName("r_mdl3_item_judul");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $data_ = array(
                    "nama"      => $inp_nm,
                    "istampil"  => $inp_tampil,
                    "isprov"    => $inp_tagprov,
                    "isactive"  => $inp_stts,
                    "up_by" => $this->session->userdata(SESSION_LOGIN)->userid,
                    "up_dt" => $current_date_time,
                );
                $status_save = $this->m_ref->update($cond,$data_);
                if(!$status_save){
                    if($this->db->error()["code"]==1062)
                        throw new Exception("Duplikasi Data : ".$inp_nm);
                    else
                        throw new Exception($this->db->error()["code"]." : ".$this->lang->line('failed_update_data').$this->db->error()["message"],0);
                }
                
                
                //sukses
                $this->db->trans_commit();
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Data berhasil diperbarui",
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"    =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    /*
     * =========================================================================
     *  List Dinilai                                                   - END
     * =========================================================================
     */
    /*
     * =========================================================================
     *  ITEM                                                            - START
     * =========================================================================
     */
    /*
     * list data sub indikator
     * author :  
     * date : 8 des 2020
     */
    function g_item(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                
                if(!in_array($session->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                
                $this->form_validation->set_rules('id','ID Sub Indi','required');

                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID Sub Indikator");
                
                //LIST SUB INDIKATOR
                $sql = "SELECT A.`id` iditem,A.`nama` nm,A.`isactive`,A.nourut
                        FROM `r_mdl3_item` A
                        WHERE A.`subindiid`=?
                        ORDER BY A.nourut ASC";
                $bind = array($id);
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
                    $encrypted_id= base64_encode(openssl_encrypt($v->iditem,"AES-128-ECB",ENCRYPT_PASS));
                    
                    
                    
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-nm='".$v->nm."'";
                    $str.="<tr>";
                    $str.="<td class='text-right'>".$v->nourut."</td>";
                    //$str.="<td class='p-l-25'><a href='javascript:void(0)' ".$tmp.">".wordwrap($v->nm,100,"<br/>")."</a></td>";
                    $str.="<td class='p-l-25'>".wordwrap($v->nm,100,"<br/>")."</td>";
                    
                    $str_tmp = "<span class='text-success' title='Ya'><i class='fas fa-check-circle'></i></span>";
                    if($v->isactive!='Y')
                        $str_tmp = "<span class='text-danger' title='Tidak'><i class='fas fa-times-circle'></i></span>";
                    $str.="<td class='text-center'>".$str_tmp."</td>";
                    
                    
                    $tmp = " data-id='".$encrypted_id."' data-title='".$v->nm."' ";
                    $str_tmp = "<td>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-info btn btn-sm btnEdit' ><i class='fas fa-pencil-alt'></i></a>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-danger btn btn-sm btnDel' title=''><i class='text fas fa-trash-alt '></i></a>"
                            . "</td>";
                    $str.=$str_tmp;
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
     * insert data item
     * author :  
     * date : 8 des 2020
     */
    function save_item()
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
                
                $this->form_validation->set_rules('id','ID Sub Indikator','required|xss_clean');
                $this->form_validation->set_rules('nama','Nama Item','required|xss_clean');
                $this->form_validation->set_rules('note','Catatan','xss_clean');
                $this->form_validation->set_rules('nourut','NO Urut','required|xss_clean|numeric');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID Sub Indikator");
                
                $inp_nm     = $this->input->post("nama");
                $inp_nourut = $this->input->post("nourut");
                $inp_note   = $this->input->post("note");

                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, nama nm FROM r_mdl3_item WHERE subindiid=? AND nama=?";
                $bind = array($id,$inp_nm);
                $list_data= $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()>0){
                    throw new Exception("Duplikasi Item!");
                }
                // add record
                $this->m_ref->setTableName("r_mdl3_item");
                $data_baru = array(
                    "subindiid" => $id,
                    "nama"      => $inp_nm,
                    "nourut"    => $inp_nourut,
                    "note"      => $inp_note,
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
     * delete data item
     * author :  
     * date : 8 des 2020
     */
    function delete_item(){
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
                //check data
                $sql= "SELECT id,nama nm FROM r_mdl3_item WHERE id=".$id;
              
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan",3);
                
                $nm = $list_data->row()->nm;
                $this->db->trans_begin();
                $sql= "DELETE FROM r_mdl3_item WHERE id=".$id;
              
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
     * get detail data item
     * author :  
     * date : 7 des 2020
     */
    function get_detail_item()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_item");
                $sel = array("id","nama nm","isactive","note","nourut");
                $cond = array(
                    "id"            => $id,
                );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()==0)
                    throw new Exception("Data Sub Indikator tidak ditemukan",0);
                
                
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  $list_data->result(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage().$exc->getLine(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    /*
     * update data item
     * author :  
     * date : 8 des 2020
     */
    function update_item()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID','required');
                $this->form_validation->set_rules('nama','Nama ','required|xss_clean');
                $this->form_validation->set_rules('nourut','No Urut','required|xss_clean|numeric');
                $this->form_validation->set_rules('stts','Status aktif','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('note','Catatan','xss_clean');

                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                $inp_nm     = $this->input->post("nama");
                $inp_stts   = $this->input->post("stts");
                $inp_note   = $this->input->post("note");
                $inp_nourut = $this->input->post("nourut");
                

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_item");
                $sel    = array("id");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if($list_data->num_rows()==0)
                    throw new Exception("Data tidak ditemukan!",0);
                
                $this->db->trans_begin();
                $this->m_ref->setTableName("r_mdl3_item");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $data_ = array(
                    "nama"      => $inp_nm,
                    "note"      => $inp_note,
                    "nourut"    => $inp_nourut,
                    "isactive"  => $inp_stts,
                    "up_by"     => $this->session->userdata(SESSION_LOGIN)->userid,
                    "up_dt"     => $current_date_time,
                );
                $status_save = $this->m_ref->update($cond,$data_);
                if(!$status_save){
                    if($this->db->error()["code"]==1062)
                        throw new Exception("Duplikasi Data : ".$inp_nm);
                    else
                        throw new Exception($this->db->error()["code"]." : ".$this->lang->line('failed_update_data').$this->db->error()["message"],0);
                }
                
                
                //sukses
                $this->db->trans_commit();
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Data berhasil diperbarui",
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"    =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    /*
     * =========================================================================
     *  ITEM                                                            - END
     * =========================================================================
     */
     /*
     * =========================================================================
     *  INDIKATOR PENILAIAN ITEM                                        - START
     * =========================================================================
     */
    /*
     * list data indikator penilaian item
     * author :  
     * date : 8 des 2020
     */
    function g_indiitem(){
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){session_write_close();throw new Exception("Session expired, please login",2);}
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                
                if(!in_array($session->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                
                $this->form_validation->set_rules('id','ID Item','required');

                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID Item");
                //LIST INDI PENILAIAN ITEM 
                $sql = "SELECT A.`id`,A.`nama` nm,A.`isactive`,A.skor,A.nourut
                        FROM `r_mdl3_item_indi` A
                        WHERE A.`itemid`=? 
                        ORDER BY A.nourut ASC";
                $bind = array($id);
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
                    $encrypted_id= base64_encode(openssl_encrypt($v->id,"AES-128-ECB",ENCRYPT_PASS));
                    
                    
                    
                    $tmp = "class='getDetail' data-id='".$encrypted_id."'";
                    $tmp .= " data-nm='".$v->nm."'";
                    $str.="<tr>";
                    $str.="<td class='text-right' title='No Urut'>".$v->nourut."</td>";
                    $str.="<td class='p-l-25'>".wordwrap($v->nm,100,"<br/>")."</td>";
                    $str.="<td class='text-right'>".$v->skor."</td>";
                    $str_tmp = "<span class='text-success' title='Aktif'><i class='fas fa-check-circle'></i></span>";
                    if($v->isactive!='Y')
                        $str_tmp = "<span class='text-danger' title='Tidak Aktif'><i class='fas fa-times-circle'></i></span>";
                    $str.="<td class='text-center'>".$str_tmp."</td>";
                    
                    
                    $tmp = " data-id='".$encrypted_id."' data-title='".$v->nm."' ";
                    $str_tmp = "<td>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-info btn btn-sm btnEdit' ><i class='fas fa-pencil-alt'></i></a>"
                            . "<a href='javascript:void(0)' ".$tmp." class='text-danger btn btn-sm btnDel' title=''><i class='text fas fa-trash-alt '></i></a>"
                            . "</td>";
                    $str.=$str_tmp;
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
     * insert data indikator penilaian item
     * author :  
     * date : 8 des 2020
     */
    function save_indiitem()
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
                
                $this->form_validation->set_rules('id','ID Item','required|xss_clean');
                $this->form_validation->set_rules('nama','Nama Item','required|xss_clean');
                $this->form_validation->set_rules('skor','Skor','required|xss_clean|numeric');
                $this->form_validation->set_rules('nourut','No Urut','required|xss_clean|numeric');
                $this->form_validation->set_rules('note','Catatan','xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID Sub Indikator");
                
                $inp_nm     = $this->input->post("nama");
                $inp_nourut = $this->input->post("nourut");
                $inp_note   = $this->input->post("note");
                $inp_skor   = $this->input->post("skor");

                
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek duplikasi
                $sql = "SELECT id, nama nm FROM r_mdl3_item_indi WHERE itemid=? AND nama=?";
                $bind = array($id,$inp_nm);
                $list_data= $this->db->query($sql,$bind);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()>0){
                    throw new Exception("Duplikasi Indikator Penilaian Item!");
                }
                // add record
                $this->m_ref->setTableName("r_mdl3_item_indi");
                $data_baru = array(
                    "itemid" => $id,
                    "nama"      => $inp_nm,
                    "nourut"    => $inp_nourut,
                    "skor"      => $inp_skor,
                    "note"      => $inp_note,
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
     * delete data indikator penilaian item
     * author :  
     * date : 8 des 2020
     */
    function delete_indiitem(){
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
                //check data
                $sql= "SELECT id,nama nm FROM r_mdl3_item_indi WHERE id=".$id;
              
                $list_data = $this->db->query($sql);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() == 0)
                    throw new Exception("Data tidak ditemukan",3);
                
                $nm = $list_data->row()->nm;
                $this->db->trans_begin();
                $sql= "DELETE FROM r_mdl3_item_indi WHERE id=".$id;
              
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
     * get detail data indikator item
     * author :  
     * date : 7 des 2020
     */
    function get_detail_indiitem()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID Data','required');
                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_item_indi");
                $sel = array("id","nama nm","isactive","note","skor","nourut");
                $cond = array(
                    "id"            => $id,
                );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if(!$list_data){
                    $msg = $session->userid." ".$this->router->fetch_class()." : ".$this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }
                if($list_data->num_rows()==0)
                    throw new Exception("Data Indikator Penilaian Item tidak ditemukan",0);
                
                
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Success",
                    "data"          =>  $list_data->result(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"       =>  $exc->getMessage().$exc->getLine(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    /*
     * update data indikator penilaian item
     * author :  
     * date : 8 des 2020
     */
    function update_indiitem()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN))
                    throw new Exception("Session berakhir, silahkan login ulang",2);
                
                if(!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)){
                    throw new Exception("You're not allowed access this page!",3);
                }
                $session = $this->session->userdata(SESSION_LOGIN);session_write_close();
                
                $this->form_validation->set_rules('id','ID','required');
                $this->form_validation->set_rules('nama','Nama ','required|xss_clean');
                $this->form_validation->set_rules('skor','Skor','required|xss_clean|numeric');
                $this->form_validation->set_rules('nourut','NO Urut','required|xss_clean|numeric');
                $this->form_validation->set_rules('stts','Status aktif','required|xss_clean|in_list[Y,N]');
                $this->form_validation->set_rules('note','Catatan','xss_clean');

                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                $inp_nm     = $this->input->post("nama");
                $inp_skor   = $this->input->post("skor");
                $inp_nourut = $this->input->post("nourut");
                $inp_stts   = $this->input->post("stts");
                $inp_note   = $this->input->post("note");

                
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                $id = decrypt_base64($this->input->post("id"));
                if(!is_numeric($id))
                    throw new Exception("Invalid ID");
                
                //check data
                $this->m_ref->setTableName("r_mdl3_item_indi");
                $sel    = array("id");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $list_data = $this->m_ref->get_by_condition($sel,$cond);
                if($list_data->num_rows()==0)
                    throw new Exception("Data tidak ditemukan!",0);
                
                $this->db->trans_begin();
                $this->m_ref->setTableName("r_mdl3_item_indi");
                $cond   = array(
                    "id"        =>  $id, 
                        );
                $data_ = array(
                    "nama"      => $inp_nm,
                    "note"      => $inp_note,
                    "skor"      => $inp_skor,
                    "nourut"    => $inp_nourut,
                    "isactive"  => $inp_stts,
                    "up_by" => $this->session->userdata(SESSION_LOGIN)->userid,
                    "up_dt" => $current_date_time,
                );
                $status_save = $this->m_ref->update($cond,$data_);
                if(!$status_save){
                    if($this->db->error()["code"]==1062)
                        throw new Exception("Duplikasi Data : ".$inp_nm);
                    else
                        throw new Exception($this->db->error()["code"]." : ".$this->lang->line('failed_update_data').$this->db->error()["message"],0);
                }
                
                
                //sukses
                $this->db->trans_commit();
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Data berhasil diperbarui",
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->db->trans_rollback();
                $output = array(
                    "status"    =>  $exc->getCode(),
                    "msg"    =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        }
        else{exit("Access Denied");}
    }
    
    /*
     * =========================================================================
     *  INDIKATOR PENILAIAN ITEM                                          - END
     * =========================================================================
     */
}
