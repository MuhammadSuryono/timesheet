<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Master_model');
    $this->load->library('session');
    if(!$this->session->userdata('ses_username')){
        redirect('auth');
    }
  }

  public function divisi()
  {
    $data['divisi'] = $this->Master_model->divisi();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('master/divisi', $data);
    $this->load->view('template/footer');
  }

  public function tambahdivisi()
  {
      $cek = $this->db->get_where('divisi', ['divisi' => $this->input->post('divisi')])->row_array();

      if($cek == 0){
        $this->Master_model->tambahdivisi();
      }

      $this->session->set_flashdata('flash2', 'Berhasil Di Simpan');
      redirect('master/divisi');
  }

  public function editdivisi()
  {
      $this->Master_model->editdivisi();
      $this->session->set_flashdata('flash2', 'Berhasil Di Ubah');
      redirect('master/divisi');
  }

  public function hapusdivisi($id)
  {
      $this->Master_model->hapusdivisi($id);
     $this->session->set_flashdata('flash2', 'Berhasil Di Hapus');
      redirect('master/divisi');
  }

  public function karyawan()
  {
    $data['divisi'] = $this->Master_model->divisi();
    $data['karyawan'] = $this->Master_model->karyawan();
    $data['karyawanlain'] = $this->Master_model->karyawanlain();
    $data['karyawanlain2'] = $this->Master_model->karyawanlain2();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('master/karyawan', $data);
    $this->load->view('template/footer');
  }

  public function tambahkaryawan()
  {
      $this->Master_model->tambahkaryawan();
     $this->session->set_flashdata('flash2', 'Berhasil Di Simpan');
      redirect('master/karyawan');
  }

  public function editkaryawan()
  {
      $this->Master_model->editkaryawan();
     $this->session->set_flashdata('flash2', 'Berhasil Di Ubah');
      redirect('master/karyawan');
  }

  public function hapuskaryawan($id)
  {
      $this->Master_model->hapuskaryawan($id);
     $this->session->set_flashdata('flash2', 'Berhasil Di Hapus');
      redirect('master/karyawan');
  }

  public function hapuskaryawan2($id)
  {
      $this->Master_model->hapuskaryawan2($id);
     $this->session->set_flashdata('flash2', 'Berhasil Di Hapus');
      redirect('master/karyawan');
  }

  public function kategori()
  {
    $data['kategori'] = $this->Master_model->kategori();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('master/kategori', $data);
    $this->load->view('template/footer');
  }

  public function tambahkategori()
  {
    $this->Master_model->tambahkategori();
    $this->session->set_flashdata('flash2', 'Berhasil Di Simpan');
    redirect('master/kategori');
  }

  public function editkategori()
  {
    $this->Master_model->editkategori();
    $this->session->set_flashdata('flash2', 'Berhasil Di Ubah');
    redirect('master/kategori');
  }

  public function hapuskategori($id)
  {
     $this->Master_model->hapuskategori($id);
     $this->session->set_flashdata('flash2', 'Berhasil Di Hapus');
     redirect('master/kategori');
  }

  public function waktuisitkm(){
    $data['alldiv'] = $this->db->query("SELECT * FROM waktuisi ORDER BY divisi ASC")->result_array();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('master/waktuisitkm', $data);
    $this->load->view('template/footer');
  }

  public function editwaktuisi(){
    $divisi = $this->input->post('divisi');
    $waktuisi = $this->input->post('waktuisi');

    // var_dump($waktuisi);
    // die;

    $this->db->query("UPDATE waktuisi SET waktuisi = concat(date(waktuisi), '$waktuisi') WHERE divisi='$divisi'");

    $this->session->set_flashdata('flash2', 'Berhasil Di Ubah');
    redirect('master/waktuisitkm');
  }

   public function panduan(){
    $data['panduan'] = $this->db->query("SELECT * FROM panduan ORDER BY id DESC")->result_array();
    $data['judul'] = 'Panduan Aplikasi';
    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('master/panduan', $data);
    $this->load->view('template/footer');
  }

  public function uploadpanduan() {
        $judul = $this->input->post('judul');
         $tanggal = date('Y-m-d');

        $extension_file  = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
        $file_name = "PanduanAplikasi_".$tanggal."_" . time() . "." . $extension_file;
        $file_tmp = $_FILES["file_upload"]['tmp_name'];
        move_uploaded_file($file_tmp, "dist/upload/" . $file_name);
       

        
        $data = [
                'judul' => $judul,
                'fileupload' => $file_name,
                'tanggalupload' => $tanggal
                ];

        $insert = $this->db->insert('panduan', $data);
        if ($insert) {
            $this->session->set_flashdata('flash2', 'Berhasil Upload Panduan');
            redirect('master/panduan'); 
        } else {
          $this->session->set_flashdata('flash', 'Gagal Upload Panduan');
          redirect('master/panduan');
        }
  }

  public function hapuspanduan($id)
  {
     $this->Master_model->hapuspanduan($id);
     $this->session->set_flashdata('flash2', 'Berhasil Di Hapus');
     redirect('master/panduan');
  }


}
