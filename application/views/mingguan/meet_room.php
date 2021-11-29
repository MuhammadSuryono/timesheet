
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
      <!-- <h1>Waiting List Target (Result Akhir)</h1> -->
      <h1> </h1>
    </div>
    <?php $akses = $this->session->userdata('ses_akses'); ?>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="row row-eq-height">

      <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h5>Detail Meeting</h5>
          </div>
            <div class="card-body">
            <table class="table table-bordered">
                <tr>
                  <th>Tanggal</th>
                  <td><?= date('d-m-Y', strtotime($meeting['tanggal'])) ?></td>
                </tr>
                <tr>
                  <th>Waktu</th>
                  <td><?=  date('H:i', strtotime($meeting['dari_jam']))." s/d ". date('H:i', strtotime($meeting['sampai_jam'])) ?></td>
                </tr>
                <tr>
                  <th>Divisi</th>
                  <td><?= $meeting['divisi'] ?></td>
                </tr>
                <tr>
                  <th>Keterangan</th>
                  <td><?= $meeting['keterangan'] ?></td>
                </tr>
            </table>
          </div>      
      </div>

      <div class="card">
        <?php
        $id_meet = $meeting['no'];
        $username = $this->session->userdata('ses_username');

        $cek_absen = $this->db->get_where('absensi_meeting', array('id_meeting' => $id_meet, 'username' => $username))->num_rows();
        $peserta = $this->db->query("SELECT * FROM absensi_meeting a LEFT JOIN tb_user b ON a.username=b.id_user WHERE id_meeting = '$id_meet' ORDER BY b.hak_akses, a.waktu ")->result_array();
        

           $awal_jam = $meeting['dari_jam'];
             $tambah = strtotime("+20 minutes",strtotime($meeting['dari_jam']));
             $akhir_jam = date('H:i:s', $tambah);
             $jam_now = date('H:i:s');
             // echo $awal_jam."<br>";
             // echo $akhir_jam."<br>";
             // echo $jam_now."<br>";

        
             
         ?>
          <div class="card-header">
            <h5>Peserta Meeting</h5>&nbsp;
            <?php if ($cek_absen == 0) {
              ?>
            <form action="<?= base_url('mingguan/absen') ?>" method="POST">
              <input type="hidden" name="username" value="<?= $username ?>">
              <input type="hidden" name="id_meet" value="<?= $meeting['no'] ?>">
            <?php $akses = $this->session->userdata('ses_akses');
             if ($akses != 'Manager') {
                if ($jam_now >= $awal_jam AND $jam_now <= $akhir_jam) {
             ?>
            <button type="submit" class="btn btn-success">Absensi Kehadiran</button>
          <?php }
            } ?>
          </form>
          <?php } ?>
          </div>
          
            <div class="card-body">
            <table class="table table-bordered">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <?php if ($meeting['pembuat'] == $username) { ?>  
                  <th>Konfirmasi Kehadiran</th>
                  <?php } ?>
                  <th>Waktu Kehadiran</th>
                </tr>
                <?php
                $no = 1; 
                foreach ($peserta as $db) {
                  ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $db['nama_user'] ?></td>
                  <?php if ($meeting['pembuat'] == $username) { ?>
                  <td class="text-center">
                  <?php if ($meeting['pembuat'] == $username AND ($db['waktu'] == NULL AND $meeting['pembuat'] != $db['username'])) { ?>
                    <input type="checkbox" name="confirm_absen<?= $db['username'] ?>" id="confirm_absen<?= $db['username'] ?>" value="<?= $db['username'] ?>" onchange="confirmAbsen('<?= $meeting['no'] ?>','<?= $db['username'] ?>')"> 
                    <?php } else if ($meeting['pembuat'] == $username AND $db['waktu'] != NULL AND $meeting['pembuat'] != $db['username']) { ?>
                      <input type="checkbox" name="confirm_absen<?= $db['username'] ?>" id="confirm_absen<?= $db['username'] ?>" value="<?= $db['username'] ?>" onchange="confirmAbsen('<?= $meeting['no'] ?>','<?= $db['username'] ?>')" checked>
                      <?php } ?> 
                  </td>
                <?php } ?>
                  <td>
                    <?php if ($db['waktu'] == NULL) {
                      echo "";
                    } else {
                     echo date('d-m-Y, H:i', strtotime($db['waktu'])). " WIB" ;
                   } ?></td>
                    

                </tr>
                <?php } ?>
            </table>
          </div>
          <div class="card-footer">
                  <?php if ($meeting['pembuat'] == $username) { ?>
                      <input type="submit" class="btn btn-success"  value="Konfirmasi" onClick="document.location.reload(true)">
                    <?php } ?>
          </div>      
      </div>

      <div class="card">
        <div class="card-header">
          <h5>Rentang Waktu TKM</h5>
        </div>
        <form method="POST" action="<?= base_url('mingguan/submit_rentang') ?>">
        <div class="card-body">
          <div class="row">
            <input type="hidden" name="no_meet" value="<?= $meeting['no'] ?>">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Dari Tanggal</label>
                <input type="date" class="form-control" name="daritanggal" value="<?= $meeting['daritanggal'] ?>" <?php if ($akses != 'Manager' AND $akses != 'Direksi'): ?> readonly <?php endif ?>>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Sampai Tanggal</label>
                <input type="date" class="form-control" name="sampaitanggal" value="<?= $meeting['sampaitanggal'] ?>" <?php if ($akses != 'Manager' AND $akses != 'Direksi'): ?> readonly <?php endif ?>>
              </div>
            </div>
          </div>
          <div>
          <?php if ($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_akses') == 'Direksi') {
            ?>
            <button type="submit" class="btn btn-success">Submit Rentang Waktu TKM</button>
          <?php } ?>
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
  function confirmAbsen(id_meet, username)
      {
        var val = $('#confirm_absen'+username).is(':checked');
        console.log(id_meet);
        console.log(username);
        console.log(val);
         if (val == true) {
            var absen = 'Yes';
            console.log(absen);
          }else{
            var absen = 'No';
            console.log(absen);
          }

          $.ajax({
           url: "<?= base_url('mingguan/confirmAbsen') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             id_meet: id_meet,
             username: username,
             absen: absen
           },
           success: function(hasil) {
             console.log('Berhasil Confirm Absensi')
           }
         });
      }
</script>