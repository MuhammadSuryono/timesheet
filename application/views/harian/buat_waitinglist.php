
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
          <form method="POST" action="<?php echo base_url('harian/add_waitinglist') ?>" enctype="multipart/form-data">
            <input type="hidden" name="username" value="<?php echo $user ?>" >
          <div class="card-header">
            <div class="row" style="width: 100%;">
            <div class="col-sm-6">
            <h4 class="ml-2">Pilih Kategori : </h4>
            <!-- <a href="#" type="button" name="add" id="add" class="add btn btn-primary">Add Row <i class="fas fa-plus-square"></i></a> -->
            <!-- <input type="button" name="button" value="SAVE" id="save_btn" class="btn btn-success ml-1" data-toggle="modal" data-target="#exampleModal"> -->
            <?php
            if ($this->session->userdata('ses_akses') == 'Manager') {
              ?>
            <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#wl_divisi">Waiting List Divisi</button> -->
          <?php } ?>
          <!-- <a href="<?= base_url('harian/buat_waitinglist') ?>" class="btn btn-primary">Buat Waiting List</a> -->
          <select class="form-control" id="pil_kategori">
               <option value=""></option>
              <?php foreach ($kat as $k) {
                ?>
              <option class="kateg" value="<?php echo $k['label'] ?>"><?php echo $k['label'] ?></option>
              <?php } ?>
          </select>
            </div>
            <div class="col-sm-2">
              <br>
              <button class="btn btn-primary" id="click">Click!</button>
            <!-- <a href="<?= base_url('harian/target') ?>" class="btn btn-warning">Target Kerja</a> -->
              
            </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table width="100%">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="50%">Deskripsi</th>
                  <th width="20%">Tanggal Delivery</th>
                  <th width="15%">Delivery To</th>

                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="input_row">
                
                

              </tbody>
            </table>
          </div>


          </div>
          <div class="card-footer">
            <input type="button" name="button" value="SAVE" id="save_btn" class="btn btn-success ml-1" data-toggle="modal" data-target="#exampleModal" style="display: none;">

              <!-- <p ><span class="font-weight-bold">Note : </span> Jika form berwarna <i class="fa fa-square fa-2x" style="color: #FFE4C4;"></i> dan disable maka list tersebut sudah masuk ke TKM</p> -->
          </div>

          <!-- Modal -->
            
        </div>
      </div>
    </div>

 

    



  </section>
</div>
<!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <b>Apakah Anda sudah yakin data yang telah Anda input sudah benar?</b>
                    <p></p>
                    <div id="data"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" name="submit" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>

        </form>

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

                    

                     $('#click').click(function(e){ //on add input button click
                       // if(e.offsetY < 0){
                          //user click on option 
                          console.log('pilih option'); 
                        

                      e.preventDefault();

                      var datenow = $('#datenow').val();

                      // var data = $(this).val();
                      var data = $('#pil_kategori').val();
                      console.log(data);

                      if(x < max_fields){ //max input box allowed

                      var cobaah = "";
                      // nomor++;

                       cobaah += "<tr class='py-3'>";
                       cobaah += "<input type='hidden' id='no' name='no[]' value='null';>";
                       cobaah += "<td>"+x+"</td>";
                       cobaah += " <td><div class='row pr-2 pt-3'>";
                       
                       // cobaah += "<div class='col-sm-12'><input type='text' name='pekerjaan[]' id='pekerjaan' class='form-control' value='"+data+" : ' placeholder='lanjutkan kalimat disini . . .'></div></div></td>";
                       cobaah += "<div class='col-sm-12'><textarea name='pekerjaan[]' id='pekerjaan' class='form-control' placeholder='lanjutkan kalimat disini . . .'>"+data+" : </textarea></div></div></td>";
                       cobaah += " <td>";
                       cobaah += "<input type='date' id='tgl_delivery' name='tgl_delivery[]' class='form-control' min='"+datenow+"' required>"
                       cobaah += "</td>";
                       cobaah += " <td>";
                       cobaah += "<input type='text' id='delivery_to' name='delivery_to[]' class='form-control' required>"
                       cobaah += "</td>";
                       cobaah += " <td>";
                       cobaah += "<a href='#' class='btn btn-danger remove_field' title='Delete'><i class='fas fa-trash-alt'></i></a>"
                       cobaah += "</td>";
                       cobaah += " </tr>";
                       
                       
                       
                       x++; //text box increment
                       if (data != null || data != '') {
                          $(wrapper).append(cobaah); //add input box
                          $('#save_btn').css('display', 'block');
                       }
                     }
                        // }else{
                        //   //dropdown is shown
                        //   console.log('dropdown show'); 

                        // }

                    
                     });
 
                     $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                      e.preventDefault(); $(this).closest('tr').remove(); x--;
                     })


                   $('#save_btn').click(function(e){ //on add input button click
                      e.preventDefault();
                       $('#data').empty();
                      var ht = '';
                      console.log($("input[id='pekerjaan']").val());
                     
                     // $("input[id='pekerjaan']").each(function(index) {
                     $("textarea[id='pekerjaan']").each(function(index) {

                      var kat = $(this).val();
                      console.log(kat);
                      var noo = index +1;
                        ht += noo +`. `+kat+`<br>`;
                      });
                     $('#data').append(ht);
                   });
                    });
</script>