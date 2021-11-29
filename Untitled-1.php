<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Isi Target Kerja Mingguan 3</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/homemingguan') ?>">Mingguan</a></div>
                <div class="breadcrumb-item">Divisi <?php echo $this->session->userdata('ses_divisi') ?> <?php echo $tanggalnya['t1']; ?> s/d <?php echo $tanggalnya['t2']; ?></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Target Kerja</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Divisi <?php echo $this->session->userdata('ses_divisi') ?> &nbsp;<b><?php echo $tanggalnya['t1']; ?> s/d <?php echo $tanggalnya['t2']; ?></b>
                        </div>
                        <div class="card-body">

                            <form action="<?php echo base_url('mingguan/simpantkm3') ?>" method="POST">

                                <input type="hidden" name="daritanggal" value="<?php echo $tanggalnya['t1'] ?>">
                                <input type="hidden" name="sampaitanggal" value="<?php echo $tanggalnya['t2'] ?>">

                                <ol class="umum">

                                    <?php
                                    if (empty($cariproject)) {
                                        echo "";
                                    } else {
                                        $i = 0;
                                        foreach ($cariproject as $cp) {
                                            $i++;
                                    ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="prapro<?php echo $i; ?>">Project/Program/Pekerjaan :</label>
                                                            <input type="text" class="form-control" id="prapro<?php echo $i; ?>" name="prapro<?php echo $i; ?>" value="<?php echo $cp['project'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <!-- 
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Target Persentase</label>
                              <div class="input-group">
                                <input type="number" class="form-control" id="praper<?php echo $i; ?>" name="praper<?php echo $i; ?>" max="<?php echo 100 - $cp['sumper']; ?>" placeholder="max : <?php echo 100 - $cp['sumper']; ?>">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <i class="fas fa-percent"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> -->

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Kategori :</label>
                                                            <select name="prakategori<?= $i ?>" id="prakategori<?= $i ?>" class="form-control select2" required>
                                                                <option selected value="<?php echo $cp['idkategori']; ?>"><?php echo $cp['namakategori']; ?></option>
                                                                <?php foreach ($kategori as $kt) : ?>
                                                                    <option value="<?= $kt['id_kategori'] ?>"><?= $kt['nama_kategori'] ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Rincian :</label>
                                                            <ol id="ul<?= $i ?>">
                                                                <section id="li<?= $i ?>">
                                                                    <!-- <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" val=""> -->
                                                                </section>
                                                            </ol>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                                                        <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="<?= $i ?>" data-new="0">Add</button>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Lintas Divisi :</label>
                                                            <ol id="uldivisi<?= $i ?>">
                                                                <section id="lidivisi<?= $i ?>">
                                                                    <!-- <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" val=""> -->
                                                                </section>
                                                            </ol>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Divisi :</label><br>
                                                        <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-toggle="modal" data-target="#adddivisi" data-id="<?= $i ?>" data-new="0">Add</button>
                                                    </div>

                                                </div>
                                                <hr>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        <input type="hidden" name="jmlprapo" value="<?php echo $i; ?>">
                                    <?php
                                    }
                                    ?>



                                    <li>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="project0">Project/Program/Pekerjaan :</label>
                                                    <input type="text" class="form-control" id="project0" name="project0">
                                                </div>
                                            </div>

                                            <!-- <div class="col-sm-2">
                        <div class="form-group">
                          <label>Target Persentase</label>
                          <div class="input-group">
                            <input type="number" class="form-control" id="persentase0" name="persentase0" min="1" max="100">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <i class="fas fa-percent"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Kategori :</label>
                                                    <select name="kategori0" id="kategori0" class="form-control select2">
                                                        <?php $kat = [];
                                                        foreach ($kategori as $kt) : ?>
                                                            <option value="<?= $kt['id_kategori'] ?>"><?= $kt['nama_kategori'] ?></option>
                                                        <?php array_push($kat, $kt);
                                                        endforeach ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php foreach ($kategori as $kt) : ?>
                                                <input type="hidden" name="kategori" value="<?= $kt['id_kategori'] ?>**<?= $kt['nama_kategori'] ?>">
                                            <?php endforeach ?>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Rincian :</label>
                                                    <ol id="ul0">
                                                        <section id="linew0">
                                                            <!-- <input type="hidden" name="uraiannew0[]" id="uraiannew0[]"> -->
                                                        </section>
                                                    </ol>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                                                <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="0" data-new="1">Add</button>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Lintas Divisi :</label>
                                                    <ol id="uldivisinew0">
                                                        <section id="lidivisinew0">
                                                            <!-- <input type="hidden" name="uraian<?= $i ?>[]" id="uraian<?= $i ?>[]" val=""> -->
                                                        </section>
                                                    </ol>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Divisi :</label><br>
                                                <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-toggle="modal" data-target="#adddivisi" data-id="0" data-new="1">Add</button>
                                            </div>

                                        </div>

                                        <hr>
                                    </li>
                                </ol>

                                <input type="hidden" id="jmlproject" name="jmlproject" value="0">

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="button" class="addrow2 btn btn-primary d-inline ml-3" style="display:block;"><i class="fa fa-plus"></i> Tambah</button>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rincian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Isi Rincian</label>
                    <input type="text" class="form-control" id="uraianmodal" name="uraianmodal" value="" required>
                    <input type="hidden" class="form-control" id="newmodal" name="newmodal" value="">
                </div>

                <!-- <div class="form-group">
          <label>Bobot Persentase</label>
          <input type="number" class="form-control" id="bobotmodal" name="bobotmodal" value="" required>
        </div> -->

            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <section id="buttonmodal">
                    <!-- <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button> -->
                </section>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- MODAL TAMBAH -->

<!-- MODAL TAMBAH -->
<div class="modal fade" tabindex="-1" role="dialog" id="adddivisi">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <input type="hidden" class="form-control" id="newmodaldivisi" name="newmodaldivisi" value="">
                    <label>Pilih Divisi</label>
                    <select class="form-control form-control-sm" name="divisimodal" id="divisimodal">
                        <option value="0">---Pilih Divisi---</option>
                        <?php foreach ($divisi as $db) : ?>
                            <option value="<?= $db['divisi'] ?>"><?= $db['divisi'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <section id="buttonmodaldivisi">
                    <!-- <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button> -->
                </section>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- MODAL TAMBAH -->

<script>
    $(document).ready(function() {
        var i = 1;
        $(".addrow2").on("click", function() {
            var ht = `<li>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="project` + i + `">Project/Program/Pekerjaan :</label>
                          <input type="text" class="form-control" id="project` + i + `" name="project` + i + `">
                        </div>
                      </div>

                      <div class="col-sm-2">
                        <div class="form-group">
                            <label for="">-</label>
                            <button class="ibtnDel btn-sm btn-danger" style="display:block;"><i class="fa fa-minus"></i></button>
                        </div>
                        </div>

                      <div class="col-sm-4">
                          <div class="form-group">
                            <label>Kategori :</label>
                            <select name="kategori` + i + `" id="kategori` + i + `" class="form-control select2 test">`;

            $("input[name='kategori']").each(function() {
                var kat = $(this).val().split('**');
                ht += `<option value="` + kat[0] + `">` + kat[1] + `</option>`;
            });

            ht += `</select>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Rincian :</label>
                            <ol id="ul` + i + `">
                                <section id="linew` + i + `">
                                <input type="hidden" name="uraian` + i + `[]" id="uraian` + i + `[]">
                                </section>
                            </ol>
                          </div>
                        </div>

                        <div class="col-sm-2">
                            <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="` + i + `" data-new="1">Add</button>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Lintas Divisi :</label>
                            <ol id="uldivisinew` + i + `">
                            <section id="lidivisinew` + i + `">
                            </section>
                            </ol>
                          </div>
                        </div>

                        <div class="col-sm-2">
                            <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Divisi :</label><br>
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-primary" data-toggle="modal" data-target="#adddivisi" data-id="` + i + `" data-new="1">Add</button>
                        </div>

                    </div>

                  </li>
                  <hr>`;

            $(".umum").append(ht);
            $("#jmlproject").attr('value', i);
            $('.test').select2();
            i++;

        });

        $('#add').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var html = `<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpan(` + button.data('id') + `)">Simpan</button>`;
            var modal = $(this);
            modal.find('#buttonmodal').html(html);
            modal.find('#uraianmodal').val('');
            modal.find('#bobotmodal').val('');
            modal.find('#newmodal').val(button.data('new'));

        });

        $('#adddivisi').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var html = `<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpandivisi(` + button.data('id') + `)">Simpan</button>`;
            var modal = $(this);
            modal.find('#buttonmodaldivisi').html(html);
            modal.find('#newmodaldivisi').val(button.data('new'));
        });

    });

    function simpan(id) {
        var val = $('#uraianmodal').val();
        var bobot = $('#bobotmodal').val();

        if (val == '' || bobot == '') {
            Swal({
                position: 'top',
                type: 'error',
                title: 'Oops...',
                text: 'Rincian dan Bobot Persentase Wajib Untuk Diisi'
            });
        } else {
            if ($('#newmodal').val() == 0) {
                var no = $(`#li` + id + ` li`).length;

                var html = `<li id="` + id + `` + no + `">` + val + ` 
                        <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus(` + id + `` + no + `)"><i class="fas fa-trash"></i></a>
                        <input type="hidden" name="uraian` + id + `[]" id="uraian` + id + `[]" value="` + val + `">
                        <input type="hidden" name="bobotpersen` + id + `[]" id="bobotpersen` + id + `[]" value="` + bobot + `">
                    </li>`;
                $('#li' + id).append(html);
            } else {
                var no = $(`#linew` + id + ` li`).length;
                var html = `<li id="` + id + `` + no + `">` + val + ` 
                        <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `` + no + `')"><i class="fas fa-trash"></i></a>
                        <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + val + `">
                        <input type="hidden" name="bobotpersennew` + id + `[]" id="bobotpersennew` + id + `[]" value="` + bobot + `">
                    </li>`;
                $('#linew' + id).append(html);
            }
        }
    }


    function simpandivisi(id) {
        var val = $('#divisimodal').val();
        if (val == 0) {
            Swal({
                position: 'top',
                type: 'error',
                title: 'Oops...',
                text: 'Anda Tidak Memilih Divisi'
            });
        } else {
            if ($('#newmodaldivisi').val() == 0) {
                var no = $(`#lidivisi` + id + ` li`).length;
                var cari = [];

                $(`input[name='divisi` + id + `[]']`).each(function() {
                    cari.push($(this).val());
                });
                if (cari.indexOf(val) < 0) {
                    var html = `<li id="lidivisi` + id + `` + no + `">` + val + `
                            <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapusdivisi('lidivisi` + id + `` + no + `')"><i class="fas fa-trash"></i></a>
                            <input type="hidden" name="divisi` + id + `[]" id="divisi` + id + `[]" value="` + val + `">
                        </li>`;
                    $('#lidivisi' + id).append(html);
                }
            } else {
                var no = $(`#lidivisinew` + id + ` li`).length;

                var cari = [];

                $(`input[name='divisinew` + id + `[]']`).each(function() {
                    cari.push($(this).val());
                });
                if (cari.indexOf(val) < 0) {
                    var html = `<li id="lidivisinew` + id + `` + no + `">` + val + `
                            <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapusdivisi('lidivisinew` + id + `` + no + `')"><i class="fas fa-trash"></i></a>
                            <input type="hidden" name="divisinew` + id + `[]" id="divisinew` + id + `[]" value="` + val + `">
                        </li>`;
                    $('#lidivisinew' + id).append(html);
                }
            }
        }
    }

    function hapus(id) {
        Swal({
            title: 'Apakah anda yakin',
            text: "data akan dihapus",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                $('#' + id).remove();
            }
        })
    }

    function hapusdivisi(id) {
        Swal({
            title: 'Apakah anda yakin',
            text: "data akan dihapus",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                $('#' + id).remove();
            }
        })
    }
</script>