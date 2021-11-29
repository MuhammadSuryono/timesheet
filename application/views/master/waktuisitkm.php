<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Waktu Isi TKM Divisi</h1>
    </div>

    <!-- AWAL ROW -->
    <div class="row">

      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="">
          <thead>
            <tr>
              <th>No.</th>
              <th>Divisi</th>
              <th>Jam Isi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach($alldiv AS $key){
            ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $key['divisi']; ?></td>
              <td><?php echo $key['waktuisi']; ?></td>
              <td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit" data-divisi="<?=$key['divisi']?>" data-waktuisi="<?=$key['waktuisi']?>"><i class="fas fa-edit fa-fw"></i>Ubah</a></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>
    <!-- AKHIR ROW -->

</section>
</div>
<!-- akhir mai content -->

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

        <form action="<?=base_url('master/editwaktuisi')?>" method="POST">
        <div class="modal-body">

        <div class="form-group">
          <label>Nama Divisi :</label>
            <input type="text" name="divisi" id="divisi" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Waktu Isi TKM Divisi :</label>
            <input type="text" name="waktuisi" id="waktuisi" class="form-control">
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
        modal.find('#divisi').val(button.data('divisi'));
        modal.find('#waktuisi').val(button.data('waktuisi'));
    });
} );
</script>
