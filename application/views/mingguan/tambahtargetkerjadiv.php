<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Target Kerja Mingguan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/homemingguan') ?>">Mingguan</a></div>
        <div class="breadcrumb-item">Divisi <?php echo $tkm['divisi'] ?> <?php echo date('d-m-Y', strtotime($tkm['daritanggal'])); ?> s/d <?php echo date('d-m-Y', strtotime($tkm['sampaitanggal'])); ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Divisi - <b><?php echo $tkm['divisi'] ?></b> &nbsp;<b><?php echo date('d-m-Y', strtotime($tkm['daritanggal'])); ?> s/d <?php echo date('d-m-Y', strtotime($tkm['sampaitanggal'])); ?></b>
            </div>
            <div class="card-body">

              <form action="<?php echo base_url('mingguan/simpantargetkerjadiv2') ?>" method="POST">

                <input type="hidden" name="daritanggal" id="daritanggal2" value="<?php echo $tkm['daritanggal'] ?>">
                <input type="hidden" name="sampaitanggal" id="sampaitanggal2" value="<?php echo $tkm['sampaitanggal'] ?>">
                <input type="hidden" name="idtkmdiv" value="<?php echo $tkm['no'] ?>">

                 <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  $akses = $this->session->userdata('ses_akses');
                  $username = $this->session->userdata('ses_username');
                  // if ($akses == 'Manager') {
                    
                //   $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                // } else {
                  // $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' AND tgl_delivery BETWEEN '$tkm[daritanggal]' AND '$tkm[sampaitanggal]'  ORDER BY a.tgl_delivery ASC")->result_array();
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' ORDER BY a.tgl_delivery ASC")->result_array();

                // }

                   ?>
                   <div class="table-responsive">
                     <table class="table table-bordered" style="table-layout: auto; word-wrap: break-word; width: 100%;">
                       <thead>
                         <tr>
                           <th style="width: 10%">No</th>
                           <th style="width: 30%">Project/Program/Pekerjaan</th>
                           <th style="width: 20%">Kategori</th>
                           <th style="width: 20%">Target Selesai</th>
                           <th style="width: 10%">Tambah Divisi</th>
                           <th style="width: 10%">Lintas Divisi</th>
                         </tr>
                       </thead>
                       <tbody id="baristkm">

                    <?php foreach ($waitinglist as $wl2) : ?>
                        <input type="hidden" name="projectz" value="<?= $wl2['id'] ?>**<?= $wl2['pekerjaan'] ?>">
                      <?php endforeach ?>
                      <?php foreach ($kategori as $kt) : ?>
                          <input type="hidden" name="kategori" value="<?= $kt['id_kategori'] ?>**<?= $kt['nama_kategori'] ?>">
                        <?php endforeach ?>

                <?php
                if (count($pekerjaanSebelumnya)) : ?>
                  <ol class="umum">
                    <?php
                    $i = 0;
                    foreach ($pekerjaanSebelumnya as $ps) :

                      // var_dump($i);
                      $i++;
                    ?>

                      <!-- <li> -->
                        <tr>
                          <td><?= $i; ?></td>
                        <input type="hidden" name="tambahan0" value="yes">
                        <!-- <input type="text"  value="<?= $i; ?>"> -->


                        <!-- <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="project<?= $i ?>">Project/Program/Pekerjaan :</label> -->
                              <td>
                                <?= $ps['project'] ?>
                              <input type="hidden" class="form-control" id="project<?= $i ?>" name="project<?= $i ?>" value="<?= $ps['project'] ?>">
                              </td>
                            <!-- </div>
                          </div> -->

                         

                          <!-- <div class="col-sm-4">
                        <div class="form-group">
                          <label for="deskripsi0">Keterangan :</label>
                          <input type="text" class="form-control" id="deskripsi0" name="deskripsi0">
                        </div>
                      </div> -->

                          <!-- <div class="col-sm-2">
                            <div class="form-group">
                              <label>Target Persentase</label>
                              <div class="input-group">
                                <input type="number" class="form-control" id="persentase0" name="persentase0" min="1" max="100">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <i class="fas fa-percent"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> -->

                          <!-- <div class="col-sm-6">
                            <div class="form-group">
                              <label>Kategori :</label> -->
                              <td>

                              <select name="kategori<?= $i ?>" id="kategori<?= $i ?>" class="form-control select2">
                                <?php $kat = [];
                                 foreach ($kategori as $kt) : ?>
                              <?php if ($kt['id_kategori'] == $ps['id_kategori']) : ?>
                                <option value="<?= $kt['id_kategori'] ?>" selected><?= $kt['nama_kategori'] ?></option>
                              <?php else : ?>
                                <option value="<?= $kt['id_kategori'] ?>"><?= $kt['nama_kategori'] ?></option>
                              <?php endif ?>
                                <?php array_push($kat, $kt);
                                endforeach ?>
                                
                              </select>
                              </td>
                            <!-- </div>
                          </div>

                        </div> -->

                        <?php foreach ($kategori as $kt) : ?>
                          <input type="hidden" name="kategori" value="<?= $kt['id_kategori'] ?>**<?= $kt['nama_kategori'] ?>">
                        <?php endforeach ?>
                       <!--  <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Uraian :</label> -->
                              <td>
                              <!-- <ol id="ul<?= $i ?>"> -->
                                <section id="li<?= $i ?>">
                                  <?php
                                  foreach ($rincianPekerjaanSebelumnya as $rps) :
                                    if ($rps['id_pekerjaan'] == $ps['no']) :
                                  ?>
                                      <!-- <li id="<?= $i ?>"> -->
                                      <input type="date" name="targetselesai" class="form-control" value="<?= $rps['targetselesai'] ?>" title="Tanggal Target Selesai" readonly> <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus(<?= $i ?>);" style="display: none;"><i class="fas fa-trash"></i></a>
                                        <input type="hidden" name="uraian <?= $i ?>[]" id="uraian<?= $i ?>[]" value="<?= $rps['uraian'] ?>">
                                      <!-- </li> -->
                                  <?php
                                    endif;
                                  endforeach;
                                  ?>
                                  <!-- <input type="hidden" name="uraiannew0[]" id="uraiannew0[]"> -->
                                </section>
                              <!-- </ol> -->
                              </td>
                            <!-- </div>
                          </div> -->

                          <!-- <div class="col-sm-2"> -->
                            <!-- <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="<?= $i ?>" data-new="1">Add</button> -->
                          <!-- </div> -->

                          <!-- <div class="col-sm-4">
                            <div class="form-group">
                              <label>Lintas Divisi :</label> -->
                              <td>
                              <ol id="uldivisinew<?= $i ?>">
                                <section id="lidivisinew<?= $i ?>">
                                  <!-- <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" val=""> -->
                                </section>
                              </ol>
                            </td>
                            <!-- </div>
                          </div> -->

                          <!-- <div class="col-sm-2"> -->
                            <td data-trigger="hover" data-toggle="popover" data-html="true" data-placement="top" title="Attention" data-content="Saat ini sedang tidak bisa digunakan, harap info langsung ke ka div terkait untuk memasukkan ke daftar tkm nya.">
                            <!-- <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Divisi :</label><br> -->
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-toggle="modal" data-target="#adddivisi" data-id="<?= $i ?>" data-new="1" disabled>Add</button>
                            </td>
                          </tr>
                          <!-- </div>

                        </div> -->

                        <!-- <hr>
                      </li> -->

                    <?php
                    endforeach;
                    ?>
                  </ol>
                <?php
                else :
                ?>
                  <!-- <ol class="umum">

                    <?php
                     for ($i=0; $i < 1; $i++) { 
                    ?>
                    <li>
                      <input type="hidden" name="tambahan0" value="yes">

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="project0">Project/Program/Pekerjaan :</label>
                            <input type="text" class="form-control" id="project0" name="project0">
                            <select class="form-control select2 test" name="project0" id="project0">
                              <option value="">Pilih Project</option>
                              <?php foreach ($waitinglist as $wl) : ?>
                              <option value="<?= $wl['pekerjaan'] ?>"><?= $wl['pekerjaan'] ?></option>
                            <?php endforeach ?>
                            </select>
                          </div>
                        </div>
 -->

                    

                        <!-- <div class="col-sm-4">
  <div class="form-group">
    <label for="deskripsi0">Keterangan :</label>
    <input type="text" class="form-control" id="deskripsi0" name="deskripsi0">
  </div>
</div> -->

                        <!-- <div class="col-sm-2">
                          <div class="form-group">
                            <label>Target Persentase</label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="persentase0" name="persentase0" min="1" max="100">
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <i class="fas fa-percent"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->

<!--                         <div class="col-sm-6">
                          <div class="form-group">
                            <label>Kategori :</label>
                            <select name="kategori0" id="kategori0" class="form-control select2">
                              <?php $kat = [];
                              foreach ($kategori as $kt) : ?>
                                <option value="<?= $kt['id_kategori'] ?>"><?= $kt['nama_kategori'] ?></option>
                              <?php array_push($kat, $kt);
                              endforeach ?>
                            </select>
                          </div>
                        </div>

                        <?php foreach ($kategori as $kt) : ?>
                          <input type="hidden" name="kategori" value="<?= $kt['id_kategori'] ?>**<?= $kt['nama_kategori'] ?>">
                        <?php endforeach ?>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Uraian :</label>
                            <ol id="ul0">
                              <section id="linew0">
                                <input type="hidden" name="uraiannew0[]" id="uraiannew0[]"> -->
                             <!--  </section>
                            </ol>
                          </div>
                        </div>

                        <div class="col-sm-2"> -->
                          <!-- <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                          <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="0" data-new="1">Add</button>
                          <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="<?= $i ?>" data-new="1">Add</button> -->
                       <!--  </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Lintas Divisi :</label>
                            <ol id="uldivisinew0">
                              <section id="lidivisinew0">
                                <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" val="">
                              </section>
                            </ol>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Divisi :</label><br>
                          <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-toggle="modal" data-target="#adddivisi" data-id="0" data-new="1">Add</button>
                        </div>

                      </div>

                      <hr>
                    </li> -->
                    <?php 
                  } ?>
                     
                  <!-- </ol> -->
                <?php endif; ?>
                    </tbody>
                   </table>
                   </div>
                <!-- <?php var_dump($i - 1) ?> -->
                <input type="hidden" id="jmlproject" name="jmlproject" value="<?= $i ?>">
                <input type="hidden" id="jmlproject_before" name="jmlproject_before" value="<?= $i ?>">

                  <br>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">Submit</button>
                  <button type="button" class="addrow2 btn btn-primary d-inline ml-3" style="display:block;"><i class="fa fa-plus"></i> Tambah</button>
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
<!-- <div class="modal fade" tabindex="-1" role="dialog" id="add">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Uraian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label>Isi Rincian</label>
          <input type="text" class="form-control" id="uraianmodal" name="uraianmodal" value="" required>
          <input type="hidden" class="form-control" id="newmodal" name="newmodal" value="">
        </div>

      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <section id="buttonmodal">
          <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button> -->
       <!--  </section>
        </form>
      </div>
    </div>
  </div>
</div>
</div> -->
<!-- MODAL TAMBAH -->

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
                          <!-- <input type="text" class="form-control" id="project` + i + `" name="project` + i + `"> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
  $(function () {
  $('[data-toggle="popover"]').popover()
})
  
  $(document).ready(function() {
    var i = <?= $i ?>+ 1;
    var ii = <?= $i ?> + 1;
    $(".addrow2").on("click", function() {
      console.log(i);
      var ht = ` <tr>
                    <td>`+i+`</td>
                    <td>
                    <select name="project` + i + `" id="project` + i + `" class="form-control select2 test" onchange="pilihSelect(`+i+`)" required>
                            <option value="">--Pilih Project--</option>`;
                                $("input[name='projectz']").each(function() {
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
                            <button class="ibtnDel btn-sm btn-danger" style="display:block;"><i class="fa fa-minus"></i></button>

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
                  // <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                  //           <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="` + i + `" data-new="1">Add</button>

      $("#baristkm").append(ht);
      $("#jmlproject").attr('value', i);
      $('.test').select2();
      i++;

    });


    $("#baristkm").on("click", ".ibtnDel", function(event) {
      $(this).closest("tr").remove();
      i -= 1
    });

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
                        <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`">

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
                        <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`">

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
  // function simpan(id) {
  //   var val = $('#uraianmodal').val();
  //   if (val == '') {
  //     Swal({
  //       position: 'top',
  //       type: 'error',
  //       title: 'Oops...',
  //       text: 'Rincian Wajib Untuk Diisi'
  //     });
  //   } else {
  //     if ($('#newmodal').val() == 0) {

  //       var html = `<li id="` + id + `` + no + `">` + val + `
  //                       <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus(` + id + `` + no + `)"><i class="fas fa-trash"></i></a>
  //                       <input type="hidden" name="uraian` + id + `[]" id="uraian` + id + `[]" value="` + val + `">
  //                   </li>`;
  //       $('#li' + id).append(html);
  //     } else {
  //       var no = $(`#linew` + id + ` li`).length;
  //       var html = `<li id="linew` + id + `` + no + `">` + val + `
  //                       <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `` + no + `')"><i class="fas fa-trash"></i></a>
  //                       <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + val + `">
  //                   </li>`;
  //       $('#linew' + id).append(html);
  //     }
  //   }
  // }


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

  function pilihSelect(id)
  {
    console.log(id);
    var max_date = $('#sampaitanggal2').val();
      var kalimat = $('#project'+id).val();
      var words = kalimat.split('_');
      $('#linew' + id).empty();

      console.log(kalimat);
      $.ajax({
           url: "<?= base_url('mingguan/getid_wl') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             id: words[1]
           },
           success: function(hasil) {
            console.log(hasil);
      // var html = `<li id="linew` + id + `0">` + words[0] + `
      //                   <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `0')"><i class="fas fa-trash"></i></a>
      //                   <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`">
      //                   <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + words[0] + `">
      //                   <input type="hidden" name="bobotpersennew` + id + `[]" id="bobotpersennew` + id + `[]" value="0">
      //                   <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + words[1] + `">
      //               </li>`;
            var html = `
                        <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `0')"><i class="fas fa-trash" style="display: none;"></i></a>
                        <input type="date" class="form-control" title="Tanggal Target Selesai" name="target` + id + `[]" id="target` + id + `[]" max="`+max_date+`" value="`+hasil[0]['tgl_delivery']+`" required readonly>
                        <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + words[0] + `">
                        <input type="hidden" name="bobotpersennew` + id + `[]" id="bobotpersennew` + id + `[]" value="0">
                        <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + words[1] + `">
                    `;

    $('#linew' + id).append(html);
      }
    });

  }
</script>
<!-- <div class="col-sm-1">
                        <div class="form-group">
                            <label for="">-</label>
                            <button class="ibtnDel btn-sm btn-danger" style="display:block;"><i class="fa fa-minus"></i></button>
                        </div>
                        </div>