<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; <?php echo SITE_NAME; ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('dist'); ?>/assets/modules/bootstrap/css/bootstraps.css">
  <link rel="stylesheet" href="<?php echo base_url('dist'); ?>/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url('dist'); ?>/assets/modules/jquery-selectric/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url('dist'); ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('dist'); ?>/assets/css/components.css">
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

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('dist') ?>/assets/img/logomri.png" alt="MRI TimeSheet WFH" width="100" class="shadow-light">
              </a>
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url('auth/prosesregister'); ?>">

                  <div class="form-group">
                    <label for="id_user">Username</label>
                    <input type="text" class="form-control" name="id_user" required>
                  </div>

                  <div class="form-group">
                    <label for="nama_user">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_user" required>
                  </div>
                  <div class="row">
                    <div class="col-lg">
                      <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" name="nik" required>
                      </div>
                    </div>
                    <div class="col-lg">
                      <div class="form-group">
                        <label for="tanggalMasuk">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggalMasuk" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="txtNewPassword" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                      <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input type="password" class="form-control" id="txtConfirmPassword" onChange="checkPasswordMatch();">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control" name="jabatan" id="jabatan" required>
                      <option value="">Piih Jabatan</option>
                      <option value="Manager">Manager</option>
                      <option value="Pegawai">Staff</option>
                    </select>
                  </div>

                  <div class="form-group">
                     <label for="divisi">Divisi</label>
                    <select class="form-control" name="divisi" required>
                      <option value="">Pilih Divisi</option>
                      <?php
                      foreach ($divisi as $key) {
                      ?>
                        <option value="<?php echo $key['divisi']; ?>"><?php echo $key['divisi']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="atasan">Nama Atasan</label>
                    <select class="form-control" name="atasan" id="atasan" required>
                      <option value="">Piih Nama Atasan</option>
                      
                    </select>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; <?php echo SITE_NAME; ?> <?php echo date('Y'); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo base_url('dist'); ?>/assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url('dist'); ?>/assets/modules/popper.js"></script>
  <script src="<?php echo base_url('dist'); ?>/assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url('dist'); ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('dist'); ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url('dist'); ?>/assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url('dist'); ?>/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?php echo base_url('dist'); ?>/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo base_url('dist'); ?>/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?php echo base_url('dist'); ?>/assets/js/page/auth-register.js"></script>

  <!-- Template JS File -->
  <script src="<?php echo base_url('dist'); ?>/assets/js/scripts.js"></script>
  <script src="<?php echo base_url('dist'); ?>/assets/js/custom.js"></script>

  <script>
    function checkPasswordMatch() {
      var password = $("#txtNewPassword").val();
      var confirmPassword = $("#txtConfirmPassword").val();

      var password2 = document.querySelector("#txtNewPassword");
      var confirmPassword2 = document.querySelector("#txtConfirmPassword");

      if (password != confirmPassword) {
        $("#divCheckPasswordMatch").html("Passwords do not match!");
          password2.style.border = "";
          confirmPassword2.style.border = "";

      } else if (password == confirmPassword && password != ''){
        $("#divCheckPasswordMatch").html("Passwords match.");
        password2.style.border = "3px solid green";
        confirmPassword2.style.border = "3px solid green";
        $("#divCheckPasswordMatch").style.color = "green";      
    }
  }

    $(document).ready(function() {
      $("#txtNewPassword, #txtConfirmPassword").keyup(checkPasswordMatch);
    });

    $(document).ready(function() {
       $('#jabatan').change(function() {
         var jabatan = $(this).val();
         
         console.log(jabatan);
         
         $('#atasan').empty();

         $.ajax({
           url: "<?php echo base_url('auth/get_atasan') ?>",
           method: "POST",
           data: {
             jabatan: jabatan
           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';

            text += '<option value="">Pilih Nama Atasan</option>';
             for (var i = 0; i < coba.length; i++) {
               text += '<option value="' + coba[i]['id_user'] + '">' + coba[i]['nama_user'] + '</option>';
             }

             $('#atasan').append(text);
           }
         });

       });
     });
  </script>

</body>

</html>