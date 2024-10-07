<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Unduh Penilaian Prov
* author : FSM
 * date : 10 des 2020
*/
class PPD_info extends CI_Controller {
    var $view_dir   = "ppd3/PPD3_unduh_nilai/t2/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/PPD2_unduh_nilai/ppd2.js";
    //var $js_google    = "https://www.googletagmanager.com/gtag/js?id=UA-217181586-1";
//    var $js_google    = "window.dataLayer = window.dataLayer || [];
//          function gtag(){dataLayer.push(arguments);}
//          gtag('js', new Date());
//
//          gtag('config', 'UA-217181586-1');";
    
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");
        $this->load->library("Excel");
    }
    
    
    public function index(){
        $info= phpinfo();
        print_r($info);                exit();
    }
    
  
    
}
