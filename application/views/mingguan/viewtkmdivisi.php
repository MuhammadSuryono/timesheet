<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>View TKM Divisi</h1>
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
          <!-- <div class="list-unstyled list-unstyled-border mt-4">
              <?php
              //foreach ($tkmdiv AS $key):
              ?>
                <div class="media">
                  <div class="media-icon"><i class="far fa-circle"></i></div>
                  <div class="media-body">
                    <h6><?php// echo $key['project']?></h6>
                    <div class="progress mb-3">
                      <div class="progress-bar" role="progressbar" data-width="<?php// echo $key['persentase']?>%" aria-valuenow="<?php// echo $key['persentase']?>" aria-valuemin="0" aria-valuemax="100"><?php// echo $key['persentase']?>%</div>
                    </div>
                    <p><?php// echo $key['deskripsi']?></p>
                  </div>
                </div>
              </br>
              <?php
              //endforeach;
              ?>
            </div> -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <!-- <h4>Target Kerja <?php// echo $divnya['divisi']?> <?php// echo $divnya['daritanggal']?> s/d <?php// echo $divnya['sampaitanggal']?></h4> -->
                <!-- <div class="card-header-action"> -->

                <!-- <a href="<?php// echo base_url('mingguan/viewtkmdivisi')?>/<?php// echo $divnya['no']?>" class="btn btn-info">View</a> -->
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
                    </tbody>
                  </table>
                </div>
              </div>
              <!--<div class="card-footer">
                      <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="0" data-new="1"><i class="fa fa-plus"></i> Assign Lintas Divisi</button>
                    </div> -->
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
        <div class="col-12 col-md-4 col-lg-4">
          <div class="pricing">
            <div class="pricing-title">
              <?php echo $key['nama_user'] ?>
            </div>
            <div class="pricing-padding">
              <div class="pricing-details">
                <ul>
                  <?php
                  $caritarget = $this->db->query("SELECT * FROM tkmstaff WHERE userstaff='$key[id_user]' AND idtkmdiv='$divnya[no]' AND persentase != 0")->result_array();

                  if (empty($caritarget)) {
                    echo "Belum ada target";
                  } else {
                    foreach ($caritarget as $ct) {
                  ?>
                      <li><?php echo $ct['project'] ?> - <?php echo $ct['persentase'] ?> %
                        <ol>
                          <?php $nama = $ct['no'];
                          if (array_key_exists("$nama", $rincian1)) {
                            for ($z = 0; $z < count($rincian1[$nama]); $z++) {
                              echo "<li>";
                              echo $rincian1[$nama][$z]['rincian'];
                              echo "</li>";
                            }
                          } ?>
                        </ol>
                      </li>
                      <hr>
                  <?php
                    }
                  }
                  ?>

                </ul>
              </div>
            </div>
            <div class="pricing-cta">
              <?php
              if ($this->session->userdata('ses_akses') == 'Manager') {

              ?>
                <a href="<?php echo base_url('mingguan/isitkmstaff4') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>">Isi <i class="fas fa-arrow-right"></i></a>
                <?php if (!empty($caritarget)) {

                ?>
                  <a href="<?php echo base_url('mingguan/viewtkmstaff') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>">View <i class="fas fa-arrow-right"></i></a>
                <?php
                }
              } else {
                if (empty($caritarget)) {
                  echo "";
                } else {
                ?>
                  <a href="<?php echo base_url('mingguan/viewtkmstaff') ?>/<?php echo $key['id_user'] ?>/<?php echo $divnya['no'] ?>">View <i class="fas fa-arrow-right"></i></a>
              <?php
                }
              }
              ?>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>

    <div id="accordion">
      <?php
      error_reporting(0);
      $daritanggal = $divnya['daritanggal'];
      $sampaitanggal = $divnya['sampaitanggal'];
      $tambahsatu = date('Y-m-d', strtotime($sampaitanggal . "+1 days"));
      $period = new DatePeriod(
        new DateTime($daritanggal),
        new DateInterval('P1D'),
        new DateTime($tambahsatu)
      );

      foreach ($period as $pp => $value) {
      ?>

        <div class="accordion">
          <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-<?php echo $value->format('d-m-Y') ?>">
            <h4>Laporn Harian <?php echo $value->format('d-m-Y') ?></h4>
          </div>
          <div class="accordion-body collapse" id="panel-body-<?php echo $value->format('d-m-Y') ?>" data-parent="#accordion">

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Project</th>
                    <th>Keterangan</th>
                    <th>Persentase</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $tanggalkerja = $value->format('Y-m-d');
                  $cariyangkerja = $this->db->query("SELECT
                                                              a.*,
                                                              b.nama_user AS namanya
                                                          FROM tugasharian a
                                                          JOIN tb_user b ON a.username = b.id_user
                                                          WHERE idtkmdiv='$divnya[no]'
                                                          AND tanggal='$tanggalkerja'
                                                          GROUP BY username")->result_array();
                  $ur = 1;
                  foreach ($cariyangkerja as $cyk) {
                    $itungkerjaan = $this->db->query("SELECT COUNT(no) AS jmlno FROM tugasharian WHERE username='$cyk[username]' AND tanggal='$tanggalkerja'")->row_array();
                    $kerjaannya = $this->db->query("SELECT * FROM tugasharian WHERE username='$cyk[username]' AND tanggal='$tanggalkerja'")->result_array();
                    $jmlno = $itungkerjaan['jmlno'] + 1;
                  ?>
                    <tr>
                      <td rowspan="<?php echo $jmlno; ?>"><?php echo $ur++; ?></td>
                      <td rowspan="<?php echo $jmlno; ?>"><?php echo $cyk['namanya'] ?></td>
                    </tr>
                    <?php
                    foreach ($kerjaannya as $kj) {
                    ?>
                      <tr>
                        <td><?php echo $kj['project']; ?></td>
                        <td><?php echo $kj['keterangan']; ?></td>
                        <td><?php echo $kj['persentase']; ?></td>
                      </tr>
                    <?php
                    }
                    ?>
                  <?php
                  }
                  ?>
                </tbody>

              </table>
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
<!-- MODAL TAMBAH -->