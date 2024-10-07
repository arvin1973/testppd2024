<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Unduh Penilaian Prov
* author : FSM
 * date : 10 des 2020
*/
class PPD2_book extends CI_Controller {
    var $view_dir   = "admin/dokumen/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD2_unduh_nilai/ppd2.js";
    
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");
        $this->load->library("Excel");
    }
    
    
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
                $this->js_path    = "assets/js/ppd3/PPD3_unduh_nilai/t2/unduh_nilai_prov_view.js?v=".now("Asia/Jakarta");
                

                $data_page = array( );
                $str = $this->load->view($this->view_dir."index_ppd2_prov_v",$data_page,TRUE);

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
    
    function view_dokumen(){
        if(!$this->session->userdata(SESSION_LOGIN)){
            echo 'Token expired, Silakan login ';exit();
        }
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        $nama = $this->session->userdata(SESSION_LOGIN)->name;
        if($_GET['token']==''){
            echo 'Token ID';exit();
        }
        $idcomb = decrypt_base64($_GET['token']);
        $tmp = explode('-', $idcomb);
        if(count($tmp)!=2){
            echo 'Invalid token';exit();
        }
        $kate_wlyh = $tmp[0];
        $idwil  = $tmp[1];
        //$tautan = $tmp[2];
        $_arr = array("prov","kota","kabupaten","umum");
        if(!in_array($kate_wlyh, $_arr)){
            echo 'InvaliD Kategori Wilayah';exit();
        }
        $tautan = $_GET['linknm'];
         $data_page = array(
            "msg"       =>  $tautan,
            "page_title"    => "DOKUMEN PENDUKUNG ",
        );
        $this->load->view($this->view_dir.'dokumen_prov',$data_page);
    }
    
    function dok_view(){
        if(!$this->session->userdata(SESSION_LOGIN)){
            echo 'Token expired, Silakan login ';exit();
        }
        $user = $this->session->userdata(SESSION_LOGIN)->id;
        $nama = $this->session->userdata(SESSION_LOGIN)->name;
        if($_GET['token']==''){
            echo 'Token ID';exit();
        }
        $idcomb = decrypt_base64($_GET['token']);
        $tmp = explode('-', $idcomb);
        if(count($tmp)!=3){
            echo 'Invalid token';exit();
            //throw new Exception("Invalid ID");
        }
        $kate_wlyh = $tmp[0];
        $idwil  = $tmp[1];
        $tautan = $tmp[2];
        $_arr = array("umum","provinsi","daerah");
        if(!in_array($kate_wlyh, $_arr)){
            echo 'InvaliD Kategori Wilayah';exit();
        }
         $data_page = array(
            //"nmpen"       =>  $nama,
            //"prov"       =>  $prov,
            "msg"       =>  $tautan,
            "page_title"    => "DOKUMEN PENDUKUNG ",
        );
        $this->load->view($this->view_dir.'index_dokumen',$data_page);
    }
    
     
    
}
