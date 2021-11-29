<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Target Kerja</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Approval Target Kerja</a></div>
        <div class="breadcrumb-item active">Mingguan</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="section-body">
      <h2 class="section-title">Aprroval Target Kerja Mingguan Per Divisi</h2>

      <?php
      foreach ($gettkm as $key) {
      ?>
      <div class="card card-primary">
        <div class="card-header">
          <h4>TKM Divisi <?php echo $key['divisi']?> <?php echo $key['daritanggal'] ?> s/d <?php echo $key['sampaitanggal'] ?></h4>
          <div class="card-header-action">
            <a href="<?php echo base_url('mingguan/approve')?>/<?php echo $key['no']?>" class="btn btn-primary"><i class="fa fa-check"></i> Approve</a>
            <div class="dropdown">
              <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
              <div class="dropdown-menu">
                <!-- <a href="<?php echo base_url('mingguan/edittkmdivisi')?>/<?php echo $key['no']?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a> -->
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url('mingguan/deletetkm')?>/<?php echo $key['no']?>" class="dropdown-item has-icon text-danger tombol-hapus"><i class="far fa-trash-alt"></i> Delete</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="list-unstyled list-unstyled-border mt-4">
            <?php
            $caripekerjaan = $this->db->query("SELECT * FROM pekerjaan WHERE idtkmdiv='$key[no]'")->result_array();
            foreach($caripekerjaan AS $cp){
            ?>
            <div class="media">
              <div class="media-icon"><i class="far fa-circle"></i></div>
              <div class="media-body">
                <h6><?php echo $cp['project']?></h6>
                <div class="progress mb-3">
                  <div class="progress-bar" role="progressbar" data-width="<?php echo $cp['persentase']?>%" aria-valuenow="<?php echo $cp['persentase']?>" aria-valuemin="0" aria-valuemax="100"><?php echo $cp['persentase']?>%</div>
                </div>
                <p><?php echo $cp['deskripsi']?></p>
              </div>
            </div>
            </br>
          <?php
          }
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
