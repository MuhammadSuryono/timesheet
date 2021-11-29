<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Isi Target Kerja Mingguan 5 <?php echo $usernya['nama_user']?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/tkmdiv')?>">List TKM</a></div>
        <div class="breadcrumb-item"><a href="#">View TKM Lintas Divisi</a></div>
        <div class="breadcrumb-item">Staff</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja Lintas Divisi</h2>
      <p class="section-lead"><?php echo $usernya['nama_user']?> <b><?php //echo $divnya['daritanggal']; ?> s/d <?php //echo $divnya['sampaitanggal']; ?></b></p>

      <div class="card card-primary">
        <div class="card-header">
          <h4>TKM Lintas Divisi <?php echo $usernya['divisi']?> <?php //echo $divnya['daritanggal'] ?> s/d <?php //echo $divnya['sampaitanggal'] ?></h4>
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="list-unstyled list-unstyled-border mt-4">

            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <!-- <h4>Target Kerja <?php// echo $divnya['divisi']?> <?php// echo $divnya['daritanggal']?> s/d <?php// echo $divnya['sampaitanggal']?></h4> -->
                    <!-- <div class="card-header-action"> -->

                      <!-- <a href="<?php// echo base_url('mingguan/viewtkmdivisi')?>/<?php// echo $divnya['no']?>" class="btn btn-info">View</a> -->
                      <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                    </div>
                  </div>
                  <div class="collapse" id="mycard-collapse">
                    <div class="card-body">

                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Project</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Persentase</th>
                                    <th>Uraian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- LINTAS DIVISI -->
                                <?php
                                $tgl = $tanggal['tanggalnya'];
                                $divisinya = $usernya['divisi'];
                                $x=1;
                                $cari = $this->db->query("SELECT
                                                                    a.*,
                                                                    b.project,
                                                                    b.deskripsi,
                                                                    b.persentase,
                                                                    b.tambahan,
                                                                    b.daritanggal as drtgl_lintasdiv,
                                                                    b.sampaitanggal as sptgl_lintasdiv,
                                                                    b.divisi as lintasdiv,
                                                                    b.tambahan,
                                                                    b.no as idpekerjaan,
                                                                    c.nama_kategori,
                                                                    d.*
                                                                FROM pekerjaan_lintasdivisi b
                                                                JOIN tkmdivisi a ON a.no = b.idtkmdiv
                                                                LEFT JOIN kategori c ON c.id_kategori = b.id_kategori
                                                                LEFT JOIN uraian d ON b.no = d.id_pekerjaan
                                                                WHERE b.daritanggal = '$tgl'
                                                                AND b.divisi='$divisinya'
                                                                GROUP BY b.project")->result_array();
                                    $jml = count($cari);
                                    if($jml>0):

                                        foreach ($cari as $cp) {
                                        if($cp['tambahan'] == NULL){
                                        $warna = "";
                                        }else{
                                        $warna = "#a1c5e6";
                                        }
                                    $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$cp[idpekerjaan]'")->result_array();
                                    $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$cp[idpekerjaan]'")->row_array();
                                    $rowspan = $jmlurai['jmu']+1;
                                    // echo $rowspan;
                                    ?>
                                  <tr bgcolor="<?php echo $warna ?>">
                                      <td rowspan="<?=$rowspan?>"><?=$x++?></td>
                                      <td rowspan="<?=$rowspan?>"><?php echo $cp['project'] ?> ( From <?=$cp['divisi']?> )</td>
                                      <td rowspan="<?=$rowspan?>"><?php echo $cp['nama_kategori'] ?></td>
                                      <td rowspan="<?=$rowspan?>"><?php echo $cp['status'] ?></td>
                                      <td rowspan="<?=$rowspan?>" class="text-center"><?php echo $cp['persentase']?>%
                                        <div class="progress" data-height="4">
                                          <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase']?>%" aria-valuenow="<?php echo $cp['persentase']?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                  </tr>
                                  <?php foreach($uraian as $ua):?>
                                  <tr>
                                      <td><?php echo $ua['uraian']?></td>
                                  </tr>

                                  <!-- IWAYRIWAY -->
                                        <input type="hidden" name="uraiantbl<?=$cp['no']?>" id="uraiantbl<?=$cp['no']?>" value="<?=$ua['uraian']?>">
                                    <!-- IWAYRIWAY -->

                                  <?php endforeach?>
                                  <?php
                                  }
                                  ?>
                                  <?php endif?>
                                <!-- LINTAS DIVISI -->

                            </tbody>
                        </table>
                        </div>
                    </div>

          </div>
        </div>
        </div>
      </div>



      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>TKM <?php echo $usernya['nama_user']?> <?php //echo $divnya['daritanggal'] ?> s/d <?php //echo $divnya['sampaitanggal'] ?></h4>
            </div>
            <div class="card-body">
              <div class="form-group row mb-4">
                <div class="col-sm-12">
                  <form action="<?php echo base_url('mingguan/prosesisitkmstaff5')?>" method="POST">


                  <input type="hidden" name="userstaff" value="<?php echo $usernya['id_user']?>">
                  <ul class="umum">

                  <?php
                        $cari = $this->db->query("SELECT
                                                  	a.*, b.project,
                                                  	b.deskripsi,
                                                  	b.persentase,
                                                  	b.tambahan,
                                                  	b.daritanggal AS drtgl_lintasdiv,
                                                  	b.sampaitanggal AS sptgl_lintasdiv,
                                                  	b.divisi AS lintasdiv,
                                                  	b.tambahan,
                                                  	b. NO AS idpekerjaan,
                                                  	c.nama_kategori,
                                                  	d.*
                                                  FROM
                                                  	pekerjaan_lintasdivisi b
                                                  JOIN tkmdivisi a ON a. NO = b.idtkmdiv
                                                  LEFT JOIN kategori c ON c.id_kategori = b.id_kategori
                                                  LEFT JOIN uraian d ON b. NO = d.id_pekerjaan
                                                  WHERE
                                                  	CASE
                                                  WHEN a.status ='Disetujui' THEN b.daritanggal = '$tgl' AND b.divisi = '$divisinya'
                                                  ELSE b.daritanggal = '$tgl' AND b.divisi = '$divisinya' AND (b.id_kategori='1' OR b.id_kategori='2')
                                                  END
                                                  GROUP BY
                                                  	b.project")->result_array();
                  ?>
                  <!-- LINTAS DIVISI -->
                  <?php
                    $jml = count($cari);
                    if($jml>0):
                    $i = 0;
                    foreach ($cari as $key):
                    $i++;
                    ?>
                        <input type="hidden" name="idtkmdiv<?=$i?>" value="<?php echo $key['no'] ?>">
                        <input type="hidden" name="idpekerjaan<?=$i?>" value="<?php echo $key['idpekerjaan']?>">

                      <li>
                        <div class="row">

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="project<?php echo $i; ?>">Project/Program/Pekerjaan :</label>
                              <input type="text" class="form-control" id="project<?php echo $i; ?>" name="project<?php echo $i; ?>" value="<?php echo $key['project']?>" readonly>
                            </div>
                          </div>

                          <!-- <div class="col-sm-3">
                            <div class="form-group">
                              <label for="deskripsi<?php echo $i; ?>">Keterangan :</label>
                              <input type="text" class="form-control" id="deskripsi<?php echo $i; ?>" value="<?php echo $key['deskripsi']?>" readonly>
                            </div>
                          </div> -->

                          <?php
                          $tamper = $this->db->query("SELECT
                                                      	sum(persentase) AS sumper
                                                      FROM
                                                      	tkmstaff
                                                      WHERE
                                                      	project = '$key[project]'
                                                      AND idtkmdiv = '$key[no]'
                                                      AND userstaff IN (SELECT id_user FROM tb_user WHERE divisi ='$usernya[divisi]')")->row_array();
                          ?>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Target Persentase</label>
                              <div class="input-group">
                                <input type="number" class="form-control" id="persentase<?php echo $i; ?>" name="persentase<?php echo $i; ?>" max="<?php echo $key['persentase'] - $tamper['sumper'];?>" placeholder="max : <?php echo $key['persentase'] - $tamper['sumper']; ?>">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <i class="fas fa-percent"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="deskripsi<?php echo $i; ?>">Rincian :</label>
                              <ol>
                                <section id="li<?=$i?>">
                                    <?//php $nama = $db['id_tkmstaff']; if()?>
                                <!-- <li id="<?//=$i?>1">Lorem ipsum dolor
                                    <a href="javascript:void(0)" title="Delete" class="text-danger mr-3 " onclick="hapus(<?//=$i?>1)"><i class="fas fa-trash"></i></a>
                                    <input type="hidden" name="rincian<?//=$i?>[]" id="rincian<?//=$i?>[]">
                                </li> -->
                                </section>
                              </ol>
                            </div>
                          </div>

                          <div class="col-sm-1">
                            <butoon class="btn btn-sm btn-round btn-block btn-primary my-4" data-toggle="modal" onclick="tambahrincian2('<?php echo $key['no']?>', '<?=$i?>')">Add</butoon>
                          </div>



                        </div>
                      </li>
                        <hr>
                      <?php endforeach; ?>
                      <?php endif?>
                      <!-- LINTAS DIVISI -->
                    </ul>
                    <input type="hidden" name="tgldivisnya" value="<?php echo $tgl; ?>">
                    <input type="hidden" name="jmlproject" value="<?php echo $i; ?>">

                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label col-12"></label>
                <div class="col-sm-12 col-md-7">
                  <?php
                  if(empty($cari)){
                  ?>
                  <p>Status TKM lintas divisi masih 'Menunggu Approval'</p>
                  <?php
                  }else{
                  ?>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <?php
                  }
                  ?>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>


<!-- MODAL TAMBAH -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-addrincian">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Rincian pekerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">

              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <section id="buttonmodal">
                </section>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- MODAL TAMBAH -->

<script>

function tambahrincian2(id_pekerjaan, nomor){
    var nama = `uraiantbl`+id_pekerjaan;
    var html = `<h6>Rincian Pekerjaan</h6>`;
    var button = `<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpan2(`+id_pekerjaan+`,`+nomor+`)">Simpan</button>`;
    var i = 0;

    $(`input[name='`+nama+`']`).each(function(){
        i++;
        html += `<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="checkbox`+id_pekerjaan+`" id="customCheck`+id_pekerjaan+``+i+`"  value="`+$(this).val()+`">
                    <label class="custom-control-label" for="customCheck`+id_pekerjaan+``+i+`">`+i+`. `+$(this).val()+`</label>
                </div>`;
    });


    $('.modal-body').html(html);
    $('#buttonmodal').empty();
    if(i != 0){
        $('#buttonmodal').html(button);
    }

    $('#modal-addrincian').modal();
}

function simpan2(id_pekerjaan, nomor) {
    var nama = `checkbox`+id_pekerjaan;
    var nama2 = `uraiantbl`+id_pekerjaan;
    // console.log(nama);
    $(`input[name='`+nama+`']`).each(function(){
        if ($(this).is(":checked"))
        {
            var val = $(this).val();
            var no = $(`#li`+nomor+` li`).length;

            var html = `<li id="`+nomor+``+no+`">`+val+`
                            <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus(`+nomor+``+no+`, `+id_pekerjaan+`, '`+val+`')"><i class="fas fa-trash"></i></a>
                        <input type="hidden" name="rincian`+nomor+`[]" id="rincian`+nomor+`[]" value="`+val+`">
                        </li>`;

            $('#li'+nomor).append(html);
            $(`input[name='`+nama2+`'][value='`+val+`']`).remove();
        }
    });
}

function hapus(id, id_pekerjaan, val) {
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

            var html = `<input type="hidden" name="uraiantbl`+id_pekerjaan+`" id="uraiantbl`+id_pekerjaan+`" value="`+val+`">`;
            $(`#hidden`+id_pekerjaan).append(html);

            $('#'+id).remove();
        }
    })
}

// $('#menu ul li').length

</script>
