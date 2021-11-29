<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>View TKM Divisi 3</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <?php
        // error_reporting(0);
        if($this->session->userdata('ses_akses') == 'Direksi'){
        ?>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/listtkmdivisi')?>">List TKM</a></div>
        <?php
        }
        else{
        ?>
        <div class="breadcrumb-item"><a href="<?php echo base_url('mingguan/homemingguan')?>">List TKM</a></div>
        <?php
        }
        ?>
        <div class="breadcrumb-item active">View TKM Divisi</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <?php
    $divisi = $this->session->userdata('ses_divisi');
    ?>

    <div class="section-body">
      <h2 class="section-title">View TKM Divisi <?php echo $divisi ?></h2>

        <div class="card card-primary">
          <div class="card-header">
            <h4>TKM Lintaas Divisi</h4>
            <div class="card-header-action">
            </div>
          </div>
          <div class="card-body">
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
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
                                    <th>Deskripsi</th>
                                    <th>Persentase</th>
                                    <th>Uraian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $x = 1;
                                foreach ($tkmdiv as $cp) {
                                $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$cp[no]'")->result_array();
                                $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$cp[no]'")->row_array();
                                $rowspan = $jmlurai['jmu']+1;
                                // echo $rowspan;
                                ?>
                                    <tr>
                                        <td rowspan="<?=$rowspan?>"><?=$x++?></td>
                                        <td rowspan="<?=$rowspan?>"><?php echo $cp['project'] ?> (From : <?php echo $cp['fromdivisi']?> )</td>
                                        <td rowspan="<?=$rowspan?>"><?php echo $cp['namakategori'] ?></td>
                                        <td rowspan="<?=$rowspan?>"><?php echo $cp['deskripsi'] ?></td>
                                        <td rowspan="<?=$rowspan?>" class="text-center"><?php echo $cp['persentase']?>%
                                          <div class="progress" data-height="4">
                                            <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo $cp['persentase']?>%" aria-valuenow="<?php echo $cp['persentase']?> %" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </td>
                                    </tr>
                                    <?php foreach($uraian as $ua):?>
                                    <tr >
                                        <td><?php echo $ua['uraian']?></td>
                                    </tr>
                                    <?php endforeach?>
                                    <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="card-footer">
                      <!-- <button type="button" class="btn btn-sm btn-icon btn-round btn-info" data-toggle="modal" data-target="#add" data-id="0" data-new="1"><i class="fa fa-plus"></i> Assign Lintas Divisi</button> -->
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>


        <h2 class="section-title">Staff</h2>
        <p class="section-lead">List Target Staff Divisi</p>


        <div class="row">

          <?php
          // error_reporting(0);
          foreach ($liststaff as $key) {
          ?>
          <div class="col-12 col-md-4 col-lg-4">
            <div class="pricing">
              <div class="pricing-title">
                <?php echo $key['nama_user'] ?>
              </div>
              <div class="pricing-padding">
                <div class="pricing-details">
                  <ul>
                    <?php
                    $tanggalnya = $tanggal['tanggalnya'];
                    // echo $tanggalnya;

                    $carilintas = $this->db->query("SELECT
                                                    	a.*,
                                                    	b.project AS projectnya,
                                                    	b.persentase AS persenstaff
                                                    FROM
                                                    	pekerjaan_lintasdivisi a
                                                    JOIN tkmstaff b ON a.idtkmdiv = b.idtkmdiv
                                                    WHERE
                                                    	a.daritanggal = '$tanggalnya'
                                                    AND a.divisi = '$key[divisi]'
                                                    AND b.userstaff = '$key[id_user]'")->result_array();

                    if(empty($carilintas)){
                      echo "Belum ada target lintas divisi";
                    }else{
                      foreach ($carilintas as $clnya) {
                        if($clnya['persenstaff'] == 0){
                          echo "";
                        }else{
                        ?>
                          <li><?php echo $clnya['project'] ?> - <?php echo $clnya['persenstaff']?> %
                            <ol>
                                <?php
                                $caririncian = $this->db->query("SELECT
                                                                  	a.*
                                                                  FROM
                                                                  	rincian a
                                                                  JOIN pekerjaan_lintasdivisi c ON a.idtkmdiv = c.idtkmdiv
                                                                  AND c. NO = a.idpekerjaan AND c.divisi = '$key[divisi]'
                                                                  JOIN tkmstaff d ON d.no = a.id_tkmstaff
                                                                  WHERE
                                                                  	a.idtkmdiv = '$clnya[idtkmdiv]'
                                                                  AND a.userstaff = '$key[id_user]'")->result_array();
                                foreach ($caririncian as $cr) {
                                  echo "<li>";
                                  echo $cr['rincian'];
                                  echo "</li>";
                                  // code...
                                }
                                ?>
                            </ol>
                          </li>
                          <?php
                            }
                        }
                    }
                    ?>
                  </ul>
                </div>
              </div>
              <div class="pricing-cta">
                <?php
                if ($this->session->userdata('ses_akses') == 'Manager'){

                  ?>
                    <a href="<?php echo base_url('mingguan/isitkmstafflintas')?>/<?php echo $key['id_user']?>/<?php echo $tanggalnya; ?>">Isi <i class="fas fa-arrow-right"></i></a>
                  <?php if (!empty($carilintas)){

                  ?>
                    <a href="<?php echo base_url('mingguan/viewtkmstafflintas')?>/<?php echo $key['id_user']?>/<?php echo $tanggalnya; ?>">View <i class="fas fa-arrow-right"></i></a>
                  <?php
                  }
                }
                else{
                  if (empty($carilintas)){
                    echo "";
                  }else{
                  ?>
                    <a href="<?php echo base_url('mingguan/viewtkmstafflintas')?>/<?php echo $key['id_user']?>/<?php echo $tanggalnya; ?>">View <i class="fas fa-arrow-right"></i></a>
                  <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
        </div>

    </div>
  </section>
</div>
