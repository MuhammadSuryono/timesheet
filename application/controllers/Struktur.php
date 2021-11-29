<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Struktur extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Struktur_model');
    if(!$this->session->userdata('ses_username')){
        redirect('auth');
    }
  }

  public function management()
  {
    $data['direksi'] = $this->Struktur_model->direksi();
    $data['karyawan'] = $this->Struktur_model->karyawan();
    $data['manager'] = $this->Struktur_model->manager();
    $data['managerlain'] = $this->Struktur_model->managerlain();
    $data['staff'] = $this->Struktur_model->staff();

    // var_dump($data['managerlain']); die;

    // VIEW 1
    // $this->load->view('template/header');
    // $this->load->view('template/sidebar');
    // $this->load->view('struktur/management', $data);
    // $this->load->view('template/footer');
    // akhir

    if($this->session->userdata('ses_username')!='001'){
      // redirect('struktur/managementstaff');
    // VIEW 2
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    // $this->load->view('struktur/management2', $data);
    $this->load->view('struktur/management4', $data);
    $this->load->view('template/footer');
    // akhir
    } else {
    // VIEW 3
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('struktur/management3', $data);
    $this->load->view('template/footer');
    // akhir
    }
  }

  public function managementstaff()
  {
    $data['staff'] = $this->Struktur_model->staff1();
    $data['manager_direksi'] = $this->Struktur_model->manager_direksi();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('struktur/management5', $data);
    $this->load->view('template/footer');
  }

  public function tambah()
  {
    $this->Struktur_model->tambah();
    $this->session->set_flashdata('flash2', 'Berhasil Di Simpan');
    redirect('struktur/management');
  }

  public function hapus($id)
  {
    $this->Struktur_model->hapus($id);
    $this->session->set_flashdata('flash2', 'Berhasil Di Hapus');
    redirect('struktur/management');
  }

}
