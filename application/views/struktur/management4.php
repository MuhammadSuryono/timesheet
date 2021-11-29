<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Struktur Management</h1>
        <div class="section-header-button">
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
                                    
                                    <!-- KUUSU DIREKSI -->
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
                                    <!-- AKHIR -->

                                </div>
                            </div>
                            <?php endforeach?>
                            <?php endif?>
                            <!-- AKHIR CEK -->
                            
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
