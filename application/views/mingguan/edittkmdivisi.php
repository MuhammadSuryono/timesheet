<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Target Kerja Mingguan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item"><a href="#">Mingguan</a></div>
        <div class="breadcrumb-item">Edit TKM</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>
      <p class="section-lead">Divisi <?php echo $tkmnya['divisi'] ?> <b><?php echo $tkmnya['daritanggal'] ?> s/d <?php echo $tkmnya['sampaitanggal'] ?></b></p>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Target Kerja :</label>
                <div class="col-sm-12 col-md-7">
                  <form action="<?php echo base_url('mingguan/prosesedittkm')?>" method="POST">

                  <input type="hidden" name="no" value="<?php echo $tkmnya['no'] ?>">

                  <textarea class="summernote-simple" name="target"><?php echo $tkmnya['target'] ?></textarea>
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
