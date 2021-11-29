<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Harian_model extends CI_Model
{

  public function harian($senin, $minggu)
  {
    $user = $this->session->userdata('ses_username');
    return $this->db->query("SELECT * from tugasharian where username = '$user' and tanggal between '$senin' and '$minggu' order by tanggal ASC")->result_array();
  }

  public function tkmstaff()
  {
    $user = $this->session->userdata('ses_username');
    return $this->db->get_where('tkmstaff', ['userstaff' => $user])->result_array();
  }

  public function tambah()
  {
    // var_dump("MASUK"); die;
    $poto = $_FILES['poto']['name'];

    if ($poto) {
      $config['upload_path']          = './dist/';
      $config['allowed_types']        = 'jpg|gif|png|pdf|doc|docx|xls|xlsx|jpeg';

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if ($this->upload->do_upload('poto')) {
        $poto = $this->upload->data('file_name');
      } else {
        echo $this->upload->display_errors();
        die;
      }
    }

    $data = [
      'idtkmdiv' => $this->input->post('idtkmdiv'),
      'username' => $this->session->userdata('ses_username'),
      'pekerjaan' => $this->input->post('rincian'),
      'poto' => $poto,
      'tanggal' => date('Y-m-d')
    ];

    $this->db->insert('tugasharian', $data);
  }

  public function edit()
  {
    $ambilpoto = $this->db->get_where('tugasharian', ['no' => $this->input->post('idtugasharian')])->row_array();
    $poto = $_FILES['poto']['name'];

    if ($poto) {
      $config['uplo]ad_path']          = './dist/';
      $config['allowed_types']        = 'jpg|gif|png|pdf|doc|docx|xls|xlsx|jpeg';

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if ($this->upload->do_upload('poto')) {
        $poto = $this->upload->data('file_name');
        unlink(FCPATH . '/dist/' . $ambilpoto['poto']);
      } else {
        echo $this->upload->display_errors();
        die;
      }
    }

    $data = [
      'pekerjaan' => $this->input->post('rincian'),
      'poto' => $poto,
    ];

    $this->db->update('tugasharian', $data, ['no' => $this->input->post('idtugasharian')]);
  }

  public function hapus($id)
  {
    $ambilpoto = $this->db->get_where('tugasharian', ['no' => $id])->row_array();
    unlink(FCPATH . '/dist/' . $ambilpoto['poto']);
    $this->db->delete('tugasharian', ['no' => $id]);
  }

  public function isihariannya()
  {

    $jmlpro   = $this->input->post('jmlpro');
    $tanggal  = $this->input->post('tanggal');
    $username = $this->session->userdata('ses_username');

    for ($i = 0; $i <= $jmlpro; $i++) {

      $persen       = $this->input->post("persen$i");

      if ($persen == 0 or $persen == NULL) {
      } else {
        $idtkmdiv     = $this->input->post("idtkmdiv$i");
        $project      = $this->input->post("project$i");
        $keterangan   = $this->input->post("keterangan$i");
        $persen       = $this->input->post("persen$i");
        $file_name    = $_FILES["fileupload$i"]['name'];
        $file_tmp = $_FILES["fileupload$i"]['tmp_name'];
        move_uploaded_file($file_tmp, "dist/upload/" . $file_name);
        $this->db->query("INSERT INTO tugasharian (idtkmdiv,username,project,keterangan,tanggal,fileupload,persentase)
                                              VALUES ('$idtkmdiv','$username','$project','$keterangan','$tanggal','$file_name','$persen')");
      }
    }
  }

  public function isihariannya2()
  {
    date_default_timezone_set('asia/jakarta');
    $tglSkrg = date('Y-m-d');
    $tglHmin1 = date('Y-m-d', strtotime("-1 days"));

    $jmlpro   = $this->input->post('jmlpro');
    $tanggal = $this->input->post('tanggal');
    $username = $this->session->userdata('ses_username');

    $jam = date('H:i:s');
    $waktuisi = date('Y-m-d H:i:s');

    $data = [];

    if ($tanggal == $tglHmin1) {
      $status_koreksi = 0;
    } else if ($tanggal < $tglHmin1) {
      $status_koreksi = 1;
    } else {
      $status_koreksi = 0;
    }

    $avgPercentage = 0;

    for ($i = 1; $i <= $jmlpro; $i++) {
      // var_dump($i);

      //

      //if($persen == 0 OR $persen == NULL){

      //}else{
      $idtkmdiv     = $this->input->post("idtkmdiv$i");
      $project      = $this->input->post("project$i");

      $kode       = $this->input->post("kode_project$i");

      $jmlrincian = $this->input->post("jmlrincian$i");
      $totalPersenPerProject = 0;
      $totalPersenAllStaff = 0;
      for ($x = 1; $x <= $jmlrincian; $x++) {
        $rincian   = $this->input->post("rincian$i$x");
        $uraian   = $this->input->post("uraian$i$x");
        $keterangan   = $this->input->post("keterangan$i$x");
        $keterangan_koreksi   = $this->input->post("keterangan_koreksi");
        $status       = $this->input->post("status$i$x");
        $file_name    = $_FILES["fileupload$i$x"]['name'];
        $persen       = $this->input->post("persen$i$x");
        // $status       = $this->input->post("status$i$x");

        $file_tmp = $_FILES["fileupload$i$x"]['tmp_name'];
        move_uploaded_file($file_tmp, "dist/upload/" . $file_name);

        $data1 = [
          'idtkmdiv' => $idtkmdiv,
          'username' => $username,
          'project' => $project,
          'keterangan' => $keterangan,
          'fileupload' => $file_name,
          'persentase' => $persen,
          'id_rincian' => $rincian,
          'status' => $status,
          'tanggal' => $tanggal,
          'jam'    => $jam,
          'waktuisi' => $waktuisi,
          'id_uraian' => $uraian,
          'status_koreksi' => $status_koreksi,
          'keterangan_koreksi' => $keterangan_koreksi
        ];

        $totalPersenPerProject += $persen;

        // var_dump($data1['id_rincian']);
        var_dump('----------------');
        if ($persen > 0) {
          array_push($data, $data1);
          // $ids = $this->db->select('no')->where('idtkmdiv', (int)$idtkmdiv)->from('tkmstaff')->get()->result_array();
            if ($status != '' OR $status != NULL) {
            
            $this->db->where('id_rincian', (int)$rincian)->update('rincian', ['targetpersen' => $persen, 'status' => $status, 'tanggalupdate' => $tanggal]);
            $this->db->where('id_tkmdiv', (int)$idtkmdiv)->where('id_uraian', (int)$uraian)->update('uraian', ['bobotpersentase' => $persen]);
            } else {

            $this->db->where('id_rincian', (int)$rincian)->update('rincian', ['targetpersen' => $persen]);
            $this->db->where('id_tkmdiv', (int)$idtkmdiv)->where('id_uraian', (int)$uraian)->update('uraian', ['bobotpersentase' => $persen]);
            }
        }
        // var_dump($data1);
      }
      $this->db->where('idtkmdiv', (int)$idtkmdiv)->where('userstaff', $username)->where('project', $project)->where('no', $kode)->update('tkmstaff', ['persentase' => round($totalPersenPerProject / $jmlrincian)]);

      $jumlahStaff = $this->db->where('idtkmdiv', (int)$idtkmdiv)->where('project', $project)->from('tkmstaff')->count_all_results();
      var_dump($jumlahStaff);

      $getTotalPersentaseAllStaff = $this->db->select_sum('persentase')->where('idtkmdiv', (int)$idtkmdiv)->where('project', $project)->from('tkmstaff')->get()->result_array();

      foreach ($getTotalPersentaseAllStaff as $persen) {
        $totalPersenAllStaff += $persen['persentase'];
      }

      $this->db->where('idtkmdiv', (int)$idtkmdiv)->where('project', $project)->update('pekerjaan', ['persentase' => round($totalPersenAllStaff / $jumlahStaff)]);
    }
    // die();
    if ($data) {

      $this->db->insert_batch('tugasharian', $data);
      $respon = array('state' => 1, 'msg' => 'Berhasil Di Simpan', 'tgl' => $tanggal);
      return $respon;
    } else {
      $respon = array('state' => 0, 'msg' => 'Gagal Di Simpan', 'tgl' => $tanggal);
      return $respon;
    }

     $this->db->query("UPDATE progress_bar SET persentase='75' WHERE username='$username'");  

  }
}
