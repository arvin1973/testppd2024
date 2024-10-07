<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module_1_PPD3 extends CI_Controller {
    var $view_dir   = "admin/module/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/module/module.js";
    
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
                $this->js_path    = "assets/js/admin/module/module_".$this->session->userdata(SESSION_LOGIN)->groupid.".js";
                

                $data_page = array( );
                $str = $this->load->view($this->view_dir."content_PPD3",$data_page,TRUE);

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
                    $idx++   =>'K.`id_kode`', 
                    $idx++   =>'K.`nama_kabupaten`',
                    $idx++   =>'K.`prov_id`',
                );
                
//                $sql = "SELECT MP.id,MP.`id_kode`,MP.`nama_provinsi`, KK.`status` 
//                        FROM `provinsi` MP
//                        LEFT JOIN (SELECT * FROM `tbl_status_penilaian` WHERE `userid` = '$userid' ) KK ON KK.`provid` = MP.id
//                        WHERE 1=1 ";
                $sql = "SELECT K.* 
                        FROM `kabupaten` K
                        LEFT JOIN `provinsi` P ON P.id_kode = K.prov_id
                        WHERE P.id ='14' ";            
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " K.`id_kode` LIKE '%".$requestData['search']['value']."%' "
                                . " OR K.`nama_kabupaten` LIKE '%".$requestData['search']['value']."%' "
                                . " OR K.`prov_id` LIKE '%".$requestData['search']['value']."%' "
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
                    $id      = $row->id_kode;
                    $title  = $row->nama_kabupaten;
                    $nestedData[] = $row->id_kode;
                    $nestedData[] = $row->nama_kabupaten;
//                    if($row->status==''){
//                        $nestedData[] = "<a class='btn btn-xs btn-danger edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h7> Belum Diisi</h7></a>";}
//                    if($row->status=='1'){
//                        $nestedData[] = ""
//                    . "<a class='btn btn-xs btn-warning edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h7>Belum Lengkap</h7></a>";}
//                    if($row->status=='2'){
//                         $nestedData[] = ""
//                    . "<a class='btn btn-xs btn-success edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i><h6 class='mt-3 mb-0'><small>Sudah Diisi</small></h6></a>";}
                    
                    //$nestedData[] = $row->status;
                   // $nestedData[] = "";
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
               
//                $this->m_ref->setTableName("provinsi");
//                $select = array();
//                $cond = array(
//                    "id_kode"  => $id,
//                );
//                $list_data = $this->m_ref->get_by_condition($select,$cond);
//                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
//               // $penilai=
//                foreach ($list_data->result() as $v) {
//                    $nama_provinsi = $v->nama_provinsi;
//                    
//                }
                $query="";
                
                $this->m_ref->setTableName("tbl_kriteria");
                $select_i = array();
                $cond_i = array(
                    "idmodule" => $id,
                );
                $list_data_i2 = $this->m_ref->get_by_condition($select_i,$cond_i);
                 //print_r($list_data_i2);exit();
                $content = "";        
                
                $no=1;
                $content2 = "";             
                

                foreach ($list_data_i2->result() as $r_ti2) {
                    
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' data-nomor='".$r_ti2->id.". ".$r_ti2->id."' data-bobot='".$r_ti2->bobot."'>".$r_ti2->id."</a></td>";
                        $content.="<td><a class='isinilai' data-id='".encrypt_text($id)."' data-nomor='".$r_ti2->nama_kriteria.". ".$r_ti2->nama_kriteria."' data-bobot='".nama_kriteria."'>".nama_kriteria."</a></td>";
                        
                   
                        $content.="</tr>";
                    
                }
                
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
                    "profile"       =>  $this->session->userdata(SESSION_LOGIN)->name,
                    "nama_provinsi"    =>  $nama_provinsi,
//                    "str_dk"    =>  $str_dk,
//                    "str_ksp"    =>  $str_ksp,
//                    "str_p2t"    =>  $str_p2t,
//                    "str_pd"    =>  $str_pd,
//                    "str_pkk"    =>  $str_pkk,
//                    "str_mtlkk"    =>  $str_mtlkk,
//                    "str_mtp"    =>  $str_mtp,
//                    "str_karang"    =>  $str_karang,
//                    "str_tpa"   =>$str_tpa,
//                    "str_rm"   =>$str_rm,
//                    "str_kp"   =>$str_kp,                    
                  //  "data"      =>  $list_data->result(),
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
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->noskor."</a></td>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->item_penilaian."</a></td>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->kspi_nol."</a></td>";
                        $content.="<td><a class='' data-id='".encrypt_text($id)."' >".$r_ti2->kspi_satu."</a></td>";
                        $content.="<td><a class='isiskor' data-id='".encrypt_text($id)."' ></a></td>";
                        $content.="</tr>";
                }
                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
//                    "profile"       =>  $this->session->userdata(SESSION_LOGIN)->name,
  //                  "nama_provinsi"    =>  $nama_provinsi,                    
 //                   "data"      =>  $list_data->result(),
                    "table_ktg_skor"       =>  $content,
//                    "tbl_keterkaitan"       =>  $content2,
//                    "tbl_konsistensi"       =>  $content3,
//                    "tbl_kk"       =>  $content4,
//                    "tbl_inovasi"       =>  $content5,
                    //"id"      => encrypt_text($id),
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
