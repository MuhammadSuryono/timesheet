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

$daritanggal = $tglterakhir['daritanggal'];
$sampaitanggal = $tglterakhir['sampaitanggal'];
$db2 = $this->load->database('database_kedua', TRUE);
?>


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

              <form class="form-inline" action="" method="POST">

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

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Laporan Timesheet <?php echo $daritanggal; ?> s/d <?php echo $sampaitanggal; ?>
            </div>
            <div class="card-body">

              <div class="table-responsive">
                <table id="example2" class="table table-bordered">
                  <thead>
                    <tr style="background-color:#40E0D0;">
                      <th>No.</th>
                      <th>Nik</th>
                      <th>Nama</th>
                      <th>Divisi</th>
                      <th>Total Hari Kerja</th>
                      <th>Total SDSD</th>
                      <th>Total Cuti</th>
                      <th>Total Libur Nasional</th>
                      <th>Total STSD</th>
                      <th>Cuti Bersama</th>
                      <th>Unpaid Leave</th>
                      <th>Tidak Isi LKH</th>
                      <th>Teguran</th>
                      <th>Total Pemotongan</th>
                      <th>Total Hari Kerja Dibayarkan</th>
                      <th>Keterangan Unpaid Leave</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    // var_dump($data);
                    foreach ($namanya as $nm) {
                    ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $nm['nik']; ?></td>
                        <td><a data-toggle="collapse" href="#a<?php echo $nm['id_user'] ?>"><?php echo $nm['nama_user'] ?></a></td>
                        <td><?php echo $nm['divisi']; ?></td>

                        <!-- Total Hari Kerja -->
                        <td>
                          <?php
                          date_default_timezone_set('Asia/Jakarta');
                          $cariliburnasional = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan = 'N'")->result_array();

                          $harilibur = array();
                          foreach ($cariliburnasional as $cln) {
                            $harilibur[] = $cln['tanggal'];
                          }

                          $date1 = date_create((string)$nm['tgl_masuk']);
                          $date2 = date_create((string)$daritanggal);
                          $dateStatus = date_diff($date1, $date2)->format("%R");

                          if ($dateStatus == "-") $startDate = (string)$nm['tgl_masuk'];
                          else $startDate = (string)$daritanggal;
                          // echo $startDate;

                          if ($nm['tgl_masuk']) $harikerja = getWorkingDays($startDate, (string)$sampaitanggal, $harilibur);
                          else $harikerja = 0;

                          echo $harikerja;

                          ?>
                        </td>
                        <!-- //Total Hari Kerja -->

                        <!-- Total SDSD -->
                        <td>
                          <?php
                          $izin = 0;
                          $carisdsd = $db2->query("SELECT * FROM daterange_izin WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND jenis='Sakit Dengan Surat Dokter' AND username='$nm[id_user]'")->result_array();

                          $arrsdsd = array();
                          foreach ($carisdsd as $sd) {
                            $arrsdsd[] = $sd['tanggal'];
                          }

                          $izin += count($arrsdsd);

                          ?>

                          <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar SDSD" <?php
                                                                                                                                                    $sdsdnya = $db2->query("SELECT * FROM daterange_izin WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]' AND jenis='Sakit Dengan Surat Dokter'")->result_array();

                                                                                                                                                    ?> data-content="
                                         <?php foreach ($carisdsd as $sd) {
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

                                          ">
                            <?php echo $izin; ?></a>
                        </td>
                        <!-- //Total SDSD -->

                        <!-- Total Cuti -->
                        <td>
                          <?php
                          $cuti = 0;
                          $caricuti = $db2->query("SELECT *, tb_mohoncuti.keterangan FROM daterange_cuti LEFT JOIN tb_mohoncuti ON daterange_cuti.no_cuti = tb_mohoncuti.no_cuti WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]' AND tb_mohoncuti.keterangan!='Cuti Bersama'")->result_array();

                          $arrcuti = array();
                          foreach ($caricuti as $cc) {
                            $arrcuti[] = $cc['tanggal'];
                          }

                          $cuti += count($arrcuti);
                          ?>

                          <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar Cuti" <?php
                                                                                                                                                    $cutinya = $db2->query("SELECT *, tb_mohoncuti.keterangan FROM daterange_cuti LEFT JOIN tb_mohoncuti ON daterange_cuti.no_cuti = tb_mohoncuti.no_cuti WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]' AND tb_mohoncuti.keterangan!='Cuti Bersama'")->result_array();
                                                                                                                                                    ?> data-content="<?php foreach ($caricuti as $ct) {
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
                                          ">
                            <?php echo $cuti; ?></a>
                        </td>
                        <!-- //Cuti -->

                        <!-- Total SDSD/Cuti/LiburNasional -->
                        <td>
                          <?php
                          $libnas = 0;

                          $arrlibur = array();
                          foreach ($cariliburnasional as $cln) {
                            $arrlibur[] = $cln['tanggal'];
                          }

                          $libnas += count($arrlibur);
                          ?>

                          <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Libur Nasional" data-content="
                                         <?php foreach ($cariliburnasional as $cabur) {
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
                            <?php echo $libnas; ?></a>
                        </td>
                        <!-- //Total Libur Nasional -->

                        <!-- Total STSD -->
                        <td>
                          <?php
                          $caristsd = $db2->query("SELECT * FROM daterange_izin WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]' AND jenis='Sakit Tanpa Surat Dokter'")->result_array();

                          $arrstsd = array();
                          foreach ($caristsd as $cstsd) {
                            $arrstsd[] = $cstsd['tanggal'];
                          }
                          ?>

                          <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar STSD" data-content="<?php foreach ($caristsd as $cstsd) {
                                                                                                                                                                    echo "<table class='bordered'>";
                                                                                                                                                                    echo "<tr>";
                                                                                                                                                                    echo "<td>";
                                                                                                                                                                    echo $cstsd['tanggal'];
                                                                                                                                                                    echo "</td>";
                                                                                                                                                                    echo "<td>";
                                                                                                                                                                    echo $cstsd['jenis'];
                                                                                                                                                                    echo "</td>";
                                                                                                                                                                    echo "</tr>";
                                                                                                                                                                    echo "</table>";
                                                                                                                                                                  } ?>
                                        ">
                            <?php echo count($arrstsd); ?></a>
                        </td>
                        <!-- //Total STSD -->

                        <!-- Total Cuti Bersama -->
                        <td>
                          <?php
                          $caricutibersama = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND tambahan='Y'")->result_array();
                          $cutibersama_pengajuan = $db2->query("SELECT *, tb_mohoncuti.keterangan FROM daterange_cuti LEFT JOIN tb_mohoncuti ON daterange_cuti.no_cuti = tb_mohoncuti.no_cuti WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]' AND tb_mohoncuti.keterangan='Cuti Bersama'")->result_array();

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

                          $cekcutinya = $db2->query("SELECT * FROM tb_pegawai WHERE nip='$nm[id_user]'")->row_array();

                          $hakallcuti = $cekcutinya['hak_cuti_tahunan'] + $cekcutinya['hak_cuti_tahunlalu'] + $cekcutinya['hak_cuti_dispensasi'];

                          if (count($arrcuber) > 0) {
                            $cekcutinya = $db2->query("SELECT * FROM tb_pegawai WHERE nip='$nm[id_user]'")->row_array();
                            $hakallcuti = $cekcutinya['hak_cuti_tahunan'] + $cekcutinya['hak_cuti_tahunlalu'] + $cekcutinya['hak_cuti_dispensasi'];

                            //if($hakallcuti >= count($arrcuber)){
                            if ($cuber > 0) {
                          ?>
                              <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar Cuti Bersama" data-content="<?php foreach ($caricutibersama as $ccb) {
                                                                                                                                                                                echo "<table class='bordered'>";
                                                                                                                                                                                echo "<tr>";
                                                                                                                                                                                echo "<td>";
                                                                                                                                                                                echo $ccb['tanggal'];
                                                                                                                                                                                echo "</td>";
                                                                                                                                                                                echo "<td>";
                                                                                                                                                                                echo $ccb['keterangan'];
                                                                                                                                                                                echo "</td>";
                                                                                                                                                                                echo "</tr>";
                                                                                                                                                                                echo "</table>";
                                                                                                                                                                              } ?>
                                          ">
                                <?php //$cuber = count($arrcuber);
                                echo $cuber; ?></a>
                          <?php
                            } else {
                              echo "<a>&#10007</a>";
                            }
                          } else {
                            echo count($arrcuber);
                          }
                          ?>
                        </td>
                        <!-- //Total Cuti Bersama -->

                        <!-- Total Unpaid -->
                        <td bgcolor="#F08080">
                          <?php
                          $unpaidcuber = 0;
                          $cariunpaid = $db2->query("SELECT * FROM daterange_unpaid WHERE tanggal BETWEEN '$daritanggal' AND '$sampaitanggal' AND username='$nm[id_user]'")->result_array();

                          $arrunpaid = array();
                          foreach ($cariunpaid as $cu) {
                            $arrunpaid[] = $cu['tanggal'];
                          }

                          $unpaidcuber += count($arrunpaid);

                          if (count($arrcuber) > 0) {
                          ?>
                            <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar Unpaid" data-content="<?php foreach ($cariunpaid as $cun) {
                                                                                                                                                                        echo "<table class='bordered'>";
                                                                                                                                                                        echo "<tr>";
                                                                                                                                                                        echo "<td>";
                                                                                                                                                                        echo $cun['tanggal'];
                                                                                                                                                                        echo "</td>";
                                                                                                                                                                        echo "<td>";
                                                                                                                                                                        echo "Unpaid Leave";
                                                                                                                                                                        echo "</td>";
                                                                                                                                                                        echo "</tr>";
                                                                                                                                                                        echo "</table>";
                                                                                                                                                                      } ?>
                                        ">
                              <?php echo $unpaidcuber; ?></a>
                          <?php
                          } else {
                            $unpaidcuber += $tidakcuber;
                          ?>
                            <a tabindex="0" class="btn" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="Daftar Unpaid" data-content="<?php foreach ($cariunpaid as $cun) {
                                                                                                                                                                        echo "<table class='bordered'>";
                                                                                                                                                                        echo "<tr>";
                                                                                                                                                                        echo "<td>";
                                                                                                                                                                        echo $cun['tanggal'];
                                                                                                                                                                        echo "</td>";
                                                                                                                                                                        echo "<td>";
                                                                                                                                                                        echo "Unpaid Leave";
                                                                                                                                                                        echo "</td>";
                                                                                                                                                                        echo "</tr>";
                                                                                                                                                                        echo "</table>";
                                                                                                                                                                      } ?>
                                           <?php foreach ($caricutibersama as $cacuber) {
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
                                            } ?>
                                          ">
                              <?php echo $unpaidcuber; ?></a>
                          <?php
                          }
                          ?>
                        </td>
                        <!-- //Total Unpaid -->

                        <!-- Tidak Isi LKH -->
                        <td bgcolor="#F08080">
                          <?php
                          $cariisilkh = $this->db->query("SELECT
                                                            *
                                                        FROM tugasharian
                                                        WHERE username='$nm[id_user]'
                                                        AND tanggal BETWEEN '$daritanggal'
                                                        AND '$sampaitanggal'
                                                        GROUP BY tanggal")->num_rows();

                          if (count($arrcuber) > 0) {
                            $tidakisilkh = $harikerja - $cariisilkh - $izin - $cuti - $libnas - $unpaidcuber - $cuber - count($arrstsd);
                          } else {
                            $tidakisilkh = $harikerja - $cariisilkh - $izin - $cuti - $libnas - $unpaidcuber - count($arrstsd);
                          };

                          if ($tidakisilkh < 0) $tidakisilkh = 0;

                          /*if ($tidakisilkh < 0) {
                            $tidakisilkh = 0;
                          }*/

                          echo $tidakisilkh;
                          ?>
                        </td>
                        <!-- // Tidak Isi LKH -->

                        <!-- Tambahan Adam Santoso Total Teguran clone dari Dashboard -->
                        <?php
                        if ($tidakisilkh <= 0) {
                          $teguran = '0';
                        } else if ($tidakisilkh == 1) {
                          $teguran = 'Teguran 1';
                        } else if ($tidakisilkh == 2) {
                          $teguran = 'Teguran 2';
                        } else if ($tidakisilkh >= 3) {
                          $teguran = 'Teguran 3';
                        }
                        ?>
                        <td bgcolor="#F08080"><?= $teguran; ?></td>
                        <!-- // Teguran -->


                        <!-- Total Pemotongan -->
                        <td bgcolor="#F08080">
                          <?php
                          $pemotongan = $tidakisilkh + $unpaidcuber;
                          echo $pemotongan;
                          ?>
                        </td>
                        <!-- //Total Pemotongan -->

                        <!-- Total Hari Kerja Dibayarkan-->
                        <td>
                          <?php
                          $totalbayar = $harikerja - $pemotongan;
                          echo $totalbayar;
                          ?>
                        </td>
                        <!-- //Total hari Kerja Dibayarkan-->

                        <!-- Keterangan -->
                        <td>

                          <?php if ($cuber > 0) {
                            foreach ($cariunpaid as $cun) {
                              echo "<table class='bordered'>";
                              echo "<tr>";
                              echo "<td>";
                              echo $cun['tanggal'];
                              echo "</td>";
                              echo "<td>";
                              echo "Unpaid Leave";
                              echo "</td>";
                              echo "</tr>";
                              echo "</table>";
                            }
                          } else {
                            foreach ($cariunpaid as $cun) {
                              echo "<table class='bordered'>";
                              echo "<tr>";
                              echo "<td>";
                              echo $cun['tanggal'];
                              echo "</td>";
                              echo "<td>";
                              echo "Unpaid Leave";
                              echo "</td>";
                              echo "</tr>";
                              echo "</table>";
                            }
                            foreach ($caricutibersama as $cacuber) {
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
                            }
                          } ?>
                        </td>

                      </tr>

                      <!-- Table Collapse-->
                      <tr id="a<?php echo $nm['id_user'] ?>" class="panel-collapse collapse">
                        <td colspan="9">
                          <table>
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
                        </td>
                      </tr>
                      <!-- //Table Collapse-->

                    <?php
                    }
                    ?>

                  </tbody>
                </table>
              </div><!-- Table Responsive -->

            </div><!-- //Card Body -->
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