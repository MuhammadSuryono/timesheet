<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Target Kerja Mingguan 2</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/homemingguan')?>">Mingguan</a></div>
        <div class="breadcrumb-item">Divisi <?php echo $tkm['divisi'] ?> <?php echo date('d-m-Y',strtotime($tkm['daritanggal'])); ?> s/d <?php echo date('d-m-Y',strtotime($tkm['sampaitanggal'])); ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Divisi - <b><?php echo $tkm['divisi'] ?></b>  &nbsp;<b><?php echo date('d-m-Y',strtotime($tkm['daritanggal'])); ?> s/d <?php echo date('d-m-Y',strtotime($tkm['sampaitanggal'])); ?></b>
            </div>
            <div class="card-body">

              <form action="<?php echo base_url('mingguan/simpantargetkerja')?>" method="POST">

                <input type="hidden" name="daritanggal" value="<?php echo $tkm['daritanggal']?>">
                <input type="hidden" name="sampaitanggal" value="<?php echo $tkm['sampaitanggal']?>">
                <input type="hidden" name="idtkmdiv" value="<?php echo $tkm['no']?>">

                 <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  $akses = $this->session->userdata('ses_akses');
                  $username = $this->session->userdata('ses_username');
                  if ($akses == 'Manager') {
                    
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                } else {
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                }

                   ?>

                <ol class="umum">

                  <li>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="project0">Project/Program/Pekerjaan :</label>
                          <input type="text" class="form-control" id="project0" name="project0">
                        </div>
                      </div>

                      <!-- <div class="col-sm-4">
                        <div class="form-group">
                          <label for="deskripsi0">Keterangan :</label>
                          <input type="text" class="form-control" id="deskripsi0" name="deskripsi0">
                        </div>
                      </div> -->

                      <div class="col-sm-2">
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
                      </div>

                      <div class="col-sm-4">
                          <div class="form-group">
                            <label>Kategori :</label>
                            <select name="kategori0" id="kategori0" class="form-control select2">
                            <?php $kat= []; foreach($kategori as $kt):?>
                                <option value="<?=$kt['id_kategori']?>"><?=$kt['nama_kategori']?></option>
                            <?php array_push($kat, $kt); endforeach?>
                            </select>
                          </div>
                        </div>

                        <?php foreach($kategori as $kt):?>
                        <input type="hidden" name="kategori" value="<?=$kt['id_kategori']?>**<?=$kt['nama_kategori']?>">
                        <?php endforeach?>

                         <div class="col-sm-4">
                          <div class="form-group">
                            <label>Uraian :</label>
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
<!-- <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Uraian</h5>
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

              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <section id="buttonmodal"> -->
                    <!-- <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button> -->
           <!--      </section>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div> -->
<!-- MODAL TAMBAH -->

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
          <label><b>Pilih Rincian</b></label>
          <!-- <input type="text" class="form-control" id="uraianmodal" name="uraianmodal" value="" required> -->
           <?php
          $no = 1;
          foreach ($waitinglist as $list) {
             ?>
              <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input waitinglist" name="waitinglist" id="waitinglist<?php echo $list['id'] ?>"  value="<?php echo $list['pekerjaan'] ?>">
                    <label class="custom-control-label" for="waitinglist<?php echo $list['id'] ?>"><?php echo $no++ .". ". $list['pekerjaan'] ?> (<span style="color: #1E90FF;"><?php echo $list['nama_user']; ?></span>)</label>
                    <input type="hidden" name="id_list" id="id_list" value="<?php echo $list['id'] ?>">
                </div>
          <?php 
          } ?> 
          <input type="hidden" class="form-control" id="newmodal" name="newmodal" value="">
           <input type="hidden" class="form-control" id="dataid" name="dataid" value="">
        </div>

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

<script>
$(document).ready(function () {
  var i = 1;
  $(".addrow2").on("click", function () {
        var ht =`<li>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="project`+i+`">Project/Program/Pekerjaan :</label>
                          <input type="text" class="form-control" id="project`+i+`" name="project`+i+`">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="deskripsi`+i+`">Keterangan :</label>
                          <input type="text" class="form-control" id="deskripsi`+i+`" name="deskripsi`+i+`">
                        </div>
                      </div>

                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Target Persentase</label>
                          <div class="input-group">
                            <input type="number" class="form-control" id="persentase`+i+`" name="persentase`+i+`" min="1" max="100">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <i class="fas fa-percent"></i>
                              </div>
                            </div>
                          </div>
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
                            <select name="kategori`+i+`" id="kategori`+i+`" class="form-control select2 test">`;

        $("input[name='kategori']").each(function(){
            var kat = $(this).val().split('**');
            ht += `<option value="`+kat[0]+`">`+kat[1]+`</option>`;
        });

        ht +=         `</select>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Uraian :</label>
                            <ol id="ul`+i+`">
                                <section id="linew`+i+`">
                                <input type="hidden" name="uraian`+i+`[]" id="uraian`+i+`[]">
                                </section>
                            </ol>
                          </div>
                        </div>

                        <div class="col-sm-2">
                            <label style="font-weight: 600;color: #34395e;font-size: 12px;letter-spacing: .5px;">Tambah Rincian :</label>
                            <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="`+i+`" data-new="1">Add</button>
                        </div>

                    </div>

                  </li>
                  <hr>`;

      $(".umum").append(ht);
      $("#jmlproject").attr('value', i);
      $('.test').select2();
      i++;

  });

  $('#add').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var html = `<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpan(`+button.data('id')+`)">Simpan</button>`;
        var modal = $(this);
        modal.find('#buttonmodal').html(html);
        modal.find('#uraianmodal').val('');
        modal.find('#newmodal').val(button.data('new'));

    });

});

function simpan(id) {
  console.log(id);
    var val =$('#uraianmodal').val();

    var list = document.getElementsByName('waitinglist');
    var id_list = document.getElementsByName('id_list');
    // console.log(val)
    if(val==''){
        Swal({
            position: 'top',
            type: 'error',
            title: 'Oops...',
            text: 'Rincian Wajib Untuk Diisi'
        });
    } else {
      for (var i = 0; i < list.length; i++) {
           if ( list[i].checked === true ) {
        var no = $(`#linew` + id + ` li`).length;
        var html = `<li id="linew` + id + `` + no + `">` + list[i].value + `
                        <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew` + id + `` + no + `')"><i class="fas fa-trash"></i></a>
                        <input type="hidden" name="uraiannew` + id + `[]" id="uraiannew` + id + `[]" value="` + list[i].value + `">
                        <input type="hidden" name="idlist` + id + `[]" id="idlist` + id + `[]" value="` + id_list[i].value + `">
                    </li>`;
        $('#linew' + id).append(html);
            }
        }
          // var no = $(`#linew`+id+` li`).length;
          // var html = `<li id="linew`+id+``+no+`">`+val+`
          //               <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus('linew`+id+``+no+`')"><i class="fas fa-trash"></i></a>
          //               <input type="hidden" name="uraiannew`+id+`[]" id="uraiannew`+id+`[]" value="`+val+`">
          //           </li>`;
          // $('#linew'+id).append(html);
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
            $('#'+id).remove();
        }
    })
}
</script>
