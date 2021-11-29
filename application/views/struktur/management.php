<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Struktur Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Struktur Organisasi</a></div>
        <div class="breadcrumb-item active">Management</div>
    </div>
    </div>
</section>

<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header">
            <h4>Daftar Karyawan</h4>
            <div class="card-header-action">
                <?php if($this->session->userdata('ses_akses')!='Pegawai' and $this->session->userdata('ses_akses')!='Pegawai2'):?>
                <a class="btn btn-icon btn-primary" href="#" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i></a>
                <?php endif?>
            </div>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <?php if($this->session->userdata('ses_akses')!='Pegawai' and $this->session->userdata('ses_akses')!='Pegawai2'):?>
                            <th>Aksi</th>
                            <?php endif?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no=1; foreach($manager as $db):?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$db['nama_user']?></td>
                            <td><?=$db['divisi']?></td>

                            <?php if($this->session->userdata('ses_akses')!='Pegawai' and $this->session->userdata('ses_akses')!='Pegawai2'):?>
                            <td>
                                <a href="<?=base_url('struktur/hapus/')?><?= $db['id_user'];?>" class="btn btn-icon btn-sm btn-danger tombol-hapus"><i class="fa fa-times"></i></a>
                            </td>
                            <?php endif?>

                        </tr>
                        <?php endforeach?>

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
                <h5 class="modal-title">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form action="<?=base_url('struktur/tambah')?>" method="POST">
              <div class="modal-body">
                            
                <div class="form-group">
                      <label>Pilih Karyawan</label>
                      <select class="form-control select2 select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true" style="width:100%;" name="karyawan[]" id="karyawan[]">
                        <!-- <option>Option 1</option> -->
                        <?php foreach ($karyawan as $db ) :?>
                            <option value="<?=$db['id_user']?>"><?=$db['nama_user']?></option>
                        <?php endforeach?>
                    </select>
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


<script>
$(document).ready(function() {
    $('#example').dataTable({
        lengthChange : false,
        paging : false,
        // responsive: true,
    });

    $('.select2').select2();

} );
</script>