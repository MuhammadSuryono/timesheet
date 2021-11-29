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

$db2 = $this->load->database('database_kedua', TRUE);

$arrMonth = ['January', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table#main,
        table#main th,
        table#main td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table#main {
            text-align: center;
            margin-bottom: 30px;
        }

        table#head {
            width: 100%;
            border: 1px solid black;
            margin-bottom: 10px;
        }

        table#head tr td {
            text-align: center;
        }

        table#head tr td span {
            line-height: 2;
            font-weight: bold;
        }

        table#sign {
            width: 100%;
            text-align: center;
        }

        table#sign thead td {
            width: 33.3%;
        }

        table#sign tbody td {
            padding-top: 70px;
        }

        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        .footer-doc {
            position: absolute;
            bottom: -20px;
            font-size: 12px;
            color: #111;
            text-align: left
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
    <table id="head">
        <tr>
            <td>


                <span>Laporan Timesheet Karyawan <br> Periode <?= (date('d', strtotime($daritanggal)) . ' ' . $arrMonth[(int)date('m', strtotime($daritanggal)) - 1] . ' ' . date('Y', strtotime($daritanggal))); ?> s.d. <?= (date('d', strtotime($sampaitanggal)) . ' ' . $arrMonth[(int)date('m', strtotime($sampaitanggal)) - 1] . ' ' . date('Y', strtotime($sampaitanggal))); ?></span>
            </td>
        </tr>
    </table>

    <table id="main">
        <thead>
            <tr>
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
            foreach ($user as $nm) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $nm['nik']; ?></td>
                    <td><?php echo $nm['nama_user'] ?></td>
                    <td><?php echo $nm['divisi']; ?></td>

                    <!-- Total Hari Kerja -->
                    <td>
                        <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $harilibur = array();
                        foreach ($dataHariLibur as $cln) {
                            $harilibur[] = $cln['tanggal'];
                        }

                        if ($nm['tgl_masuk'] == null) $nm['tgl_masuk'] = $daritanggal;

                        $date1 = date_create((string)$nm['tgl_masuk']);
                        $date2 = date_create((string)$daritanggal);
                        $startDate =  (date_diff($date1, $date2)->format("%R") == "-")  ? (string)$nm['tgl_masuk'] : (string)$daritanggal;

                        $date1 = date_create((string)date('Y-m-d'));
                        $date2 = date_create((string)$sampaitanggal);
                        $untilDate = !(date_diff($date1, $date2)->format("%R") == "-")  ? (string)date('Y-m-d') : (string)$sampaitanggal;

                        $harikerja = getWorkingDays($startDate, $untilDate, $harilibur);

                        echo $harikerja;

                        ?>
                    </td>
                    <!-- //Total Hari Kerja -->

                    <!-- Total SDSD -->
                    <td>
                        <?php
                        $izin = 0;
                        $carisdsd = $db2->query("SELECT * FROM daterange_izin WHERE tanggal BETWEEN '$startDate' AND '$untilDate' AND jenis='Sakit Dengan Surat Dokter' AND username='$nm[id_user]'")->result_array();

                        $arrsdsd = array();
                        foreach ($carisdsd as $sd) {
                            $arrsdsd[] = $sd['tanggal'];
                        }

                        $izin += count($arrsdsd);

                        ?>
                        <p><?= $izin; ?></p>
                    </td>
                    <!-- //Total SDSD -->

                    <!-- Total Cuti -->
                    <td>
                        <?php
                        $cuti = 0;
                        $caricuti = $db2->query("SELECT *, tb_mohoncuti.keterangan FROM daterange_cuti LEFT JOIN tb_mohoncuti ON daterange_cuti.no_cuti = tb_mohoncuti.no_cuti WHERE tanggal BETWEEN '$startDate' AND '$untilDate' AND username='$nm[id_user]' AND tb_mohoncuti.keterangan!='Cuti Bersama'")->result_array();

                        $arrcuti = array();
                        foreach ($caricuti as $cc) {
                            $arrcuti[] = $cc['tanggal'];
                        }

                        $cuti += count($arrcuti);
                        ?>

                        <p><?= $cuti ?></p>
                    </td>
                    <!-- //Cuti -->

                    <!-- Total SDSD/Cuti/LiburNasional -->
                    <td>
                        <?php
                        $libnas = 0;

                        $hariLibur = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$startDate' AND '$untilDate' AND tambahan = 'N'")->result_array();

                        $arrlibur = array();
                        foreach ($hariLibur as $cln) {
                            $arrlibur[] = $cln['tanggal'];
                        }

                        $libnas += count($arrlibur);
                        ?>

                        <p><?= $libnas ?></p>
                    </td>
                    <!-- //Total Libur Nasional -->

                    <!-- Total STSD -->
                    <td>
                        <?php
                        $caristsd = $db2->query("SELECT * FROM daterange_izin WHERE tanggal BETWEEN '$startDate' AND '$untilDate' AND username='$nm[id_user]' AND jenis='Sakit Tanpa Surat Dokter'")->result_array();

                        $arrstsd = array();
                        foreach ($caristsd as $cstsd) {
                            $arrstsd[] = $cstsd['tanggal'];
                        }
                        ?>
                        <p><?= count($arrstsd) ?></p>
                    </td>
                    <!-- //Total STSD -->

                    <!-- Total Cuti Bersama -->
                    <td>
                        <?php
                        $caricutibersama = $db2->query("SELECT * FROM kalender WHERE tanggal BETWEEN '$startDate' AND '$untilDate' AND tambahan='Y'")->result_array();
                        $cutibersama_pengajuan = $db2->query("SELECT *, tb_mohoncuti.keterangan FROM daterange_cuti LEFT JOIN tb_mohoncuti ON daterange_cuti.no_cuti = tb_mohoncuti.no_cuti WHERE tanggal BETWEEN '$startDate' AND '$untilDate' AND username='$nm[id_user]' AND tb_mohoncuti.keterangan='Cuti Bersama'")->result_array();

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

                            if ($cuber > 0) {
                        ?>
                                <p><?php echo $cuber; ?></p>
                        <?php
                            } else {
                                echo "<a>&#10007</a>";
                            }
                        } else {
                            echo count($arrcuber);
                        }
                        ?> </td> <!-- //Total Cuti Bersama -->

                    <!-- Total Unpaid -->
                    <td>
                        <?php
                        $unpaidcuber = 0;
                        $cariunpaid = $db2->query("SELECT * FROM daterange_unpaid WHERE tanggal BETWEEN '$startDate' AND '$untilDate' AND username='$nm[id_user]'")->result_array();

                        $arrunpaid = array();
                        foreach ($cariunpaid as $cu) {
                            $arrunpaid[] = $cu['tanggal'];
                        }

                        $unpaidcuber += count($arrunpaid);

                        if (count($arrcuber) > 0) {
                        ?>
                            <p><?php echo $unpaidcuber; ?></p>
                        <?php
                        } else {
                            $unpaidcuber += $tidakcuber;
                        ?>
                            <p>
                                <?php echo $unpaidcuber; ?></p>
                        <?php
                        }
                        ?>
                    </td>
                    <!-- //Total Unpaid -->

                    <!-- Tidak Isi LKH -->
                    <td>
                        <?php
                        $cariisilkh = $this->db->query("SELECT
                                                            *
                                                        FROM tugasharian
                                                        WHERE username='$nm[id_user]'
                                                        AND tanggal BETWEEN '$startDate'
                                                        AND '$untilDate'
                                                        GROUP BY tanggal")->num_rows();
                        if (count($arrcuber) > 0) {
                            $tidakisilkh = $harikerja - $cariisilkh - $izin - $cuti - $unpaidcuber - $cuber - count($arrstsd);
                        } else {
                            $tidakisilkh = $harikerja - $cariisilkh - $izin - $cuti - $unpaidcuber - count($arrstsd);
                        };

                        if ($tidakisilkh < 0) $tidakisilkh = 0;

                        echo $tidakisilkh;
                        ?>
                    </td>
                    <!-- // Tidak Isi LKH -->

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
                    <td><?= $teguran; ?></td>
                    <!-- // Teguran -->


                    <!-- Total Pemotongan -->
                    <td>
                        <?php
                        if ($tidakisilkh >= 3) {
                            $pemotongan = $tidakisilkh + $unpaidcuber;
                        } else {
                            $pemotongan = $unpaidcuber;
                        }
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
            <?php
            }
            ?>

        </tbody>
    </table>

    <table id="sign">
        <thead>
            <tr>
                <td id="created-by">
                    <p><span>Dibuat Oleh</span></p>
                </td>
                <td></td>
                <td id="approve-by">
                    <p><span>Menyetujui</span></p>
                </td>
            </tr>
        </thead>
        <tbody class="clearfix">
            <tr>
                <td id="created-by-body">
                    <p><span>Human Capital</span></p>
                </td class="clearfix">
                <td></td>
                <td id="approved-by-body">
                    <p><span>Management</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <span class="footer-doc">Dokumen ini dibuat melalui Aplikasi Timesheetwfh. Kode Dokumen: <?= $kode_dokumen[0]; ?></span>

</body>

</html>