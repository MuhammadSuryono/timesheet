
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

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

      <input type="hidden" name="datenow" id="datenow" value="<?= date('Y-m-d') ?>">


    <div class="row row-eq-height">


                  <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username != '$user' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                  $kat = $this->db->get('wl_kategori')->result_array();

                   ?>

      <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
          <form method="POST" action="<?php echo base_url('mingguan/add_perpanjang') ?>" enctype="multipart/form-data">
            <input type="hidden" name="username" value="<?php echo $user ?>" >
          <div class="card-header">
            <h3>Daftar Target Kerja Mingguan</h3>
            
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Pekerjaan</th>
                    <th>Persentase</th>
                    <th>Target Sebelumnya</th>
                    <th>Perpanjang</th>
                    <th>Pilih</th>
                  </tr>
                </thead>
                <tbody>
                      <?php
                      // var_dump($caritarget);
                      $no = 1;
                       foreach ($caritarget as $cp) {
                        
                        $rincian = $this->db->query("SELECT * FROM rincian WHERE idpekerjaan='$cp[id_pekerjaan]'
                                                    AND idtkmdiv='$cp[idtkmdiv]' AND userstaff='$cp[userstaff]' AND id_tkmstaff='$cp[no]'
                                                    -- AND (targetpersen < 100 OR targetpersen = NULL)
                                                      ")->result_array();
                        // var_dump($rincian);
                      foreach ($rincian as $rin) {
                        if ($rin['targetpersen'] == 100) {
                          continue;
                        }
                        if($rin['targetpersen'] == NULL){
                          $persen = 0;
                        } else {
                          $persen = $rin['targetpersen'];
                        }
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $rin['rincian'] ?></td>
                          <td><?= $persen ?>%</td>
                          <td><?= date('d/m/Y', strtotime($rin['targetselesai'])) ?></td>
                          <td class="text-center">
                              <?php if($rin['status_perpanjang'] == 'Menunggu') { 
                               echo "Menunggu Approval";
                               } else {   ?>
                            <input type="checkbox" name="num[]" value="<?= $rin['id_rincian'] ?>" id="<?= $rin['id_rincian'] ?>" onchange="cekPerpanjang(<?= $rin['id_rincian'] ?>)">
                          <?php } ?>
                            </td>
                            <td><div id="isi_tgl<?= $rin['id_rincian'] ?>"></div></td>
                        </tr>
                      <?php
                        }
                      } ?>
                </tbody>
              </table>
            </div>


          </div>
          <div class="card-footer">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
              <!-- <p ><span class="font-weight-bold">Note : </span> Jika form berwarna <i class="fa fa-square fa-2x" style="color: #FFE4C4;"></i> dan disable maka list tersebut sudah masuk ke TKM</p> -->
          </div>
        </form>

          <!-- Modal -->
            
        </div>
      </div>
    </div>

 

    



  </section>
</div>
<!-- Modal -->

        </form>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });

  function cekPerpanjang(num)
  {
    $('#isi_tgl').empty();
    var ht = ``;

    var datanya = document.getElementById(num)
    console.log(datanya);
    ht += `<input style="margin-bottom: 5px;" type="date" width="80%" title="Pilih Tanggal Perpanjang Target" class="form-control" name="tgl_perpanjang`+num+`" required>
    <textarea class="form-control" placeholder="Alasan Perpanjang" name="alasan`+num+`" required></textarea>`;

    if (datanya.checked == true) {
      // alert("OKE");
      $('#isi_tgl'+num).append(ht);
    } else {
     $('#isi_tgl'+num).empty();

    } 
  }

</script>