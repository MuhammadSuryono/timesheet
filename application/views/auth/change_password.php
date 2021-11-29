
<?php 
 $user = $this->session->userdata('ses_username');
?>
<!-- Main Content -->
<style type="text/css">
  a.disabled {
  pointer-events: none;
  cursor: default;
}


</style>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Change Password</h1>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="row row-eq-height">


                  <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  
                   ?>

      <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
          <form method="POST" action="<?php echo base_url('auth/save_change_password') ?>" enctype="multipart/form-data">
            <input type="hidden" name="username" value="<?php echo $user ?>" >
          <div class="card-header">
            <h4>Change Password</h4>
            
          </div>
          <div class="card-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div style="width: 50%; margin: 0 auto;">
                            <div style="margin: 20px 0;">
                                <input type="password" name="oldpass" class="form-control" placeholder="Old Password" >
                                <?php echo form_error('oldpass', '<div class="error" style="color: red; margin: 20px 0;">', '</div>')?>
                            </div>
                            <div style="margin: 20px 0;">
                                 <input type="password" name="newpass" class="form-control" placeholder="New Password" >
                                 <?php echo form_error('newpass', '<div class="error" style="color: red; margin: 20px 0;">', '</div>')?>
                            </div>
                            <div style="margin: 20px 0;">
                              <input type="password" name="passconf" class="form-control" placeholder="Confirm Password">
                               <?php echo form_error('passconf', '<div class="error" style="color: red; margin: 20px 0;" >', '</div>')?>
                           </div>
                              <input type="submit" name="" value="SIMPAN" class="btn btn-success" style="width: 100%">
            </div>
          </div>
          
        </form>
        </div>
      </div>
    </div>


  </section>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });


</script>