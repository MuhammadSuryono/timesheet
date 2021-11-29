<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Harian extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Harian_model');
    if (!$this->session->userdata('ses_username')) {
      redirect('auth');
    }
  }

  public function index()
  {
    $date = date('Y-m-d');
    $var = date('N', strtotime($date));
    $awal = $var - 1;
    $akhir = 7 - $var;

    $senin = date('Y-m-d', strtotime("-$awal days", strtotime($date)));
    $minggu = date('Y-m-d', strtotime("+$akhir days", strtotime($date)));

    $data['harian'] = $this->Harian_model->harian($senin, $minggu);
    $data['tkmstaff'] = $this->Harian_model->tkmstaff();
    $data['senin'] = $senin;
    $data['minggu'] = $minggu;

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('harian/index', $data);
    $this->load->view('template/footer');
  }

  public function tambah()
  {
    $cek = $this->db->get_where('tugasharian', ['idtkmdiv' => $this->input->post('idtkmdiv'), 'username' => $this->session->userdata('ses_username'), 'tanggal' => date('Y-m-d')])->row_array();

    if (count($cek) == 0) {
      $this->Harian_model->tambah();
    }

    $this->session->set_flashdata('flash2', 'Berhasil Di Simpan');
    redirect('harian');
  }

  public function edit()
  {
    if ($this->input->post('tanggal') == date('Y-m-d')) {
      $this->Harian_model->edit();
      $this->session->set_flashdata('flash2', 'Berhasil Di Ubah');
    } else {
      $this->session->set_flashdata('flash', 'Gagal Di Ubah');
    }

    redirect('harian');
  }

  public function hapus($id)
  {
    $this->Harian_model->hapus($id);
    $this->session->set_flashdata('flash2', 'Berhasil Di Hapus');
    redirect('harian');
  }

  public function getlabel_wl()
  {
    $data = $this->db->get('wl_kategori')->result_array();
    echo json_encode($data);
  }

  public function getdaftar_wl()
  {
    $id_user = $_POST['id_user'];
    $data = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE a.to_tkm = 'N' AND a.username = '$id_user' AND approve IS NULL ORDER BY b.nama_user, a.tgl_delivery ASC")->result_array();
    echo json_encode($data);
  }

  public function getdaftar_wl_hapus()
  {
    $id_user = $_POST['id_user'];
    $num = $_POST['num'];

    $this->db->query("DELETE FROM list_note WHERE id='$num'");
    $data = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE a.to_tkm = 'N' AND a.username = '$id_user' AND approve IS NULL ORDER BY b.nama_user, a.tgl_delivery ASC")->result_array();
    echo json_encode($data);
  }

  public function getdaftar_wl_edit()
  {
    $id_user = $_POST['id_user'];
    $num = $_POST['num'];
    $kalimat = $_POST['kalimat'];
    $tanggal = $_POST['tanggal'];

    $this->db->query("UPDATE list_note SET pekerjaan='$kalimat', tgl_delivery='$tanggal' WHERE id='$num'");
    $data = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE a.to_tkm = 'N' AND a.username = '$id_user' AND approve IS NULL ORDER BY b.nama_user, a.tgl_delivery ASC")->result_array();
    echo json_encode($data);
  }

  public function viewharian()
  {
    date_default_timezone_set('Asia/Jakarta');
    $tanggalnow = date('Y-m-d');
    $dari       = "2020-04-20";
    $sampai     = "2020-04-24";
    $username = $this->session->userdata('ses_username');

    $data['caritarget'] = $this->db->query("SELECT a.*,b.deskripsi FROM tkmstaff a JOIN pekerjaan b ON a.idtkmdiv = b.idtkmdiv AND a.project = b.project  WHERE a.userstaff='$username'")->result_array();

    $data['tugasharian'] = $this->db->query("SELECT * FROM tugasharian WHERE tanggal='$tanggalnow' AND username='$username'")->result_array();

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('harian/viewharian', $data);
    $this->load->view('template/footer');
  }

  public function viewharian2()
  {
    date_default_timezone_set('Asia/Jakarta');
    $username = $this->session->userdata('ses_username');
    //$tanggalharini = date('Y-m-d');
    $tanggalkemarin = date('Y-m-d', strtotime("-1 days"));
    // CEK APAKAH USER SUDAH MENCAPAI BATAS 3X UPDATE TIMESHEET
    $cek = $this->db->query("SELECT COUNT(status_koreksi) as jumlah FROM tugasharian WHERE username = '$username' AND status_koreksi = 1")->row_array();
    $jumlahLIMIT = $cek['jumlah'];
    $LIMIT = 3;
    // INISIALISASI KALO UDAH LEWAT DARI JAM 12 SIANG GAK BISA UPDATE
    $waktusekarang = date('Y-m-d H:i');
    $waktubuatra = date('Y-m-d 12:00');

    if ($waktusekarang <= $waktubuatra) {
      $tgl = $this->uri->segment(3);
      if ($tgl != null or $tgl == $tanggalkemarin) {
        if ($jumlahLIMIT < $LIMIT) {
          $tanggalnow = date('Y-m-d', strtotime($tgl));
        } else if ($tgl == $tanggalkemarin and $jumlahLIMIT > $LIMIT) {
          $tanggalnow = date('Y-m-d', strtotime($tgl));
        } else {
          $tanggalnow = date('Y-m-d');
        }
      } else {
        $tanggalnow = date('Y-m-d');
      }
      if ($jumlahLIMIT < $LIMIT) {
        $bisaPilihTgl = true;
      } else {
        $bisaPilihTgl = false;
      }
      $bisaUpdate = true;
    } else {
      $tanggalnow = date('Y-m-d');
      $bisaUpdate = false;
      $bisaPilihTgl = false;
    }


    // GET TANGGAL YANG DI SET LEWAT URL
    $getTglFromUri = $this->uri->segment(3);
    $tglFromUri = $getTglFromUri != null ? $getTglFromUri : $tanggalnow;
    // $db2 = $this->load->database('database_kedua', TRUE);
    // $tglLibur = $db2->select('tanggal')->from('kalender')->where_in('tanggal', $tglFromUri)->get()->row_array();
    //$hariNow = date('D', strtotime($tanggalnow));

    //if($tglLibur){

    //ROTASI HARI KERJA
    $username = $this->session->userdata('ses_username');
    $tglpeng = $this->db->query("SELECT tgl_pengganti FROM tb_rotasi WHERE userstaff ='$username' AND kondisi ='1'")->result_array();
    $tglrot = $this->db->query("SELECT tgl_rotasi FROM tb_rotasi WHERE userstaff ='$username' AND kondisi ='1' ORDER BY id DESC")->row_array();
  
  foreach ($tglpeng as $tp) :

    $db2 = $this->load->database('database_kedua', TRUE);
    $tglLibur = $db2->select('tanggal')->from('kalender')->where_in('tanggal', $tglFromUri)->get()->row_array();
      
      if ($tp == NULL && $tglrot == NULL) {
        $tglpengganti = " ";
        $tglrotasi = " ";
        
        $hari = date('D', strtotime($tglFromUri));
      } else {
        $tglpengganti = implode(" ", $tp);
        $tglrotasi = implode(" ",$tglrot);

        $cek = date('D', strtotime($tglrotasi)); 
          if ($tglrotasi == $tglFromUri && $cek == 'Sat' OR $tglrotasi == $tglFromUri && $cek == 'Sun') {
            $hari = 'Mon';
          } else {
            $hari = date('D', strtotime($tglFromUri));
          }
        }

        if ($tglLibur == NULL) {
          $tglLibur = "NULL";
        } else {
        $tglLibur =  implode(" ", $tglLibur);
        }

    if ($waktusekarang >= $waktubuatra or $hari == 'Sun') {
      //if(($hari == 'Sat' OR $hari == 'Sun' OR $tglLibur) AND $waktusekarang > $waktubuatra){ // KODINGAN LAMA TIDAK SESUAI
        if ($hari == 'Sat' or $hari == 'Sun' or $tglLibur != $tglrotasi && $tglLibur != "NULL") { // SUDAH SESUAI  UNTUK ROTASI HARI KERJA DAN HARI LIBUR
          $this->session->set_flashdata('flash', date('d-m-Y', strtotime($tglFromUri)) . ' adalah hari libur anda tidak dapat mengisi LKH');
          redirect('dashboard'); 
        } 
        else if ($tglpengganti == $tglFromUri) { // SUDAH SESUAI UNTUK HARI LIBUR PENGGANTI
          $this->session->set_flashdata('flash', date('d-m-Y', strtotime($tglFromUri)) . ' adalah hari libur pengganti anda tidak dapat mengisi LKH');
          redirect('dashboard'); 
        }
        else if ($tglFromUri > date('Y-m-d')) {
          $this->session->set_flashdata('flash', date('d-m-Y', strtotime($tglFromUri)) . ' adalah hari besok anda tidak dapat mengisi LKH sekarang !');
          redirect('dashboard');
        }
    }
    endforeach;
  
    //}


    $var = date('N', strtotime($tanggalnow));
    $awal = $var - 1;
    $akhir = 5 - $var;

    $senin = date('Y-m-d', strtotime("-$awal days", strtotime($tanggalnow)));
    $jumat = date('Y-m-d', strtotime("+$akhir days", strtotime($tanggalnow)));

    $dari       = $senin;
    $sampai     = $jumat;

    $data['caritarget'] = $this->db->query("SELECT
                                              	a.*,
                                              -- 	SUM(c.persentase) AS sumper,
                                              	d.deskripsi
                                              FROM
                                              	tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                              -- AND a.project = c.project
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              WHERE
                                                a.userstaff = '$username'
                                                AND 
                                                -- d.is_finish <> 1 AND 
                                                a.persentase < 100
                                                ")->result_array();

    $data['tugasharian'] = $this->db->query("SELECT
                                                a.*,
                                                b.NO AS id_tkmstaff,
                                                b.persentase AS persen,
                                                d.is_finish
                                            FROM
                                                tugasharian a
                                                JOIN tkmstaff b ON a.project = b.project AND a.idtkmdiv = b.idtkmdiv
                                                AND a.username = b.userstaff
                                                JOIN tkmdivisi c ON b.idtkmdiv = c.no
                                                -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                                -- AND a.project = c.project
                                                LEFT JOIN pekerjaan d ON b.idtkmdiv = d.idtkmdiv AND b.project = d.project
                                            WHERE
                                                -- a.tanggal BETWEEN '$dari' and '$sampai'
                                                a.username = '$username'
                                                AND d.is_finish <> 1
                                            GROUP BY
                                                a.project, a.tanggal
                                            ORDER BY a.no DESC")->result_array();

    /*$data['tugasharianpertgl'] = $this->db->query("SELECT a.*, b.NO AS id_tkmstaff FROM tugasharian a JOIN tkmstaff b ON a.project = b.project
                          AND a.username = b.userstaff WHERE a.tanggal = '$tanggalnow' AND a.username = '$username'
                          AND b.persentase > 0 ORDER BY a.no DESC LIMIT 1")->result_array();*/

    //
    // var_dump($data['tugasharian']);
    // die;

    $data['tugasharianfull'] = $this->db->query("SELECT * FROM tugasharian WHERE username = '$username' and tanggal BETWEEN '$dari' and '$sampai' order by tanggal")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                                a.*
                                            FROM
                                                rincian a
                                                JOIN tkmstaff b ON a.id_tkmstaff = b.no
                                                AND a.idtkmdiv = b.idtkmdiv
                                            WHERE b.userstaff = '$username' ORDER BY a.id_rincian DESC")->result_array();

    // $rincian1 = [];
    // foreach ($data['rincian'] as $db ) {
    //     $key = $db['id_tkmstaff'];
    //     if(array_key_exists("$key", $rincian1)){
    //         array_push($rincian1[$key], $db);
    //     } else {
    //         $rincian1[$key][] = $db;
    //     }
    //   }
    //
    //     var_dump($rincian1);
    //     die;

    $data['senin'] = $senin;
    $data['jumat'] = $jumat;
    $data['tanggalSelected'] = $tanggalnow;
    $data['bisaUpdate'] = $bisaUpdate;
    $data['bisaPilihTgl'] = $bisaPilihTgl;
    if ($jumlahLIMIT >= $LIMIT) {
      $LIMIT = '<span class="text-danger">Sudah Habis</span>';
    } else if ($jumlahLIMIT < $LIMIT) {
      $LIMIT = $LIMIT - $jumlahLIMIT;
      $LIMIT = '<span class="text-primary">' . $LIMIT . '</span>';
    }
    $data['totalLIMIT'] = $LIMIT;

    // var_dump($data);
    // die();

    // var_dump($data['tugasharianfull']);
    // die();
    $data['judul'] = 'Laporan Kerja Harian';
    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('harian/viewharian4', $data);
    $this->load->view('template/footer');
  }

  public function viewharian3()
  {
    date_default_timezone_set('Asia/Jakarta');

    $tanggalnow = date('Y-m-d');
    $var = date('N', strtotime($tanggalnow));
    $awal = $var - 1;
    $akhir = 5 - $var;

    $senin = date('Y-m-d', strtotime("-$awal days", strtotime($tanggalnow)));
    $jumat = date('Y-m-d', strtotime("+$akhir days", strtotime($tanggalnow)));

    $dari       = $senin;
    $sampai     = $jumat;
    $username = $this->session->userdata('ses_username');

    $data['caritarget'] = $this->db->query("SELECT a.*,b.deskripsi FROM tkmstaff a JOIN pekerjaan b ON a.idtkmdiv = b.idtkmdiv AND a.project = b.project  WHERE a.userstaff='$username' AND a.tanggalisi BETWEEN '$dari' AND '$sampai' AND a.persentase != 0")->result_array();

    $data['tugasharian'] = $this->db->query("SELECT
                                                a.*,
                                                b.NO AS id_tkmstaff
                                            FROM
                                                tugasharian a
                                                JOIN tkmstaff b ON a.project = b.project
                                                AND a.username = b.userstaff
                                            WHERE
                                                a.tanggal BETWEEN '$dari' and '$sampai'
                                                AND a.username = '$username'
                                            GROUP BY
                                                a.project, a.tanggal")->result_array();

    $data['tugasharianfull'] = $this->db->query("SELECT * FROM tugasharian  WHERE username = '$username' and tanggal BETWEEN '$dari' and '$sampai' order by tanggal")->result_array();

    $data['rincian'] = $this->db->query("SELECT
                                                a.*
                                            FROM
                                                rincian a
                                                JOIN tkmstaff b ON a.id_tkmstaff = b.no
                                                AND a.idtkmdiv = b.idtkmdiv
                                            WHERE
                                                b.userstaff = '$username'")->result_array();
    $data['senin'] = $senin;

    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('harian/viewharian3', $data);
    $this->load->view('template/footer');
  }

  public function isiharian()
  {
    $this->Harian_model->isihariannya();
    $this->session->set_flashdata('flash2', 'Berhasil Di Simpan');
    redirect('harian/viewharian');
  }

  public function isiharian2()
  {
    $simpan = $this->Harian_model->isihariannya2();
    if ($simpan['state']) {
      $this->session->set_flashdata('flash2', $simpan['msg']);
    } else {
      $this->session->set_flashdata('flash', $simpan['msg']);
    }
    redirect('harian/viewharian2/' . $simpan['tgl']);
  }

  public function waitinglist(){
    $username = $this->session->userdata('ses_username');
    $data['judul'] = 'Draft Waiting List';

    $data['perpanjangan'] = $this->db->query("SELECT a.*, b.nama_user FROM rincian a JOIN tb_user b ON a.userstaff=b.id_user WHERE a.status_perpanjang = 'Menunggu' AND b.atasan='$username'")->result_array();

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('harian/waitinglist', $data);
    $this->load->view('template/footer');

  }

  public function target(){
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('harian/target');
    $this->load->view('template/footer');

  }

  public function add_waitinglist()
    {
        $username = $this->input->post('username');
        $id = $this->input->post('no');
        $datenow = date("Y-m-d");


        foreach ($id as $row => $val) {
          // var_dump( $_POST['kategori_wl'][$row]." ".$_POST['pekerjaan'][$row]);
          


            if ($_POST['pekerjaan'][$row] != NULL OR $_POST['pekerjaan'][$row] != ''){
                $data = [
                            'pekerjaan' => $_POST['pekerjaan'][$row],
                            'username' => $username,
                            'tgl_delivery' => $_POST['tgl_delivery'][$row],
                            'tgl_input' => $datenow,
                            'delivery_to' => $_POST['delivery_to'][$row]
                            
                            ];

                $cek = $this->db->get_where('list_note', array('id' => $val))->row();

                if ($cek != NULL) {

                    $where = ['id' => $val];
                    
                    $this->db->where($where);
                    $this->db->update('list_note', $data);
                } else if ($cek == NULL){
                  $data2 = [
                            'pekerjaan' => $_POST['pekerjaan'][$row],
                            'username' => $username,
                            'tgl_delivery' => $_POST['tgl_delivery'][$row],
                            'tgl_input' => $datenow,
                            'delivery_to' => $_POST['delivery_to'][$row]
                            
                            ];
                    $this->db->insert('list_note', $data2);

                    // $progress = $this->db->get_where('progress_bar', array('username' => $username))->row_array();
                    // if ($progress == NULL) {
                    //   $dt = ['username' => $username,
                    //           'persentase' => '50'];
                    //   $this->db->insert('progress_bar', $dt);  

                    // } else {
                    //   $this->db->query("UPDATE progress_bar SET persentase='50' WHERE username='$username'");  

                    // }  
                    
                }
            }
        }

        // var_dump($data2);
        $this->session->set_flashdata('flash2', 'Berhasil Simpan note Waitinglist!');
        redirect('harian/waitinglist');
        // redirect('mingguan/homemingguan');

    }

  public function delete_waitinglist($id_list, $username)
    {
      $this->db->query("DELETE FROM list_note WHERE id='$id_list' AND username='$username' ");
      $this->session->set_flashdata('flash2', 'Berhasil Hapus note Waitinglist!');
      redirect('harian/waitinglist');
    }

  public function buat_waitinglist()
  {
    $data['judul'] = 'Tambah Waiting List';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('harian/buat_waitinglist');
    $this->load->view('template/footer');
  }

  public function editin_wl()
  {
    $id = $this->input->post('id_wl');
    $pekerjaan = $this->input->post('waitinglist');
    $tgl_delivery = $this->input->post('delivery');
    $to = $this->input->post('to');

    $data = [
            'pekerjaan' => $pekerjaan,
            'tgl_delivery' => $tgl_delivery,
            'delivery_to' => $to
            ];
    $this->db->where('id', $id);
    $this->db->update('list_note', $data);

    $this->session->set_flashdata('flash2', 'Berhasil Edit Waitinglist!');
        redirect('harian/waitinglist');

  }

  public function approval_rekap($id_rincian)
  {
    $this->db->query("UPDATE rincian SET approval='Diterima', alasan = NULL WHERE id_rincian='$id_rincian'");
    $this->session->set_flashdata('flash2', 'Berhasil Approve Rekap Pekerjaan!');
    redirect('dashboard');
  }

  public function tolak_rekap()
  {
    $id_rincian = $this->input->post('id_rincian');
    $alasan = $this->input->post('alasan_tolak');

    $tugasharian = $this->db->query("SELECT * FROM `tugasharian` WHERE id_rincian = '$id_rincian' ORDER BY tanggal DESC LIMIT 1 , 1")->row_array();
    $persen = $tugasharian['persentase'];
    $rincian = $this->db->get_where('rincian', array('id_rincian' => $id_rincian))->row_array();


    $this->db->query("UPDATE rincian SET approval='Ditolak', alasan='$alasan', targetpersen='$persen', status='Berprogress' WHERE id_rincian='$id_rincian'");
    $this->db->query("UPDATE tkmstaff SET persentase='$persen' WHERE no='$rincian[id_tkmstaff]'");
    $this->db->query("UPDATE pekerjaan SET persentase='$persen' WHERE no='$rincian[idpekerjaan]'");

    $this->session->set_flashdata('flash2', 'Berhasil Tolak Rekap Pekerjaan!');
    redirect('dashboard');
  }

  public function perpanjang_rincian()
  {
    $time = date('Y-m-d H:i:s');
    $id_rincian = $this->input->post('id_rincian');
    $tanggal_baru = $this->input->post('tanggal_baru');
    $alasan_perpanjang = $this->input->post('alasan_perpanjang');


    $get = $this->db->get_where('rincian', array('id_rincian' => $id_rincian))->row_array();
    $data = [
              'id_rincian' => $get['id_rincian'],
              'idpekerjaan' => $get['idpekerjaan'],
              'idtkmdiv' => $get['idtkmdiv'],
              'userstaff' => $get['userstaff'],
              'id_tkmstaff' => $get['id_tkmstaff'],
              'rincian' => $get['rincian'],
              'targetpersen' => $get['targetpersen'],
              'id_list' => $get['id_list'],
              'status' => $get['status'],
              'tanggalupdate' => $get['tanggalupdate'],
              'targetselesai' => $get['targetselesai'],
              'approval' => $get['approval'],
              'alasan' => $get['alasan'],
              'tanggalubah' => $time,
            ];
    $this->db->insert('rincian_history', $data);
    $this->db->query("UPDATE rincian SET targetselesai='$tanggal_baru', alasan_perpanjang='$alasan_perpanjang' WHERE id_rincian='$id_rincian'");

    $this->session->set_flashdata('flash2', 'Berhasil Perpanjang Target Selesai Pekerjaan!');
    redirect('dashboard');
  }


  public function set_wl()
  {
    if (isset($_POST['btn_approve'])) {
      $num_wl = $this->input->post('approve_wl');
      foreach ($num_wl as $key => $val) {
        $this->db->query("UPDATE list_note SET approve='Yes' WHERE id='$val'");

        $user = $this->db->get_where('list_note', array('id' => $val))->row_array();

        $this->db->query("UPDATE progress_bar SET persentase='75' WHERE username='$user[username]'");  
      }
    
      $num = $this->input->post('num');
      $tgl_baru = $this->input->post('tgl_delivery');


      // foreach ($num as $set => $val2) {
      //   $this->db->query("UPDATE list_note SET tgl_delivery='$tgl_baru[$set]' WHERE id='$val2'");
      // }

        $this->session->set_flashdata('flash2', 'Berhasil Approve & Save Waiting List!');
        redirect('harian/waitinglist');   

    }
  }


}
