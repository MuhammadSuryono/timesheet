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

    <!-- AWAL ROW -->
    <div class="row mt-0">
        
        <!-- AWAL KOLOM -->
        <div class="col-sm-4">
                
            <div class="section-body">
                <h2 class="section-title"><?=$manager_direksi['direksi']?></h2>
                <div class="row">
                    <div class="col-12">
                        <div class="activities">

                            <div class="activity">
                                <div class="activity-icon bg-primary text-white shadow-primary">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-detail">
                                    <div class="mb-2">
                                        <span class="text-job" style="font-size:8pt; font-weight:bold;"><?=$manager_direksi['manager']?></span>
                                        <span class="bullet"></span>
                                        <span class="text-job mr-1" style="font-size:8pt;"><?=$this->session->userdata('ses_divisi');?></span>
                                    </div>
                                    
                                    <!-- KUUSU DIREKSI -->
                                    <div class="collapse show" id="mycard-collapse">

                                        <?php if(count($staff)!=0):?>
                                            <ul>
                                                <?php foreach($staff as $bd):?>
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
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- AKHIR COLOM -->
    </div>
    <!-- AKHIR ROW -->

</section>
</div>
<!-- akhir mai content -->
