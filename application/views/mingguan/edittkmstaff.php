<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Isi Target Kerja Mingguan <?php echo $tkmnya['nama_user']?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/tkmdiv')?>">List TKM</a></div>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/viewtkmdivisi')?>/<?php echo $tkmnya['idtkmdiv']?>">View TKM Divisi</a></div>
        <div class="breadcrumb-item">Staff</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>
      <p class="section-lead"><?php echo $tkmnya['nama_user']?> - <?php echo $tkmnya['divisi'] ?> <b><?php echo $tkmnya['daritanggal']; ?> s/d <?php echo $tkmnya['sampaitanggal']; ?></b></p>

      <div class="card card-primary">
        <div class="card-header">
          <h4>TKM Divisi <?php echo $tkmnya['divisi']?> <?php echo $tkmnya['daritanggal'] ?> s/d <?php echo $tkmnya['sampaitanggal'] ?></h4>
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <?php echo $tkmnya['targetdiv']?>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>TKM <?php echo $tkmnya['nama_user']?> <?php echo $tkmnya['daritanggal'] ?> s/d <?php echo $tkmnya['sampaitanggal'] ?></h4>
            </div>
            <div class="card-body">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Target Kerja :</label>
                <div class="col-sm-12 col-md-7">
                  <form action="<?php echo base_url('mingguan/prosesedittkmstaff')?>" method="POST">

                  <input type="hidden" name="idtkmstaff" value="<?php echo $tkmnya['no']?>">
                  <input type="hidden" name="idtkmdiv" value="<?php echo $tkmnya['idtkmdiv']?>">
                  <textarea class="summernote-simple" name="target"><?php echo $tkmnya['target']?></textarea>
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
