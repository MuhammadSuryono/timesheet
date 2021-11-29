<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Target Harian</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item active">Harian</div>
    </div>
    </div>
</section>

<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header">
            <h4><?=date('j M, Y', strtotime($senin))?> - <?=date('j M, Y', strtotime("-2 days", strtotime( $minggu )))?></h4>
            <div class="card-header-action">
                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
            </div>
            </div>
            <div class="collapse" id="mycard-collapse">
            <div class="card-body">
                <?php foreach($tkmstaff as $db) :?>
                    <?=$db['target']?>
                <?php endforeach?>
            </div>
            <div class="card-footer text-primary">
                Persentase
            </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header">
            <h4>Detail Harian</h4>
            <div class="card-header-action">
                <a class="btn btn-icon btn-primary" href="#" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i></a>
            </div>
            </div>
            <div class="card-body">

                <!-- ARRAY HARIAN -->
                <?php $hari = []; foreach($harian as $db){
                        $hari[$db['tanggal']] = $db;
                    }
                ?>
                <!-- ARRAY HARIAN -->
                
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari/Tanggal</th>
                            <th>Rincian</th>
                            <th>Poto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php $tanggal = $senin; for($i=1; $i<=5; $i++):?>
                            <?php if(array_key_exists("$tanggal",$hari)) :?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td><?= date('l, j M', strtotime($tanggal))?></td>
                                    <td><?= $hari["$tanggal"]['pekerjaan'];?></td>
                                    <td><a href="" data-toggle="modal" data-target="#modalpoto" data-poto="<?=base_url('dist/')?><?=$hari["$tanggal"]['poto']?>" data-tanggal="<?= date('l, j M', strtotime($tanggal))?>" > <?= $hari["$tanggal"]['poto'];?> </a></td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-sm btn-success mr-2" data-toggle="modal" data-target="#edit" data-rincian="<?= htmlspecialchars($hari["$tanggal"]['pekerjaan']);?>" data-idtugasharian="<?= $hari["$tanggal"]['no'];?>" data-tanggal="<?=$tanggal?>"> <i class="far fa-edit"></i> </a>

                                        <a href="<?=base_url('harian/hapus/')?><?= $hari["$tanggal"]['no'];?>" class="btn btn-icon btn-sm btn-danger tombol-hapus"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php else :?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td><?= date('l, j M', strtotime($tanggal))?></td>
                                    <td>Data Tidak Tersedia</td>
                                    <td>Data Tidak Tersedia</td>
                                    <td></td>
                                </tr>
                            <?php endif?>
                        <?php $tanggal = date('Y-m-d', strtotime("+1 days", strtotime( $tanggal ))); endfor?>
                        
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>
</div>

</div>
<!-- akhir mai content -->

<!-- MODAL TAMBAH -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Form Harian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="<?=base_url('harian/tambah')?>" method="POST" enctype='multipart/form-data'>
              <div class="modal-body">
                            
                                
              <input type="hidden" name="idtkmdiv" id="idtkmdiv" value="<?=$tkmstaff[0]['idtkmdiv']?>">

                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rincian Pekerjaan :</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea class="summernote-simple" name="rincian" required></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File :</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="file" class="form-control" name="poto" id="poto" required>
                    </div>
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

<!-- MODAL POTO -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalpoto">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Poto <span id="tanggal"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
              </div>

              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- MODAL POTO -->

<!-- MODAL EDIT -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Form Harian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="<?=base_url('harian/edit')?>" method="POST" enctype='multipart/form-data'>
              <div class="modal-body">
                            
                                
              <input type="hidden" name="idtugasharian" id="idtugasharian" value="">
              <input type="hidden" name="tanggal" id="tanggal" value="">

                <div class="form-group row">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rincian Pekerjaan :</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea class="summernote-simple" name="rincian" required><span id="rincian"></span></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File :</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="file" class="form-control" name="poto" id="poto" required>
                    </div>
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
<!-- MODAL EDIT -->

<script>
$(document).ready(function() {
    $('#example').dataTable({
        lengthChange : false,
        paging : false,
        responsive: true,
    });

    $('#modalpoto').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var poto =  button.data('poto');
        var html = `<img src="`+poto+`" id="poto" alt="" width="200">`;

        var modal = $(this);
        modal.find('#tanggal').html(button.data('tanggal'));
        modal.find('.modal-body').html(html);
    });

    $('#edit').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);

        var modal = $(this);
        modal.find('#rincian').html(button.data('rincian'));
        modal.find('#idtugasharian').val(button.data('idtugasharian'));
        modal.find('#tanggal').val(button.data('tanggal'));
    });
} );
</script>