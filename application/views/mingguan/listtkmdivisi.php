<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>List TKM</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Target Kerja</a></div>
        <div class="breadcrumb-item active">List TKM</div>
      </div>
    </div>

    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

    <div class="section-body">
      <h2 class="section-title">List TKM Divisi</h2>

          <div id="accordion">

            <?php
            error_reporting(0);
            foreach ($tanggalnya as $key){
            ?>
            <div class="accordion">
              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-<?php echo $key['no']?>">
                <h4>TKM <?php echo $key['daritanggal']; ?> s/d <?php echo $key['sampaitanggal'] ?></h4>
              </div>
              <div class="accordion-body collapse" id="panel-body-<?php echo $key['no']?>" data-parent="#accordion">
                <?php
                  if($this->session->userdata('ses_divisi') == 'FINANCE'){
                  $caritkmdiv = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='$key[daritanggal]' AND sampaitanggal='$key[sampaitanggal]' AND (divisi='FINANCE' OR divisi='SUB FINANCE')")->result_array();  
                  }else{
                  $caritkmdiv = $this->db->query("SELECT * FROM tkmdivisi WHERE daritanggal='$key[daritanggal]' AND sampaitanggal='$key[sampaitanggal]'")->result_array();
                  }



                  foreach ($caritkmdiv as $tkm) {
                  ?>
                    <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h4>Target Kerja <?php echo $tkm['divisi']?> <?php echo $tkm['daritanggal']?> s/d <?php echo $tkm['sampaitanggal']?></h4>
                            <div class="card-header-action">

                              <a href="<?php echo base_url('mingguan/viewtkmdivisi')?>/<?php echo $key['no']?>" class="btn btn-info">View</a>
                              <a data-collapse="#mycard-collapse<?php echo $tkm['no']?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                            </div>
                          </div>
                          <div class="collapse" id="mycard-collapse<?php echo $tkm['no']?>">
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
                                        $caripekerjaan = $this->db->query("SELECT
                                                                                  a.*,
                                                                                  b.nama_kategori AS namakategori
                                                                                  FROM pekerjaan a
                                                                                  JOIN kategori b ON a.id_kategori = b.id_kategori
                                                                                  WHERE idtkmdiv='$tkm[no]'")->result_array();
                                        $x = 1;
                                        foreach ($caripekerjaan as $cp) {
                                        $uraian = $this->db->query("SELECT * FROM uraian WHERE id_pekerjaan='$cp[no]'")->result_array();
                                        $jmlurai = $this->db->query("SELECT COUNT(id_uraian) AS jmu FROM uraian WHERE id_pekerjaan='$cp[no]'")->row_array();
                                        $rowspan = $jmlurai['jmu']+1;
                                        // echo $rowspan;
                                        ?>
                                            <tr>
                                                <td rowspan="<?=$rowspan?>"><?=$x++?></td>
                                                <td rowspan="<?=$rowspan?>"><?php echo $cp['project'] ?></td>
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

                            </div>
                          </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
              </div>
            </div>
            <?php
            }
            ?>



          </div>

    </div>
  </section>
</div>
