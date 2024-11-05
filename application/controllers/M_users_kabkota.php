<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_users_kabkota extends CI_Controller
{
    var $view_dir   = "admin/users/";
    var $js_init    = "main";
    var $js_path    = "assets/js/admin/management/users.js";
    var $allowed    = array("PPD1");

    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        $this->load->library('email'); //panggil library email codeigniter

    }

    /*
     * 
     */
    public function index()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session expired, please login", 2);
                }

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");


                //common properties
                $this->js_init    = "main";
                $this->js_path    = "assets/js/admin/management/users_kabkota.js?v=" . now("Asia/Jakarta");

                //List Group
                //$this->m_ref->setTableName("tbl_user_group");
                //$select = array("id","groupid","name");
                //$cond = array(
                //  "id" => 'G2'
                //);
                //$list_group= $this->m_ref->get_by_condition($select,$cond);

                //List Provinsi
                $select = "SELECT * FROM provinsi where id != '-1' order by id_kode";
                $list_prov = $this->db->query($select);

                //List kabupaten
                $select = "SELECT * FROM kabupaten WHERE 1=1 ORDER BY id_kab";
                $list_data = $this->db->query($select);

                $data_page = array(
                    "list_prov"    =>  $list_prov,
                    "list_kab"    =>  $list_data,
                );
                $str = $this->load->view($this->view_dir . "index_kabkota", $data_page, TRUE);


                $output = array(
                    "status"        =>  1,
                    "str"           =>  $str,
                    "js_path"       =>  base_url($this->js_path),
                    "js_initial"    =>  $this->js_init . ".init();",
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
        } else {
            exit("access denied!");
        }
    }

    function g_pengguna_aktif()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();

                //---------------isi disini--------------------

                $sql = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 5 AND last_access IS NOT NULL AND tbl_user.active_flag = 'Y' AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi', 'testprovinsi', 'Testkabkota-pusat', 'admin')";
                $list_data = $this->db->query($sql);
                if (!$list_data) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                $sql_kabkota = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 5 AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi', 'testprovinsi', 'Testkabkota-pusat', 'admin')";
                $list_data_kabkota = $this->db->query($sql_kabkota);
                if (!$list_data_kabkota) {
                    $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
                    log_message("error", $msg);
                    throw new Exception("Invalid SQL!");
                }

                //---------end isi disini----------------------

                $response = array(
                    "status"    => 1,
                    "csrf_hash" => $this->security->get_csrf_hash(),
                    "str"     => count($list_data->result()),
                    "total"     => count($list_data_kabkota->result()),
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
        } else die("Die!");
    }

    function rekap_user()
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap User');

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue("A1", "NO");
        $this->excel->getActiveSheet()->setCellValue("B1", "USER");
        $this->excel->getActiveSheet()->setCellValue("C1", "NAMA");
        $this->excel->getActiveSheet()->setCellValue("D1", "PASSWORD");

        //---------------isi disini--------------------

        $sql_kabkota = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 5 AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi', 'testprovinsi', 'Testkabkota-pusat', 'admin')";
        $list_data_kabkota = $this->db->query($sql_kabkota);
        if (!$list_data_kabkota) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        //---------end isi disini----------------------

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 2;
        $no = 1;

        foreach ($list_data_kabkota->result() as $value) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->userid);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->name);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, 'pancasila');
            $index_excelColumn = 0;
            $no++;
            $row++;
        }
        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("3.3");
        //font
        $this->excel->getActiveSheet()->getStyle('A1:D1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function rekap_active_user()
    {
        $this->load->library("Excel");
        $sharedStyleTitles = new PHPExcel_Style();

        $this->excel->getActiveSheet()->getSheetView()->setZoomScale(50);
        $this->excel->getSheet(0)->setTitle('Rekap User');

        //garis
        $sharedStyleTitles->applyFromArray(
            array(
                'borders' =>
                array(
                    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                )
            )
        );

        $this->excel->getActiveSheet()->setCellValue("A1", "NO");
        $this->excel->getActiveSheet()->setCellValue("B1", "USER");
        $this->excel->getActiveSheet()->setCellValue("C1", "NAMA");
        $this->excel->getActiveSheet()->setCellValue("D1", "PASSWORD");
        $this->excel->getActiveSheet()->setCellValue("E1", "STATUS");

        //---------------isi disini--------------------

        $sql_kabkota = "SELECT * FROM `tbl_user` WHERE tbl_user.group = 5 AND active_flag='Y' AND userid NOT IN ('tpt', 'teamtpt', 'peppd01', 'novi', 'dit.peppd', 'testtpt', 'tpi1', 'dustintpi', 'testprovinsi', 'Testkabkota-pusat', 'admin')";
        $list_data_kabkota = $this->db->query($sql_kabkota);
        if (!$list_data_kabkota) {
            $msg = $session->userid . " " . $this->router->fetch_class() . " : " . $this->db->error()["message"];
            log_message("error", $msg);
            throw new Exception("Invalid SQL!");
        }

        //---------end isi disini----------------------

        $excelColumn = range('A', 'ZZ');
        $index_excelColumn = 0;
        $row = 2;
        $no = 1;

        foreach ($list_data_kabkota->result() as $value) {
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $no);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->userid);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->name);
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, 'pancasila');
            $this->excel->getActiveSheet()->setCellValue($excelColumn[$index_excelColumn++] . $row, $value->active_flag);
            $index_excelColumn = 0;
            $no++;
            $row++;
        }
        //lebar kolom
        $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth("8.64");
        $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth("27");
        $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth("10");
        $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth("5");
        //font
        $this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setName('CMIIW');
        //bolt
        $this->excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
        //size    
        // $this->excel->getActiveSheet()->getStyle('A1:D5')->getFont()->setSize(20);



        $this->excel->getActiveSheet()->setShowGridlines(False);

        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename = rekap_user.xls");
        header("Cache-Control:max-age=0");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("php://output");
    }

    function get_datatable()
    {
        if ($this->input->is_ajax_request()) {
            try {
                $requestData = $_REQUEST;
                $satkercode = $this->session->userdata(SESSION_LOGIN)->satker;
                $userid = $this->session->userdata(SESSION_LOGIN)->id;
                $idx = 0;
                $columns = array(
                    // datatable column index  => database column name
                    $idx++   => 'A.`userid`',
                    $idx++   => 'A.`name`',
                    $idx++   => 'A.`email`',
                    $idx++   => 'B.`name`',
                    $idx++   => 'C.`nama_kabupaten`',
                    $idx++   => 'D.`nama_provinsi`',
                );

                $sql = "SELECT A.id, A.userid,A.`name`,A.email,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker, A.last_access,C.nama_kabupaten, D.nama_provinsi
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        INNER JOIN `kabupaten` C ON A.satker = C.id
                        INNER JOIN `provinsi` D ON C.prov_id = D.id_kode
                        WHERE B.`id`='5' AND A.active_flag!='D' ";

                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " AND ( "
                        . " A.`userid` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR A.`name` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR A.`email` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR B.`name` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR C.`nama_kabupaten` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR D.`nama_provinsi` LIKE '%" . $requestData['search']['value'] . "%' "
                        . ")";
                }
                $list_data = $this->db->query($sql);
                $totalFiltered = $list_data->num_rows();
                $sql .= " ORDER BY "
                    . $columns[$requestData['order'][0]['column']] . "   "
                    . $requestData['order'][0]['dir'] . "  "
                    . "LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                $list_data = $this->db->query($sql);
                $data = array();
                $i = 1;
                foreach ($list_data->result() as $row) {
                    $nestedData = array();
                    $id      = "ppd-" . $row->id;
                    $title  = $row->name;
                    $encrypted_id = base64_encode(openssl_encrypt($id, "AES-128-ECB", ENCRYPT_PASS));
                    $tmp1 = "class='text-info btn btn-sm getDetail' data-id='" . $encrypted_id . "'";
                    $tmp1 .= " data-ustpt='" . $row->userid . "'";
                    $tmp1 .= " data-nmtpt='" . $row->name . "'";
                    $tmp1 .= " data-emtpt='" . $row->email . "'";

                    $tmp2 = "class='text-warning btn btn-sm btnRes' data-id='" . $encrypted_id . "'";
                    $tmp2 .= " data-title='" . $row->name . "'";
                    $tmp3 = "class='text-danger btn btn-sm btnDel' data-id='" . $encrypted_id . "'";
                    $tmp3 .= " data-title='" . $row->name . "'";

                    $nestedData[] = $row->userid;
                    $nestedData[] = $row->name;
                    $nestedData[] = $row->email;
                    $nestedData[] = $row->nama_provinsi;
                    $nestedData[] = $row->nama_kabupaten;
                    $nestedData[] = $row->groupname;
                    $str = "<span class='badge badge-pink'>Tidak Aktif</span>";
                    if ($row->active_flag == 'Y')
                        $str = "<span class='badge badge-success'>Aktif</span>";
                    $nestedData[] = $str;
                    $nestedData[] = $row->last_access;
                    $nestedData[] = "<a  href='javascript:void(0)' " . $tmp1 . " title='Edit Data'>     <i class='fas fa-pencil-alt'></i>      </a>"
                        . "<a  href='javascript:void(0)' " . $tmp2 . " title='Reset Password'>     <i class='fas mdi mdi-lock-reset'></i>      </a>"
                        . "<a  href='javascript:void(0)' " . $tmp3 . " title='Hapus Data'>     <i class='text fas fa-trash-alt'></i>      </a>";
                    $data[] = $nestedData;
                }
                $json_data = array(
                    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval($totalData),  // total number of records
                    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        } else
            die;
    }

    function list_kab()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    session_write_close();
                    throw new Exception("Session expired, please login", 2);
                }
                $session = $this->session->userdata(SESSION_LOGIN);
                session_write_close();
                $this->form_validation->set_rules('idprov', 'ID Prov', 'required');
                //                if($this->form_validation->run() == FALSE){
                //                    throw new Exception(validation_errors("", ""),0);
                //                }
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                $idcomb = decrypt_base64($this->input->post("idprov"));
                $sql = "SELECT * FROM kabupaten WHERE prov_id=? ORDER BY id_kab";
                $bind = array($idcomb);
                $list_kab = $this->db->query($sql, $bind);
                $content_k = '';

                if ($list_kab->num_rows() == 0) {
                    $str_stts = "<option value=''> - Silakan pilih provinsi - </option>";
                } else {
                    $str_stts = "<option value=''> - Pilih - </option>";
                    foreach ($list_kab->result() as $g) {
                        $idcomb1 = $g->id;
                        $encrypted_id1 = base64_encode(openssl_encrypt($idcomb1, "AES-128-ECB", ENCRYPT_PASS));
                        $str_stts .= "<option value='$encrypted_id1'>$g->nama_kabupaten</option>";
                    }
                }



                $output = array(
                    "status"        =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"           =>  "success update data",
                    "str"       => $str_stts,
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
        } else {
            exit("Access Denied");
        }
    }

    function add_act()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Your session is ended, please relogin", 2);
                }
                $this->form_validation->set_rules('code', 'Code', 'required|xss_clean');
                $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');

                $this->form_validation->set_rules('lprov', 'prov', 'required|xss_clean');
                $this->form_validation->set_rules('lkab', 'kab/kota', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
                $userid = $this->input->post("code");
                $name = $this->input->post("name");
                //$group = $this->input->post("group");
                $email = $this->input->post("email");
                $satker = decrypt_base64($this->input->post("lkab"));
                //$satker = $this->input->post("prov");


                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek data 
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "userid"  => $userid,
                );
                $list_data = $this->m_ref->get_by_condition($select, $cond);
                if (!$list_data) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if ($list_data->num_rows() > 0) {
                    throw new Exception("Data duplication", 0);
                }
                $tambah = "INSERT INTO tbl_user (userid,        `name`,                          `email`,      `password`,                      `group`,                          `satker`, `active_flag`,`cr_by`,`cr_dt`)
                   VALUES                     ('" . $userid . "', '" . $this->input->post("name") . "','" . $email . "', '" . md5("pancasila" . "monda") . "','5','" . $satker . "','N','" . $this->session->userdata(SESSION_LOGIN)->userid . "','$current_date_time')";
                $status_save = $this->db->query($tambah);

                if (!$status_save) {
                    throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
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
        } else {
            exit("Access Denied");
        }
    }

    //klik view table
    function detail_view()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $this->form_validation->set_rules('id', 'ID Data', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }

                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID #1");
                $kate_grp = $tmp[0];
                $id = $tmp[1];

                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $id,
                );
                $list_data = $this->m_ref->get_by_condition($select, $cond);
                if ($list_data->num_rows() == 0) {
                    throw new Exception("Data not found, please reload this page!", 0);
                }
                $groupid = $list_data->row()->group;

                $sql_g = "SELECT TU.id, TU.name FROM tbl_user_group TU WHERE 1=1 ";
                $list_pr = $this->db->query($sql_g);
                $str_pr = "<option value=''> - Choose - </option>";
                foreach ($list_pr->result() as $v) {
                    if ($v->id == $list_data->row()->group)
                        $str_pr .= "<option value='" . $v->id . "' selected=''>";
                    else
                        $str_pr .= "<option value='" . $v->id . "'>";
                    $str_pr .= $v->name . "</option>";
                }

                //LIST STATUS
                $_arr_stts = array("Y", "N");
                $_arr_stts_lbl = array("Y" => "Active", "N" => "Not Active");
                $str_stts = "<option value=''> - Choose - </option>";
                $statt = '';
                foreach ($_arr_stts as $v) {

                    if ($v == $list_data->row()->active_flag)
                        $str_stts .= "<option value='" . $v . "' selected=''>";
                    else
                        $str_stts .= "<option value='" . $v . "'>";
                    $str_stts .= $_arr_stts_lbl[$v] . "</option>";

                    $stat = $list_data->row()->active_flag;
                    if ($stat == 'Y')
                        $statt = 'Aktif';
                    else
                        $statt = 'Tidak Aktif';
                }

                $hasPlant = 'N';
                $_arr = array("G2", "G5", "G6");
                if (in_array($groupid, $_arr))
                    $hasPlant = 'Y';

                //sukses
                $output = array(
                    "status"    =>  1,
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "msg"       =>  "success get data",
                    "data"      =>  $list_data->result(),
                    //    "tbl_wilayah"       =>  $content,
                    //   "tbl_kabupaten"     =>  $content_k,
                    "str_pr"      =>  $str_pr,
                    "str_stts"      =>  $str_stts,
                    "str_status"      =>  $statt,
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
        } else {
            exit("Access Denied");
        }
    }

    function kab_datatable()
    {
        if ($this->input->is_ajax_request()) {
            try {
                $requestData = $_REQUEST;
                $this->form_validation->set_rules('id', 'ID', 'required');
                //$user = $this->input->post("id");
                $user = decrypt_text($this->input->post("id"));
                if (!is_numeric($user))
                    throw new Exception("Invalid ID!");
                //$idprov = decrypt_text($prov);
                //cari
                $idx = 0;
                $columns = array(
                    // datatable column index  => database column name
                    $idx++   => "K.id_kab",
                    $idx++   => "K.nama_kabupaten",

                );
                $sql = "SELECT K.`id`,K.id_kab,K.nama_kabupaten FROM `kabupaten` K
                        LEFT JOIN `provinsi` P ON P.id_kode = K.prov_id
                        LEFT JOIN `tbl_user_wilayah` W ON W.idwilayah = P.id WHERE 1=1 ";
                //                        WHERE W.iduser = '".$user."' ";

                $totalData = $this->db->query($sql)->num_rows();
                $totalFiltered = $totalData;

                if (!empty($requestData['search']['value'])) {
                    $sql .= " AND ( "
                        . " K.`id_kab` LIKE '%" . $requestData['search']['value'] . "%' "
                        . " OR K.`nama_kabupaten` LIKE '%" . $requestData['search']['value'] . "%' "
                        . ")";
                }
                $list_data = $this->db->query($sql);
                $totalFiltered = $list_data->num_rows();

                $sql .= " ORDER BY "
                    . $columns[$requestData['order'][0]['column']] . "   "
                    . $requestData['order'][0]['dir'] . "  "
                    . "LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                $list_data = $this->db->query($sql);
                $data = array();
                $i = 1;
                foreach ($list_data->result() as $row) {
                    $nestedData = array();
                    $id     = $row->id;

                    $nestedData[] = $row->id_kab;
                    $nestedData[] = $row->nama_kabupaten;
                    $tmp = " data-data='" . encrypt_text($id) . "' ";
                    $nestedData[] = ""
                        //                            . "<a class='btn btn-xs btn-info btnSelect' ".$tmp." title='Pilih Data'><i class='fa fa-hand-o-up'></i> Pilih</a>";
                        . "<input type='radio' class='checkbox' name='group' $tmp  value='" . $row->nama_kabupaten . "'  /> ";

                    $data[] = $nestedData;
                }
                $json_data = array(
                    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                    "recordsTotal"    => intval($totalData),  // total number of records
                    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data"            => $data   // total data array
                );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        } else
            die;
    }

    function add_wil()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Your session is ended, please relogin", 2);
                }
                $this->form_validation->set_rules('iduser', 'Code', 'required|xss_clean');
                $this->form_validation->set_rules('prov', 'Name', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $userid = decrypt_text($this->input->post("iduser"));
                if (!is_numeric($userid))
                    throw new Exception("Invalid ID!");

                $wilayah = decrypt_text($this->input->post("prov"));



                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //cek data 
                $this->m_ref->setTableName("tbl_user_wilayah");
                $select = array();
                $cond = array(
                    "iduser"  => $userid,
                    "idwilayah" => $wilayah,
                );
                $list_data = $this->m_ref->get_by_condition($select, $cond);
                if (!$list_data) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if ($list_data->num_rows() > 0) {
                    throw new Exception("Data duplication", 0);
                }

                $tambah = "INSERT INTO tbl_user_wilayah (iduser,`idwilayah`,`cr_dt`,`up_dt`,`cr_by`,`up_by`)
                   VALUES ('" . $userid . "', '" . $wilayah . "','" . $current_date_time . "', '', '" . $this->session->userdata(SESSION_LOGIN)->userid . "','')";

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
                if (!$status_save) {
                    throw new Exception($this->db->error()["code"] . ":Failed save data", 0);
                }
                //daerah penilaian
                $select_daerah = "SELECT 	P.`id`, P.`id_kode`, P.`nama_provinsi`, P.`label`,P. `ppd`,W.iduser
	FROM  `provinsi` P 
	LEFT JOIN `tbl_user_wilayah` W ON W.idwilayah = P.id
	WHERE W.iduser='" . $userid . "'";
                $list_wilayah = $this->db->query($select_daerah);
                $content = "";
                $no = 1;
                foreach ($list_wilayah->result() as $r_wil) {
                    $id      = $r_wil->id;
                    $content .= "<tr class='odd gradeX'>";
                    $content .= "<td style='font-size: 11px'><a class='isinilai' data-id='" . encrypt_text($id) . "' >" . $no++ . "</a></td>";
                    $content .= "<td style='font-size: 11px'><a class='isinilai' data-id='" . encrypt_text($id) . "' >" . $r_wil->id_kode . "</a></td>";
                    $content .= "<td style='font-size: 11px'><a class='isinilai' data-id='" . encrypt_text($id) . "' >" . $r_wil->nama_provinsi . "</a></td>";
                    $content .= "<td style='font-size: 11px'><a class='isinilai' data-id='" . encrypt_text($id) . "' >Hapus</a></td>";
                    $content .= "</tr>";
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
        } else {
            exit("Access Denied");
        }
    }

    /*
     * edit data User TPT
     * author : FSM 
     * date : 01 jan 2021
     */
    public function detail_act()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                if (!in_array($this->session->userdata(SESSION_LOGIN)->groupid, $this->allowed)) {
                    throw new Exception("You're not allowed access this page!", 3);
                }

                $this->form_validation->set_rules('iduser', 'id', 'required|xss_clean');
                $this->form_validation->set_rules('userid', 'user id', 'required|xss_clean');
                $this->form_validation->set_rules('nama', 'Name', 'required|xss_clean');
                $this->form_validation->set_rules('email', 'Group', 'required|xss_clean');
                $this->form_validation->set_rules('stts', 'Status Active', 'required|xss_clean');

                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $idcomb = decrypt_base64($this->input->post("iduser"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $userid = $tmp[1];

                //CHECK DATA
                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $userid,
                );
                $list_data = $this->m_ref->get_by_condition($select, $cond);
                if ($list_data->num_rows() == 0) {
                    throw new Exception("Data not found, reload the page!!", 0);
                }


                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                //update
                $this->m_ref->setTableName("tbl_user");
                $data_uodate = array(
                    "name"      => $this->input->post("nama"),
                    "email"      => $this->input->post("email"),
                    "active_flag"      => $this->input->post("stts"),
                    "up_dt"      => $current_date_time,
                    "up_by"      =>  $this->session->userdata(SESSION_LOGIN)->userid
                );
                $cond = array(
                    "id"    => $userid,
                );
                $status_save = $this->m_ref->update($cond, $data_uodate);
                if (!$status_save) {
                    throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                }

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
        } else {
            exit("Access Denied");
        }
    }

    /*
     * reset data User ppd
     * author : FSM 
     * date : 01 jan 2021
     */
    function reset_password()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $this->form_validation->set_rules('id', 'Id', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
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
                $list_data = $this->m_ref->get_by_condition($select, $cond);
                if (!$list_data) {
                    log_message("error", $this->db->error()["message"]);
                    throw new Exception("Invalid SQL");
                }
                if ($list_data->num_rows() == 0) {
                    throw new Exception("Data Tidak ada", 0);
                }
                $user     = $list_data->row()->userid;
                $name     = $list_data->row()->name;
                $email    = $list_data->row()->email;

                //update
                $this->db->trans_begin();
                $this->m_ref->setTableName("tbl_user");
                $data_baru = array(
                    "password"         => md5($npas . "monda"),
                    "up_dt"         => $current_date_time,
                    "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
                );
                $cond = array(
                    "id"  => $userid,
                );
                $status_save = $this->m_ref->update($cond, $data_baru);
                if (!$status_save) {
                    throw new Exception($this->db->error("code") . " : Failed Update data", 0);
                }
                if ($email != '') {
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
                    $this->email->from('no-reply@bappenas.go.id', 'PPD 2025');
                    $this->email->to($email);
                    $this->email->subject('[PPD 2025] Ganti Password');
                    $this->email->message("" . $name . " yang terhormat,<br><br>"
                        . "Id Pengguna    : " . $user . "<br>"
                        . "Untuk Password : " . $npas . "<br><br>"
                        . "Salam<br><br><br>"
                        . "Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan Daerah<br><br>"
                        . "--------------------------------------------------------------<br>"
                        . "Email ini dikirim secara otomatis oleh sistem. Anda tidak perlu membalas atau mengirim email ke alamat ini.<br>"
                        . "© 2025 Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan Daerah | www.peppd.bappenas.go.id| dit.peppd@bappenas.go.id ");

                    // Tampilkan pesan sukses atau error
                    if (!$this->email->send()) {
                        throw new Exception($this->db->error()["code"] . ":Gagal Kirim ke email", 0);
                    }
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
        } else {
            exit("Access Denied");
        }
    }

    /*
     * hapus data
     */
    function delete()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $this->form_validation->set_rules('id', 'ID Data', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
                }
                $idcomb = decrypt_base64($this->input->post("id"));
                $tmp = explode('-', $idcomb);
                if (count($tmp) != 2)
                    throw new Exception("Invalid ID");
                $kate_wlyh = $tmp[0];
                $userid = $tmp[1];

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                $this->m_ref->setTableName("tbl_user");
                $select = array();
                $cond = array(
                    "id"  => $userid,
                );
                $list_data = $this->m_ref->get_by_condition($select, $cond);
                if ($list_data->num_rows() == 0) {
                    throw new Exception("Data not found, please reload this page!", 0);
                }

                $this->db->trans_begin();
                //                $status = $this->m_ref->delete($cond);
                //                if(!$status){
                //                    if($this->db->error()["code"] == 1451)
                //                        throw new Exception($this->db->error()["code"].":Data sedang digunakan",0);
                //                    else
                //                        throw new Exception($this->db->error()["code"].":Failed delete data",0);
                //                }
                $data_baru = array(
                    "active_flag"         => "D",
                    "up_dt"         => $current_date_time,
                    "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
                );
                $cond = array(
                    "id"  => $userid,
                );
                $status_save = $this->m_ref->update($cond, $data_baru);
                if (!$status_save) {
                    throw new Exception($this->db->error("code") . " : Failed Update data", 0);
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
        } else {
            exit("Access Denied");
        }
    }




    function change_password()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $this->form_validation->set_rules('opass', 'Password Saat Ini', 'required');
                $this->form_validation->set_rules('npass', 'New Password', 'required');
                $this->form_validation->set_rules('cpass', 'Ulangi Password', 'required');
                if ($this->form_validation->run() == FALSE) {
                    throw new Exception(validation_errors("", ""), 0);
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
                $bind = array($userid, md5($pass . "monda"));
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data)
                    throw new Exception("SQL Error!");
                if ($list_data->num_rows() == 0)
                    throw new Exception("Wrong Combination!");
                //update
                $this->db->trans_begin();
                $this->m_ref->setTableName("tbl_user");
                $data_baru = array(
                    "password"         => md5($npas . "monda"),
                    "up_dt"         => $current_date_time,
                    "up_by" =>  $this->session->userdata(SESSION_LOGIN)->userid
                );
                $cond = array(
                    "id"  => $list_data->row()->id,
                );
                $status_save = $this->m_ref->update($cond, $data_baru);
                if (!$status_save) {
                    throw new Exception($this->db->error("code") . " : Failed Update data", 0);
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
        } else {
            exit("Access Denied");
        }
    }
}
