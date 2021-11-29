<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Target Kerja</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item active">Mingguan</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja Mingguan divisi <?php echo $this->session->userdata('ses_divisi'); ?></h2>

      <div class="row">

        <!-- ARRAY PEKERJAAN -->
        <?php
        error_reporting(0);
        $pekerjaan1 = [];
        $pekerjaan2 = [];
        $kategori = [];
        $deskripsi = [];
        $persentase = [];
        foreach ($pekerjaan as $db) {
          $key1 = $db['daritanggal'];
          $key2 = $db['project'];

          if (array_key_exists("$key1", $pekerjaan1)) {
            if (array_key_exists("$key2", $pekerjaan1[$key1])) {
              array_push($pekerjaan1[$key1][$key2], $db);
            } else {
              $pekerjaan1[$key1][$key2][] = $db;
              $kategori[$key1][$key2] = $db['nama_kategori'];
              $deskripsi[$key1][$key2] = $db['deskripsi'];
              $persentase[$key1][$key2] = $db['persentase'];
              $tambahan[$key1][$key2] = $db['tambahan'];
            }
          } else {
            $pekerjaan1[$key1][$key2][] = $db;
            $kategori[$key1][$key2] = $db['nama_kategori'];
            $deskripsi[$key1][$key2] = $db['deskripsi'];
            $persentase[$key1][$key2] = $db['persentase'];
            $tambahan[$key1][$key2] = $db['tambahan'];
          }

          if (array_key_exists("$key1", $pekerjaan2)) {
            $val = $db['project'];
            if (!in_array("$val", $pekerjaan2[$key1])) {
              array_push($pekerjaan2[$key1], $db['project']);
            }
          } else {
            $pekerjaan2[$key1][] = $db['project'];
          }
        } ?>
        <!-- ARRAY PEKERJAAN -->

        <!-- ARRAY TKMDIVISI -->
        <?php $tkm = [];
        foreach ($tkmdivisi as $db) {
          $key1 = $db['daritanggal'];
          $tkm[$key1] = $db['status'];
        } //var_dump($tkm);
        //var_dump(in_array("2020-04-27", $tkm)); die;
        ?>
        <!-- ARRAY TKMDIVISI -->

        <?php $tgl = $senin;
        for ($i = 1; $i <= 4; $i++) : ?>
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4>Target Kerja <?= date('d-m-Y', strtotime($tgl)) ?> s.d <?= date('d-m-Y', strtotime("+11 days", strtotime($tgl))); ?> <?php if (array_key_exists("$tgl", $tkm)) {
                                                                                                                                          echo "( <span class='ml-3 beep'></span>";
                                                                                                                                          echo $tkm[$tgl];
                                                                                                                                          echo " )";
                                                                                                                                        } ?></h4>
                <div class="card-header-action">

                  <!-- BELUM ADA DI TKMDIV -->
                  <?php if (!array_key_exists("$tgl", $tkm)) : ?>
                    <a href="<?php echo base_url('mingguan/isitkm3/') ?><?= $tgl ?>/<?= date('Y-m-d', strtotime("+11 days", strtotime($tgl))) ?>" class="btn btn-success"><i class='fa fa-plus'></i> Isi</a>
                  <?php else : ?>
                    <!-- AKHIR -->

                    <!-- STATUS DISETUJUI -->
                    <?php if ($tkm[$tgl] == 'Disetujui') : ?>
                      <a href="<?= base_url('mingguan/tambahtkmdiv/') ?><?php echo $tgl ?>" class="btn btn-warning"><i class='fa fa-edit'></i> Tambah TKM</a>
                      <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $tgl ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a>
                      <?//php endif?>
                      <!-- AKHIR -->

                      <!-- STATUS Menunggu Approval -->
                      <?//php if($tkm[$tgl]=='Menunggu Approval'):?>
                    <?php else : ?>
                      <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $tgl ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a>
                      <a href="<?php echo base_url('mingguan/deletetkmdivisi2') ?>/<?php echo $tgl ?>" class="btn btn-danger tombol-hapus"><i class='fa fa-trash'></i> Hapus</a>
                    <?php endif ?>
                    <!-- AKHIR -->
                  <?php endif ?>

                  <a data-collapse="#mycard-collapse<?= $i ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                </div>
              </div>
              <div class="collapse <?= ($i == 1 ? 'show' : ''); ?>" id="mycard-collapse<?= $i ?>">
                <div class="card-body">

                  <b>*Note :</b>
                  <ul>
                    <li>Untuk kategori project B1 dan B2 bisa langsung di tugaskan</li>
                    <?php
                    if ($tkm[$tgl] == 'Menunggu Approval') {
                      echo "<li>Harap Follow up untuk mendapatkan approval non project</li>";
                    } else {
                      echo "";
                    }
                    ?>
                  </ul>

                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Project</th>
                          <th>Kategori</th>
                          <!-- <th>Deskripsi</th> -->
                          <th>Persentase</th>
                          <th>Rincian Pekerjaan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (array_key_exists("$tgl", $pekerjaan2)) : ?>
                          <?php for ($x = 0; $x < count($pekerjaan2[$tgl]); $x++) : ?>
                            <?php $project = $pekerjaan2[$tgl][$x];
                            $rowspan = count($pekerjaan1[$tgl][$project]) + 1; ?>
                            <?php
                            if ($tambahan[$tgl][$project] == NULL) {
                              $warna = "";
                            } else {
                              $warna = "#a1c5e6";
                            }
                            ?>
                            <tr bgcolor="<?php echo $warna ?>">
                              <td rowspan="<?= $rowspan ?>"><?= $x + 1 ?></td>
                              <td rowspan="<?= $rowspan ?>"><?= $project ?></td>
                              <td rowspan="<?= $rowspan ?>"><?= $kategori[$tgl][$project] ?></td>
                              <!-- <td rowspan="<?= $rowspan ?>"><?= $deskripsi[$tgl][$project] ?></td> -->
                              <td rowspan="<?= $rowspan ?>" class="text-center"><?= $persentase[$tgl][$project] ?>%
                                <div class="progress" data-height="4">
                                  <div class="progress-bar bg-success" role="progressbar" data-width="<?= $persentase[$tgl][$project] ?>%" aria-valuenow="<?= $persentase[$tgl][$project] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                            </tr>
                            <?php foreach ($pekerjaan1[$tgl][$project] as $db) : ?>
                              <tr bgcolor="<?php echo $warna ?>">
                                <td><?= $db['uraian'] ?></td>
                              </tr>
                            <?php endforeach ?>
                          <?php endfor ?>
                        <?php else : ?>
                          <tr>
                            <td colspan="6" class="text-center"> Data Tidak Tersedia</td>
                          </tr>
                        <?php endif ?>
                      </tbody>
                    </table>
                  </div>


                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
          </div>
        <?php $tgl = date('Y-m-d', strtotime("+14 days", strtotime($tgl)));
        endfor ?>
      </div>

      <!-- BANG TEDY PUNYA -->
      <!-- BANG TEDY PUNYA -->


    </div>
  </section>
</div>