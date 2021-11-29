<style type="text/css">
  #regiration_form fieldset:not(:first-of-type) {
    display: none;
  }

  html {
        scroll-behavior: smooth;
    }
  </style>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <!-- <h1>Target Kerja</h1> -->
      <h1></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item active">Harian</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
    <!-- <div class="card">
              <div class="card-header">
              <div class="row" style="width: 100%;" >
                  <div class="col-sm-12">
                  <h5>Progress end to end</h5>
                </div>
                  <div class="col-sm-12">
                    <div class="progress">
                      <?php $username = $this->session->userdata('ses_username');
                       $cek = $this->db->get_where('progress_bar', array('username' => $username))->row_array(); ?>
                      <div class="progress-bar" role="progressbar" data-width="<?= $cek['persentase'] ?>%" aria-valuenow="<?= $cek['persentase'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $cek['persentase'] ?>%</div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
    <?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');

    $tanggalnow = date('d-m-Y', strtotime($tanggalSelected)); // Tanggal dari controller
    //$tanggalnow = date('d-m-Y');
    $namahari   = date('D', strtotime($tanggalnow));

    $hariini = date('D', strtotime($tanggalSelected));

    $username = $this->session->userdata('ses_username');

    $date = new DateTime();
                    $date->modify('next monday');
                    $mon = $date->format('Y-m-d');
    // echo $mon;    
        $cek = $this->db->query("SELECT * FROM tkmdivisi WHERE pengisi='$username' AND daritanggal <= '$mon' AND sampaitanggal>='$mon'")->row_array();

    ?>

    <div class="section-body">
      <h2 class="section-title">Laporan Kerja Harian</h2>

      <div class="card card-primary">
        <div class="card-header">
          <!-- <?php if($caritarget != NULL){ ?>
            <a href="<?= base_url('mingguan/perpanjang') ?>" class="btn btn-warning">Pengajuan Perpanjang Target Selesai</a>
          <?php } ?> -->
          <!-- <h4>TKM <?php echo $this->session->userdata('ses_nama'); ?> 20-04-2020 s/d 24-04-2020</h4> -->
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="list-unstyled list-unstyled-border mt-4">
            <?php
            $no =1;
            foreach ($caritarget as $key) :
              if ($key['persentase'] < 100) :

              $targetselesai = $key['targetselesai'];
            ?>
                <div class="media">
                  <!-- <div class="media-icon"><i class="far fa-circle"></i></div> -->
                  <div class="media-icon"><?= $no++."."; ?></div>

                  <div class="media-body">
                    <div class="row">
                      <div class="col-sm-12"><h6><?php echo $key['project']; ?></h6></div>
                      <?php if ($key['targetselesai'] != '0000-00-00') {
                        ?>
                      <!-- <div class="col-sm-6 text-right"><h6>Target Selesai : <?php echo date('d M Y', strtotime($targetselesai)); ?></h6></div> -->
                    <?php } ?>
                    </div>
                    <div class="progress mb-3">
                      <div class="progress-bar" role="progressbar" data-width="<?php echo $key['persentase'] ?>%" aria-valuenow="<?php echo $key['persentase'] ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $key['persentase'] ?>%</div>
                    </div>
                    <p><?php echo $key['deskripsi'] ?></p>
                  </div>
                </div>
                </br>
            <?php
              endif;
            endforeach;
            ?>
          </div>
        </div>
        <div class="card-footer">
          <b><span class="font-weight-bold text-warning">Keterangan :</span> Progress persentase diatas merupakan persentase sejauh mana penyelesaian Project/Program/Pekerjaan.</b>
        </div>
      </div>
    </div>

    <!-- ARRAY RINCIAN -->
    <?php $rincian1 = [];
    // var_dump($rincian);
    foreach ($rincian as $db) {
      $key = $db['id_tkmstaff'];
      if (array_key_exists("$key", $rincian1)) {
        array_push($rincian1[$key], $db);
      } else {
        $rincian1[$key][] = $db;
      }
    } ?>
    <!-- ARRAY RINCIAN -->

    <!-- ARRAY TUGAS HARIAN -->
    <?php $tugas = [];
    $riwayatharian = [];
    foreach ($tugasharianfull as $db) {
      $key = $db['tanggal'] . '/' . $db['id_rincian'];
      $kunci = $db['tanggal'];
      //var_dump($kunci);

      $tugas[$key] = $db;

      if (array_key_exists("$kunci", $riwayatharian)) {
        array_push($riwayatharian[$kunci], $db);
      } else {
        $riwayatharian[$kunci][] = $db;
      }
    } ?>
    <!-- ARRAY TUGAS HARIAN -->



    <div class="row">
      <!--<div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Limit koreksi anda: <?= $totalLIMIT; ?></h4>
                </div>
              </div>
          </div>-->
    </div>




    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card" id="tanggalAtas">
          <div class="card-header">
            <h4><?php echo $namahari . ', ' . $tanggalnow; ?></h4>
            <div class="card-header-action">
              <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#">
                <?php
                if (array_key_exists(date('Y-m-d'), $riwayatharian) == false) {
                  echo "<i class='fas fa-plus'></i> Isi";
                } else {
                  echo "<i class='fas fa-eye'></i> View";
                }
                ?>
              </a>
            </div>
          </div>
          <div class="collapse show" id="mycard-collapse">
            <div class="card-body">

              <?php
              //if(array_key_exists(date('Y-m-d'), $riwayatharian)==false){ //KODE LAMA
              $cekTimesheet = array_key_exists(date('Y-m-d', strtotime($tanggalnow)), $riwayatharian);
              if ($cekTimesheet == false or $cekTimesheet == true) {
              ?>
                <form action="<?php echo base_url('harian/isiharian2') ?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="Tanggal">Tanggal :</label>
                    <select class="form-control tanggalWFH" name="tanggal" id="tanggalSelected">
                      <!--option selected value="<php echo date('Y-m-d')?>"><php echo date('d-m-Y');?></option-->
                      <option selected value="<?= $tanggalSelected ?>" style="display:none;"><?= $tanggalnow ?></option>
                      <?php

                      $waktusekarang = date('Y-m-d H:i');
                      $waktubuatra = date('Y-m-d 12:00');
                      $hari = date('D');
                      $tanggalharini = $tanggalSelected; //date('Y-m-d');
                      $tanggalkemarin = date('Y-m-d', strtotime("-1 days"));

                      $name = $this->db->get_where('tb_user', ['id_user' => $username])->row_array();

                      $db2 = $this->load->database('database_kedua', TRUE);
                      $tglLibur = $db2->select('tanggal')->from('kalender')->where_in('tanggal', $tanggalharini)->get()->row_array();

                      if ($this->session->userdata('ses_divisi') == 'RE B1' or $this->session->userdata('ses_divisi') == 'RE B2' or $this->session->userdata('ses_divisi') == 'ITDP' or $this->session->userdata('ses_divisi') == 'ALL AROUND' or $this->session->userdata('ses_divisi') != '') {
                        // if($hari == 'Sat' OR $hari == 'Sun'){
                        //   echo "";
                        // }else{
                        //if($waktusekarang <= $waktubuatra){
                        // TAMBAHAN BARU ADAM SANTOSO


                        $tanggalHmin30 = true; // ubah jadi true/false agar fitur untuk pilih tanggal sampai H-30 aktif/non-aktif
                        if ($bisaUpdate) { // Ambil dari controller

                          if ($tanggalHmin30 AND $name['izinbackdate'] == '1') {

                            if ($bisaPilihTgl) {
                              // $tglAkhir = new DateTime(date('Y-m-d', strtotime("-1 month")));
                              $tglAkhir = new DateTime(date('Y-m-d', strtotime("-15 day")));
                              $tglAwal = new DateTime(date('Y-m-d', strtotime("+1 day")));
                              $jarakTgl = DateInterval::createFromDateString('1 day');
                              $period = new DatePeriod($tglAkhir, $jarakTgl, $tglAwal);
                              $daftarTgl = array();
                              $daftarTgl2 = array();
                              foreach ($period as $dt) {
                                $daftarTgl[] = $dt->format("Y-m-d D");
                              }
                              $daftarTgl = array_reverse($daftarTgl);
                              foreach ($daftarTgl as $dt) {

                                $tanggal = substr($dt, 0, 10);
                                $hari = substr($dt, -3);
                                $cekTglLibur = $db2->select('tanggal')->from('kalender')->where_in('tanggal', $tanggal)->get()->row_array();

                                if (!$cekTglLibur) {
                                  if ($hari != 'Sat' and $hari != 'Sun') {
                                    echo '<option value="' . date('Y-m-d', strtotime($dt)) . '">' . date('d-m-Y', strtotime($dt)) . '</option>';
                                  }
                                }
                              }
                            } else {
                              if ($waktusekarang <= $waktubuatra) {
                                if ($tanggalSelected == $tanggalkemarin) {
                                  echo '<option value="' . $tanggalharini . '">' . date('d-m-Y', strtotime($tanggalharini)) . '</option>';
                                } else {
                                  echo '<option value="' . $tanggalkemarin . '">' . date('d-m-Y', strtotime($tanggalkemarin)) . '</option>';
                                }
                              }
                            }
                          } else {
                            $tglLibur = $db2->select('tanggal')->from('kalender')->where_in('tanggal', $tanggalharini)->get()->row_array();
                            if ($waktusekarang <= $waktubuatra) {
                              if ($tanggalSelected == $tanggalkemarin) {
                                echo '<option value="' . $tanggalharini . '">' . date('d-m-Y', strtotime($tanggalharini)) . '</option>';
                              } else {
                                echo '<option value="' . $tanggalkemarin . '">' . date('d-m-Y', strtotime($tanggalkemarin)) . '</option>';
                              }
                            }
                          }

                          // =====
                        } else {
                          echo "";
                        }

                        //}
                      } else {
                        echo "";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="table-responsive">
                     <table class="table table-bordered" style="table-layout: auto; word-wrap: break-word; width: 100%;">
                       <thead>
                         <tr>
                           <th style="width: 5%">No</th>
                           <th style="width: 50%">Project/Program/Pekerjaan</th>
                           <!-- <th style="width: 25%">Keterangan</th> -->
                           <th style="width: 5%">File<br> Upload</th>
                           <th style="width: 23%">Status</th>
                           <th style="min-width: 165px">Persentase</th>
                         </tr>
                       </thead>
                       <tbody id="barislkh">
                        <?php 
                        if ($caritarget == NULL) { ?>
                          <tr class="text-center">
                            <td colspan="6">Data Tidak Tersedia</td>
                          </tr>
                        <?php } else { ?>
                     
                  <ul>
                  
                  
                

                    <?php
                    $i = 0;
                    if ($cekTimesheet == true) {
                      $jum = count($caritarget);
                      foreach ($caritarget as $cp) {
                        $i++;
                          $key = $cp['no'];
                            $ulang = 0;
                            array_key_exists("$key", $rincian1);
                            // var_dump(count($rincian1[$key]));
                            $rownya = count($rincian1[$key]);
                      
                    ?>
                   
                        <input type="hidden" name="idtkmdiv<?php echo $i ?>" value="<?php echo $cp['idtkmdiv'] ?>">
                        <!-- <li>
                          <div class="row">
                            <div class="col-sm-10">
                              <div class="form-group">
                                <label for="project<?php echo $i; ?>"><?= $i; ?>. Project/Program/Pekerjaan :</label> -->
                                <!-- <tr> -->
                                  <!-- <td rowspan="<?= $rownya ?>"><?= $i; ?></td> -->
                                  <!-- <td><?= $i; ?></td> -->
                                  <!-- <td style="display: none;"> -->
                                    <?php 
                                    // echo $cp['project'] ?>
                                <input type="hidden" class="form-control" id="project<?php echo $i; ?>" name="project<?php echo $i; ?>" value="<?php echo $cp['project'] ?>" readonly>
                                <input type="hidden" class="form-control" id="kode_project<?php echo $i; ?>" name="kode_project<?php echo $i; ?>" value="<?php echo $cp['no'] ?>" readonly>
                                <!-- </td> -->
                                
                              <!-- </div>
                            </div>
                          </div> -->

                          <!-- RINCIAN -->
                          <!-- <ul> -->
                            <?php $key = $cp['no'];
                            $ulang = 0;
                            if (array_key_exists("$key", $rincian1)) : ?>
                              <?php foreach ($rincian1[$key] as $xy) : 
                                if($xy['targetpersen'] < 100) :
                                  $ulang++;

                                $uraian = $this->db->query("SELECT id_uraian FROM uraian WHERE uraian = '$xy[rincian]'")->row_array();
                                $targetselesai = $xy['targetselesai'];
                                $tglinput = $this->uri->segment('3');
                                $datenow = date('Y-m-d');
                                // echo $tglinput;
                                $harian = $this->db->query("SELECT * FROM tugasharian WHERE id_rincian = '$xy[id_rincian]' AND (tanggal='$tglinput' OR tanggal='$datenow')")->row_array();
                                // var_dump($harian);
                                 ?>
                                <!-- <li> -->
                                 
                                  <!-- <div class="row "> -->

                                    <div class="col-sm-10" style="display: none;">
                                      <div class="form-group">
                                        <label for="rinciantext<?php echo $i; ?><?= $ulang ?>">Rincian Pekerjaan :</label>
                                        <input type="text" class="form-control" id="rinciantext<?php echo $i; ?><?= $ulang ?>" name="rinciantext<?php echo $i; ?><?= $ulang ?>" value="<?php echo $ulang . '. ' . $xy['rincian'] ?>" readonly data-trigger="hover" data-toggle="popover" data-placement="top" title="Tanggal Target Selesai" data-content=" <?php echo date('d M Y', strtotime($targetselesai)); ?>">
                                        <input type="hidden" class="form-control" id="rincian<?php echo $i; ?><?= $ulang ?>" name="rincian<?php echo $i; ?><?= $ulang ?>" value="<?php echo $xy['id_rincian'] ?>">

                                        <input type="hidden" class="form-control" id="uraian<?php echo $i; ?><?= $ulang ?>" name="uraian<?php echo $i; ?><?= $ulang ?>" value="<?php echo $uraian['id_uraian'] ?>">
                                      </div>
                                    </div>

                                    <!-- <div class="col-sm-10">
                                      <div class="form-group">
                                        <label for="keterangan<?php echo $i; ?><?= $ulang ?>">Keterangan :</label> -->
                                        <tr>
                                        <td ><?= $i; ?></td>
                                        <td>
                                          <strong><?php echo $cp['project'] ?></strong><br>
                                        <?php if ($xy['status'] == 'Menjadi Kasus') {
                                          ?>
                                        <textarea type="text" class="form-control my-3" id="keterangan<?php echo $i; ?><?= $ulang ?>" name="keterangan<?php echo $i; ?><?= $ulang ?>" readonly data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" title="Tanggal Target Selesai" data-content=" <?php echo date('d M Y', strtotime($targetselesai)); ?><br> <b>Uraian :</b> <?= $xy['rincian'] ?>" row="4" ><?= $harian['keterangan'] ?></textarea>
                                      <?php } else { ?>
                                        <textarea type="text" class="form-control my-3" id="keterangan<?php echo $i; ?><?= $ulang ?>" name="keterangan<?php echo $i; ?><?= $ulang ?>" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" title="Tanggal Target Selesai" data-content=" <?php echo date('d M Y', strtotime($targetselesai)); ?><br> <b>Uraian :</b> <?= $xy['rincian'] ?>" row="4" ><?= $harian['keterangan'] ?></textarea>
                                      <?php } ?>
                                    </td>
                                      <!-- </div>
                                    </div> -->

                                    <!-- <div class="col-sm-10">
                                      <div class="form-group"> -->
                                        <td>
                                        <!-- <label for="fileupload<?php echo $i; ?><?= $ulang ?>">File Upload</label> -->
                                        <?php if ($xy['status'] == 'Menjadi Kasus') {
                                          ?>
                                        <input type="file" class="form-control" id="fileupload<?php echo $i; ?><?= $ulang ?>" name="fileupload<?php echo $i; ?><?= $ulang ?>" accept="image/*" readonly>
                                      <?php } else { ?>
                                        <input type="file" class="form-control" id="fileupload<?php echo $i; ?><?= $ulang ?>" name="fileupload<?php echo $i; ?><?= $ulang ?>" accept="image/*">
                                      <?php } ?>
                                      </td>
                                      <!-- </div>
                                    </div> -->

                                    <!-- <div class="col-sm-10">
                                      <div class="form-group">
                                        <label for="status<?php echo $i; ?><?= $ulang ?>">Status</label>
                                        <div class="input-group"> -->
                                          <td>
                                           <?php if ($xy['status'] == 'Menjadi Kasus') {
                                          ?>
                                          <select class="form-control" name="status<?php echo $i; ?><?= $ulang ?>" id="status<?php echo $i; ?><?= $ulang ?>" disabled>
                                            <?php } else { ?>
                                              <select class="form-control" name="status<?php echo $i; ?><?= $ulang ?>" id="status<?php echo $i; ?><?= $ulang ?>" onchange="cekStatus('<?php echo $i; ?>', '<?= $ulang ?>', '<?= $xy['targetpersen']; ?>');">
                                                <?php } ?>
                                            <option value="">--Pilih Status--</option>
                                            <option <?php if ($harian['status'] == 'Berprogress') { echo "selected"; } ?> value="Berprogress">Berprogress</option>
                                            <option <?php if ($harian['status'] == 'Menjadi Kasus') { echo "selected"; } ?> value="Menjadi Kasus">Menjadi Kasus</option>
                                            <option <?php if ($harian['status'] == 'Done 100%') { echo "selected"; } ?> value="Done 100%">Done 100%</option>
                                          </select>
                                          </td>
                                        <!-- </div>
                                      </div>
                                    </div> -->

                                    <!-- <div class="col-sm-10">
                                      <div class="form-group">
                                        <label for="persen<?php echo $i; ?><?= $ulang ?>">Persentase</label> -->
                                        <td>
                                        <div class="input-group row">
                                          <?php if ($xy['status'] == 'Menjadi Kasus') {
                                          ?>
                                          <input type="number" class="form-control" id="persen<?php echo $i; ?><?= $ulang ?>" name="persen<?php echo $i; ?><?= $ulang ?>" max="100" min="<?= $xy['targetpersen']; ?>" value="<?= $xy['targetpersen']; ?>" readonly>
                                        <?php } else { ?>
                                          <input type="number" class="form-control" id="persen<?php echo $i; ?><?= $ulang ?>" name="persen<?php echo $i; ?><?= $ulang ?>" max="100" min="<?= $xy['targetpersen']; ?>" value="<?= $xy['targetpersen']; ?>" onchange="cekPersen('<?php echo $i; ?>', '<?= $ulang ?>', '<?= $xy['targetpersen']; ?>');" onkeyup="cekKeyPersen('<?php echo $i; ?>', '<?= $ulang ?>', '<?= $xy['targetpersen']; ?>');">
                                        <?php } ?>
                                          <div class="input-group-append">
                                            <div class="input-group-text">
                                              <i class="fas fa-percent"></i>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                      <!-- </div>
                                    </div> -->

                             <!--      </div>
                              
                                </li> -->
                              <?php
                               endif; 
                              endforeach; ?>

                              <!-- BANNYAK NYA RINCIAN SETIAP PEKERJAAn-->
                              <input type="hidden" name="jmlrincian<?= $i ?>" id="jmlrincian<?= $i ?>" value="<?= $ulang ?>">
                              <!-- BANNYAK NYA RINCIAN SETIAP PEKERJAAn-->

                            <?php else : ?>
                              <li>Rincian Pekerjaan Tidak Tersedia</li>
                            <?php endif ?>
                          <!-- </ul> -->
                          <!-- AKHIR RINCIAN -->

                        </li>
                        <!-- <?php if ($i > 1) { ?>
                         <a href="#tanggalAtas" type="button" name="previous" class="previous btn btn-secondary">Previous</a>
                       <?php } 
                          if ($i < $jum) { ?>
                          <a href="#tanggalAtas" type="button" name="password" class="next btn btn-primary">Next</a>
                        <?php } ?>
                        </fieldset> -->
                        <?php
                        $jml_i = $i;
                        $jml_ulang = $ulang;
                         
                         ?>
                        <!-- <hr> -->
                      <!-- </tr> -->
                      <?php
                      }
                      ?>

                      <?php
                    } else {
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

                      $var = date('N', strtotime($tanggalnow));
                      $awal = $var - 1;
                      $akhir = 5 - $var;

                      $senin = date('Y-m-d', strtotime("-$awal days", strtotime($tanggalnow)));
                      $jumat = date('Y-m-d', strtotime("+$akhir days", strtotime($tanggalnow)));

                      $dari       = $senin;
                      $sampai     = $jumat;


                      $username = $this->session->userdata('ses_username');

                      $caritarget = $this->db->query("SELECT
                      a.*,
                      d.deskripsi
                    FROM
                      tkmstaff a
                    JOIN tkmdivisi b ON a.idtkmdiv = b.no
                    LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                    WHERE
                      a.userstaff = '$username'
                    AND a.persentase < 100 
                    

                    ")->result_array();

                      $jum = count($caritarget);
                      // echo $jum;
                      foreach ($caritarget as $cp) {
                        $i++;
                        $key = $cp['no'];
                            $ulang = 0;
                            array_key_exists("$key", $rincian1);
                            // var_dump(count($rincian1[$key]));
                            $rownya = count($rincian1[$key]);
                      ?>
                        <!-- <?php if ($i == 1) { ?>
                          <fieldset>
                        <?php } else { ?>
                          <fieldset style="display: none;">
                        <?php } ?> -->
                        <input type="hidden" name="idtkmdiv<?php echo $i ?>" value="<?php echo $cp['idtkmdiv'] ?>">

                        <!-- <li>
                          <div class="row">
                            <div class="col-sm-10">
                              <div class="form-group">
                                <label for="project<?php echo $i; ?>"><?= $i; ?>. Project/Program/Pekerjaan :</label> -->
                                <!-- <tr> -->
                                  <!-- <td rowspan="<?= $rownya ?>"><?= $i; ?></td> -->
                                  <!-- <td ><?= $i; ?></td> -->
                                  <!-- <td style="display: none;"> -->
                                    <?php 
                                    // echo $cp['project'] ?>
                                <input type="hidden" class="form-control" id="project<?php echo $i; ?>" name="project<?php echo $i; ?>" value="<?php echo $cp['project'] ?>" readonly>
                                 <input type="hidden" class="form-control" id="kode_project<?php echo $i; ?>" name="kode_project<?php echo $i; ?>" value="<?php echo $cp['no'] ?>" readonly>
                               <!-- </td> -->
                              <!-- </div>
                            </div>
                          </div> -->

                          <!-- RINCIAN -->
                          <!-- <ul> -->
                            <?php $key = $cp['no'];
                            $ulang = 0;
                            if (array_key_exists("$key", $rincian1)) : ?>
                              <?php foreach ($rincian1[$key] as $xy) : 
                                 if($xy['targetpersen'] < 100) : 
                                  $ulang++;
                                $uraian = $this->db->query("SELECT id_uraian FROM uraian WHERE uraian = '$xy[rincian]'")->row_array();
                                $targetselesai = $xy['targetselesai']; ?>
                                <!-- <li>
                                  
                                  <div class="row"> -->

                                    <div class="col-sm-10" style="display: none;">
                                      <div class="form-group">
                                        <label for="rinciantext<?php echo $i; ?><?= $ulang ?>">Rincian Pekerjaan :</label>
                                        <input type="text" class="form-control" id="rinciantext<?php echo $i; ?><?= $ulang ?>" name="rinciantext<?php echo $i; ?><?= $ulang ?>" value="<?php echo $ulang . '. ' . $xy['rincian'] ?>" readonly data-trigger="hover" data-toggle="popover" data-placement="top" title="Rincian Pekerjaan" data-content="<?php echo $ulang . '. ' . $xy['rincian'] ?>">
                                        <input type="hidden" class="form-control" id="rincian<?php echo $i; ?><?= $ulang ?>" name="rincian<?php echo $i; ?><?= $ulang ?>" value="<?php echo $xy['id_rincian'] ?>">

                                        <input type="hidden" class="form-control" id="uraian<?php echo $i; ?><?= $ulang ?>" name="uraian<?php echo $i; ?><?= $ulang ?>" value="<?php echo $uraian['id_uraian'] ?>">
                                      </div>
                                    </div>

                                   <!--  <div class="col-sm-10">
                                      <div class="form-group">
                                        <label for="keterangan<?php echo $i; ?><?= $ulang ?>">Keterangan :</label> -->
                                        <tr>
                                        <td ><?= $i; ?></td>
                                        <td>
                                          <strong><?php echo $cp['project'] ?></strong><br>
                                          
                                        <?php if ($xy['status'] == 'Menjadi Kasus') {
                                          ?>
                                        <textarea type="text" class="form-control my-3" id="keterangan<?php echo $i; ?><?= $ulang ?>" name="keterangan<?php echo $i; ?><?= $ulang ?>" readonly data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" title="Tanggal Target Selesai" data-content=" <?php echo date('d M Y', strtotime($targetselesai)); ?><br> <b>Uraian :</b> <?= $xy['rincian'] ?>" row="4"></textarea>
                                      <?php } else { ?>
                                        <textarea type="text" class="form-control my-3" id="keterangan<?php echo $i; ?><?= $ulang ?>" name="keterangan<?php echo $i; ?><?= $ulang ?>" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="top" title="Tanggal Target Selesai" data-content=" <?php echo date('d M Y', strtotime($targetselesai)); ?><br> <b>Uraian :</b> <?= $xy['rincian'] ?>" row="4"></textarea>
                                      <?php } ?>
                                    </td>
                                      <!-- </div>
                                    </div> -->

                                    <!-- <div class="col-sm-10">
                                      <div class="form-group">
                                        <label for="fileupload<?php echo $i; ?><?= $ulang ?>">File Upload</label> -->
                                        <td>
                                        <?php if ($xy['status'] == 'Menjadi Kasus') {
                                          ?>
                                        <input type="file" class="form-control" id="fileupload<?php echo $i; ?><?= $ulang ?>" name="fileupload<?php echo $i; ?><?= $ulang ?>" accept="image/*" disabled>
                                      <?php } else { ?>
                                        <input type="file" class="form-control" id="fileupload<?php echo $i; ?><?= $ulang ?>" name="fileupload<?php echo $i; ?><?= $ulang ?>" accept="image/*">
                                      <?php } ?>
                                    </td>
                                      <!-- </div>
                                    </div> -->

                                    <!-- <div class="col-sm-10">
                                      <div class="form-group">
                                        <label for="status<?php echo $i; ?><?= $ulang ?>">Status</label>
                                        <div class="input-group"> -->
                                          <td>
                                          <?php if ($xy['status'] == 'Menjadi Kasus') {
                                          ?>
                                          <select class="form-control" name="status<?php echo $i; ?><?= $ulang ?>" id="status<?php echo $i; ?><?= $ulang ?>" disabled>
                                            <?php } else { ?>
                                              <select class="form-control" name="status<?php echo $i; ?><?= $ulang ?>" id="status<?php echo $i; ?><?= $ulang ?>" onchange="cekStatus('<?php echo $i; ?>', '<?= $ulang ?>', '<?= $xy['targetpersen']; ?>');">
                                                <?php } ?>
                                            <option value="">--Pilih Status--</option>
                                            <option value="Berprogress">Berprogress</option>
                                            <option value="Menjadi Kasus">Menjadi Kasus</option>
                                            <option value="Done 100%">Done 100%</option>
                                          </select>
                                        </td>
                                        <!-- </div>
                                      </div>
                                    </div> -->

                                    <!-- <div class="col-sm-10">
                                      <div class="form-group">
                                        <label for="persen<?php echo $i; ?><?= $ulang ?>">Persentase</label> -->
                                          <td>
                                        <div class="input-group row"> 

                                          <?php if ($xy['status'] == 'Menjadi Kasus') {
                                          ?>
                                          <input type="number" class="form-control" id="persen<?php echo $i; ?><?= $ulang ?>" name="persen<?php echo $i; ?><?= $ulang ?>" max="100" min="<?= $xy['targetpersen']; ?>" value="<?= $xy['targetpersen']; ?>" readonly>
                                        <?php } else { ?>
                                          <input type="number" class="form-control" id="persen<?php echo $i; ?><?= $ulang ?>" name="persen<?php echo $i; ?><?= $ulang ?>" max="100" min="<?= $xy['targetpersen']; ?>" value="<?= $xy['targetpersen']; ?>" onchange="cekPersen('<?php echo $i; ?>', '<?= $ulang ?>', '<?= $xy['targetpersen']; ?>');" onkeyup="cekKeyPersen('<?php echo $i; ?>', '<?= $ulang ?>', '<?= $xy['targetpersen']; ?>');">
                                        <?php } ?>
                                          <div class="input-group-append">
                                            <div class="input-group-text">
                                              <i class="fas fa-percent"></i>
                                            </div>
                                          </div>
                                        </div>
                                        </td>
                                      </tr>

                                      <!-- </div>
                                    </div> -->

                                  <!-- </div> -->
                                
                                <!-- </li> -->
                              <?php 
                            endif; 
                          endforeach; ?>

                              <!-- BANNYAK NYA RINCIAN SETIAP PEKERJAAn-->
                              <input type="hidden" name="jmlrincian<?= $i ?>" id="jmlrincian<?= $i ?>" value="<?= $ulang ?>">
                              <!-- BANNYAK NYA RINCIAN SETIAP PEKERJAAn-->

                            <?php else : ?>
                              <li>Rincian Pekerjaan Tidak Tersedia</li>
                            <?php endif ?>
                          </ul>
                          <!-- AKHIR RINCIAN -->
                        <!-- </tr> -->
                        <!-- </li> -->
                        <!-- <?php if ($i > 1) { ?>
                         <a href="#tanggalAtas" type="button" name="previous" class="previous btn btn-secondary">Previous</a>
                       <?php } 
                          if ($i < $jum) { ?>
                          <a href="#tanggalAtas" type="button" name="password" class="next btn btn-primary">Next</a>
                        <?php } ?>
                        </fieldset> -->
                        <!-- <hr> -->
                      <!-- </tr> -->
                    <?php
                        
                      }
                    } 

                    ?>
                  </ul>
                <?php } ?>
                  </tbody>
                   </table>
                   </div>

                    <br>
                    <br>

                  <input type="hidden" name="jmlpro" id="jmlpro" value="<?php echo $i; ?>">

                  <div class="form-group">
                    <?php
                    //if($waktusekarang >= $waktubuatra){
                    if ($tglLibur != true and $hari != 'Sun') { // CEK APAKAH SEKARANG BUKAN HARI MINGGU ATAU BUKAN HARI LIBUR ???

                      if ($cekTimesheet == true) { // CEK APAKAH SUDAH PERNAH ISI TIMESHEET ???
                        echo '
                            <div class="form-group">
                                <label for="keterangan_koreksi">Keterangan Koreksi :</label>
                                <input type="text" class="form-control" id="keterangan_koreksi" name="keterangan_koreksi" required>
                            </div>

                            <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>';
                      } else {
                          if ($cek == NULL AND $hariini == 'Fri') {
                            echo '<button type="submit" id="submit_tbl" class="btn btn-danger" title="Anda belum membuat TKM untuk minggu depan. Harap isi TKM terlebih dahulu, selanjutnya Anda dapat mengisi LKH untuk hari ini!"  disabled >Submit</button>';

                          } else {
                            echo '<button type="submit" id="submit_tbl" class="btn btn-success">Save</button>';
                          }
                      }
                    } ?>
                  </div>

                  <div class="m-3 text-justify">
                        <p ><span class="font-weight-bold">Note : </span> Jika Status pada laporan kerja harian 'Menjadi Kasus' maka form menjadi disable, harus ada proses diskusi terlebih dahulu dengan tim/atasan/management, baru dapat melanjutkan pengisian progress TKM.</p>
                  </div>

                </form>
              <?php
              }  // END CHECK ARRAY ESISTS
              //  else{ // KODE LAMA
              if ($cekTimesheet == true) {
                echo '<h5>Timesheet ' . $namahari . ', ' . $tanggalnow . ' sudah di submit sebelumnya</h5>';
              ?>
                <div class="list-unstyled list-unstyled-border mt-4">
                  <?php
                  foreach ($tugasharian as $th) :
                  ?>


                    <?php if ($th['tanggal'] == date('Y-m-d', strtotime($tanggalnow))) : ?>
                      <?php
                      // error_reporting(0);
                      $key = $th['id_tkmstaff']; ?>
                      <h6>Project : <?php echo $th['project'] ?></h6>
                      <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" data-width="<?php echo $th['persen'] ?>%" aria-valuenow="<?php echo  $th['persen'] ?>" aria-valuemin="0" aria-valuemax="100"><?php echo  $th['persen'] ?>%</div>
                          </div>
                          <p>Rincian : </p>
                          <?php
                          $i = 1;
                          foreach ($rincian1[$key] as $db) : $kunci = date('Y-m-d', strtotime($tanggalnow)) . '/' . $db['id_rincian'];
                          ?>
                            <?= $i++ . '. ' . $db['rincian'] ?> (Ket : <?= $tugas[$kunci]['keterangan'] ?>). <a target="_blank" href="<?php echo base_url('dist/upload') ?>/<?php echo $tugas[$kunci]['fileupload'] ?>"><i class="fa fa-file"></i></a></li>
                            <div class="media">
                              <div class="media-icon"><i class="far fa-circle"></i></div>
                              <div class="media-body">
                                <div class="progress mb-3">
                                  <div class="progress-bar" role="progressbar" data-width="<?php echo $tugas[$kunci]['persentase'] ?>%" aria-valuenow="<?php echo $tugas[$kunci]['persentase'] ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $tugas[$kunci]['persentase'] ?>%</div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach ?>

                        </div>
                      </div>
                      <p>Keterangan Koreksi : <?php echo $th['keterangan_koreksi'] ?></p>
                      </br>
                    <?php endif ?>
                  <?php
                  endforeach;
                  ?>
                </div>

              <?php
              }
              ?>

            </div>
            <div class="card-footer text-primary">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- RIWAYAT HARIAN -->
    <h2 class="section-title">Riwayat Harian</h2>
    <?php $tgl = $senin;
    while ($tgl <= $jumat) : ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4><?= date('D , d M', strtotime($tgl)) ?></h4>
              <div class="card-header-action">
                <a data-toggle="collapse" data-target="#mycard-collapse<?= $tgl ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-eye"></i>View</a>
              </div>
            </div>
            <div class="collapse" id="mycard-collapse<?= $tgl ?>">
              <div class="card-body">
                <?php if (array_key_exists("$tgl", $riwayatharian)) : ?>
                  <div class="list-unstyled list-unstyled-border mt-4">

                    <?php foreach ($tugasharian as $th) : ?>
                      <?php if ($tgl == $th['tanggal']) : ?>
                        <div class="media">
                          <div class="media-icon"><i class="far fa-circle"></i></div>
                          <div class="media-body">
                            <h6>Project : <?php echo $th['project'] ?></h6>
                            <div class="progress mb-3">
                              <div class="progress-bar" role="progressbar" data-width="<?php echo $th['persentase'] ?>%" aria-valuenow="<?php echo $th['persentase'] ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $th['persentase'] ?>%</div>
                            </div>
                            <p>Rincian : </p>
                            <ol>
                              <?php $key = $th['id_tkmstaff'];
                              foreach ($rincian1[$key] as $db) : $kunci = $tgl . '/' . $db['id_rincian']; ?>
                                <li><?= $db['rincian'] ?> (Ket : <?= $tugas[$kunci]['keterangan'] ?>).
                                  <a target="_blank" href="<?php echo base_url('dist/upload') ?>/<?php echo $tugas[$kunci]['fileupload'] ?>"><i class="fa fa-file"></i></a>
                                </li>
                              <?php endforeach ?>
                            </ol>
                          </div>
                        </div>
                        </br>
                      <?php endif ?>
                    <?php endforeach; ?>
                  </div>

                <?php else : ?>
                  <p>DATA TIDAK TERSEDIA</p>
                <?php endif ?>

              </div>
              <!-- AKHIR CARD BODI -->
            </div>
          </div>
        </div>
      </div>
    <?php $tgl = date('Y-m-d', strtotime("+1 days", strtotime($tgl)));
    endwhile; ?>
    <!-- AKHIR RIWAYAT HARIAN -->

</div>
<?php 
              $date = new DateTime();
                    $date->modify('next monday');
                    $mon = $date->format('Y-m-d');
              $hari = date('D');
              $jam = date('H:i');
        $cek = $this->db->query("SELECT * FROM tkmdivisi WHERE pengisi='$username' AND daritanggal <= '$mon' AND sampaitanggal>='$mon'")->row_array();
        if ($cek == NULL AND $hari == 'Fri' AND $jam >= '12:00') {
        ?>
           <!-- Modal -->
            <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button> -->
                  </div>
                  <div class="modal-body">
                    <?php if ($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_akses') == 'Direksi') { ?>
                    <b>Anda belum membuat TKM untuk minggu depan. Harap membuat TKM terlebih dahulu, selanjutnya Anda dapat mengisi LKH untuk hari ini!
                    <?php } else { ?>
                    <b>Anda tidak dapat mengisi LKH hari ini. Ingatkan atasan Anda untuk melakukan meeting TKM hari ini dan submit pembuatan TKM, selanjutnya Anda dapat mengisi LKH untuk hari ini!
                    <?php } ?>
                      <br>
                      <br>Klik button dibawah ini untuk menuju ke halaman meeting TKM dan pembuatan TKM</b>
                  </div>
                  <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <a href="<?= base_url('mingguan/homemingguan') ?>" class="btn btn-success">Menu TKM</a>
                  </div>
                </div>
              </div>
            </div>
      <?php } ?>

<script type="text/javascript">
  $(document).on('change', '.tanggalWFH', function() {
    var val = $('option:selected', this).val()
    //alert(val);
    window.location = "<?php echo base_url('harian/viewharian2/'); ?>" + val;
  });

   $(document).ready(function() {
    
      $('#popup').modal('show');
    
  });

   $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });


   function cekStatus(i, z, persentase){
    var status = document.getElementById("status"+i+z).value;

     if (status == 'Menjadi Kasus') {
              document.getElementById('persen'+i+z).value = persentase;
              // $('#persen'+i+z).prop('disabled', true);
               document.getElementById('persen'+i+z).readOnly = true;
              // document.getElementById('keterangan'+i+z).value = "";
              // $('#keterangan'+i+z).prop('disabled', true);  
             } else {
              // $('#persen'+i+z).prop('disabled', false);
              document.getElementById('persen'+i+z).readOnly = false;
              // $('#keterangan'+i+z).prop('disabled', false); 

             }
   }

   function cekPersen(i, z, persenmin){
    var persentase = document.getElementById("persen"+i+z).value;
    var statusku = document.getElementById("status"+i+z);

            if (persentase < 100 && persentase > persenmin) {
              statusku.selectedIndex = 1;
              document.getElementById("status"+i+z).readOnly = true;
            } else if (persentase == 100) {
               statusku.selectedIndex = 3;
               document.getElementById("status"+i+z).readOnly = true;
            } else if (persentase <= persenmin) {
              statusku.selectedIndex = 0;
              document.getElementById("status"+i+z).readOnly = false;
            }
   }

   function cekKeyPersen(i, z, persenmin){
    var persentase = document.getElementById("persen"+i+z).value;
    var statusku = document.getElementById("status"+i+z);

            if (persentase < 100 && persentase > persenmin) {
              statusku.selectedIndex = 1;
            } else if (persentase == 100) {
               statusku.selectedIndex = 3;
            } else if (persentase <= persenmin) {
              statusku.selectedIndex = 0;
            }
   }

$(document).ready(function(){
  var current = 1,current_step,next_step,steps;
  steps = $("fieldset").length;
  $(".next").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().next();
    next_step.show();

    current_step.hide();
    console.log(current_step);
    console.log(next_step);
  });
  $(".previous").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
  });
});


  //  $(document).ready(function() {
  //   $("#tangse").on("click", function() {
  //     var select = document.getElementById('tanggalSelected');
  //     var value = select.options[select.selectedIndex].value;

  //     var tanggal = new Date(value);
  //     var_dump(value);
  //     var_dump(tanggal);
  //   });
  // });



  // $(document).ready(function() {
  //     var jumpro = $('#jmlpro').val();
     
  //     for(var i = 1; i <= jumpro; i++) {

  //       var jumrincian  = $('#jmlrincian' + i).val();
           
  //       for(var z = 1; z <= jumrincian; z++) {
  //          // var nmr = "" + i + z;
  //          // console.log(nmr);

  //          $('#status'+i+z).change(function() {
  //            var status = $(this).val();

  //            // alert(status);
  //            m = i;
  //            n = z;
  //            var cek = $('#persen'+m+n);
  //            console.log(cek);

  //            if (status == 'Menjadi Kasus') {
  //             $('#persen'+m+n).prop('disabled', true);
  //             // document.getElementById('keterangan'+i+z).value = "";
  //             $('#keterangan'+m+n).prop('disabled', true);  
  //            } else {
  //             $('#persen'+m+n).prop('disabled', false);
  //             $('#keterangan'+m+n).prop('disabled', false); 

  //            }
  //          });
  //        }
  //     }
  //    });

//   $(document).ready(function(){
   
//     var jumpro = $('#jmlpro').val();
     
//       for(var i = 1; i <= jumpro; i++) {
        
//         var jumrincian  = $('#jmlrincian' + i).val();
           
//         for(var z = 1; z <= jumrincian; z++) {
//           // alert(i);
         
//           var nmr = "" + i + z;
//           var status = "status"+nmr;
         
//           // alert(nmr);

//           var statusku = document.getElementById(status);

//            $('#persen'+nmr).on('change keyup', function() {
//             var persentase = $(this).val();


//             // alert(persentase);

//             if (persentase < 100) {
//               statusku.selectedIndex = 1;
//             } else if (persentase == 100) {
//                statusku.selectedIndex = 3;
//             }
             
//            });
         
            
//          }
//       }
// });
</script>



</section>
</div>