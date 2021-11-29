<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>


    <?php
    if ($this->session->userdata('ses_akses') != 'Direksi') :
    ?>
      <div class="row">

        <div class="col-lg-6 col-md-6 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Target Kerja <?php echo $this->session->userdata('ses_nama') ?></h4>
            </div>
            <div class="card-body">

              <?php
              foreach ($caritarget as $key) {
              ?>
                <div class="mb-4">
                  <div class="text-small float-right font-weight-bold text-muted"><?php echo $key['persentase'] ?> %</div>
                  <div class="font-weight-bold mb-1"><?php echo $key['project'] ?></div>
                  <div class="progress" data-height="3">
                    <div class="progress-bar" role="progressbar" data-width="<?php echo $key['persentase'] ?>%" aria-valuenow="<?php echo $key['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              <?php
              }
              ?>

            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Target Kerja <?php echo $this->session->userdata('ses_divisi') ?></h4>
            </div>
            <div class="card-body">

              <?php
              foreach ($targetdiv as $td) {
              ?>
                <div class="mb-4">
                  <div class="text-small float-right font-weight-bold text-muted"><?php echo $td['persentase'] ?> %</div>
                  <div class="font-weight-bold mb-1"><?php echo $td['project'] ?></div>
                  <div class="progress" data-height="3">
                    <div class="progress-bar" role="progressbar" data-width="<?php echo $td['persentase'] ?>%" aria-valuenow="<?php echo $td['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              <?php
              }
              ?>

            </div>
          </div>
        </div>


      </div>
    <?php
    endif;
    ?>


    <?php
    if ($this->session->userdata('ses_akses') == 'Direksi') :
    ?>
      <div class="row">

        <div class="col-lg-6 col-md-6 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Target Project Semua Divisi</h4>
            </div>
            <div class="card-body">

              <?php
              foreach ($targetalldiv as $key) {
              ?>
                <div class="mb-4">
                  <div class="text-small float-right font-weight-bold text-muted"><?php echo $key['persentase'] ?> %</div>
                  <div class="font-weight-bold mb-1"><?php echo $key['divisi']; ?> - <?php echo $key['project'] ?></div>
                  <div class="progress" data-height="3">
                    <div class="progress-bar" role="progressbar" data-width="<?php echo $key['persentase'] ?>%" aria-valuenow="<?php echo $key['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              <?php
              }
              ?>

            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Pencapaian project semua divisi</h4>
            </div>
            <div class="card-body">

              <?php
              foreach ($targetcapaidiv as $td) {
                if ($td['totalper'] == NULL) {
                  $totalnya = 0;
                } else {
                  $totalnya = $td['totalper'];
                }
              ?>
                <div class="mb-4">
                  <div class="text-small float-right font-weight-bold text-muted"><?php echo $totalnya ?> %</div>
                  <div class="font-weight-bold mb-1"><?php echo $td['divisi'] ?> - <?php echo $td['project'] ?></div>
                  <div class="progress" data-height="3">
                    <div class="progress-bar" role="progressbar" data-width="<?php echo $totalnya; ?>%" aria-valuenow="<?php echo $totalnya; ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              <?php
              }
              ?>

            </div>
          </div>
        </div>


      </div>
    <?php
    endif;
    ?>

  </section>
</div>