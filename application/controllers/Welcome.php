<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    var $dir_view = "admin/login/";
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Master", "m_ref");
        $this->load->library('email'); //panggil library email codeigniter
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        //CREATE CAPTCHA
        $this->load->helper('captcha');
        $original_string = array_merge(range(1, 9), range('A', 'Z'));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 5);
        $vals = array(
            'word'          => $captcha,
            'img_path'      => './captcha/',
            'font_path'     => './fonts/KeepCalm-Medium.ttf',
            'img_url'       => base_url("captcha") . "/",
            'img_width'     => 200,
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 5,
            'font_size'     => 15,
            //            'pool'          => strtolower('123456789ABCDEFGHIJKLMNPRSTUVWXYZ'),

            // White background and border, black text and red grid
            'colors'        => array(
                'background'    => array(255, 255, 255),
                'border'        => array(255, 255, 255),
                'text'          => array(0, 0, 0),
                'grid'          => array(255, 255, 100)
            )
        );

        $cap = create_captcha($vals);
        $this->session->set_userdata("captchaword", $cap["word"]);
        session_write_close();
        $data_page = array(
            "page_title"    => "Kementerian PPN/Bappenas :: Pemantauan Evaluasi, Dan Pengendalian Pembangunan Daerah",
            "js_initial"    => "login.init();",
            "captcha_img"   =>  $cap["image"]
        );
        $this->load->view($this->dir_view . 'index', $data_page);
    }

    function login_act()
    {
        if ($this->input->is_ajax_request()) {
            try {
                $this->form_validation->set_rules('userid', 'ID', 'required|xss_clean');
                $this->form_validation->set_rules('pass', 'Password', 'required|xss_clean');
                $this->form_validation->set_rules('captcha', 'Captcha', 'required|xss_clean');
                if ($this->form_validation->run() == FALSE)
                    throw new Exception(validation_errors("", ""), 0);

                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");

                if ($this->session->userdata("captchaword") !== $this->input->post("captcha"))
                    throw new Exception("Captcha salah", 0);
                $userid = $this->input->post("userid");

                $pass   = $this->input->post("pass");
                $sql = "SELECT A.id, A.userid,A.`name`,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        WHERE A.`userid`=? AND A.`password`=?;";


                $bind = array($userid, md5($pass . "monda"));
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data)
                    throw new Exception("SQL Error!");
                if ($list_data->num_rows() == 0)
                    throw new Exception("Kombinasi salah");
                if ($list_data->row()->active_flag == 'D')
                    throw new Exception("Akun anda tidak aktif");
                $this->session->set_userdata('2023ppd', $list_data->row());

                //update last access
                $this->db->trans_begin();
                $this->m_ref->setTableName("tbl_user");
                $data_baru = array(
                    "last_access"         => $current_date_time,
                );
                $cond = array(
                    "id"  => $list_data->row()->id,
                );
                $status_save = $this->m_ref->update($cond, $data_baru);
                if (!$status_save) {
                    throw new Exception($this->db->error("code") . " : Failed save data", 0);
                }

                $this->db->trans_commit();
                $output = array(
                    "status"    =>  1,
                    "msg"       =>  "You logged in",
                    "csrf_hash" => $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            } catch (Exception $e) {
                $this->db->trans_rollback();
                $this->load->helper('captcha');
                $original_string = array_merge(range(1, 9), range('A', 'Z'));
                $original_string = implode("", $original_string);
                $captcha = substr(str_shuffle($original_string), 0, 5);
                $vals = array(
                    'word'          => $captcha,
                    'img_path'      => './captcha/',
                    'font_path'     => './fonts/KeepCalm-Medium.ttf',
                    'img_url'       => base_url("captcha"),
                    'img_width'     => 200,
                    'img_height'    => 30,
                    'expiration'    => 7200,
                    'word_length'   => 5,
                    'font_size'     => 15,
                    'pool'          => '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

                    // White background and border, black text and red grid
                    'colors'        => array(
                        'background' => array(255, 255, 255),
                        'border' => array(255, 255, 255),
                        'text' => array(0, 0, 0),
                        'grid' => array(255, 73, 142)
                    )
                );

                $cap = create_captcha($vals);
                //        print_r($cap);exit();
                $this->session->set_userdata("captchaword", $cap["word"]);
                $output = array(
                    'status'    =>  0,
                    "msg"       =>  $e->getMessage(),
                    "captcha_img"   =>  $cap["image"],
                    "csrf_hash"     => $this->security->get_csrf_hash(),
                );
                exit(json_encode($output));
            }
        } else {
            echo "denied";
        }
    }

    /*
     * Change Password
     * author : FSM 
     * date : 29 des 2020
     */
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
                $name   = $this->session->userdata(SESSION_LOGIN)->name;


                $uppercase = preg_match('@[A-Z]@', $npas);
                $lowercase = preg_match('@[a-z]@', $npas);
                $number    = preg_match('@[0-9]@', $npas);

                if (!$uppercase || !$lowercase || !$number || strlen($npas) <= 6)
                    throw new Exception("Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil dan angka");


                $sql = "SELECT A.id, A.userid,A.`name`,A.`email`,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        WHERE A.`userid`=? AND A.`password`=?";
                $bind = array($userid, md5($pass . "monda"));
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data)
                    throw new Exception("SQL Error!");
                if ($list_data->num_rows() == 0)
                    throw new Exception("Wrong Combination!");
                $email = $list_data->row()->email;
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
                //$this->load->library('email');
                $this->email->initialize($config);

                // Email dan nama pengirim
                $this->email->from('no-reply@bappenas.go.id', 'PPD 2024');
                // Email penerima
                $this->email->to($email); // Ganti dengan email tujuan
                // Subject email
                $this->email->subject('[PPD 2024] Ganti Password');
                // Isi email
                $this->email->message("" . $name . " yang terhormat,<br><br>"
                    . "Untuk Password : " . $npas . "<br><br>"
                    . "Salam<br><br><br>"
                    . "Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan Daerah<br><br>"
                    . "--------------------------------------------------------------<br>"
                    . "Email ini dikirim secara otomatis oleh sistem. Anda tidak perlu membalas atau mengirim email ke alamat ini.<br>"
                    . "© 2024 Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan Daerah | www.peppd.bappenas.go.id| dit.peppd@bappenas.go.id ");

                // Tampilkan pesan sukses atau error
                if (!$this->email->send()) {
                    throw new Exception($this->db->error()["code"] . ":Gagal Kirim", 0);
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

    function change_password_new()
    {
        if ($this->input->is_ajax_request()) {
            try {
                if (!$this->session->userdata(SESSION_LOGIN)) {
                    throw new Exception("Session berakhir, silahkan login ulang", 2);
                }
                $this->form_validation->set_rules('nemail', 'Email', 'required');
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
                $name   = $this->session->userdata(SESSION_LOGIN)->name;


                $uppercase = preg_match('@[A-Z]@', $npas);
                $lowercase = preg_match('@[a-z]@', $npas);
                $number    = preg_match('@[0-9]@', $npas);

                if (!$uppercase || !$lowercase || !$number || strlen($npas) <= 6)
                    throw new Exception("Password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil dan angka");


                $sql = "SELECT A.id, A.userid,A.`name`,A.`email`,A.`active_flag`,A.`group`,B.`groupid`,B.`name` groupname,A.satker
                        FROM tbl_user A
                        INNER JOIN `tbl_user_group` B ON A.`group`=B.`id`
                        WHERE A.`userid`=? AND A.`password`=?";
                $bind = array($userid, md5($pass . "monda"));
                $list_data = $this->db->query($sql, $bind);
                if (!$list_data)
                    throw new Exception("SQL Error!");
                if ($list_data->num_rows() == 0)
                    throw new Exception("Wrong Combination!");

                $email = $this->input->post("nemail");

                $config = [
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1',
                    'protocol'  => 'smtp',
                    'smtp_host' => 'webmail.bappenas.go.id',
                    'smtp_user' => SMTP_USER,  // Email gmail
                    'smtp_pass'   => SMTP_PASS,  // Password gmail
                    'smtp_port '  => 465,

                    //                 'smtp_host' => 'ssl://smtp.gmail.com',
                    //                 'smtp_user' => 'nanang101295@gmail.com',  // Email gmail
                    //                 'smtp_pass'   => 'emailpribadi123',  // Password gmail
                    //                 'smtp_crypto' => 'ssl',
                    //                 'smtp_port '  => 465,
                    'crlf'    => "\r\n",
                    'newline' => "\r\n",
                    'wordwrap' => TRUE
                ];
                // Load library email dan konfigurasinya
                $this->load->library('email', $config);
                //$this->load->library('email');
                $this->email->initialize($config);

                // Email dan nama pengirim
                $this->email->from('no-reply@bappenas.go.id', 'PPD 2024');
                // Email penerima
                $this->email->to($email); // Ganti dengan email tujuan
                // Subject email
                $this->email->subject('[PPD 2024] ');
                // Isi email
                $this->email->message("Yth. Bapak/Ibu " . $name . ",<br><br>"
                    . "Terima kasih telah mendaftar di Sistem penilaian PPD 2024. Akun anda yang terdaftar di sistem kami adalah :<br><br>"
                    . "Id Pengguna : " . $userid . "<br><br>"
                    . "Password    : " . $npas . "<br><br>"
                    . "Salam<br><br><br>"
                    . "Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan Daerah<br><br>"
                    . "--------------------------------------------------------------<br>"
                    . "Email ini dikirim secara otomatis oleh sistem. Anda tidak perlu membalas atau mengirim email ke alamat ini.<br>"
                    . "© 2024 Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan Daerah | https://peppd.bappenas.go.id | ppd@bappenas.go.id ");

                // Tampilkan pesan sukses atau error
                if (!$this->email->send()) {
                    throw new Exception($this->db->error()["code"] . ":Gagal Kirim", 0);
                }
                //update
                $this->db->trans_begin();
                $this->m_ref->setTableName("tbl_user");
                $data_baru = array(
                    "email"         => $email,
                    "password"      => md5($npas . "monda"),
                    "active_flag"   => "Y",
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

    function refresh_captcha()
    {
        if ($this->input->is_ajax_request()) {
            try {
                //                $this->session->sess_destroy();
                //                $this->session->unset_userdata('captchaword');
                date_default_timezone_set("Asia/Jakarta");
                $current_date_time = date("Y-m-d H:i:s");
                $this->load->helper('captcha');
                $original_string = array_merge(range(1, 9), range('A', 'Z'));
                $original_string = implode("", $original_string);
                $captcha = substr(str_shuffle($original_string), 0, 5);
                $vals = array(
                    'word'          => $captcha,
                    'img_path'      => './captcha/',
                    'font_path'     => './fonts/KeepCalm-Medium.ttf',
                    'img_url'       => base_url("captcha"),
                    'img_width'     => 200,
                    'img_height'    => 30,
                    'expiration'    => 7200,
                    'word_length'   => 5,
                    'font_size'     => 15,
                    'pool'          => '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

                    // White background and border, black text and red grid
                    'colors'        => array(
                        'background' => array(255, 255, 255),
                        'border' => array(255, 255, 255),
                        'text' => array(0, 0, 0),
                        'grid' => array(255, 73, 142)
                    )
                );

                $cap = create_captcha($vals);
                $this->session->set_userdata("captchaword", $cap["word"]);
                //                session_write_close();
                $output = array(
                    "status"        =>  1,
                    "msg"           =>  "Done",
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "captcha_img"   =>  $cap["image"]
                );
                exit(json_encode($output));
            } catch (Exception $exc) {
                $this->load->helper('captcha');
                $original_string = array_merge(range(1, 9), range('A', 'Z'));
                $original_string = implode("", $original_string);
                $captcha = substr(str_shuffle($original_string), 0, 5);
                $vals = array(
                    'word'          => $captcha,
                    'img_path'      => './captcha/',
                    'font_path'     => './fonts/KeepCalm-Medium.ttf',
                    'img_url'       => base_url("captcha"),
                    'img_width'     => 200,
                    'img_height'    => 30,
                    'expiration'    => 7200,
                    'word_length'   => 5,
                    'font_size'     => 15,
                    'pool'          => '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

                    // White background and border, black text and red grid
                    'colors'        => array(
                        'background' => array(255, 255, 255),
                        'border' => array(255, 255, 255),
                        'text' => array(0, 0, 0),
                        'grid' => array(255, 73, 142)
                    )
                );

                $cap = create_captcha($vals);
                $this->session->set_userdata("captchaword", $cap["word"]);
                session_write_close();
                $output = array(
                    "status"        =>  $exc->getCode(),
                    "msg"           =>  $exc->getMessage(),
                    "csrf_hash"     =>  $this->security->get_csrf_hash(),
                    "captcha_img"   =>  $cap["image"]
                );
                exit(json_encode($output));
            }
        } else {
            exit("Access Denied");
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('login');
        redirect('welcome', 'refresh');
    }
}
