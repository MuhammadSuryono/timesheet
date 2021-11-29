<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Isi Target Kerja Mingguan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/homemingguan')?>">Mingguan</a></div>
        <div class="breadcrumb-item">Divisi <?php echo $this->session->userdata('ses_divisi') ?> <?php echo $tanggalnya['t1']; ?> s/d <?php echo $tanggalnya['t2']; ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Divisi <?php echo $this->session->userdata('ses_divisi') ?>  &nbsp;<b><?php echo $tanggalnya['t1']; ?> s/d <?php echo $tanggalnya['t2']; ?></b>
            </div>
            <div class="card-body">

              <form action="<?php echo base_url('mingguan/isitkm')?>" method="POST">

                <input type="hidden" name="daritanggal" value="<?php echo $tanggalnya['t1']?>">
                <input type="hidden" name="sampaitanggal" value="<?php echo $tanggalnya['t2']?>">

                <ul class="umum">

                  <?php
                  if(empty($cariproject)){
                  echo "";
                  }
                  else{
                    $i = 0;
                    foreach ($cariproject as $cp) {
                    $i++;
                    ?>
                    <li>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="prapro<?php echo $i; ?>">Project/Program/Pekerjaan :</label>
                            <input type="text" class="form-control" id="prapro<?php echo $i; ?>" name="prapro<?php echo $i; ?>" value="<?php echo $cp['project']?>" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="prades<?php echo $i; ?>">Keterangan :</label>
                            <input type="text" class="form-control" id="prades<?php echo $i; ?>" name="prades<?php echo $i; ?>" value="<?php echo $cp['deskripsi']?>" readonly>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Target Persentase</label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="praper<?php echo $i; ?>" name="praper<?php echo $i; ?>" max="<?php echo 100 - $cp['sumper']; ?>" placeholder="max : <?php echo 100 - $cp['sumper']; ?>">
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <i class="fas fa-percent"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                        </div>

                      </div>
                    </li>
                    <?php
                      }
                      ?>
                      <input type="hidden" name="jmlprapo" value="<?php echo $i; ?>">
                  <?php
                  }
                  ?>



                  <li>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="project0">Project/Program/Pekerjaan :</label>
                          <input type="text" class="form-control" id="project0" name="project0">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="deskripsi0">Keterangan :</label>
                          <input type="text" class="form-control" id="deskripsi0" name="deskripsi0">
                        </div>
                      </div>

                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Target Persentase</label>
                          <div class="input-group">
                            <input type="number" class="form-control" id="persentase0" name="persentase0" min="1" max="100">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <i class="fas fa-percent"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for=""></label>
                          <button type="button" class="addrow btn btn-primary" style="display:block;"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                      </div>

                    </div>
                  </li>

                </ul>

                <input type="hidden" id="jmlproject" name="jmlproject" value="0">

                <div class="form-group">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>


              </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
