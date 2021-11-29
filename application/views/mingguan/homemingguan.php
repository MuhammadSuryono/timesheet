<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Target Kerja</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item active">Mingguan</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja Mingguan divisi <?php echo $this->session->userdata('ses_divisi'); ?></h2>

          <div class="row">

            <div class="col-12 col-md-6 col-lg-6">

              <!-- Minggu Kedua -->
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Target Kerja 20-04-2020 s/d 24-04-2020</h4>
                  <div class="card-header-action">
                      <?php
                      if(empty($kedua)){

                        if($this->session->userdata('ses_akses') == 'Manager'){
                        ?>
                        <a href="<?php echo base_url('mingguan/isitkm')?>/2020-04-20/2020-04-24" class="btn btn-info"><i class='fa fa-plus'></i> Isi</a>
                        <?php
                        }
                        else{
                        echo "";
                        }

                      }
                      else if($kedua['status'] == "Disetujui"){
                      ?>
                      <a href="<?php echo base_url('mingguan/viewtkmdivisi')?>/<?php echo $kedua['no']?>" class="btn btn-info"><i class='fa fa-eye'></i> View</a>
                      <?php
                      }
                      else{

                        if($this->session->userdata('ses_akses') == 'Manager'){
                        ?>
                        <a href="<?php echo base_url('mingguan/deletetkmdivisi')?>/<?php echo $kedua['no']?>" class="btn btn-danger tombol-hapus"><i class='fa fa-trash'></i> Hapus</a>
                        <?php
                        }
                        else{
                          echo "";
                        }

                      }
                      ?>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  if(empty($prokedua)){
                    echo "Belum Diisi";
                  }else{
                  ?>
                  <div class="list-unstyled list-unstyled-border mt-4">
                    <?php
                    foreach ($prokedua AS $key):
                    ?>
                      <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                          <h6><?php echo $key['project']?></h6>
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
                  <?php
                  }
                  ?>
                </div>
                <div class="card-footer text-right">
                  <?php
                  if(empty($kedua)){
                    echo "";
                  }else if($kedua['status'] == 'Menunggu Approval'){
                    echo "<i class='fa fa-pause'></i>&nbsp;";
                    echo $kedua['status'];
                  }
                  else if($kedua['status'] == 'Revisi'){
                    echo "<i class='fa fa-edit'></i>&nbsp;";
                    echo $kedua['status'];
                  }
                  else{
                    echo "<i class='fa fa-check'></i>&nbsp;";
                    echo $kedua['status'];
                  }
                  ?>
                </div>
              </div>
              <!-- //Minggu Kedua -->

              <!-- Minggu Ketiga -->
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Target Kerja 27-04-2020 s/d 01-05-2020</h4>
                  <div class="card-header-action">
                      <?php
                      if(empty($ketiga)){

                          if($this->session->userdata('ses_akses') == 'Manager'){
                          ?>
                          <a href="<?php echo base_url('mingguan/isitkm')?>/2020-04-27/2020-05-01" class="btn btn-info"><i class='fa fa-plus'></i> Isi</a>
                          <?php
                          }
                          else{
                            echo "";
                          }

                      }
                      else if($ketiga['status'] == "Disetujui"){
                      ?>
                      <a href="<?php echo base_url('mingguan/viewtkmdivisi')?>/<?php echo $ketiga['no']?>" class="btn btn-info"><i class='fa fa-eye'></i> View</a>
                      <?php
                      }
                      else{

                          if($this->session->userdata('ses_akses') == 'Manager'){
                          ?>
                          <a href="<?php echo base_url('mingguan/deletetkmdivisi')?>/<?php echo $ketiga['no']?>" class="btn btn-danger tombol-hapus"><i class='fa fa-trash'></i> Hapus</a>
                      <?php
                          }
                          else{
                            echo "";
                          }

                      }
                      ?>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  if(empty($proketiga)){
                    echo "Belum Diisi";
                  }else{
                  ?>
                  <div class="list-unstyled list-unstyled-border mt-4">
                    <?php
                    foreach ($proketiga AS $key):
                    ?>
                      <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                          <h6><?php echo $key['project']?></h6>
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
                  <?php
                  }
                  ?>
                </div>
                <div class="card-footer text-right">
                  <?php
                  if(empty($ketiga)){
                    echo "";
                  }else if($ketiga['status'] == 'Menunggu Approval'){
                    echo "<i class='fa fa-pause'></i>&nbsp;";
                    echo $ketiga['status'];
                  }
                  else if($ketiga['status'] == 'Revisi'){
                    echo "<i class='fa fa-edit'></i>&nbsp;";
                    echo $ketiga['status'];
                  }
                  else{
                    echo "<i class='fa fa-check'></i>&nbsp;";
                    echo $ketiga['status'];
                  }
                  ?>
                </div>
              </div>
              <!-- //Minggu Ketiga -->

            </div>

            <div class="col-12 col-md-6 col-lg-6">

              <!-- Minggu Keempat -->
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Target Kerja 04-05-2020 s/d 08-05-2020</h4>
                  <div class="card-header-action">
                      <?php
                      if(empty($keempat)){

                          if($this->session->userdata('ses_akses') == 'Manager'){
                          ?>
                          <a href="<?php echo base_url('mingguan/isitkm')?>/2020-05-04/2020-05-08" class="btn btn-info"><i class='fa fa-plus'></i> Isi</a>
                          <?php
                          }
                          else{
                          echo "";
                          }

                      }
                      else if($keempat['status'] == "Disetujui"){
                      ?>
                      <a href="<?php echo base_url('mingguan/viewtkmdivisi')?>/<?php echo $keempat['no']?>" class="btn btn-info"><i class='fa fa-eye'></i> View</a>
                      <?php
                      }
                      else{

                        if($this->session->userdata('ses_akses') == 'Manager'){
                        ?>
                        <a href="<?php echo base_url('mingguan/deletetkmdivisi')?>/<?php echo $keempat['no']?>" class="btn btn-danger tombol-hapus"><i class='fa fa-trash'></i> Hapus</a>
                        <?php
                        }
                        else{
                        echo "";
                        }

                      }
                      ?>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  if(empty($prokeempat)){
                    echo "Belum Diisi";
                  }else{
                  ?>
                  <div class="list-unstyled list-unstyled-border mt-4">
                    <?php
                    foreach ($prokeempat AS $key):
                    ?>
                      <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                          <h6><?php echo $key['project']?></h6>
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
                  <?php
                  }
                  ?>
                </div>
                <div class="card-footer text-right">
                  <?php
                  if(empty($keempat)){
                    echo "";
                  }else if($keempat['status'] == 'Menunggu Approval'){
                    echo "<i class='fa fa-pause'></i>&nbsp;";
                    echo $keempat['status'];
                  }
                  else if($keempat['status'] == 'Revisi'){
                    echo "<i class='fa fa-edit'></i>&nbsp;";
                    echo $keempat['status'];
                  }
                  else{
                    echo "<i class='fa fa-check'></i>&nbsp;";
                    echo $keempat['status'];
                  }
                  ?>
                </div>
              </div>
              <!-- //Minggu Keempat -->

              <!-- Minggu Kelima -->
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Target Kerja 11-05-2020 s/d 15-05-2020</h4>
                  <div class="card-header-action">
                      <?php
                      if(empty($kelima)){

                        if($this->session->userdata('ses_akses') == 'Manager'){
                        ?>
                        <a href="<?php echo base_url('mingguan/isitkm')?>/2020-05-11/2020-04-15" class="btn btn-info"><i class='fa fa-plus'></i> Isi</a>
                        <?php
                        }
                        else{
                        echo "";
                        }

                      }
                      else if($kelima['status'] == "Disetujui"){
                      ?>
                      <a href="<?php echo base_url('mingguan/viewtkmdivisi')?>/<?php echo $kelima['no']?>" class="btn btn-info"><i class='fa fa-eye'></i> View</a>
                      <?php
                      }
                      else{

                        if($this->session->userdata('ses_akses') == 'Manager'){
                        ?>
                        <a href="<?php echo base_url('mingguan/deletetmkdivisi')?>/<?php echo $kelima['no']?>" class="btn btn-danger tombol-hapus"><i class='fa fa-trash'></i> Hapus</a>
                      <?php
                        }
                        else{
                          echo "";
                        }

                      }
                      ?>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  if(empty($prokelima)){
                    echo "Belum Diisi";
                  }else{
                  ?>
                  <div class="list-unstyled list-unstyled-border mt-4">
                    <?php
                    foreach ($prokelima AS $key):
                    ?>
                      <div class="media">
                        <div class="media-icon"><i class="far fa-circle"></i></div>
                        <div class="media-body">
                          <h6><?php echo $key['project']?></h6>
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
                  <?php
                  }
                  ?>
                </div>
                <div class="card-footer text-right">
                  <?php
                  if(empty($kelima)){
                    echo "";
                  }else if($kelima['status'] == 'Menunggu Approval'){
                    echo "<i class='fa fa-pause'></i>&nbsp;";
                    echo $kelima['status'];
                  }
                  else if($kelima['status'] == 'Revisi'){
                    echo "<i class='fa fa-edit'></i>&nbsp;";
                    echo $kelima['status'];
                  }
                  else{
                    echo "<i class='fa fa-check'></i>&nbsp;";
                    echo $kelima['status'];
                  }
                  ?>
                </div>
              </div>
              <!-- //Minggu Kelima -->

            </div>

          </div>


      </div>
  </section>
</div>
