
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Target Kerja <i class="fas fa-long-arrow-alt-right fa-2x"></i> Target Kerja Mingguan</h1>
      <h1></h1>
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
    <div class="card">
              <div class="card-body">
              <div class="row" style="width: 100%;" >
                  <div class="col-sm-12">
                  <h5>Alur Pembuatan TKM</h5>
                </div>
                  <div class="col-sm-12">
                    <div class="progress">
                      <?php $username = $this->session->userdata('ses_username');
                       $cek_prog = $this->db->get_where('progress_bar', array('username' => $username))->row_array(); ?>
                      <div class="progress-bar" role="progressbar" data-width="<?= $cek_prog['persentase'] ?>%" aria-valuenow="<?= $cek_prog['persentase'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $cek_prog['persentase'] ?>%</div>
                    </div>
                  </div>
                </div>
                  <div class="col-sm-12 row">
                    <div style="width: 25%" class="text-center font-weight-bold">Undangan TKM</div>
                    <div style="width: 25%" class="text-center font-weight-bold">Meeting TKM</div>
                    <div style="width: 25%" class="text-center font-weight-bold">Review Waiting List</div>
                    <div style="width: 25%" class="text-center font-weight-bold">Approval TKM</div>

                  </div>
                <!-- </div> -->
              </div>
            </div>
    <div class="section-body">
      <?php $datenow = date('Y-m-d');
       $besok = date('Y-m-d', strtotime(' +1 day'));
       $divisinya = $this->session->userdata('ses_divisi');
       $akses = $this->session->userdata('ses_akses');
       
       $meeting = $this->db->query("SELECT *, a.no AS no_meet FROM meeting_tkm a left join absensi_meeting b ON a.no=b.id_meeting where (tanggal= '$datenow' OR tanggal='$besok') AND (a.pembuat='$username' OR b.username='$username') GROUP BY a.no")->result_array();
       if ($meeting != NULL) {
        $no = 1;
         ?>
       <div class="card">
         <div class="card-header">
           <h5>Meeting TKM</h5>
         </div>
         <div class="card-body">
          <div class="table-responsive">
           <table class="table table-bordered table-hover">
             <tr style="background-color: #F5F5DC;">
               <th>No</th>
               <th>Divisi</th>
               <th>Jadwal Meeting</th>
               <th>Jam Mulai</th>
               <th>Jam Selesai</th>
               <th>Keterangan</th>
               <?php if ($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_akses') == 'Direksi') { ?>
               <th>Aksi</th>
               <?php } ?>
               <th>Room</th>
             </tr>
             <?php foreach ($meeting as $meet) { ?>
               
             <tr>
               <td><?= $no++; ?></td>
               <td><?= $meet['divisi']; ?></td>
               <td><?= date('d-m-Y', strtotime($meet['tanggal'])); ?></td>
               <td><?= date('H:i', strtotime($meet['dari_jam'])); ?></td>
               <td><?= date('H:i', strtotime($meet['sampai_jam'])); ?></td>
               <td><?= $meet['keterangan']; ?></td>
                <?php if (($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_akses') == 'Direksi') AND $this->session->userdata('ses_username') == $meet['pembuat']) { ?>
               <td>
                <a href="#" type="button" data-toggle="modal" data-target="#edit_meeting<?= $meet['no_meet'] ?>"><i class="fas fa-edit"></i></a>
                <a href="<?= base_url('mingguan/hapus_meeting/'.$meet['no_meet'] )?>" class="tombol-hapus"><i class="fas fa-trash"></i></a>
               </td>
               <?php } ?>
               <td>
                <?php $jam = date('H:i:s');
                $datenow = date('Y-m-d');
                 
                 $tambah = strtotime("+20 minutes",strtotime($meet['dari_jam']));
                 $akhir_jam = date('H:i:s', $tambah);

                 $cek_absen = $this->db->get_where('absensi_meeting', array('id_meeting' => $meet['no_meet'], 'username' => $username))->row_array();
                 // var_dump($cek_absen);
                 // echo $jam."<br>";
                 // echo $meet['sampai_jam']."<br>";
                 // echo $akhir_jam."<br>";
             
                if ($jam >= $meet['dari_jam'] AND $jam <= $meet['sampai_jam'] AND $datenow == $meet['tanggal'] AND ($akses == 'Manager' OR $akses == 'Direksi')) {
                   ?>
                <a href="<?= base_url('mingguan/meeting_room/'.$meet['no_meet'] )?>" class="btn btn-warning">Masuk</a>
                <br><a href="<?= $meet['link'] ?>" target="_blank" class="btn btn-success">Link Meeting</a>

              <?php } else if ($jam < $meet['dari_jam'] AND $datenow <= $meet['tanggal'] OR $datenow < $meet['tanggal']) {
                echo "<p class='font-weight-bold'>Meeting Belum Dimulai</p>";
              } else if ($jam > $meet['sampai_jam'] AND $datenow == $meet['tanggal']){
                echo "<p class='font-weight-bold text-danger'>Meeting Telah Selesai</p>";
                // } else if ($jam < $meet['sampai_jam'] AND $jam > $akhir_jam AND $akses != 'Manager' AND $datenow == $meet['tanggal']){
                // echo "<p class='font-weight-bold text-danger'>Maaf Anda terlambat datang meeting!</p>";
                } else if ($jam >= $meet['dari_jam'] AND $jam <= $meet['sampai_jam'] AND ($akses != 'Manager' AND $akses != 'Direksi') AND  $datenow == $meet['tanggal']){
                 // AND $cek_absen['waktu'] != NULL
                 ?>
                <!-- <a href="<?= base_url('mingguan/meeting_room/'.$meet['no_meet'] )?>" class="btn btn-warning">Masuk</a> -->
                <a href="<?= $meet['link'] ?>" target="_blank" class="btn btn-warning">Masuk</a>

                <?php }
                 ?>
               </td>
              
             </tr>
           <?php } ?>
           </table>
           
         </div>
         <b><span class="text-warning faa-flash animated">*Note </span> : Anda diberikan toleransi keterlambatan hadir selama 15 menit, jika lewat dari batas toleransi Anda tidak dapat mengisi kehadiran!</h5></b>
         </div>
       </div>
     <?php } else if ($meeting == NULL AND $akses != 'Manager' AND $akses != 'Direksi') { ?>
      <div class="card">
        <div class="card-header font-weight-bold">
          <h5><span class="text-warning faa-flash animated">Note </span> : Harap koordinasi dengan atasan Anda untuk Meeting TKM!</h5>
        </div>
      </div>
    <?php } ?>
       </div>
      

       
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

        <!-- CEK TABLE TKM DIVISI -->
        <?php
        $datenow = date('Y-m-d');
              $cek2 = $this->db->query("SELECT * FROM tkmdivisi WHERE pengisi='$username' AND daritanggal <= '$datenow' AND sampaitanggal>='$datenow'")->result_array();
              $cek = $this->db->query("SELECT * FROM tkmdivisi WHERE pengisi='$username' AND (daritanggal <= '$datenow' AND sampaitanggal>='$datenow' OR daritanggal >= '$datenow') ORDER BY no DESC")->result_array();

        $jadwal = $this->db->query("SELECT * FROM meeting_tkm a JOIN absensi_meeting b ON a.no=b.id_meeting WHERE a.daritanggal >= '$datenow' AND b.username='$username' AND b.post='Yes' ORDER BY a.no DESC")->row_array();

        $cek_tkm =  $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal = '$jadwal[daritanggal]' AND sampaitanggal = '$jadwal[sampaitanggal]' AND pengisi='$username'")->row_array();
        if ($cek_tkm != NULL) {
          $jadwal = NULL;
        } else {
          $jadwal = $jadwal;
        }
        // var_dump($jadwal);
        ?>

        <div class="col-sm-12">
           

        
          <?php if ($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_akses') == 'Direksi') { ?>
            <div class="card">
              <div class="card-header">
                <h4>Rentang Target Kerja (Khusus Atasan)</h4>
           </div>
           <div class="card-body">
             <?php
             

              // if ($cek2 == NULL) {
              //   $mon = date('d-m-Y', strtotime($senin));
              // } else {
              $date = new DateTime();
                    $date->modify('next monday');
                    $mon = $date->format('d-m-Y'); 
              // }
               ?>

             <select class="form-control" name="rentang" id="rentang">
               <option value="">--Pilih Rentang Target Kerja--</option>
               <option value="<?php echo date('Y-m-d', strtotime($mon))."_".date('Y-m-d', strtotime("+4 days", strtotime($mon))); ?>">1 Mingguan (<?php echo $mon." s/d ".date('d-m-Y', strtotime("+4 days", strtotime($mon))); ?>)</option>
               <option value="<?php echo date('Y-m-d', strtotime($mon))."_".date('Y-m-d', strtotime("+11 days", strtotime($mon))); ?>">2 Mingguan (<?php echo $mon." s/d ".date('d-m-Y', strtotime("+11 days", strtotime($mon))); ?>)</option>
               <option value="<?php echo date('Y-m-d', strtotime($mon))."_".date('Y-m-d', strtotime("+18 days", strtotime($mon))); ?>">3 Mingguan (<?php echo $mon." s/d ".date('d-m-Y', strtotime("+18 days", strtotime($mon))); ?>)</option>
               <option value="<?php echo date('Y-m-d', strtotime($mon))."_".date('Y-m-d', strtotime("+25 days", strtotime($mon))); ?>">4 Mingguan (<?php echo $mon." s/d ".date('d-m-Y', strtotime("+25 days", strtotime($mon))); ?>)</option>
             </select>
             <input type="hidden" name="awal" id="awal">
             <input type="hidden" name="akhir" id="akhir">
             <br>
              <a class="btn btn-primary go" href="#" id="go" >Buat TKM</a>
              <!-- <a class="btn btn-primary go" href="<?= base_url('mingguan/isi_meetingtkm/') ?>">Meeting TKM</a> -->
              <button class="btn btn-success" type="button" data-toggle="modal" data-target="#create_meeting">Buat Jadwal Meeting</button>
           </div>
         </div>
       <?php } ?>

       <?php if ($jadwal != NULL) { ?>
           <div class="card">
             <div class="card-header">
               <h4>Rentang Target Kerja</h4>
             </div>
             <div class="card-body">
               <div class="row">
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label>Dari Tanggal</label>
                     <input type="date" name="daritanggal" data-date="" data-date-format="DD MMMM YYYY" class="form-control" value="<?= $jadwal['daritanggal'] ?>" readonly>
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label>Sampai Tanggal</label>
                     <input type="date" name="sampaitanggal"  class="form-control" value="<?= $jadwal['sampaitanggal'] ?>" readonly>
                   </div>
                 </div>
               </div>
              <a class="btn btn-primary" href="<?= base_url('mingguan/isitkm3/'.$jadwal['daritanggal']."/".$jadwal['sampaitanggal']) ?>">Buat TKM</a>

             </div>
           </div>
         <?php } ?>

       

      <?php if ($cek != NULL) {
        $i = 0; 
        foreach ($cek as $tk) {
          $i++;
        ?>
       <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4>Target Kerja <?= date('d-m-Y', strtotime($tk['daritanggal'])) ?> s.d <?= date('d-m-Y', strtotime($tk['sampaitanggal'])) ?></h4>
                <div class="card-header-action">
                  
                    <!-- STATUS DISETUJUI -->
                    <?php if ($tk['status'] == 'Disetujui') :
                          if ($this->session->userdata('ses_akses') == 'Manager') {
                     ?>

                       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#wl_divisi">Waiting List Divisi</button>
                     <?php } else { ?>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#wl_divisi">Waiting List</button>
                     <?php } ?>
                      <a href="<?= base_url('mingguan/tambahtkmdiv/') ?><?php echo $tk['no'] ?>" class="btn btn-warning"><i class='fa fa-edit'></i> Tambah TKM</a>
                      <!-- <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $tgl ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a> -->
                      <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $tk['no'] ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a>
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
                      <a href="<?= base_url('mingguan/tambahtkmdiv/') ?><?php echo $tk['no'] ?>" class="btn btn-warning"><i class='fa fa-edit'></i> Tambah TKM</a>
                      <!-- <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $tgl ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a> -->
                      <?php  if ($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_akses') != 'Pegawai')  { ?>
                        <a href="<?php echo base_url('mingguan/viewtkmdivisi3') ?>/<?php echo $tk['no'] ?>" class="btn btn-primary"><i class='fa fa-edit'></i> Penugasan</a>
                      <?php } ?>
                      <a href="<?= base_url('mingguan/edittkmmanager/') ?><?php echo $tk['no'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                      <a href="<?php echo base_url('mingguan/deletetkmdivisi2') ?>/<?php echo $tk['no'] ?>" class="btn btn-danger tombol-hapus"><i class='fa fa-trash'></i> Hapus</a>
                      <?php
                      if ($this->session->userdata('ses_username') == 'Ribka') {
                      ?>
                        <a href="<?php echo base_url('mingguan/approveb1') ?>/<?php echo $senin ?>" class="btn btn-success">Setujui</a>
                      <?php
                      }
                      ?>

                    <?php endif ?>
                    <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  $ceklintasnya = $this->db->query("SELECT * FROM pekerjaan_lintasdivisi WHERE divisi='$divisinya' AND daritanggal='$tk[daritanggal]'")->result_array();
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
                    <table class="table table-bordered table-hover cell-border" id="table_tkm<?= $i ?>">

                      <thead>
                        <tr style="text-align:center">
                          <th>No</th>
                          <th>Project/Program/Pekerjaan</th>
                          <th>Kategori</th>
                          <!-- <th>Deskripsi</th> -->
                          <th>Persentase</th>
                          <?php if ($akses == 'Manager') {
                            ?>
                          <th>Aksi</th>
                        <?php } ?>
                          <!-- <th>Rincian Pekerjaan</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php $project2= $this->db->query("SELECT *, 
                                                          a.no AS id_pekerjaan, 
                                                          a.project as projectnya,
                                                          a.persentase as persennya

                         FROM pekerjaan a JOIN kategori b ON a.id_kategori=b.id_kategori
                         JOIN uraian c ON a.no=c.id_pekerjaan WHERE a.idtkmdiv = '$tk[no]' ")->result_array();
                        $no = 1;
                        foreach ($project2 as $pro) {
                           // $rincian2 = $this->db->query("SELECT * FROM rincian WHERE idpekerjaan='$pro[id_pekerjaan]' AND idtkmdiv='$tk[no]' AND userstaff='$username' AND id_tkmstaff='$pro[id_tkmstaff]'");
                           // $rin2 = $rincian2->result_array();
                           // $row2 = $rincian2->num_rows();
                              $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$pro[id_pekerjaan]'")->result_array();
                              $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$pro[id_pekerjaan]'")->row_array();
                              $rowspan = $jmlurai['jmu']+1;
                           ?>
                           <tr>
                             <td ><?= $no++; ?></td>
                             <td ><?= $pro['projectnya']; ?></td>
                             <td ><?= $pro['nama_kategori']; ?></td>
                             <td class="text-center" ><?= $pro['persennya']; ?>%
                               <div class="progress" data-height="4">
                                  <div class="progress-bar bg-success" role="progressbar" data-width="<?= $pro['persennya'] ?>%" aria-valuenow="<?= $pro['persennya'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                             </td>
                             <?php if ($akses == 'Manager') {
                             if ($pro['persennya'] == 100) : ?>
                                <td><a href="<?= base_url('mingguan/pekerjaanselesai/') ?><?= $pro['id_pekerjaan'] ?>" onclick="return confirm('Apakan anda yakin pekerjaan telah selesai?')" class="btn btn-success">Selesai <i class='fa fa-check'></i> </a></td>
                              <?php else : ?>
                                <td><button href="" onclick="alert('Persentase pekerjaan belum 100%')" class="btn btn-success">Selesai <i class='fa fa-check'></i> </a></td>
                              <?php endif; 
                            } ?>
                             <!-- <td ><?= $pro['uraian']; ?></td> -->

                           </tr>
                           <?php 
                           // foreach ($uraian as $key) { ?>
                           <!-- <tr>
                             <td><?= $key['uraian'] ?></td>
                           </tr> -->
                           <?php
                            // }
                         } $divisinya = $this->session->userdata('ses_divisi');
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
                                                                WHERE b.daritanggal = '$tk[daritanggal]'
                                                                AND b.divisi='$divisinya'
                                                                GROUP BY b.project")->result_array();
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
                              <td ><?= $x + 1 ?></td>
                              <td ><?php echo $cp['project'] ?> ( From <?= $cp['divisi'] ?> )</td>
                              <td ><?php echo $cp['nama_kategori'] ?></td>
                              <td class="text-center"><?php echo $cp['persentase'] ?>%
                                <div class="progress" data-height="4">
                                  <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase'] ?>%" aria-valuenow="<?php echo $cp['persentase'] ?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <?php if ($akses == 'Manager') {
                            ?>
                            <td></td>
                          <?php } ?>
                            </tr>
<!--                             <?php foreach ($uraian as $ua) : ?>
                              <tr>
                                <td><?php echo $ua['uraian']; ?> - <?php echo $ua['bobotpersentase']; ?>%</td>
                              </tr>
                            <?php endforeach ?> -->
                          <?php
                          }
                          ?>
                       

                      </tbody>
                    </table>
                  </div>


                </div>
                <div class="card-footer">
                  <?php 
                    echo "<span class='ml-3 beep'></span>";
                    echo $tk['status'];
                  ?>
         </div>
       </div>
     </div>
   </div>
     <?php }
   }
   ?>

      <!-- BANG TEDY PUNYA -->
      <!-- BANG TEDY PUNYA -->


    </div>
  </section>
</div>

<!-- Modal Create Meeting -->
<div class="modal fade" id="create_meeting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Meeting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="<?php echo base_url('mingguan/isi_meetingtkm') ?>" method="POST">

      <div class="modal-body">
        <div class="form-group">
          <label for="divisi" class="font-weight-bold">Divisi</label>
          <input type="text" name="divisi" class="form-control" id="divisi" value="<?= $this->session->userdata('ses_divisi') ?>" readonly>
        </div>
        <div class="form-group">
          <label for="tanggal" class="font-weight-bold">Tanggal Meeting</label>
          <input type="date" name="tanggal" class="form-control" id="tanggal"  <?php if ($akses == 'Direksi'){ ?>
            value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>"
          <?php } else { ?> value="<?= date('Y-m-d', strtotime('+1 day')); ?>" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" <?php } ?>>
           <small class="w-100"><span class="font-weight-bold text-warning faa-flash animated">Note :</span> Undangan meeting <b>harus</b> dibuat sebelum hari H! (maksimal H-1)</small>
        </div>
        <div class="form-group">
          <label for="rentang" class="font-weight-bold">Waktu Meeting</label>
          <div class="row">
            <div class="col-sm-6">
              <label for="jam">Dari Jam</label>
              <input type="time" class="form-control" id="jam" name="dari_jam">
            </div>
            <div class="col-sm-6">
              <label for="jam">Sampai Jam</label>
              <input type="time" class="form-control" id="jam" name="sampai_jam">
            </div>
          </div>
        </div>
        <?php
             $date = new DateTime();
                    $date->modify('next monday');
                    $mon = $date->format('d-m-Y'); 
               ?>
        <div class="form-group">
          <label for="rentang" class="font-weight-bold">Rentang Waktu TKM</label>
             <select class="form-control" name="rentang" id="rentang">
               <option value="">--Pilih Rentang Target Kerja--</option>
               <option value="<?php echo date('Y-m-d', strtotime($mon))."_".date('Y-m-d', strtotime("+4 days", strtotime($mon))); ?>">1 Mingguan (<?php echo $mon." s/d ".date('d-m-Y', strtotime("+4 days", strtotime($mon))); ?>)</option>
               <option value="<?php echo date('Y-m-d', strtotime($mon))."_".date('Y-m-d', strtotime("+11 days", strtotime($mon))); ?>">2 Mingguan (<?php echo $mon." s/d ".date('d-m-Y', strtotime("+11 days", strtotime($mon))); ?>)</option>
               <option value="<?php echo date('Y-m-d', strtotime($mon))."_".date('Y-m-d', strtotime("+18 days", strtotime($mon))); ?>">3 Mingguan (<?php echo $mon." s/d ".date('d-m-Y', strtotime("+18 days", strtotime($mon))); ?>)</option>
               <option value="<?php echo date('Y-m-d', strtotime($mon))."_".date('Y-m-d', strtotime("+25 days", strtotime($mon))); ?>">4 Mingguan (<?php echo $mon." s/d ".date('d-m-Y', strtotime("+25 days", strtotime($mon))); ?>)</option>
             </select>
          <!-- <div class="row">
            <div class="col-sm-6">
              <label for="rentang">Dari</label>
              <input type="date" class="form-control" id="rentang" name="daritanggal">
            </div>
            <div class="col-sm-6">
              <label for="rentang">Sampai</label>
              <input type="date" class="form-control" id="rentang" name="sampaitanggal">
            </div>
          </div> -->
        </div>
        <div class="form-group">
          <label for="keterangan" class="font-weight-bold">Keterangan</label>
          <textarea class="form-control" name="keterangan"></textarea>
        </div>
        <div class="form-group">
          <label for="link" class="font-weight-bold">Link Meeting</label>
          <textarea class="form-control" name="link"></textarea>
        </div>
        <div class="form-group">
          <label for="keterangan" class="font-weight-bold">Undang Peserta Meeting</label>
          <br>
          <?php
          $get_head = $this->db->get_where('tb_user', array('id_user' => $username, 'aktif' => 'Y'))->row_array();

          // var_dump($get_head);
          $staff = $this->db->get_where('tb_user', array('atasan' => $username, 'aktif' => 'Y'))->result_array();
          $atasan = $this->db->get_where('tb_user', array('id_user' => $get_head['atasan'], 'aktif' => 'Y'))->result_array();

          $div = array_merge($atasan, $staff);

            foreach ($div as $st) {
           ?>
          <input type="checkbox" name="peserta[]" value="<?= $st['id_user'] ?>"> <?= $st['nama_user'] ?><br>
          <?php } ?>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Modal Edit Meeting -->
<?php
       if ($meeting != NULL) {
        $no = 0;
       foreach ($meeting as $meet) { $no++;

?>
<div class="modal fade" id="edit_meeting<?= $meet['no_meet'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Meeting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="<?php echo base_url('mingguan/edit_meetingtkm') ?>" method="POST">

      <div class="modal-body">
        <input type="hidden" name="no_meet" value="<?= $meet['no_meet'] ?>">
        <div class="form-group">
          <label for="divisi" class="font-weight-bold">Divisi</label>
          <input type="text" name="divisi" class="form-control" id="divisi" value="<?= $this->session->userdata('ses_divisi') ?>" readonly>
        </div>
        <div class="form-group">
          <label for="tanggal" class="font-weight-bold">Tanggal Meeting</label>
          <input type="date" name="tanggal" class="form-control" id="tanggal" min="<?= $meet['tanggal'] ?>" value="<?= $meet['tanggal'] ?>">
        </div>
        <div class="form-group">
          <label for="rentang" class="font-weight-bold">Waktu Meeting</label>
          <div class="row">
            <div class="col-sm-6">
              <label for="jam">Dari Jam</label>
              <input type="time" class="form-control" id="jam" name="dari_jam" value="<?= $meet['dari_jam'] ?>">
            </div>
            <div class="col-sm-6">
              <label for="jam">Sampai Jam</label>
              <input type="time" class="form-control" id="jam" name="sampai_jam" value="<?= $meet['sampai_jam'] ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="rentang" class="font-weight-bold">Rentang Waktu TKM</label>
          <div class="row">
            <div class="col-sm-6">
              <label for="rentang">Dari</label>
              <input type="date" class="form-control" id="rentang" name="daritanggal" value="<?= $meet['daritanggal'] ?>">
            </div>
            <div class="col-sm-6">
              <label for="rentang">Sampai</label>
              <input type="date" class="form-control" id="rentang" name="sampaitanggal" value="<?= $meet['sampaitanggal'] ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="keterangan" class="font-weight-bold">Keterangan</label>
          <textarea class="form-control" name="keterangan"><?= $meet['keterangan'] ?></textarea>
        </div>
        <div class="form-group">
          <label for="link" class="font-weight-bold">Link Meeting</label>
          <textarea class="form-control" name="link"><?= $meet['link'] ?></textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php }
    } ?>


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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<script>
  $('#rentang').on('change', function(){
    var button = document.getElementById('go');

    $('.go').removeAttr('href');

    var data = $(this).val();
    var link = $('.go').attr('href');
    var pecah = data.split("_");

    var base = window.location.origin + "/";
    var host = base + window.location.pathname.split('/')[1];

    var awal = pecah[0];
    var akhir = pecah [1];

      console.log(awal);
      console.log(akhir);

      console.log(data);
    var new_href = host +"/mingguan/isitkm3/"+ awal + "/"+ akhir;

    var href_salah = '#';

      console.log(new_href);
      console.log(href_salah);

    // $('.go').attr('href', new_href);
    if (data != null || data != '') {
      $('.go').attr('href', new_href);
    } else if (data != null || data != ''){
      $('.go').attr('href', href_salah);
    }

});

  $(document).ready( function () {
    for (var i = 1; i <= 99; i++) {
       
         $('#table_tkm'+i).dataTable({
           "responsive": true,
           "searching": true,
           "ordering": true,
           "info": true,
           "scrollY": "",
           "scrollCollapse": true,
           "paging": true,
           "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
         });
       }
} );
</script>