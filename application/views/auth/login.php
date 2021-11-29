<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo SITE_NAME .": ". ucfirst($this->uri->segment(1)) ." - ". ucfirst($this->uri->segment(2)) ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('dist')?>/assets/modules/bootstrap/css/bootstraps.css">
  <link rel="stylesheet" href="<?php echo base_url('dist')?>/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url('dist')?>/assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url('dist')?>/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('dist')?>/assets/css/components.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('plugins')?>/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?php echo base_url('dist')?>/assets/img/logomri.png" alt="MRI TimeSheet WFH" width="100" class="shadow-light">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>TimeSheet WFH</h4></div>
              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
              <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
              <div class="card-body">
                <form method="POST" action="<?php echo base_url('auth/authlogin')?>" class="needs-validation" novalidate="">
                  <?php echo $this->session->flashdata('message'); ?>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" <?php if (isset($_COOKIE['username'])) { ?> value="<?= $_COOKIE['username'] ?>" <?php } ?> required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <!-- <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a>
                      </div> -->
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" <?php if (isset($_COOKIE['password'])) { ?> value="<?= $_COOKIE['password'] ?>" <?php } ?> required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember_me" class="custom-control-input" tabindex="3" id="remember-me" value="1" <?php if (isset($_COOKIE['username'])) { ?> checked <?php } ?>>
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                  <center><a href="<?php echo base_url('auth/forgotpassword')?>">Forgot Password?</a></center>
                </form>

              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="<?php echo base_url('auth/register')?>">Register!!</a>
            </div> -->
            <div class="simple-footer">
              Copyright &copy; <?php echo SITE_NAME; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo base_url('dist')?>/assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url('dist')?>/assets/modules/popper.js"></script>
  <script src="<?php echo base_url('dist')?>/assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url('dist')?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('dist')?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url('dist')?>/assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url('dist')?>/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="<?php echo base_url('dist')?>/assets/js/scripts.js"></script>
  <script src="<?php echo base_url('dist')?>/assets/js/custom.js"></script>

  <!-- SweetAlert2 -->
  <script src="<?php echo base_url()?>/plugins/sweet/js/sweetalert2.all.min.js"></script>
  <script src="<?php echo base_url()?>/dist/swal.js"></script>

</body>
</html>
