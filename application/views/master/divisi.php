<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Master Divisi</h1>
        <div class="section-header-button">
            <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Add New</a>
        </div>
        <div class="section-header-button">
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Data Master</a></div>
            <div class="breadcrumb-item active">Master Divisi</div>
        </div>
    </div>


    <h2 class="section-title">Daftar Divisi</h2>
    <!-- AWAL ROW -->
    <div class="row">

        <!-- KOLOM -->
        <?php foreach($divisi as $db):?>
        <div class="col-sm-4">
            <div class="card card-info">
                <div class="card-header">
                    <h4 class="text-primary text-bold"><?=$db['divisi']?></h4>
                    <div class="card-header-action">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit" data-divisi="<?=$db['divisi']?>" data-id_divisi="<?=$db['id_divisi']?>"><i class="fas fa-edit fa-fw"></i>Ubah</a>
                        <a href="<?=base_url('master/hapusdivisi/')?><?=$db['id_divisi']?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash fa-fw"></i>Hapus</a>
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
        <h5 class="modal-title">Tambah Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <form action="<?=base_url('master/tambahdivisi')?>" method="POST">
        <div class="modal-body">

        <div class="form-group">
                <label>Nama Divisi</label>
                <input type="text" name="divisi" id="divisi" class="form-control" required>
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
        <h5 class="modal-title">Edit Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <form action="<?=base_url('master/editdivisi')?>" method="POST">
        <div class="modal-body">

        <div class="form-group">
                <label>Nama Divisi</label>
                <input type="text" name="divisi" id="divisi" class="form-control" required>
                <input type="hidden" name="id_divisi" id="id_divisi" class="form-control" required>
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
        modal.find('#id_divisi').val(button.data('id_divisi'));
        modal.find('#divisi').val(button.data('divisi'));
    });
} );
</script>
