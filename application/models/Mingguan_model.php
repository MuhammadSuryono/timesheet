<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mingguan_model extends CI_Model
{

  public function getminggukelima()
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-04-13' AND sampaitanggal='2020-04-17' AND divisi='$divisinya'")->row_array();
  }

  public function getminggukedua()
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-04-20' AND sampaitanggal='2020-04-24' AND divisi='$divisinya'")->row_array();
  }

  public function getmingguketiga()
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-04-27' AND sampaitanggal='2020-05-01' AND divisi='$divisinya'")->row_array();
  }

  public function getminggukeempat()
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-05-04' AND sampaitanggal='2020-05-08' AND divisi='$divisinya'")->row_array();
  }

  public function getpekerjaankelima()
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT
                                    a.*,
                                    b.project,
                                    b.deskripsi,
                                    b.persentase
                                FROM tkmdivisi a
                                JOIN pekerjaan b ON a.no = b.idtkmdiv
                                WHERE daritanggal='2020-05-11'
                                AND sampaitanggal='2020-05-15'
                                AND divisi='$divisinya'")->result_array();
  }

  public function getpekerjaankedua()
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT
                                    a.*,
                                    b.project,
                                    b.deskripsi,
                                    b.persentase
                                FROM tkmdivisi a
                                JOIN pekerjaan b ON a.no = b.idtkmdiv
                                WHERE daritanggal='2020-04-20'
                                AND sampaitanggal='2020-04-24'
                                AND divisi='$divisinya'")->result_array();
  }

  public function getpekerjaanketiga()
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT
                                    a.*,
                                    b.project,
                                    b.deskripsi,
                                    b.persentase
                                FROM tkmdivisi a
                                JOIN pekerjaan b ON a.no = b.idtkmdiv
                                WHERE daritanggal='2020-04-27'
                                AND sampaitanggal='2020-05-01'
                                AND divisi='$divisinya'")->result_array();
  }

  public function getpekerjaankeempat()
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT
                                    a.*,
                                    b.project,
                                    b.deskripsi,
                                    b.persentase
                                FROM tkmdivisi a
                                JOIN pekerjaan b ON a.no = b.idtkmdiv
                                WHERE daritanggal='2020-05-04'
                                AND sampaitanggal='2020-05-08'
                                AND divisi='$divisinya'")->result_array();
  }

  public function getalltkm()
  {
    $direksi = $this->session->userdata('ses_username');
    return $this->db->query("SELECT
                                  	a.*,
                                    b.nama_user AS namapengisi
                                  FROM
                                  	tkmdivisi a
                                  JOIN tb_user b ON a.pengisi = b.id_user
                                  WHERE
                                  	a.status = 'Menunggu Approval'
                                  	AND b.atasan='$direksi'
                                  ORDER BY
                                  	NO ASC")->result_array();
  }

  public function getminggupertamaapp()
  {
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-04-13' AND sampaitanggal='2020-04-17' AND status='Disetujui'")->result_array();
  }

  public function getminggukeduaapp()
  {
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-04-20' AND sampaitanggal='2020-04-24' AND status='Disetujui'")->result_array();
  }

  public function getmingguketigaapp()
  {
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-04-27' AND sampaitanggal='2020-05-01' AND status='Disetujui'")->result_array();
  }

  public function getminggukeempatapp()
  {
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-05-04' AND sampaitanggal='2020-05-08' AND status='Disetujui'")->result_array();
  }

  public function getminggukelimaapp()
  {
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-05-11' AND sampaitanggal='2020-05-15' AND status='Disetujui'")->result_array();
  }

  public function getminggukeenamapp()
  {
    return $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='2020-05-18' AND sampaitanggal='2020-05-22' AND status='Disetujui'")->result_array();
  }

  public function isitkmnya()
  {
    $cariid = $this->db->query("SELECT no FROM tkmdivisi ORDER BY no DESC LIMIT 1")->row_array();
    $idtkm  = $cariid['no'] + 1;

    $jmlproject     = $this->input->post('jmlproject') + 1;
    $daritanggal    = $this->input->post('daritanggal');
    $sampaitanggal  = $this->input->post('sampaitanggal');
    $divisi         = $this->session->userdata('ses_divisi');
    $pengisi        = $this->session->userdata('ses_username');
    $status         = "Menunggu Approval";

    $data = [];

    $jmlprapro      = $this->input->post('jmlprapo');
    // var_dump($jmlprapro);
    // die;

    if ($jmlprapro == NULL or $jmlprapro == 0) {
    } else {

      for ($j = 0; $j < $jmlprapro; $j++) {
        $praper = $this->input->post("praper$j");
        $prapro = $this->input->post("prapro$j");
        $prades = $this->input->post("prades$j");
        if ($praper == 0) {
          $data2 = [];
        } else {
          $data2 = [
            'idtkmdiv' => $idtkm,
            'project'  => $prapro,
            'deskripsi' => $prades,
            'persentase' => $praper,
          ];
          $this->db->insert('pekerjaan', $data2);
          // var_dump($data2);
        }
      }

      // die;

    }
    // echo $data2;
    // die;

    for ($i = 0; $i < $jmlproject; $i++) {
      $project    = $this->input->post("project$i");
      $deskripsi  = $this->input->post("deskripsi$i");
      $persentase = $this->input->post("persentase$i");
      $data1 = [
        'idtkmdiv' => $idtkm,
        'project' => $project,
        'deskripsi' => $deskripsi,
        'persentase' => $persentase,
      ];
      array_push($data, $data1);
    }
    $this->db->insert_batch('pekerjaan', $data);

    $data = [
      'no' => $idtkm,
      'divisi' => $divisi,
      'pengisi' => $pengisi,
      'daritanggal' => $daritanggal,
      'sampaitanggal' => $sampaitanggal,
      'status' => $status,
    ];
    $this->db->insert('tkmdivisi', $data);
  }

  public function isitkmnya2()
  {
    $cariid = $this->db->query("SELECT no FROM tkmdivisi ORDER BY no DESC LIMIT 1")->row_array();
    $idtkm  = $cariid['no'] + 1;
    $lolos = 0;

    $jmlproject     = $this->input->post('jmlproject') + 1;
    $daritanggal    = $this->input->post('daritanggal');
    $sampaitanggal  = $this->input->post('sampaitanggal');
    $divisi         = $this->session->userdata('ses_divisi');
    $pengisi        = $this->session->userdata('ses_username');
    $status         = "Menunggu Approval";

    $data = [];

    $jmlprapro      = $this->input->post('jmlprapo');

    if ($jmlprapro == NULL or $jmlprapro == 0) {
    } else {

      for ($j = 1; $j <= $jmlprapro; $j++) {
        $praper = $this->input->post("praper$j");
        $prapro = $this->input->post("prapro$j");
        $prades = $this->input->post("prades$j");
        $prakategori = $this->input->post("prakategori$j");

        if ($praper == 0) {
          $data2 = [];
        } else {

          if ($praper != '' or $praper != 0) {
            $lolos++;

            $data2 = [
              'idtkmdiv' => $idtkm,
              'project'  => $prapro,
              'deskripsi' => $prades,
              'persentase' => $praper,
              'id_kategori' => $prakategori,
            ];
            $this->db->insert('pekerjaan', $data2);



            // INSERT URAIAN
            $pekerjaan = $this->db->get_where('pekerjaan', $data2)->row_array();
            // $lorem = $j-1;
            $banyakuraian = $this->input->post("uraian$j");

            for ($x = 0; $x < count($banyakuraian); $x++) {
              if ($banyakuraian[$x] != '') {
                $datainsert = [
                  'id_tkmdiv' => $idtkm,
                  'id_pekerjaan' => $pekerjaan['no'],
                  'uraian' => $banyakuraian[$x],
                ];

                $true = $this->db->get_where('uraian', $datainsert)->row_array();
                if (count($true) == 0) {
                  $this->db->insert('uraian', $datainsert);
                }
              }
            }
            // var_dump("MASUK"); die;
            // AKHIR
          }
        }
      }

      var_dump("LOLOS1");
    }

    for ($i = 0; $i < $jmlproject; $i++) {
      $project    = $this->input->post("project$i");
      $deskripsi  = $this->input->post("deskripsi$i");
      $persentase = $this->input->post("persentase$i");
      $kategori = $this->input->post("kategori$i");

      if ($project != '' and $persentase != 0) {
        $lolos++;

        $data1 = [
          'idtkmdiv' => $idtkm,
          'project' => $project,
          'deskripsi' => $deskripsi,
          'persentase' => $persentase,
          'id_kategori' => $kategori,
        ];
        $this->db->insert('pekerjaan', $data1);

        // INSERT URAIAN
        $pekerjaan = $this->db->get_where('pekerjaan', $data1)->row_array();
        $banyakuraian = $this->input->post("uraiannew$i");
        $insert = [];
        var_dump("LOLOS LOLOS");
        var_dump(count($banyakuraian));
        for ($x = 0; $x < count($banyakuraian); $x++) {
          if ($banyakuraian[$x] != '') {
            $datainsert = [
              'id_tkmdiv' => $idtkm,
              'id_pekerjaan' => $pekerjaan['no'],
              'uraian' => $banyakuraian[$x],
            ];

            array_push($insert, $datainsert);
          }
        }

        if (count($banyakuraian) != 0) {
          $this->db->insert_batch('uraian', $insert);
        }
        // AKHIR
      }
    }

    var_dump("LOLOS2");

    if ($lolos != 0) {
      $data = [
        'no' => $idtkm,
        'divisi' => $divisi,
        'pengisi' => $pengisi,
        'daritanggal' => $daritanggal,
        'sampaitanggal' => $sampaitanggal,
        'status' => $status,
      ];
      $this->db->insert('tkmdivisi', $data);
    }
  }


  public function isitkmnya3()
  {
    $cariid = $this->db->query("SELECT no FROM tkmdivisi ORDER BY no DESC LIMIT 1")->row_array();
    $idtkm  = $cariid['no'] + 1;
    $lolos = 0;



    $jmlproject     = $this->input->post('jmlproject') + 1;
    $daritanggal    = $this->input->post('daritanggal');
    $sampaitanggal  = $this->input->post('sampaitanggal');
    $divisi         = $this->session->userdata('ses_divisi');
    $pengisi        = $this->session->userdata('ses_username');
    // $status         = "Menunggu Approval";
    $status         = "Disetujui";


    // var_dump($this->input->post());
    // die();

    $data = [];

    $jmlprapro      = $this->input->post('jmlprapo');

    if ($jmlprapro == NULL or $jmlprapro == 0) {
    } else {

      for ($j = 1; $j <= $jmlprapro; $j++) {
        $praper = $this->input->post("praper$j");
        $prapro = $this->input->post("prapro$j");
        $prades = $this->input->post("prades$j");
        $prakategori = $this->input->post("prakategori$j");


        // if ($praper == 0) {
        //   $data2 = [];
        // } else {

        // if ($praper != '' or $praper != 0) {
        $lolos++;

        $data2 = [
          'idtkmdiv' => $idtkm,
          'project'  => $prapro,
          'deskripsi' => $prades,
          'persentase' => 0,
          'id_kategori' => $prakategori,
        ];
        $this->db->insert('pekerjaan', $data2);



        // INSERT URAIAN
        $pekerjaan = $this->db->get_where('pekerjaan', $data2)->row_array();
        // $lorem = $j-1;
        $banyakuraian = $this->input->post("uraian$j");
        $boboturaian = $this->input->post("bobotpersen$j");
        $target = $this->input->post("targetold$j");

        var_dump($pekerjaan);

        $idlist = $this->input->post("idlistold$j");

        

        for ($x = 0; $x < count($banyakuraian); $x++) {
            $id_list = $idlist[$x];

          if ($banyakuraian[$x] != '') {
            $datainsert = [
              'id_tkmdiv' => $idtkm,
              'id_pekerjaan' => $pekerjaan['no'],
              'uraian' => $banyakuraian[$x],
              'id_list' => $id_list,
              'bobotpersentase' => $boboturaian[$x],
              'targetselesai' => $target[$x]
            ];

            $true = $this->db->get_where('uraian', $datainsert)->row_array();
            // var_dump($idtkm);
            if (count($true) == 0) {
              $this->db->insert('uraian', $datainsert);
            }
          }
            // $id_list = $idlist[$x];
            $this->db->query("UPDATE list_note SET to_tkm = 'Y' WHERE id='$id_list'");    
                // $this->db->where($where);
                // $this->db->update('list_note', $data);
        }

        //   LINTAS DIVISI
        $banyakdivisi = $this->input->post("divisi$j");
        for ($x = 0; $x < count($banyakdivisi); $x++) {
          if ($banyakdivisi[$x] != '') {
            $insertdivisi = [
              'no' => $pekerjaan['no'],
              'idtkmdiv' => $idtkm,
              'project'  => $prapro,
              'deskripsi' => $prades,
              'persentase' => $praper,
              'id_kategori' => $prakategori,
              'divisi' => $banyakdivisi[$x],
              'daritanggal' => $daritanggal,
              'sampaitanggal' => $sampaitanggal,
            ];

            $true = $this->db->get_where('pekerjaan_lintasdivisi', $insertdivisi)->row_array();
            if (count($true) == 0) {
              $this->db->insert('pekerjaan_lintasdivisi', $insertdivisi);
            }
          }
        }
        // AKHIR
        // var_dump("MASUK"); die;
        // AKHIR

        // }
        // }
      }


      // var_dump("LOLOS1");
      // die();
    }

    for ($i = 0; $i < $jmlproject; $i++) {
      $propro    = $this->input->post("project$i");
      $cut = explode("_" , $propro);
      $project = $cut[0];

      $deskripsi  = $this->input->post("deskripsi$i");
      $persentase = $this->input->post("persentase$i");
      $kategori = $this->input->post("kategori$i");

      if ($project != '') {
        $lolos++;

        $data1 = [
          'idtkmdiv' => $idtkm,
          'project' => $project,
          'deskripsi' => $deskripsi,
          'persentase' => 0,
          'id_kategori' => $kategori,
        ];
        $this->db->insert('pekerjaan', $data1);

        // INSERT URAIAN
        $pekerjaan = $this->db->get_where('pekerjaan', $data1)->row_array();
        $banyakuraian = $this->input->post("uraiannew$i");
        $boboturaian2 = $this->input->post("bobotpersennew$i");
        $target = $this->input->post("target$i");


        $idlist = $this->input->post("idlist$i");
        $insert = [];
        var_dump("LOLOS LOLOS");
        var_dump(count($banyakuraian));
        for ($x = 0; $x < count($banyakuraian); $x++) {
          if ($banyakuraian[$x] != '') {
            $datainsert = [
              'id_tkmdiv' => $idtkm,
              'id_pekerjaan' => $pekerjaan['no'],
              'uraian' => $banyakuraian[$x],
              'id_list' => $idlist[$x],
              'bobotpersentase' => $boboturaian2[$x],
              'targetselesai' => $target[$x]
            ];

            array_push($insert, $datainsert);
          }
            $id_list = $idlist[$x];
            $this->db->query("UPDATE list_note SET to_tkm = 'Y' WHERE id='$id_list'"); 
        }

        if (count($banyakuraian) != 0) {
          $this->db->insert_batch('uraian', $insert);
        }
        // AKHIR

        // INSERT LINTAS DIVISI
        $banyakdivisi = $this->input->post("divisinew$i");
        $insert = [];
        var_dump("LOLOS LOLOS DIVISI NEW");
        var_dump(count($banyakdivisi));
        for ($x = 0; $x < count($banyakdivisi); $x++) {
          if ($banyakdivisi[$x] != '') {
            $datainsert = [
              'no' => $pekerjaan['no'],
              'idtkmdiv' => $idtkm,
              'project' => $project,
              'deskripsi' => $deskripsi,
              'persentase' => $persentase,
              'id_kategori' => $kategori,
              'divisi' => $banyakdivisi[$x],
              'daritanggal' => $daritanggal,
              'sampaitanggal' => $sampaitanggal,
            ];

            array_push($insert, $datainsert);
          }
        }

        if (count($banyakdivisi) != 0) {
          $this->db->insert_batch('pekerjaan_lintasdivisi', $insert);
        }
        // AKHIR

      }
    }

    var_dump("LOLOS2");

    if ($lolos != 0) {
      $data = [
        'no' => $idtkm,
        'divisi' => $divisi,
        'pengisi' => $pengisi,
        'daritanggal' => $daritanggal,
        'sampaitanggal' => $sampaitanggal,
        'status' => $status,
      ];
      $this->db->insert('tkmdivisi', $data);
    }
     $this->db->query("UPDATE progress_bar SET persentase='75' WHERE username='$pengisi'");

     $user = $this->db->get_where('tb_user', array('id_user' => $pengisi))->row_array();
     $datenow = date('Y-m-d');


       $pekerjaan = $this->db->get_where('pekerjaan', array('idtkmdiv' => $idtkm))->result_array();

    foreach ($pekerjaan as $pek) {
      $staff_tkm = $this->db->get_where('rincian', array('idpekerjaan' => $pek['no']))->num_rows();

      if ($staff_tkm == 0) {
          $data = ['idtkmdiv' => $pek['idtkmdiv'],
                  'leader' => $user['atasan'],
                  'userstaff' =>  $pengisi,
                  'project' => $pek['project'],
                  'tanggalisi' => $datenow
                  ];
          $this->db->insert('tkmstaff', $data);
          $last_insert_id = $this->db->insert_id(); 

          $uraian = $this->db->get_where('uraian', array('id_tkmdiv' => $idtkm, 'id_pekerjaan' => $pek['no']))->result_array();
          foreach ($uraian as $ura) {
            $dt = [
                  'idpekerjaan' => $pek['no'],
                  'idtkmdiv' => $idtkm,
                  'userstaff' => $pengisi,
                  'id_tkmstaff' => $last_insert_id,
                  'rincian' => $ura['uraian'],
                  'id_list' => $ura['id_uraian'],
                  'targetselesai' => $ura['targetselesai']
                  ];
          $this->db->insert('rincian', $dt);

        }
      }
    } 
     $this->db->query("UPDATE progress_bar SET persentase='100' WHERE username='$pengisi'");


  }


  public function isitkmstaffnya()
  {
    date_default_timezone_set('Asia/Jakarta');

    $jmlproject = $this->input->post('jmlproject');

    for ($i = 1; $i <= $jmlproject; $i++) {
      $idtkmdiv   = $this->input->post('idtkmdiv');
      $leader     = $this->session->userdata('ses_username');
      $userstaff  = $this->input->post('userstaff');
      $project    = $this->input->post("project$i");
      $persentase = $this->input->post("persentase$i");
      $tanggalisi = date('Y-m-d');



      $this->db->query("INSERT INTO tkmstaff (idtkmdiv,leader,userstaff,project,persentase,tanggalisi)
                                        VALUES ('$idtkmdiv','$leader','$userstaff','$project','$persentase','$tanggalisi')");
    }
  }

  public function isitkmstaffnya2()
  {
    date_default_timezone_set('Asia/Jakarta');

    $jmlproject = $this->input->post('jmlproject');

    for ($i = 1; $i <= $jmlproject; $i++) {
      $idtkmdiv   = $this->input->post('idtkmdiv');
      $leader     = $this->session->userdata('ses_username');
      $userstaff  = $this->input->post('userstaff');
      $project    = $this->input->post("project$i");
      $persentase = $this->input->post("persentase$i");
      $idpekerjaan = $this->input->post("idpekerjaan$i");
      $rincian = $this->input->post("rincian$i");
      $tanggalisi = date('Y-m-d');

     
       
      $this->db->query("INSERT INTO tkmstaff (idtkmdiv,leader,userstaff,project,persentase,tanggalisi)
                                        VALUES ('$idtkmdiv','$leader','$userstaff','$project','$persentase','$tanggalisi')");
      

      $tkmstaff = $this->db->query("SELECT no from tkmstaff where idtkmdiv='$idtkmdiv' and leader='$leader' and userstaff='$userstaff' and project='$project' and persentase='$persentase' and tanggalisi='$tanggalisi'")->row_array();

      for ($x = 0; $x < count($rincian); $x++) {
        $data = [
          'idpekerjaan' => $idpekerjaan,
          'idtkmdiv' => $idtkmdiv,
          'userstaff' => $userstaff,
          'id_tkmstaff' => $tkmstaff['no'],
          'rincian' => $rincian[$x]
        ];

        $this->db->insert('rincian', $data);
      }
    }
  }

  public function isitkmstaffnya4()
  {
    date_default_timezone_set('Asia/Jakarta');

    $jmlproject = $this->input->post('jmlproject');

    for ($i = 1; $i <= $jmlproject; $i++) {
      $idtkmdiv   = $this->input->post('idtkmdiv');
      $leader     = $this->session->userdata('ses_username');
      $userstaff  = $this->input->post('userstaff');
      $project    = $this->input->post("project$i");
      $persentase = $this->input->post("persentase$i");
      $idpekerjaan = $this->input->post("idpekerjaan$i");
      $rincian    = $this->input->post("rincian$i");
      $tanggalisi = date('Y-m-d');

      if ($persentase != 0 or $persentase != null) {
        $insert = [];

        $data = [
          'idtkmdiv'  => $idtkmdiv,
          'leader'    => $leader,
          'userstaff' => $userstaff,
          'project'   => $project,
          'persentase' => $persentase,
          'tanggalisi' => $tanggalisi,
        ];

      // $cek = $this->db->query("SELECT * FROM tkmstaff WHERE idtkmdiv='$idtkmdiv' AND leader='$leader' AND userstaff='$userstaff' AND project='$project'")->num_rows();

      // if ($cek == 0) {

        $this->db->insert('tkmstaff', $data);
      // }

        $tkmstaff = $this->db->get_where('tkmstaff', $data)->row_array();
        for ($x = 0; $x < count($rincian); $x++) {
          $data1 = [
            'idpekerjaan' => $idpekerjaan,
            'idtkmdiv' => $idtkmdiv,
            'userstaff' => $userstaff,
            'id_tkmstaff' => $tkmstaff['no'],
            'rincian' => $rincian[$x]
          ];

          array_push($insert, $data1);
        }

        if (count($insert) != 0) {
          $this->db->insert_batch('rincian', $insert);
        }
      }
    }
  }

  public function isitkmstaffnya5()
  {
    date_default_timezone_set('Asia/Jakarta');

    // var_dump($this->input->post());
    // die();

    $jmlproject = $this->input->post('jmlproject');

    for ($i = 1; $i <= $jmlproject; $i++) {
      $idtkmdiv   = $this->input->post("idtkmdiv$i");
      $leader     = $this->session->userdata('ses_username');
      $userstaff  = $this->input->post('userstaff');
      $project    = $this->input->post("project$i");
      $persentase = 0;
      $idpekerjaan = $this->input->post("idpekerjaan$i");
      $rincian    = $this->input->post("rincian$i");
      $targetpersen = $this->input->post("targetpersen$i");
      $idlist = $this->input->post("idlist$i");
      $targetselesai = $this->input->post("targetselesai$i");
      $tanggalisi = date('Y-m-d');

      // if ($persentase != 0 and $persentase != null) {
      $insert = [];

      $data = [
        'idtkmdiv'  => $idtkmdiv,
        'leader'    => $leader,
        'userstaff' => $userstaff,
        'project'   => $project,
        'persentase' => $persentase,
        'tanggalisi' => $tanggalisi,
        
      ];

       $cekdata = [
        'idtkmdiv'  => $idtkmdiv,
        'leader'    => $leader,
        'userstaff' => $userstaff,
        'project'   => $project,
        // 'persentase' => $persentase,
        
        
      ];

       $cek = $this->db->query("SELECT * FROM tkmstaff WHERE idtkmdiv='$idtkmdiv' AND leader='$leader' AND userstaff='$userstaff' AND project='$project'")->num_rows();

      if ($project != null && $rincian != null) {
        

      if ($cek == 0) {
        $this->db->insert('tkmstaff', $data);
      }
        // var_dump($project);
        // var_dump($rincian);
        // var_dump('00000000000000000');
        $tkmstaff = $this->db->get_where('tkmstaff', $cekdata)->row_array();
        for ($x = 0; $x < count($rincian); $x++) {
          $data1 = [
            'idpekerjaan' => $idpekerjaan,
            'idtkmdiv' => $idtkmdiv,
            'userstaff' => $userstaff,
            'id_tkmstaff' => $tkmstaff['no'],
            'rincian' => $rincian[$x],
            'targetpersen' => $targetpersen[$x],
            'id_list' => $idlist[$x],
            'targetselesai' => $targetselesai[$x]
          ];

          array_push($insert, $data1);

        $editlist = $this->db->query("UPDATE list_note SET to_tkm='Y' WHERE id='$idlist[$x]'");
        }
      }

      if (count($insert) != 0) {
        $this->db->insert_batch('rincian', $insert);

        $jumlahStaff = $this->db->where('idtkmdiv', (int)$idtkmdiv)->where('project', $project)->from('tkmstaff')->count_all_results();
        // var_dump($jumlahStaff);

        $totalPersenAllStaff = $this->db->select('persentase')->where('idtkmdiv', (int)$idtkmdiv)->where('project', $project)->from('pekerjaan')->get()->result_array();

        $totalPersenAllStaff = $totalPersenAllStaff[0]['persentase'];

        if ($totalPersenAllStaff == 0 || $jumlahStaff == 0) {
          $hasil = 0;
        } else {
          $hasil = round((int)$totalPersenAllStaff / $jumlahStaff);
        }

        // $totalPersenAllStaff = $totalPersenAllStaff['persentase'];
        // var_dump('totalPersenAllStaff');
        // var_dump($totalPersenAllStaff);
        // var_dump('jumlahStaff');
        // var_dump($jumlahStaff);
        // var_dump('hasil');
        // var_dump(round((int)$totalPersenAllStaff / $jumlahStaff));
        // var_dump('--------');
        $this->db->where('idtkmdiv', (int)$idtkmdiv)->where('project', $project)->update('pekerjaan', ['persentase' => $hasil]);
      }

      // }
    }
    // die();
  }

  public function getPekerjaan($dari, $sampai)
  {
    $divisinya = $this->session->userdata('ses_divisi');
    $username = $this->session->userdata('ses_username');
    $akses = $this->session->userdata('ses_akses');
    
    if ($akses == 'Manager') {
      return $this->db->query("SELECT
                                      a.*,
                                      b.project,
                                      b.deskripsi,
                                      b.persentase,
                                      b.tambahan,
                                      b.no as idpekerjaan,
                                      c.nama_kategori,
                                      d.*
                                  FROM tkmdivisi a
                                  JOIN pekerjaan b ON a.no = b.idtkmdiv
                                  LEFT JOIN kategori c ON c.id_kategori = b.id_kategori
                                  LEFT JOIN uraian d ON b.no = d.id_pekerjaan
                                  WHERE 
                                  -- a.daritanggal BETWEEN '$dari' AND '$sampai'
                                  -- AND 
                                  a.divisi='$divisinya'
                                  
                                   AND is_finish = 0")->result_array();
    } else {
    return $this->db->query("SELECT
                                      a.*,
                                      b.project,
                                      b.deskripsi,
                                      b.persentase,
                                      b.tambahan,
                                      b.no as idpekerjaan,
                                      c.nama_kategori,
                                      d.*
                                  FROM tkmdivisi a
                                  JOIN pekerjaan b ON a.no = b.idtkmdiv
                                  LEFT JOIN kategori c ON c.id_kategori = b.id_kategori
                                  LEFT JOIN uraian d ON b.no = d.id_pekerjaan
                                  WHERE 
                                  -- a.daritanggal BETWEEN '$dari' AND '$sampai'
                                  -- AND 
                                  a.divisi='$divisinya'
                                  AND pengisi ='$username'
                                   AND is_finish = 0")->result_array();
    }
  }

  public function getPekerjaanLintasDivisi($dari, $sampai)
  {
    $divisinya = $this->session->userdata('ses_divisi');
    return $this->db->query("SELECT
                                      a.*,
                                      b.project,
                                      b.deskripsi,
                                      b.persentase,
                                      b.tambahan,
                                      b.daritanggal as drtgl_lintasdiv,
                                      b.sampaitanggal as sptgl_lintasdiv,
                                      b.divisi as lintasdiv,
                                      b.tambahan,
                                      b.no as idpekerjaan,
                                      c.nama_kategori,
                                      d.*
                                  FROM pekerjaan_lintasdivisi b
                                  JOIN tkmdivisi a ON a.no = b.idtkmdiv
                                  LEFT JOIN kategori c ON c.id_kategori = b.id_kategori
                                  LEFT JOIN uraian d ON b.no = d.id_pekerjaan
                                  WHERE b.daritanggal >= '$dari'
                                  AND b.divisi='$divisinya'
                                  GROUP BY b.project")->result_array();
  }

  public function getallpekerjaan($dari, $sampai)
  {
    return $this->db->query("SELECT
                                      a.*,
                                      b.project,
                                      b.deskripsi,
                                      b.persentase,
                                      b.no as idpekerjaan,
                                      c.nama_kategori,
                                      d.*
                                  FROM tkmdivisi a
                                  JOIN pekerjaan b ON a.no = b.idtkmdiv
                                  LEFT JOIN kategori c ON c.id_kategori = b.id_kategori
                                  LEFT JOIN uraian d ON b.no = d.id_pekerjaan
                                  WHERE a.daritanggal BETWEEN '$dari' AND '$sampai'
                                  ")->result_array();
  }

  public function getTkmDivisi($dari, $sampai)
  {
    $divisinya = $this->session->userdata('ses_divisi');
    $username = $this->session->userdata('ses_username');
    
    return $this->db->query("SELECT
                                      *
                                  FROM tkmdivisi
                                  WHERE daritanggal BETWEEN '$dari' AND '$sampai'
                                  AND divisi='$divisinya'
                                  AND pengisi='$username'")->result_array();
  }

  public function simpanuraian()
  {
    // $uraian = $this->input->post('uraianmodal');
    $waitinglist = $this->input->post('waitinglist');
    $idTkmDiv = $this->input->post('idtkm');
    $idPekerjaan =  $this->input->post('id_pekerjaan');

    // $idlist = $this->input->post('id_list');

    foreach ($waitinglist as $row => $val) {

    $get_list = $this->db->query("SELECT * FROM list_note where id='$val'")->row_array();

   
    $data = [
      'uraian' => $get_list['pekerjaan'],
      'id_tkmdiv' => $idTkmDiv,
      'id_pekerjaan' => $idPekerjaan,
      'bobotpersentase' => 0,
    ];

    $this->db->insert('uraian', $data);
    var_dump($idTkmDiv);
    var_dump($idPekerjaan);

      $id_list = $val;
      $this->db->query("UPDATE list_note SET to_tkm = 'Y' WHERE id='$id_list'");
    }

    $getTotalPersentase = $this->db->select_sum('bobotpersentase')->where('id_tkmdiv', (int)$idTkmDiv)->where('id_pekerjaan', $idPekerjaan)->get('uraian')->result_array();

    $getDataPersentase = $this->db->where('id_tkmdiv', (int)$idTkmDiv)->where('id_pekerjaan', $idPekerjaan)->from('uraian')->count_all_results();

    $this->db->where('no', $idPekerjaan)->update('pekerjaan', ['persentase' => ($getTotalPersentase[0]['bobotpersentase'] / (int)$getDataPersentase)]);
    // var_dump($getDataPersentase);

    // var_dump($getTotalPersentase[0]['bobotpersentase']);
    // foreach ($getTotalPersentase as $tp) {
    // }
    // die();
  }

  public function edituraian()
  {
    $data = [
      'uraian' => $this->input->post('uraianmodal'),
      'targetselesai' => $this->input->post('targetmodal')
    ];

    $data2 = [
        'project' => $this->input->post('uraianmodal')
    ];

    $id_pek = $this->db->get_where('uraian', array('id_uraian' => $this->input->post('id_uraian')))->row_array();
    $tkmstaff = $this->db->get_where('rincian', array('id_list' => $this->input->post('id_uraian')))->row_array();


    $this->db->update('uraian', $data, ['id_uraian' => $this->input->post('id_uraian')]);
    $this->db->update('pekerjaan', $data2, ['no' => $id_pek['id_pekerjaan']]);

    $this->db->update('rincian', ['rincian' => $this->input->post('uraianmodal'), 'targetselesai' => $this->input->post('targetmodal')], ['idpekerjaan' => $id_pek['id_pekerjaan']]);
    $this->db->update('tkmstaff', $data2, ['no' => $tkmstaff['id_tkmstaff']]);


  }

  public function hapusuraian($id)
  {
    $this->db->delete('uraian', ['id_uraian' => $id]);
  }

  public function hapusdata()
  {
    $uraian = $this->input->post('id_uraianmodal');
    $alasan = $this->input->post('alasan');

    if ($uraian != null or $uraian != '') {
      $data_uraian = $this->db->get_where('uraian', ['id_uraian' => $uraian])->row_array();

      $data = $data_uraian;
      $data['alasan'] = $alasan;
      $this->db->insert('uraian_hapus', $data);

      $this->db->delete('uraian', ['id_uraian' => $uraian]);
    } else {
      $data_uraian = $this->db->get_where('uraian', ['id_pekerjaan' => $this->input->post('id_pekerjaanmodal')])->result_array();
      $data_pekerjaan = $this->db->get_where('pekerjaan', ['no' => $this->input->post('id_pekerjaanmodal')])->row_array();
      $insert = [];
      foreach ($data_uraian as $key => $db) {
        $data = $db;
        $data['alasan'] = $alasan;
        array_push($insert, $data);
        $this->db->delete('uraian', ['id_uraian' => $db['id_uraian']]);
      }

      if (count($insert) != 0) {
        $this->db->insert_batch('uraian_hapus', $insert);
      }

      $data_pekerjaan['alasan'] = $alasan;
      $this->db->insert('pekerjaan_hapus', $data_pekerjaan);
      $this->db->delete('pekerjaan', ['no' => $data_pekerjaan['no']]);
    }
  }

  public function simpantargetkerja()
  {
    $idtkm  = $this->input->post('idtkmdiv');

    $jmlproject     = $this->input->post('jmlproject') + 1;
    for ($i = 0; $i < $jmlproject; $i++) {
      $project    = $this->input->post("project$i");
      $deskripsi  = $this->input->post("deskripsi$i");
      $persentase = $this->input->post("persentase$i");
      $kategori = $this->input->post("kategori$i");

      if ($project != '' and ($persentase != 0 or $persentase != '' or $persentase != null)) {

        $data1 = [
          'idtkmdiv' => $idtkm,
          'project' => $project,
          'deskripsi' => $deskripsi,
          'persentase' => $persentase,
          'id_kategori' => $kategori,
        ];
        $this->db->insert('pekerjaan', $data1);

        // INSERT URAIAN
        $pekerjaan = $this->db->get_where('pekerjaan', $data1)->row_array();
        $banyakuraian = $this->input->post("uraiannew$i");
        $insert = [];
        var_dump("LOLOS LOLOS");
        var_dump(count($banyakuraian));

        for ($x = 0; $x < count($banyakuraian); $x++) {
          if ($banyakuraian[$x] != '') {
            $datainsert = [
              'id_tkmdiv' => $idtkm,
              'id_pekerjaan' => $pekerjaan['no'],
              'uraian' => $banyakuraian[$x],
            ];

            array_push($insert, $datainsert);
          }
        }

        if (count($banyakuraian) != 0) {
          $this->db->insert_batch('uraian', $insert);
        }
        // AKHIR
      }
    }
  }

  public function simpantargetkerjadiv()
  {
    $idtkm  = $this->input->post('idtkmdiv');

    $this->db->query("UPDATE tkmdivisi SET status='Menunggu Approval' WHERE no='$idtkm'");

    $jmlproject     = $this->input->post('jmlproject') + 1;
    for ($i = 0; $i < $jmlproject; $i++) {
      $project    = $this->input->post("project$i");
      $deskripsi  = $this->input->post("deskripsi$i");
      $persentase = $this->input->post("persentase$i");
      $kategori = $this->input->post("kategori$i");
      $tambahan = "yes";

      if ($project != '' and ($persentase != 0 or $persentase != '' or $persentase != null)) {

        $data1 = [
          'idtkmdiv' => $idtkm,
          'project' => $project,
          'deskripsi' => $deskripsi,
          'persentase' => $persentase,
          'id_kategori' => $kategori,
          'tambahan' => $tambahan,
        ];
        $this->db->insert('pekerjaan', $data1);

        // INSERT URAIAN
        $pekerjaan = $this->db->get_where('pekerjaan', $data1)->row_array();
        $banyakuraian = $this->input->post("uraiannew$i");
        $insert = [];
        var_dump("LOLOS LOLOS");
        var_dump(count($banyakuraian));

        for ($x = 0; $x < count($banyakuraian); $x++) {
          if ($banyakuraian[$x] != '') {
            $datainsert = [
              'id_tkmdiv' => $idtkm,
              'id_pekerjaan' => $pekerjaan['no'],
              'uraian' => $banyakuraian[$x],
            ];

            array_push($insert, $datainsert);
          }
        }

        if (count($banyakuraian) != 0) {
          $this->db->insert_batch('uraian', $insert);
        }
        // AKHIR
      }
    }
  }

  public function hapussemuadata()
  {
    $idtkmdiv = $this->input->post('idtkmdiv');
    $alasan = $this->input->post('alasan');


    // HAPUS URAIAN
    $data_uraian = $this->db->get_where('uraian', ['id_tkmdiv' => $idtkmdiv])->result_array();
    $inserturaian = [];
    foreach ($data_uraian as $key => $db) {
      $data = $db;
      $data['alasan'] = $alasan;
      array_push($inserturaian, $data);
      $this->db->delete('uraian', ['id_uraian' => $db['id_uraian']]);
    }

    if (count($inserturaian) != 0) {
      $this->db->insert_batch('uraian_hapus', $inserturaian);
    }
    // AKHIR URAIAN

    // HAPUS PEKERJAAN
    $data_pekerjaan = $this->db->get_where('pekerjaan', ['id_tkmdiv' => $idtkmdiv])->result_array();
    $insertpekerjaan = [];
    foreach ($data_pekerjaan as $key => $db) {
      $data = $db;
      $data['alasan'] = $alasan;
      array_push($insertpekerjaan, $data);
      $this->db->delete('pekerjaan', ['id_pekerjaan' => $db['id_pekerjaan']]);
    }

    if (count($insertpekerjaan) != 0) {
      $this->db->insert_batch('pekerjaan_hapus', $insertpekerjaan);
    }
    // AKHIR PEKERJAAN

    // HAPUS TKMDIVISI
    $data_tkmdiv = $this->db->get_where('tkmdivisi', ['no' => $idtkmdiv])->row_array();
    $data_tkmdiv['alasan'] = $alasan;
    $this->db->insert('tkmdivisi_hapus', $data_tkmdiv);
    $this->db->delete('tkmdivisi', ['no' => $data_tkmdiv['no']]);
    // AKHIR TKMDIVISI
  }

  public function hapussemuadata3()
  {
    $idtkmdiv = $this->input->post('idtkmdiv');
    $alasan = $this->input->post('alasan');


    // HAPUS URAIAN
    $data_uraian = $this->db->get_where('uraian', ['id_tkmdiv' => $idtkmdiv])->result_array();
    $inserturaian = [];
    foreach ($data_uraian as $key => $db) {
      $data = $db;
      $data['alasan'] = $alasan;
      array_push($inserturaian, $data);
      $this->db->delete('uraian', ['id_uraian' => $db['id_uraian']]);
    }

    if (count($inserturaian) != 0) {
      $this->db->insert_batch('uraian_hapus', $inserturaian);
    }
    // AKHIR URAIAN

    // HAPUS PEKERJAAN
    $data_pekerjaan = $this->db->get_where('pekerjaan', ['idtkmdiv' => $idtkmdiv])->result_array();
    $this->db->delete('pekerjaan_lintasdivisi', ['idtkmdiv' => $idtkmdiv]);
    $insertpekerjaan = [];
    foreach ($data_pekerjaan as $key => $db) {
      $data = $db;
      $data['alasan'] = $alasan;
      array_push($insertpekerjaan, $data);
      $this->db->delete('pekerjaan', ['no' => $db['no']]);
    }

    if (count($insertpekerjaan) != 0) {
      $this->db->insert_batch('pekerjaan_hapus', $insertpekerjaan);
    }
    // AKHIR PEKERJAAN

    // HAPUS TKMDIVISI
    $data_tkmdiv = $this->db->get_where('tkmdivisi', ['no' => $idtkmdiv])->row_array();
    $data_tkmdiv['alasan'] = $alasan;
    $this->db->insert('tkmdivisi_hapus', $data_tkmdiv);
    $this->db->delete('tkmdivisi', ['no' => $data_tkmdiv['no']]);
    // AKHIR TKMDIVISI
  }


  // Simpan Tambah TKM 2
  public function simpantargetkerjadiv2()
  {

    $idtkm  = $this->input->post('idtkmdiv');

    $this->db->query("UPDATE tkmdivisi SET status='Menunggu Approval' WHERE no='$idtkm'");

    $jmlproject     = (int)$this->input->post('jmlproject');
    $jmlproject_before     = (int)$this->input->post('jmlproject_before');

    $mulai = $jmlproject_before + 1;


    for ($i = $mulai; $i <= $jmlproject; $i++) {
      $propro    = $this->input->post("project$i");
      $cut = explode("_" , $propro);
      $project = $cut[0];
      $deskripsi  = $this->input->post("deskripsi$i");
      // $persentase = $this->input->post("persentase$i");
      $kategori = $this->input->post("kategori$i");
      $tambahan = "yes";
     

      // echo ($project);
      // echo ($deskripsi);
      // // echo ($persentase);
      // echo ($kategori);

      // if ($project != '' and ($persentase != 0 or $persentase != '' or $persentase != null)) {
       if ($project != '' ) {

        $data1 = [
          'idtkmdiv' => $idtkm,
          'project' => $project,
          'deskripsi' => $deskripsi,
          // 'persentase' => $persentase,
          'id_kategori' => $kategori,
          'tambahan' => $tambahan,
        ];

        // var_dump($data1);
        $this->db->insert('pekerjaan', $data1);

        // INSERT URAIAN
        $pekerjaan = $this->db->get_where('pekerjaan', $data1)->row_array();
        $banyakuraian = $this->input->post("uraiannew$i");
        $targetselesai = $this->input->post("target$i");


        $idlist = $this->input->post("idlist$i");
        $insert = [];
        // var_dump("LOLOS LOLOS");
        // var_dump(count($banyakuraian));

        for ($x = 0; $x < count($banyakuraian); $x++) {
          if ($banyakuraian[$x] != '') {
            $datainsert = [
              'id_tkmdiv' => $idtkm,
              'id_pekerjaan' => $pekerjaan['no'],
              'uraian' => $banyakuraian[$x],
              'id_list' => $idlist[$x],
              'bobotpersentase' => 0,
              'targetselesai' => $targetselesai[$x]
            ];

            array_push($insert, $datainsert);
          }
          $id_list = $idlist[$x];
            $this->db->query("UPDATE list_note SET to_tkm = 'Y' WHERE id='$id_list'");
        }

        if (count($banyakuraian) != 0) {
          $this->db->insert_batch('uraian', $insert);
        }
        // AKHIR
      }

      //   LINTAS DIVISI
      $banyakdivisi = $this->input->post("divisi$i");
      for ($x = 0; $x < count($banyakdivisi); $x++) {
        if ($banyakdivisi[$x] != '') {
          $insertdivisi = [
            'no' => $pekerjaan['no'],
            'idtkmdiv' => $idtkm,
            'project'  => $prapro,
            'deskripsi' => $prades,
            'persentase' => $praper,
            'id_kategori' => $prakategori,
            'divisi' => $banyakdivisi[$x],
            'daritanggal' => $daritanggal,
            'sampaitanggal' => $sampaitanggal,
          ];

          $true = $this->db->get_where('pekerjaan_lintasdivisi', $insertdivisi)->row_array();
          if (count($true) == 0) {
            $this->db->insert('pekerjaan_lintasdivisi', $insertdivisi);
          }
        }
      }
      // INSERT LINTAS DIVISI
      $banyakdivisi = $this->input->post("divisinew$i");
      $insert = [];
      // var_dump("LOLOS LOLOS DIVISI NEW");
      // var_dump(count($banyakdivisi));
      for ($x = 0; $x < count($banyakdivisi); $x++) {
        if ($banyakdivisi[$x] != '') {
          $datainsert = [
            'no' => $pekerjaan['no'],
            'idtkmdiv' => $idtkm,
            'project' => $project,
            'deskripsi' => $deskripsi,
            'persentase' => $persentase,
            'id_kategori' => $kategori,
            'divisi' => $banyakdivisi[$x],
            'daritanggal' => $daritanggal,
            'sampaitanggal' => $sampaitanggal,
          ];

          array_push($insert, $datainsert);
        }
      }

      if (count($banyakdivisi) != 0) {
        $this->db->insert_batch('pekerjaan_lintasdivisi', $insert);
      }
      // AKHIR

    }
    // die();
  }
  // Simpan tambah tkm div 2

  public function updatePekerjaanSelesai($id)
  {
    $this->db->set('is_finish', 1)->where('no', $id)->update('pekerjaan');
  }

  public function cancelrotasi($id, $type){
    return $this->db->query("UPDATE tb_rotasi set kondisi='$type' where id='$id' ");
  }

  public function submit_rentang()
  {
    date_default_timezone_set('Asia/Jakarta');

    $no = $this->input->post('no_meet');
    $daritanggal = $this->input->post('daritanggal');
    $sampaitanggal = $this->input->post('sampaitanggal');
    $divisi = $this->session->userdata('ses_divisi');

    $waktu = date('Y-m-d H:i:s');

    $user = $this->db->get_where('absensi_meeting', array('id_meeting' => $no))->result_array();

    $data = [ 'daritanggal' => $daritanggal,
              'sampaitanggal' => $sampaitanggal
            ];
    $this->db->where('no', $no);
    $this->db->update('meeting_tkm', $data);

    foreach ($user as $key) {
      $jabatan = $this->db->get_where('tb_user', array('id_user' => $key['username']))->row_array();

    if ($jabatan['hak_akses'] != 'Manager') {
   
    $data = [ 'post' => 'Yes',
            ];
    $this->db->where('no', $key['no']);
    $this->db->update('absensi_meeting', $data); 
    }     
    // $cariid = $this->db->query("SELECT no FROM tkmdivisi ORDER BY no DESC LIMIT 1")->row_array();
    // $idtkm  = $cariid['no'] + 1;
    //   $rentang = ['no' => $idtkm,
    //               'divisi' => $divisi,
    //               'pengisi' => $key['username'],
    //               'daritanggal' => $daritanggal,
    //               'sampaitanggal' => $sampaitanggal,
    //               'status'=> 'Menunggu Approval',
    //               'tanggalisi' => $waktu
    //               ];
    //   $this->db->insert('tkmdivisi', $rentang);
    }
    var_dump($user);
  }

  public function getname_divisi()
  {
    $divisi = $_POST['divisi'];

    return $this->db->get_where('tb_user', ['divisi' => $divisi])->result_array();
  }
}
