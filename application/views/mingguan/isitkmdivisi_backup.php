<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Isi Target Kerja Mingguan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item"><a href="#">Mingguan</a></div>
        <div class="breadcrumb-item">Divisi <?php echo $this->session->userdata('ses_divisi') ?> <?php echo $tanggalnya['t1']; ?> s/d <?php echo $tanggalnya['t2']; ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>
      <p class="section-lead">Divisi <?php echo $this->session->userdata('ses_divisi') ?> <b><?php echo $tanggalnya['t1']; ?> s/d <?php echo $tanggalnya['t2']; ?></b></p>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Target Kerja :</label>
                <div class="col-sm-12 col-md-7">
                  <form action="<?php echo base_url('mingguan/prosesisitkm')?>" method="POST">

                  <input type="hidden" name="daritanggal" value="<?php echo $tanggalnya['t1']?>">
                  <input type="hidden" name="sampaitanggal" value="<?php echo $tanggalnya['t2']?>">

                  <textarea class="summernote-simple" name="target" required></textarea>

                  <div class="row">

                    <div class="col-sm-4">

                      <div class="form-group">
                        <label for="project1">Project/Program/Pekerjaan</label>
                        <input type="text" class="form-control" name="project">
                      </div>

                      <div class="form-group">
                        <label for="project1">Keterangan</label>
                        <input type="text" class="form-control" name="deskripsi">
                      </div>

                      <div class="form-group">
                        <label for="project1">Target Presentase</label>
                        <input type="number" class="form-control" name="presentase" max="100" min="1">
                      </div>

                    </div>

                  </div>

                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
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
