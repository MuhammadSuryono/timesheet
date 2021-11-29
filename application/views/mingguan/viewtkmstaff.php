<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Target Kerja</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja <?php echo $usernya['divisi']?></a></div>
        <div class="breadcrumb-item active"><?php echo $usernya['nama_user'] ?></div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>

    <div class="section-body">
      <h2 class="section-title">Target Kerja Harian</h2>

      <div class="card card-primary">
        <div class="card-header">
          <!-- <h4>TKM <?php echo $usernya['nama_user']; ?> 13-04-2020 s/d 18-04-2020</h4> -->
          <h4>TKM <?php echo $usernya['nama_user'] ." ". $daritanggal ." s/d ". $sampaitanggal; ?> </h4>
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="list-unstyled list-unstyled-border mt-4">
            <?php
            foreach ($caritarget AS $key):
              $targetselesai = $key['targetselesai'];
            ?>
              <div class="media">
                <div class="media-icon"><i class="far fa-circle"></i></div>
                <div class="media-body">
                  <div class="row">
                      <div class="col-sm-6"><h6><?php echo $key['project']; ?></h6></div>
                      <?php if ($key['targetselesai'] != '0000-00-00') {
                        ?>
                      <div class="col-sm-6 text-right"><h6>Target Selesai : <?php echo date('d M Y', strtotime($targetselesai)); ?></h6></div>
                    <?php } ?>
                    </div>
                  <div class="progress mb-3">
                    <div class="progress-bar" role="progressbar" data-width="<?php echo $key['persentase']?>%" aria-valuenow="<?php echo $key['persentase']?>" aria-valuemin="0" aria-valuemax="100"><?php echo $key['persentase']?>%</div>
                  </div>
                  <p><?php echo $key['deskripsi']?></p>
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

      <h2 class="section-title">Laporan Kerja Harian</h2>
      <?php
      foreach ($hariannya as $key) {
        $tanggalnow = date('d-m-Y');
        $namahari   = date('D', strtotime($key['tanggal']));
      ?>

      <div class="card card-primary">
        <div class="card-header">
          <h4><?php echo $namahari; ?>, <?php echo $key['tanggal']?></h4>
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="list-unstyled list-unstyled-border mt-4">
            <?php
            $tugasharian = $this->db->query("SELECT * FROM tugasharian WHERE tanggal='$key[tanggal]' AND username='$usernya[id_user]'")->result_array();
            foreach ($tugasharian AS $th):
            ?>
              <div class="media">
                <div class="media-icon"><i class="far fa-circle"></i></div>
                <div class="media-body">
                  <h6>Project : <?php echo $th['project']?> <a  target="_blank" href="<?php echo base_url('dist/upload')?>/<?php echo $th['fileupload']?>"><i class="fa fa-file"></i></a></h6>
                  <div class="progress mb-3">
                    <div class="progress-bar" role="progressbar" data-width="<?php echo $th['persentase']?>%" aria-valuenow="<?php echo $th['persentase']?>" aria-valuemin="0" aria-valuemax="100"><?php echo $th['persentase']?>%</div>
                  </div>
                  <p>Ket : <?php echo $th['keterangan']?></p>
                </div>
              </div>
            </br>
            <?php
            endforeach;
            ?>
          </div>
          </div>
        </div>
        
      <?php
      }
      ?>

      </div>
  </section>
</div>
