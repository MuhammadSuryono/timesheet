<?php
error_reporting(0);
session_start();

require "koneksi.php";

if (!isset($_SESSION['nama_user'])) {
  header("location:login.php");
  // die('location:login.php');//jika belum login jangan lanjut
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Form Pengajuan Budget</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>

<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home.php">Budget-Ing</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="home.php">Home</a></li>
          <li><a href="list.php">List</a></li>
          <!-- <li><a href="history.php">History</a></li> -->
        </ul>

        <?php
        $pengaju = $_SESSION['nama_user'];
        $cari = mysqli_query($koneksi, "SELECT * FROM bpu WHERE pengaju ='$pengaju' AND persetujuan ='Belum Disetujui' OR pengaju ='$pengaju' AND persetujuan ='Pending'");
        $belbyr = mysqli_num_rows($cari);
        ?>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-inbox"></i><span class="label label-warning"><?= $belbyr ?></span></a>
            <ul class="dropdown-menu">
              <?php
              while ($wkt = mysqli_fetch_array($cari)) {
                $wktulang = $wkt['waktu'];
                $selectnoid = mysqli_query($koneksi, "SELECT * FROM pengajuan WHERE waktu='$wktulang'");
                $noid = mysqli_fetch_assoc($selectnoid);
                $kode = $noid['noid'];
                $project = $noid['nama'];
              ?>
                <li class="header"><a href="view-finance.php?code=<?= $kode ?>">Project <b><?= $project ?></b> BPU Belum Dibayar</a></li>
              <?php
              }
              ?>
            </ul>
          </li>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="ubahpassword.php"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['nama_user']; ?> (<?php echo $_SESSION['divisi']; ?>)</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
      </div>
    </div>
  </nav>

  <br /><br />

  <div class="container">

    <p>
      <h4> Saldo BPU :
        <?php
        $suser = $_SESSION['id_user'];
        $nuser = $_SESSION['nama_user'];
        $ceksaldo = mysqli_query($koneksi, "SELECT saldo FROM tb_user WHERE id_user='$suser'");
        $rcs = mysqli_fetch_assoc($ceksaldo);
        $pertama = $rcs['saldo'];

        $query2 = "SELECT sum(jumlah) AS sumi FROM bpu WHERE namapenerima='$nuser' AND status != 'Realisasi (Direksi)' AND statusbpu='UM'";
        $result2 = mysqli_query($koneksi, $query2);
        $row2 = mysqli_fetch_array($result2);

        $query3 = "SELECT sum(realisasi) AS sumreal FROM bpu WHERE namapenerima='$nuser' AND status ='Telah Di Bayar' AND statusbpu='UM' AND tanggalrealisasi IS NOT NULL";
        $result3 = mysqli_query($koneksi, $query3);
        $row3 = mysqli_fetch_array($result3);
        $sumreal = $row3['sumreal'];

        $kedua = $row2['sumi'];
        $ketiga = ($pertama + $sumreal) - $kedua;

        echo 'Rp. ' . number_format($ketiga, 0, '', ',');

        ?>
      </h4>
    </p>

    <br /><br />


    <!-- OUTSTANDING BPU UM -->
    <h5>Outstanding BPU UM </h5>
    <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
      <div class="panel-body no-padding">
        <table class="table table-striped">
          <thead>
            <tr class="warning">
              <th>No</th>
              <th>Nama</th>
              <th>Divisi</th>
              <th>Total Outstanding</th>
            </tr>
          </thead>

          <tbody>
            <?php
            include "koneksi.php";
            $i = 1;
            $divisi   = $_SESSION['divisi'];
            $username = $_SESSION['nama_user'];
            $hakakses = $_SESSION['hak_akses'];

            if ($hakakses == 'Manager') {
              $sql2 = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE divisi='$divisi' ORDER BY nama_user ASC");
            } else if ($hakakses == 'Field') {
              $sql2 = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE divisi LIKE '%FIELD%' ORDER BY nama_user ASC");
            } else {
              $sql2 = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE nama_user='$nuser'");
            }

            while ($e = mysqli_fetch_array($sql2)) {
            ?>
              <tr>
                <td scope="row"><?php echo $i++; ?></td>
                <td><?php echo $e['nama_user']; ?></td>
                <td><?php echo $e['divisi']; ?></td>
                <td>
                  <?php
                  $usernya = $e['nama_user'];
                  // $caribpunya = mysqli_query($koneksi, "SELECT
                  //                               SUM(bpu.jumlah) AS totaljumlah,
                  //                               SUM(bpu.realisasi) AS totalreal
                  //                             FROM
                  //                               bpu
                  //                             LEFT JOIN pengajuan ON bpu.waktu = pengajuan.waktu
                  //                             LEFT JOIN selesai ON bpu.waktu = selesai.waktu
                  //                             AND bpu.no = selesai.no
                  //                             WHERE
                  //                               bpu.namapenerima = '$usernya'
                  //                             AND bpu.status = 'Telah Di Bayar'
                  //                             AND bpu.statusbpu = 'UM'");
                  // $tt = mysqli_fetch_array($caribpunya);
                  // $totaljumlah  = $tt['totaljumlah'];
                  // $totalreal    = $tt['totalreal'];
                  // $totalnya     = $totaljumlah - $totalreal;
                  $getUm = mysqli_query($koneksi, "SELECT sum(jumlah) AS sumjum FROM bpu WHERE namapenerima='$usernya' AND status !='Realisasi (Direksi)' AND statusbpu IN ('UM', 'UM Burek')");
                  $um = mysqli_fetch_array($getUm);
                  // var_dump($um);
                  echo 'Rp. ' . number_format($um[0], 0, '', ',');
                  ?>
                </td>
                <?php
                $caribpunya2 = mysqli_query($koneksi, "SELECT
                                              pengajuan.noid AS kode,
                                              pengajuan.nama AS nama,
                                              bpu.no AS no,
                                              bpu.term AS term,
                                              bpu.jumlah AS jumlah,
                                              bpu.realisasi AS realisasi,
                                              pengajuan.jenis AS jenis
                                              FROM
                                                bpu
                                              LEFT JOIN pengajuan ON bpu.waktu = pengajuan.waktu
                                              LEFT JOIN selesai ON bpu.waktu = selesai.waktu
                                              AND bpu.no = selesai.no
                                              WHERE
                                                bpu.namapenerima = '$usernya'
                                              AND bpu.status = 'Telah Di Bayar'
                                              AND bpu.statusbpu = 'UM'");
                while ($cb = mysqli_fetch_array($caribpunya2)) {
                ?>
                  <td bgcolor="#8aad70">
                    Jenis : <b><?php echo $cb['jenis']; ?></b>
                    <br />
                    Project :
                    <b><a href="views.php?code=<?php echo $cb['kode']; ?>"><?php echo $cb['nama']; ?></a></b>
                    <br />
                    Item No : <b><?php echo $cb['no']; ?></b>
                    <br />
                    Term : <b><?php echo $cb['term']; ?></b>
                    <br />
                    Jumlah :
                    <br />
                    <b>
                      <?php
                      $jumlahnya     = $cb['jumlah'];
                      $realisasinya  = $cb['realisasi'];
                      $jadinya = $jumlahnya - $realisasinya;
                      echo 'Rp. ' . number_format($jadinya, 0, '', ',');
                      ?>
                    </b>
                  </td>
                <?php
                }
                ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div>
    <!-- //OUTSTANDING BPU UM -->

    <br /><br />

    <h5>Daftar Budget</h5>
    <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
      <div class="panel-body no-padding">
        <table class="table table-striped">
          <thead>
            <tr class="warning">
              <th>No</th>
              <th>Nama Project</th>
              <th>Jenis</th>
              <th>Tahun</th>
              <th>Nama Yang Mengajukan</th>
              <th>Divisi</th>
              <th>Action</th>
              <th>Status</th>
              <th>Pengajuan</th>
            </tr>
          </thead>

          <tbody>

            <?php
            include "koneksi.php";
            $i = 1;
            $divisi = $_SESSION['divisi'];
            $username = $_SESSION['nama_user'];
            $sql = mysqli_query($koneksi, "SELECT * FROM pengajuan WHERE pengaju='$username' AND status='Belum Di Ajukan' OR pengaju='$username' AND status='Belum Di Ajukan(Penambahan)'");
            while ($d = mysqli_fetch_array($sql)) {
            ?>
              <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td>
                  <?php
                  $waktu = $d['waktu'];
                  echo $d['nama'];
                  $carifile = mysqli_query($koneksi, "SELECT * FROM upload WHERE waktu='$waktu'");
                  if (mysqli_num_rows($carifile) < 1) {
                    echo "";
                  } else {
                    while ($cf = mysqli_fetch_array($carifile)) {
                      $gambar = $cf['gambar'];
                      echo " - ";
                      echo "<a href='uploads/$gambar'><i class='fa fa-file'></i></a>";
                    }
                  }
                  ?>
                </td>
                <td><?php echo $d['jenis']; ?></td>
                <td><?php echo $d['tahun']; ?></td>
                <td><?php echo $d['pengaju']; ?></td>
                <td><?php echo $d['divisi']; ?></td>
                <td><a href="view.php?code=<?php echo $d['noid']; ?>"><i class="fas fa-eye" title="VIEW"></i></a></td>
                <td><?php echo $d['status']; ?></td>
                <?php
                if ($_SESSION['divisi'] == 'GA' || $_SESSION['divisi'] == 'RE B1') {
                  echo "<td><a href='#myModal' class='btn btn-default btn-small' id='custId' data-toggle='modal' data-id=" . $d['noid'] . ">Ajukan</a></td>";
                } else if ($_SESSION['hak_page'] == 'Create') {
                  echo "<td><a href='#myModal' class='btn btn-default btn-small' id='custId' data-toggle='modal' data-id=" . $d['noid'] . ">Ajukan</a></td>";
                } else {
                  echo "<td><a href='#myModal' class='btn btn-default btn-small' id='custId' data-toggle='modal' data-id=" . $d['noid'] . ">Ajukan</a></td>";
                }
                ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div>

    <br /><br />

    <p>
      <b>KETENTUAN DALAM PEMBUATAN BUDGET ONLINE UNTUK PROJECT :</b><br>
      1. Membawa berkas pengajuan budget ke Bu Ina untuk di approval.<br>
      2. Upload budget yang sudah di approve tersebut untuk dapat membuat/ menambah item budget yang termasuk didalam budget project tersebut.<br>
      3. Budget tidak akan bisa dibuat apabila belum upload berkas pengajuan yang sudah di approve.<br>
      4. Klik Ajukan setelah item budget sudah diinput semua.<br>
      5. Request approval budget online yang sudah dibuat ke Bu Ina.<br>
    </p>

    <p>
      <b>KETENTUAN DALAM PEMBUATAN BPU BUDGET ONLINE :</b><br>
      1. Klik BPU di item budget yang akan diajukan<br>
      2. Isi BPU sesuai kebutuhan.<br>
      3. Upload file rinci ke BPU online yang akan dibuat.<br>
      4. BPU tidak akan bisa di submit bila belum upload file rincian di pengajuan BPU online.<br>
    </p>

    </br></br>

    <?php
    if ($_SESSION['hak_page'] == 'Create') {
      echo "<a href='home.php?page=1'><button type='button' class='btn btn-primary'>Tambah Project</button></a>";
    } else {
      echo "";
    }
    ?>

    </br></br>

    <?php

    include "isi.php";

    ?>

  </div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pengajuan</h4>
        </div>
        <div class="modal-body">
          <div class="fetched-data"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#myModal').on('show.bs.modal', function(e) {
        var rowid = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
          type: 'post',
          url: 'ajukan.php',
          data: 'rowid=' + rowid,
          success: function(data) {
            $('.fetched-data').html(data); //menampilkan data ke dalam modal
          }
        });
      });
    });
  </script>

</body>

</html>