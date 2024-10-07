<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module_2 extends CI_Controller {
    var $view_dir   = "admin/module_2/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/module_2/module_2.js";
    
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
                $this->js_path    = "assets/js/admin/module_2/module_2_".$this->session->userdata(SESSION_LOGIN)->groupid.".js";
                
                $data_page = array( );
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
                $satkercode = $this->session->userdata(SESSION_LOGIN)->unit_code;
                $idx = 0;
                $columns = array( 
                // datatable column index  => database column name
                    $idx++   =>'AA.`id_kode`', 
                    $idx++   =>'AA.`nama_provinsi`',
                );
                $sql = "SELECT AA.* "
                        . "FROM provinsi AA "
                        . "WHERE 1=1 ";
                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                        $sql.=" AND ( "
                                . " AA.`id_kode` LIKE '%".$requestData['search']['value']."%' "
                                . " OR AA.`nama_provinsi` LIKE '%".$requestData['search']['value']."%' "
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
                    $title  = $row->nama_provinsi;

                    $nestedData[] = $row->id_kode;
                    $nestedData[] = $row->nama_provinsi;
                    $nestedData[] = "";
                    $nestedData[] = ""
                            . " "
                            . "<a class='btn btn-xs btn-info edit' data-id='".encrypt_text($id)."' title='Edit Data'><i class='fa fa-pencil'></i></a>";

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
                
                $this->m_ref->setTableName("provinsi");
                $select = array();
                $cond = array(
                    "id_kode"  => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select,$cond);
                if($list_data->num_rows() == 0){throw new Exception("Data not found, please reload this page!",0);}
               // $penilai=
                foreach ($list_data->result() as $v) {
                    $nama_provinsi = $v->nama_provinsi;
                    
                }
                $query="";
                
                $this->m_ref->setTableName("tbl_indikator");
                $select_i = array();
                $cond_i = array(
//                    "idkreteria" => '2'
                );
                $list_data_i2 = $this->m_ref->get_by_condition($select_i,$cond_i);
                $content = "";             
                $content.="<table id=\"tbl_kp\" class=\"table table-striped table-bordered table-hover\"><thead>"
                        . "<tr><th>No</th><th>Indikator</th><th>Bobot</th><th>Status Penilaian</th></tr>"
                        . "</thead>";
                $content.="<tbody>";
                $no=1;
                $content2 = "";             
                $content2.="<table id=\"tbl_ket\" class=\"table table-striped table-bordered table-hover\"><thead>"
                        . "<tr><th>No</th><th>Indikator</th><th>Bobot</th><th>Status Penilaian</th></tr>"
                        . "</thead>";
                $content2.="<tbody>";
                $content3 = "";             
                $content3.="<table id=\"sample_1\" class=\"table table-striped table-bordered table-hover\"><thead>"
                        . "<tr><th>No</th><th>Indikator</th><th>Bobot</th><th>Status Penilaian</th></tr>"
                        . "</thead>";
                $content3.="<tbody>";
                $content4 = "";             
                $content4.="<table id=\"sample_1\" class=\"table table-striped table-bordered table-hover\"><thead>"
                        . "<tr><th>No</th><th>Indikator</th><th>Bobot</th><th>Status Penilaian</th></tr>"
                        . "</thead>";
                $content4.="<tbody>";
                $content5 = "";             
                $content5.="<table id=\"sample_1\" class=\"table table-striped table-bordered table-hover\"><thead>"
                        . "<tr><th>No</th><th>Indikator</th><th>Bobot</th><th>Status Penilaian</th></tr>"
                        . "</thead>";
                $content5.="<tbody>";
                $no=1;
                foreach ($list_data_i2->result() as $r_ti2) {
                    if($r_ti2->idkreteria == 1){
                        $id      = $r_ti2->id;
                        $content.="<tr class='odd gradeX'>";
                        $content.="<td>".$r_ti2->no_indikator."</td>";
                        $content.="<td>".$r_ti2->nama_indikator."</td>";
                        $content.="<td>".$r_ti2->bobot."%</td>";
                        //$content.="<td><a class='btn btn-xs btn-info isinilai' data-id='".encrypt_text($id)."' title='Isi Nilai'><i class='fa fa-pencil'></i></a></td>";
                        $content.="<td><h5 class='text-primary font-16 m-0'>Belum Lengkap</h5></td>";
                        $content.="</tr>";
                    }
                    if($r_ti2->idkreteria == 2){
                        $content2.="<tr class='odd gradeX'>";
                        $content2.="<td>".$r_ti2->no_indikator."</td>";
                        $content2.="<td>".$r_ti2->nama_indikator."</td>";
                        $content2.="<td>".$r_ti2->bobot."%</td>";
                        $content2.="<td></td>";
                        $content2.="</tr>";
                    }    
                    if($r_ti2->idkreteria == 3){
                        $content3.="<tr class='odd gradeX'>";
                        $content3.="<td>".$r_ti2->no_indikator."</td>";
                        $content3.="<td>".$r_ti2->nama_indikator."</td>";
                        $content3.="<td>".$r_ti2->bobot."%</td>";
                        $content3.="<td></td>";
                        $content3.="</tr>";
                    }
                    if($r_ti2->idkreteria == 4){
                        $content4.="<tr class='odd gradeX'>";
                        $content4.="<td>".$r_ti2->no_indikator."</td>";
                        $content4.="<td>".$r_ti2->nama_indikator."</td>";
                        $content4.="<td>".$r_ti2->bobot."%</td>";
                        $content4.="<td></td>";
                        $content4.="</tr>";
                    }
                    if($r_ti2->idkreteria == 5){
                        $content5.="<tr class='odd gradeX'>";
                        $content5.="<td>".$r_ti2->no_indikator."</td>";
                        $content5.="<td>".$r_ti2->nama_indikator."</td>";
                        $content5.="<td>".$r_ti2->bobot."%</td>";
                        $content5.="<td></td>";
                        $content5.="</tr>";
                    }
                }
                $content.="</tbody>";
                $content.="</table>";
                $content2.="</tbody>";
                $content2.="</table>";
                $content3.="</tbody>";
                $content3.="</table>";
                $content4.="</tbody>";
                $content4.="</table>";
                $content5.="</tbody>";
                $content5.="</table>";
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
                    "data"      =>  $list_data->result(),
                    "tbl_pencapaian"       =>  $content,
                    "tbl_keterkaitan"       =>  $content2,
                    "tbl_konsistensi"       =>  $content3,
                    "tbl_kk"       =>  $content4,
                    "tbl_inovasi"       =>  $content5,
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
}
