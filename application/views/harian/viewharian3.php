<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Target Kerja 3</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item active">Harian</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $tanggalnow = date('d-m-d');
    $namahari   = date('D', strtotime($tanggalnow));
    ?>

    <div class="section-body">
      <h2 class="section-title">Laporan Kerja Harian 3</h2>

      <div class="card card-primary">
        <div class="card-header">
          <!-- <h4>TKM <?php echo $this->session->userdata('ses_nama'); ?> 20-04-2020 s/d 24-04-2020</h4> -->
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="list-unstyled list-unstyled-border mt-4">
            <?php
            foreach ($caritarget as $key) :
            ?>
              <div class="media">
                <div class="media-icon"><i class="far fa-circle"></i></div>
                <div class="media-body">
                  <h6><?php echo $key['project']; ?></h6>
                  <div class="progress mb-3">
                    <div class="progress-bar" role="progressbar" data-width="<?php echo $key['persentase'] ?>%" aria-valuenow="<?php echo $key['persentase'] ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $key['persentase'] ?>%</div>
                  </div>
                  <p><?php echo $key['deskripsi'] ?></p>
                </div>
              </div>
              </br>
            <?php
            endforeach;
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- ARRAY RINCIAN -->
    <?php $rincian1 = [];
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

      $tugas[$key] = $db;

      if (array_key_exists("$kunci", $riwayatharian)) {
        array_push($riwayatharian[$kunci], $db);
      } else {
        $riwayatharian[$kunci][] = $db;
      }
    } ?>
    <!-- ARRAY TUGAS HARIAN -->

    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4><?php echo $namahari; ?>, <?php echo date('d-m-Y') ?></h4>
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
              if (array_key_exists(date('Y-m-d'), $riwayatharian) == false) {
              ?>
                <form action="<?php echo base_url('harian/isiharian2') ?>" method="post" enctype="multipart/form-data">

                  <ul>
                    <?php
                    $i = 0;
                    foreach ($caritarget as $cp) {
                      $i++;
                    ?>
                      <input type="hidden" name="idtkmdiv<?php echo $i ?>" value="<?php echo $cp['idtkmdiv'] ?>">
                      <li>
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="project<?php echo $i; ?>">Project/Program/Pekerjaan :</label>
                              <input type="text" class="form-control" id="project<?php echo $i; ?>" name="project<?php echo $i; ?>" value="<?php echo $cp['project'] ?>" readonly>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Persentase</label>
                              <div class="input-group">
                                <input type="number" class="form-control" id="persen<?php echo $i; ?>" name="persen<?php echo $i; ?>" max="<?php echo $cp['persentase']; ?>">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <i class="fas fa-percent"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                        <!-- RINCIAN -->
                        <ul>
                          <?php $key = $cp['no'];
                          $ulang = 0;
                          if (array_key_exists("$key", $rincian1)) : ?>
                            <?php foreach ($rincian1[$key] as $xy) : $ulang++; ?>
                              <li>
                                <div class="row">

                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label for="rinciantext<?php echo $i; ?><?= $ulang ?>">Rincian Pekerjaan :</label>
                                      <input type="text" class="form-control" id="rinciantext<?php echo $i; ?><?= $ulang ?>" name="rinciantext<?php echo $i; ?><?= $ulang ?>" value="<?php echo $ulang . '. ' . $xy['rincian'] ?>" readonly>

                                      <input type="hidden" class="form-control" id="rincian<?php echo $i; ?><?= $ulang ?>" name="rincian<?php echo $i; ?><?= $ulang ?>" value="<?php echo $xy['id_rincian'] ?>">
                                    </div>
                                  </div>

                                  <div class="col-sm-4">
                                    <div class="form-group">
                                      <label for="keterangan<?php echo $i; ?><?= $ulang ?>">Keterangan :</label>
                                      <input type="text" class="form-control" id="keterangan<?php echo $i; ?><?= $ulang ?>" name="keterangan<?php echo $i; ?><?= $ulang ?>">
                                    </div>
                                  </div>

                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label for="fileupload<?php echo $i; ?><?= $ulang ?>">File Upload</label>
                                      <input type="file" class="form-control" id="fileupload<?php echo $i; ?><?= $ulang ?>" name="fileupload<?php echo $i; ?><?= $ulang ?>">
                                    </div>
                                  </div>

                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label for="status<?php echo $i; ?><?= $ulang ?>">Status</label>
                                      <select class="form-control select2" id="status<?php echo $i; ?><?= $ulang ?>" name="status<?php echo $i; ?><?= $ulang ?>">
                                        <option value="Belum Selesai">Belum Selesai</option>
                                        <option value="Belum Dikerjakan">Belum Dikerjakan</option>
                                        <option value="Selesai">Selesai</option>
                                      </select>
                                    </div>
                                  </div>

                                </div>
                              </li>
                            <?php endforeach ?>

                            <!-- BANNYAK NYA RINCIAN SETIAP PEKERJAAn-->
                            <input type="hidden" name="jmlrincian<?= $i ?>" id="jmlrincian<?= $i ?>" value="<?= $ulang ?>">
                            <!-- BANNYAK NYA RINCIAN SETIAP PEKERJAAn-->

                          <?php else : ?>
                            <li>Rincian Pekerjaan Tidak Tersedia</li>
                          <?php endif ?>
                        </ul>
                        <!-- AKHIR RINCIAN -->

                      </li>
                      <hr>
                    <?php
                    }
                    ?>
                  </ul>

                  <input type="hidden" name="jmlpro" value="<?php echo $i; ?>">

                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>

                </form>
              <?php
              } else {
              ?>
                <div class="list-unstyled list-unstyled-border mt-4">
                  <?php
                  foreach ($tugasharian as $th) :
                  ?>
                    <?php if (date('Y-m-d') == $th['tanggal']) : ?>
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
                            foreach ($rincian1[$key] as $db) : $kunci = date('Y-m-d') . '/' . $db['id_rincian']; ?>
                              <li><?= $db['rincian'] ?> (Ket : <?= $tugas[$kunci]['keterangan'] ?>). <a target="_blank" href="<?php echo base_url('dist/upload') ?>/<?php echo $tugas[$kunci]['fileupload'] ?>"><i class="fa fa-file"></i></a></li>
                            <?php endforeach ?>
                          </ol>
                        </div>
                      </div>
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
    while ($tgl < date('Y-m-d')) : ?>
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
</section>
</div>