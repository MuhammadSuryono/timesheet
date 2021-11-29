<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Master Kategori</h1>
        <div class="section-header-button">
            <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Add New</a>
        </div>
        <div class="section-header-button">
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Pekerjaan</a></div>
            <div class="breadcrumb-item active">Master Kategori</div>
        </div>
    </div>


    <h2 class="section-title">Daftar Kategori Divisi - <?=$this->session->userdata('ses_divisi')?></h2>
    <!-- AWAL ROW -->
    <div class="row">

        <!-- KOLOM -->
        <?php foreach($kategori as $db):?>
        <div class="col-sm-4">
            <div class="card card-info">
                <div class="card-header">
                    <h4 class="text-primary text-bold"><?=$db['nama_kategori']?></h4>
                    <div class="card-header-action">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit" data-nama_kategori="<?=$db['nama_kategori']?>" data-id_kategori="<?=$db['id_kategori']?>"><i class="fas fa-edit fa-fw"></i>Ubah</a>
                        <a href="<?=base_url('master/hapuskategori/')?><?=$db['id_kategori']?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash fa-fw"></i>Hapus</a>
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
        <h5 class="modal-title">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <form action="<?=base_url('master/tambahkategori')?>" method="POST">
        <div class="modal-body">
                    
        <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
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

<!-- MODAL EDIT -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Edit Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <form action="<?=base_url('master/editkategori')?>" method="POST">
        <div class="modal-body">
                    
        <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                <input type="hidden" name="id_kategori" id="id_kategori" class="form-control" required>
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
    $('#edit').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);

        var modal = $(this);
        modal.find('#id_kategori').val(button.data('id_kategori'));
        modal.find('#nama_kategori').val(button.data('nama_kategori'));
    });
} );
</script>
