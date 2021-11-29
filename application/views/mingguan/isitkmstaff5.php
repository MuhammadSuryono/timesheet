<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Isi Target Kerja Mingguan <?php echo $usernya['nama_user'] ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/tkmdiv') ?>">List TKM</a></div>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/viewtkmdivisi') ?>/<?php echo $divnya['no'] ?>">View TKM</a></div>
        <div class="breadcrumb-item">Staff</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja</h2>
      <p class="section-lead"><?php echo $usernya['nama_user'] ?> <b><?php echo date('d-m-Y', strtotime($divnya['daritanggal'])) ?> s/d <?php echo date('d-m-Y', strtotime($divnya['daritanggal'])) ?></b></p>

      <div class="card card-primary">
        <div class="card-header">
          <h4>TKM Divisi<?php echo $divnya['divisi'] ?> <?php echo date('d-m-Y', strtotime($divnya['daritanggal'])) ?> s/d <?php echo date('d-m-Y', strtotime($divnya['sampaitanggal'])) ?></h4>
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="list-unstyled list-unstyled-border mt-4">

            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <input type="hidden" name="max_date" id="max_date" value="<?php echo $divnya['sampaitanggal'] ?>">
                  <!-- <h4>Target Kerja <?php// echo $divnya['divisi']?> <?php// echo $divnya['daritanggal']?> s/d <?php// echo $divnya['sampaitanggal']?></h4> -->
                  <!-- <div class="card-header-action"> -->

                  <!-- <a href="<?php// echo base_url('mingguan/viewtkmdivisi')?>/<?php// echo $divnya['no']?>" class="btn btn-info">View</a> -->
                  <a data-collapse="#mycard-collapse<?php echo $divnya['no'] ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="collapse" id="mycard-collapse<?php echo $divnya['no'] ?>">
                <div class="card-body">

                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Project</th>
                          <th>Kategori</th>
                          <th>Deskripsi</th>
                          <th>Persentase</th>
                          <th>Uraian</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                         $divisinya = $this->session->userdata('ses_divisi');
                        $user_name = $this->uri->segment(3); 
                        $caripekerjaan = $this->db->query("SELECT
                                                                          a.*,
                                                                          b.nama_kategori AS namakategori
                                                                          FROM pekerjaan a
                                                                          JOIN kategori b ON a.id_kategori = b.id_kategori
                                                                          WHERE idtkmdiv='$divnya[no]'")->result_array();
                        $x = 1;

                        foreach ($caripekerjaan as $cp) {
                          $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$cp[no]' ")->result_array();
                          // $uraian2 = $this->db->query("SELECT id_pekerjaan, uraian, bobotpersentase FROM uraian WHERE id_pekerjaan='$cp[no]' UNION ALL SELECT id as id_pekerjaan, pekerjaan, username as uraian FROM list_note WHERE username='$user_name' AND (pekerjaan IS NOT NULL AND pekerjaan != '') ")->result_array();
                          $leader = $this->db->query("SELECT * FROM tb_user WHERE divisi = '$divisinya' AND hak_akses = 'Manager'")->row_array();


                          $uraian2 = $this->db->query("SELECT * FROM list_note WHERE username='$user_name' AND (pekerjaan IS NOT NULL AND pekerjaan != '') OR username = '$leader[id_user]'")->result_array();
                          $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$cp[no]'")->row_array();
                          $rowspan = $jmlurai['jmu'] + 1;
                          // echo $rowspan;
                        ?>
                          <tr>
                            <td rowspan="<?= $rowspan ?>"><?= $x++ ?></td>
                            <td rowspan="<?= $rowspan ?>"><?php echo $cp['project'] ?></td>
                            <td rowspan="<?= $rowspan ?>"><?php echo $cp['namakategori'] ?></td>
                            <td rowspan="<?= $rowspan ?>"><?php echo $cp['deskripsi'] ?></td>
                            <td rowspan="<?= $rowspan ?>" class="text-center"><?php echo $cp['persentase'] ?>%
                              <div class="progress" data-height="4">
                                <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase'] ?>%" aria-valuenow="<?php echo $cp['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          <section id="hidden<?= $cp['no'] ?>">
                            <?php foreach ($uraian as $ua) : ?>
                              <tr>
                                <td><?php echo $ua['uraian'] ?></td>
                              </tr>

                              <!-- IWAYRIWAY -->
                              <?php if ($ua['bobotpersentase'] != 100) : ?>
                                <input type="hidden" name="uraiantbl<?= $cp['no'] ?>" id="uraiantbl<?= $cp['no'] ?>" value="<?= $ua['uraian'] ?>">
                                <input type="hidden" name="boboturaian<?= $cp['no'] ?>" id="boboturaian<?= $cp['no'] ?>" value="<?= $ua['bobotpersentase'] ?>">
                              <?php endif; ?>
                              <!-- IWAYRIWAY -->
                            <?php endforeach ?>
                          </section>

                        <?php
                     
                        ?>

                        <?php foreach ($uraian as $ua) :
                          $cekRincian = $this->db->query("SELECT rincian FROM rincian WHERE rincian = '$ua[uraian]' AND userstaff = '$user_name'")->num_rows();
                                // if($cekRincian >= 1){
                                //   continue;
                                // }
                         ?>

                         <input type="hidden" name="uraiantbl2<?= $cp['no'] ?>" id="uraiantbl2<?= $cp['no'] ?>" value="<?= $ua['uraian'] ?>" data-tgll="<?= $ua['targetselesai'] ?>">
                         <input type="hidden" name="selesai<?= $cp['no'] ?>" id="selesai<?= $cp['no'] ?>" value="<?= $ua['targetselesai'] ?>">

                         <input type="hidden" name="boboturaian2<?= $cp['no'] ?>" id="boboturaian2<?= $cp['no'] ?>" value="<?= $ua['bobotpersentase'] ?>">
                         <input type="hidden" name="<?= $ua['uraian'] ?>" id="<?= $ua['uraian'] ?>" value="<?= $ua['id_uraian'] ?>">
                       <?php endforeach; ?>

                       <!-- <?php foreach ($uraian2 as $za) :
                          $cekRincian = $this->db->query("SELECT rincian FROM rincian WHERE rincian = '$za[pekerjaan]' AND id_list = '$za[id]' AND userstaff = '$user_name'")->num_rows();
                                if($cekRincian >= 1){
                                  continue;
                                }

                        $cekUraian = $this->db->query("SELECT * FROM uraian WHERE uraian = '$za[pekerjaan]'")->num_rows();
                        if($cekUraian >= 1){
                                  continue;
                                }
                         ?>

                         <input type="hidden" name="uraiantbl2<?= $cp['no'] ?>" id="uraiantbl2<?= $cp['no'] ?>" value="<?= $za['pekerjaan'] ?>">

                         <input type="hidden" name="<?= $za['pekerjaan'] ?>" id="<?= $za['pekerjaan'] ?>" value="<?= $za['id'] ?>">
                       
                       <?php endforeach; 
                          } ?> -->

                        <!-- LINTAS DIVISI -->
                        <?php
                        $tgl = $divnya['daritanggal'];
                        $divisinya = $this->session->userdata('ses_divisi');
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
                        if ($jml > 0) :

                          foreach ($cari as $cp) {
                            if ($cp['tambahan'] == NULL) {
                              $warna = "";
                            } else {
                              $warna = "#a1c5e6";
                            }
                            $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$cp[idpekerjaan]'")->result_array();
                            $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$cp[idpekerjaan]'")->row_array();
                            $rowspan = $jmlurai['jmu'] + 1;
                            // echo $rowspan;
                        ?>
                            <tr bgcolor="<?php echo $warna ?>">
                              <td rowspan="<?= $rowspan ?>"><?= $x++ ?></td>
                              <td rowspan="<?= $rowspan ?>"><?php echo $cp['project'] ?> ( <?= $cp['divisi'] ?> )</td>
                              <td rowspan="<?= $rowspan ?>"><?php echo $cp['nama_kategori'] ?></td>
                              <td rowspan="<?= $rowspan ?>"><?php echo $cp['deskripsi'] ?></td>
                              <td rowspan="<?= $rowspan ?>" class="text-center"><?php echo $cp['persentase'] ?>%
                                <div class="progress" data-height="4">
                                  <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase'] ?>%" aria-valuenow="<?php echo $cp['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                            </tr>
                            <?php foreach ($uraian as $ua) : ?>
                              <tr>
                                <td><?php echo $ua['uraian'] ?></td>
                              </tr>

                              <!-- IWAYRIWAY -->
                              <input type="hidden" name="uraiantbl<?= $cp['no'] ?>" id="uraiantbl<?= $cp['no'] ?>" value="<?= $ua['uraian'] ?>">
                              <input type="hidden" name="boboturaian<?= $cp['no'] ?>" id="boboturaian<?= $cp['no'] ?>" value="<?= $ua['bobotpersentase'] ?>">
                              <!-- IWAYRIWAY -->

                            <?php endforeach ?>
                          <?php
                          }
                          ?>
                        <?php endif ?>
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
                <h4>TKM <?php echo $usernya['nama_user'] ?> <?php echo date('d-m-Y', strtotime($divnya['daritanggal'])) ?> s/d <?php echo date('d-m-Y', strtotime($divnya['sampaitanggal'])) ?></h4>
              </div>
              <div class="card-body">
                <div class="form-group row mb-4">
                  <div class="col-sm-12">
                    <form action="<?php echo base_url('mingguan/prosesisitkmstaff5') ?>" method="POST">


                      <input type="hidden" name="userstaff" value="<?php echo $usernya['id_user'] ?>">
                      <input type="hidden" name="id_tkm" value="<?php echo $id_tkm ?>">
                      <ul class="umum">
                        <div class="table-responsive">
                           <table class="table table-bordered" style="table-layout: auto; word-wrap: break-word; width: 100%;">
                             <thead>
                               <tr>
                                 <th style="width: 10%">No</th>
                                 <th style="width: 40%">Project/Program/Pekerjaan</th>
                                 <th style="width: 40%">Target Selesai</th>
                                 <th style="width: 10%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody id="baristkm">

                        <?php
                        $i = 0;
                        foreach ($kerjaan as $key) :
                          $i++;
                        ?>
                          <input type="hidden" name="idtkmdiv<?= $i ?>" value="<?php echo $divnya['no'] ?>">
                          <input type="hidden" name="idpekerjaan<?= $i ?>" value="<?php echo $key['no'] ?>">

                          <!-- <li>
                            <div class="row">

                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="project<?php echo $i; ?>">Project/Program/Pekerjaan :</label> -->
                                  <tr>
                                    <td><?= $i ?></td>
                                    <td><?php echo $key['project'] ?>
                                  <input type="hidden" class="form-control" id="project<?php echo $i; ?>" name="project<?php echo $i; ?>" value="<?php echo $key['project'] ?>" readonly>
                                  </td>
                                <!-- </div>
                              </div> -->

                              <!-- <div class="col-sm-3">
                            <div class="form-group">
                              <label for="deskripsi<?php //echo $i; 
                                                    ?>">Keterangan :</label>
                              <input type="text" class="form-control" id="deskripsi<?php //echo $i; 
                                                                                    ?>" value="<?php //echo $key['deskripsi']
                                                                                                ?>" readonly>
                            </div>
                          </div> -->

                              <?php
                              $tamper = $this->db->query("SELECT sum(persentase) AS sumper FROM tkmstaff WHERE project='$key[project]' AND idtkmdiv='$divnya[no]'
                            AND userstaff IN (SELECT id_user FROM tb_user WHERE divisi ='$usernya[divisi]')")->row_array();
                              ?>

                              <!-- <div class="col-sm-6">

                                <div class="form-group">
                                  <div class="row">
                                      <div class="col-sm-6 form-group"><label for="deskripsi<?php echo $i; ?>">Rincian :</label></div>
                                      <div class="col-sm-6 form-group" ><label for="deskripsi<?php echo $i; ?>">Tanggal Target Selesai :</label></div>
                                   -->
                                 <td>
                                  <ol>
                                    <section id="li<?= $i ?>">
                                      <?//php $nama = $db['id_tkmstaff']; if()?>
                                      <!-- <li id="<?//=$i?>1">Lorem ipsum dolor
                                    <a href="javascript:void(0)" title="Delete" class="text-danger mr-3 " onclick="hapus(<?//=$i?>1)"><i class="fas fa-trash"></i></a>
                                    <input type="hidden" name="rincian<?//=$i?>[]" id="rincian<?//=$i?>[]">
                                </li> -->
                                    </section>
                                  </ol>
                                </td>
                                <!-- </div> -->
                            <!--   </div>
                            </div>
                            </div> -->

                              <!-- <div class="col-sm-1"> -->
                                <td>
                                <butoon class="btn btn-sm btn-round btn-block btn-primary my-4" data-toggle="modal" onclick="tambahrincian2('<?php echo $key['no'] ?>', '<?= $i ?>')">Add</butoon>
                                </td>
                              <!-- </div> -->
                              <!-- <input type="text" name="cek" value="<?php echo $key['no'] ?>', '<?= $i ?>"> -->

                              <!-- <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="targetselesai<?php echo $i; ?>">Tanggal Target Selesai :</label>
                                  <input type="date" class="form-control" name="targetselesai<?php echo $i; ?>" id="targetselesai<?php echo $i; ?>" required>
                                  
                                </div>
                              </div> -->

                              


                            </tr>
                            <!-- </div> -->
                          <!-- </li>
                          <hr> -->
                        <?php endforeach; ?>

                        <!-- LINTAS DIVISI -->
                        <?php
                        // $cari = $this->db->query("SELECT
                        //                                               a.*,
                        //                                               b.project,
                        //                                               b.deskripsi,
                        //                                               b.persentase,
                        //                                               b.tambahan,
                        //                                               b.daritanggal as drtgl_lintasdiv,
                        //                                               b.sampaitanggal as sptgl_lintasdiv,
                        //                                               b.divisi as lintasdiv,
                        //                                               b.tambahan,
                        //                                               b.no as idpekerjaan,
                        //                                               c.nama_kategori,
                        //                                               d.*
                        //                                           FROM pekerjaan_lintasdivisi b
                        //                                           JOIN tkmdivisi a ON a.no = b.idtkmdiv
                        //                                           LEFT JOIN kategori c ON c.id_kategori = b.id_kategori
                        //                                           LEFT JOIN uraian d ON b.no = d.id_pekerjaan
                        //                                           WHERE b.daritanggal = '$tgl'
                        //                                           AND b.divisi='$divisinya'
                        //                                           GROUP BY b.project")->result_array();
                        //               $jml = count($cari);
                        //               if($jml>0):
                        //               foreach ($cari as $key):
                        //               $i++;
                        ?>


                        <!-- <input type="hidden" name="idtkmdiv<?php //echo $i 
                                                                ?>" value="<?php //echo $key['no'] 
                                                                            ?>">
                        <input type="hidden" name="idpekerjaan<?php //echo $i 
                                                              ?>" value="<?php //echo $key['idpekerjaan']
                                                                          ?>"> -->

                        <!-- <li>
                        <div class="row">

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="project<?php //echo $i; 
                                                  ?>">Project/Program/Pekerjaan :</label>
                              <input type="text" class="form-control" id="project<?php //echo $i; 
                                                                                  ?>" name="project<?php //echo $i; 
                                                                                                    ?>" value="<?php //echo $key['project']
                                                                                                                ?>" readonly>
                            </div>
                          </div> -->

                        <!-- <div class="col-sm-3">
                            <div class="form-group">
                              <label for="deskripsi<?php //echo $i; 
                                                    ?>">Keterangan :</label>
                              <input type="text" class="form-control" id="deskripsi<?php //echo $i; 
                                                                                    ?>" value="<?php //echo $key['deskripsi']
                                                                                                ?>" readonly>
                            </div>
                          </div> -->

                        <?php
                        //$tamper = $this->db->query("SELECT sum(persentase) AS sumper FROM tkmstaff WHERE project='$key[project]' AND idtkmdiv='$key[no]'")->row_array();
                        ?>

                        <!-- <div class="col-sm-2">
                            <div class="form-group">
                              <label>Target Persentase</label>
                              <div class="input-group">
                                <input type="number" class="form-control" id="persentase<?php //echo $i; 
                                                                                        ?>" name="persentase<?php //echo $i; 
                                                                                                            ?>" max="<?php //echo $key['persentase'] - $tamper['sumper'];
                                                                                                                      ?>" placeholder="max : <?php //echo $key['persentase'] - $tamper['sumper']; 
                                                                                                                                              ?>">
                                <div class="input-group-append">
                                  <div class="input-group-text">
                                    <i class="fas fa-percent"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> -->

                        <!-- <div class="col-sm-3">
                            <div class="form-group">
                              <label for="deskripsi<?php //echo $i; 
                                                    ?>">Rincian :</label>
                              <ol>
                                <section id="li<?php //echo $i
                                                ?>"> -->
                        <?//php $nama = $db['id_tkmstaff']; if()?>
                        <!-- <li id="<?//=$i?>1">Lorem ipsum dolor
                                    <a href="javascript:void(0)" title="Delete" class="text-danger mr-3 " onclick="hapus(<?//=$i?>1)"><i class="fas fa-trash"></i></a>
                                    <input type="hidden" name="rincian<?//=$i?>[]" id="rincian<?//=$i?>[]">
                                </li> -->
                        <!-- </section>
                              </ol>
                            </div>
                          </div> -->

                        <!-- <div class="col-sm-1">
                            <butoon class="btn btn-sm btn-round btn-block btn-primary my-4" data-toggle="modal" onclick="tambahrincian2('<?php //echo $key['no']
                                                                                                                                          ?>', '<?php //echo $i
                                                                                                                                                ?>')">Add</butoon>
                          </div> -->



                        <!-- </div>
                      </li>
                        <hr> -->
                        <?php //endforeach; 
                        ?>
                        <?php //endif
                        ?>
                        <!-- LINTAS DIVISI -->
                        </tbody>
                       </table>
                       </div>
                      </ul>
                      <input type="hidden" name="tgldivisnya" value="<?php echo $tgl; ?>">
                      <input type="hidden" name="jmlproject" value="<?php echo $i; ?>">

                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label col-12"></label>
                  <div class="col-sm-12 col-md-7">
                    <?php
                    if (empty($kerjaan)) {
                    ?>
                      <p>Harap follow up untuk mendapatkan persetujuan TKM</p>
                    <?php
                    } else {
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
  <?php
  $i = 0;
  foreach ($kerjaan as $key) :
    $i++; 
     ?>
<div class="modal fade" tabindex="-1" role="dialog" id="modal-addrincian<?php echo $key['no'].$i ?>">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Rincian pekerjaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" id="data_disini<?php echo $key['no'].$i ?>">

      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <section id="buttonmodal<?php echo $key['no'].$i ?>">
        </section>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php
endforeach; ?>
<!-- MODAL TAMBAH -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });

  function tambahrincian2(id_pekerjaan, nomor) {
    var nama = `uraiantbl2` + id_pekerjaan;
    var bobot = `boboturaian` + id_pekerjaan;
    var html = `<h6>Rincian Pekerjaan</h6>`;
    var button = `<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="simpan2(` + id_pekerjaan + `,` + nomor + `)">Simpan</button>`;
    var i = 0;

    // var selesai = $('#selesai'+id_pekerjaan).val();

    console.log((`input[name='` + nama + `']`));
    $(`input[name='` + nama + `']`).each(function() {
      i++;
      console.log(this);
        var selesai = $(this).data('tgll');

      html += `<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="checkbox` + id_pekerjaan + `" id="customCheck` + id_pekerjaan + `` + i + `"  value="` + $(this).val() + `" data-tgl="`+selesai+`">
                    <label class="custom-control-label" for="customCheck` + id_pekerjaan + `` + i + `">` + i + `. ` + $(this).val() + `</label>
                </div>
                `;
    });

    // $(`input[name='`+bobot+`']`).each(function(){
    //     html += `<label>Bobot Persentase :</label>
    //               <input type="number" name="bobotrincian`+id_pekerjaan+`" value="`+$(this).val()+`">
    //             `;
    // });




    $('#data_disini'+id_pekerjaan+nomor).html(html);
    $('#buttonmodal'+id_pekerjaan+nomor).empty();
    if (i != 0) {
      $('#buttonmodal'+id_pekerjaan+nomor).html(button);
    }

    $('#modal-addrincian'+id_pekerjaan+nomor).modal();
  }

  function simpan2(id_pekerjaan, nomor) {
    var nama = `checkbox` + id_pekerjaan;
    var nama2 = `uraiantbl2` + id_pekerjaan;
    var bobotnya = `bobotrincian` + id_pekerjaan;
    var valbobot = $(`input[name='` + bobotnya + `']`).val();

    var max_date = $('#max_date').val();

    // console.log(nama);
    $(`input[name='` + nama + `']`).each(function() {
      if ($(this).is(":checked")) {
        var val = $(this).val();
        var tgl = $(this).data('tgl');
        var id = document.getElementById(val).value;
        var no = $(`#li` + nomor + ` li`).length;

        var html = `<div class="row" id="` + nomor + `` + no + `">
                    <div class="col-sm-12">
                    <li >` + val + ` 
                            <a href="javascript:void(0)" title="Delete" class="text-danger mr-3" onclick="hapus(` + nomor + `` + no + `, ` + id_pekerjaan + `, '` + val + `')"><i class="fas fa-trash"></i></a>
                    </div>
                    <div class="col-sm-12">
                            
                            <input type="date" class="form-control" name="targetselesai` + nomor + `[]" id="targetselesai` + nomor + `" max="`+max_date+`" data-trigger="hover" data-toggle="popover" value="`+tgl+`" data-placement="top" title="Tanggal Target Selesai" required readonly>
                       </div>
                        <input type="hidden" name="rincian` + nomor + `[]" id="rincian` + nomor + `[]" value="` + val + `">
                        <input type="hidden" name="targetpersen` + nomor + `[]" id="targetpersen` + nomor + `[]" value="` + valbobot + `">
                        <input type="hidden" name="idlist` + nomor + `[]" id="idlist` + nomor + `[]" value="` + id + `">
                   
                    
                        </li>
                        </div>`;

        $('#li' + nomor).append(html);
        $(`input[name='` + nama2 + `'][value='` + val + `']`).remove();
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

        var html = `<input type="hidden" name="uraiantbl2` + id_pekerjaan + `" id="uraiantbl` + id_pekerjaan + `" value="` + val + `">`;
        $(`#hidden` + id_pekerjaan).append(html);

        $('#' + id).remove();
        
      }
    })
  }

  

  // $('#menu ul li').length
</script>