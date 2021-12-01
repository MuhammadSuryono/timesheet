<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?php echo base_url('dashboard')?>">MRI TimeSheet WFH</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo base_url('dashboard')?>">MRI</a>
    </div>
    <ul class="sidebar-menu">

      <li class="menu-header">Dashboard</li>
      <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('dashboard')?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      <li ><a class="nav-link" type="button" href="#" data-toggle="modal" data-target="#disclaimer2"><i class="fas fa-exclamation-circle"></i> <span>Disclaimer</span></a></li>

      <!-- <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Struktur</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?php// echo base_url('struktur/management')?>">Management</a></li> -->
          <!-- <li><a class="nav-link" href="layout-default.html">Divisi</a></li> -->
        <!-- </ul>
      </li> -->

      <?php
      if($this->session->userdata('ses_akses') != 'Direksi'):
       ?>
      <li class="menu-header">Pekerjaan</li>
      <li class="dropdown <?php echo $this->uri->segment(1) == 'mingguan' ? 'active': '' ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Target Kerja</span></a>
        <ul class="dropdown-menu">
          <?php
          if($this->session->userdata('ses_akses') == 'Manager' OR $this->session->userdata('ses_divisi') == 'SUB FINANCE'){
          ?>
          <li class="<?php echo $this->uri->segment(2) == 'waitinglist' ? 'active': '' ?> "><a class="nav-link" href="<?php echo base_url('harian/waitinglist')?>">Draft Waiting List</a></li>
          <div class="divider"></div>
          <li class="<?php echo $this->uri->segment(2) == 'homemingguan' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/homemingguan')?>">Target Kerja Mingguan</a></li>
          <?php if($this->session->userdata('ses_akses') == 'Manager') { ?>
            <li class="<?php echo $this->uri->segment(2) == 'rekap_pekerjaanhead' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/rekap_pekerjaanhead')?>">Rekap Pekerjaan</a></li>
          <?php } else if($this->session->userdata('ses_akses') == 'Pegawai'){ ?>
            <li class="<?php echo $this->uri->segment(2) == 'rekap_pekerjaan' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/rekap_pekerjaan')?>">Rekap Pekerjaan</a></li>
          <?php } ?>
          <!-- <li class="<?php echo $this->uri->segment(2) == 'viewharian2' ? 'active': '' ?> "><a class="nav-link" href="<?php echo base_url('harian/viewharian2')?>">Laporan Kerja Harian</a></li> -->
          <div class="divider"></div>

          <?php
          }else{
          ?>
          <li class="<?php echo $this->uri->segment(2) == 'waitinglist' ? 'active': '' ?> "><a class="nav-link" href="<?php echo base_url('harian/waitinglist')?>">Draft Waiting List</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'homemingguan' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/homemingguan')?>">Target Kerja Mingguan</a></li>
          <div class="divider"></div>
          <!-- <li class="<?php echo $this->uri->segment(2) == 'viewharian2' ? 'active': '' ?> "><a class="nav-link" href="<?php echo base_url('harian/viewharian2')?>">Laporan Kerja Harian</a></li> -->
          <?php if($this->session->userdata('ses_akses') == 'Manager') { ?>
            <li class="<?php echo $this->uri->segment(2) == 'rekap_pekerjaanhead' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/rekap_pekerjaanhead')?>">Rekap Pekerjaan</a></li>
          <?php } else if($this->session->userdata('ses_akses') == 'Pegawai'){ ?>
            <li class="<?php echo $this->uri->segment(2) == 'rekap_pekerjaan' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/rekap_pekerjaan')?>">Rekap Pekerjaan</a></li>
          <?php } ?>
          <div class="divider"></div>

          <?php
          }
          ?>
          <!-- <li class="<?php //echo $this->uri->segment(2) == 'homemingguan' ? 'active': '' ?>"><a class="nav-link" href="<?php //echo base_url('mingguan/homemingguan2')?>">Weeks Revisi - UnderMaintance</a></li> -->
        </ul>
      </li>
      <?php
      endif;
       ?>

      <?php
      $direksi = $this->session->userdata('ses_username');
      $cariapprove = $this->db->query("SELECT
                                        	a.*
                                        FROM
                                        	tkmdivisi a
                                        JOIN tb_user b ON a.pengisi = b.id_user
                                        WHERE
                                        	a.status = 'Menunggu Approval'
                                        	AND b.atasan='$direksi'
                                        ORDER BY
                                        	NO ASC")->result_array();
      if(empty($cariapprove)){
        $beep = "";
      }else{
        $beep = "beep beep-sidebar";
      }


      if($this->session->userdata('ses_akses') == 'Direksi'):
      ?>
      <li class="menu-header">Komando dan Tanggung Jawab</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Data Master</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?=base_url('master/divisi')?>">Master Divisi</a></li>
          <!-- <li><a class="nav-link" href="<?=base_url('master/karyawan')?>">Master Karyawan</a></li> -->
          <li><a class="nav-link" href="<?=base_url('master/karyawan')?>">Struktur Organisasi</a></li>
          <li><a class="nav-link" href="<?=base_url('master/kategori')?>">Master Kategori</a></li>
        </ul>
        <!-- <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Struktur</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?php// echo base_url('struktur/management')?>">Management</a></li>
        </ul> -->
      </li>

      <li class="menu-header">Target Kerja</li>
      <!-- <li class="<?php echo $this->uri->segment(2) == 'kategori' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('master/kategori')?>"><i class="fas fa-fire"></i> <span>Master Kategori</span></a></li> -->
      <li class="dropdown <?php echo $this->uri->segment(1) == 'mingguan' ? 'active': '' ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Target Kerja</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'waitinglist' ? 'active': '' ?> "><a class="nav-link" href="<?php echo base_url('harian/waitinglist')?>">Draft Waiting List</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'homemingguan' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/homemingguan')?>">Target Kerja Mingguan</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'approvalmingguan' ? 'active': '' ?>"><a class="nav-link <?php echo $beep; ?>" href="<?php echo base_url('mingguan/approvalmingguan')?>"> Approval Target Kerja</a></li>
          <!-- <li class="<?php echo $this->uri->segment(2) == 'listtkmdivisi' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/listtkmdivisi')?>"> List TKM</a></li> -->
          <li class="<?php echo $this->uri->segment(2) == 'laporantimesheet' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/laporantimesheet')?>"> Laporan Timesheet</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'laporantimesheet' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/laporanpayrol')?>"> Laporan Payrol</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'rekap_pekerjaanhead' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/rekap_pekerjaanhead')?>"> Rekap Pekerjaan</a></li>

        </ul>
      </li>
      <?php
      endif;
      ?>

      <?php
      if($this->session->userdata('ses_divisi') == 'HC'):
      ?>
      <li class="dropdown <?php echo $this->uri->segment(1) == 'mingguan' ? 'active': '' ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Laporan</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'viewharian2' ? 'active': '' ?> "><a class="nav-link" href="<?php echo base_url('harian/viewharian2')?>">Laporan Kerja Harian</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'laporantimesheet' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/laporantimesheet')?>"> Laporan Timesheet</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'laporantimesheet' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/laporanpayrol')?>"> Laporan Payrol</a></li>

        </ul>
      </li>
      <?php
      endif;
      ?>

      <?php
      if($this->session->userdata('ses_akses') == 'Manager' && $this->session->userdata('ses_divisi') != 'HC' && $this->session->userdata('ses_username') != 'alfi'):
      ?>
      <li class="dropdown <?php echo $this->uri->segment(1) == 'mingguan' ? 'active': '' ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Laporan</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'viewharian2' ? 'active': '' ?> "><a class="nav-link" href="<?php echo base_url('harian/viewharian2')?>">Laporan Kerja Harian</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'laporantimesheet' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/laporantimesheet')?>"> Laporan Timesheet</a></li>
        </ul>
      </li>
      <?php
      endif;
      ?>

      <?php
      if($this->session->userdata('ses_akses') != 'Manager' && $this->session->userdata('ses_divisi') != 'HC'):
      ?>
      <li class="dropdown <?php echo $this->uri->segment(1) == 'mingguan' ? 'active': '' ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Laporan</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'viewharian2' ? 'active': '' ?> "><a class="nav-link" href="<?php echo base_url('harian/viewharian2')?>">Laporan Kerja Harian</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'laporantimesheet' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/laporantimesheet')?>"> Laporan Timesheet</a></li>
        </ul>
      </li>
      <?php
      endif;
      ?>

      <?php
      if($this->session->userdata('ses_username') == '998'):
      ?>
      <li class="<?php echo $this->uri->segment(1) == 'master' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('master/waktuisitkm')?>"><i class="fas fa-times"></i> <span>Waktu Isi TKM</span></a></li>
      <?php
      endif;
      ?>

      <?php
      if($this->session->userdata('ses_akses') == 'Manager' &&  $this->session->userdata('ses_divisi') == 'FINANCE'):
      ?>
      <li class="menu-header">Approval</li>
      <li class="dropdown <?php echo $this->uri->segment(1) == 'mingguan' ? 'active': '' ?>">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Divisi SUB FINANCE</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'approvalmingguan' ? 'active': '' ?>"><a class="nav-link <?php echo $beep; ?>" href="<?php echo base_url('mingguan/approvalmingguan')?>"> Approval Target Kerja</a></li>
          <!--<li class="<?php echo $this->uri->segment(2) == 'listtkmdivisi' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('mingguan/listtkmdivisi')?>"> List TKM</a></li>-->
        </ul>
      </li>
      <?php
      endif;
      ?>

      <?php
      if ($this->session->userdata('ses_akses') == 'Direksi' OR $this->session->userdata('ses_akses') == 'Manager') {
         ?>

      <li class="menu-header">Panduan</li>
      <li class="<?php echo $this->uri->segment(1) == 'panduan' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('master/panduan')?>"><i class="fas fa-book"></i> <span>Panduan Aplikasi</span></a></li>

      <?php 
      } 

       if ($this->session->userdata('ses_akses') == 'Direksi' OR ($this->session->userdata('ses_akses') == 'Manager' AND $this->session->userdata('ses_divisi') == 'HC' )) {
      ?>

      <li class="menu-header">User</li>
      <li class="<?php echo $this->uri->segment(1) == 'panduan' ? 'active': '' ?>"><a class="nav-link" href="<?php echo base_url('auth/register')?>"><i class="fas fa-user"></i> <span>Register User</span></a></li>


    <?php } ?>
          <!-- <li ><a class="nav-link" type="button" href="#" data-toggle="modal" data-target="#disclaimer2"><i class="fas fa-exclamation-circle"></i> <span>Disclaimer</span></a></li> -->
    
  </aside>
</div>

<div class="modal fade" id="disclaimer2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <?php  $user_login = $this->session->userdata('ses_username');
            $nama_login = $this->session->userdata('ses_nama'); ?>
        <form action="<?php echo base_url('dashboard/disclaimer') ?>" method="POST">
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
              <td style="text-align: justify;">Pengisian Tugas Kerja Mingguan  paling telat hari Jumat sebelum jam 23.59.</td>
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
              <td style="text-align: justify;">Apabila karyawan tidak mencapai TKM sesuai timeline yang telah disepakati maka akan terkena pemotongan tunjangan.</td>
            </tr>
            <tr>
              <td width="5%" valign="top">(5)</td>
              <td style="text-align: justify;">Setiap divisi wajib mengadakan meeting TKM sebelum membuat TKM untuk minggu berikutnya.</td>
            </tr>

          </tbody>
        </table>
        <hr width="100%" style="height:0; border-top:3px solid #DCDCDC;">
        <?php
        $username = $this->session->userdata('ses_username');
        $disc = $this->db->get_where('disclaimer', array('id_user' => $username))->num_rows();
        if ($disc > 0) {
           ?>
        <p><input type="checkbox" checked name="check_pernyataan" id="setujui1" value="setujui1" onclick="return false;"> <b>Saya telah membaca dan memahami pernyataan tersebut diatas.</b> </p>
        <p><input type="checkbox" checked name="check_pernyataan" id="setujui2" value="setujui2" onclick="return false;"> <b>Saya  menyetujui pernyataan dan ketentuan-ketentuan tersebut diatas.</b> </p>
        <p><input type="checkbox" checked name="check_pernyataan" id="setujui3" value="setujui3" onclick="return false;"> <b>Saya menerima konsekuensi apabila melanggar ketentuan tersebut diatas.</b> </p>
      <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

