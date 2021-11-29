
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



    <div class="row row-eq-height">


                  <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  // if ($this->session->userdata('ses_akses') == 'Direksi') {
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.atasan='$user' AND a.to_tkm = 'N' AND a.username != '$user' ORDER BY b.nama_user, a.tgl_delivery ASC")->result_array();
                  // } else {
                  // $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username != '$user' ORDER BY b.nama_user, a.tgl_delivery ASC")->result_array();
                  // }

                  $kat = $this->db->get('wl_kategori')->result_array();

                   ?>

      <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
              <div class="card-body">
              <div class="row" style="width: 100%;" >
                  <div class="col-sm-12">
                  <h5>Alur Pembuatan TKM</h5>
                </div>
                  <div class="col-sm-12">
                    <div class="progress">
                      <?php $username = $this->session->userdata('ses_username');
                       $cek = $this->db->get_where('progress_bar', array('username' => $username))->row_array(); ?>
                      <div class="progress-bar" role="progressbar" data-width="<?= $cek['persentase'] ?>%" aria-valuenow="<?= $cek['persentase'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $cek['persentase'] ?>%</div>
                    </div>
                  </div>
                </div>
                  <div class="col-sm-12 row">
                    <div style="width: 25%" class="text-center font-weight-bold">Undangan TKM</div>
                    <div style="width: 25%" class="text-center font-weight-bold">Meeting TKM</div>
                    <div style="width: 25%" class="text-center font-weight-bold">Review Waiting List</div>
                    <div style="width: 25%" class="text-center font-weight-bold">Approval TKM</div>

                  </div>
                <!-- </div> -->
              </div>
            </div>
        <div class="card">
          <form method="POST" action="<?php echo base_url('harian/add_waitinglist') ?>" enctype="multipart/form-data">
            <input type="hidden" name="username" value="<?php echo $user ?>" >
          <div class="card-header">
            <div class="row" style="width: 100%;">
            <div class="col-sm-6">
            <h4></h4>
            <!-- <a href="#" type="button" name="add" id="add" class="add btn btn-primary">Add Row <i class="fas fa-plus-square"></i></a> -->
            <!-- <input type="button" name="button" value="SAVE" id="save_btn" class="btn btn-success ml-1" data-toggle="modal" data-target="#exampleModal"> -->
            <?php
            if ($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_akses') == 'Direksi') {
              ?>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#wl_divisi">Draft Waiting List Divisi</button>
          <?php } ?>
          <a href="<?= base_url('harian/buat_waitinglist') ?>" class="btn btn-primary">Tambah Waiting List</a>
<!--           <select class="form-control" id="pil_kategori">
               <option value="">Pilih Kategori</option>
              <?php foreach ($kat as $k) {
                ?>
              <option value="<?php echo $k['label'] ?>"><?php echo $k['label'] ?></option>
              <?php } ?>
          </select> -->
            </div>
            <div class="col-sm-6 text-right">
            <a href="<?= base_url('harian/target') ?>" class="btn btn-warning">Target Kerja</a>
              
            </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table width="100%" class="table table-bordered table-hover" id="table_tkm1">
              <thead style="background-color: #E0FFFF;" >
                <tr >
                  <th width="25px">No</th>
                  <th>Waiting List</th>
                  <th>Tanggal Delivery</th>
                  <th>Delivery To</th>

                  <th width="70px" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody class="input_row">
                 <?php
                 $query = $this->db->query("SELECT * FROM list_note WHERE username = '$user' AND to_tkm='N' ORDER BY tgl_delivery ASC")->result_array();

                 if ($query != NULL) {
                  
                  $no = 1;
                 foreach ($query as $row) :
                  $h_min7 = date('Y-m-d', strtotime('-14 days', strtotime($row['tgl_delivery'])));
                  $datenow = date('Y-m-d');
                 
                 
                 ?>
                <tr class="py-3">
                  <input type="hidden" id="no" name="no[]" value="<?php echo $row['id'] ?>">
                  <input type="hidden" name="kategori_wl[]">
                  <td class="text-center"><div class="pr-2 pt-3" ><?php echo $no++; ?></div></td>
                  <td>
                  <div class="pr-2 pt-3">
                   <?php echo $row['pekerjaan'] ?>
                    <input type="hidden" name="pekerjaan[]" value="<?php echo $row['pekerjaan'] ?>" class="form-control">
                  </div>
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
                  <td><?= $row['delivery_to'] ?></td>
                  <td>
                    <div >
                      <?php if($row['approve'] == 'Yes') { ?>
                      <button type="button" id="btn_editwl" class="btn btn-secondary" data-toggle="modal" data-target="#edit_wl<?= $row['id'] ?>" title="Sudah di Approve" disabled><i class="fas fa-edit"></i></button>
                      <a href="<?php echo base_url('harian/delete_waitinglist/'.$row['id'].'/'.$user) ?>" type="button" class="btn btn-secondary tombol-hapus" title="Sudah di Approve" style="pointer-events: none;"><i class="fas fa-trash-alt"></i></a>
                     <?php } else { ?>
                      <button type="button" id="btn_editwl" class="btn btn-warning" data-toggle="modal" data-target="#edit_wl<?= $row['id'] ?>" ><i class="fas fa-edit"></i></button>
                      <a href="<?php echo base_url('harian/delete_waitinglist/'.$row['id'].'/'.$user) ?>" type="button" class="btn btn-danger tombol-hapus" title="Delete"><i class="fas fa-trash-alt"></i></a>
                  <?php } ?>
                  </div>
                  </td>
                </tr>
              <?php endforeach;
              } else { ?>
                <!-- <tr>
                  <td colspan="3" class="text-center font-weight-bold" style="border: 5px ridge grey;">Belum Ada Data</td>
                </tr> -->
              <?php }  ?>

              </tbody>
            </table>
          </div>
          <br><br>
          <b><span class="font-weight-bold text-warning">Catatan :</span> 
            <br> - Arti tanda kedip-kedip menandakan bahwa waiting list tersebut akan masuk rentang periode TKM minggu berikutnya.
            <br> - Draft Waiting List yang sudah di approve tidak dapat di edit maupun di delete.
          </b>


          </div>
          <div class="card-footer">
            <?php if ($query != NULL) {
                  ?>
            <input style="display: none;" type="button" name="button" value="UPDATE  " id="save_btn" class="btn btn-success ml-1" data-toggle="modal" data-target="#exampleModal">
          <?php } ?>

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
                    <b>Apakah Anda sudah yakin data yang telah di edit atau di update sudah benar?</b>
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
  <div class="modal-dialog modal-lg" role="document" style="min-width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Draft Waiting List Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <?php
        $head = $this->db->get_where('tb_user', array('atasan' => $user))->result_array();
        $poll = [];
        $div = [];
          foreach ($head as $row) {
            $poll[] = $row['id_user'];
            $div[] = $row['divisi'];
          }
          // $imploded_arr = implode(',', $poll);
          if ($poll != NULL) {
           $daftar = $this->db->where_in('atasan', $poll)->or_where('atasan', $user)->group_by('id_user')->order_by('nama_user', 'ASC')->get('tb_user')->result_array();
          } else {
          $daftar = $this->db->where('atasan', $user)->group_by('id_user')->order_by('nama_user', 'ASC')->get('tb_user')->result_array();
          }
        // $daftar = $this->db->query("SELECT * FROM tb_user WHERE (atasan='$user' OR atasan IN ('".implode(',',$poll)."'))")->result_array(); ?>
        
        <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#wl" class="nav-link active" id="klik_wl" data-toggle="tab">
                                    Draft Waiting List Divisi </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#perpanjang" class="nav-link" id="klik_perpanjang" data-toggle="tab">Pengajuan Perpanjang Target Selesai</a>
                                </li>
                                
      </ul>

      <div class="tab-content">
        <div class="tab-pane fade show active" id="wl">
        <div class="row">
            <div class="col-sm-2"><strong>Pilih Nama :</strong></div>
            <div class="mb-5 col-sm-5">
              <select class="form-control selectpicker select2" id="nama_kar" style="width: 100%;">
                <option>--Pilih Nama Karyawan--</option>
                <?php foreach ($daftar as $row) {
                  ?>
                <option value="<?= $row['id_user'] ?>"><?= $row['nama_user'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-2"><button class="btn btn-primary" id="btn_kar">Tampilkan</button></div>
        </div>

        <div class="table-responsive">
          <form method="POST" action="<?php echo base_url('harian/set_wl') ?>" enctype="multipart/form-data">
          <table class="table table-bordered table-hover  table-striped" id="table_tkm2">
            <thead class="bg-info">
              <tr>
                <th class="text-white" style="width: 5%">No</th>
                <th class="text-white" style="width: 30%">Waiting List</th>
                <th class="text-white" style="width: 25%">Delivery To</th>
                <th class="text-white" style="width: 10%">Tanggal Delivery</th>
                <th class="text-white" style="width: 10%">Pembuat</th>
                 <th class="text-white">Approve</th>
         
              </tr>
            </thead>
            <tbody id="data_wl">
              <!-- <?php
              $no = 1;
              if ($waitinglist != NULL) {
                
              foreach ($waitinglist as $wl) {
                ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $wl['pekerjaan']; ?></td>
                  <td><?= $wl['delivery_to'] ?></td>
                <td>
                    <?php echo date('d/m/Y', strtotime($wl['tgl_delivery'])) ?>
                  </td>
                <td><?php echo $wl['nama_user']; ?></td>
                
              </tr>
            <?php }
            } else { ?>
              <tr>
                <td colspan="3"><center><h6>Data Tidak Tersedia</h6></center></td>
                
              </tr>
            <?php } ?> -->
            </tbody>
          </table>
          <div class="text-right" id="lok_approve"></div>
        </form>
        </div>
      </div>

        <div class="tab-pane fade show" id="perpanjang">
          <h6>Daftar Pengajuan Perpanjang Target Selesai Pekerjaan</h6>
          <br>
          <div class="table-responsive">
          <form method="POST" action="<?php echo base_url('mingguan/approve_perpanjang') ?>" enctype="multipart/form-data">
          <table class="table table-bordered table-hover  table-striped" id="table_tkm5">
              <thead style="background-color: #66CDAA;">
                <tr >
                  <th class="text-white">No</th>
                  <th class="text-white">Pekerjaan</th>
                  <th class="text-white">Target Selesai Sebelumnya</th>
                  <th class="text-white">Target Selesai Baru</th>
                  <th class="text-white">Alasan</th>
                  <th class="text-white">Pembuat</th>
                  <th class="text-white" style="min-width: 40px;">Aksi</th> 
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1; 
                foreach ($perpanjangan as $perp) {
                ?>
                <input type="text" name="num[]" value="<?= $perp['id_rincian'] ?>" style="display: none;">
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $perp['rincian']; ?></td>
                  <td><?= date('d/m/Y', strtotime($perp['targetselesai'])); ?></td>
                  <td><?= date('d/m/Y', strtotime($perp['tgl_diajukan'])); ?></td>
                  <td><?= $perp['alasan_perpanjang']; ?></td>
                  <td><?= $perp['nama_user']; ?></td>
                  <td>
                    <!-- <input type="checkbox" id="checknya" name="id_perpanjangan[]" value="<?= $perp['id_rincian'] ?>"> -->
                    <input type="radio" id="checknya" name="id_perpanjangan<?= $perp['id_rincian'] ?>" value="1"><b class="text-primary"> Setujui</b> <br>
                    <input type="radio" id="checknya_tolak" name="id_perpanjangan<?= $perp['id_rincian'] ?>" value="0"><b class="text-danger"> Tolak</b>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
          </table>
          <div class="text-right">
            <input type="checkbox" id="all_check" onchange="checkAll(this)"> <b>Setujui Semua</b>
            <input type="submit" name="submit" value="Approve" class="btn btn-success">
          </div>
          </form>
          </div>
        </div>

    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" >Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal EDIT WL -->
<?php 
$no = 0;
                 foreach ($query as $row) :
                  $no++;
                  ?>
            <div class="modal fade" id="edit_wl<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Waiting List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="<?= base_url('harian/editin_wl') ?>" method="POST">
                  <div class="modal-body">
                    <input type="hidden" name="id_wl" id="id_wl" class="form-control" value="<?= $row['id'] ?>">
                    <div class="form-group">
                      <label id="waitinglist" class="font-weight-bold">Waiting List</label>
                      <textarea id="waitinglist" name="waitinglist" class="form-control" rows="4" style="height:100%;"><?= $row['pekerjaan'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label id="delivery" class="font-weight-bold">Tanggal Delivery</label>
                      <input type="date" name="delivery" id="delivery" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= $row['tgl_delivery'] ?>">
                    </div>
                    <div class="form-group">
                      <label id="to" class="font-weight-bold">Delivery To</label>
                      <input type="text" name="to" id="to" class="form-control" value="<?= $row['delivery_to'] ?>">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
<?php endforeach; ?>


<!-- EDIT MODAL HEAD -->
        <div class="modal fade" id="head_editwl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Waiting List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id_wl" id="id_head" class="form-control">
                    <input type="hidden" name="id_wl" id="pembuat_head" class="form-control">

                    <div class="form-group">
                      <label id="waitinglist" class="font-weight-bold">Waiting List</label>
                      <textarea id="kalimat_head" name="waitinglist" class="form-control" rows="4" style="height:100%;"></textarea>
                    </div>
                    <div class="form-group">
                      <label id="delivery" class="font-weight-bold">Tanggal Delivery</label>
                      <input type="date" name="delivery" id="delivery_head" class="form-control">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="submit_head" name="submit" class="btn btn-primary" data-dismiss="modal">Save</button>
                  </div>
                </div>
              </div>
            </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

  function checkAll(box) 
  {
   let checkboxes = document.querySelectorAll("[id='checknya']");
if (box.checked) { // jika checkbox teratar dipilih maka semua tag input juga dipilih
    for (let i = 0; i < checkboxes.length; i++) {
     if (checkboxes[i].type == 'radio') {
      checkboxes[i].checked = true;
     }
    }
   } else { // jika checkbox teratas tidak dipilih maka semua tag input juga tidak dipilih
    for (let i = 0; i < checkboxes.length; i++) {
     if (checkboxes[i].type == 'radio') {
      checkboxes[i].checked = false;
     }
    }
   }
  }


  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });

  $('#btn_kar').click(function(){
    var user = $('#nama_kar').val();
    console.log(user);

    $('#data_wl').empty();
    $('#lok_approve').empty();


    $.ajax({
     url: "<?php echo base_url('harian/getdaftar_wl') ?>",
     method: "POST",
     data: {
         id_user : user                  
     },
      async: false,
     dataType: 'json',
     success: function(coba) {
      console.log(coba);

      var no = 0;
      var ht = '';
      var bt = '';
      for (var i = 0; i < coba.length; i++) {
        var today = coba[i]['tgl_delivery'].split("-");
        var tanggal = today[2]+"/"+today[1]+"/"+today[0];
        no++;

        ht += '<tr>';
        ht += '<input type="hidden" name="num[]" value="'+coba[i]['id']+'" >';
        ht += '<td>'+no+'</td>';
        ht += '<td>'+coba[i]['pekerjaan']+'</td>';
        ht += '<td>'+coba[i]['delivery_to']+'</td>';
        // ht += '<td style="width: 10%;"><input type="date" class="form-control" name="tgl_delivery[]" value="'+coba[i]['tgl_delivery']+'" style="width: 100%;"></td>';
        ht += '<td>'+tanggal+'</td>';
        ht += '<td>'+coba[i]['nama_user']+'</td>';
              ht += '<td><center>';
            ht += '<a type="button" href="#" onclick="hapusWL(`'+coba[i]['id']+'`,`'+coba[i]['id_user']+'`)"><i class="fas fa-trash" style="color: red"></i></a>&nbsp;Hapus<br>';
            ht += '<a type="button" id="editin_head'+coba[i]['id']+'" href="#" data-toggle="modal" data-target="#head_editwl" data-num="'+coba[i]['id']+'" data-kalimat="'+coba[i]['pekerjaan']+'" data-tanggal="'+coba[i]['tgl_delivery']+'" data-pembuat="'+coba[i]['id_user']+'" onclick="headEdit(`'+coba[i]['id']+'`)"><i class="fas fa-edit"></i></a>&nbsp;Edit<br>';
            ht += '<input type="checkbox" name="approve_wl[]" value="'+coba[i]['id']+'">&nbsp;Approve</center></td>';
        
        ht += '</tr>';
      }
        bt += '<input type="submit" class="btn btn-success" name="btn_approve" value="Approve & Save">';
      $('#data_wl').append(ht);
      $('#lok_approve').append(bt);

    }
  });
  });

  function hapusWL(num, id_user)
  {
    console.log("Klik Hapus"+num);
    console.log(id_user);

    $('#data_wl').empty();
    $('#lok_approve').empty();


    $.ajax({
     url: "<?php echo base_url('harian/getdaftar_wl_hapus') ?>",
     method: "POST",
     data: {
         id_user : id_user,
         num : num                  
     },
      async: false,
     dataType: 'json',
     success: function(coba) {
      console.log(coba);

      var no = 0;
      var ht = '';
      var bt = '';
      for (var i = 0; i < coba.length; i++) {
        var today = coba[i]['tgl_delivery'].split("-");
        var tanggal = today[2]+"/"+today[1]+"/"+today[0];
        no++;

        ht += '<tr>';
        ht += '<input type="hidden" name="num[]" value="'+coba[i]['id']+'" >';
        ht += '<td>'+no+'</td>';
        ht += '<td>'+coba[i]['pekerjaan']+'</td>';
        ht += '<td>'+coba[i]['delivery_to']+'</td>';
        // ht += '<td style="width: 10%;"><input type="date" class="form-control" name="tgl_delivery[]" value="'+coba[i]['tgl_delivery']+'" style="width: 100%;"></td>';
        ht += '<td>'+tanggal+'</td>';
        ht += '<td>'+coba[i]['nama_user']+'</td>';
              ht += '<td><center>';
            ht += '<a type="button" href="#" onclick="hapusWL(`'+coba[i]['id']+'`,`'+coba[i]['id_user']+'`)"><i class="fas fa-trash" style="color: red"></i></a>&nbsp;Hapus<br>';
            ht += '<a type="button" id="editin_head'+coba[i]['id']+'" href="#" data-toggle="modal" data-target="#head_editwl" data-num="'+coba[i]['id']+'" data-kalimat="'+coba[i]['pekerjaan']+'" data-tanggal="'+coba[i]['tgl_delivery']+'" data-pembuat="'+coba[i]['id_user']+'" onclick="headEdit(`'+coba[i]['id']+'`)"><i class="fas fa-edit"></i></a>&nbsp;Edit<br>';
            ht += '<input type="checkbox" name="approve_wl[]" value="'+coba[i]['id']+'">&nbsp;Approve</center></td>';
        
        ht += '</tr>';
      }
        bt += '<input type="submit" class="btn btn-success" name="btn_approve" value="Approve & Save">';
      $('#data_wl').append(ht);
      $('#lok_approve').append(bt);

      Swal.fire(
        'Success!',
        'Berhasil Hapus Draft Waiting List!',
        'success'
      )

    }
  });

  }

  function headEdit(num)
  {
    console.log(num);
    console.log($('#editin_head'+num).data('tanggal'));
    $('#id_head').val(num);
    $('#kalimat_head').val($('#editin_head'+num).data('kalimat'));
    $('#delivery_head').val($('#editin_head'+num).data('tanggal'));
    $('#pembuat_head').val($('#editin_head'+num).data('pembuat'));



  }

  $(document).ready(function() {
      $('#submit_head').click(function(){
          var num = $('#id_head').val();
          var kalimat = $('#kalimat_head').val();
          var tanggal = $('#delivery_head').val();
          var id_user = $('#pembuat_head').val();

    $('#data_wl').empty();
    $('#lok_approve').empty();

         $.ajax({
     url: "<?php echo base_url('harian/getdaftar_wl_edit') ?>",
     method: "POST",
     data: {
         id_user : id_user,
         num : num,
         kalimat : kalimat,
         tanggal : tanggal                  
     },
      async: false,
     dataType: 'json',
     success: function(coba) {
      console.log(coba);

      var no = 0;
      var ht = '';
      var bt = '';
      for (var i = 0; i < coba.length; i++) {
        var today = coba[i]['tgl_delivery'].split("-");
        var tanggal = today[2]+"/"+today[1]+"/"+today[0];
        no++;

        ht += '<tr>';
        ht += '<input type="hidden" name="num[]" value="'+coba[i]['id']+'" >';
        ht += '<td>'+no+'</td>';
        ht += '<td>'+coba[i]['pekerjaan']+'</td>';
        ht += '<td>'+coba[i]['delivery_to']+'</td>';
        // ht += '<td style="width: 10%;"><input type="date" class="form-control" name="tgl_delivery[]" value="'+coba[i]['tgl_delivery']+'" style="width: 100%;"></td>';
        ht += '<td>'+tanggal+'</td>';
        ht += '<td>'+coba[i]['nama_user']+'</td>';
              ht += '<td><center>';
            ht += '<a type="button" href="#" onclick="hapusWL(`'+coba[i]['id']+'`,`'+coba[i]['id_user']+'`)"><i class="fas fa-trash" style="color: red"></i></a>&nbsp;Hapus<br>';
            ht += '<a type="button" id="editin_head'+coba[i]['id']+'" href="#" data-toggle="modal" data-target="#head_editwl" data-num="'+coba[i]['id']+'" data-kalimat="'+coba[i]['pekerjaan']+'" data-tanggal="'+coba[i]['tgl_delivery']+'" data-pembuat="'+coba[i]['id_user']+'" onclick="headEdit(`'+coba[i]['id']+'`)"><i class="fas fa-edit"></i></a>&nbsp;Edit<br>';
            ht += '<input type="checkbox" name="approve_wl[]" value="'+coba[i]['id']+'">&nbsp;Approve</center></td>';
        
        ht += '</tr>';
      }
        bt += '<input type="submit" class="btn btn-success" name="btn_approve" value="Approve & Save">';
      $('#data_wl').append(ht);
      $('#lok_approve').append(bt);

      Swal.fire(
        'Success!',
        'Berhasil Edit Draft Waiting List!',
        'success'
      )

    }
  });



      });
  });


  $(document).ready(function() {
     $('.modal').on("hidden.bs.modal", function (e) {
    if($('.modal:visible').length)
    {
        $('.modal-backdrop').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
        $('body').addClass('modal-open');
    }
}).on("show.bs.modal", function (e) {
    if($('.modal:visible').length)
    {
        $('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) + 10);
        $(this).css('z-index', parseInt($('.modal-backdrop.in').first().css('z-index')) + 10);
    }
});

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

                     $('#pil_kategori').change(function(e){ //on add input button click
                      e.preventDefault();

                      var data = $(this).val();
                      console.log(data);

                      if(x < max_fields){ //max input box allowed

                      var cobaah = "";
                      // nomor++;

                       cobaah += "<tr class='py-3'>";
                       cobaah += "<input type='hidden' id='no' name='no[]' value='null';>";
                       cobaah += " <td><div class='pr-2 pt-3'><input type='text' id='nomor' value='' class='form-control' readonly></div></td>";
                       cobaah += " <td><div class='row pr-2 pt-3'>";
                       
                       cobaah += "<div class='col-sm-12'><input type='text' name='pekerjaan[]' id='pekerjaan' class='form-control' value='"+data+" : ' placeholder='lanjutkan kalimat disini . . .'></div></div></td>";
                       cobaah += " <td>";
                       cobaah += "<a href='#' class='btn btn-danger remove_field' title='Delete'><i class='fas fa-trash-alt'></i></a>"
                       cobaah += "</td>";
                       cobaah += " </tr>";
                       
                       
                       
                       x++; //text box increment
                       if (data != null || data != '') {
                          $(wrapper).append(cobaah); //add input box
                       }
                     }

                    
                     });
 
                     $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                      e.preventDefault(); $(this).closest('tr').remove(); x--;
                     })


                   $('#save_btn').click(function(e){ //on add input button click
                      e.preventDefault();
                       $('#data').empty();
                      var ht = '';
                      console.log($("input[id='pekerjaan']").val());
                     
                     $("input[id='pekerjaan']").each(function(index) {
                      var kat = $(this).val();
                      console.log(kat);
                      var noo = index +1;
                        ht += noo +`. `+kat+`<br>`;
                      });
                     $('#data').append(ht);
                   });
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

 // $('#btn_editwl').click(function(e) {
 //    var id = $(this).data('id');
 //    console.log(id);
 //    $('#id_wl').val(id);
 //    $('#waitinglist').val($(this).data('pekerjaan'));
 //    $('#delivery').val($(this).data('delivery'));


 // });
</script>