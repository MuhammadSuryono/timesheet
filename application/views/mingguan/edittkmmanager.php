<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Target Kerja Mingguan</h1>
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

              <!-- <form action="<?php echo base_url('mingguan/simpantkm2') ?>" method="POST"> -->

                <input type="hidden" name="daritanggal" id="daritanggal2" value="<?php echo $tkm['daritanggal'] ?>">
                <input type="hidden" name="sampaitanggal" id="sampaitanggal2" value="<?php echo $tkm['sampaitanggal'] ?>">

              <!-- ARRAY PERSENTASE -->
              <?php $persen = [];
              foreach ($persentase as $db) {
                $key = $db['project'];
                $persen[$key] = $db['sumper'];
              } ?>
              <!-- ARRAY PERSENTASE -->

              <!-- ARRAY URAIAN -->
              <?php $urai = [];
              foreach ($uraian as $db) {
                $key = $db['no'];

                if (array_key_exists("$key", $urai)) {
                  array_push($urai[$key], $db);
                } else {
                  $urai[$key][] = $db;
                }
              } ?>
              <!-- ARRAY URAIAN -->

              <ol class="umum">
                <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                 $akses = $this->session->userdata('ses_akses');
                  $username = $this->session->userdata('ses_username');
                //   if ($akses == 'Manager') {
                    
                //   $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                // } else {
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                // }
                   ?>
                   <div class="table-responsive">
                     <table class="table table-bordered" style="table-layout: auto; word-wrap: break-word; width: 100%;">
                       <thead>
                         <tr>
                           <th style="width: 7%">No</th>
                           <th style="width: 30%">Project/Program/Pekerjaan</th>
                           <th style="width: 15%">Kategori</th>
                           <th style="width: 25%">Target Selesai</th>
                           <th style="width: 10%">Hapus Target Kerja</th>
                         </tr>
                       </thead>
                       <tbody id="baristkm">

                <?php
                $i = 0;
                foreach ($cariproject as $cp) {
                  $i++;
                ?>
                <tr>
                  <td><?= $i ?></td>
                  <!-- <li>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="project<?php echo $cp['no']; ?>">Project/Program/Pekerjaan :</label> -->
                          <td>
                            <?php echo $cp['project'] ?>
                              <input type="hidden" class="form-control" id="project<?php echo $cp['no']; ?>" name="project<?php echo $cp['no']; ?>" value="<?php echo $cp['project'] ?>" onchange="project(<?= $cp['no'] ?>)" disabled>
                          </td>
                        <!-- </div>
                      </div> -->

                      <!-- <div class="col-sm-4">
                          <div class="form-group">
                            <label for="deskripsi<?php //echo $cp['no']; 
                                                  ?>">Keterangan :</label>
                            <input type="text" class="form-control" id="deskripsi<?php //echo $cp['no']; 
                                                                                  ?>" name="deskripsi<?php //echo $cp['no']; 
                                                                                                      ?>" value="<?php //echo $cp['deskripsi']
                                                                                                                                        ?>" onchange="ubah('deskripsi', <?php //echo $cp['no']
                                                                                                                                                                                                ?>)">
                          </div>
                        </div> -->
                      <!-- 
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Target Persentase</label>
                          <div class="input-group">
                            <?php $key = $cp['project'];
                            if (array_key_exists("$key", $persen)) {
                              $max = 100 - intval($persen[$key]) + intval($cp['persentase']);
                            } else {
                              $max = intval($cp['persentase']);
                            }
                            ?>
                            <input type="number" class="form-control" id="persentase<?php echo $cp['no']; ?>" name="persentase<?php echo $cp['no']; ?>" max="<?php echo $max ?>" value="<?= $cp['persentase'] ?>" onchange="ubah('persentase', <?= $cp['no'] ?>)">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <i class="fas fa-percent"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->

                      <!-- <div class="col-sm-2">
                        <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Hapus Target Kerja :</label> -->
                        <!-- <td>
                        <button type="button" class="btn btn-sm btn-icon btn-round btn-danger btn-block" data-toggle="modal" data-target="#hapus" data-id_uraian="all" data-deskripsi="<?= $cp['deskripsi'] ?>" data-project="<?= $cp['project'] ?>" data-id_pekerjaan="<?= $cp['no']; ?>">Hapus</button>
                        </td> -->
                      <!-- </div> -->

                      <!-- <div class="col-sm-4">
                        <div class="form-group">
                          <label>Kategori :</label> -->
                          <td>
                          <select name="id_kategori<?= $cp['no'] ?>" id="id_kategori<?= $cp['no'] ?>" class="form-control select2" onchange="ubah('id_kategori', <?= $cp['no'] ?>)">
                            <?php foreach ($kategori as $kt) : ?>
                              <?php if ($kt['id_kategori'] == $cp['id_kategori']) : ?>
                                <option value="<?= $kt['id_kategori'] ?>" selected><?= $kt['nama_kategori'] ?></option>
                              <?php else : ?>
                                <option value="<?= $kt['id_kategori'] ?>"><?= $kt['nama_kategori'] ?></option>
                              <?php endif ?>
                            <?php endforeach ?>
                          </select>
                        </td>
                       <!--  </div>
                      </div> -->

                      <!-- <div class="col-sm-4">
                        <div class="form-group">
                          <label>Uraian :</label> -->
                          <td>
                          <!-- <ol id="ul<?= $cp['no'] ?>"> -->
                            <section id="li<?= $cp['no'] ?>">
                              <?php $key = $cp['no'];
                              foreach ($urai[$key] as $xy) : ?>
                                <?php if ($xy['uraian'] != '') : ?>
                                  <!-- <li id="<?= $cp['no'] ?>**<?= $xy['id_uraian'] ?>"><?= $xy['uraian'] ?> -->
                                  <div class="form-inline row">
                                  <input type="date" name="targetselesai" class="form-control" value="<?= $xy['targetselesai'] ?>" title="Target Selesai" readonly>
                                    <a href="javascript:void(0)" title="Edit" class="text-success" data-id="<?= $xy['id_uraian'] ?>" data-uraian="<?= $xy['uraian'] ?>" data-target2="<?= $xy['targetselesai'] ?>" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></a>
                                  </div>

                                    <!-- <a href="<?= base_url('mingguan/hapusuraian/') ?><?= $tkm['no'] ?>/<?= $xy['id_uraian'] ?>" title="Delete" class="text-danger mr-3 tombol-hapus"><i class="fas fa-trash"></i></a> -->

                                    <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" data-toggle="modal" data-target="#hapus" data-id_uraian="<?= $xy['id_uraian'] ?>" data-uraian="<?= $xy['uraian'] ?>" data-project="<?= $cp['project'] ?>" data-id_pekerjaan="<?= $cp['no']; ?>" style="display: none;"><i class="fas fa-trash"></i></a>
                                  <!-- </li> -->
                                <?php endif ?>
                              <?php endforeach ?>
                            </section>
                          <!-- </ol> -->
                        </td>

                        <td>
                        <button type="button" class="btn btn-sm btn-icon btn-round btn-danger btn-block" data-toggle="modal" data-target="#hapus" data-id_uraian="all" data-deskripsi="<?= $cp['deskripsi'] ?>" data-project="<?= $cp['project'] ?>" data-id_pekerjaan="<?= $cp['no']; ?>">Hapus</button>
                        </td>
                        <!-- </div>
                      </div> -->
                      </tr>
                      <!-- <div class="col-sm-2">
                        <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Uraian :</label>
                        <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="<?= $cp['no'] ?>">Add</button>
                      </div>

                    </div>
                    <hr>
                  </li> -->
                <?php
                }
                ?>
                    </tbody>
                   </table>
                   </div>
                <input type="hidden" name="jml" value="<?php echo $i; ?>">

                  <br>
                <div class="form-group">
                  <a href="<?= base_url('mingguan/homemingguan') ?>" class="btn btn-primary btn-block btn-round">Selesai</a>
                  <!-- <button type="button" class="addrow2 btn btn-primary d-inline ml-3" style="display:block;"><i class="fa fa-plus"></i> Tambah</button> -->
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
        <h5 class="modal-title">Tambah Uraian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('mingguan/simpanuraian') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Pilih Rincian</label>
          <!-- <input type="text" class="form-control" id="uraianmodal" name="uraianmodal" value="" required> -->
                       <?php
                      $no = 1;
                      foreach ($waitinglist as $list) {
                         ?>
                          <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input waitinglist" name="waitinglist[]" id="waitinglist<?php echo $list['id'] ?>"  value="<?php echo $list['id'] ?>">
                                <label class="custom-control-label" for="waitinglist<?php echo $list['id'] ?>"><?php echo $no++ .". ". $list['pekerjaan'] ?> (<span class="text-info"><?php echo $list['nama_user']; ?></span>)</label>
                                <input type="hidden" name="id_list[]" id="id_list" value="<?php echo $list['id'] ?>">
                            </div>
                      <?php 
                      } ?> 

            <input type="hidden" class="form-control" id="idtkm" name="idtkm" value="<?= $tkm['no'] ?>">
            <input type="hidden" class="form-control" id="id_pekerjaan" name="id_pekerjaan" value="<?= $tkm['no'] ?>">
          </div>

        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<!-- MODAL TAMBAH -->

<!-- MODAL Edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Uraian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url('mingguan/edituraian') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Isi Rincian</label>
            <input type="text" class="form-control" id="uraianmodal" name="uraianmodal" value="" required>
            
            <input type="hidden" class="form-control" id="id_uraian" name="id_uraian" value="">
            <input type="hidden" class="form-control" id="idtkm" name="idtkm" value="<?= $tkm['no'] ?>">
          </div>
          <div class="form-group">
            <label>Target Selesai</label>
            <input type="date" class="form-control" id="targetmodal" name="targetmodal" max="<?php echo $tkm['sampaitanggal'] ?>" value="" required>
            
          </div>

        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<!-- MODAL Edit -->

<!-- MODAL Hapus -->
<div class="modal fade" tabindex="-1" role="dialog" id="hapus">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Ini?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url('mingguan/hapusdata') ?>" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label>Nama Project</label>
            <input type="text" class="form-control" id="projectmodal" name="projectmodal" value="" readonly>
            <input type="hidden" class="form-control" id="id_pekerjaanmodal" name="id_pekerjaanmodal" value="">
          </div>

          <div class="form-group" id="deskripsisection">
            <label>Keterangan / Deskripsi</label>
            <input type="text" class="form-control" id="deskripsimodal" name="deskripsimodal" value="" readonly>
          </div>

          <div class="form-group" id="uraiansection">
            <label>Uraian</label>
            <input type="text" class="form-control" id="uraianmodal" name="uraianmodal" value="" readonly>
            <input type="hidden" class="form-control" id="id_uraianmodal" name="id_uraianmodal" value="">
          </div>

          <div class="form-group">
            <label>Isi Alasan</label>
            <input type="text" class="form-control" id="alasan" name="alasan" value="">
            <input type="hidden" class="form-control" id="idtkm" name="idtkm" value="<?= $tkm['no'] ?>">
          </div>

        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Hapus</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<!-- MODAL hapus -->

<script>
  $(document).ready(function() {
    $('#add').on('show.bs.modal', function(e) {
      var button = $(e.relatedTarget);

      var modal = $(this);
      modal.find('#id_pekerjaan').val(button.data('id'));

    });

    $('#edit').on('show.bs.modal', function(e) {
      var button = $(e.relatedTarget);

      var modal = $(this);
      modal.find('#uraianmodal').val(button.data('uraian'));
      modal.find('#targetmodal').val(button.data('target2'));

      modal.find('#id_uraian').val(button.data('id'));

    });

    $('#hapus').on('show.bs.modal', function(e) {
      var button = $(e.relatedTarget);
      var id_uraian = button.data('id_uraian');

      var modal = $(this);
      if (id_uraian == 'all') {
        modal.find('#uraiansection').hide();
        modal.find('#deskripsisection').show();
        modal.find('#deskripsimodal').val(button.data('deskripsi'));
      } else {
        modal.find('#deskripsisection').hide();
        modal.find('#uraiansection').show();
        modal.find('#uraianmodal').val(button.data('uraian'));
        modal.find('#id_uraianmodal').val(button.data('id_uraian'));
      }

      modal.find('#projectmodal').val(button.data('project'));
      modal.find('#id_pekerjaanmodal').val(button.data('id_pekerjaan'));

    });

  });

  function ubah(nama, id) {
    var val = $('#' + nama + id).val();
    $.ajax({
      url: "<?= base_url('mingguan/ubahtargetkerja') ?>",
      type: "POST",
      dataType: 'json',
      data: {
        id: id,
        val: val,
        nama: nama
      },
      success: function(hasil) {
        Swal({
          position: 'top',
          type: 'success',
          title: 'Berhasi;',
          text: 'Berhasil Di Ubah'
        });
      }
    });
  }
</script>