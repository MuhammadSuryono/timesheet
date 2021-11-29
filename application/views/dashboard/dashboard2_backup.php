<?php
//The function returns the no. of business days between two dates and it skips the holidays
function getWorkingDays($startDate, $endDate, $holidays)
{
  // do strtotime calculations just once
  $endDate = strtotime($endDate);
  $startDate = strtotime($startDate);


  //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
  //We add one to inlude both dates in the interval.
  $days = ($endDate - $startDate) / 86400 + 1;

  $no_full_weeks = floor($days / 7);
  $no_remaining_days = fmod($days, 7);

  //It will return 1 if it's Monday,.. ,7 for Sunday
  $the_first_day_of_week = date("N", $startDate);
  $the_last_day_of_week = date("N", $endDate);

  //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
  //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
  if ($the_first_day_of_week <= $the_last_day_of_week) {
    if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
    if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
  } else {
    // (edit by Tokes to fix an edge case where the start day was a Sunday
    // and the end day was NOT a Saturday)

    // the day of the week for start is later than the day of the week for end
    if ($the_first_day_of_week == 7) {
      // if the start date is a Sunday, then we definitely subtract 1 day
      $no_remaining_days--;

      if ($the_last_day_of_week == 6) {
        // if the end date is a Saturday, then we subtract another day
        $no_remaining_days--;
      }
    } else {
      // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
      // so we skip an entire weekend and subtract 2 days
      $no_remaining_days -= 2;
    }
  }

  //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
  //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
  $workingDays = $no_full_weeks * 5;
  if ($no_remaining_days > 0) {
    $workingDays += $no_remaining_days;
  }

  //We subtract the holidays
  foreach ($holidays as $holiday) {
    $time_stamp = strtotime($holiday);
    //If the holiday doesn't fall in weekend
    if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N", $time_stamp) != 6 && date("N", $time_stamp) != 7)
      $workingDays--;
  }

  return $workingDays;
}
 
?>
<style type="text/css">
  @media screen and (max-width: 780px) {
  table.table {
    width: 50%;
  }
  /*.no {
    width: 50px;
  } 
  .rincian {
    width: 100px;
  } 
  .persen {
    width: 70px;
  }
  .status {
    width: 70px;
  }
  .pencapaian {
    width: 10px;
  }*/
}

</style>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <!-- <h1>Dashboard</h1> -->
      <marquee scrollamount="10"><h3><span class="text-danger">PENTING!!</span> Wajib meeting TKM dengan atasan agar dapat mengisi TKM dan LKH untuk minggu berikutnya</h3></marquee>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

      <div class="card">
              <div class="card-body">
              <div class="row" style="width: 100%;" >
                  <div class="col-sm-12">
                  <h5>Alur Pembuatan TKM</h5>
                </div>
                  <div class="col-sm-12" >
                    <div class="progress">
                      <?php $username = $this->session->userdata('ses_username');
                      $akses = $this->session->userdata('ses_akses');
                       $cek = $this->db->get_where('progress_bar', array('username' => $username))->row_array(); ?>
                      <div class="progress-bar" role="progressbar" data-width="<?= $cek['persentase'] ?>%" aria-valuenow="<?= $cek['persentase'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $cek['persentase'] ?>%</div>
                    </div>
                  </div>
                </div>
                  <div class="col-sm-12 row">
                    <div style="width: 25%" class="text-center font-weight-bold"><a href="<?= base_url('mingguan/homemingguan') ?> " data-trigger="hover" data-toggle="popover" data-html="true" data-placement="bottom" title="Meeting TKM" data-content="Meeting TKM adalah meeting divisi yang membahas TKM yang dikerjakan dalam minggu berikutnya <br>Pelaksanaan : 1x seminggu sebelum hari Jumat jam 23.59<br>Peserta : Atasan & karyawan" class="font-weight-bold">Meeting TKM</a></div>
                    <div style="width: 25%" class="text-center font-weight-bold"><a href="<?= base_url('harian/waitinglist') ?>" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="Waiting List Target" data-content="Waiting List Target adalah list target  karyawan yang dilakukan dalam periode minggu tersebut" class="font-weight-bold">Waiting List Target</a></div>
                    <div style="width: 25%" class="text-center font-weight-bold"><a href="<?= base_url('mingguan/homemingguan') ?>" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="Pembuatan TKM" data-content="Pembuatan TKM adalah list target karyawan yang telah disetujui oleh atasan beserta tanggal pencapaiannya" class="font-weight-bold">Pembuatan TKM</a></div>
                    <?php if ($akses == 'Manager' OR $akses == 'Direksi') { ?>
                    <div style="width: 25%" class="text-center font-weight-bold"><a href="<?= base_url('mingguan/approvalmingguan') ?>" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="Approval TKM" data-content="Approval TKM adalah proses persetujuan Atasan terhadap TKM yang dibuat oleh karyawan agar bisa karyawan bisa mengisi LKH" class="font-weight-bold">Approval TKM</a></div>
                    <?php } else { ?>
                    <div style="width: 25%" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="Approval TKM" data-content="Approval TKM adalah proses persetujuan Atasan terhadap TKM yang dibuat oleh karyawan agar bisa karyawan bisa mengisi LKH" class="text-center font-weight-bold">Approval TKM</div>
                  <?php } ?>

                  </div>
                <!-- </div> -->
              </div>
            </div>
    <div class="row row-eq-height">
      <?php $username = $this->session->userdata('ses_username');
          $tunggu = $this->db->query("SELECT a.*, b.* FROM tkmdivisi a JOIN tb_user b ON a.pengisi=b.id_user WHERE a.status='Menunggu Approval' AND b.atasan='$username'")->result_array();

      $datenow = date('Y-m-d');
       $besok = date('Y-m-d', strtotime(' +1 day'));
       $divisinya = $this->session->userdata('ses_divisi');
       $akses = $this->session->userdata('ses_akses');
       
       $undangan = $this->db->query("SELECT * FROM meeting_tkm where divisi='$divisinya' AND (tanggal= '$datenow' OR tanggal='$besok')")->row_array();
       ?>

      <div class="col-lg-6 col-md-6 col-12">
        <?php if ($tunggu != NULL) {
         ?>
        <div class="card">
          <div class="card-header"><h4>Menunggu Approval TKM</h4></div>
          <div class="card-body">
            <?php foreach ($tunggu as $draft) {
              ?>
              <a class="text-warning" href="<?= base_url('mingguan/approvalmingguan') ?>" ><p class="text-warning font-weight-bold faa-flash animated faa-slow "><?= $draft['nama_user'] ?> <i class='fas fa-bell faa-tada animated' ></i></p></a>
            <?php } ?>
          </div>
        </div>
      <?php } ?>

      <?php if ($undangan != NULL) {
         ?>
        <div class="card">
          <div class="card-header"><a class="faa-flash animated" data-toggle="collapse" href="#undangan" role="button" aria-expanded="false" aria-controls="collapseExample"><h4>Undangan Meeting TKM</h4></a></div>
          <div class="card-body collapse" id="undangan">
              <p class="font-weight-bold">Anda diundang untuk meeting TKM divisi <?= $divisinya ?> pada tanggal <?= date('d M Y', strtotime($undangan['tanggal'])) ?>. Mohon cek di menu Target Kerja Mingguan untuk detail meeting. Atau klik <a href="<?= base_url('mingguan/homemingguan') ?>">di sini</a></p>
            
          </div>
        </div>
      <?php } ?>


        <div class="card">
            <!-- <button class="btn btn-success" type="button" data-toggle="modal" data-target="#disclaimer">Cek Disclaimer</button><br> -->
        <?php $get_tolak = $this->db->get_where('rincian', array('approval' => 'Ditolak', 'targetpersen <' => '100', 'userstaff' => $username))->row_array();
         ?>
          <div class="card-header">
            <?php if ($get_tolak == NULL) { ?>
            <a data-toggle="collapse" href="#divisi_coll" role="button" aria-expanded="false" aria-controls="collapseExample"><h4>Progress Kerja Divisi <?php echo $this->session->userdata('ses_divisi') ?></h4></a>
          <?php } else { ?>
            <a class="faa-flash animated" data-toggle="collapse" href="#divisi_coll" role="button" aria-expanded="false" aria-controls="collapseExample"><h4>Progress Kerja Divisi <?php echo $this->session->userdata('ses_divisi') ?> <span class="text-danger">*</span></h4></a>
          <?php } ?>
          </div>
          <div class="card-body collapse" id="divisi_coll">

            <?php
            $user_login = $this->session->userdata('ses_username');
            $nama_login = $this->session->userdata('ses_nama');

            $cek_disclaimer = $this->db->get_where('disclaimer', array('id_user' => $user_login, 'nama' => $nama_login))->row_array();

            $userdir = $direksinya['atasan'];
            $carinamadir = $this->db->query("SELECT * FROM tb_user WHERE id_user='$userdir'")->row_array();
            
            if ($cek_disclaimer != NULL) {
            
            ?>
            <input type="hidden" name="num_disclaimer" id="num_disclaimer" value="1">
          <?php } else { ?>
              <input type="hidden" name="num_disclaimer" id="num_disclaimer" value="0">
            <?php } ?>


            <ul>
              <?php   if($this->session->userdata('ses_akses') != 'Direksi'): ?>
              <li><?php echo $carinamadir['nama_user'] ?> ( <?php echo $carinamadir['divisi'] ?> )</li>
              <?php
            endif;
            

            


            if ($this->session->userdata('ses_akses') == 'Direksi') {
            
              foreach ($leader as $key) {
              ?>
                <li><h6 style="font-weight: normal; font-size: 14px; "><?php echo $key['nama_user'] ?> ( <?php echo $key['jabatan1'] ?> )</h6></li>
              <?php
              }
              ?>
              <?php
              $id_direksi = $this->session->userdata('ses_username');
              $under = $this->db->query("SELECT * FROM tb_user WHERE atasan='$id_direksi'")->result_array();

             
              foreach ($under as $u) : 
                
                ?>

                  <li><h6 style="font-weight: normal; font-size: 14px; "><a href="#" type="button" data-toggle="modal" data-target="#detailkerja<?php echo $u['id_user'] ?>"><?php echo $u['nama_user'] ?> ( <?php echo $u['jabatan1'] ?> ) ( <?php echo $u['divisi'] ?> )</a></h6></li>
              <?php
                   
              endforeach;
            }







              foreach ($leader as $key) {
                 $time = strtotime("-3 month", time());
                  $bulan3 = date("Y-m-d", $time);
                  $datenow = date("Y-m-d");
                if($this->session->userdata('ses_akses') != 'Direksi' AND $this->session->userdata('ses_akses') == 'Manager'): 
                   $jum_target = $this->db->query("SELECT
                                                a.*,
                                                d.deskripsi, 
                                              d.no as no_pekerjaan,
                                              b.daritanggal,
                                              b.sampaitanggal
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              WHERE
                                                a.userstaff = '$key[id_user]'
                                                AND a.tanggalisi between '$bulan3' AND '$datenow'
                                                ")->num_rows();
                  if ($get_tolak == NULL) {
                  ?>
                <li><h6 style="font-weight: normal; font-size: 14px; "><?php echo $key['nama_user'] ?> ( <?php echo $key['jabatan1'] ?> ) - <a href="#" type="button" data-toggle="modal" data-target="#detailkerja<?php echo $key['id_user'] ?>">Target Kerja</a>&nbsp;&nbsp;<span class="badge badge-primary"><?= $jum_target ?></span></h6></li>
              <?php } else { ?>
                <li><h6 style="font-weight: normal; font-size: 14px; "><?php echo $key['nama_user'] ?> ( <?php echo $key['jabatan1'] ?> ) - <a href="#" type="button" class="faa-flash animated" data-toggle="modal" data-target="#detailkerja<?php echo $key['id_user'] ?>">Target Kerja<span class="text-danger">*</span></a>&nbsp;&nbsp;<span class="badge badge-primary"><?= $jum_target ?></span></h6></li>
              <?php
                    }
                  endif;
              }
              ?>
              <?php
              if($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_divisi') == 'SUB FINANCE') {
              foreach ($alldiv as $ad) {
                $time = strtotime("-3 month", time());
                  $bulan3 = date("Y-m-d", $time);
                  $datenow = date("Y-m-d");
                  

                  $jum_target = $this->db->query("SELECT
                                                a.*,
                                                d.deskripsi, 
                                              d.no as no_pekerjaan,
                                              b.daritanggal,
                                              b.sampaitanggal
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              WHERE
                                                a.userstaff = '$ad[id_user]'
                                                AND a.tanggalisi between '$bulan3' AND '$datenow'
                                                ")->num_rows();
                  $kasus = $this->db->query("SELECT
                                                *
                                              FROM
                                                tkmstaff a
                                              JOIN rincian b ON a.no=b.id_tkmstaff
                                              WHERE
                                                a.userstaff = '$ad[id_user]'
                                                AND b.status='Menjadi Kasus'
                                                GROUP BY a.no
                                                ")->num_rows();

                $approve = $this->db->get_where('tkmdivisi', array('pengisi' => $ad['id_user'], 'status' => 'Menunggu Approval'))->num_rows();
              ?>
              
                <li><h6 style="font-weight: normal; font-size: 14px; "><?php echo $ad['nama_user'] ?> ( <?php echo $ad['jabatan1'] ?> ) - 
                  <a href="#" type="button" data-toggle="modal" data-target="#detailkerja<?php echo $ad['id_user'] ?>">Target Kerja</a>&nbsp;&nbsp;<span class="badge badge-primary" ><?= $jum_target ?></span> -  
                  <!-- <a href="#" type="button" class="portfolio-link" data-toggle="modal" data-target="#tindaklanjut<?php echo $ad['id_user'] ?>"> 
                  <i class="fas fa-cog"></i></a> -->
                  <a href="#" type="button" class="portfolio-link" data-toggle="modal" data-target="#tindaklanjut<?php echo $ad['id_user'] ?>"> 
                  Kasus Target Kerja</a>&nbsp;&nbsp;<span class="badge badge-danger"><?= $kasus ?></span>
                  <?php if ($approve > 0) {
                    echo "<a href='". base_url('mingguan/approvalmingguan')."' title='Menunggu Approval' class='text-warning'><i class='fas fa-bell faa-tada animated' ></i></a>";
                  } ?>
                </h6>
              </li>
              <?php
              }
            } else {
              if($this->session->userdata('ses_akses') != 'Direksi') { ?>
              <li><?php echo $key['nama_user'] ?> ( <?php echo $key['jabatan1'] ?> )</li>
              <?php }
              
              foreach ($alldiv as $ad) {
              if ($ad['id_user'] == $user_login) {
                 
                    if ($get_tolak == NULL) {
                     ?>
                    <li><a href="#" type="button" data-toggle="modal" data-target="#detailkerja<?php echo $ad['id_user'] ?>"><?php echo $ad['nama_user'] ?> ( <?php echo $ad['jabatan1'] ?> )</a></li>
                  <?php } else { ?>
                    <li><a href="#" type="button" class="faa-flash animated" data-toggle="modal" data-target="#detailkerja<?php echo $ad['id_user'] ?>"><?php echo $ad['nama_user'] ?> ( <?php echo $ad['jabatan1'] ?> )<span class="text-danger">*</span> </a></li>
              <?php }
               } else { ?>
                 <li><?php echo $ad['nama_user'] ?> ( <?php echo $ad['jabatan1'] ?> )</li>
              <?php
                    }
              }
              } ?>
            
            </ul>

          </div>
        </div>
      </div>



      <?php
      date_default_timezone_set('Asia/Jakarta');
      $user = $this->session->userdata('ses_username');

      function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
      {
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
        while ($current <= $last) {
          if (date('D', $current) != 'Sat' & date('D', $current) != 'Sun') {
            $dates[] = date($output_format, $current);
          }
          $current = strtotime($step, $current);
        }
        return $dates;
      }

      $endDate = date('Y-m-d', strtotime("-1 days"));

      if (date('d', strtotime("-1 days")) < 21) {
        $lastMonth = date('Y-m-d', strtotime('first day of last month'));
        $tahun = date('Y', strtotime($lastMonth));
        $bulan = date('m', strtotime($lastMonth));
        $datenya = new DateTime();
        $datenya->setDate($tahun, $bulan, 21);
        $startDate = $datenya->format('Y-m-d');
      } else {
        $tahun = date('Y', strtotime($endDate));
        $bulan = date('m', strtotime($endDate));
        $datenya = new DateTime();
        $datenya->setDate($tahun, $bulan, 21);
        $startDate = $datenya->format('Y-m-d');
      }


      //echo 'TGL 21 AWAL BULAN:'.$startDate.'<Br>'; // UNTUK PENGECEKAN SAJA

      $getTglMasukKerja = $this->db->query("SELECT tgl_masuk FROM tb_user WHERE id_user = '$user'")->row_array();
      if ($getTglMasukKerja['tgl_masuk'] <= $endDate) {
        $sudahMasuk = true;
        $cekTglMasukKerja = $this->db->query("SELECT tgl_masuk FROM tb_user WHERE id_user = '$user' AND STR_TO_DATE(tgl_masuk, '%Y-%m-%d') BETWEEN '$startDate' AND STR_TO_DATE('$endDate','%Y-%m-%d')")->row_array();
        if ($startDate >= $cekTglMasukKerja['tgl_masuk']) {
          $startDate = $startDate;
        } else {
          $startDate = $cekTglMasukKerja['tgl_masuk'];
        }
      } else {
        $sudahMasuk = false;
        $startDate = $getTglMasukKerja['tgl_masuk'];
      }

      $daftarHari = date_range($startDate, $endDate, "+1 day", "Y-m-d");


      $tidakisiLKH = array();
      $totaltidakisi = 0;

      $db2 = $this->load->database('database_kedua', TRUE);
      foreach ($daftarHari as $dH) {
        //$isiLKH = $this->db->query("SELECT tanggal FROM tugasharian WHERE username = '$user' and tanggal = '$dH' AND STR_TO_DATE(tanggal, '%Y-%m-%d') BETWEEN $startDate AND STR_TO_DATE($endDate,'%Y-%m-%d')")->num_rows(); // KODINGAN LAMA TIDAK SESUAI
        $isiLKH = $this->db->query("SELECT tanggal FROM tugasharian WHERE username = '$user' and tanggal = '$dH'")->num_rows(); // SUDAH SESUAI MELAKUKAN PENGECEKAN APAKAH TGL $dH ADA DI DALAM TABEL TUGASHARIAL ??? JIKA YA AKAN BERNILAI 1 ARTINYA SUDAH MENGISI LKH

        $tglLibur = $db2->select('tanggal')->from('kalender')->where_in('tanggal', $dH)->get()->row_array();
        if (!$tglLibur) {
          if ($isiLKH == 0) {
            $tidakisiLKH[] = $dH;
          }
        }
      }


      if ($sudahMasuk) {
        $totaltidakisi = count($tidakisiLKH);
      }

      $dataHariLibur = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$startDate' AND '$endDate' AND tambahan = 'N'")->result_array();
      $harilibur = array();
      foreach ($dataHariLibur as $cln) {
        $harilibur[] = $cln['tanggal'];
      }
      $harikerja = getWorkingDays($startDate, $endDate, $harilibur);

      $cariisilkh = $this->db->query("SELECT * FROM tugasharian 
                                      WHERE username='$user' 
                                      AND tanggal 
                                      BETWEEN '$startDate' AND '$endDate' 
                                      GROUP BY tanggal")->num_rows();

      $izin = 0;
      $carisdsd = $db2->query("SELECT * FROM daterange_izin WHERE tanggal BETWEEN '$startDate' AND '$endDate' AND jenis='Sakit Dengan Surat Dokter' AND username='$user'")->result_array();

      $arrsdsd = array();
      foreach ($carisdsd as $sd) {
        $arrsdsd[] = $sd['tanggal'];
      }

      $izin += count($arrsdsd);

      $cuti = 0;
      $caricuti = $db2->query("SELECT *, tb_mohoncuti.keterangan 
                                FROM daterange_cuti 
                                LEFT JOIN tb_mohoncuti ON daterange_cuti.no_cuti = tb_mohoncuti.no_cuti 
                                WHERE tanggal 
                                BETWEEN '$startDate' AND '$endDate' 
                                AND username='$user' 
                                AND tb_mohoncuti.keterangan!='Cuti Bersama'")->result_array();

      $arrcuti = array();
      foreach ($caricuti as $cc) {
        $arrcuti[] = $cc['tanggal'];
      }
      $cuti += count($arrcuti);

      $unpaidcuber = 0;
      $cariunpaid = $db2->query("SELECT * FROM daterange_unpaid WHERE tanggal BETWEEN '$startDate' AND '$endDate' AND username='$user'")->result_array();

      $arrunpaid = array();
      foreach ($cariunpaid as $cu) {
        $arrunpaid[] = $cu['tanggal'];
      }
      $unpaidcuber += count($arrunpaid);

      $caricutibersama = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$startDate' AND '$endDate' AND tambahan='Y'")->result_array();
      $cutibersama_pengajuan = $db2->query("SELECT *, tb_mohoncuti.keterangan FROM daterange_cuti LEFT JOIN tb_mohoncuti ON daterange_cuti.no_cuti = tb_mohoncuti.no_cuti WHERE tanggal BETWEEN '$startDate' AND '$endDate' AND username='$user' AND tb_mohoncuti.keterangan='Cuti Bersama'")->result_array();

      $arrcuber = array();
      if ($cutibersama_pengajuan) {
        foreach ($cutibersama_pengajuan as $cbp) {
          $arrcuber[] = $cbp['tanggal'];
        }
      }
      $cuber = count($arrcuber);

	$listcuber = array();
      foreach ($caricutibersama as $ccb) {
        $listcuber[] = $ccb['tanggal'];
      }
      $totalcuber = count($listcuber);
      $tidakcuber = $totalcuber - $cuber;

      if ($tidakcuber > 0) {
        $unpaidcuber += $tidakcuber;
      }

      $caristsd = $db2->query("SELECT * FROM daterange_izin WHERE tanggal BETWEEN '$startDate' AND '$endDate' AND username='$user' AND jenis='Sakit Tanpa Surat Dokter'")->result_array();
      $arrstsd = array();
      foreach ($caristsd as $cstsd) {
        $arrstsd[] = $cstsd['tanggal'];
      }

      if (count($arrcuber) > 0) {
        $totaltidakisi = $harikerja - $cariisilkh - $izin - $cuti - $unpaidcuber - $cuber - count($arrstsd);
      } else {
        $totaltidakisi = $harikerja - $cariisilkh - $izin - $cuti - $unpaidcuber - count($arrstsd);
      };

      if ($totaltidakisi < 0) $totaltidakisi = 0;

      $arrMonth = ['January', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      ?>

      <!-- PENGINGAT TENTANG ROTASI HARI KERJA -->
      <?php
        $tglnow = date('Y-m-d');
        $username = $this->session->userdata('ses_username');
        $tglrot = $this->db->query("SELECT tgl_rotasi FROM tb_rotasi WHERE userstaff ='$username' ORDER BY id DESC")->row_array();
        if ($tglrot != NULL) {
          $tglrotasi = implode(" ", $tglrot);
          if ($tglnow <= $tglrotasi ) {

       ?>
      <div class="col-lg-6 col-md-6 col-12">
        <div class="card">
          <div class="card-header">
            <h4>Rotasi Hari Kerja <?php echo $this->session->userdata('ses_nama') ?></h4>
          </div>
          <div class="card-body">
            <p class="text-warning font-weight-bold">Pengingat !</p>
            <p>Tanggal Rotasi Kerja &nbsp; : &nbsp;<span class="font-weight-bold"><?php echo date('D , d M Y', strtotime($tglrotasi)) ?></span></p>
          </div>
        </div>
      </div>
      <?php
          }
        }
      ?>


      <?php
        if($this->session->userdata('ses_akses') != 'Direksi'):
         $string = '';
          ?>
      <!-- PERINGATAN SATUAN DARI 1 SAMPAI 3 SESUAI KONDISI -->
      <?php if ($totaltidakisi >= 0) { ?>
        <div class="col-lg-6 col-md-6 col-12">
          <div class="card">
            <div class="card-header">
              <!-- <h4><?php echo $this->session->userdata('ses_nama') ?></h4> -->
              <h4>Kedisiplinan Isi LKH</h4>
            </div>
            <div class="card-body">
            
            <?php if ($totaltidakisi == 0) { ?>
              <div style="width: 100%; text-align: center;">
                <i class="text-success fas fa-thumbs-up fa-10x faa-flash animated" style="font-size: 100px;"></i>
                <h6 class="text-success mt-3 faa-flash animated">Terimakasih karena Anda telah disiplin untuk mengisi LKH</h6>
              </div>
            <?php
              
            
            } else if ($totaltidakisi >= 3) { ?>
              <!-- <div class="card-body"> -->
                <a class="text-danger" data-toggle="collapse" href="#teguran" role="button" aria-expanded="false" aria-controls="collapseExample"><p class="text-danger font-weight-bold faa-flash animated ">Teguran 3</p></a>

                <div class="collapse" id="teguran"><p>Saudara/i tidak mengisi LKH <?= $totaltidakisi ?> kali (tanggal
                  <?php for ($i = 0; $i < count($tidakisiLKH); $i++) {
                    $string .= (date('d', strtotime($tidakisiLKH[$i])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[$i])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[$i])));
                    $string .= ($i < count($totaltidakisi)) ? ', ' : ' ';
                  }
                  echo $string;
                  ?>
                  ). 
                  <!-- Ini adalah teguran terakhir bagi saudara. <br><br>Tingkatkan kedisiplinan saudara, sekali lagi <strong>TINGKATKAN KEDISIPLINAN SAUDARA</strong>, TINGKATKAN KEDISIPLINAN SAUDARA, agar gaji anda tidak terpotong. <br><br>Selanjutnya anda akan terkena potongan gaji harian tanpa ada teguran</p> -->
                  <br>Ini adalah teguran terakhir bagi saudara. <br><br>Setelah saudara menerima <strong>Teguran ke 3</strong> maka gaji saudara akan dikenakan potongan 3 hari atau sejumlah saudara tidak mengisi LKH.</p>
                </div>
              <!-- </div> -->
            <?php
             // } else if ($totaltidakisi > 2) { ?>
              <!-- <div class="card-body"> -->
            <!--     <p class="text-danger font-weight-bold">Teguran 3</p>
                <p>Saudara/i tidak mengisi LKH ketiga kalinya (tanggal <?php echo (date('d', strtotime($tidakisiLKH[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[0]))) . ", " . (date('d', strtotime($tidakisiLKH[1])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[1])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[1])));
                                                                        echo ", ";
                                                                        echo (date('d', strtotime($tidakisiLKH[2])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[2])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[2]))); ?>). 
                                                                        <br>Ini adalah teguran terakhir bagi saudara. <br><br>Setelah saudara menerima Teguran ke 3 maka gaji saudara akan dikenakan potongan 3 hari atau sejumlah saudara tidak mengisi LKH.</p>
                                                                        Tingkatkan kedisiplinan saudara, sekali lagi <strong>TINGKATKAN KEDISIPLINAN SAUDARA</strong>, TINGKATKAN KEDISIPLINAN SAUDARA, agar gaji anda tidak terpotong. <br><br>Selanjutnya anda akan terkena potongan gaji harian tanpa ada teguran</p> --> 
              <!-- </div> -->
            <?php } else if ($totaltidakisi > 1) { ?>
              <!-- <div class="card-body"> -->
                <a class="text-warning" data-toggle="collapse" href="#teguran" role="button" aria-expanded="false" aria-controls="collapseExample"><p class="text-danger font-weight-bold"><p class="text-warning font-weight-bold faa-flash animated">Teguran 2</p></a>
                <div class="collapse" id="teguran"><p>Saudara/i tidak mengisi LKH yang kedua kalinya tanggal <?php echo (date('d', strtotime($tidakisiLKH[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[0])));
                                                                          echo ", ";
                                                                          echo (date('d', strtotime($tidakisiLKH[1])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[1])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[1]))); ?>. Ini adalah peringatan keras. <br><br> Tingkatkan kedisiplinan saudara agar tidak menimbulkan teguran ketiga (Teguran Terakhir)</p>
                </div>
              <!-- </div> -->
            <?php } else if ($totaltidakisi > 0) { ?>
              <!-- <div class="card-body"> -->
                <a class="text-warning" data-toggle="collapse" href="#teguran" role="button" aria-expanded="false" aria-controls="collapseExample"><p class="text-danger font-weight-bold"><p class="text-warning font-weight-bold faa-flash animated">Teguran 1</p></a>
                <div class="collapse" id="teguran"><p>Saudara/i tidak mengisi LKH pada tanggal <?php echo (date('d', strtotime($tidakisiLKH[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[0]))); ?>. Ini adalah peringatan awal. Harap disiplin mengisi LKH setiap hari, agar tidak terjadi teguran kedua.</p>
                </div>
              <!-- </div> -->
            <?php } ?>
          </div>

          <div class="card-footer">
          <?php
          if ($this->session->userdata('ses_akses') == 'Manager') {
            echo "<h6>Staff</h6>";
            $staff = $this->db->get_where('tb_user', array('atasan' => $user, 'aktif' => 'Y'))->result_array();
            foreach ($staff as $st) {
              unset($tidakisiLKH_staff);
             
             $getTglMasukKerja_staff = $this->db->query("SELECT tgl_masuk FROM tb_user WHERE id_user = '$st[id_user]'")->row_array();
              if ($getTglMasukKerja_staff['tgl_masuk'] <= $endDate) {
                $sudahMasuk_staff = true;
                $cekTglMasukKerja_staff = $this->db->query("SELECT tgl_masuk FROM tb_user WHERE id_user = '$st[id_user]' AND STR_TO_DATE(tgl_masuk, '%Y-%m-%d') BETWEEN '$startDate' AND STR_TO_DATE('$endDate','%Y-%m-%d')")->row_array();
                if ($startDate >= $cekTglMasukKerja_staff['tgl_masuk']) {
                  $startDate = $startDate;
                } else {
                  $startDate = $cekTglMasukKerja_staff['tgl_masuk'];
                }
              } else {
                $sudahMasuk = false;
                $startDate = $getTglMasukKerja_staff['tgl_masuk'];
              }

              $daftarHari_staff = date_range($startDate, $endDate, "+1 day", "Y-m-d");


              $tidakisiLKH_staff = array();
              $totaltidakisi_staff = 0;

              $db2 = $this->load->database('database_kedua', TRUE);
              foreach ($daftarHari_staff as $dH) {
                //$isiLKH = $this->db->query("SELECT tanggal FROM tugasharian WHERE username = '$user' and tanggal = '$dH' AND STR_TO_DATE(tanggal, '%Y-%m-%d') BETWEEN $startDate AND STR_TO_DATE($endDate,'%Y-%m-%d')")->num_rows(); // KODINGAN LAMA TIDAK SESUAI
                $isiLKH_staff = $this->db->query("SELECT tanggal FROM tugasharian WHERE username = '$st[id_user]' and tanggal = '$dH'")->num_rows(); // SUDAH SESUAI MELAKUKAN PENGECEKAN APAKAH TGL $dH ADA DI DALAM TABEL TUGASHARIAL ??? JIKA YA AKAN BERNILAI 1 ARTINYA SUDAH MENGISI LKH

                $tglLibur = $db2->select('tanggal')->from('kalender')->where_in('tanggal', $dH)->get()->row_array();
                if (!$tglLibur) {
                  if ($isiLKH_staff == 0) {
                    $tidakisiLKH_staff[] = $dH;
                  }
                }
              }

              $string = NULL;

              if ($sudahMasuk_staff) {
                $totaltidakisi_staff = count($tidakisiLKH_staff);
              }
              if ($totaltidakisi_staff >= 3) { ?>
              <!-- <div class="card-body"> -->
                <a class="text-danger" data-toggle="collapse" href="#teguran<?= $st['id_user'] ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><p class="text-danger font-weight-bold faa-flash animated ">Teguran 3 (<?= $st['nama_user'] ?>)</p></a>

                <div class="collapse" id="teguran<?= $st['id_user'] ?>"><p>Saudara/i <?= $st['nama_user'] ?> tidak mengisi LKH <?= $totaltidakisi_staff ?> kali (tanggal
                  <?php for ($i = 0; $i < count($tidakisiLKH_staff); $i++) {
                    $string .= (date('d', strtotime($tidakisiLKH_staff[$i])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH_staff[$i])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH_staff[$i])));
                    $string .= ($i < count($totaltidakisi_staff)) ? ', ' : ' ';
                  }
                  echo $string;
                  ?>
                  ). 
                  <!-- Ini adalah teguran terakhir bagi saudara. <br><br>Tingkatkan kedisiplinan saudara, sekali lagi <strong>TINGKATKAN KEDISIPLINAN SAUDARA</strong>, TINGKATKAN KEDISIPLINAN SAUDARA, agar gaji anda tidak terpotong. <br><br>Selanjutnya anda akan terkena potongan gaji harian tanpa ada teguran</p> -->
                  <!-- <br>Ini adalah teguran terakhir bagi saudara. <br><br>Setelah saudara menerima <strong>Teguran ke 3</strong> maka gaji saudara akan dikenakan potongan 3 hari atau sejumlah saudara tidak mengisi LKH.</p> -->
                </div>
              <!-- </div> -->
            <?php
             // } else if ($totaltidakisi > 2) { ?>
              <!-- <div class="card-body"> -->
            <!--     <p class="text-danger font-weight-bold">Teguran 3</p>
                <p>Saudara/i tidak mengisi LKH ketiga kalinya (tanggal <?php echo (date('d', strtotime($tidakisiLKH[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[0]))) . ", " . (date('d', strtotime($tidakisiLKH[1])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[1])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[1])));
                                                                        echo ", ";
                                                                        echo (date('d', strtotime($tidakisiLKH[2])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[2])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[2]))); ?>). 
                                                                        <br>Ini adalah teguran terakhir bagi saudara. <br><br>Setelah saudara menerima Teguran ke 3 maka gaji saudara akan dikenakan potongan 3 hari atau sejumlah saudara tidak mengisi LKH.</p>
                                                                        Tingkatkan kedisiplinan saudara, sekali lagi <strong>TINGKATKAN KEDISIPLINAN SAUDARA</strong>, TINGKATKAN KEDISIPLINAN SAUDARA, agar gaji anda tidak terpotong. <br><br>Selanjutnya anda akan terkena potongan gaji harian tanpa ada teguran</p> --> 
              <!-- </div> -->
            <?php } else if ($totaltidakisi_staff > 1) { ?>
              <!-- <div class="card-body"> -->
                <a class="text-warning" data-toggle="collapse" href="#teguran<?= $st['id_user'] ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><p class="text-danger font-weight-bold"><p class="text-warning font-weight-bold faa-flash animated">Teguran 2 (<?= $st['nama_user'] ?>)</p></a>
                <div class="collapse" id="teguran<?= $st['id_user'] ?>"><p>Saudara/i <?= $st['nama_user'] ?> tidak mengisi LKH yang kedua kalinya tanggal <?php echo (date('d', strtotime($tidakisiLKH_staff[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH_staff[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH_staff[0])));
                                                                          echo ", ";
                                                                          echo (date('d', strtotime($tidakisiLKH_staff[1])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH_staff[1])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH_staff[1]))); ?>. 
                                                                          <!-- Ini adalah peringatan keras. <br><br> Tingkatkan kedisiplinan saudara agar tidak menimbulkan teguran ketiga (Teguran Terakhir)</p> -->
                </div>
              <!-- </div> -->
            <?php } else if ($totaltidakisi_staff > 0) { ?>
              <!-- <div class="card-body"> -->
                <a class="text-warning" data-toggle="collapse" href="#teguran<?= $st['id_user'] ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><p class="text-danger font-weight-bold"><p class="text-warning font-weight-bold faa-flash animated">Teguran 1 (<?= $st['nama_user'] ?>)</p></a>
                <div class="collapse" id="teguran<?= $st['id_user'] ?>"><p>Saudara/i <?= $st['nama_user'] ?> tidak mengisi LKH pada tanggal <?php echo (date('d', strtotime($tidakisiLKH_staff[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH_staff[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH_staff[0]))); ?>. 
                <!-- Ini adalah peringatan awal. Harap disiplin mengisi LKH setiap hari, agar tidak terjadi teguran kedua.</p> -->
                </div>
              </div>
            <?php }
            } ?>


          </div>
            

          
        </div>
      <?php }
      } ?>
      
      <!-- =========== -->


      <!-- RINCIAN PERINGATAN 1 SAMPAI 3 -->
      <?php if ($totaltidakisi > 0) { ?>
        <div class="col-12">
          <div class="card" style="display: none;">
            <div class="card-header">
              <a class="text-dark" data-toggle="collapse" href="#detail_teguran" role="button" aria-expanded="false" aria-controls="collapseExample"><p class="text-danger font-weight-bold"><h4>Detail Teguran</h4></a>
              <!-- <h4><?php echo $this->session->userdata('ses_nama') ?></h4> -->
            </div>
            <div class="collapse" id="detail_teguran">
            <?php if ($totaltidakisi >= 3) { ?>
              
              <div class="card-body">
                <p class="text-danger font-weight-bold">Teguran 3</p>
                <p>Saudara/i tidak mengisi LKH <?= $totaltidakisi ?> kali (tanggal
                  <?php for ($i = 0; $i < count($tidakisiLKH); $i++) {
                    $string .= (date('d', strtotime($tidakisiLKH[$i])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[$i])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[$i])));
                    $string .= ($i < count($totaltidakisi)) ? ', ' : ' ';
                  }
                  echo $string;
                  ?>
                  ).
                   <!-- Ini adalah teguran terakhir bagi saudara. <br><br>Tingkatkan kedisiplinan saudara, sekali lagi <strong>TINGKATKAN KEDISIPLINAN SAUDARA</strong>, TINGKATKAN KEDISIPLINAN SAUDARA, agar gaji anda tidak terpotong. <br><br>Selanjutnya anda akan terkena potongan gaji harian tanpa ada teguran</p> -->
                    Ini adalah teguran terakhir bagi saudara. Setelah saudara menerima <strong>Teguran ke 3</strong> maka gaji saudara akan dikenakan potongan 3 hari atau sejumlah saudara tidak mengisi LKH.</p>
              </div>
            <?php }
            // if ($totaltidakisi > 2) { ?>
             <!--   <div class="card-body">
                <p class="text-danger font-weight-bold">Teguran 3</p>
                <p>Saudara/i tidak mengisi LKH ketiga kalinya (tanggal <?php echo (date('d', strtotime($tidakisiLKH[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[0]))) . ", " . (date('d', strtotime($tidakisiLKH[1])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[1])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[1])));
                                                                        echo ", ";
                                                                        echo (date('d', strtotime($tidakisiLKH[2])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[2])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[2]))); ?>). 
                                                                      Ini adalah teguran terakhir bagi saudara. Setelah saudara menerima Teguran ke 3 maka gaji saudara akan dikenakan potongan 3 hari atau sejumlah saudara tidak mengisi LKH.</p>
                                                                        Ini adalah teguran terakhir bagi saudara. Tingkatkan kedisiplinan saudara, sekali lagi <strong>TINGKATKAN KEDISIPLINAN SAUDARA</strong>, TINGKATKAN KEDISIPLINAN SAUDARA, agar gaji anda tidak terpotong. Selanjutnya anda akan terkena potongan gaji harian tanpa ada teguran</p>
              </div> --> 
            <?php 
          // } 
          ?>
            <?php if ($totaltidakisi > 1) { ?>
              <div class="card-body">
                <p class="text-warning font-weight-bold">Teguran 2</p>
                <p>Saudara/i tidak mengisi LKH yang kedua kalinya (tanggal <?php echo (date('d', strtotime($tidakisiLKH[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[0])));
                                                                            echo ", ";
                                                                            echo (date('d', strtotime($tidakisiLKH[1])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[1])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[1]))); ?>). Ini adalah peringatan keras. Tingkatkan kedisiplinan saudara agar tidak menimbulkan teguran ketiga (Teguran Terakhir)</p>
              </div>
            <?php } ?>
            <?php if ($totaltidakisi > 0) { ?>
              <div class="card-body">
                <p class="text-warning font-weight-bold">Teguran 1</p>
                <p>Saudara/i tidak mengisi LKH pada tanggal <?php echo (date('d', strtotime($tidakisiLKH[0])) . ' ' . $arrMonth[(int)date('m', strtotime($tidakisiLKH[0])) - 1] . ' ' . date('Y', strtotime($tidakisiLKH[0]))); ?>. Ini adalah peringatan awal. Harap disiplin mengisi LKH setiap hari, agar tidak terjadi teguran kedua.</p>
              </div>
            <?php } ?>
          </div>
        </div>
        </div>
      <?php } 
      endif; ?>
      <!-- =========== -->








  </section>

  <!-- Modal -->
<div class="modal fade" id="disclaimer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('dashboard/disclaimer') ?>" method="POST">
        <input type="hidden" name="nama" id="nama" value="<?php echo $nama_login ?>">
        <input type="hidden" name="id_user" id="id_user" value="<?php echo $user_login ?>">
        <input type="hidden" name="ket" id="ket" value="Setuju">
        <table class="table table-sm borderless" cellpadding="5" style="font-size: 17px; width: 100%" >

          <tr>
            <td colspan="2">
              <p>Halo <?php echo $nama_login; ?> !!
                <br>
                <strong><i>"Selamat bergabung di Aplikasi Timesheet Work From Home (WFH)"</i></strong>
              </p>
            </td>
          </tr>
          <!-- <tr >
                                       <td colspan="2"></td>
                                    </tr> -->
          <tbody >
            <tr>
              <td colspan="2" style="text-align: justify;">Marketing Research Indonesia adalah perusahaan yang menjunjung tinggi nilai perusahaan yaitu CITIE (Commitment-Integrity-Teamwork-Innovative-Excellent), berlandasan nilai perusahaan tersebut maka tujuan dibuatkan <strong><i>Aplikasi Timesheet WFH</i></strong> ini adalah :
              </td>
            </tr>
            <tr>
              <td width="5%" valign="top">(1) </td>
              <td style="text-align: justify;">Sebagai pengganti absensi kehadiran / finger print selama pandemic Covid-19.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(2)</td>
              <td style="text-align: justify;">Mengubah pola kerja karyawan dari pelupa menjadi tidak pelupa.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(3)</td>
              <td style="text-align: justify;">Mengubah pola kerja karyawan dari tidak disiplin menjadi disiplin.</td>
            </tr>

            <tr>
              <td width="5%" valign="top">(4)</td>
              <td style="text-align: justify;">Mengubah pola kerja karyawan dari tidak mempunyai perencanaan kerja menjadi mempunyai perencanaan kerja yang telah disepakati oleh atasan.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(5)</td>
              <td style="text-align: justify;">Membuat pengembangan kinerja karyawan yang berdampak pada pengembangan perusahaan.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(6)</td>
              <td style="text-align: justify;">Bila karyawan menghasilkan hasil kerja yang lebih dari target maka karyawan mendapatkan insentif bulanan.</td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: justify;">Adapun ketentuan-ketentuan Aplikasi TimesheetWFH adalah sebagai berikut :
              </td>
            </tr>
            <tr>
              <td width="5%" valign="top">(1) </td>
              <td style="text-align: justify;">Pengisian Tugas Kerja Mingguan  paling telat hari Jumat sebelum jam 24.00.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(2)</td>
              <td style="text-align: justify;">Pengisian LKH paling telat H+1 sebelum jam 10.00.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(3)</td>
              <td style="text-align: justify;">Apabila karyawan lalai mengisi LKH :</td>
            </tr>

            <tr>
              <td></td>
              <td style="text-align: justify;">A. 1 hari maka karyawan mendapatkan teguran 1 secara sistem.</td>
            </tr>
            <tr>
              <td></td>
              <td style="text-align: justify;">B. 2 hari maka karyawan mendapatkan teguran 2 secara sistem.</td>
            </tr>
            <tr>
              <td></td>
              <td style="text-align: justify;">C. 3 hari dan seterusnya maka karyawan mendapatkan teguran secara sistem dan pemotongan gaji sejumlah hari tidak mengisi LKH. HC juga akan mengeluarkan teguran tertulis dan  karyawan harus melakukan pembinaan.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(4)</td>
              <td style="text-align: justify;">Apabila karyawan tidak mencapai TKM sesuai timeline yang telah disepakati maka akan pemotongan tunjangan.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(5)</td>
              <td style="text-align: justify;">Setiap divisi wajib mengadakan meeting TKM sebelum membuat TKM untuk minggu berikutnya.</td>
            </tr>

          </tbody>
        </table>
        <hr width="100%" style="height:0; border-top:3px solid #DCDCDC;">
        <p><input type="checkbox" name="check_pernyataan" id="setujui1" value="setujui1"> <b>Saya telah membaca dan memahami pernyataan tersebut diatas.</b> </p>
        <p><input type="checkbox" name="check_pernyataan" id="setujui2" value="setujui2"> <b>Saya  menyetujui pernyataan dan ketentuan-ketentuan tersebut diatas.</b> </p>
        <p><input type="checkbox" name="check_pernyataan" id="setujui3" value="setujui3"> <b>Saya menerima konsekuensi apabila melanggar ketentuan tersebut diatas.</b> </p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="setujui" disabled>Setujui</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </form>
    </div>
  </div>
</div>





                 
<?php
//MODAL REKAP PEKERJAAN

$no = 0;
foreach ($alldiv as $ad) { $no++; ?>

<div class="modal fade" tabindex="-1" role="dialog" id="detailkerja<?php echo $ad['id_user'] ?>">
  <div class="modal-dialog" role="document" style="min-width: 80%;">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #F0F8FF;">
        <h5 class="modal-title" id="exampleModalLabel">Rekap Pekerjaan <?php echo $ad['nama_user'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="border-top: 1px solid #F0F8FF;">
        <?php
        $time = strtotime("-3 month", time());
        $bulan3 = date("Y-m-d", $time);
        $datenow = date("Y-m-d");
        

        $get = $this->db->query("SELECT
                                                a.*,
                                              --  SUM(c.persentase) AS sumper,
                                                d.deskripsi, 
                                              d.no as no_pekerjaan,
                                              b.daritanggal,
                                              b.sampaitanggal
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                              -- AND a.project = c.project
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              WHERE
                                                a.userstaff = '$ad[id_user]'
                                                AND a.tanggalisi between '$bulan3' AND '$datenow'
                                                ")->result_array(); ?>
        <b><span class="text-warning faa-flash animated">*Note </span> : Detail pekerjaan harian dapat dilihat di menu laporan timesheet!</h5></b>
        <div class="table-responsive">

        <table class="table  table-bordered table-hover tabel-rekap" >
          <thead>
            <!-- <tr>
              <th colspan="2">TKM</th>

            </tr>
 -->
          </thead>
          <tbody>
            <?php if ($get == NULL) {
             ?>
              <div class="text-center" style="border-bottom: 1px solid #F0F8FF;">
                <h6>Data Tidak Tersedia</h6>
              </div>
            <?php } else {
             foreach ($get as $row) {
              $sebelum = $row['daritanggal'];
              $sesudah = $row['sampaitanggal'];
              
              ?>
            <tr>

              <th colspan="7" class="bg-info text-white"><?php echo $row['project']; ?> (Periode : <?php echo date('d M Y', strtotime($sebelum)) ." - ". date('d M Y', strtotime($sesudah)) ?>)</th>
            </tr>
           <?php $get_uraian = $this->db->query("SELECT * from rincian where idpekerjaan='$row[no_pekerjaan]' AND id_tkmstaff='$row[no]' AND userstaff='$row[userstaff]'")->result_array();
            if ($get_uraian != NULL) { ?>
              <tr class="bg-light">
                <th class="no">No</th>
                <th class="rincian">Rincian</th>
                <th class="persen">Persentase</th>
                <th class="status">Status</th>
                <th class="target">Target Selesai</th>
                <th class="pencapaian">Pencapaian</th>
                <th class="approval">Approval</th>
              </tr>
            <?php }
            $no = 1;
            foreach ($get_uraian as $data) {
               ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['rincian']; ?></td>
              <td><center><?php echo $data['targetpersen']; ?>%</center></td>
              <td><?php echo $data['status']; ?></td>
              <td><?php echo date('d-m-Y', strtotime($data['targetselesai']));
                  if ($akses == 'Manager') {
                 ?>
                  <a href="#" id="target_baru" type="button" title="Perpanjang Target" class="btn btn-primary" data-toggle="modal" data-target="#perpanjang_target" data-rincian="<?= $data['id_rincian'] ?>" onclick="clickTarget('<?= $data['id_rincian'] ?>');"><i class='fas fa-plus'></i></a>
                  <?php } ?> 
              </td>
              
                <?php
                if ($data['targetpersen'] == 100 AND $data['tanggalupdate'] <= $data['targetselesai'] AND $data['targetselesai'] != '0000-00-00') {
                  echo "<td style='background-color: #7FFFD4;'>Tercapai Tepat Waktu</td>";
                } else if ($data['targetpersen'] == 100 AND $data['tanggalupdate'] > $data['targetselesai'] AND $data['targetselesai'] != '0000-00-00') {
                  echo "<td style='background-color: #DC143C; color: white;'>Tidak Tercapai Tepat Waktu</td>";
                } else {
                  echo "<td></td>";
                }
                 ?>
                 <td>
                   <?php if ($akses == 'Manager') {
                        if ($data['targetpersen'] == 100 AND $data['approval'] != 'Diterima') {
                          
                        echo "<b>".$data['approval']."</b><br>";

                         echo "<div class='row'><a href='".base_url('harian/approval_rekap/').$data['id_rincian']."' title='Diterima' class='btn btn-success'><i class='fas fa-check-square'></i></a>
                         <a href='#' id='tolak_approve' type='button' title='Ditolak' class='btn btn-danger' data-toggle='modal' data-target='#tolak' data-rincian='".$data['id_rincian']."' onclick='clickTolak(`".$data['id_rincian']."`);'><i class='fas fa-times-circle'></i></a></div>";
                       } else {
                        echo "<b>".$data['approval']."</b>";
                       }
                   } else { 
                      if ($data['approval'] == 'Diterima') {
                        echo "<b class='text-success'>".$data['approval']."</b>";
                      } else if ($data['approval'] == 'Ditolak')  {
                        echo "<b class='text-danger'>".$data['approval']." (".$data['alasan'].")</b>";
                      }

                   } ?>
                 </td>
                
                

              
            </tr>

          <?php
          }
           } 
         } ?>
          </tbody>
        </table>
      </div>
      <br>
      <?php if($get != NULL) { ?>
       <p ><span class="font-weight-bold">Note : </span> Kolom Pencapaian akan terisi otomatis jika persentase sudah terisi sampai 100%.</p>
     <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Keterangan Penolakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('harian/tolak_rekap'); ?>">
          <input type="hidden" name="id_rincian" class="form-control" id="id_rincian">
          <div class="form-group">
            <label for="alasan_tolak">Alasan Penolakan</label>
              <textarea class="form-control" id="alasan_tolak" name="alasan_tolak"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="perpanjang_target" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Perpanjang Target Selesai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('harian/perpanjang_rincian'); ?>">
          <input type="hidden" name="id_rincian" class="form-control" id="id_rincian_target">
          <div class="form-group">
            <label for="pilih_tanggal">Pilih Tanggal :</label>
            <input type="date" id="pilih_tanggal" name="tanggal_baru" class="form-control">
          </div>
          <div class="form-group">
            <label for="alasan_perpanjang">Alasan Perpanjang :</label>
            <textarea class="form-control" id="alasan_perpanjang" name="alasan_perpanjang"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>






<?php
//MODAL TINDAK LANJUT PERUBAHAN STATUS
$no = 0;
foreach ($alldiv as $ad) { $no++; ?>
<div class="modal fade" tabindex="-1" role="dialog" id="tindaklanjut<?php echo $ad['id_user'] ?>">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <h5 class="modal-title" id="exampleModalLabel">Tindak Lanjut Perubahan Status Rincian TKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="border-top: 1px solid #E6E6FA;">

        <div style="border-bottom: 1px solid #E6E6FA;" class="mb-3">
        <p class="font-weight-bold" id="exampleModalLabel">Nama &nbsp; : &nbsp; <?php echo $ad['nama_user']; ?></p>
        </div>
        <?php
       
        

        $get = $this->db->query("SELECT
                                                *
                                              FROM
                                                tkmstaff a
                                              JOIN rincian b ON a.no=b.id_tkmstaff
                                              WHERE
                                                a.userstaff = '$ad[id_user]'
                                                AND b.status='Menjadi Kasus'
                                                GROUP BY a.no
                                                ")->result_array(); ?>

      <!-- <li> --> 
                       <?php if ($get == NULL) {
                           ?>
                            <div class="text-center" style="border-bottom: 1px solid #F0F8FF;">
                              <h6>Data Tidak Tersedia</h6>
                            </div>
                          <?php } else {
                          foreach ($get as $row) {
                          ?>
                           <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="project">Project/Program/Pekerjaan :</label>
                                <input type="text" class="form-control" id="project" name="project[]" value="<?php echo $row['project'] ?>" readonly>
                              </div>
                            </div>
                          </div>

                          <!-- RINCIAN -->
                         
                          <ul>
                            <?php 
                                $rincian = $this->db->query("SELECT * FROM rincian WHERE id_tkmstaff = '$row[no]' AND userstaff='$ad[id_user]' AND status='Menjadi Kasus'")->result_array(); ?>
                                <li>
                                  <?php 
                                    foreach ($rincian as $data) :
                                      
                                  ?>
                                  <form action="<?php echo base_url('dashboard/tindaklanjut_status') ?>" method="POST" enctype="multipart/form-data">
                                  <div class="row">

                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label for="rinciantext">Rincian Pekerjaan :</label>
                                        <input type="text" class="form-control" name="rinciantext[]" value="<?php echo $data['rincian'] ?>" readonly>

                                         <input type="hidden" class="form-control" name="idrincian[]" value="<?php echo $data['id_rincian'] ?>" readonly>
                                       
                                      </div>
                                    </div>


                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label for="status">Status</label>
                                        <div class="input-group">
                                          <select class="form-control" name="status[]" >
                                           <?php if ($data['status'] == 'Menjadi Kasus') {
                                             ?>
                                            <option value="Berprogress">Berprogress</option>
                                            <option value="Menjadi Kasus" selected="">Menjadi Kasus</option>
                                            <option value="Done 100%">Done 100%</option>
                                          <?php } ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label for="persen">Persentase</label>
                                        <div class="input-group">
                                           <input type="text" class="form-control" name="persen[]" value="<?php echo $data['targetpersen'] ?>" readonly>
                                          <div class="input-group-append">
                                            <div class="input-group-text">
                                              <i class="fas fa-percent"></i>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                  </div>

                                </li>
                              <?php endforeach;
                               ?>
                              </ul>
                              
                                <?php
                              
                                 }
                                 } ?>
                                 <div class="col-sm-12 text-right">
                              <?php if ($get != NULL) {
                                ?>
                              <input type="submit" name="submit" value="Save" class="btn btn-success">
                            <?php } ?>
                              </div>
                            </form>
      <!-- </li> -->
        

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn font-weight-bold" data-dismiss="modal" style="background-color: #ADD8E6;">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div>




<?php
//MODAL REKAP PEKERJAAN UNDER DIREKSI
if ($this->session->userdata('ses_akses') == 'Direksi') {
$no = 0;
 foreach ($under as $ad) : 
                ?>

<div class="modal fade" tabindex="-1" role="dialog" id="detailkerja<?php echo $ad['id_user'] ?>">
  <div class="modal-dialog" role="document" style="min-width: 80%;">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #F0F8FF;">
        <h5 class="modal-title" id="exampleModalLabel">Rekap Pekerjaan <?php echo $ad['nama_user'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="border-top: 1px solid #F0F8FF;">
        <?php
        $time = strtotime("-3 month", time());
        $bulan3 = date("Y-m-d", $time);
        $datenow = date("Y-m-d");
        

        $get = $this->db->query("SELECT
                                                a.*,
                                              --  SUM(c.persentase) AS sumper,
                                                d.deskripsi, 
                                              d.no as no_pekerjaan,
                                              b.daritanggal,
                                              b.sampaitanggal
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                              -- AND a.project = c.project
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              WHERE
                                                a.userstaff = '$ad[id_user]'
                                                AND a.tanggalisi between '$bulan3' AND '$datenow'
                                                ")->result_array(); ?>
        <b><span class="text-warning faa-flash animated">*Note </span> : Detail pekerjaan harian dapat dilihat di menu laporan timesheet!</h5></b>
        
        <div class="table-responsive">
        <table class="table  table-bordered table-hover tabel-rekap" >
          <thead>
            <!-- <tr>
              <th colspan="2">TKM</th>

            </tr>
 -->
          </thead>
          <tbody>
            <?php if ($get == NULL) {
             ?>
              <div class="text-center" style="border-bottom: 1px solid #F0F8FF;">
                <h6>Data Tidak Tersedia</h6>
              </div>
            <?php } else {
             foreach ($get as $row) {
              $sebelum = $row['daritanggal'];
              $sesudah = $row['sampaitanggal'];
              
              ?>
            <tr>

              <th colspan="7" class="bg-info text-white"><?php echo $row['project']; ?> (Periode : <?php echo date('d M Y', strtotime($sebelum)) ." - ". date('d M Y', strtotime($sesudah)) ?>)</th>
            </tr>
           <?php $get_uraian = $this->db->query("SELECT * from rincian where idpekerjaan='$row[no_pekerjaan]' AND id_tkmstaff='$row[no]' AND userstaff='$row[userstaff]'")->result_array();
            if ($get_uraian != NULL) { ?>
              <tr class="bg-light">
                <th class="no">No</th>
                <th class="rincian">Rincian</th>
                <th class="persen">Persentase</th>
                <th class="status">Status</th>
                <th class="target">Target Selesai</th>
                <th class="pencapaian">Pencapaian</th>
                <th class="Approval">Approval</th>
              </tr>
            <?php }
            $no = 1;
            foreach ($get_uraian as $data) {
               ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['rincian']; ?></td>
              <td><center><?php echo $data['targetpersen']; ?>%</center></td>
              <td><?php echo $data['status']; ?></td>
              <td><?php echo date('d-m-Y', strtotime($data['targetselesai'])); ?></td>

              <td>
                <?php
                if ($data['targetpersen'] == 100 AND $data['tanggalupdate'] <= $data['targetselesai'] AND $data['targetselesai'] != '0000-00-00') {
                  echo "Tercapai Tepat Waktu";
                } else if ($data['targetpersen'] == 100 AND $data['tanggalupdate'] > $data['targetselesai'] AND $data['targetselesai'] != '0000-00-00') {
                  echo "Tidak Tercapai Tepat Waktu";
                } else {
                  echo "";
                }
                 ?>
                
              </td>
              <td>
                   <?php if ($akses == 'Direksi') {
                        if ($data['targetpersen'] == 100 AND $data['approval'] != 'Diterima') {
                         
                         echo "<div class='row'><a href='".base_url('harian/approval_rekap/').$data['id_rincian']."' title='Diterima' class='btn btn-success'><i class='fas fa-check-square'></i></a>
                         <a href='#' id='tolak_approve' type='button' title='Ditolak' class='btn btn-danger' data-toggle='modal' data-target='#tolak' data-rincian='".$data['id_rincian']."' onclick='clickTolak(`".$data['id_rincian']."`);'><i class='fas fa-times-circle'></i></a></div>";
                       } else {
                        echo "<b>".$data['approval']."</b>";
                       }
                   } else { 
                      if ($data['approval'] == 'Diterima') {
                        echo "<b class='text-success'>".$data['approval']."</b>";
                      } else if ($data['approval'] == 'Ditolak')  {
                        echo "<b class='text-danger'>".$data['approval']." (".$data['alasan'].")</b>";
                      }

                   } ?>
                 </td>
            </tr>

          <?php
          }
           } 
         } ?>
          </tbody>
        </table>
      </div>
      <br>
      <?php if($get != NULL) { ?>
       <p ><span class="font-weight-bold">Note : </span> Kolom Pencapaian akan terisi otomatis jika persentase sudah terisi sampai 100%.</p>
     <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<?php  
endforeach;
} ?>






<?php
//MODAL REKAP PEKERJAAN LEADER

$no = 0;
 foreach ($leader as $ad) : 
                ?>

<div class="modal fade" tabindex="-1" role="dialog" id="detailkerja<?php echo $ad['id_user'] ?>">
  <div class="modal-dialog" role="document" style="min-width: 80%;">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #F0F8FF;">
        <h5 class="modal-title" id="exampleModalLabel">Rekap Pekerjaan <?php echo $ad['nama_user'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="border-top: 1px solid #F0F8FF;">
        <?php
        $time = strtotime("-3 month", time());
        $bulan3 = date("Y-m-d", $time);
        $datenow = date("Y-m-d");
        

        $get = $this->db->query("SELECT
                                                a.*,
                                              --  SUM(c.persentase) AS sumper,
                                                d.deskripsi, 
                                              d.no as no_pekerjaan,
                                              b.daritanggal,
                                              b.sampaitanggal
                                              FROM
                                                tkmstaff a
                                              JOIN tkmdivisi b ON a.idtkmdiv = b.no
                                              -- LEFT JOIN tugasharian c ON a.idtkmdiv = c.idtkmdiv
                                              -- AND a.project = c.project
                                              LEFT JOIN pekerjaan d ON a.idtkmdiv = d.idtkmdiv AND a.project = d.project
                                              WHERE
                                                a.userstaff = '$ad[id_user]'
                                                AND a.tanggalisi between '$bulan3' AND '$datenow'
                                                ")->result_array(); ?>
        <b><span class="text-warning faa-flash animated">*Note </span> : Detail pekerjaan harian dapat dilihat di menu laporan timesheet!</h5></b>
        
        <div class="table-responsive">
        <table class="table  table-bordered table-hover tabel-rekap" >
          <thead>
            <!-- <tr>
              <th colspan="2">TKM</th>

            </tr>
 -->
          </thead>
          <tbody>
            <?php if ($get == NULL) {
             ?>
              <div class="text-center" style="border-bottom: 1px solid #F0F8FF;">
                <h6>Data Tidak Tersedia</h6>
              </div>
            <?php } else {
             foreach ($get as $row) {
              $sebelum = $row['daritanggal'];
              $sesudah = $row['sampaitanggal'];
              
              ?>
            <tr>

              <th colspan="6" class="bg-info text-white"><?php echo $row['project']; ?> (Periode : <?php echo date('d M Y', strtotime($sebelum)) ." - ". date('d M Y', strtotime($sesudah)) ?>)</th>
            </tr>
           <?php $get_uraian = $this->db->query("SELECT * from rincian where idpekerjaan='$row[no_pekerjaan]' AND id_tkmstaff='$row[no]' AND userstaff='$row[userstaff]'")->result_array();
            if ($get_uraian != NULL) { ?>
              <tr class="bg-light">
                <th class="no">No</th>
                <th class="rincian">Rincian</th>
                <th class="persen">Persentase</th>
                <th class="status">Status</th>
                <th class="target">Target Selesai</th> 
                <th class="pencapaian">Pencapaian</th>
                <th class="Approval">Approval</th>
              </tr>
            <?php }
            $no = 1;
            foreach ($get_uraian as $data) {
               ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['rincian']; ?></td>
              <td><center><?php echo $data['targetpersen']; ?>%</center></td>
              <td><?php echo $data['status']; ?></td>
              <td><?php echo date('d-m-Y', strtotime($data['targetselesai'])); ?></td>
              <td>
                <?php
                if ($data['targetpersen'] == 100 AND $data['tanggalupdate'] <= $data['targetselesai'] AND $data['targetselesai'] != '0000-00-00') {
                  echo "Tercapai Tepat Waktu";
                } else if ($data['targetpersen'] == 100 AND $data['tanggalupdate'] > $data['targetselesai'] AND $data['targetselesai'] != '0000-00-00') {
                  echo "Tidak Tercapai Tepat Waktu";
                } else {
                  echo "";
                }
                 ?>
              </td>
              <td>
                   <?php 
                      if ($data['approval'] == 'Diterima') {
                        echo "<b class='text-success'>".$data['approval']."</b>";
                      } else if ($data['approval'] == 'Ditolak')  {
                        echo "<b class='text-danger'>".$data['approval']." (".$data['alasan'].")</b>";
                      }
                  ?>
                 </td>
            </tr>

          <?php
          }
           } 
         } ?>
          </tbody>
        </table>
      </div>
      <br>
      <?php if($get != NULL) { ?>
       <p ><span class="font-weight-bold">Note : </span> Kolom Pencapaian akan terisi otomatis jika persentase sudah terisi sampai 100%.</p>
     <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<?php  
endforeach;
 ?>



 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})


  $("input[type=checkbox]").on("change", function(evt) {
    var setujui1 = $('input[id=setujui1]:checked');
    var setujui2 = $('input[id=setujui2]:checked');
    var setujui3 = $('input[id=setujui3]:checked');
    if (setujui1.length == 1 && setujui2.length == 1 && setujui3.length == 1) {
      $("button[id=setujui]").prop("disabled", false);
    } else {
      $("button[id=setujui]").prop("disabled", true);
    }
  });

  $(document).ready(function() {
    var cek = document.getElementById('num_disclaimer').value;
    console.log(cek);
    // alert(cek);

    if (cek == 0) {
      $('#disclaimer').modal('show');
    }
  });

   
   function clickTolak(id){
   console.log(id);
   $('#id_rincian').val(id);
   }

   function clickTarget(id){
   console.log(id);
   $('#id_rincian_target').val(id);
   }
</script>