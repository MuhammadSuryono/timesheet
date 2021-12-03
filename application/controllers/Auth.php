<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model');
    $this->load->library('session');
    //Codeigniter : Write Less Do More
    $this->load->helper('cookie'); 
  }

  public function index()
  {
    $this->load->view('auth/login');
  }

  public function full()
  {
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('template/content');
    $this->load->view('template/footer');
  }

  public function authlogin()
  {

    $username = $this->input->post('username');
    $password = $this->input->post('password');
    // $remember = $this->input->post('remember_me');
    // $cekuser = $this->Auth_model->cekusernya($username, $password);
    $cekuser = $this->Auth_model->cekusernya2($username);


    if ($cekuser->num_rows() == 1) {
      $data = $cekuser->row_array();
      if (password_verify($password, $data['password'])) {
        $data = $cekuser->row_array();
      $this->session->set_userdata('masuk', TRUE);
      $this->session->set_userdata('ses_username', $data['id_user']);
      $this->session->set_userdata('ses_divisi', $data['divisi']);
      $this->session->set_userdata('ses_nama', $data['nama_user']);
      $this->session->set_userdata('ses_akses', $data['hak_akses']);
      $this->session->set_userdata('ses_jabatan', $data['jabatan1']);
      $this->session->set_userdata('ses_id', $data['no_user']);
			$this->session->set_userdata('ses_atasan', $data['atasan']);
      
      if (isset($_POST['remember_me'])) {
          // buat coockie
        set_cookie('username', $username, time() + 86400 * 30);
        set_cookie('password', $password, time() + 86400 * 30);
      } else if (!isset($_POST['remember_me'])){
        set_cookie('username', null, -1);
        set_cookie('password', null, -1);
      }

      $this->session->set_flashdata('cek', 'Berhasil Login');
      redirect(base_url('dashboard'));
     } else {
      $url = base_url();
      $this->session->set_flashdata('flash', 'Username atau Password Anda salah!');
      redirect($url); 
     }
    } else {
      $url = base_url();
      $this->session->set_flashdata('flash', 'Username atau Password Anda salah!');
      redirect($url);
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('masuk');
    $this->session->unset_userdata('ses_username');
    $this->session->unset_userdata('ses_divisi');
    $this->session->unset_userdata('ses_nama');
    $this->session->unset_userdata('ses_akses');
    $this->session->unset_userdata('ses_jabatan');
    $this->session->unset_userdata('ses_id');
    $url = base_url();
    redirect($url);
  }

  public function register()
  {
    $data['divisi'] = $this->db->query("SELECT * FROM divisi WHERE id_divisi != 15 AND id_divisi != 19 AND id_divisi != 18 ORDER BY divisi ASC")->result_array();

    $this->load->view('auth/register', $data);
  }

  public function prosesregister()
  {
    $pass = $this->input->post('password');
    $jabatan = $this->input->post('jabatan');

    if ($jabatan == 'Manager') {
      $posisi = 'Leader 1';
    } else if ($jabatan == 'Pegawai') {
      $posisi = 'Staff';
    }


    $data = [
      'id_user' => $this->input->post('id_user'),
      'nama_user' => $this->input->post('nama_user'),
      'email' => $this->input->post('email'),
      'password' => password_hash($pass, PASSWORD_DEFAULT),
      'divisi' => $this->input->post('divisi'),
      'jabatan1' => $posisi,
      'hak_akses' => $jabatan,
      'atasan' => $this->input->post('atasan'),
      'nik' => $this->input->post('nik'),
      'tgl_masuk' => $this->input->post('tanggalMasuk'),
      'aktif' => 'Y'
    ];

    $this->db->insert('tb_user', $data);

    $this->session->set_flashdata('flash2', 'Register Berhasil');
    $url = base_url('dashboard');
    redirect($url);
  }

  public function get_atasan()
  {
    $jabatan = $_POST['jabatan'];

    $query = $this->Auth_model->get_atasan($jabatan);
    echo json_encode($query);
  }

  public function change_password()
  {
        $data['title'] = "Change Password";
        $data['list'] = "";

      $id_user = $this->session->userdata('ses_username');
      $data['biodata'] = $this->db->query("SELECT * FROM tb_user WHERE id_user = '$id_user'")->result_array();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('auth/change_password', $data);
    $this->load->view('template/footer');
  }

  public function save_change_password()
    {
        $data['title'] = "Change Password";
        $data['list'] = "";

        $this->form_validation->set_rules('oldpass', 'old password', 'required');
        $this->form_validation->set_rules('newpass', 'new password', 'required');
        $this->form_validation->set_rules('passconf', 'confirm password', 'required|matches[newpass]');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        if($this->form_validation->run() == false) {
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('auth/change_password');
        $this->load->view('template/footer');   
    
        } else {

            $id = $this->session->userdata('ses_id');
            $user = $this->db->get_where('tb_user', array('no_user' => $id))->row_array();

            $oldpass = $this->input->post('oldpass');

            if (!password_verify($oldpass, $user['password'])) {
              $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama yang Anda masukkan salah!</div>');
              redirect('auth/change_password');
            } else {

            $newpass = $this->input->post('newpass');

                if ($newpass == $oldpass) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama dan Password baru tidak boleh sama!</div>');
                    redirect('auth/change_password');
                } else {

                $data_akses = [
                        'password' => password_hash($newpass,PASSWORD_DEFAULT)
                        ];

                  $where = ['no_user' => $id];

                        $this->db->where($where);
                        $this->db->update('tb_user', $data_akses);


                var_dump($user);
                redirect('auth/logout');
                  }
          }
        }
    }

    public function forgot_password()
    {
     
    $this->load->view('auth/forgotpassword');
    }

    public function forgotpassword()
    {

      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      if ($this->form_validation->run() == false ) {
        $this->load->view('auth/forgotpassword');
      } else {
        $email = $this->input->post('email');
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $token = '';
          for ($i = 0; $i < 32; $i++) {
              $token .= $characters[rand(0, $charactersLength - 1)];
          }
          // return $randomString;

        $user = $this->db->get_where('tb_user', array('email' => $email ))->row_array();

        if ($user) {
           $config = [
                        'protocol' => 'smtp',
                      'smtp_host' => '192.168.8.3',
                      'smtp_port' => 25,
                      'smtp_user' => 'admin.web@mri-research-ind.com',
                      'smtp_pass' => 'w3bminMRI',
                      'smtp_timeout' => '30',
                      'crlf' => "\r\n",
                        'newline' => "\r\n"

                    ];

             $link  .= "<a href='" . base_url('auth/form_reset?email=') . $email ."&token=".$token. "' >Reset Password</a>";

            $this->load->library('email', $config);
            $this->email->initialize($config);

            $this->email->from('admin.web@mri-research-ind.com', 'MRI-TimesheetWFH WebAdmin');
            $this->email->to($email);
            $this->email->subject('Timesheet WFH - Reset Password');
            $this->email->message('
                Click this link to reset your password : '.$link.'
                    ');

            $this->email->set_mailtype('html');
            $this->email->send();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
              redirect('auth/forgotpassword');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
              redirect('auth/forgotpassword');
        }

      var_dump($user);
      }
    }

    public function form_reset()
    {

      $email = $this->input->get('email');

      $this->session->set_userdata('reset_email', $email);
      $this->load->view('auth/reset_password');
   } 

   public function new_password()
   {
    if (!$this->session->userdata('reset_email')) {
        redirect('auth');
      }
      
    $password = password_hash($this->input->post('newpass'), PASSWORD_DEFAULT);
    // $email = $this->input->post('email');
    $email = $this->session->userdata('reset_email');

    // var_dump($email);
    $this->db->set('password', $password);
    $this->db->where('email', $email);
    $this->db->update('tb_user');

    $this->session->unset_userdata('reset_email');
    
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login!</div>');
    redirect('auth');
   }
}
