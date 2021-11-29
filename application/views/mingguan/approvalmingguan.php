<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Target Kerja</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item active">Approval Target Kerja</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="section-body">
      <h2 class="section-title">Approval Target Kerja</h2>

      <div class="row">

        <?php
        // gettkm
        // tkmdivisi
        foreach ($gettkm as $key) {

        $cariyes = $this->db->query("SELECT count(project) AS jmlyes FROM pekerjaan WHERE tambahan='yes' AND idtkmdiv='$key[no]'")->row_array();

        if($cariyes['jmlyes'] > 0){
          $tambahan = "(Tambahan Target Kerja)";
        }else{
          $tambahan = "";
        }
        ?>
          <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Target Kerja <?php echo $key['divisi']?> (<?php echo $key['namapengisi']?>) <?php echo $key['daritanggal']?> s/d <?php echo $key['sampaitanggal']?> <?php echo $tambahan ?></h4>
                  <div class="card-header-action">

                    <div class="dropdown">
                      <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                      <div class="dropdown-menu">
                        <a href="<?=base_url('mingguan/tambahtkm/')?><?php echo $key['no']?>" class="dropdown-item has-icon"><i class="fas fa-plus"></i> Add Target Kerja</a>
                        <a href="<?=base_url('mingguan/edittkm/')?><?php echo $key['no']?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" title="Delete" data-toggle="modal" data-target="#hapus" data-divisi="<?=$key['divisi']?>" data-idtkmdiv="<?=$key['no']?>" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i> Delete All</a>
                      </div>
                    </div>

                    <a href="<?php echo base_url('mingguan/approve')?>/<?php echo $key['no']?>" class="btn btn-success">Setujui</a>
                    <a data-collapse="#mycard-collapse<?php echo $key['no']?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                  </div>
                </div>
                <div class="collapse" id="mycard-collapse<?php echo $key['no']?>">
                  <div class="card-body">

                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Project</th>
                                  <th>Kategori</th>
                                  <th>Deskripsi</th>
                                  <th>Target Persentase</th>
                                  <th>Uraian</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              $caripekerjaan = $this->db->query("SELECT
                                                                        a.*,
                                                                        b.nama_kategori AS namakategori
                                                                        FROM pekerjaan a
                                                                        JOIN kategori b ON a.id_kategori = b.id_kategori
                                                                        WHERE idtkmdiv='$key[no]'")->result_array();
                              $x = 1;
                              foreach ($caripekerjaan as $cp) {
                                if($cp['tambahan'] == NULL){
                                  $warna = "";
                                }else{
                                  $warna = "#a1c5e6";
                                }
                              $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$cp[no]'")->result_array();
                              $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$cp[no]'")->row_array();
                              $rowspan = $jmlurai['jmu']+1;
                              // echo $rowspan;
                              ?>
                                  <tr bgcolor="<?php echo $warna ?>">
                                      <td rowspan="<?=$rowspan?>"><?=$x++?></td>
                                      <td rowspan="<?=$rowspan?>"><?php echo $cp['project'] ?></td>
                                      <td rowspan="<?=$rowspan?>"><?php echo $cp['namakategori'] ?></td>
                                      <td rowspan="<?=$rowspan?>"><?php echo $cp['deskripsi'] ?></td>
                                      <td rowspan="<?=$rowspan?>" class="text-center"><?php echo $cp['persentase']?>%
                                        <div class="progress" data-height="4">
                                          <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase']?>%" aria-valuenow="<?php echo $cp['persentase']?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                  </tr>
                                  <?php foreach($uraian as $ua):?>
                                  <tr>
                                      <td><?php echo $ua['uraian']?></td>
                                  </tr>
                                  <?php endforeach?>
                                  <?php
                                  }
                                  ?>
                          </tbody>
                      </table>
                      </div>
                  </div>
                  <div class="card-footer">

                  </div>
                </div>
              </div>
          </div>
          <?php
          }
          ?>


      </div>

      <!-- BANG TEDY PUNYA -->
      <!-- BANG TEDY PUNYA -->

      </div>
  </section>
</div>

<!-- MODAL Hapus -->
<div class="modal fade" tabindex="-1" role="dialog" id="hapus">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Target Kerja Divisi - <b id="divisi"></b> ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

            <form action="<?=base_url('mingguan/hapussemuadata')?>" method="post">
              <div class="modal-body">

                <div class="form-group">
                      <label>Isi Alasan</label>
                      <input type="text" class="form-control" id="alasan" name="alasan" value="">
                      <input type="hidden" class="form-control" id="idtkmdiv" name="idtkmdiv" value="">
                </div>

              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" >Hapus</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- MODAL hapus -->

<script>
$(document).ready(function () {
  $('#hapus').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);

        var modal = $(this);
          modal.find('#divisi').html(button.data('divisi'));
          modal.find('#idtkmdiv').val(button.data('idtkmdiv'));
    });

});
</script>
