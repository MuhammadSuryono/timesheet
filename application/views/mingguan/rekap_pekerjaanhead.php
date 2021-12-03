
<?php 
 $user = $this->session->userdata('ses_username');
 $akses = $this->session->userdata('ses_akses');

?>
<!-- Main Content -->
<style type="text/css">
  a.disabled {
  pointer-events: none;
  cursor: default;
}


</style>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <!-- <h1>Waiting List Target (Result Akhir)</h1> -->
      <h1> </h1>
      


    </div>

    <input type="hidden" id="aksesnya" value="<?= $this->session->userdata('ses_akses'); ?>">
      <input type="hidden" id="usernya" value="<?= $this->session->userdata('ses_username'); ?>">


    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>



    <div class="row row-eq-height">


                  <?php
                  $divisinya = $this->session->userdata('ses_divisi');
                  // if ($this->session->userdata('ses_akses') == 'Direksi') {
                  $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.atasan='$user' AND a.to_tkm = 'N' AND a.username != '$user' ORDER BY b.nama_user, a.tgl_delivery ASC")->result_array();
                  // } else {
                  // $waitinglist = $this->db->query("SELECT * FROM list_note a JOIN tb_user b ON a.username=b.id_user WHERE b.divisi='$divisinya' AND a.to_tkm = 'N' AND a.username != '$user' ORDER BY b.nama_user, a.tgl_delivery ASC")->result_array();
                  // }

                  $kat = $this->db->get('wl_kategori')->result_array();

                  $head = $this->db->get_where('tb_user', array('atasan' => $user))->result_array();
		        $poll = [];
		        $div = [];
		          foreach ($head as $row) {
		            $poll[] = $row['id_user'];
		            $div[] = $row['divisi'];
		          }
		          // $imploded_arr = implode(',', $poll);
		          if ($poll != NULL) {
		           $daftar = $this->db->where_in('atasan', $poll)->or_where('atasan', $user)->group_by('id_user')->order_by('nama_user', 'ASC')->get('tb_user')->result_array();
		          } else {
		          $daftar = $this->db->where('atasan', $user)->group_by('id_user')->order_by('nama_user', 'ASC')->get('tb_user')->result_array();
		          }

                   ?>

      <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
            <div class="card-body">
            <h6 class="text-primary">Search Data :</h6>
        <?php if ($akses == 'Direksi') { ?>
          <div class="row mx-3 mb-3">
            <div class="col-sm-2"><strong>Pilih Divisi :</strong></div>
            <div class="col-sm-8">
              <select class="form-control selectpicker select2" id="divisi" style="width: 100%;" onchange="gantiDivisi()">
                <option>--Pilih Nama Divisi--</option>
                <?php foreach ($divisi as $row) {
                  ?>
                <option value="<?= $row['divisi'] ?>"><?= $row['divisi'] ?></option>
                <?php } ?>
              </select>
            </div>    
        </div>
        <?php } ?>
        <div class="row mx-3 mb-3">
            <div class="col-sm-2"><strong>Pilih Nama :</strong></div>
            <div class="col-sm-8">
              <select class="form-control selectpicker select2" id="nama_kar" style="width: 100%;">
                <option>--Pilih Nama Karyawan--</option>
                <?php foreach ($daftar as $row) {
                  ?>
                <option value="<?= $row['id_user'] ?>"><?= $row['nama_user'] ?></option>
                <?php } ?>
              </select>
            </div>    
        </div>

      <div class="row mx-3">
        <div class="col-sm-2"><p class="font-weight-bold">Dari Tanggal :</p></div>
        <div class="col-sm-3"><input type="date" class="form-control" name="daritanggal" id="daritanggal"></div>
        <div class="col-sm-2"><p class="font-weight-bold">Sampai Tanggal :</p></div>
        <div class="col-sm-3"><input type="date" class="form-control" name="sampaitanggal" id="sampaitanggal"></div>
        <div class="col-sm-2"><button type="button" class="btn btn-primary" onclick="searchData()"><i class="fas fa-search"></i> Search</button></div>

      </div>
      <div class="row mx-3">
        <div class="col-sm-2"><p class="font-weight-bold">Kata Kunci :</p></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="katakunci" id="katakunci"></div>
        
      </div>
        <a href="" id="pengajuan" class="btn btn-warning">Pengajuan Perpanjang Target Selesai</a>

      <hr>

        <b><span class="text-warning faa-flash animated">*Note </span> : Detail pekerjaan harian dapat dilihat di menu laporan timesheet!</h5></b>
        <div class="table-responsive">

        <table class="table  table-bordered table-hover table-striped tabel-rekap" >
          <thead>
              <tr class="bg-light">
                <th class="no">No</th>
                <th class="rincian">Rincian</th>
                <th class="persen">Persentase</th>
								<th class="persen">Poin Penilaian</th>
                <th class="status">Status</th>
                <th class="target">Target Selesai</th>
                <th class="target">Detail</th>
                <th class="pencapaian">Pencapaian</th>
                <th class="approval">Approval</th>
                <th class="aksi">Aksi</th>

              </tr>
            <!-- <tr>
              <th colspan="2">TKM</th>

            </tr>
 -->
          </thead>
          <tbody id="datanya">
            <tr>
            	<td colspan="10"><center><b>Belum Ada Data</b></center></td>
            </tr>
          </tbody>
        </table>
      </div>
      <br>
      <?php 
      // if($get != NULL) {
       ?>
       <p ><span class="font-weight-bold">Note : </span>
       <br> * Kolom Pencapaian akan terisi otomatis jika persentase sudah terisi sampai 100%.
       <br> * Data yang ditampilkan merupakan data 2 minggu terakhir, jika ingin melihat data melebihi 2 minggu dapat menggunakan fitur 'Search Data'.

      </p>
     <?php 
   // } ?>  
            </div>
          <div class="card-footer">
            
          </div>

          <!-- Modal -->
            
        </div>
      </div>
    </div>

 

    



  </section>
</div>

<!-- Modal -->
<div class="modal fade" id="pengurangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengurangan Persentase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('mingguan/kurangi_rekap'); ?>">
          <input type="hidden" name="id_rincian" class="form-control" id="id_rincian">
          <div class="form-group">
            <label for="alasan_tolak">Rincian</label>
              <textarea class="form-control" id="rincian_kurang" name="rincian_kurang" readonly></textarea>
          </div>
          <div class="form-group">
            <label for="alasan_tolak">Persentase</label>
            <input type="number" name="persentase_kurang" id="persentase_kurang" class="form-control">
          </div>
          <div class="form-group">
            <label for="alasan_tolak">Alasan Pengurangan Persentase</label>
              <textarea class="form-control" id="alasan_kurang" name="alasan_kurang"></textarea>
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
<div class="modal fade" id="detailin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <h6>Last Submit</h6> -->
        <div class="form-group">
            <label for="alasan_tolak"><h6>Pekerjaan</h6></label>
              <textarea class="form-control" id="pekerjaan_submit" name="pekerjaan_submit" readonly></textarea>
        </div>
        <h6>History Laporan Kerja Harian</h6>
        <div class="table-responsive">
          <table class="table  table-bordered table-hover table-striped tabel-rekap">
            <thead class="bg-light">
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Note</th>
                <th>Persentase</th>
                <th>File Upload</th>
              </tr>
            </thead>
            <tbody id="history_submit">
              
            </tbody>
          </table>
        </div>
        <!-- <div class="form-group">
            <label for="alasan_tolak">Keterangan</label>
              <textarea class="form-control" id="keterangan_submit" name="keterangan_submit" readonly></textarea>
        </div>
        <div class="form-group">
            <label for="alasan_tolak">File Upload</label>
            <div id="filenya"></div>
        </div>
        <div class="form-group">
            <label for="alasan_tolak">Tanggal</label>
            <input type="date" class="form-control" name="tanggalnya" id="tanggalnya" readonly>
        </div> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script type="text/javascript">

function gantiDivisi(){
  
  var divisi = $('#divisi').val();

  $('#nama_kar').empty();

  $.ajax({
           url: "<?php echo base_url('mingguan/getname_divisi') ?>",
           method: "POST",
           data: {
             divisi: divisi,
             
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
              var ht = '';
            if(hasil.length > 0) {
              ht +=  `<option>--Pilih Nama Divisi--</option>`;
              for (var i = 0; i < hasil.length; i++) {
               ht += "<option value='" + hasil[i]['id_user'] + "'>" + hasil[i]['nama_user'] + "</option>";
             }

           } else {
              ht +=  `<option>--Pilih Nama Divisi--</option>`;
              
            }
             $('#nama_kar').append(ht);
            
         }
  });
}

	function detailnya(id){
  console.log(id);
  var id_rincian = id;
                $('#filenya').empty();
                $('#history_submit').empty();

  $.ajax({
           url: "<?php echo base_url('mingguan/getlastsubmit') ?>",
           method: "POST",
           data: {
             id_rincian: id_rincian,
             
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
              var ht = '';
            if(hasil.length > 0) {
              $('#pekerjaan_submit').val(hasil[0]['project']);
            
             for (var i = 0; i < hasil.length; i++) {
                var num = i + 1;
              
                ht += `<tr>
                      <td>`+num+`</td>
                      <td>`+hasil[i]['tanggal']+`</td>
                      <td>`+hasil[i]['keterangan']+`</td>
                      <td>`+hasil[i]['persentase']+`%</td>`;
                if (hasil[i]['fileupload'] != null && hasil[i]['fileupload'] != "") {  
                  ht += `<td><a target="_blank" href="<?php echo base_url('dist/upload/') ?>`+hasil[i]['fileupload']+`"><i class="fa fa-file"></i></a></td>`;
                } else {
                  ht += `<td></td>`;
                }
                ht += `</tr>`;
             }

           } else {
              ht += `<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;">
                        <th colspan="5">
                          <h6>Data Tidak Tersedia</h6>
                        </th>
                      </tr>`; 
            }
             $('#history_submit').append(ht);
            
         }
  });
}

$(document).ready(function() {
    var isAvailableLastData = getParameterByName('lastData')
      
    if (isAvailableLastData === 'true') {
      var idUser = getParameterByName('idUser')
      var startDate = getParameterByName('startDate')
      var endDate = getParameterByName('endDate')
      var keyword = getParameterByName('keyword')
      var isSearch = getParameterByName('isSearch')

      if (isSearch === 'true') {
        searchData(idUser, startDate, endDate, keyword)
      }

      setDataToLocalStorage('search_data_rekap', '')
    }
  })

  function setDataToLocalStorage(key, data) {
     window.localStorage.setItem(key, data)
   }

  function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }

function viewDiscuss(taskId) {
    setDataToLocalStorage('previous_page', '<?= base_url("mingguan/rekap_pekerjaan") ?>')
    window.location.href = "<?php echo base_url('discuss/list/task/') ?>" + taskId
  }

$(document).ready(function(){
	$( "#nama_kar" ).change(function() {
	  var id_user = $(this).val();

	var akses = $('#aksesnya').val();
    var usernya = $('#usernya').val();


    var base = window.location.origin + "/";
         var host = base + window.location.pathname.split('/')[1];

    console.log(id_user);

    $('#datanya').empty();
    $.ajax({
           url: "<?php echo base_url('dashboard/getrekap_name') ?>",
           method: "POST",
           data: {
             id_user: id_user,
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
              var ht = '';
            if(hasil.length > 0) {
             for (var i = 0; i < hasil.length; i++) {
              var today = hasil[i]['targetselesai'].split("-");
              var tanggal = today[2]+"-"+today[1]+"-"+today[0];

              var num = i + 1;
              if (hasil[i]['approval'] == null) {
                hasil[i]['approval'] = '';
              }

              if (hasil[i]['status'] == null) {
                hasil[i]['status'] = '';
              }
                ht += `<tr>
                      <td>`+num+`</td>
                      <td>`+hasil[i]['rincian']+`</td>`;
              if (hasil[i]['targetpersen'] == null) {
                ht +=`<td><center>0%</center></td>`;
              } else {
                ht +=`<td><center>`+hasil[i]['targetpersen']+`%&nbsp;
                    	<a href="#" type="button" data-toggle="modal" data-target="#pengurangan" onclick="kurangiRekap('`+hasil[i]['id_rincian']+`', '`+hasil[i]['targetpersen']+`', '`+hasil[i]['rincian']+`')"><i class="fas fa-edit"></i></a>
                </center></td>`;
              }
								ht += '<td class="text-center">'+hasil[i].point_task+'</td>';
                ht += `<td>`+hasil[i]['status']+`</td>
                      <td>`+tanggal+`</td>
                      <td><button type="button" class="btn btn-round btn-sm btn-primary" data-toggle="modal" data-target="#detailin" onclick="detailnya('`+hasil[i]['id_rincian']+`');">Detail</button></td>
                      `;
              
								let messagePencapaianWithDiscuss = hasil[i].with_discuss;
                if (hasil[i]['targetpersen'] == 100 && hasil[i]['tanggalupdate'] < hasil[i]['targetselesai'] && hasil[i]['targetselesai'] != '0000-00-00') {
                  // var selisih = hasil[i]['targetselesai'] - hasil[i]['tanggalupdate'];
                  var date1 = new Date(hasil[i]['targetselesai']);    
                  var date2 = new Date(hasil[i]['tanggalupdate']);
                  var weekend = 0;


                  let loop = new Date(date2);
                    while (loop <= date1) {
                      console.log(loop);
                      if (loop.getDay() == 6 || loop.getDay() == 0) {
                        weekend++;
                      }
                      let newDate = loop.setDate(loop.getDate() + 1);
                      loop = new Date(newDate);
                    }

                    // alert(weekend);

                  var diff = (date2 - date1)/1000;
                  diff = Math.abs(Math.floor(diff));

                  var days = (Math.floor(diff/(24*60*60))) - weekend;
                  var leftSec = diff - days * 24*60*60;
                  
                  ht += `<td style="background-color: #7CFC00;">Lebih Cepat `+days+` Hari ${messagePencapaianWithDiscuss}</td>`;
                } else if (hasil[i]['targetpersen'] == 100 && hasil[i]['tanggalupdate'] > hasil[i]['targetselesai'] && hasil[i]['targetselesai'] != '0000-00-00') {
                  var date1 = new Date(hasil[i]['tanggalupdate']);    
                  var date2 = new Date(hasil[i]['targetselesai']);
                  var weekend = 0;


                  let loop = new Date(date2);
                    while (loop <= date1) {
                      console.log(loop);
                      if (loop.getDay() == 6 || loop.getDay() == 0) {
                        weekend++;
                      }
                      let newDate = loop.setDate(loop.getDate() + 1);
                      loop = new Date(newDate);
                    }

                    // alert(weekend);

                  var diff = (date2 - date1)/1000;
                  diff = Math.abs(Math.floor(diff));

                  var days = (Math.floor(diff/(24*60*60))) - weekend;
                  var leftSec = diff - days * 24*60*60;

                  ht += `<td style="background-color: #DC143C; color: white;">Terlambat `+days+` Hari ${messagePencapaianWithDiscuss}</td>`;
                } else if (hasil[i]['targetpersen'] == 100 && hasil[i]['tanggalupdate'] == hasil[i]['targetselesai'] && hasil[i]['targetselesai'] != '0000-00-00') {
                  ht += `<td style="background-color: #00CED1; color: white;">Tepat Waktu ${messagePencapaianWithDiscuss}</td>`;
                } else {
                  ht += `<td></td>`;
                }
                 ht += `<td>`;
                   if ((akses == 'Manager' || akses == 'Direksi') && id_user != usernya) {
                        if (hasil[i]['targetpersen'] == 100 && (hasil[i]['approval'] != 'Diterima' || hasil[i]['approval'] == '')) {
                          
                        ht += `<b>`+hasil[i]['approval']+`</b><br>`;

                        ht += `<div class="row"><a href="`+host+`/harian/approval_rekap/`+hasil[i]['id_rincian']+`" title="Diterima" class="btn btn-success"><i class="fas fa-check-square"></i></a>
                         <a href="#" id="tolak_approve" type="button" title="Ditolak" class="btn btn-danger" data-toggle="modal" data-target="#tolak" data-rincian="`+hasil[i]['id_rincian']+`" onclick="clickTolak('`+hasil[i]['id_rincian']+`');"><i class="fas fa-times-circle"></i></a></div>`;
                       } else {
                        ht += `<b>`+hasil[i]['approval']+`</b>`;
                       }
                   } else { 
                      if (hasil[i]['approval'] == 'Diterima') {
                        ht += `<b class="text-success">`+hasil[i]['approval']+`</b>`;
                      } else if (hasil[i]['approval'] == 'Ditolak')  {
                        ht += `<b class="text-danger">`+hasil[i]['approval']+` (`+hasil[i]['alasan']+`)</b>`;
                      }

                   }
                 ht += `</td>
								 <td><button onclick="viewDiscuss(`+hasil[i]["no"]+`)" class="btn btn-primary btn-sm btn-view-discuss"><i class="fa fa-comments"></i>&nbsp;Lihat Diskusi</button></td>
              
            </tr>`;
              }
            } else {
              ht += `<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;">
                        <th colspan="8">
                          <h6>Data Tidak Tersedia</h6>
                        </th>
                      </tr>`; 
            } 
                $('#datanya').append(ht);
                $("#pengajuan").attr("href", host+'/mingguan/perpanjang/'+id_user);

           }
         });

	});
});

 function searchData(){
    var id_user = $('#nama_kar').val();
    var daritanggal = $('#daritanggal').val();
    var sampaitanggal = $('#sampaitanggal').val();
    var katakunci = $('#katakunci').val();

    var akses = $('#aksesnya').val();
    var usernya = $('#usernya').val();

    var base = window.location.origin + "/";
         var host = base + window.location.pathname.split('/')[1];

    $('#datanya').empty();
    console.log(id_user);
    console.log(daritanggal);
    console.log(sampaitanggal);
    $.ajax({
           url: "<?php echo base_url('dashboard/getrekap') ?>",
           method: "POST",
           data: {
             id_user: id_user,
             daritanggal: daritanggal,
             sampaitanggal: sampaitanggal,
             katakunci: katakunci
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
              var ht = '';
            if(hasil.length > 0) {
             for (var i = 0; i < hasil.length; i++) {
              var today = hasil[i]['targetselesai'].split("-");
              var tanggal = today[2]+"-"+today[1]+"-"+today[0];

              var num = i + 1;
              if (hasil[i]['approval'] == null) {
                hasil[i]['approval'] = '';
              }

              if (hasil[i]['status'] == null) {
                hasil[i]['status'] = '';
              }
                ht += `<tr>
                      <td>`+num+`</td>
                      <td>`+hasil[i]['rincian']+`</td>`;
              if (hasil[i]['targetpersen'] == null) {
                ht +=`<td><center>0%</center></td>`;
              } else {
                ht +=`<td><center>`+hasil[i]['targetpersen']+`%&nbsp;
                    	<a href="#" type="button" data-toggle="modal" data-target="#pengurangan" onclick="kurangiRekap('`+hasil[i]['id_rincian']+`', '`+hasil[i]['targetpersen']+`', '`+hasil[i]['rincian']+`')"><i class="fas fa-edit"></i></a>
                </center></td>`;
              }
                ht += '<td class="text-center">'+hasil[i].point_task+'</td>';

                ht += `<td>`+hasil[i]['status']+`</td>
                      <td>`+tanggal+`</td>
                      <td><button type="button" class="btn btn-round btn-sm btn-primary" data-toggle="modal" data-target="#detailin" onclick="detailnya('`+hasil[i]['id_rincian']+`');">Detail</button></td>
                      `;
              
								let messagePencapaianWithDiscuss = hasil[i].with_discuss;
                if (hasil[i]['targetpersen'] == 100 && hasil[i]['tanggalupdate'] < hasil[i]['targetselesai'] && hasil[i]['targetselesai'] != '0000-00-00') {
                  // var selisih = hasil[i]['targetselesai'] - hasil[i]['tanggalupdate'];
                  var date1 = new Date(hasil[i]['targetselesai']);    
                  var date2 = new Date(hasil[i]['tanggalupdate']);
                  var weekend = 0;


                  let loop = new Date(date2);
                    while (loop <= date1) {
                      console.log(loop);
                      if (loop.getDay() == 6 || loop.getDay() == 0) {
                        weekend++;
                      }
                      let newDate = loop.setDate(loop.getDate() + 1);
                      loop = new Date(newDate);
                    }

                    // alert(weekend);

                  var diff = (date2 - date1)/1000;
                  diff = Math.abs(Math.floor(diff));

                  var days = (Math.floor(diff/(24*60*60))) - weekend;
                  var leftSec = diff - days * 24*60*60;
                  
                  ht += `<td style="background-color: #7CFC00;">Lebih Cepat `+days+` Hari ${messagePencapaianWithDiscuss}</td>`;
                } else if (hasil[i]['targetpersen'] == 100 && hasil[i]['tanggalupdate'] > hasil[i]['targetselesai'] && hasil[i]['targetselesai'] != '0000-00-00') {
                  var date1 = new Date(hasil[i]['tanggalupdate']);    
                  var date2 = new Date(hasil[i]['targetselesai']);
                  var weekend = 0;


                  let loop = new Date(date2);
                    while (loop <= date1) {
                      console.log(loop);
                      if (loop.getDay() == 6 || loop.getDay() == 0) {
                        weekend++;
                      }
                      let newDate = loop.setDate(loop.getDate() + 1);
                      loop = new Date(newDate);
                    }

                    // alert(weekend);

                  var diff = (date2 - date1)/1000;
                  diff = Math.abs(Math.floor(diff));

                  var days = (Math.floor(diff/(24*60*60))) - weekend;
                  var leftSec = diff - days * 24*60*60;

                  ht += `<td style="background-color: #DC143C; color: white;">Terlambat `+days+` Hari ${messagePencapaianWithDiscuss}</td>`;
                } else if (hasil[i]['targetpersen'] == 100 && hasil[i]['tanggalupdate'] == hasil[i]['targetselesai'] && hasil[i]['targetselesai'] != '0000-00-00') {
                  ht += `<td style="background-color: #00CED1; color: white;">Tepat Waktu ${messagePencapaianWithDiscuss}</td>`;
                } else {
                  ht += `<td></td>`;
                }
                 ht += `<td>`;
                   if ((akses == 'Manager' || akses == 'Direksi') && id_user != usernya) {
                        if (hasil[i]['targetpersen'] == 100 && (hasil[i]['approval'] != 'Diterima' || hasil[i]['approval'] == '')) {
                          
                        ht += `<b>`+hasil[i]['approval']+`</b><br>`;

                        ht += `<div class="row"><a href="`+host+`/harian/approval_rekap/`+hasil[i]['id_rincian']+`" title="Diterima" class="btn btn-success"><i class="fas fa-check-square"></i></a>
                         <a href="#" id="tolak_approve" type="button" title="Ditolak" class="btn btn-danger" data-toggle="modal" data-target="#tolak" data-rincian="`+hasil[i]['id_rincian']+`" onclick="clickTolak('`+hasil[i]['id_rincian']+`');"><i class="fas fa-times-circle"></i></a></div>`;
                       } else {
                        ht += `<b>`+hasil[i]['approval']+`</b>`;
                       }
                   } else { 
                      if (hasil[i]['approval'] == 'Diterima') {
                        ht += `<b class="text-success">`+hasil[i]['approval']+`</b>`;
                      } else if (hasil[i]['approval'] == 'Ditolak')  {
                        ht += `<b class="text-danger">`+hasil[i]['approval']+` (`+hasil[i]['alasan']+`)</b>`;
                      }

                   }
                 ht += `</td>
              
            </tr>`;
              }
            } else {
              ht += `<tr class="text-center" style="border-bottom: 1px solid #F0F8FF;">
                        <th colspan="8">
                          <h6>Data Tidak Tersedia</h6>
                        </th>
                      </tr>`; 
            } 
                $('#datanya').append(ht);

           }
         });

   }

   function kurangiRekap(id_rincian, targetpersen, rincian)
   {
   	$('#id_rincian').val(id_rincian);
   	$('#persentase_kurang').val(targetpersen);
   	$('#rincian_kurang').val(rincian);

   }
</script>
