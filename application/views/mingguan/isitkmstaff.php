<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Isi Target Kerja Mingguan <?php echo $usernya['nama_user']?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/tkmdiv')?>">List TKM</a></div>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/viewtkmdivisi')?>/<?php echo $divnya['no']?>">View TKM</a></div>
        <div class="breadcrumb-item">Staff</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>
      <p class="section-lead"><?php echo $usernya['nama_user']?> <b><?php echo $divnya['daritanggal']; ?> s/d <?php echo $divnya['sampaitanggal']; ?></b></p>

      <div class="card card-primary">
        <div class="card-header">
          <h4>TKM Divisi <?php echo $divnya['divisi']?> <?php echo $divnya['daritanggal'] ?> s/d <?php echo $divnya['sampaitanggal'] ?></h4>
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="list-unstyled list-unstyled-border mt-4">
            <?php
            foreach ($tkmnya AS $key):
            ?>
              <div class="media">
                <div class="media-icon"><i class="far fa-circle"></i></div>
                <div class="media-body">
                  <h6><?php echo $key['project']; ?></h6>
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

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>TKM <?php echo $usernya['nama_user']?> <?php echo $divnya['daritanggal'] ?> s/d <?php echo $divnya['sampaitanggal'] ?></h4>
            </div>
            <div class="card-body">
              <div class="form-group row mb-4">
                <div class="col-sm-12">
                  <form action="<?php echo base_url('mingguan/prosesisitkmstaff')?>" method="POST">

                    <input type="hidden" name="idtkmdiv" value="<?php echo $divnya['no'] ?>">
                    <input type="hidden" name="userstaff" value="<?php echo $usernya['id_user']?>">

                  <ul class="umum">

                  <?php
                  $i = 0;
                  foreach ($kerjaan as $key):
                  $i++;
                  ?>

                      <li>
                        <div class="row">

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="project<?php echo $i; ?>">Project/Program/Pekerjaan :</label>
                              <input type="text" class="form-control" id="project<?php echo $i; ?>" name="project<?php echo $i; ?>" value="<?php echo $key['project']?>" readonly>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="deskripsi<?php echo $i; ?>">Keterangan :</label>
                              <input type="text" class="form-control" id="deskripsi<?php echo $i; ?>" value="<?php echo $key['deskripsi']?>" readonly>
                            </div>
                          </div>

                          <?php
                          $tamper = $this->db->query("SELECT sum(persentase) AS sumper FROM tkmstaff WHERE project='$key[project]'")->row_array();
                          ?>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Target Persentase</label>
                              <div class="input-group">
                                <input type="number" class="form-control" id="persentase<?php echo $i; ?>" name="persentase<?php echo $i; ?>" max="<?php echo $key['persentase'] - $tamper['sumper'];?>" placeholder="max : <?php echo $key['persentase'] - $tamper['sumper']; ?>">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <i class="fas fa-percent"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </li>

                      <?php endforeach; ?>
                    </ul>
                    <input type="hidden" name="jmlproject" value="<?php echo $i; ?>">

                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label col-12"></label>
                <div class="col-sm-12 col-md-7">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
