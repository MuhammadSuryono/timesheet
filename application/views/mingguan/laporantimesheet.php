<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan Timesheet</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url('mingguan/laporantimesheet') ?>">Laporan Timesheet</a></div>
      </div>
    </div>


    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="section-body">
      <h2 class="section-title">Laporan Timesheet</h2>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Pilih Range Tanggal
            </div>
            <div class="card-body">

              <form class="form-inline" action="<?php echo base_url('mingguan/proseslaporan') ?>" method="POST">

                <input type="hidden" name="pencari" value="<?php echo $this->session->userdata('ses_username') ?>">

                <div class="form-group">
                  <label for="daritanggal">Dari Tanggal : </label>
                  <input type="date" class="form-control" id="daritanggal" name="daritanggal" required>
                </div>

                <div class="form-group">
                  <label for="sampaitanggal">Sampai Tanggal: </label>
                  <input type="date" class="form-control" id="sampaitanggal" name="sampaitanggal" required>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
              </form>

            </div>
          </div>
        </div>
      </div>

      <?php
      // error_reporting(0);

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

      //Example:
      $daritanggal = $tglterakhir['daritanggal'];
      $sampaitanggal = $tglterakhir['sampaitanggal'];
      $db2 = $this->load->database('database_kedua', TRUE);
      $carilibur = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan = 'N'")->result_array();
      $caricutibersama = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan='Y'")->result_array();
      $liburnya = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal'")->result_array();

      $holidays = array();
      foreach ($carilibur as $key) {
        // // code...
        // echo $key['tanggal'];
        $holidays[] = $key['tanggal'];
      }

      $cutibersama = array();
      foreach ($caricutibersama as $cb) {
        $cutibersama[] = $cb['tanggal'];
      }

      $harilibur = array();
      foreach ($liburnya as $lb) {
        $harilibur[] = $lb['tanggal'];
      }



      // $holidays=array("2008-12-25","2008-12-26","2009-01-01");
      // $holidays = array();
      // while($cl = mysqli_fetch_assoc($carilibur)){
      // $holidays[] = $cl['tanggal'];
      // }

      $harikerja = getWorkingDays("$daritanggal", "$sampaitanggal", $harilibur);
      // echo getWorkingDays("$daritanggal","$sampaitanggal",$holidays);
      ?>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Laporan Timesheet <?php echo $tglterakhir['daritanggal'] ?> s/d <?php echo $tglterakhir['sampaitanggal'] ?>
            </div>
            <div class="card-body">

              <div class="table-responsive">
                <table id="example2" class="table table-bordered">
                  <thead>
                    <tr style="background-color:salmon;">
                      <th>No</th>
                      <th>Nik</th>
                      <th>Nama</th>
                      <th>Divisi</th>
                      <th>Total Hari Kerja</th>
                      <!-- <th>Total Isi LKH</th> -->
                      <th>Total SDSD/Cuti/Libur Nasional</th>
                      <th>Cuti Bersama</th>
                      <th>Unpaid Leave</th>
                      <!-- <th>Total LKH</th> -->
                      <th>Tidak Isi LKH</th>
                      <th>Total STSD</th>
                      <th>Total Pemotongan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // error_reporting(0);
                    $i = 1;
                    foreach ($namanya as $nm) {
                    ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $nm['nik'] ?></td>
                        <td><a data-toggle="collapse" href="#a<?php echo $nm['id_user'] ?>"><?php echo $nm['nama_user'] ?></a> </td>
                        <td><?php echo $nm['divisi'] ?></td>

                        <!-- Total Hari Kerja -->
                        <td><?php echo $harikerja; ?></td>

                        <!-- Total Isi LKH -->
                        <!-- <td> -->
                        <?php
                        $daritanggal = $tglterakhir['daritanggal'];
                        $sampaitanggal = $tglterakhir['sampaitanggal'];
                        $jmlhari = $this->db->query("SELECT
                                                                      *
                                                                  FROM tugasharian
                                                                  WHERE username='$nm[id_user]'
                                                                  AND tanggal BETWEEN '$daritanggal'
                                                                  AND '$sampaitanggal'
                                                                  GROUP BY tanggal")->num_rows();
                        // echo $jmlhari;
                        ?>
                        <!-- </td> -->

                        <!-- Total SDSD/Cuti/LiburNasional -->
                        <td>
                          <?php
                          $ic = 0;
                          $carizin = $db2->query("SELECT COUNT(no) AS jmlijin FROM daterange_izin WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]' AND jenis='Sakit Dengan Surat Dokter'")->row_array();
                          $ic += $carizin['jmlijin'];

                          $caricuti = $db2->query("SELECT COUNT(no) AS jmlcuti FROM daterange_cuti WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]'")->row_array();
                          $ic += $caricuti['jmlcuti'];

                          // $ic += count($holidays);
                          ?>
                          <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar SDSD /Cuti / Libur Nasional" <?php
                                                                                                                                                                            $sdsdnya = $db2->query("SELECT * FROM daterange_izin WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]' AND jenis='Sakit Dengan Surat Dokter'")->result_array();
                                                                                                                                                                            $cutinya = $db2->query("SELECT * FROM daterange_cuti WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]'")->result_array();
                                                                                                                                                                            ?> data-content="<?php foreach ($cutinya as $ct) {
                                                                                                                                                                                                echo "<table class='bordered'>";
                                                                                                                                                                                                echo "<tr>";
                                                                                                                                                                                                echo "<td>";
                                                                                                                                                                                                echo $ct['tanggal'];
                                                                                                                                                                                                echo "</td>";
                                                                                                                                                                                                echo "<td>";
                                                                                                                                                                                                echo "Cuti";
                                                                                                                                                                                                echo "</td>";
                                                                                                                                                                                                echo "</tr>";
                                                                                                                                                                                                echo "</table>";
                                                                                                                                                                                              } ?>
                                                   <?php foreach ($sdsdnya as $sd) {
                                                      echo "<table class='bordered'>";
                                                      echo "<tr>";
                                                      echo "<td>";
                                                      echo $sd['tanggal'];
                                                      echo "</td>";
                                                      echo "<td>";
                                                      echo $sd['jenis'];
                                                      echo "</td>";
                                                      echo "</tr>";
                                                      echo "</table>";
                                                    } ?>
                                                   <?php foreach ($carilibur as $cabur) {
                                                      echo "<table class='bordered'>";
                                                      echo "<tr>";
                                                      echo "<td>";
                                                      echo $cabur['tanggal'];
                                                      echo "</td>";
                                                      echo "<td>";
                                                      echo $cabur['keterangan'];
                                                      echo "</td>";
                                                      echo "</tr>";
                                                      echo "</table>";
                                                    } ?>
                                                    ">
                            <?php echo $ic; ?></a>
                        </td>

                        <!-- Total Cuti Bersama -->
                        <td>
                          <?php
                          //echo count($cutibersama);

                          ?>
                          <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar Cuti Bersama" data-content="<?php foreach ($caricutibersama as $cacuber) {
                                                                                                                                                                            echo "<table class='bordered'>";
                                                                                                                                                                            echo "<tr>";
                                                                                                                                                                            echo "<td>";
                                                                                                                                                                            echo $cacuber['tanggal'];
                                                                                                                                                                            echo "</td>";
                                                                                                                                                                            echo "<td>";
                                                                                                                                                                            echo $cacuber['keterangan'];
                                                                                                                                                                            echo "</td>";
                                                                                                                                                                            echo "</tr>";
                                                                                                                                                                            echo "</table>";
                                                                                                                                                                          } ?>"><?php echo count($cutibersama);; ?></a>

                        </td>

                        <!-- Total Unpaid Leave -->
                        <td>
                          <?php
                          $cariunpaid = $db2->query("SELECT * FROM daterange_unpaid WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]'")->result_array();
                          ?>
                          <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar Cuti Bersama" data-content="<?php
                                                                                                                                                                          $totalunpaid = array();
                                                                                                                                                                          foreach ($cariunpaid as $caun) {
                                                                                                                                                                            $totalunpaid[] = $caun['tanggal'];
                                                                                                                                                                            echo "<table class='bordered'>";
                                                                                                                                                                            echo "<tr>";
                                                                                                                                                                            echo "<td>";
                                                                                                                                                                            echo $caun['tanggal'];
                                                                                                                                                                            echo "</td>";
                                                                                                                                                                            echo "<td>";
                                                                                                                                                                            echo "Unpaid Leave";
                                                                                                                                                                            echo "</td>";
                                                                                                                                                                            echo "</tr>";
                                                                                                                                                                            echo "</table>";
                                                                                                                                                                          } ?>"><?php echo count($totalunpaid); ?></a>

                        </td>

                        <!-- Total LKH -->
                        <!-- <td><?php //echo $jmlhari + $ic + count($cutibersama);
                                  ?></td> -->

                        <!-- Tidak Isi LKH -->
                        <td>
                          <?php
                          $tidakisilkh = $harikerja - $jmlhari - count($totalunpaid) - count($cutibersama) - $ic;
                          echo $tidakisilkh;
                          ?>
                        </td>

                        <!-- Total STSD -->
                        <td>
                          <?php
                          $carizinstsd = $db2->query("SELECT COUNT(no) AS jmlijin FROM daterange_izin WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]' AND jenis='Sakit Tanpa Surat Dokter'")->row_array();
                          echo $carizinstsd['jmlijin'];
                          ?>
                        </td>

                        <!-- Total Pemotongan -->
                        <td>
                          <?php
                          $totalpotong = count($totalunpaid) + $tidakisilkh + $carizinstsd['jmlijin'];
                          echo $totalpotong;
                          ?>
                        </td>

                      </tr>
                      <tr id="a<?php echo $nm['id_user'] ?>" class="panel-collapse collapse">
                        <td colspan='9'>

                          <table class='table table-bordered'>
                            <thead>
                              <tr style='background-color:antiquewhite;'>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Project</th>
                                <th>Keterangan</th>
                                <th>FileUpload</th>
                                <th>Rincian Pekerjaan</th>
                                <th>Persentase</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $rangetanggal = $this->db->query("SELECT
                                                                      *
                                                                  FROM tugasharian
                                                                  WHERE username='$nm[id_user]'
                                                                  AND tanggal BETWEEN '$daritanggal'
                                                                  AND '$sampaitanggal'
                                                                  GROUP BY tanggal")->result_array();
                              $n = 1;

                              // if(empty($rangetanggal)){
                              //   echo "Tidak ada Data";
                              // }else{

                              foreach ($rangetanggal as $rt) {
                                $itung = $this->db->query("SELECT COUNT(id_rincian) AS rincnya FROM tugasharian WHERE tanggal='$rt[tanggal]' AND username='$nm[id_user]'")->row_array();
                                $jmlitung = $itung['rincnya'] + 1;
                              ?>
                                <tr style='background-color:#fdffde;'>
                                  <td rowspan="<?php echo $jmlitung ?>"><?php echo $n++; ?></td>
                                  <td rowspan="<?php echo $jmlitung ?>"><?php echo $rt['tanggal'] ?></td>
                                </tr>
                                <?php
                                $caririnc = $this->db->query("SELECT
                                                              	a.*, b.rincian AS rincinya
                                                              FROM
                                                              	tugasharian a
                                                              JOIN rincian b ON a.idtkmdiv = b.idtkmdiv AND a.id_rincian = b.id_rincian
                                                              WHERE tanggal='$rt[tanggal]'
                                                              AND username='$nm[id_user]'")->result_array();
                                foreach ($caririnc as $cr) {
                                ?>
                                  <tr>
                                    <td><?php echo $cr['project'] ?></td>
                                    <td><?php echo $cr['keterangan'] ?></td>
                                    <td>
                                      <?php
                                      if ($cr['fileupload'] == '' or $cr['fileupload'] == NULL) {
                                        echo "-";
                                      } else {
                                      ?>
                                        <a href="<?php echo base_url('dist/upload/') ?><?php echo $cr['fileupload'] ?>" target="_blank"><i class="fa fa-file"></i> <?php echo $cr['fileupload'] ?></a>
                                      <?php
                                      }
                                      ?>
                                    </td>
                                    <td><?php echo $cr['rincinya'] ?></td>
                                    <td><?php echo $cr['persentase'] ?></td>
                                  </tr>
                                <?php
                                }
                                ?>
                              <?php
                              }
                              ?>
                            </tbody>
                          </table>
                      </tr>
                    <?php
                    }
                    // }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- //Tabel Telat -->

            </div>
          </div>
        </div>
      </div>



    </div>
  </section>
</div>

<script>
  $(document).ready(function() {
    $('[data-toggle="popover"]').popover();
  });
</script>