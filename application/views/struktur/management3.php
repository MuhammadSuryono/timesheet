<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Struktur Management</h1>
        <div class="section-header-button">
            <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Add New</a>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Struktur Organisasi</a></div>
            <div class="breadcrumb-item active">Management</div>
        </div>
    </div>

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

    <!-- ARRAY MANAGER -->
    <?php $managerlain = []; foreach ($karyawan as $db) {
        $key = $db['atasan'];

        if(array_key_exists("$key", $managerlain)){
            array_push($managerlain[$key], $db);
        } else {    
            $managerlain[$key][] = $db;
        }
    }?>
    <!-- ARRAY MANAGER -->

    <!-- AWAL ROW -->
    <div class="row mt-0">
    <!-- AWAL KOLOM -->
        <div class="col-sm-4">
                
            <div class="section-body">
                <h2 class="section-title"><?=$this->session->userdata('ses_nama');?></h2>
                <div class="row">
                    <div class="col-12">
                        <div class="activities">

                            <?php foreach($manager as $db):?>
                            <div class="activity">
                                <div class="activity-icon bg-primary text-white shadow-primary">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-detail">
                                    <div class="mb-2">
                                        <span class="text-job" style="font-size:8pt; font-weight:bold;"><?=$db['nama_user']?></span>
                                        <span class="bullet"></span>
                                        <span class="text-job mr-1" style="font-size:8pt;"><?=$db['divisi']?></span>
                                        <div class="float-right">

                                            <!-- <a href="#" title="View" class="text-info mr-1" data-toggle="collapse" data-target="#mycard-collapse<?=$db['id_user']?>"><i class="fas fa-eye" style="font-size:14pt; "></i></a> -->
                                            
                                            <!-- <a href="<?=base_url('struktur/hapus/')?><?= $db['id_user'];?>" title="Delete" class="text-danger tombol-hapus"><i class="fas fa-trash" style="font-size:14pt; "></i></a> -->

                                        </div>
                                    </div>
                                    
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

                                </div>
                            </div>
                            <?php endforeach?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- AKHIR KOLOM -->
        
        <!-- AWAL KOLOM -->
        <?php foreach($direksi as $dr) :?>
        <div class="col-sm-4">
                
            <div class="section-body">
                <h2 class="section-title"><?=$dr['nama_user']?></h2>
                <div class="row">
                    <div class="col-12">
                        <div class="activities">

                            <!-- CEK MANAGER -->
                            <?php $nama=$dr['id_user']; if(array_key_exists("$nama", $managerlain)):?>
                            <?php foreach($managerlain[$nama] as $db):?>
                            <div class="activity">
                                <div class="activity-icon bg-primary text-white shadow-primary">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-detail">
                                    <div class="mb-2">
                                        <span class="text-job" style="font-size:8pt; font-weight:bold;"><?=$db['nama_user']?></span>
                                        <span class="bullet"></span>
                                        <span class="text-job mr-1" style="font-size:8pt;"><?=$db['divisi']?></span>
                                    </div>
                                    
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

                                </div>
                            </div>
                            <?php endforeach?>
                            <?php endif?>
                            <!-- AKHIR CEK -->
                            
                            <!-- CEK PEGWAI -->
                            <?php $nama=$dr['id_user']; if(array_key_exists("$nama", $pegawai)):?>
                            <?php foreach($pegawai[$nama] as $db):?>
                            <div class="activity">
                                <div class="activity-icon bg-primary text-white shadow-primary">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-detail">
                                    <div class="mb-2">
                                        <span class="text-job" style="font-size:8pt; font-weight:bold;"><?=$db['nama_user']?></span>
                                        <span class="bullet"></span>
                                        <span class="text-job mr-1" style="font-size:8pt;"><?=$db['divisi']?></span>
                                    </div>
                                    
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

                                </div>
                            </div>
                            <?php endforeach?>
                            <?php endif?>
                            <!-- AKHIR CEK PEGAWAI -->
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php endforeach?>
        <!-- AKHIR COLOM -->
    </div>
    <!-- AKHIR ROW -->

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
                <div class="row">

                <div class="col-sm-12">    
                <div class="form-group">
                      <label>Pilih Karyawan</label>
                      <select class="form-control select2 select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true" style="width:100%;" name="karyawan[]" id="karyawan[]">
                        <!-- <option>Option 1</option> -->
                        <?php foreach ($karyawan as $db ) :?>
                            <option value="<?=$db['id_user']?>"><?=$db['divisi']?> - <?=$db['nama_user']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                </div>

                <div class="col-sm-12">   
                <div class="form-group">
                      <label>Pilih Direksi</label>
                      <select class="form-control select2" name="direksi" id="direksi" style="width:100%;">
                        <option value="<?= $this->session->userdata('ses_username')?>"><?= $this->session->userdata('ses_nama')?></option>
                        <?php foreach ($direksi as $db ) :?>
                            <option value="<?=$db['id_user']?>"><?=$db['nama_user']?></option>
                        <?php endforeach?>
                    </select>
                </div>
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


<script>
$(document).ready(function() {
    $('#example').dataTable({
        lengthChange : false,
        paging : false,
        // responsive: true,
    });

    // $('.select2').select2();
    // $('.test').select2();

    $('#tambah').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        // $('.select2').select2();
        $("#direksi").select2();
        // alert("MASUK");
    });

} );
</script>