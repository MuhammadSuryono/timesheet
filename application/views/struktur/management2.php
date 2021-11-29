<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Struktur Management</h1>
        <div class="section-header-button">
            <?php if($this->session->userdata('ses_akses')=='Direksi'):?>
            <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Add New</a>
            <?php endif?>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Struktur Organisasi</a></div>
            <div class="breadcrumb-item active">Management</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Daftar Karyawan</h2>
        <div class="row">
            <div class="col-12">
                <div class="activities">

                <!-- ARRAY STAFF PER DIVISI -->
                <?php $pegawai = []; foreach ($staff as $db) {
                    $key = $db['atasan'];

                    if(array_key_exists("$key", $pegawai)){
                        array_push($pegawai[$key], $db);
                    } else {    
                        $pegawai[$key][] = $db;
                    }
                }?>
                <!-- ARRAY STAFF PER DIVISI -->

                    <?php foreach($manager as $db):?>
                    <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="activity-detail">
                            <div class="mb-2">
                                <span class="text-job" style="font-size:12pt; font-weight:bold;"><?=$db['nama_user']?></span>
                                <span class="bullet"></span>
                                <span class="text-job mr-5" style="font-size:12pt;"><?=$db['divisi']?></span>
                                <div class="float-right">

                                    <!-- KHUSUS DIRESKI -->
                                    <?php if($this->session->userdata('ses_akses')=='Direksi'):?>
                                    <a href="#" title="View" class="text-info mr-3" data-toggle="collapse" data-target="#mycard-collapse<?=$db['id_user']?>"><i class="fas fa-eye" style="font-size:14pt; margin-top:2px;"></i></a>
                                    
                                    <a href="<?=base_url('struktur/hapus/')?><?= $db['id_user'];?>" title="Delete" class="text-danger mr-3 tombol-hapus"><i class="fas fa-trash" style="font-size:14pt; margin-top:2px;"></i></a>
                                    <?php endif?>
                                    <!-- AKHIR -->

                                </div>
                            </div>
                            
                            <!-- KUUSU DIREKSI -->
                            <?php if($this->session->userdata('ses_akses')=='Direksi'):?>
                            <div class="collapse show" id="mycard-collapse<?=$db['id_user']?>">

                                <?php $key = $db['id_user']; if(array_key_exists("$key", $pegawai)):?>
                                    <ul>
                                        <?php foreach($pegawai[$key] as $bd):?>
                                        <li><?=$bd['nama_user']?></li>
                                        <?php endforeach?>
                                    </ul>
                                <?php else :?>
                                    <p>Data Tidak Tersedia</p>
                                <?php endif?>

                            </div>
                            <?php endif?>
                            <!-- AKHIR -->

                        </div>
                    </div>
                    <?php endforeach?>

                </div>
            </div>
        </div>
    </div>

</section>
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