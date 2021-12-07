<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Api.php");


class Mingguan extends Api
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Mingguan_model');
    $this->load->library('form_validation');
    //Codeigniter : Write Less Do More
    if (!$this->session->userdata('ses_username')) {
      redirect('auth');
    }
  }

  public function homemingguan2()
  {
    $data['kelima'] = $this->Mingguan_model->getminggukelima();
    $data['kedua'] = $this->Mingguan_model->getminggukedua();
    $data['ketiga'] = $this->Mingguan_model->getmingguketiga();
    $data['keempat'] = $this->Mingguan_model->getminggukeempat();
    $data['prokelima'] = $this->Mingguan_model->getpekerjaankelima();
    $data['prokedua'] = $this->Mingguan_model->getpekerjaankedua();
    $data['proketiga'] = $this->Mingguan_model->getpekerjaanketiga();
    $data['prokeempat'] = $this->Mingguan_model->getpekerjaankeempat();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/homemingguan', $data);
    $this->load->view('template/footer');
  }

  public function homemingguan3()
  {
    date_default_timezone_set('Asia/Jakarta');

    $tanggalnow = date('Y-m-d');
    $var = date('N', strtotime($tanggalnow));
    $awal = $var - 1;
    $akhir = 5 - $var;

    $senin = date('Y-m-d', strtotime("-$awal days", strtotime($tanggalnow)));
    $jumat = date('Y-m-d', strtotime("+$akhir days", strtotime($tanggalnow)));

    $dari       = $senin;
    $sampai     = date('Y-m-d', strtotime("+21 days", strtotime($dari)));

    $data['senin'] = $senin;
    $data['pekerjaan'] = $this->Mingguan_model->getPekerjaan($dari, $sampai);
    $data['tkmdivisi'] = $this->Mingguan_model->getTkmDivisi($dari, $sampai);
    // var_dump("A"); die;

    $data['kelima'] = $this->Mingguan_model->getminggukelima();
    $data['kedua'] = $this->Mingguan_model->getminggukedua();
    $data['ketiga'] = $this->Mingguan_model->getmingguketiga();
    $data['keempat'] = $this->Mingguan_model->getminggukeempat();
    $data['prokelima'] = $this->Mingguan_model->getpekerjaankelima();
    $data['prokedua'] = $this->Mingguan_model->getpekerjaankedua();
    $data['proketiga'] = $this->Mingguan_model->getpekerjaanketiga();
    $data['prokeempat'] = $this->Mingguan_model->getpekerjaankeempat();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/homemingguan2', $data);
    $this->load->view('template/footer');
  }

  public function homemingguan()
  {
    date_default_timezone_set('Asia/Jakarta');

     $divisinya = $this->session->userdata('ses_divisi');
    $username = $this->session->userdata('ses_username');


    $tanggalnow = date('Y-m-d');
    $var = date('N', strtotime($tanggalnow));
    $awal = $var - 1;
    $akhir = 5 - $var;

    $tkm = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal <= '$tanggalnow' AND sampaitanggal >= '$tanggalnow' AND divisi='$divisinya' AND pengisi='$username' LIMIT 1")->row_array();

    if ($tkm != NULL) {
      $senin = $tkm['daritanggal'];
      $jumat = $tkm['sampaitanggal'];
    } else {
      $senin = date('Y-m-d', strtotime("-$awal days", strtotime($tanggalnow)));
      $jumat = date('Y-m-d', strtotime("+$akhir days", strtotime($tanggalnow)));
    }

    $dari       = $senin;
    $sampai     = date('Y-m-d', strtotime("+21 days", strtotime($dari)));

    $data['senin'] = $senin;
    $data['pekerjaan'] = $this->Mingguan_model->getPekerjaan($dari, $sampai);
    $data['pekerjaan_lintasdivisi'] = $this->Mingguan_model->getPekerjaanLintasDivisi($dari, $sampai);
    $data['tkmdivisi'] = $this->Mingguan_model->getTkmDivisi($dari, $sampai);
    $data['id_tkm'] = $tkm['no'];

    // var_dump("A"); die;

    // $data['kelima'] = $this->Mingguan_model->getminggukelima();
    // $data['kedua'] = $this->Mingguan_model->getminggukedua();
    // $data['ketiga'] = $this->Mingguan_model->getmingguketiga();
    // $data['keempat'] = $this->Mingguan_model->getminggukeempat();
    // $data['prokelima'] = $this->Mingguan_model->getpekerjaankelima();
    // $data['prokedua'] = $this->Mingguan_model->getpekerjaankedua();
    // $data['proketiga'] = $this->Mingguan_model->getpekerjaanketiga();
    // $data['prokeempat'] = $this->Mingguan_model->getpekerjaankeempat();
    $data['judul'] = 'Target Kerja';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/homemingguan3', $data);
    $this->load->view('template/footer');
  }

  public function isitkm($tanggal1, $tanggal2)
  {
    $this->form_validation->set_rules('project0', 'Project', 'required');

    if ($this->form_validation->run() == false) {
      $data['tanggalnya'] = [
        't1' => $tanggal1,
        't2' => $tanggal2,
      ];
      $divisi = $this->session->userdata('ses_divisi');
      $data['cariproject'] = $this->db->query("SELECT
                                                	a.*, SUM(a.persentase) AS sumper
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                	HAVING SUM(a.persentase) < 100")->result_array();
      $data['jmlpekerjaan'] = $this->db->query("SELECT
                                                	COUNT(a.no) AS nonya
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                	HAVING SUM(a.persentase) < 100")->row_array();


      $this->load->view('template/header');
      $this->load->view('template/sidebar');
      $this->load->view('mingguan/isitkmdivisi', $data);
      $this->load->view('template/footer');
    } else {
      $this->Mingguan_model->isitkmnya();
      $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
      redirect('mingguan/homemingguan');
    }
  }

  public function isitkm2($tanggal1, $tanggal2)
  {
    $this->form_validation->set_rules('project0', 'Project', 'required');

    if ($this->form_validation->run() == false) {
      $data['tanggalnya'] = [
        't1' => $tanggal1,
        't2' => $tanggal2,
      ];
      $divisi = $this->session->userdata('ses_divisi');
      $data['cariproject'] = $this->db->query("SELECT
                                                	a.*, SUM(a.persentase) AS sumper
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                	HAVING SUM(a.persentase) < 100")->result_array();
      $data['jmlpekerjaan'] = $this->db->query("SELECT
                                                	COUNT(a.no) AS nonya
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                  HAVING SUM(a.persentase) < 100")->row_array();

      // $data['kategori'] = $this->db->get_where('kategori', ['divisi'=>$divisi])->result_array();

      $data['kategori'] = $this->db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC")->result_array();

      $this->load->view('template/header');
      $this->load->view('template/sidebar');
      $this->load->view('mingguan/isitkmdivisi2', $data);
      $this->load->view('template/footer');
    } else {
      // var_dump("MASUK"); die;
      $this->Mingguan_model->isitkmnya2();
      $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
      redirect('mingguan/homemingguan');
    }
  }

  public function simpantkm2()
  {
    // $banyakuraian = $this->input->post("uraian1");
    // var_dump("$banyakuraian"); die;
    $this->Mingguan_model->isitkmnya2();
    $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
    redirect('mingguan/homemingguan');
  }

  public function isitkm3($tanggal1, $tanggal2)
  {
    $this->form_validation->set_rules('project0', 'Project', 'required');
        $user = $this->session->userdata('ses_username');
        $cek_wl = $this->db->get_where('list_note', array('username' => $user, 'to_tkm' => 'N'))->num_rows();
        if ($cek_wl == 0) {
           echo "<script>alert('Waiting List Anda kosong! Harap membuat Waiting List Target terlebih dahulu agar Anda dapat melanjutkan ke pembuatan TKM! ');
            window.location.href='" . base_url() . "harian/waitinglist';</script>";
            // window.location.href='" . base_url() . "mingguan/homemingguan';</script>";

            // redirect('mingguan/homemingguan'); 
        } else {

    if ($this->form_validation->run() == false) {
      $data['tanggalnya'] = [
        't1' => $tanggal1,
        't2' => $tanggal2,
      ];
      $divisi = $this->session->userdata('ses_divisi');


      if ($this->session->userdata('ses_jabatan') == 'Staff') {
        $user = $this->session->userdata('ses_username');
      // $data['cariproject'] = $this->db->query("SELECT
      //                                             a.*,
      //                                             SUM(a.persentase) AS sumper,
      //                                             c.id_kategori AS idkategori,
      //                                             c.nama_kategori AS namakategori
      //                                           FROM
      //                                             pekerjaan a
      //                                           JOIN tkmdivisi b ON a.idtkmdiv = b. NO
      //                                           JOIN kategori c ON a.id_kategori = c.id_kategori
      //                                           WHERE
      //                                           b.divisi = '$divisi'
      //                                           AND b.pengisi = '$user' 
      //                                           GROUP BY
      //                                             a.project
      //                                             HAVING SUM(a.persentase) < 100")->result_array();
      $data['cariproject'] = NULL;

      } else {
      // $data['cariproject'] = $this->db->query("SELECT
      //                                           	a.*,
      //                                             SUM(a.persentase) AS sumper,
      //                                             c.id_kategori AS idkategori,
      //                                             c.nama_kategori AS namakategori
      //                                           FROM
      //                                           	pekerjaan a
      //                                           JOIN tkmdivisi b ON a.idtkmdiv = b. NO
      //                                           JOIN kategori c ON a.id_kategori = c.id_kategori
      //                                           WHERE
      //                                           b.divisi = '$divisi'
      //                                           AND b.pengisi = '$user'
      //                                           GROUP BY
      //                                           	a.project
      //                                           	HAVING SUM(a.persentase) < 100")->result_array();
      $data['cariproject'] = NULL;
      }

      $data['jmlpekerjaan'] = $this->db->query("SELECT
                                                	COUNT(a.no) AS nonya
                                                FROM
                                                	pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                                WHERE
                                                b.divisi = '$divisi'
                                                GROUP BY
                                                	a.project
                                                  HAVING SUM(a.persentase) < 100")->row_array();

      // $data['kategori'] = $this->db->get_where('kategori', ['divisi'=>$divisi])->result_array();

      $data['kategori'] = $this->db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC")->result_array();
      $data['divisi'] = $this->db->get_where('divisi', ['divisi!=' => $divisi])->result_array();

      $data['rincianPekerjaanSebelumnya'] = $this->db->where('bobotpersentase <', 100)->get('uraian')->result_array();

      // var_dump($data['rincianPekerjaanSebelumnya']);
      // die();
      $data['judul'] = 'Target Kerja';

      $this->load->view('template/header', $data);
      $this->load->view('template/sidebar');
      $this->load->view('mingguan/isitkmdivisi3', $data);
      $this->load->view('template/footer');
    } else {
      // var_dump("MASUK"); die;
      $this->Mingguan_model->isitkmnya2();
      $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
      redirect('mingguan/homemingguan3');
    }
  }
  }

  public function simpantkm3()
  {
    // $banyakuraian = $this->input->post("uraian1");
    // var_dump("$banyakuraian"); die;
    $this->Mingguan_model->isitkmnya3();
    $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
    redirect('mingguan/homemingguan');
  }

  // public function prosesisitkm(){
  //   $daritanggal      = $_POST['daritanggal'];
  //   $sampaitanggal    = $_POST['sampaitanggal'];
  //   $divisi           = $this->session->userdata('ses_divisi');
  //   $pengisi          = $this->session->userdata('ses_username');
  //   $target           = $_POST['target'];
  //   $status           = "Menunggu Approval";
  //
  //   $this->db->query("INSERT INTO tkmdivisi (divisi,pengisi,daritanggal,sampaitanggal,target,status)
  //                                     VALUES ('$divisi','$pengisi','$daritanggal','$sampaitanggal','$target','$status')");
  //
  //   $this->session->set_flashdata('flash2', 'TKM Berhasil Diisi');
  //   redirect('mingguan/homemingguan');
  // }

  public function approvalmingguan3()
  {
    // var_dump("MASUK"); die;
    $data['gettkm'] = $this->Mingguan_model->getalltkm();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/approvalmingguan', $data);
    $this->load->view('template/footer');
  }

  public function approvalmingguan()
  {
    // var_dump("MASUK"); die;
    $data['gettkm'] = $this->Mingguan_model->getalltkm();
    $data['judul'] = 'Target Kerja';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/approvalmingguan3', $data);
    $this->load->view('template/footer');
  }

  public function approve($no)
  {
    $approval = $this->session->userdata('ses_username');
    $datenow = date('Y-m-d');

    $get = $this->db->get_where('tkmdivisi', array('no' => $no))->row_array();
    $this->db->query("UPDATE progress_bar SET persentase='100' WHERE username='$get[pengisi]'");  
    
    $this->db->query("UPDATE tkmdivisi SET status='Disetujui' WHERE no='$no'");
    $cek_kerjaan = $this->db->get_where('pekerjaan', array('idtkmdiv' => $no, 'tambahan' => 'yes'))->result_array();
    // if ($cek_kerjaan == NULL) {
      $pekerjaan = $this->db->get_where('pekerjaan', array('idtkmdiv' => $no))->result_array();
    // } else {
    //   $pekerjaan = $this->db->get_where('pekerjaan', array('idtkmdiv' => $no, 'tambahan' => 'yes'))->result_array();

    // }

    foreach ($pekerjaan as $pek) {
      $staff_tkm = $this->db->get_where('rincian', array('idpekerjaan' => $pek['no']))->num_rows();

      if ($staff_tkm == 0) {
          $data = ['idtkmdiv' => $pek['idtkmdiv'],
                  'leader' => $approval,
                  'userstaff' =>  $get['pengisi'],
                  'project' => $pek['project'],
                  'tanggalisi' => $datenow
                  ];
          $this->db->insert('tkmstaff', $data);
          $last_insert_id = $this->db->insert_id(); 

          $uraian = $this->db->get_where('uraian', array('id_tkmdiv' => $no, 'id_pekerjaan' => $pek['no']))->result_array();
          foreach ($uraian as $ura) {
            $dt = [
                  'idpekerjaan' => $pek['no'],
                  'idtkmdiv' => $no,
                  'userstaff' => $get['pengisi'],
                  'id_tkmstaff' => $last_insert_id,
                  'rincian' => $ura['uraian'],
                  'id_list' => $ura['id_uraian'],
                  'targetselesai' => $ura['targetselesai']
                  ];
          $this->db->insert('rincian', $dt);

        }
      }
    }

    $this->session->set_flashdata('flash2', 'TKM Berhasil Di Approve');
    redirect('mingguan/approvalmingguan');
  }

  // public function approve($no)
  // {
    
  //   $this->db->query("UPDATE tkmdivisi SET status='Disetujui' WHERE no='$no'");
   
  //   $this->session->set_flashdata('flash2', 'TKM Berhasil Di Approve');
  //   redirect('mingguan/approvalmingguan');
  // }

  public function approveb1($tgl)
  {
    $divisi = $this->session->userdata('ses_divisi');
    $this->db->query("UPDATE tkmdivisi SET status='Disetujui' WHERE daritanggal='$tgl' AND divisi='$divisi'");
    $this->session->set_flashdata('flash2', 'TKM Berhasil Di Approve');
    redirect('mingguan/homemingguan');
  }

  public function edittkmdivisi($no)
  {
    $data['tkmnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/edittkmdivisi', $data);
    $this->load->view('template/footer');
  }

  public function prosesedittkm()
  {
    $no     = $_POST['no'];
    $target = $_POST['target'];
    $this->db->query("UPDATE tkmdivisi SET target='$target' WHERE no='$no'");
    if ($this->session->userdata['ses_akses'] == 'Direksi') {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/approvalmingguan');
    } else {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/homemingguan');
    }
  }

  public function deletetkmdivisi($no)
  {
    $this->db->query("DELETE FROM tkmdivisi WHERE no='$no'");
    $this->db->query("DELETE FROM pekerjaan WHERE idtkmdiv='$no'");
    if ($this->session->userdata['ses_akses'] == 'Direksi') {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/approvalmingguan');
    } else {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/homemingguan');
    }
  }

  public function deletetkmdivisi2($no)
  {
    // $cek = $this->db->get_where('tkmdivisi', ['daritanggal' => $no, 'divisi' => $this->session->userdata('ses_divisi')])->row_array();
    // $notkmdiv = $cek['no'];

    $cek = $this->db->get_where('tkmdivisi', ['no' => $no, 'divisi' => $this->session->userdata('ses_divisi')])->row_array();
    $notkmdiv = $cek['no'];


    $this->db->query("DELETE FROM pekerjaan WHERE idtkmdiv='$notkmdiv'");
    $this->db->query("DELETE FROM tkmdivisi WHERE no='$notkmdiv'");

    if ($this->session->userdata['ses_akses'] == 'Direksi') {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/approvalmingguan');
    } else {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/homemingguan');
    }
  }

  public function deletetkmdivisi3($no)
  {
    $cek = $this->db->get_where('tkmdivisi', ['daritanggal' => $no, 'divisi' => $this->session->userdata('ses_divisi')])->row_array();
    $notkmdiv = $cek['no'];

    $this->db->query("DELETE FROM pekerjaan WHERE idtkmdiv='$notkmdiv'");
    $this->db->query("DELETE FROM pekerjaan_lintasdivisi WHERE idtkmdiv='$notkmdiv'");
    $this->db->query("DELETE FROM tkmdivisi WHERE no='$notkmdiv'");

    if ($this->session->userdata['ses_akses'] == 'Direksi') {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/approvalmingguan');
    } else {
      $this->session->set_flashdata('flash2', 'TKM Berhasil Di Hapus');
      redirect('mingguan/homemingguan2');
    }
  }

  public function listtkmdivisi()
  {
    // $data['pertamaapp'] = $this->Mingguan_model->getminggupertamaapp();
    // $data['keduaapp'] = $this->Mingguan_model->getminggukeduaapp();
    // $data['ketigaapp'] = $this->Mingguan_model->getmingguketigaapp();
    // $data['keempatapp'] = $this->Mingguan_model->getminggukeempatapp();
    // $data['kelimaapp'] = $this->Mingguan_model->getminggukelimaapp();
    // $data['keenamapp'] = $this->Mingguan_model->getminggukeenamapp();

    if ($this->session->userdata('ses_divisi') == 'FINANCE') {
      $data['tanggalnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE status='Disetujui' AND (divisi='FINANCE' OR divisi='SUB FINANCE') GROUP BY daritanggal,sampaitanggal")->result_array();
    } else {
      $data['tanggalnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE status='Disetujui' GROUP BY daritanggal,sampaitanggal")->result_array();
    }

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/listtkmdivisi', $data);
    $this->load->view('template/footer');
  }

  public function viewtkmdivisi($no)
  {
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*,
                                              b.no as nopekerjaan
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $divisi = $data['divnya']['divisi'];
    $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND aktif='Y' AND resign='0' ORDER BY nama_user")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff is not null")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewtkmdivisi', $data);
    $this->load->view('template/footer');
  }

  public function viewtkmdivisi2($tgl)
  {
    $divisi = $this->session->userdata('ses_divisi');
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='$tgl' AND divisi='$divisi'")->row_array();
    $no = $data['divnya']['no'];

    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*,
                                              b.no as nopekerjaan
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    //$divisi = $data['divnya']['divisi'];
    $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND aktif='Y' AND resign='0' ORDER BY nama_user")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff is not null")->result_array();

    $data['leader'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1='Leader 1' OR jabatan1='Leader 2' OR jabatan1='Leader 3'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewtkmdivisi', $data);
    $this->load->view('template/footer');
  }

  public function viewtkmdivisi3($id_tkm)
  {
    $divisi = $this->session->userdata('ses_divisi');
    $akses = $this->session->userdata('ses_akses');
    $username = $this->session->userdata('ses_username');
    // $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='$tgl' AND divisi='$divisi'")->row_array();
     $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$id_tkm' AND divisi='$divisi'")->row_array();
    $no = $data['divnya']['no'];

    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*,
                                              b.no as nopekerjaan
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    //$divisi = $data['divnya']['divisi'];
    if ($akses == 'Manager') {
     
    $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND aktif='Y' AND resign='0' ORDER BY nama_user")->result_array();
    } else {
       $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND aktif='Y' AND resign='0' AND id_user='$username' ORDER BY nama_user")->result_array();
    }

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff is not null")->result_array();

    $data['leader'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1='Leader 1' OR jabatan1='Leader 2' OR jabatan1='Leader 3'")->result_array();
    // var_dump($data);
    // die();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewtkmdivisi3', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();

    $data['kerjaan'] = $this->db->query("SELECT
                                          			a.*
                                          FROM pekerjaan a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no'")->result_array();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff2($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();

    $data['kerjaan'] = $this->db->query("SELECT
                                          			a.*
                                          FROM pekerjaan a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no'")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff2', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff3($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();

    $data['kerjaan'] = $this->db->query("SELECT
                                          			a.*
                                          FROM pekerjaan a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no'")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff3', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff4($username, $no)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();

    if ($data['divnya']['status'] == 'Disetujui') {
      $data['kerjaan'] = $this->db->query("SELECT
                                                  a.*
                                            FROM pekerjaan a
                                            JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                            WHERE a.idtkmdiv = '$no'")->result_array();
    } else {
      $data['kerjaan'] = $this->db->query("SELECT
                                                  a.*
                                            FROM pekerjaan a
                                            JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                            WHERE a.idtkmdiv = '$no' AND (a.id_kategori = 1 OR a.id_kategori = 2)")->result_array();
    }



    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff4', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstaff5($username, $no)
  {
    $data['id_tkm'] = $no;
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$no'")->row_array();
    $data['tkmdiv'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.*
                                          FROM tkmdivisi a
                                          JOIN pekerjaan b ON a.no = b.idtkmdiv
                                          WHERE a.no='$no'")->result_array();



    if ($data['divnya']['status'] == 'Disetujui') {
      $data['kerjaan'] = $this->db->query("SELECT
                                                  a.*
                                            FROM pekerjaan a
                                            JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                            WHERE a.idtkmdiv = '$no' AND a.persentase < 100")->result_array();
    } else {
      $data['kerjaan'] = $this->db->query("SELECT
                                                  a.*
                                            FROM pekerjaan a
                                            JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                            WHERE a.idtkmdiv = '$no'AND a.persentase < 100 AND (a.id_kategori = 1 OR a.id_kategori = 2 OR b.divisi IN ('ITDP','FINANCE','HC (1)','OPERATION 2','OPERATION  - SUPPORT','HC'))")->result_array();
    }

    $data['rincian'] = $this->db->query("SELECT
                                            a.*
                                          FROM rincian a
                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                          WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstaff5', $data);
    $this->load->view('template/footer');
  }

  public function prosesisitkmstaff()
  {
    $idtkmdiv = $this->input->post('idtkmdiv');
    $this->Mingguan_model->isitkmstaffnya();
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Diisi');
    redirect('mingguan/viewtkmdivisi/' . $idtkmdiv);
  }

  public function prosesisitkmstaff2()
  {
    $idtkmdiv = $this->input->post('idtkmdiv');
    $this->Mingguan_model->isitkmstaffnya2();
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Diisi');
    redirect('mingguan/viewtkmdivisi/' . $idtkmdiv);
  }

  public function prosesisitkmstaff4()
  {
    $idtkmdiv = $this->input->post('idtkmdiv');
    $this->Mingguan_model->isitkmstaffnya4();
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Diisi');
    redirect('mingguan/viewtkmdivisi/' . $idtkmdiv);
  }

  public function prosesisitkmstaff5()
  {
    $idtkmdiv = $this->input->post('tgldivisnya');
    $no_tkm = $this->input->post('id_tkm');
    
    $this->Mingguan_model->isitkmstaffnya5();
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Diisi');
    redirect('mingguan/viewtkmdivisi3/' . $no_tkm);
  }

  public function edittkmstaff($no)
  {
    $data['tkmnya'] = $this->db->query("SELECT
                                              a.*,
                                              b.daritanggal,
                                              b.sampaitanggal,
                                              b.divisi,
                                              b.target AS targetdiv,
                                              c.nama_user
                                        FROM tkmstaff a
                                        JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                        JOIN tb_user c ON a.userstaff = c.id_user
                                        WHERE a.no='$no'")->row_array();
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/edittkmstaff', $data);
    $this->load->view('template/footer');
  }

  public function prosesedittkmstaff()
  {
    $target       = $_POST['target'];
    $idtkmstaff   = $_POST['idtkmstaff'];
    $idtkmdiv     = $_POST['idtkmdiv'];
    $this->db->query("UPDATE tkmstaff SET target='$target' WHERE no='$idtkmstaff'");
    $this->session->set_flashdata('flash2', 'TKM Staff Berhasil Di Edit');
    redirect('mingguan/viewtkmdivisi/' . $idtkmdiv);
  }

  public function viewtkmstaff($username, $nodiv)
  {

    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();

    $data['caritarget'] = $this->db->query("SELECT a.*,b.deskripsi FROM tkmstaff a JOIN pekerjaan b ON a.idtkmdiv = b.idtkmdiv AND a.project = b.project  WHERE a.userstaff='$username' AND a.idtkmdiv ='$nodiv'")->result_array();

    $gettanggal = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$nodiv'")->row_array();
    $daritanggal = $gettanggal['daritanggal'];
    $sampaitanggal = $gettanggal['sampaitanggal'];

    $data['daritanggal'] = $gettanggal['daritanggal'];
    $data['sampaitanggal'] = $gettanggal['sampaitanggal'];


    $data['hariannya'] = $this->db->query("SELECT tanggal FROM tugasharian WHERE username='$username' AND tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' GROUP BY tanggal")->result_array();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewtkmstaff', $data);
    $this->load->view('template/footer');
  }

  public function edittkm($no)
  {
    $tkm = $this->db->get_where('tkmdivisi', ['no' => $no])->row_array();
    $divisi = $tkm['divisi'];

    $data['tkm'] = $tkm;
    $data['cariproject'] = $this->db->query("SELECT
                                              a.*
                                              FROM
                                                pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b.NO
                                              WHERE
                                                a.idtkmdiv = $tkm[no]")->result_array();

    $data['uraian'] = $this->db->query("SELECT
                                              a.*,
                                              c.*
                                              FROM
                                                pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b.NO
                                                LEFT JOIN uraian c on a.no = c.id_pekerjaan
                                              WHERE
                                                a.idtkmdiv = $tkm[no]")->result_array();

    $data['persentase'] = $this->db->query("SELECT
                                                a.*, SUM(a.persentase) AS sumper
                                              FROM
                                                pekerjaan a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                              WHERE
                                              b.divisi = '$divisi'
                                              GROUP BY
                                                a.project
                                                HAVING SUM(a.persentase) < 100")->result_array();

    $data['kategori'] = $this->db->get_where('kategori', ['divisi' => $divisi])->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/edittkmdivisi2', $data);
    $this->load->view('template/footer');
  }

  public function edittkmmanager($id_tkm)
  {
    $divisi = $this->session->userdata('ses_divisi');
    // $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$id_tkm' AND divisi='$divisi'")->row_array();
    $data['divnya'] = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$id_tkm'")->row_array();

    $no = $data['divnya']['no'];

    $tkm = $this->db->get_where('tkmdivisi', ['no' => $no])->row_array();
    // $divisi = $tkm['divisi'];

    $data['tkm'] = $tkm;
    $data['cariproject'] = $this->db->query("SELECT
                                              a.*
                                              FROM
                                                pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b.NO
                                              WHERE
                                                a.idtkmdiv = $tkm[no]")->result_array();

    $data['uraian'] = $this->db->query("SELECT
                                              a.*,
                                              c.*
                                              FROM
                                                pekerjaan a
                                                JOIN tkmdivisi b ON a.idtkmdiv = b.NO
                                                LEFT JOIN uraian c on a.no = c.id_pekerjaan
                                              WHERE
                                                a.idtkmdiv = $tkm[no]")->result_array();

    $data['persentase'] = $this->db->query("SELECT
                                                a.*, SUM(a.persentase) AS sumper
                                              FROM
                                                pekerjaan a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b. NO
                                              WHERE
                                              b.divisi = '$divisi'
                                              GROUP BY
                                                a.project
                                                HAVING SUM(a.persentase) < 100")->result_array();

    $data['kategori'] = $this->db->get_where('kategori', ['divisi' => $divisi])->result_array();

    $data['judul'] ='Target Kerja';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/edittkmmanager', $data);
    $this->load->view('template/footer');
  }


  public function tambahtkm($no)
  {
    $tkm = $this->db->get_where('tkmdivisi', ['no' => $no])->row_array();
    $divisi = $tkm['divisi'];

    $data['tkm'] = $tkm;
    $data['kategori'] = $this->db->get_where('kategori', ['divisi' => $divisi])->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/tambahtargetkerja', $data);
    $this->load->view('template/footer');
  }

  public function tambahtkmdiv($id_tkm)
  {
    // $tkm = $this->db->get_where('tkmdivisi', ['no'=>$no])->row_array();
    // $divisi = $tkm['divisi'];
    $divisi = $this->session->userdata('ses_divisi');
    $tkm = $this->db->query("SELECT * FROM tkmdivisi WHERE no='$id_tkm' AND divisi='$divisi'")->row_array();

    $data['tkm'] = $tkm;
    $data['kategori'] = $this->db->get_where('kategori')->result_array();
    $data['divisi'] = $this->db->get_where('divisi', ['divisi!=' => $divisi])->result_array();
    // $data['pekerjaanSebelumnya'] = $this->db->where('persentase <', 100)->where('idtkmdiv = "$tkm[no]"')->get('pekerjaan')->result_array();
    $data['pekerjaanSebelumnya'] = $this->db->query("SELECT * FROM pekerjaan WHERE persentase < 100 AND idtkmdiv = $tkm[no]")->result_array();
    $data['tkmDivSebelumnya'] = $this->db->where('daritanggal <=', date('Y-m-d'))->where('daritanggal >', date('Y-m-d', strtotime('-1 week')))->get('tkmdivisi')->result_array();
    $data['rincianPekerjaanSebelumnya'] = $this->db->where('bobotpersentase <', 100)->get('uraian')->result_array();

    $data['judul'] = 'Target Kerja';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/tambahtargetkerjadiv', $data);
    $this->load->view('template/footer');
  }


  public function simpantargetkerja()
  {
    $this->Mingguan_model->simpantargetkerja();
    $this->session->set_flashdata('flash2', 'Target Kerja Berhasil Di Simpan');
    redirect('mingguan/approvalmingguan');
  }

  public function simpantargetkerjadiv()
  {
    $this->Mingguan_model->simpantargetkerjadiv();
    $this->session->set_flashdata('flash2', 'Target Kerja Berhasil Di Simpan');
    redirect('mingguan/homemingguan');
  }

  public function simpantargetkerjadiv2()
  {
    $this->Mingguan_model->simpantargetkerjadiv2();
    $this->session->set_flashdata('flash2', 'Target Kerja Berhasil Di Simpan');
    redirect('mingguan/homemingguan');
  }

  public function simpanuraian()
  {
    $this->Mingguan_model->simpanuraian();
    $this->session->set_flashdata('flash2', 'Uraian Berhasil Di Simpan');
    redirect('mingguan/edittkmmanager/' . $this->input->post('idtkm'));
  }

  public function edituraian()
  {
    $this->Mingguan_model->edituraian();
    $this->session->set_flashdata('flash2', 'Uraian Berhasil Diubah');
    redirect('mingguan/edittkmmanager/' . $this->input->post('idtkm'));
  }

  public function hapusuraian($idtkm, $id)
  {
    $this->Mingguan_model->hapusuraian($id);
    $this->session->set_flashdata('flash2', 'Uraian Telah Di Hapus');
    redirect('mingguan/edittkmmanager/' . $idtkm);
  }

  public function hapusdata()
  {
    $this->Mingguan_model->hapusdata();
    $this->session->set_flashdata('flash2', 'Data Telah Di Hapus');
    redirect('mingguan/edittkmmanager/' . $this->input->post('idtkm'));
  }

  public function hapussemuadata()
  {
    $this->Mingguan_model->hapussemuadata();
    $this->session->set_flashdata('flash2', 'Data Telah Di Hapus');
    redirect('mingguan/approvalmingguan');
  }

  public function hapussemuadata3()
  {
    $this->Mingguan_model->hapussemuadata3();
    $this->session->set_flashdata('flash2', 'Data Telah Di Hapus');
    redirect('mingguan/approvalmingguan');
  }

  public function ubahtargetkerja()
  {
    $id = $_POST['id'];
    $val = $_POST['val'];
    $nama = $_POST['nama'];

    $data = [
      "$nama" => $val,
    ];

    $this->db->update('pekerjaan', $data, ['no' => $id]);
    echo json_encode($data);
  }

  public function tambahrincian()
  {
    $nomor = $_POST['nomor'];
    $data['rinciannya'] = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$nomor'")->result_array();
    $this->load->view('mingguan/addrincian', $data);
  }

  public function laporantimesheet()
  {
    $pencari  = $this->session->userdata('ses_username');
    $divisinya = $this->session->userdata('ses_divisi');

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC' or $this->session->userdata('ses_username') == 'alfi') {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } elseif ($this->session->userdata('ses_akses') == 'Manager') {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$pencari'")->result_array();
    }

    if ($this->input->post()) {
      $divisinya      = $this->session->userdata('ses_divisi');
      $data['tglterakhir'] = [
        "daritanggal" => $this->input->post('daritanggal'),
        "sampaitanggal" => $this->input->post('sampaitanggal')
      ];

      $this->session->set_flashdata('flash2', 'Pencarian Berhasil');
    } else {
      $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();
    }
    // Hari Libur
    $db2 = $this->load->database('database_kedua', TRUE);

    $daritanggal    = $data['tglterakhir']['daritanggal'];
    $sampaitanggal  = $data['tglterakhir']['sampaitanggal'];

    $data['dataHariLibur'] = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan = 'N'")->result_array();

    $data['judul'] = 'Laporan Timesheet';
 
    $this->db->query("INSERT INTO tanggalhistory(daritanggal,sampaitanggal,pencari) VALUES ('$daritanggal','$sampaitanggal','$pencari')");

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/laporantimesheet3', $data);
    $this->load->view('template/footer');
  }

  public function proseslaporan()
  {

    $pencari        = $this->input->post('pencari');
    $daritanggal    = $this->input->post('daritanggal');
    $sampaitanggal  = $this->input->post('sampaitanggal');
    $divisinya      = $this->session->userdata('ses_divisi');
    $user           = $this->session->userdata('ses_username');

    // // +++++++++++++++++++++++++++

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC' or $this->session->userdata('ses_username') == 'alfi') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } elseif ($this->session->userdata('ses_akses') == 'Manager') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$pencari'")->result_array();
    }


    $insertketgl = $this->db->query("INSERT INTO tanggalhistory(daritanggal,sampaitanggal,pencari) VALUES ('$daritanggal','$sampaitanggal','$pencari')");

    $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->session->set_flashdata('flash2', 'Pencarian Berhasil');
    $this->load->view('mingguan/laporantimesheet3', $data);
    $this->load->view('template/footer');
  }

  public function laporanpayrol()
  {
    $pencari  = $this->session->userdata('ses_username');
    $divisinya = $this->session->userdata('ses_divisi');
    $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC' or $this->session->userdata('ses_username') == 'alfi') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    }

    if ($this->input->post()) {
      $divisinya      = $this->session->userdata('ses_divisi');
      $data['tglterakhir'] = [
        "daritanggal" => $this->input->post('daritanggal'),
        "sampaitanggal" => $this->input->post('sampaitanggal')
      ];

      $this->session->set_flashdata('flash2', 'Pencarian Berhasil');
    } else {
      $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();
    }

    $db2 = $this->load->database('database_kedua', TRUE);

    $daritanggal    = $data['tglterakhir']['daritanggal'];
    $sampaitanggal  = $data['tglterakhir']['sampaitanggal'];

    $data['dataHariLibur'] = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan = 'N'")->result_array();

    // var_dump($data['dataHariLibur']);
    // die();
    $this->db->query("INSERT INTO tanggalhistory(daritanggal,sampaitanggal,pencari) VALUES ('$daritanggal','$sampaitanggal','$pencari')");

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/laporanpayrol1', $data);
    $this->load->view('template/footer');
  }

  public function prosespayrol()
  {
    $pencari        = $this->input->post('pencari');
    $daritanggal    = $this->input->post('daritanggal');
    $sampaitanggal  = $this->input->post('sampaitanggal');
    $divisinya = $this->session->userdata('ses_divisi');

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC' or $this->session->userdata('ses_username') == 'alfi') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    }

    $insertketgl = $this->db->query("INSERT INTO tanggalhistory(daritanggal,sampaitanggal,pencari) VALUES ('$daritanggal','$sampaitanggal','$pencari')");

    $data['tglterakhir'] = $this->db->query("SELECT * FROM tanggalhistory WHERE pencari='$pencari' ORDER BY no DESC LIMIT 1")->row_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->session->set_flashdata('flash2', 'Pencarian Berhasil');
    $this->load->view('mingguan/laporanpayrol1', $data);
    $this->load->view('template/footer');
  }

  public function viewlintasdivisi($tgl)
  {
    $divisi = $this->session->userdata('ses_divisi');
    // $data['divnya'] = $this->db->query("SELECT * FROM pekerjaan_lintasdivisi WHERE daritanggal='$tgl' AND divisi='$divisi'")->row_array();
    // $no = $data['divnya']['no'];

    // $data['tkmdiv'] = $this->db->query("SELECT
    //                                           a.*,
    //                                           b.*,
    //                                           b.no as nopekerjaan
    //                                       FROM tkmdivisi a
    //                                       JOIN pekerjaan b ON a.no = b.idtkmdiv
    //                                       WHERE a.no='$no'")->result_array();
    //$divisi = $data['divnya']['divisi'];

    $data['tanggal'] = ['tanggalnya' => $tgl];

    $data['tkmdiv'] = $this->db->query("SELECT
                                        	a.*,
                                        	b.nama_kategori AS namakategori,
                                        	c.divisi AS fromdivisi
                                        FROM
                                        	pekerjaan_lintasdivisi a
                                        JOIN kategori b ON a.id_kategori = b.id_kategori
                                        JOIN tkmdivisi c ON a.idtkmdiv = c.no
                                        WHERE
                                        	a.daritanggal = '$tgl'
                                        AND a.divisi = '$divisi'")->result_array();

    $data['liststaff'] = $this->db->query("SELECT * FROM tb_user WHERE divisi='$divisi' AND divisi!='' AND aktif='Y' AND resign='0' ORDER BY nama_user")->result_array();

    // $data['rincian'] = $this->db->query("SELECT
    //                                         a.*
    //                                       FROM rincian a
    //                                       JOIN tkmdivisi b ON a.idtkmdiv = b.no
    //                                       WHERE a.idtkmdiv = '$no' and userstaff is not null")->result_array();

    $data['leader'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1='Leader 1' OR jabatan1='Leader 2' OR jabatan1='Leader 3'")->result_array();


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/viewlintasdivisi', $data);
    $this->load->view('template/footer');
  }

  public function isitkmstafflintas($username, $tanggal)
  {
    $data['usernya'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$username'")->row_array();

    // $divisinya = $data['usernya']['divisi'];
    //
    // $data['tkmdiv'] = $this->db->query("SELECT
    //                                       	a.*,
    //                                       	b.project AS projectnya
    //                                       FROM
    //                                       	pekerjaan_lintasdivisi a
    //                                       JOIN tkmstaff b ON a.idtkmdiv = b.idtkmdiv
    //                                       WHERE
    //                                       	a.daritanggal = '$tanggal'
    //                                       AND a.divisi = '$divisinya'
    //                                       AND b.userstaff ='$username")->result_array();
    //
    //
    // if($data['divnya']['status'] == 'Disetujui'){
    //   $data['kerjaan'] = $this->db->query("SELECT
    //                                               a.*
    //                                         FROM pekerjaan a
    //                                         JOIN tkmdivisi b ON a.idtkmdiv = b.no
    //                                         WHERE a.idtkmdiv = '$no'")->result_array();
    // }else{
    //   $data['kerjaan'] = $this->db->query("SELECT
    //                                               a.*
    //                                         FROM pekerjaan a
    //                                         JOIN tkmdivisi b ON a.idtkmdiv = b.no
    //                                         WHERE a.idtkmdiv = '$no' AND (a.id_kategori = 1 OR a.id_kategori = 2)")->result_array();
    // }
    //
    // $data['rincian'] = $this->db->query("SELECT
    //                                         a.*
    //                                       FROM rincian a
    //                                       JOIN tkmdivisi b ON a.idtkmdiv = b.no
    //                                       WHERE a.idtkmdiv = '$no' and userstaff='$username'")->result_array();

    // $carilintas = $this->db->query("SELECT
    //                                       a.*,
    //                                       b.nama_kategori AS namakategori,
    //                                   FROM pekerjaan_lintasdivisi a
    //                                   JOIN kategori b ON a.id_kategori = b.id_kategori
    //                                   JOIN tkmdivisi c ON a.idtkmdiv = c.no
    //                                   WHERE daritanggal='$tanggal'
    //                                   AND divisi='$usernya[divisi]'")->result_array();

    $data['tanggal'] = ['tanggalnya' => $tanggal];


    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/isitkmstafflintas', $data);
    $this->load->view('template/footer');
  }

  public function pekerjaanSelesai($id)
  {
    $this->Mingguan_model->updatePekerjaanSelesai($id);
    $this->session->set_flashdata('flash2', 'TKM Berhasil Diselesaikan');
    redirect('mingguan/homemingguan');
  }

  public function printLaporanHarian($daritanggal, $sampaitanggal)
  {
    $this->load->library('mypdf');

    $data['daritanggal'] = $daritanggal;
    $data['sampaitanggal'] = $sampaitanggal;

    $kodeTanggal = date('Y m');
    $kodeDokumen = md5($kodeTanggal);
    $kodeDokumen = substr(strtoupper($kodeDokumen), 0, 9);
    $data['kode_dokumen'] = ['MRI-' . $kodeDokumen . date('ym')];

    $pencari  = $this->session->userdata('ses_username');
    $divisinya = $this->session->userdata('ses_divisi');

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC' or $this->session->userdata('ses_username') == 'alfi') {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } elseif ($this->session->userdata('ses_akses') == 'Manager') {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['user'] = $this->db->query("SELECT * FROM tb_user WHERE id_user='$pencari'")->result_array();
    }


    $db2 = $this->load->database('database_kedua', TRUE);

    $data['dataHariLibur'] = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan = 'N'")->result_array();

    $this->mypdf->generate('mingguan/printlaporanharian', $data, 'Laporan Timesheet Karyawan', 'A4', 'landscape');
  }

  public function printLaporanPayrol($daritanggal, $sampaitanggal)
  {
    $this->load->library('mypdf');

    $data['daritanggal'] = $daritanggal;
    $data['sampaitanggal'] = $sampaitanggal;

    $kodeTanggal = date('Y m');
    $kodeDokumen = md5($kodeTanggal);
    $kodeDokumen = substr(strtoupper($kodeDokumen), 0, 9);
    $data['kode_dokumen'] = ['MRI-' . $kodeDokumen . date('ym')];

    $pencari  = $this->session->userdata('ses_username');
    $divisinya = $this->session->userdata('ses_divisi');

    if ($this->session->userdata('ses_akses') == 'Direksi' or $this->session->userdata('ses_divisi') == 'HC' or $this->session->userdata('ses_username') == 'alfi') {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND hak_akses !='Direksi' ORDER BY nama_user ASC")->result_array();
    } else {
      $data['namanya'] = $this->db->query("SELECT * FROM tb_user WHERE jabatan1!='' AND divisi='$divisinya' ORDER BY nama_user ASC")->result_array();
    }

    $db2 = $this->load->database('database_kedua', TRUE);
    $data['dataHariLibur'] = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan = 'N'")->result_array();

    $this->mypdf->generate('mingguan/printlaporanpayrol', $data, 'Laporan Payrol', 'A4');
  }

  public function isirotasi (){
    $data = [
        'userstaff' => $this->input->post('user'),
        'tgl_rotasi' => $this->input->post('tgl_rotasi'),
        'tgl_pengganti' => $this->input->post('tgl_pengganti'),
        'kondisi' => $this->input->post('kondisi')
      ];

      $awal = $this->input->post('tglawal');

      $this->db->insert('tb_rotasi', $data);
      $this->session->set_flashdata('flash2', 'Rotasi Hari Kerja Berhasil Diisi');
      redirect('mingguan/viewtkmdivisi3/'. $awal);

  }

  public function getid_wl()
  {
    $id = $_POST['id'];
    $data = $this->db->get_where('list_note', array('id' => $id))->result_array();

    echo json_encode($data);
  }

  public function cancelrotasi($awal, $id, $type){

      $awal = $awal;
      if ($type == 0) {
        $cancel = $this->Mingguan_model->cancelrotasi($id, "0");

        if ($cancel) {
          $this->session->set_flashdata('flash2', 'Rotasi Hari Kerja Berhasil Dicancel');
          redirect('mingguan/viewtkmdivisi3/'. $awal);
        }

      }
  }

  public function isi_meetingtkm()
  {
    date_default_timezone_set('Asia/Jakarta');

                  $akses = $this->session->userdata('ses_akses');
   
    $waktu = date('Y-m-d H:i:s');
    $divisinya = $this->session->userdata('ses_divisi');
    $username = $this->session->userdata('ses_username');
    $rentang = $this->input->post('rentang');

    $pecah = explode("_", $rentang);
    $tanggal = $this->input->post('tanggal');
    $datenow = date('Y-m-d');
    if ($tanggal == $datenow AND $akses != 'Direksi') {
      $this->session->set_flashdata('flash', 'Gagal Buat Jadwal Meeting TKM! Meeting harus dibuat H-1!');
      redirect('mingguan/homemingguan');
    } else {
    $data = ['pembuat' => $username,
            'divisi' => $this->input->post('divisi'),
            'tanggal' => $this->input->post('tanggal'),
            'dari_jam' => $this->input->post('dari_jam'),
            'sampai_jam' => $this->input->post('sampai_jam'),
            'daritanggal' => $pecah[0],
            'sampaitanggal' => $pecah[1],
            'keterangan' => $this->input->post('keterangan'),
            'link' => $this->input->post('link'),
            'tanggal_isi' => $waktu 
            ];
    $this->db->insert('meeting_tkm', $data);
     $insert_id = $this->db->insert_id();
    

    $progress = $this->db->get_where('progress_bar', array('username' => $username))->row_array();
                    if ($progress == NULL) {
                      $dt = ['username' => $username,
                              'persentase' => '25'];
                      $this->db->insert('progress_bar', $dt);  

                    } else {
                      $this->db->query("UPDATE progress_bar SET persentase='25' WHERE username='$username'");  

                    }

     $peserta = $this->input->post('peserta');
     foreach ($peserta as $pst => $val) {
       $tag = [
              'id_meeting' => $insert_id,
              'username' => $val
              ];
          $this->db->insert('absensi_meeting', $tag);

          $progress = $this->db->get_where('progress_bar', array('username' => $val))->row_array();
                    if ($progress == NULL) {
                      $dt = ['username' => $val,
                              'persentase' => '25'];
                      $this->db->insert('progress_bar', $dt);  

                    } else {
                      $this->db->query("UPDATE progress_bar SET persentase='25' WHERE username='$val'");  

                    }
     }
    $this->session->set_flashdata('flash2', 'Berhasil Buat Meeting TKM');
          redirect('mingguan/homemingguan');
    }

  }

  public function edit_meetingtkm()
  {
    
    $username = $this->session->userdata('ses_username');
    $num = $this->input->post('no_meet');
    $data = ['pembuat' => $username,
            'divisi' => $this->input->post('divisi'),
            'tanggal' => $this->input->post('tanggal'),
            'dari_jam' => $this->input->post('dari_jam'),
            'sampai_jam' => $this->input->post('sampai_jam'),
            'daritanggal' => $this->input->post('daritanggal'),
            'sampaitanggal' => $this->input->post('sampaitanggal'),
            'keterangan' => $this->input->post('keterangan'),
            'link' => $this->input->post('link')
            ];
    $this->db->where('no', $num);
    $this->db->update('meeting_tkm', $data);
    var_dump($data);
    var_dump($num);
    $this->session->set_flashdata('flash2', 'Berhasil Update Meeting TKM');
          redirect('mingguan/homemingguan');

  }

  public function hapus_meeting($no)
  {
    
    $this->db->where('no', $no);
    $this->db->delete('meeting_tkm');

    $this->db->where('id_meeting', $no);
    $this->db->delete('absensi_meeting');

    $this->session->set_flashdata('flash2', 'Berhasil Hapus Meeting TKM');
          redirect('mingguan/homemingguan');

  }

  public function meeting_room($id)
  {
    $data['judul'] = 'Meeting Room';
    $data['meeting'] = $this->db->get_where('meeting_tkm', array('no' => $id))->row_array();

      $akses = $this->session->userdata('ses_akses');
    $username = $this->session->userdata('ses_username');
    if ($akses == 'Manager' OR $akses == 'Direksi') {
      $waktu = date('Y-m-d H:i:s');
      $dataku = [
          'id_meeting' => $id,
          'username' => $username,
          'waktu' => $waktu
          ];
    $cek = [
          'id_meeting' => $id,
          'username' => $username,
          ];
    $cek_meet = $this->db->get_where('absensi_meeting', $cek)->num_rows();
        if ($cek_meet == 0) {
            $this->db->insert('absensi_meeting', $dataku);
        }

        // $progress = $this->db->get_where('progress_bar', array('username' => $username))->row_array();
        //             if ($progress == NULL) {
        //               $dt = ['username' => $username,
        //                       'persentase' => '25'];
        //               $this->db->insert('progress_bar', $dt);  

        //             } else {
        //               $this->db->query("UPDATE progress_bar SET persentase='25' WHERE username='$username'");  

        //             }
 
    }
    

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/meet_room', $data);
    $this->load->view('template/footer');

    
  }


  public function rekap_pekerjaan()
  {
    $data['judul'] = 'Rekap Pekerjaan';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/rekap_pekerjaan', $data);
    $this->load->view('template/footer');

    
  }

  public function rekap_pekerjaanhead()
  {
    $data['judul'] = 'Rekap Pekerjaan';

    $data['divisi'] = $this->db->get('divisi')->result_array();
    

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/rekap_pekerjaanhead', $data);
    $this->load->view('template/footer'); 
  }

  public function getname_divisi()
  {
    $data = $this->Mingguan_model->getname_divisi();

    echo json_encode($data);
  }

  public function kurangi_rekap()
  {
    $this->Mingguan_model->kurangi_rekap();

    $this->session->set_flashdata('flash2', 'Berhasil Edit Persentase Penyelesaian Pekerjaan');
    redirect('mingguan/rekap_pekerjaanhead');

  }

  public function getlastsubmit()
  {
    $id_rincian = $_POST['id_rincian'];

    $data = $this->db->query("SELECT * FROM tugasharian WHERE id_rincian='$id_rincian' ORDER BY tanggal ASC")->result_array();
    
    echo json_encode($data);
  }

  public function absen()
  {
    date_default_timezone_set('Asia/Jakarta');
    
    $id_meet = $this->input->post('id_meet');
    $username = $this->input->post('username');

    $progress = $this->db->get_where('progress_bar', array('username' => $username))->row_array();
                    if ($progress == NULL) {
                      $dt = ['username' => $username,
                              'persentase' => '25'];
                      $this->db->insert('progress_bar', $dt);  

                    } else {
                      $this->db->query("UPDATE progress_bar SET persentase='25' WHERE username='$username'");  

                    }

   $waktu = date('Y-m-d H:i:s');
   $data = [
          'id_meeting' => $id_meet,
          'username' => $username,
          'waktu' => $waktu
          ];
  $this->db->insert('absensi_meeting', $data);
    $this->session->set_flashdata('flash2', 'Berhasil Absensi Kehadiran Meeting TKM');
          redirect('mingguan/meeting_room/'.$id_meet);

  }

  public function confirmAbsen()
  {
    date_default_timezone_set('Asia/Jakarta');
    
    $id_meet = $_POST['id_meet'];
    $username = $_POST['username'];
    $absen = $_POST['absen'];
    $waktu = date('Y-m-d H:i:s');

    if ($absen == 'Yes') {
       $data = $this->db->query("UPDATE absensi_meeting SET waktu='$waktu' WHERE id_meeting='$id_meet' AND username='$username'");
    
    $progress = $this->db->get_where('progress_bar', array('username' => $username))->row_array();
                    if ($progress == NULL) {
                      $dt = ['username' => $username,
                              'persentase' => '50'];
                      $this->db->insert('progress_bar', $dt);  

                    } else {
                      $this->db->query("UPDATE progress_bar SET persentase='50' WHERE username='$username'");  

                    }

    } else {
       $data = $this->db->query("UPDATE absensi_meeting SET waktu = NULL WHERE id_meeting='$id_meet' AND username='$username'");
    }


    echo json_encode($data);
  }

  public function submit_rentang()
  {
    $this->Mingguan_model->submit_rentang();
    $this->session->set_flashdata('flash2', 'Berhasil Submit Rentang Waktu TKM');
          redirect('mingguan/homemingguan');    
  }

  public function perpanjang($id_user)
  {
    $data['judul'] = 'Perpanjang Target';
    $username = $this->session->userdata('ses_username');

    $data['caritarget'] = $this->db->query("SELECT
                                                a.*,
                                              --  SUM(c.persentase) AS sumper,
                                              d.no AS id_pekerjaan,
                                                d.deskripsi
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                              -- AND a.project = c.project
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              WHERE
                                                a.userstaff = '$id_user'
                                                AND 
                                                -- d.is_finish <> 1 AND 
                                                a.persentase < 100
                                                ")->result_array();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('mingguan/perpanjangtarget', $data);
    $this->load->view('template/footer');
  }

  public function add_perpanjang()
  {
    $num = $this->input->post('num');
    foreach ($num as $key => $val) {
      $tgl_baru = $this->input->post('tgl_perpanjang'.$val);
      $alasan = $this->input->post('alasan'.$val);


      $this->db->query("UPDATE rincian SET tgl_diajukan='$tgl_baru', alasan_perpanjang='$alasan', status_perpanjang='Menunggu' WHERE id_rincian='$val'");
    }
      $this->session->set_flashdata('flash2', 'Berhasil mengajukan perpanjangan target selesai pekerjaan.');
      redirect('dashboard');
  }

  public function approve_perpanjang()
  {
    $num = $this->input->post('num');
    var_dump($num);
    foreach ($num as $key => $val) {
    $id_perpanjangan = $this->input->post('id_perpanjangan'.$val);
    var_dump($id_perpanjangan);

      if ($id_perpanjangan != NULL) {        
          $detail = $this->db->get_where('rincian', array('id_rincian' => $val))->row_array();

        if ($id_perpanjangan == 1) {
          $this->db->query("UPDATE rincian SET targetselesai='$detail[tgl_diajukan]', status_perpanjang='Diterima' WHERE id_rincian='$val'");
        } else if ($id_perpanjangan == 0) {
          $this->db->query("UPDATE rincian SET tgl_diajukan=NULL, status_perpanjang='Ditolak' WHERE id_rincian='$val'");
        }

      }
    }

      $this->session->set_flashdata('flash2', 'Berhasil approve perpanjangan target selesai pekerjaan.');
      redirect('harian/waitinglist');
  }
}
