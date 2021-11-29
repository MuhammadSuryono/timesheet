<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Target Kerja 3</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item active">Mingguan</div>
      </div>
    </div>

    <?php
    error_reporting(0);
                  $divisinya = $this->session->userdata('ses_divisi');
                  $akses = $this->session->userdata('ses_akses');
                  $username = $this->session->userdata('ses_username');
                  if ($akses == 'Manager') {
                    
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                } else {
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username='$username' ORDER BY b.hak_akses, b.nama_user ASC")->result_array();
                }

                

                  


    ?>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="section-body">
      <h2 class="section-title">Target Kerja Mingguan divisi <?php echo $this->session->userdata('ses_divisi'); ?></h2>

      <div class="row">

        <!-- ARRAY PEKERJAAN -->
        <?php $pekerjaan1 = [];
        $pekerjaan2 = [];
        $kategori = [];
        $deskripsi = [];
        $persentase = [];
        $idPekerjaanArr = [];
        $i = 0;
        foreach ($pekerjaan as $db) {
          $key1 = $db['daritanggal'];
          $key2 = $db['project'];
          $idPekerjaan = $db['idpekerjaan'];

          sort($idPekerjaanArr);
          if ($idPekerjaanArr == null || ($idPekerjaan != $idPekerjaanArr[$i - 1])) {
            array_push($idPekerjaanArr, $idPekerjaan);
            array_push($persentasePekerjaanArr, $persentasePekerjaan);
            $i++;
          }

          if (array_key_exists("$key1", $pekerjaan1)) {
            if (array_key_exists("$key2", $pekerjaan1[$key1])) {
              array_push($pekerjaan1[$key1][$key2], $db);
            } else {
              $pekerjaan1[$key1][$key2][] = $db;
              $kategori[$key1][$key2] = $db['nama_kategori'];
              $deskripsi[$key1][$key2] = $db['deskripsi'];
              $persentase[$key1][$key2] = $db['persentase'];
              $tambahan[$key1][$key2] = $db['tambahan'];
            }
          } else {
            $pekerjaan1[$key1][$key2][] = $db;
            $kategori[$key1][$key2] = $db['nama_kategori'];
            $deskripsi[$key1][$key2] = $db['deskripsi'];
            $persentase[$key1][$key2] = $db['persentase'];
            $tambahan[$key1][$key2] = $db['tambahan'];
          }

          if (array_key_exists("$key1", $pekerjaan2)) {
            $val = $db['project'];
            if (!in_array("$val", $pekerjaan2[$key1])) {
              array_push($pekerjaan2[$key1], $db['project']);
            }
          } else {
            $pekerjaan2[$key1][] = $db['project'];
          }
        }
        ?>
        <!-- ARRAY PEKERJAAN -->



        <!-- ARRAY TKMDIVISI -->
        <?php $tkm = [];
        $nonya = [];
        foreach ($tkmdivisi as $db) {
          $key1 = $db['daritanggal'];
          $tkm[$key1] = $db['status'];
          $nonya[$key1] = $db['no'];
        }
        ?>
        <!-- ARRAY TKMDIVISI -->


        <?php $tgl = $senin;
        for ($i = 1; $i <= 4; $i++) : ?>
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4>Target Kerja <?= date('d-m-Y', strtotime($tgl)) ?> s.d <?= date('d-m-Y', strtotime("+11 days", strtotime($tgl))); ?></h4>
                <div class="card-header-action">

                  <!-- BELUM ADA DI TKMDIV -->
                  <?php if (!array_key_exists("$tgl", $tkm)) : ?>

                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $tgljam = $tgl . date('H:i:s');
                    $jumatan = date('Y-m-d', strtotime("+13 days", strtotime($tgl)));
                    $jumatlast = date('Y-m-d H:i:s', strtotime("+13 days", strtotime($tgljam)));
                    $jamsekarang = date('H:i:s');
                    $hariini = date('Y-m-d');
                    // $jumtime = date('Y-m-d H:i:s', strtotime($jumatlast));
                    $divisi = $this->session->userdata('ses_divisi');
                    $carijam = $this->db->query("SELECT waktuisi FROM waktuisi WHERE divisi='$divisi'")->row_array();
                    $waktuisi = $carijam['waktuisi'];
                    $tgltimeisi = date('Y-m-d H:i:s', strtotime($waktuisi));

                    if (strtotime($jumatan) >= strtotime($hariini)) {

                      if (((int) date('H', $jamsekarang)) <= $waktuisi) {
                    ?>
                        <a href="<?php echo base_url('mingguan/isitkm3/') ?><?= $tgl ?>/<?= date('Y-m-d', strtotime("+11 days", strtotime($tgl))) ?>" class="btn btn-success"><i class='fa fa-plus'></i> Isi</a>
                    <?php
                      } else {
                        echo "";
                      }
                    } else {
                      echo "";
                    }

                    // if(strtotime($tgltimeisi) <= strtotime($jumatlast)){
                    // if (((int) date('H', $tgltimeisi)) <= ((int) date('H', $jumtime))){
                    // if(new DateTime("$tgltimeisi") < new DateTime("$jumatlast")){
                    ?>
                    <!-- <a href="<?php //echo base_url('mingguan/isitkm3/')
                                  ?><?php //echo $tgl
                                    ?>/<?php //echo date('Y-m-d', strtotime("+4 days", strtotime( $tgl )))
                                        ?>" class="btn btn-success"><i class='fa fa-plus'></i> Isi</a> -->
                    <?php
                    ?>
                  <?php else : ?>
                    <!-- AKHIR -->

                    <!-- STATUS DISETUJUI -->
                    <?php if ($tkm[$tgl] == 'Disetujui') :
                          if ($this->session->userdata('ses_akses') == 'Manager') {
                     ?>

                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#wl_divisi">Waiting List Divisi</button>
                     <?php } else { ?>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#wl_divisi">Waiting List</button>
                     <?php } ?>
                      <a href="<?= base_url('mingguan/tambahtkmdiv/') ?><?php echo $id_tkm ?>" class="btn btn-warning"><i class='fa fa-edit'></i> Tambah TKM</a>
                      <!-- <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $tgl ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a> -->
                      <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $id_tkm ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a>
                      <?//php endif?>
                      <!-- AKHIR -->

                      <!-- STATUS Menunggu Approval -->
                      <?//php if($tkm[$tgl]=='Menunggu Approval'):?>
                    <?php else :
                          if ($this->session->userdata('ses_akses') == 'Manager') {
                     ?>

                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#wl_divisi">Waiting List Divisi</button>
                     <?php } else { ?>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#wl_divisi">Waiting List</button>
                     <?php } ?>
                      <a href="<?= base_url('mingguan/tambahtkmdiv/') ?><?php echo $id_tkm ?>" class="btn btn-warning"><i class='fa fa-edit'></i> Tambah TKM</a>
                      <!-- <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $tgl ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a> -->
                      <?php  if ($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_akses') != 'Pegawai')  { ?>
                        <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $id_tkm ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a>
                      <?php } ?>
                      <a href="<?= base_url('mingguan/edittkmmanager/') ?><?php echo $id_tkm ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                      <a href="<?php echo base_url('mingguan/deletetkmdivisi2') ?>/<?php echo $tgl ?>" class="btn btn-danger tombol-hapus"><i class='fa fa-trash'></i> Hapus</a>
                      <?php
                      if ($this->session->userdata('ses_username') == 'Ribka') {
                      ?>
                        <a href="<?php echo base_url('mingguan/approveb1') ?>/<?php echo $tgl ?>" class="btn btn-success">Setujui</a>
                      <?php
                      }
                      ?>

                    <?php endif ?>
                    <!-- AKHIR -->
                  <?php endif ?>


                  <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  $ceklintasnya = $this->db->query("SELECT * FROM pekerjaan_lintasdivisi WHERE divisi='$divisinya' AND daritanggal='$tgl'")->result_array();
                  if (empty($ceklintasnya)) {
                    echo "";
                  } else {
                  ?>
                    <a href="<?php echo base_url('mingguan/viewlintasdivisi') ?>/<?php echo $tgl ?>" class="btn btn-secondary"><i class='fa fa-edit'></i> Penugasan Lintas Divisi</a>
                  <?php
                  }
                  ?>


                  <a data-collapse="#mycard-collapse<?= $i ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                </div>
              </div>
              <div class="collapse <?= ($i == 1 ? 'show' : ''); ?>" id="mycard-collapse<?= $i ?>">
                <div class="card-body">

                  <b>*Note :</b>
                  <ul>
                    <li>Untuk kategori project B1 dan B2 bisa langsung di tugaskan</li>
                    <?php
                    if ($tkm[$tgl] == 'Menunggu Approval') {
                      echo "<li>Harap Follow up untuk mendapatkan approval non project</li>";
                    } else {
                      echo "";
                    }
                    ?>
                  </ul>
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                      <thead>
                        <tr style="text-align:center">
                          <th>No</th>
                          <th>Project</th>
                          <th>Kategori</th>
                          <!-- <th>Deskripsi</th> -->
                          <th>Persentase</th>
                          <th>Aksi</th>
                          <th>Rincian Pekerjaan</th>
                        </tr>
                      </thead>
                      <tbody>

                        <!-- BUKAN LINTAS DIVISI -->
                        <?php if (array_key_exists("$tgl", $pekerjaan2)) : ?>
                          <?php for ($x = 0; $x < count($pekerjaan2[$tgl]); $x++) : ?>
                            <?php
                            $project = $pekerjaan2[$tgl][$x];
                            // $idPekerjaan = $idPekerjaanArr[$x];
                            $rowspan = count($pekerjaan1[$tgl][$project]) + 1; ?>
                            <?php
                            if ($tambahan[$tgl][$project] == NULL) {
                              $warna = "";
                            } else {
                              $warna = "#a1c5e6";
                            }
                            ?>
                            <tr bgcolor="<?php echo $warna ?>">
                              <td rowspan="<?= $rowspan ?>"><?= $x + 1 ?></td>
                              <td rowspan="<?= $rowspan ?>"><?= $project ?>
                                <?php
                                $divisinya = $this->session->userdata('ses_divisi');
                                $username = $this->session->userdata('ses_username');
                                
                                $caridulu = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal = '$tgl'
                                            AND divisi='$divisinya'")->row_array();
                                $noidtkm = $caridulu['no'];

                                $carilintas = $this->db->query("SELECT * FROM pekerjaan_lintasdivisi WHERE idtkmdiv='$noidtkm' AND project='$project'")->result_array();
                                // $carilintas = "SELECT * FROM pekerjaan_lintasdivisi WHERE idtkmdiv='$noidtkm'";
                                // echo $carilintas;
                                if (empty($carilintas)) {
                                  echo "";
                                } else {
                                  echo "<ul>";
                                  foreach ($carilintas as $key) {
                                    $lint = $key['divisi'];
                                    echo "<li>";
                                    echo "Divisi ";
                                    echo "$lint";
                                    echo "</li>";
                                  }
                                  echo "</ul>";
                                }
                                ?>
                              </td>
                              <td rowspan="<?= $rowspan ?>"><?= $kategori[$tgl][$project] ?></td>
                              <td rowspan="<?= $rowspan ?>" class="text-center"><?= $persentase[$tgl][$project] ?>%
                                <div class="progress" data-height="4">
                                  <div class="progress-bar bg-success" role="progressbar" data-width="<?= $persentase[$tgl][$project] ?>%" aria-valuenow="<?= $persentase[$tgl][$project] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <?php if ($persentase[$tgl][$project] == 100) : ?>
                                <td rowspan="<?= $rowspan ?>"><a href="<?= base_url('mingguan/pekerjaanselesai/') ?><?= $idPekerjaanArr[$x] ?>" onclick="return confirm('Apakan anda yakin pekerjaan telah selesai?')" class="btn btn-success">Selesai <i class='fa fa-check'></i> </a></td>
                              <?php else : ?>
                                <td rowspan="<?= $rowspan ?>"><button href="" onclick="alert('Persentase pekerjaan belum 100%')" class="btn btn-success">Selesai <i class='fa fa-check'></i> </a></td>
                              <?php endif; ?>
                            </tr>
                            <?php foreach ($pekerjaan1[$tgl][$project] as $db) :
                              $jumlahStaff = $this->db->where('idpekerjaan', (int)$db['idpekerjaan'])->where('rincian', $db['uraian'])->from('rincian')->count_all_results();
                              $totalPersen = $this->db->select_sum('targetpersen')->where('idpekerjaan', (int)$db['idpekerjaan'])->where('rincian', $db['uraian'])->get('rincian')->result_array();

                              $persentaseRincian = $totalPersen[0]['targetpersen'] / $jumlahStaff;
                            ?>

                              <tr bgcolor="<?php echo $warna ?>">
                                <td><?= $db['uraian'] ?> - <?php echo ($persentaseRincian) ? $persentaseRincian : 0; ?>%</td>
                              </tr>
                            <?php endforeach ?>
                          <?php endfor ?>
                        <?php endif ?>
                        <!-- AKHIR -->

                        <!-- LINTAS DIVISI -->
                        <?php
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
                        if (array_key_exists("$tgl", $pekerjaan2) == false) {
                          $x = 0;
                        }
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
                              <td rowspan="<?= $rowspan ?>"><?= $x + 1 ?></td>
                              <td rowspan="<?= $rowspan ?>"><?php echo $cp['project'] ?> ( From <?= $cp['divisi'] ?> )</td>
                              <td rowspan="<?= $rowspan ?>"><?php echo $cp['nama_kategori'] ?></td>
                              <td rowspan="<?= $rowspan ?>" class="text-center"><?php echo $cp['persentase'] ?>%
                                <div class="progress" data-height="4">
                                  <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase'] ?>%" aria-valuenow="<?php echo $cp['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                            </tr>
                            <?php foreach ($uraian as $ua) : ?>
                              <tr>
                                <td><?php echo $ua['uraian']; ?> - <?php echo $ua['bobotpersentase']; ?>%</td>
                              </tr>
                            <?php endforeach ?>
                          <?php
                          }
                          ?>
                        <?php endif ?>
                        <!-- LINTAS DIVISI -->

                        <?php if (array_key_exists("$tgl", $pekerjaan2) == false and $jml == 0) : ?>
                          <tr>
                            <td colspan="6" class="text-center"> Data Tidak Tersedia</td>
                          </tr>
                        <?php endif ?>
                      </tbody>
                    </table>
                  </div>


                </div>
                <div class="card-footer">
                  <?php if (array_key_exists("$tgl", $tkm)) {
                    echo "<span class='ml-3 beep'></span>";
                    echo $tkm[$tgl];
                  } ?>
                </div>
              </div>
            </div>
          </div>
        <?php $tgl = date('Y-m-d', strtotime("+14 days", strtotime($tgl)));
        endfor ?>
      </div>

      <!-- BANG TEDY PUNYA -->
      <!-- BANG TEDY PUNYA -->


    </div>
  </section>
</div>


 <!-- Modal -->
<div class="modal fade" id="wl_divisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Waiting List Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover  table-striped">
            <thead class="bg-info">
              <tr>
                <th class="text-white">No</th>
                <th class="text-white">Waiting List</th>
                <th class="text-white">Pembuat</th>
                <!-- <th class="text-white">Tanggal Input</th> -->
                
                
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if ($waitinglist != NULL) {
                
              foreach ($waitinglist as $wl) {
                ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $wl['pekerjaan']; ?></td>
                <td><?php echo $wl['nama_user']; ?></td>
                <!-- <td><?php echo $wl['tgl_input']; ?></td> -->
                
              </tr>
            <?php }
            } else { ?>
              <tr>
                <td colspan="3"><center><h6>Data Tidak Tersedia</h6></center></td>
                
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" >Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>