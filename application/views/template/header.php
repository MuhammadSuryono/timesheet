<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo SITE_NAME . ": " . ucfirst($this->uri->segment(1)) . " - " . ucfirst($this->uri->segment(2)) ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/modules/bootstrap/css/bootstraps.css">
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css"/>

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/modules/chocolat/dist/css/chocolat.css">
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/modules/select2/dist/css/select2.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/css/custom.css">
  <link rel="stylesheet" href="<?php echo base_url('dist') ?>/assets/css/components.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('plugins') ?>/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<style>
	.shadow {
		box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
	}

	.pointer {
		cursor: pointer;
	}
</style>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <h3 class="text-white">
							<?= isset($judul) ? $judul : 'MRI TIMESHEET WFH ' ?>
            </h3>
          </ul>
        </form>
        <?php
        $direksi = $this->session->userdata('ses_username');
        $cariapprove = $this->db->query("SELECT
                                          	a.*
                                          FROM
                                          	tkmdivisi a
                                          JOIN tb_user b ON a.pengisi = b.id_user
                                          WHERE
                                          	a.status = 'Menunggu Approval'
                                          	AND b.atasan='$direksi'
                                          ORDER BY
                                            NO ASC")->result_array();
        if (empty($cariapprove)) {
          $beep = "";
        } else {
          $beep = "beep";
        }
        ?>
      
        <ul class="navbar-nav navbar-right">
					<a href="#" data-toggle="modal" data-target='#information-modal' class="nav-link nav-link-lg"><i class="far fa-question-circle"></i></a>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg <?php echo $beep; ?>"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <!-- <a href="#">Mark All As Read</a> -->
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <?php
                if (empty($cariapprove)) {
                  echo "<p>Tidak ada notifikasi</p>";
                } else {

                  foreach ($cariapprove as $key) {
                ?>
                    <a href="<?php echo base_url('mingguan/approvalmingguan') ?>" class="dropdown-item">
                      <div class="dropdown-item-icon bg-info text-white">
                        <i class="far fa-user"></i>
                      </div>
                      <div class="dropdown-item-desc">
                        <b><?php echo $key['divisi'] ?></b> meminta persetujuan untuk target
                        <div class="time"><?php echo date('d-m-Y H:i', strtotime($key['tanggalisi'])) ?></div>
                      </div>
                    </a>
                <?php
                  }
                }
                ?>
                <div class="dropdown-footer text-center">
                  <?php
                  if (empty($cariapprove)) {
                    echo "";
                  } else {
                  ?>
                    <a href="<?php echo base_url('mingguan/approvalmingguan') ?>">View All <i class="fas fa-chevron-right"></i></a>
                  <?php
                  }
                  ?>
                </div>
              </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?php echo base_url('dist') ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block"><?php echo $this->session->userdata('ses_nama'); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('auth/change_password') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-user-lock"></i> Change Password
              </a>
              <a href="<?php echo base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

			<div class="modal fade" id="information-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle"></i> Informasi Tambahan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="accordion">
								<div class="card shadow">
									<div class="card-header pointer" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<h6 class="mb-0">
												> Perhitungan Perolehan Poin
										</h6>
									</div>

									<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="card-body">
											<b>Ketentuan Perolehan Poin:</b>
											<p>Total keseluruhan poin penilaian adalah 100. Perolehan nilai akan menurun jika ketentuan dibawah ini terjadi, berikut ketentuan perhitungan perolehan poin:</p>
											<ol>
												<li>Setiap pekerjaan setidaknya memiliki data diskusi dengan pihak terkait baik itu manager maupun divisi lain terkait dengan pekerjaan tersebut</li>
												<li>Perolehan nilai akan sempurna jika pekerjaan diselesaikan <b>Tepat Waktu</b> atau <b>Lebih cepat</b> dari target yang telah dibuat</li>
												<li>Jika pekerjaan diselesaikan lewat dari target yang di tentukan dan masih dalam periode minggu TKM, poin akan berkurang <b>5 Poin</b> untuk per-harinya</li>
												<li>Jika pekerjaan diselesaikan lewat dari target serta melewati batas TKM yang disepakati dan namun disertai data diskusi, poin akan berkurang <b>25 poin</b> setiap minggunya</li>
												<li>Jika pekerjaan diselesaikan lewat dari target serta melewati batas TKM yang disepakati dan <b>tidak</b> disertai data diskusi, poin akan berkurang <b>50 poin</b> setiap minggunya</li>
												<li>Jika pekerjaan diselesaikan lewat dari target serta melewati batas TKM yang disepakati sebanyak 2x dan <b>tidak</b> disertai data diskusi, staff serta atasannya akan dikenakan <span class="text-danger">PINALTI</span></li>
											</ol>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
