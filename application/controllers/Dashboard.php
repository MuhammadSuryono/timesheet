<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Dashboard_model');
    //Codeigniter : Write Less Do More
    if (!$this->session->userdata('ses_username')) {
      redirect('auth');
    }
  }

  public function index()
  {

    $divisi = $this->session->userdata('ses_divisi');
    $nama = $this->session->userdata('ses_username');


    $data['direksinya'] = $this->db->query("SELECT atasan FROM tb_user WHERE divisi='$divisi' AND jabatan1='Leader 1'")->row_array();

    $data['leader'] = $this->db->query("SELECT
                                              *
                                          FROM tb_user
                                          WHERE divisi='$divisi'
                                          AND aktif='Y'
                                          AND jabatan1 !='Staff'
                                          OR divisi='$divisi'
                                          AND aktif='Y'
                                          AND jabatan1 != NULL ORDER BY jabatan1")->result_array();

    $data['alldiv'] = $this->db->query("SELECT
                                              *
                                            FROM tb_user
                                            WHERE divisi='$divisi'
                                            -- AND jabatan1 !='Leader 1'
                                            -- OR divisi='$divisi'
                                            -- AND jabatan1 !='Leader 2'
                                            -- OR divisi='$divisi'
                                            AND jabatan1 ='Staff' OR 
                                            atasan='$nama' GROUP BY id_user ORDER BY nama_user")->result_array();
    $data['judul'] = 'MRI TIMESHEET WFH';

    $this->load->view('template/header', $data);
    $this->load->view('dashboard/dashboard2', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/footer');
  }

  public function index_lama()
  {
    $username = $this->session->userdata('ses_username');
    $divisi   = $this->session->userdata('ses_divisi');
    $data['caritarget'] = $this->db->query("SELECT * FROM tkmstaff WHERE userstaff='$username'")->result_array();
    $data['targetdiv'] = $this->db->query("SELECT * FROM pekerjaan WHERE idtkmdiv IN (SELECT no FROM tkmdivisi WHERE divisi='$divisi')")->result_array();

    $data['targetalldiv'] = $this->db->query("SELECT
                                              	a.*,
                                              	b.divisi,
                                              	b.daritanggal,
                                              	b.sampaitanggal
                                              FROM
                                              	pekerjaan a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              WHERE b.status = 'Disetujui'
                                              GROUP BY a.project")->result_array();

    $data['targetcapaidiv'] = $this->db->query("SELECT
                                              	a.*,
                                              	b.divisi,
                                              	b.daritanggal,
                                              	b.sampaitanggal,
                                              	SUM(c.persentase) AS totalper
                                              FROM
                                              	pekerjaan a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              LEFT JOIN tugasharian c ON a.project = c.project
                                              WHERE b.status = 'Disetujui'
                                              GROUP BY a.project ")->result_array();

    $this->load->view('template/header');
    $this->load->view('dashboard/dashboard', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/footer');
  }

  public function tindaklanjut_status()
  {
   
        $id = $this->input->post('idrincian');
        

        foreach ($id as $row => $val) {

            $data = [
                        'rincian' => $_POST['rinciantext'][$row],
                        'targetpersen' => $_POST['persen'][$row],
                        'status' => $_POST['status'][$row]
                        
                        ];


                $where = ['id_rincian' => $val];
                
                $this->db->where($where);
                $this->db->update('rincian', $data);
            
        }
        $this->session->set_flashdata('flash2', 'Berhasil Ubah Status Rincian TKM');
        redirect('dashboard');
  }

  public function disclaimer()
  {
    $nama = $this->input->post('nama');
    $id_user = $this->input->post('id_user');
    $ket = $this->input->post('ket');

    $data = [
          'id_user' => $id_user,
          'nama' => $nama,
          'ket' => $ket,
            ];

      var_dump($data);
    $this->db->insert('disclaimer', $data);
    redirect('dashboard');
     
  }

  public function getrekap()
  {
    $id_user = $_POST['id_user'];
    $daritanggal = $_POST['daritanggal'];
    $sampaitanggal = $_POST['sampaitanggal'];
    $katakunci = $_POST['katakunci'];


    if ($katakunci == NULL OR $katakunci == '') {
     $data = $this->db->query("SELECT
                                                a.*,
                                              --  SUM(c.persentase) AS sumper,
                                                d.deskripsi, 
                                              d.no as no_pekerjaan,
                                              b.daritanggal,
                                              b.sampaitanggal,
                                              e.*
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                              -- AND a.project = c.project
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              JOIN rincian e ON a.no=e.id_tkmstaff AND d.no=e.idpekerjaan
                                              WHERE
                                                a.userstaff = '$id_user'
                                                -- AND a.tanggalisi between '$daritanggal' AND '$sampaitanggal'
                                                AND b.daritanggal between '$daritanggal' AND '$sampaitanggal'
                                                ")->result_array();
    } else {
    $data = $this->db->query("SELECT
                                                a.*,
                                              --  SUM(c.persentase) AS sumper,
                                                d.deskripsi, 
                                              d.no as no_pekerjaan,
                                              b.daritanggal,
                                              b.sampaitanggal,
                                              e.*
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                              -- AND a.project = c.project
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              JOIN rincian e ON a.no=e.id_tkmstaff AND d.no=e.idpekerjaan
                                              WHERE
                                                a.userstaff = '$id_user'
                                                -- AND (a.tanggalisi between '$daritanggal' AND '$sampaitanggal' OR e.rincian LIKE '%$katakunci%')
                                                AND (b.daritanggal between '$daritanggal' AND '$sampaitanggal' OR e.rincian LIKE '%$katakunci%')
                                            
                                                ")->result_array();
  }
    echo json_encode($data);
  }


  public function getrekap_name()
  {
    $id_user = $_POST['id_user'];
    $time = strtotime("-14 days", time());
    $daritanggal = date("Y-m-d", $time);
    $sampaitanggal = date("Y-m-d");
    

     $data = $this->db->query("SELECT
                                                a.*,
                                              --  SUM(c.persentase) AS sumper,
                                                d.deskripsi, 
                                              d.no as no_pekerjaan,
                                              b.daritanggal,
                                              b.sampaitanggal,
                                              e.*
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                              -- AND a.project = c.project
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              JOIN rincian e ON a.no=e.id_tkmstaff AND d.no=e.idpekerjaan
                                              WHERE
                                                a.userstaff = '$id_user'
                                                -- AND a.tanggalisi between '$daritanggal' AND '$sampaitanggal'
                                                AND b.daritanggal between '$daritanggal' AND '$sampaitanggal'
                                                ")->result_array();
   
    echo json_encode($data);
  }
}
