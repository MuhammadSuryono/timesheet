
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
      <!-- <h1>Target Kerja</h1> -->
      <h1>Target Kerja <i class="fas fa-long-arrow-alt-right fa-2x"></i> Status Target Kerja</h1>

    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="row row-eq-height">


                  <?php
                  $time = strtotime("-3 month", time());
                  $bulan3 = date("Y-m-d", $time);
                  $datenow = date("Y-m-d");
                  
                  $divisinya = $this->session->userdata('ses_divisi');
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user 
                    WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username != '$user' AND a.tgl_input between '$bulan3' AND '$datenow' 
                    ORDER BY b.hak_akses, b.nama_user ASC")->result_array();

                   ?>

      <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
          <form method="POST" action="<?php echo base_url('harian/add_waitinglist') ?>" enctype="multipart/form-data">
            <input type="hidden" name="username" value="<?php echo $user ?>" >
          <div class="card-header">
<!--             <div class="row" style="width: 100%;">
            <div class="col-sm-6">
            <h4></h4>
            <a href="#" type="button" name="add" id="add" class="add btn btn-primary">Add Row <i class="fas fa-plus-square"></i></a>
            <input type="submit" name="submit" value="SAVE" class="btn btn-success ml-1">
            <?php
            if ($this->session->userdata('ses_akses') == 'Manager') {
              ?>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#wl_divisi">Waiting List Divisi</button>
          <?php } ?>
            </div>
            <div class="col-sm-6 text-right">
            <a href="<?= base_url('harian/target') ?>" class="add btn btn-warning">Target Kerja</a>
              
            </div> -->
            <!-- </div> -->
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table width="100%" class="table table-bordered table-hover" id="table_tkm1">
              <thead style="background-color: #7FFFD4;">
                <tr>
                  <th width="25px">No</th>
                  <th>Target Kerja</th>
                  <th>Tanggal Delivery</th>
                  <th>Status</th>
                  <th width="10%">Persentase</th>

                  <!-- 
                    <th>Aksi</th> -->
                </tr>
              </thead>
              <tbody class="input_row">
                 <?php
                 $query = $this->db->query("SELECT a.*, c.targetpersen, c.status FROM list_note a JOIN uraian b ON a.id=b.id_list JOIN rincian c ON b.id_uraian=c.id_list  WHERE username = '$user' AND to_tkm='Y' ORDER BY tgl_delivery DESC")->result_array();

                 if ($query != NULL) {
                  
                  $no = 1;
                 foreach ($query as $row) :
                  $h_min7 = date('Y-m-d', strtotime('-7 days', strtotime($row['tgl_delivery'])));
                  $datenow = date('Y-m-d');
                 
                 ?>
                <tr class="py-3">
                  <input type="hidden" id="no" name="no[]" value="<?php echo $row['id'] ?>">
                  <input type="hidden" name="kategori_wl[]">
                  <td class="text-center"><div class="pr-2 pt-3" ><?php echo $no++; ?></div></td>
                  <td>
                   <?php echo $row['pekerjaan'] ?>
                   <div class="pr-2 pt-3"><input type="hidden" name="pekerjaan[]" value="<?php echo $row['pekerjaan'] ?>" class="form-control  font-weight-bold" readonly style="background-color: #FFE4C4; " data-trigger="hover" data-toggle="popover" data-placement="left" title="Waiting List" data-content="Sudah masuk ke TKM"></div>
                  </td>
                  <td>
                    <?php if ($row['tgl_delivery'] != NULL) {
                      if ($datenow >= $h_min7 AND $datenow <= $row['tgl_delivery'] ) {
                          echo "<span class='text-danger faa-flash animated faa-slow'>".date('d/m/Y', strtotime($row['tgl_delivery']))."</span>";
                          } else {
                         echo date('d/m/Y', strtotime($row['tgl_delivery']));
                        }
                    } else {
                     echo ''; 
                    } ?>
                  </td>
                  <td width="15%"><?= $row['status'] ?></td>
                  <td width="15%"><?= $row['targetpersen'] ?><?php if ($row['targetpersen'] != NULL) { echo "%";} ?></td>
                  
                </tr>
              <?php endforeach;
              } ?>
                
              <?php  ?>

              </tbody>
            </table>
          </div>


          </div>
          <div class="m-3">
              <!-- <p ><span class="font-weight-bold">Note : </span> Jika form berwarna <i class="fa fa-square fa-2x" style="color: #FFE4C4;"></i> dan disable maka list tersebut sudah masuk ke TKM</p> -->
          </div>

        </form>
        </div>
      </div>
    </div>

 

    



  </section>
</div>

   <!-- Modal -->
<div class="modal fade" id="wl_divisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Waiting List Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover  table-striped">
            <thead class="bg-info">
              <tr>
                <th class="text-white">No</th>
                <th class="text-white">Waiting List</th>
                <th class="text-white">Pembuat</th>
                <!-- <th class="text-white">Tanggal Input</th> -->
                
                
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if ($waitinglist != NULL) {
                
              foreach ($waitinglist as $wl) {
                ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $wl['pekerjaan']; ?></td>
                <td><?php echo $wl['nama_user']; ?></td>
                <!-- <td><?php echo $wl['tgl_input']; ?></td> -->
                
              </tr>
            <?php }
            } else { ?>
              <tr>
                <td colspan="3"><center><h6>Data Tidak Tersedia</h6></center></td>
                
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" >Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });


  $(document).ready(function() {
                     var max_fields      = 100; //maximum input boxes allowed
                     var wrapper     = $(".input_row"); //Fields wrapper
                     var add_button      = $(".add"); //Add button ID


                     // var nomor = document.getElementById('nomor').value;
                     
                     var x = 1; //initlal text box count
                     $(add_button).click(function(e){ //on add input button click
                      e.preventDefault();

                       $.ajax({
                         url: "<?php echo base_url('harian/getlabel_wl') ?>",
                         method: "POST",
                         data: {
                           


                         },
                         async: false,
                         dataType: 'json',
                         success: function(coba) {
                          console.log(coba);
                      if(x < max_fields){ //max input box allowed

                      var cobaah = "";
                      // nomor++;


                      
                       cobaah += "<tr class='py-3'>";
                       cobaah += "<input type='hidden' id='no' name='no[]' value='null';>";
                       cobaah += " <td><div class='pr-2 pt-3'><input type='text' id='nomor' value='' class='form-control' readonly></div></td>";
                       cobaah += " <td><div class='row pr-2 pt-3'>";
                       cobaah += " <div class='col-sm-3'><select class='form-control' name='kategori_wl[]'>";
                       cobaah += " <option value='test'>--Pilih Kategori--</option>";
                       for (var i = 0; i < coba.length; i++) {
                         cobaah += " <option value='"+coba[i]['label']+"'>"+coba[i]['label']+"</option>";
                       }
                       cobaah += " </select></div>";
                       
                       cobaah += "<div class='col-sm-9'><input type='text' name='pekerjaan[]' class='form-control' placeholder='lanjutkan kalimat disini . . .'></div></div></td>";
                       cobaah += " <td>";
                       cobaah += "<a href='#' class='btn btn-danger remove_field' title='Delete'><i class='fas fa-trash-alt'></i></a>"
                       cobaah += "</td>";
                       cobaah += " </tr>";
                       
                       
                       
                       x++; //text box increment
                       $(wrapper).append(cobaah); //add input box
                     }

                      }
                    });
                     });
 
                     $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                      e.preventDefault(); $(this).closest('tr').remove(); x--;
                     })
                    });

   $(document).ready( function () {
    for (var i = 1; i <= 99; i++) {
       
         $('#table_tkm'+i).dataTable({
           "responsive": true,
           "searching": true,
           "ordering": true,
           "info": true,
           "scrollY": "",
           "scrollCollapse": true,
           "paging": true,
           "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
         });
       }
} );
</script>