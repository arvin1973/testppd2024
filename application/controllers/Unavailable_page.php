<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unavailable_page extends CI_Controller {
    var $view_dir   = "unavailable_page/";
    var $js_init    = "unavailable_page";
    var $js_path    = "assets/js/userdefined/unavailable_page/init.js";
    
    function __construct() {
        parent::__construct();
        $this->load->model("M_Master","m_ref");
    }
    
    /*
     * LAPORAN DIGITAL Output Kegiatan
     */
    public function index(){
        if($this->input->is_ajax_request()){
            try 
            {                
                if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
           
                
                
                //common properties
                $this->js_init    = "unavailable_page";
                $this->js_path    = "assets/js/admin/unavailable_page/init.js";

                
                
                $data_page = array(
                );
                $str = $this->load->view($this->view_dir."index",$data_page,TRUE);


                $output = array(
                    "general_title" =>  "SEDANG DALAM PEMELIHARAAN",
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
     * LAPORAN DIGITAL Komponen Satker
     */
    public function komponen_satker(){
        if($this->input->is_ajax_request()){
            try 
            {                
                if(!$this->session->userdata(SESSION_LOGIN)){throw new Exception("Session expired, please login",2);}
                
                $menuid = "pemantauan";
                $this->session->set_userdata("menu",$menuid);
                $status = check_access_rights($this->session->userdata(SESSION_LOGIN)->id_group,$menuid);
                if($status["status"]==FALSE)
                    throw new Exception($this->lang->line("has_no_privilege"),0);

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
               
                //UNIT DETAIL
                $tmp = explode(".",$this->session->userdata(SESSION_LOGIN)->unit_code);
                $kl_id      = $tmp[0];
                $unit_id    = $tmp[1];
                $prog_id    = $tmp[2];
                $dit_id     = $tmp[3];
                
                
                //common properties
                $this->js_init    = "laporan_digital";
                $this->js_path    = "assets/js/userdefined/laporan_digital/k5_satker.js";

                
                $sql = "SELECT DISTINCT DPT.`kddept`,DPT.`nmdept` ,UNT.`kdunit`,UNT.`nmunit`,PRG.`kdprogram`,PRG.`nmprogram`,DIT.`kddit`,DIT.`nmdit`
                        FROM r_giat A
                        LEFT JOIN `r_dept` DPT ON DPT.th_ang=A.`th_ang` AND DPT.`kddept`=A.`kddept`
                        LEFT JOIN `r_unit` UNT ON UNT.th_ang=A.`th_ang` AND UNT.`kddept`=A.`kddept` AND UNT.`kdunit`=A.`kdunit`
                        LEFT JOIN `r_program` PRG ON PRG.th_ang=A.`th_ang` AND PRG.`kddept`=A.`kddept` AND PRG.`kdunit`=A.`kdunit` AND PRG.`kdprogram`=A.`kdprogram`
                        LEFT JOIN `r_dit` DIT ON DIT.th_ang=A.`th_ang` AND DIT.`kddept`=A.`kddept` AND DIT.`kdunit`=A.`kdunit` AND DIT.`kddit`=A.`kddit`
                        WHERE A.`kddept`='".$kl_id."' AND A.`kdunit`='".$unit_id."' AND A.`kdprogram`='".$prog_id."' AND A.`kddit`='".$dit_id."' AND A.`th_ang`=".THN_ANG;
                $list_data = $this->db->query($sql);
                if($list_data->num_rows()==0)
                    throw new Exception("Data referensi not found",0);
                
                //LISt KEGIATAN yg dibawah Dit
                $sql = "SELECT A.th_ang,A.`kdgiat`,A.`nmgiat`
                        FROM r_giat A
                        WHERE A.`kddept`='".$kl_id."' AND A.`kdunit`='".$unit_id."' AND A.`kdprogram`='".$prog_id."' AND A.`kddit`='".$dit_id."' AND A.`th_ang`=".THN_ANG;
                $list_giat = $this->db->query($sql);
                if(!$list_giat)
                    throw new Exception($this->db->error()["message"]);
                
                
                $data_page = array(
                    "tahun"       => THN_ANG,
                    "list_data"     => $list_data,
                    "list_giat"     => $list_giat,
                    "kl"            => "<i><b>[ ".$list_data->row()->kddept." ]</b> - ".$list_data->row()->nmdept."</i>",
                    "unit"          => "<i><b>[ ".$list_data->row()->kdunit." ]</b> - ".$list_data->row()->nmunit."</i>",
                    "program"       => "<i><b>[ ".$list_data->row()->kdprogram." ]</b> - ".$list_data->row()->nmprogram."</i>",
                    "dit"           => "<i><b>[ ".$list_data->row()->kddit." ]</b> - ".$list_data->row()->nmdit."</i>",
                );
                $str = $this->load->view($this->view_dir."index_k5_satker",$data_page,TRUE);


                $output = array(
                    "general_title" =>  "LAPORAN DIGITAL KOMPONEN SATKER",
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
     * Get expand 'Kegiatan' 
     */
    function get_list_satker(){
        if($this->input->is_ajax_request()){
            try {
                $this->form_validation->set_rules('id','Kode Kegiatan','required');
                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                
                
                // storing  request (ie, get/post) global array to a variable  
                $tmp = explode('.',decrypt_text($this->input->post("id")));
                if(count($tmp)<2)
                    throw new Exception("Invalid ID",0);
                
                $th_ang = $tmp[0];
                $kdgiat = $tmp[1];
                
                /*
                 * GET KEGIATAN data
                 */
                $this->m_ref->setTableName("r_giat");
                
                $select = array("kdgiat","nmgiat");
                $cond = array(
                    "th_ang"        => $th_ang,
                    "kdgiat"        => $kdgiat,
                );
                $list_giat = $this->m_ref->get_by_condition($select,$cond);
                if(!$list_giat)
                    throw new Exception($this->db->error()["code"]);
                if($list_giat->num_rows() == 0)
                    throw new Exception($this->lang->line('r_giat_data_not_found'),0);

                
                
                //1.SATKER LIST
                $sql = "SELECT DISTINCT A.kdgiat,A.`kdsatker`,B.`nmsatker`
                        FROM `map_output_satker` A
                        INNER JOIN `r_satker` B ON B.`th_ang`=A.`th_ang` AND B.`kdsatker`=A.`kdsatker`
                        WHERE A.`th_ang`=".$th_ang." AND A.kdgiat='".$kdgiat."'";
                
                $listData = $this->db->query($sql);
                $str = "";
                $no=1;
                $brk="";
                foreach ($listData->result() as $v) {
                    $str .="<tr>";
                    $str .="<td>".$no++."</td>";
                    $str.='<td class="text-bold text-uppercase"><a href="#" data-id="'.encrypt_text($th_ang.".".$v->kdgiat.".".$v->kdsatker).'" class="getSatkerDetail">'.$v->kdsatker.'</a></td>';
                    $str.='<td class=""><a href="#" data-id="'.encrypt_text($th_ang.".".$v->kdgiat.".".$v->kdsatker).'" class="getSatkerDetail">'.$v->nmsatker.'</a></td>';
                    $str.='<td class="text-center"><a href="#"  data-id="'.encrypt_text($th_ang.".".$v->kdgiat.".".$v->kdsatker).'" class="btn btn-xs btn-info getSatkerDetail"><i class="fa fa-hand-o-up"></i></a></td>';

                    $str .="</tr>";
                }
                
                
                $json_data = array(
                    "status"        => 1,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "str"           => $str,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "data_giat"     => $list_giat->row(),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "csrf_hash"       => $this->security->get_csrf_hash(),
                    );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                $json_data = array(
                    "status"            => 0,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "csrf_hash"       => $this->security->get_csrf_hash(),
                    "msg"           => $exc->getMessage(),
                    );
                exit(json_encode($json_data));
            }
        }
        
    }
    /*
     * Get expand 'Kegiatan' 
     */
    function get_laporan_satker(){
        if($this->input->is_ajax_request()){
            try {
                $this->form_validation->set_rules('id','Kodifikasi','required');
                if($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""),0);
                
                
                
                // storing  request (ie, get/post) global array to a variable  
                $tmp = explode('.',decrypt_text($this->input->post("id")));
                if(count($tmp)<3)
                    throw new Exception("Invalid ID",0);
                
                $th_ang = $tmp[0];
                $kdgiat = $tmp[1];
                $kdsatker = $tmp[2];
                
                /*
                 * GET KEGIATAN data
                 */
                $this->m_ref->setTableName("r_satker");
                
                $select = array("kdsatker","nmsatker");
                $cond = array(
                    "th_ang"        => $th_ang,
                    "kdsatker"      => $kdsatker,
                );
                $list_satker= $this->m_ref->get_by_condition($select,$cond);
                if(!$list_satker)
                    throw new Exception($this->db->error()["code"]);
                if($list_satker->num_rows() == 0)
                    throw new Exception("[Satker]".$this->lang->line('data_not_found'),0);

                
                
                //1.SATKER LIST
                $sql = "SELECT KO.`kdgiat`,KO.`kdoutput`,RSO.`kdsoutput`,KO.`kdkomponen`,KO.`nmkomponen`
                    ,TKR.satuan_fisik
                            ,CASE WHEN TKR.pagu_fisik IS NULL THEN 0 ELSE TKR.pagu_fisik END pagu_fisik
                            ,CASE WHEN TKR.pagu_bm IS NULL THEN 0 ELSE TKR.pagu_bm END pagu_bm
                            ,CASE WHEN TKR.pagu_bb IS NULL THEN 0 ELSE TKR.pagu_bb END pagu_bb
                            ,CASE WHEN TKR.pagu_bp IS NULL THEN 0 ELSE TKR.pagu_bp END pagu_bp
                            ,CASE WHEN TKR.pagu_bansos IS NULL THEN 0 ELSE TKR.pagu_bansos END pagu_bansos
                            
                            ,CASE WHEN RDET1.fisik IS NULL THEN 0 ELSE RDET1.fisik END real_fisik1
                            ,CASE WHEN RDET1.belanja_bansos IS NULL THEN 0 ELSE RDET1.belanja_bansos END belanja_bansos1
                            ,CASE WHEN RDET1.belanja_bp IS NULL THEN 0 ELSE RDET1.belanja_bp END belanja_bp1
                            ,CASE WHEN RDET1.belanja_bb IS NULL THEN 0 ELSE RDET1.belanja_bb END belanja_bb1
                            ,CASE WHEN RDET1.belanja_bm IS NULL THEN 0 ELSE RDET1.belanja_bm END belanja_bm1
                            ,CASE WHEN RDET1.notif IS NULL THEN 'NULL' ELSE RDET1.notif END notif1

                            ,CASE WHEN RDET2.fisik IS NULL THEN 0 ELSE RDET2.fisik END real_fisik2
                            ,CASE WHEN RDET2.belanja_bansos IS NULL THEN 0 ELSE RDET2.belanja_bansos END belanja_bansos2
                            ,CASE WHEN RDET2.belanja_bp IS NULL THEN 0 ELSE RDET2.belanja_bp END belanja_bp2
                            ,CASE WHEN RDET2.belanja_bb IS NULL THEN 0 ELSE RDET2.belanja_bb END belanja_bb2
                            ,CASE WHEN RDET2.belanja_bm IS NULL THEN 0 ELSE RDET2.belanja_bm END belanja_bm2
                            ,CASE WHEN RDET2.notif IS NULL THEN 'NULL' ELSE RDET2.notif END notif2

                            ,CASE WHEN RDET3.fisik IS NULL THEN 0 ELSE RDET3.fisik END real_fisik3
                            ,CASE WHEN RDET3.belanja_bansos IS NULL THEN 0 ELSE RDET3.belanja_bansos END belanja_bansos3
                            ,CASE WHEN RDET3.belanja_bp IS NULL THEN 0 ELSE RDET3.belanja_bp END belanja_bp3
                            ,CASE WHEN RDET3.belanja_bb IS NULL THEN 0 ELSE RDET3.belanja_bb END belanja_bb3
                            ,CASE WHEN RDET3.belanja_bm IS NULL THEN 0 ELSE RDET3.belanja_bm END belanja_bm3
                            ,CASE WHEN RDET3.notif IS NULL THEN 'NULL' ELSE RDET3.notif END notif3

                            ,CASE WHEN RDET4.fisik IS NULL THEN 0 ELSE RDET4.fisik END real_fisik4
                            ,CASE WHEN RDET4.belanja_bansos IS NULL THEN 0 ELSE RDET4.belanja_bansos END belanja_bansos4
                            ,CASE WHEN RDET4.belanja_bp IS NULL THEN 0 ELSE RDET4.belanja_bp END belanja_bp4
                            ,CASE WHEN RDET4.belanja_bb IS NULL THEN 0 ELSE RDET4.belanja_bb END belanja_bb4
                            ,CASE WHEN RDET4.belanja_bm IS NULL THEN 0 ELSE RDET4.belanja_bm END belanja_bm4
                            ,CASE WHEN RDET4.notif IS NULL THEN 'NULL' ELSE RDET4.notif END notif4

                            ,CASE WHEN RDET5.fisik IS NULL THEN 0 ELSE RDET5.fisik END real_fisik5
                            ,CASE WHEN RDET5.belanja_bansos IS NULL THEN 0 ELSE RDET5.belanja_bansos END belanja_bansos5
                            ,CASE WHEN RDET5.belanja_bp IS NULL THEN 0 ELSE RDET5.belanja_bp END belanja_bp5
                            ,CASE WHEN RDET5.belanja_bb IS NULL THEN 0 ELSE RDET5.belanja_bb END belanja_bb5
                            ,CASE WHEN RDET5.belanja_bm IS NULL THEN 0 ELSE RDET5.belanja_bm END belanja_bm5
                            ,CASE WHEN RDET5.notif IS NULL THEN 'NULL' ELSE RDET5.notif END notif5

                            ,CASE WHEN RDET6.fisik IS NULL THEN 0 ELSE RDET6.fisik END real_fisik6
                            ,CASE WHEN RDET6.belanja_bansos IS NULL THEN 0 ELSE RDET6.belanja_bansos END belanja_bansos6
                            ,CASE WHEN RDET6.belanja_bp IS NULL THEN 0 ELSE RDET6.belanja_bp END belanja_bp6
                            ,CASE WHEN RDET6.belanja_bb IS NULL THEN 0 ELSE RDET6.belanja_bb END belanja_bb6
                            ,CASE WHEN RDET6.belanja_bm IS NULL THEN 0 ELSE RDET6.belanja_bm END belanja_bm6
                            ,CASE WHEN RDET6.notif IS NULL THEN 'NULL' ELSE RDET6.notif END notif6

                            ,CASE WHEN RDET7.fisik IS NULL THEN 0 ELSE RDET7.fisik END real_fisik7
                            ,CASE WHEN RDET7.belanja_bansos IS NULL THEN 0 ELSE RDET7.belanja_bansos END belanja_bansos7
                            ,CASE WHEN RDET7.belanja_bp IS NULL THEN 0 ELSE RDET7.belanja_bp END belanja_bp7
                            ,CASE WHEN RDET7.belanja_bb IS NULL THEN 0 ELSE RDET7.belanja_bb END belanja_bb7
                            ,CASE WHEN RDET7.belanja_bm IS NULL THEN 0 ELSE RDET7.belanja_bm END belanja_bm7
                            ,CASE WHEN RDET7.notif IS NULL THEN 'NULL' ELSE RDET7.notif END notif7

                            ,CASE WHEN RDET8.fisik IS NULL THEN 0 ELSE RDET8.fisik END real_fisik8
                            ,CASE WHEN RDET8.belanja_bansos IS NULL THEN 0 ELSE RDET8.belanja_bansos END belanja_bansos8
                            ,CASE WHEN RDET8.belanja_bp IS NULL THEN 0 ELSE RDET8.belanja_bp END belanja_bp8
                            ,CASE WHEN RDET8.belanja_bb IS NULL THEN 0 ELSE RDET8.belanja_bb END belanja_bb8
                            ,CASE WHEN RDET8.belanja_bm IS NULL THEN 0 ELSE RDET8.belanja_bm END belanja_bm8
                            ,CASE WHEN RDET8.notif IS NULL THEN 'NULL' ELSE RDET8.notif END notif8

                            ,CASE WHEN RDET9.fisik IS NULL THEN 0 ELSE RDET9.fisik END real_fisik9
                            ,CASE WHEN RDET9.belanja_bansos IS NULL THEN 0 ELSE RDET9.belanja_bansos END belanja_bansos9
                            ,CASE WHEN RDET9.belanja_bp IS NULL THEN 0 ELSE RDET9.belanja_bp END belanja_bp9
                            ,CASE WHEN RDET9.belanja_bb IS NULL THEN 0 ELSE RDET9.belanja_bb END belanja_bb9
                            ,CASE WHEN RDET9.belanja_bm IS NULL THEN 0 ELSE RDET9.belanja_bm END belanja_bm9
                            ,CASE WHEN RDET9.notif IS NULL THEN 'NULL' ELSE RDET9.notif END notif9

                            ,CASE WHEN RDET10.fisik IS NULL THEN 0 ELSE RDET10.fisik END real_fisik10
                            ,CASE WHEN RDET10.belanja_bansos IS NULL THEN 0 ELSE RDET10.belanja_bansos END belanja_bansos10
                            ,CASE WHEN RDET10.belanja_bp IS NULL THEN 0 ELSE RDET10.belanja_bp END belanja_bp10
                            ,CASE WHEN RDET10.belanja_bb IS NULL THEN 0 ELSE RDET10.belanja_bb END belanja_bb10
                            ,CASE WHEN RDET10.belanja_bm IS NULL THEN 0 ELSE RDET10.belanja_bm END belanja_bm10
                            ,CASE WHEN RDET10.notif IS NULL THEN 'NULL' ELSE RDET10.notif END notif10

                            ,CASE WHEN RDET11.fisik IS NULL THEN 0 ELSE RDET11.fisik END real_fisik11
                            ,CASE WHEN RDET11.belanja_bansos IS NULL THEN 0 ELSE RDET11.belanja_bansos END belanja_bansos11
                            ,CASE WHEN RDET11.belanja_bp IS NULL THEN 0 ELSE RDET11.belanja_bp END belanja_bp11
                            ,CASE WHEN RDET11.belanja_bb IS NULL THEN 0 ELSE RDET11.belanja_bb END belanja_bb11
                            ,CASE WHEN RDET11.belanja_bm IS NULL THEN 0 ELSE RDET11.belanja_bm END belanja_bm11
                            ,CASE WHEN RDET11.notif IS NULL THEN 'NULL' ELSE RDET11.notif END notif11

                            ,CASE WHEN RDET12.fisik IS NULL THEN 0 ELSE RDET12.fisik END real_fisik12
                            ,CASE WHEN RDET12.belanja_bansos IS NULL THEN 0 ELSE RDET12.belanja_bansos END belanja_bansos12
                            ,CASE WHEN RDET12.belanja_bp IS NULL THEN 0 ELSE RDET12.belanja_bp END belanja_bp12
                            ,CASE WHEN RDET12.belanja_bb IS NULL THEN 0 ELSE RDET12.belanja_bb END belanja_bb12
                            ,CASE WHEN RDET12.belanja_bm IS NULL THEN 0 ELSE RDET12.belanja_bm END belanja_bm12
                            ,CASE WHEN RDET12.notif IS NULL THEN 'NULL' ELSE RDET12.notif END notif12

                            FROM `map_output_satker` MAP
                            INNER JOIN `r_suboutput` RSO ON MAP.`th_ang`=RSO.`th_ang` AND MAP.`kdgiat`=RSO.`kdgiat` AND MAP.`kdoutput`=RSO.`kdoutput`
                            INNER JOIN `r_komponen` KO ON KO.`th_ang`=MAP.`th_ang` AND KO.`kdgiat`=MAP.`kdgiat` AND KO.`kdoutput`=MAP.`kdoutput` AND KO.`kdsoutput`=RSO.`kdsoutput`
                            LEFT JOIN `t_komponen_rincian` TKR ON TKR.`kdsatker`=MAP.`kdsatker` AND TKR.`kode`=CONCAT(KO.`th_ang`,'.',KO.`kdgiat`,'.',KO.`kdoutput`,'.',KO.`kdsoutput`,'.',KO.`kdkomponen`)
                            INNER JOIN `r_satker` RSAT ON RSAT.`th_ang`=MAP.`th_ang` AND MAP.`kdsatker`=RSAT.`kdsatker`
                            LEFT JOIN `t_komponen_realisasi_detail` RDET1 ON RDET1.kode=TKR.KODE AND RDET1.kdsatker=TKR.kdsatker AND RDET1.month=1
                            LEFT JOIN `t_komponen_realisasi_detail` RDET2 ON RDET2.kode=TKR.KODE AND RDET2.kdsatker=TKR.kdsatker AND RDET2.month=2
                            LEFT JOIN `t_komponen_realisasi_detail` RDET3 ON RDET3.kode=TKR.KODE AND RDET3.kdsatker=TKR.kdsatker AND RDET3.month=3
                            LEFT JOIN `t_komponen_realisasi_detail` RDET4 ON RDET4.kode=TKR.KODE AND RDET4.kdsatker=TKR.kdsatker AND RDET4.month=4
                            LEFT JOIN `t_komponen_realisasi_detail` RDET5 ON RDET5.kode=TKR.KODE AND RDET5.kdsatker=TKR.kdsatker AND RDET5.month=5
                            LEFT JOIN `t_komponen_realisasi_detail` RDET6 ON RDET6.kode=TKR.KODE AND RDET6.kdsatker=TKR.kdsatker AND RDET6.month=6
                            LEFT JOIN `t_komponen_realisasi_detail` RDET7 ON RDET7.kode=TKR.KODE AND RDET7.kdsatker=TKR.kdsatker AND RDET7.month=7
                            LEFT JOIN `t_komponen_realisasi_detail` RDET8 ON RDET8.kode=TKR.KODE AND RDET8.kdsatker=TKR.kdsatker AND RDET8.month=8
                            LEFT JOIN `t_komponen_realisasi_detail` RDET9 ON RDET9.kode=TKR.KODE AND RDET9.kdsatker=TKR.kdsatker AND RDET9.month=9
                            LEFT JOIN `t_komponen_realisasi_detail` RDET10 ON RDET10.kode=TKR.KODE AND RDET10.kdsatker=TKR.kdsatker AND RDET10.month=10
                            LEFT JOIN `t_komponen_realisasi_detail` RDET11 ON RDET11.kode=TKR.KODE AND RDET11.kdsatker=TKR.kdsatker AND RDET11.month=11
                            LEFT JOIN `t_komponen_realisasi_detail` RDET12 ON RDET12.kode=TKR.KODE AND RDET12.kdsatker=TKR.kdsatker AND RDET12.month=12

                            WHERE MAP.`kdsatker`='".$kdsatker."' AND MAP.`th_ang`=".THN_ANG;
                
                $list_data = $this->db->query($sql);
                $data_page = array(
                    "list_data"     => $list_data,
                );
                $str = $this->load->view($this->view_dir."preview_k5_satker",$data_page,TRUE);
                
                
                $json_data = array(
                    "status"        => 1,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "str"           => $str,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "data_satker"     => $list_satker->row(),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "csrf_hash"       => $this->security->get_csrf_hash(),
                    );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                $json_data = array(
                    "status"            => 0,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "csrf_hash"       => $this->security->get_csrf_hash(),
                    "msg"           => $exc->getMessage(),
                    );
                exit(json_encode($json_data));
            }
        }
        
    }
}
