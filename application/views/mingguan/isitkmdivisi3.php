<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Isi Target Kerja Mingguan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/homemingguan') ?>">Mingguan</a></div>
        <div class="breadcrumb-item">Divisi <?php echo $this->session->userdata('ses_divisi') ?> <?php echo date('d-m-Y', strtotime($tanggalnya['t1'])); ?> s/d <?php echo date('d-m-Y', strtotime($tanggalnya['t2'])); ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Divisi <?php echo $this->session->userdata('ses_divisi') ?> &nbsp;<b><?php echo date('d-m-Y', strtotime($tanggalnya['t1'])); ?> s/d <?php echo date('d-m-Y', strtotime($tanggalnya['t2'])); ?></b>
            </div>
            <div class="card-body">

              <form action="<?php echo base_url('mingguan/simpantkm3') ?>" method="POST">

                <input type="hidden" name="daritanggal" id="daritanggal2" value="<?php echo $tanggalnya['t1'] ?>">
                <input type="hidden" name="sampaitanggal" id="sampaitanggal2" value="<?php echo $tanggalnya['t2'] ?>">

                <!-- <ol class="umum"> -->
                <div class="umum">

                  <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  $akses = $this->session->userdata('ses_akses');
                  $username = $this->session->userdata('ses_username');
                //   if ($akses == 'Manager') {
                    
                //   $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                // } else {
                  // $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' AND tgl_delivery BETWEEN '$tanggalnya[t1]' AND '$tanggalnya[t2]'  ORDER BY b.hak_akses, b.nama_user, a.id ASC")->result_array();
                  if($akses == 'Manager' OR $akses == 'Direksi') {
                    $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' AND tgl_delivery BETWEEN '$tanggalnya[t1]' AND '$tanggalnya[t2]'  ORDER BY a.tgl_delivery ASC")->result_array();
                  } else {
                    $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' AND a.approve='Yes' AND tgl_delivery BETWEEN '$tanggalnya[t1]' AND '$tanggalnya[t2]'  ORDER BY a.tgl_delivery ASC")->result_array();
                  }

                  // $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' AND tgl_delivery BETWEEN '$tanggalnya[t1]' AND '$tanggalnya[t2]' AND a.approve='Yes'  ORDER BY a.tgl_delivery ASC")->result_array();

                // }

                   ?>
                   <div class="table-responsive">
                     <table class="table table-bordered" style="table-layout: auto; word-wrap: break-word; width: 100%;">
                       <thead>
                         <tr>
                           <th style="width: 10%">No</th>
                           <th style="width: 30%">Project/Program/Pekerjaan</th>
                           <th style="width: 25%">Kategori</th>
                           <th style="width: 15%">Target Selesai</th>
                           <th style="width: 10%">Tambah Divisi</th>
                           <th style="width: 10%" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="top" title="Attention" data-content="Saat ini sedang tidak bisa digunakan, harap info langsung ke ka div terkait untuk memasukkan ke daftar tkm nya.">Lintas Divisi</th>
                         </tr>
                       </thead>
                       <tbody id="baristkm">
                     

                  <?php
                  if (empty($cariproject)) {
                    echo "";
                    $i = 0;
                  } else {
                    $i = 0;
                    foreach ($cariproject as $cp) {
                      $i++;
                  ?>
                      <!-- <li> -->
                        <tr>
                          <td><?= $i; ?></td>
                          
                        <!-- <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="prapro<?php echo $i; ?>">Project/Program/Pekerjaan :</label> -->
                             <td>
                              <?php echo $cp['project'] ?>
                              <input type="hidden" class="form-control" id="prapro<?php echo $i; ?>" name="prapro<?php echo $i; ?>" value="<?php echo $cp['project'] ?>" readonly>
                            </td>
                            <!-- </div>
                          </div> -->
                          <input type="hidden" name="baris_id" id="baris_id" value="<?= $i ?>">

                          <!-- <div class="col-sm-6">
                            <div class="form-group">
                              <label>Kategori :</label> -->
                              <td>
                              <select name="prakategori<?= $i ?>" id="prakategori<?= $i ?>" class="form-control select2" required>
                                <option selected value="<?php echo $cp['idkategori']; ?>"><?php echo $cp['namakategori']; ?></option>
                                <?php foreach ($kategori as $kt) : ?>
                                  <option value="<?= $kt['id_kategori'] ?>"><?= $kt['nama_kategori'] ?></option>
                                <?php endforeach ?>
                              </select>
                              </td>
                            <!-- </div>
                          </div> -->

                          <!-- <div class="col-sm-4">
                            <div class="form-group"> -->
                              <!-- <label>Rincian :</label> -->
                              <!-- <label>Target Selesai :</label> -->
                              <td>
                              <ol id="ul<?= $i ?>">
                                <section id="li<?= $i ?>">
                                  <!-- <li id="li<?= $i ?>0"> -->
                                    <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('li<?= $i ?>0')"><i class="fas fa-trash" style="display: none;"></i></a>
                                    <input type="date" class="form-control" title="Tanggal Target Selesai" name="targetold<?= $i ?>[]" id="target<?= $i ?>[]" max="<?= $tanggalnya['t2'] ?>" required>
                                    <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" value="<?= $cp['project'] ?>">
                                    <input type="hidden" name="bobotpersen<?= $i ?>[]" id="bobotpersen<?= $i ?>[]" value="0">
                                    <input type="hidden" name="idlistold<?= $i ?>[]" id="idlist<?= $i ?>[]" value="null">
                                <!-- </li> -->
                                  <!-- <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" val=""> -->
                                </section>
                              </ol>
                            </td>
                            <!-- </div>
                          </div> -->

                          <!-- <div class="col-sm-2"> -->
<!--                             <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="<?= $i ?>" data-new="0">Add</button> -->
                          <!-- </div> -->

                          <!-- <div class="col-sm-4">
                            <div class="form-group">
                              <label>Lintas Divisi :</label> -->
                              <td>
                              <ol id="uldivisi<?= $i ?>">
                                <section id="lidivisi<?= $i ?>">
                                  <!-- <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" val=""> -->
                                </section>
                              </ol>
                            </td>
                            <!-- </div>
                          </div>
 -->
                          <!-- <div class="col-sm-2">
                            <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Divisi :</label><br> -->
                            <td data-trigger="hover" data-toggle="popover" data-html="true" data-placement="top" title="Attention" data-content="Saat ini sedang tidak bisa digunakan, harap info langsung ke ka div terkait untuk memasukkan ke daftar tkm nya.">
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-toggle="modal" data-target="#adddivisi" data-id="<?= $i ?>" data-new="0" data-trigger="hover" data-toggle="popover" data-html="true" data-placement="top" title="Attention" data-content="Saat ini sedang tidak bisa digunakan, harap info langsung ke ka div terkait untuk memasukkan ke daftar tkm nya." disabled>Add</button>
                          </td>
                          <!-- </div> -->

                        <!-- </div> -->
                      </tr>
                        <!-- <hr> -->
                      <!-- </li> -->
                    <?php
                    }
                    ?>
                    <input type="hidden" name="jmlprapo" value="<?php echo $i; ?>">
                  <?php
                  }
                  ?>


                  <?php $x = $i + 1; 
                  $i = 0;
                  // for ($i=0; $i < 1; $i++) {
                  foreach ($waitinglist as $key) {
                  $i++; 
                    ?>
                  <!-- <li> -->
                    <tr>
                      <td><?= $x++; ?></td>
                    <!-- <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="project0">Project/Program/Pekerjaan :</label> -->
                          <td>
                            <?= $key['pekerjaan'] ?>
                          <!-- <input type="text" class="form-control" id="project0" name="project0"> -->
                          <input type="hidden" name="project<?= $i ?>" id="project<?= $i ?>" value="<?= $key['pekerjaan'] ?>">
                          <!-- <select class="form-control select2 test" name="project0" id="project0" required>
                            <option value="">--Pilih Project--</option>
                            <?php foreach ($waitinglist as $wl) { ?>
                             <option value="<?= $wl['pekerjaan'].'_'.$wl['id'] ?>"><?= $wl['pekerjaan'] ?></option>
                            <?php } ?>
                          </select> -->
                        </td>
                        <!-- </div>
                      </div> -->
                          <input type="hidden" name="baris_id" id="baris_id_null" value="<?= $i ?>">


                      <?php foreach ($waitinglist as $wl) : ?>
                        <input type="hidden" name="project" value="<?= $wl['id'] ?>**<?= $wl['pekerjaan'] ?>">
                      <?php endforeach ?>

                      <!-- <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kategori :</label> -->
                          <td>
                          <select name="kategori<?= $i ?>" id="kategori<?= $i ?>" class="form-control select2" style="width: 100%;">
                            <?php $kat = [];
                            foreach ($kategori as $kt) : ?>
                              <option value="<?= $kt['id_kategori'] ?>"><?= $kt['nama_kategori'] ?></option>
                            <?php array_push($kat, $kt);
                            endforeach ?>
                          </select>
                        </td>
                        <!-- </div>
                      </div -->

                      <?php foreach ($kategori as $kt) : ?>
                        <input type="hidden" name="kategori" value="<?= $kt['id_kategori'] ?>**<?= $kt['nama_kategori'] ?>">
                      <?php endforeach ?>

<!--                       <div class="col-sm-4">
                        <div class="form-group">
 -->                          <!-- <label>Rincian :</label> -->
                          <!-- <label>Target Selesai :</label> -->
                        <td>                       
                          <!-- <ol id="ul0"> -->
                            <section id="linew<?= $i ?>">
                              <!-- <input type="hidden" name="uraiannew0[]" id="uraiannew0[]"> -->
                              <!-- <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('li<?= $i ?>0')"><i class="fas fa-trash" style="display: none;"></i></a> -->
                                    <input type="date" class="form-control" title="Tanggal Target Selesai" name="target<?= $i ?>[]" id="target<?= $i ?>[]" max="<?= $tanggalnya['t2'] ?>" value="<?= $key['tgl_delivery'] ?>" readonly required >
                                    <input type="hidden" name="uraiannew<?= $i ?>[]" id="uraiannew<?= $i ?>[]" value="<?= $key['pekerjaan'] ?>">
                                    <input type="hidden" name="bobotpersennew<?= $i ?>[]" id="bobotpersennew<?= $i ?>[]" value="0">
                                    <input type="hidden" name="idlist<?= $i ?>[]" id="idlist<?= $i ?>[]" value="<?= $key['id'] ?>">
                            </section>
                          <!-- </ol> -->
                        </td>
<!--                         </div>
                      </div>
 -->
                      <!-- <div class="col-sm-2"> -->
                       <!--  <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                        <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="<?= $i ?>" data-new="1">Add</button> -->
                      <!-- </div> -->

                      <!-- <div class="col-sm-4">
                        <div class="form-group">
                          <label>Lintas Divisi :</label> -->
                          <td>
                          <ol id="uldivisinew0">
                            <section id="lidivisinew<?= $i ?>">
                              <!-- <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" val=""> -->
                            </section>
                          </ol>
                        </td>
                        <!-- </div>
                      </div> -->

                      <td data-trigger="hover" data-toggle="popover" data-html="true" data-placement="top" title="Attention" data-content="Saat ini sedang tidak bisa digunakan, harap info langsung ke ka div terkait untuk memasukkan ke daftar tkm nya.">
                      <!-- <div class="col-sm-2">
                        <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Divisi :</label><br> -->
                        <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-target="#adddivisi" data-id="<?= $i ?>" data-new="1" data-trigger="click" data-toggle="popover" data-html="true" data-placement="top" title="Attention" data-content="Saat ini sedang tidak bisa digunakan, harap info langsung ke ka div terkait untuk memasukkan ke daftar tkm nya." disabled>Add</button>
                      <!-- </div> -->
                    </td>

                    <!-- </div> -->
                  </tr>

                    <!-- <hr> -->
                  <!-- </li> -->
                <?php } ?>
                    </tbody>
                   </table>
                   </div>
                <!-- </ol> -->
              </div>

                <input type="hidden" id="jmlproject" name="jmlproject" value="<?= $i ?>">

                <div class="form-group">
                  <button type="submit" class="btn btn-success">Submit</button>
                  <!-- <button type="button" class="addrow2 btn btn-primary d-inline ml-3" style="display:block;"><i class="fa fa-plus"></i> Tambah</button> -->
                  
                </div>
                <div>
                  <b><span class="font-weight-bold text-warning">Catatan :</span> 
                      <br> - Waiting list yang ditarik dan akan dijadikan TKM yaitu waiting list yang memiliki tanggal delivery diatara rentang tanggal TKM yang akan dibuat dan sudah di approve pada saat proses review waiting list.
                      
                  </b>
                </div>


              </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" tabindex="-1" role="dialog" id="add">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Rincian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label><b>Pilih Rincian</b></label>
          <!-- <input type="text" class="form-control" id="uraianmodal" name="uraianmodal" value="" required> -->
           <?php
          $no = 1;
          foreach ($waitinglist as $list) {
             ?>
              <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input waitinglist" name="waitinglist" id="waitinglist<?php echo $list['id'] ?>"  value="<?php echo $list['pekerjaan'] ?>">
                    <label class="custom-control-label" for="waitinglist<?php echo $list['id'] ?>"><?php echo $no++ .". ". $list['pekerjaan'] ?> (<span style="color: #1E90FF;"><?php echo $list['nama_user']; ?></span>)</label>
                    <input type="hidden" name="id_list" id="id_list" value="<?php echo $list['id'] ?>">
                </div>
          <?php 
          } ?> 
          <input type="hidden" class="form-control" id="newmodal" name="newmodal" value="">
           <input type="hidden" class="form-control" id="dataid" name="dataid" value="">
        </div>

      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <section id="buttonmodal">
          <!-- <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button> -->
        </section>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<!-- MODAL TAMBAH -->

<!-- MODAL TAMBAH -->
<div class="modal fade" tabindex="-1" role="dialog" id="adddivisi">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="form-group">
          <input type="hidden" class="form-control" id="newmodaldivisi" name="newmodaldivisi" value="">
          <label>Pilih Divisi</label>
          <select class="form-control form-control-sm" name="divisimodal" id="divisimodal">
            <option value="0">---Pilih Divisi---</option>
            <?php foreach ($divisi as $db) : ?>
              <option value="<?= $db['divisi'] ?>"><?= $db['divisi'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <section id="buttonmodaldivisi">
          <!-- <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button> -->
        </section>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<!-- MODAL TAMBAH -->
<!-- 

                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="project` + i + `">Project/Program/Pekerjaan :</label>
                          <input type="text" class="form-control" id="project` + i + `" name="project` + i + `">
                        </div>
                      </div> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
  $(function () {
  $('[data-toggle="popover"]').popover()
})


  $(document).ready(function() {
    var i = <?= $i ?> + 1;
    $(".addrow2").on("click", function() {
      var z = i + <?= $x ?> - 1;
      var ht = `
                    <tr>
                    <td>`+z+`</td>
                    <td>
                    <select name="project` + i + `" id="project` + i + `" class="form-control select2 test" onchange="pilihSelect(`+i+`)" required>
                            <option value="">--Pilih Project--</option>`;
                                $("input[name='project']").each(function() {
                                  var kat = $(this).val().split('**');
                                  ht += `<option value="`+kat[1]+`_`+kat[0]+`">` + kat[1] + `</option>`;
                                });

                                ht += `</select>

                      </td>

                      
                        
                        <td>
                            <select name="kategori` + i + `" id="kategori` + i + `" class="form-control select2 test">`;

      $("input[name='kategori']").each(function() {
        var kat = $(this).val().split('**');
        ht += `<option value="` + kat[0] + `">` + kat[1] + `</option>`;
      });

      ht += `</select>
                          </td>

                        <td>
                            
                            <ol id="ul` + i + `">
                                <section id="linew` + i + `">
                                <input type="hidden" name="uraian` + i + `[]" id="uraian` + i + `[]">
                                </section>
                            </ol>
                          </td>


                        <td>
                            <ol id="uldivisinew` + i + `">
                            <section id="lidivisinew` + i + `">
                            </section>
                            </ol>
                          </td>

                        <td data-trigger="hover" data-toggle="popover" data-html="true" data-placement="top" title="Attention" data-content="Saat ini sedang tidak bisa digunakan, harap info langsung ke ka div terkait untuk memasukkan ke daftar tkm nya.">
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-toggle="modal" data-target="#adddivisi" data-id="` + i + `" data-new="1" disabled>Add</button>
                        </td>
                        </tr>

                  `;

      $("#baristkm").append(ht);
      $("#jmlproject").attr('value', i);
      $('.test').select2();
      i++;

    });

  // <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
   // <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="` + i + `" data-new="1">Add</button> 


    $('#add').on('show.bs.modal', function(e) {
      var button = $(e.relatedTarget);
      var html = `<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpan(` + button.data('id') + `)">Simpan</button>`;
      var modal = $(this);
      $('.waitinglist').prop('checked', false);

      $('#dataid').val(button.data('id'));
      modal.find('#buttonmodal').html(html);
      modal.find('#uraianmodal').val('');
      modal.find('#bobotmodal').val('');
      modal.find('#newmodal').val(button.data('new'));

    });

    $('#adddivisi').on('show.bs.modal', function(e) {
      var button = $(e.relatedTarget);
      var html = `<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpandivisi(` + button.data('id') + `)">Simpan</button>`;
      var modal = $(this);
      modal.find('#buttonmodaldivisi').html(html);
      modal.find('#newmodaldivisi').val(button.data('new'));
    });

  });

  function simpan(id) {
    var val = $('#uraianmodal').val();
    var bobot = $('#bobotmodal').val();


    var list = document.getElementsByName('waitinglist');
    var id_list = document.getElementsByName('id_list');

    var max_date = $('#sampaitanggal2').val();

    if (val == '' || bobot == '') {
      Swal({
        position: 'top',
        type: 'error',
        title: 'Oops...',
        text: 'Rincian dan Bobot Persentase Wajib Untuk Diisi'
      });
    } else {
      if ($('#newmodal').val() == 0) {
        for (var i = 0; i < list.length; i++) {
           if ( list[i].checked === true ) {
        var no = $(`#li` + id + ` li`).length;
        console.log(no);

        var html = `<li id="` + id + `` + no + `">` + list[i].value + `
                        <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus(` + id + `` + no + `)"><i class="fas fa-trash"></i></a>
                        <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`" required>
                        <input type="hidden" name="uraian` + id + `[]" id="uraian` + id + `[]" value="` + list[i].value + `">
                        <input type="hidden" name="bobotpersen` + id + `[]" id="bobotpersen` + id + `[]" value="` + bobot + `">
                         <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + id_list[i].value + `">
                    </li>`;
        $('#li' + id).append(html);
            }
        }
      } else {
        for (var i = 0; i < list.length; i++) {
           if ( list[i].checked === true ) {
        var no = $(`#linew` + id + ` li`).length;
        var html = `<li id="linew` + id + `` + no + `">` + list[i].value + `
                        <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `` + no + `')"><i class="fas fa-trash"></i></a>
                        <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`" required>
                        <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + list[i].value + `">
                        <input type="hidden" name="bobotpersennew` + id + `[]" id="bobotpersennew` + id + `[]" value="` + bobot + `">
                        <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + id_list[i].value + `">
                    </li>`;
        $('#linew' + id).append(html);
            }
        }
      }
    }
  }


  function simpandivisi(id) {
    var val = $('#divisimodal').val();
    if (val == 0) {
      Swal({
        position: 'top',
        type: 'error',
        title: 'Oops...',
        text: 'Anda Tidak Memilih Divisi'
      });
    } else {
      if ($('#newmodaldivisi').val() == 0) {
        var no = $(`#lidivisi` + id + ` li`).length;
        var cari = [];

        $(`input[name='divisi` + id + `[]']`).each(function() {
          cari.push($(this).val());
        });
        if (cari.indexOf(val) < 0) {
          var html = `<li id="lidivisi` + id + `` + no + `">` + val + `
                            <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapusdivisi('lidivisi` + id + `` + no + `')"><i class="fas fa-trash"></i></a>
                            <input type="hidden" name="divisi` + id + `[]" id="divisi` + id + `[]" value="` + val + `">
                        </li>`;
          $('#lidivisi' + id).append(html);
        }
      } else {
        var no = $(`#lidivisinew` + id + ` li`).length;

        var cari = [];

        $(`input[name='divisinew` + id + `[]']`).each(function() {
          cari.push($(this).val());
        });
        if (cari.indexOf(val) < 0) {
          var html = `<li id="lidivisinew` + id + `` + no + `">` + val + `
                            <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapusdivisi('lidivisinew` + id + `` + no + `')"><i class="fas fa-trash"></i></a>
                            <input type="hidden" name="divisinew` + id + `[]" id="divisinew` + id + `[]" value="` + val + `">
                        </li>`;
          $('#lidivisinew' + id).append(html);
        }
      }
    }
  }

  function hapus(id) {
    Swal({
      title: 'Apakah anda yakin',
      text: "data akan dihapus",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus Data!'
    }).then((result) => {
      if (result.value) {
        $('#' + id).remove();
      }
    })
  }

  function hapusdivisi(id) {
    Swal({
      title: 'Apakah anda yakin',
      text: "data akan dihapus",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus Data!'
    }).then((result) => {
      if (result.value) {
        $('#' + id).remove();
      }
    })
  }

  $(document).ready(function() {
    $('#project0').change(function() {
    var max_date = $('#sampaitanggal2').val();
    var id = $('#baris_id_null').val();
      var kalimat = $(this).val();
      var words = kalimat.split('_');
      $('#linew' + id).empty();

      console.log(kalimat);
      // var html = `<li id="linew` + id + `0">` + words[0] + `
      //                   <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `0')"><i class="fas fa-trash"></i></a>
      //                   <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`">
      //                   <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + words[0] + `">
      //                   <input type="hidden" name="bobotpersennew` + id + `[]" id="bobotpersennew` + id + `[]" value="0">
      //                   <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + words[1] + `">
      //               </li>`;
        var html = `
                          <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `0')"><i class="fas fa-trash" style="display: none;"></i></a>
                        <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`" required>
                        <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + words[0] + `">
                        <input type="hidden" name="bobotpersennew` + id + `[]" id="bobotpersennew` + id + `[]" value="0">
                        <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + words[1] + `">
                    `;
      console.log(id);

    $('#linew' + id).append(html);

    });
  });

  function pilihSelect(id)
  {
    console.log(id);
    var max_date = $('#sampaitanggal2').val();
      var kalimat = $('#project'+id).val();
      var words = kalimat.split('_');
      $('#linew' + id).empty();

      console.log(kalimat);
      // var html = `<li id="linew` + id + `0">` + words[0] + `
      //                   <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `0')"><i class="fas fa-trash"></i></a>
      //                   <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`">
      //                   <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + words[0] + `">
      //                   <input type="hidden" name="bobotpersennew` + id + `[]" id="bobotpersennew` + id + `[]" value="0">
      //                   <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + words[1] + `">
      //               </li>`;
            var html = `
                        <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `0')"><i class="fas fa-trash" style="display: none;"></i></a>
                        <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`" required>
                        <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + words[0] + `">
                        <input type="hidden" name="bobotpersennew` + id + `[]" id="bobotpersennew` + id + `[]" value="0">
                        <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + words[1] + `">
                    `;

    $('#linew' + id).append(html);

  }

</script>

<!--       var ht = `<li>
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label for="project` + i + `">Project/Program/Pekerjaan :</label>
                          <select name="project` + i + `" id="project` + i + `" class="form-control select2 test" onchange="pilihSelect(`+i+`)" required>
                            <option value="">--Pilih Project--</option>`;
                                $("input[name='project']").each(function() {
                                  var kat = $(this).val().split('**');
                                  ht += `<option value="`+kat[1]+`_`+kat[0]+`">` + kat[1] + `</option>`;
                                });

                                ht += `</select>
                        </div>
                      </div>

                      <div class="col-sm-1">
                        <div class="form-group">
                            <label for="">-</label>
                            <button class="ibtnDel btn-sm btn-danger" style="display:block;"><i class="fa fa-minus"></i></button>
                        </div>
                        </div>

                      <div class="col-sm-4">
                          <div class="form-group">
                            <label>Kategori :</label>
                            <select name="kategori` + i + `" id="kategori` + i + `" class="form-control select2 test">`;

      $("input[name='kategori']").each(function() {
        var kat = $(this).val().split('**');
        ht += `<option value="` + kat[0] + `">` + kat[1] + `</option>`;
      });

      ht += `</select>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                              <label>Target Selesai :</label>
                            
                            <ol id="ul` + i + `">
                                <section id="linew` + i + `">
                                <input type="hidden" name="uraian` + i + `[]" id="uraian` + i + `[]">
                                </section>
                            </ol>
                          </div>
                        </div>

                        <div class="col-sm-2">

                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Lintas Divisi :</label>
                            <ol id="uldivisinew` + i + `">
                            <section id="lidivisinew` + i + `">
                            </section>
                            </ol>
                          </div>
                        </div>

                        <div class="col-sm-2">
                            <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Divisi :</label><br>
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-toggle="modal" data-target="#adddivisi" data-id="` + i + `" data-new="1">Add</button>
                        </div>

                    </div>

                  </li>
                  <hr>`;
