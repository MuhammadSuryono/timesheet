

<!-- Main Content -->

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>View TKM Divisi 3</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <?php
        if ($this->session->userdata('ses_akses') == 'Direksi') {
        ?>
          <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/listtkmdivisi') ?>">List TKM</a></div>
        <?php
        } else {
        ?>
          <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/homemingguan') ?>">List TKM</a></div>
        <?php
        }
        ?>
        <div class="breadcrumb-item active">View TKM Divisi</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="section-body">
      <h2 class="section-title">View TKM Divisi <?php echo $divnya['divisi'] ?></h2>

      <div class="card card-primary">
        <div class="card-header">
          <h4>TKM Divisi <?php echo $divnya['divisi'] ?> <?php echo $divnya['daritanggal'] ?> s/d <?php echo $divnya['sampaitanggal'] ?></h4>
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <a data-collapse="#mycard-collapse<?php echo $divnya['no'] ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
              </div>
            </div>
            <div class="collapse" id="mycard-collapse<?php echo $divnya['no'] ?>">
              <div class="card-body">

                <div class="table-responsive">
                  <table class="table table-bordered table-hover">

                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Project</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Persentase</th>
                        <th>Uraian</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $caripekerjaan = $this->db->query("SELECT
                                                                          a.*,
                                                                          b.nama_kategori AS namakategori
                                                                          FROM pekerjaan a
                                                                          JOIN kategori b ON a.id_kategori = b.id_kategori
                                                                          WHERE idtkmdiv='$divnya[no]'")->result_array();
                      $x = 1;
                      foreach ($caripekerjaan as $cp) {
                        $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$cp[no]'")->result_array();
                        $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$cp[no]'")->row_array();
                        $rowspan = $jmlurai['jmu'] + 1;
                        // echo $rowspan;
                      ?>
                        <tr>
                          <td rowspan="<?= $rowspan ?>"><?= $x++ ?></td>
                          <td rowspan="<?= $rowspan ?>"><?php echo $cp['project'] ?></td>
                          <td rowspan="<?= $rowspan ?>"><?php echo $cp['namakategori'] ?></td>
                          <td rowspan="<?= $rowspan ?>"><?php echo $cp['deskripsi'] ?></td>
                          <td rowspan="<?= $rowspan ?>" class="text-center"><?php echo $cp['persentase'] ?>%
                            <div class="progress" data-height="4">
                              <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase'] ?>%" aria-valuenow="<?php echo $cp['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                        </tr>
                        <?php foreach ($uraian as $ua) : ?>
                          <tr>
                            <td><?php echo $ua['uraian'] ?></td>
                          </tr>
                        <?php endforeach ?>
                      <?php
                      }
                      ?>

                      <!-- LINTAS DIVISI -->
                      <?php
                      $tgl = $divnya['daritanggal'];
                      $divisinya = $this->session->userdata('ses_divisi');
                      $cari = $this->db->query("SELECT
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
                                                                WHERE b.daritanggal = '$tgl'
                                                                AND b.divisi='$divisinya'
                                                                GROUP BY b.project")->result_array();
                      $jml = count($cari);
                      if ($jml > 0) :

                        foreach ($cari as $cp) {
                          if ($cp['tambahan'] == NULL) {
                            $warna = "";
                          } else {
                            $warna = "#a1c5e6";
                          }
                          $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$cp[idpekerjaan]'")->result_array();
                          $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$cp[idpekerjaan]'")->row_array();
                          $rowspan = $jmlurai['jmu'] + 1;
                          // echo $rowspan;
                      ?>
                          <tr bgcolor="<?php echo $warna ?>">
                            <td rowspan="<?= $rowspan ?>"><?= $x++ ?></td>
                            <td rowspan="<?= $rowspan ?>"><?php echo $cp['project'] ?> ( <?= $cp['divisi'] ?> )</td>
                            <td rowspan="<?= $rowspan ?>"><?php echo $cp['nama_kategori'] ?></td>
                            <td rowspan="<?= $rowspan ?>"><?php echo $cp['deskripsi'] ?></td>
                            <td rowspan="<?= $rowspan ?>" class="text-center"><?php echo $cp['persentase'] ?>%
                              <div class="progress" data-height="4">
                                <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase'] ?>%" aria-valuenow="<?php echo $cp['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <?php foreach ($uraian as $ua) : ?>
                            <tr>
                              <td><?php echo $ua['uraian'] ?></td>
                            </tr>
                          <?php endforeach ?>
                        <?php
                        }
                        ?>
                      <?php endif ?>
                      <!-- LINTAS DIVISI -->

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <!-- <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="0" data-new="1"><i class="fa fa-plus"></i> Assign Lintas Divisi</button> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <h2 class="section-title">Staff</h2>
    <p class="section-lead">List Target Staff Divisi <b><?php echo $divnya['divisi'] ?></b> <?php echo $divnya['daritanggal'] ?> s/d <?php echo $divnya['sampaitanggal'] ?></p>

    <!-- ARRAY RINCIAN -->
    <?php $rincian1 = [];
    foreach ($rincian as $db) {
      $nama = $db['id_tkmstaff'];
      if (array_key_exists("$nama", $rincian1)) {
        array_push($rincian1[$nama], $db);
      } else {
        $rincian1[$nama][] = $db;
      }
    } ?>
    <!-- ARRAY RINCIAN -->

    <div class="row">

      <?php
      foreach ($liststaff as $key) {
      ?>
        <div class="col-lg-12">
          <div class="pricing" >
            <div class="pricing-title col-sm-12" >
              <?php echo $key['nama_user'] ?>
            </div>
           
              <div class="pricing-details py-5">
                <ul>
                  <?php
                  if ($this->session->userdata('ses_akses') == 'Manager') {
                    
                        $caritarget = $this->db->query("SELECT * FROM tkmstaff a JOIN tkmdivisi b on a.idtkmdiv=b.no WHERE a.userstaff='$key[id_user]' AND b.divisi = '$divnya[divisi]' AND b.daritanggal='$divnya[daritanggal]' AND b.sampaitanggal='$divnya[sampaitanggal]'")->result_array();
                    
                  } else {
                    $caritarget = $this->db->query("SELECT * FROM tkmstaff WHERE userstaff='$key[id_user]' AND idtkmdiv='$divnya[no]'")->result_array();
                  }

                  foreach ($caritarget as $ct) {
                    // $this->db->where('rincian', (int)$ct['idtkmdiv'])
                  ?>
                    <li><a data-toggle="collapse" href="#rincian<?= $ct['no'] ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><?php echo $ct['project'] ?> - <?php echo $ct['persentase'] ?> %</a>
                      <ol class="collapse" id="rincian<?= $ct['no'] ?>">
                        <?php $nama = $ct['no'];
                        if (array_key_exists("$nama", $rincian1)) {
                          for ($z = 0; $z < count($rincian1[$nama]); $z++) {
                            if ($rincian1 != null) {
                              echo "<li>";
                              echo $rincian1[$nama][$z]['rincian'];
                              echo "</li>";
                            }
                          }
                        } ?>
                      </ol>
                    </li>
                    <hr>
                  <?php
                  } ?>
                  <?php

                  $lintasdivsi = $this->db->query("SELECT * FROM pekerjaan_lintasdivisi WHERE divisi='$divisinya' and daritanggal = '$tgl'")->result_array();

                  foreach ($lintasdivsi as $ldiv) {
                    $caritarget2 = $this->db->query("SELECT
                                                                a.*,
                                                                b.divisi AS fromdiv
                                                          FROM tkmstaff a
                                                          JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                                          WHERE a.userstaff='$key[id_user]'
                                                          AND a.idtkmdiv='$ldiv[idtkmdiv]'")->result_array();

                    foreach ($caritarget2 as $ct) {
                  ?>
                      <li><?php echo $ct['project'] ?> - <?php echo $ct['persentase'] ?> % (From :<?php echo $ct['fromdiv'] ?>)
                        <ol>
                          <?php
                          // $rincian = $this->db->get_where("rincian", ['id_tkmstaff'=>$ct['no']])->result_array();
                          $rincian = $this->db->query("SELECT * FROM rincian WHERE id_tkmstaff='$ct[no]'")->result_array();
                          foreach ($rincian as $dd) {
                            // echo "<li>";
                            // echo $ct['no'];
                            // echo $dd['rincian'];
                            // echo " - ";
                            // echo $dd['targetpersen'];
                            // echo "</li>";
                            echo ($dd);
                            die();
                          }
                          ?>
                        </ol>
                      </li>
                      <hr>
                  <?php
                    }
                  }
                  ?>
                </ul>
              </div>
           
            <div class="">
              <?php
              // if ($this->session->userdata('ses_akses') == 'Manager' or $this->session->userdata('ses_username') == 'sekar') {

              ?>
              <div class="col-md-12 bg-light py-2">
                
                <a href="<?php echo base_url('mingguan/isitkmstaff5') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>"><button class="btn btn-success m-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Isi TKM Staff"><i class="fas fa-plus-circle"></i></button></a>

                <?php if (!empty($caritarget)) { ?>
                <a href="<?php echo base_url('mingguan/viewtkmstaff') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>"><button class="btn btn-primary m-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="View TKM Staff"><i class="far fa-eye"></i></button></a>

                <?php 
                  if ($this->session->userdata('ses_akses') == 'Manager' or $this->session->userdata('ses_username') == 'sekar') {
                ?>
                <a data-toggle="modal"  class="open-RotasiKerja" data-target="#RotasiKerja<?php echo $key['id_user'] ?>"><button class="btn btn-warning m-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Isi Rotasi Hari Kerja Staff"><i class="fas fa-sync-alt"></i></button></a>

                <?php
              }
                     }  
              // } else {
                  if (empty($caritarget2)) {
                    echo "";
                  } else {
                ?>
                  <a href="<?php echo base_url('mingguan/viewtkmstaff') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>"><button class="btn btn-warning m-1">View</button></a>
              <?php
                }
              // }

                 $tglnow = date('Y-m-d');
                 $username = $key['id_user'];
                 $rotasi = $this->db->query("SELECT * FROM tb_rotasi WHERE userstaff ='$username' AND kondisi ='1' AND tgl_pengganti >=
                  '$tglnow'")->result_array();
                 if ($rotasi != NULL) { 
                 ?>
                 <p>
                <a data-toggle="collapse" href="#inforotasi<?php echo $key['id_user'] ?>"><button class="btn btn-info mt-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Info Rotasi Hari Kerja"><i class="fas fa-arrow-circle-down"></i></button></a>
                </p>
                <?php 
                }
              
                ?>


                <div class="collapse mt-2" id="inforotasi<?php echo $key['id_user'] ?>"  >
                  <div class="card card-body">
                    <span class="font-weight-bold mb-2 py-2 bg-light">INFO ROTASI HARI KERJA</span>
                    <span class="font-weight-bold mb-2 ml-1 text-left">Nama &nbsp; : &nbsp; <?php echo $key['nama_user'] ?></span>
                    
                      <div class="table-responsive"> 
                          <table class="table table-bordered m-0">
                            <tr class="bg-light">
                              <th>Tanggal Rotasi</th>
                              <th>Tanggal Pengganti</th>
                              <th>Aksi</th>
                            </tr>
                        <?php                
                        foreach ($rotasi as $r) :
              
                         ?>
                            <tr>
                              <td><?php echo date('d-m-Y', strtotime($r['tgl_rotasi'])) ?></td>
                              <td><?php echo date('d-m-Y', strtotime($r['tgl_pengganti'])) ?></td>
                              <td><a href="<?php echo site_url('mingguan/cancelrotasi/'.$this->uri->segment(3).'/'.$r['id'].'/0') ?>" class="btn btn-success">Cancel</a></td>
                            </tr>
                          <?php
                          endforeach;
                           ?>
                          </table>
                      </div>
                  </div>
                </div>
              </div>

<!--                 <a href="<?php echo base_url('mingguan/isitkmstaff5') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>">Isi <i class="fas fa-arrow-right"></i></a>
                
                  <a href="<?php echo base_url('mingguan/viewtkmstaff') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>">View <i class="fas fa-arrow-right"></i></a>

                  <a data-toggle="modal" data-id="<?php echo $key['id_user'] ?>" class="open-RotasiKerja" href="#RotasiKerja">Rotasi Kerja <i class="fas fa-arrow-right"></i></a> -->
<!-- 
                <?php
                

              // } else {
              //   if (empty($caritarget2)) {
              //     echo "";
              //   } else {
              //   ?>
                  <a href="<?php echo base_url('mingguan/viewtkmstaff') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>">View <i class="fas fa-arrow-right"></i></a>
              <?php
              //   }
              // }
              ?> 
            -->
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>

</div>
</section>
</div>


<!-- Modal Rotasi Kerja -->
 <?php
 $no = 0;
      foreach ($liststaff as $key) {
        $no++;
      ?>
<div class="modal hide" id="RotasiKerja<?php echo $key['id_user'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rotasi Hari Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('mingguan/isirotasi');?>
        <label class="font-weight-bold mt-2">Nama</label>
        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $key['nama_user'] ?>" readonly/>
        <input type="hidden" class="form-control" name="user" id="user" value="<?php echo $key['id_user'] ?>" readonly/>
        <label class="font-weight-bold mt-2">Tanggal Rotasi</label>
        <input type="date" class="form-control" name="tgl_rotasi">
        <label class="font-weight-bold mt-2">Tanggal Pengganti</label>
        <input type="date" class="form-control" name="tgl_pengganti">
        <input type="hidden" class="form-control" name="kondisi" value="1">
        <input type="hidden" class="form-control" name="tglawal" value="<?php echo $this->uri->segment(3); ?>">

      </div>
      <div class="modal-footer">
        <input class="btn btn-success" type="submit" name="simpan" value="Simpan">

        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- MODAL Assign -->
<div class="modal fade" tabindex="-1" role="dialog" id="add">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assign Lintas Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form action="" method="POST">

          <div class="form-group">
            <label for="project">Project :</label>
            <select class="form-control" name="project" required>
              <option value="" selected disabled>Pilih Project</option>
              <?php
              foreach ($caripekerjaan as $cpk) {
              ?>
                <option value=""><?php echo $cpk['project'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="project">Nama Leader :</label>
            <select class="form-control" name="project" required>
              <option value="" selected disabled>Pilih Nama Leader</option>
              <?php
              foreach ($leader as $ld) {
              ?>
                <option value=""><?php echo $ld['nama_user'] ?> - <?php echo $ld['divisi'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <button type="submit" class="btn btn-success">Submit</button>

        </form>

      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <section id="buttonmodal">
          <!-- <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button> -->
        </section>
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<script>
  // $(document).on("click", ".open-RotasiKerja", function () {
  //    var myUserId = $(this).data('id');
  //    $(".modal-body #user").val( myUserId );
    
  //   });

  $(document).ready(function(){
    $('.popover').popover();
  });
</script>