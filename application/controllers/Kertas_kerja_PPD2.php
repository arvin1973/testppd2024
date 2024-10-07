<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kertas_kerja_PPD2 extends CI_Controller {
    var $view_dir   = "admin/kertas_kerja/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/kertas_kerja/kertas_kerja.js";
    
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
                $this->js_path    = "assets/js/admin/kertas_kerja/kertas_kerja_".$this->session->userdata(SESSION_LOGIN)->groupid.".js";
                
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $sql = "SELECT MP.id,MP.`id_kode` AS KODE,MP.`nama_provinsi` AS NAMA, KK.`status`, KT.attch
                        FROM `provinsi` MP
                        LEFT JOIN (SELECT * FROM `tbl_status_penilaian` WHERE `userid` = '".$userid."'  ) KK ON KK.`provid` = MP.id
                        LEFT JOIN `tbl_user_wilayah` W ON W.idwilayah = MP.id
                        LEFT JOIN (SELECT * FROM `tbl_kertas_kerja` WHERE `user` = '".$userid."' ) KT ON KT.`idwilayah` = MP.id_kode
                        WHERE W.iduser='".$userid."'  
                        UNION ALL             
                        SELECT MK.id,MK.`id_kab` AS KODE,MK.`nama_kabupaten` AS NAMA,KK.`status`, KT.attch 
                        FROM `kabupaten` MK
                        LEFT JOIN (SELECT * FROM `tbl_status_penilaian_kk` WHERE `userid` = '".$userid."'  ) KK ON KK.`idkabkot` = MK.id
                        LEFT JOIN `tbl_user_kabkot` W ON W.idkabkot = MK.id
                        LEFT JOIN (SELECT * FROM `tbl_kertas_kerja` WHERE `user` = '".$userid."' ) KT ON KT.`idwilayah` = MK.id_kab
                        WHERE W.iduser='".$userid."'  ";
                //print_r($sql);exit();
                $list_satker = $this->db->query($sql);
                $content = "";
                $no=1;
                foreach ($list_satker->result() as $r_satker) {
                    $id      = $r_satker->id;
                    $content.="<tr class='odd gradeX'>";
                    $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' >".$no++."</a></td>";
                    $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_satker->NAMA."</a></td>";
                    if($r_satker->status==''){
                        $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Belum '><i class='fa fa-pencil'></i><h7> Belum Diisi</h7></a></td>";
                        $content.="<td style='font-size: 14px'></td>";
                    }
                    elseif($r_satker->status=='1'){
                        $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lenkapi Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        $content.="<td style='font-size: 14px'></td>";
                    }
                    elseif($r_satker->status=='2'){
                        $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-info btn-rounded waves-effect waves-light uploadK' data-id='".encrypt_text($id)."' data-nama='".$r_satker->NAMA."' data-berkas='".$r_satker->attch."' data-kode='".$r_satker->KODE."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Upload </h7></a></td>";
                    }
                    if($r_satker->attch !=''){
                    $content.="<td><a href=\"$r_satker->attch\" target=\"_blank\" class='btn btn-xs btn-outline-info waves-purple waves-light '  title='File Kertas Kerja'><i class='ion ion-md-archive'></i><h7 class='mt-3 mb-0'><small></small></h7></a></td>";
                    }else{
                        $content.="<td style='font-size: 14px'><a class='isiskor' \ ></a></td>";
                    }
                    
                    $content.="</tr>";    
                }
                
                $data_page = array( 
                    "content" => $content,
                );
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
    
    function add_act()
    {
        if($this->input->is_ajax_request()){
            try {
                if(!$this->session->userdata(SESSION_LOGIN)){
                    throw new Exception("Your session is ended, please relogin",2);
                }
                $this->form_validation->set_rules('select_prov','select_prov','required|xss_clean');
                $this->form_validation->set_rules('cname','cname','required|xss_clean');

                if($this->form_validation->run() == FALSE){
                    throw new Exception(validation_errors("", ""),0);
                }
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                
                //upload file dokumen
                $inp_urldoc="";
                if(file_exists($_FILES['attch']['tmp_name']) && is_uploaded_file($_FILES['attch']['tmp_name'])) {
                    //UPLOAD documents
                    $config['upload_path'] = './attachments/kertaskerja/';
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
                    $inp_urldoc = base_url("attachments/kertaskerja/").$upload_file['file_name'];
                }
                
                
                //cek data 
                $this->m_ref->setTableName("tbl_kertas_kerja");
                $select = array();
                $cond = array(
                    "user"       => $userid,
                    "idwilayah"  => $this->input->post("select_prov"),
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_data){
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if($list_data->num_rows() > 0){
                    $this->db->trans_begin();
                            $this->m_ref->setTableName("tbl_kertas_kerja");
                            $data_baru = array(
                                 "attch"     => $inp_urldoc,
                                "ud_by"      => $this->session->userdata(SESSION_LOGIN)->id,
                                "ud_dt"      => $current_date_time,
                            );
                            $cond = array(
                               "user"  => $userid,
                               "idwilayah"  => $this->input->post("select_prov"),
                                
                            );
                            $status_save = $this->m_ref->update($cond,$data_baru);
                            if(!$status_save){throw new Exception($this->db->error("code")." : Failed save data",0);}
                            $this->db->trans_commit();
                    
                } else {
                    $this->m_ref->setTableName("tbl_kertas_kerja");
                $data_baru = array(
                    "user"  => $userid,
                    "idwilayah"  => $this->input->post("select_prov"),
                    "attch"          => $inp_urldoc,
                    "cr_by"      => $this->session->userdata(SESSION_LOGIN)->id,
                    "cr_dt"       => $current_date_time,
                );
                $status_save = $this->m_ref->save($data_baru);
                if(!$status_save){
                    throw new Exception($this->db->error()["code"].":Failed save data",0);
                }
                }
                
                $sql = "SELECT MP.id,MP.`id_kode` AS KODE,MP.`nama_provinsi` AS NAMA, KK.`status`, KT.attch
                        FROM `provinsi` MP
                        LEFT JOIN (SELECT * FROM `tbl_status_penilaian` WHERE `userid` = '".$userid."'  ) KK ON KK.`provid` = MP.id
                        LEFT JOIN `tbl_user_wilayah` W ON W.idwilayah = MP.id
                        LEFT JOIN (SELECT * FROM `tbl_kertas_kerja` WHERE `user` = '".$userid."' ) KT ON KT.`idwilayah` = MP.id
                        WHERE W.iduser='".$userid."'  
                        UNION ALL             
                        SELECT MK.id,MK.`id_kab` AS KODE,MK.`nama_kabupaten` AS NAMA,KK.`status`, KT.attch 
                        FROM `kabupaten` MK
                        LEFT JOIN (SELECT * FROM `tbl_status_penilaian_kk` WHERE `userid` = '".$userid."'  ) KK ON KK.`idkabkot` = MK.id
                        LEFT JOIN `tbl_user_kabkot` W ON W.idkabkot = MK.id
                        LEFT JOIN (SELECT * FROM `tbl_kertas_kerja` WHERE `user` = '".$userid."' ) KT ON KT.`idwilayah` = MK.id
                        WHERE W.iduser='".$userid."'   ";
                //print_r($sql);exit();
                $list_satker = $this->db->query($sql);
                $content = "";
                $no=1;
                foreach ($list_satker->result() as $r_satker) {
                    $id      = $r_satker->id;
                    $content.="<tr class='odd gradeX'>";
                    $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' >".$no++."</a></td>";
                    $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_satker->NAMA."</a></td>";
                    if($r_satker->status==''){
                        $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-secondary waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Belum '><i class='fa fa-pencil'></i><h7> Belum Diisi</h7></a></td>";
                        $content.="<td style='font-size: 14px'></td>";
                    }
                    elseif($r_satker->status=='1'){
                        $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-warning waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lenkapi Penilaian'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a></td>";
                        $content.="<td style='font-size: 14px'></td>";
                    }
                    elseif($r_satker->status=='2'){
                        $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-outline-info waves-effect waves-light edit' data-id='".encrypt_text($id)."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Sudah Dinilai</h7></a></td>";
                        $content.="<td style='font-size: 14px'><a class='btn btn-xs btn-info btn-rounded waves-effect waves-light uploadK' data-id='".encrypt_text($id)."' data-nama='".$r_satker->NAMA."' data-berkas='".$r_satker->attch."' data-kode='".$r_satker->KODE."' title='Lihat Penilaian'><i class='fa fa-pencil'></i><h7>Upload </h7></a></td>";
                    }
                    $content.="<td style='font-size: 14px'><a class='isiskor' data-id='".encrypt_text($id)."' >".$r_satker->attch."</a></td>";
                    $content.="</tr>";    
                }
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "content" => $content,
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
    
  
    
}
