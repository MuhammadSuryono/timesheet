<style>
    /*Now the CSS*/
* {margin: 0; padding: 0;}

.tree {
    min-width: 3000px;
}
.tree ul {
    padding-top: 20px; position: relative;
    
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

.tree li {
    float: left; text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
    
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
    content: '';
    position: absolute; top: 0; right: 50%;
    /*border-top: 1px solid #ccc;*/
    border-top: 3px solid #191970;
    width: 50%; height: 20px;
}
.tree li::after{
    right: auto; left: 50%;
    /*border-left: 1px solid #ccc;*/
    border-left: 3px solid #191970;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
    display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
    border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
    /*border-right: 1px solid #ccc;*/
    border-right: 3px solid #191970;
    border-radius: 0 5px 0 0;
    -webkit-border-radius: 0 5px 0 0;
    -moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
    border-radius: 5px 0 0 0;
    -webkit-border-radius: 5px 0 0 0;
    -moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
    content: '';
    position: absolute; top: 0; left: 50%;
    /*border-left: 1px solid #ccc;*/
    border-left: 3px solid #191970;
    width: 0; height: 20px;
}

.kotak{
    /*border: 3px solid #ccc;*/
    text-decoration: none;
    color: #666;
    /*font-family: arial, verdana, tahoma;*/
    font-family: Comic Sans MS;
    font-size: 15px;
    display: inline-block;
    
    border-radius: 10px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
    background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
    border-color:  #94a0b4;
}

/*Thats all. I hope you enjoyed it.
Thanks :)*/
</style>
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
<div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

<!-- Main Content -->
<div class="main-content">
<section class="section">

    <div class="section-header">
        <!-- <h1>Master Karyawan</h1> -->
        <h1>Struktur Organisasi</h1>

        <div class="section-header-button">
            <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Add New</a>
        </div>
        <div class="section-header-button">
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Data Master</a></div>
            <div class="breadcrumb-item active">Master Karyawan</div>
        </div>
    </div>


    <!-- ARRAY KARYAWAN 1-->
    <?php $karyawandivisi=[]; foreach ($karyawanlain as $db ) {
        $key = $db['divisi'];
        if (array_key_exists("$key", $karyawandivisi)) {
            array_push($karyawandivisi[$key], $db);
        } else {
            $karyawandivisi[$key][] = $db;
        }
    }?>
    <!-- ARRAY KARYAWAN 1-->

    <!-- ARRAY KARYAWAN 2-->
    <?php $karyawandivisi2=[]; foreach ($karyawanlain2 as $db ) {
        $key = $db['divisi2'];
        if (array_key_exists("$key", $karyawandivisi2)) {
            array_push($karyawandivisi2[$key], $db);
        } else {
            $karyawandivisi2[$key][] = $db;
        }
    }?>
    <!-- ARRAY KARYAWAN 2-->
<?php $dir = $this->db->get_where('tb_user', array('jabatan1' => 'Direksi'))->result_array(); ?>

    <h2 class="section-title">Daftar Divisi</h2>
    <div class="row">
        <div class="col-sm-12 text-center table-responsive" style="border: 5px solid    #4682B4;">
            <div class="tree">
    <ul>
        <li>
            <a href="#" class="btn btn-primary" style="color: white;">Marketing Research Indonesia</a>
            <ul>
                <?php
                foreach ($dir as $d) {
                    $under = $this->db->group_by('divisi')->get_where('tb_user', array('atasan' => $d['id_user']))->result_array();
                
                ?>
                <li>
                    <div class="kotak" href="#">
                        <div class="card" style="border: 3px solid #191970; border-radius: 10px;">
                        <div class="card-header" style="background-color:   #191970; color: white;"><?= $d['divisi'] ?></div>
                        <div class="card-body" style="background-color: #87CEFA;"><?= $d['nama_user'] ?></div>
                        </div>
                    </div>
                    <ul>
                        <?php 
                        foreach ($under as $un) {
                        $staff = $this->db->get_where('tb_user', array('divisi' => $un['divisi']))->result_array();

                        ?>
                        <li>
                            <div class="kotak" href="#">
                                <div class="card" style="border: 3px solid #191970; border-radius: 10px;">
                                <div class="card-header" style="background-color: #191970; color: white;"><?= $un['divisi'] ?></div>
                                <div class="card-body" style="text-align: left; background-color: #ADD8E6">
                                    
                                    <?php foreach ($staff as $st) {
                                        $head1 = $this->db->query("SELECT * FROM tb_user WHERE id_user='$st[id_user]'")->row_array();
                                     ?>
                                        <span><?= $st['nama_user']." (".$st['jabatan1'].")" ?><a href="#" title="Edit" class="text-success mr-1" data-toggle="modal" data-target="#edit" data-id_user="<?= $st['id_user'];?>" data-nama="<?= $st['nama_user'];?>" data-divisi="<?= $st['divisi'];?>" data-jabatan="<?= $st['jabatan1'];?>" data-atasan="<?= $st['atasan'] ?>" data-izinbackdate="<?= $st['izinbackdate'] ?>"><i class="fas fa-edit"></i></a>
                                            
                                    <a href="<?=base_url('master/hapuskaryawan/')?><?= $st['id_user'];?>" title="Delete" class="text-danger tombol-hapus"><i class="fas fa-trash"></i></a></span><br>
                                       
                                    <?php } ?>
                                        
                                    </div>
                                </div>        
                            </div>

                        <?php 
                        // $undiv = $this->db->group_by('divisi')->get_where('tb_user', array('atasan' => $un['id_user'], 'divisi !=' => $un['divisi'], 'divisi !=' => ''))->result_array();
                        $undiv = $this->db->query("SELECT * FROM `tb_user` WHERE `atasan` = '$un[id_user]' AND `divisi` != '$un[divisi]' AND `divisi` != '' GROUP BY `divisi`")->result_array();
                        if($undiv != NULL){
                        ?>
                            <ul>
                        <?php
                        foreach ($undiv as $ud) {
                        $staff2 = $this->db->get_where('tb_user', array('divisi' => $ud['divisi']))->result_array();

                        ?>
                        <li>
                            <div class="kotak" href="#">
                                <div class="card" style="border: 3px solid #191970; border-radius: 10px;">
                                <div class="card-header" style="background-color: #191970; color: white;"><?= $ud['divisi'] ?></div>
                                <div class="card-body" style="text-align: left; background-color: #ADD8E6">                                    
                                    <?php foreach ($staff2 as $st) { 
                                        $head2 = $this->db->query("SELECT * FROM tb_user WHERE id_user='$st[id_user]'")->row_array();
                                         ?>
                                        <span><?= $st['nama_user']." (".$st['jabatan1'].")" ?><a href="#" title="Edit" class="text-success mr-1" data-toggle="modal" data-target="#edit" data-id_user="<?= $st['id_user'];?>" data-nama="<?= $st['nama_user'];?>" data-divisi="<?= $st['divisi'];?>" data-jabatan="<?= $st['jabatan1'];?>" data-atasan="<?= $st['atasan'] ?>" data-izinbackdate="<?= $st['izinbackdate'] ?>"><i class="fas fa-edit"></i></a>
                                            
                                    <a href="<?=base_url('master/hapuskaryawan/')?><?= $st['id_user'];?>" title="Delete" class="text-danger tombol-hapus"><i class="fas fa-trash"></i></a></span><br>
                                       
                                    <?php } ?>
                                        
                                    </div>
                                </div>        
                            </div>
                            </li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
                    </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php } ?>
                
            </ul>
        </li>
    </ul>

</div>
        </div>
        
    </div>
    <!-- AWAL ROW -->
    <div class="row" style="display: none;">

        <!-- KOLOM -->
        <?php foreach($divisi as $db):?>
        <div class="col-sm-4">
            <div class="activities">
            <div class="activity">
            <div class="activity-detail">
                <div class="mb-2">
                    <span class="text-job" style="font-size:12pt; font-weight:bold;"><?=$db['divisi']?></span>
                    <!-- <span class="bullet"></span> -->
                    <!-- <span class="text-job mr-1" style="font-size:8pt;"><?=$this->session->userdata('ses_divisi');?></span> -->
                </div>
                
                <div class="collapse show" id="mycard-collapse">

                    <!-- LEADER UTAMA -->
                    <?php $key = $db['divisi']; if(array_key_exists("$key", $karyawandivisi)):?>
                        <ul>
                            <?php foreach($karyawandivisi[$key] as $bd):?>
                            <li><?=$bd['nama_user']?> ( <?=$bd['jabatan1']?> )
                                <div class="float-right">
                                    <a href="#" title="Edit" class="text-success mr-1" data-toggle="modal" data-target="#edit" data-id_user="<?= $bd['id_user'];?>" data-nama="<?= $bd['nama_user'];?>" data-divisi="<?= $bd['divisi'];?>" data-jabatan="<?= $bd['jabatan1'];?>"><i class="fas fa-edit"></i></a>
                                            
                                    <a href="<?=base_url('master/hapuskaryawan/')?><?= $bd['id_user'];?>" title="Delete" class="text-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                                </div>
                            </li>
                            <?php endforeach?>
                        </ul>
                    <?php endif?>
                    <!-- AKHIR -->

                    <?php if(array_key_exists("$key", $karyawandivisi2)==true and array_key_exists("$key", $karyawandivisi)==true) :?>
                        <hr>
                    <?php endif?>
                    
                    <!-- LEDER LAINNYA -->
                    <?php if(array_key_exists("$key", $karyawandivisi2)):?>
                        <ul>
                            <?php foreach($karyawandivisi2[$key] as $bd):?>
                            <li><?=$bd['nama_user']?> ( <?=$bd['jabatan2']?> )
                                <div class="float-right">
                                    <a href="<?=base_url('master/hapuskaryawan2/')?><?= $bd['id_user'];?>" title="Delete" class="text-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                                </div>
                            </li>
                            <?php endforeach?>
                        </ul>
                    <?php endif;?>
                    <!-- AKHIR  -->

                    <!-- TIDAK ADA LEDER SAMA SEKALI -->
                    <?php if(array_key_exists("$key", $karyawandivisi2)==false and array_key_exists("$key", $karyawandivisi)==false) :?>
                        <p>Data Tidak Tersedia</p>
                    <?php endif?>
                    <!-- AKHIR -->

                </div>
                <!-- AKHIR -->

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

        <form action="<?=base_url('master/tambahkaryawan')?>" method="POST">
        <div class="modal-body">
                    
        <div class="form-group">
            <label>Pilih Karyawan</label>
                <select class="form-control select2" multiple="" tabindex="-1" aria-hidden="true" style="width:100%;" name="id_user[]" id="id_user[]">
                <!-- <option>Option 1</option> -->
                <?php foreach ($karyawan as $db ) :?>
                    <option value="<?=$db['id_user']?>"><?=$db['nama_user']?></option>
                <?php endforeach?>
            </select>
        </div>

        <div class="form-group">
            <label>Pilih Divisi</label>
                <select class="form-control select2" style="width:100%;" name="divisi" id="divisi">
                    <option value="">--Pilih Divisi--</option>
                <?php foreach ($divisi as $db ) :?>
                    <option value="<?=$db['divisi']?>"><?=$db['divisi']?></option>
                <?php endforeach?>
            </select>
        </div>

        <div class="form-group">
            <label>Pilih Jabatan</label>
                <select class="form-control select2" style="width:100%;" name="jabatan" id="jabatan">
                    <option value="">--Pilih Jabatan--</option>
                <option value="Manajemen">Manajemen</option>
                <option value="Direksi">Direksi</option>
                <option value="Kepala Divisi">Kepala Divisi</option>
                <option value="Koordinator">Koordinator</option>
                <option value="Staff">Staff</option>
                <option value="Klerikal">Klerikal</option>

            </select>
        </div>

        <?php $atas = $this->db->query("SELECT * FROM tb_user WHERE (hak_akses ='Direksi' OR hak_akses='Manager')")->result_array() ?>
        <div class="form-group">
            <label>Pilih atasan</label>
                <select class="form-control select2" style="width:100%;" name="atasan" id="atasan">
                    <option value="">--Pilih Atasan--</option>

                <?php foreach ($atas as $at) {
                  ?>
                <option value="<?= $at['id_user'] ?>"><?= $at['nama_user'] ?></option>
            <?php } ?>

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

<!-- MODAL EDIT -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Edit Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <form action="<?=base_url('master/editkaryawan')?>" method="POST">
        <div class="modal-body">
                    
        <div class="form-group">
            <label>Nama Karyawan</label>
                <input class="form-control" type="text" name="nama" id="nama" readonly>
                <input type="hidden" name="id_user" id="id_user">
        </div>

        <div class="form-group">
            <label>Pilih Divisi</label>
                <select class="form-control" style="width:100%;" name="divisi" id="divisi">
                <?php foreach ($divisi as $db ) :?>
                    <option value="<?=$db['divisi']?>"><?=$db['divisi']?></option>
                <?php endforeach?>
            </select>
        </div>

        <div class="form-group">
            <label>Pilih Jabatan</label>
                <select class="form-control" style="width:100%;" name="jabatan" id="jabatan">
                <option value="Manajemen">Manajemen</option>
                <option value="Direksi">Direksi</option>
                <option value="Kepala Divisi">Kepala Divisi</option>
                <option value="Koordinator">Koordinator</option>
                <option value="Staff">Staff</option>
                <option value="Klerikal">Klerikal</option>
            </select>
        </div>

        <?php $atas = $this->db->query("SELECT * FROM tb_user WHERE (hak_akses ='Direksi' OR hak_akses='Manager')")->result_array() ?>
        <div class="form-group">
            <label>Pilih atasan</label>
                <select class="form-control" style="width:100%;" name="atasan" id="atasan">
                <?php foreach ($atas as $at) {
                  ?>
                <option value="<?= $at['id_user'] ?>"><?= $at['nama_user'] ?></option>
            <?php } ?>

            </select>
        </div>
        
        <div class="form-group">
            <label>Izin Backdate</label>
                <select class="form-control" style="width:100%;" name="backdate" id="backdate">
                <option value="1">ON</option>
                <option value="0">OFF</option>

                
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
<!-- MODAL EDIT -->

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

$(document).ready(function() {
    $('#edit').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);

        var modal = $(this);
        modal.find('#id_user').val(button.data('id_user'));
        modal.find('#nama').val(button.data('nama'));
        modal.find('#jabatan').val(button.data('jabatan'));
        modal.find('#divisi').val(button.data('divisi'));
        modal.find('#atasan').val(button.data('atasan'));
        modal.find('#backdate').val(button.data('izinbackdate'));

    });

    $('.select2').select2();

} );
 
        $(document).ready(function () {
        // create a tree
        $("#tree-data").jOrgChart({
            chartElement: $("#tree-view"), 
            nodeClicked: nodeClicked
        });
        // lighting a node in the selection
        function nodeClicked(node, type) {
            node = node || $(this);
            $('.jOrgChart .selected').removeClass('selected');
                node.addClass('selected');
            }
        });

</script>
